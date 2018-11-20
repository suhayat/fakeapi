$(document).ready(function () {
    $('.sidebar-menu').tree()
    $("a").not('a[href^="#"]').click(function () {
      $('.sidebar-menu li.active').removeClass('active');
      $('.sidebar-menu li.menu-open').removeClass('menu-open');
      $('.sidebar-menu ul.treeview-menu').css('display','none');
      $(this).closest("li").addClass("active");
      $(this).parents().closest('.treeview').addClass("active menu-open");
      $(this).parents().closest('.treeview-menu').css('display','block');
    });
    $("a").each(function() {
        if (this.href == window.location.href) {
            $(this).closest("li").addClass("active");
            $(this).parents().closest('.treeview').addClass("active menu-open");
        }
    });
   $('select').select2({
    minimumResultsForSearch: -1
   });
});

function deleteRow(url,redirect) {
  swal({
    title: "Notifikasi.",
    text: "Yakin ingin menghapus data ini.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: url,
          type: 'DELETE',
          data: { 
            _token: csrf_token
          }
      }).done(function(resp) {
          window.location = redirect;
      });
      }
  });
}