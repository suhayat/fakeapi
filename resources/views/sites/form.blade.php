@extends('layouts.app')
@section('title', 'Sites')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/sites') }}">@yield('title')</a> &raquo; {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
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
   		    		<label>Website Name*</label>
                  {!! Form::text('website_name',null, ['class' => 'form-control']) !!}
   		  		</div>
               <div class="form-group">
                  <label>Domain</label>
                  {!! Form::text('domain',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Logo</label>
                  {!! Form::text('logo',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Layout</label>
                  {!! Form::select('layout', ['theme01' => 'Theme 01', 'theme02' => 'Theme 02'], null, ['placeholder' => 'Choose Layout','class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Meta Tag</label>
                  {!! Form::textarea('meta_tag',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Meta Description</label>
                  {!! Form::textarea('meta_description',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>CSS Style</label>
                  {!! Form::textarea('css_style',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Facebook Key</label>
                  {!! Form::text('facebook_key',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Google Key</label>
                  {!! Form::text('google_key',null, ['class' => 'form-control']) !!}
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
{!! $validator->selector('#model-form') !!}
@endsection