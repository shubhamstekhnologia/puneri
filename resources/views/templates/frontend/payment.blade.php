@if (Session::has('AccessTokens') && Session::has('cart'))
<?php $value = Session::get('AccessTokens') ?>
@else
<script>
    window.location.href = "{{url(Session('main'))}}"
</script>
@endif


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
        padding: 0 5rem 5rem 5rem;
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
        /*padding: 1vh;*/
        /*margin-bottom: 4vh;*/
        outline: none;
        /*width: 100%;*/
        background-color: rgb(247, 247, 247)
    }

    input:focus::-webkit-input-placeholder {
        color: transparent
    }

    .header {
        /*font-size: 1.5rem*/
    }

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

        border-color: rgb(23, 4, 189);
        color: white;


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

    .form-check-label {
        margin-top: -5px;
        padding-left: 5px !important;
    }

    #cvv:hover {}
</style>
@extends('templates.frontend.header')
@section('content')

<div class="header">
    <div class="site-nav-container container">
        <ol class="checkout-steps">
            <li class="step step1 active">BAG</li>
            <li class="divider"></li>
            <li class="step step2 active">ADDRESS</li>
            <li class="divider"></li>
            <li class="step step3 active">PAYMENT</li>
        </ol>
        <div class="secureContainer"></div>
    </div>
</div>

<div class="card">
    <div class="card-top border-bottom text-center"> <a href="{{url(Session('main'))}}"> Back to shop</a>
        <!--<span id="logo">BBBootstrap.com</span>-->
    </div>
    <div class="card-body">
        <!--<div class="row upper"> <span><i class="fa fa-check-circle-o"></i> Shopping bag</span> <span><i class="fa fa-check-circle-o"></i> Order details</span> <span id="payment"><span id="three">3</span>Payment</span> </div>-->
        <div class="row">
            <div class="col-md-7">
                <div class="address_div">
                    <h5>Deliver To</h5>
                    @php $i = 0;
                    $promo = 0; @endphp
                    @if(!empty($address))
                    @foreach($address as $promocode)
                    @php $i++ @endphp
                    <div class="form-check bordered p-3">
                        @if($i == 1)
                        <input class="form-check-input" type="checkbox" name="address" id="address{{$i}}0" checked
                            value="{{$promocode->id}}">
                        @else
                        <input class="form-check-input" type="checkbox" name="address" id="addresscheckbox{{$i}}"
                            value="{{$promocode->id}}">

                        @endif
                        <label class="form-check-label" for="flexRadioDefault2">
                            Name : {{$promocode->name}}<br>
                            Mobile No : {{$promocode->mobile_no}}<br>
                            Address Details : {{$promocode->address_details}}<br>
                            {{$promocode->area}},
                            {{$promocode->city}}<br>
                            {{$promocode->state}}<br>
                            {{$promocode->country}}<br>
                            Pincode : {{$promocode->pincode}}<br>

                            Address Type : {{$promocode->address_type}}<br>
                        </label>

                    </div>
                    @endforeach
                    @else
                    <a href="{{url('add-user-address')}}">Add address</a>
                    @endif
                </div>
            </div>
            <div class="col-md-5">
                <div class="right border">
                    <div class="header px-3 mb-3">Order Summary (<small>{{count(Session('cart')) }} items</small>)</div>
                    @php $product_names = array(); @endphp
                    @foreach(Session('cart') as $id=>$details)
                    @php array_push($product_names, $details['name']); @endphp
                    <div class="row item border-bottom">
                        <div class="col-4 align-self-center">
                            <img class="img-fluid" src="../images/products_images/{{ $details['image'] }}"
                                style="height: 80px;">
                        </div>
                        <div class="col-8">
                            <div class="row"><b>Rs.{{$details['price']}}</b></div>
                            <div class="row text-muted">{{$details['name']}}</div>
                            <div class="row">Qty: {{$details['quantity']}}</div>
                            <div class="row">Size: {{$details['size']}}</div>
                        </div>
                    </div>
                    @endforeach


                    <div class="row lower mt-3">
                        <div class="col text-left">Subtotal</div>
                        <div class="col text-right">Rs.{{Session('subtotal')}}</div>
                    </div>
                    <div class="row lower">
                        <div class="col text-left">Delivery</div>
                        <div class="col text-right">Free</div>
                    </div>
                    @if(Session::has('coupon'))
                    @php $promo = Session('coupon') @endphp
                    <div class="row lower">
                        <div class="col text-left">Coupon Discount</div>
                        <div class="col text-right text-success">-Rs. {{Session('coupon')}}</div>
                    </div>
                    @endif
                    <div class="row lower">
                        <div class="col text-left"><b>Total to pay</b></div>
                        <div class="col text-right"><b>Rs. {{Session('total')}}</b></div>
                    </div>


                    {{-- <div class="row lower  mt-4 pl-3">
                        <div class="form-check">
                            <input class="form-check-input payment_method online" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Online Payment(Debit Card, UPI, Wallets)
                            </label>
                        </div>
                    </div> --}}

                    <div class="row lower mb-4 pl-3">
                        <div class="form-check">
                            <input class="form-check-input payment_method cod" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Cash On Delivery
                            </label>
                        </div>
                    </div>

                    {{-- {!! Form::open(['method' => 'POST', 'url' => 'success', 'enctype' => 'multipart/form-data', 'id'
                    =>'online_payment_form']) !!}
                    <input type="hidden" class="form-control" value="{{$promo}}" id="promocode" name="promocode">
                    <!--<input type="hidden" class="form-control" value="" id="products" name="products" >-->
                    <input type="hidden" class="form-control" value="{{Session('subtotal')}}" id="subtotal"
                        name="subtotal">
                    <input type="hidden" class="form-control" value="{{Session('total')}}" id="total" name="total">
                    <input type="hidden" class="form-control" value="" id="select-address" name="select_address">
                    <input type="hidden" class="form-control" value="online" id="payment_method" name="payment_method">
                    <input type="hidden" class="form-control" value="paid" id="payment_status" name="payment_status">
                    <input type="hidden" class="form-control" value="" id="razorpay_signature"
                        name="razorpay_signature">
                    <input type="hidden" class="form-control" value="" id="razorpay_pament_id"
                        name="razorpay_pament_id">
                    <input type="hidden" class="form-control" value="" id="razorpay_order_id" name="razorpay_order_id">
                    </form>

                    <button class="payment-btn2 btn"
                        style=" width: 100%; background-color: rgb(23, 4, 189) !important; color:white"
                        id="rzp-button1">Pay Now</button> --}}

                    {!! Form::open(['method' => 'POST', 'url' => 'success', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" class="form-control" value="{{$promo}}" id="promocode" name="promocode">
                    <!--<input type="hidden" class="form-control" value="" id="products" name="products" >-->
                    <input type="hidden" class="form-control" value="{{Session('subtotal')}}" id="subtotal"
                        name="subtotal">
                    <input type="hidden" class="form-control" value="{{Session('total')}}" id="total" name="total">
                    <input type="hidden" class="form-control" value="" id="select-address-cod" name="select_address">
                    <input type="hidden" class="form-control" value="COD" id="payment_method" name="payment_method">
                    <input type="hidden" class="form-control" value="pending" id="payment_status" name="payment_status">
                    <button class="payment-btn2 btn place_order"
                        style=" width: 100%; background-color: rgb(23, 4, 189) !important; color:white" id="place_order"
                        type="submit">Place order</button>
                    </form>
                    <p class="text-muted text-center">Complimentary Shipping & Returns</p>
                </div>
            </div>
        </div>
    </div>
    <div> </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    var amount = {{Session('total') * 100 }}
document.getElementById('rzp-button1').onclick = function(e){
    e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "{{url(Session('main').'/generate_order')}}",
            data: {amount: amount },
            success: function (data) {
                if (data != "") {
                    order_id = data;

                }


            var options = {
    "key": "rzp_test_VRjuJ0lp3kC47e", // Enter the Key ID generated from the Dashboard
     "amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Grobiz Ecommerce",
    "description": "{{implode(',', $product_names)}}",
    "image": "https://grobiz.app/GRBCRM2022/GrobizEcomm/templates-assets/frontendweb/images/apple-touch-icon.png",
    "order_id":order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        console.log(options)
        $("#razorpay_pament_id").val(response.razorpay_payment_id);
        $("#razorpay_order_id").val(response.razorpay_order_id);
        $("#razorpay_signature").val(response.razorpay_signature)

        $("#online_payment_form").submit();
    },
    "prefill": {
        "name": "{{$user_name}}",
        "email": "{{$user_email}}",
        "contact": "{{$user_no}}"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);

rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});

                rzp1.open();

            },
            error:function(){
                alert("There is something wrong,please check amount and try again later!");
            }
            })


}
</script>
<script>
    $(".payment_method").change(function(e){
        if ($(this).hasClass('cod'))
        {
            if($("#place_order").hasClass('d-none'))
            {
                $("#place_order").removeClass("d-none")
                $("#rzp-button1").addClass("d-none")
            }

        }else
        {
             if($("#rzp-button1").hasClass('d-none'))
            {
                $("#rzp-button1").removeClass("d-none")
                $("#place_order").addClass("d-none")
            }

        }
    })

    $(document).ready(function(){
        $("#select-address").val($('input[name="address"]:checked').val());
          $("#select-address-cod").val($('input[name="address"]:checked').val());
    })
    $('input[name="address"]').click(function(){
          $("#select-address").val($('input[name="address"]:checked').val());
            $("#select-address-cod").val($('input[name="address"]:checked').val());
    })
</script>
@endsection
