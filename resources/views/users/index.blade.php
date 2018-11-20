@extends('layouts.app')
@section('title', 'Users')
@section('content')
<section class="content-header">
   <h1>@yield('title')</h1>
</section>
<section class="content">
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title">
            @can('users_create')
               <a href="{{ Navigation::adminUrl('/users/create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add</a>
            @endcan
         </h3>
      </div>
      <div class="box-body">
         @include('widgets.message')
         <table class="table table-bordered table-striped nowrap" id="data-table" style="width: 100%;"></table>
      </div>
   </div>
</section>
@endsection
@section('js')
<script>
   $('#data-table').DataTable({
      "processing": true,
      "serverSide": true,
      "language": {
         "search": "",
         "lengthMenu": '_MENU_ &nbsp;&nbsp;&nbsp;'
      },
      "ajax": function(data, callback, settings) {
         var column = data.columns[data.order[0].column].data;
         var dir = data.order[0].dir;
         $.getJSON(base_url + '/users', {
            limit: data.length,
            search: data.search.value,
            page: Math.ceil(data.start/data.length) + 1,
            field: column,
            order: dir
         }, function(res) {
            callback({
               recordsTotal: res.totalRow,
               recordsFiltered: res.totalRow,
               data: res.data
            });
         });
      },
      "scrollX": true,
      "scrollCollapse": true,
      "fixedColumns":   {
         leftColumns: 3
      },
      "columns": [
         { "title": "ID", "data": "id", "visible": false },
         { "title" : "No.", "data": null, "orderable": false, "width": "40px", render: function (data, type, row, meta) {
             return meta.row + meta.settings._iDisplayStart + 1;
         }},
         { "title" : "#", "orderable": false, "width": "100px", "className": "text-center", render: function (data, type, row, meta) {
            var view = '';
            var edit = '';
            var dele = '';
            @can('users_view')
               view = '<a href="{{ Navigation::adminUrl('/users') }}/'+row.id+'/view" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>'; 
            @endcan
            @can('users_edit')
               edit = '<a href="{{ Navigation::adminUrl('/users') }}/'+row.id+'/edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>';
            @endcan
            @can('users_delete')
               dele = '<button class="btn btn-xs btn-danger" onclick="deleteRow(\'{{ Navigation::adminUrl('/users') }}/'+row.id+'/delete\',\'{{ Navigation::adminUrl('/users') }}\');"><i class="fa fa-trash"></i></button>';
            @endcan
            return view+' '+edit+' '+dele;
         }},
         { "title": "Name", "data": "name" },
         { "title": "Email", "data": "email" },
         { "title": "Role", "data": "role_name", render: function (data, type, row, meta) {
            return '<span class="label label-primary">'+ row.role_name +'</span>';
         }},
         { "title": "Status", "data": "status", render: function (data, type, row, meta) {
            var style = (row.status == "ACTIVE") ? "primary" : "warning";
            return '<span class="label label-'+style+'">'+ row.status +'</span>';
         }}
      ]
   });
</script>
@endsection