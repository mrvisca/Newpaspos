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
            date_default_timezone_set("Asia/Jakarta");
            include '../../settings/database.php';

            $id = $_POST['id_faktur'];
            $nofak = $_POST['nofak'];
            $sisa_pembayaran = $_POST['sisa_pembayaran'];
            $pembayaran = $_POST['pembayaran'];

            $sisa_bayar = $sisa_pembayaran - $pembayaran;

            // get pembayaran data
            $query_pembayaran_faktur = "SELECT pembayaran FROM faktur WHERE id_faktur='".$id_faktur."'";
            $pembayaran_faktur = $koneksi->prepare($query_pembayaran_faktur);
            $pembayaran_faktur->execute();
            $pembayaran_faktur->bind_result($pembayaran_faktur);
            while($pembayaran_faktur->fetch()){
            }

            $dibayarkan = $pembayaran_faktur + $pembayaran;

            $update_pembayaran_faktur = "UPDATE faktur SET pembayaran='".$dibayarkan."',sisa_pembayaran='".$sisa_bayar."' WHERE id_faktur='".$id."'";
            $update_pembayaran = $koneksi->prepare($update_pembayaran_faktur);
            if($update_pembayaran->execute()){
                echo '  <script>
                            swal({
                                title: "Update Pembayaran Faktur Berhasil",
                                text: "Update Pembayaran Faktur berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../convert_cabang.php";
                            });
                        </script>';
            }else{
                echo '  <script>
                            swal({
                                title: "Update Pembayaran Faktur Gagal",
                                text: "Update Pembayaran Faktur gagal, ada kesalahan dalam penginputan",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_cabang.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>