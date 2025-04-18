<div x-data="{
    timer: 60,
    otpResend: false,
    mobileNumber: '',

    resendOTP() {
        this.otpResend = true;
        this.timer = 60;
        let interval = setInterval(() => {
            this.timer--;
            if (this.timer === 0) {
                clearInterval(interval);
                this.otpResend = false;
            }
        }, 1000);
    },


    init() {
        Alpine.nextTick(() => {
            const googleRegisterData = @js(session()->exists('google_register_data') ? session()->get('google_register_data') : null);
            googleRedirectAction(googleRegisterData)
        })
    }

}">
    <div class="modal left fade custom-modal m-0 overflow-hidden" id="mobileModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog position-top-right">
            <div class="modal-content bdr-20">
                <div class="modal-body h-600px p-0">
                    <div class="input-set fade-element show">
                        <div class="other-heads-bg p-4 bdr-top-15">
                            <div>
                                <button type="button"
                                    class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white mb-2"
                                    data-bs-dismiss="modal" aria-label="Close">
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
                                    <label for="mobileNumber" class="form-label fs-12 fw-500">Enter your Mobile
                                        Number</label>
                                    <input type="number" x-model="mobileNumber" class="form-control bg-grey form-bdr"
                                        id="mobile_number" name="mobile_number" placeholder="">
                                    <div class="invalid-feedback">
                                        Please enter the Mobile Number.
                                    </div>
                                </div>
                                <button type="submit" class="btn my-button next-button w-100" id="sendOtpBtn">Request
                                    OTP</button>
                            </form>
                            <div class="fs-10 text-secondary text-center mt-3">Don't have an account?
                                <span class="text-dark fw-500 register-link">Register</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Opt Verification --}}
    <div class="modal left fade custom-modal m-0 overflow-hidden" id="otpModal" tabindex="-1"
        aria-labelledby="otpModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog position-top-right">
            <div class="modal-content bdr-20">
                <div class="modal-body h-600px p-0">
                    <div class="input-set fade-element show">
                        <div class="other-heads-bg p-4 bdr-top-15">
                            <div>
                                <button type="button"
                                    class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white mb-2"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-angle-left text-white fs-18"></i>
                                </button>
                            </div>
                            <div>
                                <h4 class="modal-title text-white my-2 lh-sm">OTP Verification</h4>
                            </div>
                        </div>
                        <div class="py-3 px-2 px-lg-5">
                            <form id="verification_otp">
                                <input type="hidden" name="mobile_number2" id="mobile_number_otp2"
                                    :value="mobileNumber">
                                <div class="mb-3">


                                    <p x-show="!otpResend" class="form-label fs-12 fw-500 text-secondary text-center">
                                        Enter the OTP sent to
                                        <span class="text-dark fw-500" id="userPhone">+91 - 8554569487</span>
                                    </p>

                                    <p x-show="otpResend" class="form-label fs-12 fw-500 text-secondary text-center">OTP
                                        has been resent to
                                        <span class="text-dark fw-500" x-text="mobileNumber">+91 - 8554569487</span>,
                                        request for next OTP in <span x-text="timer"></span> seconds
                                    </p>

                                    <input type="number" class="form-control bg-grey form-bdr" id="verification_code"
                                        name="verification_code" placeholder="">
                                    <div class="invalid-feedback">
                                        Please enter the Verification Code.
                                    </div>
                                    <span class="text-dark fw-500 text-danger" id="otp_error"></span>
                                </div>
                                <button type="submit" class="btn my-button next-button w-100">Verify Code</button>
                                <button x-show="!otpResend" id="resend-otp" @click="resendOTP" type="button"
                                    style="color: rgb(9, 58, 163); background: transparent; border: none; outline: none; font-size: .9em; width: 100%; text-align: center; margin-top: 1em">
                                    Resend
                                    OTP</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Register model --}}
    <div class="modal left fade custom-modal m-0 overflow-hidden" id="registerModal" tabindex="-1"
        aria-labelledby="registerModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog position-top-right">
            <div class="modal-content bdr-20">
                <div class="modal-body h-600px p-0">
                    <div class="input-set fade-element show">
                        <div class="other-heads-bg p-4 bdr-top-15">
                            <div>
                                <button type="button"
                                    class="border-2 rounded-pill px-3 py-2 me-3 back-btn text-white mb-2"
                                    data-bs-dismiss="modal" aria-label="Close">
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
                                    <label for="user_name_" class="form-label fs-12 fw-500">Your Name</label>
                                    <input type="text" class="form-control bg-grey form-bdr" id="user_name_"
                                        name="user_name" placeholder="Enter your name">
                                    <div class="invalid-feedback">
                                        Please enter the User Name.
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="user_email" class="form-label fs-12 fw-500">Your Email</label>
                                    <input type="email" class="form-control bg-grey form-bdr" id="user_email"
                                        name="user_email" placeholder="Enter your Email">
                                    <div class="invalid-feedback">
                                        Please enter the User Email.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="reg_mobile_number" class="form-label fs-12 fw-500">Your Mobile
                                        Number</label>
                                    <input type="text" class="form-control bg-grey form-bdr"
                                        id="reg_mobile_number" name="reg_mobile_number" placeholder="+91">
                                    <div class="invalid-feedback">
                                        Please enter the Mobile Number.
                                    </div>
                                </div>
                              
                                <button type="submit" class="btn my-button next-button w-100">Register</button>

                                <div id="google_button">
                                    <a href="{{ url('auth/google') }}"  class="mt-5 btn btn-light border d-flex align-items-center justify-content-center" style="gap: 8px; padding: 10px; text-decoration: none;">
                                        <i class="fab fa-google"></i>
                                        <span>Sign in with Google</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


 

    {{-- User Document upload --}}

    <div class="modal fade" id="user_document" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center fs-4">
                        Upload Documents
                    </h2>
                    <div class="text-center mb-3 fs-13">
                        Upload your Aadhaar and Driving Licence by clicking the upload button to complete your identity
                        verification.
                    </div>
                    <form id="user_documentation" class="my-3">
                        <!-- File input -->
                        <div class="my-file-border p-3">
                            <div id="beforeUpload"
                                class="before-upload d-flex flex-column justify-content-center align-items-center">
                                <img src="{{ asset('user/img/image 23.png') }}" alt=""
                                    class="img-fluid w-25">
                                <h2 class="text-center fs-5">
                                    Drag and drop font files to upload
                                </h2>
                                <div class="text-center mb-3 fs-13">
                                    For maximum browser support, upload in PDF or JPG Format
                                </div>
                            </div>

                            <!-- File List -->
                            <div id="fileList" class="file-list">
                                <!-- Uploaded files will be displayed here -->
                            </div>
                            <input type="file" id="documents" name="documents[]"
                                class="form-control form-control-sm mt-3" multiple accept=".png, .jpg, .jpeg, .pdf">
                            <div class="invalid-feedback">
                                Please select the Aadhaar and Driving License Image.
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="aadhaar-number" class="form-label fs-13 fw-500">Aadhaar Number</label>
                            <input type="number" name="aadhaar_number" id="aadhaar_number"
                                class="form-control form-control-sm my-1" placeholder="Enter your Aadhaar Number">
                            <div class="invalid-feedback">
                                Please enter the Aadhaar Number.
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="driving_licence" class="form-label fs-13 fw-500">Driving License</label>
                            <input type="text" id="driving_licence" name="driving_licence"
                                class="form-control form-control-sm my-1" placeholder="Enter your Driving License">
                            <div class="invalid-feedback">
                                Please enter the Driving License.
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="login_alert" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Centering the modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Warning</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group d-grid">
                        <label for="cancel-reason" class="text-danger text-center" id="error_message"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="payment_alert" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Centering the modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Warning</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group d-grid">
                        <label for="cancel-reason" class="text-danger text-center">Payment Cannot Be Generate</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>


