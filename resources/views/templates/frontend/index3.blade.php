@extends('templates.frontend.header')
@section('content')
<style>
  .overlay {
    position: absolute;
    /*bottom: 25;*/
    top: 100px;
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.5);
    color: #f1f1f1;
    width: 95%;
    transition: .5s ease;
    opacity: 0;
    color: white;
    font-size: 20px;
    padding: 20px;
    text-align: center;
  }

  .common-height {
    width: 100%;
    height: 200px;
  }

  .product_container:hover .overlay {
    opacity: 1;
  }

  .abc {
    background: rgba(255, 63, 108, .8);
    display: inline-block;
    position: absolute;
    top: 15px;
    left: 15px;
    text-transform: uppercase;
    color: #fff;
    font-size: 10px;
    font-weight: 500;
    z-index: 1;
    padding: 0 4px;
    line-height: 16px;
  }
</style>






@foreach ($homecomponent as $v)
  if ($v['component_type'] == "Slider") { ?>
    <div class="row">
      <?php if (!empty($v['slider_images'])) { ?>


        <div class="col-md-12">
          <div class="container-fluid">
            <br />
            <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title'] ?></h5>
          </div>

        </div>

        <div class="sliding_banner col-md-12">
          <div class="slider" style="padding-right:13px;">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">

                  <img src="./images/slider/<?php echo $v['first_img']; ?>" class="d-block w-100" alt="..." style="height: 24rem;">

                </div>

                @foreach ($v['slider_images'] as $s)
                  <div class="carousel-item">
                    <img src="./images/slider/<?php echo $s['component_image']; ?>" class="d-block w-100" alt="..." style="height: 24rem;">
                  </div>
                  @endforeach
                <!--<div class="carousel-item">-->
                <!--   <img src="./images/slider/slider3.webp" class="d-block w-100" alt="...">-->
                <!--</div>-->
                <!--<div class="carousel-item">-->
                <!--   <img src="./images/slider/slider4.webp" class="d-block w-100" alt="...">-->
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

    @else
        <h6>No Slider</h6>
@endif

    </div>
    @endforeach

    <!-- Slider Done -->
    <?php if ($v['component_type'] == "Brand") { ?>

      <div class="row">
        <div class="col-md-12">
          <div class="container-fluid">
            <br />
            <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title'] ?></h5>
          </div>

        </div>


        <?php if ($v['web_layout_type'] == 0) { ?>



          <div class="col-md-12">
            <div class="owl-carousel owl-theme">
              <?php foreach ($v['content'] as $sub) { ?>
                <div class="item" style="padding:8px;">
                  <div>
                    <?php if ($v['web_icon_type'] == "0") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                      <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "1") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                      <center>
                        <p id="category_name"><?php echo $sub['brand_name']; ?></p>
                      </center></a>
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "2") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"></a><br />
                      <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                        ?></p></center>-->
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "3") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                      <center>
                        <p id="category_name"><?php echo $sub['brand_name']; ?></p>
                      </center></a>
                    <? } ?>
                  </div>
                </div>


              <?php } ?>
            </div>

          </div>


        <?php } ?>



        <!--Double Strip Sliding-->
        <?php if ($v['web_layout_type'] == 1) { ?>



          <div class="col-md-12">
            <div class="owl-carousel owl-theme">
              <?php foreach ($v['content'] as $sub) { ?>
                <div class="item" style="padding:15px;">
                  <div class="banner2">
                    <?php if ($v['web_icon_type'] == "0") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                      <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "1") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                      <center>
                        <p id="category_name"><?php echo $sub['brand_name']; ?></p>
                      </center></a>
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "2") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                      <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                        ?></p></center>-->
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "3") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                      <center>
                        <p id="category_name"><?php echo $sub['brand_name']; ?></p>
                      </center></a>
                    <? } ?>
                  </div>
                </div>


              <?php } ?>
            </div>

          </div>
          <div class="col-md-12">
            <div class="owl-carousel owl-theme">
              <?php foreach ($v['content'] as $sub) { ?>
                <div class="item" style="padding:15px;">
                  <div class="banner2">
                    <?php if ($v['web_icon_type'] == "0") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                      <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "1") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                      <center>
                        <p id="category_name"><?php echo $sub['brand_name']; ?></p>
                      </center></a>
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "2") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                      <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                        ?></p></center>-->
                    <? } ?>
                    <?php if ($v['web_icon_type'] == "3") { ?>
                      <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                      <center>
                        <p id="category_name"><?php echo $sub['brand_name']; ?></p>
                      </center></a>
                    <? } ?>
                  </div>
                </div>


              <?php } ?>
            </div>

          </div>

        <?php } ?>




        <!--3X3-->

        <?php if ($v['web_layout_type'] == 2) {
          if (count($v['content']) < 16) {
            foreach ($v['content'] as $sub) { ?>
              <div class="col-md-4" style="padding:50px;">
                <div class="banner2">
                  <?php if ($v['web_icon_type'] == "0") { ?>
                    <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                  <? } ?>
                  <?php if ($v['web_icon_type'] == "1") { ?>
                    <a href="{{url('product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                  <? } ?>
                  <?php if ($v['web_icon_type'] == "2") { ?>
                    <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                    <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                      ?></p></center>-->
                  <? } ?>
                  <?php if ($v['web_icon_type'] == "3") { ?>
                    <a href="{{url('product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                    <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                  <? } ?>
                </div>
              </div>

            <?php }
          } else { ?>

            <?php for ($i = 0; $i < 9; $i++) { ?>
              <div class="col-md-4">
                <div class="banner2">
                  <?php if ($v['web_icon_type'] == "0") { ?>
                    <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                  <? } ?>
                  <?php if ($v['web_icon_type'] == "1") { ?>
                    <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"><img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                    <center>
                      <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                    </center></a>
                  <? } ?>
                  <?php if ($v['web_icon_type'] == "2") { ?>
                    <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
                    <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                      ?></p></center>-->
                  <? } ?>
                  <?php if ($v['web_icon_type'] == "3") { ?>
                    <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
                    <center>
                      <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p>
                    </center></a>
                  <? } ?>
                </div>
              </div>






            <?php } ?>
      </div>


  <?php }
        } ?>


  <!--4 X 4-->

  <?php if ($v['web_layout_type'] == 3) {

        if (count($v['content']) < 16) {
          foreach ($v['content'] as $sub) { ?>

        <div class="col-md-3" style="padding:50px;">
          <div class="banner2">
            <?php if ($v['web_icon_type'] == "0") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
              <!--<center><p id="category_name">Metal Black Chair</p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "1") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
            <?php if ($v['web_icon_type'] == "2") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
              <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                ?></p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "3") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
          </div>
        </div>
      <?php }
        } else { ?>

      <?php for ($i = 0; $i < 16; $i++) { ?>
        <div class="col-md-3">
          <div class="banner2">
            <?php if ($v['web_icon_type'] == "0") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
              <!--<center><p id="category_name">Metal Black Chair</p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "1") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"><img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
            <?php if ($v['web_icon_type'] == "2") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
              <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                ?></p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "3") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"><img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
          </div>
        </div>






      <?php } ?>

    <?php } ?>



    </div>
    </div>

  <?php } ?>


  <!--6X6-->

  <?php if ($v['web_layout_type'] == 4) {



        if (count($v['content']) < 36) {

          foreach ($v['content'] as $sub) { ?>
        <div class="col-md-2" style="padding:55px;">
          <div class="container-fluid">
            <div class="banner2">
              <?php if ($v['web_icon_type'] == "0") { ?>
                <a href="{{url('product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
              <? } ?>
              <?php if ($v['web_icon_type'] == "1") { ?>
                <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
                <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
              <? } ?>
              <?php if ($v['web_icon_type'] == "2") { ?>
                <a href="{{url('product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                  ?></p></center>-->
              <? } ?>
              <?php if ($v['web_icon_type'] == "3") { ?>
                <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
              <? } ?>
            </div>
          </div>

        </div>
      <?php }
        } else {
          for ($i = 0; $i < 36; $i++) { ?>
        <div class="col-md-2" style="padding:35px;">
          <div class="banner2">
            <?php if ($v['web_icon_type'] == "0") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
              <!--<center><p id="category_name">Metal Black Chair</p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "1") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
              <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
            <?php if ($v['web_icon_type'] == "2") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
              <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                ?></p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "3") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
              <p id="category_name" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
          </div>
        </div>






    <?php }
        } ?>
    </div>
    </div>

  <?php } ?>

  <!--7columns single strip static-->

  <?php if ($v['web_layout_type'] == 5) {



        if (count($v['content']) < 7) {

          foreach ($v['content'] as $sub) { ?>
        <div class="col" style="padding:35px;">
          <div class="banner2">
            <?php if ($v['web_icon_type'] == "0") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
              <!--<center><p id="category_name">Metal Black Chair</p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "1") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
              <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
            <?php if ($v['web_icon_type'] == "2") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
              <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                ?></p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "3") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
              <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
          </div>
        </div>
      <?php }
        } else {
          for ($i = 0; $i < 7; $i++) { ?>
        <div class="col" style="padding:35px;">
          <div class="banner2">
            <?php if ($v['web_icon_type'] == "0") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
                                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                   <? } ?>
                     <?php if ($v['web_icon_type'] == "1") { ?>
                    <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>"><img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br/>
                                                    <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
                   <? } ?>
                   <?php if ($v['web_icon_type'] == "2") { ?>
                                                    <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br/>
                                                    <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                                                      ?></p></center>-->
                   <? } ?>
                    <?php if ($v['web_icon_type'] == "3") { ?>
                                                    <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
              <p id="category_name" style="margin-left:63px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
          </div>
        </div>






    <?php }
        } ?>
    </div>
    </div>

  <?php } ?>

  <!--4X2-->

  <?php if ($v['web_layout_type'] == 6) {



        if (count($v['content']) < 8) {

          foreach ($v['content'] as $sub) { ?>
        <div class="col-md-3" style="padding:35px;">
          <div class="banner2">
            <?php if ($v['web_icon_type'] == "0") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
              <!--<center><p id="category_name">Metal Black Chair</p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "1") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
            <?php if ($v['web_icon_type'] == "2") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"><img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
              <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                ?></p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "3") { ?>
              <a href="{{url('product-lists',$sub['brand_auto_id'])}}"> <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
          </div>
        </div>
      <?php }
        } else {
          for ($i = 0; $i < 8; $i++) { ?>
        <div class="col-md-3" style="padding:35px;">
          <div class="banner2">
            <?php if ($v['web_icon_type'] == "0") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"></a></a>
              <!--<center><p id="category_name">Metal Black Chair</p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "1") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;width:343px;height:280px;"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
            <?php if ($v['web_icon_type'] == "2") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="width:343px;height:280px;"></a><br />
              <!--<center><p id="category_name"><? //php echo $sub['subcategory_name'];
                                                ?></p></center>-->
            <? } ?>
            <?php if ($v['web_icon_type'] == "3") { ?>
              <a href="{{url('product-lists',<?php echo $v['content'][$i]['brand_auto_id']; ?>)}}"> <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="width:343px;height:280px;"></a><br />
              <p id="category_name" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
            <? } ?>
          </div>
        </div>






    <?php }
        } ?>
    </div>
    </div>

  <?php } ?>




<?php } ?>


@endsection
