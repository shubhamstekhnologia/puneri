@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif

@if($allterms->isNotEmpty())

    @foreach($allterms as $terms)

        @php 
        $contact_india = $terms->contact_india;
        $contact_us = $terms->contact_us;
        $email = $terms->email;
        $address = $terms->address;
        $message = $terms->message;
       $id = $terms->id; 
        @endphp

    @endforeach

@else

    @php 
    $contact_india = "";
    $contact_us = "";
    $email = "";
    $address = "";
    $message = "";
    $id = 0; 
     @endphp

@endif
<script src="{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/ckeditor.js')}}"></script>

<script src="{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/sample.js')}}"></script>

<link href="{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/sample.css')}}" rel="stylesheet"/>

@extends('templates.SuperAdmin.layout')

@section('content')

<div class="content mt-3">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <strong class="card-title">Ecommerce Contact Details</strong>

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Update Contact Details</strong></div>

                                <div class="card-body card-block"> 

                                    @include('templates.SuperAdmin.messages')

                                    {!! Form::open(['method' => 'POST', 'url' => 'update-contact-details', 'enctype' => 'multipart/form-data']) !!}

                                        @csrf

                                        <input type="hidden" name="id" value="{{$id}}">

                                       <div class="form-group col-md-4">

                                            <label class="form-control-label">India Contact</label>

                                            <input type="tel" id="contact_india" name="contact_india" placeholder="" class="form-control" value="{{$contact_india}}">

                                        </div>
                                         <div class="form-group col-md-4">

                                            <label class="form-control-label">USA Contact</label>

                                            <input type="tel" id="contact_us" name="contact_us" placeholder="" class="form-control" value="{{$contact_us}}">

                                        </div>
                                          <div class="form-group col-md-4">

                                            <label class="form-control-label">Email ID</label>

                                            <input type="email" id="email" name="email" placeholder="" class="form-control" value="{{$email}}">

                                        </div>

                                      

                                        <div class="form-group col-md-12">

                                           <label for="vat" class="form-control-label">Address</label>

                                         
                                          <textarea cols="80" id="address" name="address" rows="10" class="form-control" >{{$address}}</textarea>


                                           <small class="text-danger">{{ $errors->first('address') }}</small>

                                       </div>
                                        <div class="form-group col-md-12">

                                           <label for="vat" class="form-control-label">Message</label>

                                         
                                          <textarea cols="80" id="message" name="message" rows="10" class="form-control" >{{$message}}</textarea>


                                           <small class="text-danger">{{ $errors->first('message') }}</small>

                                       </div>



                                        <div class="card-footer col-md-12">  

                                            <button type="submit" class="btn btn-success btn-sm">

                                                <i class="fa fa-dot-circle-o"></i> Submit

                                            </button>

                                                        

                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('contact-details')}}">Cancel</a></button> 

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>                                          
 <script>
//<![CDATA[

   // This call can be placed at any point after the
   // <textarea>, or inside a <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><script> in a
   // window.onload event handler.

   // Replace the <textarea id="editor"> with an CKEditor
   // instance, using default configurations.
   CKEDITOR.replace( 'term',
   {
       filebrowserBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
       filebrowserImageBrowseUrl : "js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
       filebrowserFlashBrowseUrl :"js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector={{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/connector.php')}}",
       filebrowserUploadUrl  :"{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File')}}",
       filebrowserImageUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image')}}",
       filebrowserFlashUploadUrl : "{{asset('templates-assets/OrganicSuperAdminWeb/ckeditor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash')}}"
   });      
</script>                   
@endsection