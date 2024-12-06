@php
    $page = 'Home';
@endphp


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

        @media (max-width:767px) {
            .common-height {
                width: 150px !important;
                height: 150px;
            }
        }


        .quantity-controllers:hover {
            cursor: pointer;

        }

        .quantity-form {
            align-self: center;
            width: 70%
        }

        .quantity-form {
            padding-left: 25%
        }

        @media (max-width: 767px) {
            .quantity-form {
                width: 100% !important;
                padding-left: 0% !important;
            }
        }
    </style>
    <section>
        <div class="col-md-12 col-sm-12 col-lg-12">
            <?php foreach($homecomponent As $v){

                    if($v['component_type']=="Slider"){?>
            <div class="row ps-2">
                <?php if(!empty($v['slider_images'])){?>


                <div class="col-md-12">
                    <div class="container-fluid">
                        <br />
                        <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
                    </div>

                </div>

                <div class="sliding_banner col-md-12">
                    <div class="slider" style="padding-right:13px;">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">

                                    <img src="./images/slider/<?php echo $v['first_img']; ?>" class="d-block w-100" alt="..."
                                        style="height: 24rem;">

                                </div>

                                <?php foreach($v['slider_images'] As $s) {?>
                                <div class="carousel-item">
                                    <img src="./images/slider/<?php echo $s['component_image']; ?>" class="d-block w-100" alt="..."
                                        style="height: 24rem;">
                                </div>
                                <?php }?>
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

            </div>
            <?php  } else{?>
            <div class="row">
                <h6>No Slider</h6>
            </div>
            <?php }} ?>



            <?php if($v['component_type']=="MainCategories" ){?>

            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="container-fluid">
                    <br />
                    <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
                </div>

            </div>

            <div class="container-fluid">
                <?php if($v["web_icon_type"]=="1")
                           {?>

                <div class="row">

                    <div class="owl-carousel owl-theme">
                        <?php foreach($main_category As $main)
                                        {?>
                        <div class="item" style="padding:15px;">
                            <div class="banner2">

                                <a href="{{ url(Session('main') . '/product-lists', $main->id) }}">
                                    <img class="mx-auto" src="{{ asset('images/categories/' . $main['category_image_app']) }}"
                                        style="border-radius:50%;height:150px; width:150px"></a><br />
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->

                            </div>
                        </div>

                        <?php }

                                    ?>
                    </div>

                </div>


                <!--Only Category Image and Category Name Circle-->
                <?php }else if($v["web_icon_type"]=="2")
                           {?>
                <div class="row">


                    <div class="owl-carousel owl-theme">
                        <?php foreach($main_category As $main)
                                        {?>
                        <div class="item" style="padding:5px;">
                            <div class="banner2">

                                <a href="{{ url(Session('main') . '/product-lists', $main->id) }}">
                                    <img id="category_img"
                                        src="{{ asset('images/categories/' . $main['category_image_app']) }}"
                                        style="border-radius:50%;height:150px; width:150px"></a>

                            </div>
                        </div>

                        <?php }?>
                    </div>
                    <div class="sticky owl-carousel owl-theme">
                        <?php foreach($main_category As $main)
                                        {?>
                        <div class="item" style="padding:15px;">
                            <a href="{{ url(Session('main') . '/product-lists', $main->id) }}">
                                <p class="text-center"><?php echo $main['category_name']; ?></p>
                            </a>


                        </div>

                        <?php }?>
                    </div>
                </div>
                <?php   }else if($v["web_icon_type"]=="3")
                           {?>
                <div class="row">


                    <div class="owl-carousel owl-theme">
                        <?php foreach($main_category As $main)
                                        {?>
                        <div class="item" style="padding:15px;">
                            <div class="banner2">

                                <a href="{{ url(Session('main') . '/product-lists', $main->id) }}">
                                    <img id="category_img"
                                        src="{{ asset('images/categories/' . $main['category_image_app']) }}"
                                        style="height:150px;"></a><br />


                            </div>
                        </div>

                        <?php }?>
                    </div>
                </div>

                <?php }else if($v["web_icon_type"]=="4")
                           {?>
                <div class="row">


                    <div class="owl-carousel owl-theme">
                        <?php foreach($main_category As $main)
                                        {?>
                        <div class="item" style="padding:15px;">
                            <div class="banner2">

                                <a href="{{ url(Session('main') . '/product-lists', $main->id) }}">
                                    <img class="mx-auto" src="{{ asset('images/categories/' . $main['category_image_app']) }}"
                                        style="height:150px;"><br />
                                    <p class="text-center" style="color:black;"><?php echo $main['category_name']; ?></p>
                                </a>

                            </div>
                        </div>

                        <?php }?>
                    </div>
                </div>

                <?php }else {
                              ?>
                <div class="row">


                    <div class="owl-carousel owl-theme">
                        <?php foreach($main_category As $main)
                                    {?>
                        <div class="item" style="padding:5px;">
                            <div class="banner2">

                                <a href="{{ url(Session('main') . '/product-lists', $main->id) }}">
                                    <img class="mx-auto"
                                        src="{{ asset('images/categories/' . $main['category_image_app']) }}"
                                        style="height:120px; width:120px; border-radius:50%"><br />
                                    <p class="text-center"><?php echo $main['category_name']; ?></p>
                                </a>

                            </div>
                        </div>

                        <?php }?>
                    </div>
                </div>
                <?php } ?>
            </div>





            <?php } ?>

            <?php if($v['component_type']=="Brand" && count($v["content"]) > 0){?>

            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <br />
                        <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
                    </div>

                </div>


                <?php if($v['web_layout_type']==0){?>



                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <?php foreach($v['content'] As $sub)
                                        {?>
                        <div class="item" style="padding:8px;">
                            <div>
                                <?php if($v['web_icon_type']=="0")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        style="border-radius:50%;" class="common-height"></a><br />
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                                        class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p>
                                <?php  } elseif($v['web_icon_type']=="2")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img class="common-height" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"></a><br />
                                <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img
                                        id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                                <?php  }else
                   {
                    ?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img class="common-height" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"></a><br />
                                <?php
                   } ?>
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
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        style="border-radius:50%;" class="common-height"></a><br />
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                                        class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                                <?php  }else if($v['web_icon_type']=="2")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        class="common-height"></a><br />
                                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                <?php  } elseif($v['web_icon_type']=="3")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                                <?php  }else{
                    ?>

                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img
                                        id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>

                                <?php
                   } ?>
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
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        style="border-radius:50%;" class="common-height mx-auto"></a><br />
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                <?php  } elseif($v['web_icon_type']=="1")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        style="border-radius:50%;" class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                                <?php  } else if($v['web_icon_type']=="2")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img
                                        id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        class="common-height"></a><br />
                                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                <?php  } elseif($v['web_icon_type']=="3")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                                <?php  } else
                   {
                    ?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                        class="common-height mx-auto"></a><br />
                                <p class="text-center"><?php echo $sub['brand_name']; ?></p>

                                <?php } ?>
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
                <div class="col-md-4" style="padding:20px;">
                    <div class="banner2">
                        <?php if($v['web_icon_type']=="0")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img
                                id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                                class="common-height"></a>
                        <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                        <?php  }else if($v['web_icon_type']=="1")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                            <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                                class="common-height mx-auto"></a><br />
                        <p class="text-center" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                        <?php  }else if($v['web_icon_type']=="2")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                            <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                class="common-height"></a><br />

                        <?php  }else if($v['web_icon_type']=="3")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                            <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height px-2"></a><br />
                        <p class="text-center"><?php echo $sub['brand_name']; ?></p>
                        </a>
                        <?php  }else  {
                    ?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"><img
                                id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>"
                                class="common-height"></a><br />
                        <p class="text-center"><?php echo $sub['brand_name']; ?></p>
                        </a>
                        <?php } ?>
                    </div>
                </div>

                <?php }}else{?>

                <?php for($i=0;$i<9;$i++){?>
                <div class="col-md-4">
                    <div class="banner2">
                        <?php if($v['web_icon_type']=="0")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}"> <img
                                id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                                class="common-height"></a>
                        <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                        <?php  }else if($v['web_icon_type']=="1")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}"><img
                                id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                                class="common-height"></a><br />
                        <p class="text-center" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                        <?php  } else if($v['web_icon_type']=="2")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}"> <img
                                id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                                class="common-height"></a><br />
                        <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                        <?php  } else if($v['web_icon_type']=="3")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                            <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                        <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                        <?php  }else
                   {
                    ?>
                        <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                            <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                        <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>

                        <?php
                   } ?>
                    </div>
                </div>






                <?php }?>
            </div>


            <?php }}?>


            <!--4 X 4-->

            <?php if($v['web_layout_type']==3){

                                         if(count($v['content'])<16){
                                          foreach($v['content'] As $sub){?>

            <div class="col-md-3" style="padding:20px;">
                <div class="banner2">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img id="category_img"
                            src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                            class="common-height"></a>
                    <?php  }else if($v['web_icon_type']=="1")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img
                            src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                            class="common-height mx-auto"></a><br />
                    <p class="text-center" style="margin-left:110px;"><?php echo $sub['brand_name']; ?></p></a>
                    <?php  }else if($v['web_icon_type']=="2")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img id="category_img"
                            src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                    <?php  }else if($v['web_icon_type']=="3")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img
                            src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                    <?php  }else
                   { ?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img
                            src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                    <?php

                   } ?>
                </div>
            </div>
            <?php }}else{?>

            <?php for($i=0;$i<16;$i++){?>
            <div class="col-md-3">
                <div class="banner2">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}"> <img id="category_img"
                            src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                            class="common-height"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <?php  } else if($v['web_icon_type']=="1")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}"><img
                            src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                            class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                    <?php  } else if($v['web_icon_type']=="2")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}"> <img id="category_img"
                            src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                    <?php  } else if($v['web_icon_type']=="3")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                        <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                    <?php  }else
                   {
                    ?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                        <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>

                    <?php
                   } ?>
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
        <div class="col-md-2" style="padding:15px;">
            <div class="container-fluid">
                <div class="banner2">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"><img id="category_img"
                            src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                            class="common-height"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <?php  } else if($v['web_icon_type']=="1")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                        <img id="category_img" src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                            class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                    <?php  } else if($v['web_icon_type']=="2")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                        <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                    <?php  } else if($v['web_icon_type']=="3")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                        <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                    <?php  } else{?>

                    <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                        <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                    <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php } }else { for($i=0;$i<36;$i++){?>
        <div class="col-md-2" style="padding:20px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                        class="common-height mx-auto"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                        class="common-height mx-auto"></a><br />
                <p class="text-center" style="margin-left:35px;"><?php echo $sub['brand_name']; ?></p></a>
                <?php  } else if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                        class="common-height mx-auto"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  }else {
                    ?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                        class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php
                   } ?>
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
        <div class="col" style="padding:20px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}"> <img id="category_img"
                        src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                        class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  } else if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  } else { ?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php } ?>

            </div>
        </div>
        <?php } }else { for($i=0;$i<7;$i++){?>
        <div class="col" style="padding:20px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}"> <img id="category_img"
                        src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;" class="common-height"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                        class="common-height  mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  } else if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                        class="common-height mx-auto"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  }else {
                    ?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php
                   } ?>
            </div>
        </div>






        <?php }}?>
        </div>
        </div>

        <?php }?>

        <!--4X2-->

        <?php if($v['web_layout_type']==6 || $v['web_layout_type']==7 || $v['web_layout_type']==8 ){



                                                 if(count($v['content'])<8){

                                                 foreach($v['content'] As $sub){?>
        <div class="col-md-3" style="padding:20px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                        class="common-height mx-auto"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" style="border-radius:50%;"
                        class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  } else if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  } else
                   {
                    ?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['brand_auto_id']) }}">
                    <img src="./images/brands/<?php echo $sub['brand_image_app']; ?>" class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php
                   } ?>
            </div>
        </div>
        <?php } }else { for($i=0;$i<8;$i++){?>
        <div class="col-md-3" style="padding:20px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                        style="border-radius:50%;width:343px;height:280px;"></a></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>" style="border-radius:50%;"
                        class="common-height mx-auto"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  } else if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img class=" mx-auto" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                        style="width:343px;height:280px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img class="mx-auto" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                        style="width:343px;height:280px;"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>
                <?php  }else {
                    ?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['brand_auto_id']; ?>) }}">
                    <img class="mx-auto" src="./images/brands/<?php echo $v['content'][$i]['brand_image_app']; ?>"
                        style="width:343px;height:280px;"></a><br />
                <p class="text-center"><?php echo $sub['brand_name']; ?></p></a>

                <?php
                   } ?>
            </div>
        </div>






        <?php }}?>
        </div>
        </div>

        <?php }?>




        <?php }?>

        <?php if($v['component_type']=="Banner" && count($v["content"]) > 0){?>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <br />
                    <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
                </div>

            </div>
            <div class="col-md-12">
                <div class="container-fluid">
                    <?php foreach($v['content'] As $b){?>
                    <img src="./images/slider/<?php echo $b['component_image']; ?>" style="width:100%;"
                        class="img-fluid img-responsive">
                    <?php }?>

                </div>

            </div>
        </div>

        <?php } ?>

        <?php if($v['component_type']=="SubCategories" && count($v["content"]) > 0){

                      ?>

        <div class="row my-3">
            <div class="col-md-12">
                <div class="container-fluid">
                    <br />
                    <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
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
                            <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                            style="border-radius:50%;"></a><br />
                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                    <?php  } elseif($v['web_icon_type']=="1")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height mx-auto"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                                style="border-radius:50%;"></a><br />
                                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                        <?php  }else if($v['web_icon_type']=="2")
                           {?>
                                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                        <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                        <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height mx-auto"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>

                                        <?php } else {

                  ?>
                                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height mx-auto"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                        <?php
                 }  ?>





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
                            <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                    href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                        style="border-radius:50%;"></a>
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                        href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                            style="border-radius:50%;"></a>
                                    <p class="text-center pt-2"><?php echo $sub['sub_category_name']; ?></p>
                                    <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                    <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>">
                                    </a>

                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                    <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a>
                                    <p class="text-center pt-2"><?php echo $sub['sub_category_name']; ?></p>
                                    <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                    <?php  }else
                   {
                    ?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a>
                                    <p class="text-center pt-2"><?php echo $sub['sub_category_name']; ?></p>
                                    <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                    <?php
                   } ?>
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
                            <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                    href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                        style="border-radius:50%;"></a><br />
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                <?php  } ?>
                                <?php if($v['web_icon_type']=="1")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                        href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                            style="border-radius:50%;"></a><br />
                                    <center>
                                        <p id="category_name"><?php echo $sub['sub_category_name']; ?></p>
                                    </center>
                                    <p
                                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                                        <?php echo $sub['get_spcount']; ?> Options</p>
                                    <?php  } ?>
                                    <?php if($v['web_icon_type']=="2")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height"
                                            src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                    <?php  } ?>
                                    <?php if($v['web_icon_type']=="3")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height"
                                            src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                    <center>
                                        <p id="category_name"><?php echo $sub['sub_category_name']; ?></p>
                                    </center>
                                    <p
                                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                                        <?php echo $sub['get_spcount']; ?> Options</p>
                                    <?php  } ?>
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
            <div class="col-md-4" style="padding-right: 0px;padding-left: 0px;">
                <div style="margin-right: 20px;margin-left: 20px;">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?></a>"
                            style="border-radius:50%;">
                        <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                        <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                style="border-radius:50%;"></a><br />
                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                        <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                        <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                        <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height mx-auto"
                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                        <?php  }else{
                    ?>

                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height mx-auto"
                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>

                        <?php
                   } ?>
                </div>
            </div>

            <?php }}else{?>

            <?php for($i=0;$i<9;$i++){?>
            <div class="col-md-4">
                <div class="banner2">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a><br />
                    <center>
                        <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                    </center>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  }else if($v['web_icon_type']=="2")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                    <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <center>
                        <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                    </center>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  }else {
                    ?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <center>
                        <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                    </center>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>

                    <?php
                   } ?>
                </div>
            </div>






            <?php }?>
        </div>


        <?php }}?>


        <!--4 X 4-->

        <?php if($v['web_layout_type']==3){

                                         if(count($v['content'])<16){
                                          foreach($v['content'] As $sub){?>

        <div class="col-md-2" style="padding:20px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }else
                   {
                    ?>

                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>

                <?php
                   } ?>
            </div>
        </div>
        <?php }}else{?>

        <?php for($i=0;$i<16;$i++){?>
        <div class="col-md-3">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
                <?php if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
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
        <div class="col-md-2" style="padding:15px;">
            <div class="container-fluid">
                <div class="banner2">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <?php  } ?>
                    <?php if($v['web_icon_type']=="1")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a><br />
                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  } ?>
                    <?php if($v['web_icon_type']=="2")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                    <?php  } ?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  } ?>
                </div>
            </div>

        </div>
        <?php } }else { for($i=0;$i<36;$i++){?>
        <div class="col-md-2">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a><br />
                <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
                <?php if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
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
        <div class="col-md-2" style="padding-right: 0px;">
            <div>
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } elseif($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:170px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } elseif($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }else
                   {
                    ?>

                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}" class=" px-2">
                    <img class="mx-auto" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="height:250px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-muted d-block text-center"><?php echo $sub['get_spcount']; ?> Options</small>


                <?php

                   } ?>
            </div>
        </div>
        <?php } }else { for($i=0;$i<7;$i++){?>
        <div class="col" style="padding:10px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:170px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } elseif($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:170px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  }else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }else

                   {
                    ?>

                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>


                <?php } ?>
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
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="border-radius:50%;height:280px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img class="mx-auto"
                        src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;height:280px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  } elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height:280px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="mx-auto" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="height:280px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  }else
                   {
                    ?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="mx-auto" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php
                   } ?>
            </div>
        </div>
        <?php } }else { for($i=0;$i<8;$i++){?>
        <div class="col-md-3">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="border-radius:50%;width:343px;height:280px;">
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <img class="mx-auto" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="border-radius:50%;width:343px;height:280px;"><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="width:343px;height:280px;"><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <img class="mx-auto" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="width:343px;height:280px;"><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  }else
                   {

                    ?>
                <img class="mx-auto" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="width:343px;height:280px;"><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>


                <?php
                   } ?>
            </div>
        </div>






        <?php }}?>
        </div>
        </div>

        <?php } ?>

        <!--1*4-->

        <?php if($v['web_layout_type']==7){

                                          ?>


        <div class="container-fluid" style="padding-right: 35px;padding-left: 35px;">
            <div class="row">
                <?php if(count($v['first_subcat'])<2){
                           foreach($v['first_subcat'] As $fsub){?>

                <div class="col-lg-6 col-md-6 col-xs-12" style="padding:0px;">
                    <div class="col-lg-12 col-md-12 col-xs-12 thumb" style="padding:4px;">
                        <?php if($v['web_icon_type']=="4")
                           {?>
                        <a class="thumbnail" href="{{ url(Session('main') . '/product-lists', $fsub['_id']) }}"
                            data-lightbox="imgGLR">
                            <h3
                                style="position: absolute;top: 15px;text-align: center;width: 100%;color: white;background: rgba(255, 255, 255, 0.3);">
                                <?php echo $fsub['sub_category_name']; ?></h3>

                            <img id="category_img" class="img-responsive"
                                src="./images/subcategories/<?php echo $fsub['subcategory_image_app']; ?>" border="0"
                                style="height:730px;width: 100%;">
                        </a>
                        <?php  } ?>
                    </div>
                </div>
                <?php } }?>
                <div class="col-lg-6 col-md-6 col-xs-12">

                    <div class="row">
                        <?php if(count($v['content'])<4){
                           foreach($v['content'] As $sub){?>
                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">

                            <a class="thumbnail" href="product-lists/$sub['subcategory_auto_id']" data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height: 340px;width: 100%;"
                                    border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $sub['sub_category_name']; ?></p>
                                </center>

                            </a>

                        </div>
                        <?php } }else { for($i=0;$i<4;$i++){?>


                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">

                            <a class="thumbnail" href="product-lists/<?php echo $v['content'][$i]['subcategory_auto_id']; ?>" data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="height: 340px;width: 100%;"
                                    border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $v['content'][$i]['sub_category_name']; ?></p>
                                </center>
                            </a>

                        </div>
                        <?php }}?>
                    </div>
                </div>


            </div>
        </div>
        <?php }?>
        <!--4*1-->

        <?php if($v['web_layout_type']==8){

                                            ?>

        <div class="container-fluid" style="padding-right: 35px;padding-left: 35px;">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-xs-12">

                    <div class="row">
                        <?php if(count($v['content'])<4){
                           foreach($v['content'] As $sub){?>
                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">
                            <?php if($v['web_icon_type']=="4")
                           {?>
                            <a href="product-lists/$sub['subcategory_auto_id']" class="thumbnail" data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>" style="height: 340px;width: 100%;"
                                    border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $sub['sub_category_name']; ?></p>
                                </center>

                            </a>
                            <?php  } ?>
                        </div>
                        <?php } }else { for($i=0;$i<4;$i++){?>


                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">

                            <a href="product-lists/<?php echo $v['content'][$i]['subcategory_auto_id']; ?>" class="thumbnail" data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="height: 340px;width: 100%;"
                                    border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $v['content'][$i]['sub_category_name']; ?></p>
                                </center>
                            </a>

                        </div>
                        <?php }}?>
                    </div>
                </div>
                <?php if(count($v['first_subcat'])<2){
                           foreach($v['first_subcat'] As $fsub){?>

                <div class="col-lg-6 col-md-6 col-xs-12" style="padding:0px;">
                    <div class="col-lg-12 col-md-12 col-xs-12 thumb" style="padding:4px;">

                        <a class="thumbnail" href="{{ url(Session('main') . '/product-lists', $fsub['_id']) }}"
                            data-lightbox="imgGLR">
                            <h3
                                style="position: absolute;top: 15px;text-align: center;width: 100%;color: white;background: rgba(255, 255, 255, 0.3);">
                                <?php echo $fsub['sub_category_name']; ?></h3>

                            <img id="category_img" class="img-responsive"
                                src="./images/subcategories/<?php echo $fsub['subcategory_image_app']; ?>" border="0"
                                style="height: 730px;width: 100%;">
                        </a>

                    </div>
                </div>
                <?php } }?>

            </div>
        </div>




        <?php }?>


        <?php }?>




        <!-- End of Subcategories -->
        <?php if($v['component_type']=="MubCategories"){

                      ?>

        <div class="row my-3">
            <div class="col-md-12">
                <div class="container-fluid">
                    <br />
                    <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
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
                            <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                            style="border-radius:50%;"></a><br />
                                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                    <?php  } elseif($v['web_icon_type']=="1")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <a
                                            href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height mx-auto"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                                style="border-radius:50%;"></a><br />
                                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                        <?php  }else if($v['web_icon_type']=="2")
                           {?>
                                        <a
                                            href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                        <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                        <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                                        <a
                                            href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height mx-auto"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>

                                        <?php } else {

                  ?>
                                        <a
                                            href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                            <img class="common-height mx-auto"
                                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                        <?php
                 }  ?>





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
                            <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                    href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                        style="border-radius:50%;"></a>
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                        href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                            style="border-radius:50%;"></a>
                                    <p class="text-center pt-2"><?php echo $sub['sub_category_name']; ?></p>
                                    <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                    <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>">
                                    </a>

                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                    <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height"
                                            src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a>
                                    <p class="text-center pt-2"><?php echo $sub['sub_category_name']; ?></p>
                                    <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                    <?php  }else
                   {
                    ?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height"
                                            src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a>
                                    <p class="text-center pt-2"><?php echo $sub['sub_category_name']; ?></p>
                                    <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                                    <?php
                   } ?>
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
                            <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                    href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                        style="border-radius:50%;"></a><br />
                                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                                <?php  } ?>
                                <?php if($v['web_icon_type']=="1")
                           {?>
                                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"> <a
                                        href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                            style="border-radius:50%;"></a><br />
                                    <center>
                                        <p id="category_name"><?php echo $sub['sub_category_name']; ?></p>
                                    </center>
                                    <p
                                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                                        <?php echo $sub['get_spcount']; ?> Options</p>
                                    <?php  } ?>
                                    <?php if($v['web_icon_type']=="2")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height"
                                            src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                                    <?php  } ?>
                                    <?php if($v['web_icon_type']=="3")
                           {?>
                                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                                        <img class="common-height"
                                            src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                                    <center>
                                        <p id="category_name"><?php echo $sub['sub_category_name']; ?></p>
                                    </center>
                                    <p
                                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                                        <?php echo $sub['get_spcount']; ?> Options</p>
                                    <?php  } ?>
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
            <div class="col-md-4" style="padding-right: 0px;padding-left: 0px;">
                <div style="margin-right: 20px;margin-left: 20px;">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?></a>"
                            style="border-radius:50%;">
                        <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                        <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                style="border-radius:50%;"></a><br />
                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                        <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                        <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                        <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height mx-auto"
                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                        <?php  }else{
                    ?>

                        <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                            <img class="common-height mx-auto"
                                src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"></a><br />
                        <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                        <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>

                        <?php
                   } ?>
                </div>
            </div>

            <?php }}else{?>

            <?php for($i=0;$i<9;$i++){?>
            <div class="col-md-4">
                <div class="banner2">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a><br />
                    <center>
                        <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                    </center>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  }else if($v['web_icon_type']=="2")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                    <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <center>
                        <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                    </center>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  }else {
                    ?>
                    <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                        <img class="common-height" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <center>
                        <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                    </center>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>

                    <?php
                   } ?>
                </div>
            </div>






            <?php }?>
        </div>


        <?php }}?>


        <!--4 X 4-->

        <?php if($v['web_layout_type']==3){

                                         if(count($v['content'])<16){
                                          foreach($v['content'] As $sub){?>

        <div class="col-md-2" style="padding:20px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  }elseif($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  }elseif($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }else
                   {
                    ?>

                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>

                <?php
                   } ?>
            </div>
        </div>
        <?php }}else{?>

        <?php for($i=0;$i<16;$i++){?>
        <div class="col-md-3">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
                <?php if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:110px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
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
        <div class="col-md-2" style="padding:15px;">
            <div class="container-fluid">
                <div class="banner2">
                    <?php if($v['web_icon_type']=="0")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a>
                    <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                    <?php  } ?>
                    <?php if($v['web_icon_type']=="1")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="border-radius:50%;width:280px;"></a><br />
                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  } ?>
                    <?php if($v['web_icon_type']=="2")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                    <?php  } ?>
                    <?php if($v['web_icon_type']=="3")
                           {?>
                    <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                            id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                            style="width:280px;"></a><br />
                    <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                    <p
                        style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                        <?php echo $sub['get_spcount']; ?> Options</p>
                    <?php  } ?>
                </div>
            </div>

        </div>
        <?php } }else { for($i=0;$i<36;$i++){?>
        <div class="col-md-2">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:280px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:280px;"></a><br />
                <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
                <?php if($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } ?>
                <?php if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:280px;"></a><br />
                <p id="category_name" style="margin-left:35px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } ?>
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
        <div class="col-md-2" style="padding-right: 0px;">
            <div>
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        class="common-height" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } elseif($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:170px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } elseif($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }else
                   {
                    ?>

                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}" class=" px-2">
                    <img class="mx-auto" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="height:250px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-muted d-block text-center"><?php echo $sub['get_spcount']; ?> Options</small>


                <?php

                   } ?>
            </div>
        </div>
        <?php } }else { for($i=0;$i<7;$i++){?>
        <div class="col" style="padding:10px;">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="border-radius:50%;width:170px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } elseif($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="border-radius:50%;width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  } elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}"><img id="category_img"
                        src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>" style="width:170px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  }else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>
                <?php  }else

                   {
                    ?>

                <a href="{{ url(Session('main') . '/product-lists', <?php echo $v['content'][$i]['subcategory_auto_id']; ?>) }}">
                    <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                        style="width:170px;"></a><br />
                <p id="category_name" style="margin-left:63px;"><?php echo $sub['sub_category_name']; ?></p>
                <p
                    style="color: #848484;font-size: 1rem;text-align: center;font-family: Manrope,sans-serif;display: block;">
                    <?php echo $sub['get_spcount']; ?> Options</p>


                <?php } ?>
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
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;height:280px;"></a>
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img class="mx-auto"
                        src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="border-radius:50%;height:280px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  } elseif($v['web_icon_type']=="2")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}"><img
                        id="category_img" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="height:280px;"></a><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="mx-auto" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="height:280px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  }else
                   {
                    ?>
                <a href="{{ url(Session('main') . '/product-lists', $sub['subcategory_auto_id']) }}">
                    <img class="mx-auto" src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                        style="width:280px;"></a><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php
                   } ?>
            </div>
        </div>
        <?php } }else { for($i=0;$i<8;$i++){?>
        <div class="col-md-3">
            <div class="banner2">
                <?php if($v['web_icon_type']=="0")
                           {?>
                <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="border-radius:50%;width:343px;height:280px;">
                <!--<center><p id="category_name">Metal Black Chair</p></center>-->
                <?php  } else if($v['web_icon_type']=="1")
                           {?>
                <img class="mx-auto" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="border-radius:50%;width:343px;height:280px;"><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  }elseif($v['web_icon_type']=="2")
                           {?>
                <img id="category_img" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="width:343px;height:280px;"><br />
                <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->
                <?php  } else if($v['web_icon_type']=="3")
                           {?>
                <img class="mx-auto" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="width:343px;height:280px;"><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>
                <?php  }else
                   {

                    ?>
                <img class="mx-auto" src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                    style="width:343px;height:280px;"><br />
                <p class="text-center"><?php echo $sub['sub_category_name']; ?></p>
                <small class="text-center d-block text-muted"><?php echo $sub['get_spcount']; ?> Options</small>


                <?php
                   } ?>
            </div>
        </div>






        <?php }}?>
        </div>
        </div>

        <?php } ?>

        <!--1*4-->

        <?php if($v['web_layout_type']==7){

                                          ?>


        <div class="container-fluid" style="padding-right: 35px;padding-left: 35px;">
            <div class="row">
                <?php if(count($v['first_subcat'])<2){
                           foreach($v['first_subcat'] As $fsub){?>

                <div class="col-lg-6 col-md-6 col-xs-12" style="padding:0px;">
                    <div class="col-lg-12 col-md-12 col-xs-12 thumb" style="padding:4px;">
                        <?php if($v['web_icon_type']=="4")
                           {?>
                        <a class="thumbnail" href="{{ url(Session('main') . '/product-lists', $fsub['_id']) }}"
                            data-lightbox="imgGLR">
                            <h3
                                style="position: absolute;top: 15px;text-align: center;width: 100%;color: white;background: rgba(255, 255, 255, 0.3);">
                                <?php echo $fsub['sub_category_name']; ?></h3>

                            <img id="category_img" class="img-responsive"
                                src="./images/subcategories/<?php echo $fsub['subcategory_image_app']; ?>" border="0"
                                style="height:730px;width: 100%;">
                        </a>
                        <?php  } ?>
                    </div>
                </div>
                <?php } }?>
                <div class="col-lg-6 col-md-6 col-xs-12">

                    <div class="row">
                        <?php if(count($v['content'])<4){
                           foreach($v['content'] As $sub){?>
                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">

                            <a class="thumbnail" href="product-lists/$sub['subcategory_auto_id']"
                                data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                    style="height: 340px;width: 100%;" border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $sub['sub_category_name']; ?></p>
                                </center>

                            </a>

                        </div>
                        <?php } }else { for($i=0;$i<4;$i++){?>


                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">

                            <a class="thumbnail" href="product-lists/<?php echo $v['content'][$i]['subcategory_auto_id']; ?>" data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                                    style="height: 340px;width: 100%;" border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $v['content'][$i]['sub_category_name']; ?></p>
                                </center>
                            </a>

                        </div>
                        <?php }}?>
                    </div>
                </div>


            </div>
        </div>
        <?php }?>
        <!--4*1-->

        <?php if($v['web_layout_type']==8){

                                            ?>

        <div class="container-fluid" style="padding-right: 35px;padding-left: 35px;">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-xs-12">

                    <div class="row">
                        <?php if(count($v['content'])<4){
                           foreach($v['content'] As $sub){?>
                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">
                            <?php if($v['web_icon_type']=="4")
                           {?>
                            <a href="product-lists/$sub['subcategory_auto_id']" class="thumbnail"
                                data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $sub['subcategory_image_app']; ?>"
                                    style="height: 340px;width: 100%;" border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $sub['sub_category_name']; ?></p>
                                </center>

                            </a>
                            <?php  } ?>
                        </div>
                        <?php } }else { for($i=0;$i<4;$i++){?>


                        <div class="col-lg-6 col-md-6 col-xs-12 thumb" style="padding:4px;">

                            <a href="product-lists/<?php echo $v['content'][$i]['subcategory_auto_id']; ?>" class="thumbnail" data-lightbox="imgGLR">
                                <img id="category_img" class="img-responsive"
                                    src="./images/subcategories/<?php echo $v['content'][$i]['subcategory_image_app']; ?>"
                                    style="height: 340px;width: 100%;" border="0">

                                <center>
                                    <p
                                        style="color: #121212;font-size: 1.25rem;text-align: center;font-family: Manrope,sans-serif;display: block;font-weight:bold;">
                                        <?php echo $v['content'][$i]['sub_category_name']; ?></p>
                                </center>
                            </a>

                        </div>
                        <?php }}?>
                    </div>
                </div>
                <?php if(count($v['first_subcat'])<2){
                           foreach($v['first_subcat'] As $fsub){?>

                <div class="col-lg-6 col-md-6 col-xs-12" style="padding:0px;">
                    <div class="col-lg-12 col-md-12 col-xs-12 thumb" style="padding:4px;">

                        <a class="thumbnail" href="{{ url(Session('main') . '/product-lists', $fsub['_id']) }}"
                            data-lightbox="imgGLR">
                            <h3
                                style="position: absolute;top: 15px;text-align: center;width: 100%;color: white;background: rgba(255, 255, 255, 0.3);">
                                <?php echo $fsub['sub_category_name']; ?></h3>

                            <img id="category_img" class="img-responsive"
                                src="./images/subcategories/<?php echo $fsub['subcategory_image_app']; ?>" border="0"
                                style="height: 730px;width: 100%;">
                        </a>

                    </div>
                </div>
                <?php } }?>

            </div>
        </div>




        <?php }?>


        <?php }?>
        <!-- End of main Categories -->




        <?php if($v['component_type']=="Offers" && count($v["content"]) > 0){

                        ?>

        <div class="row container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">
                    <br />
                    <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
                </div>

            </div>


            <?php if($v['layout_type']==0){?>



            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($v['content'] As $sub)
                                        {?>
                    <div class="item" style="padding:15px;">
                        <div class="banner2">

                            <a href="{{ url(Session('main') . '/product-lists', $sub['offer_auto_id']) }}">
                                <img id="category_img" src="./images/offers/<?php echo $sub['component_image']; ?>"
                                    style="width: 100%;height:200px;"></a><br />
                            <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->

                        </div>
                    </div>


                    <?php }?>
                </div>

            </div>

            <?php }?>



            <!--4X2-->

            <?php if($v['layout_type']==1){



                                                 if(count($v['content'])<8){

                                                 foreach($v['content'] As $sub){?>
            <div class="col-md-3" style="padding:20px;">
                <div class="banner2">

                    <a href="{{ url(Session('main') . '/product-lists', $sub['offer_auto_id']) }}"><img id="category_img"
                            src="./images/offers/<?php echo $sub['component_image']; ?>" class="common-height"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->

                </div>
            </div>
            <?php } }else { for($i=0;$i<8;$i++){?>
            <div class="col-md-3" style="padding:20px;">
                <div class="banner2">

                    <a href="{{ url(Session('main') . '/product-lists', $sub['offer_auto_id']) }}"><img id="category_img"
                            src="./images/offers/<?php echo $v['content'][$i]['component_image']; ?>" class="common-height"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->

                </div>
            </div>






            <?php }}?>


            <?php }?>




            <!--3 column row-->

            <?php if($v['layout_type']==2){

                                         if(count($v['content'])<4){
                                          foreach($v['content'] As $sub){?>

            <div class="col-md-4" style="padding:20px;">
                <div class="banner2">

                    <a href="{{ url(Session('main') . '/product-lists', $sub['offer_auto_id']) }}"> <img
                            id="category_img" src="./images/offers/<?php echo $sub['component_image']; ?>"
                            style="width:100%;height:250px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->

                </div>
            </div>




            <?php }?>

            <?php }?>



            <?php }?>

            <!--2 X 2-->

            <?php if($v['layout_type']==3){

                                         if(count($v['content'])<8){
                                          foreach($v['content'] As $sub){?>

            <div class="col-md-6" style="padding:20px;">
                <div class="banner2">

                    <a href="{{ url(Session('main') . '/product-lists', $sub['offer_auto_id']) }}"> <img
                            id="category_img" src="./images/offers/<?php echo $sub['component_image']; ?>"
                            style="width:100%;height:300px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->

                </div>
            </div>
            <?php }}else{?>

            <?php for($i=0;$i<8;$i++){?>
            <div class="col-md-6">
                <div class="banner2">

                    <a href="{{ url(Session('main') . '/product-lists', $sub['offer_auto_id']) }}"> <img
                            id="category_img" src="./images/offers/<?php echo $v['content'][$i]['component_image']; ?>"
                            style="width:100%;height:300px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->

                </div>
            </div>






            <?php }?>

            <?php }?>



            <?php }?>

            <!--single row-->

            <?php if($v['layout_type']== 4){

                                          foreach($v['content'] As $sub){?>

            <div class="col-md-12">
                <div class="banner2">

                    <a href="{{ url(Session('main') . '/product-lists', $sub['offer_auto_id']) }}">
                        <img id="category_img" src="./images/offers/<?php echo $sub['component_image']; ?>"
                            style="width:93%;height:300px;"></a><br />
                    <!--<center><p id="category_name"><?//php echo $sub['subcategory_name']; ?></p></center>-->

                </div>
            </div>


            <?php }?>





            <?php }?>


        </div>

        <?php }?>

        <?php if($v['component_type']=="Products" && count($v["content"]) > 0){?>

        <div class="container-fluid">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="container-fluid">
                    <br />
                    <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
                </div>

            </div>


            <?php if($v['layout_type']==0){?>


            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($v['content'] As $sub)
                                        {?>
                    <div class="item" style="padding:15px;width:100%">
                        <div>

                            <a href="{{ url('product-detail', $sub['product_auto_id']) }}">
                                <img id="category_img"
                                    src="{{ asset('images/products_images/' . $sub['product_images']) }}"
                                    style="height:200px;">
                            </a><br />
                            <div class="rounded bg-white discount" id="orange"
                                style="background:rgba(255,63,108,.8);margin-bottom: 3%;text-align:center;font-size:12px;">
                                @if ($sub['offer_percentage'] != 0)
                                    <small class="text-muted "
                                        style="text-decoration: line-through;">{{ $sub['currency'] }}
                                        {{ $sub['product_price'] }}</small>
                                @endif
                                <span
                                    class="font-weight-bold">{{ $sub['currency'] }}{{ number_format($sub['final_product_price']) }}</span>
                            </div>

                            <h6 style="text-align:center;">{{ $sub['product_name'] }} </h6>
                        </div>
                        <div class="card-body" style="padding:5px;">
                            @if ($sub['offer_percentage'] != 0)
                                <div class="abc bg-success">{{ $sub['offer_percentage'] }}% off</div>
                            @endif


                        </div>


                    </div>





                    <?php }?>


                </div>

            </div>


            <?php }?>



            <!--Double Strip Sliding-->
            <?php if($v['layout_type']==1){?>




            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($v['content'] As $sub)
                                        {?>
                    <div class="item" style="padding:15px;width:100%">
                        <div>

                            <a href="{{ url('product-detail', $sub['product_auto_id']) }}">
                                <img id="category_img"
                                    src="{{ asset('images/products_images/' . $sub['product_images']) }}"
                                    style="height:200px;">
                            </a><br />
                            <div class="rounded bg-white discount" id="orange"
                                style="background:rgba(255,63,108,.8);margin-bottom: 3%;text-align:center;font-size:12px;">
                                @if ($sub['offer_percentage'] != 0)
                                    <small class="text-muted "
                                        style="text-decoration: line-through;">{{ $sub['currency'] }}
                                        {{ $sub['product_price'] }}</small>
                                @endif
                                <span
                                    class="font-weight-bold">{{ $sub['currency'] }}{{ number_format($sub['final_product_price']) }}</span>
                            </div>

                            <h6 style="text-align:center;">{{ $sub['product_name'] }} </h6>
                        </div>
                        <div class="card-body" style="padding:5px;">
                            @if ($sub['offer_percentage'] != 0)
                                <div class="abc bg-success">{{ $sub['offer_percentage'] }}% off</div>
                            @endif


                        </div>


                    </div>



                    <?php }?>


                </div>

            </div>

            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($v['content'] As $sub)
                                        {?>
                    <div class="item" style="padding:15px;width:100%">
                        <div>

                            <a href="{{ url('product-detail', $sub['product_auto_id']) }}">
                                <img id="category_img"
                                    src="{{ asset('images/products_images/' . $sub['product_images']) }}"
                                    style="height:200px;">

                            </a><br />
                            <div class="rounded bg-white discount" id="orange"
                                style="background:rgba(255,63,108,.8);margin-bottom: 3%;text-align:center;font-size:12px;">
                                @if ($sub['offer_percentage'] != 0)
                                    <small class="text-muted "
                                        style="text-decoration: line-through;">{{ $sub['currency'] }}
                                        {{ $sub['product_price'] }}</small>
                                @endif
                                <span
                                    class="font-weight-bold">{{ $sub['currency'] }}{{ number_format($sub['final_product_price']) }}</span>
                            </div>

                            <h6 style="text-align:center;">{{ $sub['product_name'] }} </h6>
                        </div>
                        <div class="card-body" style="padding:5px;">
                            @if ($sub['offer_percentage'] != 0)
                                <div class="abc bg-success">{{ $sub['offer_percentage'] }}% off</div>
                            @endif


                        </div>


                    </div>




                    <?php }?>


                </div>

            </div>

            <?php }else{?>




            <div class="container-fluid">
                <div class="row">

                    @php $i = 0; @endphp
                    <?php foreach($v['content'] As $sub)
              {?>

                    @if ($i % 2 == 0)
                        <div class="col-md-1 col-sm-12 product-mobile"></div>
                    @endif

                    <div class="col-md-5 col-sm-12 mt-5">
                        <div>
                            <div class="row col-sm-12" style="border:1px solid #c8c5c5; border-radius:5px;height:100%">

                                <div
                                    class="col-7 pt-2 d-flex align-items-center justify-content-center position-relative">
                                    <div class="rounded bg-white" id="orange"
                                        style="background: rgba(255,63,108,.8); margin-bottom: 3%; font-size: 12px; text-align: center;align-items: center">
                                        <!-- Your existing code -->

                                        <div>

                                            <h4 class="font-weight-bold">{{ $sub['product_name'] }}</h4>

                                            @if ($sub['offer_percentage'] != 0)
                                                <small class="text-muted"
                                                    style="text-decoration: line-through;">{{ $sub['currency'] }}
                                                    {{ $sub['product_price'] }}</small>
                                                <br>
                                            @endif


                                            <span
                                                class="font-weight-bold">{{ $sub['currency'] }}{{ number_format($sub['final_product_price']) }}</span>
                                            <br>


                                            @if ($sub['offer_percentage'] != 0)
                                                <span class="px-1 bg-success text-white">{{ $sub['offer_percentage'] }}%
                                                    off</span>
                                                <br>
                                                <br>
                                            @endif


                                            @if (Session('cart'))
                                                @php $in_cart = false; @endphp
                                                @foreach (Session('cart') as $id => $prod)
                                                    @if ($id == $sub['product_auto_id'])
                                                        @php $in_cart = true; @endphp
                                                        @php $pid = $id; @endphp
                                                        @php $quantity = $prod['quantity'] ; @endphp
                                                    @endif
                                                @endforeach
                                                @if ($in_cart)
                                                    <div class="input-group quantity-form">
                                                        <div class="input-group-prepend quantity-controllers qty-plus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                            <div class="input-group-text" id="inputGroupPrepend">+</div>
                                                        </div>
                                                        <input type="number" class="form-control quantity update-cart"
                                                            id="qty" value="{{ $quantity }}"
                                                            min="0" data-id="{{ $pid }}" readonly
                                                            aria-describedby="inputGroupPrepend quantity-controllers">
                                                        <div class="input-group-append quantity-controllers qty-minus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                            <div class="input-group-text" id="inputGroupAppend">-</div>
                                                        </div>
                                                    </div>

                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $(".quantity-controllers").click(function(e) {
                                                                e.preventDefault(); // Prevent default action

                                                                var ele;
                                                                if ($(this).hasClass("qty-plus")) {
                                                                    ele = $(this).next();
                                                                } else {
                                                                    ele = $(this).prev();
                                                                }

                                                                $.ajax({
                                                                    url: '{{ route('update.cart') }}',
                                                                    method: "patch",
                                                                    data: {
                                                                        _token: '{{ csrf_token() }}',
                                                                        id: ele.data('id'),
                                                                        quantity: ele.val()
                                                                    },
                                                                    success: function(response) {
                                                                        if (response.status === 'success') {
                                                                            window.location.reload();
                                                                        } else {
                                                                            alert('There was an error updating the cart.');
                                                                        }
                                                                    },
                                                                    error: function() {
                                                                        alert('There was an error updating the cart.');
                                                                    }
                                                                });
                                                            });

                                                            $(".update-cart").change(function(e) {
                                                                e.preventDefault(); // Prevent default action

                                                                var ele = $(this);

                                                                $.ajax({
                                                                    url: '{{ route('update.cart') }}',
                                                                    method: "patch",
                                                                    data: {
                                                                        _token: '{{ csrf_token() }}',
                                                                        id: ele.data('id'),
                                                                        quantity: ele.val()
                                                                    },
                                                                    success: function(response) {
                                                                        if (response.status === 'success') {
                                                                            window.location.reload();
                                                                        } else {
                                                                            alert('There was an error updating the cart.');
                                                                        }
                                                                    },
                                                                    error: function() {
                                                                        alert('There was an error updating the cart.');
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>
                                                @else
                                                    <div
                                                        class="text-center row align-items-center justify-content-center position-relative mb-3">
                                                        <span class="btn-holder">
                                                            <a href="{{ route('add.to.cart', $sub['product_auto_id']) }}"
                                                                class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white"
                                                                role="button"
                                                                style="font-size: 13px;background: #fd7f34;border: #fd7f34;float:left;">Add
                                                                to cart</a>
                                                        </span>

                                                    </div>
                                                @endif
                                            @else
                                                <div
                                                    class="text-center row align-items-center justify-content-center position-relative mb-3">
                                                    <span class="btn-holder">
                                                        <a href="{{ route('add.to.cart', $sub['product_auto_id']) }}"
                                                            class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white"
                                                            role="button"
                                                            style="font-size: 13px; background: #fd7f34; border: #fd7f34;">Add
                                                            to cart</a>
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="col-5">

                                    <a href="{{ url('product-detail', $sub['product_auto_id']) }}">
                                        <img id="category_img" class="my-4"
                                            src="{{ asset('images/products_images/' . $sub['product_images']) }}"
                                            style="height:80px;width:80px;">
                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>

                    @if ($i % 2 == 1)
                        <div class="col-md-1 col-sm-12 product-mobile"></div>
                    @endif

                    @php $i++; @endphp
                    <?php }?>


                </div>
            </div>

        </div>

        <?php }?>

        </div>
        <?php }?>
        <?php if($v['component_type']=="Recommended P"){?>

        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <br />
                    <h5 style="font-size: 2rem;line-height: 32px;"><?php echo $v['title']; ?></h5>
                </div>

            </div>


            <?php if($v['layout_type']==0){?>




            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($v['content'] As $sub)
                                        {?>
                    <div class="item" style="padding:15px;width:100%">
                        <div>

                            <a href="{{ url('product-detail', $sub['product_auto_id']) }}">
                                <img id="category_img" src="./images/products_images/<?php echo $sub['product_images']; ?>"
                                    style="height:200px;">
                            </a><br />
                            <div class="rounded bg-white discount" id="orange"
                                style="background:rgba(255,63,108,.8);margin-bottom: 3%;text-align:center;font-size:12px;">
                                @if ($sub['offer_percentage'] != 0)
                                    <small class="text-muted "
                                        style="text-decoration: line-through;">{{ $sub['currency'] }}
                                        {{ $sub['product_price'] }}</small>
                                @endif
                                <span
                                    class="font-weight-bold">{{ $sub['currency'] }}{{ number_format($sub['final_product_price']) }}</span>
                            </div>

                            <h6 style="text-align:center;">{{ $sub['product_name'] }} </h6>
                        </div>
                        <div class="card-body" style="padding:5px;">
                            @if ($sub['offer_percentage'] != 0)
                                <div class="abc bg-success">{{ $sub['offer_percentage'] }}% off</div>
                            @endif


                        </div>


                    </div>




                    <?php }?>


                </div>

            </div>


            <?php }?>



            <!--Double Strip Sliding-->
            <?php if($v['layout_type']==1){?>




            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($v['content'] As $sub)
                                        {?>
                    <div class="item" style="padding:15px;width:100%">
                        <div>

                            <a href="{{ url('product-detail', $sub['product_auto_id']) }}">
                                <img id="category_img" src="./images/products_images/<?php echo $sub['product_images']; ?>"
                                    style="height:200px;">
                            </a><br />
                            <div class="rounded bg-white discount" id="orange"
                                style="background:rgba(255,63,108,.8);margin-bottom: 3%;text-align:center;font-size:12px;">
                                @if ($sub['offer_percentage'] != 0)
                                    <small class="text-muted "
                                        style="text-decoration: line-through;">{{ $sub['currency'] }}
                                        {{ $sub['product_price'] }}</small>
                                @endif
                                <span
                                    class="font-weight-bold">{{ $sub['currency'] }}{{ number_format($sub['final_product_price']) }}</span>
                            </div>

                            <h6 style="text-align:center;">{{ $sub['product_name'] }} </h6>
                        </div>
                        <div class="card-body" style="padding:5px;">
                            @if ($sub['offer_percentage'] != 0)
                                <div class="abc bg-success">{{ $sub['offer_percentage'] }}% off</div>
                            @endif


                        </div>

                    </div>
                    <?php }?>


                </div>

            </div>

            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach($v['content'] As $sub)
                                        {?>
                    <div class="item" style="padding:15px;width:100%">
                        <div>

                            <a href="{{ url('product-detail', $sub['product_auto_id']) }}">
                                <img id="category_img" src="./images/products_images/<?php echo $sub['product_images']; ?>"
                                    style="height:200px;">
                            </a><br />
                            <div class="rounded bg-white discount" id="orange"
                                style="background:rgba(255,63,108,.8);margin-bottom: 3%;text-align:center;font-size:12px;">
                                @if ($sub['offer_percentage'] != 0)
                                    <small class="text-muted "
                                        style="text-decoration: line-through;">{{ $sub['currency'] }}
                                        {{ $sub['product_price'] }}</small>
                                @endif
                                <span
                                    class="font-weight-bold">{{ $sub['currency'] }}{{ number_format($sub['final_product_price']) }}</span>
                            </div>

                            <h6 style="text-align:center;">{{ $sub['product_name'] }} </h6>
                        </div>
                        <div class="card-body" style="padding:5px;">
                            @if ($sub['offer_percentage'] != 0)
                                <div class="abc bg-success">{{ $sub['offer_percentage'] }}% off</div>
                            @endif
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php }?>
        </div>
        <?php }?>
        </div> <!--container-fluid-->
        <?php } ?>
        <!--Forach end-->
        </div>
    </section>
@endsection
