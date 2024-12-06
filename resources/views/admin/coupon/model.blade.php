<div class="modal fade" id="coupon_model" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coupon_label">Create Coupon</h5>
                <div class="d-flex m-left">
                    <div class="my-auto">
                        <label for="title">Active - Status</label>
                    </div>
                    <div class="toggle-wrapper mx-2" id="toggle-button">
                        <div class="label off">OFF</div>
                        <div class="toggle-switch"></div>
                        <div class="label on" style="display: none;">ON</div>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="coupon_form">
                    <div class="form-row">
                        <input type="hidden" name="status" id="toggle-value" value="2">
                        <input type="hidden" name="coupon_id">
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
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="amount">
                            <div class="invalid-feedback">
                                Please enter the Amount.
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="type">Type</label>
                            <select id="type" name="type" class="form-control">
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
                        <div class="form-group col-md-4">
                            <label for="coupon_code">Coupon Code</label>
                            <div class="input-group">
                                <input id="coupon_code" type="text" name="coupon_code" class="form-control" placeholder="Valam#1234" />
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="coupon_start_date">Start Date & Time</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="coupon_start_date" name="coupon_start_date" placeholder="Start date and time" />
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="coupon_end_date">End Date and Time</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="coupon_end_date" name="coupon_end_date" placeholder="End date and time" />
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div class="invalid-feedback">
                                    Please select the end date.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="order_booking">Booking Order</label>
                            <div class="input-group">
                                <input id="order_booking" type="text" name="order_booking" class="form-control" placeholder="5" />
                            </div>
                            <div class="invalid-feedback">
                                Please select valid booking order.
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
