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
    $no = 1;
    if(isset($_POST['cabang'])){
        $s_cabang = $_POST['cabang'];
        $s_keyword = $_POST['keyword'];
    }

    $query_item_full = "SELECT * FROM item INNER JOIN item_branch ON item.id = item_branch.id_item WHERE (item.nama LIKE '%".$s_keyword."%' OR .item.kode LIKE '%".$s_keyword."%') AND item_branch.id_branch='".$s_cabang."' AND item_branch.id_brand='".$id_brand."'";
    $item_full_data = $koneksi->prepare($query_item_full);
    $item_full_data->execute();
    $result = $item_full_data->get_result();
    $hitung_pencarian = $result->num_rows;
    if($result->num_rows > 0){
        while($hasil = $result->fetch_assoc()){
            $item_id = $hasil['id'];
            $item_nama = $hasil['nama'];
            $item_kode = $hasil['kode'];
            $item_harga = $hasil['harga'];
            $item_deskripsi = $hasil['deskripsi'];
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
                <span class="card-text item-company">By <a href="#" class="company-name">Apple</a></span>
            </h6>
            <p class="card-text item-description">
                <?php echo $item_deskripsi; ?>
            </p>
        </div>
        <div class="item-options text-center">
            <div class="item-wrapper">
                <div class="item-cost">
                    <h4 class="item-price">Rp. <?php echo rupiah($item_harga); ?></h4>
                </div>
            </div>
            <a href="proses/proses_hapus_ibranch.php?id=<?php echo $id_item; ?>" class="btn btn-light btn-wishlist" onclick="return confirm('Apa kamu yakin akan menghapus produk ini?');">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                <span>Hapus Item</span>
            </a>
            <button type="button" class="btn btn-primary btn-cart open-modal" data-bs-toggle="modal" data-bs-target="#inlineForm" data-id="<?php echo $id_item; ?>" data-nama="<?php echo $item_nama; ?>" data-id_branch="<?php echo $id_branch; ?>" data-id_brand="<?php echo $id_brand; ?>">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="add-to-cart">Tambah Produk</span>
            </button>
        </div>
    </div>
<?php
        }
    }
?>

<!-- Modal -->
    <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Form Tambah Produk Cabang</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses/proses_tambah_branch_product.php" method="POST">
                    <div class="modal-body">
                        <label>Produk: </label>
                        <div class="mb-1">
                            <br/>
                            <input type="text" class="form-control nama_item" readonly/>
                            <input type="hidden" class="form-control id_item" name="id_item" />
                        </div>
                        <label>Nama Cabang: </label>
                        <div class="mb-1">
                            <br/>
                            <select name="id_branch" class="form-select id_branch">
                                <option value="0">Belum ditambahkan</option>
                                <?php
                                    // Query branch
                                    $query_branch_data = "SELECT id,nama FROM branch WHERE id_brand='".$id_brand."'";
                                    $branch_data = $koneksi->prepare($query_branch_data);
                                    $branch_data->execute();
                                    $branch_data->bind_result($branch_id,$branch_nama);
                                    while($branch_data->fetch()){
                                ?>
                                <option value="<?php echo $branch_id; ?>"><?php echo $branch_nama; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="id_brand" class="form-control id_brand"/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Modal End -->
<p class="hitung_pencarian"><?php echo $hitung_pencarian; ?></p>

<script>
    $(document).on("click",".open-modal",function (){
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var id_branch = $(this).data('id_branch');
        var id_brand = $(this).data('id_brand');
        $(".id_item").val(id); // id_ingredient
        $(".nama_item").val(nama); // jumlah_ingredient
        $(".id_branch").val(id_branch); // id_daftar_stock
        $(".id_brand").val(id_brand); // id_daftar_stock
    })
</script>
