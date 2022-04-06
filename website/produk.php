<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<?php
    include '../settings/database.php';
    session_start();
    $id_brand=$_SESSION['id_brand'];

    function rupiah($angka){
	    $hasil_rupiah = "" . number_format($angka,0,',','.');
	    return $hasil_rupiah;
    }

    $s_keyword = "";
    if(isset($_POST['keyword'])){
        $s_keyword = $_POST['keyword'];
    }
    
    $no = 1;
    $query_item = "SELECT * FROM item WHERE (nama LIKE '%".$s_keyword."%' OR kode LIKE '%".$s_keyword."%') AND id_brand='".$id_brand."'";
    $data_item = $koneksi->prepare($query_item);
    $data_item->execute();
    $hasil = $data_item->get_result();

    if ($hasil->num_rows > 0) {
        while ($row = $hasil->fetch_assoc()) {
            $id = $row['id'];
            $nama_item = $row['nama'];
            $kode = $row['kode'];
            $harga = $row['harga'];
            $harga_beli = $row['harga_beli'];
            $deskripsi = $row['deskripsi'];
            $id_brand = $row['id_brand'];
            $id_katagori = $row['id_katagori'];
            $gambar = $row['gambar'];
            $penilaian = $row['penilaian'];
?>
    <!-- Wishlist Starts -->
    <div class="card ecommerce-card">
        <div class="item-img text-center">
            <a href="detail_product.php?id=<?php echo $id; ?>">
                <img src="../assets/tema/template/app-assets/images/pages/eCommerce/1.png" class="img-fluid" alt="img-placeholder" />
            </a>
        </div>
        <div class="card-body">
            <div class="item-wrapper">
                <div class="item-rating">
                    <ul class="unstyled-list list-inline">
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
                <div class="item-cost">
                    <h6 class="item-price"> Rp.<?php echo rupiah($harga); ?></h6>
                </div>
            </div>
            <div class="item-name">
                <a href="detail_product.php?id=<?php echo $id; ?>"><?php echo $nama_item; ?></a>
            </div>
            <p class="card-text item-description">
                <?php echo $deskripsi; ?>
            </p>
        </div>
        <div class="item-options text-center">
            <a href="proses/proses_hapus_product.php?id=<?php echo $id; ?>" class="btn btn-light btn-wishlist" onclick="return confirm('Apa kamu yakin akan menghapus produk ini?');">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                <span>Hapus</span>
            </a>
            <a href="detail_product.php?id=<?php echo $id; ?>" class="btn btn-primary btn-cart">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="add-to-cart">Detail</span>
            </a>
        </div>
    </div>
    <!-- Wishlist Ends -->

<?php
        }
    }
?>

