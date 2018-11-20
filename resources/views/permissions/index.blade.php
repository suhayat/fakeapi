@extends('layouts.app')
@section('title', 'Permissions')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
<section class="content-header">
   <h1>@yield('title')</h1>
</section>
<section class="content">
   <div class="box">
      <div class="box-header with-border">
         <h3 class="box-title">
            @can('permissions_create')
               <a href="{{ Navigation::adminUrl('/permissions/create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add</a>
            @endcan
         </h3>
      </div>
      <div class="box-body">
         @include('widgets.message')
         <table class="table table-bordered table-striped" id="data-table">
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Alias</th>
                  <th>Realted Menu</th>
                  <th></th>
               </tr>
            </thead>
            <thead id="searchid">
               <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
            </thead>
            <tbody></tbody>
         </table>
      </div>
   </div>
</section>
@endsection
@section('js')
<script>
   var t = $('#data-table').DataTable({
      "processing": true,
      "serverSide": true,
      "autoWidth": false,
      "language": {
         "search": "",
         "lengthMenu": '_MENU_ &nbsp;&nbsp;&nbsp;'
      },
      // "ajax": base_url + '/permissions',
      "ajax":{
         "url": base_url + '/permissions',
         "dataType": "json",
         "type": "POST",
         "data":{ _token: "{{csrf_token()}}"}
      },
      "columns": [
         { "title" : "Action", "data": "id", "orderable": false, "width": "100px", "className": "text-center", render: function (data, type, row, meta) {
            var view = '';
            var edit = '';
            var dele = '';
            @can('permissions_view')
               view = '<a href="{{ Navigation::adminUrl('/permissions') }}/'+row.id+'/view" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>'; 
            @endcan
            @can('permissions_edit')
               edit = '<a href="{{ Navigation::adminUrl('/permissions') }}/'+row.id+'/edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>';
            @endcan
            @can('permissions_delete')
               dele = '<button class="btn btn-xs btn-danger" onclick="deleteRow(\'{{ Navigation::adminUrl('/permissions') }}/'+row.id+'/delete\',\'{{ Navigation::adminUrl('/permissions') }}\');"><i class="fa fa-trash"></i></button>';
            @endcan
            return view+' '+edit+' '+dele;
         }},
         { "title" : "No.", "data": null, "orderable": false, "className": "text-center", "width": "40px", render: function (data, type, row, meta) {
             return meta.row + meta.settings._iDisplayStart + 1;
         }},
         { "title": "Name", "data": "name" },
         { "title": "Alias", "data": "alias" },
         { "title": "Related Menu", "data": "menu" }
      ]
   });

   $('#data-table #searchid td').each(function() {
      if ($(this).index() != 0 && $(this).index() != 1) {
         $(this).html('<input style="width:100%" type="text" class="form-control" placeholder="Search" data-id="' + $(this).index() + '" />');
      } else {
         $(this).html('<center>#</center>');
      }
   });

   $('#data-table #searchid input').keyup(function () {
      t.columns($(this).data('id')).search(this.value).draw();
   });
</script>
@endsection