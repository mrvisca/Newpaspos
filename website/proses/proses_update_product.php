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
            require '../vendor/autoload.php';
            use Aws\S3\S3Client;
            use Aws\S3\Exception\S3Exception;

            function compressImage($source, $destination, $quality) {
                $info = getimagesize($source);
    
                if ($info['mime'] == 'image/jpeg') 
                    $image = imagecreatefromjpeg($source);
                elseif ($info['mime'] == 'image/gif') 
                    $image = imagecreatefromgif($source);
                elseif ($info['mime'] == 'image/png') 
                    $image = imagecreatefrompng($source);
                
                imagejpeg($image, $destination, 5);   
            }

            $id_product = $_POST['id_item'];
            $id_brand = $_POST['id_brand'];
            $nama = $_POST['nama'];
            $kode = $_POST['kode'];
            $harga = $_POST['harga'];
            $harga_beli = $_POST['harga_beli'];
            $deskripsi = $_POST['deskripsi'];
            $id_katagori = $_POST['id_katagori'];
            $penilaian = $_POST['penilaian'];

            $harga = str_replace("Rp. ", "", str_replace(".", "", str_replace(",", ".", $harga)));
            $harga_beli = str_replace("Rp. ", "", str_replace(".", "", str_replace(",", ".", $harga_beli)));

            if($_FILES['berkas']['name']!=""){
                $namaFile = $_FILES['berkas']['name'];
                $namaSementara = $_FILES['berkas']['tmp_name'];
                // tentukan lokasi file akan dipindahkan
                $dirUpload = "product_pp/";

                $location=$dirUpload."img_".$id.".jpg";

                $client = S3Client::factory([
                    'version' => 'latest',
                    'region'  => 'us-east-1',
                    'endpoint' => 'https://is3.cloudhost.id',
                    'credentials' => [
                        'key'    => "FLJKAY2ZCZY1Y1BFBRB0",
                        'secret' => "QG7SwQxo2cSA3amBatjbvpeSnjbcp87SFVUeUgWV"
                    ]
                ]);

                try {
                    $client->putObject([
                    'Bucket'     =>'cdn-pp.pasglobalteknologi.com',
                    'Key'        => $location,
                    'ContentType' => 'jpg/png',
                    'SourceFile' => $namaSementara,    // like /var/www/vhosts/mysite/file.csv
                    'ACL'        => 'public-read',
                    ]);
                } catch (S3Exception $e) {
                    // Catch an S3 specific exception.
                    echo $e->getMessage();
                }
            }

            $query_update_item="UPDATE item SET nama='".$nama."',kode='".$kode."',harga='".$harga."',harga_beli='".$harga_beli."',deskripsi='".$deskripsi."',id_katagori='".$id_katagori."',gambar='".$location."' WHERE id='".$id."'";
            $update_item = $koneksi->prepare($query_update_item);
            if($update_item->execute()){
                echo '  <script>
                            swal({
                                title: "Update Data Produk Berhasil",
                                text: "Update Data Produk berhasil dilakukan",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../daftar_produk.php";
                            });
                        </script>';
            }else{
                echo '  <script>
                            swal({
                                title: "Update Data Produk Gagal",
                                text: "Update Data Produk gagal, ada kesalahan dalam penginputan",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../edit_product.php";
                            });
                        </script>';
            }
        ?>
    </body>
</html>