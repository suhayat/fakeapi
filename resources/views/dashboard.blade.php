@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<section class="content-header">
   <h1>@yield('title')</h1>
</section>
<section class="content">
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title">
            @yield('title')
         </h3>
      </div>
      <div class="box-body">
        Hallo, {{ Auth::user()->name }}
      </div>
   </div>
</section>
@stop
      
