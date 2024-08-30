<style>
    .toggle.btn.btn-success {
        border-radius: 30px;
    }
    .toggle.btn.btn-default.off {
         border-radius: 30px;
     }

</style>
<div class="modal fade" id="coupon_model" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coupon_label">Create Coupon</h5>
                <div class="form-check form-switch">
                    <label class="form-check-label" for="toggleSwitch">Toggle Switch</label>
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="coupon_form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                            <div class="invalid-feedback">
                                Please enter the Title.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            <div class="invalid-feedback">
                                Please enter the Description.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="number" placeholder="amount">
                            <div class="invalid-feedback">
                                Please enter the Amount.
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="type">Type</label>
                            <select id="type" class="form-control">
                                <option selected value="1">Percentage</option>
                                <option value="2">Fixed</option>
                            </select>
                            <div class="invalid-feedback">
                                Please enter the Amount Type.
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="prefix">Prefix</label>
                            <input type="text" class="form-control" id="prefix" name="prefix" placeholder="{ amount } for new users">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="coupon_code">Coupon Code</label>
                            <div class="input-group">
                                <input id="coupon_code" type="text" name="coupon_code" class="form-control" placeholder="Valam#1234" />
                                <button class="btn btn-dark" data-clipboard-target="#kt_clipboard_1">Copy</button>
                                <div class="invalid-feedback">
                                    Please enter the Coupon Code.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="coupon_start_date">Start Date & Time</label>
                            <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker" id="coupon_start_date" name="coupon_start_date" placeholder="Start date and time" />
                                <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the start date.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="coupon_end_date">End Date and Time</label>
                            <div class="input-group date" id="enddatetimepicker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#enddatetimepicker" id="coupon_end_date" name="coupon_end_date" placeholder="End date and time" />
                                <div class="input-group-append" data-target="#enddatetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the end date.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-3 float-right">
                        <button type="submit" id="save_coupon" class="btn btn-primary mb-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
