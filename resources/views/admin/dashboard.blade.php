@extends('admin.layout.app')

@section('content')

<style>
     body {
        font-family: 'Lato', sans-serif;
        background-color: #f5f7fa;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        color: #333;
        text-align: center;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        margin-bottom: 20px;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 30px;
    }

    .card-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }

    .card-text {
        font-family: 'Montserrat', sans-serif;
        font-size: 36px;
        font-weight: 600;
        color: #333;
    }

    .icon {
        font-size: 50px;
        margin-bottom: 20px;
        color: #777;
    }

    .chart-container {
        width: 100%;
        margin-top: 30px;
    }

    .chart-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #444;
        margin-bottom: 20px;
    }

    .form-group select {
        border-radius: 8px;
        padding: 10px 15px;
        background-color: #ffffff;
        border: 1px solid #ced4da;
        font-size: 16px;
    }

    .btn-secondary {
        background-color: #4e5d6c;
        color: #fff;
        border-radius: 8px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #3f4e5b;
    }

    .fa-car {
        color: #2ecc71;
    }

    .fa-calendar-check {
        color: #3498db;
    }

    .fa-ban {
        color: #e74c3c;
    }

    .fa-users {
        color: #9b59b6;
    }

    .fa-building {
        color: #f1c40f;
    }
</style>


<section class="px-5">
    <div class="pt-4">
        <form class="d-flex justify-content-center align-items-center mb-4" style="height: 10vh;">
            <label for="hubFilter" class="mr-3">Select Hub</label>
            <div class="form-group mx-2">
                <select id="hubFilter" class="form-control" style="width: 300px;">
                    <option value="all">All Hubs</option>
                    @foreach ($hubs as $hub)
                    <option value="{{ $hub }}">{{ ucfirst($hub) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-secondary px-2 p-1 mb-3" id="searchBtn">
                <i class="fas fa-search" style="color: white;"></i>
            </button>
        </form>
    </div>

    <div class="row" id="dashboardCards">
        <!-- Cards will be dynamically loaded here -->
    </div>

    <div class="row gap-5">
        <div class="card col-md-6 chart-container mx-3">
            <div class="card-body">
                <h2 class="chart-title mb-5">Hub-Wise Car Availability</h2>
                <canvas id="barChart"></canvas>
            </div>
        </div>
        <div class="card col-md-5 chart-container mx-3">
            <div class="card-body">
                <h2 class="chart-title">Hub-Wise Bookings</h2>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</section>

@endsection


@section('customJs')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hubFilter = document.getElementById('hubFilter');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Set CSRF token for axios
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

            // Chart instances
            let barChartInstance = null;
            let pieChartInstance = null;

            // Fetch and load dashboard data
            function loadDashboardData(hub = 'all') {
                axios.get(`{{ url('/') }}/admin/dashboard/dataset`, { params: { hub } })
                    .then(response => {
                        const data = response.data;

                        // Update the cards with data
                        document.getElementById('dashboardCards').innerHTML = `
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fa fa-car fa-2x icon"></i>
                                    <h5 class="card-title">Available Cars</h5>
                                    <h2 class="card-text">${data.available_cars}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fa fa-calendar-check fa-2x icon"></i>
                                    <h5 class="card-title">Booked Cars</h5>
                                    <h2 class="card-text">${data.booked_cars}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fa fa-ban fa-2x icon"></i>
                                    <h5 class="card-title">Blocked Cars</h5>
                                    <h2 class="card-text">${data.blocked_cars}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fa fa-users fa-2x icon"></i>
                                    <h5 class="card-title">Total Users</h5>
                                    <h2 class="card-text">${data.total_users}</h2>
                                </div>
                            </div>
                        </div>
                    `;

                        // Update the bar chart data
                        const barChartData = {
                            labels: data.hubs_list,
                            datasets: [{
                                label: 'Available Cars',
                                data: data.hubs_available,
                            }, {
                                label: 'Booked Cars',
                                data: data.hubs_booked,
                            }, {
                                label: 'Blocked Cars',
                                data: data.hubs_blocked,
                            }]
                        };

                        // Destroy the existing bar chart if it exists
                        if (barChartInstance) {
                            barChartInstance.destroy();
                        }

                        // Create a new bar chart
                        const barChartCanvas = document.getElementById('barChart').getContext('2d');
                        barChartInstance = new Chart(barChartCanvas, {
                            type: 'bar',
                            data: barChartData,
                            options: { scales: { y: { beginAtZero: true } } }
                        });

                        // Update the pie chart data
                        const pieChartData = {
                            labels: data.hubs_list,
                            datasets: [{
                                label: 'Bookings',
                                data: data.hubs_available_list,
                            }]
                        };

                        // Destroy the existing pie chart if it exists
                        if (pieChartInstance) {
                            pieChartInstance.destroy();
                        }

                        // Create a new pie chart
                        const pieChartCanvas = document.getElementById('pieChart').getContext('2d');
                        pieChartInstance = new Chart(pieChartCanvas, {
                            type: 'pie',
                            data: pieChartData
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching dashboard data:", error);
                    });
            }

            // Initial data load
            loadDashboardData();

            // Reload dashboard data on filter change
            hubFilter.addEventListener('change', function() {
                loadDashboardData(hubFilter.value);
            });

            // Trigger search button click to reload data
            document.getElementById('searchBtn').addEventListener('click', function() {
                loadDashboardData(hubFilter.value);
            });
        });
    </script>

@endsection
