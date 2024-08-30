$(function () {
    'use strict'
    $(document).ready(function() {
        loadDatePickers()
        function loadDatePickers() {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm', // Customize the format as needed
                icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check',
                    clear: 'fas fa-trash-alt',
                    close: 'fas fa-times'
                }
            });


            $('#enddatetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check',
                    clear: 'fas fa-trash-alt',
                    close: 'fas fa-times'
                }
            });
        }

        $('#add_coupon').click(function() {
            $('#coupon_label').text("Create Coupon");
            $('#coupon_model').modal('show');
            $('#save_coupon').text("Submit");
        });

        $('#coupon_form').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            // let fields = [
            //     { id: '#title', wrapper: true, condition: (val) => val === '' },
            //     { id: '#description', wrapper: true, condition: (val) => val === '' },
            //     { id: '#amount', wrapper: true, condition: (val) => val === '' },
            //     { id: '#coupon_code', wrapper: true, condition: (val) => val === '' },
            //     { id: '#coupon_start_date', wrapper: false, condition: (val) => val === '' },
            //     { id: '#coupon_end_date', wrapper: false, condition: (val) => val === '' },
            // ];
            //
            // fields.forEach(field => {
            //     let element = $(field.id);
            //     let value = element.val();
            //     if (field.condition(value)) {
            //         element.addClass('is-invalid');
            //         isValid = false;
            //     } else {
            //         element.removeClass('is-invalid');
            //     }
            // });

            if (isValid) {
                // $('#save_coupon').prop('disabled', true);  // Disable submit button during AJAX
                $.ajax({
                    url: '/admin/coupon/save',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#coupon_model').modal('hide');
                       // updateRoleTable(response.data,response.permission)
                        alertify.success(response.success);
                    },
                    error: function(response) {
                        if (response.responseJSON.errors) {
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
                    complete: function() {
                        $('#save_user_role').prop('disabled', false);  // Re-enable the submit button
                    }
                });
            }



        });
    });
});
