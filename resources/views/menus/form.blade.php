@extends('layouts.app')
@section('title', 'Permissions')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/menus') }}">@yield('title')</a> &raquo; {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
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
   			<div class="col-lg-6">
               <div class="form-group">
                  <label>Name*</label>
                  {!! Form::text('name',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Url</label>
                  {!! Form::text('url',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Parent Menu</label>
                  {!! Form::select('parent_id', $options, null, ['placeholder' => 'Pilih Menu','class' => 'form-control parent']) !!}
               </div>
            </div>
            <div class="col-lg-6">
               <div class="form-group">
                  <label>Icon*</label>
                  {!! Form::text('icon',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Order*</label>
                  {!! Form::text('order',null, ['class' => 'form-control']) !!}
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
<script type="text/javascript">
$(function() {
   $('select.parent').select2();
});
</script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
{!! $validator->selector('#model-form') !!}
@endsection