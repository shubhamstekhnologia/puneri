
@if (Session::has('AccessTokens'))

   <?php $value = Session::get('AccessTokens') ?>

@endif
@extends('templates.frontend.header')
@section('content')
<div class="container p-3 col-sm-12 col-md-12">
            <h3 style="text-align:center;">My Orders Details</h3>

    <div class="row col-sm-12 col-md-12 ">

        <div class="col-md-3 col-lg-3 col-sm-6"></div>
                <div class="col-md-9 col-lg-9 col-sm-12" style="margin: 10px;background: white;box-sizing: border-box;box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);padding: 10px;">

             @if(!empty($data))
                  @php $i = 0 @endphp
                  @foreach($data as $order)
                  @php $i++; @endphp
                  <div class="row py-3 px-2">
   <div class="col-md-4 col-lg-4 col-sm-4 " >
   <b class="text-right py-2">Order ID:  {{$order['order_id']}}</b>
   <div class="item"><img src="../images/products_images/{{$order['product_image']}}" style="height: 11rem;">

   </div>

</div>
     <div class="col-md-8 col-lg-8 col-sm-8 py-4" >
           <b >Order Date: {{$order['order_date']}}</b><br>
            <a href="{{url('product-detail',$order['product_auto_id'])}}" class="text-primary"><b>{{$order['product_name']}}</b></a><br>
             {{-- <p>Color: <b>{{$order['size']}}</b><br>
             Size: <b>{{$order['color_name']}}</b><br> --}}
            Quantity: <b>{{$order['quantity']}}</b><br>
           Price: <del style="color:black;text-decoration: line-through;">{{$order['product_price']}}</del>&nbsp;<b>{{$order['product_final_price']}}&nbsp;({{$order['product_offer_percentage']}}% OFF)</b><br>
            @if($order['order_status'] == "Cancelled")
              Order Status: <b style="color:red;">{{$order['order_status']}}</b><br>
              @else
              Order Status: <b style="color:green;">{{$order['order_status']}}</b><br>
              @endif
            </p>

            <p><i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i></p>


             {{-- {!! Form::open(['method' => 'POST', 'url' => 'cancel_my_orders', 'enctype' => 'multipart/form-data']) !!}
                   <input type="hidden" class="form-control" value="{{$order['_id']}}" id="product_order_auto_id" name="product_order_auto_id">
                    <input type="hidden" class="form-control" value="{{$order['order_id']}}" id="order_id" name="order_id" >
                        @if($order['order_status'] != "Cancelled")
                    <input type="submit" class="btn bg-transparent text-danger"  value="Cancel Item">
                        @endif
             </form> --}}

             </div>
             </div>
            {{-- <!--<a href="{{url('cart')}}"style="float: right;margin-top: -55px;color: blue;">Apply</a>--> --}}

             @endforeach
          @endif

          @if (!empty($data))
          @php $i = 0; @endphp
            @foreach($data as $order)
            @php $i++; @endphp
            @if($i > 1)
            @php continue; @endphp
            @endif
            <div class="row">
             <div class="col-md-8" > <b>Shipping Address</b>
            <p>{{$order['address']}},{{$order['city']}}<br>{{$order['state']}}-{{$order['used_pincode']}}<br>{{$order['country']}}</p></div>

            <div class="col-md-4">
            <b>Payment Details</b>
            <p>Payment Mode: <b>{{$order['payment_mode']}}</b><br>
               Original Price: <b>{{$order['total_price']}}</b><br>
               Offer Price: <b>{{$order['promocode_value_off_on_order']}}</b><br>
               Delivery Charge: <b>{{$order['pincode_delivery_charge']}}</b><br>
               Order Total:<b> Rs. {{number_format($order['total_paid_price'])}}</b><br>
             </p><br>
             </div>
             </div>
           @endforeach
           @endif
             </div>
        </div>
</div>

@endsection
