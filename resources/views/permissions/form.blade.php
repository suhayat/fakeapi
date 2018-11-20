@extends('layouts.app')
@section('title', 'Permissions')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/permissions') }}">@yield('title')</a> &raquo; {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
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
   			<div class="col-xs-6">
   				<div class="form-group">
   		    		<label>Name*</label>
   		    		@if(isset($model))
                     {!! Form::text('name',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  @else
                     {!! Form::text('name',null, ['class' => 'form-control']) !!}
                  @endif
   		  		</div>
               <div class="form-group">
                  <label>Alias*</label>
                  {!! Form::text('alias',null, ['class' => 'form-control']) !!}
               </div>
   		  	</div>
            <div class="col-xs-6">
               <div class="form-group">
                  <label>Menu</label>
                  {!! Form::select('menu_id', $options, null, ['placeholder' => 'Pilih Menu','class' => 'form-control']) !!}
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
   $('select').select2();
});
</script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
{!! $validator->selector('#model-form') !!}
@endsection