<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';

    function rupiah($angka){
        $hasil_rupiah = "" . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    $id_product = $_GET['id'];
    // Get data item from id
    $query_data_item = "SELECT nama,kode,harga,harga_beli,deskripsi,id_brand,id_katagori,gambar,penilaian FROM item WHERE id='".$id_product."'";
    $data_item = $koneksi->prepare($query_data_item);
    $data_item->execute();
    $data_item->bind_result($nama_produk,$kode_produk,$harga_produk,$harga_beli,$deskripsi,$id_brand,$id_katagori,$gambar,$penilaian);
    while($data_item->fetch()){
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
                            <h2 class="content-header-title float-start mb-0">Form Edit Product</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Produk</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Form Edit Produk</a>
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
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Edit Produk</h4>
                            </div>
                            <div class="card-body">
                                <form action="proses/proses_update_product.php" method="POST" class="form form-horizontal">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="fname-icon">Foto Produk :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <input class="form-control" type="file" name="berkas" id="formFile" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="email-icon">Nama Produk :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                                        <input type="text" class="form-control" name="nama" value="<?php echo $nama_produk; ?>" placeholder="Nama Produk" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="contact-icon">Kode Produk :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="codepen"></i></span>
                                                        <input type="number" class="form-control" name="kode" value="<?php echo $kode_produk; ?>" placeholder="Kode Produk" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="pass-icon">Harga :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="dollar-sign"></i></span>
                                                        <input type="text" class="form-control" id="harga" name="harga" value="<?php echo rupiah($harga_produk); ?>" placeholder="Harga Jual" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="pass-icon">Harga Beli :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="dollar-sign"></i></span>
                                                        <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo rupiah($harga_beli); ?>" placeholder="Harga Beli" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="pass-icon">Deskripsi :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <textarea data-length="20" name="deskripsi" class="form-control char-textarea" rows="3" placeholder="Counter" style="height: 100px"><?php echo $deskripsi; ?></textarea>
                                                    </div>
                                                    <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 200 </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="pass-icon">Katagori :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <select name="id_katagori" class="form-select">
                                                            <?php
                                                                if($id_katagori!="" || $id_katagori!=0){
                                                                    // Get nama from id_katagori
                                                                    $query_nkatagori = "SELECT nama FROM katagori WHERE id='".$id_katagori."'";
                                                                    $data_nkatagori = $koneksi->prepare($query_nkatagori);
                                                                    $data_nkatagori->execute();
                                                                    $data_nkatagori->bind_result($katagori_name);
                                                                    while($data_nkatagori->fetch()){
                                                                        echo '<option value="'.$id_katagori.'" selected disabled>'.$katagori_name.'</option>';
                                                                        // Get data katagori
                                                                        $query_katagori = "SELECT id,nama FROM katagori WHERE id_brand='".$id_brand."' AND id!='".$id_katagori."'";
                                                                        $data_katagori = $koneksi2->prepare($query_katagori);
                                                                        $data_katagori->execute();
                                                                        $data_katagori->bind_result($katagori_id,$katagori_nama);
                                                                        while($data_katagori->fetch()){
                                                                            echo '<option value="'.$katagori_id.'">'.$katagori_nama.'</option>';
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label" for="pass-icon">Penilaian :</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group input-group-merge">
                                                        <select name="penilaian" class="form-select">
                                                            <?php
                                                                if($penilaian!="" || $penilaian!=0){
                                                                    if($penilaian==1){
                                                                        echo '<option value="1" selected>Bintang 1</option>';
                                                                        echo '<option value="2">Bintang 2</option>';
                                                                        echo '<option value="3">Bintang 3</option>';
                                                                        echo '<option value="4">Bintang 4</option>';
                                                                        echo '<option value="5">Bintang 5</option>';
                                                                    }else if($penilaian==2){
                                                                        echo '<option value="1">Bintang 1</option>';
                                                                        echo '<option value="2" selected>Bintang 2</option>';
                                                                        echo '<option value="3">Bintang 3</option>';
                                                                        echo '<option value="4">Bintang 4</option>';
                                                                        echo '<option value="5">Bintang 5</option>';
                                                                    }else if($penilaian==3){
                                                                        echo '<option value="1">Bintang 1</option>';
                                                                        echo '<option value="2">Bintang 2</option>';
                                                                        echo '<option value="3" selected>Bintang 3</option>';
                                                                        echo '<option value="4">Bintang 4</option>';
                                                                        echo '<option value="5">Bintang 5</option>';
                                                                    }else if($penilaian==4){
                                                                        echo '<option value="1">Bintang 1</option>';
                                                                        echo '<option value="2">Bintang 2</option>';
                                                                        echo '<option value="3">Bintang 3</option>';
                                                                        echo '<option value="4" selected>Bintang 4</option>';
                                                                        echo '<option value="5">Bintang 5</option>';
                                                                    }else{
                                                                       echo '<option value="1">Bintang 1</option>';
                                                                        echo '<option value="2">Bintang 2</option>';
                                                                        echo '<option value="3">Bintang 3</option>';
                                                                        echo '<option value="4">Bintang 4</option>';
                                                                        echo '<option value="5" selected>Bintang 5</option>'; 
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_item" value="<?php echo $id_product; ?>"/>
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary me-1">Update Produk</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                </form>
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

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

        var harga = document.getElementById("harga");
        harga.addEventListener("keyup", function(e) {
            harga.value = convertRupiah(this.value);
        });
        harga.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });
        
        var harga_beli = document.getElementById("harga_beli");
        harga_beli.addEventListener("keyup", function(e) {
            harga_beli.value = convertRupiah(this.value);
        });
        harga_beli.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });
        
        function convertRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split  = number_string.split(","),
            sisa   = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
            if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
            }
        
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
        }
        
        function isNumberKey(evt) {
            key = evt.which || evt.keyCode;
            if ( 	key != 188 // Comma
            && key != 8 // Backspace
            && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            && (key < 48 || key > 57) // Non digit
            ) 
            {
            evt.preventDefault();
            return;
            }
        }
    </script>
</body>
<!-- END: Body-->

</html>