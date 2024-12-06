@extends('templates.SuperAdmin.admin_header')
@section('content')
<!--Text Editor-->

<script src="{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/sample.js')}}"></script>
<link href="{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/sample.css')}}" rel="stylesheet"/>
<div class="container">
    {!! Form::open(['method' => 'POST', 'url' => 'ecommerce_admin_add_product', 'enctype' => 'multipart/form-data']) !!}
     <div class="row">
           

                        <div class="col-md-12">
                           
                                <br/>
                                <center><h3><b>Add Products</b></h3></center>
                               
                                </div>
                                
                                <div class="col-md-4">
                                   
                                         <div class="form-group">
                <label>Product Name</label>
               <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" required/>
           </div>
                                    
               
           </div>
     
            <div class="col-md-4">
                                    
                                         <div class="form-group">
                <label>Brand Name</label>
               <select name="brand_name" class="form-control" required>
                    <option value="none" class="form-control" selected>Select Brand </option>
                   @foreach($brands As $b)
                   <option value={{$b->_id}} class="form-control">{{$b->brand_name}} </option>
                   @endforeach
               </select>
           </div>
                                    
               
           </div>
                     <div class="col-md-4">
                                    
                                         <div class="form-group">
                <label>Product Unit</label>
               <select name="product_unit" class="form-control" required>
                    <option value="none" class="form-control" selected>Select Unit </option>
                   <option value="kg" class="form-control" selected>Kg</option>
               </select>
           </div>
                                    
               
           </div>
            <div class="col-md-4">
                                    
                                         <div class="form-group">
                <label>Product Gross Weight</label>
               <input type="text" class="form-control" name="product_gross_weight" placeholder="Enter Product Gross Weight" required/>
           </div>
                                    
               
           </div>
            <div class="col-md-4">
                                    
                                         <div class="form-group">
                <label>Product Net Weight</label>
               <input type="text" class="form-control" name="product_net_weight" placeholder="Enter Product Net Weight" required/>
           </div>
                                    
               
           </div>
            <div class="col-md-4">
                                   
                                         <div class="form-group">
                <label>Product Quantity</label>
               <input type="text" class="form-control" name="product_quantity" placeholder="Enter Product Quantity" required/>
           </div>
                                    
               
           </div>
           <div class="col-md-4">
                                    
                                         <div class="form-group">
                <label>Product Actual Price</label>
               <input type="text" class="form-control" name="product_actual_price" placeholder="Enter the Product Price" required/>
           </div>
                                    
               
           </div>
            <div class="col-md-4">
                                   
                                         <div class="form-group">
                <label>Product Offer(%)</label>
               <input type="text" class="form-control" name="product_offer_price" placeholder="Enter the Product Offer(%)" required/>
           </div>
                                    
               
           </div>
              <div class="col-md-4">
                                   
                                         <div class="form-group">
                <label>Minimun Order Quantity(MOQ)</label>
               <input type="text" class="form-control" name="product_moq" placeholder="Enter the MOQ" required/>
           </div>
                                    
               
           </div>
              <div class="col-md-4">
                                   
                                         <div class="form-group">
                <label>Maximun Order Price(MOP)</label>
               <input type="text" class="form-control" name="product_maxop" placeholder="Enter the MOP" required/>
           </div>
                                    
               
           </div>
            <div class="col-md-4">
                                   
                                         
              <label>Select size</label>
              <div class="form-group">
              <select name="product_size" class="form-control" required>
                  <option value="none">Select Size</option>
                   <option value="5">5</option>
                   <option value="5">6</option>
                   <option value="5">7</option>
                   <option value="5">8</option>
                   <option value="5">8</option>
                   <option value="5">8</option>
              </select>
           </div>
                                    
               
           </div>
              <div class="col-md-4">
                                   
                                         <div class="form-group">
                <label>Manage Stock</label>
               <input type="text" class="form-control" name="product_manage_stock" placeholder="Enter Product Barcode" required/>
           </div>
                                    
               
           </div>
           <div class="col-md-12">
                 <br/>
               <hr/>
                <center> <label>Select Color</label></center>
                       <div class="container"  style="border:1px solid rgba(0,0,0,.15);border-radius:5px;">
                           
                          <div class="row">
              
                                           
                                             <div class="form-group">
                    <div class="upload__box">
  <div class="upload__btn-box">
     
          <label class="upload__btn">
      <p>Upload Available Colours</p>
         <input type="file" name="colourimage[]" class="upload__inputfile" multiple="" required>
      <!--<input type="file" multiple="" data-max_length="20" class="upload__inputfile">-->
    </label>
    
      
    
  </div>
  <div class="upload__img-wrap"></div>
</div>
               </div>
                
             
           </div>  
                       </div>
                          
           </div>
           <div class="col-md-12">
               <br/>
               <hr/>
                <center><label>Select Product Image</label></center>
                       <div class="container"  style="border:1px solid rgba(0,0,0,.15);border-radius:5px;">
                           
                          <div class="row">
              
                                           
                                             <div class="form-group">
                    <div class="upload__box">
  <div class="upload__btn-box">
     
          <label class="upload__btn">
      <p>Upload Product Images</p>
        <input type="file" name="cimage[]" class="upload__productinputfile" multiple="" required>
      <!--<input type="file" multiple="" data-max_length="20" class="upload__productinputfile">-->
    </label>
    
      
    
  </div>
  <div class="upload__img-wrap"></div>
</div>
               </div>
                
             
           </div> 
           <div class="container">
               <div class="row">
                  
                    <div class="col-md-6">
                       Select 1 product Video
          <input type="file" name="product_video" required/>
             <br/><br/>  
                   </div>
               </div>
            
           </div>
                       </div>
                        
           </div>
          
             
            
<!--                <div class="col-md-4">-->
<!--                    <div class="filter_field_wrapper">-->
<!--                        <div class="dropdown">-->
              
<!--  <button style="border: 1px solid #dee2e6;width:100%;" class="btn btn-default dropdown-toggle" type="button" -->
<!--          id="dropdownMenu1" data-toggle="dropdown" -->
<!--          aria-haspopup="true" aria-expanded="true">-->
<!--    Add Filters-->
<!--  </button>-->
  
<!--  <ul class="dropdown-menu checkbox-menu" aria-labelledby="dropdownMenu1">-->
     
<!--  <input type="text" name="filter_name" placeholder="Enter Filter Name" required/>-->
<!--  <div class="container add_columns_div">-->
       
<!--                        Manage/Add Columns-->
<!--                    <br/>-->
<!--                  <div class="field_wrapper">-->
<!--    <div>-->
<!--       <input type="text" name="column_name[]"  value="" required/>-->
<!--        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a><br/>-->
        
<!--    </div>-->
   
<!--</div><br/> -->
 <!--<button type="submit" class="btn btn-sm btn-danger btn_add_columns">Add Options</button>-->
          
<!--  </div>-->
<!--    <li>-->
      
<!--        <input type="checkbox" name="mycolumn[]" value="Order">Top Type-->
      
<!--    </li>-->
    
    
<!--  </ul>-->
<!--</div>-->
<!--                        </div>-->
<!--                </div>-->
                
        
               

                                    
               
          
               
            <div class="col-md-12">
               <hr/>
           </div>
                 
                  
                      <div class="col-md-12">
                                   
                            <label for="vat" class=" form-control-label">Product Specifications</label> 
                            <textarea id="highlight_col1" name="highlight_col1" placeholder="" class="ckeditor form-control" value="" required></textarea>
                            <small class="text-danger">{{ $errors->first('highlight_col1') }}</small>
                                        
                    </div>
                  
                 <div class="col-md-12">
                                   
                        <label for="vat" class=" form-control-label">Product Highlights</label> 
                        <textarea id="highlight_col2" name="highlight_col2" placeholder="" class="ckeditor form-control" value=""  required></textarea>
                        <small class="text-danger">{{ $errors->first('highlight_col2') }}</small>
                                        
                </div>
                
                                    
             <div class="col-md-12">
               <hr/>
               <center>Product Description</center>
           </div>
           
            <div class="col-md-12">
                                   
                                         
           
                                               
                                                <textarea id="pdesc" name="pdesc" placeholder="" class="ckeditor form-control" value="" required></textarea>
                                                <small class="text-danger">{{ $errors->first('pdesc') }}</small>               
               
           </div>
           
                
          <div class="col-md-12">
              <input type="submit" class="btn btn-md btn-danger pull-right" value="Add Product">
          </div>

           
   </div>
                                
</div>

   </form> 
   
    </div>
<br/><br/>
<script type="text/javascript">
//<![CDATA[
 
    
    CKEDITOR.replace( 'highlight_col1',
    {
        filebrowserBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserImageBrowseUrl : "js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserFlashBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserUploadUrl  :"{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File')}}",
        filebrowserImageUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image')}}",
        filebrowserFlashUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash')}}"
    });

    CKEDITOR.replace( 'highlight_col2',
    {
        filebrowserBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserImageBrowseUrl : "js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserFlashBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserUploadUrl  :"{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File')}}",
        filebrowserImageUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image')}}",
        filebrowserFlashUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash')}}"
    });

    CKEDITOR.replace( 'pdesc',
    {
        filebrowserBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserImageBrowseUrl : "js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserFlashBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
        filebrowserUploadUrl  :"{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File')}}",
        filebrowserImageUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image')}}",
        filebrowserFlashUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash')}}"
    });
    

//]]>
</script>
<script type="text/javascript">
   
        
        
        $(document).ready(function(){
            
    //Add Filters Box
   var maxField = 10; //Input fields increment limitation
    var addfilterButton = $('.add_filter_button'); //Add button selector
    var wrapper = $('.filter_field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="dropdown"><button style="border: 1px solid #dee2e6;width:100%;" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Add Filters</button><ul class="dropdown-menu checkbox-menu" aria-labelledby="dropdownMenu1"><input type="text" name="filter_name" placeholder="Enter Filter Name"/><div class="container add_columns_div">Manage/Add Columns<br/><div class="field_wrapper"><div><input type="text" name="column_name[]"  value=""/><a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a><br/></div></div><br/><button type="submit" class="btn btn-sm btn-danger btn_add_columns">Add Options</button></div><li><input type="checkbox" name="mycolumn[]" value="Order">Top Type</li></ul></div><a href="javascript:void(0);" class="remove_filter_button"><i class="fa fa-minus"></i></a>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addfilterButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_filter_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
   
    
        });
        
         
        
</script>

@endsection