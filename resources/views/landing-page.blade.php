@extends('Template.templateLogin', ['title' => 'landing-page'])

@section('content-dinamis')
<link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">
<div class="container-fluid landing-page">
    <div class="row">
        <div class="col-md-6 content">
            <h1><b>Pengaduan <br> Masyarakat</b></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a href="{{ route('login') }}" class="btn btn-success bergabung">Bergabung!</a>
        </div>
        <div class="col-md-6" ><img src="assets/img/1.jpg" alt="" class="background"></div>
    </div>
</div>
@endsection