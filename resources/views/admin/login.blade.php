<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
</head>
<style>
    .login-page, .register-page {
        flex-direction: row;
    }
</style>
<body class="hold-transition login-page">

<div class="container my-5 row">
    <div class="col-12 col-md-6 col-lg-8 my-auto mx-auto">
            <img src="{{ asset('admin/img/imgpsh_fullsize_anim.png') }}" class="img-fluid d-block">
    </div>
    <div class="col-12 col-md-6 col-lg-4 my-auto">
        <div class="login-box justify-content-end">
            @include('admin.message')
            <!-- /.login-logo -->
            <div>
                <div class="card-header text-center">
                    <a href="#" class="h3">Administrative Panel</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{ route('admin.authenticate') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password"  name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                            <p  class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <p class="mb-1 mt-3">
                            <a href="forgot-password.html">I forgot my password</a>
                        </p>
                        <p class="mb-1 mt-3">
                            <a href="{{ route('admin.register') }}">Register Admin page</a>
                        </p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="js/demo.js"></script>--}}
</body>
</html>
