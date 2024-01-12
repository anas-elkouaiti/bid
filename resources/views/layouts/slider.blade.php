<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titolo')</title>
    <link rel="icon" href="{{ asset('/images/bg/auction_logo_24.png') }}" type="image/gif" sizes="20x20">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div id="spinner-loading">
        <img id="spinner-gif" src="{{ asset('/images/bg/spinner.gif')}}" alt="Loading..." />
    </div>

    <header class="header-area style-1">
        <div class="header-logo">
            <a href="{{ url('/') }}"><img alt="image" src="{{ asset('images/bg/auction_white_header.png') }}"></a>
        </div>
        <div class="main-menu">
            <div class="mobile-logo-area d-lg-none d-flex justify-content-between align-items-center">
                <div class="mobile-logo-wrap ">
                    <a href="{{ url('/') }}"><img alt="image" src="{{ asset('images/bg/auction_white_header.png') }}"></a>
                </div>
                <div class="menu-close-btn">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>
            <ul class="menu-list">
                <li>
                    <a href="{{ url('/') }}">@lang('labels.navbar-home')</a>
                </li>
                <li>
                    <a href="{{ url('/') }}/prodotti">@lang('labels.navbar-prodotti')</a>
                </li>
                @if (isset($logged) && $logged)
                <li>
                    <a href="{{ url('/') }}/prodotti/create">@lang('labels.navbar-nuovo-prodotto')</a>
                </li>
                @endif
                <li>
                    <a href="{{ url('/') }}/contattaci">@lang('labels.navbar-contattaci')</a>
                </li>
                @if (isset($logged) && $logged)
                <li>
                    <a href="{{ url('/') }}/user/logout">@lang('labels.navbar-logout')</a>
                </li>
                @endif
            </ul>

            <div class="d-lg-none d-block">
                <form action="{{ url('/') }}/prodotti/cerca" method="POST" id="form_m_search" class="mobile-menu-form mb-5">
                    @csrf
                    <div class="input-with-btn d-flex flex-column">
                        <input name="testo" id="testo_m_search" type="text" placeholder="@lang('labels.navbar-cerca-placeholder')" required>
                        <button type="submit" id="bottone_m_search" class="eg-btn btn--primary btn--sm">@lang('labels.navbar-cerca')</button>
                    </div>
                </form>
                <div class="position-relative mt-5">
                    @if (isset($logged) && $logged)
                    <div class="input-with-btn d-flex flex-column mobile-menu-form">
                        <a href="{{ url('/') }}/user/dashboard"><button class="eg-btn btn--primary btn--sm">@lang('labels.navbar-account')</button></a>
                    </div>
                    @else
                    <div class="input-with-btn d-flex flex-column mobile-menu-form">
                        <a href="{{ url('/') }}/user/login"><button class="eg-btn btn--primary btn--sm">@lang('labels.navbar-login')</button></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="nav-right d-flex align-items-center">
            <div style="padding: 9px 20px;">
                <a href="{{ url('/') }}/lang/it"><u>IT</u></a>/<a href="{{ url('/') }}/lang/en"><u>EN</u></a>
            </div>
            <form action="{{ url('/') }}/prodotti/cerca" method="POST" id="form_search">
                @csrf
                <div class="form-outline">
                    <input type="search" name="testo" id="testo_search" class="form-control" placeholder="@lang('labels.navbar-cerca-placeholder')" required/>
                </div>
            </form>    
            <div class="search-btn">
                <i id="bottone_search" class="bi bi-search"></i>
            </div>
            
            @if (isset($logged) && $logged)
            <div class="eg-btn btn--primary header-btn">
                <a href="{{ url('/') }}/user/dashboard">@lang('labels.navbar-account')</a>
            </div>
            @else
            <a href="{{ url('/') }}/user/login">
                <div class="eg-btn btn--primary header-btn">
                    @lang('labels.navbar-login')
                </div>
            </a>
            @endif
            <div class="mobile-menu-btn d-lg-none d-block">
                <i class='bx bx-menu'></i>
            </div>
        </div>
    </header>


    <div class="hero-area hero-style-one">
        <div class="hero-main-wrapper position-relative">
            <div class="swiper banner1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slider-bg-1">
                            <div class="container">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-xl-7 col-lg-10">
                                        <div class="banner1-content">
                                            <span>@lang('labels.slider-header')</span>
                                            <h1>@lang('labels.slider-titolo-1')</h1>
                                            <p>@lang('labels.slider-sottotitolo-1')
                                            </p>
                                            <a href="{{ url('/') }}/prodotti" class="eg-btn btn--primary btn--lg">@lang('labels.slider-esplora')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider-bg-2">
                            <div class="container">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-xl-7 col-lg-10">
                                        <div class="banner1-content">
                                            <span>@lang('labels.slider-header')</span>
                                            <h2>@lang('labels.slider-titolo-2')</h2>
                                            <p>@lang('labels.slider-sottotitolo-2')
                                            </p>
                                            <a href="{{ url('/') }}/prodotti" class="eg-btn btn--primary btn--lg">@lang('labels.slider-esplora')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-one-pagination d-flex justify-content-center flex-column align-items-center gap-3"></div>
        </div>
    </div>

    @yield('content')

    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <a href="{{ url('/') }}"><img alt="image" src="{{ asset('images/bg/auction_logo_64.png') }}"></a>
                            <a href="{{ url('/') }}"><img alt="image" src="{{ asset('images/bg/logo_footer.png') }}"></a>
                            <p>@lang('labels.footer-frase-immagine')</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex justify-content-lg-center">
                        <div class="footer-item">
                            <h5>@lang('labels.footer-navigazione')</h5>
                            <ul class="footer-list">
                                <li><a href="{{ url('/') }}/prodotti">@lang('labels.footer-prodotti')</a></li>
                                @if (isset($logged) && $logged)
                                    <li><a href="{{ url('/') }}/user/dashboard">@lang('labels.footer-account')</a></li>
                                @else
                                    <li><a href="{{ url('/') }}/user/login">@lang('labels.footer-login')</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex justify-content-lg-center">
                        <div class="footer-item">
                            <h5>@lang('labels.footer-faqs')</h5>
                            <ul class="footer-list">
                                <li><a href="{{ url('/') }}/contattaci">@lang('labels.footer-contattaci')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('js/odometer.min.js') }}"></script>
    <script src="{{ asset('js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/verifica_signup.js') }}"></script>
    <script src="{{ asset('js/verifica_login.js') }}"></script>
    <script src="{{ asset('js/verifica_create.js') }}"></script>
    <script src="{{ asset('js/verifica_contact.js') }}"></script>
    <script src="{{ asset('js/verifica_search.js') }}"></script>
    <script src="{{ asset('js/timer.js') }}"></script>
</body>

</html>