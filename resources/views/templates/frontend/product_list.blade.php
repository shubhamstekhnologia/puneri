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

/* .fa-search {
    font-size: 20px;
    padding: 10px;
    margin-bottom: 3px;
    padding-right: 20px
} */

.search-nav-item {
    height: 40px
}
input:read-only
{
    background-color:rgba(128,128,128, 0.5);
    border-color: rgba(128,128,128, 0.5);
    border:0px;
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
    top: 2%;
    right: 0%;
    background: red;
    display: inline-block;
    z-index: 1;
    padding: 2px;
}
h5{
    padding:0px;
}
p{
    margin:0px;
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
        padding-right:0px;
    }

    #products {
        width: 78%;
        padding: 10px;
        margin: 0;
        float: right;

    }

    .card {

       height: auto;
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
  width: 100%;
  position: relative;
}

/* fix blank or flashing items on carousel */
.owl-carousel .item {
  position: relative;
  z-index: 100;
  -webkit-backface-visibility: hidden;
}

/* end fix */
.owl-nav > div {
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

.item, .price {
  clear: left;
  width: 100%;
  text-align: center;
}

.price {
  color: Grey;
}

.description, label, button, input {
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
.abc{
        background: rgba(255,63,108,.8);
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

    /* .fa-search {
        padding: 3px;
        font-size: 18px
    } */

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
/*
    .fa-search {
        padding: 10px;
        font-size: 18px
    } */

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
.btn-holder{
    margin-bottom: 0 !important;
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
    width:40px;
    height: 35px;
    font-size: 14px;
    box-sizing: border-box;
}
._p-add-cart {
    margin-left: 0px;
    margin-bottom: 15px;
}

._p-qty > span {
    color: black;
    margin-right: 15px;
    font-weight: 500;
}
._p-qty .value-button {
    display: inline-flex;
    border: 0px solid #ddd;
    margin: 0px;
    width: 30px;
    height:27px;
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
.tooltip-inner {
    background-color:grey !important;
}

.product_qty_div{
    margin-top: -26px;
    margin-left: 76px;
}

.size-popup {
  display: none;

  position: fixed;
  bottom: 40px;
  left: 50%;
transform: translateX(-50%);

  background-color:#fff;
  z-index:1500;
  animation:slide_up;
  animation-duration:1s;
}
@keyframes slide_up
{
    0% {
        bottom:0;
    }
    100%
    {
        bottom:40px;
    }
}

.select_size:hover
{
    cursor:pointer;
    background-color:#198754;
    color:#fff;
    border-color:green;
}
.select_size.active
{
    cursor:pointer;
    background-color:green;
    color:#fff;
    border-color:green;
}
.close-size
{
    right:15px;
    top:-35px;
    cursor:pointer;
}
.close-size:hover
{
    color:red;
}
@media (max-width:767px) {
    .size-popup{
        width:90%;
        top:20px;
    }

}
</style>
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	</script>

	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
	</script>


@if (Session::has('AccessTokens'))

   <?php $value = Session::get('AccessTokens') ?>

@endif
@extends('templates.frontend.header')
@section('content')



<div class="filter"> <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#mobile-filter" aria-expanded="true" aria-controls="mobile-filter">Filters<span class="fa fa-filter pl-1"></span></button>
</div>
<div id="mobile-filter">
    <!--<p class="pl-sm-0 pl-2" style="font-size: 15px;"> Home / Clothing / Jeans /<b>Jeans For Men</b></p>-->
    <p class="pl-sm-0 pl-2"><b>Product Lists</b></p>
    <div class="border-bottom pb-2 ml-2">
        <h4 id="burgundy">FILTERS</h4>
    </div>
 <!--   <div class="py-2 border-bottom border-right ml-3">-->
 <!--       <h6 class="font-weight-bold">BRAND</h6>-->
 <!--      @if(!empty($brand_lists))-->
 <!--                 @php $i = 0 @endphp-->
 <!--                 @foreach($brand_lists as $brands)-->
 <!--                 @php $i++; @endphp-->
 <!--               		<div class="block">-->
 <!--               		<input type="checkbox" id="{{$brands->brand_name}}">&nbsp;{{$brands->brand_name}}-->
 <!--               		</div>-->
 <!--               @endforeach-->
 <!--                @endif-->

	<!--<div id="load"> <b> Load More </b></div>-->
 <!--   </div>-->
    <div class="py-2 border-bottom border-right ml-3">

    </div>
    <div class="py-2 border-bottom border-right ml-3">
        <!--<h6 class="font-weight-bold">COLOR</h6>-->
        <!--@if(!empty($color_lists))-->
        <!--          @php $i = 0 @endphp-->
        <!--          @foreach($color_lists as $color)-->
        <!--          @php $i++; @endphp-->
        <!--<form>-->

        <!--    <div class="form-group"> <input type="checkbox" id="25off"> <label for="25"><img src="../images/colors/{{$color->color_img}}" class="img-responsive" style="width: 15px;height:15px;border:1px solid gray;"/> {{$color->color_name}}</label> </div>-->

        <!--</form>-->
        <!-- @endforeach-->
        <!--  @endif-->
    </div>
     <div class="py-2 border-right ml-3">
       <!-- <h6 class="font-weight-bold">DISCOUNT RANGE</h6>-->
       <!--@if(!empty($discount_lists))-->
       <!--           @php $i = 0 @endphp-->
       <!--           @foreach($discount_lists as $discount)-->
       <!--           @php $i++; @endphp-->
       <!--  <form>-->
       <!--     <div class="form-group"> <input type="checkbox" id="25off"> <label for="25">{{$discount->discount_percent}}% OFF</label> </div>-->

       <!-- </form>-->
       <!--  @endforeach-->
       <!--   @endif-->
    </div>
</div>
<!-- Sidebar filter section -->
<section id="sidebar">
    <!--<p style="font-size: 15px;">Home / Clothing / Jeans / <b>Jeans For Men</b></p>-->
      <p> <b>Product Lists</b></p>
    <div class="border-bottom pb-2 ml-2">
        <h6 id="burgundy">FILTERS</h6>
    </div>
    <div class="py-2 border-bottom border-right ml-3">
        <h6 class="font-weight-bold">BRAND</h6>

                     @if(!empty($brand_lists))
                  @php $i = 0 @endphp
                  @foreach($brand_lists as $brands)
                  @php $i++; @endphp
                		<div class="block" style="display: none;">
                	<p style="font-size: 1.2rem;font-family: Manrope,sans-serif;display: block;"><input type="checkbox" class="common_selector brand" name="brand" id="brand" value="{{$brands->id}}"> {{$brands->brand_name}}</p>

                		</div>
                @endforeach
                 @endif

	<div id="load" class="px-3 text-info" style="text-align: right"> <b style="font-size:15px; " > <i class="fa fa-angle-double-down" aria-hidden="true"></i> </b></div>
    </div>
    <div class="py-2 border-bottom border-right ml-3">
        <h6 class="font-weight-bold">PRICE</h6>
        @php $max = 0;  @endphp
        @foreach($price_lists as $cprice)
        @if ($cprice['final_price'] > $max)
        @php $max = $cprice['final_price']; @endphp
        @endif
        @endforeach

        @php $min = $max @endphp

        @foreach($price_lists as $cprice)
        @if ($cprice['final_price'] <= $min)
        @php $min = $cprice['final_price']; @endphp
        @endif
        @endforeach

                        		<div class="price" style="display:none;">

                		<p style="font-size: 1.2rem;font-family: Manrope,sans-serif;display: block;"><input type="checkbox" class="common_selector price" name="price" id="price" value="1"> By price range</p>

                		</div>

        <div class="prices">
            <div class="min-price">
                <label style="display:block">Min Price</label>
                <input type="number" value="{{ $min}}" name="min_price" class="prices_input min_price form-control w-50" min="{{$min}}" readonly>

            </div>
                        <div class="max-price">
                <label style="display:block">Max Price</label>
                <input type="number" value="{{ $max}}" class="prices_input max_price form-control w-50" name="max-price" max="{{$max}}" readonly>

            </div>
        </div>



    </div>
    <div class="py-2 border-bottom border-right ml-3">
        <h6 class="font-weight-bold">COLOR</h6>


           @if(!empty($color_lists))
                  @php $i = 0 @endphp
                  @foreach($color_lists as $color)
                  @php $i++; @endphp
                		<div class="color" style="display:none;">
                		 <input type="checkbox" class="common_selector color" name="color" id="color" value="{{$color->color_name}}"><label><p style="font-size: 1.2rem;font-family: Manrope,sans-serif;display: block;">{{$color->color_name}}</p></label>

                		</div>
                @endforeach
                 @endif

	<div id="load_color" class="px-3 text-info" style="text-align:right"> <b style="font-size:15px;" > <i class="fa fa-angle-double-down" aria-hidden="true"></i> </b></div>
    </div>

</section>
<section>

<div class="d-flex flex-row" style="padding-top: 62px;">
   <div class="mr-lg-9">

   </div>
            <div class="ml-auto mr-lg-3">
                <div id="sorting" class="border rounded p-1 m-1"> <span class="text-muted">Sort by</span> <select name="sort" id="sort">

                        <option value="new">What's New</option>
                        <option value="high_price">Price : High to Low</option>
                        <option value="low_price">Price : Low to High</option>
                    </select> </div>
            </div>
</div>
</section>
<!-- products section -->

<section id="products" class="border-top">


    <div class="container">

        <div class="row">

              @if(!empty($product_lists))
              @php  @endphp
              @php $myproducts = array();  @endphp
                  @php $i = 0 @endphp
                  @php $has_price_ids = array(); @endphp
                  @foreach($product_lists as $products)
                  @foreach($price_lists as $cprice)
                  @if($products->_id == $cprice->product_auto_id)
                  @php array_push($has_price_ids, $products->_id); @endphp
                  @endif
                  @endforeach
                  @endforeach

                  @foreach($product_lists as $products)
                  @if (!in_array($products->_id, $has_price_ids))
                  @php continue; @endphp
                  @endif
                 @php $myproduct = collect($products); @endphp
                 @php $wished = 0; @endphp
                  @php $i++; @endphp
            <div class="filter_data product_container col-lg-4 col-md-4 col-sm-6 offset-md-0 offset-sm-1" >
                <div class="card" style="padding:5px;"> <a href="{{url('product-detail',$products['_id'])}}">
                      @if($pimages_lists->isNotEmpty())
                               <div class="carousel-wrap">
                                      <div class="owl-carousel">
                                      @foreach($pimages_lists as $wholesalers)

                                        @if($products->_id == $wholesalers->product_auto_id)
                                       @if(isset($search))


                                            <div class="item"><img class="mx-auto" src="{{asset('images/products_images/'.$wholesalers['image_file'])}}" style="height:250px;"></div>
                                      @else
                                                                                  <div class="item"><img src="{{asset('images/products_images/'.$wholesalers['image_file'])}}" class="img-fluid mx-auto"style="height:250px;" ></div>
                                                                                  @endif
                                        @endif

                                      @endforeach
                                     </div>
                                    </div>



                                    @endif
                    </a>
                    <div class="card-body" style="padding:5px;">
                        @if($products["new_arrival"] == "Yes")
                        <div class="abc">NEW ARRIVAL</div>
                        @endif

                          @if (Session::has('AccessTokens') !='')


                            {!! Form::open(['method' => 'POST', 'url' => 'wishlist', 'enctype' => 'multipart/form-data']) !!}

                             <input name="user_auto_id" type="hidden" value="{{$value}}" />
                             <input name="product_auto_id" type="hidden" value="{{$products["_id"]}}" />
                                @foreach($wproducts as $wproduct)
                               @if($wproduct['product_auto_id'] == $products->_id)
                               @php $wished = 1;
                                 break;
                                @endphp
                               @endif
                               @endforeach

                               @if ($wished ==1)
                                <button type="submit" class="btn btn-info" style="float: right;padding: 3px;color:maroon;"><i class="fa fa-light fa-heart" ></i></button>
                                   @else
                            <button type="submit" class="btn btn-info" style="float: right;padding: 3px;"><i class="fa fa-light fa-heart" ></i></button>
                                  @endif


                            </form>

                        @else
                            <button onclick="show_login();" type="submit" class="btn btn-info" style="float: right;padding: 3px;"><i class="fa fa-light fa-heart" ></i></button>

                        @endif

                           @if($price_lists->isNotEmpty())
                             @foreach($price_lists as $cprice)
                              @if($products->_id == $cprice->product_auto_id)
                              @php $myproduct->put('final_price',$cprice["final_price"]);
                              array_push($myproducts, $myproduct->all())
                              @endphp
                        <div class="d-flex justify-content-center my-2">

                        <h6 class="price" style="font-size: 12px;margin-left: 8%;">
                            <b style="font-size:16px;"> {{$cprice["currency"]}}{{number_format($cprice["final_price"])}}</b>
                             @if($cprice["offer_percentage"] != "0" && $cprice["offer_percentage"] != "")
                            <del style="text-decoration: line-through;">{{$cprice["currency"]}} {{$cprice["product_price"]}}</del>
                            <h6 style="color:#ff905a;font-size: 12px;">&nbsp({{$cprice["offer_percentage"]}}% OFF)</h6>
                                 @endif
                            </h6><br/>
                        </div>

                        @php break; @endphp
                         @endif
                            @endforeach
                              @endif
                              <h5 style="text-align:center;text-overflow: ellipsis;white-space: nowrap;width: 100%;overflow: hidden;font-weight:600">{{$products["product_name"]}} </h5>

                               @if (Session::has('AccessTokens') !='')


                            <!--{!! Form::open(['method' => 'POST', 'url' => 'buy_now', 'enctype' => 'multipart/form-data']) !!}-->

                            <!-- <input name="user_auto_id" type="hidden" value="{{$value}}" />                           -->
                            <!-- <input name="product_auto_id" type="hidden" value="{{$products["_id"]}}" />-->
                            <!-- <input name="cart_quantity" type="hidden" value="1" />-->

                            <!--<button type="submit" class="btn btn-sm btn-danger" style="color:white;font-size:13px;background:purple;border:purple;">Buy Now</button>-->


                            <!--</form>-->
                            <p class="btn-holder"><a href="{{ route('add.to.buynow', $products->id) }}" class="btn btn-sm btn-danger" role="button" style="color:white;font-size:13px;background:purple;border:purple;margin-left: 21%;float: left;margin-right: 10px;">Buy Now</a> </p>

                        @else
                            <button onclick="show_login()" type="submit" class="btn btn-sm btn-danger" style="color:white;font-size:13px;background:purple;border:purple;margin-left: 21%;float: left;margin-right: 10px;">Buy Now</button>


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
                        <p class="btn-holder"><button data-toggle="tooltip" data-placement="bottom" title="Product added to cart, go to cart to add more quantity" class="btn btn-sm btn-secondary add_to_cart_btn2 text-center text-white" role="button" style="font-size: 13px;float:left;">Added to cart</button> </p>
                        @else
                         <p class="btn-holder">
                             <a href="{{ route('add.to.cart', $products->id) }}" data-product="{{$products->id}}" data-size='{{ $products["size"]}}' class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white" role="button" style="font-size: 13px;background: #fd7f34;border: #fd7f34;float:left;">Add to cart</a>
                             <div class="size-popup shadow" id="modal-{{$products->id}}">
                                 <h3 class="p-3">Select product size</h3>
                                 <div class="position-relative">
                                     <span class="position-absolute close-size fa fa-times" data-target-id="modal-{{$products->id}}"></span>
                                 </div>
                                   <div class="row container p-4">
                                      @if(!empty($get_slists))
                                      @php $sizes = array(); @endphp
                                      @if($products["size"] != "")
                                      @php $prod_size = explode("|",$products["size"]) @endphp
                                      @foreach($get_slists as $sizelist)
                                      @foreach($prod_size as $size_id)
                                      @if($sizelist["_id"] == $size_id)
                                      @php array_push($sizes, array("size"=>$sizelist["size"], "id"=>$sizelist["_id"])) @endphp
                                      @endif
                                      @endforeach
                                      @endforeach

                                      @foreach($sizes as $size)
                                      <div class="col-md-4 col-lg-4 col-sm-6 select_size" onclick="select_price(this.id, '{{$size['id']}}')" id="size-{{$size['id']}}-{{$products->id}}"
                                      data-size="{{$size['id']}}" data-route="{{route('add.to.cart', $products->id.'&'.$size['size'])}}" style="border: 1px solid;padding: 5px;margin: 5px; max-height:50px">
                                          <span  class="select_size_span">{{$size["size"]}}&nbsp;</span>
                                      </div>

                                      @endforeach
                                       @endif
                                       @endif
                                     </div>
                             </div>
                             </p>
                         @endif
                         @else
                          <p class="btn-holder"><a href="{{ route('add.to.cart', $products->id) }}" data-product="{{$products->id}}" data-size='{{ $products["size"]}}' class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white" role="button" style="font-size: 13px;background: #fd7f34;border: #fd7f34;float:left; color:white">Add to cart</a> </p>

                        @endif
                         @else

                    <button onclick="show_login()" type="submit" class="btn btn-sm btn-warning text-center" style="font-size: 13px;background: #fd7f34;border: #fd7f34;float:left; text-white">Add to cart</button>

                        @endif

<!-- Modal -->

<div class="modal lab-slide-bottom-popup"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select Product size</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body lab-modal-body">
          <div class="row">
                                      @if(!empty($get_slists))
                                      @php $sizes = array(); @endphp
                                      @if($products["size"] != "")
                                      @php $prod_size = explode("|",$products["size"]) @endphp
                                      @foreach($get_slists as $sizelist)
                                      @foreach($prod_size as $size_id)
                                      @if($sizelist["_id"] == $size_id)
                                      @php array_push($sizes, array("size"=>$sizelist["size"], "id"=>$sizelist["_id"])) @endphp
                                      @endif
                                      @endforeach
                                      @endforeach

                                      @foreach($sizes as $size)
                                      <div class="col-md-2 col-lg-2 col-sm-6 select_size" onclick="select_price(this.id, '{{$size['id']}}')" id="size-{{$size['id']}}-{{$products->id}}" data-size="{{$size['id']}}" data-route="{{route('add.to.cart', $products->id.'&'.$size['size'])}}" style="border: 1px solid;
    padding: 5px;margin: 5px;">
                                          <span  class="select_size_span">{{$size["size"]}}&nbsp;</span>
                                      </div>

                                      @endforeach
                                       @endif
                                       @endif
                                     </div>
      </div>

    </div>
  </div>
</div>

                    </div>

                </div>
            </div>
              @endforeach
          @else

            <h4 class="box-title" style="font-size: 14px;text-align:center;color:red">Not Available any data</h4>
          @endif

        </div>
    </div>
</section>


<div class="clearfix"></div>


<script>

$("#sort").change(function(){
   let  products = <?php echo  json_encode($myproducts); ?>;
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                url: "{{ url(Session('main').'/sort_product')}}",
                type: 'POST',
                data: {sort: $(this).val(), products: products},
                success:function(response){
                    $("#products").html(response);
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

                }
            })
})
var size = "";
var prod_id = "";
var prod = "";

$(".add_to_cart_btn2").click(function(e){
    e.preventDefault();
    let product_id = $(this).data("product");

    let size_modal = $("#modal-"+ product_id)
    prod_id = product_id


    if($(this).data("size") == "")
    {
        location.href = $(this).attr("href")

    }else
    {
          $("#overlay").show();
        size_modal.show();

}   })


function select_price(div, size)
{
    size =  $("#"+div).data("route")
    $("#"+div).addClass("active");
            location.href = size;

}


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
<script>$('.owl-carousel').owlCarousel({
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
})</script>
</div>

	<script>
		$(document).ready(function () {
			$(".block").slice(0, 5).show();
			if ($(".block:hidden").length != 0) {
				$("#load").show();
			}
			$("#load").on("click", function (e) {
				e.preventDefault();
				$(".block:hidden").slice(0, 5).slideDown();
				if ($(".block:hidden").length == 0) {
					$("#load").text("No More to view")
						.fadOut("slow");
				}
			});
		})
		//price
			$(document).ready(function () {
			$(".price").slice(0, 5).show();
			if ($(".price:hidden").length != 0) {
				$("#load_price").show();
			}
			$("#load_price").on("click", function (e) {
				e.preventDefault();
				$(".price:hidden").slice(0, 5).slideDown();
				if ($(".price:hidden").length == 0) {
					$("#load_price").text("No More to view")
						.fadOut("slow");
				}
			});
		})
		//color
			$(document).ready(function () {
			$(".color").slice(0, 5).show();
			if ($(".color:hidden").length != 0) {
				$("#load_color").show();
			}
			$("#load_color").on("click", function (e) {
				e.preventDefault();
				$(".color:hidden").slice(0, 5).slideDown();
				if ($(".color:hidden").length == 0) {
					$("#load_color").text("No More to view")
						.fadOut("slow");
				}
			});
		})
			//discount
			$(document).ready(function () {
			$(".disc").slice(0, 5).show();
			if ($(".disc:hidden").length != 0) {
				$("#load_disc").show();
			}
			$("#load_disc").on("click", function (e) {
				e.preventDefault();
				$(".disc:hidden").slice(0, 5).slideDown();
				if ($(".disc:hidden").length == 0) {
					$("#load_disc").text("No More to view")
						.fadOut("slow");
				}
			});
		})
	</script>

<script>
let orignal_products = $("#products").html();

    function filter_data()
    {
        $('#loading').show();
        var action = 'fetch_data';
                var brand = get_filter('brand');
                var max_price = $(".max_price").val();
                var min_price = $(".min_price").val();
                var price = 0;
                var category_id = window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1);

                if ($("#price").is(":checked"))
                {
                     price = 1

                }else
                {
                    price = 0
                }
                var discount = get_filter('discount');
                var color = get_filter('color');
                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

                $.ajax({
                        url: '<?php echo url(Session('main').'/filter_products'); ?>',
                        type: 'POST',
                        data: {price:price, max_price:max_price, min_price:min_price, brand:brand, discount:discount, color:color, category_id: category_id},
                        success:function(data){
                            $('#loading').hide();
                            $('#products').html(data);
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

                        }
                });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').change(function(){
        if ($(".common_selector").is(":checked"))
{
            filter_data();
}
else
{
  location.reload();
}

    });

   $("input.price").change(function(){
       $(".prices_input").removeAttr("readonly");
   })


   $(".prices_input").change(function(){
       filter_data();
   })

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>

$(".close-size").click(function(){
    var parent_div = $(this).data("target-id");
    $("#overlay").hide();
    $("#"+ parent_div).hide();
})

</script>
@endsection