$(function () {
    'use strict'
    $(document).ready(function() {
        // Edit Pickup/delivery
        $('#booking_table').on('click', '.booking_edit', function() {
            let modal = $('#booking_model');
            modal.find('#event_name').val($(this).data('event_name'));
            modal.find('#event_date').val($(this).data('event_date'));
            modal.find('#description').val($(this).data('description'));
            modal.find('input[name=holiday_id]').val($(this).data('id'));
            modal.modal('show');
        });

        // function updateHolidayTable(data) {
        //     let tbody = $('#holiday_table tbody');
        //     tbody.empty(); // Clear existing rows
        //
        //     if (data.holiday.length === 0) {
        //         tbody.append(`<tr><td colspan="10" class="text-center">Record Not Found</td></tr>`);
        //     } else {
        //         // Loop through the data and append rows
        //         $.each(data.holiday, function(index, item) {
        //             tbody.append(`
        //         <tr>
        //             <td>${item.id}</td>
        //             <td>${item.event_name}</td>
        //             <td>${formatDate(item.event_date)}</td>
        //            <td>${item.user ? item.user.email : ''}</td>
        //             <td>${formatDateTime(item.updated_at)}</td>
        //             <td>
        //                 <a href="javascript:void(0)" class="holiday_edit" data-id="${item.id}"
        //                     data-event_name="${item.event_name}" data-description="${item.notes}"
        //                     data-event_date="${formatDate(item.event_date)}" >
        //                     <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        //                         <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
        //                     </svg>
        //                 </a>
        //                 <a href="#" class="holiday_delete text-danger w-4 h-4 mr-1" data-id="${item.id}">
        //                     <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        //                         <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        //                     </svg>
        //                 </a>
        //             </td>
        //         </tr>
        //     `);
        //         });
        //     }
        // }

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
            let holiday_search = $('#holiday_search').val();
            $.ajax({
                url: '/admin/holiday/search', // Define this route in your web.php
                type: 'GET',
                data: {
                    holiday_search: holiday_search
                },
                success: function(response) {
                    updateHolidayTable(response.data) // Populate table with new data
                },
                error: function(xhr) {
                    alertify.error('Something Went Wrong');
                }
            });
        }

        $('#holiday_search').on('keyup', fetchData);
    });
});
