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
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/layout.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/documentsedit.css">
    </head>
@endsection
@section('content')
<div class="container" style="margin-top: 150px;">
        <h1 class="text-center titre">informations de livres</h1>
        <div class="card">
            <div class="image">
                <img src="{{ asset('images/'.$document['image']) }}" alt="not found">
            </div>
            <div class="info">
                <div class="label1">
                <span><p class="first">Titre : </p></span>
                </div>
                <div class="information1">
                <span><p class="seconde">{{$document['titre']}} </p></span>
                </div>
                <div class="label2">
                <span><p class="first">Auteur : </p></span>
                </div>
                <div class="information2">
                <span><p class="seconde">{{$document['auteur_principal']}} </p></span>
                </div>
                <div class="label3">
                <span><p class="first">Editeur : </p></span>
                </div>
                <div class="information3">
                <span><p class="seconde">{{$document['nom_editeur']}} </p></span>
                </div>
                <!--
                <div class="label4">
                <span><p class="first">description : </p></span>
                </div>
                <div class="information4">
                <span><p class="seconde">{{$document['cote']}}  </p></span>
                </div>
                -->
                 <div class="label5">
                <span><p class="first">Nombre d'exemplaires : </p></span>
                </div>
                <div class="information5">
                <span><p class="seconde">{{$document['nombre_de_copies']}} </p></span>
                </div>
                <div class="reservation-btn">
                    <form action="{{ route('reservation.store') }}" method="POST">
                        @CSRF
                        @if(auth()->check())
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        @endif
                        @if($document['nombre_de_copies'] == 0)
                        <div class="alert alert-danger ms-5 col-md-8 col-lg-5 text-center">
                            <p>Le document est déjà emprunté par tous les utilisateurs. </p>
                        </div>
                        @else
                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                        <div class="col-md-8 col-lg-5 text-center"><button class="btn btn-lg d-block w-100" type="submit">Réserver</button></div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection