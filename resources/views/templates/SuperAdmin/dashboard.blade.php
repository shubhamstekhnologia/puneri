@if (Session::has('AccessToken'))

   <?php  $value = Session::get('AccessToken') ?>

@else

	<script>window.location.href = "SuperAdmin";</script>

@endif

@section('content')

@extends('templates.SuperAdmin.layout')



	<div class="col-sm-6 col-lg-3">
       <a href="customers">
	    
	    <div class="card text-white bg-flat-color-1 dashboard_box">
         
             <div class="card-body pb-0">

	        	<div class="col-md-4">

	        		<div class="dashboard_img_main">

		        		<div id="dashboard_img">

		        			<img src="{{asset('templates-assets/OrganicSuperAdminWeb/images/user.png')}}" alt="Collection">

		        		</div>

		        	</div>

	        	</div>

	        	<div class="col-md-8 card-dash">

	        		<span class="heading">Manage Customers</span>

		            <div id="count">{{$users}}</div>

		        </div>

		        <div class="col-md-12 dashboard_bborder"><p>Total Customers</p></div>

	        </div>
       
	    </div>
         </a>
	</div>

	<div class="col-sm-6 col-lg-3">
       <a href="purchased-history">
	    
	    <div class="card text-white bg-flat-color-1 dashboard_box">
         
             <div class="card-body pb-0">

	        	<div class="col-md-4">

	        		<div class="dashboard_img_main">

		        		<div id="dashboard_img">

		        			<img src="{{asset('templates-assets/OrganicSuperAdminWeb/images/booking.jpg')}}" alt="Collection">

		        		</div>

		        	</div>

	        	</div>

	        	<div class="col-md-8 card-dash">

	        		<span class="heading"> Manage Order History</span>

		            <div id="count">{{$order_history}}</div>

		        </div>

		        <div class="col-md-12 dashboard_bborder"><p>Total Order History</p></div>

	        </div>
       
	    </div>
         </a>
	</div>
	


@endsection