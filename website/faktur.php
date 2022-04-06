<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';

    $nofak = substr(str_shuffle("0123456789"), 0, 10);
    $tanggal_sekarang = date('Y-m-d');
?>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Faktur Pembelian Stock</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Stock</a>
                                    </li>
                                    <li class="breadcrumb-item active">Faktur Pembelian Stock
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Modern Horizontal Wizard -->
                <section class="modern-horizontal-wizard">
                    <div class="bs-stepper wizard-modern modern-wizard-example">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#account-details-modern" role="tab" id="account-details-modern-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                        <i data-feather="file-text" class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Faktur Settings</span>
                                        <span class="bs-stepper-subtitle">Setup Faktur Details</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step" data-target="#personal-info-modern" role="tab" id="personal-info-modern-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                        <i data-feather="user" class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Supplier Info</span>
                                        <span class="bs-stepper-subtitle">Supplier Personal Info</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step" data-target="#address-step-modern" role="tab" id="address-step-modern-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                        <i data-feather="box" class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Item Pembelian</span>
                                        <span class="bs-stepper-subtitle">List Barang</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step" data-target="#social-links-modern" role="tab" id="social-links-modern-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                        <i data-feather="dollar-sign" class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Pembayaran</span>
                                        <span class="bs-stepper-subtitle">Detail Pembayaran</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form action="proses/proses_buat_faktur.php" method="POST">
                                <div id="account-details-modern" class="content" role="tabpanel" aria-labelledby="account-details-modern-trigger">
                                    <div class="content-header">
                                        <h5 class="mb-0">Faktur Settings</h5>
                                        <small class="text-muted">Lengkapi Form dibawah ini.</small>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="modern-username">No Faktur</label>
                                            <input type="text" value="<?php echo $nofak; ?>" class="form-control" placeholder="<?php echo $nofak; ?>" disabled/>
                                            <input type="hidden" name="nofak" value="<?php echo $nofak; ?>"/>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="modern-email">Tanggal</label>
                                            <input type="text" name="tglfak" id="fp-date-time" value="<?php echo $tanggal_sekarang; ?>" class="form-control flatpickr-basic" placeholder="<?php echo $tanggal_sekarang; ?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 form-password-toggle col-md-6">
                                            <label class="form-label" for="modern-password">Cabang</label>
                                            <select name="id_branch" class="form-select w-100">
                                                <option value="" selected disabled> --- Pilih Cabang --- </option>
                                                <?php
                                                    // Get BRANCH data
                                                    $query_branch = "SELECT id,nama FROM branch WHERE id_brand='".$id_brand."' OR id='".$id_branch."'";
                                                    $branch_get_data = $koneksi->prepare($query_branch);
                                                    $branch_get_data->execute();
                                                    $branch_get_data->bind_result($branch_id,$branch_nama);
                                                    while($branch_get_data->fetch()){
                                                ?>
                                                <option value="<?php echo $branch_id; ?>"><?php echo $branch_nama; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-1 form-password-toggle col-md-6">
                                            <label class="form-label" for="modern-confirm-password">Pengguna</label>
                                            <select name="id_pegawai" class="form-select w-100">
                                                <option value="" selected disabled> --- Pilih Pengguna --- </option>
                                                <?php
                                                    // Get BRANCH data
                                                    $query_employee = "SELECT id,nama FROM employee WHERE id_brand='".$id_brand."' OR id='".$id_pegawai."'";
                                                    $employee_get_data = $koneksi->prepare($query_employee);
                                                    $employee_get_data->execute();
                                                    $employee_get_data->bind_result($pegawai_id,$pegawai_nama);
                                                    while($employee_get_data->fetch()){
                                                ?>
                                                <option value="<?php echo $pegawai_id; ?>"><?php echo $pegawai_nama; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_brand" value="<?php echo $id_brand; ?>"/>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-outline-secondary btn-prev" disabled>
                                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Selanjutnya</span>
                                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="personal-info-modern" class="content" role="tabpanel" aria-labelledby="personal-info-modern-trigger">
                                    <div class="content-header">
                                        <h5 class="mb-0">Supplier Info</h5>
                                        <small>Form Supplier Info.</small>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="modern-first-name">Nama Supplier</label>
                                            <select name="id_supplier" class="form-select w-100" id="id" onchange="cek_supplier()">
                                                <option value="" selected disabled> --- Pilih Supplier --- </option>
                                                <?php
                                                    // Get Supplier Data
                                                    $query_supplier = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_brand='".$id_brand."'");
                                                    while($supplier = mysqli_fetch_array($query_supplier)){
                                                ?>
                                                <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['nama']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="modern-last-name">No Telpon</label>
                                            <input type="number" id="notlp" class="form-control" placeholder="No Telpon Supplier" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="modern-country">Produk</label>
                                            <input type="text" id="dstock" class="form-control" placeholder="Produk Supplier" />
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="modern-language">Harga Penawaran</label>
                                            <input type="number" id="harga_p" class="form-control" placeholder="Harga Penawaran" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-12">
                                            <label class="form-label" for="modern-country">Alamat</label>
                                            <textarea id="alamat" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id_stock"/>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-prev">
                                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Selanjutnya</span>
                                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="address-step-modern" class="content" role="tabpanel" aria-labelledby="address-step-modern-trigger">
                                    <div class="content-header">
                                        <h5 class="mb-0">Item Pembelian</h5>
                                        <small>Item Pembelian Stock.</small>
                                    </div>
                                    <div class="after-add-more">
                                        <div class="row">
                                            <div class="mb-1 col-md-6">
                                                <label class="form-label" for="modern-address">Nama Item</label>
                                                <select name="id_daftar_stock[]" class="form-select w-100 dstock_id">
                                                    <option value="" selected disabled>--- Pilih Nama Item ---</option>
                                                    <?php
                                                        // Get Data Stock
                                                        $query_stock = "SELECT * FROM daftar_stock WHERE id_brand='".$id_brand."'";
                                                        $dstock_data = $koneksi->prepare($query_stock);
                                                        $dstock_data->execute();
                                                        $result = $dstock_data->get_result();
                                                        if($result){
                                                            $i = 0;
                                                            while($rows = $result->fetch_assoc()){
                                                                $i++;
                                                    ?>
                                                    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['nama']; ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-md-2">
                                                <label class="form-label" for="modern-landmark">Jumlah</label>
                                                <input type="number" name="jumlah[]" class="form-control dstock_jml" value="0" placeholder="Jumlah Item" />
                                            </div>
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="pincode3">Harga Satuan</label>
                                                <input type="number" name="harga_satuan[]" class="form-control dstock_harga" value="0" placeholder="Harga Item" />
                                            </div>
                                            <div class="mb-1 col-md-6">
                                                <label class="form-label" for="modern-address">Total Item</label>
                                                <input type="number" name="total_harga[]" value="0" class="form-control tot_harga"/>
                                            </div>
                                            <input type="hidden" name="nama_stock[]" class="form-controler dstock_nama" value="">
                                            <div class="mb-3 col-md-3">
                                                <button type="button" class="btn btn-info add-more" style="top:24px;"><i data-feather="plus-circle"></i> Tambah Produk</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-prev">
                                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none">Selanjutnya</span>
                                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="social-links-modern" class="content" role="tabpanel" aria-labelledby="social-links-modern-trigger">
                                    <div class="content-header">
                                        <h5 class="mb-0">Pembayaran</h5>
                                        <small>Transaksi dan pembayaran.</small>
                                    </div>
                                    <div class="pembayaran">
                                        <div class="row">
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-twitter">Jumlah Pembelian</label>
                                                <input type="number" value="0" class="form-control beli_total" placeholder="Jumlah Pembelian" />
                                            </div>
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-facebook">Ongkos Kirim</label>
                                                <input type="number" class="form-control ongkir" value="0" placeholder="Ongkos Kirim" />
                                            </div>
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-facebook">Total Pembayaran</label>
                                                <input type="number" name="tot_pem" class="form-control pembulatan" value="0" placeholder="Total Pembayaran" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-google">Jumlah pembayaran</label>
                                                <input type="number" name="jum_pembayaran" class="form-control jum_bayar" value="0" placeholder="Jumlah yang akan dibayarkan" />
                                            </div>
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-google">Sisa Pembayaran</label>
                                                <input type="number" name="sisa_pembayaran" class="form-control sisa_pem" value="0" placeholder="Jumlah yang akan dibayarkan" />
                                            </div>
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-linkedin">Pembayaran</label>
                                                <select name="pembayaran" class="form-select w-100 bayar">
                                                    <option value="" selected disabled>--- Pilih Rekening Bank ---</option>
                                                    <option value="1">Cash (Tunai)</option>
                                                    <?php
                                                        // Get Rekening Bank
                                                        $query_rekening = "SELECT id,nama FROM rek_pembayaran WHERE id_brand='".$id_brand."' AND id_branch='-1'";
                                                        $rekening_data = $koneksi->prepare($query_rekening);
                                                        $rekening_data->execute();
                                                        $rekening_data->bind_result($id_rekening,$nama_rekening);
                                                        while($rekening_data->fetch()){
                                                    ?>
                                                    <option value="<?php echo $id_rekening; ?>"><?php echo $nama_rekening; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-linkedin">Jenis Pembayaran</label>
                                                <select name="jenis_pembayaran" class="form-select w-100 jenis_bayar">
                                                    <option value="" selected disabled>--- Pilih Jenis Pembayaran ---</option>
                                                    <option value="0">Tunai</option>
                                                    <option value="1">Kredit</option>
                                                    <option value="2">Down Payment (DP)</option>
                                                    <option value="3">Cash On Delivery (COD)</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-google">Tanggal Dari</label>
                                                <input type="text" name="tanggal_dari" id="fp-date-time" class="form-control flatpickr-basic" placeholder="Tanggal Pembayaran" />
                                            </div>
                                            <div class="mb-1 col-md-4">
                                                <label class="form-label" for="modern-linkedin">Tanggal Sampai</label>
                                                <input type="text" name="tanggal_sampai" id="fp-date-time" class="form-control flatpickr-basic" placeholder="Batas Tanggal Pembayaran" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-1 col-md-12">
                                            <label class="form-label" for="modern-country">Catatan</label>
                                            <textarea name="catatan" class="form-control"></textarea>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-prev">
                                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                        </button>
                                        <button type="submit" class="btn btn-success">Buat Faktur</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- /Modern Horizontal Wizard -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php
        include 'footer.php';
    ?>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>

    <script src="../assets/tema/template/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../assets/tema/template/app-assets/js/scripts/forms/form-wizard.js"></script>
    <script src="../assets/tema/template/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <!-- END: Page JS-->

    <script>

        var basicPickr = $('.flatpickr-basic');

        // Default
        if (basicPickr.length) {
            basicPickr.flatpickr();
        }

        function cek_supplier(){
            var id = $("#id").val(); 
                $.ajax({
                url : 'get_supplier.php', // file proses penginputan
                method:"POST",
                data : "id="+id,
                success: function (data){
                    var json = data,
                    obj = JSON.parse(json);
                    $('#notlp').val(obj.notlp);
                    $('#id_stock').val(obj.id_stock);
                    $('#dstock').val(obj.dstock);
                    $('#harga_p').val(obj.harga_p);
                    $('#alamat').val(obj.alamat);
                }
            });
            // console.log(id_stock);
        }

        $(document).ready(function() {
            $(".add-more").click(function(){ 
                // var random_id = Math.floor((Math.random() * 10000) + 1);
                var html = "<div class='row'>" +
                                "<div class='mb-1 col-md-6'>" +
                                    "<label class='form-label' for='modern-address'>Nama Item</label>" +
                                    "<select name='id_daftar_stock[]' class='form-select w-100 dstock_id'>" +
                                        "<option value='' selected disabled>--- Pilih Nama Item ---</option>" +
                                        "<?php
                                            // Get Data Stock
                                            $query_stock = "SELECT * FROM daftar_stock WHERE id_brand='".$id_brand."'";
                                            $dstock_data = $koneksi->prepare($query_stock);
                                            $dstock_data->execute();
                                            $result = $dstock_data->get_result();
                                            if($result){
                                                $i = 0;
                                                while($rows = $result->fetch_assoc()){
                                                    $i++;
                                        ?>" +
                                        "<option value='<?php echo $rows['id']; ?>'><?php echo $rows['nama']; ?></option>" +
                                        "<?php
                                                }
                                            }
                                        ?>" +
                                    "</select>" +
                                "</div>" +
                                "<div class='mb-1 col-md-2'>" +
                                    "<label class='form-label' for='modern-landmark'>Jumlah</label>" +
                                    "<input type='number' name='jumlah[]' class='form-control dstock_jml' value='0' placeholder='Jumlah Item' />" +
                                "</div>" +
                                "<div class='mb-1 col-md-4'>" +
                                    "<label class='form-label' for='pincode3'>Harga Satuan</label>" +
                                    "<input type='number' name='harga_satuan[]' class='form-control dstock_harga' value='0' placeholder='Harga Item' />" +
                                "</div>" +
                                "<div class='mb-1 col-md-6'>" +
                                    "<label class='form-label' for='modern-address'>Total Item</label>" +
                                    "<input type='number' name='total_harga' value='0' class='form-control tot_harga'/>" +
                                "</div>" +
                                "<input type='hidden' name='nama_stock[]' class='form-controler dstock_nama' value=''>" +
                                "<div class='mb-3 col-md-3'>" +
                                    "<br/>" +
                                    "<button type='button' class='btn btn-danger remove' style='top:24px;'>"+ feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +" Hapus Produk</button>" +
                                "</div>" +
                            "</div>";
                $(".after-add-more").append(html);
            });
            $("body").on("click",".remove",function(){ 
                $(this).parents(".row").remove();
            });
        });

        $(".after-add-more").delegate(".dstock_id","change",function(){
            var stock_id = $(this).val();
            var tr = $(this).parent().parent();

            $.ajax({
                url : 'get_stock.php',
                method:"GET",
                data : "id="+stock_id,
                success: function(data){
                    var json = data,
                    obj = JSON.parse(json);
                    tr.find('.dstock_jml').val(1);
                    tr.find('.dstock_nama').val(obj.nama);
                    tr.find('.dstock_harga').val(obj.harga);
                    tr.find('.tot_harga').val(tr.find('.dstock_jml').val()*tr.find('.dstock_harga').val());
                }
            })
        })

        $(".after-add-more").delegate(".dstock_jml","keyup",function(){
            var jml = $(this);
            var tr = $(this).parent().parent();
            if(isNaN(jml.val())){
                alert("Masukan Jumlah Quantity Item");
                jml.val(1);
            }else{
                tr.find('.tot_harga').val(parseInt(jml.val())*parseInt(tr.find(".dstock_harga").val()));
                calculate();
            }
        })

        function calculate(){
            var sub_total = 0;
            var ongkir_def = 1000;
            $(".tot_harga").each(function(){
                sub_total = sub_total+($(this).val()*1);
            })
            $('.beli_total').val(sub_total);
        }

        $(".pembayaran").delegate(".ongkir","keyup",function(){
            var ongkir = $(this);
            if(isNaN(ongkir.val())){
                ongkir.val(1000);
            }else{
                $(".pembulatan").val(parseInt($(".beli_total").val())+parseInt($(".ongkir").val()));
            }
        })

        $(".pembayaran").delegate(".jum_bayar","keyup",function(){
            $(".sisa_pem").val(parseInt($(".pembulatan").val())-parseInt($(this).val()));
            var nilai = $(".sisa_pem").val();
            if($(".sisa_pem").val()>=1){
                $(".jenis_bayar option[value='0']").attr("disabled", "disabled");
            }else{
                $(".jenis_bayar option[value='0']").removeAttr('disabled');
            }
        })

        // Script default Theme
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>