<?php
    include '../settings/database.php';
    $query_cari_stock = mysqli_query($koneksi,"SELECT * FROM daftar_stock WHERE id='".$_GET['id']."'");
    $data_stock = mysqli_fetch_array($query_cari_stock);

    $data = array('nama' => $data_stock['nama'],'harga' => $data_stock['harga_unit']);
      echo json_encode($data);
?>