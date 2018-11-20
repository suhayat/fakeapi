@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<section class="content-header">
   <h1>@yield('title')</h1>
</section>
<section class="content">
   	<div class="box box-danger">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">Profil</h3>
         	</div>
      	</div>
      	<div class="box-body">
			<div class="col-xs-4">
				<div class="form-group">
		    		<label>Name</label>
		    		<div class="form-group">{!! $model['name'] !!}</div>
		  		</div>
		  		<div class="form-group">
		    		<label>Email</label>
		    		<div class="form-group">{!! $model['email'] !!}</div>
		  		</div>
		  	</div>
		  	<div class="col-xs-4">
		  		<div class="form-group">
		    		<label>Group</label>
		  			<div class="form-group">{!! $model['role_name'] !!}</div>
		  		</div>
		  		<div class="form-group">
		    		<label>Status</label>
		    		<div class="form-group">{!! ($model['status'] > 0) ? 'ACTIVE' : 'INACTIVE' !!}</div>
		  		</div>
		  	</div>
      	</div>
      	<div class="box-footer">
      		<div class="col-xs-12">
	      		<div class="btn-group pull-right">
				  	<button type="button" class="btn btn-warning" onclick="history.back();">
				  		<i class="fa fa-arrow-circle-left"></i> Kembali</button>
				  	<a href="{{ Navigation::adminUrl('/change-password') }}" class="btn btn-primary pull-right">
			  			<i class="fa fa-pencil"></i> Ubah Password</a>
				</div>
	      	</div>
      	</div>
   	</div>
</section>
@endsection