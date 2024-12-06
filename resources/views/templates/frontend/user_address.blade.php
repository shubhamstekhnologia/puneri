@if (Session::has('AccessTokens'))
<?php $value = Session::get('AccessTokens') ?>
@else
<script>
    window.location.href = ''
</script>
@endif
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
            <li class="step step3">PAYMENT</li>
        </ol>
        <div class="secureContainer"></div>
    </div>
</div>

<div class="content mt-3">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <strong class="card-title">User Address</strong>

                        <a href="{{url(Session('main').'/add-user-address')}}" class="right" style="float: right;"><i
                                class="fa fa-plus-square"></i> Add Address</a>

                    </div>

                    @if (Session::has('success'))

                    <div class="alert alert-success">{{ Session::get('success') }}</div>

                    @endif

                    <div class="card-body">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered">

                            <thead>

                                <tr>

                                    <th>Select</th>

                                    <th>Address Details</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>

                                @if($user_address->isNotEmpty())

                                @php $i = 0 @endphp

                                @foreach($user_address as $promocode)

                                @php $i++; @endphp

                                <tr>

                                    <td>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="addresses" ,
                                                value='{{$promocode->id}}}'>
                                        </div>
                                    </td>

                                    <td>Name : {{$promocode->name}}<br>
                                        Mobile No : {{$promocode->mobile_no}}<br>
                                        Area : {{$promocode->area}}<br>
                                        City : {{$promocode->city}}<br>
                                        State : {{$promocode->state}}<br>
                                        Country : {{$promocode->country}}<br>
                                        Pincode : {{$promocode->pincode}}<br>
                                        Address Details : {{$promocode->address_details}}<br>
                                        Address Type : {{$promocode->address_type}}<br>

                                    </td>

                                    <td>

                                        <a href="{{url(Session('main').'/edit-user-address',$promocode->id)}}"
                                            class="btn btn-primary" title="" data-toggle="tooltip"
                                            data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Are You Sure to delete selected data?')"
                                            href="{{url(Session('main').'/delete-user-address')}}/{{$promocode->id}}"
                                            class="btn btn-danger" title="" data-toggle="tooltip"
                                            data-original-title="Delete"><i class="fa fa-close"></i></a>

                                    </td>

                                </tr>

                                @endforeach

                                @endif
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <a href="{{ url(Session('main')) }}" class="btn btn-warning"><i
                                                class="fa fa-angle-left"></i> Continue Shopping</a>
                                        @if(Session('cart') && $user_address->isNotEmpty() )
                                        <button class="btn btn-success" id="proceed_to_payment"
                                            onclick="proceed_to_payment()">Proceed</button>
                                        @endif
                                    </td>
                                </tr>


                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div><!-- .animated -->

</div><!-- .content -->

<script>

    function proceed_to_payment()
    {
        location.href= "{{ url(Session('main').'/payment')}}";
    }
</script>

@endsection