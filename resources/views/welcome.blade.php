@extends('templates.frontend')

@section('content')
<div data-card-height="cover-card" class="card bg-transparent">
    <div class="card-center text-center">
        <h1 class="fa-3x font-900 mb-0 color-highlight">AZURES</h1>
        <p class="font-13">Beautiful & Fast Interfaces</p>

        <div class="row mx-auto mt-3 mb-0" style="max-width:330px;">
            <a href="index.html" class="col-4">
                <i data-feather="home" data-feather-line="1" data-feather-size="55" data-feather-color="green1-dark" data-feather-bg="green1-fade-light"></i>
                <p>Home</p>
            </a>
            <a href="#" data-toggle-theme class="col-4 show-on-theme-light">
                <i data-feather="moon" data-feather-line="1" data-feather-size="55" data-feather-color="gray2-dark" data-feather-bg="gray2-fade-light"></i>
                <p>Dark Mode</p>
            </a>
            <a href="#" data-toggle-theme class="col-4 show-on-theme-dark">
                <i data-feather="sun" data-feather-line="1" data-feather-size="55" data-feather-color="yellow1-dark" data-feather-bg="yellow1-fade-light"></i>
                <p>Light Mode</p>
            </a>
            <a href="index-components.html" class="col-4">
                <i data-feather="settings" data-feather-line="1" data-feather-size="55" data-feather-color="blue2-dark" data-feather-bg="blue2-fade-light"></i>
                <p>Components</p>
            </a>
            <a href="gallery-list.html" class="col-4">
                <i data-feather="camera" data-feather-line="1" data-feather-size="55" data-feather-color="teal-dark" data-feather-bg="teal-fade-light"></i>
                <p>Gallery</p>
            </a>
            <a href="portfolio-list.html" class="col-4">
                <i data-feather="image" data-feather-line="1" data-feather-size="55" data-feather-color="red2-dark" data-feather-bg="red2-fade-light"></i>
                <p>Portfolio</p>
            </a>
            <a href="pages-list.html" class="col-4">
                <i data-feather="file" data-feather-line="1" data-feather-size="55" data-feather-color="brown1-dark" data-feather-bg="brown1-fade-light"></i>
                <p>Pages</p>
            </a>
            <a href="pages-appstyled-list.html" class="col-4">
                <i data-feather="smartphone" data-feather-line="1" data-feather-size="55" data-feather-color="magenta1-dark" data-feather-bg="magenta1-fade-light"></i>
                <p>AppStyled</p>
            </a>
            <a href="page-contact.html" class="col-4">
                <i data-feather="mail" data-feather-line="1" data-feather-size="55" data-feather-color="blue2-dark" data-feather-bg="blue2-fade-light"></i>
                <p>Contact</p>
            </a>
            <a href="tel:+1 234 567 8901" class="col-4">
                <i data-feather="phone" data-feather-line="1" data-feather-size="55" data-feather-color="green1-dark" data-feather-bg="green1-fade-light"></i>
                <p>Call Now</p>
            </a>
        </div>

        <div class="row mx-auto mt-2 mb-0" style="max-width:230px;">
            <div class="col-4">
                <a href="#" class="icon icon-l color-facebook rounded-xl mb-2"><i class="font-20 fab fa-facebook-f"></i></a>
            </div>
            <div class="col-4">
                <a href="#" class="icon icon-l color-twitter rounded-xl mb-2"><i class="font-20 fab fa-twitter"></i></a>
            </div>
            <div class="col-4">
                <a href="#" class="icon icon-l color-instagram rounded-xl mb-2"><i class="font-20 fab fa-instagram"></i></a>
            </div>
        </div>

        <p class="opacity-60 font-10">Copyright <span class="copyright-year"></span> Enabled. All rights reserved</p>


    </div>
</div>
@endsection