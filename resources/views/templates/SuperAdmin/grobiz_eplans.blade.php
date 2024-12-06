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
                        <strong class="card-title">ECommerce Plans</strong>
                          <a href="{{url('add-ecomm-plans')}}" class="right"><i class="fa fa-plus-square"></i> Add Plans</a>
                    </div>
                     @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                     @endif
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                         <thead>
                            <tr>            
                              <th>No</th>
                              <th>Country</th>
                              <th>Plan Name</th>
                              <th>Price</th>
                              <th>Validity</th>
                              <th>Validity Unit</th>
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
                                        <td>{{$offer->country_name}}</td>
                                      <td>{{$offer->name}}</td>
                                       <td>{{$offer->final_price}}</td>
                                       <td>{{$offer->validity}}</td>
                                        <td>{{$offer->validity_unit}}</td>
                                      <td>
                                          <a href="{{url('edit-ecomm-plans',$offer->id)}}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                          <a href="{{url('delete-ecomm-plans')}}/{{$offer->id}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close"></i></a>
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