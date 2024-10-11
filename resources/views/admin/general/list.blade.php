@extends('admin.layout.app')
@section('content')
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
                            <div class="form-group col-md-4">
                                <label class="form-control-label font-weight-bold" for="inputPassword4">Minimum booking days</label>
                                <input type="number" class="form-control" id="minimum_hours" name="minimum_hours" placeholder="24 Hours" value="{{ $data['minimum_hours'] ?? 0 }}">
                                <div class="invalid-feedback">Please Enter Minimum booking days.</div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label font-weight-bold" for="inputPassword4">Maximum booking days</label>
                                <input type="number" class="form-control" id="maximum_hours" name="maximum_hours" placeholder="36 Hours" value="{{ $data['maximum_hours'] ?? 0 }}">
                                <div class="invalid-feedback">Please Enter Maximum booking days.</div>
                            </div>
                                <div class="form-group col-md-3">
                                    <label class="form-control-label font-weight-bold" for="inputEmail4">Referral</label>
                                    <input type="text" class="form-control" id="referral" disabled value="{{ $referral_code ?? 0 }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-control-label font-weight-bold" for="inputPassword4">Door Step Delivery Fee</label>
                                    <input type="number" class="form-control" id="delivery_fee" name="delivery_fee" placeholder="500" value="{{ $data['delivery_fee'] ?? 0 }}">
                                    <div class="invalid-feedback">Please Enter Delivery Fee.</div>
                                </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script src="{{asset("admin/js/frontend.js")}}"></script>
@endsection
