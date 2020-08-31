<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url() ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url() ?>plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url() ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= base_url() ?>dist/js/pages/dashboard2.js"></script>

<script src="<?= base_url() ?>plugins/summernote/summernote-bs4.min.js"></script>

<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>plugins/select2/js/select2.full.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('#editor').summernote({
    	height: 400,
    	width: 500
    })
  })
</script>
<script>
  $(function () {
    // Summernote
    $('#editor-berita').summernote({
    	height: 400,
    	width: '100%'
    })
  })
</script>

<script>
  $(function () {
    $('#data-table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
      responsive: true,
    });
  });
</script>

<script type="text/javascript">
  
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    });
</script>
</body>
</html>

