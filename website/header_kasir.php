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
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-invoice.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-ecommerce.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-ecommerce-details.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/form-number-input.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/assets/css/style.css">
        <!-- END: Custom CSS-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        

    </head>
    <!-- END: Head-->

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
        $id_branch = "";
        $trial=$_SESSION['trial'];
        $id_pegawai = 0;
        if($role=="emp"){//employee
            $id_branch=$_SESSION['id_branch'];
            $fea_kasir=$_SESSION['fea_kasir'];
            $fea_menu=$_SESSION['fea_menu'];
            $fea_pegawai=$_SESSION['fea_pegawai'];
            $nama=$_SESSION['nama'];
            $id_pegawai = $_SESSION['id_pegawai'];
        }
    ?>