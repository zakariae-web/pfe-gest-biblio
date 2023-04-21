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
        <link rel="stylesheet" href="/assets/bootstrap/css/reservationindex.css">
    </head>
@endsection
@section('content')
    <div class="create">
        <h1>Liste des réservations</h1>
        @if(Auth()->check() && Auth()->user()->role == 'admin')
        <form method="GET" action="{{ route('reservation.index') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Recherche par carte de lecture" name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Document</th>
                    <th>Carte de lecture</th>
                    @if(Auth()->check() && Auth()->user()->role == 'admin')
                    <th>Validation</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->document->titre }}</td>
                        <td>{{ $reservation->user->card_number}}</td>
                        @if(Auth()->check() && Auth()->user()->role == 'admin')
                        <td>
                        <form action="{{ route('documents.validerEmprunt', $reservation->document->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Valider l'emprunt</button>
                        </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </tbody>
        </table>
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
        <a href="{{route('reservation.create')}}"><h1>ajouter une reservation </h1></a>
    </div>
@endsection