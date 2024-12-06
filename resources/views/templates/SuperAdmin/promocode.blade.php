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

                        <strong class="card-title">Logos</strong>

                        <a href="{{url('add-logo')}}" class="right"><i class="fa fa-plus-square"></i> Add Logo</a>

                    </div>

                     @if (Session::has('success'))

                        <div class="alert alert-success">{{ Session::get('success') }}</div>

                     @endif

                    <div class="card-body">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered">

                         <thead>

                            <tr>            

                              <th>No</th>
          
                              <th>Logos</th>

                              <th>Actions</th>

                            </tr>

                          </thead>

                           <tbody>

                            @if(!empty($promocodes))

                              @php $i = 0 @endphp

                              @foreach($promocodes as $promocode)

                                @php $i++; @endphp

                                  <tr>

                                      <td>{{$i}}</td>

                                     <td><img src="images/logos/{{$promocode->logo}}" width="100" height="100" /></td>

                                      <td>
                            
                                        <a href="{{url('edit-logo',$promocode->id)}}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                      <a onclick="return confirm('Are You Sure to delete selected data?')" href="{{url('delete-logo')}}/{{$promocode->id}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close"></i></a>
                                    
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