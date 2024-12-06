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

                        <strong class="card-title">Account</strong>

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <strong>Change Password</strong>

                                </div>

                                @if (Session::has('message'))

                                    <div class="alert alert-warning">{{ Session::get('message') }}</div>

                                @endif

                                @if (Session::has('success'))

                                    <div class="alert alert-success">{{ Session::get('success') }}</div>

                                @endif

                                <div class="card-body card-block"> 

                                    {!! Form::open(['method' => 'POST', 'url' => 'updateaccount']) !!}



                                        <div class="form-group">

                                            <label for="vat" class=" form-control-label">Old Password</label> 

                                           <input type="password" id="oldp" placeholder="Enter Old Password" class="form-control" value="{{old('oldp')}}" name="oldp">

                                            <small class="text-danger">{{ $errors->first('oldp') }}</small>

                                        </div>



                                        <div class="form-group">

                                            <label for="vat" class=" form-control-label">New Password</label> 

                                           <input type="password" id="newp" placeholder="Enter New Password" class="form-control" value="" name="newp">

                                            <small class="text-danger">{{ $errors->first('newp') }}</small>

                                        </div>



                                           

                                        <div class="card-footer">  

                                             <button type="submit" class="btn btn-success btn-sm">

                                                <i class="fa fa-dot-circle-o"></i> Submit

                                            </button>

                                            <button class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="dashboard">Cancel</a></button> 

                                        </div> 

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div><!-- .animated -->

</div><!-- .content -->

@endsection