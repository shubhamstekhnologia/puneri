
  <style>

.header {
    border-bottom: 1px solid #F5F5F6;
}

.header .container {
    line-height: 78px;
}
.site-nav-container {
    background-color: #fff;
    width: 100%;
    min-height: 78px;
    max-width: 92%;
    margin: auto;
}

.header .myntra-logo {
    height: 40px;
    width: 40px;
    float: left;
}


.header .checkout-steps {
    margin: 0 0 0 34%;
    width: 40%;
    color: #696B79;
    padding: 0;
    display: inline-block;
    line-height: 20px;
}
.header .checkout-steps .active {
    color: #20BD99;
    border-bottom: 2px solid #20BD99;
}

.header .checkout-steps .step1 {
    margin: 0 5px 0 0;
}
.header .checkout-steps .step {
    display: inline-block;
    letter-spacing: 3px;
}
.header .checkout-steps .divider {
    display: inline-block;
    border-top: 1px dashed #696B79;
    height: 4px;
    width: 10%;
}
.header .checkout-steps .step2 {
    margin: 0 5px 0 6px;
}
.header .checkout-steps .step {
    display: inline-block;
    letter-spacing: 3px;
}

.header .checkout-steps .step3 {
    margin: 0 0 0 7px;
}

.header .checkout-steps .step {
    display: inline-block;
    letter-spacing: 3px;
}

:no



    .shopping-cart{
	padding-bottom: 50px;
	font-family: 'Montserrat', sans-serif;
}

.shopping-cart.dark{
	background-color: #f6f6f6;
}

.shopping-cart .content{
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color: white;
	padding: 30px;
}

.shopping-cart .block-heading{
    /*padding-top: 50px;*/
    margin-bottom: 40px;
    text-align: center;
}

.shopping-cart .block-heading p{
	text-align: center;
	max-width: 420px;
	margin: auto;
	opacity:0.7;
}

.shopping-cart .dark .block-heading p{
	opacity:0.8;
}
.delivery{padding:20px;}
.shopping-cart .block-heading h1,
.shopping-cart .block-heading h2,
.shopping-cart .block-heading h3 {
	margin-bottom:1.2rem;
	color: #3b99e0;
}

.shopping-cart .items{
	margin: auto;
}

.shopping-cart .items .product{
	margin-bottom: 20px;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .items .product .info{
	padding-top: 0px;
	text-align: center;
}

.shopping-cart .items .product .info .product-name{
	font-weight: 600;
}

.shopping-cart .items .product .info .product-name .product-info{
	font-size: 14px;
	margin-top: 15px;
}

.shopping-cart .items .product .info .product-name .product-info .value{
	font-weight: 400;
}

.shopping-cart .items .product .info .quantity .quantity-input{
    margin: auto;
    width: 80px;
}

.shopping-cart .items .product .info .price{
	margin-top: 15px;
    font-weight: bold;
    font-size: 22px;
 }

.shopping-cart .summary{
	border-top: 2px solid #5ea4f3;
    background-color: #f7fbff;
    height: 100%;
    padding: 30px;
}

.shopping-cart .summary h3{
	text-align: center;
	font-size: 1.3em;
	font-weight: 600;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .summary .summary-item:not(:last-of-type){
	padding-bottom: 10px;
	padding-top: 10px;
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.shopping-cart .summary .text{
	font-size: 1em;
	font-weight: 600;
}

.shopping-cart .summary .price{
	font-size: 1em;
	float: right;
}

.shopping-cart .summary button{
	margin-top: 20px;
}

@media (min-width: 768px) {
	.shopping-cart .items .product .info {
		padding-top: 25px;
		text-align: left; 
	}

	.shopping-cart .items .product .info .price {
		font-weight: bold;
		font-size: 22px;
		top: 17px; 
	}

	.shopping-cart .items .product .info .quantity {
		text-align: center; 
	}
	.shopping-cart .items .product .info .quantity .quantity-input {
		padding: 4px 10px;
		text-align: center; 
	}
}


  input[type=text] {
 width: 100%;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: #f8f9fa;
  /*background-image: url('../GrobizEcomm/images/img/searchicon.png');*/
  background-position: 10px 10px; 
  background-repeat: no-repeat;
     padding: 10px 20px 9px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
}


.checkout-footer {
    border-top: 1px solid #F5F5F6;
    margin: 0 0 10px 0;
}

.checkout-footer .content {
    max-width: 980px;
    padding-top: 10px;
    margin: auto;
}

.checkout-footer .images {
    display: inline-block;
}
img {
    vertical-align: middle;
}
img {
    border-style: none;
}
  </style>  


@if (Session::has('AccessTokens'))

   <?php $value = Session::get('AccessTokens') ?>

@endif 
@extends('templates.frontend.header')
@section('content')

<div class="header">
     <div class="site-nav-container container"> 
     <ol class="checkout-steps"> <li class="step step1 active">BAG</li> <li class="divider"></li> <li class="step step2">ADDRESS</li> <li class="divider"></li> <li class="step step3">PAYMENT</li> </ol> <div class="secureContainer"></div> </div>
     </div>
	<main class="page">
	 	<section class="shopping-cart dark">
	 		<div class="container">
	 		   
	 		    
		        <div class="block-heading">
		          <!--<h2>Shopping Cart</h2>-->
		          <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>-->
		          	<div class="row">
	 		    	<div class="col-md-12 col-lg-12">
	 		    	    <br/>
	 		    	    <img src="{{url('images/img/cart_details_banner.webp')}}" class="img img-fluid"/>
	 		    	    </div>
	 		    	    </div>
		        </div>
		            <div class="block-heading">
		        
		          <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>-->
		          	<div class="row">
	 		    	<div class="col-md-12 col-lg-12 col-sm-12">
	 		    	      @if(Session('buynow'))
	 		    	        <h2>Select Address</h2>
	 		    	    @if(!empty($user_address))
                  @php $i = 0 @endphp
                  @foreach($user_address as $address)
                  @php $i++; @endphp
                     @if($address->user_auto_id == $value)
                     	   	<div class="col-md-3 col-lg-3 col-sm-6">
                            <div style="text-align: left;padding: 5px;margin: 5px;border: 1px solid gray;background: white;">
                        	<input type="radio" id="radio01-01" name="demo01" />
                        	<label for="radio01-01"><br>
                        	        <b>Name & Number</b> : {{$address->name}}({{$address->mobile_no}})<br>
                                    <b>Address Details</b> : {{$address->address_details}}<br>
                                    <b>Address Type</b> : {{$address->address_type}}<br>
                                    {{$address->area}},{{$address->city}}<br>
                                    {{$address->state}}, {{$address->country}}, {{$address->pincode}}
                             </label>     
                              </div>
                        	 </div>
                        	 @endif
                        	 @endforeach
                            @endif
                              @endif
	 		    	    </div>
	 		    	    </div>
		        </div>
		        
		        <div class="content">
	 			 <table id="cart" class="table table-hover table-condensed">
	 			        @if(Session('buynow'))
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    @endif
    <tbody>
        @php $total = 0 @endphp
        @if(Session('buynow'))
            @foreach(Session('buynow') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="./images/products_images/{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h5 class="nomargin">{{ $details['name'] }}</h5>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">Rs.{{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-buynow" />
                    </td>
                    <td data-th="Subtotal" class="text-center">Rs.{{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-buynow"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
      @if(Session('buynow'))
    <tfoot>
        <tr>
            	      
	 		    
       
            <td colspan="5" class="text-right"><br>
            <b>Order Total  - {{ $total }}</b><br>
                @if($promocodes != "" )
                           <b> Coupon Discount  <a href="{{url('promocode_list')}}" style="color:blue">Apply Coupon</a></b><br>

           
            @else
              <b>Coupon Discount </b> -   {{$promocodes}}
             @endif
             <!-- {!! Form::open(['method' => 'POST', 'url' => 'promocode_apply', 'enctype' => 'multipart/form-data']) !!}-->
             <!--       <div class="col-md-4 col-lg-4 col-sm-12" style="float:right;"> <input type="text" placeholder="Coupon Code" class="form-control" id="promocode" name="promocode" style="width:75%;">-->
             <!--       <input type="submit" class="btn btn-success" value="Apply" style="margin-top: -40px;"></div>-->
                                           
             <!--</form>-->
             <div class="clearfix"></div>
             @if($pincodes->isNotEmpty())
             @foreach($pincodes as $pincodess)
           
             <b>Delivery Charges  - {{$pincodess->price}}</b><br>
          <?php $total_paid_price =  $total + $pincodess->price - $promocodes ?>

            @endforeach
             @else
                          <b>Delivery Charges  - 0</b><br>
                            <?php $total_paid_price = 0 +  $total + 0 ?>

             @endif
             <?php  ?>
            <h3><strong>Total Amount Rs.{{ $total_paid_price }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('ecommerce') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success">Proceed</button>
            </td>
        </tr>
    </tfoot>
      @endif
</table>
		 		

</section>

	 		</div>
	 
	 		   
	 	
		</section>
		
	</main>
	<div class="checkout-footer"> <div class="content"> <div class="images"> 
	<img class="footer-bank-ssl" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-ssl.png" width="70" height="37" style="float:left">
	<img class="footer-bank-visa" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-visa.png" width="60" height="37" style="float:left">
	<img class="footer-bank-mc" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-mc.png" width="60" height="37" style="float:left">
	<img class="footer-bank-ae" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-ae.png" width="60" height="37" style="float:left">
	<img class="footer-bank-dc" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-dc.png" width="60" height="37" style="float:left">
	<img class="footer-bank-nb" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-nb.png" width="60" height="37" style="float:left">
	<img class="footer-bank-cod" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-cod.png" width="60" height="37" style="float:left"> 
	<img class="footer-bank-rupay" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-rupay.png" width="60" height="37" style="float:left">
	<img class="footer-bank-paypal" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-paypal.png" width="60" height="37" style="float:left"> 
	<img class="footer-bank-bhim" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-bhim.png" width="60" height="37" style="float:left">
	</div> 
	<a href="/contactus" class="contact-us"> <span>Need Help ? Contact Us</span> </a> </div></div>
		<section id="products" class="border-top">
    

<script type="text/javascript">
   
    $(".update-buynow").change(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        $.ajax({
            url: '{{ route('update.buynow') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
   
    $(".remove-from-buynow").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.buynow') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
   
</script>
@endsection
		 	

