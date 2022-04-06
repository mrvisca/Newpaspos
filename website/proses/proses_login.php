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

            if($_POST['pass']=="" || $_POST['user']==""){
                session_start();
                session_destroy();
                echo '  <script>
                            swal({
                                title: "Login Gagal",
                                text: "Pastikan username dan password terisi dengan benar",
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../login.php";
                            });
                        </script>';
            }

            $stmt=$koneksi->prepare("SELECT id,nama,user,pass,nohp,paket,masa_aktif,trial FROM brand WHERE user=?");
            $stmt->bind_param("s", $_POST['user']);
            $stmt->execute();
            $stmt->bind_result($id_brand,$nama,$user,$pass,$nohp,$paket,$masa_aktif,$trial);

            $ok=0;
            while($stmt->fetch()){
                $ok=1;break;
            }

            //cek tgl aktif
            if($ok==1 && strtotime(date('Y-m-d'))>strtotime($masa_aktif)){
                session_start();
                session_destroy();
                echo '  <script>
                            swal({
                                title: "Login Gagal",
                                text: "Masa aktif akun telah kadaluarsa, silahkan hubungi admin terkait",
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../login.php";
                            });
                        </script>';
            }

            //FITUR-FITUR
            //modul report
            $fea_report_summary=1;
            $fea_report=1;

            $_SESSION['fea_report_summary']=$fea_report_summary;
            $_SESSION['fea_report']=$fea_report;

            //modul branch
            $fea_branch_daftar_branch=1;
            $fea_branch_daftar=1;
            $fea_branch_produk=1;
            $fea_branch=1;

            $_SESSION['fea_branch_daftar_branch']=$fea_branch_daftar_branch;
            $_SESSION['fea_branch_daftar']=$fea_branch_daftar;
            $_SESSION['fea_branch_produk']=$fea_branch_produk;
            $_SESSION['fea_branch']=$fea_branch;


            //modul stock
            $fea_stock_opname=1;
            $fea_stock_daftar=1;
            $fea_stock_tambah=1;
            $fea_stock_update=1;
            $fea_stock_log=1;
            $fea_stock=1;

            $_SESSION['fea_stock_opname']=$fea_stock_opname;
            $_SESSION['fea_stock_daftar']=$fea_stock_daftar;
            $_SESSION['fea_stock_tambah']=$fea_stock_tambah;
            $_SESSION['fea_stock_update']=$fea_stock_update;
            $_SESSION['fea_stock_log']=$fea_stock_log;
            $_SESSION['fea_stock']=$fea_stock;

            //modul produk
            $fea_produk_lihat=1;
            $fea_produk_tambah=1;
            $fea_produk_katagori=1;
            $fea_produk=1;

            $_SESSION['fea_produk_lihat']=$fea_produk_lihat;
            $_SESSION['fea_produk_tambah']=$fea_produk_tambah;
            $_SESSION['fea_produk_katagori']=$fea_produk_katagori;
            $_SESSION['fea_produk']=$fea_produk;

            //modul kepegawaian
            $fea_pegawai_daftar=1;
            $fea_pegawai_tambah=1;
            $fea_pegawai=1;

            $_SESSION['fea_pegawai_daftar']=$fea_pegawai_daftar;
            $_SESSION['fea_pegawai_tambah']=$fea_pegawai_tambah;
            $_SESSION['fea_pegawai']=$fea_pegawai;

            //modul akuntansi
            $fea_akuntansi_laporan_penjualan=1;
            $fea_akuntansi_rek_pembayaran=1;
            $fea_akuntansi_katagori=1;
            $fea_akuntansi_transaksi=1;
            $fea_akuntansi_jurnal=1;
            $fea_akuntansi_aruskas=1;
            $fea_akuntansi_edit_trans=1;
            $fea_akuntansi=1;

            $_SESSION['fea_akuntansi_laporan_penjualan']=$fea_akuntansi_laporan_penjualan;
            $_SESSION['fea_akuntansi_rek_pembayaran']=$fea_akuntansi_rek_pembayaran;
            $_SESSION['fea_akuntansi_katagori']=$fea_akuntansi_katagori;
            $_SESSION['fea_akuntansi_transaksi']=$fea_akuntansi_transaksi;
            $_SESSION['fea_akuntansi_jurnal']=$fea_akuntansi_jurnal;
            $_SESSION['fea_akuntansi_aruskas']=$fea_akuntansi_aruskas;
            $_SESSION['fea_akuntansi_edit_trans']=$fea_akuntansi_edit_trans;
            $_SESSION['fea_akuntansi']=$fea_akuntansi;

            //modul kasir
            $fea_penjualan_kasir=1;
            $fea_penjualan_pesanan=1;
            $fea_penjualan_bill=1;
            $fea_penjualan=1;

            $_SESSION['fea_penjualan']=$fea_penjualan;
            $_SESSION['fea_penjualan_kasir']=$fea_penjualan_kasir;
            $_SESSION['fea_penjualan_pesanan']=$fea_penjualan_pesanan;
            $_SESSION['fea_penjualan_bill']=$fea_penjualan_bill;

            if($ok==1 && password_verify(md5($_POST['pass']), $pass))//owner
            {
                session_start();
                $_SESSION['pass'] = $pass;
                $_SESSION['user'] = $user;
                $_SESSION['role'] = "owner";
                $_SESSION['id_brand'] = $id_brand;
                $_SESSION['nama_brand'] = $nama;
                $_SESSION['nohp'] = $nohp;
                $_SESSION['paket'] = $paket;
                $_SESSION['masa_aktif'] = $masa_aktif;
                $_SESSION['trial'] = $trial;
                
                echo '  <script>
                            swal({
                                title: "Login Berhasil",
                                text: "Selamat datang mimin owner '.$_SESSION['nama_brand'].'",
                                type: "success",
                                timer: 3000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../index.php";
                            });
                        </script>';
            }else{ //bukan owner coba cek apakah ada di database employee
                
                $stmt=$koneksi2->prepare("SELECT id,nama,id_brand,id_branch,fea_kasir,fea_menu,fea_pegawai FROM employee WHERE user='".$_POST['user']."' AND pass='".$_POST['pass']."'") or die("Password anda salah, silahkan reset password atau klik link dibawah ini<br/><a href='../login.php'>Kembali ke halaman login</a> ");
                $stmt->execute();
                
                $stmt->bind_result($id_pegawai,$nama,$id_brand,$id_branch,$fea_kasir,$fea_menu,$fea_pegawai);
                while($stmt->fetch()){
                    $ok=1;break;
                }

                if($ok==1 ){//pegawai
                    session_start();
                    $_SESSION['id_pegawai']=$id_pegawai;
                    $_SESSION['pass'] = $pass;
                    $_SESSION['user'] = $user;
                    $_SESSION['role'] = "emp";
                    $_SESSION['id_brand'] = $id_brand;
                    $_SESSION['id_branch'] = $id_branch;
                    $_SESSION['fea_kasir'] = $fea_kasir;
                    $_SESSION['fea_menu'] = $fea_menu;
                    $_SESSION['fea_pegawai'] = $fea_pegawai;
                    $_SESSION['nama'] = $nama;
                    
                    
                    $query2="SELECT nama,nohp FROM brand WHERE id='".$id_brand."'";
                    $stmt2=$koneksi2->prepare($query2);
                    
                    $stmt2->execute();
                    
                    $stmt2->bind_result($nama_brand,$nohp);
                    while($stmt2->fetch()){
                    }   
                    $_SESSION['nama_brand'] = $nama_brand;
                    $_SESSION['nohp'] = $nohp;
                    
                    
                    //FITUR-FITUR
                    
                    //modul report
                    $fea_report_summary=0;
                    $fea_report=0;

                    
                    //modul branch
                    $fea_branch_daftar_branch=0;
                    $fea_branch_daftar=0;
                    $fea_branch_produk=0;
                    $fea_branch=0;
                    
                    //modul stock
                    $fea_stock_opname=0;
                    $fea_stock_daftar=0;
                    $fea_stock_tambah=0;
                    $fea_stock_update=0;
                    $fea_stock_log=0;
                    $fea_stock=0;
                    
                    //modul produk
                    $fea_produk_lihat=0;
                    $fea_produk_tambah=0;
                    $fea_produk=0;
                    $fea_produk_katagori=0;
                    
                    //MODUL KEPEGAWAIAN
                    $fea_pegawai_daftar=0;
                    $fea_pegawai_tambah=0;
                    $fea_pegawai=0;
                    
                    //modul akuntansi
                    $fea_akuntansi_laporan_penjualan=0;
                    $fea_akuntansi_rek_pembayaran=0;
                    $fea_akuntansi_katagori=0;
                    $fea_akuntansi_transaksi=0;
                    $fea_akuntansi_jurnal=0;
                    $fea_akuntansi_aruskas=0;
                    $fea_akuntansi_edit_trans=0;
                    $fea_akuntansi=0;
                    
                    //modul penjualan
                    $fea_penjualan_kasir=0;
                    $fea_penjualan_pesanan=0;
                    $fea_penjualan_bill=0;
                    
                    $query2="SELECT id_fitur FROM fitur_akses WHERE id_pegawai='".$id_pegawai."'";
                    $stmt2=$koneksi3->prepare($query2);
                    $stmt2->execute();$stmt2->bind_result($id_fitur);
                    while($stmt2->fetch()){
                        if($id_fitur=="1"){
                            $fea_penjualan_kasir=1;
                        }elseif($id_fitur=="2"){
                            $fea_penjualan_pesanan=1;
                        }elseif($id_fitur=="3"){
                            $fea_penjualan_bill=1;   
                        }elseif($id_fitur=="4"){
                            $fea_branch_daftar=1;
                        }elseif($id_fitur=="5"){
                            $fea_branch_produk=1;
                        }elseif($id_fitur=="6"){
                            $fea_stock_opname=1;
                        }elseif($id_fitur=="7"){
                            $fea_stock_daftar=1;
                        }elseif($id_fitur=="8"){
                            $fea_stock_tambah=1;
                        }elseif($id_fitur=="9"){
                            $fea_stock_update=1;
                        }elseif($id_fitur=="10"){
                            $fea_produk_lihat=1;
                        }elseif($id_fitur=="11"){
                            $fea_produk_tambah=1;
                        }elseif($id_fitur=="12"){
                            $fea_pegawai_daftar=1;
                        }elseif($id_fitur=="13"){
                            $fea_pegawai_tambah=1;
                        }elseif($id_fitur=="14"){
                            $fea_akuntansi_laporan_penjualan=1;
                        }elseif($id_fitur=="15"){
                            $fea_akuntansi_rek_pembayaran=1;
                        }elseif($id_fitur=="16"){
                            $fea_akuntansi_katagori=1;
                        }elseif($id_fitur=="17"){
                            $fea_akuntansi_transaksi=1;
                        }elseif($id_fitur=="18"){
                            $fea_akuntansi_jurnal=1;
                        }elseif($id_fitur=="19"){
                            $fea_produk_katagori=1;
                        }elseif($id_fitur=="20"){
                            $fea_akuntansi_aruskas=1;
                        }elseif($id_fitur=="21"){
                            $fea_report_summary=1;
                        }elseif($id_fitur="22"){
                            $fea_stock_log=1;
                        }elseif($id_fitur="23"){
                            $fea_akuntansi_edit_trans=1;
                        }  
                    }
                    
                    //modul report
                    if($fea_report_summary==1){
                        $fea_report=1;
                        echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index.php";
                                    });
                                </script>';
                    }
                    $_SESSION['fea_report_summary']=$fea_report_summary;
                    $_SESSION['fea_report']=$fea_report;
                    

                    // branch
                    if($fea_branch_daftar==1 || $fea_branch_produk==1){
                        $fea_branch=1;
                        echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index.php";
                                    });
                                </script>';   
                    }
                    $_SESSION['fea_branch_daftar']=$fea_branch_daftar;
                    $_SESSION['fea_branch_produk']=$fea_branch_produk;
                    $_SESSION['fea_branch']=$fea_branch;
                    
                    // stok
                    if($fea_stock_opname==1 || $fea_stock_daftar==1 || $fea_stock_tambah==1 || $fea_stock_update==1 || $fea_stock_log==1){
                        $fea_stock=1;
                        echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index.php";
                                    });
                                </script>';  
                    }
                    $_SESSION['fea_stock_opname']=$fea_stock_opname;
                    $_SESSION['fea_stock_daftar']=$fea_stock_daftar;
                    $_SESSION['fea_stock_tambah']=$fea_stock_tambah;
                    $_SESSION['fea_stock_update']=$fea_stock_update;
                    $_SESSION['fea_stock_log']=$fea_stock_log;
                    $_SESSION['fea_stock']=$fea_stock;
                    
                    //PRODUK
                    if($fea_produk_katagori==1 || $fea_produk_lihat==1 || $fea_produk_tambah==1){
                        $fea_produk=1;
                        echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index.php";
                                    });
                                </script>';   
                    }
                    $_SESSION['fea_produk_lihat']=$fea_produk_lihat;
                    $_SESSION['fea_produk_tambah']=$fea_produk_tambah;
                    $_SESSION['fea_produk_katagori']=$fea_produk_katagori;
                    $_SESSION['fea_produk']=$fea_produk;
                    
                    //MODUL KEPEGAWAIAN
                    if($fea_pegawai_daftar==1 || $fea_pegawai_tambah==1 ){
                        $fea_pegawai=1;
                        echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index.php";
                                    });
                                </script>'; 
                    }

                    $_SESSION['fea_pegawai_daftar']=$fea_pegawai_daftar;
                    $_SESSION['fea_pegawai_tambah']=$fea_pegawai_tambah;
                    $_SESSION['fea_pegawai']=$fea_pegawai;
                    
                    // MODUL AKUNTANSI
                    if($fea_akuntansi_edit_trans==1 || $fea_akuntansi_aruskas==1 || $fea_akuntansi_laporan_penjualan==1 || $fea_akuntansi_rek_pembayaran==1 || $fea_akuntansi_katagori==1 || $fea_akuntansi_transaksi==1 || $fea_akuntansi_jurnal==1){
                        $fea_akuntansi=1;    
                        echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index.php";
                                    });
                                </script>';
                    }

                    $_SESSION['fea_akuntansi_laporan_penjualan']=$fea_akuntansi_laporan_penjualan;
                    $_SESSION['fea_akuntansi_rek_pembayaran']=$fea_akuntansi_rek_pembayaran;
                    $_SESSION['fea_akuntansi_katagori']=$fea_akuntansi_katagori;
                    $_SESSION['fea_akuntansi_transaksi']=$fea_akuntansi_transaksi;
                    $_SESSION['fea_akuntansi_jurnal']=$fea_akuntansi_jurnal;
                    $_SESSION['fea_akuntansi_aruskas']=$fea_akuntansi_aruskas;
                    $_SESSION['fea_akuntansi_edit_trans']=$fea_akuntansi_edit_trans;
                    $_SESSION['fea_akuntansi']=$fea_akuntansi;
                
                    // PENJUALAN
                    if($fea_penjualan_kasir==0 && $fea_penjualan_pesanan==0 && $fea_penjualan_bill==0){
                        $fea_penjualan=0;
                        echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index.php";
                                    });
                                </script>';
                    }

                    $_SESSION['fea_penjualan']=$fea_penjualan;
                    $_SESSION['fea_penjualan_kasir']=$fea_penjualan_kasir;
                    $_SESSION['fea_penjualan_pesanan']=$fea_penjualan_pesanan;
                    $_SESSION['fea_penjualan_bill']=$fea_penjualan_bill;                    
                    echo '  <script>
                                    swal({
                                        title: "Login Berhasil",
                                        text: "Selamat datang, selamat bekerja",
                                        type: "success",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../index_kasir.php";
                                    });
                                </script>';
                }else{
                    echo '  <script>
                                    swal({
                                        title: "Login Gagal",
                                        text: "Username dan password salah",
                                        type: "error",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../login.php";
                                    });
                                </script>';
                    $_SESSION['role'] = "owner"; 
                }
            }
        ?>
    </body>
</html>