<div class="modal fade" id="holiday_model" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="holiday_label">Create Holidays</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="holiday_form">
                    <div class="form-row">
                        <input type="hidden" name="holiday_id">
                        <div class="form-group col-md-6">
                            <label for="title">Event Name</label>
                            <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Event Name">
                            <div class="invalid-feedback">
                                Please enter the Event.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="event_date">Event Date</label>
                            <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker" id="event_date" name="event_date" placeholder="Event Date " />
                                <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the Event Date.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            <div class="invalid-feedback">
                                Please enter the Description.
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-3 float-right">
                        <button type="submit" id="save_holiday" class="btn btn-primary mb-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete_holiday" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm_delete">Delete</button>
            </div>
        </div>
    </div>
</div>