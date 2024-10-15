<div class="modal fade" id="booking_model" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="booking_label">Booking Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="card shadow border border-0 rounded-3 p-3">
                                <h5 class="fs-4">Car details</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">Car Modal</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="car_modal"></p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">Register Number</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="register_number"></p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">Address</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="address"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card shadow border border-0 rounded-3 p-3">
                                <h5 class="fs-4">Booking details</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">Start Date</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="start_date"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">End Date</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="end_date">End Date</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">Total Days</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="days"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="card shadow border border-0 rounded-3 p-3">
                                <h5 class="fs-4">User details</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="card border border-0 rounded-3 shadow p-3" style="background-color: #f5f5f5;">
                                            <p class="fs-6 fw-bold">Car Modal</p>
                                            <p class="fs-6" id="user_name">Swift</p>
                                            <p class="fs-6" id="user_mobile">Swift</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="card border border-0 rounded-3 shadow p-3" style="background-color: #f5f5f5;">
                                            <p class="fs-6 fw-bold">Car Modal</p>
                                            <p class="fs-6">Swift</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="card border border-0 rounded-3 shadow p-3" style="background-color: #f5f5f5;">
                                            <p class="fs-6 fw-bold">Car Modal</p>
                                            <p class="fs-6">Swift</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 g-3">
                        <div class="col-12 col-lg-6">
                            <div class="card shadow border border-0 rounded-3 p-3">
                                <h5 class="fs-4">Payment Details</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">Total Price</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="price"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6 fw-bold">Security Deposit</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="fs-6" id="security_deposit"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card shadow border border-0 rounded-3 p-3">
                                <h5 class="fs-4">Commend</h5>
                                <hr>
                                <textarea name="" id="" class="form-control"></textarea>
                            </div>
                            <div class="card mt-3 shadow border border-0 rounded-3 p-3">
                                <h5 class="fs-4">User details</h5>
                                <hr>
                                <select name="" id="" class="form-select border border-0" style="background-color: #FFFFFF;">
                                    <option value="3">Processing</option>
                                    <option value="2">Completed</option>
                                    <option value="1">Booking</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
