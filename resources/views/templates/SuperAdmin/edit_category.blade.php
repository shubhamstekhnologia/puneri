@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif
@extends('templates.SuperAdmin.layout')
@section('content')
@if(!empty($categories))
    @foreach($categories as $category)
        @php
            $id = $category->id;
            $name = $category->name;
          
        @endphp
    @endforeach
@endif
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Medical Departments</strong>
                    </div>
                     <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Edit Medical Departments</strong></div>
                                <div class="card-body card-block"> 
                                    {!! Form::open(['method' => 'POST', 'url' => 'update-category', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf 
                                    
                                        <input type="hidden" name="id" value="{{$id}}">       
                                         <div class="form-group col-md-6">
                                            <label for="vat" class="form-control-label">Name</label><br/>
                                           
                                            <input type="text" id="cname" name="cname" class="form-control" value="{{$name}}" >
                                            <small class="text-danger">{{ $errors->first('cname') }}</small>
                                        </div>                
                                        
                                        
                                        <div class="card-footer col-md-12">  
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> 
                                                <a href="{{url('categories')}}"> Cancel</a>
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