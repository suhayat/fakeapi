@extends('layouts.app')
@section('title', 'User')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/users') }}">@yield('title')</a> &raquo; {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
</section>
<section class="content">
   	<div class="box">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">User Form</h3>
         	</div>
      	</div>
      	@if(isset($model))
		    {{ Form::model($model, ['id' => 'user-form']) }}
		@else
		    {{ Form::open(['id' => 'user-form']) }}
		@endif
      	<div class="box-body">
      		<div class="col-xs-12">
      			@include('widgets.error')
      		</div>
			<div class="col-xs-6">
				<div class="form-group">
		    		<label>Name*</label>
		    		{!! Form::text('name',null, ['class' => 'form-control']) !!}
		  		</div>
		  		<div class="form-group">
		    		<label>Email*</label>
		    		{!! Form::text('email',null, ['class' => 'form-control']) !!}
		  		</div>
		  		<div class="form-group">
		    		<label>Username*</label>
		    		{!! Form::text('username',null, ['class' => 'form-control']) !!}
		  		</div>
		  	</div>
		  	<div class="col-xs-6">
		  		<div class="form-group">
		    		<label>Password* <small><i>{!! (isset($model)) ? '(kosongkan jika tidak diubah)' : '' !!}</i></small></label>
		    		<input type="password" class="form-control" name="password">
		  		</div>
		  		<div class="form-group">
		    		<label>Role*</label>
		  			{!! Form::select('role_id', $roles, null, ['placeholder' => 'Choose Role','class' => 'form-control']) !!}
		  		</div>
		  		<div class="form-group">
		    		<label>Active</label>
		    		<div class="form-group">
			    		{!! Form::checkbox('status', '00', isset($model) ? $model : null) !!}
			    	</div>
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
{!! $validator->selector('#user-form') !!}
@endsection