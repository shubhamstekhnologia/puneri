<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .carousel-wrap {
        width: 1225px;
        margin: auto;
        position: relative;
    }

    .owl-carousel .owl-nav {
        overflow: hidden;
        height: 0px;
    }

    .owl-theme .owl-dots .owl-dot.active span,
    .owl-theme .owl-dots .owl-dot:hover span {
        background: #2caae1;
    }

    .abc {
        background: rgba(255, 63, 108, .8);
        display: inline-block;
        position: absolute;
        top: 5px;
        left: 5px;
        text-transform: uppercase;
        color: #fff;
        font-size: 10px;
        font-weight: 500;
        z-index: 1;
        padding: 0 4px;
        line-height: 16px;
    }

    .owl-carousel .item {
        text-align: center;
    }

    .owl-carousel .nav-btn {
        height: 47px;
        position: absolute;
        width: 26px;
        cursor: pointer;
        top: 100px !important;
    }

    .owl-carousel .owl-prev.disabled,
    .owl-carousel .owl-next.disabled {
        pointer-events: none;
        opacity: 0.2;
    }

    .owl-carousel .prev-slide {
        background: url('images/img/nav-icon.png') no-repeat scroll 0 0;
        left: -33px;
    }

    .owl-carousel .next-slide {
        background: url('images/img/nav-icon.png') no-repeat scroll -24px 0px;
        right: -33px;
    }

    .owl-carousel .prev-slide:hover {
        background-position: 0px -53px;
    }

    .owl-carousel .next-slide:hover {
        background-position: -24px -53px;
    }


    .picZoomer {
        position: relative;
        /*margin-left: 40px;
    padding: 15px;*/
    }

    .picZoomer-pic-wp {
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .picZoomer-pic-wp:hover .picZoomer-cursor {
        display: block;
    }

    .picZoomer-zoom-pic {
        position: absolute;
        top: 0;
        left: 0;
    }

    .picZoomer-pic {
        /*width: 100%;
	height: 100%;*/
    }

    .picZoomer-zoom-wp {
        display: none;
        position: absolute;
        z-index: 999;
        overflow: hidden;
        border: 1px solid #eee;
        height: 460px;
        margin-top: -19px;
    }

    .picZoomer-cursor {
        display: none;
        cursor: crosshair;
        width: 100px;
        height: 100px;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 50%;
        border: 1px solid #eee;
        background-color: rgba(0, 0, 0, .1);
    }

    .picZoomCursor-ico {
        width: 23px;
        height: 23px;
        position: absolute;
        top: 40px;
        left: 40px;
        background: url(images/zoom-ico.png) left top no-repeat;
    }

    .my_img {
        vertical-align: middle;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        height: 100%;
    }

    .piclist li {
        display: inline-block;
        width: 90px;
        height: 114px;
        border: 1px solid #eee;
    }

    .piclist li img {
        width: 97%;
        height: auto;
    }

    /* custom style */
    .picZoomer-pic-wp,
    .picZoomer-zoom-wp {
        border: 1px solid #eee;
    }




    section {
        padding: 60px 0;
    }

    .row-sm .col-md-6 {
        padding-left: 5px;
        padding-right: 5px;
    }

    .zoom-img:hover {
        -ms-transform: scale(2.5);
        /* IE 9 */
        -webkit-transform: scale(2.5);
        /* Safari 3-8 */
        transform: scale(2.5);
    }

    /*===pic-Zoom===*/
    ._boxzoom .zoom-thumb {
        width: 80px;
        display: inline-block;
        vertical-align: top;
        margin-top: 0px;
        height: 460px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    ._boxzoom .zoom-thumb ul.piclist {
        padding-left: 0px;
        top: 0px;
    }

    ._boxzoom ._product-images {
        width: 80%;
        display: inline-block;
    }

    ._boxzoom ._product-images .picZoomer {}

    ._boxzoom ._product-images .picZoomer .picZoomer-pic-wp img {
        left: 0px;
    }

    ._boxzoom ._product-images .picZoomer img.my_img {
        width: 100%;
    }

    .piclist li img {
        height: 100px;
        object-fit: cover;
    }

    /*======products-details=====*/
    ._product-detail-content {
        background: #fff;
        padding: 15px;
        /*border: 1px solid lightgray;*/
    }

    ._product-detail-content p._p-name {
        color: black;
        font-size: 20px;
        /*border-bottom: 1px solid lightgray;*/
        padding-bottom: 12px;
    }

    .p-list span {
        margin-right: 15px;
    }

    .p-list span.price {
        font-size: 25px;
        color: #318234;
    }

    ._p-qty>span {
        color: black;
        margin-right: 15px;
        font-weight: 500;
    }

    ._p-qty .value-button {
        display: inline-flex;
        border: 0px solid #ddd;
        margin: 0px;
        width: 30px;
        height: 35px;
        justify-content: center;
        align-items: center;
        background: #fd7f34;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: #fff;
    }

    ._p-qty .value-button {
        border: 0px solid #fe0000;
        height: 35px;
        font-size: 20px;
        font-weight: bold;
    }

    ._p-qty input#number {
        text-align: center;
        border: none;
        border-top: 1px solid #fe0000;
        border-bottom: 1px solid #fe0000;
        margin: 0px;
        width: 50px;
        height: 35px;
        font-size: 14px;
        box-sizing: border-box;
    }

    ._p-add-cart {
        margin-left: 0px;
        margin-bottom: 15px;
    }

    .p-list {
        margin-bottom: 10px;
    }

    ._p-features>span {
        display: block;
        font-size: 16px;
        color: #000;
        font-weight: 500;
    }

    ._p-add-cart .buy-btn {
        background-color: #fd7f34;
        color: #fff;
    }

    ._p-add-cart .btn {
        text-transform: capitalize;
        padding: 6px 20px;
        /* width: 200px; */
        border-radius: 52px;
    }

    ._p-add-cart .btn {
        margin: 0px 8px;
    }

    /*=========Recent-post==========*/
    .title_bx h3.title {
        font-size: 22px;
        text-transform: capitalize;
        position: relative;
        color: #fd7f34;
        font-weight: 700;
        line-height: 1.2em;
    }

    .title_bx h3.title:before {
        content: "";
        height: 2px;
        width: 20%;
        position: absolute;
        left: 0px;
        z-index: 1;
        top: 40px;
        background-color: #fd7f34;
    }

    .title_bx h3.title:after {
        content: "";
        height: 2px;
        width: 100%;
        position: absolute;
        left: 0px;
        top: 40px;
        background-color: #ffc107;
    }

    .common_wd .owl-nav .owl-prev,
    .common_wd .owl-nav .owl-next {
        background-color: #fd7f34 !important;
        display: block;
        height: 30px;
        width: 30px;
        text-align: center;
        border-radius: 0px !important;
    }

    .owl-nav .owl-next {
        right: -25px;
    }

    .owl-nav .owl-prev {
        left: -25px;
    }

    .owl-nav .owl-prev,
    .owl-nav .owl-next {
        top: 50%;
        position: absolute;
        font-size: 25px;
    }

    .common_wd .owl-nav .owl-prev i,
    .common_wd .owl-nav .owl-next i {
        color: #fff;
        font-size: 14px !important;
        position: relative;
        top: -1px;
    }

    .common_wd .owl-nav {
        position: absolute;
        top: -21%;
        right: 4px;
        width: 65px;
    }

    .owl-nav .owl-prev i,
    .owl-nav .owl-next i {
        left: 0px;
    }

    ._p-qty .decrease_ {
        position: relative;
        right: -5px;
        top: 3px;
    }

    ._p-qty .increase_ {
        position: relative;
        top: 3px;
        left: -5px;
    }

    /*========box========*/
    .sq_box {
        padding-bottom: 5px;
        border-bottom: solid 2px #fd7f34;
        background-color: #fff;
        text-align: center;
        padding: 15px 10px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .item .sq_box span.wishlist {
        right: 5px !important;
    }

    .sq_box span.wishlist {
        position: absolute;
        top: 10px;
        right: 20px;
    }

    .sq_box span {
        font-size: 14px;
        font-weight: 600;
        margin: 0px 10px;
    }

    .sq_box span.wishlist i {
        color: #adb5bd;
        font-size: 20px;
    }

    .sq_box h4 {
        font-size: 18px;
        text-align: center;
        font-weight: 500;
        color: #343a40;
        margin-top: 10px;
        margin-bottom: 10px !important;
    }

    .sq_box .price-box {
        margin-bottom: 15px !important;
    }

    .sq_box .btn {
        border-radius: 50px;
        padding: 5px 13px;
        font-size: 15px;
        color: #fff;
        background-color: #fd7f34;
        font-weight: 600;
    }

    .sq_box .price-box span.price {
        text-decoration: line-through;
        color: #6c757d;
    }

    .sq_box span {
        font-size: 14px;
        font-weight: 600;
        margin: 0px 10px;
    }

    .sq_box .price-box span.offer-price {
        color: #28a745;
    }

    .sq_box img {
        object-fit: cover;
        height: 150px !important;
        margin-top: 20px;
    }

    .sq_box span.wishlist i:hover {
        color: #fd7f34;
    }

    #orange,
    select,
    .btn {
        color: black;
        font-size: 12px;
    }

    .discount {
        border: 1px solid orange;
        border-radius: 5px;
        position: absolute;
        bottom: 24%;
        background: red;
    }

    .size_box {

        height: 120px;
    }

    .color_box {

        height: 143px;
    }

    .size_span {
        padding: 16px;
        border-radius: 50%;
        border: 1px solid;
    }


    .color_col {
        border: 1px solid;
        width: 19px;
        padding: 3px;
    }

    .rating_box {
        height: 5px;
    }


    .star_text {
        margin-top: -10px;
    }

    ._p-name {
        color: #535665;
        padding: 5px 20px 14px 0;
        font-size: 20px;
        opacity: .8;
        font-weight: 400;
        margin-top: -25px;
        margin-left: 2px;
    }


    .discount_text {
        font-size: 20px;
        font-weight: 500;
        letter-spacing: .5px;
        color: #ff905a;
    }

    .pdp-vatInfo {
        color: #03a685;
        font-weight: 500;
        font-size: 14px;
        display: block;
        margin: 5px 10px 0 0;
    }

    .size-buttons-select-size {
        display: inline-block;
        font-size: 16px;
        margin: 0;
        font-weight: 500;
    }

    .pincode-deliveryContainer {
        margin-top: 30px;
    }

    .tooltip-inner {
        background-color: #262626 !important;
    }

    .tooltip .arrow {
        top: -30px !important;
    }

    .tooltip .arrow:before {
        border-right-color: #262626 !important;
    }

    .size-boxes:hover {
        background-color: green;
        border-color: green;
        color: #fff;
    }

    .checked-star {
        color: orange;
    }

    ._boxzoom .show_only_mobile {
        display: none;
    }

    @media (max-width:992px) {
        ._boxzoom .zoom-thumb {
            display: none;
        }

        ._boxzoom .show_only_mobile {
            display: block;
        }

        ._boxzoom .zoom-thumb {
            width: 80px;
            vertical-align: top;
            margin-top: 0px;
            height: 90px;
            overflow-x: scroll;
            overflow-y: hidden;
        }

        .piclist li img {
            height: 100px;
            object-fit: cover;
        }
    }
</style>
@if (Session::has('AccessTokens'))

<?php $value = Session::get('AccessTokens') ?>

@endif
@extends('templates.frontend.header')
@section('content')

<section id="services" class="services section-bg">
    <div class="container-fluid">

        <div class="row row-sm">
            <div class="col-md-6 _boxzoom">
                <div class="zoom-thumb show_only_desktop">

                    <ul class="piclist">
                        <!--<li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        <!-- <li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        <!--  <li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        <!--   <li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        @if($pimages_lists->isNotEmpty())
                        @php $i = 0 @endphp
                        @foreach($pimages_lists as $wholesalers)
                        @php $i++; @endphp
                        @if($product_details->_id == $wholesalers->product_auto_id)
                        <li><img src="{{asset('images/products_images/'.$wholesalers['image_file'])}}" alt=""></li>


                        @endif

                        @endforeach

                        @endif

                    </ul>
                </div>

                <div class="_product-images">
                    <div class="picZoomer px-2">
                        @if($pimages_lists->isNotEmpty())

                        @foreach($pimages_lists as $wholesalers)

                        @if($product_details->_id == $wholesalers->product_auto_id)
                        <img class="my_img " src="{{asset('images/products_images/'.$wholesalers['image_file'])}}">


                        @endif

                        @endforeach

                        @endif
                    </div>
                </div>
                <div class="zoom-thumb show_only_mobile my-2 px-2">

                    <ul class="piclist">
                        <!--<li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        <!-- <li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        <!--  <li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        <!--   <li><img src="../images/products_images/{{$product_details["image_file"]}}" alt=""></li>-->
                        @if($pimages_lists->isNotEmpty())
                        @php $i = 0 @endphp
                        @foreach($pimages_lists as $wholesalers)
                        @php $i++; @endphp
                        @if($product_details->_id == $wholesalers->product_auto_id)
                        <li><img src="{{asset('images/products_images/'.$wholesalers['image_file'])}}" alt=""></li>


                        @endif

                        @endforeach

                        @endif

                    </ul>
                </div>
                <hr>

                <div class="container">
                    <h3>Customer Reviews </h3>

                    <div class="collapse" id="reviewproduct">
                        <div class="card card-body">
                            {!! Form::open(['method' => 'POST', 'url' => 'rate_product', 'enctype' =>
                            'multipart/form-data', 'id' => 'rating']) !!}
                            @csrf
                            <div class="form-group">

                                <label for="exampleFormControlTextarea1">Rate this product</label>
                                <div class="d-flex rating-stars">
                                    <i class="far fa-star pr-2 rating-star" data-value="1"></i>
                                    <i class="far fa-star px-2 rating-star" data-value="2"></i>
                                    <i class="far fa-star px-2 rating-star" data-value="3"></i>
                                    <i class="far fa-star px-2 rating-star" data-value="4"></i>
                                    <i class="far fa-star px-2 rating-star" data-value="5"></i>
                                </div>
                                <input type="hidden" name="rating" id="rating_count">
                                <input type="hidden" name="product_id" value="{{$product_details->id}}">

                            </div>

                            <div class="form-group my-4">
                                <label for="">Upload product image <small class="text-muted">Optional</small></label>
                                <input type="file" class="form-control-file" name="review_image"
                                    accept="image/png, image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Leave a review</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    name="review"></textarea>
                            </div>
                            <div class="text-right"><button class="btn btn-primary" type="submit">Submit review</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @if(!empty($product_rating))
                    @foreach($product_rating as $rating)

                    <div class="row" style="margin-top: 15px;">
                        <div class="_product-detail-content rating_box" style="border:1px solid gray;">

                            <p class="star_text">{{$rating["rating"]}} <i class="fa fa-star"
                                    style="color:green"></i>Rating</p>
                        </div>
                        <div><img src="../images/RatingReview/{{$rating["review_image"]}}"
                                style="width:100px;height:100px;margin: auto;"><br>
                            <p>{{$rating["review"]}}<br>
                                <b style="font-size:10px;float:right;">{{$rating["name"]}} | {{$rating["rdate"]}}</b>
                            </p>
                        </div>

                    </div>


                    @endforeach

                    @else
                    <p class="text-muted">There are no customer reviews for this product</p>
                    @endif
                </div>

            </div>
            <div class="col-md-6">
                <div class="_product-detail-content">
                    <p class="_p-name"><b>{{$product_details["product_name"]}}</b></p>
                    <div class="_p-price-box">
                        <div class="col-lg-12 mt-3">
                            <div class="_product-detail-content rating_box">

                                <p class="star_text">{{$avg_rating}} <i class="fa fa-star" style="color:green"></i> |
                                    {{$total_rating_count}} Rating</p>
                            </div>

                        </div>
                        <hr />
                        <div class="p-list">
                            @if($price_lists->isNotEmpty())
                            @foreach($price_lists as $cprice)
                            @if($cprice["product_auto_id"] == $product_details['_id'])
                            <span class="price"><strong style="color:black;">
                                    {{$cprice["currency"]}}{{number_format($cprice["final_price"])}}</strong></span>
                                @if($cprice["offer_percentage"] != "0" && $cprice["offer_percentage"] != "")
                                <span style="text-decoration: line-through;"> {{$cprice["currency"]}}
                                    {{number_format($cprice["product_price"])}} </span>
                                <span class="discount_text">Discount {{$cprice["offer_percentage"]}}% </span>
                                @endif
                                <span class="pdp-vatInfo">inclusive of all taxes</span>

                                @php break; @endphp
                            @endif

                            @endforeach

                            @endif
                        </div>
                        {{-- @if($get_slists)
                        <div class="_product-detail-content size_box">
                            <p class="size-buttons-select-size">Select Size&nbsp;<a href="#" style="margin-left:10px;"
                                    data-toggle="modal" data-target="#sizechart">Size Chart</a></p>
                            <div class="container">
                                <br />


                                <a>
                                    <div class="row">
                                        @if($get_slists)
                                        @foreach($get_slists as $sizelist)

                                        <div class="col-md-2 col-lg-2 col-sm-6 size-boxes"
                                            data-route="{{route('add.to.cart', $product_details['_id'].'&'.$sizelist['size_name'])}}"
                                            data-size="" style="border: 1px solid;padding: 5px;margin: 5px;">
                                            <span>{{$sizelist["size_name"]}}&nbsp;</span>
                                        </div>

                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="row" style=" margin-top: 2%;">
                                        @if($get_plists)

                                        @foreach($get_plists as $sizeprice)


                                        <div class="col-md-2 col-lg-2 col-sm-6">
                                            <p><b>Rs.{{$sizeprice["size_price"]}}</b></p>
                                        </div>
                                        @endforeach

                                        @endif
                                    </div>
                                </a>



                            </div>
                        </div>
                        @endif --}}

                        @if($get_cproducts)
                        <div class="_product-detail-content">
                            <!--<div class="container">-->
                            <!--                   <h6>Choose From the colors</h6>-->
                            <!--                  <div class="row">-->
                            <!--                      <div class="owl-carousel owl-theme">-->


                            <!--                      @foreach($get_cproducts as $colors)-->
                            <!--                      <div class="item" style="padding:5px;">-->


                            <!--                     <a href="{{url('product-detail',$colors['product_auto_id'])}}"> <div class="col color_col" style="height: 90%;">-->
                            <!--                          <img src="../images/products_images/{{$colors["color_image"]}}" style="height:70px;">-->
                            <!--                          <h6 style="font-size: 12px;text-align:center;padding: 0px;color:black;">{{$colors["color_name"]}}</h6>-->
                            <!--                      </div></a>-->

                            <!--                      </div>-->
                            <!--                        @endforeach-->


                            <!--                      </div>-->
                            <!--                         </div>-->
                            <!--                      </div>-->
                        </div>
                        @endif
                        <!--<div class="_p-add-cart">-->
                        <!--   <div class="_p-qty">-->
                        <!--      <span>Add Quantity</span>-->
                        <!--      <div class="value-button decrease_" id="" value="Decrease Value">-</div>-->
                        <!--      <input type="number" name="qty" id="number" value="1" />-->
                        <!--      <div class="value-button increase_" id="" value="Increase Value">+</div>-->
                        <!--   </div>-->

                        <!--</div>-->

                        <div class="col-lg-12 mt-3">
                            <div class="row">
                                <div class="col-lg-4 pb-2">

                                    @if (Session::has('AccessTokens') !='')
                                    @if(Session('cart'))
                                    @php $in_cart = false; @endphp
                                    @foreach(Session('cart') as $id =>$prod)
                                    @if($id == $product_details['_id'])
                                    @php $in_cart = true; @endphp
                                    @endif
                                    @endforeach
                                    @if ($in_cart)
                                    <p class="btn-holder"><button data-toggle="tooltip" data-placement="bottom"
                                            title="Product added to cart, go to cart to add more quantity"
                                            class="btn w-100 btn-cart btn-secondary text-center text-white"
                                            role="button">Added to cart</button> </p>
                                    @else

                                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product_details->id) }}"
                                            class="btn w-100 btn-warning text-center text-white"
                                            role="button">Add to cart</a> </p>
                                    @endif
                                    @else
                                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product_details->id) }}"
                                            class="btn w-100 btn-warning text-center text-white"
                                            role="button">Add to cart</a> </p>
                                    @endif
                                    @else

                                    <button onclick="location.href = '../login';" type="submit"
                                        class="btn w-100 btn-cart btn-warning text-center text-white">Add to
                                        cart</button>

                                    @endif
                                </div>
                                <div class="col-lg-4 pb-2">
                                    @if (Session::has('AccessTokens') !='')


                                    <!--{!! Form::open(['method' => 'POST', 'url' => 'buy_now', 'enctype' => 'multipart/form-data']) !!}-->

                                    <!-- <input name="user_auto_id" type="hidden" value="{{$value}}" />                           -->
                                    <!-- <input name="product_auto_id" type="hidden" value="{{$product_details["_id"]}}" />-->
                                    <!-- <input name="cart_quantity" type="hidden" value="1" />-->

                                    <!--<button type="submit" class="btn btn-success w-100" style="color:white;font-weight:500font-size:13px;">Buy Now</button>-->


                                    <!--</form>-->
                                    <p class="btn-holder"><a href="{{ route('add.to.buynow', $product_details->id) }}"
                                            class="btn btn-success w-100" role="button"
                                            style="color:white;font-weight:500; color: white;background: purple;border: purple;">Buy
                                            Now</a> </p>
                                    @else
                                    <button onclick="show_login()" type="submit" class="btn btn-success w-100"
                                        style="color:white;font-weight:500; color: white;background: purple;border: purple;">Buy
                                        Now</button>


                                    @endif
                                </div>
                                <div class="col-lg-4">



                                    @if (Session::has('AccessTokens'))
                                    @php $wished = 0; @endphp


                                    {!! Form::open(['method' => 'POST', 'url' => 'wishlist', 'enctype' =>
                                    'multipart/form-data']) !!}

                                    <input name="user_auto_id" type="hidden" value="{{$value}}" />
                                    <input name="product_auto_id" type="hidden" value="{{$product_details['_id']}}" />
                                    @foreach($wproducts as $wproduct)
                                    @if($wproduct['product_auto_id'] == $product_details['_id'])
                                    @php $wished = 1; @endphp
                                    @php break; @endphp
                                    @endif
                                    @endforeach

                                    @if($wished == 1)
                                    <button type="submit" class="btn btn-success btn-block "
                                        style="padding: 3px;color:maroon;">wishlisted</button>
                                    @else
                                    <button type="submit" class="btn btn-outline-success btn-block"
                                        style="padding: 3px;">add to wishlist</i></button>
                                    @endif


                                    </form>

                                    @else
                                    <button onclick="show_login();" type="submit"
                                        class="btn btn-outline-success btn-block" style="padding: 3px;">add to
                                        wishlist</button>

                                    @endif
                                </div>


                            </div>
                            <div class="col-lg-8 mt-3">

                                <div class="pincode-checkServiceAbilityhalfCard">
                                    <div class="pincode-deliveryContainer">
                                        <h4>
                                            <!-- react-text: 231 -->Delivery Options
                                            <!-- /react-text -->
                                            <span
                                                class="myntraweb-sprite pincode-deliveryOptionsIcon sprites-deliveryOptionsIcon"></span>
                                        </h4>
                                        {!! Form::open(['method' => 'POST', 'url' => 'pincode_availability', 'enctype'
                                        => 'multipart/form-data']) !!}
                                        <input type="hidden" name="id" value="{{$product_details->_id}}">
                                        <input type="text" placeholder="Enter pincode" class="form-control" value=""
                                            id="pincode" name="pincode" style="width:78%;">
                                        <input type="submit" class="btn btn-success" value="Check"
                                            style="float: right;margin-top: -38px; margin-right:-20px">

                                        </form>
                                        @include('templates.frontend.messages')
                                        <p class="pincode-enterPincode">Please enter PIN code to check delivery time
                                            &amp; Pay on Delivery Availability</p>
                                        <h6>Expected delivery in: {{$product_details["time"]}}
                                            {{$product_details["time_unit"]}}</h6>
                                        @if($product_details["isReturn"] == "Yes")
                                        <h6>Return/Exchange</h6>
                                        <p class="pincode-enterPincode">Easy return and exchange available within
                                            {{$product_details["days"]}} days.</p>
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-12 mt-3">
                                <div class="pdp-productDescriptorsContainer">
                                    <div>
                                        @if ($product_details["description"] != "")
                                        <h4 class="pdp-product-description-title">
                                            <!-- react-text: 261 -->Description
                                            <!-- /react-text -->
                                            <span
                                                class="myntraweb-sprite pdp-productDetailsIcon sprites-productDetailsIcon"></span>
                                        </h4>
                                        <p class="pdp-product-description-content">{{$product_details["description"]}}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="pdp-sizeFitDesc">
                                        @if(!empty($get_specification_details))

                                        <div class="index-sizeFitDesc">
                                            <h4 class="index-sizeFitDescTitle index-product-description-title"
                                                style="padding-bottom: 12px;">Specifications</h4>
                                            <div class="index-tableContainer">
                                                <div class="index-row">
                                                    <table class="table table-striped">


                                                        <tbody>
                                                            <tr>
                                                                @if($get_specification_details)

                                                                @foreach($get_specification_details as $speccification)
                                                                <td>{{$speccification["title"]}}</td>
                                                                @endforeach
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                @if($get_specification_details)

                                                                @foreach($get_specification_details as $speccification)
                                                                <td>{{$speccification["description"]}}</td>
                                                                @endforeach
                                                                @endif
                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
</section>
<div class="clearfix"></div>
<section id="products">


    <div class="container-fluid">
        <div class="col-md-12 ">
            <hr class="pb-4">
            <h4 class="p-3 text-center font-weight-bold position-absolute"
                style="top:-28px; left:40%; background-color:#fff">Similar Products</h4>

            <div class="carousel-wrap" id="similars">
                <div class="owl-carousel owl-theme">
                    @if(!empty($get_sponcerproducts))
                    @php $i = 0 @endphp
                    @php $has_price_ids = array(); @endphp
                    @foreach($get_sponcerproducts as $products)
                    @foreach($price_lists as $cprice)
                    @if($products['product_auto_id'] == $cprice['product_auto_id'])
                    @php array_push($has_price_ids, $products['product_auto_id']); @endphp
                    @endif
                    @endforeach
                    @endforeach

                    @foreach($get_sponcerproducts as $ssproducts)
                    @if (!in_array($ssproducts['product_auto_id'], $has_price_ids))
                    @php continue; @endphp
                    @endif
                    @php $i++; @endphp
                    <a href="{{url('product-detail',$ssproducts['product_auto_id'])}}">
                        <div class="item">
                            <div class="card"> <img class="card-img-top" src="{{asset('images/products_images/'.$ssproducts['product_image'])}}" style="height:300px;">
                                <div class="card-body" style="padding: 5px;">


                                    @if($ssproducts["new_arrival"] == "Yes")
                                    <div class="abc">NEW ARRIVAL</div>
                                    @endif
                                    @if($price_lists->isNotEmpty())
                                    @foreach($price_lists as $cprice)
                                    @if($ssproducts["product_auto_id"] == $cprice["product_auto_id"])
                                    <div class="d-flex justify-content-center mt-1">

                                        <h6 class="font-weight-bold px-1 ">
                                            {{$cprice["currency"]}}{{number_format($cprice["final_price"])}}</h6>
                                        @if($cprice["offer_percentage"] != "0" && $cprice["offer_percentage"] != "")
                                        <h6 style="text-decoration:line-through;">
                                            {{$cprice["currency"]}}{{number_format($cprice["product_price"])}}</h6>
                                        <h6 class="text-success">&nbsp({{$cprice["offer_percentage"]}}% OFF)</h6>
                                        @endif

                                    </div>
                                    @php break; @endphp
                                    @endif

                                    @endforeach
                                    @endif
                                    <h6 class="text-center pb-3" style="padding: 0px;color:black;">
                                        {{$ssproducts["product_name"]}}</h6>

                                </div>

                            </div>
                        </div>
                    </a>
                    @endforeach
                    @else

                    <h4 class="box-title" style="font-size: 14px;text-align:center;color:red">Not Available any data
                    </h4>
                    @endif

                </div>

            </div>

        </div>

    </div>
</section>
<div class="clearfix"></div>

<script>
    (function($){
	$.fn.picZoomer = function(options){
		var opts = $.extend({}, $.fn.picZoomer.defaults, options),
			$this = this,
			$picBD = $('<div class="picZoomer-pic-wp"></div>').css({'width':opts.picWidth+'px', 'height':opts.picHeight+'px'}).appendTo($this),
			$pic = $this.children('img').addClass('picZoomer-pic').appendTo($picBD),
			$cursor = $('<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>').appendTo($picBD),
			cursorSizeHalf = {w:$cursor.width()/2 ,h:$cursor.height()/2},
			$zoomWP = $('<div class="picZoomer-zoom-wp"><img src="" alt="" class="picZoomer-zoom-pic"></div>').appendTo($this),
			$zoomPic = $zoomWP.find('.picZoomer-zoom-pic'),
			picBDOffset = {x:$picBD.offset().left,y:$picBD.offset().top};


		opts.zoomWidth = opts.zoomWidth||opts.picWidth;
		opts.zoomHeight = opts.zoomHeight||opts.picHeight;
		var zoomWPSizeHalf = {w:opts.zoomWidth/2 ,h:opts.zoomHeight/2};

		$zoomWP.css({'width':opts.zoomWidth+'px', 'height':opts.zoomHeight+'px'});
		$zoomWP.css(opts.zoomerPosition || {top: 0, left: opts.picWidth+30+'px'});

		$zoomPic.css({'width':opts.picWidth*opts.scale+'px', 'height':opts.picHeight*opts.scale+'px'});


		$picBD.on('mouseenter',function(event){
			$cursor.show();
			$zoomWP.show();
			$zoomPic.attr('src',$pic.attr('src'))
		}).on('mouseleave',function(event){
			$cursor.hide();
			$zoomWP.hide();
		}).on('mousemove', function(event){
			var x = event.pageX-picBDOffset.x,
				y = event.pageY-picBDOffset.y;

			$cursor.css({'left':x-cursorSizeHalf.w+'px', 'top':y-cursorSizeHalf.h+'px'});
			$zoomPic.css({'left':-(x*opts.scale-zoomWPSizeHalf.w)+'px', 'top':-(y*opts.scale-zoomWPSizeHalf.h)+'px'});

		});
		return $this;

	};
	$.fn.picZoomer.defaults = {
        picHeight: 460,
		scale: 1.5,
		zoomerPosition: {top: '0', left: '380px'},

		zoomWidth: 400,
		zoomHeight: 460
	};
})(jQuery);



$(document).ready(function () {

      $("#owl-demo").owlCarousel({
    navigation : true
  });


     $('.picZoomer').picZoomer();
    $('.piclist li').on('click', function (event) {
        var $pic = $(this).find('img');
        $('.picZoomer-pic').attr('src', $pic.attr('src'));
    });

  var owl = $('#similars');
              owl.owlCarousel({
                margin:40,
                dots:false,
                nav: true,
                navText: [
                  "<i class='fa fa-chevron-left'></i>",
                  "<i class='fa fa-chevron-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                  0: {
                    items: 2
                  },
                  600: {
                    items:3
                  },
                  1000: {
                    items:5
                  },
                  1200: {
                    items:4
                  }
                }
  });

        $('.decrease_').click(function () {
            decreaseValue(this);
        });
        $('.increase_').click(function () {
            increaseValue(this);
        });
        function increaseValue(_this) {
            var value = parseInt($(_this).siblings('input#number').val(), 10);
            value = isNaN(value) ? 0 : value;
            value++;
            $(_this).siblings('input#number').val(value);
        }

        function decreaseValue(_this) {
            var value = parseInt($(_this).siblings('input#number').val(), 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $(_this).siblings('input#number').val(value);
        }
    });


 $('.owl-carousel').owlCarousel({
            margin: 10,
            nav: true,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 5
                },
                1000: {
                    items: 5
                }
            }
        });


        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<!-- Catgeory Modal -->
<div class="modal fade" id="sizechart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['method' => 'POST', 'url' => 'add_main_category', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Size Chart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div aria-hidden="true">&times;</div>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">

                        <img src="../images/products/{{$product_details[" product_img"]}}" class="img img-responsive">
                        Nayo{{$product_details["product_name"]}}
                        <p style="font-size: 16px;"><span tabindex="0"><strong>? 1259</strong></span>
                            <!-- react-empty: 1476 -->
                            <span><s>
                                    <!-- react-text: 1479 -->?
                                    <!-- /react-text -->
                                    <!-- react-text: 1480 -->3499
                                    <!-- /react-text -->
                                </s></span><span class="PriceInfo-discount">(64% OFF)</span>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-12">
                        <img src="../images/img/sizechart.PNG" class="img img-responsive">
                    </div>
                    <div class="col-md-12">
                        <br />
                        <img src="../images/img/howtomeasure.PNG" class="img img-responsive">
                    </div>
                </div>

            </div>
            <div class="modal-footer">


                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    $(".size-boxes").click(function(){
        $('.add-to-cart').href= $(this).data("route");
        $(".size-boxes").removeClass("bg-success")
        $(".size-boxes").removeClass("text-white")

        $(this).addClass("bg-success");
        $(this).addClass("text-white");
        location.href = $(this).data("route");

    })
    $(".rating-star").hover(function()
    {
        $(this).prevAll().addClass("checked-star")
        $(this).addClass("checked-star")
        $(this).nextAll().removeClass("checked-star")
    })
      $(".rating-star").click(function()
    {
        $(this).prevAll().removeClass("far fa-star")
        $(this).prevAll().addClass("fas fa-star")
        $(this).removeClass("far fa-star")
        $(this).addClass("fas fa-star")

        $("#rating_count").val($(this).data("value"))

    })
</script>

@endsection