<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.container-fluid{
  padding: 10px
}
h3, h4{
  display: inline-block
}
.category-list, .subcategory-list{
  margin-bottom: 10px;
}
.category-list-body{
 padding-left: 30px 
}
</style>
@extends('templates.frontend.header')
@section('content')


    
        
   <div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="category-container">
        <div class="category-head">
          Category
        </div>
        <div class="category-body">
          <button type="button" class="btn btn-outline-primary add-category">
        Add New Category Filter</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="category-element" style="display: none">
  <div class="category-add-element">
    <div class="form-group">
      <input type="text" name="category" class="form-control" placeholder="Enter Category">
    </div>
    <button type="button" class="btn btn-outline-success btn-sm save-add-category">Save</button>
    <button type="button" class="btn btn-outline-secondary btn-sm cancel-add-category">Cancel</button>
  </div>
  <div class="category-edit-element">
    <div class="form-group">
      <input type="text" name="category" class="form-control" placeholder="Enter Category">
    </div>
    <button type="button" class="btn btn-outline-success btn-sm save-edit-category">Save</button>
    <button type="button" class="btn btn-outline-secondary btn-sm cancel-edit-category">Cancel</button>
     <button type="button" class="btn btn-outline-danger btn-sm delete-category" style="float: right">Delete</button>
  </div>
  <div class="category-result-element">
    <div class="category-list-title">
      <h3></h3>
      <button type="button" class="btn btn-success btn-sm edit-category">Edit</button>
      <br>
    </div>
    <div class="category-list-body">
      <button type="button" class="btn btn-link add-subcategory">+ Add Sub Category</button>
    </div>
  </div>
</div>

<div class="subcategory-element" style="display: none">
  <div class="subcategory-add-element">
    <div class="form-group">
      <input type="text" name="subcategory" class="form-control" placeholder="Enter Category">
    </div>
    <button type="button" class="btn btn-outline-success btn-sm save-add-subcategory">Save</button>
    <button type="button" class="btn btn-outline-secondary btn-sm cancel-add-subcategory">Cancel</button>
  </div>
  <div class="subcategory-edit-element">
    <div class="form-group">
      <input type="text" name="subcategory" class="form-control" placeholder="Enter Category">
    </div>
    <button type="button" class="btn btn-outline-success btn-sm save-edit-subcategory">Save</button>
    <button type="button" class="btn btn-outline-secondary btn-sm cancel-edit-subcategory">Cancel</button>
     <button type="button" class="btn btn-outline-danger btn-sm delete-subcategory" style="float: right">Delete</button>
  </div>
  <div class="subcategory-result-element">
    <div class="subcategory-list-title">
      <em></em>
      <button type="button" class="btn btn-success btn-sm edit-subcategory">Edit</button>
    </div>
  </div>
</div>
</section>
<div class="clearfix"></div>
<script>
   // add category start
$('.add-category').on('click', function(){
  var $e = $(this);
  var $categoryBody = $('.category-body');
  var $categoryElement = $('.category-element .category-add-element');
  
  $('<div class="category-list"></div>').insertBefore($e);
  $categoryElement.clone().appendTo($categoryBody.find('.category-list:last'));
});

$(document).on('click', '.cancel-add-category', function(){
  var $e = $(this);
  $e.closest('.category-add-element').remove();
});

$(document).on('click', '.save-add-category', function(){
  var $e = $(this);
  var $closeAdd = $e.siblings('.cancel-add-category');
  var $val = $e.closest('.category-add-element').find('input').val();
  var $categoryList = $e.closest('.category-list');
  var $categoryElement = $('.category-element .category-result-element');
  $categoryElement.clone().appendTo($categoryList);
  $e.closest('.category-list').find('.category-list-title h3').text($val)
  $closeAdd.trigger('click');
});
// add category end

// edit category start
$(document).on('click', '.edit-category', function(){
  var $e = $(this);
  var $categoryElement = $('.category-element .category-edit-element');
  var $categoryList = $e.closest('.category-list');
  var $categoryName = $e.siblings('h3').text();

  $categoryElement.clone().appendTo($categoryList);
  $categoryList.find('.category-edit-element input').val($categoryName).focus();
  $e.closest('.category-result-element').hide();
  
});

$(document).on('click', '.save-edit-category', function(){
  var $e = $(this);
  var $closeEdit = $e.siblings('.cancel-edit-category');
  var $val = $e.closest('.category-edit-element').find('input').val();
  var $categoryList = $e.closest('.category-list');
  var $categoryElement = $('.category-element .category-result-element');
  $e.closest('.category-list').find('.category-list-title h3').text($val)
  $closeEdit.trigger('click');
});

$(document).on('click', '.cancel-edit-category', function(){
  var $e = $(this);
  var $categoryList = $e.closest('.category-list');
  $e.closest('.category-edit-element').remove();
  $categoryList.find('.category-result-element').show();
});
// edit category end

// delete category start
$(document).on('click', '.delete-category', function(){
  var $e = $(this);
  var $categoryList = $e.closest('.category-list');
  var $closeEdit = $categoryList.find('.cancel-edit-category');
  var $subLength = $categoryList.find('.category-list-body .subcategory-list').length
  if($subLength != 0){
   alert('gak boleh dihapus') 
  } else{
    $closeEdit.trigger('click');
    $categoryList.slideUp(function(){
      $(this).remove();
    });
  }
});
// delete category end





// add sub category start
$(document).on('click', '.add-subcategory', function(){
  var $e = $(this);
  var $categoryListBody = $e.closest('.category-list').find('.category-list-body');
  var $categoryElement = $('.subcategory-element .subcategory-add-element');
  
  $('<div class="subcategory-list"></div>').insertBefore($e);
  $categoryElement.clone().appendTo($categoryListBody.find('.subcategory-list:last'));
});

$(document).on('click', '.cancel-add-subcategory', function(){
  var $e = $(this);
  $e.closest('.subcategory-add-element').remove();
});

$(document).on('click', '.save-add-subcategory', function(){
  var $e = $(this);
  var $closeAdd = $e.siblings('.cancel-add-subcategory');
  var $val = $e.closest('.subcategory-add-element').find('input').val();
  var $subcategoryList = $e.closest('.subcategory-list');
  var $subcategoryElement = $('.subcategory-element .subcategory-result-element');
  $subcategoryElement.clone().appendTo($subcategoryList);
  $e.closest('.subcategory-list').find('.subcategory-list-title em').text($val)
  $closeAdd.trigger('click');
});
// add sub category end

// edit sub category start
$(document).on('click', '.edit-subcategory', function(){
  var $e = $(this);
  var $subcategoryElement = $('.subcategory-element .subcategory-edit-element');
  var $subcategoryList = $e.closest('.subcategory-list');
  var $subcategoryName = $e.siblings('em').text();

  $subcategoryElement.clone().appendTo($subcategoryList);
  $subcategoryList.find('.subcategory-edit-element input').val($subcategoryName).focus();
  $e.closest('.subcategory-result-element').hide();
  
});

$(document).on('click', '.save-edit-subcategory', function(){
  var $e = $(this);
  var $closeEdit = $e.siblings('.cancel-edit-subcategory');
  var $val = $e.closest('.subcategory-edit-element').find('input').val();
  var $subcategoryList = $e.closest('.subcategory-list');
  var $subcategoryElement = $('.subcategory-element .subcategory-result-element');
  $e.closest('.subcategory-list').find('.subcategory-list-title em').text($val)
  $closeEdit.trigger('click');
});

$(document).on('click', '.cancel-edit-subcategory', function(){
  var $e = $(this);
  var $subcategoryList = $e.closest('.subcategory-list');
  $e.closest('.subcategory-edit-element').remove();
  $subcategoryList.find('.subcategory-result-element').show();
});
// edit sub category end

// delete sub category start
$(document).on('click', '.delete-subcategory', function(){
  var $e = $(this);
  var $subcategoryList = $e.closest('.subcategory-list');
  var $closeEdit = $subcategoryList.find('.cancel-edit-subcategory');
  
  $closeEdit.trigger('click');
  $subcategoryList.slideUp(function(){
    $(this).remove();
  })
});
// delete sub category end

</script>

  

@endsection