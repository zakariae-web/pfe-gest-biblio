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
        <link rel="stylesheet" href="/assets/bootstrap/css/documentscreate.css">
    </head>
@endsection
@section('content')
<div class="container create " style="margin-top: 150px;">
    <h1>ajouter un livre</h1>
    <form action="{{route('document.store')}}" method="POST" enctype="multipart/form-data">
        @CSRF
        <label> Titre </label>
        <input type="text" name="titre">
        <label> Image </label>
        <input type="file" name="image" class="form-control">
        <label> Type </label>
        <select name="type_document" id="">
            <option value="livre"> Livre</option>
            <option value="revue"> Revue</option>
        </select>
        <label> Nom d'editeur </label>
        <input type="text" name="nom_editeur">
        <label> Auteur </label>
        <input type="text" name="auteur_principal">
        <label> thématique </label>
        <select name="cote" id="">
            <option value="science"> science</option>
            <option value="mathematique"> mathematique</option>
            <option value="informatique"> informatique</option>
            <option value="l'histoire"> l'histoire</option>
            <option value="dictionnaire"> dictionnaire</option>
            <option value="autre"> autre</option>
        </select>
        <button type="submit">submit</button>
    </form>
</div>  
@endsection