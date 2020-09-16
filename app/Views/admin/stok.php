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
					<li class="breadcrumb-item"><a href="#">Transaksi</a></li>
					<li class="breadcrumb-item active">Stok</li>
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
						<h3 class="card-title"><i class="fas fa-store-alt"></i> Informasi Stok</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>

						</div>
					</div>
					<div class="card-body">

						<h4>Cari Berdasarkan</h4>
						<div class="row">
						<div class="col-sm-6">
								<div class="form-group">
									<label>Suplier</label>
									<select class="custom-select" name="suplier">
									<?php foreach ($suplier as $msup) : ?>
										<option>Pilih Suplier</option>
										<option value="<?= $msup->id_suplier ?>"><?= $msup->nama_suplier; ?></option>
									<?php endforeach; ?>
								</select>

								</div>
							</div>
							
								<!-- <div class="col-sm-6">
									<div class="form-group">
										<label>Kategori</label>
										<select class="custom-select" name="kategori">
									<?php //foreach ($kategori as $mkat) : ?>
										<option>Pilih Kategori</option>
										<option value="<?//= //$mkat->id ?>"><?//= $mkat->kategori; ?></option>
									<?php //endforeach; ?>
								</select>

									</div> -->
									
								<!-- </div> -->
								<div class="col-sm-6">
								<div class="form-group">
									<label>Nama Produk</label>
									<input name="nama_produk" requeired name="nama_produk" class="form-control nama_produk" type="text">
									<span class="help-block"></span>
								</div>
							</div>
								<div class="col-sm-3">
								<button type="submit" class="btn btn-primary">Go</button>
								</div>
							</div>
							

							
							
							<div class="col-sm-6">
								<div class="form-group">


								</div>
							</div>

						</div>

						<div class="col-12">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:3px">No</th>
										<th style="width:3px">Kode Produk</th>
										<th>Label</th>
										<th>Nama Produk</th>
										<th style="width:3px">Harga Eceran</th>
										<th style="width:3px">Harga Grosir</th>
										<th style="width:3px">Sisa Stok</th>
										<th style="width:3px">K2</th>
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
										foreach ($produk as $mbeli) : ?>
											<tr>
												<td width="5%"><?php echo $no; ?></td>
												<td width="10%"><?php echo $mbeli->kd_produk; ?></td>
												<td width="3%"></td>
												<td width="40%"><?php echo $mbeli->nama_produk; ?></td>
												<td><?php echo number_format($mbeli->harga_eceran, 0, '', '.'); ?></td>
												<td><?php echo  number_format($mbeli->harga_grosir, 0, '', '.'); ?></td>
												<td><?php echo $mbeli->stok_total == "" ? 0 : $mbeli->stok_total; ?></td>
												<td></td>
												<td>Detail</td>
											</tr>
										<?php
											$no++;
										endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
							<div class="row">

							</div>
						</div>
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
<!--  -->

<?= $this->endSection(); ?>
<? $this->section('jscript'); ?>
<?= $this->endSection(); ?>