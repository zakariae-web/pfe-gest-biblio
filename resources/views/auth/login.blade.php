@extends('layouts.app')

@section('header')
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ENSR Rabat</title>
        <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/login.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/layout.css">
    </head>
@endsection
@section('content')
<div class="container create">
    <div class="login-box" style="background-image:url('assets/img/login.jpg'); background-size:cover;">
        <h2>se connecter</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="user-box">
                <label for="email"></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Addresse email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
            </div>
            <div class="user-box">
                <label for="password"></label>
                <div class="password-toggle">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('mot de passe') }}">
                    <button class="btn-toggle" type="button" onclick="togglePassword()">
                        <i class="far fa-eye-slash"></i>
                    </button>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="cssbuttons-io-button">
                <button type="submit">
                    {{ ('Login') }}
                </button>
            </div>
            <div class="row">
            @if (Route::has('password.request'))
                <div class="mdp pt-2" >
                    <a class="pt-3" href="{{ route('password.request') }}">
                        mot de passe oublié
                    </a>
                </div>
            @endif
            </div>
        </form>
    </div>
</div>
@endsection
