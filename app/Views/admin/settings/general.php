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

                <form role="form" id="form-general-setting" action="<?= base_url() . "/settings/updateGeneralSetting"; ?>" method="post">
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
                    <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
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