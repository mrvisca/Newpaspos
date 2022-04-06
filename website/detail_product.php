<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';

    function rupiah($angka){
	    $hasil_rupiah = "" . number_format($angka,0,',','.');
	    return $hasil_rupiah;
    }

    // Get nama user brand
    $query_nama_user = "SELECT nama FROM brand WHERE id='".$id_brand."'";
    $nama_user = $koneksi->prepare($query_nama_user);
    $nama_user->execute();
    $nama_user->bind_result($user_nama);
    while($nama_user->fetch()){
    }

    $id = $_GET['id'];
    $query_data_product = "SELECT nama,kode,harga,harga_beli,deskripsi,id_brand,id_katagori,gambar,penilaian FROM item WHERE id='".$id."'";
    $data_product = $koneksi->prepare($query_data_product);
    $data_product->execute();
    $data_product->bind_result($nama_produk,$kode_product,$harga,$harga_beli,$deskripsi,$id_brand,$id_katagori,$gambar,$penilaian);
    while($data_product->fetch()){
        // Get nama katagori
        $query_nkatagori = "SELECT nama FROM katagori WHERE id='".$id_katagori."'";
        $nkatagori_data = $koneksi2->prepare($query_nkatagori);
        $nkatagori_data->execute();
        $nkatagori_data->bind_result($nama_katagori);
        while($nkatagori_data->fetch()){
        }
    }
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Produk Detail</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Produk</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="app-ecommerce-shop.html">Produk Detail</a>
                                    </li>
                                    <li class="breadcrumb-item active"><?php echo $nama_produk; ?>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- app e-commerce details start -->
                <section class="app-ecommerce-details">
                    <div class="card">
                        <!-- Product Details starts -->
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="../assets/tema/template/app-assets/images/pages/eCommerce/1.png" class="img-fluid product-img" alt="product image" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <h4><?php echo $nama_produk; ?></h4>
                                    <span class="card-text item-company">By <a href="#" class="company-name"><?php echo $user_nama; ?></a></span>
                                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                        <h4 class="item-price me-1">Rp.<?php echo rupiah($harga); ?></h4>
                                        <ul class="unstyled-list list-inline ps-1 border-start">
                                            <?php
                                                if($penilaian=="1"){
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                }else if($penilaian=="2"){
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                }else if($penilaian=="3"){
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                }else if($penilaian=="4"){
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                }else{
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                    echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <p class="card-text">Available - <span class="text-success">In stock</span></p>
                                    <p class="card-text">
                                        <?php echo $deskripsi; ?>
                                    </p>
                                    <ul class="product-features list-unstyled">
                                        <li> <span><b>Ingredient (Bahan Baku):</b></span></li>
                                        <?php
                                            // Mencari data ingredient
                                            $query_data_ingredient = "SELECT id_daftar_stock,jumlah FROM ingredient WHERE id_item='".$id."'";
                                            $data_ingredient = $koneksi->prepare($query_data_ingredient);
                                            $data_ingredient->execute();
                                            $data_ingredient->bind_result($id_daftar_stock,$jumlah_stock);
                                            while($data_ingredient->fetch()){
                                                // Get nama daftar stock
                                                $query_nama_stock = "SELECT nama,unit FROM daftar_stock WHERE id='".$id_daftar_stock."'";
                                                $data_nstock = $koneksi2->prepare($query_nama_stock);
                                                $data_nstock->execute();
                                                $data_nstock->bind_result($nama_dstock,$unit_stock);
                                                while($data_nstock->fetch()){

                                                if($unit_stock=="ONS"){
                                                    $unit_stock = "Gr";
                                                }
                                        ?>
                                        <li><i class="fa fa-check" aria-hidden="true"></i> <span><?php echo $nama_dstock; ?> (<?php echo $jumlah_stock; ?> <?php echo $unit_stock; ?>)</span></li>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </ul>
                                    <hr />
                                    <div class="product-color-options">
                                        <h6>Katagori</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-inline-block">
                                                <span class="badge badge-light-primary"> <?php echo $nama_katagori; ?> </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr />
                                    <div class="d-flex flex-column flex-sm-row pt-1">
                                        <a href="edit_product.php?id=<?php echo $id; ?>" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0">
                                            <i data-feather="edit" class="me-50"></i>
                                            <span class="add-to-cart">Edit Produk</span>
                                        </a>
                                        <a href="ingredient.php?id=<?php echo $id; ?>" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0">
                                            <i data-feather="book-open" class="me-50"></i>
                                            <span>Ingredient (Bahan Baku)</span>
                                        </a>
                                        <div class="btn-group dropdown-icon-wrapper btn-share">
                                            <button type="button" class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="share-2"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="facebook"></i>
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="twitter"></i>
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="youtube"></i>
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    <i data-feather="instagram"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details ends -->

                        <!-- Item features starts -->
                        <div class="item-features">
                            <div class="row text-center">
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="award"></i>
                                        <h4 class="mt-2 mb-1">100% Original</h4>
                                        <p class="card-text">Chocolate bar candy canes ice cream toffee. Croissant pie cookie halvah.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="clock"></i>
                                        <h4 class="mt-2 mb-1">10 Day Replacement</h4>
                                        <p class="card-text">Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="w-75 mx-auto">
                                        <i data-feather="shield"></i>
                                        <h4 class="mt-2 mb-1">1 Year Warranty</h4>
                                        <p class="card-text">Cotton candy gingerbread cake I love sugar plum I love sweet croissant.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item features ends -->

                        <!-- Related Products starts -->
                        <div class="card-body">
                            <div class="mt-4 mb-2 text-center">
                                <h4>Produk Lainnya</h4>
                                <p class="card-text">Produk lainnya dari <?php echo $user_nama; ?></p>
                            </div>
                            <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                                <div class="swiper-wrapper">
                                    <?php
                                        // Get Product Brand
                                        $query_brand_product = "SELECT nama,harga,gambar,penilaian FROM item WHERE id_brand='".$id_brand."'";
                                        $brand_product = $koneksi->prepare($query_brand_product);
                                        $brand_product->execute();
                                        $brand_product->bind_result($nama_item,$harga_item,$gambar_item,$penilaian_item);
                                        while($brand_product->fetch()){
                                    ?>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="item-heading">
                                                <h5 class="text-truncate mb-0"><?php echo $nama_item; ?></h5>
                                                <small class="text-body">by <?php echo $user_nama; ?></small>
                                            </div>
                                            <div class="img-container w-50 mx-auto py-75">
                                                <img src="../assets/tema/template/app-assets/images/elements/apple-watch.png" class="img-fluid" alt="image" />
                                            </div>
                                            <div class="item-meta">
                                                <ul class="unstyled-list list-inline mb-25">
                                                    <?php
                                                        if($penilaian=="1"){
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                        }else if($penilaian=="2"){
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                        }else if($penilaian=="3"){
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                        }else if($penilaian=="4"){
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                                        }else{
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                            echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                                        }
                                                    ?>
                                                </ul>
                                                <p class="card-text text-primary mb-0">$399.98</p>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        <!-- Related Products ends -->
                    </div>
                </section>
                <!-- app e-commerce details end -->
                
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
    <script src="../assets/tema/template/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/extensions/swiper.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../assets/tema/template/app-assets/js/scripts/pages/app-ecommerce-details.js"></script>
    <script src="../assets/tema/template/app-assets/js/scripts/forms/form-number-input.js"></script>
    <script src="../assets/tema/template/app-assets/js/scripts/components/components-modals.js"></script>
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