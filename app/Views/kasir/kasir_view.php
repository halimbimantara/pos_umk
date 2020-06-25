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

                            <div class="info-box-content">
                                <span class="info-box-text">Total</span>
                                <span class="info-box-number">0</span>
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
                        
                        <div class="card-footer">
                            <button id="btn_addtmp" type="submit" onclick="addbarangtemp()" class="btn btn-primary">Tambahkan</button>
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
    // document.addEventListener("contextmenu", function(e) {
    //     e.preventDefault();
    // }, false);

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
                    $('#btn_addtmp').text('tambah'); //change button text
                    $('#btn_addtmp').attr('disabled', false); //set button enable 
                    // $('#btn_addProduk').attr('disabled', false); //set 
                    $('#response_ajax').load(data);
                    var json = JSON.parse(data);
                    // console.log(data);
                    // alert(data);
                    if (json.success) {
                        reloadTable(nota_penjualan);
                    } else {
                        alert("Gagal Menambahkan barang");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    console.log(jqXHR + "-" + errorThrown);
                    $('#btn_addtmp').text('tambah'); //change button text
                    $('#btn_addtmp').attr('disabled', false); //set 
                    // $('#btnSave').text('save'); //change button text
                    // $('#btnSave').attr('disabled', false); //set button enable 
                    // $('#btn_addProduk').attr('disabled', false); //set 
                }
            });
        }
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
        var gr_qty = parseInt($('#qty_grosir').val());

        //paket 2
        var h_grosir1 = $('#hgrosir').val();
        var gr_qty1 = parseInt($('#qty_grosir1').val());

        var harga = $('#harga_barang').val().replace(".", "").replace(".", "");
        var harga_ori = $('#harga_ori').val();

        var max = parseInt($('#stok_item').val()); //stok tersediaS

        // if (_qty <= max) {
        //     $('#sub_total').val(convertToRupiah(harga * _qty));
        // } else if (_qty > max) {
        //     if (_qty >= gr_qty) {
        //         $('#qty').val(max);
        //         $('#sub_total').val(convertToRupiah(h_grosir * max));
        //         $('#harga_barang').val(convertToRupiah(h_grosir));
        //         console.log("Grosir Max");

        //     } else if (gr_qty > _qty) {
        //         $('#qty').val(max);
        //         $('#sub_total').val(convertToRupiah(harga * max));
        //         console.log("Harga Normal max");
        //     }
        // }

        // if (_qty <= max && _qty >= gr_qty) {
        //     var temp_qty = _qty;
        //     if (temp_qty <= gr_qty && temp_qty <= gr_qty1) {
        //         $('#harga_barang').val(convertToRupiah(h_grosir));
        //         $('#sub_total').val(convertToRupiah(h_grosir * _qty));
        //         console.log("Grosir Paket 1");
        //     } else if (temp_qty == gr_qty1) {
        //         console.log("Grosir Paket 2");
        //         $('#harga_barang').val(convertToRupiah(h_grosir1));
        //         $('#sub_total').val(convertToRupiah(h_grosir1 * _qty));
        //     }
        // } else {
        //     $('#harga_barang').val(convertToRupiah(harga_ori));
        //     $('#sub_total').val(convertToRupiah(harga * _qty));
        //     console.log("Normal");
        // }
    }
</script>
<?= $this->endSection() ?>