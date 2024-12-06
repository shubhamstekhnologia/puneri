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
    <!-- Data tables  -->
    <link rel="stylesheet" href="{{asset('templates-assets/OrganicSuperAdminWeb/css/dataTables.bootstrap.min.css')}}">
    <!--<script src="{{asset('templates-assets/myadminweb/js/jquery-2.1.4.min.js')}}"></script> -->
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/ajax.js')}}"></script>
</head>
<body style="background: #f1f2f7 !important;">
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand"  href="#"><!--<img src="{{asset('templates-assets/myadminweb/images/logo.png')}}" alt="Logo"> -->Grobiz E-Commerce</a>
                <a class="navbar-brand hidden" href="./"><img src="{{asset('templates-assets/OrganicSuperAdminWeb/images/logo2.png')}}" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{url('dashboard')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                  
                    <li>
                       <a href="{{url('customers')}}"><i class="menu-icon fa fa-users"></i>Manage Users</a>
                   </li>
                   <li>
                        <a href="{{url('app-data')}}"><i class="menu-icon fa fa-list-alt"></i>App Base Data</a>
                    </li>

                    <li>
                        <a href="{{url('ecomm-plans')}}"><i class="menu-icon fa fa-list-alt"></i>Ecommerce Plans</a>
                    </li>
                     <li>
                       <a href="{{url('logo')}}"><i class="menu-icon fa fa-list-alt"></i>Logos</a>
                   </li>
                   <li>
                        <a href="{{url('image-plans')}}"><i class="menu-icon fa fa-list-alt"></i>Image Subscription Plans</a>
                    </li>
                    <li>
                        <a href="{{url('image-subscription-history')}}"><i class="menu-icon fa fa-list-alt"></i>Image Subscription Order History</a>
                    </li>
                   <!--<li>-->
                   <!--    <a href="{{url('classified_ad')}}"><i class="menu-icon fa fa-arrow-right"></i>Manage Classified Ad</a>-->
                   <!--</li>-->
                    <!--<li class="menu-item-has-children dropdown">-->

                    <!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-arrow-right"></i>Manage Classified Ad</a>-->

                    <!--        <ul class="sub-menu children dropdown-menu" role="menu">-->

                    <!--            <li><i class="menu-icon fa fa-arrow-right"></i><a href="{{url('waiting-classified-ad')}}">Waiting For Approval List</a></li>-->
                                
                    <!--            <li><i class="menu-icon fa fa-arrow-right"></i><a href="{{url('approved-classified-ad')}}">Approved List</a></li>-->

                    <!--            <li><i class="menu-icon fa fa-arrow-right"></i><a href="{{url('disapproved-classified-ad')}}">Disapproved List</a></li>-->

                    <!--        </ul>-->

                    <!--    </li>-->
                    <!--<li>-->
                    <!--     <a href="{{url('upload_import_csv')}}"> <i class="menu-icon fa fa-envelope"></i>Import Bulk Email as CSV</a>-->
                    <!--</li>-->
                    <li>
                        <a href="{{url('charges')}}"> <i class="menu-icon fa fa-wrench"></i>Maintance Status</a>
                    </li>
                     <li>
                       <a href="{{url('purchased-history')}}"><i class="menu-icon fa fa-history"></i>Manage Order History</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-question-circle"></i>Help Section</a>
                            <ul class="sub-menu children dropdown-menu" role="menu">
                    <li>
                        <i class="menu-icon fa fa-info"></i><a href="{{url('about')}}">About Us</a>
                    </li>
                     <li>
                        <i class="menu-icon fa fa-gavel"></i><a href="{{url('termCondition')}}"> Terms & Conditions</a>
                    </li>
                     <li>
                        <i class="menu-icon fa fa-gavel"></i><a href="{{url('privacyPolicy')}}"> Privacy Policy</a>
                    </li>
                    <li>
                        <i class="menu-icon fa fa-gavel"></i><a href="{{url('refund')}}"> Refund Policy</a>
                    </li>
                     <li>
                       <i class="menu-icon fa fa-question"></i><a href="{{url('faq')}}">FAQ's</a>
                    </li>
                    <li>
                       <i class="menu-icon fa fa-info"></i><a href="{{url('contact-details')}}">Contact Details</a>
                    </li>
                   
                    
                      </ul>
                        </li>
                  

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

     <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{asset('templates-assets/OrganicSuperAdminWeb/images/admin.jpg')}}" alt="User">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{url('profile')}}"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="{{url('account')}}"><i class="fa fa -cog"></i>Account</a>

                            <a class="nav-link" href="{{url('logout')}}"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
       
        @yield('content')

    </div>

    <!-- Footer -->
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/plugins.js')}}"></script>

    <!-- Tables   -->
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/jszip.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/pdfmake.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/vfs_fonts.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/data-table/datatables-init.js')}}"></script>
    <script src="{{asset('templates-assets/OrganicSuperAdminWeb/js/main.js')}}"></script>
</body>
</html>