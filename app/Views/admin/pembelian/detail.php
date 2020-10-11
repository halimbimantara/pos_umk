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
                        <?php //echo "co".index_page();?>
                        <h3 class="card-title"><i class="fas fa-cart-plus"></i> Transaksi Pembelian Nota <?= $m_pembelian->getRow()->kd_trx_pembelian ?></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>

                        </div>
                    </div>
                    <div class="card-body">
                    <div class="row" style="margin-bottom: 10px;">
							<div class="col-xs-8">
								<a href="<?= base_url('pembelian/cetak/')."/".$kode_trx; ?>" class="btn btn-app btn-success btn-xs">
									<i class="ace-icon fa fa-print align-top bigger-125"></i>
									Cetak

</a>
								
							</div>

						</div>
                        <!-- content -->
                        <div class="col-12">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:3px">No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th style="width:100px">Total</th>
                                        <th style="width:100px">Diskon</th>
                                        <th style="width:100px">Tanggal</th>
                                        <th style="width:100px">Suplier</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ($m_pembelian) : ?>
                                        <?php
                                        $nomor = 0;
                                        foreach ($m_pembelian->getResult('array') as $mbeli) : ?>
                                            <tr>
                                                <td><?php echo ++$nomor; ?></td>
                                                <td><?php echo $mbeli['nama_barang']; ?></td>
                                                <td><?php echo number_format($mbeli['harga'], 0, '', '.');  ?></td>
                                                <td><?php echo $mbeli['qty']; ?></td>
                                                <td><?php echo number_format($mbeli['total'], 0, '', '.'); ?></td>
                                                <td><?php echo $mbeli['diskon']; ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($mbeli['created_date'])); ?></td>
                                                <td><?php echo $mbeli['nama_suplier']; ?></td>
                                            </tr>
                                        <?php
                                        endforeach; ?>
                                        <?= $total; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

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

<?= $this->endSection() ?>
<?= $this->section('jscript') ?>
<?= $this->endSection() ?>