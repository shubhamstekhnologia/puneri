@extends('templates.SuperAdmin.admin_header')
@section('content')
                     
        <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                <center><h3><b>Choose from Main Categories</b></h3></center>
                                </div>
                                </div>
                                </div>            

<div class="container">
   
 <?php foreach($main_category As $main){?>
 <div class="row">
   <h6><?php echo $main['category_name']; ?></h6><br/>
   <div class="row">
        <?php foreach($main['subcategories'] As $s){?>
       <div class="col-md-3">
            <div class="banner2">
                    
                <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $s['subcategory_image_app']; ?>" style="width:280px;height:343px;"><br/>
                 <center><input type="checkbox" name="subcat" value="<?php echo $s['_id']; ?>"/><p id="category_name"><?php echo $s['sub_category_name']; ?></p></center><br/>
                  
              </div>
       </div>
       <?php }?>
   </div>
 </div>

<?php }?>
<div class="row">
    <div class="col-md-12">
         <button type="submit" class="btn btn-md btn-danger pull-right">Save</button>
    </div>
   
</div>

<br/><br/>
   
                 
                     </div> <!--container-fluid-->
                    
              

   @endsection
   
    <!-- Edit Catgeory Modal -->
<div class="modal fade" id="category_image_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
     {!! Form::open(['method' => 'POST', 'url' => 'add_main_category', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf 
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Add Main Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label>Enter Category Name</label>
               <input type="text" class="form-control category_name" name="category_name"/>
           </div>
           </div>
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

    <!-- Catgeory Modal -->
<div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
     {!! Form::open(['method' => 'POST', 'url' => 'add_main_category', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf 
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Edit Main Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label>Category Name</label>
               <input type="text" class="form-control category_name" name="category_name"  value="Category Name"/>
           </div>
           </div>
           <div class="col-md-12">
               <div class="banner2">
                   <img src="https://gruzen.in/GrobizEcomm/images/img/grayscale.jpg" style="width:50%;height:50%;">
                    <br/>
               </div>
              
           </div>
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
      
        <button type="button" id="add_button" class="drop_select btn btn-primary">Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>

<div class="modal fade" id="choose_maincat_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
     {!! Form::open(['method' => 'POST', 'url' => 'add_main_category', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf 
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Choose From  Main Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-md-12">
                <div class="row">
                     Men
                </div>
                  <div class="row">
                     <div class="col-md-2">
                         <div class="banner2">
                             <input type="checkbox" name="sub"/>
                             <img src="https://gruzen.in/GrobizEcomm/images/img/grayscale.jpg" style="width:25%;height:25%">
                         </div>
                         
                     </div>
                </div>
              
           </div>
           
           </div>
           
          
       </div>
       
      </div>
      <div class="modal-footer">
      
        <button type="button" id="add_button" class="drop_select btn btn-primary">Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>


</body>

</html>