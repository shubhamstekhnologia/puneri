@extends('templates.SuperAdmin.admin_header')
@section('content')
<br/>
                      <div class="row">
                          <div class="col-md-12">
                               <button class="btn btn-sm btn-danger pull-right" data-toggle="modal" data-target="#category_image_modal"><i class="fa fa-add"></i>Add Category</button>
                          </div>
                         
                      </div>
                      <!--Only Category Name-->
                       <?php 
                      
                           if($main_cat_style=="0")
                           {?>
                            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <!--<a class="navbar-brand" href="#">Mega Menu</a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
         <div class="navbar-toggler-icon"></div> 
        </button>
        <div class="collapse navbar-collapse" id="mobile_nav">
        <!--<ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-right">-->
        <!--</ul>-->
        <ul class="navbar-nav navbar-light">
            <!--<li class="nav-item"><a class="nav-link" href="#">Home</a></li>-->
            <!--<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>-->
            <!--<li class="nav-item dmenu dropdown">-->
            <!--    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
            <!--    Services-->
            <!--    </a>-->
            <!--    <div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown">-->
            <!--        <a class="dropdown-item" href="#">Software Development</a>-->
            <!--        <a class="dropdown-item" href="#">Web Designing & Development</a>-->
            <!--        <a class="dropdown-item" href="#">Mobile Application</a>-->
            <!--        <a class="dropdown-item" href="#">Business Solutions & Business Process</a>-->
            <!--        <a class="dropdown-item" href="#">Digital Marketing & SEO Services</a>-->
            <!--        <a class="dropdown-item" href="#">Web Hosting & Maintenance</a>-->
            <!--        <a class="dropdown-item" href="#">Cyber Security</a>-->
            <!--        <a class="dropdown-item" href="#">Block Chain Implementation</a>-->
            <!--        <a class="dropdown-item" href="#">Big Data</a>-->
            <!--    </div>-->
            <!--</li>-->
            <!--========-->
            <?php foreach($main_category As $main){?>
            
            <li class="nav-item dropdown megamenu-li dmenu">
                
                
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $main['category_name'];?></a><a href="#"><i class="fa fa-edit"  data-toggle="modal" data-target="#edit_category_modal"></i></a>&nbsp;&nbsp;<a onclick="return confirm('Are you sure you want to delete this item?');" href="#"><i class="fa fa-trash"></i></a>
               
                <!--<a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Services</a>-->
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <div class="row">
                        
                         <?php foreach($main['subcategories'] As $sub){?>
                          <div class="col-sm-6 col-lg-3 border-right mb-4">
                            <h6><?php echo $sub['sub_category_name']?></h6>
                            <a class="dropdown-item" href="#"><i class="fab fa-magento"></i>Sub Sub Category 1</a>
                            <a class="dropdown-item" href="#"><i class="fab fa-magento"></i>Sub Sub Category 2</a>
                            <a class="dropdown-item" href="#"><i class="fab fa-magento"></i>Sub Sub Category 3</a>
                            <a class="dropdown-item" href="#"><i class="fab fa-magento"></i>Sub Sub Category 4</a>
                            <a class="dropdown-item" href="#"><i class="fab fa-magento"></i>Sub Sub Category 5</a>
                        </div>
                         <?php }?>
                       
                       <!--<div class="col-sm-6 col-lg-3 border-right mb-4">-->
                       <!--     <h6>LAMP Technology</h6>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-php"></i> PHP Website Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-circle"></i> Phalcon Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-laravel"></i> Laravel Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-wordpress-simple"></i> WordPress Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-php"></i> Symfony Development</a>-->
                       <!-- </div>-->
                       <!-- <div class="col-sm-6 col-lg-3 border-right mb-4">-->
                       <!--     <h6>Mobile</h6>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-apple"></i> iPhone App Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android App Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Phone Gap App Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> Hybrid App Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Ionic Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-tablet-alt"></i> React Native Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Xamarin App Development</a>-->
                       <!-- </div>-->
                       <!-- <div class="col-sm-6 col-lg-3 mb-4">-->
                       <!--     <h6>Node.js & MongoDB</h6>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-cubes"></i> Full Stack Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> MEAN Stack</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-angular"></i> AngularJS</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fab fa-node-js"></i> Node.JS Development</a>-->
                       <!--     <a class="dropdown-item" href="#"><i class="fas fa-leaf fa-rotate-90"></i> MongoDB Development</a>-->
                       <!-- </div>-->
                    </div>
                     
                </div>
                
            </li>
            <?php }?>
   
        </ul>
        </div>
    </div>
</nav>
                   
                    <?php }?>
                    
                     <!--Only Category Image Circle-->
                   <?php if($main_cat_style=="1")
                           {?>
                           
                           <div class="row">
              
                                <di v class="owl-carousel owl-theme">
                                    <?php foreach($main_category As $main)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                    
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/categories/<?php echo $main['category_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <a href="#"><i class="fa fa-edit main_cat_edit_btn" data-toggle="modal" data-target="#edit_category_modal"></i></a>&nbsp;&nbsp;<a href="#" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
         
                                    <?php }
                                    
                                    }?>
                                </div>
                            </div>
                           
                             
                             
                              <!--Only Category Image and Category Name Circle-->
                   <?php if($main_cat_style=="2")
                           {?>
                           <div class="row">
                            
              
                                <div class="owl-carousel owl-theme">
                                    <?php foreach($main_category As $main)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                    
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/categories/<?php echo $main['category_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $main['category_name']; ?></p></center><br/>
                    <a href="#"><i class="fa fa-edit main_cat_edit_btn" data-toggle="modal" data-target="#edit_category_modal"></i></a>&nbsp;&nbsp;<a href="#" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
         
                                    <?php }?>
                                </div>
                            </div>
                       <?php   }?>  
                          
                        
                          <!--Only Category Image Square-->
                   <?php if($main_cat_style=="3")
                           {?>
                             <div class="row">
                            
              
                                <div class="owl-carousel owl-theme">
                                    <?php foreach($main_category As $main)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                    
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/categories/<?php echo $main['category_image_app']; ?>" style="height:150px;"><br/>
                                                    <a href="#"><i class="fa fa-edit main_cat_edit_btn" data-toggle="modal" data-target="#edit_category_modal"></i></a>&nbsp;&nbsp;<a href="#" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                   
                                                </div>
                                            </div>
         
                                    <?php }?>
                                </div>
                            </div>
                           
                             <?php }?>
                             
                             
                             
                          <!--Only Category Image and Category Name Square-->
                   <?php if($main_cat_style=="4")
                           {?>
                             <div class="row">
                            
              
                                <div class="owl-carousel owl-theme">
                                    <?php foreach($main_category As $main)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                    
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/categories/<?php echo $main['category_image_app']; ?>" style="height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $main['category_name']; ?></p></center><br/>
                                                     <a href="#"><i class="fa fa-edit main_cat_edit_btn" data-toggle="modal" data-target="#edit_category_modal"></i></a>&nbsp;&nbsp;<a href="#" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                   
                                                </div>
                                            </div>
         
                                    <?php }?>
                                </div>
                            </div>
                           
                             <?php }?>

                    <?php foreach($homecomponent As $v){
                    if($v['component_type']=="Slider"){?>
                      <div class="row">
                          
                    <?php if(!empty($v['slider_images'])){?>
                   
                        
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                 <h6><?php echo $v['title']?></h6>
                            </div>
                           
                        </div>
                         <div class="col-md-12">
                            <div class="row">
                                  <div class="col-md-6">
                                      
                                  </div>
                                  <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                        </div>
                                        <div class="col-md-6">
                                           <div class="row">
                                               <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                          <div class="col-md-10">
                                                        
                                                              <!--<a href="{{url('admin_add_slider')}}" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></a>-->
                                                             <a href="{{url('admin_edit_slider')}}" class="btn btn-sm btn-danger"><i class="fa fa-edit"></i></a>
                                                             <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                                       
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              
                          </div>
                    <div class="sliding_banner col-md-12">
                    <div class="slider" style="padding-right:13px;">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                              
                                 <img src="https://gruzen.in/GrobizEcomm/images/slider/<?php echo $v['first_img'];?>" class="d-block w-100" alt="..." style="height:400px;">
                               
                              </div>
                               
                                <?php foreach($v['slider_images'] As $s) {?>
                              <div class="carousel-item">
                                 <img src="https://gruzen.in/GrobizEcomm/images/slider/<?php echo $s['component_image'];?>" class="d-block w-100" alt="..." style="height:400px;">
                              </div>
                              <?php }?>
                              <!--<div class="carousel-item">-->
                              <!--   <img src="https://gruzen.in/GrobizEcomm/images/slider/slider3.webp" class="d-block w-100" alt="...">-->
                              <!--</div>-->
                              <!--<div class="carousel-item">-->
                              <!--   <img src="https://gruzen.in/GrobizEcomm/images/slider/slider4.webp" class="d-block w-100" alt="...">-->
                              <!--</div>-->
                             </div>
                             </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                              <div class="carousel-control-prev-icon" aria-hidden="true"></div>
                              <div class="sr-only">Previous</div>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                              <div class="carousel-control-next-icon" aria-hidden="true"></div>
                              <div class="sr-only">Next</div>
                            </a>
                          </div>
                      </div>
                  
                    <?}else{?>
                   <h6>No Slider</h6>
                            
                    <?php }} ?>
                    </div> 
                     <?php if($v['component_type']=="Brand"){?>
                      <div class="container-fluid">
                           <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                 <h6><?php echo $v['title']?></h6>
                          
                           </div>
                        </div>
                           <div class="col-md-12">
                              <div class="row">
                                  <div class="col-md-6">
                                      
                                  </div>
                                  <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                        </div>
                                        <div class="col-md-6">
                                           <div class="row">
                                               <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                        
                                                       
                                                            <a href="{{url('ecommerce_admin_brands')}}" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></a>
                                                             &nbsp;<a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i></a>
                                                       
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                                   
                              
                              
                              
                          </div>
                        
                                        
                                         <?php if($v['web_layout_type']==0){?>
                      
                          
                    
                        <div class="col-md-12">
                             <div class="owl-carousel owl-theme">
                                    <?php foreach($v['content'] As $sub)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                                                </div>
                                            </div>
                                             
         
                                    <?php }?>
                                </div>
                                
                            </div>
                    
                             
                                        <?php }?>
                                        
                                        
                                        
                        <!--Double Strip Sliding-->
                       <?php if($v['web_layout_type']==1){?>
                      
                          
                    
                        <div class="col-md-12">
                             <div class="owl-carousel owl-theme">
                                    <?php foreach($v['content'] As $sub)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                                                </div>
                                            </div>
                                             
         
                                    <?php }?>
                                </div>
                                
                            </div>
                     <div class="col-md-12">
                             <div class="owl-carousel owl-theme">
                                    <?php foreach($v['content'] As $sub)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                                                </div>
                                            </div>
                                             
         
                                    <?php }?>
                                </div>
                                
                            </div>
                             
                                        <?php }?>
                                        
                                        
                                        
                                        
                                        <!--3X3-->
                                        
                                          <?php if($v['web_layout_type']==2){
                                             if(count($v['content'])<16){
                                          foreach($v['content'] As $sub){?>
                                           <div class="col-md-4" style="padding:50px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;" >
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                          
                                        <?php }}else{?>
                                           
                                                 <?php for($i=0;$i<9;$i++){?>
                                                  <div class="col-md-4">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;" >
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></center>
                   <?}?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }?>
                                        </div>
                      </div>
                      
                                       
                                        
                                        <?php }}?>
                                        
                                        
                                        <!--4 X 4-->
                                        
                                        <?php if($v['web_layout_type']==3){
                                        
                                         if(count($v['content'])<16){
                                          foreach($v['content'] As $sub){?>
                                          
                                          <div class="col-md-3" style="padding:50px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                   <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                         <?php }}else{?>
                                         
                                         <?php for($i=0;$i<16;$i++){?>
                                                  <div class="col-md-3">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }?>
                                         
                                         <?php }?>
                                        
                                           
                                                 
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                        
                                        <!--6X6-->
                                        
                                         <?php if($v['web_layout_type']==4){
                                        
                                           
                                                
                                                 if(count($v['content'])<36){
                                                 
                                                 foreach($v['content'] As $sub){?>
                                                   <div class="col-md-2" style="padding:55px;">
                                                       <div class="container-fluid">
                                                           <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                                       </div>
                                                
                                            </div>
                                                 <?php } }else { for($i=0;$i<36;$i++){?>
                                                  <div class="col-md-2" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                           
                                        <!--7columns single strip static-->
                                        
                                         <?php if($v['web_layout_type']==5){
                                        
                                           
                                                
                                                 if(count($v['content'])<7){
                                                 
                                                 foreach($v['content'] As $sub){?>
                                                   <div class="col" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                   <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<7;$i++){?>
                                                  <div class="col" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                        <!--4X2-->
                                        
                                         <?php if($v['web_layout_type']==6){
                                        
                                           
                                                
                                                 if(count($v['content'])<8){
                                                 
                                                 foreach($v['content'] As $sub){?>
                                                   <div class="col-md-3" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<8;$i++){?>
                                                  <div class="col-md-3" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="width:343px;height:280px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="width:343px;height:280px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                       
                   
 
 <?php }?>
 
                     <?php if($v['component_type']=="Banner"){?>
                     <div class="container-fluid">
                         <div class="row">
                           <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                 <h6><?php echo $v['title']?></h6>
                            </div>
                           
                        </div>
                         <div class="col-md-12">
                            <div class="row">
                                  <div class="col-md-6">
                                      
                                  </div>
                                  <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                        </div>
                                        <div class="col-md-6">
                                           <div class="row">
                                               <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-8">
                                                        
                                                       
                                                             <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-edit" style="margin-left:0px;height:0px;"></i></a>
                                                             <a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i></a>
                                                       
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                               <br/>
                          </div>
                        
                       
                  <div class="col-md-12">
                      
                      
                           <?php foreach($v['content'] As $b){?>
                      <img src="https://gruzen.in/GrobizEcomm/images/slider/<?php echo $b['component_image'];?>" style="width:100%;height:500px;" class="img-responsive"> 
                      <?php }?>
                   
                     
                     
                      </div>
                  </div>  
                     </div>
                    
                         
                    <?php } ?>
                    
                     <?php if($v['component_type']=="SubCategories"){?>
                     <div class="container-fluid">
                         <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                 <h6><?php echo $v['title']?></h6>
                            </div>
                           
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                  <div class="col-md-6">
                                      
                                  </div>
                                  <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                        </div>
                                        <div class="col-md-6">
                                           <div class="row">
                                               <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                        
                                                       
                                                             <a href="{{url('ecommerce_admin_subcat')}}" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></a>
                                                             &nbsp;<a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i></a>
                                                       
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              
                          </div>
                                        
                                         <?php if($v['web_layout_type']==0){?>
                      
                          
                    
                        <div class="col-md-12">
                             <div class="owl-carousel owl-theme">
                                    <?php foreach($v['content'] As $sub)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;height:180px;"><br/>
                                                    <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;height:180px;"><br/>
                                                   <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height:180px;"><br/>
                                                   <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height:180px;"><br/>
                                                   <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                 
                                                </div>
                                               
                                            </div>
                                             
         
                                    <?php }?>
                                </div>
                                
                            </div>
                    
                             
                                        <?php }?>
                                        
                                        
                                        
                        <!--Double Strip Sliding-->
                       <?php if($v['web_layout_type']==1){?>
                      
                          
                    
                        <div class="col-md-12">
                             <div class="owl-carousel owl-theme">
                                    <?php foreach($v['content'] As $sub)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                  
                                                </div>
                                            </div>
                                             
         
                                    <?php }?>
                                </div>
                                
                            </div>
                     <div class="col-md-12">
                             <div class="owl-carousel owl-theme">
                                    <?php foreach($v['content'] As $sub)
                                        {?>
                                            <div class="item" style="padding:15px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                  
                                                </div>
                                            </div>
                                             
         
                                    <?php }?>
                                </div>
                                
                            </div>
                             
                                        <?php }?>
                                        
                                        
                                        
                                        
                                        <!--3X3-->
                                        
                                          <?php if($v['web_layout_type']==2){
                                             if(count($v['content'])<16){
                                          foreach($v['content'] As $sub){?>
                                           <div class="col-md-4" style="padding:50px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;">
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   
                                                </div>
                                            </div>
                                          
                                        <?php }}else{?>
                                           
                                                 <?php for($i=0;$i<9;$i++){?>
                                                  <div class="col-md-4">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;" >
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?}?>
                 
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }?>
                                        </div>
                     </div>
                       
                                       
                                        
                                        <?php }}?>
                                        
                                        
                                        <!--4 X 4-->
                                        
                                        <?php if($v['web_layout_type']==3){
                                        
                                         if(count($v['content'])<16){
                                          foreach($v['content'] As $sub){?>
                                          
                                          <div class="col-md-3" style="padding:50px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                   <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                 
                                                </div>
                                            </div>
                                         <?php }}else{?>
                                         
                                         <?php for($i=0;$i<16;$i++){?>
                                                  <div class="col-md-3">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }?>
                                         
                                         <?php }?>
                                        
                                           
                                                 
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                        
                                        <!--6X6-->
                                        
                                         <?php if($v['web_layout_type']==4){
                                        
                                           
                                                
                                                 if(count($v['content'])<36){
                                                 
                                                 foreach($v['content'] As $sub){?>
                                                   <div class="col-md-2" style="padding:55px;">
                                                       <div class="container-fluid">
                                                           <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                  
                                                </div>
                                                       </div>
                                                
                                            </div>
                                                 <?php } }else { for($i=0;$i<36;$i++){?>
                                                  <div class="col-md-2">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;height"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                  
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                           
                                        <!--7columns single strip static-->
                                        
                                         <?php if($v['web_layout_type']==5){
                                        
                                           
                                                
                                                 if(count($v['content'])<7){
                                                 
                                                 foreach($v['content'] As $sub){?>
                                                   <div class="col" style="padding:10px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                   <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                  
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<7;$i++){?>
                                                  <div class="col" style="padding:10px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:135px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                 
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                        <!--4X2-->
                                        
                                         <?php if($v['web_layout_type']==6){
                                        
                                           
                                                
                                                 if(count($v['content'])<8){
                                                 
                                                 foreach($v['content'] As $sub){?>
                                                   <div class="col-md-3">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color: white;font-weight: 500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;height:180px;"><br/>
                                                    <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" ><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                  
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<8;$i++){?>
                                                  <div class="col-md-3">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?}?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:343px;height:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?}?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="https://gruzen.in/GrobizEcomm/images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:343px;height:280px;"><br/>
                                                     <div style="margin-top:-49px;background-color: grey;opacity: 0.45;color: white;width:135px;"><center><a href="{{url('ecommerce_admin_products')}}" style="color:white;font-weight:500;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</a></center></div>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?}?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                       
                   
 
 <?php }?>
 
 <?php } ?> 
<!--Forach end-->
                     </div> <!--container-fluid-->
                    
           </div>   
                    
 
  
</div>
    <!-- Edit Catgeory Modal -->
<div class="modal fade" id="category_image_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
     {!! Form::open(['method' => 'POST', 'url' => 'add_main_category', 'enctype' => 'multipart/form-data']) !!}
                                        @csrf 
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Add Main Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><div aria-hidden="true">&times;</div></button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><div aria-hidden="true">&times;</div></button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><div aria-hidden="true">&times;</div></button>
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


@endsection