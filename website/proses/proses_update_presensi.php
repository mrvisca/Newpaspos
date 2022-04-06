<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    </head>
    <body>
        <?php
            include '../../settings/database.php';

            $id_presensi = $_POST['id_presensi'];
            $id_pegawai = $_POST['id_pegawai'];
            $id_shift = $_POST['id_shift'];
            $jam_presensi = $_POST['jam_presensi'];
            $status_kehadiran = $_POST['status_kehadiran'];
            $toleransi = $_POST['toleransi'];

            // Update data ke table item
            $query_update_presensi = "UPDATE presensi SET id_pegawai='".$id_pegawai."',id_shift='".$id_shift."',jam_presensi='".$jam_presensi."',status_kehadiran='".$status_kehadiran."',toleransi='".$toleransi."' WHERE id='".$id_presensi."'";
            $data_presensi = $koneksi->prepare($query_update_presensi);
            if($data_presensi->execute()){
                echo    '<script>
                            swal({
                                title: "Update Data Presensi Berhasil",
                                text: "Update Data Presensi berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../convert_presensi.php";
                            });
                        </script>';
            }else{
                echo    '<script>
                            swal({
                                title: "Update Data Presensi Gagal",
                                text: "Update Data Presensi Gagal dilakukan",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_presensi.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>