@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif
@extends('templates.SuperAdmin.layout')
@section('content')
@if(!empty($offers))
    @foreach($offers as $offer)
        @php
            $id = $offer->id;
            $name = $offer->name;
            $price = $offer->price;
            $offer_percentage = $offer->offer_percentage;
            $validity = $offer->validity;
            $no_of_edits = $offer->no_of_edits;
            $description = $offer->description;
            $status = $offer->status;
        @endphp
    @endforeach
@endif
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Image Subscription Plans</strong>
                    </div>
                     <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Edit Image Subscription Plans</strong></div>
                                <div class="card-body card-block"> 
                                    {!! Form::open(['method' => 'POST', 'url' => 'update-image-plans', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf 
                                        <input type="hidden" name="id" value="{{$id}}"> 
                         
                                            <div class="form-group col-md-6">



                                                <label class="form-control-label">Plan Name</label> 



                                                <input type="text" name="name" class="form-control" value="{{$name}}" >



                                                <small class="text-danger">{{ $errors->first('name') }}</small>



                                            </div>
                                                 <div class="form-group col-md-6">



                                                <label class="form-control-label">Price</label> 



                                                <input type="text" name="price" class="form-control" value="{{$price}}" >



                                                <small class="text-danger">{{ $errors->first('price') }}</small>



                                            </div>

                                            <div class="form-group col-md-6">



                                                <label class="form-control-label">Offer Percentage</label> 



                                                <input type="text" name="offer_percentage" class="form-control" value="{{$offer_percentage}}" >



                                                <small class="text-danger">{{ $errors->first('offer_percentage') }}</small>



                                            </div>
                                                 <div class="form-group col-md-6">



                                                <label class="form-control-label">Validity (Days)</label> 



                                                <input type="number" name="validity" class="form-control" value="{{$validity}}" >



                                                <small class="text-danger">{{ $errors->first('validity') }}</small>



                                            </div>

                                            <div class="form-group col-md-6">



                                                <label class="form-control-label">Number of Edits</label> 



                                                <input type="text" name="no_of_edits" class="form-control" value="{{$no_of_edits}}" >



                                                <small class="text-danger">{{ $errors->first('no_of_edits') }}</small>



                                            </div>
                                                 <div class="form-group col-md-6">



                                                <label class="form-control-label">Description</label> 



                                                <input type="text" name="description" class="form-control" value="{{$description}}" >



                                                <small class="text-danger">{{ $errors->first('description') }}</small>



                                            </div>
                                              <div class="form-group col-md-6">



                                                <label class="form-control-label">Status</label> 



                                                <input type="text" name="status" class="form-control" value="{{$status}}" >



                                                <small class="text-danger">{{ $errors->first('status') }}</small>



                                            </div>

                             
                                        <div class="card-footer col-md-12">  
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> 
                                                <a href="{{url('image-plans')}}"> Cancel</a>
                                            </button> 
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