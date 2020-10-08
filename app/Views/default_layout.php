<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= NAME_APPS ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url("resources/plugins/fontawesome-free/css/all.min.css"); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url("resources/dist/css/adminlte.min.css"); ?>">
	<link rel="stylesheet" href="<?= base_url("resources/plugins/select2/css/select2.min.css") ?>" />
	<!-- daterange picker -->
	<link rel="stylesheet" href="<?= base_url("resources/plugins/daterangepicker/daterangepicker.css"); ?>">
	<!-- Google Font: Source Sans Pro -->
	<link href=" https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark navbar-gray-dark">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">

				</li>

			</ul>

			<!-- SEARCH FORM -->


			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<button class="btn btn-navbar bg-success" type="submit">
					<a href="<?= base_url("pos") ?>">
						<i class="fas fa-cash-register"> Kasir</i>
					</a>
				</button>
				<!-- Messages Dropdown Menu -->
				<!-- <li class="nav-item dropdown"> -->
				<a class="btn btn-info" data-toggle="dropdown" href="#">
					<i class="far fa-user"> Profile</i>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<a href="<?= base_url("profile") ?>" class="dropdown-item">
						<!-- Message Start -->
						<i class="far fa-user"> Profile</i>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
					<a href="<?= base_url("login/logout") ?>" class="dropdown-item">
						<!-- Message Start -->
						<i class="fa fa-window-close"> Logout</i>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
				</div>
				</li>
				<!-- Notifications Dropdown Menu -->
				<!-- <li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">15</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">15 Notifications</span>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-envelope mr-2"></i> 4 new messages
							<span class="float-right text-muted text-sm">3 mins</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-users mr-2"></i> 8 friend requests
							<span class="float-right text-muted text-sm">12 hours</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-file mr-2"></i> 3 new reports
							<span class="float-right text-muted text-sm">2 days</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
					</div>
				</li> -->
				<!-- <li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li> -->
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="../../index3.html" class="brand-link elevation-4">
				<img src="<?= base_url("resources/dist/img/store.png"); ?>" alt="Umkm" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">MobieCashier</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<i class=" nav-icon fas fa-user "></i>

					</div>
					<div class="info">
						<a href="#" class="d-block"><?php echo $username ?></a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<?php echo $menu; ?>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?= $this->renderSection('content') ?>
		</div>
		<!-- /.content-wrapper -->


		<!--  //$this->include('admin_footer');  -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->
	 
	<?= $this->include('bottom_js'); ?>
	<?= $this->renderSection('jscript') ?>

</body>

</html>