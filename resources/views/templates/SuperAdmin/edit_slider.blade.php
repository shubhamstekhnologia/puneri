
@extends('templates.SuperAdmin.admin_header')
@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-12">
            <br/>
             <h3><center>Edit Slider</center></h3>
             <center>Edit First Image&nbsp;&nbsp;<input type="file"name="slider_first_img"/></center><br/>
      <div class="container">
          <img src="./images/slider/no_slider.jpg"  style="width:100%;height:250px;"/>
      </div>
      <br/>
        
             <center>Edit Other Images&nbsp;&nbsp;<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#slider_image"><i class="fa fa-plus"></i></button></center><br/>
      <div class="container">
          <div class="row">
              <div class="col-md-3">
                  <input type="file"name="slider_first_img" onchange="preview_sliderimage(event)"/><br/>
                   <img  src="./images/slider/no_slider.jpg"  class="img img-responsive output_slider_image"  style="width:auto;height:auto;"/>
             
              </div>
              <div class="col-md-3">
                  <input type="file"name="slider_first_img"/><br/>
                   <img src="./images/slider/no_slider.jpg"  class="img img-responsive output_slider_image" style="width:auto;height:auto;"/>
              </div>
              <div class="col-md-3">
                  <input type="file"name="slider_first_img"/><br/>
                   <img src="./images/slider/no_slider.jpg"  class="img img-responsive output_slider_image" style="width:auto;height:auto;"/>
              </div>
              <div class="col-md-3">
                  <input type="file"name="slider_first_img"/><br/>
                   <img src="./images/slider/no_slider.jpg"  class="img img-responsive output_slider_image"  style="width:auto;height:auto;"/>
              </div>
              
          </div>
         
      </div>   
      <br/>
      <a href="#" class="btn btn-sm btn-danger pull-right">Update</a>
            
           
        </div>
       
    </div>
    
     <br/> <br/> <br/> <br/>
</div>

<!--Add Slider Modal-->
<div class="modal fade" id="slider_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
     {!! Form::open(['method' => 'POST', 'url' => 'add_slider', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf 
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Add Slider Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><div aria-hidden="true">&times;</div></button>
      </div>
      <div class="modal-body">
       <div class="row">
       
            <div class="col-md-12">
                   <div class="form-group">
                       <label>Select Image</label>
                   </div>
           
 <input type="file" class="form-control image" onchange="preview_image(event)" name="image" >
 <img id="output_image"/>

           </div>
          
          
       </div>
       
      </div>
      <div class="modal-footer">
      
        <button type="button" id="add_button" class="drop_select btn btn-primary">Add</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>



@endsection
