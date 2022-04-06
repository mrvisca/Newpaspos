<?php
    include '../settings/database.php';
    $query_cari = mysqli_query($koneksi,"SELECT * FROM supplier WHERE id='".$_GET['id']."'");
    $supplier = mysqli_fetch_array($query_cari);
    
    // get nama stock
    $query_nstock = "SELECT nama FROM daftar_stock WHERE id='".$supplier['id_daftar_stock']."'";
    $nstock_data = $koneksi2->prepare($query_nstock);
    $nstock_data->execute();
    $nstock_data->bind_result($nama_stock);
    while($nstock_data->fetch()){
    }
    $data = array('notlp' => $supplier['notlp'],'id_stock' => $supplier['id_daftar_stock'],'dstock' => $nama_stock,'harga_p' => $supplier['harga_penawaran'],'alamat' => $supplier['alamat']);
      echo json_encode($data);
?>