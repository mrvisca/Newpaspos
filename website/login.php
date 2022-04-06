<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    
    <!-- BEGIN: Head-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>Pas POS - Login</title>
        <link rel="icon" href="../assets/img/logo.svg" type="image/gif" sizes="16x16" />
        <link rel="shortcut icon" href="../assets/img/logo.svg" type="image/gif" sizes="16x16">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/vendors.min.css">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/colors.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/components.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/dark-layout.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/bordered-layout.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/semi-dark-layout.css">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/plugins/forms/form-validation.css">
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/page-auth.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="../assets/tema/template/assets/css/style.css">
        <!-- END: Custom CSS-->

    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <div class="auth-wrapper auth-v2">
                        <div class="auth-inner row m-0">
                            <!-- Brand logo-->
                            <a class="brand-logo" href="#">
                                <img src="../assets/img/logo paspos 160x160.png" style="width:32px;height:28px;">
                                <h2 class="brand-text text-danger ms-1">Pas POS</h2>
                            </a>
                            <!-- /Brand logo-->
                            <!-- Left Text-->
                            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="../assets/tema/template/app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
                            </div>
                            <!-- /Left Text-->
                            <!-- Login-->
                            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                    <h2 class="card-title fw-bold mb-1">Selamat Datang Member Pas POS! 👋</h2>
                                    <p class="card-text mb-2">Login... untuk mulai menggunkan aplikasi </p>
                                    <form action="proses/proses_login.php" method="post" class="auth-login-form mt-2">
                                        <div class="mb-1">
                                            <label class="form-label" for="login-email">Username</label>
                                            <input class="form-control" id="login-email" type="text" name="user" placeholder="demo" aria-describedby="login-email" autofocus="" tabindex="1" required/>
                                        </div>
                                        <div class="mb-1">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label" for="login-password">Password</label><a href="forgotpass.php"><small>Lupa Passsword?</small></a>
                                            </div>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input class="form-control form-control-merge" id="login-password" type="password" name="pass" placeholder="············" aria-describedby="login-password" tabindex="2" required /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <div class="form-check">
                                                <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                                <label class="form-check-label" for="remember-me"> Ingatkan Saya</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100" tabindex="4">Sign in</button>
                                    </form>
                                    <p class="text-center mt-2"><span>Belum memiliki Akun?</span><a href="register.php"><span>&nbsp;Daftar Sekarang</span></a></p>
                                </div>
                            </div>
                            <!-- /Login-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content-->


        <!-- BEGIN: Vendor JS-->
        <script src="../assets/tema/template/app-assets/vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="../assets/tema/template/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
        <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <script src="../assets/tema/template/app-assets/js/scripts/pages/page-auth-login.js"></script>
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
        </script>
    </body>
    <!-- END: Body-->

</html>