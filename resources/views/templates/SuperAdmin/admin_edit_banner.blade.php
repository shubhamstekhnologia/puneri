
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>ECommerce</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('templates-assets/frontendweb/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('templates-assets/frontendweb/images/apple-touch-icon.png')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('templates-assets/frontendweb/css/custom.css')}}">
    
    	<link rel="stylesheet" type="text/css" href="{{asset('templates-assets/frontendweb/css/header_style.css')}}">
<!--    <link rel="stylesheet" href=-->
<!--"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->

   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

 <script src="{{asset('templates-assets/frontendweb/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/popper.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('templates-assets/frontendweb/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/inewsticker.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/bootsnav.js.')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/images-loded.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/isotope.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/form-validator.min.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/contact-form-script.js')}}"></script>
    <script src="{{asset('templates-assets/frontendweb/js/custom.js')}}"></script>
  <style>
       
  .search_input{
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

input[type=text]:focus {
  width: 100%;
}


.fa-edit{
    height: 27px;
    margin-left: 30px;
}

/*Image Preview*/
 
#output_image
{
 max-width:50%;
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
 
    /* float: left; */
   width:139%;
    /*margin: 14px;*/

}

 .navbar{
     background: #fff;
     padding-top: 0;
     padding-bottom: 0;
     box-shadow: 1px 3px 4px 0 #adadad33;
}
 .navbar-light .navbar-brand {
     color: #2196F3;
}
 .navbar-light .navbar-nav .nav-link {
     color:black;
}
 .navbar-light .navbar-brand:focus, .navbar-light .navbar-brand:hover {
     /*color: #1ebdc2;*/
}
 .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
     color: #fff;
}
 .navbar-light .navbar-nav .nav-link{
     padding-top: 22px;
     padding-bottom: 22px;
     transition: 0.3s;
     padding-left: 24px;
     padding-right: 24px;
         font-size: 14px;
}
 .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover{
     background: #1ebdc2;
     transition: 0.3s;
}
.dropdown-item:focus, .dropdown-item:hover {
    color: #fff;
    text-decoration: none;
    background-color: #1ebdc2 !important;
}
.sm-menu{
    border-radius: 0px;
    border: 0px;
    top: 97%;
    box-shadow: rgba(173, 173, 173, 0.2) 1px 3px 4px 0px;
}
.dropdown-item {
    color: #3c3c3c;
        font-size: 14px;
}
.dropdown-item.active, .dropdown-item:active {
    color: #fff;
    text-decoration: none;
    background-color: #2196F3;
}
.navbar-toggler{
    outline: none !important;
}
.navbar-tog{
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
.megamenu h6{
    margin-left: 21px;
}
.megamenu i{
    width: 20px;
}

.col-xs-2{
    background:#00f;
    color:#FFF;
}
.col-half-offset{
    margin-left:4.166666667%
}
  </style>  
  
  
<script>
 $('.document').ready(function(){
     
     $('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
    
    
    	$(".megamenu").on("click", function(e) {
		e.stopPropagation();
	});  
	
      $('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:4
        },
        600:{
            items:3
        },
        1000:{
            items:10
        }
    }
})  



 $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
          
        });
        
 $("#add_button").click(function(){
          
             var token = "{{ csrf_token() }}";

            var category_name = $('.category_name').val();
         
          
          
          
          
        //   alert(category_name);alert(category_image);die;
         
       
            
                $.ajax({

                  url: "<?php echo route('add_main_category'); ?>",

                  method: 'POST',

                  data: {  '_token': token,

                            'category_name':category_name,
                      'category_image':category_image,
                  },

                 dataType: "html",

                  success: function(data) {
                  
                alert(data);
                  
                     $("#sub_category_auto_id").html(data);

                  }

              });
        });
 
  
 });
 function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>

</head>

<body>
    <div class="container-fluid">
      
                <div class="row" style="background-color:#eaeaea;color:black;padding: 6px;">
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                     <div class="col-md-12">
                                    Why ECommerce? &nbsp;&nbsp; <span>Download App</span>&nbsp;&nbsp;
                                     <img src="{{url('images/img/ios_app_icon.svg')}}" style="margin-top: -21px;margin-left: 239px;"/>&nbsp;
                                      <img src="{{url('images/img/android_app_icon.svg')}}" style="margin-top:-40px;margin-left: 265px;"/>
                                </div>
                                
                               
                                </div>
                               
                                
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                       
                                    </div>
                                      <div class="col-md-2">
                                       
                                    </div>
                                     <div class="col-md-2">
                                       
                                    </div>
                                   
                                    <div class="col-md-6">
                                         <ul class="list-inline" class="pull-right">
        <li class="list-inline-item">&nbsp;About Us</li>
        <li class="list-inline-item">&bull;&nbsp;Careers</li>
        <li class="list-inline-item">&bull;&nbsp;Contact Us</li>
      </ul> 
                                    </div>
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                  
            </div>
           
          <br/>
              <div class="row">
                    <div class="container">
                        <div class="row">
                             <div class="col-md-2">
                     <h3><a href="#">ECommerce</a></h3>
              
                  </div>
                  <div class="col-md-6">
                      <!--<div class="row">-->
                      <!--    <div class="col-md-4">-->
                      <!--     <img src="{{url('images/img/location.png')}}" style="width: 25px; height: 25px;}"/>&nbsp;Pune,Maharashtra-->
                      <!--    </div>-->
                      <!--     <div class="col-md-8">-->
                      <!--       <input type="text" class="form-control pull-left" placeholder="Search....."/>-->
                      <!--    </div>-->
                      <!--</div>-->
                      <div class="row">
                    <div class="container">
                      
                        <div class="row">
                           
                  <div class="col-md-12">
                    
                          
                             <!--<div class="select_dropdown" style="background:white;border-radius: 7px;border:2px solid black;">-->
                             <!--    <select class=" form-control" style="width:32%;border-top-left-radius: 7px;border-bottom-right-radius: 0px;border-top-right-radius: 0px;background: #e55625;color: white;">-->
                             <!--        <option>All Categories</option>-->
                                   
                             <!--    </select>-->
                             <!--   <button type="submit"  class="pull-right search_icon"     style="margin-top: -33px;border-radius: 5px; background: white;border: 2px solid white;">-->
                             <!--       <img src="{{url('images/img/search-icon-header.svg')}}">-->
                             <!--   </button>-->
                             <!--</div>-->
                               <input type="text" class="search_input form-control"/>
                               
                                
                        
                  
                  <!--<div class="col-md-4">
                  <!--    <div class="row">-->
                  <!--        <div class="col-xs-4 col-md-4">-->
                  <!--           <i class="fa fa-user"></i>&nbsp;&nbsp;Login-->
                  <!--        </div>-->
                  <!--        <div class="col-xs-4 col-md-4">-->
                  <!--            <i class="fas fa-heart"></i>&nbsp;&nbsp;Wishlist-->
                  <!--        </div>-->
                  <!--        <div class="col-xs-4 col-md-4">-->
                  <!--             <i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;Cart-->
                  <!--        </div>-->
                  <!--    </div>-->
                  <!--</div>-->
         
                        </div>
                       
                 
                  
                   
              </div>
    
                      </div>
                   
                     </div>
                  </div>
                  <div class="col-md-4">
                      <div class="row">
                          <div class="col-xs-4 col-md-4">
                             <i class="fa fa-user"></i>&nbsp;&nbsp;Login
                          </div>
                          <div class="col-xs-4 col-md-4">
                              <i class="fas fa-heart"></i>&nbsp;Wishlist
                          </div>
                          <div class="col-xs-4 col-md-4">
                               <i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;Cart
                          </div>
                         
                      </div>
                  </div>
         
                        </div>
                 
                  
                   
              </div>
    
                      </div>
                     
          <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                <center><h6>Edit Banner Image</h6></center>
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <div class="row">
        <?php foreach($brands As $s){?>
       <div class="col-md-3">
            <div class="banner2">
                    
                <img id="brand_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $s['brand_image_app']; ?>" style="width:280px;height:343px;"><br/>
                 <center><input type="checkbox" name="subcat" value="<?php echo $s['_id']; ?>"/><p id="category_name"><?php echo $s['brand_name']; ?></p></center><br/>
                  
              </div>
       </div>
       <?php }?>
   </div>
                                    </div>
                                </div>
<div class="row">
    <div class="col-md-12">
         <button type="submit" class="btn btn-md btn-danger pull-right">Save</button>
    </div>
   
</div>


<br/><br/>






   
                 
                     </div> <!--container-fluid-->
                    
              </div>

   
        @yield('content')
   <!-- Start Footer  -->
               <footer>
                <div class="footer-main">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="footer-widget">
                                    <h4>About ECommerce</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        </p>
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
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Customer Service</a></li>
                                        <li><a href="#">Our Sitemap</a></li>
                                        <li><a href="#">Terms &amp; Conditions</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Delivery Information</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="footer-link-contact">
                                    <h4>Contact Us</h4>
                                    <ul>  
                                        <li>
                                            <p><i class="fas fa-map-marker-alt"></i>Address: Lorem Ipsum has been the industry's <br>standard dummy text ever since,<br> the 1500s </p>
                                        </li>
                                        <li>
                                            <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+91-xxxxxxxxxx">+91-xxxxxxxxxx</a></p>
                                        </li>
                                        <li>
                                            <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contact@gmail.com">contact@gmail.com</a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End Footer  -->
            
            <!-- Start copyright  -->
            <div class="footer-copyright">
                <p class="footer-company">All Rights Reserved. &copy; 2022 <a href="#">ECommerce</a></p>
            </div>
            <!-- End copyright  -->
            
            <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>


  
</div>
   

    



</body>

</html>