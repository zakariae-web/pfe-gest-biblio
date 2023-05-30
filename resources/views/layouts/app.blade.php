@yield('header')
    <body>
        <nav class="navbar fixed-top navbar-expand-lg" id="mainNav">
            <div class="container">
                <a href="{{('/')}}"> <img src="{{asset('assets/img/logo.png')}}"  class="navbar-brand">  <img src="{{asset('assets/img/ens.png')}}" alt="" class="ens navbar-brand"></a>
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
                        <li class="nav-item"><a class="nav-link"  href="{{('/reservation')}}">Réservation</a></li>
                        @endif
                        @if(Auth()->check() && Auth()->user()->role == 'admin')
                        <li class="nav-item"><a class="nav-link"  href="{{('/emprunts')}}">Emprunts</a></li>
                        <li class="nav-item"><a class="nav-link"  href="{{('/admin/reminder-emails')}}">e-mails de rappel</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="https://ensr-biblio.gitbook.io/ensr-biblio-1/">Guide</a></li>
                        <ul class="navbar-nav ms-auto">
                            @if(Auth()->check())
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" onclick="toggleDropdown()" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if(Auth()->user()->role != 'admin')
                                            <p class="dropdown-item"> carte de lecture : {{Auth::user()->card_number}} <i class="fa fa-copy material-icons" aria-hidden="true" onclick="copyCardNumber()">content_copy</i></p>
                                        @endif
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
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
        <footer class="text-center footer text-faded py-4">
        <div class="container">
            <p class="m-0 small">Copyright&nbsp;©&nbsp;cle-info 2023</p>
        </div>
    </footer>
    <script src="{{asset('assets/bootstrap/js/script.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/current-day.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/index.js')}}"></script>
    <script type="text/javascript">
    
  window._mfq = window._mfq || [];
  (function() {
    var mf = document.createElement("script");
    mf.type = "text/javascript"; mf.defer = true;
    mf.src = "//cdn.mouseflow.com/projects/40d5c39d-0739-4339-a337-5da192b0be3b.js";
    document.getElementsByTagName("head")[0].appendChild(mf);
  })();
</script>
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
</body>
</html>
