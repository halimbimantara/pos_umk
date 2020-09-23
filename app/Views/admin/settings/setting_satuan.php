<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Macam Kemasan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Setting</a></li>
                    <li class="breadcrumb-item active">Kemasan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">

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
    <div class="col-md-4">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-header border-0">
                <h3 class="card-title">Kemasan Eceran</h3>
                <div class="card-tools">
                  <a href="#" id="btn_add_satuan" class="btn btn-tool btn-sm">
                    <i class="fas fa-edit"></i>
                  </a>
                  
                </div>
              </div>
            </div>


            <!-- /.card-header -->
            <!-- form start -->

            <!-- <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Success alert preview. This alert is dismissable.
                </div> -->
            <!-- /.card-body -->

            <table style="margin-left: 10px;" id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width:3px">Kode</th>
                        <th size="2">Nama Kemasan</th>
                        <th style="width:100px">
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            #
                        </th>
                        <!-- <th class="hidden-480">Status</th> -->
                    </tr>
                </thead>
                <?php if ($k1) : ?>
                    <?php
                    $nomor = 1;
                    foreach ($k1 as $mbeli) : ?>
                        <tr>
                            <td><?php echo $mbeli->kd_kemasan; ?></td>
                            <td><?php echo $mbeli->nama; ?></td>
                        </tr>
                    <?php
                    endforeach; ?>
                <?php endif; ?>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-4">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Kemasan Grosir</h3>
            </div>
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width:3px">Kode</th>
                        <th size="2">K Grosir</th>
                        <th style="width:100px">
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            #
                        </th>
                        <!-- <th class="hidden-480">Status</th> -->
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-4">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Satuan</h3>
            </div>
            <table id="simple-table" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width:3px">Kode</th>
                        <th size="2">Nama Satuan</th>
                        <th style="width:100px">
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            #
                        </th>
                        <!-- <th class="hidden-480">Status</th> -->
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>
<!-- Cetak Nota Beli -->
<div class="modal fade " id="modal_add" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h4 class="modal-title">Tambah Satuan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">ID SATUAN</label>
						<div class="col-md-9">
							<input name="kd_satuan" id="kd_satuan" class="form-control" type="text">
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">ISTILAH</label>
						<div class="col-md-9">
							<input name="istilah" id="istilah" class="form-control" type="text">
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
btn_add_satuan
<?= $this->endSection() ?>

<?= $this->section('jscript') ?>
<script>
    
</script>
<?= $this->endSection() ?>