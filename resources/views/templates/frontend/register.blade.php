<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
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
    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    .card-wrapper {
        max-width: 400px; /* Adjust this as needed */
        width: 100%;
        margin: auto;
        padding: 20px;
    }
    /* Add media query for smaller screens */
    @media (max-width: 768px) {
        .card-wrapper {
            max-width: 90%; /* Adjust this as needed */
        }
    }
</style>
</head>
<body>

<section>
    <div class="container">
        <div class="row justify-content-md-center h-100" style="margin:100px 0px 50px 0px;">
            <div class="card-wrapper">
                <!-- <div class="brand">
              <img src="img/logo.jpg" alt="login page" />
            </div>-->
                <div class="card fat">
                    <div class="card-body">
                        @include('templates.frontend.messages')
                        <h3 class="card-title" style="margin:auto;">Register User</h3>
                        <!--<form method="POST" class="my-login-validation" novalidate="">-->
                        {!! Form::open(['method' => 'POST', 'url' => 'store-user', 'enctype' => 'multipart/form-data'])
                        !!}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" name="name" required autofocus />
                            <div class="invalid-feedback">What's your name?</div>
                        </div>

                        {{-- <div class="form-group d-none">
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
                        </div> --}}

                        <div class="form-group">
                            <label for="number">Mobile Number</label>
                            <input id="contact" type="number" class="form-control" name="contact" value="{{$mobile_number}}" readonly required />
                            <div class="invalid-feedback">Your number is invalid</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required data-eye />
                            <div class="invalid-feedback">Email is required</div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                data-eye />
                            <div class="invalid-feedback">Password is required</div>
                        </div> --}}

                        <div class="form-group">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" name="agree" id="agree" class="custom-control-input" required />
                                <label for="agree" class="custom-control-label">
                                   <span style="margin-left: 25px"> I agree to the</span>
                                   <br>
                                    <a style="color: blue;" href="{{url('puneri/term-condition')}}">Terms and Conditions</a>
                                </label>
                                <div class="invalid-feedback">
                                    You must agree with our Terms and Conditions
                                </div>
                            </div>

                        </div>

                        <div class="form-group m-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                Register
                            </button>
                        </div>
                        <div class="mt-4 text-center">
                            Already have an account? <a href="{{url('login')}}">Login</a>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</body>
</html>

<script>
    $(document).ready(function() {
     const userAction = async () => {
const response = await fetch('https://api.first.org/data/v1/countries?region=africa&limit=3&pretty=true');
  const myJson = await response.json(); //extract JSON from the http response
  // do something with myJson
  console.log("Function ran");

}

})
</script>

{{-- @endsection --}}