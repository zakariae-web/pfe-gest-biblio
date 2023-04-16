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
<div class="search-filter-container mb-5">
    <form method="GET" action="{{ route('document.index') }}">
        <div class="input-container mb-3 mt-4">
            <input type="text" name="titre" id="titre" class="form-control" placeholder="Rechercher par titre...">
        </div>
        <div class="d-flex gap-2  shadow rounded text-light p-3" id="filter">
            <i class="fa-solid fa-caret-right"></i>
            <label for="type_document">filtrage par type:</label>
            <select name="type_document" id="type_document" class="form-select">
                <option value="all" class="d-flex align-items-center filter-btn gap-3 fs-5"> tous les documents</option>
                    <option value="livre">livre</option>
                    <option value="revue">revue</option>
            </select>
            <button type="submit" class="btn btn-light">Filter</button>
        </div>
    </form>
</div>
@if(Auth()->check() && Auth()->user()->role == 'admin')
    <a href="{{route('document.create')}}">
        <button class="cssbuttons-io-button mt-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg>
            <span>ajouter</span>
        </button>
    </a>
@endif
<div class="container">
    <div class="card-container">
        @foreach($documents as $document)
            <div class="book-card">
                <div class="book-card-image">
                    <img src="images/{{$document['image']}}" alt="Book cover image">
                </div>
                <div class="book-card-info">
                    <h2>{{$document['titre']}}</h2>
                    <p>{{$document['nom_editeur']}}</p>
                    <p>{{$document['auteur_principal']}}</p>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <form method="POST" action="{{ route('document.destroy', ['document' => $document->id])}}">
                            @csrf
                            @method('DELETE')
                            <button class="noselect mt-2 mb-2"><span class="text">supprimer</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg></span></button>
                        </form>
                        <a href="{{route('document.edit', ['document' => $document->id])}}"><button class="mt-2 mb-2" id="btn"> modifier </button></a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection