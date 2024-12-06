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
                        <strong class="card-title">Medical Departments</strong>
                    </div>
                     @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                     @endif
                     <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Add Medical Departments</strong></div>
                                    <div class="card-body card-block"> 
                                        {!! Form::open(['method' => 'POST', 'url' => 'category-save', 'enctype' => 'multipart/form-data']) !!}
                                            @csrf  
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label">Name</label> 
                                                <input type="text" id="cname" name="cname"  class="form-control" value="" placeholder="Category Name">
                                                <small class="text-danger">{{ $errors->first('cname') }}</small>
                                            </div>

                                            

                                            <div class="card-footer col-md-12">  
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Submit
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('pincode')}}">Cancel</a></button> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                     <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Manage Medical Departments</strong></div>
                                    <div class="card-body card-block"> 
                                       <table id="bootstrap-data-table" class="table table-striped table-bordered table-responsive-sm">
                                            <tr>
                                                <td>SR NO.</td>
                                                <td>Name</td>
                                               
                                                <td>Actions</td>
                                            </tr>
                                            @foreach ($allcat as $k=>$val) 
                                                <tr>
                                                    <td>{{$k+1}}</td>
                                                    <td>{{$val->name}}</td>
                                                    
                                                    <td>
                                                        <a href="{{url('edit-category')}}/{{$val->id}}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a> 
                                                        <a href="{{url('delete-category')}}/{{$val->id}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></a> 
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
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