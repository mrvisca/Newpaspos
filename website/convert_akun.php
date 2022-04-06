<?php
    include '../settings/database.php';
    // Select data brand
    $query_brand = mysqli_query($koneksi,"SELECT * FROM brand");
    if(mysqli_num_rows($query_brand) > 0){
        $responsistem = array();
        $responsistem["data"] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_brand)){
            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['nama'] = $row['nama'];
            $data['maxbranch'] = $row['maxbranch'];
            $data['user'] = $row['user'];
            $data['nohp'] = $row['nohp'];
            $data['masa_aktif'] = $row['masa_aktif'];
            $data['created_at'] = $row['created_at'];
            $data['email'] = $row['email'];
            $data['trial'] = $row['trial'];
            array_push($responsistem["data"], $data);
        }
        // echo json_encode($responsistem);
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/pengguna.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_pengguna.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>