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
        <link rel="stylesheet" href="/assets/bootstrap/css/documentsedit.css">
    </head>
@endsection
@section('content')
    <div class="container create">
        <h1 class="text-center">informations de livres</h1>
        <div id="uno" class="vpn-top-item nonumber"><div class="number">{{$document['id']}}</div>
            <div class="row" style="margin-right: 15px;margin-left: 15px;">
                <div class="col-md-6 col-lg-8">
                    <div class="row content">
                        <div class="col-lg-8 col-xl-8">
                            <div class="d-table" style="width: 100%;padding-top: 25px;">
                                <div class="d-table-row">
                                    <div class="d-table-cell" style="width: 100%;"><h1>{{$document['titre']}}<br></h1></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell" style="width: 100%;"><h3>{{$document['nom_editeur']}}<br></h3></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell" style="width: 100%;"><h3>{{$document['auteur_principal']}}<br></h3></div>
                                </div>
                                <div class="d-table-row">
                                    <div class="d-table-cell" style="width: 100%;"><p>une description de livre<br></p></div>
                                </div>
                                <form action="{{ route('reservation.store') }}" method="POST">
                                    @CSRF
                                    @if(auth()->check())
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    @endif
                                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                                        <div class="col-md-8 col-lg-5 text-center"><button class="btn btn-danger btn-lg d-block w-100" style="margin-top: 35px;" type="submit">Réserver</button></div>
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="one"></div>
                    <img src="/images/{{$document['image']}}" alt="">
                    <div class="one"></div>
                </div>
            </div>
        </div>
    </div>
@endsection