@extends('user.frontpage.list-cars.main')

@section('content')

    <div class="container-fluid p-3 section-1-bg">
        <div class="container bg-head-grey rounded-pill p-1 rounded-sm-3 my-head-round">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                <div class="container d-flex justify-content-between">
                    <div class="d-flex justify-content-between mobile-head-width">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('user/img/Logo (4).png') }}" alt="Site-Logo" class="img-fluid d-block">
                        </a>
                        <div class="my-auto h-100">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav"
                                aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <form x-data="{
        email: '{{ $email }}',
        token: '{{ $token }}',
        password: null,
        password_confirmation: null,
        error: ''
    }" @submit.prevent="async () => {

        if(!password || !password_confirmation) {
            error = 'Password Fields are required'
            return;
        }

        if(password !== password_confirmation) {
            error = 'Password Confirmation did not match'
            return;
        }

        try {
            const response = await axios.post('{{ route('reset-user-password') }}', {
                email, password, password_confirmation, token
            });

            if(response.status == 200) {
                window.location.href = '{{ url('/') }}'
            }

        } catch(error) {
            console.log(error)
        }

    }" style=" display: flex; justify-content: center; align-items: center; height: 80vh; ;">
        <div class="shadow-sm p-4 form-bdr" style="width: 400px">
            <h4 class="mb-0">Reset Password</h4>
            <p class="mb-4 text-secondary">Please enter the new password</p>
            <div class="mb-3 w-100">
                <label for="password" class="form-label fs-12 fw-500">Password</label>
                <input type="password" class="form-control  w-100 bg-grey form-bdr" x-model="password" id="password" name="password"
                    placeholder="********">
                <span class="text-danger" x-text="error"></span>
            </div>

            <div class="mb-3 w-100">
                <label for="password_confirmation" class="form-label fs-12 fw-500">Confirm
                    Password</label>
                <input type="password" class="form-control bg-grey form-bdr" x-model="password_confirmation" id="password_confirmation"
                    name="password_confirmation" placeholder="********">
            </div>

            <button type="submit" class="btn my-button next-button w-100 mt-4">Change Password</button>
        </div>
    </form>

@endsection