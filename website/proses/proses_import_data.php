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
            session_start();
            date_default_timezone_set("Asia/Jakarta");
            include '../../settings/database.php';

            $id_employee = "emp";
            $ket = 'Penambahan stock barang impor';
            if($id_employee!=$_SESSION['role']){
                $id_employee=0;
            }else{
                $id_employee=$_SESSION['id_pegawai'];
            }

            $tanggal = date('Y-m-d H:i');

            require '../../vendor/autoload.php';
    
            use PhpOffice\PhpSpreadsheet\Spreadsheet;
            use PhpOffice\PhpSpreadsheet\Reader\Csv;
            use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

            $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {

                $nama_file = $_FILES['berkas_excel']['name'];
                echo $nama_file;
                $arr_file = explode('.', $_FILES['berkas_excel']['name']);
                $extension = end($arr_file);

                if('csv' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }

                $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
                
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                for($i = 1;$i < count($sheetData);$i++)
                {
                    $nama           = $sheetData[$i]['0'];
                    $kode           = $sheetData[$i]['1'];
                    $harga          = $sheetData[$i]['2'];
                    $harga_beli     = $sheetData[$i]['3'];
                    $deskripsi      = $sheetData[$i]['4'];
                    $id_brand       = $sheetData[$i]['5'];
                    $id_katagori    = $sheetData[$i]['6'];
                    $branch         = $sheetData[$i]['7'];
                    $foto           = $sheetData[$i]['8'];
                    $stock_jumlah   = $sheetData[$i]['9'];
                    $bulk           = $sheetData[$i]['10'];

                    if($id_brand!=""){
                        $query = "INSERT INTO item (nama,kode,harga,harga_beli,deskripsi,id_brand,id_katagori,gambar) VALUES ('".$nama."','".$kode."','".$harga."','".$harga_beli."','".$deskripsi."','".$id_brand."','".$id_katagori."','".$foto."')";
                        mysqli_query($koneksi,$query);
                        $last_id = mysqli_insert_id($koneksi);

                        $query_item_branch = "INSERT INTO item_branch (id_item,id_branch) VALUES ('".$last_id."','".$branch."')";
                        mysqli_query($koneksi,$query_item_branch);

                        if($bulk=="1"){
                            $query2 = "INSERT daftar_stock (nama,unit,ket,id_brand) VALUES ('".$nama."','Pcs','Bulk stock','".$id_brand."')";
                            mysqli_query($koneksi,$query2);
                            $id_daftar_stock = mysqli_insert_id($koneksi);

                            $query3 = "INSERT INTO ingredient (id_item,id_daftar_stock,jumlah) VALUES ('".$last_id."','".$id_daftar_stock."','1')";
                            mysqli_query($koneksi,$query3);

                            $query4 = "INSERT INTO update_stock (id_daftar_stock,id_branch,jumlah,ket,id_employee) VALUES ('".$id_daftar_stock."','".$branch."','".$stock_jumlah."','".$ket."','".$id_employee."')";
                            mysqli_query($koneksi,$query4);

                            $query5 = "INSERT INTO stock_branch (id_brand,id_branch,id_daftar_stock,stock_jumlah,unit,tanggal) VALUES ('".$id_brand."','".$id_branch."','".$id_daftar_stock."','1','Pcs','".$tanggal."')";
                            mysqli_query($koneksi,$query5);
                        }

                        echo    '<script>
                                    swal({
                                        title: "Impor Data Produk Berhasil",
                                        text: "Impor data produk berhasil dilakukan",
                                        type: "success",
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../daftar_produk.php";
                                    });
                                </script>';
                    }else{
                        echo    '<script>
                                    swal({
                                        title: "Impor Data Produk Gagal",
                                        text: "Impor data produk gagal dilakukan, cek kembali format import anda",
                                        type: "error",
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../import product.php";
                                    });
                                </script>';
                    }
                }
            }
        ?>
    </body>
</html>