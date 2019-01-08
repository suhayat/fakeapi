@extends('layouts.app')
@section('title', 'Article')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/permissions') }}">@yield('title')</a> &raquo; View</h1>
</section>
<section class="content">
   	<div class="box">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">@yield('title') Detail</h3>
         	</div>
      	</div>
      	<div class="box-body">
   			<div class="col-xs-12">
   				<div class="form-group">
   		    		<label>Title</label>
   		    		<div class="form-group">{!! $model->title !!}</div>
   		  		</div>
   		  	</div>
            <div class="col-xs-12">
               <div class="form-group">
                  <label>Short Content</label>
                  <div class="form-group">{!! $model->short_content !!}</div>
               </div>
            </div>
            <div class="col-xs-12">
               <div class="form-group">
                  <label>Content</label>
                  <div class="form-group">{!! $model->content !!}</div>
               </div>
            </div>
      	</div>
      	<div class="box-footer">
      		<div class="col-xs-12">
	      		<div class="btn-group pull-right">
				  	<button type="button" class="btn btn-warning" onclick="history.back();">
				  		<i class="fa fa-arrow-circle-left"></i> Back</button>
				</div>
	      	</div>
      	</div>
   	</div>
</section>
@endsection