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
                    updateHolidayTable(response.data, response.permissions) // Populate table with new data
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        $('#name_search').on('keyup', fetchData);

        $('#user_table').on('click', '.user_view', function () {
            // Show the modal
            $('#document_model').modal('show');

            // Base path for images in storage
            let assetBasePath = "/storage/user-documents";

            // Get images array from data-images attribute
            let images = $(this).data('images');

            // Clear any existing images in the modal
            $('#image_gallery').empty();

            if (images && images.length > 0) {
                images.forEach((imageName, index) => {
                    if (imageName) {
                        let imageUrl = `${assetBasePath}/${imageName}`;
                        $('#image_gallery').append(`
                    <div class="col-md-4 mb-3 text-center">
                        <label class="form-label">Document ${index + 1}</label>
                        <img src="${imageUrl}" alt="Document Image" class="img-fluid border rounded" style="max-height: 200px; object-fit: cover;">
                    </div>
                `);
                    }
                });
            } else {
                $('#image_gallery').append(`
            <div class="col-12 text-center">
                <p class="text-muted">No images available</p>
            </div>
        `);
            }
        });





    });
});
