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
                        <strong class="card-title">Users</strong>
                       <!--  <a href="add-user" class="right"><i class="fa fa-plus-square"></i> Add Users</a> -->
                    </div>
                      @include('templates.SuperAdmin.messages')
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered table-responsive-sm">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Customer ID</th>
                              <th>Name</th>
                                <th>E-mail</th>
                                <th>E-mail Verification</th>
                                 <th>Status</th>
                                 <th>Country</th>
                                 <th>Contact</th>
                                 <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(!empty($customers))
                              @php $i = 0 @endphp
                              @foreach($customers as $customer)
                                @php $i++; @endphp
                                  <tr>
                                      <td>{{$i}}</td>
                                       <td>{{$customer->customer_id}}</td>
                                      <td>{{$customer->name}}</td>
                                      <td>{{$customer->email}}</td>
                                      <td>{{$customer->email_verification}}</td>
                                      <td>{{$customer->status}}</td>
                                      <td>{{$customer->country}}</td>
                                      <td>{{$customer->contact}}</td>
                                      <!-- <td><a href="#" class="switch" title="" data-toggle="tooltip" data-original-title="status"><i class="fa"></i></a></td> -->
                                      
                                        <td>
                                            <a href="{{url('edit-customers')}}/{{$customer->id}}" class="btn btn-success" title="" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></a>
                                            <a href="{{url('delete-customers')}}/{{$customer->id}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close"></i></a>
                                        </td>
                                  </tr>
                              @endforeach
                            @endif  
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection