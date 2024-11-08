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

        $('#user_table').on('click', '.user_view', function() {
            // Show the modal
            $('#document_model').modal('show');

            // Base path for images in storage
            let assetBasePath = "/storage/user-documents";

            // Get image names from data attributes
            let image1 = $(this).data('image1');
            let image2 = $(this).data('image2');

            // Construct full URLs for images
            let imageUrl1 = image1 ? `${assetBasePath}/${image1}` : null;
            let imageUrl2 = image2 ? `${assetBasePath}/${image2}` : null;

            // Update Image 1 or show "No Image" text
            if (imageUrl1) {
                $('#car_image_preview1').attr('src', imageUrl1).show();
                $('#no_image_text1').hide();
            } else {
                $('#car_image_preview1').hide();
                $('#no_image_text1').show();
            }

            // Update Image 2 or show "No Image" text
            if (imageUrl2) {
                $('#car_image_preview2').attr('src', imageUrl2).show();
                $('#no_image_text2').hide();
            } else {
                $('#car_image_preview2').hide();
                $('#no_image_text2').show();
            }
        });



    });
});
