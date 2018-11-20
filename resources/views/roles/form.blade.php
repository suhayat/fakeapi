@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/roles') }}">@yield('title')</a> &raquo; {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
</section>
<section class="content">
   	<div class="box">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">Group Form</h3>
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
   		    		{!! Form::text('name',null, ['class' => 'form-control']) !!}
   		  		</div>
   		  	</div>
            <div class="col-xs-12">
               <div class="form-group">
                  <label>Setting Permission</label>
               </div>
            </div>
            <div class="col-xs-12">
               <table class="table table-bordered table-striped">
                  <tr>
                     <th width="25%">Menu</th>
                     <th width="75%">Permission</th>
                  </tr>
                  @foreach($menus as $menu)
                     <tr>
                        <td>{!! $menu['label'] !!}</td>
                        <td>
                           @foreach($menu['permissions'] as $permission)
                              <div class="row col-lg-3">
                                 <label class="checkbox-inline">
                                    @if(isset($model))
                                       @php
                                          $checked = Navigation::checkPermission($permission['id'], $model->id);
                                       @endphp
                                       <input type="checkbox" {{ ($checked) ? 'checked' : '' }} name="permissions[]" value="{{ $permission['id'] }}">
                                    @else
                                       <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}">
                                    @endif
                                    {{ $permission['alias'] }}
                                 </label>
                              </div>
                           @endforeach
                        </td>
                     </tr>
                  @endforeach
               </table>
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