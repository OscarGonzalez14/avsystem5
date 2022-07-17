  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- date-range-picker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="js/cleave.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

  ///////////////////////////  DESPLAZAMIENTO    ////////////////
document.addEventListener('keydown',handleInputFocusTransfer);

function handleInputFocusTransfer(e){

  const focusableInputElements= document.querySelectorAll(`.next-input`);  
  const focusable= [...focusableInputElements]; 
  const index = focusable.indexOf(document.activeElement); 

  let nextIndex = 0;
  if (e.keyCode === 38) {
   // e.preventDefault();
    nextIndex= index > 0 ? index-1 : 0;
    focusableInputElements[nextIndex].focus();
  }
  else if (e.keyCode === 40) {
   // e.preventDefault();
    nextIndex= index+1 < focusable.length ? index+1 : index;
    focusableInputElements[nextIndex].focus();
    focusableInputElements[nextIndex].select();
  }else if(e.keyCode === 37){
   // e.preventDefault();
    nextIndex= index > 0 ? index-1 : 0;
    focusableInputElements[nextIndex].focus();
    focusableInputElements[nextIndex].select();
  }else if(e.keyCode === 39){
   // e.preventDefault();
    nextIndex= index+1 < focusable.length ? index+1 : index;
    focusableInputElements[nextIndex].focus();
    focusableInputElements[nextIndex].select();
  }else if(e.keyCode === 13){
   // e.preventDefault();
    nextIndex= index+1 < focusable.length ? index+1 : index;
    focusableInputElements[nextIndex].focus();
    focusableInputElements[nextIndex].select();
  }
}
</script>
<!-- Select2 -->



</body>
</html>