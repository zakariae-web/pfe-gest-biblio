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
        <link rel="stylesheet" href="/assets/bootstrap/css/reservationindex.css">
    </head>
@endsection
@section('content')
    <div class="container create" style="margin-top: 150px;">
            <div class="intro"><h1>Liste des réservations</h1> </div>
            @if(Auth()->check() && Auth()->user()->role == 'admin')
            <form method="GET" action="{{ route('reservation.index') }}">
                <div class="input-group mb-3">
                    <div class="input-container">
                        <input type="text" class="input" placeholder="Recherche par carte de lecture" name="search">
                        <span class="icon"> 
                            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier"      stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </span>
                    </div>
                    <div class="input-group-append ">
                        <button class="btn btn-outline-secondary bg-light ms-3 rechercherbtn" type="submit">Rechercher</button>
                    </div>
                </div>
            </form>
            @endif
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr> 
                        @if(Auth()->check() && Auth()->user()->role == 'admin')
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Document</th>
                            <th>Carte de lecture</th>
                            <th>Validation</th>
                        @else
                            <th></th>
                            <th>Document</th>
                            <th>Date de reservation</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            @if(Auth()->check() && Auth()->user()->role == 'admin')
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->document->titre }}</td>
                                <td>{{ $reservation->user->card_number}}</td>
                                <td>
                                <form action="{{ route('documents.validerEmprunt', $reservation->document->id) }}" method="POST" style="display: inline;" id="form-valider-emprunt-{{ $reservation->id }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn site-btn">Valider l'emprunt</button>
                                </form>
                                </td>
                            @else
                                <td><img src="images/{{ $reservation->document->image }}" style="width:150px; height:250px;"></td>
                                <td>{{ $reservation->document->titre }}</td>
                                <td>{{ $reservation->created_at}}</td>
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
        </div>
        @if(Auth()->check())
        <script>
    function copyCardNumber() {
        // Récupérer le numéro de carte de lecture
        var cardNumber = "{{ Auth::user()->card_number }}";

        // Créer un élément temporaire pour copier le texte dans le presse-papiers
        var tempElem = document.createElement('textarea');
        tempElem.value = cardNumber;
        tempElem.setAttribute('readonly', '');
        tempElem.style.position = 'absolute';
        tempElem.style.left = '-9999px';
        document.body.appendChild(tempElem);

        // Sélectionner le texte et le copier dans le presse-papiers
        tempElem.select();
        document.execCommand('copy');

        // Supprimer l'élément temporaire
        document.body.removeChild(tempElem);

        var icon = document.querySelector('.fa-copy');
        icon.classList.add('copied');
    }
    </script>
    @endif
@endsection