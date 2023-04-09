<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&amp;display=swap">
    <link rel="stylesheet" href="/assets/bootstrap/css/index.css">
    <link rel="stylesheet" href="/assets/bootstrap/css/productscreate.css">

</head>
<body style="background:linear-gradient(rgba(47, 23, 15, 0.65), rgba(47, 23, 15, 0.65)), url('/assets/img/bg.jpg'); background-repeat: no-repeat; background-size: cover;">
    <nav class="navbar navbar-expand-lg " id="mainNav">
        <div class="container">
            <img src="/assets/img/logo.png" width="200px"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarResponsive"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link"  href="{{('/')}}">accueil</a></li>
                    <li class="nav-item"><a class="nav-link"  href="{{('/document')}}">documents</a></li>
                    <li class="nav-item"><a class="nav-link"  href="{{('/reservation/create')}}">réservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.html">contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="intro-body">
            <div class="row register-form">
                <div class="col-md-8 offset-md-2" style="margin-top: 50px;">
                    <form action="{{ route('reservation.store') }}" method="POST">
                    @CSRF
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <h1>formulaire de réservation</h1>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label" for="document_id">Document : </label>
                            <div class="col-sm-10">
                                <select class="form-select" name="document_id" id="document_id" aria-label="document_id">
                                    <option selected>Open this select menu</option>
                                    @foreach($documents as $document)
                                        <option value="{{ $document->id }}">{{ $document->titre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="start_date" class="col-sm-2 col-form-label">start date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" name="start_date" id="start_date"  required="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="end_date" class="col-sm-2 col-form-label">end date</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" name="end_date" id="end_date"  required="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-light submit-button">Enregistrer</button>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>     
    </header>
</body>
</html>