@if (Session::has('AccessTokens'))

   <?php $value = Session::get('AccessTokens') ?>

@endif 
@extends('templates.frontend.header')
@section('content')
  <style>


.card {
    /*max-width: 1000px;*/
    margin: 2vh
}

.card-top {
    padding: 0.7rem 5rem
}

.card-top a {
    float: left;
    margin-top: 0.7rem
}

#logo {
    font-family: 'Dancing Script';
    font-weight: bold;
    font-size: 1.6rem
}

.card-body {
    padding:25px;
    /*background-image: url("https://i.imgur.com/4bg1e6u.jpg");*/
    background-size: cover;
    background-repeat: no-repeat
}

@media(max-width:768px) {
    .card-body {
        padding: 0 1rem 1rem 1rem;
        /*background-image: url("https://i.imgur.com/4bg1e6u.jpg");*/
        background-size: cover;
        background-repeat: no-repeat
    }

    .card-top {
        padding: 0.7rem 1rem
    }
}

.row {
    margin: 0
}

.upper {
    padding: 1rem 0;
    justify-content: space-evenly
}

#three {
    border-radius: 1rem;
    width: 22px;
    height: 22px;
    margin-right: 3px;
    border: 1px solid blue;
    text-align: center;
    display: inline-block
}

#payment {
    margin: 0;
    color: blue
}

.icons {
    margin-left: auto
}

form span {
    color: rgb(179, 179, 179)
}

form {
    padding: 2vh 0
}

input {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

input:focus::-webkit-input-placeholder {
    color: transparent
}

/*.header {*/
/*    font-size: 1.5rem*/
/*}*/

.left {
    background-color: #ffffff;
    padding: 6vh
}

.left img {
    width: 2rem
}

.left .col-4 {
    padding-left: 0
}

.right .item {
    padding: 0.3rem 0
}

.right {
    background-color: #ffffff;
    padding: 2vh
}

.col-8 {
    padding: 0 1vh
}

.lower {
    line-height: 2
}

.btn {
    background-color: rgb(23, 4, 189);
    border-color: rgb(23, 4, 189);
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin: 4vh 0 1.5vh 0;
    padding: 1.5vh;
    border-radius: 0
}

.btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none
}

.btn:hover {
    color: white
}

a {
    color: black
}

a:hover {
    color: black;
    text-decoration: none
}

input[type=checkbox] {
    width: unset;
    margin-bottom: unset
}

#cvv {
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575), rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center
}

#cvv:hover {}

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
.header .checkout-steps .clickable {
    cursor: pointer;
}

.header .checkout-steps .divider {
    display: inline-block;
    border-top: 1px dashed #696B79;
    height: 4px;
    width: 10%;
}
.header .checkout-steps .active {
    color: #20BD99;
    border-bottom: 2px solid #20BD99;
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


<div class="header">
<div class="site-nav-container container">
<ol class="checkout-steps"> <li class="step step1">BAG</li> <li class="divider"></li> <li class="step step2 active">ADDRESS</li> <li class="divider"></li> <li class="step step3">PAYMENT</li> </ol> <div class="secureContainer"></div> </div>
</div>
<div class="card">
    <div class="card-top border-bottom text-center"> 
      @if (Session::has('AccessTokens') !='')
                     {!! Form::open(['method' => 'POST', 'url' => 'delete_buy_now', 'enctype' => 'multipart/form-data']) !!}

                             <input name="user_auto_id" type="hidden" value="{{$value}}" />                           

                            <button type="submit" class="btn btn-sm btn-danger" style="color:white;font-size:13px;background:purple;border:purple;width:10%;float:left;">Back to shop</button>
                           
                               
                            </form>
                        @else
                            <button id="myButton" type="submit" class="btn btn-sm btn-danger" style="color:white;font-size:13px;background:purple;border:purple;width:10%;float:left;">Back to shop</button>
                            

                        @endif
    <!--<span id="logo">BBBootstrap.com</span>-->
    </div>
    <div class="card-body">
        <!--<div class="row upper"> <span><i class="fa fa-check-circle-o"></i> Shopping bag</span> <span><i class="fa fa-check-circle-o"></i> Order details</span> <span id="payment"><span id="three">3</span>Payment</span> </div>-->
        <div class="row">
            <div class="col-md-7">
                <div class="left border">
                    <div class="row"> <span class="header">Where do you want us to deliver?</span>
                        <!--<div class="icons"> <img src="https://img.icons8.com/color/48/000000/visa.png" /> <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png" /> <img src="https://img.icons8.com/color/48/000000/maestro.png" /> </div>-->
                    </div>
                    <form> 
                    <!--<span>Card Number:</span> <input placeholder="0125 6780 4567 9909">-->
                        <div class="row">
                            <div class="col-6">
                                <span>Email * :</span> <input placeholder="Enter a Valid Email Id" class="form-control" required></div>
                            <div class="col-6">
                                <span>Mobile Number * :</span> <input placeholder="Enter a Valid Mobile Number" class="form-control" required>
                                </div>
                            <div class="col-12">
                                <br/>
                                <span>Full Name * :</span> <input placeholder="Enter Your Full Name" class="form-control" required>
                                 <br/>
                                </div>
                                 <div class="col-6">
                                <span>Country * :</span> <input placeholder="Enter Country Name" class="form-control" required>
                                </div>
                                 <div class="col-6">
                                <span>Pin Code * :</span> <input placeholder="Enter a Valid Pin Code" class="form-control" required>
                                </div>
                                 <div class="col-12">
                                     <br/>
                                <span>Address* :</span> <textarea rows-"3" cols="5" placeholder="Enter Address" class="form-control" required></textarea>
                                </div>
                                   <div class="col-6">
                                       <br/>
                                <input placeholder="Landmark" class="form-control" required>
                                </div>
                        </div> <br/><input type="checkbox" id="save_card" class="align-left"> <label for="save_card">Save as Default Address</label>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="right border">
                    <div class="header">Order Summary</div>
                    <p>2 items</p>
                    <div class="row item">
                        <div class="col-4 align-self-center"><img class="img-fluid" src="{{url('templates-assets/frontendweb/images/jen2.jpg')}}"></div>
                        <div class="col-8">
                            <div class="row"><b>Rs.699</b></div>
                            <div class="row text-muted">Men Slim Tapered Fit Jeans</div>
                            <div class="row">Qty:1</div>
                        </div>
                    </div>
                    <div class="row item">
                        <div class="col-4 align-self-center"><img class="img-fluid" src="{{url('templates-assets/frontendweb/images/jen1.jpg')}}"></div>
                        <div class="col-8">
                            <div class="row"><b>Rs. 719</b></div>
                            <div class="row text-muted">Men Super Skinny Fit Jeans</div>
                            <div class="row">Qty:1</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row lower">
                        <div class="col text-left">Subtotal</div>
                        <div class="col text-right">Rs.1418</div>
                    </div>
                    <div class="row lower">
                        <div class="col text-left">Delivery</div>
                        <div class="col text-right">Free</div>
                    </div>
                    <div class="row lower">
                        <div class="col text-left"><b>Total to pay</b></div>
                        <div class="col text-right"><b>Rs. 1418</b></div>
                    </div>
                    <div class="row lower">
                        <div class="col text-left"><a href="#"><u>Add promo code</u></a></div>
                    </div> <button class="btn">Place order</button>
                    <p class="text-muted text-center">Complimentary Shipping & Returns</p>
                </div>
            </div>
        </div>
    </div>
    <div> </div>
</div>
<script type="text/javascript">
                                document.getElementById("myButton").onclick = function () {
                                    location.href = "../login";
                                };
                            </script>
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
	@endsection