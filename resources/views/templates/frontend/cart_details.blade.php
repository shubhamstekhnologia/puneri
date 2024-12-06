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

    :no .shopping-cart {
        padding-bottom: 50px;
        font-family: 'Montserrat', sans-serif;
    }

    .shopping-cart.dark {
        background-color: #f6f6f6;
    }

    .shopping-cart .content {
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        background-color: white;
        padding: 30px;
    }

    .shopping-cart .block-heading {
        /*padding-top: 50px;*/
        margin-bottom: 40px;
        text-align: center;
    }

    .shopping-cart .block-heading p {
        text-align: center;
        max-width: 420px;
        margin: auto;
        opacity: 0.7;
    }

    .shopping-cart .dark .block-heading p {
        opacity: 0.8;
    }

    .delivery {
        padding: 20px;
    }

    .shopping-cart .block-heading h1,
    .shopping-cart .block-heading h2,
    .shopping-cart .block-heading h3 {
        margin-bottom: 1.2rem;
        color: #3b99e0;
    }

    .shopping-cart .items {
        margin: auto;
    }

    .shopping-cart .items .product {
        margin-bottom: 20px;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .shopping-cart .items .product .info {
        padding-top: 0px;
        text-align: center;
    }

    .shopping-cart .items .product .info .product-name {
        font-weight: 600;
    }

    .shopping-cart .items .product .info .product-name .product-info {
        font-size: 14px;
        margin-top: 15px;
    }

    .shopping-cart .items .product .info .product-name .product-info .value {
        font-weight: 400;
    }

    .shopping-cart .items .product .info .quantity .quantity-input {
        margin: auto;
        width: 80px;
    }

    .shopping-cart .items .product .info .price {
        margin-top: 15px;
        font-weight: bold;
        font-size: 22px;
    }

    .shopping-cart .summary {
        border-top: 2px solid #5ea4f3;
        background-color: #f7fbff;
        height: 100%;
        padding: 30px;
    }

    .shopping-cart .summary h3 {
        text-align: center;
        font-size: 1.3em;
        font-weight: 600;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .shopping-cart .summary .summary-item:not(:last-of-type) {
        padding-bottom: 10px;
        padding-top: 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .shopping-cart .summary .text {
        font-size: 1em;
        font-weight: 600;
    }

    .shopping-cart .summary .price {
        font-size: 1em;
        float: right;
    }

    .shopping-cart .summary button {
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

    /*
  input[type=text] {
 width: 100%;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: #f8f9fa;
background-image: url('../GrobizEcomm/images/img/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
     padding: 10px 20px 9px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
 */



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

    .cart-item {
        border-bottom: 1px solid #e0e0e0;
    }

    .modal-dialog {
        max-width: 80%;
    }

    .modal-dialog-slideout {
        min-height: 100%;
        margin: 0 0 0 auto;
        background: #fff;
    }

    .modal.fade .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(100%, 0)scale(1);
        transform: translate(100%, 0)scale(1);
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout {
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
        display: flex;
        align-items: stretch;
        -webkit-box-align: stretch;
        height: 100%;
    }

    .modal.fade.show .modal-dialog.modal-dialog-slideout .modal-body {
        overflow-y: auto;
        overflow-x: hidden;
    }

    .modal-dialog-slideout .modal-content {
        border: 0;
    }

    .modal-dialog-slideout .modal-header,
    .modal-dialog-slideout .modal-footer {
        height: 4rem;
        display: block;
    }

    .quantity-controllers:hover {
        cursor: pointer;

    }

    .quantity-form {
        width: 25%;
    }

    @media (max-width: 767px) {
        .quantity-form {
            width: 75% !important;
        }
    }
</style>


@if (Session::has('AccessTokens'))

<?php $value = Session::get('AccessTokens') ?>

@endif
@extends('templates.frontend.header')
@section('content')

<div class="header">
    <div class="site-nav-container container">
        <ol class="checkout-steps">
            <li class="step step1 active">BAG</li>
            <li class="divider"></li>
            <li class="step step2">ADDRESS</li>
            <li class="divider"></li>
            <li class="step step3">PAYMENT</li>
        </ol>
        <div class="secureContainer"></div>
    </div>
</div>
<main class="page">
    <section class="shopping-cart dark">
        <div class="container">
            @if(Session('cart'))
            <h4 class="py-4">Your Cart(<small>{{count(Session('cart'))}} items</small>)</h4>
            @else
            <h4 class="py-4">Your Cart(<small>No items in your cart</small>)</h4>
            @endif
            <div class="row bg-white p-4">
                @if(Session('cart'))
                @if(count(Session('cart')) > 0)
                @php $total = 0 @endphp

                <div class="col-md-8 cart-products">
                    <div class="row ">
                        @foreach(Session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <div class="col-md-12 cart-item p-3 row">
                            <div class="cart-img col-3">
                                <img src="{{ asset('images/products_images/' .  $details['image']) }}" alt=""
                                    style="height: 100px;" class="img-fluid">
                            </div>
                            <div class="cart-product-detail col-9 p-0">
                                <div class="d-flex">
                                    <div class="w-75">
                                        <h4>{{ $details['name'] }}</h4>
                                    </div>
                                    <div class="w-25 text-right">
                                        <button class="btn btn-sm btn  btn-sm bg-none remove-from-cart h1"
                                            data-id="{{ $id }}"> Remove <i class="bi bi-trash"></i></button>
                                    </div>

                                </div>

                                <h5 class="">Rs.{{ $details['price'] * $details['quantity'] }}</h5>
                                @if(!empty($details['size']))
                                <h6 class="pb-4">Size: {{ $details['size'] }}</h6>
                                @endif
                                <div class="input-group quantity-form" style="width:25%;">
                                    <div class="input-group-prepend quantity-controllers qty-plus"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <div class="input-group-text" id="inputGroupPrepend">+</div>
                                    </div>
                                    <input type="number" class="form-control quantity update-cart" id="qty"
                                        value="{{ $details['quantity'] }}" min="1" data-id="{{$id}}"
                                        aria-describedby="inputGroupPrepend quantity-controllers">
                                    <div class="input-group-append quantity-controllers qty-minus"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <div class="input-group-text" id="inputGroupAppend">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-2 coupon-div border ">
                        <a href="#" data-toggle="modal" class="text-primary" data-target="#ModalSlide">Apply Coupon</a>
                        @if(Session('promo_error'))
                        <p class="alert alert-danger my-2">Invalid or expired coupon</p>
                        @endif
                    </div>
                    <div class="my-3 p-4 total-div border">
                        <div class="total-details border-bottom py-3">

                            <div class="d-flex py-2">


                                <div class="price-details font-weight-bold w-50 ">
                                    Subtotal
                                </div>
                                <div class="w-50 font-weight-bold">Rs. {{ number_format($total)}}</div>
                            </div>
                            <div class="d-flex">
                                <div class="price-details w-50">
                                    Delivery
                                </div>
                                <div class="w-50">Rs. 0</div>
                            </div>
                            @php $promo = 0; @endphp
                            @if(session('promocode'))
                            @if(session('promo_success') == 1)
                            @php $promo = session('promocode') @endphp
                            @php Session::put('coupon', $promo);

                            @endphp

                            <div class="d-flex py-3">
                                <div class="coupon-value w-50 text-success">
                                    Coupon Discount
                                </div>

                                <div class="coupon-amount text-success w-50">
                                    -Rs. {{$promo}}
                                </div>

                            </div>
                            @endif
                            @endif
                            @php

                            Session::put('subtotal', $total);
                            Session::put('total', $total - $promo);
                            @endphp

                            <!-- <div>Total Amount: Rs. 7800</div> -->
                        </div>
                        <div class="d-flex py-3">
                            <div class="total-bill font-weight-bold w-50">Total</div>
                            <div class="total-bill-value font-weight-bold w-50">Rs. {{ number_format($total- $promo) }}
                            </div>
                        </div>

                        <div class="p-4">
                            <a href="{{url(Session('main').'/user-address')}}"
                                class="btn btn-success btn-block">Procceed to pay</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12">

                    <p class="py-4 text-danger">Cart is Empty!,<br><br> <a href="{{ url(Session('main')) }}"
                            class="btn start"><i class="fa fa-angle-left"></i> Continue Shopping</a></p>
                </div>

                @endif
                @else
                <div class="col-md-12">

                    <p class="py-4 text-danger">Cart is Empty!,<br><br> <a href="{{ url(Session('main')) }}"
                            class="btn start"><i class="fa fa-angle-left"></i> Continue Shopping</a></p>
                </div>


                @endif
            </div>

        </div>

        <div class="modal fade" id="ModalSlide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-slideout" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-right" id="exampleModalLabel">Available Coupons.</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        @if(!empty($coupons))
                        @php $i = 0 @endphp
                        @foreach($coupons as $pcode)
                        @php $i++; @endphp
                        <div class="col-md-12"
                            style="margin: 10px;background: white;box-sizing: border-box;box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);padding: 10px;">

                            <b>{{$pcode->coupen_code}}<br>
                                <p>Get upto {{$pcode->coupen_code_value}} off</p>
                            </b>
                            {!! Form::open(['method' => 'POST', 'url' => Session('main').'/promocode_apply', 'enctype'
                            => 'multipart/form-data']) !!}
                            <input type="hidden" class="form-control promocode" value="{{$pcode->coupen_code}}"
                                name="promocode" style="width:75%;">
                            <input type="hidden" class="form-control promocode" value="{{$pcode->id}}" name="coupon_id"
                                style="width:75%;">
                            <input type="submit" class="btn btn-success" value="Apply"
                                style="margin-top: -50px;float: right;">

                            </form>
                            <!--<a href="{{url('cart')}}"style="float: right;margin-top: -55px;color: blue;">Apply</a>-->
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
{{-- <div class="checkout-footer">
    <div class="content">
        <div class="images">
            <img class="footer-bank-ssl" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-ssl.png"
                width="70" height="37" style="float:left">
            <img class="footer-bank-visa" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-visa.png"
                width="60" height="37" style="float:left">
            <img class="footer-bank-mc" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-mc.png"
                width="60" height="37" style="float:left">
            <img class="footer-bank-ae" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-ae.png"
                width="60" height="37" style="float:left">
            <img class="footer-bank-dc" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-dc.png"
                width="60" height="37" style="float:left">
            <img class="footer-bank-nb" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-nb.png"
                width="60" height="37" style="float:left">
            <img class="footer-bank-cod" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-cod.png"
                width="60" height="37" style="float:left">
            <img class="footer-bank-rupay"
                src="https://constant.myntassets.com/checkout/assets/img/footer-bank-rupay.png" width="60" height="37"
                style="float:left">
            <img class="footer-bank-paypal"
                src="https://constant.myntassets.com/checkout/assets/img/footer-bank-paypal.png" width="60" height="37"
                style="float:left">
            <img class="footer-bank-bhim" src="https://constant.myntassets.com/checkout/assets/img/footer-bank-bhim.png"
                width="60" height="37" style="float:left">
        </div>
        <a href="/contactus" class="contact-us"> <span>Need Help ? Contact Us</span> </a>
    </div>
</div>
<section id="products" class="border-top">
    --}}

    <script type="text/javascript">
        $(".quantity-controllers").click(function(){
        if ($(this).hasClass("qty-plus"))
        {
        var ele = $(this).next();


        }else
        {
         var ele = $(this).prev();

        }

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.data('id'),
                quantity: ele.val()
            },
            success: function (response) {
               window.location.reload();
            }
        });

    })
    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.data('id'),
                quantity: ele.val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.data('id')
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    </script>
    @endsection