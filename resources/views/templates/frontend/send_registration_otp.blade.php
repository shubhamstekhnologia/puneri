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
    .login {
        position: fixed;
        z-index: 1200;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        /* Center vertically */
        justify-content: center;
        /* Center horizontally */
    }

    .login .body {
        transition: all 2s ease-in;
        display: block;
        width: 750px;

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
        width: 100%;
        /* Set the width to 100% */
        height: auto;
        /* Set height to auto */
    }

    .login .box-1,
    .login .box-2 {
        width: 100%;
    }

    /* @media (max-width:767px) {
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
    } */

    @media (max-width: 767px) {
        .login .body {
            flex-direction: column;
            /* Stack elements vertically */
            width: 100%;
            /* Adjust width as needed */
            height: auto;
            /* Allow height to adjust based on content */
        }

        .login .box-1 img {
            height: 230px;
            /* Set height as needed */
        }

        .login .box-2 {
            padding: 20px;
            /* Adjust padding as needed */
        }

        .login .form-group {
            margin-bottom: 20px;
            /* Adjust margin as needed */
        }
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
            height: 250px;
        }

        .login .box-2 {
            width: 100%;

        }
    }
</style>


<section>

    <div class="login">
        <div class="body d-md-flex align-items-center justify-content-between position-relative">
            <div class="box-1 mt-md-0 mt-5">
                <img src="https://gruzen.in/Puneri_Amruttulya/images/logos/1000077067.jpg" class="p-5" alt="">
            </div>
            <div class="box-2 d-flex flex-column h-auto">

                <div class="mt-5 login_info text-black">

                    <p class="mb-1 h-1">Verify Mobile Number</p>
                    <p class="text-muted mb-2">Login and enjoy your shopping!</p>
                    <div class="d-flex flex-column ">

                        <div class="d-flex align-items-center">
                            {!! Form::open(['method' => 'POST', 'url' => 'send_registration_otp', 'enctype' => 'multipart/form-data']) !!}

                            @csrf
                            @if ($success ?? '' != '')
                            <div class="alert alert-success">{{ $success }}</div>
                            @endif
                            @if ($error ?? '' != '')
                            <div class="alert alert-danger">{{ $error }}</div>
                            @endif

                            <div class="form-group">
                                <label for="mobile_number">Mobile Number</label>
                                <input id="mobile_number" type="tel" class="form-control" name="mobile_number" value="" required
                                pattern="[0-9]{10}" title="Please enter a 10-digit valid number"  autofocus />
                                <div class="invalid-feedback">number is invalid</div>
                            </div>

                            <div class="form-group my-5">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Send Otp
                                </button>
                            </div>
                            <div class="mt-3">
                                <p class="mb-0 text-muted">  Already have an account? <a href="{{url('login')}}">Login</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <p class="footer text-muted mb-0 mt-md-0 mt-4">By register you agree with our
                            <span class="p-color me-1">terms and conditions</span>and
                            <span class="p-color ms-1">privacy policy</span>
                        </p>
                    </div>
                    {!! Form::close() !!} <!-- Close the form tag here -->

                </div>


            </div>
        </div>
    </div>

</section>