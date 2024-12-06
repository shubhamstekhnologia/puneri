@if (Session::has('AccessToken'))
   <?php $value = Session::get('AccessToken') ?>
@else
    <script>window.location.href = "SuperAdmin";</script>
@endif
@if($refunds->isNotEmpty())

    @foreach($refunds as $rfnd)

        @php 
        $refund_policy = $rfnd->refund_policy;

      $id = $rfnd->id; 
        @endphp

    @endforeach

@else

    @php 
    $refund_policy = "";
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

                        <strong class="card-title">Refund Policy</strong>

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Update Refund Policy</strong></div>

                                <div class="card-body card-block"> 

                                   @include('templates.SuperAdmin.messages')

                                    {!! Form::open(['method' => 'POST', 'url' => 'update-refund', 'enctype' => 'multipart/form-data']) !!}

                                        @csrf

                                        <input type="hidden" name="id" value="{{$id}}">

                                     
                                        <div class="form-group col-md-12">

                                           <label for="vat" class="form-control-label">Refund Policy</label>

                                         
                                       <textarea cols="80" id="refund_policy" name="refund_policy" rows="10" class="form-control" >{{$refund_policy}}</textarea>


                                           <small class="text-danger">{{ $errors->first('refund_policy') }}</small>

                                       </div>



                                        <div class="card-footer col-md-12">  

                                            <button type="submit" class="btn btn-success btn-sm">

                                                <i class="fa fa-dot-circle-o"></i> Submit

                                            </button>

                                                        

                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-times-circle-o" aria-hidden="true"></i> <a href="{{url('faq')}}">Cancel</a></button> 

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
   CKEDITOR.replace( 'refund_policy',
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