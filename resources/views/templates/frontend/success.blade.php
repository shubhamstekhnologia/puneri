<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

body {
    background-color: #eee;
    font-family: "Poppins", sans-serif;
    font-weight: 300
}

.cart {
    /*height: 100vh*/
}

.progresses {
    display: flex;
    align-items: center
}

.line {
    width: 76px;
    height: 6px;
    background: #63d19e
}

.steps {
    display: flex;
    background-color: #63d19e;
    color: #fff;
    font-size: 12px;
    width: 30px;
    height: 30px;
    align-items: center;
    justify-content: center;
    border-radius: 50%
}

.check1 {
    display: flex;
    background-color: #63d19e;
    color: #fff;
    font-size: 17px;
    width: 60px;
    height: 60px;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-bottom: 10px
}

.invoice-link {
    font-size: 15px
}

.order-button {
    height: 50px
}

.background-muted {
    background-color: #fafafc
}
</style>

@extends('templates.frontend.header')
@section('content')


<div class="container mt-4 mb-4">
    <div class="row d-flex cart align-items-center justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="d-flex justify-content-center border-bottom">
                    <div class="p-3">
                        <div class="progresses">
                            <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                            <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                            <div class="steps"> <span class="font-weight-bold">3</span> </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-6 border-right p-5">
                        <div class="text-center order-details">
                            <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span> <span class="font-weight-bold">Order Confirmed</span> <small class="mt-2">Your Order has been received successfully</small> <a href="#" class="text-decoration-none invoice-link">View Invoice</a> </div> <a href="{{url('my_orders')}}" class="btn btn-success btn-block order-button">Go to your Order</a>
                        </div>
                    </div>
                    <div class="col-md-6 background-muted">
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> Creeated at {{date('d-m-Y ')}}</span> <span><i class="fa fa-hashtag text-muted"></i> Order ID: {{$order_id}}</span> </div>
                            <div class="mt-3">
                                @foreach ($addresses as $address)
                                <h6 class="mb-0">{{$address['name']}}</h6> <span class="d-block mb-0">{{$address['address_details']}},
                                {{$address['area']}}, <br>{{$address['city']}}, {{$address['state']}}<br>{{$address['country']}}<br>
                                Pincode: {{$address['pincode']}}</span> <small>Payment: {{ $payment}}</small>
                                @endforeach
                              
                            </div>
                        </div>
                        
                        @foreach($products as $id=>  $product)
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{$product['name'] }}- {{$product['size']}}</span> </div>
                            </div>
                             <div class="col-md-2">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{$product['quantity']}}</span> </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>Rs. {{$product['price']}}</span> </div>
                            </div>
                        </div>
                        
                        @endforeach
                        
                         <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center font-weight-bold"> <span>Subtotal</span> </div>
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex justify-content-center align-items-center font-weight-bold"> <span>Rs.{{$subtotal}}</span> </div>
                            </div>
                        </div>
                        
                        <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>Delivery fees</span> </div>
                            </div>
                             <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>Rs.0</span> </div>
                            </div>
                        </div>
                        
                        @if($promo != 0)
                        
                         <div class="row g-0 border-bottom">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>Coupon Discount</span> </div>
                            </div>
                             <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex justify-content-center align-items-center text-success"> <span>-Rs. {{$promo}}</span> </div>
                            </div>
                        </div>
                        @endif
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                            </div>
                             <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Rs. {{$total}}</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div> </div>
            </div>
        </div>
    </div>
</div>
@endsection