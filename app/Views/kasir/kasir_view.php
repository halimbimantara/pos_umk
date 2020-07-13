<?= $this->extend('default_top_layout') ?>
<?= $this->section('content') ?>
<div class="content-header">
</div>
<!-- content -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kasir Transaksi</h3>
                        <div class="card-tools">
                            <span class="badge badge-danger">No Nota <?= $nota_penjualan; ?></span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <form role="form">
                            <div class="card-body">
                                <!-- <div class="row"> -->

                                <div class="form-group">
                                    <label for="idprodukbarcode">Nama Produk / Barcode</label>
                                    <!-- <input type="text" class="form-control" id="idprodukbarcode" placeholder="Masukan nama / letakan kursor"> -->
                                    <select onchange="showBarang(this.value)" autocomplete="off" id="id_barang" name="id_barang" required="true" style="width: 100%;" class="form-control  select2bs4" data-placeholder="Cari Produk..."></select>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="gambar_checkbox">
                                    <label class="form-check-label" for="exampleCheck1">Tampil Gambar ?</label>
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <!-- <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div> -->
                        </form>
                        <!--Table -->
                        <table id="table-penjualan-temp" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:3px">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Diskon</th>
                                    <th>Sub Total</th>
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

                    </div>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer text-center">
                    <a href="javascript::">View All Users</a>
                </div> -->
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-5">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                            <div id="total_belanja">
                                <div class="info-box-content">
                                    <span class="info-box-text">Total</span>
                                    <span class="info-box-number">0</span>
                                </div>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-5">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Kasir Anton</span>
                                <span class="info-box-number">11001</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <div class="col-12 col-sm-8 col-md-12">
                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Produk</h3>
                            <div class="card-tools">
                                <!-- <span class="badge badge-danger">id produk</span> -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <form action="#" id="form-addtemp" class="form-horizontal">
                                <input type="hidden" id="kd_trxpenjualan" name="kd_trxpenjualan" value="<?= $nota_penjualan ?>" />
                                <div id="detail_item"></div>
                            </form>
                            <!--Table -->

                        </div>
                        <div id="response_ajax"></div>
                        <!-- /.card-body -->
                        <div class="form-group">
                            <div class="row" style="padding: 10px;">
                                <div class="col-md-6">
                                    <label class="control-label col-md-5">Bayar</label>
                                    <input name="bayar" id="bayar" type="number" oninput='validity.valid||(value="");' class="form-control" onchange="showKembali(this.value)" onkeyup="showKembali(this.value)">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-5">Kembalian</label>
                                    <input name="kembalian" disabled id="kembalian" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button id="btn_addtmp" type="submit" onclick="addbarangtemp()" class="btn btn-primary">Tambahkan</button>
                            <button id="btn_selesai" hidden type="submit" onclick="" class="btn btn-success">Selesai</button>

                        </div>
                        <!-- <div class="card-footer text-center">
                    <a href="javascript::">View All Users</a>
                </div> -->
                        <!-- /.card-footer -->
                    </div>
                    <!--/.card -->
                </div>
            </div>

            <!-- /.col -->
        </div>

    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('jscript') ?>
<script type="text/javascript">
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
    var save_method; //for save method string
    var nota_penjualan = $("#kd_trxpenjualan").val();
    var selesai_penjualan;

    $("#btn_addtmp").hide();
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
    });

    function showBarang(str) {
        if (str == "") {
            $('#nama_barang').val('');
            $('#harga_barang').val('');
            $('#qty').val('');
            $('#reset').hide();
            return;
        } else {
            // add to db temp jual
            $("#detail_item").load("<?= base_url('pos/showproduk') ?>/" + str);
            var img_uri = $("#url_image").val();
            $(".badge-danger").add();
            $("#img_produk").delay(800).attr("src", "<?= base_url('resources/dist/img/') ?>" + '/' + img_uri + "");
            $("#btn_addtmp").show();
        }
    }

    function showKembali(str) {
        var total = $('#mtotal_belanja').val().replace(".", "").replace(".", "");
        //   var temps =$('#total_temps').val();
        //   var bayar = str.replace(".", "").replace(".", "");
        if(str.empty){
            $('#kembalian').val("");
        }else{
            var kembali = str - total;
            $('#kembalian').val(convertToRupiah(kembali));
        }
        //   if(temps == '') {
        //       $('#selesai').attr("disabled","disabled");
        //   }else{
        //       $('#selesai').removeAttr("disabled");
        //       if (kembali >= 0) {
        //         $('#selesai').removeAttr("disabled");
        //       }else{
        //         $('#selesai').attr("disabled","disabled");
        //       }
        //   }
    }

    function addbarangtemp() {
        $('#btn_addtmp').text('loading'); //change button text
        $('#btn_addtmp').attr('disabled', true); //set 
        save_method = 'add';
        var cstok = $("#tot_stok").val();
        var form_data = $('#form-addtemp').serialize();
        var url;
        var qty = $("#qty").val();

        if (save_method == 'add') {
            url = "<?php echo site_url('pos/addproduktemp') ?>";
        } else {
            url = "<?php echo site_url('pos/updateProdukTemp') ?>";
        }

        if (cstok == 0) {
            alert("stok kosong");
        } else if (qty == 0) {
            alert("Masukan Qty");
        } else {
            $.ajax({
                url: url,
                type: "POST",
                data: form_data,
                success: function(data) {
                    $('#btn_addtmp').text('Tambah'); //change button text
                    $('#btn_addtmp').attr('disabled', false); //set button enable 
                    $('#response_ajax').load(data);
                    var json = JSON.parse(data);
                    if (json.success) {
                        reloadTable(nota_penjualan);
                        reloadTotalBelanja(nota_penjualan);
                        $('#btn_selesai').attr('hidden', false); //
                    } else {
                        alert("Gagal Menambahkan barang");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    console.log(jqXHR + "-" + errorThrown);
                    $('#btn_addtmp').text('Tambah'); //change button text
                    $('#btn_addtmp').attr('disabled', false); //set 
                }
            });
        }
    }

    function reloadTotalBelanja(str) {
        $("#total_belanja").load("<?= base_url('pos/getTotalBelanja') ?>/" + str);
    }

    function reloadTable(str) {
        $("#table-content").load("<?= base_url('pos/showTableTemp') ?>/" + str);
    }

    //harga * jumlah
    function subTotal(qty) {
        //qty ambil
        var _qty = parseInt(qty);
        // console.log(qty);

        //paket 1
        var h_grosir = $('#heceran').val();
        // var gr_qty = parseInt($('#qty_grosir').val());

        //paket 2
        var h_grosir1 = $('#hgrosir').val();
        var gr_qty1 = parseInt($('#qty_grosir1').val());

        console.log(parseFloat(h_grosir) * qty);
        $('#subtotal').val(parseFloat(h_grosir) * qty);

    }

    function hapus_temp(str){
        var url ="pos/hapus_temp";
        $.ajax({
                url: url,
                type: "POST",
                data: {
                    id_penjualan:str
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json.success) {
                        reloadTable(nota_penjualan);
                        reloadTotalBelanja(nota_penjualan);
                        //jika total 0 maka btn selesai hilang
                        var total = $('#mtotal_belanja').val().replace(".", "").replace(".", "");
                        if(total.empty || total == 0){
                            $('#btn_selesai').attr('hidden', false); //
                        }else{
                            $('#btn_selesai').attr('hidden', true); //
                        }
                        //reload kembalian
                    } else {
                        alert("Gagal menghapus barang");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error delete data');
                    console.log(jqXHR + "-" + errorThrown);
                }
            });
    }

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');

        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';

        return rupiah.split('', rupiah.length - 1).reverse().join('');

    }
</script>
<?= $this->endSection() ?>