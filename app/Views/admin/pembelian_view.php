<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url("resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
<!-- Bootstrap Switch -->
<script src="<?= base_url("resources/plugins/bootstrap-switch/js/bootstrap-switch.min.js") ?>"></script>
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
					<li class="breadcrumb-item active">Transaksi Pembelian / Belanja Toko</li>
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
						<h3 class="card-title"><i class="fas fa-cart-plus"></i> Transaksi Pembelian / Belanja Toko</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>

						</div>
					</div>
					<div class="card-body">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-xs-8">
								<button class="btn btn-app btn-success btn-xs" onclick="add_person()">
									<i class="ace-icon fa fa-shopping-basket align-top bigger-125"></i>
									Tambah

								</button>
								<button class="btn btn-app btn-success btn-xs" onclick="show_notadialog()">
									<i class="ace-icon fa fa-receipt align-top bigger-125"></i>
									Cetak No Nota

								</button>
							</div>

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
										<th style="width:100px">No Nota</th>
										<th>Nama Suplier</th>
										<th style="width:100px">Total Nota</th>
										<th style="width:100px">Tanggal</th>
										<th style="width:100px">
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Action
										</th>
										<!-- <th class="hidden-480">Status</th> -->
									</tr>
								</thead>

								<tbody>
									<?php
									if ($m_pembelian) : ?>
										<?php
										foreach ($m_pembelian as $mbeli) : ?>
											<tr>
												<td><?php echo ++$nomor; ?></td>
												<td><?php echo $mbeli['kd_trx_pembelian']; ?></td>
												<td><?php echo $mbeli['nama_suplier'] . "</br>" . $mbeli['keterangan']; ?></td>
												<td><?php echo number_format($mbeli['total_pembelian'], 0, '', '.'); ?></td>
												<td><?php echo date("d-m-Y", strtotime($mbeli['created_date'])); ?></td>
												<td>
													<div class="hidden-md hidden-lg">
														<div class="inline pos-rel">
															<a href="pembelian/detailpembelian/<?= $mbeli['kd_trx_pembelian']; ?>" type="button" href= class="btn-xs btn-outline-success small"> <i class="fa fa-eye"></i></a>
															<button type="button" class="btn-xs	  btn-outline-primary small"> <i class="fa fa-edit"></i></button>
															<button type="button" class="btn-xs	  btn-outline-danger small"> <i class="fa fa-trash"></i></button>

														</div>
													</div>

												</td>
											</tr>
										<?php
										endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<?php if ($pager) : ?>
											<?php $pagi_path = 'pos_beta/public/pembelian'; ?>
											<?php $pager->setPath($pagi_path); ?>
											<?php echo $pager->links('pembelian', 'bootstrap_pagination') ?>
										<?php endif ?>
									</div>
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

<input type="hidden" id="nota_pembelian" value="<?= $nota_pembelian; ?>">
<!-- inline scripts related to this page -->
<!-- Bootstrap modal -->
<div class="modal fade " id="modal_form" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title">Large Modal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<div id="no_nota">
				</div>
				<!-- <h4>Nomor Nota :</h4> -->
				<form action="#" id="form-pembelian" class="form-horizontal">
					<input type="hidden" name="kd_trx" id="kd_trx" value="<?= $nota_pembelian; ?>" />
					<div class="form-body">
						<label class="control-label col-md-3">Produk</label>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<select onchange="showBarang(this.value)" autocomplete="off" id="id_barang" name="id_barang" required="true" class="form-control select2" data-placeholder="Cari Produk...">
										<?php if ($produk) : ?>
											<?php
											$no = 1;
											foreach ($produk->getResult('array')  as $row) { ?>
												<option value=""> </option>
												<option value="<?= $row['kd_produk'] ?>"><?= $row['nama_produk'] ?></option>
											<?php $no++;
											} ?>
										<?php endif; ?>
									</select>

									<button style="margin-top: 6px" type="button" id="btn_addProduk" onclick="add_produk()" class="btn btn-white btn-info btn-bold">
										<i class="fas fa-cart-plus"></i>
										Produk
									</button>
									<div class="form-group">
										<label class="control-label col-md-6">Tampilkan Gambar</label>
										<input type="checkbox" id="gambar-checkbox" name="gambar-checkbox" data-bootstrap-switch label="">
									</div>

								</div>
								<div class="col-sm-6">
									<img id="img_produk" src="<?= base_url("resources/dist/img/avatar.png"); ?>" style="width: inherit;height: inherit;" />
								</div>
							</div>

							<!-- <div class="col-md" -->
						</div>

						<div id="data_produk">

							<input type="hidden" name="tot_stok" id="tot_stok" value="" />
							<div class="form-group">
								<label class="control-label col-md-3">Harga</label>
								<div class="col-md-9">
									<input name="harga" disabled id="harga" class="form-control" type="number">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Harga</label>
							<div class="col-md-9">
								<input name="harga_beli" id="harga_beli" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Qty</label>
							<div class="col-md-9">
								<input name="qty" min=0 oninput="validity.valid||(value='');" id="qty" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Potongan</label>
							<div class="col-md-9">
								<input name="diskon" min=0 oninput="validity.valid||(value='');" id="diskon" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Suplier</label>
							<div class="col-md-9">
								<!--  -->
								<select autocomplete="off" id="id_suplier" name="id_suplier" required="true" class="form-control select2" data-placeholder="Cari Suplier...">
								</select>
							</div>
						</div>
						<div class="form-group" style="margin-top: 10px">
							<label class="control-label col-md-3">Keterangan</label>
							<div class="col-md-9">
								<textarea name="address" placeholder="Address" class="form-control"></textarea>
								<span class="help-block"></span>
							</div>
						</div>


				<button type="button" id="btnSave" onclick="savebarang()" class="btn btn-primary">Tambah</button>

						<table id="table-pembelian-temp" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th style="width:3px">No</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Harga</th>
									<th>Qty</th>
									<th>Diskon</th>
									<th>Sub Total</th>
									<th>Catatan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="table-content">
							</tbody>

							<!-- <tfoot>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Gender</th>
									<th>Address</th>
									<th>Date of Birth</th>
									<th>Action</th>
								</tr>
							</tfoot> -->
						</table>
						<div id="respon_ajax"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSelesai" disabled onclick="selesai()" class="btn btn-warning">Selesai</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Cetak Nota Beli -->
<div class="modal fade " id="modal_cetaknota" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title">Cetak Nota Beli</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Kode Transaksi</label>
						<div class="col-md-9">
							<input name="kd_trxbeli" id="kd_trxbeli" class="form-control" type="text">
							<span class="help-block"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_cetak" onclick="cetak()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<!-- Detail Nota -->
<div class="modal fade " id="modal_detailnota" role="dialog">
	<div class="modal-dialog modal">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title">Detail transaksi nota pembelian</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Kode Transaksi</label>
						<div class="col-md-9">
							<input name="kode_trxbeli" id="kode_trxbeli" class="form-control" type="text">
							<span class="help-block"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_cetak" onclick="save_newproduk()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<!-- End Bootstrap modal -->
<div class="modal fade " id="modal_addproduk" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Tambah Produk Baru</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" value="" name="id" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Kode Barcode</label>
							<div class="col-md-9">
								<input name="add_kodeproduk_barcode" id="add_kodeproduk_barcode" class="form-control select2" type="text">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Kode Produk</label>
							<div class="col-md-9">
								<input name="add_kodeproduk" id="add_kodeproduk" class="form-control" type="text">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Nama Produk</label>
							<div class="col-md-9">
								<input name="add_produk" id="add_produk" class="form-control" type="text">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Harga Eceran</label>
							<div class="col-md-9">
								<input name="add_harga" id="add_harga" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Harga Grosir</label>
							<div class="col-md-9">
								<input name="add_harga_grosir" id="add_harga_grosir" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Minimal Qty Grosir</label>
							<div class="col-md-9">
								<input name="add_qtymin_grosir" id="add_qtymin_grosir" class="form-control" type="number">
								<span class="help-block"></span>
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSaveProduk" onclick="save_newproduk()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<?= $this->endSection() ?>
<?= $this->section('jscript') ?>
<script src="<?= base_url("resources/plugins/bootstrap-switch/js/bootstrap-switch.min.js") ?>"></script>
<script type="text/javascript">
	$('.select2').select2();
	var save_method; //for save method string
	var nota_pembelian;
	var selesai_pembelian;

	$(document).ready(function() {
		$("#id_barang").select2({
			ajax: {
				url: "<?= base_url("pembelian/getProdukSelect") ?>",
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});

	$(document).ready(function() {
		$("#id_suplier").select2({
			ajax: {
				url: "<?= base_url("pembelian/getsuplier") ?>",
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
	$("#img_produk").hide();
	$("#gambar-checkbox").change(function() {
		var img_uri = $("#url_image").val();
		if (this.checked) {
			if (!img_uri.empty) {
				console.log(img_uri);
				$("#img_produk").attr("src", "<?= base_url('resources/dist/img/') ?>" + '/' + img_uri + "");
				$("#img_produk").show();
			} else {
				alert("gambar tidak ada");
			}
		} else {
			$("#img_produk").hide();
		}
	});


	function cektotalrow(){
		nota_pembelian = $("#nota_pembelian").val();
		$.ajax({
			url: "<?= base_url("pembelian/cektotalrow") ?>"+"/"+nota_pembelian,
			type: "GET",
			success: function(data) {
				var json = JSON.parse(data);
				if (json.success) {
					console.log(json.total_row);
					if(json.total_row > 0){
						console.log("ada item");
						$('#btnSelesai').removeAttr('disabled', true);
					}else{
						$('#btnSelesai').attr('disabled', true);
					}
				} else {
					alert("Gagal Menambahkan");
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


	function detailnotabeli(str){
		$('#modal_detailnota').modal('show'); // 
		$('#modal_detailnota .modal-title').text('Detail transaksi nota pembelian '+str);
	}

	function add_person() {
		nota_pembelian = $("#nota_pembelian").val();
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('#modal_form .modal-title').text('Transaksi Pembelian :' + nota_pembelian); // Set Title to Bootstrap modal title
		reload_table();
	}

	function show_notadialog() {
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_cetaknota').modal('show'); // show bootstrap modal\Set Title to Bootstrap modal title
		reload_table(nota_pembelian);
	}

	function add_produk() {
		$('#modal_form').modal('hide');
		$('#modal_addproduk').modal('show');
	}

	function reloadTable(str) {
		$("#table-content").load("<?= base_url('pembelian/getTempTable') ?>/" + str);
		cektotalrow();
	}

	function cetak(){
		var nota_cetak =$('#kd_trxbeli').val();
		window.location.assign('<?= base_url()?>/pembelian/cetak/'+nota_cetak);
	}


	function savebarang() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable 
		$('#btn_addProduk').attr('disabled', true); //set button disable 
		var url;
		save_method = 'add';
		if (save_method == 'add') {
			url = "<?php echo site_url('pembelian/addtemp') ?>";
		} else {
			url = "<?php echo site_url('person/ajax_update') ?>";
		}
		// ajax adding data to databasection url
		var form_data = $('#form-pembelian').serialize(); //Encode form elements for submission
		// ajax adding data to database
		$.ajax({
			url: url,
			type: "POST",
			data: form_data,
			success: function(data) {
				$('#btnSave').text('tambah'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 
				$('#btn_addProduk').attr('disabled', false); //set 
				$('#response_ajax').load(data);
				var json = JSON.parse(data);
				if (json.success) {
					$("#form-pembelian")[0].reset();
					reloadTable(nota_pembelian);
				} else {
					alert("Gagal Menambahkan");
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

	function selesai() {
		var url = "<?php echo site_url('pembelian/selesai_pembelian') ?>";
		// close dialog dan print
		var form_data
		$.ajax({
			url: url,
			type: "POST",
			data: {
				kd_trx: nota_pembelian,
				keterangan:"-",
				id_suplier : $("#id_suplier").val()

			},
			success: function(data) {
				$('#btnSave').text('tambah'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 
				$('#btn_addProduk').attr('disabled', false); //set 
				var json = JSON.parse(data);
				if (json.success) {
					//print 
					$('#form')[0].reset();
					window.location.assign('<?= base_url()?>/pembelian/cetak/'+nota_pembelian);
				} else {
					alert("Gagal Menambahkan");
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('#response_ajax').load(errorThrown);
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 
				$('#btn_addProduk').attr('disabled', false); //set 
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
			$("#data_produk").load("<?= base_url('pembelian/getProduk') ?>/" + str);
			var img_uri = $("#url_image").val();
			$("#img_produk").delay(800).attr("src", "<?= base_url('resources/dist/img/') ?>" + '/' + img_uri + "");
		}
	}

	function delete_tabtemp(id) {
		if (confirm('Apakah anda yakin untuk menghapusnya?')) {
			// ajax delete data to database
			$.ajax({
				url: "<?php echo site_url('pembelian/tempDelete') ?>/" + id,
				type: "GET",
				success: function(data) {
					var json = JSON.parse(data);
					if (json.success) {
						reloadTable(nota_pembelian);

					} else {
						alert("Gagal Menghapus");
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error deleting data ' + errorThrown);
				}
			});
		}
	}

	function cetak_nota_beli(str) {
		window.open("https://www.w3schools.com");
	}
</script>
<?= $this->endSection() ?>