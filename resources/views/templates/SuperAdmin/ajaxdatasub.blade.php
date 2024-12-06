
<!-- subcategory -->
@if(!empty($sub_cat_data))
	 <option value="" selected disabled>Select subcategory</option>
@foreach($sub_cat_data as $sub_cat_data)
<option value="{{$sub_cat_data->psid}}">{{$sub_cat_data->sub_category_ename}}({{$sub_cat_data->sub_category_mname}})</option>
@endforeach 
 @endif 
 
 
 
<!-- edit subcategory -->
<!--@if(!empty($edit_sub_cat_data))-->
<!--	 <option value="" selected disabled>Select subcategory</option>-->
<!--@foreach($edit_sub_cat_data as $sub_cat_data)-->


<!--<option value="{{$sub_cat_data->psid}}" <?php if($sub_cat_data->psid == $products->psid){?> selected <?php } ?>>{{$sub_cat_data->sub_category_ename}}({{$sub_cat_data->sub_category_mname}})</option>-->
<!--@endforeach -->
<!-- @endif -->