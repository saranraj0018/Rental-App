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
            <select id="car_model" class="form-control">
                <option selected disabled>Select Model</option>
                @foreach ($car_model as $model)
                    <option value="{{$model}}">{{$model}}</option>
                @endforeach
            </select>
            <select id="booking_type" class="form-control">
                <option selected disabled>Select Hub</option>
                <option value="603">Coimbatore</option>
            </select>
        </div>
        <!-- /.container-fluid -->
    </section>
    <table class="table">
        <thead>
        <tr>
            <th>Reg No</th>
            @foreach (range(0, 23) as $hour)
                <th>{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @if(!empty($availability))
        @foreach ($availability as $regNo => $days)
            <tr>
                <td>{{ $regNo }}</td>
                @foreach ($days as $day => $hours)
                    @foreach ($hours as $hour => $status)
                        <td class="{{ strtolower($status) }}">{{ $status }}</td>
                    @endforeach
                @endforeach
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>

@endsection

@section('customJs')
    <script src="{{ asset('admin/js/available.js') }}"></script>
@endsection
