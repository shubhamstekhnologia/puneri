@extends('templates.frontend.header')
@section('content')
<h4 style="text-align:center;text-decoration: underline;margin:15px;">Faq's</h4>
   @if(!empty($allfaqs))
                  @foreach($allfaqs as $faqs)
                		<div class="container">
                		    <div class="row">
                	     {{$faqs->faq}}
                	     </div>
                		</div>
                @endforeach
                 @endif

@endsection