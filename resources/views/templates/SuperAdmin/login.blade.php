<!doctype html>
<html class="no-js" lang=""> <!--<![endif]-->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="description" content="Admin">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('templates-assets/OrganicSuperAdminWeb/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates-assets/OrganicSuperAdminWeb/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates-assets/OrganicSuperAdminWeb/css/main.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet'>
</head>
<body style=" background-color: thistle;">
    <div class="login">
        <div class="col-lg-12" style="text-align: center;">
            <div class="logo">
                <a class="navbar-brand" href="dashboard"><!--<img src="{{asset('templates-assets/myadminweb/images/homelogo.png')}}" alt="Logo"> --></a>
            </div>
            
            <div class="card">
                <p>Sign in to continue to Admin</p>
                <div class="card-body card-block">
                    @if (Session::has('message'))
                            <div class="alert alert-warning">{{ Session::get('message') }}</div>
                            @endif
                    <form action="{{url('check_login')}}" method="post" >
                        @csrf
                        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" id="username" name="username" placeholder="Username" class="form-control" value="{{old('username')}}"><br/>
                                <small class="text-danger">{{ $errors->first('username') }}</small>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control"><br/>
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            </div>
                        </div>

                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-success btn-sm" id="btnlogin">SIGN IN</button>
                        </div>                       
                    </form>
                   <!--  <a href="#">Forgot Password?</a> -->
                </div>
            </div>
            <br/>

        </div>
    </div>
</body>
</html>