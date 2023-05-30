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
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/layout.css">
        <link rel="stylesheet" href="/assets/bootstrap/css/documentsindex.css">
    </head>
@endsection
@section('content')
<div class="container" style="margin-top: 150px;">
    <div class="card-container">
        <div class="col">
            <div class="search-filter-container">
            <form method="GET" action="{{ route('document.index') }}">
                <div class="input-group mb-2">
                    <div class="input-container">
                        <input type="text" class="input" placeholder="Rechercher par titre..." name="titre" id="titre">
                    </div>
                </div>
            </form>
            </div>
            <form method="GET" action="{{ route('document.index') }}">
                <div class="d-flex gap-2  shadow rounded text-light p-3" id="filter">
                    <i class="fa-solid fa-caret-right"></i>
                <label for="cote">filtrage par thématique:</label>
                </div>
                <ul id="filter-options" class="mt-2">
                    <li><a href="{{ route('document.index') }}">Tous les documents</a></li>
                    <li><a href="{{ route('document.index', ['cote' => 'informatique']) }}">Informatique</a></li>
                    <li><a href="{{ route('document.index', ['cote' => 'mathematique']) }}">Mathématique</a></li>
                    <li><a href="{{ route('document.index', ['cote' => 'science']) }}">Science</a></li>
                    <li><a href="{{ route('document.index', ['cote' => "l'histoire"]) }}">L'Histoire</a></li>
                    <li><a href="{{ route('document.index', ['cote' => 'dictionnaire']) }}">dictionnaire</a></li>
                    <li><a href="{{ route('document.index', ['cote' => 'autre']) }}">autre...</a></li>
                </ul>
            </form>
                @if(Auth()->check() && Auth()->user()->role == 'admin')
    <a href="{{route('document.create')}}">
        <button class="cssbuttons-io-button mt-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg>
            <span>ajouter</span>
        </button>
    </a>
    @endif
        </div>
        @foreach($documents as $document)

            <div class="book-card">
                <div class="book-card-image">
                    <a href="{{route('document.show', ['document' => $document->id])}}"><img src="images/{{$document['image']}}" alt="Book cover image"></a>
                </div>
                <div class="book-card-info">
                    <div class="book-title"><h2>{{$document['titre']}}</h2> </div>
                    <div class="book-editeur"><p>{{$document['nom_editeur']}}</p></div>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                      <button class="cssbuttons-io-button" type="submit" onclick="showDeleteModal()">supprimer</button>
                        <a href="{{route('document.edit', ['document' => $document->id])}}"><button class="cssbuttons-io-button mt-2 mb-2"> modifier </button></a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" data-bs-dismiss="modal">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce document ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" action="{{ route('document.destroy', ['document' => $document->id])}}">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" type="submit" onclick="showDeleteModal()">supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showDeleteModal() {
            $('#deleteModal').modal('show');
        }

        function deleteDocument() {
            $('#deleteForm').submit();
        }
    </script>
    <div class="doc-links mt-3 mb-2">
        {{ $documents->links() }}
    </div>
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