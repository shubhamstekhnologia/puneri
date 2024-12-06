     
    <div class="container">
        
        <div class="row">
           
              @if(!empty($product_lists))
              @php  @endphp
              @php $myproducts = array();  @endphp
                  @php $i = 0 @endphp
                  @php $has_price_ids = array(); @endphp
                  @foreach($product_lists as $products)
                  @foreach($price_lists as $cprice)
                  @if($products->_id == $cprice->product_auto_id)
                  @php array_push($has_price_ids, $products->_id); @endphp
                  @endif
                  @endforeach
                  @endforeach
                  
                  @foreach($product_lists as $products)
                  @if (!in_array($products->_id, $has_price_ids))
                  @php continue; @endphp
                  @endif
                 @php $myproduct = collect($products); @endphp
                 @php $wished = 0; @endphp
                  @php $i++; @endphp
            <div class="filter_data product_container col-lg-4 col-md-4 col-sm-6 offset-md-0 offset-sm-1" >
                <div class="card" style="padding:5px;"> <a href="{{url('product-detail',$products['_id'])}}">
                      @if($pimages_lists->isNotEmpty())
                               <div class="carousel-wrap">
                                      <div class="owl-carousel">
                                      @foreach($pimages_lists as $wholesalers)

                                        @if($products->_id == $wholesalers->product_auto_id)
                                       @if(isset($search))
                                       
                                       
                                            <div class="item"><img class="mx-auto" src="{{asset('images/products_images/'.$wholesalers['image_file'])}}" style="height:250px;"></div>
                                      @else
                                                                                  <div class="item"><img src="{{asset('images/products_images/'.$wholesalers['image_file'])}}" class="img-fluid mx-auto"style="height:250px;" ></div>
                                                                                  @endif
                                        @endif

                                      @endforeach
                                     </div>
                                    </div>
   
   
 
                                    @endif
                    </a>
                    <div class="card-body" style="padding:5px;">
                        @if($products["new_arrival"] == "Yes")
                        <div class="abc">NEW ARRIVAL</div>
                        @endif
                        
                          @if (Session::has('AccessTokens') !='')
                            
                     
                            {!! Form::open(['method' => 'POST', 'url' => 'wishlist', 'enctype' => 'multipart/form-data']) !!}

                             <input name="user_auto_id" type="hidden" value="{{$value}}" />                           
                             <input name="product_auto_id" type="hidden" value="{{$products["_id"]}}" />
                                @foreach($wproducts as $wproduct)
                               @if($wproduct['product_auto_id'] == $products->id)
                               @php $wished = 1; @endphp
                               @endif
                               @endforeach
                              
                               @if ($wished ==1)
                                <button type="submit" class="btn btn-info" style="float: right;padding: 3px;color:maroon;"><i class="fa fa-light fa-heart" ></i></button>
                                   @else
                            <button type="submit" class="btn btn-info" style="float: right;padding: 3px;"><i class="fa fa-light fa-heart" ></i></button>
                                  @endif
                              
                                
                            </form>
                         
                        @else
                            <button onclick="show_login();" type="submit" class="btn btn-info" style="float: right;padding: 3px;"><i class="fa fa-light fa-heart" ></i></button>

                        @endif
                     
                           @if($price_lists->isNotEmpty())
                             @foreach($price_lists as $cprice)
                              @if($products->_id == $cprice->product_auto_id)
                              @php $myproduct->put('final_price',$cprice["final_price"]);
                              array_push($myproducts, $myproduct->all())
                              @endphp
                        <div class="d-flex justify-content-center my-2">
                         
                        <h6 class="price" style="font-size: 12px;margin-left: 8%;">
                            <b style="font-size:16px;"> {{$cprice["currency"]}}{{number_format($cprice["final_price"])}}</b>
                             @if($cprice["offer_percentage"] != "0")
                            <del style="text-decoration: line-through;">{{$cprice["currency"]}} {{$cprice["product_price"]}}</del>
                            <h6 style="color:#ff905a;font-size: 12px;">&nbsp({{$cprice["offer_percentage"]}}% OFF)</h6>
                                 @endif
                            </h6><br/>
                            
                             
                        </div> 
                         @endif
                            @endforeach
                              @endif
                              <h5 style="text-align:center;text-overflow: ellipsis;white-space: nowrap;width: 100%;overflow: hidden;font-weight:600">{{$products["product_name"]}} </h5>

                               @if (Session::has('AccessTokens') !='')
                            
                     
                            <!--{!! Form::open(['method' => 'POST', 'url' => 'buy_now', 'enctype' => 'multipart/form-data']) !!}-->

                            <!-- <input name="user_auto_id" type="hidden" value="{{$value}}" />                           -->
                            <!-- <input name="product_auto_id" type="hidden" value="{{$products["_id"]}}" />-->
                            <!-- <input name="cart_quantity" type="hidden" value="1" />-->
                          
                            <!--<button type="submit" class="btn btn-sm btn-danger" style="color:white;font-size:13px;background:purple;border:purple;">Buy Now</button>-->
                           

                            <!--</form>-->
                            <p class="btn-holder"><a href="{{ url(Session('main').'/buy_now', $products->id) }}" class="btn btn-sm btn-danger" role="button" style="color:white;font-size:13px;background:purple;border:purple;margin-left: 21%;float: left;margin-right: 10px;">Buy Now</a> </p>

                        @else
                            <button onclick="show_login()" type="submit" class="btn btn-sm btn-danger" style="color:white;font-size:13px;background:purple;border:purple;margin-left: 21%;float: left;margin-right: 10px;">Buy Now</button>
                            

                        @endif
                      
                          @if (Session::has('AccessTokens') !='')
                          @if(Session('cart'))
                          @php $in_cart = false; @endphp
                          @foreach(Session('cart') as $id =>$prod)
                          @if($id == $products->id)
                          @php $in_cart = true; @endphp
                          @endif
                          @endforeach
                          @if ($in_cart)
                        <p class="btn-holder"><button data-toggle="tooltip" data-placement="bottom" title="Product added to cart, go to cart to add more quantity" class="btn btn-sm btn-secondary add_to_cart_btn2 text-center text-white" role="button" style="font-size: 13px;float:left;">Added to cart</button> </p>
                        @else
                         <p class="btn-holder">
                             <a href="{{ route('add.to.cart', $products->id) }}" data-product="{{$products->id}}" data-size='{{ $products["size"]}}' class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white" role="button" style="font-size: 13px;background: #fd7f34;border: #fd7f34;float:left;">Add to cart</a> 
                             <div class="size-popup shadow" id="modal-{{$products->id}}">
                                 <h3 class="p-3">Select product size</h3>
                                 <div class="position-relative">
                                     <span class="position-absolute close-size fa fa-times" data-target-id="modal-{{$products->id}}"></span>
                                 </div>
                                   <div class="row container p-4">
                                      @if(!empty($get_slists))
                                      @php $sizes = array(); @endphp
                                      @if($products["size"] != "")
                                      @php $prod_size = explode("|",$products["size"]) @endphp
                                      @foreach($get_slists as $sizelist)
                                      @foreach($prod_size as $size_id)
                                      @if($sizelist["_id"] == $size_id)
                                      @php array_push($sizes, array("size"=>$sizelist["size"], "id"=>$sizelist["_id"])) @endphp
                                      @endif
                                      @endforeach
                                      @endforeach
                                      
                                      @foreach($sizes as $size)
                                      <div class="col-md-4 col-lg-4 col-sm-6 select_size" onclick="select_price(this.id, '{{$size['id']}}')" id="size-{{$size['id']}}-{{$products->id}}" 
                                      data-size="{{$size['id']}}" data-route="{{route('add.to.cart', $products->id.'&'.$size['size'])}}" style="border: 1px solid;padding: 5px;margin: 5px; max-height:50px">
                                          <span  class="select_size_span">{{$size["size"]}}&nbsp;</span>
                                      </div>

                                      @endforeach
                                       @endif
                                       @endif
                                     </div>
                             </div>
                             </p>
                         @endif
                         @else 
                          <p class="btn-holder"><a href="{{ route('add.to.cart', $products->id) }}" data-product="{{$products->id}}" data-size='{{ $products["size"]}}' class="btn btn-sm btn-warning add_to_cart_btn2 text-center text-white" role="button" style="font-size: 13px;background: #fd7f34;border: #fd7f34;float:left; color:white">Add to cart</a> </p>
                         
                        @endif
                         @else
                     
                    <button onclick="show_login()" type="submit" class="btn btn-sm btn-warning text-center" style="font-size: 13px;background: #fd7f34;border: #fd7f34;float:left; text-white">Add to cart</button>
                    
                        @endif

<!-- Modal -->

<div class="modal lab-slide-bottom-popup"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select Product size</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body lab-modal-body">
          <div class="row">
                                      @if(!empty($get_slists))
                                      @php $sizes = array(); @endphp
                                      @if($products["size"] != "")
                                      @php $prod_size = explode("|",$products["size"]) @endphp
                                      @foreach($get_slists as $sizelist)
                                      @foreach($prod_size as $size_id)
                                      @if($sizelist["_id"] == $size_id)
                                      @php array_push($sizes, array("size"=>$sizelist["size"], "id"=>$sizelist["_id"])) @endphp
                                      @endif
                                      @endforeach
                                      @endforeach
                                      
                                      @foreach($sizes as $size)
                                      <div class="col-md-2 col-lg-2 col-sm-6 select_size" onclick="select_price(this.id, '{{$size['id']}}')" id="size-{{$size['id']}}-{{$products->id}}" data-size="{{$size['id']}}" data-route="{{route('add.to.cart', $products->id.'&'.$size['size'])}}" style="border: 1px solid;
    padding: 5px;margin: 5px;">
                                          <span  class="select_size_span">{{$size["size"]}}&nbsp;</span>
                                      </div>

                                      @endforeach
                                       @endif
                                       @endif
                                     </div>
      </div>

    </div>
  </div>
</div>
                        
                    </div>
                    
                </div>
            </div>
              @endforeach
          @else
          
            <h4 class="box-title" style="font-size: 14px;text-align:center;color:red">Not Available any data</h4>
          @endif  
      
        </div>
    </div>