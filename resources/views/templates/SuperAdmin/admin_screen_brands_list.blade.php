@extends('templates.SuperAdmin.admin_header')
@section('content')
                     
          <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                <center><h6>Choose from Brands</h6></center>
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <div class="row">
        <?php foreach($brands As $s){?>
       <div class="col-md-3">
            <div class="banner2">
                    
                <img id="brand_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $s['brand_image_app']; ?>" style="width:280px;height:343px;"><br/>
                 <center><input type="checkbox" name="subcat" value="<?php echo $s['_id']; ?>"/><p id="category_name"><?php echo $s['brand_name']; ?></p></center><br/>
                  
              </div>
       </div>
       <?php }?>
   </div>
                                    </div>
                                </div>
<div class="row">
    <div class="col-md-12">
         <button type="submit" class="btn btn-md btn-danger pull-right">Save</button>
    </div>
   
</div>


<br/><br/>






   
                 
                     </div> <!--container-fluid-->
                    
              </div>

   
  @endsection
   