<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>MUTHIA SMART SCHOOL</title>
    <link rel="stylesheet" type="text/css" href="{{asset('templates/styles/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('templates/styles/style.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include jQuery (if not included already) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
</head>

<body class="theme-light" data-highlight="blue2">

    <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div>

    <div id="page">

        <div class="header header-fixed header-auto-show header-logo-app">
            <a href="{{ url()->previous() }}" data-back-button class="header-title header-subtitle">
                MUTHIA SMART SCHOOL

            </a>

        </div>

        @if (!in_array(Request::path(), ['login', 'register', '/']))
        <div id="footer-bar" class="footer-bar-5">
            <a href="{{ route('home') }}" class="{{ Request::is('home*') ? 'active-nav' : '' }}">
                <i class="fas fa-home"></i><span>Home</span>
            </a>
            <a href="{{ url('/about') }}" class="{{ Request::is('about*') ? 'active-nav' : '' }}">
                <i class="fas fa-info"></i><span>About</span>
            </a>
            <a href="{{ url('/profile') }}" class="{{ Request::is('profile*') ? 'active-nav' : '' }}">
                <i class="fas fa-cog"></i><span>Settings</span>
            </a>
        </div>


        @endif

        <div class="page-content pb-0" style="padding: 5px;margin-top: 10px;">
            <!-- Add a scrollable container for the content -->
            <!-- 
            <div class="page-title page-title-small">
                <h2 style="text-transform: uppercase;"><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ Route::currentRouteName() }}</h2>
                <a href="#" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{asset('templates/images/avatars/5s.png')}}"></a>
            </div>
            <div class="card header-card shape-rounded" data-card-height="95">
                <div class="card-overlay bg-highlight opacity-95"></div>
                <div class="card-overlay dark-mode-tint"></div>
                <div class="card-bg preload-img" data-src="{{ asset('templates/images/pictures/logo.png')}}"></div>
            </div> -->
            <!-- Header bar -->

            <div class="scrollable" style="padding-bottom: 50px;">
                @yield('content')

            </div>
            <!-- end of scrollable container -->
        </div>


        <div id="menu-share" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-load="menu-share.html" data-menu-height="420" data-menu-effect="menu-over">
        </div>

        <div id="menu-highlights" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-load="menu-colors.html" data-menu-height="510" data-menu-effect="menu-over">
        </div>

        <div id="menu-main" class="menu menu-box-right menu-box-detached rounded-m" data-menu-width="260" data-menu-load="menu-main.html" data-menu-active="nav-pages" data-menu-effect="menu-over">
        </div>

    </div>


    <script type="text/javascript" src="{{asset('templates/scripts/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('templates/scripts/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('templates/scripts/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</body>

</html>