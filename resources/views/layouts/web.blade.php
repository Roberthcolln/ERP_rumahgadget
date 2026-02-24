<?php

use Illuminate\Support\Facades\DB;

$konf = DB::table('setting')->first();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $konf->instansi_setting }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ $konf->keyword_setting }}" name="keywords">
    <meta content="{{ $konf->tentang_setting }}" name="description">

    <!-- Favicon -->
    <link href="{{ asset('logo/'.$konf->logo_setting) }}" rel="icon">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">



    <!-- Libraries Stylesheet -->
    <link href="{{ asset ('web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('web/lib/animate/animate.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset ('web/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset ('web/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>{{$konf->alamat_setting}}</small>
                    <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>{{$konf->no_hp_setting}}</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>{{$konf->email_setting}}</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">

                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://wa.me/{{$konf->no_hp_setting}}" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="{{$konf->instagram_setting}}"><i class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href="{{$konf->youtube_setting}}"><i class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="{{url ('/')}}" class="navbar-brand p-0">
                <div style="background-color: white; padding: 5px; border-radius: 5px;">
                    <img src="{{ asset('logo/'.$konf->logo_setting) }}" alt="Logo" style="height: 40px;">
                </div>
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link">Homepage</a>
                    <a href="{{ url('/') }}#about" class="nav-item nav-link">About Us</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Explore</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ url('/') }}#produk" class="dropdown-item">Product</a>
                            <a href="{{ url('/') }}#service" class="dropdown-item">Services</a>
                            
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Portfolio</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ url('/') }}#global" class="dropdown-item">Global Presence</a>
                            <a href="{{ url('/') }}#30years" class="dropdown-item">Proven Success</a>
                            <a href="{{ url('/') }}#feature" class="dropdown-item">Feature</a>
                            <a href="{{ url('/') }}#project" class="dropdown-item">Project</a>
                            <a href="{{ url('/') }}#partner" class="dropdown-item">Partner</a>
                            <a href="{{ url('/') }}#article" class="dropdown-item">Article</a>
                            <a href="{{ url('/') }}#testimonial" class="dropdown-item">Testimonial</a>
                        </div>
                    </div>
                    
                    


                    <a href="{{ url('kontak') }}" class="nav-item nav-link">Contact</a>
                </div>

                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                <a href="{{ url('login') }}" class="btn btn-primary py-2 px-4 ms-3">Login</a>
            </div>
        </nav>
        @yield('isi')

        @yield('content')

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                            <a href="index.html" class="navbar-brand">
                                <img src="{{ asset('logo/'.$konf->logo_setting) }}" style="width: 50%;" alt="">
                            </a>
                            <p class="mt-3 mb-4">Tradisco is a prominent holding company, tech provider, and consulting firm with a rich legacy rooted in latest development from energy and natural resources. Over three decades, Tradisco has evolved to become a leader in tech and investment infrastructure, driving innovation across diverse industries. </p>
                            
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="row gx-5">
                            <div class="col-lg-4 col-md-12 pt-5 mb-5">
                                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                    <h3 class="text-light mb-0">Get In Touch</h3>
                                </div>
                                <div class="d-flex mb-2">
                                    <i class="bi bi-geo-alt text-primary me-2"></i>
                                    <p class="mb-0">{{$konf->alamat_setting}}</p>
                                </div>
                                <div class="d-flex mb-2">
                                    <i class="bi bi-envelope-open text-primary me-2"></i>
                                    <p class="mb-0">{{$konf->email_setting}}</p>
                                </div>
                                <div class="d-flex mb-2">
                                    <i class="bi bi-telephone text-primary me-2"></i>
                                    <p class="mb-0">{{$konf->no_hp_setting}}</p>
                                </div>
                                <div class="d-flex mt-4">
                                    <a class="btn btn-primary btn-square me-2" href="https://wa.me/{{$konf->no_hp_setting}}"><i class="fab fa-whatsapp"></i></a>
                                    <a class="btn btn-primary btn-square me-2" href="{{$konf->youtube_setting}}"><i class="fab fa-youtube fw-normal"></i></a>
                                    <a class="btn btn-primary btn-square" href="{{$konf->instagram_setting}}"><i class="fab fa-instagram fw-normal"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                    <h3 class="text-light mb-0">Quick Links</h3>
                                </div>
                                <div class="link-animated d-flex flex-column justify-content-start">
                                    <a class="text-light mb-2" href="{{ url('/') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Homepage</a>
                                    <a class="text-light mb-2" href="{{ url('/') }}#about"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                                    <a class="text-light mb-2" href="{{ url('/') }}#product"><i class="bi bi-arrow-right text-primary me-2"></i>Product</a>
                                    <a class="text-light mb-2" href="{{ url('/') }}#service"><i class="bi bi-arrow-right text-primary me-2"></i>Service</a>
                                    <a class="text-light" href="{{ url('kontak') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                                    <a class="text-light" href="{{ url('/') }}#article"><i class="bi bi-arrow-right text-primary me-2"></i>Article</a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                    <h3 class="text-light mb-0">Popular Links</h3>
                                </div>
                                <div class="link-animated d-flex flex-column justify-content-start">
                                    <a class="text-light mb-2" href="{{ url('/') }}#global"><i class="bi bi-arrow-right text-primary me-2"></i>Global Presence</a>
                                    <a class="text-light mb-2" href="{{ url('/') }}#30years"><i class="bi bi-arrow-right text-primary me-2"></i>Proven Success</a>
                                    <a class="text-light mb-2" href="{{ url('/') }}#feature"><i class="bi bi-arrow-right text-primary me-2"></i>Feature</a>
                                    <a class="text-light mb-2" href="{{ url('/') }}#project"><i class="bi bi-arrow-right text-primary me-2"></i>Project</a>
                                    <a class="text-light mb-2" href="{{ url('/') }}#partner"><i class="bi bi-arrow-right text-primary me-2"></i>Partner</a>
                                    <a class="text-light" href="{{ url('/') }}#testimonial"><i class="bi bi-arrow-right text-primary me-2"></i>Testimonial</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-white" style="background: #061429;">
            <div class="container text-center">
                <div class="row justify-content-end">
                    <div class="col-lg-8 col-md-6">
                        <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                            <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">{{$konf->instansi_setting}}</a>. All Rights Reserved.
                                <img src="{{ asset('logo/'.$konf->logo_setting) }}" style="width: 5%;" alt="">
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset ('web/lib/wow/wow.min.js' ) }}"></script>
        <script src="{{ asset ('web/lib/easing/easing.min.js' ) }}"></script>
        <script src="{{ asset ('web/lib/waypoints/waypoints.min.js' ) }}"></script>
        <script src="{{ asset ('web/lib/counterup/counterup.min.js' ) }}"></script>
        <script src="{{ asset ('web/lib/owlcarousel/owl.carousel.min.js' ) }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset ('web/js/main.js' ) }}"></script>
</body>

</html>