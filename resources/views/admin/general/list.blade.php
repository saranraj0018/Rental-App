@extends('admin.layout.app')
@section('content')
    <style>
        svg.w-5.h-5 {
            height: 20px;
            width: 20px;
        }

        p.text-sm.text-gray-700.leading-5.dark\:text-gray-400 {
            margin: 30px 0;
            text-align: center;
        }

        a.relative.inline-flex.items-center.px-4.py-2.ml-3.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.rounded-md.hover\:text-gray-500.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-700.transition.ease-in-out.duration-150.dark\:bg-gray-800.dark\:border-gray-600.dark\:text-gray-300.dark\:focus\:border-blue-700.dark\:active\:bg-gray-700.dark\:active\:text-gray-300 {
            margin-left: 50px !important;
        }

        .toggle-wrapper {
            display: inline-block;
            width: 53px;
            height: 25px;
            background-color: #ccc;
            border-radius: 30px;
            position: relative;
            cursor: pointer;
            user-select: none;
        }

        .m-left {
            margin-left: 56%;
        }

        .toggle-switch {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background-color: #000000;
            border-radius: 50%;
            transition: 0.3s;
        }

        .toggle-wrapper.on .toggle-switch {
            left: 32px;
        }

        .toggle-wrapper .label {
            position: absolute;
            top: 5px;
            font-weight: bold;
            font-size: 12px;
        }

        .toggle-wrapper .label.off {
            top: 4px;
            left: 27px;
            color: black;
        }

        .toggle-wrapper .label.on {
            top: 4px;
            right: 27px;
            color: black;
        }
    </style>
    @php
        $data = !empty($general) && optional($general)->data_values ? json_decode($general->data_values, true) : [];
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $features = !empty($data['features']) ? json_decode($data['features'], true) : [];
    @endphp
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form id="general_section" action="{{ route('banner.save') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="general_id" value="{{ $general->id ?? 0 }}">
                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold" for="minimum_hours">Minimum booking
                                    duration</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="minimum_hours" name="minimum_hours"
                                        placeholder="24" value="{{ $data['minimum_hours'] ?? 0 }}">
                                    <select class="form-control" id="minimum_duration_type" name="minimum_duration_type">
                                        <option value="hours"
                                            {{ isset($data['minimum_duration_type']) && $data['minimum_duration_type'] == 'hours' ? 'selected' : '' }}>
                                            Hours</option>
                                        <option value="days"
                                            {{ isset($data['minimum_duration_type']) && $data['minimum_duration_type'] == 'days' ? 'selected' : '' }}>
                                            Days</option>
                                        <option value="months"
                                            {{ isset($data['minimum_duration_type']) && $data['minimum_duration_type'] == 'months' ? 'selected' : '' }}>
                                            Months</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Please Enter Minimum booking days.</div>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold" for="maximum_hours">Maximum booking
                                    duration</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="maximum_hours" name="maximum_hours"
                                        placeholder="36" value="{{ $data['maximum_hours'] ?? 0 }}">
                                    <select class="form-control" id="maximum_duration_type" name="maximum_duration_type">
                                        <option value="hours"
                                            {{ isset($data['maximum_duration_type']) && $data['maximum_duration_type'] == 'hours' ? 'selected' : '' }}>
                                            Hours</option>
                                        <option value="days"
                                            {{ isset($data['maximum_duration_type']) && $data['maximum_duration_type'] == 'days' ? 'selected' : '' }}>
                                            Days</option>
                                        <option value="months"
                                            {{ isset($data['maximum_duration_type']) && $data['maximum_duration_type'] == 'months' ? 'selected' : '' }}>
                                            Months</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Please Enter Maximum booking days.</div>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold" for="show_duration">Pre-Bookings Allowed
                                    Until</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="show_duration" name="show_duration"
                                        placeholder="1" value="{{ $data['show_duration'] ?? 0 }}">
                                    <select class="form-control" id="duration_type" name="duration_type">
                                        <option value="year"
                                            {{ isset($data['duration_type']) && $data['duration_type'] == 'year' ? 'selected' : '' }}>
                                            Year</option>
                                        <option value="months"
                                            {{ isset($data['duration_type']) && $data['duration_type'] == 'months' ? 'selected' : '' }}>
                                            Months</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Please Enter Show booking duration.</div>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold" for="inputEmail4">Referral</label>
                                <input type="text" class="form-control" id="referral" disabled
                                    value="{{ $referral_code ?? 0 }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold" for="inputPassword4">Door Step Delivery
                                    Fee</label>
                                <div class="d-flex">
                                    <div>
                                        <input type="text" class="form-control" id="delivery_fee" name="delivery_fee"
                                            placeholder="500" value="{{ $data['delivery_fee'] ?? 0 }}">
                                    </div>
                                    <div class=" mt-2 ps-3">
                                        <input class="form-check-input" type="checkbox" value="1" name="show_delivery"
                                            id="show_delivery" {{ !empty($data['show_delivery']) ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Please Enter Delivery Fee.</div>
                            </div>


                            <div class="form-group col-md-3" style="height: 100%; margin: 40px 0 0 0">
                                <div class="d-flex">
                                    {{-- <div class="my-auto"> --}}
                                    {{-- </div> --}}
                                    <div class="toggle-wrapper mx-2" id="toggle-button">
                                        <div class="label off">OFF</div>
                                        <div class="toggle-switch"></div>
                                        <div class="label on" style="display: none;">ON</div>
                                    </div>
                                    <input type="hidden" name="show_bookmarks" id="toggle-value" value="0">
                                    <label for="title">Show Bookmarks</label>
                                </div>
                            </div>

                            <div class="form-group col-md-5" style="height: 100%; margin: 40px 0 0 0">
                                <div class="d-flex">
                                    <div class="toggle-wrapper mx-2" id="toggle-blog-button">
                                        <div class="label off">OFF</div>
                                        <div class="toggle-switch"></div>
                                        <div class="label on" style="display: none;">ON</div>
                                    </div>
                                    <input type="hidden" name="show_blog" id="toggle-blog-value" value="0">
                                    <label for="title">Show Blog</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label font-weight-bold" for="inputPassword4">Create Booking
                                    After (Hours)
                                </label>
                                <div>
                                    <input type="text" class="form-control" id="booking_duration"
                                        name="booking_duration" placeholder="500"
                                        value="{{ $data['booking_duration'] ?? 0 }}">
                                </div>
                                <div class="invalid-feedback">Please Enter Booking Duration</div>
                            </div>

                        </div>


                        @if (in_array('general_settings_update', getAdminPermissions()))
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Update</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            if ("{{ !empty($data['show_bookmarks']) }}") {
                $('#toggle-button').toggleClass('on');
            }

            if ($('#toggle-button').hasClass('on')) {
                $('#toggle-button').css('background-color', 'green');
                $('#toggle-value').val('1');
            } else {
                $('#toggle-button').css('background-color', 'red');
            }

            $('#toggle-button').find('.label.off').toggle(!$('#toggle-button').hasClass('on'));
            $('#toggle-button').find('.label.on').toggle($('#toggle-button').hasClass('on'));
            $('#toggle-value').val("{{ !empty($data['show_bookmarks']) }}");



            if ("{{ !empty($data['show_blog']) }}") {
                $('#toggle-blog-button').toggleClass('on');
            }

            if ($('#toggle-blog-button').hasClass('on')) {
                $('#toggle-blog-button').css('background-color', 'green');
                $('#toggle-blog-value').val('1');
            } else {
                $('#toggle-blog-button').css('background-color', 'red');
            }
            $('#toggle-blog-button').find('.label.off').toggle(!$('#toggle-blog-button').hasClass('on'));
            $('#toggle-blog-button').find('.label.on').toggle($('#toggle-blog-button').hasClass('on'));
            $('#toggle-blog-value').val("{{ !empty($data['show_blog']) }}");
        });


        $('#toggle-button').on('click', function() {
            $(this).toggleClass('on');
            let value;
            if ($(this).hasClass('on')) {
                $(this).css('background-color', 'green');
                value = 1;
            } else {
                $(this).css('background-color', 'red');
                value = 0;
            }
            $(this).find('.label.off').toggle(!$(this).hasClass('on'));
            $(this).find('.label.on').toggle($(this).hasClass('on'));
            $('#toggle-value').val(value);
        });


        $('#toggle-blog-button').on('click', function() {
            $(this).toggleClass('on');
            let value;
            if ($(this).hasClass('on')) {
                $(this).css('background-color', 'green');
                value = 1;
            } else {
                $(this).css('background-color', 'red');
                value = 0;
            }

            $(this).find('.label.off').toggle(!$(this).hasClass('on'));
            $(this).find('.label.on').toggle($(this).hasClass('on'));
            $('#toggle-blog-value').val(value);
        });


        // Initially set the button to red color using jQuery
        $('#toggle-button').css('background-color', 'red');
        $('#toggle-blog-button').css('background-color', 'red');
    </script>


    <script src="{{ asset('admin/js/frontend.js') }}"></script>
@endsection
