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
        <link rel="stylesheet" href="assets/bootstrap/css/layout.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/emprunts.css">
    </head>
@endsection
@section('content')
<div class=" container create" style="margin-top: 150px;">
    <div class="intro"> <h1>Liste des emprunts</h1> </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nom d'utilisateur</th>
                    <th>Document</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour</th>
                    @if(Auth()->check() && Auth()->user()->role == 'admin')
                    <th>valider retour</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($emprunts as $emprunt)
                    <tr>
                        <td>{{ $emprunt->id }}</td>
                        <td>{{ $emprunt->user->name }}</td>
                        <td>{{ $emprunt->document->titre }}</td>
                        <td>{{ $emprunt->date_emprunt }}</td>
                        <td>{{ $emprunt->date_retour }}</td>
                        @if(Auth()->check() && Auth()->user()->role == 'admin')
                        <td>
                            
                        <form action="{{ route('emprunts.validerRetour', ['emprunt_id' => $emprunt->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn site-btn" id="valider-emprunt-{{ $emprunt->id }}">Valider le retour</button>
                        </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection