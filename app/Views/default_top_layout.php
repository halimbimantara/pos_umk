<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Kasir POS</title>


	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url("resources/plugins/fontawesome-free/css/all.min.css"); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url("resources/dist/css/adminlte.min.css"); ?>">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url("resources/plugins/select2/css/select2.min.css") ?>">
	<link rel="stylesheet" href="<?php echo base_url("resources/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<style>
		#results {
			position: absolute;
			width: inherit;
			max-width: 870px;
			cursor: pointer;
			overflow-y: auto;
			max-height: 400px;
			box-sizing: border-box;
			z-index: 1001;
		}

		.link-class:hover {
			background-color: #f1f1f1;
		}
	</style>
	<link rel="stylesheet" href="<?= base_url("resources/dist/css/flexgrid.css") ?>">
	<style>
		.modal-dialog {
			position: absolute;
			top: 50px;
			right: 100px;
			bottom: 0;
			left: 0;
			z-index: 10040;
			overflow: auto;
			overflow-y: auto;
		}
	</style>
</head>

<body class="hold-transition layout-top-nav sidebar-collapse layout-top-nav sidebar-closed layout-navbar-fixed text-sm">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar sidebar-mini layout-navbar-fixed navbar-dark  navbar-gray-dark">
			<div class="container">
				<a href="#" class="navbar-brand">
					<i class="fas fa-cash-register"></i>
					<span class="brand-text font-weight-light">Kasir</span>
				</a>

				<!-- <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button> -->

				<div class="collapse navbar-collapse order-3" id="navbarCollapse">
					<!-- Left navbar links -->
					<!-- <ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
						</li>

					</ul> -->

				</div>

				<!-- Right navbar links -->
				<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
					<!-- Messages Dropdown Menu -->
					<div style="text-size-adjust: 14px;" id="total_belanja">
						<div>
							<!-- <label class="control-label">Bayar</label> -->
							<input placeholder="Total Nota" name="mtotal_belanja" disabled="" id="mtotal_belanja" type="text" class="form-control">
							<span class="help-block"></span>
						</div>
					</div>
					<!-- Notifications Dropdown Menu -->

					<!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
              class="fas fa-th-large"></i></a>
        </li> -->

				</ul>
			</div>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<!-- <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> -->
			<a class="nav-link" data-widget="pushmenu" href="#" class="brand-link elevation-4">
				<img src="<?= base_url("resources/dist/img/store.png"); ?>" alt="Umkm" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">Umkm</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<i class=" nav-icon fas fa-user "></i>

					</div>
					<div class="info">
						<a href="<?= base_url("profile") ?>" class="d-block">User</a>
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
						<li class="nav-item">
							<a href="<?php echo base_url("produk"); ?>" class="nav-link">
								<i class="nav-icon fas fa-box"></i>
								<p>
									Produk
									<!-- <span class="badge badge-info right">2</span> -->
								</p>
							</a>
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
							<a href="../gallery.html" class="nav-link">
								<i class="nav-icon fas fa-cart-arrow-down"></i>
								<p>
									Informasi Stok
								</p>
							</a>
						</li>


						<li class="nav-header">Setting</li>
						<li class="nav-item">
							<a href="<?php echo base_url("settings"); ?>" class="nav-link">
								<i class="nav-icon fas fa-file"></i>
								<p>General Setting</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("profile"); ?>" class="nav-link">
								<i class="nav-icon fas fa-file"></i>
								<p>User Setting</p>
							</a>
						</li>


					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?= $this->renderSection('content') ?>
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
			<div class="p-3">
				<h5>Title</h5>
				<p>Sidebar content</p>
			</div>
		</aside>
		<!-- /.control-sidebar -->

		<!-- Main Footer -->
		<!-- <?php //$this->include('admin_footer'); 
				?> -->
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<?= $this->include('bottom_js'); ?>
	<?= $this->renderSection('jscript') ?>
</body>

</html>