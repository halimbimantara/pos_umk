<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-cart-plus"></i> List Produk Suplier <?= $nama_suplier; ?></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>

                        </div>
                    </div>
                    <div class="card-body">
<div class="col-12">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:3px">No</th>
										<th style="width:3px">Kode Produk</th>
										<th>Nama Produk</th>
										<th style="width:3px">Harga Beli Terkahir</th>
										<th style="width:3px">Sisa Stok</th>
										<!-- <th style="width:100px">
											<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
											Action
										</th> -->
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
												<td width="40%"><?php echo $mbeli->nama_barang; ?></td>
												<td><?php echo number_format($mbeli->harga, 0, '', '.'); ?></td>
												<td><?php echo $mbeli->stok == ""?0:$mbeli->stok ; ?></td>
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
<?= $this->endSection(); ?>
<? $this->section('jscript'); ?>
<?= $this->endSection(); ?>