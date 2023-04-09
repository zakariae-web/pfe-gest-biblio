<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&amp;display=swap">
    <link rel="stylesheet" href="assets/bootstrap/css/index.css">
    <link rel="stylesheet" href="assets/bootstrap/css/productsindex.css">
</head>
<body style="background:linear-gradient(rgba(47, 23, 15, 0.65), rgba(47, 23, 15, 0.65)), url('assets/img/bg.jpg'); background-repeat: no-repeat; background-size: cover;">
<nav class="navbar navbar-expand-lg " id="mainNav">
            <div class="container">
                <img src="assets/img/logo.png" width="200px"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarResponsive"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link"  href="{{('/')}}">accueil</a></li>
                        <li class="nav-item"><a class="nav-link"  href="{{('/document')}}">documents</a></li>
                        <li class="nav-item"><a class="nav-link"  href="{{('/reservation/create')}}">réservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="products.html">contact</a></li>
                        <li class="nav-item"><a class="nav-link " href="#" role="button">{{ Auth::user()->name }}</a></li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

    </nav>
    <section class="page-section clearfix">
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
                    @if(Auth::user()->role == 'admin')
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
                        <div class="card">
                            <div class="img"></div>
                            <div class="text">
                                <p class="h3"> {{$document['titre']}}</p>
                                <p class="p"> {{$document['auteur_principal']}} </p>
                                <p class="span">{{$document['nom_editeur']}}</p>
                            </div>
                        </div>
                        @if(Auth::user()->role == 'admin')
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
    </section>
</body>
</html>