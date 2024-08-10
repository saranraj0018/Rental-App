@extends('admin.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cars List</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary mb-3" id="add_car">Add Car</button>
                    <button class="btn btn-primary mb-3" id="add_car_model">Add Model</button>
            </div>
        </div>

        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href=''"
                                    class="btn btn-default btn-sm">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Model</th>
                            <th>Info</th>
                            <th>Block InterCity For Interval</th>
                            <th>Application For Ipp</th>
                            <th>Registration No</th>
                            <th>Hub</th>
                            <th>Till</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="7"> Record Not Found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                {{--                <div class="card-footer clearfix">--}}
                {{--                    {{ $category->links() }}--}}
                {{--                </div>--}}
            </div>
        </div>

        @include('admin.hub.model')
        <!-- /.card -->
    </section>

    <!-- /.content -->
@endsection
@section('customJs')
<script src="{{asset("admin/js/car-details.js")}}"></script>
@endsection
