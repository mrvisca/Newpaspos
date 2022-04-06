<!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="dashboard.php"><span class="brand-logo">
                        <img src="../assets/img/logo paspos 160x160.png" style="width:30px;height:23px;"></span>
                        <h2 class="brand-text text-danger">Pas POS</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="index.php"><i data-feather="monitor"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                </li>

                <?php
                    if($trial==0 || $trial==2)
                    {
                        $tampilkan = "block";
                    }else{
                        $tampilkan = "none";
                    }
                ?>

                <li class="navigation-header" style="display:<?php echo $tampilkan; ?>;"><span data-i18n="Apps &amp; Pages">Super &amp; Admin</span><i data-feather="more-horizontal"></i></li>
                <li class=" nav-item" style="display:<?php echo $tampilkan; ?>;">
                    <a class="d-flex align-items-center" href="convert_akun.php"><i data-feather="users" ></i><span class="menu-title text-truncate" data-i18n="Email">Daftar Pengguna</span></a>
                </li>

                <li class="navigation-header"><span data-i18n="User Interface">Owner</span><i data-feather="more-horizontal"></i></li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="ui-typography.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Typography">Cabang</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="convert_cabang.php"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Card">Daftar Cabang</span></a></li>
                        <li><a class="d-flex align-item-center" href="cabang_product.php"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Card">Produk Cabang</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="ui-feather.html"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Feather">Stock</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="convert_stock.php"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Card">Daftar Stok</span></a></li>
                        <li><a class="d-flex align-item-center" href="convert_stock_cabang.php"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Card">Stock Opname (Cabang)</span></a></li>
                        <li><a class="d-flex align-item-center" href="convert_supplier.php"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Card">Supplier</span></a></li>
                        <li><a class="d-flex align-item-center" href="convert_faktur.php"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Card">Pembelian Stock</span></a></li>
                        <li><a class="d-flex align-item-center" href="convert_stocklog.php"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Card">Stock Log</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="daftar_produk.php"><i data-feather="gift"></i><span class="menu-title text-truncate" data-i18n="Card">Produk</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user-check"></i><span class="menu-title text-truncate" data-i18n="Components">Pegawai</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="convert_pegawai.php"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="Accordion">Daftar Pegawai</span></a></li>
                        <li><a class="d-flex align-items-center" href="convert_presensi.php"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="Alerts">Presensi Pegawai</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="pengguna.php"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Extensions">Akun Pengguna</span></a></li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Penjualan</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="kasir.php"><i data-feather="shopping-cart"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Kasir</span></a></li>
                        <li><a class="d-flex align-items-center" href="daftar_pesanan.php"><i data-feather="shopping-bag"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Pesanan</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="book-open"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Bill / Invoice (On Progress)</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Laporan Akuntansi (On Progress)</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Laporan Penjualan (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Biaya Operasional (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Jurnal (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Arus Kas (Laba Rugi) (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Summary (On Progress)</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Pengaturan (On Progress)</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="calendar"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Shift Pegawai (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="log-in"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Akses Pengguna (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="map"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Website (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="clipboard"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Meja Reservasi (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Transaksi (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="database"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Operasional (On Progress)</span></a></li>
                    </ul>
                </li>

                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Kasir &amp; Pegawai</span><i data-feather="more-horizontal"></i></li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="clipboard"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Presensi (On Progress)</span></a>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="box"></i><span class="menu-title text-truncate" data-i18n="Form Layout">Penjualan (On Progress)</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Pembukaan Kasir (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Kasir (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="shopping-bag"></i><span class="menu-item text-truncate" data-i18n="Layout Full">Pesanan (On Progress)</span></a></li>
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="book-open"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Bill / Invoice (On Progress)</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
<!-- END: Main Menu-->