<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';

    // Get data brand
    $query_brand = "SELECT nama,user,pass,nohp,masa_aktif,created_at,alamat,kota,provinsi,email FROM brand WHERE id='".$id_brand."'";
    $brand_data = $koneksi->prepare($query_brand);
    $brand_data->execute();
    $brand_data->bind_result($nama_brand,$username,$password,$nohp,$masa_aktif,$created_at,$alamat,$kota,$provinsi,$email);
    while($brand_data->fetch()){
    }
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
                            <h2 class="content-header-title float-start mb-0">Akun Pengguna</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Akun</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Akun Pengguna</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Akun Pengguna</h4>
                                </div>
                                <div class="card-body">
                                    <form action="proses/proses_akun_pengguna.php" method="POST" class="form form-horizontal">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="fname-icon">Nama Pengguna</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="home"></i></span>
                                                            <input type="text" class="form-control" name="nama" value="<?php echo $nama_brand; ?>" placeholder="Nama Pengguna" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="email-icon">Username</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                                            <input type="email" class="form-control" name="user" value="<?php echo $username; ?>" placeholder="Username" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="contact-icon">Password</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="lock"></i></span>
                                                            <input type="text" class="form-control" name="pass" value="<?php echo $password; ?>" placeholder="Password" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="pass-icon">No Hp</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="phone"></i></span>
                                                            <input type="number" class="form-control" name="nohp" value="<?php echo $nohp; ?>" placeholder="No Handphone" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="pass-icon">Email</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="mail"></i></span>
                                                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="pass-icon">Alamat</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <textarea name="alamat" class="form-control"><?php echo $alamat; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="pass-icon">Kota</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="home"></i></span>
                                                            <input type="text" class="form-control" name="kota" value="<?php echo $kota; ?>" placeholder="Kota" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="pass-icon">Provinsi</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="home"></i></span>
                                                            <input type="text" class="form-control" name="provinsi" value="<?php echo $provinsi; ?>" placeholder="Provinsi" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="pass-icon">Tanggal Pembuatan</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                                                            <input type="text" class="form-control" placeholder="Tanggal Pembuatan" value="<?php echo $created_at; ?>" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label" for="pass-icon">Masa Aktif</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="calendar"></i></span>
                                                            <input type="text" class="form-control" placeholder="Masa Aktif" value="<?php echo $masa_aktif; ?>" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id_brand" value="<?php echo $id_brand; ?>" />
                                            <div class="col-sm-9 offset-sm-3">
                                                <div class="mb-1">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customCheck2" />
                                                        <label class="form-check-label" for="customCheck2">Remember me</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary me-1">Update Akun</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Horizontal form layout section end -->
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

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
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