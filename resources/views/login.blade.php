@extends('Template.templateLogin', ['title' => 'login'])

@section('content-dinamis')
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    {{-- <form action="{{ route("do.register") }}" method="POST"> --}}
        <div class="landing-page">
            <div class="content">
                <h1><b><i>Login</i></b></h1>
                <form action="{{ route("login.auth") }}" method="POST">
                    @csrf
                    <div class="field">
                        <input type="email" name="email" required placeholder="Masukkan Email">
                        <label for="email"></label>
                    </div>
                    <div class="field">
                        <input type="password" name="password" required placeholder="Masukkan Password">
                        <label for="password"></label>
                    </div>
                    <button type="submit">Login</button>
                    <button type="submit" class="buat-akun">Buat Akun</button>
                </form>
            </div>
        </div>
@endsection