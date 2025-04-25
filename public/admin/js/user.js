$(function () {
    "use strict";
    $(document).ready(function () {
        function updateHolidayTable(data) {
            let tbody = $("#user_table tbody");
            tbody.empty(); // Clear existing rows

            if (data.user.length === 0) {
                tbody.append(
                    `<tr><td colspan="10" class="text-center">Record Not Found</td></tr>`
                );
            } else {
                // Loop through the data and append rows
                $.each(data.user, function (index, item) {
                    tbody.append(`
                <tr>
                    <td>${item.id}</td>
                    <td>
                        <span class="bg-${ item.is_offline_booking == 0 ? 'success' : 'warning' } text-white p-1 rounded">
                            ${ item.is_offline_booking == 0 ? 'Online' : 'Offline' }
                        </span>
                    </td>
                    <td>${item.name}</td>
                    <td>${item.mobile}</td>
                   <td>${item.email ? item.email : ""}</td>
                   <td>${item.aadhaar_number ? item.aadhaar_number : ""}</td>
                   <td>${item.driving_licence ? item.driving_licence : ""}</td>
                    <td>${formatDateTime(item.updated_at)}</td>

                </tr>
            `);
                });
            }
        }

        // Helper function to format dates
        function formatDateTime(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString() + " " + date.toLocaleTimeString();
        }
        function formatDate(dateString) {
            let date = new Date(dateString);
            return date.toLocaleDateString();
        }

        function fetchData() {
            let name_search = $("#name_search").val();
            let user_type = $("#user_type").val();
            
            $.ajax({
                url: "/admin/user/search", // Define this route in your web.php
                type: "GET",
                data: {
                    name_search: name_search,
                    user_type
                },
                success: function (response) {
                    updateHolidayTable(response.data); // Populate table with new data
                },
                error: function (xhr) {
                    alertify.error("Something Went Wrong");
                },
            });
        }

        $("#name_search").on("keyup", fetchData);
        $("#user_type").on("change", fetchData);

        $("#user_table").on("click", ".user_view", function () {
            // Show the modal
            $("#document_model").modal("show");

            // Base path for images in storage
            let assetBasePath = "/storage/user-documents";

            // Get images array from data-images attribute
            let images = $(this).data("images");
            let documents = $(this).data("documents");

            // Clear any existing images in the modal
            $("#image_gallery").empty();
            $("#documents").empty();

            if (images && images.length > 0) {
                images.forEach((imageName, index) => {
                    if (imageName) {
                        let imageUrl = `${assetBasePath}/${imageName}`;
                        $("#image_gallery").append(`
                    <a href="${imageUrl}" target="_blank" class="mb-3 text-center d-flex" style="flex-direction: column;">
                        <label class="form-label">Document ${index + 1}</label>
                        <img src="${imageUrl}" alt="Document Image" class="img-fluid border rounded" style="height: 300px; width: 300px; object-fit: cover;" />
                    </a>
                `);
                    }
                });
            } else {
                $("#image_gallery").append(`
            <div class="col-12 text-center">
                <p class="text-muted">No images available</p>
            </div>
        `);
            }

            if (documents && documents.length) {
                documents?.map((document) => {
                    if (document?.title) {
                        $("#documents").append(`
                            <div>
                            <h6 class="text-bold mb-0">${document.title}</h6>
                            <p class="">${document.value}</p>
                            </div>
                            `);
                    }
                });
            } else {
                $("#documents").append(`
                    <div class="col-12 text-center">
                        <p class="text-muted">No Data available</p>
                    </div>
                `);
            }
        });
    });
});
