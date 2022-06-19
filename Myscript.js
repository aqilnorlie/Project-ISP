//function utk pagination
$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "bJQueryUI":true,
      "bSort":true,
      "bPaginate":true,
      "sPaginationType":"full_numbers",
       "iDisplayLength": 5
    });
  });

//CSS file pagination
//<link rel=”stylesheet” href=”https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css” />

//JS file pagination
//<script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>

//<link rel=”stylesheet” href=”https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css” />
//<script type=”text/javascript” src=”https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js”></script>

