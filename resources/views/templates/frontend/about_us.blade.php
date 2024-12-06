@extends('templates.frontend.header')
@section('content')
<h4 style="text-align:center;text-decoration: underline;margin:15px;">About Us</h4>
   @if(!empty($allabouts))
                  @foreach($allabouts as $abouts)
                		<div class="container">
                		    <div class="row">
                	     {{$abouts->about}}
                	     </div>
                		</div>
                @endforeach
                 @endif

@endsection