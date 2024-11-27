<div class="modal fade" id="edit_block" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="car_block_label">Edit Maintenance Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="car_edit_block_form">
                    <div class="form-row w-25">
                        <label for="register_number">Car Registration Number</label>
                        <input type="text" class="form-control" id="register_number" disabled>
                    </div>

                    <div class="form-row mt-2">
                        <div class="form-group col-md-4">
                            <label for="start_date_time">Start Date & Time</label>
                            <div class="input-group date" id="start_date_time" data-target-input="nearest">
                                <label for="edit_start_date"></label><input type="text"
                                    class="form-control datetimepicker-input" data-target="#start_date_time"
                                    id="edit_start_date" name="edit_start_date" placeholder="Select date and time" />
                                <div class="input-group-append" data-target="#start_date_time"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the start date.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="end_date">End Date and Time</label>
                            <div class="input-group date" id="end_date_time" data-target-input="nearest">
                                <label for="edit_end_date"></label><input type="text"
                                    class="form-control datetimepicker-input" data-target="#end_date_time"
                                    id="edit_end_date" name="edit_end_date" placeholder="Select end date and time" />
                                <div class="input-group-append" data-target="#end_date_time"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the end date.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row w-75">
                        <label for="edit_comment">Comments</label>
                        <input type="text" class="form-control" id="edit_comment" name="edit_comment"
                            placeholder="Comments">
                        <div class="invalid-feedback">
                            Please enter the comments.
                        </div>
                    </div>
                    <input type="hidden" id="block_id" name="block_id">
                    <div class="form-row mt-3">
                        <div class="form-group col-md-6">
                            <button type="submit" id="update_block" class="btn btn-primary mb-2">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .bootstrap-datetimepicker-widget.dropdown-menu {
        z-index: 1050 !important;
        /* Adjust as necessary */
    }
</style>
