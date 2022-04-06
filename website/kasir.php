<?php
    ob_start();
    include 'header_kasir.php';
?>

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">
        <?php

            include '../settings/database.php';

            $pagi_start = "00:00";
            $pagi_end = "12:00";
            $siang_start = "12:01";
            $siang_end = "18:00";
            $malam_start = "18:01";
            $malam_end = "23:59";

            $jam_sekarang = date('H:i');

            if($jam_sekarang>=$pagi_start && $jam_sekarang<=$pagi_end){
                $greeting = "Selamat Pagi...";
            }elseif($jam_sekarang>=$siang_start && $jam_sekarang<=$siang_end){
                $greeting = "Selamat Siang...";
            }else{
                $greeting = "Selamat Malam...";
            }

            if($trial==1){
                $status = "Member Pas POS";
            }elseif($trial==0){
                $status = "Super Admin";
            }elseif($trial==2){
                $status = "Karyawan Pas POS";
            }else{
                $status = "Pegawai";
            }

            $id_item_cart = "";
            $nama_cart = "";
            $harga_cart = "";
            $jumlah = "";

        ?>
        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item d-none d-lg-block">
                            <p style="line-height:2em;"></p>
                            <p><b>Hallo <?php echo $nama; ?> <?php echo $greeting; ?></b></p>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ms-auto">
                    <li class="nav-item dropdown dropdown-cart me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span class="badge rounded-pill bg-primary badge-up cart-item-count cart_notif"></span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 me-auto">Keranjang Ku</h4>
                                    <div class="badge rounded-pill badge-light-primary item_list"></div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list cart-list">
                                <!--- Cart List --->
                                <!--- Cart List End --->
                            </li>
                            <li class="dropdown-menu-footer">
                                <div class="d-flex justify-content-between mb-1">
                                    <h6 class="fw-bolder mb-0">Total Item:</h6>
                                    <h6 class="text-primary fw-bolder mb-0 total_harga"></h6>
                                </div>
                                <a class="btn btn-primary w-100 btn-checkout" data-bs-toggle="modal" data-bs-target="#inlineForm">Checkout</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        $query = mysqli_query($koneksi,"SELECT * FROM penjualan WHERE pelayanan='0' AND id_brand='".$id_brand."'");
                        $pesanan = mysqli_num_rows($query);
                    ?>
                    <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up"><?php echo $pesanan; ?></span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 me-auto">Notifikasi</h4>
                                    <div class="badge rounded-pill badge-light-primary"><?php echo $pesanan; ?> Baru</div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <?php
                                    $query_penjualan = "SELECT id_pesanan,nama_item FROM penjualan WHERE pelayanan='0' AND id_brand='".$id_brand."' LIMIT 5";
                                    $stmt = $koneksi->prepare($query_penjualan);
                                    $stmt->execute();
                                    $stmt->bind_result($id_pesanan,$nama_item);
                                    while($stmt->fetch()){
                                        $query_pesanan = "SELECT judul FROM pesanan WHERE id='".$id_pesanan."' AND id_brand='".$id_brand."'";
                                        $stmt2 = $koneksi2->prepare($query_pesanan);
                                        $stmt2->execute();
                                        $stmt2->bind_result($judul);
                                        $no=0;
                                        while($stmt2->fetch()){
                                            $no++;
                                ?>
                                <a class="d-flex" href="pesanan.php">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar-content">PP</div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder"><?php echo $judul; ?></p><small class="notification-text"><?php echo $nama_item; ?></small>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                        }
                                    }
                                ?>
                            </li>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Lihat semua pesanan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name fw-bolder"><?php echo $_SESSION['user']; ?></span><span class="user-status"><?php echo $status; ?></span>
                            </div>
                            <span class="avatar"><img class="round" src="../assets/tema/template/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">
                                <span class="avatar-status-online"></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="page-profile.html"><i class="me-50" data-feather="user"></i> Profile</a>
                            <a class="dropdown-item" href="page-faq.html"><i class="me-50" data-feather="help-circle"></i> FAQ</a>
                            <a class="dropdown-item" href="proses/proses_logout.php"><i class="me-50" data-feather="power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        
        <?php
            include 'sidebar.php';
        ?>

        <!-- BEGIN: Content-->
        <div class="app-content content ecommerce-application">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Kasir Owner</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Kasir</a>
                                        </li>
                                        <li class="breadcrumb-item active">Kasir Owner
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- E-commerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-bs-toggle="collapse">
                                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                        </button>
                                        <div class="search-results total_search">16285 results found</div>
                                    </div>
                                    <div class="view-options d-flex">
                                        <select name="id_branch" class="form-select id_branch">
                                            <option value="" selected disabled>Pilih Cabang</option>
                                            <?php
                                                // Get branch Data
                                                $query_branch = "SELECT id,nama FROM branch WHERE id_brand='".$id_brand."'";
                                                $branch_data = $koneksi->prepare($query_branch);
                                                $branch_data->execute();
                                                $branch_data->bind_result($branch_id,$branch_nama);
                                                while($branch_data->fetch()){
                                            ?>
                                            <option value="<?php echo $branch_id; ?>"><?php echo $branch_nama; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        &ensp;&ensp;
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_option1" autocomplete="off" checked />
                                            <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn" for="radio_option1"><i data-feather="grid" class="font-medium-3"></i></label>
                                            <input type="radio" class="btn-check" name="radio_options" id="radio_option2" autocomplete="off" />
                                            <label class="btn btn-icon btn-outline-primary view-btn list-view-btn" for="radio_option2"><i data-feather="list" class="font-medium-3"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Content Section Starts -->

                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="body-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- E-commerce Search Bar Starts -->
                    <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                        <div class="row mt-1">
                            <div class="col-sm-3">
                                <div class="input-group input-group-merge">
                                    <select name="id_katagori" class="form-select search-product id_katagori">
                                        <option value="" selected disabled>Katagori</option>
                                        <?php
                                            // Get data katagori
                                            $query_katagori = "SELECT id,nama FROM katagori WHERE id_brand='".$id_brand."'";
                                            $katagori_data = $koneksi->prepare($query_katagori);
                                            $katagori_data->execute();
                                            $katagori_data->bind_result($katagori_id,$katagori_nama);
                                            while($katagori_data->fetch()){
                                        ?>
                                        <option value="<?php echo $katagori_id; ?>"><?php echo $katagori_nama; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control search-product cari_produk" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Search Bar Ends -->

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">
                    </section>
                    <!-- E-commerce Products Ends -->
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <!-- Modal -->
        <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Form Checkout Pembelian</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="proses/proses_pembelian_item.php" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label><b>Nama Produk</b></label><br/>
                                    <label class="produk_nama"></label>
                                </div>
                                <div class="col-md-4">
                                    <label><b>Jumlah</b></label><br/>
                                    <label class="produk_jml"></label>
                                </div>
                                <div class="col-md-4">
                                    <label><b>Harga (Rp)</b></label><br/>
                                    <label class="produk_harga"></label>
                                </div>
                                <input type="hidden" class="form-control id_item" name="id_item" />
                                <input type="hidden" class="form-control id_branch_item" name="id_branch_item" />
                                <input type="hidden" class="form-control nama_item" name="nama_item" />
                                <input type="hidden" class="form-control jml_item" name="jml_item" />
                                <input type="hidden" class="form-control harga_item" name="harga_item" />
                                <input type="hidden" class="form-control id_katagori_form" name="id_katagori" />
                                <input type="hidden" class="form-control harga_beli_form" name="harga_beli" />
                            </div><br/>
                            <div class="pembayaran">
                                <label>Total Item: </label>
                                <div class="mb-1">
                                    <input type="text" class="form-control-plaintext total_item" value="" readonly/>
                                </div>
                                <label>Service Charge (%): </label>
                                <div class="mb-1">
                                    <input type="number" placeholder="10" class="form-control service_charge" name="potongan" value="0" readonly/>
                                </div>
                                <label>Diskon (%): </label>
                                <div class="mb-1">
                                    <input type="number" placeholder="10" class="form-control diskon" name="diskon" value="0"/>
                                </div>
                                <label>Pajak (%): </label>
                                <div class="mb-1">
                                    <input type="number" placeholder="10" class="form-control pajak" name="pajak" value="0" readonly/>
                                </div>
                                <label>Total Pembayaran: </label>
                                <div class="mb-1">
                                    <input type="text" class="form-control-plaintext total_keseluruhan" value="" name="pembulatan" readonly/>
                                </div>
                                <label>Jumlah Dibayarkan: </label>
                                <div class="mb-1">
                                    <input type="text" placeholder="12.000" class="form-control dibayarkan" name="dibayarkan" value="0"/>
                                </div>
                                <label class="kembalian">Sisa Pembayaran: </label>
                                <div class="mb-1">
                                    <input type="text" class="form-control-plaintext sisa_pembayaran" name="sisa_pembayaran" value="0" readonly/>
                                </div>
                                <label>Rekening Pembayaran: </label>
                                <div class="mb-1">
                                    <select name="rek_pembayaran" class="form-select rek_pembayaran">
                                        <?php
                                            // Get query data rekening
                                            $query_rek = "SELECT id,nama FROM rek_pembayaran WHERE id_brand='".$id_brand."'";
                                            $data_rek = $koneksi->prepare($query_rek);
                                            $data_rek->execute();
                                            $data_rek->bind_result($id_rek,$nama_rek);
                                            while($data_rek->fetch()){
                                        ?>
                                        <option value="<?php echo $id_rek; ?>"><?php echo $nama_rek; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label>Nama Pelanggan: </label>
                                <div class="mb-1">
                                    <input type="text" placeholder="Jhon Doe" class="form-control" name="judul" />
                                </div>
                                <label>No Telpn (WA): </label>
                                <div class="mb-1">
                                    <input type="number" placeholder="8180xxxxxxxx" class="form-control" name="telpon" />
                                </div>
                                <label>Catatan: </label>
                                <div class="mb-1">
                                    <textarea class="form-control" name="catatan"></textarea>
                                </div>
                                <label>Tipe Pesanan: </label>
                                <div class="mb-1">
                                    <select name="id_meja" class="form-select" required>
                                        <option value="" disabled selected> --- Pilih Tipe Pesanan --- </option>
                                        <option value="0">Take Away (Bawa Pulang)</option>
                                        <?php
                                            // Get data meja Reservasi
                                            $query_meja = "SELECT id,meja,kapasitas FROM reservasi WHERE id_brand='".$id_brand."' AND status_reservasi='1'";
                                            $data_meja = $koneksi->prepare($query_meja);
                                            $data_meja->execute();
                                            $data_meja->bind_result($id_meja,$nama_meja,$kapasitas);
                                            while($data_meja->fetch()){
                                        ?>
                                        <option value="<?php echo $id_meja; ?>"><?php echo $nama_meja; ?> (<?php echo $kapasitas; ?>)</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" name="id_pegawai" value="<?php echo $id_pegawai; ?>" />
                                <input type="hidden" class="form-control id_branch_pembelian" name="id_branch_pembelian" value="" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" value="simpan" class="btn btn-success">Simpan Transaksi</button>
                            <button type="button" class="btn btn-primary btn-pembelian">Lanjutkan Transaksi</button>
                            <button type="submit" name="submit" value="bayar" class="btn btn-primary btn-bayar">Bayar Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
        <script src="../assets/tema/template/app-assets/vendors/js/extensions/wNumb.min.js"></script>
        <script src="../assets/tema/template/app-assets/vendors/js/extensions/nouislider.min.js"></script>
        <script src="../assets/tema/template/app-assets/vendors/js/extensions/toastr.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
        <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <script src="../assets/tema/template/app-assets/js/scripts/pages/app-ecommerce.js"></script>
        <!-- END: Page JS-->

        <script>
            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            })

            $(document).ready(function(){
                // Nilai Default
                $('.cart_notif').html(0);
                $('.item_list').html('0 Item');
                $('.total_harga').html('Rp. 0');

                // Nilai / Element Tersembunyi
                $('.pembayaran').hide();
                $(".btn-bayar").hide();

                load_data();
                function load_data(cabang, katagori, keyword)
                {
                    $.ajax({
                        method:"POST",
                        url:"kasir_product.php",
                        data: {cabang:cabang, katagori:katagori, keyword:keyword},
                        success:function(hasil)
                        {
                            $('.grid-view').html(hasil);

                            $('.btn-cart').click(function(){
                                var id_cart = $(this).data('id');
                                var id_branch_cart = $(this).data('id_branch');
                                var nama_cart = $(this).data('nama');
                                var nama_branch_cart = $(this).data('nama_branch')
                                var harga_cart = $(this).data('harga');
                                var jumlah_cart = $(this).data('jumlah');
                                var katagori = $(this).data('katagori');
                                var harga_beli = $(this).data('harga_beli');
                                var cart =  "<div class='list-item align-items-center copy' id='isi_"+ id_cart +"'><img class='d-block rounded me-1' src='../assets/tema/template/app-assets/images/pages/eCommerce/1.png' alt='donuts' width='62'>" +
                                                "<div class='list-item-body flex-grow-1'><i class='list-item-body ficon cart-item-remove remove fa fa-close' onclick='hapusAppend("+ id_cart +","+ harga_cart +");'></i>" +
                                                    "<div class='media-heading'>" +
                                                        "<h6 class='cart-item-title nama_produk'>"+ nama_cart +"</h6><small class='cart-item-by nama_branch'>"+ nama_branch_cart +"</small>" +
                                                    "</div>" +
                                                    "<div class='cart-item-qty'>" +
                                                        "<div class='input-group bootstrap-touchspin'>" +
                                                            "<span class='input-group-btn bootstrap-touchspin-injected'>" +
                                                                "<button class='btn btn-primary bootstrap-touchspin-down kurang' type='button' onclick='kurangi("+ id_cart +","+ harga_cart +")'><i class='fa fa-minus'></i></button>" +
                                                            "</span>" +
                                                            "<input class='touchspin-cart form-control qty' type='number' value='"+ jumlah_cart +"' id='txt_jumlah_"+ id_cart +"' onkeyup='customHarga("+ id_cart +","+ harga_cart +")'/>" +
                                                            "<span class='input-group-btn bootstrap-touchspin-injected'>" +
                                                                "<button class='btn btn-primary bootstrap-touchspin-up tambah' type='button' onclick='jumlahkan("+ id_cart +","+ harga_cart +")'><i class='fa fa-plus'></i></button>" +
                                                            "</span>" +
                                                        "</div>" +
                                                    "</div>" +
                                                    "<h5 class='cart-item-price harga_produk'>Rp."+ harga_cart +"</h5>" +
                                                    "<p class='id_cart' style='display:none;'>"+ id_cart +"</p>" +
                                                    "<p class='id_branch_cart' style='display:none;'>"+ id_branch_cart +"</p>" +
                                                    "<p class='id_katagori_cart' style='display:none;'>"+ katagori +"</p>" +
                                                    "<p class='harga_beli_cart' style='display:none;'>"+ harga_beli +"</p>" +
                                                "</div>" +
                                            "</div>";
                                $('.cart-list').append(cart);
                                badgeCart(1);
                                totalCart(jumlah_cart,harga_cart);
                            });

                            var a = $(".service_charge_source").html();
                            var b = $(".diskon_source").html();
                            var c = $(".pajak_source").html();
                            var d = $(".total_pencarian").html();
                            
                            kasirSetting(a,b,c,d);
                        }
                    });
                }
                $('.cari_produk').keyup(function(){
                    var cabang = $(".id_branch").val();
                    var katagori = $(".id_katagori").val();
                    var keyword = $(".cari_produk").val();
                    load_data(cabang,katagori,keyword);
                });
                $('.id_katagori').change(function(){
                    var cabang = $(".id_branch").val();
                    var katagori = $(".id_katagori").val();
                    var keyword = $(".cari_produk").val();
                    load_data(cabang,katagori,keyword);
                })
                $('.id_branch').change(function(){
                    var cabang = $(".id_branch").val();
                    var katagori = $(".id_katagori").val();
                    var keyword = $(".cari_produk").val();
                    load_data(cabang,katagori,keyword);
                });
                setTimeout(function() { $(".cari_produk").focus() }, 1000);
            });

            function hapusAppend(id,harga){
                kurangBadge(1);
                updateCart(id,harga);
                $("#isi_"+id).remove();
            }

            function badgeCart(j){
                var keranjang = parseInt($(".cart_notif").html());
                var dropdown_cart = parseInt($(".item_list").html());
                $(".cart_notif").html(keranjang+j);
                $(".item_list").html(dropdown_cart+j+" Items");
            }

            function kurangBadge(k){
                var keranjang = parseInt($(".cart_notif").html());
                var dropdown_cart = parseInt($(".item_list").html());
                if(keranjang!=0 || keranjang>=1){
                    $(".cart_notif").html(keranjang-k);
                    $(".item_list").html(dropdown_cart-k+" Items");
                }else{
                    alert("Keranjang sudah kosong...")
                    $(".cart_notif").html(0);
                    $(".item_list").html(0+" Item");
                }
            }

            function jumlahkan(id,harga){
                var jumlah_sekarang = parseInt($("#txt_jumlah_"+id).val());
                var jumlah_tambah = jumlah_sekarang+=1
                $("#txt_jumlah_"+id).val(jumlah_tambah);

                // Total Harga
                var call_total = $(".total_harga").html();
                var total_nilai = call_total.replace('Rp.',' ');
                var dijumlahkan = parseInt(1)*parseInt(harga)+parseInt(total_nilai);
                $(".total_harga").html("Rp. "+dijumlahkan);
            }

            function kurangi(id,harga){
                var jumlah_saat_ini = parseInt($("#txt_jumlah_"+id).val());
                // Total Harga
                var call_total = $(".total_harga").html();
                var total_nilai = call_total.replace('Rp.',' ');

                if(jumlah_saat_ini>=1 || jumlah_saat_ini!=0){
                    var jumlah_kurangi = jumlah_saat_ini-1;
                    $("#txt_jumlah_"+id).val(jumlah_kurangi);

                    var dikurangi = parseInt(total_nilai)-parseInt(1)*parseInt(harga);
                    $(".total_harga").html("Rp. "+dikurangi);
                }else if(jumlah_saat_ini==0){
                    alert("Jumlah tidak bisa dikurangi");
                    $("#txt_jumlah_"+id).val(1);

                    var dikurangi = parseInt(total_nilai);
                    $(".total_harga").html("Rp. "+dikurangi);
                }
            }

            function totalCart(qty,harga){
                var total_harga = $(".total_harga").html();
                var nilai_total = total_harga.replace('Rp.',' ');
                var real_total = parseInt(nilai_total)+parseInt(qty)*parseInt(harga);
                $('.total_harga').html('Rp. '+real_total);
            }

            function updateCart(id,harga){
                var jumlah_item = parseInt($('#txt_jumlah_'+id).val());
                var total_item = $('.total_harga').html();
                var ngambil_total = total_item.replace('Rp.',' ');
                var hitung_pengurangan = parseInt(ngambil_total)-jumlah_item*parseInt(harga);
                $('.total_harga').html('Rp. '+hitung_pengurangan);
            }

            function customHarga(id,harga){
                var jumlah_item = parseInt($('#txt_jumlah_'+id).val());
                var total_harga = $('.total_harga').html();
                var get_nilai = total_harga.replace('Rp.',' ');
                var harga_default = 1*parseInt(harga);
                var harga_update = parseInt(get_nilai)+jumlah_item*parseInt(harga)-harga_default;
                $('.total_harga').html('Rp. '+harga_update);
            }

            function kasirSetting(a,b,c,d){
                $(".service_charge").val(parseInt(a));
                $(".diskon").val(parseInt(b));
                $(".pajak").val(parseInt(c));
                $(".total_search").html(parseInt(d)+" Produk Tersedia");
            }

            $(".btn-checkout").click(function(){
                var id_cart = "";
                var id_branch_cart = "";
                var nama_produk = "";
                var nama_branch = "";
                var quantity = "";
                var harga = "";
                var id_katagori_cart = "";
                var harga_beli_cart = "";
                var total_item = $(".total_harga").html();
                var id_branch_form = $(".id_branch_cart").html();

                $(".id_branch_pembelian").val(parseInt(id_branch_form));

                // Get nama produk array in cart
                $(".id_cart").each(function(){
                    id_cart = id_cart+$(this).html()+",";
                    id_arr = "["+id_cart+"]";
                });

                $(".id_branch_cart").each(function(){
                    id_branch_cart = id_branch_cart+$(this).html()+",";
                    id_branch_arr = "["+id_branch_cart+"]";
                })

                $(".nama_produk").each(function(){
                    nama_produk = nama_produk+$(this).html()+",";
                    nama_produk_arr = "["+nama_produk+"]";
                });

                $(".nama_branch").each(function(){
                    nama_branch = nama_branch+$(this).html()+",";
                    nama_branch_arr = "["+nama_branch+"]";
                });

                $(".qty").each(function(){
                    quantity = quantity+$(this).val()+",";
                    quantity_arr = "["+quantity+"]";
                })

                $(".harga_produk").each(function(){
                    harga = harga+$(this).html()+", ";
                    harga_arr = "["+harga+"]";
                });

                $(".id_katagori_cart").each(function(){
                    id_katagori_cart = id_katagori_cart+$(this).html()+",";
                });

                $(".harga_beli_cart").each(function(){
                    harga_beli_cart = harga_beli_cart+$(this).html()+",";
                })

                var replace_separator_nama = nama_produk.replace(/,/g,"<br/>");
                var replace_separator_jml = quantity.replace(/,/g,"<br/>");
                var replace_separator_harga = harga.replace(/,/g,"<br/>");

                // "\n" = <br>
                // List Item
                $(".produk_nama").html(replace_separator_nama);
                $(".produk_jml").html(replace_separator_jml);
                $(".produk_harga").html(replace_separator_harga);
                $(".total_item").val(total_item);

                // Nilai Array
                $(".id_item").val(id_cart);
                $(".id_branch_item").val(id_branch_cart);
                $(".nama_item").val(nama_produk);
                $(".jml_item").val(quantity);
                $(".harga_item").val(harga.replace(/Rp./g,""));
                $(".id_katagori_form").val(id_katagori_cart);
                $(".harga_beli_form").val(harga_beli_cart);

                // hitung total pembelian (service_charge,diskon,pajak);
                var service_charge = parseInt($(".service_charge").val());
                var diskon = parseInt($(".diskon").val());
                var pajak = parseInt($(".pajak").val());

                if(pajak!=0 && diskon!=0 && pajak!=0){
                    var ambil_total = total_item.replace("Rp.", " ")
                    var nilai_total = parseInt(ambil_total);
                    totalan = nilai_total+service_charge/100*nilai_total;
                    hasil = totalan-diskon/100*totalan;
                    hasil = hasil+hasil*pajak/100;

                    $(".total_keseluruhan").val(hasil);
                    $(".sisa_pembayaran").val(hasil);
                }else{
                    $(".total_keseluruhan").val(total_item);
                    $(".sisa_pembayaran").val(total_item);
                }

            });

            $(".diskon").keyup(function(){
                var diskon_val = $(this).val();
                var total_item = $(".total_item").val();
                var ambil_tot = total_item.replace("Rp."," ");
                var nilai_tot = parseInt(ambil_tot);
                var service_charge = parseInt($(".service_charge").val());
                var pajak = parseInt($(".pajak").val());

                totalan = nilai_tot+service_charge/100*nilai_tot;
                hasil = totalan-diskon/100*totalan;
                hasil = hasil+hasil*pajak/100;
                $(".total_keseluruhan").val(hasil);
            })

            $(".btn-pembelian").click(function(){
                $(".pembayaran").show();
                $(".btn-bayar").show();
                $(".btn-pembelian").hide();
                $(".dibayarkan").attr('required','required');
                $(".rek_pembayaran").attr('required','required');
            })

            $(".dibayarkan").keyup(function(){
                var dibayarkan = parseInt($(this).val())
                var total_keseluruhan = $(".total_keseluruhan").val();
                var ambil_total = total_keseluruhan.replace("Rp.", " ")
                var nilai_total = parseInt(ambil_total);

                if(dibayarkan>=nilai_total){
                    $(".kembalian").html("Kembalian:");
                    $(".sisa_pembayaran").val(dibayarkan-nilai_total);
                }else{
                    $(".sisa_pembayaran").val(nilai_total-dibayarkan);
                }
            });
        </script>
    </body>
    <!-- END: Body-->
</html>