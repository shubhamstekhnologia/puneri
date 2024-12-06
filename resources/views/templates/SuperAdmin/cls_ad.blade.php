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
                        <strong class="card-title">Classified Ad</strong>
                       <!--  <a href="add-user" class="right"><i class="fa fa-plus-square"></i> Add Users</a> -->
                    </div>
                      @include('templates.SuperAdmin.messages')
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered table-responsive-sm">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Name</th>
                                <th>E-mail</th>
                                <th>Contact</th>
                                <th>Approval Status</th>
                                <th>Ad Created Date</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(!empty($classified_ads))
                              @php $i = 0 @endphp
                              @foreach($classified_ads as $ads)
                                @php $i++; @endphp
                                  <tr>
                                      <td>{{$i}}</td>
                                      <td>{{$ads->name}}</td>
                                      <td>{{$ads->email}}</td>
                                      <td>{{$ads->contact}}</td>
                                      <td>{{$ads->status}}</td>
                                      <td>{{$ads->created_at}}</td>
                                      <!-- <td><a href="#" class="switch" title="" data-toggle="tooltip" data-original-title="status"><i class="fa"></i></a></td> -->
                                      
                                        <td>
                                            <a href="{{url('edit_classified_ad')}}/{{$ads->id}}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{url('delete_classified_ad')}}/{{$ads->id}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close"></i></a>
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