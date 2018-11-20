@extends('layouts.app')
@section('title', 'Profil')
@section('content')
<section class="content-header">
   <h1>@yield('title') &raquo; Ubah Password</h1>
</section>
<section class="content">
   	<div class="box box-danger">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">Ubah Password</h3>
         	</div>
      	</div>
      	{{ Form::open(['id' => 'user-form']) }}
      	<div class="box-body">
      		<div class="col-xs-12">
      			@include('widgets.message')
      			@include('widgets.error')
      		</div>
			<div class="col-xs-4">
				<div class="form-group {{ $errors->has('now_password') ? 'has-error' : ''}}">
		    		<label>Password lama*</label>
		    		<input type="password" class="form-control" name="now_password">
		    		{!! $errors->first('now_password', '<span class="help-block error-help-block">:message</span>') !!}
		  		</div>
		  		<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
		    		<label>Password baru*</label>
		    		<input type="password" class="form-control" name="password">
		    		{!! $errors->first('password', '<span class="help-block error-help-block">:message</span>') !!}
		  		</div>
		  		<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
		    		<label>Konfirmasi password*</label>
		    		<input type="password" class="form-control" name="password_confirmation">
		    		{!! $errors->first('password_confirmation', '<span class="help-block error-help-block">:message</span>') !!}
		  		</div>
		  	</div>
      	</div>
      	<div class="box-footer">
      		<div class="col-xs-12">
	      		<div class="btn-group pull-right">
				  	<a class="btn btn-warning" href="{{ Navigation::adminUrl('/profile') }}">
				  		<i class="fa fa-arrow-circle-left"></i> Kembali</a>
				  	<button type="submit" class="btn btn-success pull-right">
	      				<i class="fa fa-save"></i> Simpan</button>
				</div>
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