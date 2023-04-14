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
        <link rel="stylesheet" href="/assets/bootstrap/css/documentsindex.css">
    </head>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="GET" action="{{ route('document.index') }}">
                    <div class="input-container mb-3">
                        <input type="text" name="titre" id="titre" class="input" placeholder="Rechercher par titre...">
                        <span class="icon"> 
                            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </span>
                    </div>
                    <div class="mr-3 d-flex filtercat gap-3 align-items-center shadow rounded bg-dark text-light p-3">
                        <i class="fa-solid fa-caret-right"></i>
                        <label for="type_document">filtrage par le type :</label>
                        <select name="type_document" id="type_document">
                            <option value="all" class="d-flex align-items-center filter-btn gap-3 fs-5"> tous les documents</option>
                                <option value="livre">livre</option>
                                <option value="revue">revue</option>
                        </select>
                        <button type="submit">Filter</button>
                    </div>
                </form>
                @if(Auth()->check() && Auth()->user()->role == 'admin')
                    <a href="{{route('document.create')}}">
                        <button class="cssbuttons-io-button mt-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg>
                            <span>ajouter</span>
                        </button>
                    </a>
                @endif
            </div>
            @foreach($documents as $document)
                <div class="col">
                    <figure class="snip1253 hover">
                        <div class="image"><img src="images/{{$document['image']}}" alt="sample66"/></div>
                        <figcaption>
                            <div class="date"><span class="day">17</span><span class="month">Nov</span></div>
                            <h3>{{$document['titre']}}</h3>
                            <p> editeur : {{$document['nom_editeur']}}</p>
                        </figcaption>
                        <footer>
                            <div class="views"><i class="ion-eye"></i>{{$document['auteur_principal']}}</div>
                        </footer><a href="{{route('document.show', ['document' => $document->id])}}"></a>
                    </figure>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                    <form method="POST" action="{{ route('document.destroy', ['document' => $document->id])}}">
                        @csrf
                        @method('DELETE')
                    <button class="noselect mt-2 mb-2"><span class="text">supprimer</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg></span></button>
                    </form>
                    <a href="{{route('document.edit', ['document' => $document->id])}}"><button class="btn mt-2 mb-2"> modifier </button></a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection