@extends('layouts.app')
@section('title', 'Pengguna')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/users') }}">@yield('title')</a> &raquo; Lihat lebih rinci</h1>
</section>
<section class="content">
   	<div class="box">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">Informasi Pengguna</h3>
         	</div>
      	</div>
      	<div class="box-body">
			<div class="col-xs-6">
				<div class="form-group">
		    		<label>Name*</label>
		    		<div class="form-group">{!! $model['name'] !!}</div>
		  		</div>
		  		<div class="form-group">
		    		<label>Email*</label>
		    		<div class="form-group">{!! $model['email'] !!}</div>
		  		</div>
		  		<div class="form-group">
		    		<label>Group*</label>
		  			<div class="form-group">{!! $model['role_name'] !!}</div>
		  		</div>
		  		<div class="form-group">
		    		<label>Active</label>
		    		<div class="form-group">{!! ($model['status'] > 0) ? 'YES' : 'NO' !!}</div>
		  		</div>
		  	</div>
      	</div>
      	<div class="box-footer">
      		<div class="col-xs-12">
	      		<div class="btn-group pull-right">
				  	<button type="button" class="btn btn-warning" onclick="history.back();">
				  		<i class="fa fa-arrow-circle-left"></i> Kembali</button>
				</div>
	      	</div>
      	</div>
   	</div>
</section>
@endsection