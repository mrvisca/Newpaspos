<?php
    ob_start();
    include 'header.php';
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
                            <h2 class="content-header-title float-start mb-0">Produk Cabang</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Cabang</a>
                                    </li>
                                    <li class="breadcrumb-item active">Produk Cabang
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
                                    <div class="search-results total_item_search">16285 results found</div>
                                </div>
                                <div class="view-options d-flex">
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
                                <select name="cabang" class="form-select search-product cabang">
                                    <option value="0">Item Default</option>
                                    <?php
                                        // Get data branch
                                        $query_branch = "SELECT id,nama FROM branch WHERE id_brand='".$id_brand."'";
                                        $branch_data = $koneksi->prepare($query_branch);
                                        $branch_data->execute();
                                        $branch_data->bind_result($branch_id,$branch_nama);
                                        while($branch_data->fetch()){
                                            echo '<option value="'.$branch_id.'">'.$branch_nama.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control search-product cari_produk" id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
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
        $(document).ready(function(){
            load_data();
            function load_data(cabang, keyword)
            {
                $.ajax({
                    method:"POST",
                    url:"branchproduct.php",
                    data: {cabang: cabang, keyword:keyword},
                    success:function(hasil)
                    {
                        $('.grid-view').html(hasil);

                        var hitung = $(".hitung_pencarian").html();
                        hitungSearch(hitung);
                    }
                });
            }
            $('.cari_produk').keyup(function(){
                var cabang = $(".cabang").val();
                var keyword = $(".cari_produk").val();
                load_data(cabang,keyword);
            });
            $('.cabang').change(function(){
                var cabang = $(".cabang").val();
                var keyword = $(".cari_produk").val();
                load_data(cabang,keyword);
            });

            function hitungSearch(nilai){
                $(".total_item_search").html(parseInt(nilai)+" Produk Tersedia");
            }
        });

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