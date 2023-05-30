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
        <link rel="stylesheet" href="/assets/bootstrap/css/layout.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/documentsindex.css">
    </head>
@endsection
@section('content')
    <h1>Send Reminder Emails</h1>

    @if(count($users) > 0)
        <form method="POST" action="{{ route('admin.send-emails') }}">
            @csrf

            @foreach($users as $user)
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="users[]" value="{{ $user->id }}">
                        {{ $user->name }} - {{ $user->email }}
                    </label>
                </div>
            @endforeach

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Send Emails</button>
            </div>
        </form>
    @else
        <p>No users found with emprunts due in the next 24 hours.</p>
    @endif
@endsection
