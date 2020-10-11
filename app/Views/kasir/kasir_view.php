<?= $this->extend('default_top_layout_v2') ?>



<?= $this->section('content') ?>
<!-- content -->
<!-- Main content -->

<section class="content" style="padding-top: 10px;">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-sm-2">
                <div class="col-sm-2 col-md-12">
                    <div class="form-group">
                        <div style="text-size-adjust: 14px;" id="total_belanja">
                            <!-- <label class="control-label">Total</label>
                                <input type="hidden" name="mtotal_belanja" id="mtotal_belanja" />
                                <h3><span style=" color: red;" class="info-box-number"></span></h3> -->
                            <!-- <div>
                                <input placeholder="Total Nota" name="mtotal_belanja" disabled id="mtotal_belanja" type="text" class="form-control">
                                <span class="help-block"></span>
                            </div> -->
                            <label>Jenis Produk</label>
                        </div>
                        <div>
                            <!-- Total item yg di beli
                        - misal gatsby dan oreo maka itemnya 2 jenis
                        -->
                            <!-- <label>Total Produk</label> -->
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Pelanggan</h3>
                            </div>
                        </div>
                        <!--  -->
                        <!-- Foto -->
                        <div class="col-sm-5 col-md-12" id="foto">
                            <div class="card card-black">
                                <div class="card-header">
                                    <h3 class="card-title">Gambar</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="padding: 1px;">
                                    <img id="img_prod" class="img-fluid mb-4" src="<?= base_url() . "/resources/dist/img/default-150x150.png"; ?>" alt="Photo" style="width:100%">

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- <img id="img_prod" class="img-fluid mb-3" alt="Photo"> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="col-sm-9 col-md-12">
                    <!-- USERS LIST -->
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-sm-6">
                            <!-- <label class="control-label">Bayar</label> -->
                            <input placeholder="Bayar" name="bayar" disabled id="bayar" type="text" oninput='validity.valid||(value="");' class="form-control" onchange="showKembali(this.value)" onkeyup="showKembali(this.value)">
                            <span class="help-block"></span>
                        </div>
                        <div class="col-sm-6">
                            <!-- <label class="control-label">Kembalian</label> -->
                            <input placeholder="Kembalian" name="kembalian" disabled id="kembalian" class="form-control">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- <div class="card-header">
                            <h3 class="card-title">Kasir Transaksi</h3>

                            <div class="card-tools">
                                <span class="badge badge-danger">No Nota <?//= $nota_penjualan; ?></span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div> -->
                    <!-- /.card-header -->
                    <!--Table -->
                    <table id="table-penjualan-temp" style="background-color: white;" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th style="width:3px">No</th> -->
                                <th>Produk</th>
                                <th>Harga</th>
                                <th style="width:3px" align="right">Qty</th>
                                <!-- <th>Diskon</th> -->
                                <th>S.Total</th>
                                <th width="2%">#</th>
                            </tr>
                        </thead>
                        <tbody id="table-content">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>


            <div class="col-sm-5">
                <div class="col-12 col-sm-5 col-md-12">
                    <div class="card card-gray-dark card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Barcode <i class="fa fa-barcode"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Search <i class="fa fa-search"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Icon <i class="fa fa-cart"></i></a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <form id="form_barcode">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="idprodukbarcode">Barcode</label>
                                                <input type="text" class="form-control" onchange="showBarang(this.value)" id="idprodukbarcode" placeholder="Masukan nama / letakan kursor">
                                            </div>

                                            <div class="form-check" hidden>
                                                <input type="checkbox" class="form-check-input" id="gambar_checkbox">
                                                <label class="form-check-label" for="exampleCheck1">Tampil Gambar ?</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <form id="form_searchs">
                                        <div class="row">
                                            <div class="card-body" style="margin-top: -20px;">
                                                <div class="form-group">
                                                    <label for="idprodukbarcode">Cari Nama Produk</label>
                                                    <input style="margin-top: 12px;" type="text" class="form-control" id="trx_kasir" placeholder="Format Input nama barang=qty=harga barang">
                                                    <div id="itemList"></div>
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                    <!-- <form id="form_menu"> -->
                                    <div class="row">
                                        <div class="col-sm-7 col-md-8 col-md-6">
                                            <div class="row" id="produk_icon">
                                                <?php foreach ($item_produk as $rows) {
                                                    $gambar = $rows->gambar_produk == '' ? base_url() . "/resources/dist/img/default-150x150.png" : base_url() . "/public/uploads/" . $rows->gambar_produk;
                                                ?>
                                                    <div class="col-sm-4 col-md-4 col-md-3" onclick="addproduk('<?= $rows->kd_produk ?>','<?= $rows->nama_produk ?>')">
                                                        <img src="<?= $gambar; ?>" alt="Avatar" style="width:100%">
                                                        <div class="container">
                                                            <div>
                                                                <center>
                                                                    <p style="font-size: x-small;"><?= substr($rows->nama_produk, 0, 10); ?></p>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 com-md-4">
                                            <?php foreach ($item_kategori as $cat) { ?>
                                                <button type="button" class="btn btn-block btn-outline-secondary btn-sm"><?= $cat->kategori ?></button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- </form> -->
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="col-5 col-sm-5 col-md-12" hidden>
                    <!-- USERS LIST -->
                    <!-- /.card-header -->
                    <div class="card-body p-0">

                        <form action="#" id="form-addtemp" class="form-horizontal">
                            <input type="hidden" id="update_qty" name="update_qty" value="0" />
                            <input type="hidden" id="kd_trxpenjualan" name="kd_trxpenjualan" value="<?= $nota_penjualan ?>" />
                            <div id="detail_item" hidden></div>
                        </form>
                    </div>
                    <div id="response_ajax"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modal_calculators" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content col-md-5">
                <div class="modal-header">
                    <p>Masukan Jumlah Barang</p>
                </div>
                <div class="modal-body form">
                    <div class="col-sm-12 col-md-offset-3 calculator" align="center">
                        <div class="row displayBox">
                            <p class="displayText" style="font-size: 50px;" id="display">0</p>
                        </div>
                        <div class="row numberPad" style="padding: 20px;">
                            <div class="col-sm-12">
                                <div class="row">
                                    <button class="btn btn-calc hvr-radial-out" id="seven">7</button>
                                    <button class="btn btn-calc hvr-radial-out" id="eight">8</button>
                                    <button class="btn btn-calc hvr-radial-out" id="nine">9</button>
                                </div>
                                <div class="row">
                                    <button class="btn btn-calc hvr-radial-out" id="four">4</button>
                                    <button class="btn btn-calc hvr-radial-out" id="five">5</button>
                                    <button class="btn btn-calc hvr-radial-out" id="six">6</button>
                                </div>
                                <div class="row">
                                    <button class="btn btn-calc hvr-radial-out" id="one">1</button>
                                    <button class="btn btn-calc hvr-radial-out" id="two">2</button>
                                    <button class="btn btn-calc hvr-radial-out" id="three">3</button>
                                </div>
                                <div class="row">
                                    <button class="btn btn-calc hvr-radial-out" id="clear">C</button>
                                    <button class="btn btn-calc hvr-radial-out" id="zero">0</button>
                                    <button class="btn btn-calc hvr-radial-out" id="backspace">⌫</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSaveProduk" onclick="save_qty()" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- dialog qty update -->
    <input type="hidden" id="dl_qty" name="dl_qty" value="0" />
    <input type="hidden" id="id_item_trx" name="id_item_trx" value="0" />
</section>

<!-- tes -->
<div class="modal fade " id="modal_cetaknota" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title">Cetak Nota Beli</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Kode Transaksi</label>
                        <div class="col-md-9">
                            <input name="kd_trxbeli" id="kd_trxbeli" class="form-control" type="text">
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

<!-- End Bootstrap modal -->

<?= $this->endSection() ?>
<?= $this->section('jscript') ?>
<script type="text/javascript">
    var ismodelPop = false;

    $(document).ready(function() {

        window.onresize = function(event) {
            // applyOrientation();
        }

        function applyOrientation() {
            if (window.innerHeight < window.innerWidth) {
                alert("You are now in 1111");
            } else {
                if (window.innerHeight < window.innerWidth) {
                    alert("You are now in 2222");
                } else {
                    alert("You are now in 33333");
                }
            }
        }
        // $('#form_menu').hide();
        // $('#form_barcode').hide();
        // $('#form_searchs').show();
        $("#idprodukbarcode").focus();
        var displayBox = document.getElementById('display')
        var hasEvaluated = false

        //
        $('#mode_barcode').click(function() {
            $('#form_barcode').show();
            $('#form_menu').hide();
            $('#form_searchs').hide();
        })
        $('#mode_menu').click(function() {
            $('#form_barcode').hide();
            $('#form_menu').show();
            $('#form_searchs').hide();
        })
        $('#mode_search').click(function() {
            $('#form_barcode').hide();
            $('#form_searchs').show();
            $('#form_menu').hide();
        })

        // CHECK IF 0 IS PRESENT. IF IT IS, OVERRIDE IT, ELSE APPEND VALUE TO DISPLAY
        function clickNumbers(val) {
            if (displayBox.innerHTML === '0' || (hasEvaluated === true && !isNaN(displayBox.innerHTML))) {
                displayBox.innerHTML = val
            } else {
                displayBox.innerHTML += val
            }
            hasEvaluated = false
        }

        // PLUS MINUS
        $('#plus_minus').click(function() {
            if (eval(displayBox.innerHTML) > 0) {
                displayBox.innerHTML = '-' + displayBox.innerHTML
            } else {
                displayBox.innerHTML = displayBox.innerHTML.replace('-', '')
            }
        })

        // ON CLICK ON NUMBERS
        $('#clear').click(function() {
            displayBox.innerHTML = '0'
            $('#display').css('font-size', '80px')
            $('#display').css('margin-top', '10px')
            $('button').prop('disabled', false)
        })
        $('#one').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(1)
        })
        $('#two').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(2)
        })
        $('#three').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(3)
        })
        $('#four').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(4)
        })
        $('#five').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(5)
        })
        $('#six').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(6)
        })
        $('#seven').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(7)
        })
        $('#eight').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(8)
        })
        $('#nine').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(9)
        })
        $('#zero').click(function() {
            checkLength(displayBox.innerHTML)
            clickNumbers(0)
        })
        $('#backspace').click(function() {
            checkLength(displayBox.innerHTML);
            // clickNumbers(0)
            // console.log(displayBox.innerHTML.length);
            displayBox.innerHTML.slice(0, displayBox.innerHTML.length - 1);
            displayBox.innerHTML = displayBox.innerHTML.slice(0, displayBox.innerHTML.length - 1);
            evaluate();
        })
        $('#decimal').click(function() {
            if (displayBox.innerHTML.indexOf('.') === -1 ||
                (displayBox.innerHTML.indexOf('.') !== -1 && displayBox.innerHTML.indexOf('+') !== -1) ||
                (displayBox.innerHTML.indexOf('.') !== -1 && displayBox.innerHTML.indexOf('-') !== -1) ||
                (displayBox.innerHTML.indexOf('.') !== -1 && displayBox.innerHTML.indexOf('×') !== -1) ||
                (displayBox.innerHTML.indexOf('.') !== -1 && displayBox.innerHTML.indexOf('÷') !== -1)) {
                clickNumbers('.')
            }
        })

        // OPERATORS
        $('#add').click(function() {
            evaluate()
            checkLength(displayBox.innerHTML)
            displayBox.innerHTML += '+'
        })
        $('#subtract').click(function() {
            evaluate()
            checkLength(displayBox.innerHTML)
            displayBox.innerHTML += '-'
        })
        $('#multiply').click(function() {
            evaluate()
            checkLength(displayBox.innerHTML)
            displayBox.innerHTML += '×'
        })
        $('#divide').click(function() {
            evaluate()
            checkLength(displayBox.innerHTML)
            displayBox.innerHTML += '÷'
        })

        $('#square').click(function() {
            var num = Number(displayBox.innerHTML)
            num = num * num
            checkLength(num)
            displayBox.innerHTML = num
        })

        $('#sqrt').click(function() {
            var num = parseFloat(displayBox.innerHTML)
            num = Math.sqrt(num)
            displayBox.innerHTML = Number(num.toFixed(5))
        })

        $('#equals').click(function() {
            evaluate()
            hasEvaluated = true
        })

        // EVAL FUNCTION
        function evaluate() {
            displayBox.innerHTML = displayBox.innerHTML.replace(',', '')
            displayBox.innerHTML = displayBox.innerHTML.replace('×', '*')
            displayBox.innerHTML = displayBox.innerHTML.replace('÷', '/')
            if (displayBox.innerHTML.indexOf('/0') !== -1) {
                $('button').prop('disabled', false)
                $('.clear').attr('disabled', false)
                displayBox.innerHTML = 'Division by 0 is undefined!'
            }
            var evaluate = eval(displayBox.innerHTML)
            if (evaluate.toString().indexOf('.') !== -1) {
                evaluate = evaluate.toFixed(5)
            }
            checkLength(evaluate)
            displayBox.innerHTML = evaluate
        }

        // CHECK FOR LENGTH & DISABLING BUTTONS
        function checkLength(num) {
            if (num.toString().length > 7 && num.toString().length < 14) {
                $('#display').css('font-size', '35px')
                $('#display').css('margin-top', '174px')
            } else if (num.toString().length > 16) {
                num = 'Infinity'
                $('button').prop('disabled', true)
                $('.clear').attr('disabled', false)
            }
        }

        // TRIM IF NECESSARY
        function trimIfNecessary() {
            file = 'standard ignore' // eslint-disable-line
            var length = displayBox.innerHTML.length
            if (length > 7 && length < 14) {
                $('#display').css('font-size', '35px')
                $('#display').css('margin-top', '174px')
            } else if (length > 14) {
                displayBox.innerHTML = 'Infinity'
                $('button').prop('disabled', true)
                $('.clear').attr('disabled', false)
            }
        }
    });

    $(function() {

        //Initialize Select2 Elements
        // $('.select2').select2();
        //Initialize Select2 Elements
        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // });

        $('[data-toggle="tooltip"]').tooltip();

    });

    function showIconProduk(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("produk_icon").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("GET", "<?= base_url('pos/showprodukkategori') ?>/" + str, true);
        xhttp.send();
    }

    var save_method; //for save method string
    var nota_penjualan = $("#kd_trxpenjualan").val();
    var selesai_penjualan;

    $("#btn_addtmp").hide();
    $('#bayar').attr('disabled', true); //

    $(document).ready(function() {
        $("[data-toggle=popover]").popover({
            html: true,
            content: function() {
                return $('#popover-content').html();
            }
        });

        $('#trx_kasir').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: "<?= base_url("pembelian/getProdukSelectCustom") ?>",
                    method: "POST",
                    data: {
                        searchTerm: query
                    },
                    success: function(data) {
                        $('#itemList').fadeIn();
                        $('#itemList').html(data);
                    }
                });
            } else {
                $('#itemList').html('');
            }
        });

        $(document).on('click', '.list-group-item', function() {
            $('#trx_kasir').val($(this).text());
            $('#itemList').fadeOut();
            //get value
            var tipe_input = $(this).attr('rel-tipe');
            // console.log($(this).attr('rel'));
            if (tipe_input != 1) {
                showBarang($(this).attr('rel'));
            } else {
                $("#trx_kasir").focus();


                $('#element').popover('show');
            }
        });

        $(document).on('click', '.tb-trx', function() {
            // $('#trx_kasir').val($(this).text());
            // $('#itemList').fadeOut();
            //get value
            var img_uri = $(this).attr('rel-tb');
            if (!img_uri.empty && img_uri != "-") {
                // console.log(img_uri);
                $("#img_prod").attr("src", "<?= base_url('public/uploads') ?>" + '/' + img_uri + "");
                $("#img_prod").show();
            } else {
                console.log("kosong");
                $("#img_prod").attr("src", "<?= base_url() . "/resources/dist/img/default-150x150.png" ?>");
                $("#img_prod").show();
            }

            $(this).tooltip('enable').tooltip('open');
            // console.log($(this).attr('rel'));
            // alert(tipe_input);
        });

        $('#trx_kasir').keypress(function(e) {
            var in_value = $("#trx_kasir").val();
            // console.log(.preventDefault())

            var url = "<?php echo site_url('pos/addproduktemp') ?>";
            if (e.key === "Enter" || (e.keyCode || e.which) === 13) {
                e.preventDefault();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        tipe_search: 2,
                        kd_trxpenjualan: $('#kd_trxpenjualan').val(),
                        qty: 1,
                        kd_produk: in_value,
                        update_qty: 0,
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json.success) {
                            reloadTable(nota_penjualan);
                            reloadTotalBelanja(nota_penjualan);
                            // $("#update_qty").val(0);
                            // $("#form-addtemp")[0].reset();
                            // $("#detail_item").empty();
                            $('#btn_selesai').attr('hidden', false); //
                            $('#bayar').attr('disabled', false); //

                            // $("#idprodukbarcode").focus();
                            $("#trx_kasir").val("");

                        } else {
                            alert("Gagal Menambahkan barang");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding data');
                    }
                });
            }
        });

        $("#gambar-checkbox").change(function() {
            var img_uri = $("#url_image").val();
            if (!img_uri.empty) {
                console.log(img_uri);
                $("#img_produk").attr("src", "<?= base_url('public/uploads') ?>" + '/' + img_uri + "");
                $("#img_produk").show();
            } else {
                $("#img_produk").attr("src", "<?= base_url() . "/resources/dist/img/default-150x150.png" ?>");
                $("#img_produk").show();
            }

        });
    });


    function save_qty() {
        var displayBox = document.getElementById('display')
        if (displayBox.innerHTML > 0) {

            var idItem=$("#id_item_trx").val();
            // $("#qty").val(displayBox.innerHTML);
            // subTotal(displayBox.innerHTML);
            var uQty = displayBox.innerHTML;
            var url = "<?php echo site_url('pos/updateQtyTemp') ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id_item_penjualan: idItem,
                    qty: uQty
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json.success) {
                        reloadTable(nota_penjualan);
                        reloadTotalBelanja(nota_penjualan);
                    //     //jika total 0 maka btn selesai hilang
                    //     var total = $('#mtotal_belanja').val().replace(".", "").replace(".", "");
                    //     if (total.empty || total == 0) {
                    //         $('#btn_selesai').attr('hidden', false); //
                    //         $('#bayar').removeAttr('disabled');
                    //     } else {

                    //         $('#bayar').attr('disabled', true); //
                    //         $('#btn_selesai').attr('hidden', true); //
                    //     }
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
            $('#modal_calculators').modal('hide');
            displayBox.innerHTML = 0;
        } else {
            alert("masukan jumlah");
        }
    }

    function showBarang(str) {
        // $(".select2bs4").append("aok");
        if (str == "") {
            $('#nama_barang').val('');
            $('#harga_barang').val('');
            $('#qty').val('');
            $('#reset').hide();
            return;
        } else {
            // console.log("item s" + str);
            // add to db temp jual
            $("#form-addtemp")[0].reset();
            // $("#form-addtemp").trigger("reset");
            $("#id_barang").val("");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("detail_item").innerHTML = xhttp.responseText;
                    addbarangtemp();
                    $("#idprodukbarcode").val("");
                    $("#idprodukbarcode").focus();
                }
            };
            xhttp.open("GET", "<?= base_url('pos/showproduk') ?>/" + str, true);
            xhttp.send();

            // $("#btn_addtmp").show();

            // $("#qty").val(1);
            // addbarangtemp();
            $("#id_barang").trigger("reset");
            $("#form-addtemp")[0].reset();
            // $("#form-addtemp").trigger("reset");
            var tipe_input = $("#tipe_search").val();
            if (tipe_input != 1) {
                show_qty('');
            }
            var img_uri = $("#url_image").delay(3000).val();
            // $(".badge-danger").add();
            // $("#form-addtemp")[0].reset();
            // console.log(img_uri);
            $('#img_prod').removeAttr('hidden', true); //
            $("#img_prod").delay(2000).attr("src", "<?= base_url('public/uploads') ?>" + '/' + img_uri + "");

            // addbarangtemp();
        }
    }

    function showKembali(str) {
        var total = $('#mtotal_belanja').val().replace(".", "").replace(".", "");
        //   var temps =$('#total_temps').val();
        //   var bayar = str.replace(".", "").replace(".", "");
        if (str.empty) {
            $('#kembalian').val("");
        } else {
            var kembali = str - total;
            $('#kembalian').val(convertToRupiah(kembali));
            if (kembali < 0 || kembali == 0) {

            } else {
                //show tombol selesai
                $("btn_selesai").removeAttr('hidden', true);
            }
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

    function addproduk(idproduct, nmprod) {
        var url = "<?php echo site_url('pos/addproduktemp') ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                is_icon: "yes",
                kd_produk: idproduct,
                kd_trxpenjualan: $('#kd_trxpenjualan').val(),
                qty: 1,
                nama_barang: nmprod,
                update_qty: 0,
            },
            success: function(data) {
                var json = JSON.parse(data);
                if (json.success) {
                    reloadTable(nota_penjualan);
                    reloadTotalBelanja(nota_penjualan);
                    // $("#update_qty").val(0);
                    // $("#form-addtemp")[0].reset();
                    // $("#detail_item").empty();
                    $('#btn_selesai').attr('hidden', false); //
                    $('#bayar').attr('disabled', false); //

                    $("#idprodukbarcode").focus();

                } else {
                    alert("Gagal Menambahkan barang");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding data');
            }
        });
    }

    function addbarangtemp() {
        $('#btn_addtmp').text('loading'); //change button text
        $('#btn_addtmp').attr('disabled', true); //set 
        save_method = 'add';
        var cstok = $("#tot_stok").val();
        var form_data = $('#form-addtemp').serialize();
        var url;
        var qty = $("#qty").val();
        var tipe_trx = $("#tipe_search").val();

        if (save_method == 'add') {
            url = "<?php echo site_url('pos/addproduktemp') ?>";
        } else {
            url = "<?php echo site_url('pos/updateProdukTemp') ?>";
        }

        if (cstok == 0) {
            $('#modal_calculators').modal('hide');
            alert("stok kosong");
        } else if (qty == 0 && tipe_trx == 0) {
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
                        $("#update_qty").val(0);
                        $("#trx_kasir").val("");
                        // $("#form-addtemp")[0].reset();
                        // $("#detail_item").empty();
                        $('#btn_selesai').attr('hidden', false); //
                        $('#bayar').attr('disabled', false); //

                        $("#idprodukbarcode").focus();

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
        $("#form-addtemp")[0].reset();
        $("#total_belanja").load("<?= base_url('pos/getTotalBelanja') ?>/" + str);
    }

    function reloadTable(str) {
        $("#table-content").load("<?= base_url('pos/showTableTempv1') ?>/" + str);
    }

    //harga * jumlah
    function subTotal(qty) {
        var _stok = $('#stok').val();
        var IntStok = parseInt(_stok);
        if (qty >= IntStok) {
            $('#qty').val(_stok);
            qty = _stok;
        }
        //qty ambil
        var _qty = parseInt(qty);
        // console.log(qty);

        //paket 1
        var h_grosir = $('#heceran').val();
        // var gr_qty = parseInt($('#qty_grosir').val());

        //paket 2
        var h_grosir1 = $('#hgrosir').val();
        var gr_qty1 = parseInt($('#qty_grosir1').val());

        console.log(parseFloat(h_grosir) * _qty);
        $('#subtotal').val(parseFloat(h_grosir) * _qty);

    }

    function selesaitrx() {
        // nota_penjualan
        var url = "<?= base_url() . "/pos/selesai" ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                kd_trxpenjualan: nota_penjualan
            },
            success: function(data) {
                var json = JSON.parse(data);
                if (json.success) {
                    //reload kembalian
                    window.location.assign('<?= base_url() ?>/pos/cetak/' + nota_penjualan);
                } else {
                    alert("Transaksi Gagal");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error submit data');
                console.log(jqXHR + "-" + errorThrown);
            }
        });
    }

    /**

     */
    function show_qty() {
        // $('#modal_calculator').modal({
        //     // backdrop: 'static',
        //     keyboard: true
        // });
        // console.log(values);
        // if(!values.empty){
        //     $("#img_produk").attr("src", "<?//= base_url('public/uploads') ?>" + '/' + value + "");
        // }
        $('#modal_calculators').modal('show');
        var displayBox = document.getElementById('display')
        displayBox.innerHTML = 0;
    }

    function show_qtyedit(values) {
        // $('#modal_calculator').modal('show');
        // show_qty();
        // console.log("on");
        // $('#modal_calculator').modal({
        //     // backdrop: 'static',
        //     keyboard: true
        // });
        $("#id_item_trx").val(values);
        $('#modal_calculators').modal('show');
        var displayBox = document.getElementById('display')
        displayBox.innerHTML = 0;
    }

    function hapus_temp(str) {
        var url = "<?= base_url() . "/pos/hapus_temp" ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                id_penjualan: str
            },
            success: function(data) {
                var json = JSON.parse(data);
                if (json.success) {
                    reloadTable(nota_penjualan);
                    reloadTotalBelanja(nota_penjualan);
                    //jika total 0 maka btn selesai hilang
                    var total = $('#mtotal_belanja').val().replace(".", "").replace(".", "");
                    if (total.empty || total == 0) {
                        $('#btn_selesai').attr('hidden', false); //
                        $('#bayar').removeAttr('disabled');
                    } else {

                        $('#bayar').attr('disabled', true); //
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
    // Styled components version, not needed if using scss
</script>
<?= $this->endSection() ?>