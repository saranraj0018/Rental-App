$(function () {
    'use strict'
    $(document).ready(function() {

        function updateHolidayTable(data) {
            let tbody = $('#user_table tbody');
            tbody.empty(); // Clear existing rows

            if (data.user.length === 0) {
                tbody.append(`<tr><td colspan="10" class="text-center">Record Not Found</td></tr>`);
            } else {
                // Loop through the data and append rows
                $.each(data.user, function(index, item) {
                    tbody.append(`
                <tr>
                    <td>${item.id}</td>
                    <td>${item.name}</td>
                    <td>${item.mobile}</td>
                   <td>${item.email ? item.email : ''}</td>
                   <td>${item.aadhaar_number ? item.aadhaar_number : ''}</td>
                   <td>${item.driving_licence ? item.driving_licence : ''}</td>
                    <td>${formatDateTime(item.updated_at)}</td>

                </tr>
            `);
                });
            }
        }

// Helper function to format dates
        function formatDateTime(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }
        function formatDate(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString();
        }

        function fetchData() {
            let name_search = $('#name_search').val();
            $.ajax({
                url: '/admin/user/search', // Define this route in your web.php
                type: 'GET',
                data: {
                    name_search: name_search
                },
                success: function(response) {
                    updateHolidayTable(response.data) // Populate table with new data
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        $('#name_search').on('keyup', fetchData);
    });
});
