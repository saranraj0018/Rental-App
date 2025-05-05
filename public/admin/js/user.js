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
                    console.log(item);
                    tbody.append(`
                <tr>
                    <td>${item.id}</td>
                    <td>
                        <span class="bg-${ !item.is_offline_booking ? 'success' : 'warning' } text-white p-1 rounded">
                            ${ !item.is_offline_booking ? 'Online' : 'Offline' }
                        </span>
                    </td>
                    <td>
                        <span class="p-0">${item?.name} <button data-legacy-user-names="${btoa(item.updated_user_name)}" id="preview-legacy-names" data-target="#userNameModal" data-toggle="modal" style="background: transparent; border: none; outline: none;;"><i class="fa fa-eye text-primary"></i></button></span>
                    </td>
                    <td>${item.mobile}</td>
                   <td>${item.email ? item.email : ""}</td>
                   <td>${item.aadhaar_number ? item.aadhaar_number : ""}</td>
                   <td>${item.driving_licence ? item.driving_licence : ""}</td>
                    <td>${formatDateTime(item.updated_at)}</td>

                        <td>
                            <a href="#" class="user_view text-primary w-4 h-4 mr-1"
                                data-id="${ item.id }"
                                data-images="${ JSON.stringify(item?.user_doc?.map(doc => doc.image_name)) }"   data-documents="${ btoa(item?.documents) }">
                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M12 4.5c4.636 0 8.604 3.094 10.314 7.5-1.71 4.406-5.678 7.5-10.314 7.5S3.396 16.406 1.686 12C3.396 7.594 7.364 4.5 12 4.5zm0 2.25a5.25 5.25 0 100 10.5 5.25 5.25 0 000-10.5zM12 9a3 3 0 110 6 3 3 0 010-6z" />
                                </svg>
                            </a>
                            <button @click="() => {
                                comment = ${item.comments};
                                userId = ${item.id};
                            }" class="bg-primary rounded" data-toggle="modal" data-target="#commentModal" style="border: none; outline: none; background-color: transparent;">
                                <i class="fa fa-comment"></i>
                            </button>
                        </td>
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

        function fetchData(page = 1) {
            let name_search = $("#name_search").val();
            let user_type = $("#user_type").val();

            $.ajax({
                url: "/admin/user/search?page=" + page, // Define this route in your web.php
                type: "GET",
                data: {
                    name_search: name_search,
                    user_type
                },
                success: function (response) {
                    updateHolidayTable(response.data); // Populate table with new data
                    $("#pagination").html(response.data.pagination);
                },
                error: function (xhr) {
                    alertify.error("Something Went Wrong");
                },
            });
        }

        $(document).on("click", "#pagination a", function (e) {
            e.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
            fetchData(page);
        });

        $("#name_search").on("keyup", fetchData);
        $("#user_type").on("change", fetchData);

        $("#user_table").on("click", ".user_view", function () {

            // Show the modal
            $("#document_model").modal("show");

            // Base path for images in storage
            let assetBasePath = "/storage/user-documents";

            // Get images array from data-images attribute
            let images = $(this).data("images");
            const documents = atob($(this).data("documents"));
            // Clear any existing images in the modal
            $("#image_gallery").empty();
            $("#documents").empty();

            if (images && images.length > 0) {
                images?.forEach((imageName, index) => {
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

                JSON.parse(documents)?.map((document) => {
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


        $("#user_table").on("click", "#preview-legacy-names", function () {
            const names = JSON.parse(atob($(this).data("legacy-user-names")));
            $("#legacy_names_list").empty();
            if (names && names.length > 0) {
                names?.forEach((name) => {
                    if (name) {
                        $("#legacy_names_list").append(`
                            <div class="name-item" style="padding: 12px; margin-bottom: 10px; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;">
                                <h6 style="font-weight: 700; margin: 0; color: #333;">${name.user_name}</h6>
                                <small style="color: #777;">Updated: ${new Date(name.updated_at).toLocaleString()}</small>
                            </div>
                        `);
                    }
                });
            }
        });
    });
});
