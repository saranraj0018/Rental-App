@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Car Availability</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="d-flex w-25">
            <label for="car_model"></label><select id="car_model" class="form-control">
                <option selected disabled>Select Model</option>
                @foreach ($car_model as $id => $model)
                    <option value="{{$id}}">{{$model}}</option>
                @endforeach
            </select>
            <label for="booking_type"></label><select id="booking_type" class="form-control">
                <option selected disabled>Select Hub</option>
                <option value="603">Coimbatore</option>
            </select>
        </div>
        <!-- /.container-fluid -->
    </section>
    <div id="availabilityDetails" class="mt-4">
        <!-- Availability details will be loaded here via AJAX -->
    </div>

@endsection

@section('customJs')
    <script src="{{ asset('admin/js/available.js') }}"></script>
@endsection
