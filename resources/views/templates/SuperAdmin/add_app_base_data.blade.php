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
                        <strong class="card-title">App Data</strong>
                    </div>
                     <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Add App Data</strong></div>
                                <div class="card-body card-block"> 
                                    {!! Form::open(['method' => 'POST', 'url' => 'store-app-data', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf  
                                          <div class="form-group col-md-4">

                                                <label for="vat" class="form-control-label">App Name</label> 

                                                <input type="text" id="app_name" name="app_name"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('app_name') }}</small>
                                            </div>
                                       
                                        <div class="form-group col-md-4">
                                            <label for="vat" class="form-control-label">Image</label> 
                                            <input type="file" id="app_image" name="app_image" class="form-control" value="" >
                                            <small class="text-danger">{{ $errors->first('app_image') }}</small>
                                        </div> 
                                          <div class="form-group col-md-4">

                                                <label for="vat" class="form-control-label">Keyword</label> 

                                                <input type="text" id="keywords" name="keywords"  class="form-control" value="">

                                                <small class="text-danger">{{ $errors->first('keywords') }}</small>
                                            </div>
                                        <div class="card-footer col-md-12">  
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('app-data')}}">Cancel</a></button> 
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