$(function () {
    'use strict';

    $(document).on('click', '#download-btn', function () {
        let filename = $(this).data('filename');

        // Make an AJAX request to check if the file exists on the server
        $.ajax({
            url: '/user/download/' + filename,
            method: 'GET',
            xhrFields: {
                responseType: 'blob' // Important for downloading the file
            },
            success: function (data, status, xhr) {
                // Create a temporary download link
                let link = document.createElement('a');
                let url = window.URL.createObjectURL(data);
                link.href = url;

                // Get the file name from Content-Disposition header (if available)
                let contentDisposition = xhr.getResponseHeader('Content-Disposition');
                let fileName = filename;

                if (contentDisposition) {
                    var matches = /"([^"]*)"/.exec(contentDisposition);
                    if (matches !== null && matches[1]) fileName = matches[1];
                }

                // Set the filename
                link.download = fileName;
                document.body.appendChild(link);
                link.click();

                // Remove the temporary link
                window.URL.revokeObjectURL(url);
                document.body.removeChild(link);
            },
            error: function (xhr, status, error) {
                alert('File download failed.');
            }
        });
    });

    function validateField(field) {
        const element = $(field.id);
        const value = element.val();
        if (field.condition(value)) {
            element.addClass('is-invalid');
            return false;
        } else {
            element.removeClass('is-invalid');
            return true;
        }
    }

    $('#user_profile').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        const fields = [
            { id: '#user_name', condition: (val) => val === '' },
            { id: '#user_mobile', condition: (val) => val === '' },
            { id: '#aadhaar_number', condition: (val) => val === '' },
            { id: '#driving_licence', condition: (val) => val === '' },
        ];
        fields.forEach(field => {
            if (!validateField(field)) isValid = false;
        });

        if (isValid) {
            let formData = new FormData(this);
            $.ajax({
                url: '/user/document/update', // Update with your route
                method: 'POST',
                data: formData,
                processData: false, // Required for jQuery to send the data properly
                contentType: false, // Required to handle file uploads correctly
                success: function(response) {
                    if (response.success()){
                        window.location.reload();
                    }
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        let errors = response.responseJSON.errors;
                        $('.form-control').removeClass('is-invalid');
                        $('.invalid-feedback').empty();
                        $.each(errors, function (key, value) {
                            let element = $('#' + key);
                            // For other form controls
                            element.addClass('is-invalid');
                            // Display the error message
                            element.siblings('.invalid-feedback').text(value[0]);
                        });
                    }
                },
            });
        }
    });

});
