<?php
    session_start();
    include '../settings/database.php';
    $id_brand=$_SESSION['id_brand'];

    // Select Data Pegawai
    $query_pegawai = mysqli_query($koneksi, "SELECT * FROM employee WHERE id_brand='".$id_brand."'");
    if(mysqli_num_rows($query_pegawai)){
        $responsistem = array();
        $responsistem['data'] = array();
        $no = 1;
        while($row = mysqli_fetch_assoc($query_pegawai)){

            // Get nama branch
            $query_branch = "SELECT nama FROM branch WHERE id='".$row['id_branch']."'";
            $data_branch = $koneksi2->prepare($query_branch);
            $data_branch->execute();
            $data_branch->bind_result($nama_branch);
            while($data_branch->fetch()){
            }

            $data['responsive_id'] = "";
            $data['no'] = $no++;
            $data['id'] = $row['id'];
            $data['id_brand'] = $row['id_brand'];
            $data['user'] = $row['user'];
            $data['pass'] = $row['pass'];
            $data['id_branch'] = $row['id_branch'];
            $data['nama_branch'] = $nama_branch;
            $data['nama'] = $row['nama'];
            $data['email'] = $row['email'];
            array_push($responsistem["data"], $data);
        }
        $filejson = json_encode($responsistem);
        $rootfile = "jsonfile/pegawai.json";
        $output_file = file_put_contents($rootfile,$filejson);
        echo '<script>window.location.href="daftar_pegawai.php"</script>';
    }else{
        $responsistem["message"]="Tidak ada data";
        echo json_encode($responsistem);
    }
?>