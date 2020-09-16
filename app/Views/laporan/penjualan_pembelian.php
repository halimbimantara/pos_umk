<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url("resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
<link rel="stylesheet" href="<?= base_url("resources/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css") ?>">
<!-- Bootstrap Switch -->
<script src="<?= base_url("resources/plugins/bootstrap-switch/js/bootstrap-switch.min.js") ?>"></script>
<style>
    .modal-header,
    h4-x,
    .close {
        background-color: #5cb85c;
        color: white !important;
        text-align: center;
        font-size: 30px;
    }

    .modal-footer {
        background-color: #f9f9f9;
    }

    .btn.btn-circle.btn-mn {
        width: 20px;
        height: 20px;
        padding: 0px;
        font-size: 1em;
    }
</style>
<section class="content">
    <div style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Pembelian </h3>
                    </div>
                    <div class="card-body">
                        <!-- Date range -->
                        <div class="form-group">
                            <label>Berdasar Rentang Tanggal :</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation_a">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- Date and time range -->
                        <div class="form-group">
                            <label>Berdasarkan Bulan:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control float-right" id="pemb_dataemonth">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->



                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- /.card -->
            </div>

            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Laporan Penjualan </h3>
                    </div>
                    <div class="card-body">
                        <!-- Date range -->
                        <div class="form-group">
                            <label>Berdasar Rentang Tanggal :</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- Date and time range -->
                        <div class="form-group">
                            <label>Berdasarkan Bulan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control float-right" id="penj_month">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group">
                            <label>Cetak Nota Penjualan:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control float-right" id="nota_jual">
                            </div>
                            <br>
                            <button id="btn_addtmp" type="submit" onclick="cetaknotajual()" class="btn btn-primary"><i class"ace-icon fa fa-receipt align-top bigger-125"></i>Cetak</button>
                            <!-- /.input group -->
                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- /.card -->
            </div>
        </div>
    </div>
    </div>

</section>

<?= $this->endSection() ?>
<?= $this->section('jscript') ?>
<!-- InputMask -->
<script src="<?php echo base_url("resources/plugins/moment/moment.min.js") ?>"></script>
<script src="<?php echo base_url("resources/plugins/inputmask/min/jquery.inputmask.bundle.min.js") ?>"></script>
<script src="<?php echo base_url("resources/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") ?>"></script>
<script src="<?php echo base_url("resources/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script>
    $(function() {

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'MM/DD/YYYY'
            }
        })
        $('#reservation_a').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            }
        })
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        $('#pemb_dataemonth').datepicker({
            startView: 1,
            minViewMode: 1,
            todayHighlight: true,
            beforeShowMonth: function(date) {
                if (date.getMonth() == 8) {
                    return false;
                }
            }
        });
        $('#penj_month').datepicker({
            startView: 1,
            minViewMode: 1,
            todayHighlight: true,
            beforeShowMonth: function(date) {
                if (date.getMonth() == 8) {
                    return false;
                }
            }
        });
    })

    function cetaknotajual() {
        var nota_cetak = $('#nota_jual').val();
        if (nota_cetak == "") {
            alert("no nota tidak boleh kosong");
        } else {
            window.location.assign('<?= base_url() ?>/pos/cetak/' + nota_cetak);
        }
    }
</script>
<?= $this->endSection() ?>