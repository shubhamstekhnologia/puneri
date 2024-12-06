<style>
.dropbtn {
    /* background-color: #d33b33; */
    color: #010101;
    padding: 15px;
    font-size: 10px;
    border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color:white;color:black;}
.hmtrnditemPro {
    position: relative;
}
.hmtrnditemNm span {
    font-size: 14px;
    margin: 0 3px;
    color: #d3b951;
    font-weight: 600;
}
.proDiscount {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 10px;
    background: #000;
    font-weight: 600;
    padding: 10px;
    color: #fff;
    text-transform: uppercase;
    border-radius: 50%;
    font-family: 'Lato',sans-serif;
    height: 45px;
    width: 45px;
    text-align: center;
    box-sizing: border-box;
}
.homeBox1 {
    float: left;
    /*width:34.333%;*/
    padding: 0px 15px;
    box-sizing: border-box;
}

.img-fluid{
        max-width: 114%;
}
.banner2 {
 
    /* float: left; */
    width: 100%;
    margin: 14px;

}
 .carousel-wrap {
    width: 1225px;
    margin: auto;
    position: relative;
  }
  .owl-carousel .owl-nav{
    overflow: hidden;
    height: 0px;
  }

  .owl-theme .owl-dots .owl-dot.active span, 
  .owl-theme .owl-dots .owl-dot:hover span {
      background: #2caae1;
  }


  .owl-carousel .item {
      text-align: center;
  }
  .owl-carousel .nav-btn{
      height: 47px;
      position: absolute;
      width: 26px;
      cursor: pointer;
      top: 100px !important;
  }

  .owl-carousel .owl-prev.disabled,
  .owl-carousel .owl-next.disabled{
    pointer-events: none;
    opacity: 0.2;
  }

  .owl-carousel .prev-slide{
      background: url('images/img/nav-icon.png') no-repeat scroll 0 0;
      left: -33px;
  }
  .owl-carousel .next-slide{
      background: url('images/img/nav-icon.png') no-repeat scroll -24px 0px;
      right: -33px;
  }
  .owl-carousel .prev-slide:hover{
     background-position: 0px -53px;
  }
  .owl-carousel .next-slide:hover{
    background-position: -24px -53px;
  }

  span.img-text {
    text-decoration: none;
    outline: none;
    transition: all 0.4s ease;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    cursor: pointer;
    width: 100%;
    font-size: 23px;
    display: block;
    text-transform: capitalize;
  }
  span.img-text:hover {
    color: #2caae1;
  }
</style>
@extends('templates.frontend.layout_header')
@section('content')

 <br/>
                      <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_three" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
                 <div class="sliding_banner row">
                  <div class="col-md-12">
                    <div class="slider" style="padding-right:13px;">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="{{url('images/img/slider1.webp')}}" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                 <img src="{{url('images/img/slider2.webp')}}" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="{{url('images/img/slider3.webp')}}" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                 <img src="{{url('images/img/slider4.webp')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                 <img src="{{url('images/img/slider5.webp')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                 <img src="{{url('images/img/slider6.webp')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                  <img src="{{url('images/img/slider7.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                 <img src="{{url('images/img/slider8.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                  <img src="{{url('images/img/slider9.webp')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                 <img src="{{url('images/img/slider10.webp')}}" class="d-block w-100" alt="...">
                            </div>
                           
                               <!-- <div class="carousel-item">
                                <img src="" class="d-block w-100" alt="...">
                            </div> -->
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
                  </div>
                 
              </div>
   <br/> 
      <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_four" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
    <div class="row static_banner">
        
                  <div class="col-md-6">
                    <div class="slider" style="padding-right:13px;">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="{{url('images/img/1647838474IKea.jpg')}}" class="d-block w-100" alt="..." style="height:450px;">
                              </div>
                              <div class="carousel-item">
                                  <img src="{{url('images/img/1647838437Yato (1).jpg')}}" class="d-block w-100" alt="..." style="height:450px;">
                              </div>
                              <div class="carousel-item">
                                 <img src="{{url('images/img/1647838416BOSCH03.jpg')}}" class="d-block w-100" alt="..." style="height:450px;">
                              </div>
                              <div class="carousel-item">
                                <img src="{{url('images/img/1647838416BOSCH03.jpg')}}" class="d-block w-100" alt="..." style="height:450px;">
                            </div>
                            <div class="carousel-item">
                                 <img src="{{url('images/img/1647838355Fulcrum.jpg')}}" class="d-block w-100" alt="..." style="height:450px;">
                            </div>
                            <div class="carousel-item">
                                 <img src="{{url('images/img/1647838308Desktop_sitewide-discount_523x334-2.png')}}" class="d-block w-100" alt="..." style="height:450px;">
                            </div>
                            <div class="carousel-item">
                                  <img src="{{url('images/img/1647838374Power House02 (2).jpg')}}" class="d-block w-100" alt="..." style="height:450px;">
                            </div>
                            <div class="carousel-item">
                                 <img src="{{url('images/img/1647838509ASIAN PAINT2.1.jpg')}}" class="d-block w-100" alt="..." style="height:450px;">
                            </div>
                           
                           
                               <!-- <div class="carousel-item">
                                <img src="" class="d-block w-100" alt="...">
                            </div> -->
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
                  </div>
                 <div class="col-md-6">
                     <div class="row">
                         <div class="col-md-12">
                             <img src="https://static3.industrybuying.com/homepage/1643976502Desktop_PayLater-Banner-449x199%20(1).png" style="    width: 100%;
    margin-left: -27px;
    margin-top: 3px;"/>
                         </div>
                     </div>
                      <div class="row">
                            <div class="col-md-6" style="padding:44px;">
                             <img src="{{url('images/img/1551767207right-small-reseller2.webp')}}" class="d-block w-100" alt="..." style="margin-left:-56px;margin-top:-36px;">

                         </div>
                         <div class="col-md-6" style="margin-left: -80px;margin-top: 11px;">
                            <div class="subscribe" id="AH_newsLetterView" data-val="Subscribe Widget" style="display:block;">
                                    <center><img  class="envelopIcon" src="{{url('images/img/mobile.png')}}"></center>
                                    <span class="text" style="font-size:15px;">Enter your phone number to <span class="get-off">Get Upto 5% Off</span> </span>
                                    <form class="subEmail AH_SubscriberForm AH_newsLetterForm">
                                        <input type="hidden" name="csrfmiddlewaretoken" value="ASCuURnn6Fmy3qoX72lKHsWePtipCuKITG5mixAgokNpzfeZCiKqpF03zU3hbu8L" style="width:84%;">
                                        <input type="text" class="AH_EmailInput AH_phone_no" maxlength="10" placeholder="Enter your phone">
                                        <button class="btn btn-danger btn-md" type="submit">GO</button>
                                    </form>
                                    <label class="hide subscriberAjaxResult AH_sub_result error-mssg"></label>
                                </div>
                         </div>
                        
                     </div>
                 </div>
              </div>
                 <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_five" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
    <div class="row threecols_static">
        
            <div class="col-md-4">
                 <div class="homeBox1" data-var-pos="2" data-ho-pos="0">
         <a href="#"> 
         <img src="{{url('images/img/row4img1.webp')}}" style="width:383%;"> 
         </a>
         </div>  
            </div>
            <div class="col-md-4">
                 <div class="homeBox1 clevertapImg" data-var-pos="2" data-ho-pos="0">
         <a href="#"> 
         <img src="{{url('images/img/row4img2.webp')}}" style="width:383%;"> 
         </a>
         </div> 
         </div>
           <div class="col-md-4">
                 <div class="homeBox1 clevertapImg" data-var-pos="2" data-ho-pos="0">
         <a href="#"> 
         <img src="{{url('images/img/row4img3.webp')}}" style="width:383%;"> 
         </a>
         </div>  
            </div>
    
        </div>
       <br/>
          <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_six" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
          <div class="row fixed_ad_banner">
       
            <div class="col-md-12">
                <div class="banner2">
                    <img src="{{url('images/img/1646893911Schneider.jpg')}}" style="width:100%;"> 
                </div>
              
           </div>
       </div>
          <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_seven" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
       <div class="row fixed_product_img_banner">
           <div class="col-md-12">
               <center><h2>OUR FAVORITES THIS SEASON</h2></center>
       
           </div>
            <div class="col-md-12">
                <div class="banner2">
                    <img src="{{url('images/img/row5banner1.webp')}}" style="width: 98%;"> 
                </div>
              
           </div>
       </div>
       <br/>
          <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_eight" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
       <div class="row single_row_product" style="padding-left: 0px;padding-right: 29px;">
           <div class="col-md-12">
               
               <h4 style="margin-left:30px;">POWER BRAND</h4>
       <br/>
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>
                      <button class="btn btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
              
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/MAT.TEL.85447832_1640086918741.jpg')}}" style="height: 175px;"><br/>
                          <p>Corvids 20.5Feet 16 Steps Aluminium Portable</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>
                      <button class="btn btn-danger">Buy Now</button>
                    </div>
                 
                   
                </div>
              
           </div> 
          <div class="col-md-2">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/SOL.SOL.95494463_1641451407181.jpeg')}}" style="height: 175px;"><br/>
                          <p>Bluebird Solar 335 Watt Polycrystalline Solar Panel</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>
                      <button class="btn btn-danger">Buy Now</button>
                    </div>
                  
                </div>
              
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/IND.PUS.75381372_1638423367945.jpg')}}" style="height: 175px;"><br/>
                          <p>Schneider XB4BA42 22mm Spring Return Red Push</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>
                      <button class="btn btn-danger">Buy Now</button>
                    </div>
                  
                   
                </div>
              
           </div>
          <div class="col-md-2">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/MAT.STO.105037755_1633433896656.jpg')}}" style="height: 175px;"><br/>
                          <p>Aristo BIN-45 Polyethylene FPO Storage Bin</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>
                      <button class="btn btn-danger">Buy Now</button>
                    </div>
                 
                </div>
              
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/MAT.PAL.35281665_1646997445245.jpg')}}" style="height: 175px;"><br/>
                          <p>Stanley 2500kg Alloy Steel Yellow Hand Pallet Truck,</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>
                      <button class="btn btn-danger">Buy Now</button>
                    </div>
                   
                      
                   </div>
                   
                   
                </div>
           <!--    <div class="col-md-2">-->
           <!--     <div class="banner2">-->
           <!--         <div class="row" style="padding: 25px;">-->
           <!--              <img src="{{url('images/img/CLE.WAS.94905925_1632390894137.jpg')}}" style="height: 175px;"><br/>-->
           <!--               <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>-->
           <!--           <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>-->
           <!--           <button class="btn btn-danger">Buy Now</button>-->
           <!--           </div>-->
                      
                   
           <!--     </div>-->
              
           <!--</div>-->
           <!-- <div class="col-md-2">-->
           <!--     <div class="banner2">-->
           <!--         <div class="row" style="padding: 25px;">-->
           <!--              <img src="{{url('images/img/OFF.OFF.25601812_1643953277817.jpg')}}" style="height: 175px;"><br/>-->
           <!--               <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>-->
           <!--           <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>-->
           <!--           <button class="btn btn-danger">Buy Now</button>-->
           <!--           </div>-->
                      
                   
           <!--     </div>-->
              
           <!--</div>-->
           <!-- <div class="col-md-2">-->
           <!--     <div class="banner2">-->
           <!--         <div class="row" style="padding: 25px;">-->
           <!--              <img src="{{url('images/img/HAN.TRI.24761866_1630757269680.jpg')}}" style="height: 175px;"><br/>-->
           <!--               <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>-->
           <!--           <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>-->
           <!--           <button class="btn btn-danger">Buy Now</button>-->
           <!--           </div>-->
                      
                   
           <!--     </div>-->
              
           <!--</div>-->
           <!-- <div class="col-md-2">-->
           <!--     <div class="banner2">-->
           <!--         <div class="row" style="padding: 25px;">-->
           <!--              <img src="{{url('images/img/PUM.SUB.75372463_1638178995529.jpg')}}" style="height: 175px;"><br/>-->
           <!--               <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>-->
           <!--           <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>-->
           <!--           <button class="btn btn-danger">Buy Now</button>-->
           <!--           </div>-->
                      
                   
           <!--     </div>-->
              
           <!--</div>-->
           <!-- <div class="col-md-2">-->
           <!--     <div class="banner2">-->
           <!--         <div class="row" style="padding: 25px;">-->
           <!--              <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>-->
           <!--               <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>-->
           <!--           <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>-->
           <!--           <button class="btn btn-danger">Buy Now</button>-->
           <!--           </div>-->
                      
                   
           <!--     </div>-->
              
           <!--</div>-->
           <!-- <div class="col-md-2">-->
           <!--     <div class="banner2">-->
           <!--         <div class="row" style="padding: 25px;">-->
           <!--              <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>-->
           <!--               <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>-->
           <!--           <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>-->
           <!--           <button class="btn btn-danger">Buy Now</button>-->
           <!--           </div>-->
                      
                   
           <!--     </div>-->
              
           <!--</div>-->
           </div>
           <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_nine" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
           <div class="row ad_banner_two_static">
               <div class="col-md-12">
                <div class="banner2">
                    <img src="{{url('images/img/1647085976Downloads.png')}}" style="width: 98%;"> 
                </div>
              
           </div>
           </div>
             <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_ten" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
        <div class="row section_content sliding_product_catalog" >

                  
                  <div class="col-md-12">
                      <div class="carousel-wrap">
    <div class="owl-carousel owl-theme">
        <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/1.jpg')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;height:auto;"> <span class="proDiscount"> 30%<br>OFF </span></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
          <!--<span class="img-text">nightlife</span>-->
          <div class="hmtrnditemNm"><p>Hot Pink Smocked Strappy Crop...</p><span><i class="fa fa-rupee"></i> 840</span> <span class="hmtrnditemNm" style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i> 1200</span></div>
        </div>
        <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/2.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;height:auto;"></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
         <div class="hmtrnditemNm"><p>Blush Fit and Flare Stretch P...</p><span><i class="fa fa-rupee"></i> 1400</span></div>
        </div>
      
        <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/3.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;height:auto;"></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
         <div class="hmtrnditemNm"><p>Pink Floral Belted Kurta with...</p><span><i class="fa fa-rupee"></i> 3400</span></div>
        </div>
        <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/4.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;height:auto;"> <span class="proDiscount"> 30%<br>OFF </span></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
         <div class="hmtrnditemNm"><p>Blue Floral Flared Palazzo Pa...</p><span><i class="fa fa-rupee"></i>1680</span> <span class="hmtrnditemNm" style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>2400</span></div>
        </div>
        
         <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/6.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Teal Mirror Striped Crop Top " style="opacity: 1;height:auto;"> <span class="proDiscount"> 50%<br>OFF </span></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
            <div class="hmtrnditemNm"><p>Teal Mirror Striped Crop Top</p><span><i class="fa fa-rupee"></i>800</span> <span class="hmtrnditemNm" style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>1600</span></div>
        </div>
        <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/7.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;"></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
         <div class="hmtrnditemNm"><p>Grey Floral Printed High Slit...</p><span><i class="fa fa-rupee"></i> 2400</span></div>
        </div>
          <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/8.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;"> <span class="proDiscount"> 50%<br>OFF </span></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
         <div class="hmtrnditemNm"><p>Lavender Embroidered Foil Hig...</p><span><i class="fa fa-rupee"></i> 1450</span> <span class="hmtrndcutprz"><i class="fal fa-rupee-sign"></i> 2900</span></div>
        </div>
          <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/9.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;"></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
          <div class="hmtrnditemNm"><p>Navy Foil Bishop Sleeve Short...</p><span><i class="fa fa-rupee"></i> 1800</span></div>
        </div>
          <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/10.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;"></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
          <div class="hmtrnditemNm"><p>EARTHEN Yellow Floral Smocked...</p><span><i class="fa fa-rupee"></i> 2450</span></div>
        </div>
           <div class="item">
            <div class="hmtrnditemPro"><img class="owl-lazy" src="{{url('images/img/11.webp')}}" data-src="https://img.faballey.com/images/product/ITP01050Z/1.jpg?v=1" alt="Hot Pink Smocked Strappy Crop Top " style="opacity: 1;"></div>
          <!--<img src="https://picsum.photos/640/480?pic=1" />-->
         <div class="hmtrnditemNm"><p>Green Foil Double Dupatta Bel...</p><span><i class="fa fa-rupee"></i> 3400</span></div>
        </div>
         
        
    </div>
  </div>
                  </div>
            </div>
            <br/>
            <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_eleven" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
             <div class="row sliding_produt_two_rows">
            <div class="col-md-12">
                   <div class="carousel-wrap">
    <div class="owl-carousel owl-theme">
        <div class="item">
             
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                     
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
              
        </div>
        <div class="item">
             
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
              
        </div>
        <div class="item">
             
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
              
        </div>
         <div class="item">
             
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                     
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
              
        </div>
        <div class="item">
             
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                     
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
               
        </div>
        <div class="item">
             
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                     &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                    
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
               
        </div>
        <div class="item">
             
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                     
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i><br/>
                       &nbsp;&nbsp;
                        <a class="btn btn-sm btn-danger" style="color:white;">Buy Now</a>
                      </div>
                      
               
        </div>
    </div>
  </div>
                  </div>
       </div>
       <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_twelve" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
              <div class="row product_cat" style="padding-left: 0px;padding-right: 29px;">
           <div class="col-md-12">
               <center><h2>CATEGORIES TO BAG</h2></center>
       
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <img src="{{url('images/img/row7img1.webp')}}" style="width:100%;">
                    <img src="{{url('images/img/row7img7.webp')}}" style="width:100%;">
                </div>
              
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <img src="{{url('images/img/row7img2.webp')}}" style="width:100%;"> 
                     <img src="{{url('images/img/row7img8.webp')}}" style="width:100%;">
                </div>
              
           </div> <div class="col-md-2">
                <div class="banner2">
                    <img src="{{url('images/img/row7img3.webp')}}" style="width:100%;"> 
                     <img src="{{url('images/img/row7img9.webp')}}" style="width:100%;">
                </div>
              
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <img src="{{url('images/img/row7img4.webp')}}" style="width:100%;"> 
                     <img src="{{url('images/img/row7img10.webp')}}" style="width:100%;">
                </div>
              
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <img src="{{url('images/img/row7img5.webp')}}" style="width:100%;"> 
                     <img src="{{url('images/img/row7img11.webp')}}" style="width:100%;">
                </div>
              
           </div>
            <div class="col-md-2">
                <div class="banner2">
                    <img src="{{url('images/img/row7img6.webp')}}" style="width:100%;"> 
                     <img src="{{url('images/img/row7img12.webp')}}" style="width:100%;">
                </div>
              
           </div>
       </div>
       <br/><br/>
         <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_thirteen" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
        <div class="row product_cat_two_rows" style="padding-left: 0px;padding-right: 29px;">
            <div class="col-md-12">
               
               <h4 style="margin-left:30px;">BEST SELLERS</h4>
       <br/>
           </div>
             <div class="col-md-12">
                 <div class="row" style="padding:16px;">
              <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                  <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                  <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                  <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                  <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                </div>
                </div>
         <div class="col-md-12">
                 <div class="row" style="padding:16px;">
              <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                  <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                   <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                  <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                 <div class="col">
                <div class="banner2">
                    <div class="row" style="padding: 25px;">
                         <img src="{{url('images/img/OFF.OFF.65403871_1646997455842.jpg')}}" style="height: 175px;"><br/>
                          <p>Regent Boom Net & Metal Black Chair with Modle Handle</p>
                      <span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>
                      &nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>
                      </div>
                      
                   
                </div>
                </div>
                </div>
                </div>
        </div>
        <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_fourteen" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
    <div class="row section_content one_row_static_product_catalog"  style="margin-left: 9px;">


<div class="col-md-12">
     <hr/>
    <div class="row">
        <div class="col-md-12">
           
    <center><h2>HAND TOOLS</h2></center>
  
 <!--<a  style="margin-top:-50px;" class="btn btn-sm btn-danger pull-right" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a>-->
        </div>
      
    </div>
    

              

   <hr/>

</div>
   <div class="col-md-12">
                 <div class="row" style="padding: 35px;margin-left:-39px;">
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/1617427859Torque-Wrench.webp')}}"><br/>
                          <p>Torque Wrenches</p>
                           <span style="color:#d3b951;">Upto 23% Off</span>
                      <!--<span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>-->
                      <!--&nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>-->
            </div>
            <div class="col" style="padding:25px;">
               <img src="{{url('images/img/1617427762Tool-Trolley-and-Cabinets.webp')}}"><br/>
                          <p>Tool Trolley and Cabinets</p>
                           <span style="color:#d3b951;">Upto 40% Off</span>
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/1617427811Tool-Boxes.png')}}"><br/>
                          <p>Tool Boxes List</p>
                           <span style="color:#d3b951;">Upto 30% Off</span>
            </div>
            <div class="col" style="padding:25px;">
                 <img src="{{url('images/img/1617427903Bench-Vices.webp')}}"><br/>
                          <p>Bench Vices List</p>
                           <span style="color:#d3b951;">Upto 30% Off</span>
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/1617428081Socket-Sets.webp')}}"><br/>
                          <p>Pipe Bending Machine</p>
                           <span style="color:#d3b951;">Upto 30% Off</span>
            </div>
            <div class="col" style="padding:25px;">
                 <img src="{{url('images/img/1617427712Pipe-Bending-Machine.webp')}}"><br/>
                          <p>Pipe Bending Machine</p>
                           <span style="color:#d3b951;">Upto 30% Off</span>
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/1617427713Hand-Operated-Machines.webp')}}"><br/>
                          <p>Hand Operated Machines</p>
                           <span style="color:#d3b951;">Upto 40% Off</span>
            </div>
                </div>
       </div>
<!--  <div class="col-md-12">-->
<!--     <hr/>-->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
           
<!--    <center><h2>HAND TOOLS</h2></center>-->
  
 <!--<a  style="margin-top:-50px;" class="btn btn-sm btn-danger pull-right" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a>-->
<!--        </div>-->
      
<!--    </div>-->
    

              

<!--   <hr/>-->

<!--</div>-->
<!--   <div class="col-md-12">-->
<!--                 <div class="row" style="padding: 35px;margin-left:-39px;">-->
<!--            <div class="col" style="padding:25px;">-->
<!--                <img src="{{url('images/img/1617427859Torque-Wrench.webp')}}"><br/>-->
<!--                          <p>Torque Wrenches</p>-->
<!--                           <span style="color:#d3b951;">Upto 23% Off</span>-->
                      <!--<span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>-->
                      <!--&nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>-->
<!--            </div>-->
<!--            <div class="col" style="padding:25px;">-->
<!--               <img src="{{url('images/img/1617427762Tool-Trolley-and-Cabinets.webp')}}"><br/>-->
<!--                          <p>Tool Trolley and Cabinets</p>-->
<!--                           <span style="color:#d3b951;">Upto 40% Off</span>-->
<!--            </div>-->
<!--            <div class="col" style="padding:25px;">-->
<!--                <img src="{{url('images/img/1617427811Tool-Boxes.png')}}"><br/>-->
<!--                          <p>Tool Boxes List</p>-->
<!--                           <span style="color:#d3b951;">Upto 30% Off</span>-->
<!--            </div>-->
<!--            <div class="col" style="padding:25px;">-->
<!--                 <img src="{{url('images/img/1617427903Bench-Vices.webp')}}"><br/>-->
<!--                          <p>Bench Vices List</p>-->
<!--                           <span style="color:#d3b951;">Upto 30% Off</span>-->
<!--            </div>-->
<!--            <div class="col" style="padding:25px;">-->
<!--                <img src="{{url('images/img/1617428081Socket-Sets.webp')}}"><br/>-->
<!--                          <p>Pipe Bending Machine</p>-->
<!--                           <span style="color:#d3b951;">Upto 30% Off</span>-->
<!--            </div>-->
<!--            <div class="col" style="padding:25px;">-->
<!--                 <img src="{{url('images/img/1617427712Pipe-Bending-Machine.webp')}}"><br/>-->
<!--                          <p>Pipe Bending Machine</p>-->
<!--                           <span style="color:#d3b951;">Upto 30% Off</span>-->
<!--            </div>-->
<!--            <div class="col" style="padding:25px;">-->
<!--                <img src="{{url('images/img/1617427713Hand-Operated-Machines.webp')}}"><br/>-->
<!--                          <p>Hand Operated Machines</p>-->
<!--                           <span style="color:#d3b951;">Upto 40% Off</span>-->
<!--            </div>-->
<!--                </div>-->
<!--       </div> -->
<!--       <div class="col-md-12">-->
<!--     <hr/>-->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
           
<!--    <center><h2>HAND TOOLS</h2></center>-->
  
 <!--<a  style="margin-top:-50px;" class="btn btn-sm btn-danger pull-right" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a>-->
<!--        </div>-->
      
<!--    </div>-->
    

              

<!--   <hr/>-->

<!--</div>-->
   <!--<div class="col-md-12">-->
   <!--              <div class="row" style="padding: 35px;margin-left:-39px;">-->
   <!--         <div class="col" style="padding:25px;">-->
   <!--             <img src="{{url('images/img/1617427859Torque-Wrench.webp')}}"><br/>-->
   <!--                       <p>Torque Wrenches</p>-->
   <!--                        <span style="color:#d3b951;">Upto 23% Off</span>-->
                      <!--<span style="color:#d3b951;"><i class="fa fa-rupee"></i>500</span>&nbsp;&nbsp;<span style="color:black;text-decoration: line-through;"><i class="fa fa-rupee"></i>840</span>&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>-->
                      <!--&nbsp;&nbsp;<button class="btn btn-sm btn-danger">Buy Now</button>-->
   <!--         </div>-->
   <!--         <div class="col" style="padding:25px;">-->
   <!--            <img src="{{url('images/img/1617427762Tool-Trolley-and-Cabinets.webp')}}"><br/>-->
   <!--                       <p>Tool Trolley and Cabinets</p>-->
   <!--                        <span style="color:#d3b951;">Upto 40% Off</span>-->
   <!--         </div>-->
   <!--         <div class="col" style="padding:25px;">-->
   <!--             <img src="{{url('images/img/1617427811Tool-Boxes.png')}}"><br/>-->
   <!--                       <p>Tool Boxes List</p>-->
   <!--                        <span style="color:#d3b951;">Upto 30% Off</span>-->
   <!--         </div>-->
   <!--         <div class="col" style="padding:25px;">-->
   <!--              <img src="{{url('images/img/1617427903Bench-Vices.webp')}}"><br/>-->
   <!--                       <p>Bench Vices List</p>-->
   <!--                        <span style="color:#d3b951;">Upto 30% Off</span>-->
   <!--         </div>-->
   <!--         <div class="col" style="padding:25px;">-->
   <!--             <img src="{{url('images/img/1617428081Socket-Sets.webp')}}"><br/>-->
   <!--                       <p>Pipe Bending Machine</p>-->
   <!--                        <span style="color:#d3b951;">Upto 30% Off</span>-->
   <!--         </div>-->
   <!--         <div class="col" style="padding:25px;">-->
   <!--              <img src="{{url('images/img/1617427712Pipe-Bending-Machine.webp')}}"><br/>-->
   <!--                       <p>Pipe Bending Machine</p>-->
   <!--                        <span style="color:#d3b951;">Upto 30% Off</span>-->
   <!--         </div>-->
   <!--         <div class="col" style="padding:25px;">-->
   <!--             <img src="{{url('images/img/1617427713Hand-Operated-Machines.webp')}}"><br/>-->
   <!--                       <p>Hand Operated Machines</p>-->
   <!--                        <span style="color:#d3b951;">Upto 40% Off</span>-->
   <!--         </div>-->
   <!--             </div>-->
   <!--    </div>-->
<div class="col-md-12">
    <br/><br/><br/>
    </div>

                 </div>
                
                
              </div>
              <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_fifteen" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
       <div class="row offer_products_images" style="padding-left: 0px;padding-right: 29px;">
            <div class="col-md-12">
               <center><h2>TOP BRANDS ON OFFER</h2></center>
       
           </div>
            <div class="col-md-12">
                 <div class="row" style="padding:16px;">
            <div class="col">
                <img src="{{url('images/img/br1.webp')}}" style="width:119%;">
            </div>
            <div class="col">
                <img src="{{url('images/img/br2.webp')}}" style="width:119%;">
            </div>
            <div class="col">
                <img src="{{url('images/img/br3.webp')}}" style="width:119%;">
            </div>
            <div class="col">
                <img src="{{url('images/img/br4.webp')}}" style="width:119%;">
            </div>
            <div class="col">
                <img src="{{url('images/img/br5.webp')}}" style="width:119%;">
            </div>
            <div class="col">
                <img src="{{url('images/img/br6.webp')}}" style="width:119%;">
            </div>
            <div class="col">
                <img src="{{url('images/img/br7.webp')}}" style="width:119%;">
            </div>
                </div>
       </div>
       </div>
                   <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_sixteen" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
                    <div class="row collection_static" style="padding-right: 29px;padding-left: 16px;">
           <div class="col-md-12">
               <center><h2>EQUISITE COLLECTION</h2></center>
       
           </div>
           <div class="col-md-6">
                <div class="banner2">
                    <img src="{{url('images/img/row8img1.jpg')}}" style="width:100%;">
           </div>
           </div>
            <div class="col-md-3">
                <div class="banner2">
                    <img src="{{url('images/img/row8img2.gif')}}" style="width:100%;">
           </div>
           </div>
            <div class="col-md-3">
                <div class="banner2">
                    <img src="{{url('images/img/row8img3.jpg')}}" style="width:100%;">
           </div>
           </div>
           </div>
           <br/><br/>
             <div class="row">
                         <div class="col-md-2"></div>
                          <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                           <div class="col-md-2"></div>
                          <div class="col-md-2"><label class="switch_seventeen" ><input type="checkbox"><span class="slider_toggle round hide-off"></a></span></label></div>
                      </div>
    <div class="row section_content best_collection_three_rows"  style="margin-left: 9px;">
<!--    <div class="col-md-12">-->
<!--        <center><h2>SHOP BY CATEGORY</h2></center>-->
<!--        <hr/>-->

<!--    </div>-->
<!--    <div class="col-md-12">-->
<!--        <div class="container">-->
         
<!--            <div class="row">-->
<!--                <div class="col">-->
                  
<!--                            <img src="{{url('images/img/topwearcat.webp')}}" style="height:200px;border-radius:25px;" class="img-fluid">-->
                      
<!--                            <center><p><b>Casual Shirts</b></p></center>-->
<!--                </div>-->
<!--                <div class="col">-->
                  
<!--                    <img src="{{url('images/img/indianwearcat.webp')}}" style="height:200px;border-radius:25px;" class="img-fluid">-->
<!--                    <center><p><b>Indian Wear</b></p></center>-->
              
<!--        </div>-->
<!--        <div class="col">-->
                  
<!--            <img src="{{url('images/img/kurtis_suitscat.webp')}}" style="height:200px;border-radius:25px;" class="img-fluid">-->
      
<!--            <center><p><b>Kurtis & Sets</b></p></center>-->
<!--</div>-->
<!--<div class="col">-->
                  
<!--    <img src="{{url('images/img/fusionwearcat.webp')}}" style="height:200px;border-radius:25px;" class="img-fluid">-->

<!--    <center><p><b>Western Wear</b></p></center>-->
<!--</div>-->
<!--<div class="col">-->
                  
<!--    <img src="{{url('images/img/jeans.webp')}}" style="height:200px;border-radius:25px;" class="img-fluid">-->

<!--    <center><p><b>Bottom Wear</b></p></center>-->
<!--</div>-->
<!--<div class="col">-->
                  
   
<!--<center><p> <a  class="btn btn-sm btn-danger" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a></p></center>-->

<!--</div>-->
            
                <!-- break -->
<!--                <div class="col-12 p-2"></div>-->
                <!-- row 2 -->
<!--                <div class="col">-->
                  
<!--                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRixQWTo6AKzT1EfrzAx1kxSyT5IIQj_btfwg&usqp=CAU" style="height:200px;border-radius:25px;" class="img-fluid">-->
<!--                    <center><p>Meat</p></center>-->
              
<!--        </div>-->
<!--        <div class="col">-->
                  
<!--            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAwmQeRS5bErkn_9rpmddx5b0y9HyNkXAOGw&usqp=CAU" style="height:200px;border-radius:25px;" class="img-fluid">-->
<!--            <center><p>Dairy</p></center>-->
      
<!--</div>-->
<!--<div class="col">-->
                  
<!--    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgXFPbkd1J3VqWLYZH1n6LnezSZD6Go4Qz8w&usqp=CAU" style="height:200px;border-radius:25px;" class="img-fluid">-->
<!--    <center><p>Vegetable</p></center>-->

<!--</div>-->
<!--<div class="col">-->
                  
<!--    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTVoKJd4VYuwIzxE5FlqDRCi5YWTGEXlh74w&usqp=CAU" style="height:200px;border-radius:25px;" class="img-fluid">-->

<!--    <center><p>Fruits</p></center>-->
<!--</div>-->
<!--<div class="col">-->
                  
<!--    <img src="https://m.media-amazon.com/images/I/71Qqnhm0LtL._SL1500_.jpg" style="height:200px;border-radius:25px;" class="img-fluid">-->
<!--<center><p>Beauty</p></center>-->

<!--</div>-->
  <!-- break -->
<!--  <div class="col-12 p-2"></div>-->
  
<!--<div class="col"></div>-->
<!--<div class="col"></div>-->
<!--<div class="col"></div>-->
<!--<div class="col"></div>-->
<!--            </div>-->
<!--        </div>-->
   
    
   
<!--</div>    -->

<div class="col-md-12">
     <hr/>
    <div class="row">
        <div class="col-md-12">
           
    <center><h2>BEST OF CLOTHING</h2></center>
  
 <a  style="margin-top:-50px;" class="btn btn-sm btn-danger pull-right" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a>
        </div>
      
    </div>
    

              

   <hr/>

</div>
   <div class="col-md-12">
                 <div class="row" style="padding: 35px;margin-left:-39px;">
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/clothing1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/clothing2.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/clothing4.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/clothing6.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/clothing7.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/br1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/br7.webp')}}" style="width:119%;">
            </div>
                </div>
       </div>
    
<div class="col-md-12">
     <hr/>
    <div class="row">
        <div class="col-md-12">
           
    <center><h2>BEST OF FOOTWEAR</h2></center>
  
 <a  style="margin-top:-50px;" class="btn btn-sm btn-danger pull-right" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a>
        </div>
      
    </div>
    

              

   <hr/>

</div>
   <div class="col-md-12">
                 <div class="row" style="padding:40px;margin-left:-39px;">
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/foot1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/foot2.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/foot3.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/foot4.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/foot2.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/foot1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/foot2.webp')}}" style="width:119%;">
            </div>
                </div>
       </div>    
<div class="col-md-12">
     <hr/>
    <div class="row">
        <div class="col-md-12">
           
    <center><h2>BEST OF HOME & FURNISHING</h2></center>
  
 <a  style="margin-top:-50px;" class="btn btn-sm btn-danger pull-right" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a>
        </div>
      
    </div>
    

              

   <hr/>

</div>
   <div class="col-md-12">
                 <div class="row" style="padding:40px;margin-left:-39px;">
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/home1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/home2.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/home3.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/home4.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/home5.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/home1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/home2.webp')}}" style="width:119%;">
            </div>
                </div>
       </div>    
<div class="col-md-12">
     <hr/>
    <div class="row">
        <div class="col-md-12">
           
    <center><h2>BEST OF BEAUTY & PERSONAL CARE</h2></center>
  
 <a  style="margin-top:-50px;" class="btn btn-sm btn-danger pull-right" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a>
        </div>
      
    </div>
    

              

   <hr/>

</div>
   <div class="col-md-12">
                 <div class="row" style="padding:40px;margin-left:-39px;">
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/beauty1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/beauty2.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/beauty3.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/beauty4.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/beauty5.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/beauty1.webp')}}" style="width:119%;">
            </div>
            <div class="col" style="padding:25px;">
                <img src="{{url('images/img/beauty2.webp')}}" style="width:119%;">
            </div>
                </div>
       </div>  
<div class="col-md-12">
    <br/><br/><br/>
    </div>
<!--<div class="col-md-12">-->
<!--    <hr/>-->
<!--    <center><h2>MEATS DEALS</h2></center>-->
<!--    <hr/>-->

<!--</div>-->
<!--<div class="col-md-12">-->
<!--    <div class="container">-->
     
<!--        <div class="row">-->
<!--            <div class="col">-->
              
<!--                        <img src="https://dao54xqhg9jfa.cloudfront.net/Category/e883d949-b5c7-b95d-3652-3bc2c53b0816/original/1603646230.3323--2020-10-2522_47_10--738.jpeg?format=webp" class="img-fluid"/>-->
                  
<!--                    <center><p>Chicken</p> </center> -->
<!--            </div>-->
<!--            <div class="col">-->
              
<!--                <img src="https://dao54xqhg9jfa.cloudfront.net/Category/bdfca08e-566b-4439-0aac-9c100704cb0b/original/1603646527.5457--2020-10-2522_52_07--738.jpeg?format=webp" class="img-fluid"/>-->
          
<!--                <center><p>Eggs</p> </center> -->
<!--    </div>-->
<!--    <div class="col">-->
              
<!--        <img src="https://dao54xqhg9jfa.cloudfront.net/Category/7948e90c-5b27-abdc-c33c-29fc3ca485ea/original/1603646285.4662--2020-10-2522_48_05--738.jpeg?format=webp" class="img-fluid"/>-->
<!--        <center><p>Fish & Sea Foods</p> </center> -->
       
<!--</div>-->
<!--<div class="col">-->
              
<!--    <img src="https://dao54xqhg9jfa.cloudfront.net/Category/ae9f4c10-4fdb-633a-9688-de8a0693381f/original/1603646326.9208--2020-10-2522_48_46--738.jpeg?format=webp" class="img-fluid"/>-->
<!--    <center><p>Mutton</p> </center> -->
   
<!--</div>-->
<!--<div class="col">-->
              
<!--    <img src="https://s3-ap-southeast-1.amazonaws.com/licious/cat/4/cat_tile_img/1609086575.0106--2020-12-2721:59:35--738?format=webp" class="img-fluid"/>-->
<!--    <center><p>Ready to Cook</p> </center> -->
   
<!--</div>-->


        
            <!-- break -->
<!--            <div class="col-12 p-2"></div>-->
            <!-- row 2 -->
        
   



<!--<div class="col">-->
              

<!--<center><p> <a  class="btn btn-sm btn-danger" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a></p></center>-->

<!--</div>-->

<!--        </div>-->
<!--    </div>-->



<!--</div> -->
<!--<div class="col-md-12">-->
<!--    <hr/>-->
<!--    <center><h2>GROCERIES</h2></center>-->
<!--    <hr/>-->

<!--</div>-->
<!--<div class="col-md-12">-->
<!--    <div class="container">-->
     
<!--        <div class="row">-->
<!--            <div class="col">-->
              
<!--                        <img src="https://www.bigbasket.com/media/customPage/b01eee88-e6bc-410e-993c-dedd012cf04b/bdcb2f5b-a1c4-4cd7-aab4-dd41e7a17532/1d7a0d5e-b571-4d6a-953c-f3c69d794b75/hp_staplesStorefront_atta-m_480_250122_01.jpg" class="img-fluid"/>-->
                  
                       
<!--            </div>-->
<!--            <div class="col">-->
              
<!--                <img src="https://www.bigbasket.com/media/customPage/b01eee88-e6bc-410e-993c-dedd012cf04b/bdcb2f5b-a1c4-4cd7-aab4-dd41e7a17532/1d7a0d5e-b571-4d6a-953c-f3c69d794b75/hp_staplesStorefront_rice-m_480_250122_02.jpg" class="img-fluid"/>-->
          
               
<!--    </div>-->
<!--    <div class="col">-->
              
<!--        <img src="https://www.bigbasket.com/media/customPage/b01eee88-e6bc-410e-993c-dedd012cf04b/bdcb2f5b-a1c4-4cd7-aab4-dd41e7a17532/1d7a0d5e-b571-4d6a-953c-f3c69d794b75/hp_staplesStorefront_cooking-m_480_250122_04.jpg" class="img-fluid"/>-->
  
       
<!--</div>-->
<!--<div class="col">-->
              
<!--    <img src="https://www.bigbasket.com/media/customPage/b01eee88-e6bc-410e-993c-dedd012cf04b/bdcb2f5b-a1c4-4cd7-aab4-dd41e7a17532/1d7a0d5e-b571-4d6a-953c-f3c69d794b75/hp_staplesStorefront_dry-m_480_250122_05.jpg" class="img-fluid"/>-->

   
<!--</div>-->
<!--<div class="col">-->
              
<!--    <img src="https://www.bigbasket.com/media/customPage/b01eee88-e6bc-410e-993c-dedd012cf04b/bdcb2f5b-a1c4-4cd7-aab4-dd41e7a17532/1d7a0d5e-b571-4d6a-953c-f3c69d794b75/hp_staplesStorefront_salt-m_480_250122_06.jpg" class="img-fluid"/>-->

   
<!--</div>-->


        
            <!-- break -->
<!--            <div class="col-12 p-2"></div>-->
            <!-- row 2 -->
        
   



<!--<div class="col">-->
              

<!--<center><p> <a  class="btn btn-sm btn-danger" target="_blank" href="#"><i class="fa fa-plus" style="color:white;"></i>&nbsp;Add </a></p></center>-->

<!--</div>-->

<!--        </div>-->
<!--    </div>-->



<!--</div> -->


                 </div>
                
                
              </div>

   </div>  
   <script type="text/javascript">
       $(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
    navigation : true
  });
 
});
        $('.owl-carousel').owlCarousel({
            margin: 10,
            nav: true,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 5
                },
                1000: {
                    items: 5
                }
            }
        });
   </script>
@endsection

