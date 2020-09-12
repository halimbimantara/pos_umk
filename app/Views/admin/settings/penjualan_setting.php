<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid" style="margin-top: 10px;">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Penjualan Setting</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
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
                <!-- <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Success alert preview. This alert is dismissable.
                </div> -->

                <form role="form" id="form-general-setting" action="<?= base_url() . "/settings/updateMargin"; ?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Margin Penjualan Dalam Persen(%)</label>
                            <input type="text" class="form-control" name="margin_penjualan" value="<?= $margin->margin; ?>" placeholder="Enter nama aplikasi">
                            <input type="hidden"  name="id_margin" value="<?= $margin->id; ?>" placeholder="Enter nama aplikasi">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">History Perubahan Margin</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>