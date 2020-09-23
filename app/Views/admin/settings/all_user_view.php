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
						<h3 class="card-title"><i class="fas fa-store-alt"></i> Data All Users </h3>

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
										<th>Nama</th>
										<th>Email</th>
										<th>Username</th>
										<th>No Tlpn</th>
										<th>Alamat</th>
										<th>Status</th>
										<th width="12%">Action</th>
									</tr>
								</thead>

								<tbody>
									<?php if ($setting_all_user) : ?>
										<?php
										$no = 1;
										foreach ($setting_all_user as $mdata) : ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $mdata->first_name; ?></td>
												<td><?php echo $mdata->email; ?></td>
												<td><?php echo $mdata->username; ?></td>
												<td><?php echo $mdata->phone; ?></td>
												<td><?php echo $mdata->alamat; ?></td>
												<!-- <td><?php if($mdata->active == 1) { echo 'Aktive'; }else {echo 'Tidak Aktive';}; ?></td> -->
												<td><?php echo ($mdata->active == 1 ? 'Aktive' : 'Tidak Aktive') ?></td>
												<td class="text-right py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="#" class="btn btn-view btn-info"
														data-idsuplier="<?= $mdata->id; ?>"
														data-namasuplier="<?= $mdata->first_name; ?>"
														data-hp="<?= $mdata->phone; ?>"
														data-alamat="<?= $mdata->alamat; ?>"
														data-ket="<?= $mdata->active; ?>"
														data-email="<?= $mdata->email; ?>"
														data-username="<?= $mdata->username; ?>"
														><i class="fas fa-eye"></i></a>
														<a href="#" class="btn btn-edit btn-primary"
														data-idsuplier="<?= $mdata->id; ?>"
														data-namasuplier="<?= $mdata->first_name; ?>"
														data-hp="<?= $mdata->phone; ?>"
														data-alamat="<?= $mdata->alamat; ?>"
														data-ket="<?= $mdata->active; ?>"
														data-email="<?= $mdata->email; ?>"
														data-username="<?= $mdata->username; ?>"
														><i class="fas fa-pencil-alt"></i></a>
														<a href="#" class="btn btn-delete btn-danger" data-idsuplier="<?= $mdata->id; ?>"><i class="fas fa-trash"></i></a>
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
<form action="<?= base_url('settings/all_user_add') ?>" method="post">
	<div class="modal fade " id="modal_addproduk" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Tambah Users</h4>
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
								<label class="control-label col-md-6">Nama Suplier</label>
								<div class="col-md-9">
									<input name="enama_suplier" placeholder="nama suplier" requeired id="nama_suplier" class="form-control enama_suplier" type="text">
									<span class="help-block"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-6">Username</label>
								<div class="col-md-9">
									<input name="username" placeholder="nama username" requeired id="username" class="form-control username" type="text">
									<span class="help-block"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-6">Password</label>
								<div class="col-md-9">
									<input name="password" placeholder="password" requeired id="password" class="form-control password" type="text">
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
							<div class="form-group" style="margin-top: 10px">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-9">
									<input name="email" id="email" placeholder="085xxxx" class="form-control email" type="email">
									<span class="help-block"></span>
								</div>
							</div>
							<hr>
							</hr>
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
									<select name="eketerangan" class="form-control eketerangan">
										<option value='1'>Aktive</option>
										<option value='0'>Non Aktive</option>
									</select>
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

					<h4>Apakah anda yakin akan menghapus data Users ?</h4>

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
<form action="<?= base_url('settings/all_user_edit') ?>" method="post">
	<div class="modal fade " id="modal_edit" role="dialog">
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

							<div class="form-group">
								<label class="control-label col-md-6">Username</label>
								<div class="col-md-9">
									<input name="username" placeholder="nama username" requeired id="username" class="form-control username" type="text">
									<span class="help-block"></span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-6">Password</label>
								<div class="col-md-9">
									<input name="password" placeholder="password" requeired id="password" class="form-control password" type="text">
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
							<div class="form-group" style="margin-top: 10px">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-9">
									<input name="email" id="email" placeholder="085xxxx" class="form-control email" type="email">
									<span class="help-block"></span>
								</div>
							</div>
							<hr>
							</hr>
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
									<select name="eketerangan" class="form-control eketerangan">
										<option value='1'>Aktive</option>
										<option value='0'>Non Aktive</option>
									</select>
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
			const hp = $(this).data('hp');
			const alamat = $(this).data('alamat');
			const ket = $(this).data('ket');
			const email = $(this).data('email');
			const username = $(this).data('username');

			console.log(id + namesuplier);
			$('.enama_suplier').val(namesuplier);
			$('.eno_sales').val(hp);
			$('.ealamat').val(alamat);
			$('.eketerangan').val(ket);
			$('.suplierID').val(id);
			$('.email').val(email);
			$('.username').val(username);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_edit').modal('show');
		});

		$('.btn-view').on('click', function() {
			const id = $(this).data('idsuplier');
			const namesuplier = $(this).data('namasuplier');
			const hp = $(this).data('hp');
			const alamat = $(this).data('alamat');
			const ket = $(this).data('ket');
			const email = $(this).data('email');
			const username = $(this).data('username');

			console.log(id + namesuplier);
			$('.enama_suplier').val(namesuplier);
			$('.eno_sales').val(hp);
			$('.ealamat').val(alamat);
			$('.eketerangan').val(ket);
			$('.suplierID').val(id);
			$('.email').val(email);
			$('.username').val(username);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_view').modal('show');
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