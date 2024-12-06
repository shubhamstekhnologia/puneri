@extends('templates.frontend.header')
@section('content')
<h4 style="text-align:center;text-decoration: underline;margin:15px;">Privacy Policy</h4>
   @if(!empty($allprivacy))
                  @foreach($allprivacy as $privacypolicy)
                		<div class="container">
                		    <div class="row">
                	     {{$privacypolicy->privacy}}
                	     </div>
                		</div>
                @endforeach
                 @endif

@endsection