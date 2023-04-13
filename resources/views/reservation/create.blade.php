@extends('layouts.app')

@section('header')
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ENSR Rabat</title>
        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link rel="stylesheet" href="/assets/bootstrap/css/reservationcreate.css">
    </head>
@endsection
@section('content')
    <header>
        <div class="container">
            <form action="{{ route('reservation.store') }}" method="POST">
            @CSRF
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <h1>formulaire de réservation</h1>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="document_id">Document : </label>
                    <div class="col-sm-10">
                        <select class="form-select" name="document_id" id="document_id" aria-label="document_id">
                            <option selected>Open this select menu</option>
                            @foreach($documents as $document)
                                <option value="{{ $document->id }}">{{ $document->titre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <button type="submit" class="btn btn-dark submit-button">Enregistrer</button>
            </form>
        </div>
    </header>
@endsection