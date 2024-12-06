@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif
@extends('templates.SuperAdmin.layout')
@section('content')
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
                                <div class="card-header"><strong>Add Image Subscription Plans</strong></div>
                                <div class="card-body card-block"> 
                                    {!! Form::open(['method' => 'POST', 'url' => 'store-image-plans', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf  
                                
                                          <div class="form-group col-md-6">

                                                <label for="vat" class="form-control-label">Plan Name</label> 

                                                <input type="text" id="name" name="name"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                            </div>
                                       
                                     
                                          <div class="form-group col-md-6">

                                                <label for="vat" class="form-control-label">Price</label> 

                                                <input type="text" id="price" name="price"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('price') }}</small>
                                            </div>
                                            <div class="form-group col-md-6">

                                                <label for="vat" class="form-control-label">Offer Percentage</label> 

                                                <input type="text" id="offer_percentage" name="offer_percentage"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('offer_percentage') }}</small>
                                            </div>
                                       
                                     
                                          <div class="form-group col-md-6">

                                                <label for="vat" class="form-control-label">Validity (Days)</label> 

                                                <input type="number" id="validity" name="validity"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('validity') }}</small>
                                            </div>
                                             <div class="form-group col-md-6">

                                                <label for="vat" class="form-control-label">Number of Edits</label> 

                                                <input type="text" id="no_of_edits" name="no_of_edits"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('no_of_edits') }}</small>
                                            </div>
                                             <div class="form-group col-md-6">

                                                <label for="vat" class="form-control-label">Description</label> 

                                                <input type="text" id="description" name="description"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('description') }}</small>
                                            </div>
                                        <div class="card-footer col-md-12">  
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('image-plans')}}">Cancel</a></button> 
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