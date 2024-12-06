<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
@if(Session('AcessTokens'))
@php $user_id = Session('AcessTokens'); @endphp

@endif

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>{{$app_name = Session('app_name') ? Session('app_name'): "Grobiz App Builder"}}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('templates-assets/frontendweb/images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="apple-touch-icon" href="{{asset('templates-assets/frontendweb/images/apple-touch-icon.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/venobox/dist/venobox.min.css')}}" type="text/css"
        media="screen" />


    <link rel="stylesheet" type="text/css" href="{{asset('templates-assets/frontendweb/css/header_style.css')}}">
    <!--    <link rel="stylesheet" href=-->
    <!--"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


    <script src="{{asset('templates-assets/frontendweb/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/popper.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('templates-assets/frontendweb/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/inewsticker.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/bootsnav.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/images-loded.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/isotope.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/form-validator.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/contact-form-script.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('templates-assets/frontendweb/venobox/dist/venobox.min.js')}}"></script>

    <style>
        .search_input {
            width: 100%;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            /*background-color: #f8f9fa;*/
            background-image: url('../GrobizEcomm/images/img/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 10px 20px 9px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }



        #category_name {

            color: #121212;
            font-size: 1.25rem;
            text-align: center;
            font-family: Manrope, sans-serif;
            display: block;
            font-weight: bold;

        }


        /*Image Preview*/

        #output_image {
            max-width: 50%;
        }

        * {
            margin: 0;
            padding: 0;
        }


        .imgbox {
            display: grid;
            height: 100%;
        }

        .center-fit {
            max-width: 100%;
            max-height: 100vh;
            margin: auto;
        }

        .banner2 {

            width: 110%;

        }

        .navbar {
            /*background: #fff;*/
            padding-top: 0;
            padding-bottom: 0;
            box-shadow: 1px 3px 4px 0 #adadad33;
            z-index: 1200;
        }

        .navbar-light .navbar-brand {
            color: #2196F3;
        }

        .navbar-light .navbar-nav .nav-link {
            color: black;
        }

        .navbar-light .navbar-brand:focus,
        .navbar-light .navbar-brand:hover {
            /*color: #1ebdc2;*/
        }

        .navbar-light .navbar-nav .nav-link:focus,
        .navbar-light .navbar-nav .nav-link:hover {
            color: #fff;
        }

        .navbar-light .navbar-nav .nav-link {
            padding-top: 22px;
            padding-bottom: 22px;
            transition: 0.3s;
            padding-left: 24px;
            padding-right: 24px;
            font-size: 14px;
        }

        .navbar-light .navbar-nav .nav-link:focus,
        .navbar-light .navbar-nav .nav-link:hover {
            background: #1ebdc2;
            transition: 0.3s;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            color: #fff;
            text-decoration: none;
            background-color: #1ebdc2 !important;
        }

        .sm-menu {
            border-radius: 0px;
            border: 0px;
            top: 97%;
            box-shadow: rgba(173, 173, 173, 0.2) 1px 3px 4px 0px;
        }

        .dropdown-item {
            color: #3c3c3c;
            font-size: 14px;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #fff;
            text-decoration: none;
            background-color: #2196F3;
        }

        .navbar-toggler {
            outline: none !important;
        }

        .navbar-tog {
            color: #1ebdc2;
        }

        .megamenu-li {
            position: static;
        }

        .megamenu {
            position: absolute;
            width: 100%;
            left: 0;
            right: 0;
            padding: 15px;
        }

        .megamenu h6 {
            margin-left: 21px;
        }

        .megamenu i {
            width: 20px;
        }

        .col-xs-2 {
            background: #00f;
            color: #FFF;
        }

        .col-half-offset {
            margin-left: 4.166666667%
        }

        .switch_search input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch_search {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            margin-top: 13px;
        }

        .switch_toggle {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch_toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider_toggle {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider_toggle:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider_toggle {
            background-color: #2196F3;
        }

        input:focus+.slider_toggle {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider_toggle:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider_toggle.round {
            border-radius: 34px;
        }

        .slider_toggle.round:before {
            border-radius: 50%;
        }


        div.sticky {

            /*background-color: #c0c0c0;*/
            position: fixed;
            top: 305px;
            width: 100%;
            z-index: 100;
        }

        .show-cart li {
            display: flex;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            width: 200px;
            height: 200px;
            align-self: center;
        }


        @media (max-width:767px) {
            .mobile-no-float {
                float: none;
            }
        }

        .owl-nav .owl-next {
            position: absolute;
            top: 80px;
            background-color: #fff !important;

            padding: 20px !important;
            right: 0;
        }

        .owl-nav .owl-prev {
            position: absolute;
            top: 80px;
            background-color: #fff;

            padding: 20px !important;
            left: 0;

        }
    </style>

    <style>
        .login {
            position: fixed;
            z-index: 1200;
            display: none;
            /* Hidden by default */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);

        }

        .login .body {
            transition: all 2s ease-in;
            display: block;
            width: 720px;

            margin: 50px auto;
            border: 1px solid #dddd;
            border-radius: 18px;

            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;


            background-color: #fff;

        }

        .login .box-1 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login .box-2 {
            padding: 30px;
        }

        .login .box-1,
        .login .box-2 {
            width: 50%;
        }

        .login .h-1 {
            font-size: 24px;
            font-weight: 700;
        }

        .login .text-muted {
            font-size: 14px;
        }

        .login .box {
            width: 100px;
            height: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
            text-decoration: none;
            color: #615f5fdd;
        }

        .login .box:active,
        .login .box:visited {
            border: 2px solid #ee82ee;
        }

        .login .box:hover {
            border: 2px solid #ee82ee;
        }

        /*.login .btn.btn-primary {*/
        /*background-color: transparent;*/
        /*    color: #ee82ee;*/
        /*    border: 0px;*/
        /*    padding: 0;*/
        /*    font-size: 14px;*/
        /*}*/

        /*.login .btn.btn-primary .fas.fa-chevron-right {*/
        /*    font-size: 12px;*/
        /*}*/

        .login .footer .p-color {
            color: #ee82ee;
        }

        .login .footer.text-muted {
            font-size: 10px;
        }

        .login .fas.fa-times {
            position: absolute;
            top: 20px;
            right: 20px;
            height: 40px;
            width: 40px;

            font-size: 25px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .login .fas.fa-times:hover {
            color: #ff0000;
        }

        @media (max-width:767px) {
            .login {
                padding: 10px;
                width: 100%;
            }

            .login .body {
                width: 100%;
                height: 100%;
                overflow: scroll;
            }

            .login .box-1 {
                width: 100%;
                height: 230px;
            }

            .login .box-2 {
                width: 100%;

            }
        }

        #pageMessages {
            position: fixed;
            bottom: 15px;
            right: 15px;
            width: 30%;
            z-index: 1500;
        }

        .alert {
            position: relative;
        }

        .alert .close {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 1em;
        }

        .alert .fa {
            margin-right: .3em;
        }

        #login_messages {
            position: fixed;
            top: 15px;
            right: 15px;
            width: 30%;
            z-index: 1500;

        }

        #loading {
            position: fixed;
            display: block;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            opacity: 0.8;
            background-color: #fff;
            z-index: 1399;

        }

        #loading-img {
            position: absolute;
            top: 45%;
            left: 45%;
            height: 80px;
            z-index: 1400;
            opacity: 1;
        }

        #overlay {
            position: fixed;
            /* Sit on top of the page content */
            display: none;
            /* Hidden by default */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
            z-index: 1499;
            /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;
            /* Add a pointer on hover */
        }

        @media (max-width:767px) {

            #pageMessages,
            #login_messages {
                /* width:90%;
        top: 15px; */
            }

        }

        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0 !important;
            /* remove the gap so it doesn't close */
        }

        .search_input_control:focus {
            border-color: #ced4da;
            box-shadow: none;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>


</head>

<body>
    <div id="loading">
        <img id="loading-img" src="{{asset('images/loading.svg')}}">

    </div>

    <div id="overlay"></div>

  <nav class="navbar navbar-expand-lg bg-white sticky-top py-3">

    <button class="navbar-toggler" style="color:#3c3c3c; font-size:30px" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        &#9776;
    </button>

    <a href="{{ url(Session('main')) }}" class="navbar-brand">
        @if(Session('logo'))
            <img class="img-fluid" style="height: 50px;"
                src="{{ asset('images/logos/'. Session('logo')) }}">
        @else
            {{ Session('app_name') }}
        @endif
    </a>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <form action="{{ url(Session('main').'/search') }}" method="GET" id="searchForm" class="mr-3 my-2">
            <div class="input-group">
                <input type="text" class="form-control search_input_control" name="search" style="border-right:0px"
                    placeholder="Search products, category, brand" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent cursor-pointer" onclick="document.getElementById('searchForm').submit()"
                        style="border-left: 0px" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
            </div>
        </form>

       <div class="row">
        <div class="col-6 pl-5">
            <ul class="navbar-nav pl-5">
                @if(Session::has('AccessTokens'))
                    @php
                        $user_name = Session::get('user_name');
                        $user_no = Session::get("user_no");
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('templates-assets/frontendweb/images/admin.jpg') }}" alt="User" style="width: 50px;">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <a class="dropdown-item" href="{{ url('#') }}">Item 1</a>
                            <a class="dropdown-item" href="{{ url('#') }}">Item 2</a> --}}
                            <a class="dropdown-item" href="{{ url('profile-user') }}">My Profile</a>
                            <a class="dropdown-item" href="{{ url(Session('main') .'/user-address') }}">My Address</a>
                            <a class="dropdown-item" href="{{ url('my_orders') }}">My Orders</a>
                            <a class="dropdown-item" href="{{ url('wishlist_products') }}">Wishlist Products</a>
                            <a class="dropdown-item" href="{{ url('logout_user') }}">Logout</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="login_btn">
                            <button class="btn btn-info">Login</button>
                        </a>
                    </li>
                @endif
            </ul>
           </div>

            <div class="nav-item col-6">
                <a class="nav-link" href="{{ url(Session('main').'/cart') }}">
                    <button type="button" class="btn btn-info">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                        <span class="badge badge-pill badge-danger">{{ count(Session::get('cart', [])) }}</span>
                    </button>
                </a>
            </div>
       </div>

    </div>

</nav>

    <div class="col-sm-12 col-md-12 col-lg-12">
        @yield('content')
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12" style="height: 50px">
    </div>
    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About
                                <?php foreach ($business_details as $bdetails) { ?>
                                <?php echo $bdetails['business_name'] ?>
                                <?php } ?>
                            </h4>

                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="{{url(Session('main').'/about-us')}}">About Us</a></li>
                                <li><a href="{{url(Session('main').'/faqs')}}">Faq's</a></li>
                                <li><a href="{{url(Session('main').'/term-condition')}}">Terms &amp; Conditions</a></li>
                                <li><a href="{{url(Session('main').'/privacy-policy')}}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>



                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            @if(!empty($contact_details))

                            @foreach($contact_details as $cdetails)

                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address:{{$cdetails->address}}</p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a
                                            href="tel:{{$cdetails->contact}}">{{$cdetails->contact}}</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a
                                            href="mailto:{{$cdetails->email}}">{{$cdetails->email}}</a></p>
                                </li>
                            </ul>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2022 <a href="#">{{Session('app_name')}}</a></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>


    <!-- Modal -->
    <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="show-cart table">
                    </table>

                    <div>Total price: Rs. <span class="total-cart"></span></div>

                </div>
                <div class="modal-footer">
                    <button class="clear-cart btn btn-danger">Clear Cart</button>
                    <button type="button" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </div>
    </div>








    <div class="login">
        <div class="body d-md-flex align-items-center justify-content-between position-relative">
            <span class="fas fa-times" onclick="hide_login()"></span>
            <div class="box-1 mt-md-0 mt-5">
                <img src="{{asset('images/login.jpg')}}" class="" alt="">
            </div>
            <div class=" box-2 d-flex flex-column h-100">

                <div class="mt-5 login_info">

                    <p class="mb-1 h-1">Login</p>
                    <p class="text-muted mb-2">Login and enjoy your shopping!</p>
                    <div class="d-flex flex-column ">

                        <div class="d-flex align-items-center">
                            {!! Form::open(['method' => 'POST', 'url' => 'storelogin', 'enctype' =>
                            'multipart/form-data']) !!}
                            @include('templates.frontend.messages')
                            <div class="form-group">
                                <label for="number">Mobile Number</label>
                                <input id="contact" type="number" class="form-control" name="contact" value="" required
                                    autofocus />
                                <div class="invalid-feedback">number is invalid</div>
                            </div>

                            <div class="form-group">
                                <label for="number">Password</label>

                                <input id="password" type="password" class="form-control" name="password" required
                                    data-eye />

                                <a href="{{url('forgot-password')}}" style="color:blue" class="float-right py-1">
                                    Forgot Password?
                                </a>
                                <!--</label>-->
                                <div class="invalid-feedback">Password is required</div>
                            </div>


                            <div class="form-group my-5">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>
                            </div>
                            <div class="mt-3">
                                <p class="mb-0 text-muted">Do not have an account? <button
                                        style="color:blue; background:transparent" onclick="show_register()">Register
                                        now</button></p>

                            </div>
                        </div>
                    </div>
                    <div class="mt-auto">

                    </div>
                    </form>

                </div>


            </div>
        </div>
    </div>

    <div class="login_details" style="display:none">
        <p class="mb-1 h-1">Login</p>
        <p class="text-muted mb-2">Login and enjoy your shopping!</p>
        <div class="d-flex flex-column ">

            <div class="d-flex align-items-center">
                {!! Form::open(['method' => 'POST', 'url' => 'storelogin', 'enctype' => 'multipart/form-data']) !!}
                @include('templates.frontend.messages')
                <div class="form-group">
                    <label for="number">Mobile Number</label>
                    <input id="contact" type="number" class="form-control" name="contact" value="" required autofocus />
                    <div class="invalid-feedback">number is invalid</div>
                </div>

                <div class="form-group">
                    <label for="number">Password</label>

                    <input id="password" type="password" class="form-control" name="password" required data-eye />

                    <a href="{{url('forgot-password')}}" style="color:blue" class="float-right py-1">
                        Forgot Password?
                    </a>
                    <!--</label>-->
                    <div class="invalid-feedback">Password is required</div>
                </div>


                <div class="form-group my-5">
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>
                </div>
                <div class="mt-3">
                    <p class="mb-0 text-muted">Do not have an account? <button
                            style="color:blue; background:transparent" onclick="show_register()">Register now</button>
                    </p>

                </div>
            </div>
        </div>
        <div class="mt-auto">

        </div>
        </form>
    </div>

    <div class="register_info" style="display:none">
        @include('templates.frontend.messages')
        <p class="mb-1 h-1">Create an account</p>
        <p class="text-muted mb-2">Create account and enjoy your shopping!</p>
        <!--<form method="POST" class="my-login-validation" novalidate="">-->
        {!! Form::open(['method' => 'POST', 'url' => 'store-user', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" class="form-control" name="name" required autofocus />
            <div class="invalid-feedback">What's your name?</div>
        </div>
        <div class="form-group d-none">
            <label for="select" class=" form-control-label">Select Country</label>
            <select name="country_code" id="country_code" class="form-control">
                <option value="">Please select</option>
                @if(!empty($get_country_details))

                @foreach($get_country_details as $country)
                <option value="{{$country->country_code}}">{{$country->country_name}}</option>

                @endforeach
                @endif
            </select>
            <div class="invalid-feedback">Country code is invalid</div>
        </div>
        <div class="form-group">
            <label for="number">Mobile Number</label>
            <input id="contact" type="number" class="form-control" name="contact" required />
            <div class="invalid-feedback">Your number is invalid</div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" required data-eye />
            <div class="invalid-feedback">Email is required</div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required data-eye />
            <div class="invalid-feedback">Password is required</div>
        </div>


        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="agree" id="agree">
            <label class="form-check-label" for="agree">I agree to the <a href="{{url('term-conditions')}}">Terms and
                    Conditions</a></label>
            <div class="invalid-feedback">
                You must agree with our Terms and Conditions
            </div>
        </div>



        <div class="form-group m-0">
            <button type="submit" class="btn btn-primary btn-block">
                Register
            </button>
        </div>
        <div class="mt-4 text-center">
            Already have an account? <button onclick="toggle_login()"
                style="color:blue; background:transparent">Login</button>
        </div>
        </form>
    </div>


    <div id="pageMessages">
    </div>
    <div id="login_messages">

    </div>

    <div class="clearfix"></div>

    <script>
        function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
      var iconMap = {
        info: "fa fa-info-circle",
        success: "fa fa-thumbs-up",
        warning: "fa fa-exclamation-triangle",
        danger: "fa ffa fa-exclamation-circle"
      };

      var iconAdded = false;

      var alertClasses = ["alert", "animated", "flipInX"];
      alertClasses.push("alert-" + severity.toLowerCase());

      if (dismissible) {
        alertClasses.push("alert-dismissible");
      }

      var msgIcon = $("<i />", {
        "class": iconMap[severity] // you need to quote "class" since it's a reserved keyword
      });

      var msg = $("<div />", {
        "class": alertClasses.join(" ") // you need to quote "class" since it's a reserved keyword
      });

      if (title) {
        var msgTitle = $("<h4 />", {
          html: title
        }).appendTo(msg);

        if (!iconAdded) {
          msgTitle.prepend(msgIcon);
          iconAdded = true;
        }
      }

      if (summary) {
        var msgSummary = $("<strong />", {
          html: summary
        }).appendTo(msg);

        if (!iconAdded) {
          msgSummary.prepend(msgIcon);
          iconAdded = true;
        }
      }

      if (details) {
        var msgDetails = $("<p />", {
          html: details
        }).appendTo(msg);

        if (!iconAdded) {
          msgDetails.prepend(msgIcon);
          iconAdded = true;
        }
      }


      if (dismissible) {
        var msgClose = $("<span />", {
          "class": "close", // you need to quote "class" since it's a reserved keyword
          "data-dismiss": "alert",
          html: "<i class='fa fa-times-circle'></i>"
        }).appendTo(msg);
      }

      $('#' + appendToId).prepend(msg);

      if (autoDismiss) {
        setTimeout(function() {
          msg.addClass("flipOutX");
          setTimeout(function() {
            msg.remove();
          }, 1000);
        }, 5000);
      }
    }
    </script>

    @if (Session('success'))
    <script>
        createAlert("Product Added to cart", "Product has been added to cart successfully, go to cart to view", "", "success", "true", "true", "pageMessages")
    </script>
    @endif

    @if (Session('login_success'))
    <script>
        createAlert("Logged In", "You have been succesfully logged in, enjoy shopping!!", "Wecolme back, Happy Shopping", "success", "true", "true", "login_messages")
    </script>
    @endif

    @if (Session('register_success'))
    <script>
        createAlert("Account Created", "Congratulations, you have been registerd succesfully!!", "Wecolme, Happy Shopping", "success", "true", "true", "login_messages")
    </script>
    @endif

    @if (Session('remove_sucess'))
    <script>
        createAlert("Removed from Cart", "Product has been removed from cart", "", "warning", "true", "true", "pageMessages")
    </script>
    @endif

    <script>
        // ************************************************
    // Shopping Cart API
    // ************************************************

    var shoppingCart = (function() {
      // =============================
      // Private methods and propeties
      // =============================
      cart = [];

      // Constructor
      function Item(name, price, count) {
        this.name = name;
        this.price = price;
        this.count = count;
      }

      // Save cart
      function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
      }

      // Load cart
      function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
      }
      if (sessionStorage.getItem("shoppingCart") != null) {
        loadCart();
      }


      // =============================
      // Public methods and propeties
      // =============================
      var obj = {};

      // Add to cart
      obj.addItemToCart = function(name, price, count) {
        for (var item in cart) {
          if (cart[item].name === name) {
            cart[item].count++;
            saveCart();
            return;
          }
        }
        var item = new Item(name, price, count);
        cart.push(item);
        saveCart();
      }
      // Set count from item
      obj.setCountForItem = function(name, count) {
        for (var i in cart) {
          if (cart[i].name === name) {
            cart[i].count = count;
            break;
          }
        }
      };
      // Remove item from cart
      obj.removeItemFromCart = function(name) {
        for (var item in cart) {
          if (cart[item].name === name) {
            cart[item].count--;
            if (cart[item].count === 0) {
              cart.splice(item, 1);
            }
            break;
          }
        }
        saveCart();
      }

      // Remove all items from cart
      obj.removeItemFromCartAll = function(name) {
        for (var item in cart) {
          if (cart[item].name === name) {
            cart.splice(item, 1);
            break;
          }
        }
        saveCart();
      }

      // Clear cart
      obj.clearCart = function() {
        cart = [];
        saveCart();
      }

      // Count cart
      obj.totalCount = function() {
        var totalCount = 0;
        for (var item in cart) {
          totalCount += cart[item].count;
        }
        return totalCount;
      }

      // Total cart
      obj.totalCart = function() {
        var totalCart = 0;
        for (var item in cart) {
          totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
      }

      // List cart
      obj.listCart = function() {
        var cartCopy = [];
        for (i in cart) {
          item = cart[i];
          itemCopy = {};
          for (p in item) {
            itemCopy[p] = item[p];

          }
          itemCopy.total = Number(item.price * item.count).toFixed(2);
          cartCopy.push(itemCopy)
        }
        return cartCopy;
      }

      // cart : Array
      // Item : Object/Class
      // addItemToCart : Function
      // removeItemFromCart : Function
      // removeItemFromCartAll : Function
      // clearCart : Function
      // countCart : Function
      // totalCart : Function
      // listCart : Function
      // saveCart : Function
      // loadCart : Function
      return obj;
    })();


    // *****************************************
    // Triggers / Events
    // *****************************************
    // Add item
    $('.add-to-cart').click(function(event) {
      event.preventDefault();
      var name = $(this).data('name');
      var price = Number($(this).data('price'));
      shoppingCart.addItemToCart(name, price, 1);
      displayCart();
    });

    // Clear items
    $('.clear-cart').click(function() {
      shoppingCart.clearCart();
      displayCart();
    });


    function displayCart() {
      var cartArray = shoppingCart.listCart();
      var output = "";
      for (var i in cartArray) {
        output += "<tr>" +
          "<td>" + cartArray[i].name + "</td>" +
          "<td>(" + cartArray[i].price + ")</td>" +
          "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>" +
          "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>" +
          "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>" +
          "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>" +
          " = " +
          "<td>" + cartArray[i].total + "</td>" +
          "</tr>";
      }
      $('.show-cart').html(output);
      $('.total-cart').html(shoppingCart.totalCart());
      $('.total-count').html(shoppingCart.totalCount());
    }

    // Delete item button

    $('.show-cart').on("click", ".delete-item", function(event) {
      var name = $(this).data('name')
      shoppingCart.removeItemFromCartAll(name);
      displayCart();
    })


    // -1
    $('.show-cart').on("click", ".minus-item", function(event) {
      var name = $(this).data('name')
      shoppingCart.removeItemFromCart(name);
      displayCart();
    })
    // +1
    $('.show-cart').on("click", ".plus-item", function(event) {
      var name = $(this).data('name')
      shoppingCart.addItemToCart(name);
      displayCart();
    })

    // Item count input
    $('.show-cart').on("change", ".item-count", function(event) {
      var name = $(this).data('name');
      var count = Number($(this).val());
      shoppingCart.setCountForItem(name, count);
      displayCart();
    });

    displayCart();


    function hide_login() {
      $(".login").hide();
    }
    $("#login_btn").click(function(e) {
      e.preventDefault();
      if ($(".login").css("display") == "none") {
        $(".login").show();
      }
    })

    function show_login() {
      if ($(".login").css("display") == "none") {
        $(".login").show();
      }
    }


    function show_register() {

      $(".login_info").html($(".register_info").html());
    }

    function toggle_login() {

      $(".login_info").html($(".login_details").html());
    }
    </script>

    <script>
        $('.document').ready(function() {

      $(window).scroll(function(e) {
        var $el = $('.sticky');
        var isPositionFixed = ($el.css('position') == 'fixed');
        if ($(this).scrollTop() > 200 && !isPositionFixed) {
          $el.css({
            'position': 'fixed',
            'top': '0px',
            'background': 'red'
          });
        }
        if ($(this).scrollTop() < 200 && isPositionFixed) {
          $el.css({
            'position': 'static',
            'top': '0px',
            'background': 'none'
          });
        }
      });



      $(".switch_search input").prop('checked', false);

      $(".switch_search input").on("change", function(e) {
        const isOn = e.currentTarget.checked;

        if (isOn) {
          window.open('https://gruzen.in/GrobizEcomm/ecommerce_admin', '_self');

        }

      });



      $('.navbar-light .dmenu').hover(function() {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
      }, function() {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
      });


      $(".megamenu").on("click", function(e) {
        e.stopPropagation();
      });

      $('.owl-carousel').owlCarousel({

        autoplay: true,
        margin: 15,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
          0: {
            items: 2,
            loop: true
          },
          600: {
            items: 3

          },
          700: {
            items: 4
          },
          1000: {
            items: 6
          }
        }
      })



      $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;

      });

      $("#add_button").click(function() {

        var token = "{{ csrf_token() }}";

        var category_name = $('.category_name').val();





        //   alert(category_name);alert(category_image);die;



        $.ajax({

          url: "<?php echo route('add_main_category'); ?>",

          method: 'POST',

          data: {
            '_token': token,

            'category_name': category_name,
            'category_image': category_image,
          },

          dataType: "html",

          success: function(data) {

            alert(data);

            $("#sub_category_auto_id").html(data);

          }

        });
      });


    });

    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }


    $("#zip").keyup(function() {
      var el = $("#zip");
      if (el.val().length === 6) {
        $("#zip").css("border-color", "grey");
        $("#zip_error").hide();
        $.get({
          url: "https://api.postalpincode.in/pincode/" + el.val(),
          dataType: "json",
          success: function(data) {
            if (data[0].Status == "Success") {
              $("#state").val(data[0].PostOffice[0].State);
              $("#city").val(data[0].PostOffice[0].Block);

            }
          }
        })
      } else {
        $("#state").val("");
        $("#city").val("");
        $("#zip_error").show();
        $("#zip").css("border-color", "red");
      }
    });



    $(window).on('load', function() {
      $('#loading').hide();
    })
    </script>
    @if (Session('show_login'))
    <script>
        show_login();
    </script>
    @endif

    @if (Session('show_register'))
    <script>
        show_register()
    show_login();
    </script>
    @endif

    <script>
        new VenoBox({
      numeration: true,
      navigation: true
    });
    function toggleNavbarMethod() {
    if ($(window).width() > 992) {
       $(".dropdown-toggle").removeAttr("data-toggle");
       $(".dropdown-toggle").attr("data-hover", "dropdown")
    }else
    {
      $(".dropdown-toggle").removeAttr("data-hover");
       $(".dropdown-toggle").attr("data-toggle", "dropdown")
    }
}
$(document).ready(function()

{
  toggleNavbarMethod();
})
$(window).resize(toggleNavbarMethod);
    </script>

</body>

</html>