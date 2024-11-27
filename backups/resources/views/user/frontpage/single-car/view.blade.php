@extends('user.frontpage.list-cars.main')

@section('content')
    @include('user.frontpage.single-car.section1')
    @include('user.frontpage.single-car.section2')
    @include('user.frontpage.single-car.verified-model')
    @include('user.frontpage.footer')
@endsection
