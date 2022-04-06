<?php
    include '../settings/database.php';
    session_start();
    $id_brand=$_SESSION['id_brand'];

    function rupiah($angka){
	    $hasil_rupiah = "" . number_format($angka,0,',','.');
	    return $hasil_rupiah;
    }

    $s_pesanan = 0;
    $status = "";
    $no = 1;
    if(isset($_POST['id_pesanan'])){
        $s_pesanan = $_POST['id_pesanan'];
    }

    $query_penjualan = "SELECT id,id_item,tanggal,nama_item,jml_beli,harga_satuan,total,pelayanan,id_katagori FROM penjualan WHERE id_pesanan='".$s_pesanan."' AND id_brand='".$id_brand."'";
    $data_penjualan = $koneksi->prepare($query_penjualan);
    $data_penjualan->execute();
    $result = $data_penjualan->get_result();
    if($result->num_rows > 0){
        while($hasil = $result->fetch_assoc()){
            $penjualan_id = $hasil['id'];
            $penjualan_id_item = $hasil['id_item'];
            $penjualan_tanggal = $hasil['tanggal'];
            $penjualan_nama_item = $hasil['nama_item'];
            $penjualan_jml_beli = $hasil['jml_beli'];
            $penjualan_harga_satuan = $hasil['harga_satuan'];
            $penjualan_total = $hasil['total'];
            $penjualan_pelayanan = $hasil['pelayanan'];
            $penjualan_id_katagori = $hasil['id_katagori'];

            $tanggal_order = date('d-m-Y',strtotime($penjualan_tanggal));
            // Get nama katagori
            $query_nkatagori = "SELECT nama FROM katagori WHERE id='".$penjualan_id_katagori."'";
            $nkatagori_data = $koneksi->prepare($query_nkatagori);
            $nkatagori_data->execute();
            $nkatagori_data->bind_result($nama_katagori);
            while($nkatagori_data->fetch()){
            }

            $badge = "";
            $display = "block";
            
            if($penjualan_pelayanan!=0){
                $status = "Selesai";
                $badge = "badge-light-success";
                $display = "none";
            }else{
                $status = "Belum dilayani";
                $badge = "badge-light-warning";
                $display = "block";
            }
?>
    <li class="todo-item">
        <div class="todo-title-wrapper">
            <div class="todo-title-area">
                <i data-feather="more-vertical" class="drag-icon"></i>
                <div class="title-wrapper">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input checklist" data-id_penjualan="<?php echo $penjualan_id; ?>" style="display:<?php echo $display; ?>;"/>
                        <label class="form-check-label" for="customCheck1"></label>
                    </div>
                    <span class="todo-title"><?php echo $penjualan_nama_item; ?></span>
                </div>
            </div>
            <div class="todo-item-action">
                <div class="badge-wrapper me-1">
                    <span class="badge rounded-pill badge-light-primary"><?php echo $nama_katagori; ?></span>
                </div>
                <small class="text-nowrap text-muted me-1"><?php echo $tanggal_order; ?></small>
                <div class="badge-wrapper me-1">
                    <p class="data_layanan" style="display:none;"><?php echo $penjualan_pelayanan; ?></p>
                    <span class="badge rounded-pill <?php echo $badge; ?>"><?php echo $status; ?></span>
                </div>
            </div>
        </div>
    </li>
<?php
        }
    }
?>
<br/>
<button type="button" class="btn btn-primary w-100 update_pesanan">Selesaikan pesanan</button>