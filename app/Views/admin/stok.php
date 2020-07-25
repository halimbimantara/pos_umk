<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>

<div class="col-12">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th style="width:3px">No</th>
										<th style="width:3px">Kode Produk</th>
										<th>Nama Produk</th>
										<th style="width:3px">Harga Eceran</th>
										<th style="width:3px">Harga Grosir</th>
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
												<td width="40%"><?php echo $mbeli->nama_produk; ?></td>
												<td><?php echo number_format($mbeli->harga_eceran, 0, '', '.'); ?></td>
												<td><?php echo  number_format($mbeli->harga_grosir, 0, '', '.'); ?></td>
												<td><?php echo $mbeli->stok_total == ""?0:$mbeli->stok_total ; ?></td>
											</tr>
										<?php
											$no++;
										endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
							<div class="row">
								
							</div>
						</div><!-- /.
<?= $this->endSection(); ?>
<? $this->section('jscript'); ?>
<?= $this->endSection(); ?>