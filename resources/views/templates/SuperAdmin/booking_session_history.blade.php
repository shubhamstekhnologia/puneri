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
                        <strong class="card-title">Booked Sessions History</strong>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-warning">{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Sr.No</th>
                              <th>Customer Name</th>
                              <th>Session Details</th>
                              <th>Status</th>
                              <th>Session Booking Date</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                              @if(!empty($book_sessions_details))
                              <?php  $i = 0; ?>
                                @foreach($book_sessions_details as $history)
                                  <?php $i++; ?>
                                  <tr>
                                      <td>{{$i}} </td>
                                       <td>
                                       @if(!empty($cust_details))

                                      @foreach($cust_details as $cust)

                                        @if($history->user_auto_id == $cust->id)

                                           {{$cust->name}}
                                          
                                        @endif

                                      @endforeach

                                    @endif
                                      </td>
                                      <td>
                                       

                                          <b>Session Date : </b> {{$history->session_date}}<br>
                                          <b>Start Time : </b> {{$history->start_time}}<br>
                                          <b>End Time : </b> {{$history->end_time}}<br>
                                          <b>Remaining Sessions : </b> {{$history->session_count}}<br>
                                      
                                      </td>
                                      <td>{{$history->status}}</td>
                                      <td>{{$history->created_at}}</td>
                                      <td>
                                       <a href="{{ url('/delete-manage-sessions',$history->id)}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-close"></i></a>
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