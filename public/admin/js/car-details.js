$(function () {
    'use strict'


    $(document).ready(function() {
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
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();

            let isValid = true;

            // Name validation
            let service_city = $('#service_city');
            if (service_city.val().trim() === '') {
                service_city.addClass('is-invalid');
                isValid = false;
            } else {
                service_city.removeClass('is-invalid');
            }

            if (isValid) {
                $('#submitBtn').prop('disabled', true);  // Disable submit button
                this.submit();
            }

            let id = $('#categoryId').val();
            let url = id ? `/categories/${id}` : '/categories';
            let type = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: type,
                data: $(this).serialize(),
                success: function(response) {
                    $('#categoryModal').modal('hide');
                    location.reload();
                },
                error: function(response) {
                    alert('Error');
                }
            });
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
