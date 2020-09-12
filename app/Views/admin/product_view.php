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
					<li class="breadcrumb-item active">Produk</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-store-alt"></i> Produk Toko</h3>

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
										<!-- <th class="center">
								<label class="pos-rel">
									<input type="checkbox" class="ace" />
									<span class="lbl"></span>
								</label>
							</th> -->
										<th style="width:3px">No</th>
										<th style="width:3px">Kode Barcode</th>
										<th>Nama Produk</th>
										<th style="width:3px">Kategori</th>
										<th style="width:3px">Harga Eceran</th>
										<th style="width:3px">Harga Grosir</th>
										<th style="width:3px">Minimum Grosir</th>
										<th width="10%">Tanggal Buat</th>
										<th>Keterangan</th>
										<th style="width:100px">
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Action
										</th>
										<!-- <th class="hidden-480">Status</th> -->
									</tr>
								</thead>

								<tbody>
									<?php if ($produk) : ?>
										<?php
										$no = 1;
										foreach ($produk as $mbeli) :

											$hjual = $mbeli->harga_jual + ($mbeli->harga_jual * ($margin / 100));
										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $mbeli->kd_barcode; ?></td>
												<td><?php echo $mbeli->nama_produk; ?></td>
												<td><?php echo $mbeli->kategori; ?></td>
												<!-- Jika ada harga produk manual maka cantumkan yg manual -->
												<td><?php echo $mbeli->harga_eceran > 0 ? number_format($mbeli->harga_eceran, 0, '', '.') : number_format($hjual, 0, '', '.'); ?></td>
												<td><?php echo  number_format($mbeli->harga_grosir, 0, '', '.'); ?></td>
												<td><?php echo $mbeli->batas_grosir; ?></td>
												<td><?php echo date("d-m-Y", strtotime($mbeli->created_date)); ?></td>
												<td><?php echo $mbeli->keterangan; ?></td>
												<td>
													<div class="hidden-md hidden-lg">
														<div class="inline pos-rel">

															<button type="button" class="btn-xs	 btn-outline-success small"> <i class="fa fa-eye"></i></button>
															<button type="button" class="btn-xs	btn-edit   btn-outline-primary small" data-id="<?= $mbeli->kd_produk; ?>" data-batas_grosir="<?= $mbeli->batas_grosir; ?>" data-batas_maxgrosir="<?= $mbeli->batas_max_stok; ?>" data-barcode="<?= $mbeli->kd_barcode; ?>" data-name="<?= $mbeli->nama_produk; ?>" data-heceran="<?= $mbeli->harga_jual == NULL ? 0 : $mbeli->harga_jual; ?>"> <i class="fa fa-edit"></i></button>
															<button type="button" class="btn-xs	  btn-outline-danger small"> <i class="fa fa-trash"></i></button>

														</div>
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

<div class="modal fade " id="modal_addproduk" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title">Tambah produk baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<?= \Config\Services::validation()->listErrors(); ?>
				<form action="#" id="form_addprod" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" value="" name="id" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Kode Barcode</label>
							<div class="col-md-9">
								<div class="input-group input-group-sm">
									<input type="text" id="kd_barcode" class="form-control">
									<span class="input-group-append">
										<button type="button" onclick="generateBarcode()" class="btn btn-info btn-flat"><i class="fa fa-barcode" aria-hidden="true"></i> Generate</button>
									</span>
								</div>
								<!-- <input name="kd_barcode" id="kd_barcode" class="form-control" type="text">
								<span class="help-block"></span> -->
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Nama Produk</label>
							<div class="col-md-9">
								<input name="nama_produk" requeired id="nama_produk" class="form-control" type="text">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Kategori</label>
							<div class="col-md-9">
								<select class="custom-select" name="kategori">
									<?php foreach ($kategori as $mkat) : ?>
										<option value="<?= $mkat->id ?>"><?= $mkat->kategori; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-6">Batas Minimum stok</label>
							<div class="col-md-9">
								<input disabled name="b_min_stok" id="b_min_stok" class="form-control" type="number">
								<span class="help-block">10% Dari Maksimum </span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-6">Batas Maksimal stok</label>
							<div class="col-md-9">
								<input onchange="setminstok(this.value)" name="b_max_stok" id="b_max_stok" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>

						<hr>


						<div class="form-group">
							<label class="control-label col-md-3">Kemasan [K1]</label>
							<div class="col-md-9">
								<div class="form-group">
									<!-- <label>Custom Select</label> -->
									<select class="custom-select" name="kemasan_k1">
										<?php foreach ($kemasan as $mkemasan) : ?>
											<option value="<?= $mkemasan->id ?>"><?= $mkemasan->nama; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>

						<hr>
						<div class="form-group">
							<label class="control-label col-md-3">Gambar</label>
							<div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="customFile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
						</div>
						<div class="form-group" hidden>
							<label class="control-label col-md-3">Harga Eceran</label>
							<div class="col-md-9">
								<input name="add_harga" id="add_harga" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group" hidden>
							<label class="control-label col-md-3">Harga Grosir</label>
							<div class="col-md-9">
								<input name="harga_grosir" id="harga_grosir" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>
						<!-- K2  -->
						<div class="form-group" hidden>
							<label class="control-label col-md-3">Minimal Qty Grosir</label>
							<div class="col-md-9">
								<input name="batas_grosir" id="batas_grosir" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save_newproduk()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Bootstrap modal -->

<!-- Edit  -->
<form action="<?= base_url('produk/editProduk') ?>" method="post">
	<div class="modal fade " id="modal_editproduk" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-secondary">
					<h4 class="modal-title">Edit Produk</h4>
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
								<label class="control-label col-md-6">Kode Barcode</label>
								<div class="col-md-9">
									<input name="Ekd_barcode" class="form-control kd_barcode" type="text">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Kode Produk</label>
								<div class="col-md-9">
									<input name="Ekd_produk" class="form-control kd_produk" type="text" disabled>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Nama Produk</label>
								<div class="col-md-9">
									<input name="Enama_produk" requeired name="nama_produk" class="form-control nama_produk" type="text">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Harga Eceran + Margin <?= $margin; ?>%</label>
								<div class="col-md-9">
									<input name="edit_harga" class="form-control edit_harga" type="number" disabled>
									<span class="help-block"></span>
								</div>
								<div class="form-check">
									<input class="form-check-input" id="c_setharga" name="c_setharga" type="checkbox">
									<label class="form-check-label">Set Harga Manual</label>
								</div>
							</div>
							<input type="hidden" id="margin" value="<?= $margin; ?>">
							<div id="form-hargamanual" class="form-group">
								<label class="control-label col-md-3">Setting Harga Jual</label>
								<div class="col-md-9">
									<input name="eharga_meceran" class="form-control eharga_meceran" type="number">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group" hidden>
								<label class="control-label col-md-3">Harga Grosir</label>
								<div class="col-md-9">
									<input name="eharga_grosir" class="form-control harga_grosir" type="number">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group" hidden>
								<label class="control-label col-md-3">Minimal Qty Grosir</label>
								<div class="col-md-9">
									<input name="ebatas_grosir" class="form-control batas_grosir" type="number">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-6">Notif minimal stok</label>
								<div class="col-md-9">
									<input name="eb_min_stok" class="form-control b_min_stok" type="number">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Notif Maksimal stok</label>
								<div class="col-md-9">
									<input name="eb_max_stok" class="form-control b_max_stok" type="number">
									<span class="help-block"></span>
								</div>
							</div>

						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnEdit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</form>
<!-- End -->
<?= $this->endSection(); ?>
<? $this->section('jscript'); ?>

<script src="<?= base_url("resources/assets/js/jquery-ui.custom.min.js") ?>"></script>
<script src="<?= base_url("resources/assets/js/jquery.ui.touch-punch.min.js") ?>"></script>
<script src="<?= base_url("resources/assets/js/chosen.jquery.min.js") ?>"></script>
<script src="<?= base_url("resources/assets/js/chosen.jquery.min.js") ?>"></script>
<script src="<?= base_url("resources/plugins/bs-custom-file-input/bs-custom-file-input.min.js") ?>"></script>
<script type="text/javascript">

$(document).ready(function () {
  bsCustomFileInput.init();
});
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
		$('.btn-edit').on('click', function() {
			// get data from button edit
			const id = $(this).data('id');
			const barcode = $(this).data('barcode');
			const name = $(this).data('name');
			const price = $(this).data('heceran');
			const max_grosir = $(this).data('batas_maxgrosir');
			const min_grosir = $(this).data('batas_grosir');
			// Set data to Form Edit
			$('.kd_barcode').val(barcode);
			var margin = $('#margin').val();
			var total_margin = 0;
			if (price == 'NULL') {
				total_margin = 0;
				//belum melakukan pembelian
			} else {
				// $hjual = $hbeli + ($hbeli * ($margin / 100));
				total_margin = parseFloat(price) + parseFloat(price * (parseFloat(margin) / 100));
			}
			$('.kd_produk').val(id);
			$('.nama_produk').val(name);
			$('.eharga_meceran').val(0);
			$('.edit_harga').val(total_margin);
			// $('.product_category').val(category).trigger('change');
			// Call Modal Edit
			$('#modal_editproduk').modal('show');
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

	function setminstok(val) {
		 var total_min =  parseFloat(val) * 0.1;
		$('#b_min_stok').val(total_min);
	}

	function add_person() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Transaksi Pembelian'); // Set Title to Bootstrap modal title
	}


	function save_newproduk() {
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
			dataType: 'json',
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


	function generateBarcode() {
		$.ajax({
			url: "<?php echo site_url('produk/genbarcode') ?>",
			type: "GET",
			success: function(data) {
				$("#kd_barcode").val(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error deleting data');
			}
		});
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