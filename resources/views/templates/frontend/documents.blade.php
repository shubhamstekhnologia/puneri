<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>


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

</head>
<body>

<section>
    <div class="container">
        <div class="row justify-content-md-center h-100" style="margin:100px 0px 50px 0px;">
            <div class="card-wrapper">

                <div class="container-fluid">
                    <div >

                        <div class="alert alert-success">Upload the documents and wait for admin approval</div>

                        @include('templates.frontend.messages')

                        <h3 class="card-title" style="margin:auto;">Upload Documents</h3>
                        <!--<form method="POST" class="my-login-validation" novalidate="">-->
                        {!! Form::open(['method' => 'POST', 'url' => 'store_document', 'enctype' =>
                        'multipart/form-data'])
                        !!}
                        <div class="form-group">
                            <label for="aadhar_docs">Adhar Card: @if ($adhar_status == 'reupload') <span class="text-danger"> <strong>Rejected</strong> Upload Again</span> @endif</label>
                            @if ($adhar_status == 'verified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-success"> Verified</strong></span>

                            @elseif ($adhar_status == 'unverified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-warning"> Pending</strong></span>

                            @else

                            <input id="aadhar_docs" type="file" class="form-control" name="aadhar_docs" required autofocus />
                            <div class="invalid-feedback">Select valid file..!</div>

                            @endif

                        </div>

                        <div class="form-group">
                            <label for="pan_card_doc">Pan Card: @if ($pan_status == 'reupload') <span class="text-danger"> <strong>Rejected</strong> Upload Again</span>  @endif</label>

                            @if ($pan_status == 'verified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-success"> Verified</strong></span>

                            @elseif ($pan_status == 'unverified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-warning"> Pending</strong></span>

                            @else

                            <input id="pan_card_doc" type="file" class="form-control" name="pan_card_doc" required />
                            <div class="invalid-feedback">Select valid file..!</div>

                            @endif

                        </div>

                        <div class="form-group">
                            <label for="shop_act_docs">Shop Act Doc: @if ($act_status == 'reupload') <span class="text-danger"> <strong>Rejected</strong> Upload Again</span>  @endif</label>

                            @if ($act_status == 'verified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-success"> Verified</strong></span>

                            @elseif ($act_status == 'unverified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-warning"> Pending</strong></span>

                            @else
                            <input id="shop_act_docs" type="file" class="form-control" name="shop_act_docs" required />
                            <div class="invalid-feedback">Select valid file..!</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fssai_docs_certificate">FSSAI Certificate: @if ($fssai_status == 'reupload') <span class="text-danger"><strong>Rejected</strong> Upload Again</span>  @endif</label>

                            @if ($fssai_status == 'verified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-success"> Verified</strong></span>

                            @elseif ($fssai_status == 'unverified')

                            <span> <span class="text-success"> Uploaded</span><strong class="text-warning"> Pending</strong></span>

                            @else

                            <input id="fssai_docs_certificate" type="file" class="form-control"
                                name="fssai_docs_certificate" required />
                            <div class="invalid-feedback">Select valid file..!</div>

                            @endif

                        </div>

                        <div class="form-group m-0">
                            @if($submit == 'true')
                            <button type="submit" class="btn btn-primary btn-block">
                                Submit
                            </button>
                            @endif
                        </div>
                        <div class="mt-4 text-center">
                            <strong class="text-info">Wait for admin approval</strong> | <a href="{{url('login')}}">Login</a>
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