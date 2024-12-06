@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif


@if($customers->isNotEmpty()) 

    @foreach($customers as $cust)

        @php

            $id = $cust->id;

            $customer_id = $cust->customer_id;

            $name = $cust->name;

            $email = $cust->email;
                 $contact = $cust->contact;

            $country_code = $cust->country_code;

            $country = $cust->country;
             $state = $cust->state;
             $city = $cust->city;
          $app_name = $cust->app_name;

            $app_type = $cust->app_type;

            $app_logo = $cust->app_logo;

            $payment_gateway_name = $cust->payment_gateway_name;

            $merchant_name = $cust->merchant_name;

            $razorpay_key = $cust->razorpay_key;
              $client_id = $cust->client_id;

            $secret_key = $cust->secret_key;

            $register_date = $cust->register_date;

           $status = $cust->status;

            

        @endphp

    @endforeach

@endif



@extends('templates.SuperAdmin.layout')

@section('content')

<div class="content mt-3">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <strong class="card-title">Edit Customers</strong>

                    </div>

                     <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Profile</strong></div>

                                <div class="card-body card-block"> 

                                    {!! Form::open(['method' => 'POST', 'url' => 'update-customer', 'enctype' => 'multipart/form-data']) !!}

                                        @csrf

                                        <input type="hidden" name="id" value="{{$id}}">

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Customer ID</label>

                                            <input type="text" id="customer_id" name="customer_id" placeholder="" class="form-control" value="{{$customer_id}}" readonly>

                                        </div>

                                        

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Name</label> 

                                            <input type="text" id="name" name="name" placeholder="" class="form-control" value="{{$name}}" readonly>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Email</label>

                                            <input type="text" id="email" name="email" placeholder="" class="form-control" value="{{$email}}" readonly>

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Contact</label>

                                            <input type="text" id="contact" name="contact" placeholder="" class="form-control" value="{{$contact}}" readonly>

                                        </div>

                                        

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Country Code</label> 

                                            <input type="text" id="country_code" name="country_code" placeholder="" class="form-control" value="{{$country_code}}" readonly>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Country</label>

                                            <input type="text" id="country" name="country" placeholder="" class="form-control" value="{{$country}}" readonly>

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">State</label>

                                            <input type="text" id="state" name="state" placeholder="" class="form-control" value="{{$state}}" readonly>

                                        </div>

                                        

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">City</label> 

                                            <input type="text" id="city" name="city" placeholder="" class="form-control" value="{{$city}}" readonly>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">App Name</label>

                                            <input type="text" id="app_name" name="app_name" placeholder="" class="form-control" value="{{$app_name}}" readonly>

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">App Logo</label>
 
                                            <img src="../images/admin_logo/{{$app_logo}}" style="width:100px;height:100px;" />
                                      

                                        </div>

                                        

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">App Type</label> 

                                            <input type="text" id="app_type" name="app_type" placeholder="" class="form-control" value="{{$app_type}}" readonly>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Payment Gateway Name</label>

                                            <input type="text" id="payment_gateway_name" name="payment_gateway_name" placeholder="" class="form-control" value="{{$payment_gateway_name}}" readonly>

                                        </div>
                                        

                                        

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Registration Date</label> 

                                            <input type="text" id="register_date" name="register_date" placeholder="" class="form-control" value="{{$register_date}}" readonly>

                                        </div>


                                        <div class="form-group col-md-6">

                                            <label for="vat" class="form-control-label">User Status</label> 

                                            <select class="form-control" title="select central looking" name="status" id="status" >

                                                <option value="Unblock" @if($status == "Unblock") selected @endif>Unblock</option>

                                                <option value="Block" @if($status == "Block") selected @endif>Block</option>

                                            </select>

                                            <small class="text-danger">{{ $errors->first('status') }}</small>

                                        </div> 
                                         
                                         
                                            

                                        <div class="card-footer col-md-12">  

                                            <button type="submit" class="btn btn-success btn-sm">

                                                <i class="fa fa-dot-circle-o"></i> Submit

                                            </button>

                                            <button class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('customers')}}">Cancel</a></button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>                                     

@endsection