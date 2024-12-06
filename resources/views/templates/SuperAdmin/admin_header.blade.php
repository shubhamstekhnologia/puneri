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
<!--For Line Chart-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>



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
    
    
     <!--Custom Js for Respective Line Charts-->
        <script src="{{asset('templates-assets/frontendweb/js/custom_charts.js')}}"></script>
    
    <!--DAshboard-->
    <!--For Line Charts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



  <style>
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
  
  
  .search_input{
 width: 100%;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  /*background-color: #f8f9fa;*/
  background-image: url('../GrobizEcomm/images/img/searchicon.png');
     background-position: 8px 6px;
  background-repeat: no-repeat;
     padding: 10px 20px 9px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  margin-top: 14px;
    height: 36px;
        margin-left: 363px;
}

input[type=text]:focus {
  width: 100%;
}

.main_cat_edit_btn{
    margin-left:47px;
   
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
     width:100%;
     margin-top:-23px;
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
	max-width:auto;
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



.upload__box {
  padding: 40px;
}
.upload__inputfile {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}

.upload__productinputfile{
    width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.upload__btn {
 display: inline-block;
    font-weight: 600;
    color: #fff;
    text-align: center;
    min-width: 116px;
    padding: 5px;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid;
    background-color: red;
    border-color: red;
    border-radius: 10px;
    height: 39px;
    font-size: 14px;
}
.upload__btn:hover {
  background-color: red;
  color: #4045ba;
  transition: all 0.3s ease;
}
.upload__btn-box {
  margin-bottom: 10px;
}
.upload__img-wrap {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -10px;
}
.upload__img-box {
  width: 200px;
  padding: 0 10px;
  margin-bottom: 12px;
}
.upload__img-close {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: red;
  position: absolute;
  top: 10px;
  right: 10px;
  text-align: center;
  line-height: 24px;
  z-index: 1;
  cursor: pointer;
}
.upload__img-close:after {
  content: "✖";
  font-size: 14px;
  color: white;
}

.img-bg {
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  position: relative;
  padding-bottom: 100%;
}

.fa-angle-left{margin-top:-100px;}


.switch_search {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    margin-top:13px;
  }
  
   .switch_search input { 
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
  
  input:checked + .slider_toggle {
    background-color: #2196F3;
  }
  
  input:focus + .slider_toggle {
    box-shadow: 0 0 1px #2196F3;
  }
  
  input:checked + .slider_toggle:before {
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

/*END OF TOGGLE SWITCH*/



/*Dashboard*/
 .fa-minus:before {
   
    margin-left: 5px;
}
.checkbox-menu{padding:15px;}

#myInput {
 background-image: url('../GrobizEcomm/images/img/searchicon.png');
  background-position: 6px 6px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 12px;
}

#myTable th, #myTable td {
  text-align: left;
  padding:5px;
  max-width:fit-content;

  
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}




/*checkbox in dropdown*/

.checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}

.btn_add_columns{
margin-top: -20px;
    margin-left: 115px;
}

/* table {*/
/*  border-collapse: collapse;*/
/*  width: 300px;*/
/*  overflow-x: scroll;*/
/*  display: block;*/
/*}*/

/*thead {*/
/*  background-color: #EFEFEF;*/
/*}*/

/*thead,*/
/*tbody {*/
/*  display: block;*/
/*}*/

/*tbody {*/
/*  overflow-y: scroll;*/
/*  overflow-x: hidden;*/
/*  height: 140px;*/
/*}*/

/*td,*/
/*th {*/
/*  min-width: 100px;*/
/*  height: 25px;*/
/*  border: dashed 1px lightblue;*/
/*  overflow: hidden;*/
/*  text-overflow: ellipsis;*/
/*  max-width: 100px;*/
/*}*/

 .second_header{
          font-family: inherit;font-weight: 500;margin-left: 427px;
     }
     
     
     
     .logo{
         margin-top:-76px;margin-left: -104px;
     }
     

/*DAshboard Responsive*/
 @media only screen and (max-width:575.98px){
     .search_input {
         margin-left:0px;
     }
     
     
     .second_header{
         margin-left:100px;
         
     }
     
     
     
     .logo{
         margin-top: -72px;
    font-size: 16px;
    margin-left: -17px;
     }
     
 }

#table1 th{font-size:13px;}
  </style>  
  
  
<script>
    
   
// multiple image upload preview 
function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];
  
  
   $('.upload_productinputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });
$('.upload__productinputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div><input type='radio' name='product_img' value='" + f.name + "'/></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });
  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
  });
}
 $('.document').ready(function(){
     
      ImgUpload();
      
      
      
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
    // nav:true,
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
    },
    // navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
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

//Slider
 function preview_sliderimage(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementByClassName('output_slider_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}


//  Dashboard
    $(document).ready(function() {
        // 	$(".switch_search input").prop('checked', true);
       
	$(".switch_search input").on("change", function(e) {
  	const isOn = e.currentTarget.checked;
    
    if (isOn) {
         window.open('https://gruzen.in/GrobizEcomm/ecommerce_admin','_self');
    
    } 
    else {
    	  window.open('https://gruzen.in/GrobizEcomm/ecommerce','_self');
    }
  });
  
  
  
  
       var xValues = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
var yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});


//Total Sales
  var x1Values = [12,6,12,6];
var y1Values = [0,2,4,6,8,10];

new Chart("myChart1", {
  type: "line",
  data: {
    labels: x1Values,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: y1Values
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 0, max:10}}],
    }
  }
});




//Add Checkboxes
   var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    
    



$("#myInput").on("keyup", function() {
    var value = $(this).val();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().indexOf(value) > -1)
    });
  });
  
  $(".column_title_add").click(function(){
      $('.add_columns_div').show();
  });
  
  
   $('.dropdown-menu').click(function(e) {

         e.stopPropagation();
   });
   
   
   $('table').on('scroll', function() {
  $("#" + this.id + " > *").width($(this).width() + $(this).scrollLeft());
});
  
    });
    
    
        



   
</script>


   


</head>

<body>
    <div class="container-fluid">
      
                <div class="row" style="background-color:#eaeaea;color:black;">
                  
                    <div class="container-fluid">
                          
                        <div class="row">
                            <div class="col-md-4">
                             
                               
                                 <input type="text" class="search_input form-control"/>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                   
                                    <div class="col-md-12">
                                         <ul class="list-inline second_header">
        <li class="list-inline-item">&nbsp;About Us</li>
        <li class="list-inline-item">&nbsp;Careers</li>
        <li class="list-inline-item">&nbsp;Contact Us</li>
        <li class="list-inline-item btn btn-md btn-danger" style="background-color:#c741c7;border-color: #c741c7;font-family: inherit;font-weight: 500;">&nbsp;Dashboard</li>
        <li class="list-inline-item"><div class="switch_toggle"><label class="switch_search pull-right" ><input type="checkbox" checked><span class="slider_toggle round hide-off"></a></span></label></div></li>
      </ul> 
                                    </div>
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                  
            </div>
            <br/>
         <div class="container">
                        <div class="row">
                             <div class="col-md-2">
                     <h3 class="logo"><a href="#">ECommerce</a></h3>
              
                  </div>
                  <div class="col-md-6">
                    
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
                  <!--<div class="col-md-4">-->
                  <!--    <div class="row">-->
                  <!--        <div class="col-xs-4 col-md-4">-->
                  <!--           <i class="fa fa-user"></i>&nbsp;&nbsp;Login-->
                  <!--        </div>-->
                  <!--        <div class="col-xs-4 col-md-4">-->
                  <!--            <i class="fas fa-heart"></i>&nbsp;Wishlist-->
                  <!--        </div>-->
                  <!--        <div class="col-xs-4 col-md-4">-->
                  <!--             <i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;Cart-->
                  <!--        </div>-->
                         
                  <!--    </div>-->
                  <!--</div>-->
         
                        </div>
                 
                  
                   
              </div>
              <div class="container-fluid">
                   <div class="row">
                   <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <!--<a class="navbar-brand" href="#">Mega Menu</a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
         <div class="navbar-toggler-icon"></div> 
        </button>
        <div class="collapse navbar-collapse" id="mobile_nav">
        <!--<ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">-->
        <!--</ul>-->
        <ul class="navbar-nav navbar-light">
            <!--<li class="nav-item"><a class="nav-link" href="#">Home</a></li>-->
            <!--<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>-->
            <!--<li class="nav-item dmenu dropdown">-->
            <!--    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
            <!--    Services-->
            <!--    </a>-->
            <!--    <div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown">-->
            <!--        <a class="dropdown-item" href="#">Software Development</a>-->
            <!--        <a class="dropdown-item" href="#">Web Designing & Development</a>-->
            <!--        <a class="dropdown-item" href="#">Mobile Application</a>-->
            <!--        <a class="dropdown-item" href="#">Business Solutions & Business Process</a>-->
            <!--        <a class="dropdown-item" href="#">Digital Marketing & SEO Services</a>-->
            <!--        <a class="dropdown-item" href="#">Web Hosting & Maintenance</a>-->
            <!--        <a class="dropdown-item" href="#">Cyber Security</a>-->
            <!--        <a class="dropdown-item" href="#">Block Chain Implementation</a>-->
            <!--        <a class="dropdown-item" href="#">Big Data</a>-->
            <!--    </div>-->
            <!--</li>-->
            <!--========-->
           
            
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Customers&nbsp;<span class="badge badge-secondary">0</span></a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <div class="row">
                       
                       
                       <div class="col-sm-6 col-lg-3 mb-4">
                            <h6>Customers</h6>
                            <a class="dropdown-item" href="{{url('allcustomer')}}">All Customers &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('emailsubscribers')}}">Email Subscribers &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('abandonedcustomers')}}">Abandoned Checkouts in the last 30 days &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('purchase_more_than_once_customers')}}">Customers who have purchased more than once &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('no_purchase_customers')}}">Customers who haven't purchased &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                        </div>
                        <!--<div class="col-sm-6 col-lg-3 border-right mb-4">-->
                        <!--    <h6>Mobile</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-apple"></i> iPhone App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Phone Gap App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> Hybrid App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Ionic Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> React Native Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Xamarin App Development</a>-->
                        <!--</div>-->
                        <!--<div class="col-sm-6 col-lg-3 mb-4">-->
                        <!--    <h6>Node.js & MongoDB</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cubes"></i> Full Stack Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> MEAN Stack</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-angular"></i> AngularJS</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-node-js"></i> Node.JS Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-leaf fa-rotate-90"></i> MongoDB Development</a>-->
                        <!--</div>-->
                    </div>
                     
                </div>
                
            </li>
          <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Analytics&nbsp;<span class="badge badge-secondary">0</span></a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <div class="row">
                       
                       
                       <div class="col-sm-6 col-lg-3 border-right mb-4">
                           <a class="dropdown-item" href="{{url('totalsales')}}">Total Sales&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('onlinestoreconversionrate')}}">Online Store Conversion Rate&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('topproductsbyunits')}}">Top Products by units sold&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('onlinestoresessions')}}">Online Store Sessions&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('averageordervalue')}}">Average Order Value&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('onlinestoresessionsbylocation')}}">Online Store Sessions By location&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('salesbyPOSLocation')}}">Sales by POS Location&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('returningcustomerrate')}}">Returning Customer Rate&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('totalorders')}}">Total Orders&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                          <a class="dropdown-item" href="{{url('retailsalesbystaff')}}">Retail Sales by staff at register&nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                        </div>
                        <!--<div class="col-sm-6 col-lg-3 border-right mb-4">-->
                        <!--    <h6>Mobile</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-apple"></i> iPhone App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Phone Gap App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> Hybrid App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Ionic Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> React Native Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Xamarin App Development</a>-->
                        <!--</div>-->
                        <!--<div class="col-sm-6 col-lg-3 mb-4">-->
                        <!--    <h6>Node.js & MongoDB</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cubes"></i> Full Stack Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> MEAN Stack</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-angular"></i> AngularJS</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-node-js"></i> Node.JS Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-leaf fa-rotate-90"></i> MongoDB Development</a>-->
                        <!--</div>-->
                    <!--</div>-->
                     
                </div>
                
            </li>
           
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orders&nbsp;<span class="badge badge-secondary">0</span></a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <div class="row">
                       
                <div class="col-sm-6 col-lg-3 mb-4">
                            <h6>Orders</h6>
                            <a class="dropdown-item" href="{{url('billing_address')}}">Billing Address &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('poslocation')}}">POS Location &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('admin_product')}}">Product &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('shipping_address')}}">Shipping Address &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('staff')}}">Staff Member &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                        </div>
                     
                     
                </div>
                
            </li>
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products&nbsp;<span class="badge badge-secondary">0</span></a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <div class="row">
                       
                <div class="col-sm-6 col-lg-3 mb-4">
                            <h6>Products</h6>
                            <a class="dropdown-item" href="{{url('allproducts')}}">All Products &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                           <a class="dropdown-item" href="{{url('inventory')}}">Inventory &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('collections')}}">Collections &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('giftcards')}}">Gift Cards &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('transfers')}}">Transfers &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                            <a class="dropdown-item" href="{{url('inventory_scanner')}}">Inventory Scanner &nbsp;&nbsp;<span class="badge badge-secondary">0</span></a>
                        </div>
                     
                     
                </div>
                     
                </div>
                
            </li>
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Order Tracking</a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <!--<div class="row">-->
                       
                       
                    <!--   <div class="col-sm-6 col-lg-3 border-right mb-4">-->
                    <!--        <h6>LAMP Technology</h6>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> PHP Website Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fas fa-circle"></i> Phalcon Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-laravel"></i> Laravel Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-wordpress-simple"></i> WordPress Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> Symfony Development</a>-->
                    <!--    </div>-->
                        <!--<div class="col-sm-6 col-lg-3 border-right mb-4">-->
                        <!--    <h6>Mobile</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-apple"></i> iPhone App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Phone Gap App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> Hybrid App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Ionic Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> React Native Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Xamarin App Development</a>-->
                        <!--</div>-->
                        <!--<div class="col-sm-6 col-lg-3 mb-4">-->
                        <!--    <h6>Node.js & MongoDB</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cubes"></i> Full Stack Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> MEAN Stack</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-angular"></i> AngularJS</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-node-js"></i> Node.JS Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-leaf fa-rotate-90"></i> MongoDB Development</a>-->
                        <!--</div>-->
                    <!--</div>-->
                     
                </div>
                
            </li>
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Payments</a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <!--<div class="row">-->
                       
                       
                    <!--   <div class="col-sm-6 col-lg-3 border-right mb-4">-->
                    <!--        <h6>LAMP Technology</h6>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> PHP Website Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fas fa-circle"></i> Phalcon Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-laravel"></i> Laravel Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-wordpress-simple"></i> WordPress Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> Symfony Development</a>-->
                    <!--    </div>-->
                        <!--<div class="col-sm-6 col-lg-3 border-right mb-4">-->
                        <!--    <h6>Mobile</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-apple"></i> iPhone App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Phone Gap App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> Hybrid App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Ionic Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> React Native Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Xamarin App Development</a>-->
                        <!--</div>-->
                        <!--<div class="col-sm-6 col-lg-3 mb-4">-->
                        <!--    <h6>Node.js & MongoDB</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cubes"></i> Full Stack Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> MEAN Stack</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-angular"></i> AngularJS</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-node-js"></i> Node.JS Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-leaf fa-rotate-90"></i> MongoDB Development</a>-->
                        <!--</div>-->
                    <!--</div>-->
                     
                </div>
                
            </li>
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Discount Coupons</a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <div class="row">
                       
                       
                       <div class="col-sm-6 col-lg-3 border-right mb-4">
                            <h6>Discount Coupons</h6>
                            <a class="dropdown-item" href="#">Discount Codes</a>
                            <a class="dropdown-item" href="#">Automated Discounts</a>
                           
                        </div>
                      
                    </div>
                     
                </div>
                
            </li>
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Invoice</a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <!--<div class="row">-->
                       
                       
                    <!--   <div class="col-sm-6 col-lg-3 border-right mb-4">-->
                    <!--        <h6>LAMP Technology</h6>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> PHP Website Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fas fa-circle"></i> Phalcon Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-laravel"></i> Laravel Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-wordpress-simple"></i> WordPress Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> Symfony Development</a>-->
                    <!--    </div>-->
                        <!--<div class="col-sm-6 col-lg-3 border-right mb-4">-->
                        <!--    <h6>Mobile</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-apple"></i> iPhone App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Phone Gap App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> Hybrid App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Ionic Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> React Native Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Xamarin App Development</a>-->
                        <!--</div>-->
                        <!--<div class="col-sm-6 col-lg-3 mb-4">-->
                        <!--    <h6>Node.js & MongoDB</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cubes"></i> Full Stack Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> MEAN Stack</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-angular"></i> AngularJS</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-node-js"></i> Node.JS Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-leaf fa-rotate-90"></i> MongoDB Development</a>-->
                        <!--</div>-->
                    <!--</div>-->
                     
                </div>
                
            </li>
             <li class="nav-item dropdown megamenu-li dmenu">
                
                
              
               
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Marketing</a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <!--<div class="row">-->
                       
                       
                    <!--   <div class="col-sm-6 col-lg-3 border-right mb-4">-->
                    <!--        <h6>LAMP Technology</h6>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> PHP Website Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fas fa-circle"></i> Phalcon Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-laravel"></i> Laravel Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-wordpress-simple"></i> WordPress Development</a>-->
                    <!--        <a class="dropdown-item" href="#"><i class="fab fa-php"></i> Symfony Development</a>-->
                    <!--    </div>-->
                        <!--<div class="col-sm-6 col-lg-3 border-right mb-4">-->
                        <!--    <h6>Mobile</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-apple"></i> iPhone App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Phone Gap App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> Hybrid App Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Ionic Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> React Native Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Xamarin App Development</a>-->
                        <!--</div>-->
                        <!--<div class="col-sm-6 col-lg-3 mb-4">-->
                        <!--    <h6>Node.js & MongoDB</h6>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cubes"></i> Full Stack Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> MEAN Stack</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-angular"></i> AngularJS</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fab fa-node-js"></i> Node.JS Development</a>-->
                        <!--    <a class="dropdown-item" href="#"><i class="fas fa-leaf fa-rotate-90"></i> MongoDB Development</a>-->
                        <!--</div>-->
                    <!--</div>-->
                     
                </div>
                
            </li>
        </ul>
        </div>
    </div>
</nav>
              </div>
              </div>
             
    
                 
                      
                      
                         @yield('content')
                         
                         
                         
                         </div>
                         
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
                         