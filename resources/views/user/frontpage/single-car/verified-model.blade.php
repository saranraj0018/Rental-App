<div class="modal left fade custom-modal m-0 overflow-hidden" id="mobileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog position-top-right">
        <div class="modal-content bdr-20">
            <div class="modal-body h-600px p-0">
                <div class="input-set fade-element show">
                    <div class="other-heads-bg p-4 bdr-top-15">
                        <div>
                            <button type="button" class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white mb-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-angle-left text-white fs-18"></i>
                            </button>
                        </div>
                        <div>
                            <h4 class="modal-title text-white my-2 lh-sm">Sign In To Your Account</h4>
                            <p class="fs-12 text-white">Sign In To Your Account</p>
                        </div>
                    </div>
                    <div class="py-3 px-2 px-lg-5">
                        <form id="user-otp">
                            <div class="mb-3">
                                <label for="mobileNumber" class="form-label fs-12 fw-500">Enter your Mobile Number</label>
                                <input type="number" class="form-control bg-grey form-bdr" id="mobile_number" name="mobile_number" placeholder="9329*****1">
                                <div class="invalid-feedback">
                                    Please enter the Mobile Number.
                                </div>
                            </div>
                            <button type="submit" class="btn my-button next-button w-100" id="sendOtpBtn">Request OTP</button>
                        </form>
                        <div class="fs-10 text-secondary text-center mt-3">Don't have an account?
                            <span class="text-dark fw-500 register-link">Register</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--Opt Verification--}}
<div class="modal left fade custom-modal m-0 overflow-hidden" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog position-top-right">
        <div class="modal-content bdr-20">
            <div class="modal-body h-600px p-0">
                <div class="input-set fade-element show">
                    <div class="other-heads-bg p-4 bdr-top-15">
                        <div>
                            <button type="button" class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white mb-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-angle-left text-white fs-18"></i>
                            </button>
                        </div>
                        <div>
                            <h4 class="modal-title text-white my-2 lh-sm">OTP Verification</h4>
                        </div>
                    </div>
                    <div class="py-3 px-2 px-lg-5">
                        <form id="verification_otp">
                            <div class="mb-3">
                                <p class="form-label fs-12 fw-500 text-secondary text-center">Enter the OTP sent to <span class="text-dark fw-500" id="userPhone">+91 - 8554569487</span></p>
                                    <input type="number" class="form-control bg-grey form-bdr" id="verification_code" name="verification_code" placeholder="4568">
                                    <div class="invalid-feedback">
                                        Please enter the Verification Code.
                                    </div>
                                <span class="text-dark fw-500 text-danger" id="otp_error"></span>
                            </div>
                            <button type="submit" class="btn my-button next-button w-100">Verify Code</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--Register model--}}
<div class="modal left fade custom-modal m-0 overflow-hidden" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog position-top-right">
        <div class="modal-content bdr-20">
            <div class="modal-body h-600px p-0">
                <div class="input-set fade-element show">
                    <div class="other-heads-bg p-4 bdr-top-15">
                        <div>
                            <button type="button" class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white mb-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-angle-left text-white fs-18"></i>
                            </button>
                        </div>
                        <div>
                            <h4 class="modal-title text-white my-2 lh-sm">Create Your Account</h4>
                            <p class="fs-12 text-white">Register a new account</p>
                        </div>
                    </div>
                    <form id="user_registration">
                        <div class="py-3 px-2 px-lg-5">
                            <div class="mb-2">
                                <label for="user_name" class="form-label fs-12 fw-500">Your Name</label>
                                <input type="text" class="form-control bg-grey form-bdr" id="user_name" name="user_name" placeholder="Enter your name">
                                <div class="invalid-feedback">
                                    Please enter the User Name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="mobile_number" class="form-label fs-12 fw-500">Enter Your Mobile Number</label>
                                <input type="text" class="form-control bg-grey form-bdr" id="reg_mobile_number" name="mobile_number" placeholder="+91">
                                <div class="invalid-feedback">
                                    Please enter the Mobile Number.
                                </div>
                            </div>
                            <button type="submit" class="btn my-button next-button w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

