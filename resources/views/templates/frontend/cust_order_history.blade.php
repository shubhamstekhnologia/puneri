
@if (Session::has('AccessTokens'))

   <?php $value = Session::get('AccessTokens') ?>

@endif
@extends('templates.frontend.header')
@section('content')
<div class="container">
            <h3 style="text-align:center; padding:10px">My Orders List</h3>

    <div class="row">
        <div class="col-md-12 my-5">
        <div class="table-responsive bg-white">
        <table class="table  table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">No. of Items</th>
      <th scope="col">Payment Mode</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment Status</th>
       <th scope="col">Order Status</th>
       <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
       @if(!empty($data))
                  @php $i = 0 @endphp
                  @foreach($data as $order)
                  @php $i++; @endphp
    <tr>
      <th scope="row"> <a href="{{url('my_orders_details',$order['_id'])}}" class="text-primary">{{$order['order_id']}}</a></th>
      <td>{{date('d-M-Y', strtotime($order['order_date']))}}</td>
      <td>{{$order['quantity']}}</td>
      <td> <span class="font-weight-bold @if($order['payment_mode'] =='online') text-success @else text-danger @endif"> {{$order['payment_mode']}}</span> </td>
       <td>{{$order['total_paid_price']}}</td>
       <td>{{$order['payment_status']}}</td>
       @if($order['status'] == "Cancelled")<td class="text-danger h6">{{$order['status']}}</td>
       @else
       <td>{{$order['status']}}</td>
       @endif
        <td>

      {!! Form::open(['method' => 'POST', 'url' => 'cancel_my_orders', 'enctype' => 'multipart/form-data']) !!}
            {{-- <input type="hidden" class="form-control" value="{{$order['_id']}}" id="product_order_auto_id" name="product_order_auto_id"> --}}
                    <input type="hidden" class="form-control" value="{{$order['order_id']}}" id="order_id" name="order_id" >
                    @if($order['status'] != "Cancelled")
                    <input type="submit" class="btn bg-none text-danger" style="background:transparent" value="Cancel Order">
                    @endif
                   {!! Form::close() !!}


</td>
    </tr>
   @endforeach
   @else
   <tr>
       <td colspan="8">No Orders yet</td>
   </tr>
   @endif

  </tbody>
</table>
</div>
</div>


        </div>
</div>

@endsection
