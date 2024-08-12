$(function () {
    'use strict'


    $(document).ready(function() {

        // Check if any selectpicker element has the is-invalid class
        $('select.form-select, select.form-control').each(function() {
            if ($(this).hasClass('is-invalid')) {
                $(this).closest('.bootstrap-select').addClass('is-invalid');
            }
        });


        // Add Cars
        $('#add_car').click(function() {
            $('select').selectpicker();
            $('#car_form').trigger("reset");
            $('#car_label').text("Add New Car");
            $('#create_car').modal('show');
        });

        // Add Car Models
        $('#add_car_model').click(function() {
            $('select').selectpicker();
            $('#car_model_form').trigger("reset");
            $('#car_modal_label').text("Add New Car");
            $('#create_car_modal').modal('show');
        });

        // Store category
        $('#car_form').on('submit', function(e) {
            e.preventDefault();

            let isValid = true;
            let service_city = $('#service_city');
            let service_city_wrapper = service_city.closest('.bootstrap-select');
            if (service_city.val() === null) {
                service_city_wrapper.addClass('is-invalid');
                isValid = false;
            } else {
                service_city.removeClass('is-invalid');
            }

            // Validate Hub
            let hub_city = $('#hub_city');
            let hub_wrapper = hub_city.closest('.bootstrap-select');
            if (hub_city.val() === null || hub_city.val() === "Hub") {
                hub_wrapper.addClass('is-invalid');
                isValid = false;
            } else {
                hub_wrapper.removeClass('is-invalid');
            }

            // Validate Car Model
            let car_model = $('#car_model');
            let car_model_wrapper = car_model.closest('.bootstrap-select');
            if (car_model.val() === null || car_model.val() === "Model") {
                car_model_wrapper.addClass('is-invalid');
                isValid = false;
            } else {
                car_model_wrapper.removeClass('is-invalid');
            }

            // Validate Registration Number
            let register_number = $('#register_number');
            if (register_number.val().trim() === '') {
                register_number.addClass('is-invalid');
                isValid = false;
            } else {
                register_number.removeClass('is-invalid');
            }

          //  Validate Current KM Reading
            let current_km = $('#current_km');
            if (current_km.val().trim() === '') {
                current_km.addClass('is-invalid');
                isValid = false;
            } else {
                current_km.removeClass('is-invalid');
            }


            if (isValid) {
              //  $('#submit_btn').prop('disabled', true);  // Disable submit button during AJAX

                $.ajax({
                    url: '/admin/car/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {

                        let successAlert = $('#successAlert');
                        successAlert.show();

                        // Automatically close the alert after 3 seconds

                        // setTimeout(function() {
                        //     successAlert.fadeOut(500, function() {
                        //         successAlert.hide(); // Ensure the alert is hidden after fading out
                        //        // $('#create_car').modal('hide');
                        //     });
                        // }, 3000); // 3 seconds
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $('.form-control').removeClass('is-invalid');
                        $('.invalid-feedback').empty();
                        $.each(errors, function(key, value) {
                            let element = $('#' + key);
                            if (element.is('select')) {
                                let selectPicker = element.closest('.bootstrap-select');

                                // Add the 'is-invalid' class to the Bootstrap Select container
                                selectPicker.addClass('is-invalid');

                                // Update the invalid feedback message
                                selectPicker.next('.invalid-feedback').text(value[0]).show();
                            } else {
                                // For other form controls
                                element.addClass('is-invalid');
                            }
                            // Display the error message
                            element.siblings('.invalid-feedback').text(value[0]);
                        });
                    },
                    complete: function() {
                        $('#submitBtn').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }
        });

        // Edit category
        $('.btnEdit').click(function() {
            let id = $(this).data('id');
            $.get(`/categories/${id}/edit`, function(data) {
                $('#categoryModalLabel').text("Edit Category");
                $('#categoryId').val(data.id);
                $('#name').val(data.name);
                $('#categoryModal').modal('show');
            });
        });

        // Delete category
        $('.btnDelete').click(function() {
            if (confirm("Are you sure?")) {
                let id = $(this).data('id');
                $.ajax({
                    url: `/categories/${id}`,
                    type: 'DELETE',
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                        alert('Error');
                    }
                });
            }
        });
    });
});
