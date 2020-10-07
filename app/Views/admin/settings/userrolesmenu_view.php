<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<!-- <h1>Fixed Navbar Layout</h1> -->
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Admin</a></li>
					<li class="breadcrumb-item active">Suplier</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<?php
		if (!empty(session()->getFlashdata('success'))) { ?>

			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Alert!</h5>
				<?php echo session()->getFlashdata('success'); ?>
			</div>

		<?php } ?>
		<?php if (!empty(session()->getFlashdata('info'))) { ?>

			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Alert!</h5>
				<?php echo session()->getFlashdata('info'); ?>
			</div>

		<?php } ?>

		<?php if (!empty(session()->getFlashdata('warning'))) { ?>

			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fas fa-check"></i> Alert!</h5>
				<?php echo session()->getFlashdata('warning'); ?>
			</div>

		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-store-alt"></i> Data Menu </h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>

						</div>
					</div>
					<div class="card-body">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-xs-8">
								<button class="btn btn-app btn-success btn-xs" onclick="add_menu()">
									<i class="ace-icon fa fa-plus align-top bigger-125"></i>
									Tambah Menu
								</button>
							</div>
							<div class="col-xs-8">
								<button class="btn btn-app btn-success btn-xs" onclick="add_sub_menu()">
									<i class="ace-icon fa fa-plus align-top bigger-125"></i>
									Tambah Sub Menu
								</button>
							</div>

						</div>
						<!-- content -->
						<div class="col-12">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:3px">No</th>
										<th>Nama Menu</th>
										<th>Keterangan / Url</th>
										<th width="12%">Action</th>
									</tr>
								</thead>

								<tbody>
									<?php if ($roles_menu) : ?>
										<?php
										$no = 1;
										foreach ($roles_menu as $mdata) : ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $mdata->menu; ?></td>
												<td><?php echo $mdata->catatan; ?></td>
												<td class="text-right py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="#" class="btn btn-view btn-info" data-id="<?= $mdata->id; ?>" data-menu="<?= $mdata->menu; ?>"><i class="fas fa-eye"></i></a>
														<a href="#" class="btn btn-edit btn-primary" data-id="<?= $mdata->id; ?>" data-menu="<?= $mdata->menu; ?>"><i class="fas fa-pencil-alt"></i></a>
														<a href="#" class="btn btn-delete btn-danger" data-id="<?= $mdata->id; ?>"><i class="fas fa-trash"></i></a>
													</div>
												</td>
											</tr>
											<?php
											 $no2 = 1;
											//  print_r($CI=$menu->tes());
											//  exit();
											 foreach ($menus->submenuusers($mdata->id)->getResult() as $submenu) :
											?>
												<tr>
													<td></td>
													<td><?php echo $no2 . '. ' . $submenu->submenu; ?></td>
													<td><?php echo $submenu->url; ?></td>
													<td class="text-right py-0 align-middle">
														<div class="btn-group btn-group-sm">
															<a href="#" class="btn btn-view-sub btn-info" data-id="<?= $submenu->id; ?>" data-submenu="<?= $submenu->submenu; ?>" data-menu="<?= $mdata->id; ?>" data-url="<?= $submenu->url; ?>"><i class="fas fa-eye"></i></a>
															<a href="#" class="btn btn-edit-sub btn-primary" data-id="<?= $submenu->id; ?>" data-submenu="<?= $submenu->submenu; ?>" data-menu="<?= $mdata->id; ?>" data-url="<?= $submenu->url; ?>"><i class="fas fa-pencil-alt"></i></a>
															<a href="#" class="btn btn-delete-sub btn-danger" data-id="<?= $submenu->id; ?>"><i class="fas fa-trash"></i></a>
														</div>
													</td>
												</tr>
											<?php $no2++;
											endforeach; ?>
										<?php
											$no++;
										endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
							<div class="row">
								<div class="col-xs-12">

								</div>
							</div>
						</div><!-- /.span -->
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<!-- No nota -->
					</div>
					<!-- /.card-footer-->
				</div>
				<!-- /.card -->
			</div>
		</div>

	</div>
</section>
<!-- inline scripts related to this page -->
<!-- Bootstrap modal -->
<form action="<?= base_url('settings/addMenu') ?>" method="post">
	<div class="modal fade " id="modal_addproduk" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Tambah Menu</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form">
					<?= \Config\Services::validation()->listErrors(); ?>
					<form action="#" id="form_addprod" class="form-horizontal">
						<input type="hidden" value="" name="id" />
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Menu</label>
								<div class="col-md-9">
									<input name="nama_menu" placeholder="nama menu" requeired id="nama_roles" class="form-control" type="text">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</form>
<!-- End Bootstrap modal -->

<!-- modal sub menu -->
<form action="<?= base_url('settings/addMenusub') ?>" method="post">
	<div class="modal fade " id="modal_sub_menu" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Tambah Sub Menu</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form">
					<?= \Config\Services::validation()->listErrors(); ?>
					<form action="#" id="form_addprod" class="form-horizontal">
						<input type="hidden" value="" name="id" />
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Menu</label>
								<div class="col-md-9">
									<select class="custom-select" name="nama_menu">
										<?php foreach ($roles_menu as $mkat) : ?>
											<option value="<?= $mkat->id ?>"><?= $mkat->menu; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Nama Sub menu</label>
								<div class="col-md-9">
									<input name="nama_submenu" placeholder="nama menu" requeired class="form-control" type="text">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Url</label>
								<div class="col-md-9">
									<input name="url" placeholder="url menu" requeired class="form-control" type="text">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</form>
<!-- end modal sub menu -->

<!-- Delete -->
<form action="<?= base_url('settings/deleteMenu') ?>" method="post">
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<h4>Apakah anda yakin akan menghapus data suplier ?</h4>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" class="id">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-primary">Ya</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- Edit  -->
<form action="<?= base_url('settings/updateMenu') ?>" method="post">
	<div class="modal fade " id="modal_editsuplier" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Edit Suplier</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form">
					<?= \Config\Services::validation()->listErrors(); ?>
					<form action="#" id="form_addprod" class="form-horizontal">
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-6">Nama menu</label>
								<div class="col-md-9">
									<input name="nama_menu" id="nama_menu" placeholder="nama menu" requeired class="form-control nama_menu" type="text">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" class="id">
					<button type="submit" id="btnEdit" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</div>
</form>
<!-- /.modal-dialog -->

<!-- View  -->
<form action="#" method="post">
	<div class="modal fade " id="modal_viewmenu" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Edit Suplier</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form">
					<?= \Config\Services::validation()->listErrors(); ?>
					<form action="#" id="form_addprod" class="form-horizontal">
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-6">Nama Menu</label>
								<div class="col-md-9">
									<input name="nama_menu" placeholder="nama menu" requeired id="nama_menu" class="form-control nama_menu" type="text">
									<span class="help-block"></span>
								</div>
							</div>


						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" class="id">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</div>
</form>

<!-- modal sub menu -->
<form action="<?= base_url('settings/updateMenusub') ?>" method="post">
	<div class="modal fade " id="modal_editsupliersub" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Edit Suplier</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form">
					<?= \Config\Services::validation()->listErrors(); ?>
					<form action="#" id="form_addprod" class="form-horizontal">
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Menu</label>
								<div class="col-md-9">
									<select class="custom-select nama_menu" name="nama_menu">
										<?php foreach ($roles_menu as $mkat) : ?>
											<option value="<?= $mkat->id ?>"><?= $mkat->menu; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Nama Sub menu</label>
								<div class="col-md-9">
									<input name="nama_submenu" placeholder="nama menu" requeired class="form-control nama_submenu" type="text">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Url</label>
								<div class="col-md-9">
									<input name="url" placeholder="url menu" requeired class="form-control url" type="text">
									<span class="help-block"></span>
								</div>
							</div>


						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" class="id">
					<button type="submit" id="btnEdit" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</div>
</form>
<!-- /.modal-dialog -->

<!-- View sub menu  -->
<form action="#" method="post">
	<div class="modal fade " id="modal_viewmenusub" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Edit Suplier</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form">
					<?= \Config\Services::validation()->listErrors(); ?>
					<form action="#" id="form_addprod" class="form-horizontal">
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Menu</label>
								<div class="col-md-9">
									<select class="custom-select nama_menu" id="nama_menu" name="nama_menu">
										<?php foreach ($roles_menu as $mkat) : ?>
											<option value="<?= $mkat->id ?>"><?= $mkat->menu; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Nama Sub menu</label>
								<div class="col-md-9">
									<input name="nama_submenu" id="nama_submenu" placeholder="nama menu" requeired class="form-control nama_submenu" type="text">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Url</label>
								<div class="col-md-9">
									<input name="url" id="url" placeholder="url menu" requeired class="form-control url" type="text">
									<span class="help-block"></span>
								</div>
							</div>


						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" class="id">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</div>
</form>

<!-- delete sub menu -->

<form action="<?= base_url('settings/deleteMenusub') ?>" method="post">
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<h4>Apakah anda yakin akan menghapus data suplier ?</h4>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" class="id">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-primary">Ya</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- end modal sub menu -->
<!-- /.modal-dialog -->

<!-- Modal Delete Product-->

</div>
<!-- End -->
<?= $this->endSection(); ?>
<? $this->section('jscript'); ?>

<script src="<?= base_url("resources/assets/js/jquery-ui.custom.min.js") ?>"></script>
<script src="<?= base_url("resources/assets/js/jquery.ui.touch-punch.min.js") ?>"></script>
<script src="<?= base_url("resources/assets/js/chosen.jquery.min.js") ?>"></script>
<script type="text/javascript">
	var save_method; //for save method string
	var nota_pembelian;
	$(document).ready(function() {

		$('#form-hargamanual').hide();
		$('#c_setharga').on("click", function() {
			if (c_setharga.checked) {
				$('#form-hargamanual').show();
			} else {
				$('#form-hargamanual').hide();
			}
		});

		// get Delete Product
		$('.btn-delete').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			// Set data to Form Edit
			$('.id').val(id);
			// Call Modal Edit
			$('#deleteModal').modal('show');
		});

		$('.btn-edit').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const nama_menu = $(this).data('menu');
			$('.id').val(id);
			$('.nama_menu').val(nama_menu);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_editsuplier').modal('show');
		});

		$('.btn-view').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const nama_menu = $(this).data('menu');
			$('.id').val(id);
			$('.nama_menu').val(nama_menu);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_viewmenu').modal('show');
		});

		// sub menu
		$('.btn-delete-sub').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			// Set data to Form Edit
			$('.id').val(id);
			// Call Modal Edit
			$('#deleteModalsub').modal('show');
		});

		$('.btn-edit-sub').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const nama_menu = $(this).data('menu');
			const sub_menu = $(this).data('submenu');
			const url = $(this).data('url');
			$('.id').val(id);
			$('.nama_menu').val(nama_menu).attr('checked');
			$('.nama_submenu').val(sub_menu);
			$('.url').val(url);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_editsupliersub').modal('show');
		});

		$('.btn-view-sub').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const nama_menu = $(this).data('menu');
			const sub_menu = $(this).data('submenu');
			const url = $(this).data('url');
			$('.id').val(id);
			$('.nama_menu').val(nama_menu).attr('checked');
			$('.nama_submenu').val(sub_menu);
			$('.url').val(url);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_viewmenusub').modal('show');
		});
	});
	jQuery(function($) {
		nota_pembelian = $("#nota_pembelian").val();
		$("#no_nota").html("<h4>No Nota : " + nota_pembelian + "</h4>");
		// if (!ace.vars['touch']) {

		$('.chosen-select').chosen({
			allow_single_deselect: true,
			width: "75%"
		});
	});

	function add_person() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Transaksi Pembelian'); // Set Title to Bootstrap modal title
	}


	function save_suplier() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable 
		// $('#btn_addProduk').attr('disabled', true); 
		// ajax adding data to databasection url
		var form_data = $('#form_addprod').serialize(); //Encode form elements for submission
		// ajax adding data to database
		var url;
		save_method = 'add';
		if (save_method == 'add') {
			url = "<?php echo site_url('produk/addProduk') ?>";
		} else {
			url = "<?php echo site_url('produk/editProduk') ?>";
		}
		$.ajax({
			url: url,
			type: "POST",
			data: form_data,
			success: function(data) {
				$('#btnSave').text('tambah'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 
				// $('#btn_addProduk').attr('disabled', false); //set 
				// $('#response_ajax').load(data);
				var json = JSON.parse(data);
				if (json.success) {
					$('#modal_addproduk').modal('hide');
					$('#form_addprod')[0].reset();
					location.reload();
				} else {
					alert(json.message);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('#response_ajax').load(errorThrown);
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 
				$('#btn_addProduk').attr('disabled', false); //set 
			}
		});
	}

	function add_menu() {
		$('#modal_addproduk').modal('show');
	}

	function add_sub_menu() {
		$('#modal_sub_menu').modal('show');
	}

	function showBarang(str) {
		if (str == "") {
			$('#nama_barang').val('');
			$('#harga_barang').val('');
			$('#qty').val('');
			$('#reset').hide();
			return;
		} else {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					$("#data_produk").html(xmlhttp.responseText);
					// alert(xmlhttp.responseText);
				}
			}
			xmlhttp.open("GET", "<?= base_url('pembelian/getProduk') ?>/" + str, true);
			xmlhttp.send();
		}
	}

	function delete_person(id) {
		if (confirm('Apakah anda yakin untuk menghapusnya?')) {
			// ajax delete data to database
			$.ajax({
				url: "<?php echo site_url('person/ajax_delete') ?>/" + id,
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error deleting data');
				}
			});

		}
	}
</script>
<?= $this->endSection(); ?>