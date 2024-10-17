<tbody>
@if(!empty($booking))
    @foreach($booking as $item)
        @php
            $booking_details = !empty($item->car_details) ? json_decode($item->car_details) : [];
        @endphp
        <tr id="row-{{ $item->id }}">
            <td> @if($item->booking_type == 'pickup')
                    <h2>P</h2>
                @else
                    <h2>D</h2>
                @endif
            </td>

            <!-- Risk Checkbox -->
            <td>
                <input type="checkbox" class="risk-checkbox" data-id="{{ $item->id }}">
                <button class="btn btn-warning open-risk-modal" data-id="{{ $item->id }}">
                    Add Comment
                </button>
            </td>

            <!-- Done Checkbox -->
            <td>
                <input type="checkbox" class="done-checkbox" data-id="{{ $item->id }}">
            </td>

            <!-- Other Columns -->
            <td>{{ $item->user->name ?? '' }}</td>
            <td>{{ $booking_details->car_model->model_name ?? '' }}</td>
            <td>{{ $item->car->register_number }}</td>
            <td>{{ $item->start_date }}</td>
            <td>{{ $item->end_date }}</td>
            <td>{{ $item->total_price }}</td>

            <td>
                @if($item->status == 1)
                    <span class="badge badge-secondary" style="background-color: green">Booking</span>
                @else
                    <span class="badge badge-danger" style="background-color: red">Complete</span>
                @endif
            </td>

            <td>{{ $item->created_at }}</td>

            <td>
                <a href="javascript:void(0)" class="booking_edit">
                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                    </svg>
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="9">Record Not Found</td>
    </tr>
@endif
</tbody>


pop
<div class="modal fade" id="riskModal" tabindex="-1" role="dialog" aria-labelledby="riskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="riskModalLabel">Add Risk Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="risk-form">
                    <input type="hidden" id="risk-booking-id" name="booking_id">
                    <div class="form-group">
                        <label for="risk-comment">Comment</label>
                        <textarea class="form-control" id="risk-comment" name="comment" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


$(document).ready(function() {
// Handle Risk checkbox
$('.risk-checkbox').on('change', function() {
var rowId = $(this).data('id');
if ($(this).is(':checked')) {
$('#row-' + rowId).css('background-color', 'red');
} else {
$('#row-' + rowId).css('background-color', '');
}
});

// Handle Done checkbox
$('.done-checkbox').on('change', function() {
var rowId = $(this).data('id');
if ($(this).is(':checked')) {
$('#row-' + rowId).css('background-color', 'green');
} else {
$('#row-' + rowId).css('background-color', '');
}
});

// Open risk modal on button click
$('.open-risk-modal').on('click', function() {
var bookingId = $(this).data('id');
$('#risk-booking-id').val(bookingId);
$('#riskModal').modal('show');
});

// Handle risk comment form submission
$('#risk-form').on('submit', function(e) {
e.preventDefault();
var bookingId = $('#risk-booking-id').val();
var comment = $('#risk-comment').val();

// Here you would typically send an AJAX request to save the comment
$.ajax({
url: '/save-risk-comment', // Update with your actual save route
method: 'POST',
data: {
_token: "{{ csrf_token() }}",
booking_id: bookingId,
comment: comment
},
success: function(response) {
// Close the modal and reset the form
$('#riskModal').modal('hide');
$('#risk-form')[0].reset();
alert('Comment saved successfully!');
},
error: function(xhr, status, error) {
console.error(error);
alert('Error saving comment.');
}
});
});
});


Route::post('/save-risk-comment', [BookingController::class, 'saveRiskComment'])->name('save-risk-comment');


public function saveRiskComment(Request $request)
{
// Validate the request
$request->validate([
'booking_id' => 'required',
'comment' => 'required',
]);

// Save the comment to the database
// Assuming you have a `comments` table linked to bookings
$comment = new Comment();
$comment->booking_id = $request->booking_id;
$comment->comment = $request->comment;
$comment->save();

return response()->json(['success' => true]);
}

