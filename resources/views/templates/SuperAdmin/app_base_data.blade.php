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
                        <strong class="card-title">App Data</strong>
                          <a href="{{url('add-app-data')}}" class="right"><i class="fa fa-plus-square"></i> Add App data</a>
                    </div>
                     @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                     @endif
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                         <thead>
                            <tr>            
                              <th>No</th>
                              <th>App Name</th>
                              <th>Image</th>
                              <th>Keyword</th>
                               <th>Actions</th>
                            </tr>
                          </thead>
                           <tbody>
                            @if(!empty($offers))
                              @php $i = 0 @endphp
                              @foreach($offers as $offer)
                                @php $i++; @endphp
                                  <tr>
                                      <td>{{$i}}</td>
                                      <td>{{$offer->app_name}}</td>
                                      <td><img src="images/app_data/{{$offer->app_image}}" width="100" height="100" /></td>
                                       <td>{{$offer->keywords}}</td>
                                      <td>
                                          <a href="{{url('edit-app-data',$offer->id)}}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                          <a href="{{url('delete-app-data')}}/{{$offer->id}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close"></i></a>
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