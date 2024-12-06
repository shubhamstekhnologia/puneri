@extends('templates.frontend.header')
@section('content')
<h4 style="text-align:center;text-decoration: underline;margin:15px;">Term & Conditions</h4>
   @if(!empty($allterms))
                  @foreach($allterms as $tms)
                		<div class="container">
                		    <div class="row">
                	     {{$tms->term}}
                	     </div>
                		</div>
                @endforeach
                 @endif

@endsection