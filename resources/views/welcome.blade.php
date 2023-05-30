<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ENSR Rabat</title>
    <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&amp;display=swap">
    <link rel="stylesheet" href="assets/bootstrap/css/index.css">
</head>

<body>
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

        var icon = document.querySelector('.material-icons');
        icon.classList.add('copied');
    }
    </script>
    @endif
    <nav class="navbar fixed-top navbar-expand-lg" id="mainNav">
        <div class="container">
            <a href="{{('/')}}"><img src="{{asset('assets/img/logo.png')}}"  class="navbar-brand"> <img src="assets/img/ens.png" alt="" class="ens navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <img src="{{asset('assets/img/logo.png')}}"  class="navbar-brand">
                    <img src="assets/img/ens.png" alt="" class="navbar-brand">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link"  href="{{('/')}}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link"  href="{{('/document')}}">Documents</a></li>
                    @if(Auth()->check())
                    <li class="nav-item"><a class="nav-link"  href="{{('/Réservation')}}">Réservation</a></li>
                    @endif
                    @if(Auth()->check() && Auth()->user()->role == 'admin')
                    <li class="nav-item"><a class="nav-link"  href="{{('/emprunts')}}">Emprunts</a></li>
                    <li class="nav-item"><a class="nav-link"  href="{{('/admin/reminder-emails')}}">e-mails de rappel</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="https://ensr-biblio.gitbook.io/ensr-biblio-1/">Guide</a></li>
                    @if(Auth()->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" onclick="toggleDropdown()" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <p class="dropdown-item"> carte de lecture : {{Auth::user()->card_number}} <span class="material-icons" aria-hidden="true" onclick="copyCardNumber()">content_copy</span></p>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Se Déconnecter') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li> 
                    @else
                        <li class="nav-item" id="login-item">
                            <a class="nav-link login-link" href="{{ route('login') }}">Se Connecter</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <section class="page-section clearfix" >
    <div class="container" style="margin-top: 150px;">
        <div class="row">
        <div class="col-md-6">
            <div class="text-center intro-text p-5 rounded bg-faded">
            <h2 class="section-heading mb-4"><span class="section-heading-lower">Bienvenue sur ENSR BIBLIO </span></h2>
            <p class="mb-3">Nous sommes heureux de vous présenter notre bibliothèque en ligne, où vous pouvez accéder à une collection de livres fascinante et gérer vos emprunts de manière simple et rapide. Commencez votre voyage de lecture dès maintenant</p>
            <div class="mx-auto intro-button"><a class="btn btn-primary d-inline-block mx-auto btn-xl" role="button" href="{{('/public/document')}}">Consulter le catalogue</a></div>
            </div>
        </div>
        <div class="image-container col-md-6">
            <img src="assets/img/welcomeimg.jpeg" alt="" class="welcomeimg w-100 ms-5" style="margin-top: 100px;">
        </div>
        </div>
    </div>
    </section>
    <section class="page-section cta" style="background-image:url('assets/img/secbg.jpeg'); background-repeat:no-repeat; background-size:cover; height:100vh;background-position-y:center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="text-center cta-inner rounded">
                        <h2 class="section-heading mb-4"><span class="section-heading-lower">Explorez notre bibliothèque</span></h2>
                        <p class="mb-0">Notre site de gestion de bibliothèque est l'outil parfait pour tout passionné de lecture. Avec notre système de gestion de catalogue en ligne, vous pouvez parcourir notre collection de livres en quelques clics et trouver le livre parfait pour vous. Nous avons une grande variété de genres, allant de la fiction à la non-fiction, de l'histoire à la science-fiction, de la romance aux thrillers. Notre site permet également de gérer vos emprunts et vos réservations en ligne, ce qui facilite la planification de votre temps de lecture.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container gallery">
        <div class="slider">
            <div class="slide"><img src="{{asset('assets/img/biblio1.jpeg')}}"></div>
            <div class="slide"><img src="{{asset('assets/img/biblio2.jpeg')}}"></div>
            <div class="slide"><img src="{{asset('assets/img/biblio3.jpeg')}}"></div>
            <div class="slide"><img src="{{asset('assets/img/biblio4.jpeg')}}"></div>
            <div class="slide"><img src="{{asset('assets/img/biblio5.jpeg')}}"></div>
            <div class="slide"><img src="{{asset('assets/img/biblio6.jpeg')}}"></div>
            <div class="slide"><img src="{{asset('assets/img/biblio7.jpeg')}}"></div>
            <div class="slide"><img src="{{asset('assets/img/biblio8.jpeg')}}"></div>
        </div>
        <div class="thumbnails">
            <div class="thumbnail" data-slide="0"><img src="{{asset('assets/img/biblio1.jpeg')}}"></div>
            <div class="thumbnail" data-slide="1"><img src="{{asset('assets/img/biblio2.jpeg')}}"></div>
            <div class="thumbnail" data-slide="2"><img src="{{asset('assets/img/biblio3.jpeg')}}"></div>
            <div class="thumbnail" data-slide="3"><img src="{{asset('assets/img/biblio4.jpeg')}}"></div>
            <div class="thumbnail" data-slide="4"><img src="{{asset('assets/img/biblio5.jpeg')}}"></div>
            <div class="thumbnail" data-slide="5"><img src="{{asset('assets/img/biblio6.jpeg')}}"></div>
            <div class="thumbnail" data-slide="6"><img src="{{asset('assets/img/biblio7.jpeg')}}"></div>
            <div class="thumbnail" data-slide="7"><img src="{{asset('assets/img/biblio8.jpeg')}}"></div>
        </div>
    </div>
    <section id="contact" class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="map">
                        <h2>Localisation</h2>
                        <p>N'hésitez pas à nous visiter!</p>
                        <div class="mobmap"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3308.5279642009364!2d-6.827079974534711!3d33.97897023703628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76b5b0b4ce247%3A0x696a97e141a43e64!2sEcole%20Normale%20Sup%C3%A9rieure!5e0!3m2!1sen!2sma!4v1682344779124!5m2!1sen!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                    </div>
                </div>
                <div class="col">
                    <div class="contact">
                        <h2>Ens Rabat Bibliothèque</h2>
                        <p>Contactez Nous</p>
                        <ul>
                            <li><i class="fa-solid fa-graduation-cap"></i> école normale supérieure rabat</li>
                            <li><i class="fa-solid fa-location-dot"></i> Siège: ENS Avenue Mohamed Bel Hassan El Ouazzani, BP : 5118. Takaddoum - Rabat Maroc.</li>
                            <li><i class="fa-solid fa-phone"></i> 05.37.75.80.96</li>
                            <li><i class="fa-regular fa-envelope"></i> Email: ens@um5.ac.ma</li>
                        </ul>
                        <img src="{{asset('assets/img/ens.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-center footer text-faded py-4">
        <div class="container">
            <p class="m-0 small">Copyright&nbsp;©&nbsp;cle-info 2023</p>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/current-day.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/bootstrap/js/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript">
        window._mfq = window._mfq || [];
        (function() {
            var mf = document.createElement("script");
            mf.type = "text/javascript"; mf.defer = true;
            mf.src = "//cdn.mouseflow.com/projects/40d5c39d-0739-4339-a337-5da192b0be3b.js";
            document.getElementsByTagName("head")[0].appendChild(mf);
        })();
    </script>
</body>

</html>