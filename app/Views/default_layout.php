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
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="far fa-comments"></i>
					<span class="badge badge-danger navbar-badge">3</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<a href="#" class="dropdown-item">
						<!-- Message Start -->
						<div class="media">
							<img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
							<div class="media-body">
								<h3 class="dropdown-item-title">
									Brad Diesel
									<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
								</h3>
								<p class="text-sm">Call me whenever you can...</p>
								<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
							</div>
						</div>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<!-- Message Start -->
						<div class="media">
							<img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
							<div class="media-body">
								<h3 class="dropdown-item-title">
									John Pierce
									<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
								</h3>
								<p class="text-sm">I got your message bro</p>
								<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
							</div>
						</div>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<!-- Message Start -->
						<div class="media">
							<img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
							<div class="media-body">
								<h3 class="dropdown-item-title">
									Nora Silvester
									<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
								</h3>
								<p class="text-sm">The subject goes here</p>
								<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
							</div>
						</div>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
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
						<a href="#" class="d-block">user</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Laporan
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url("laporan"); ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Pembelian & Penjualan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="../../index3.html" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Stok</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-header">Toko</li>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-cart-arrow-down"></i>
								<p>
									Produk
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">


								<li class="nav-item">
									<a href="<?php echo base_url("stok"); ?>" class="nav-link">
										<i class="nav-icon fa fa-percent"></i>
										<p>Stok</p>
									</a>
								</li>
							</ul>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("pembelian"); ?>" class="nav-link">
								<i class="nav-icon fas fa-cart-plus"></i>
								<p>
									Pembelian Barang
									<!-- <span class="badge badge-info right">2</span> -->
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url("settings/setingkategori"); ?>" class="nav-link">
								<i class="nav-icon fas fa-cart-arrow-down"></i>
								<p>
									Kategori Produk
								</p>
							</a>
						</li>


						<li class="nav-header">Setting</li>
						<!-- General -->
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-cart-arrow-down"></i>
								<p>
									General
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url("settings"); ?>" class="nav-link">
										<i class="nav-icon fa fa-tasks"></i>
										<p>App Setting</p>
									</a>
								</li>
							</ul>
						</li>
						<!-- End General -->
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-cart-arrow-down"></i>
								<p>
									Produk
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url("produk"); ?>" class="nav-link">
										<i class="nav-icon fa fa-percent"></i>
										<p>Tambah Produk</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url("settings/psetting"); ?>" class="nav-link">
										<i class="nav-icon fa fa-percent"></i>
										<p>Profit</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="<?php echo base_url("suplier"); ?>" class="nav-link">
										<i class="nav-icon fas fa-file"></i>
										<p>Data Suplier</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="<?php echo base_url("settings/settingsatuan"); ?>" class="nav-link">
										<i class="nav-icon fa fa-dropbox"></i>
										<p>Kemasan</p>
									</a>
								</li>
							</ul>
						</li>
						<!-- general -->


						<!-- user Management -->
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-users"></i>
								<p>
									User Management
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url("profile"); ?>" class="nav-link">
										<i class="nav-icon fas fa-file"></i>
										<p>User Setting</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url("settings/usermenu"); ?>" class="nav-link">
										<i class="nav-icon fas fa-file"></i>
										<p>User Menu</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url("settings/userroles"); ?>" class="nav-link">
										<i class="nav-icon fas fa-file"></i>
										<p>User Roles</p>
									</a>
								</li>
							</ul>
						</li>
						<!-- End user Management -->
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