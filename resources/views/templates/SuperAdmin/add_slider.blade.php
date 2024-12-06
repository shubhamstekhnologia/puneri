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
                        <strong class="card-title"> Slider</strong>
                    </div>
                     <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Add Slider</strong></div>
                                    <div class="card-body card-block"> 
                                        {!! Form::open(['method' => 'POST', 'url' => 'store-slider', 'enctype' => 'multipart/form-data']) !!}
                                            @csrf  
                                            <div class="form-group col-md-6">
                                            <label class="form-control-label">Category</label> 
                                            <select id="category" name="category"  class="form-control">
                                                <option value="">Select Category</option> 
                                                @if(!empty($categories))
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                              <small class="text-danger">{{ $errors->first('category') }}</small>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="form-control-label">Image</label> 
                                                <input type="file" name="cimage" class="form-control" value="" >
                                                <small class="text-danger">{{ $errors->first('cimage') }}</small>
                                            </div> 
                                            
                                           <div class="card-footer col-md-12">  
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Submit
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('slider')}}">Cancel</a></button> 
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
</div>                                      
@endsection