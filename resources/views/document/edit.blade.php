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
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/documentscreate.css">
    </head>
@endsection
@section('content')
<h1>modifier les informations de livre</h1>
    <form action="{{route('document.update', ['document' => $document->id])}}" method="POST">
        @CSRF
        @method('PUT')
        <label> titre </label>
        <input type="text" name="titre" value="{{old('titre',$document->titre)}}">
        <label> image </label>
        <input type="file" name="image">
        <label> le type </label>
        <select name="type_document" id="">
            <option value="livre"> livre</option>
            <option value="revue"> revue</option>
        </select>
        <label> nom d'editeur </label>
        <input type="text" name="nom_editeur" value="{{old('nom_editeur',$document->nom_editeur)}}">
        <label> auteur </label>
        <input type="text" name="auteur_principal" value="{{old('auteur_principal',$document->auteur_principal)}}">
        <br><label> periodicity </label>
        <input type="text" name="periodicite_parution" value="{{old('periodicite_parution',$document->periodicite_parution)}}">
        <label> cote </label>
        <input type="text" name="cote" value="{{old('cote',$document->cote)}}">
        <button type="submit">submit</button>
    </form>
    
@endsection