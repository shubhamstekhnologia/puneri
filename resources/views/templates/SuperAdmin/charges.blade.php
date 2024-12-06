@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif

@if($allcharges->isNotEmpty())

    @foreach($allcharges as $charge)

        @php $maintance_status = $charge->maintance_status;


        $id = $charge->id; 
        @endphp

    @endforeach

@else

    @php 
    $maintance_status = '';
    $id = 0; 
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

                        <strong class="card-title">Maintance Status</strong>

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Maintance Status</strong></div>

                                <div class="card-body card-block"> 

                                    @include('templates.SuperAdmin.messages')

                                    {!! Form::open(['method' => 'POST', 'url' => 'update-charges', 'enctype' => 'multipart/form-data']) !!}

                                        @csrf

                                        <input type="hidden" name="id" value="{{$id}}">


                                            <div class="form-group col-md-6">

                                            <label for="vat" class="form-control-label">Status</label> 

                                            <select class="form-control" title="select central looking" name="maintance_status" id="maintance_status" >

                                                <option value="Enable" @if($maintance_status == "Enable") selected @endif>Enable</option>

                                                <option value="Disable" @if($maintance_status == "Disable") selected @endif>Disable</option>

                                            </select>

                                            <small class="text-danger">{{ $errors->first('maintance_status') }}</small>

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