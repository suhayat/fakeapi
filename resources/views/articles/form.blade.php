@extends('layouts.app')
@section('title', 'Articles')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/articles') }}">@yield('title')</a> &raquo; {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
</section>
<section class="content">
   	<div class="box">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">@yield('title') Form</h3>
         	</div>
      	</div>
      	@if(isset($model))
		       {{ Form::model($model, ['id' => 'model-form']) }}
   		@else
   		    {{ Form::open(['id' => 'model-form']) }}
   		@endif
      	<div class="box-body">
      		<div class="col-xs-12">
      			@include('widgets.error')
      		</div>
   			<div class="col-xs-12">
   				<div class="form-group">
   		    		<label>Title*</label>
                  {!! Form::text('title',null, ['class' => 'form-control']) !!}
   		  		</div>
               <div class="form-group">
                  <label>Content*</label>
                  {!! Form::textarea('content',null, ['class' => 'form-control']) !!}
               </div>
   		  	</div>
      	</div>
      	<div class="box-footer">
            <div class="col-xs-12">
               @include('widgets.submit_button')
            </div>
         </div>
      	{!! Form::close() !!}
   	</div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
   var editor_config = {
      path_absolute : "/",
      selector: "textarea",
      plugins: [
         "advlist autolink lists link image charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen",
         "insertdatetime media nonbreaking save table contextmenu directionality",
         "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
         var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
         var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

         var cmsURL = editor_config.path_absolute + 'cms-filemanager?field_name=' + field_name;
         if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
         } else {
            cmsURL = cmsURL + "&type=Files";
         }

         tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
         });
      }
   };
   tinymce.init(editor_config);
</script>
{!! $validator->selector('#model-form') !!}
@endsection