$(function () {
    'use strict';

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

    function handleAjaxErrors(xhr, fieldId) {
        const field = $(fieldId);
        field.removeClass('is-invalid');
        $('.invalid-feedback').hide();

        if (xhr.status === 422) {
            const response = xhr.responseJSON;
            field.addClass('is-invalid');
            field.siblings('.invalid-feedback').text(response.message).show();
        }
    }

    $('#login_payment').on('click', function() {
        let text = $(this).text();
       if (text === 'Login To Proceed Payment'){
           $('#mobileModal').modal('show');
       }
    });

    $('#login_user').on('click', function() {
        $('#mobileModal').modal('show');
    });

    $('#register_user').on('click', function() {
        $('#registerModal').modal('show');
    });
    // Send OTP form
    $('#user-otp').on('submit', function(e) {
        e.preventDefault();
        if (validateField({ id: '#mobile_number', condition: (val) => val === '' })) {
            $.ajax({
                url: '/user/send-otp', // Update with your route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#mobileModal').modal('hide');
                        $('#otpModal').modal('show');
                        $('#userPhone').text(response.phone);
                    } else {
                        alert(response.message); // You may replace this with a modal if preferred
                    }
                },
                error: function(xhr) {
                    handleAjaxErrors(xhr, '#mobile_number');
                }
            });
        }
    });

    // Verify OTP form
    $('#verification_otp').on('submit', function(e) {
        e.preventDefault();
        if (validateField({ id: '#verification_code', condition: (val) => val === '' })) {
            $.ajax({
                url: '/user/verify-otp', // Update with your route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#otpModal').modal('hide');
                        console.log(typeof response.documents)
                        if (response.documents === 0){
                            $('#user_document').modal('show');
                        }
                        $('#login_payment')
                            .attr('id', 'payment') // Change id to 'payment'
                            .text('Proceed Payment');
                        $('#otp_error').text('');
                    } else {
                        $('#otp_error').text('Invalid OTP');
                    }
                },
                error: function(xhr) {
                    handleAjaxErrors(xhr, '#verification_code');
                }
            });
        }
    });

    // Back button functionality
    $('.back-button').click(function() {
        const prevModal = $(this).data('prev');
        if (prevModal === 1) {
            $('#otpModal').modal('hide');
            $('#mobileModal').modal('show');
        } else if (prevModal === 2) {
            $('#registerModal').modal('hide');
            $('#otpModal').modal('show');
        }
    });

    // Show registration form
    $('.register-link').click(function() {
        $('#mobileModal').modal('hide');
        $('#registerModal').modal('show');
        // $('#user_document').modal('show');
    });

    // User Registration form
    $('#user_registration').on('submit', function(e) {
        e.preventDefault();
        const fields = [
            { id: '#user_name', condition: (val) => val === '' },
            { id: '#reg_mobile_number', condition: (val) => val === '' }
        ];

        let isValid = true;
        fields.forEach(field => {
            if (!validateField(field)) isValid = false;
        });

        if (isValid) {
            $.ajax({
                url: '/user/register', // Update with your route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#registerModal').modal('hide');
                        $('#mobileModal').modal('show');
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error during registration'); // Replace alert if needed
                }
            });
        }
    });

    // To store selected files
    let selectedFiles = [];

    // Handle file input change
    $('#documents').on('change', function (event) {
        let files = event.target.files;

        // Clear the selectedFiles array first
        selectedFiles = [];

        // Add files to the selectedFiles array
        $.each(files, function (i, file) {
            selectedFiles.push(file);
        });

        // Display files
        displayFileList();
    });

    function displayFileList() {
        let $fileList = $('#fileList');
        let $beforeUpload = $('#beforeUpload');
        $fileList.empty(); // Clear current file list

        $.each(selectedFiles, function (index, file) {
            // Create a file item div
            let $fileItem = $('<div>', { 'class': 'file-item' });

            // File name span
            let $fileName = $('<span>').text(file.name);

            // Delete button
            let $deleteButton = $('<button>', { 'class': 'btn' }).html('<i class="fa-solid fa-trash" style="color:red;"></i>');

            // Delete button click event
            $deleteButton.on('click', function () {
                removeFile(index);
            });

            // Append file name and delete button to file item
            $fileItem.append($fileName).append($deleteButton);

            // Append file item to file list
            $fileList.append($fileItem);
        });

        // Show or hide the before-upload section
        $beforeUpload.css('display', selectedFiles.length === 0 ? 'flex' : 'none');
    }


    // Function to remove a file from the selectedFiles array
    function removeFile(index) {
        selectedFiles.splice(index, 1);
        displayFileList(); // Refresh the displayed file list
    }

    // User Registration form
    $('#user_documentation').on('submit', function(e) {
        e.preventDefault();
        const fields = [
            { id: '#aadhaar_number', condition: (val) => val === '' },
            { id: '#driving_licence', condition: (val) => val === '' },
            { id: '#documents', condition: (val) => val === '' },
        ];

        let isValid = true;
        fields.forEach(field => {
            if (!validateField(field)) isValid = false;
        });

        if (isValid) {
            let formData = new FormData(this);
            $.ajax({
                url: '/user/documentation', // Update with your route
                method: 'POST',
                data: formData,
                processData: false, // Required for jQuery to send the data properly
                contentType: false, // Required to handle file uploads correctly
                success: function(response) {
                    if (response.success) {
                        $('#user_document').modal('hide');
                    } else {
                        alert(response.message);
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
