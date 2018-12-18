<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="assets/panel/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="assets/panel/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="assets/panel/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="assets/panel/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
  <script src="assets/crossbrowserjs/html5shiv.js"></script>
  <script src="assets/crossbrowserjs/respond.min.js"></script>
  <script src="assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="assets/panel/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/panel/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/panel/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="assets/panel/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/panel/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/panel/js/table-manage-default.demo.min.js"></script>
<!-- <script src="assets/panel/js/dashboard-v2.min.js"></script> -->
<script src="assets/panel/plugins/parsley/dist/parsley.js"></script>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/panel/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/panel/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="assets/panel/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/panel/plugins/masked-input/masked-input.min.js"></script>
<script src="assets/panel/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/panel/plugins/password-indicator/js/password-indicator.js"></script>
<script src="assets/panel/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="assets/panel/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/panel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="assets/panel/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="assets/panel/plugins/jquery-tag-it/js/tag-it.min.js"></script>
  <script src="assets/panel/plugins/bootstrap-daterangepicker/moment.js"></script>
  <script src="assets/panel/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="assets/panel/plugins/select2/dist/js/select2.min.js"></script>
  <script src="assets/panel/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <script src="assets/panel/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
  <script src="assets/panel/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
  <script src="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
  <script src="assets/panel/plugins/clipboard/clipboard.min.js"></script>
<script src="assets/panel/js/form-plugins.demo.min.js"></script>

<script src="assets/panel/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
  $(document).ready(function() {
    App.init();
    // DashboardV2.init();
    TableManageDefault.init();
			FormPlugins.init();
  });
</script>

<script type='text/javascript'>
  var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
  var date = new Date();
  var day = date.getDate();
  var month = date.getMonth();
  var thisDay = date.getDay(),
    thisDay = myDays[thisDay];
  var yy = date.getYear();
  var year = (yy < 1000) ? yy + 1900 : yy;
  function startTime() {
      var today=new Date(),
          curr_hour=today.getHours(),
          curr_min=today.getMinutes(),
          curr_sec=today.getSeconds();
   curr_hour=checkTime(curr_hour);
      curr_min=checkTime(curr_min);
      curr_sec=checkTime(curr_sec);
      document.getElementById('clock').innerHTML=curr_hour+":"+curr_min+":"+curr_sec;
      document.getElementById('date').innerHTML=thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
      document.getElementById('clock2').innerHTML=curr_hour+":"+curr_min+":"+curr_sec;
      document.getElementById('date2').innerHTML=thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
  }

  function checkTime(i) {
      if (i<10) {
          i="0" + i;
      }
      return i;
  }
  setInterval(startTime, 500);
</script>


</body>

</html>
