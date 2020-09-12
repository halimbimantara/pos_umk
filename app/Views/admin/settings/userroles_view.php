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
						<h3 class="card-title"><i class="fas fa-store-alt"></i> Data User Hak Akses</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>

						</div>
					</div>
					<div class="card-body">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-xs-8">
								<button class="btn btn-app btn-success btn-xs" onclick="add_produk()">
									<i class="ace-icon fa fa-plus align-top bigger-125"></i>
									Tambah
							</div>
							</button>

						</div>
						<!-- content -->
						<div class="col-12">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:3px">No</th>
										<th>Nama Akses</th>
										<th width="12%">Action</th>
									</tr>
								</thead>

								<tbody>
									<?php if ($roles) : ?>
										<?php
										$no = 1;
										foreach ($roles as $mdata) : ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $mdata->role; ?></td>
												<td class="text-right py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
														<a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
													</div>
												</td>
											</tr>
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
<form action="<?= base_url('settings/addroles') ?>" method="post">
	<div class="modal fade " id="modal_addproduk" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Tambah Hak Akses</h4>
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
								<label class="control-label col-md-3">Nama Roles</label>
								<div class="col-md-9">
									<input name="nama_roles" placeholder="nama roles" requeired id="nama_roles" class="form-control" type="text">
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

<!-- Delete -->
<form action="<?= base_url('suplier/delete') ?>" method="post">
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Suplier</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<h4>Apakah anda yakin akan menghapus data suplier ?</h4>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="suplier_id" class="suplierID">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-primary">Ya</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- Edit  -->
<form action="<?= base_url('suplier/edit') ?>" method="post">
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
								<label class="control-label col-md-6">Nama Suplier</label>
								<div class="col-md-9">
									<input name="enama_suplier" placeholder="nama suplier" requeired id="nama_suplier" class="form-control enama_suplier" type="text">
									<span class="help-block"></span>
								</div>
							</div>

							<div class="form-group" style="margin-top: 10px">
								<label class="control-label col-md-3">Alamat</label>
								<div class="col-md-9">
									<textarea name="ealamat" placeholder="Alamat" class="form-control ealamat"></textarea>
									<span class="help-block"></span>
								</div>
							</div>
							<hr>
							</hr>
							<div class="form-group">
								<label class="control-label col-md-3">No Telepon</label>
								<div class="col-md-9">
									<input name="eno_tlpn" id="no_tlpn" placeholder="085xxxx" class="form-control eno_tlpn" type="number">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">No Hp Sales</label>
								<div class="col-md-9">
									<input name="eno_sales" id="no_sales" placeholder="085xxxx" class="form-control eno_sales" type="number">
									<span class="help-block"></span>
								</div>
							</div>

							<div class="form-group" style="margin-top: 10px">
								<label class="control-label col-md-3">Keterangan</label>
								<div class="col-md-9">
									<textarea name="eketerangan" placeholder="Keterangan" class="form-control eketerangan"></textarea>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="suplier_id" class="suplierID">
					<button type="submit" id="btnEdit" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div>
</form>
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
			const id = $(this).data('idsuplier');
			// Set data to Form Edit
			$('.suplierID').val(id);
			// Call Modal Edit
			$('#deleteModal').modal('show');
		});

		$('.btn-edit').on('click', function() {
			// get data from button edit
			const id = $(this).data('idsuplier');
			const namesuplier = $(this).data('namasuplier');
			const tlpn = $(this).data('tlpn');
			const hp = $(this).data('hp');
			const alamat = $(this).data('alamat');
			const ket = $(this).data('ket');

			console.log(id + namesuplier + tlpn);
			$('.enama_suplier').val(namesuplier);
			$('.eno_tlpn').val(tlpn);
			$('.eno_sales').val(hp);
			$('.ealamat').val(alamat);
			$('.eketerangan').val(ket);
			$('.suplierID').val(id);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_editsuplier').modal('show');
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

	function add_produk() {
		$('#modal_addproduk').modal('show');
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