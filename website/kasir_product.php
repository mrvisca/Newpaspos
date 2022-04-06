<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<?php
    include '../settings/database.php';
    session_start();
    $id_brand=$_SESSION['id_brand'];

    function rupiah($angka){
	    $hasil_rupiah = "" . number_format($angka,0,',','.');
	    return $hasil_rupiah;
    }

    $s_cabang = 0;
    $s_keyword = "";
    $s_katagori = "";
    $no = 1;
    if(isset($_POST['cabang'])){
        $s_cabang = $_POST['cabang'];
        $s_katagori = $_POST['katagori'];
        $s_keyword = $_POST['keyword'];
    }

    $query_item_full = "SELECT * FROM item INNER JOIN item_branch ON item.id = item_branch.id_item WHERE (item.nama LIKE '%".$s_keyword."%' OR .item.kode LIKE '%".$s_keyword."%') AND item_branch.id_branch='".$s_cabang."' AND item_branch.id_brand='".$id_brand."'";
    if($s_katagori!=""){
        $query_item_full.="AND item.id_katagori='".$s_katagori."'";
    }
    $item_full_data = $koneksi->prepare($query_item_full);
    $item_full_data->execute();
    $result = $item_full_data->get_result();
    $total_pencarian = $result->num_rows;
    if($result->num_rows > 0){
        while($hasil = $result->fetch_assoc()){
            $item_id = $hasil['id'];
            $item_nama = $hasil['nama'];
            $item_kode = $hasil['kode'];
            $item_harga = $hasil['harga'];
            $item_harga_beli = $hasil['harga_beli'];
            $item_deskripsi = $hasil['deskripsi'];
            $item_katagori = $hasil['id_katagori'];
            $item_gambar = $hasil['gambar'];
            $item_penilaian = $hasil['penilaian'];

            $id_item = $hasil['id_item'];
            $id_branch = $hasil['id_branch'];

            // Get nama branch
            $query_nama_branch = "SELECT nama FROM branch WHERE id='".$id_branch."'";
            $nbranch_data = $koneksi2->prepare($query_nama_branch);
            $nbranch_data->execute();
            $nbranch_data->bind_result($nama_branch);
            while($nbranch_data->fetch()){
            }

            if($id_branch==0){
                $nama_branch = "Belum ada cabang";
            }
?>
    <div class="card ecommerce-card">
        <div class="item-img text-center">
            <a href="detail_product.php?id=<?php echo $id_item; ?>">
                <img class="img-fluid card-img-top" src="../assets/tema/template/app-assets/images/pages/eCommerce/1.png" alt="img-placeholder" />
            </a>
        </div>
        <div class="card-body">
            <div class="item-wrapper">
                <div class="item-rating">
                    <ul class="unstyled-list list-inline">
                        <?php
                            if($item_penilaian=="1"){
                                echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                            }else if($item_penilaian=="2"){
                                echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                            }else if($item_penilaian=="3"){
                                echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                                echo '<li class="ratings-list-item"><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                            }else if($item_penilaian=="4"){
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
                <div>
                    <h6 class="item-price">Rp.<?php echo rupiah($item_harga); ?></h6>
                </div>
            </div>
            <h6 class="item-name">
                <a class="text-body" href="detail_product.php?id=<?php echo $id_item; ?>"><?php echo $item_nama; ?> (<?php echo $nama_branch; ?>)</a>
                <span class="card-text item-company">By <a href="#" class="company-name"><?php echo $item_nama; ?></a></span>
            </h6>
            <p class="card-text item-description">
                <?php echo $item_deskripsi; ?>
            </p>
        </div>
        <div class="item-options text-center">
            <div class="item-wrapper">
                <div class="item-cost">
                    <h4 class="item-price">Rp.<?php echo rupiah($item_harga); ?></h4>
                </div>
            </div>
            <a href="#" class="btn btn-light btn-wishlist">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                <span>Details</span>
            </a>
            <a href="#" class="btn btn-primary btn-cart" data-id="<?php echo $id_item; ?>" data-id_branch="<?php echo $id_branch; ?>" data-nama="<?php echo $item_nama; ?>" data-nama_branch="<?php echo $nama_branch; ?>" data-harga="<?php echo $item_harga; ?>" data-jumlah="1" data-katagori="<?php echo $item_katagori; ?>" data-harga_beli="<?php echo $item_harga_beli; ?>">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="add-to-cart">Keranjang</span>
            </a>
        </div>
    </div>
<?php
        }
    }

    // Get data setting kasir
    $query_setting = "SELECT service_charge,diskon,pajak FROM setting_kasir WHERE id_branch='".$s_cabang."'";
    $data_setting = $koneksi->prepare($query_setting);
    $data_setting->execute();
    $data_setting->bind_result($service_charge,$diskon,$pajak);
    while($data_setting->fetch()){
    }
?>
<p class="service_charge_source" style="display:none;"><?php echo $service_charge; ?></p>
<p class="diskon_source" style="display:none;"><?php echo $diskon; ?></p>
<p class="pajak_source" style="display:none;"><?php echo $pajak; ?></p>
<p class="total_pencarian" style="display:none;"><?php echo $total_pencarian; ?></p>
