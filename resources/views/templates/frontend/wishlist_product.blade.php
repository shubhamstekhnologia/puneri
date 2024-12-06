<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
    #search {
        outline: none;
        border: none;
        display: inline-block
    }

    #burgundy {
        color: black
    }

    #orange,
    select,
    .btn {
        color: black;
        font-size: 12px;
    }

    .fa-search {
        font-size: 20px;
        padding: 10px;
        margin-bottom: 3px;
        padding-right: 20px
    }

    .search-nav-item {
        height: 40px
    }

    nav {
        padding: 0px 100px
    }

    .fa-user-o,
    .fa-shopping-cart {
        font-size: 20px;
        padding: 4px
    }

    .form-group {
        margin-bottom: 5px
    }

    label {
        padding-left: 10px
    }

    .form-group:last-child {
        margin-bottom: 0
    }

    h6 {
        margin-bottom: 0px
    }

    #sort {
        outline: none;
        border: none
    }

    .btn {
        border: 1px solid orange;
        border-radius: 10px;
        background-color: #fff
    }

    .btn:hover {
        color: #fff;
        background-color: orange
    }

    .card-body {
        padding: 8px
    }

    .sign {
        width: 25px;
        height: 25px
    }

    .discount {
        border: 1px solid orange;
        border-radius: 5px;
        width: 50px;
        position: absolute;
        top: 2%;
        right: 0%;
        background: red;
        display: inline-block;
        z-index: 1;
        padding: 2px;
    }

    h5 {
        padding: 0px;
    }

    p {
        margin: 0px;
    }

    @media(min-width:1200px) {
        #search {
            width: 300px;
            padding: 5px;
            padding-left: 20px
        }

        .search-nav-item {
            margin-left: 400px;
            width: 350px
        }

        .fa-user-o {
            margin-left: 300px
        }

        .text {
            display: none
        }

        .fa-user-o,
        .fa-shopping-cart {
            font-size: 20px;
            padding-left: 20px
        }

        #sidebar {
            width: 22%;
            padding: 20px;
            float: left;
            padding-right: 0px;
        }

        #products {
            width: 100%;
            padding: 10px;
            margin: 0;

        }

        .card {

            height: 330px;
            border: none
        }

        .card-img-top {

            height: 280px;
        }

        del {
            padding-right: 2px
        }

        .filter,
        #mobile-filter {
            display: none
        }
    }

    .carousel-wrap {
        margin: auto;
        padding: 0 5%;
        width: 80%;
        position: relative;
    }

    /* fix blank or flashing items on carousel */
    .owl-carousel .item {
        position: relative;
        z-index: 100;
        -webkit-backface-visibility: hidden;
    }

    /* end fix */
    .owl-nav>div {
        margin-top: -26px;
        position: absolute;
        top: 50%;
        color: #cdcbcd;
    }

    .owl-nav i {
        font-size: 52px;
    }

    .owl-nav .owl-prev {
        left: -30px;
    }

    .owl-nav .owl-next {
        right: -30px;
    }

    @media(min-width:992px) and (max-width:1199px) {
        #search {
            width: 300px;
            padding: 5px;
            padding-left: 20px
        }

        .search-nav-item {
            margin-left: 200px;
            width: 350px
        }

        .fa-user-o {
            margin-left: 160px
        }

        .text {
            display: none
        }

        #sidebar {
            width: 30%;
            padding: 20px;
            float: left
        }

        .item,
        .price {
            clear: left;
            width: 100%;
            text-align: center;
        }

        .price {
            color: Grey;
        }

        .description,
        label,
        button,
        input {
            float: left;
            clear: left;
            width: 100%;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            font-size: 1em;
            text-align: center;
            margin: 0.2em auto;
        }

        #products {
            width: 70%;
            padding: 10px;
            margin: 0;
            float: right;

        }

        .card {
            width: 200px;
            height: 330px;
            border: none
        }

        .card-img-top {
            width: 200px;
            height: 200px;
            border-radius: 10px
        }

        .fa-plus,
        .fa-minus {
            font-size: 12px
        }

        .sign {
            height: 25px
        }

        .price {
            width: 99px
        }

        .filter,
        #mobile-filter {
            display: none
        }
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
    }

    @media(min-width:768px) and (max-width:991px) {
        #search {
            width: 300px;
            padding: 5px;
            padding-left: 20px
        }

        .search-nav-item {
            margin-left: 60px;
            width: 350px
        }

        .fa-user-o {
            margin-left: 80px
        }

        .text {
            display: none
        }

        #sidebar {
            width: 35%;
            padding: 20px;
            float: left
        }

        #products {
            width: 65%;
            padding: 10px;
            margin: 0;
            float: right
        }

        .card {
            border: none
        }

        .filter,
        #mobile-filter {
            display: none
        }
    }

    @media(min-width:576px) and (max-width:767px) {
        .text {
            display: none
        }

        .search-nav-item {
            margin-left: 35px;
            width: 270px
        }

        #search {
            width: 240px;
            padding: 5px;
            padding-left: 20px
        }

        .fa-search {
            padding: 3px;
            font-size: 18px
        }

        #sidebar {
            width: 40%;
            padding: 20px;
            float: left
        }

        #products {
            width: 60%;
            padding: 10px;
            margin: 0;
            float: right
        }

        .card {
            border: none
        }

        #off {
            padding-left: 2px
        }

        #sorting span,
        #res {
            font-size: 14px
        }

        .filter,
        #mobile-filter {
            display: none
        }
    }

    @media(max-width:575px) {
        .search-nav-item {
            margin: 0;
            width: 100%;
            margin-top: 10px
        }

        #search {
            width: 80%;
            padding-left: 10px;
            margin-top: 10px;
            padding-right: 10px
        }

        .fa-search {
            padding: 10px;
            font-size: 18px
        }

        #sidebar {
            display: none
        }

        .filter {
            margin-left: 70%;
            margin-top: 2%
        }

        #sorting,
        #res {
            font-size: 12px;
            margin-top: 2%
        }
    }

    .overlay {
        position: absolute;
        /*bottom: 25;*/
        top: 100px;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.5);
        color: #f1f1f1;
        width: 95%;
        transition: .5s ease;
        opacity: 0;
        color: white;
        font-size: 20px;
        padding: 20px;
        text-align: center;
    }

    .product_container:hover .overlay {
        opacity: 1;
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

    ._p-qty .value-button {
        border: 0px solid #fe0000;
        height: 27px;
        font-size: 20px;
        font-weight: bold;
    }

    ._p-qty input#number {
        text-align: center;
        border: none;
        /*border-top: 1px solid #fe0000;*/
        /*border-bottom: 1px solid #fe0000;*/
        margin: 0px;
        width: 40px;
        height: 35px;
        font-size: 14px;
        box-sizing: border-box;
    }

    ._p-add-cart {
        margin-left: 0px;
        margin-bottom: 15px;
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
        height: 27px;
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

    .product_qty_div {
        margin-top: -26px;
        margin-left: 76px;
    }
</style>
@if (Session::has('AccessTokens'))

<?php $value = Session::get('AccessTokens') ?>

@endif
@extends('templates.frontend.header')
@section('content')


<!-- products section -->

<section id="products" class="border-top">


    <div class="container">
        <h2 style="text-align:center;">My Wishlist Products</h2>
        <div class="row">
            @foreach($data as $d)
            @if(count($d['product_lists']))
            @php $i = 0
            @endphp
            @foreach($d['product_lists'] as $products)
            @php $i++; @endphp
            <div class="product_container col-lg-3 col-md-6 col-sm-10 offset-md-0 offset-sm-1" style="height:400px;">
                <div class="card" style="padding:5px;"> <a href="{{url('product-detail',$products['_id'])}}">
                        @if($pimages_lists->isNotEmpty())
                        <div class="carousel-wrap">
                            <div class="owl-carousel">
                                @foreach($pimages_lists as $wholesalers)

                                @if($products->_id == $wholesalers->product_auto_id)

                                <div class="item"><img src="{{asset('images/products_images/' . $wholesalers["image_file"]) }}" style="height:250px;"></div>


                                @endif

                                @endforeach
                            </div>
                        </div>


                        @endif
                    </a>
                    <div class="card-body" style="padding:5px;">
                        <h6 style="text-align:center;margin-top: 5px;">{{$products["product_name"]}} </h6>
                        <div class="rounded bg-white discount" id="orange" style="background:rgba(255,63,108,.8);">
                            {{$d['rating']}} <i class="fa fa-star" aria-hidden="true" style="color: turquoise;"></i> |
                            {{$d['total_rating_count']}}</div>
                        @if($products["new_arrival"] == "Yes")
                        <div class="abc">NEW ARRIVAL</div>
                        @endif
                        @if (Session::has('AccessTokens') !='')


                        {!! Form::open(['method' => 'POST', 'url' => 'wishlist', 'enctype' => 'multipart/form-data'])
                        !!}

                        <input name="user_auto_id" type="hidden" value="{{$value}}" />
                        <input name="product_auto_id" type="hidden" value="{{$products[" _id"]}}" />
                        @if(!empty($wproducts))
                        <button type="submit" class="btn btn-info"
                            style="margin-top: -50px;float: right;padding: 5px;color:red;"><i
                                class="fa fa-light fa-heart"></i></button>
                        @else
                        <button type="submit" class="btn btn-info"
                            style="margin-top: -50px;float: right;padding: 5px;color:red;"><i
                                class="fa fa-light fa-heart"></i></button>
                        @endif
                        </form>
                        @else
                        <button type="submit" class="btn btn-info"
                            style="margin-top: -50px;float: right;padding: 5px;"><i
                                class="fa fa-light fa-heart"></i></button>

                        @endif

                        @if($currency_price_details->isNotEmpty())
                        @foreach($currency_price_details as $cprice)
                        @if($products->_id == $cprice->product_auto_id)
                        <div class="d-flex flex-row my-2">

                            <h6 class="price" style="font-size: 12px;">
                                <b>Rs. {{$cprice["final_price"]}}</b>
                                @if($cprice["offer_percentage"] != "0")
                                <del>Rs. {{$cprice["product_price"]}}</del>
                                <h6 style="color:#ff905a;">&nbsp({{$cprice["offer_percentage"]}}% OFF)</h6>
                                @endif
                            </h6><br />


                        </div>
                        @endif
                        @endforeach
                        @endif
                        @if (Session::has('AccessTokens') !='')

                        <p class="btn-holder"><a href="{{ route('add.to.buynow', $products->id) }}"
                                class="btn btn-sm btn-danger" role="button"
                                style="color:white;font-size:13px;background:purple;border:purple;">Buy Now</a> </p>
                        @else
                        <button onclick="location.href = '../login';" type="submit" class="btn btn-sm btn-danger"
                            style="color:white;font-size:13px;background:purple;border:purple;">Buy Now</button>


                        @endif

                        @if (Session::has('AccessTokens') !='')
                        @if(Session('cart'))
                        @php $in_cart = false; @endphp
                        @foreach(Session('cart') as $id =>$prod)
                        @if($id == $products->id)
                        @php $in_cart = true; @endphp
                        @endif
                        @endforeach
                        @if ($in_cart)
                        <p class="btn-holder"><button data-toggle="tooltip" data-placement="bottom"
                                title="Product added to cart, go to cart to add more quantity"
                                class="btn btn-sm btn-secondary add_to_cart_btn2 text-center text-white" role="button"
                                style="font-size: 13px;float: right;margin-top: -30px;">Added to cart</button> </p>
                        @else
                        <p class="btn-holder">
                            <a href="{{ route('add.to.cart', $products->id) }}" data-product="{{$products->id}}"
                                data-size='{{ $products["size"]}}'
                                class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white" role="button"
                                style="font-size: 13px;background: #fd7f34;border: #fd7f34;float: right;margin-top: -30px;">Add
                                to cart</a>

                        </p>
                        @endif
                        @else
                        <p class="btn-holder"><a href="{{ route('add.to.cart', $products->id) }}"
                                data-product="{{$products->id}}" data-size='{{ $products["size"]}}'
                                class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white" role="button"
                                style="font-size: 13px;background: #fd7f34;border: #fd7f34;float: right;margin-top: -30px; color:white">Add
                                to cart</a> </p>

                        @endif
                        @else

                        <button onclick="show_login()" type="submit" class="btn btn-sm btn-warning text-center"
                            style="font-size: 13px;background: #fd7f34;border: #fd7f34;float: right;margin-top: -30px; text-white">Add
                            to
                            cart</button>

                        @endif

                    </div>

                </div>
            </div>
            @endforeach
            @else

            <h4 class="box-title" style="font-size: 14px;text-align:center;color:red">Not Available any data</h4>
            @endif
            @endforeach
        </div>
    </div>
</section>

<div class="clearfix"></div>
<script>
    $(document).ready(function(){

      $('.add_to_cart_btn').click(function () {



           $('.product_qty_div').show();
           $('.add_to_cart_btn').hide();

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





</script>
<script>
    $('.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  autoplay: true,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
})
</script>
</div>
@endsection