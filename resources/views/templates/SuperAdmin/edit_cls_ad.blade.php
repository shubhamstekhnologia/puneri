@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif


@if($classified_ads->isNotEmpty()) 

    @foreach($classified_ads as $cust)

        @php

            $id = $cust->id;

            $name = $cust->name;

            $email = $cust->email;

            $contact = $cust->contact;
            $blood_group = $cust->blood_group;
            $country_of_residence = $cust->country_of_residence;
            $city_of_residence = $cust->city_of_residence;
            $medical_department = $cust->medical_department;
            $classified_ad = $cust->classified_ad;
            $reason = $cust->reason;
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

                        <strong class="card-title">Edit Classified Ad</strong>

                    </div>

                     <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Classified Ad</strong></div>

                                <div class="card-body card-block"> 

                                    {!! Form::open(['method' => 'POST', 'url' => 'update_classified_ad', 'enctype' => 'multipart/form-data']) !!}

                                        @csrf

                                        <input type="hidden" name="id" value="{{$id}}">

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Name</label>

                                            <input type="text" id="name" name="name" placeholder="" class="form-control" value="{{$name}}" readonly>

                                        </div>

                                        

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Email</label> 

                                            <input type="email" id="email" name="email" placeholder="" class="form-control" value="{{$email}}" readonly>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Contact</label>

                                            <input type="text" id="contact" name="contact" placeholder="" class="form-control" value="{{$contact}}" readonly>

                                        </div>

                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Blood Group</label>

                                            <input type="text" id="blood_group" name="blood_group" placeholder="" class="form-control" value="{{$blood_group}}" readonly>

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Country of Residence</label>

                                            <input type="text" id="country_of_residence" name="country_of_residence" placeholder="" class="form-control" value="{{$country_of_residence}}" readonly>

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">City of Residence</label>

                                            <input type="text" id="city_of_residence" name="city_of_residence" placeholder="" class="form-control" value="{{$city_of_residence}}" readonly>

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Medical Department</label>

                                            <input type="text" id="medical_department" name="medical_department" placeholder="" class="form-control" value="{{$medical_department}}" readonly>

                                        </div>
                                        <div class="form-group col-md-6">

                                            <label class="form-control-label">Classified Ad</label>

                                            <textarea id="classified_ad" name="classified_ad" placeholder="" class="form-control" value="" readonly>{{$classified_ad}}</textarea> 

                                        </div>


                                        <div class="form-group col-md-6">

                                            <label for="vat" class="form-control-label">Approval Status</label> 

                                            <select class="form-control" title="select central looking" name="status" id="status" >

                                                <option value="InReview" @if($status == "InReview") selected @endif>InReview</option>

                                                <option value="Approved" @if($status == "Approved") selected @endif>Approved</option>
                                                
                                                <option value="Disapproved" @if($status == "Disapproved") selected @endif>Disapproved</option>
                                                

                                            </select>

                                            <small class="text-danger">{{ $errors->first('status') }}</small>

                                        </div> 
                                         
                                          <div class="form-group col-md-6">

                                            <label class="form-control-label">Reason For Disapproval</label>

                                            <textarea id="reason" name="reason" placeholder="" class="form-control" value="" >{{$reason}}</textarea> 

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