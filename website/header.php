<!DOCTYPE html>
<?php
    date_default_timezone_set("Asia/Jakarta");
    $pagi_start = "06:00";
    $pagi_end = "17:59";
    $malam_start = "18:00";
    $malam_end = "05:59";
    $waktu_sekarang = date("H:i");

    if($waktu_sekarang>=$pagi_start && $waktu_sekarang<=$pagi_end){
        $theme = "";
    }else{
        $theme = "dark-layout";
    }
?>
<html class="loading <?php echo $theme; ?>" lang="en" data-textdirection="ltr">

    <!-- BEGIN: Head-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>Pas POS - Admin</title>
        <link rel="icon" href="../assets/img/logo.svg" type="image/gif" sizes="16x16" />
        <link rel="shortcut icon" href="../assets/img/logo.svg" type="image/gif" sizes="16x16">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/charts/apexcharts.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/extensions/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
        
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/forms/select/select2.min.css">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/extensions/swiper.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/colors.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/components.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/dark-layout.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/bordered-layout.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/semi-dark-layout.css">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/dashboard-ecommerce.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/charts/chart-apex.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/extensions/ext-component-toastr.css">

        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/pickers/form-pickadate.css">

        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/form-validation.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/form-wizard.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/form-quill-editor.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-invoice.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-ecommerce.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-ecommerce-details.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/form-number-input.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-todo.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/assets/css/style.css">
        <!-- END: Custom CSS-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">
        <?php
            session_start();
            if(!isset($_SESSION['role'])){
                echo '  <script>
                            swal({
                                title: "Akses Gagal",
                                text: "Silahkan login terlebih dahulu untuk memulai aplikasi",
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "login.php";
                            });
                        </script>';
            }
            
            $pass=$_SESSION['pass'];
            $user=$_SESSION['user'];
            $role=$_SESSION['role'];
            $id_brand=$_SESSION['id_brand'];
            $nama_brand=$_SESSION['nama_brand'];
            $nama="OWNER";
            $trial=$_SESSION['trial'];
            $id_branch = 0;
            if($role=="emp"){//employee
                $id_branch=$_SESSION['id_branch'];
                $fea_kasir=$_SESSION['fea_kasir'];
                $fea_menu=$_SESSION['fea_menu'];
                $fea_pegawai=$_SESSION['fea_pegawai'];
                $nama=$_SESSION['nama'];
            }

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