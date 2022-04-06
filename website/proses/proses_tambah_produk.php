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

            // Compress image
            function compressImage($source, $destination, $quality) {
                $info = getimagesize($source);
                
                if ($info['mime'] == 'image/jpeg') 
                    $image = imagecreatefromjpeg($source);
                elseif ($info['mime'] == 'image/gif') 
                    $image = imagecreatefromgif($source);
                elseif ($info['mime'] == 'image/png') 
                    $image = imagecreatefrompng($source);
                
                imagejpeg($image, $destination, $quality);
            }

            $id_brand = $_POST['id_brand'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $harga_beli = $_POST['harga_beli'];
            $deskripsi = $_POST['deskripsi'];
            $kode = $_POST['kode'];
            $id_katagori = $_POST['id_katagori'];
            $penilaian = $_POST['penilaian'];
            $bulk_stock = $_POST['bulk_stock'];
            $id_branch = $_POST['id_brannch'];

            $harga = str_replace("Rp. ", "", str_replace(".", "", str_replace(",", ".", $harga)));
            $harga_beli = str_replace("Rp. ", "", str_replace(".", "", str_replace(",", ".", $harga_beli)));

            // Insert data ke table item
            $query_insert_item = "INSERT INTO item (nama,kode,harga,harga_beli,deskripsi,id_brand,id_katagori,gambar,penilaian) VALUES ('".$nama."','".$kode."','".$harga."','".$harga_beli."','".$deskripsi."','".$id_brand."','".$id_katagori."','".$gambar."','".$id_katagori."','".$gambar."','".$penilaian."')";
            $item_insert = $koneksi->prepare($query_insert_item);
            $item_insert->execute();
            $id_item = $item_insert->insert_id;

            if($bulk_stock == 1){
                $query_insert_stock = "INSERT INTO daftar_stock (id_brand,nama,unit,harga_ingredient,harga_unit,id_supplier,ket) VALUES ('".$id_brand."','".$nama."','PRODUK','','','','Penambahan Bulk Stock Produk')";
                $data_stock = $koneksi->prepare($query_insert_stock);
                $data_stock->execute();
                $id_daftar_stock = $data_stock->insert_id;

                $query_insert_ingredient = "INSERT INTO ingredient (id_item,id_daftar_stock,jumlah) VALUES ('".$id_item."','".$id_daftar_stock."','1')";
                $ingredient_data = $koneksi->prepare($query_insert_ingredient);
                $ingredient_data->execute();
            }

            if($id_branch!=""){
                $query_item_branch = "INSERT INTO item_branch (id_item,id_branch,id_brand) VALUES ('".$id_item."','".$id_branch."','".$id_brand."')";
                $data_ibranch = $koneksi->prepare($query_item_branch);
                $data_ibranch->execute();

                $query_item_branch = "INSERT INTO item_branch (id_item,id_branch,id_brand) VALUES ('".$id_item."','0','".$id_brand."')";
                $data_ibranch = $koneksi->prepare($query_item_branch);
                $data_ibranch->execute();
            }else{
                $query_item_branch = "INSERT INTO item_branch (id_item,id_branch,id_brand) VALUES ('".$id_item."','0','".$id_brand."')";
                $data_ibranch = $koneksi->prepare($query_item_branch);
                $data_ibranch->execute();
            }

            if($_FILES['berkas']['name']!=""){
            
                // file extension
                $file_extension = pathinfo($_FILES['berkas']['name'], PATHINFO_EXTENSION); //edit
                $file_extension = strtolower($file_extension); //edit
                $valid_ext = array('png','jpeg','jpg');  //edit
                if(in_array($file_extension,$valid_ext)){ //edit
                    //edit
                }else{ //edit
                    $ok=0; //edit
                }
                
                //DAPATKAN id terakhirnya
                if($ok==1){
                    
                    //SAVE DATA
                    // ambil data file
                    $namaFile = $_FILES['berkas']['name'];
                    $namaSementara = $_FILES['berkas']['tmp_name'];
                    
                    // tentukan lokasi file akan dipindahkan
                    $dirUpload = "product_pp/";

                    $location=$dirUpload."img_".$last_id.".jpg";

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
            }

            echo    '<script>
                        swal({
                            title: "Tambah Data Produk Berhasil",
                            text: "Tambah Data Produk berhasil dilakukan",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function(){
                            window.location.href = "../daftar_produk.php";
                        });
                    </script>';
        ?>
    </body>
</html>