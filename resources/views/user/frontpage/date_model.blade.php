<!-- First Modal Popup -->
<div class="modal fade" id="dateTimeModal1" tabindex="-1" aria-labelledby="dateTimeModalLabel1" aria-hidden="true">
    <div class="modal-dialog date-modal-width">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title text-white" id="dateTimeModalLabel1">Starting Date & Time</h5>
{{--                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>--}}
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-pills" id="dateTimeTab1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3 active" id="date-tab1" data-bs-toggle="tab"
                               href="#dateTabContent1" role="tab" aria-controls="dateTabContent1"
                               aria-selected="true">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3" id="time-tab1" data-bs-toggle="tab"
                               href="#timeTabContent1" role="tab" aria-controls="timeTabContent1"
                               aria-selected="false">
                                <i class="fas fa-clock"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active p-3" id="dateTabContent1" role="tabpanel"
                         aria-labelledby="date-tab1">
                        <div id="inlineDatePicker1"></div>
                    </div>
                    <div class="tab-pane fade p-3" id="timeTabContent1" role="tabpanel" aria-labelledby="time-tab1">
                        <div id="time-buttons" class="d-flex justify-content-between flex-wrap container">
                            <!-- Time Buttons for 24 hours with 30-minute intervals -->
                            <!-- You can keep the buttons here as in the original code -->
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="00:00">00:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="00:30">00:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="01:00">01:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="01:30">01:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="02:00">02:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="02:30">02:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="03:00">03:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="03:30">03:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="04:00">04:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="04:30">04:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="05:00">05:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="05:30">05:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="06:00">06:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="06:30">06:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="07:00">07:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="07:30">07:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="08:00">08:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="08:30">08:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="09:00">09:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="09:30">09:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="10:00">10:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="10:30">10:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="11:00">11:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="11:30">11:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="12:00">12:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="12:30">12:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="13:00">13:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="13:30">13:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="14:00">14:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="14:30">14:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="15:00">15:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="15:30">15:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="16:00">16:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="16:30">16:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="17:00">17:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="17:30">17:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="18:00">18:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="18:30">18:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="19:00">19:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="19:30">19:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="20:00">20:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="20:30">20:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="21:00">21:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="21:30">21:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="22:00">22:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="22:30">22:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="23:00">23:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="23:30">23:30</button>
                            <!-- Add more buttons as needed -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-blue text-white" id="submitDateTime1" data-bs-dismiss="modal" aria-label="Close">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Second Modal Popup -->
<div class="modal fade" id="dateTimeModal2" tabindex="-1" aria-labelledby="dateTimeModalLabel2" aria-hidden="true">
    <div class="modal-dialog date-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateTimeModalLabel2">Choose Date and Time (2)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-pills" id="dateTimeTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3 active" id="date-tab2" data-bs-toggle="tab"
                               href="#dateTabContent2" role="tab" aria-controls="dateTabContent2"
                               aria-selected="true">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-4 rounded-3" id="time-tab2" data-bs-toggle="tab"
                               href="#timeTabContent2" role="tab" aria-controls="timeTabContent2"
                               aria-selected="false">
                                <i class="fas fa-clock"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active p-3" id="dateTabContent2" role="tabpanel"
                         aria-labelledby="date-tab2">
                        <div id="inlineDatePicker2"></div>
                    </div>
                    <div class="tab-pane fade p-3" id="timeTabContent2" role="tabpanel" aria-labelledby="time-tab2">
                        <div id="time-buttons" class="d-flex justify-content-between flex-wrap container">
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="00:00">00:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="00:30">00:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="01:00">01:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="01:30">01:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="02:00">02:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="02:30">02:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="03:00">03:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="03:30">03:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="04:00">04:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="04:30">04:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="05:00">05:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="05:30">05:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="06:00">06:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="06:30">06:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="07:00">07:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="07:30">07:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="08:00">08:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="08:30">08:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="09:00">09:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="09:30">09:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="10:00">10:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="10:30">10:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="11:00">11:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="11:30">11:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="12:00">12:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="12:30">12:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="13:00">13:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="13:30">13:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="14:00">14:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="14:30">14:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="15:00">15:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="15:30">15:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="16:00">16:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="16:30">16:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="17:00">17:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="17:30">17:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="18:00">18:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="18:30">18:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="19:00">19:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="19:30">19:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="20:00">20:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="20:30">20:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="21:00">21:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="21:30">21:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="22:00">22:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="22:30">22:30</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="23:00">23:00</button>
                            <button class="btn btn-blue-border time-btn me-2 mb-2 p-1"
                                    data-time="23:30">23:30</button>
                            <!-- Add more buttons as needed -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-blue text-white" id="submitDateTime2" data-bs-dismiss="modal" aria-label="Close">Submit</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="minimum_days" id="minimum_days" value="{{ $timing_setting['total_minimum_hours'] ?? ''}}">
    <input type="hidden" name="maximum_days" id="maximum_days" value="{{ $timing_setting['total_maximum_hours'] ?? ''}} ">
    <input type="hidden" name="front_duration" id="front_duration" value="{{ $timing_setting['front_duration'] ?? ''}} ">
</div>


{{--Alert Pop date select --}}

<div class="modal fade" id="alert_booking" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Car Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="cancel-reason" class="text-danger">Please choose the your Booking Pick And Drop Date And Time</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>



