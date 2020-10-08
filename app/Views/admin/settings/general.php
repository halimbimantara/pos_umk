<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid" style="margin-top: 10px;">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General Setting</h3>
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

                <form role="form" id="form-general-setting" action="<?= base_url() . "/settings/updateGeneralSetting"; ?>" enctype="multipart/form-data" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Aplikasi</label>
                            <input type="text" class="form-control" name="nama_aplikasi" disabled value="<?= $data[0]->nama_apps; ?>" placeholder="Enter nama aplikasi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Tempat Usaha</label>
                            <input type="text" class="form-control" name="nama_usaha" value="<?= $data[0]->nama_usaha; ?>" placeholder="Enter nama aplikasi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor telepon</label>
                            <input type="text" class="form-control" name="no_tlpn" value="<?= $data[0]->no_tlpn; ?>" placeholder="Enter nama aplikasi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor WA</label>
                            <input type="text" class="form-control" name="no_wa" value="<?= $data[0]->no_wa; ?>" placeholder="Enter nama aplikasi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alamat Usaha</label>
                            <textarea class="form-control" name="alamat_usaha" value="" rows="3" placeholder="Enter ..."><?= $data[0]->alamat_usaha; ?></textarea>
                        </div>
                        <div class="form-group">
                        <img class="profile-user-img img-fluid" src="<?= ( $data[0]->logo !=null ? base_url()."/resources/uploads/".$data[0]->logo : base_url()."/resources/dist/img/avatar.png" ) ?>" alt="User profile picture">
                                    <label for="inputSkills">Upload Logo</label>
                                    <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" name="file_upload" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    </div>
                                </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Delivery Setting</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Provinsi</label>
                            <input type="email" class="form-control" id="provinsi" placeholder="Jawa Timur">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kab / Kota</label>
                            <input type="text" class="form-control" id="kab_kota" placeholder="Kediri">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jalan / Desa</label>
                            <input type="text" class="form-control" id="kecamatan" placeholder="">
                        </div>
                    
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<? $this->section('jscript'); ?>

<!-- bs-custom-file-input -->
<script src="<?= base_url("resources/plugins/bs-custom-file-input/bs-custom-file-input.min.js")?>"></script>

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<?= $this->endSection(); ?>