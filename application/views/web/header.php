<!DOCTYPE html>
<?php
$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?= $judul_web; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="<?php echo $this->Mcrud->judul_web(); ?>" name="description" />
	<meta content="" name="author" />
	<meta name="keywords" content="<?php echo $this->Mcrud->judul_web(); ?>">
	<base href="<?php echo base_url();?>"/>
	<link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/panel/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/panel/css/animate.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/panel/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="assets/panel/css/style-gue.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="assets/panel/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="assets/panel/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/panel/plugins/morris/morris.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/panel/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/panel/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>

	<style>
	.myAlert-top{
	  position: fixed;
	  top: 50px;
	  left:27%;
	  width: 46%;
		padding: 5px;
		padding-left: 10px;
	  z-index: 9999;
	}
	.alert{
	    display: none;
	}
	</style>

</head>
<body>

<style type="text/css"></style>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu"> <!--page-sidebar-minified-->
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="" class="navbar-brand">
						<span class="navbar-logo"><i class="ion-ios-medkit" style="color:#fff;"></i></span> &nbsp;
						<b> <?php echo $this->Mcrud->judul_web(2); ?> </b>
					</a>
					<!-- <button type="button" class="navbar-toggle" data-click="top-menu-toggled"> -->
					<button type="button" class="navbar-toggle">
						<!-- <span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> -->
						<div id="clock2" style="float:right;color:white;font-weight:bold;margin-top:-15px;font-size:16px;"></div><br>
						<div id="date2" style="float:right;color:#f1f1f1;margin-top:-15px;"></div>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="" class="btn btn-xl btn-icon btn-circle btn-warning" style="margin-top:12px;color:white;margin-right:8px;" title="Halaman Utama"><i class="fa fa-home"></i></a>
					</li>
					<li>
						<a href="web/login" class="btn btn-xl btn-icon btn-circle btn-info" style="margin-top:12px;color:white;margin-right:8px;" title="Form Login"><i class="fa fa-user"></i></a>
					</li>
					<li>
						<a href="javascript:;" class="btn btn-xl btn-icon btn-circle btn-success" style="margin-top:12px;color:white;" title="Refresh" onClick="window.location.reload()"><i class="fa fa-repeat"></i></a>
					</li>
					<li>&nbsp;</li>
				</ul>
				<!-- end header navigation right -->

			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- begin #top-menu -->
		<div id="top-menu" class="top-menu">
            <!-- begin top-menu nav -->
			<ul class="nav">
					<li class="has-sub active">
						<a href="javascript:;" style="background:orange;font-weight:bold;font-size:14px;">
							<span id="clock"></span>
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<span id="date"></span>
						</a>
					</li>
        </ul>
            <!-- end top-menu nav -->
    </div>
		<!-- end #top-menu -->
