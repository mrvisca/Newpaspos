<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';

    $id = $_GET['id'];
    // Get nama item
    $query_data_nama = "SELECT id,nama FROM item WHERE id='".$id."'";
    $data_nama = $koneksi->prepare($query_data_nama);
    $data_nama->execute();
    $data_nama->bind_result($item_id,$nama_produk);
    while($data_nama->fetch()){
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
                            <h2 class="content-header-title float-start mb-0">Ingredient (Bahan Baku)</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Produk</a>
                                    </li>
                                    <li class="breadcrumb-item active">Ingredient
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section class="form-control-repeater">
                    <div class="row">
                        <!-- Invoice repeater -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Ingredient (Bahan Baku)</h4>
                                </div>
                                <div class="card-body">
                                    <form action="proses/proses_tambah_ingredient.php" class="invoice-repeater" method="POST">
                                        <div class="form_copy">
                                            <div class="item-list">
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-5 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Nama Bahan</label>
                                                            <select name="id_daftar_stock[]" class="form-select">
                                                                <option value="" disabled selected> ---  Pilih Bahan Stock --- </option>
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
                                                                <option value="<?php echo $rows['id']; ?>"><?php echo $rows['nama']; ?> (<?php echo $rows['unit']; ?>)</option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemcost">Jumlah</label>
                                                            <input type="number" class="form-control" name="jumlah[]" aria-describedby="itemcost" placeholder="Jumlah Bahan" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12 mb-100">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1 remove" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Hapus</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_item" value="<?php echo $id; ?>"/>
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-icon btn-primary add-more" type="button">
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Tambah List</span>
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-icon btn-success text-right" style="float: right;" type="submit">
                                                    <i data-feather="save" class="me-25"></i>
                                                    <span>Simpan Ingredient</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice repeater -->
                    </div>
                </section>

                <!-- Table head options start -->
                <div class="row" id="table-head">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Ingredient Bahan Baku <?php echo $nama_produk; ?></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bahan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // Get data ingredient
                                            $query_ingredient = "SELECT id,id_daftar_stock,jumlah FROM ingredient WHERE id_item='".$id."'";
                                            $ingredient_data = $koneksi->prepare($query_ingredient);
                                            $ingredient_data->execute();
                                            $ingredient_data->bind_result($id_ing,$daftar_stock_id,$jumlah_ing);
                                            $no = 1;
                                            while($ingredient_data->fetch()){
                                                // Get Nama Stock
                                                $query_nstock = "SELECT nama FROM daftar_stock WHERE id='".$daftar_stock_id."'";
                                                $nstock_data = $koneksi2->prepare($query_nstock);
                                                $nstock_data->execute();
                                                $nstock_data->bind_result($nama_stock);
                                                while($nstock_data->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $nama_stock; ?></td>
                                            <td><?php echo $jumlah_ing; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item open-modal" data-bs-toggle="modal" data-bs-target="#inlineForm" data-iding="<?php echo $id_ing; ?>" data-namaing="<?php echo $daftar_stock_id; ?>" data-jumlahing="<?php echo $jumlah_ing; ?>">
                                                            <i data-feather="edit-2" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item" href="proses/proses_hapus_ingredient.php?id=<?php echo $id_ing; ?>&id_item=<?php echo $id; ?>">
                                                            <i data-feather="trash" class="me-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table head options end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Modal -->
    <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Ingredient <?php echo $nama_produk; ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses/proses_update_ingredient.php" method="POST">
                    <div class="modal-body">
                        <label>Nama Stock: </label>
                        <div class="mb-1">
                            <select name="id_daftar_stock" class="form-select id_ingredient">
                                <?php
                                    // Get data Stock
                                    $query_stockist = "SELECT id,nama FROM daftar_stock WHERE id_brand='".$id_brand."'";
                                    $data_stockist = $koneksi->prepare($query_stockist);
                                    $data_stockist->execute();
                                    $data_stockist->bind_result($daftar_id_stock,$stock_name);
                                    while($data_stockist->fetch()){
                                ?>
                                <option value="<?php echo $daftar_id_stock; ?>"><?php echo $stock_name; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <label>Jumlah: </label>
                        <div class="mb-1">
                            <input type="number" name="jumlah" placeholder="Jumlah" class="form-control jumlah_stock" />
                            <input type="hidden" name="id_ingredient" class="ids_stock" value=""/>
                            <input type="hidden" name="id_item" value="<?php echo $id_item; ?>"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Update Ingredient</button>
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

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../assets/tema/template/app-assets/js/scripts/components/components-modals.js"></script>
    <!-- END: Page JS-->

    <script>
        $(document).ready(function() {
            $(".add-more").click(function(){ 
                // var random_id = Math.floor((Math.random() * 10000) + 1);
                var html =  "<div class='item-list'>"+
                                "<div class='row d-flex align-items-end'>" +
                                    "<div class='col-md-5 col-12'>" +
                                        "<div class='mb-1'>" +
                                            "<label class='form-label' for='itemname'>Nama Bahan</label>" +
                                            "<select name='id_daftar_stock[]' class='form-select'>" +
                                                "<option value='' disabled selected> ---  Pilih Bahan Stock --- </option>" +
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
                                                "<option value='<?php echo $rows['id']; ?>'><?php echo $rows['nama']; ?> (<?php echo $rows['unit']; ?>)</option>" +
                                                "<?php
                                                        }
                                                    }
                                                ?>" +
                                            "</select>" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class='col-md-5 col-12'>" +
                                        "<div class='mb-1'>" +
                                            "<label class='form-label' for='itemcost'>Jumlah</label>" +
                                            "<input type='number' class='form-control' name='jumlah[]' aria-describedby='itemcost' placeholder='Jumlah Bahan' />" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class='col-md-2 col-12 mb-100'>" +
                                        "<div class='mb-1'>" +
                                            "<button class='btn btn-outline-danger text-nowrap px-1 remove' type='button'>" +
                                                feather.icons['x'].toSvg({ class: 'font-small-4' }) +
                                                "<span>Hapus</span>" +
                                            "</button>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>" +
                                "<hr />" +
                            "</div>";
                $(".form_copy").append(html);
            });
            $("body").on("click",".remove",function(){ 
                $(this).parents(".item-list").remove();
            });
        });

        $(document).on("click",".open-modal",function (){
            var id_ing = $(this).data('iding');
            var nama_ing = $(this).data('namaing');
            var jumlah_ing = $(this).data('jumlahing');
            $(".ids_stock").val(id_ing); // id_ingredient
            $(".jumlah_stock").val(jumlah_ing); // jumlah_ingredient
            $(".id_ingredient").val(nama_ing); // id_daftar_stock
        })

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