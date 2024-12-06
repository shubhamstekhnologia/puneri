@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif

@if($allbanners->isNotEmpty())

  @foreach($allbanners as $banner)

      @php
       $id = $banner->id;
      $offer_img = $banner->offer_img;

   
      @endphp

  @endforeach
@else

    @php 

        $id = 0; 
        $offer_img = '';
     @endphp
@endif

@extends('templates.SuperAdmin.layout')
@section('content')

<div class="content mt-3">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <strong class="card-title">Banner</strong>

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Update Banner</strong></div>

                                <div class="card-body card-block"> 

                                    @include('templates.SuperAdmin.messages')

                                    {!! Form::open(['method' => 'POST', 'url' => 'update-banner', 'enctype' => 'multipart/form-data']) !!}

                                        @csrf

                                        <input type="hidden" name="id" value="{{$id}}">


                                            

                                         <div class="form-group col-md-6">
                                            <label for="vat" class="form-control-label">Logo</label><br/>
                                            <img src="images/banner/{{$offer_img}}" style="width:30%" /><br/><br/>
                                            <input type="file" id="offer_img" name="offer_img" class="form-control" value="" >
                                            <small class="text-danger">{{ $errors->first('offer_img') }}</small>
                                        </div>

                                       



                                        <div class="card-footer col-md-12">  

                                            <button type="submit" class="btn btn-success btn-sm">

                                                <i class="fa fa-dot-circle-o"></i> Submit

                                            </button>

                                                        

                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('home')}}">Cancel</a></button> 

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