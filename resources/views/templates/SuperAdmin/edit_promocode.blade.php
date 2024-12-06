@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif
@extends('templates.SuperAdmin.layout')
@section('content')

@if(!empty($promocodes))

    @foreach($promocodes as $promocode)

        @php

            $id = $promocode->id;

            $logo = $promocode->logo;

         @endphp

    @endforeach

@endif



<div class="content mt-3">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <strong class="card-title">Logos</strong>

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Edit Logo</strong></div>

                                <div class="card-body card-block"> 

                                    {!! Form::open(['method' => 'POST', 'url' => 'update-logo', 'enctype' => 'multipart/form-data']) !!}
                                    @csrf 
                                    <input type="hidden" name="id" value="{{$id}}">
                                         <div class="form-group col-md-2">
                                            <img src="../images/logos/{{$logo}}" style="width:80%" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="vat" class="form-control-label">Image</label><br/>
                                            
                                            <input type="file" id="logo" name="logo" class="form-control" value="" >
                                            <small class="text-danger">{{ $errors->first('logo') }}</small>
                                        </div>





                                        <div class="card-footer col-md-12">  

                                            <button type="submit" class="btn btn-success btn-sm">

                                                <i class="fa fa-dot-circle-o"></i> Submit

                                            </button>

                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> 

                                                <a href="{{url('logo')}}"> Cancel</a>

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