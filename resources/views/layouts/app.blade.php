@yield('header')
    <body>  
        <nav class="navbar navbar-expand-lg pt-5" id="mainNav">
            <div class="container">
                <img src="/assets/img/logo.png"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarResponsive"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link"  href="{{('/')}}">accueil</a></li>
                        <li class="nav-item"><a class="nav-link"  href="{{('/document')}}">documents</a></li>
                        <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item" id="login-item">
                                    <a class="nav-link login-link" href="{{ route('login') }}">{{ __('Se Connecter') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
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
</body>
</html>
