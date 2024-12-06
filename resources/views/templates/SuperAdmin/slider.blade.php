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
                        <strong class="card-title"> Sliders</strong>
                        <a href="{{url('add-slider')}}" class="right"><i class="fa fa-plus-square"></i> Add Slider</a>
                    </div>
                     @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                     @endif
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered table-responsive-sm">
                         <thead>
                            <tr>            
                              <th>No</th>
                              <th>Category</th>
                              <th>Image</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                           <tbody>
                            @if(!empty($sliders))
                              @php $i = 0 @endphp
                              @foreach($sliders as $slider)
                                @php $i++; @endphp
                                  <tr>
                                      <td>{{$i}}</td>
                                       <td>{{$slider->category}}</td>
                                      <td><img src="images/slider/{{$slider->logo}}" style="width: 100px;height:100px"/></td>
                                      
                                      <td><a href="{{ url('edit-slider',$slider->id)}}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>


                                      <a href="{{url('delete-slider')}}/{{$slider->id}}" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-close"></i></a></td>
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