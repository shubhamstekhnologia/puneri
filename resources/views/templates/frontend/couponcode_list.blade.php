
@if (Session::has('AccessTokens'))

   <?php $value = Session::get('AccessTokens') ?>

@endif 
@extends('templates.frontend.header')
@section('content')
<div class="container">
            <h3 style="text-align:center;">Promocode List</h3>

    <div class="row">
        
        <div class="col-md-3 col-lg-3 col-sm-6"></div>
  @if(!empty($promocode_lists))
                  @php $i = 0 @endphp
                  @foreach($promocode_lists as $pcode)
                  @php $i++; @endphp
        <div class="col-md-6 col-lg-6 col-sm-12" style="margin: 10px;background: white;box-sizing: border-box;box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);padding: 10px;">
   
            <b>{{$pcode->coupen_code}}<br>
            <p>Get upto {{$pcode->coupen_code_value}} off</p>
            </b>
              {!! Form::open(['method' => 'POST', 'url' => 'promocode_apply', 'enctype' => 'multipart/form-data']) !!}
                   <input type="hidden" class="form-control" value="{{$pcode->coupen_code}}" id="promocode" name="promocode" style="width:75%;">
                    <input type="submit" class="btn btn-success" value="Apply" style="margin-top: -50px;float: right;">
                                           
             </form>
            <!--<a href="{{url('cart')}}"style="float: right;margin-top: -55px;color: blue;">Apply</a>-->
             </div>
             @endforeach
          @endif
        </div>
</div>
  
@endsection