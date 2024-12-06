@extends('templates.frontend.header')
@section('content')
  
                              
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
                        
                    <div class="sliding_banner col-md-12">
                    <div class="slider" style="padding-right:13px;">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                              
                                 <img src="../../images/slider/<?php echo $v['first_img'];?>" class="d-block w-100" alt="..." style="height:400px;">
                               
                              </div>
                               
                                <?php foreach($v['slider_images'] As $s) {?>
                              <div class="carousel-item">
                                 <img src="../../images/slider/<?php echo $s['component_image'];?>" class="d-block w-100" alt="..." style="height:400px;">
                              </div>
                              <?php }?>
                              <!--<div class="carousel-item">-->
                              <!--   <img src="../../images/slider/slider3.webp" class="d-block w-100" alt="...">-->
                              <!--</div>-->
                              <!--<div class="carousel-item">-->
                              <!--   <img src="../../images/slider/slider4.webp" class="d-block w-100" alt="...">-->
                              <!--</div>-->
                             </div>
                             </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                      </div>
                  
                    <?php }else{?>
                   <h6>No Slider</h6>
                            
                    <?php }} ?>
                    </div> 
                     <?php if($v['component_type']=="Brand"){?>
                      
                       <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                 <h6><?php echo $v['title']?></h6>
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
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
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
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
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
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
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
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;" ></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
 <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                                                </div>
                                            </div>
                                          
                                        <?php }}else{?>
                                           
                                                 <?php for($i=0;$i<9;$i++){?>
                                                  <div class="col-md-4">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;" ></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></center></a>
                   <?php }?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }?>
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
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}">   <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                   <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                                                </div>
                                            </div>
                                         <?php }}else{?>
                                         
                                         <?php for($i=0;$i<16;$i++){?>
                                                  <div class="col-md-3">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                      <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}">  <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
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
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                  <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                                                </div>
                                                       </div>
                                                
                                            </div>
                                                 <?php } }else { for($i=0;$i<36;$i++){?>
                                                  <div class="col-md-2" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
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
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                      <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                 <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                   <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<7;$i++){?>
                                                  <div class="col" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                 <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
 <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
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
                                                   <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}">  <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}">  <img id="category_img" src="../../images/brands/<?php echo $sub['brand_image_app']; ?>" style="height:150px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<8;$i++){?>
                                                  <div class="col-md-3" style="padding:35px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"></a></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}">  <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
 <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="width:343px;height:280px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                 <a href="{{url(Session('main').'/product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="../../images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="width:343px;height:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                   <?php }?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                       
                   
 
 <?php }?>
 
                     <?php if($v['component_type']=="Banner"){?>
                     <div class="row">
                           <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                 <h6><?php echo $v['title']?></h6>
                            </div>
                           
                        </div>
                  <div class="col-md-12">
                      <div class="container-fluid">
                           <?php foreach($v['content'] As $b){?>
                      <img src="../../images/slider/<?php echo $b['component_image'];?>" style="width:100%;height:500px;" class="img-responsive"> 
                      <?php }?>
                   
                      </div>
                     
                      </div>
                  </div> 
                         
                    <?php } ?>
                    
                     <?php if($v['component_type']=="SubCategories"){?>
                      
                       <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <br/>
                                 <h6><?php echo $v['title']?></h6>
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
                                                    <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"> <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"> <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;"></a><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"> <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
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
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"> <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;"></a><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"> <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
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
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"> <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;"></a><br/>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"> <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br/>
                                                    <center><p id="category_name"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
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
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?></a>" style="border-radius:50%;width:280px;" >
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                      <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                                                </div>
                                            </div>
                                          
                                        <?php }}else{?>
                                           
                                                 <?php for($i=0;$i<9;$i++){?>
                                                  <div class="col-md-4">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;" ></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;" ></a><br/>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <center><p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p></center>
                   <?php }?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }?>
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
                                                      <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                      <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                   <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                                                </div>
                                            </div>
                                         <?php }}else{?>
                                         
                                         <?php for($i=0;$i<16;$i++){?>
                                                  <div class="col-md-3">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;" ></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;" ></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
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
                                                      <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                      <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                                                </div>
                                                       </div>
                                                
                                            </div>
                                                 <?php } }else { for($i=0;$i<36;$i++){?>
                                                  <div class="col-md-2">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;" ></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;" ></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
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
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:170px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:170px;"></a><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:170px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:170px;"></a><br/>
                                                   <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<7;$i++){?>
                                                  <div class="col" style="padding:10px;">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:170px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:170px;"></a><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:170px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:170px;"></a><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
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
                                                      <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                      <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                     <a href="{{url(Session('main').'/product-lists',$sub['subcategory_auto_id'])}}"><img id="category_img" src="../../images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:280px;"></a><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                                                </div>
                                            </div>
                                                 <?php } }else { for($i=0;$i<8;$i++){?>
                                                  <div class="col-md-3">
                                                <div class="banner2">
                       <?php if($v['web_icon_type']=="0")
                           {?>
                                                    <img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;">
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <?php }?>
                     <?php if($v['web_icon_type']=="1")
                           {?>
                                                    <img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                   <?php if($v['web_icon_type']=="2")
                           {?>
                                                    <img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:343px;height:280px;"><br/>
                                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                   <?php }?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                                                    <img id="category_img" src="../../images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:343px;height:280px;"><br/>
                                                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                   <?php }?>
                                                </div>
                                            </div>
                                        
                                         
                                       
                                      
                                        
                                        
                                        <?php }}?>
                                        </div>
                                        </div>
                                        
                                        <?php }?>
                                        
                                                      <!--1*4-->
                                        
                                         <?php if($v['web_layout_type']==7){?>
                                        
            <div class="container-fluid" style="padding-right: 35px;padding-left: 35px;">
            <div class="row">
         		  <?php if(count($v['first_subcat'])<2){
                           foreach($v['first_subcat'] As $fsub){?>
                          
                <div class="col-lg-6 col-md-6 col-xs-12" style="padding:0px;">		
                <div class="col-lg-12 col-md-12 col-xs-12 thumb" style="padding:4px;">
                     <?php if($v['web_icon_type']=="4")
                           {?>
                    <a class="thumbnail" href="{{url(Session('main').'/product-lists',$fsub['_id'])}}" data-lightbox="imgGLR" >
                                <h3 style="position: absolute;top: 15px;left: 30%;color:black;"><?php echo $fsub['sub_category_name']; ?></h3>
                
                                    <img id="category_img" class="img-responsive" src="./images/subcategories/<?php echo $fsub['subcategory_image_app']; ?>" border="0" style="height: 440px;width: 100%;">
                        </a>
                          <?php }?>
                        </div>
                </div>
                 <?php } }?>
                <div class="col-lg-6 col-md-6 col-xs-12">
   
                     <div class="row">
                        <?php if(count($v['content'])<4){
                           foreach($v['content'] As $sub){?>
                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">
                             <?php if($v['web_icon_type']=="4")
                           {?>
                            <a class="thumbnail" href="product-lists/$sub['subcategory_auto_id']" data-lightbox="imgGLR" >
                                <img id="category_img" class="img-responsive" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height: 190px;width: 100%;" border="0">
                    
                                <center><p style="margin-bottom:0px;color:black;"><?php echo $sub['sub_category_name']; ?></p></center>
                                
                                </a>
                                 <?php }?>
                                </div>
                                 <?php } }else { for($i=0;$i<4;$i++){?>
                    		
                    
                      <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">
                           <?php if($v['web_icon_type']=="4")
                           {?>
                          <a class="thumbnail" href="product-lists/<?php echo $v['content'][$i]['subcategory_auto_id']; ?>" data-lightbox="imgGLR">
                            <img id="category_img" class="img-responsive" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="height: 190px;width: 100%;" border="0">
                    
                              <center><p style="margin-bottom:0px;color:black;"><?php echo $v['content'][$i]['sub_category_name']; ?></p></center>
                              </a>
                              <?php }?>
                              </div>
                    		  <?php }}?>
                    </div>
                    </div>
			

	</div>	
</div>
    <?php }?>
                                          <!--4*1-->
                                        
                                         <?php if($v['web_layout_type']==8){?>
                                        
            <div class="container-fluid" style="padding-right: 35px;padding-left: 35px;">
            <div class="row">
               
                <div class="col-lg-6 col-md-6 col-xs-12">
   
                     <div class="row">
                        <?php if(count($v['content'])<4){
                           foreach($v['content'] As $sub){?>
                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">
                             <?php if($v['web_icon_type']=="4")
                           {?>
                            <a href="product-lists/$sub['subcategory_auto_id']" class="thumbnail" data-lightbox="imgGLR" >
                                <img id="category_img" class="img-responsive" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height: 190px;width: 100%;" border="0">
                    
                                <center><p style="margin-bottom:0px;color:black;"><?php echo $sub['sub_category_name']; ?></p></center>
                                
                                </a>
                                 <?php }?>
                                </div>
                                 <?php } }else { for($i=0;$i<4;$i++){?>
                    		
                    
                      <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">
                           <?php if($v['web_icon_type']=="4")
                           {?>
                          <a href="product-lists/<?php echo $v['content'][$i]['subcategory_auto_id']; ?>" class="thumbnail" data-lightbox="imgGLR">
                            <img id="category_img" class="img-responsive" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="height: 190px;width: 100%;" border="0">
                    
                              <center><p style="margin-bottom:0px;color:black;"><?php echo $v['content'][$i]['sub_category_name']; ?></p></center>
                              </a>
                              <?php }?>
                              </div>
                    		  <?php }}?>
                    </div>
                    </div>
			  <?php if(count($v['first_subcat'])<2){
                           foreach($v['first_subcat'] As $fsub){?>
                          
                <div class="col-lg-6 col-md-6 col-xs-12" style="padding:0px;">		
                <div class="col-lg-12 col-md-12 col-xs-12 thumb" style="padding:4px;">
                     <?php if($v['web_icon_type']=="4")
                           {?>
                    <a class="thumbnail" href="{{url(Session('main').'/product-lists',$fsub['_id'])}}" data-lightbox="imgGLR" >
                                <h3 style="position: absolute;top: 15px;left: 30%;color:black;"><?php echo $fsub['sub_category_name']; ?></h3>
                
                                    <img id="category_img" class="img-responsive" src="./images/subcategories/<?php echo $fsub['subcategory_image_app']; ?>" border="0" style="height: 440px;width: 100%;">
                        </a>
                          <?php }?>
                        </div>
                </div>
                 <?php } }?>

	</div>	
</div>

                                        
                                        
                                        
                                        <?php }?>                           
                   
 
 <?php }?>
 
 <?php } ?> 
<!--Forach end-->
                     </div> <!--container-fluid-->
                    
              
          @endsection          
  