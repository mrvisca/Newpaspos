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

            include '../../settings/database.php';
            require "PHPMailer/PHPMailerAutoload.php";

            date_default_timezone_set("Asia/Jakarta");

            $nama=$_POST['nama'];
            $user=$_POST['user'];
            $pass=$_POST['pass'];
            $pass1=$_POST['pass1'];
            $password_hash = password_hash(md5($pass),PASSWORD_DEFAULT);
            $nohp=$_POST['nohp'];
            $email=$_POST['email'];

            $_SESSION['su_nohp']=$nohp;
            $_SESSION['su_nama']=$nama;
            $_SESSION['su_email']=$email;
            $_SESSION['su_user']=$user;

            $ok=0;
            if($pass==$pass1){
                $ok=1;
            }

            if($ok==1){
                // Mencari Nama user yang sama
                $query_user = "SELECT id FROM brand WHERE nama='".$nama."'";
                $user_nama = $koneksi->prepare($query_user);
                $user_nama->execute();
                $user_nama->bind_result($brand_id);
                $status = 0;
                while($user_nama->fetch()){
                    $status=1;break;
                }

                // Mencari username yang sama pada database
                $query="SELECT id FROM brand WHERE user='".$user."'";
                $stmt=$koneksi->prepare($query);
                $stmt->execute();
                $stmt->bind_result($id);
                $no=0;
                while($stmt->fetch()){
                    $no=1;break;
                }
                
                if($no==0){
                    //mencari username yang sama dari pegawai
                    $query="SELECT id FROM employee WHERE user='".$user."'";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($id);
                    while($stmt->fetch()){
                        $no=1;break;
                    }
                }
                
                //jika masih tidak ada usernamenya
                if($no==0 && $status==0){
                    $date = strtotime("+7 day");
                    $query="INSERT INTO brand (nama,user,pass,email,nohp,masa_aktif) VALUES ('".$nama."','".$user."','".$password_hash."','".$email."','".$nohp."','".date('Y-m-d', $date)."') ";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();
                    $id_brand=$stmt->insert_id;
                    
                    //MEMBUAT katagori transaksi
                    $query="INSERT INTO katagori_transaksi (id_brand,nama,tipe) VALUES ('".$id_brand."','Operasional umum','1')";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();
                    $query="INSERT INTO katagori_transaksi (id_brand,nama,tipe) VALUES ('".$id_brand."','Non operasional umum','2')";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();
                    
                    //Membuat rekening utama
                    $query="INSERT INTO rek_pembayaran (nama,id_brand,id_branch,deskripsi) VALUES ('Rekening utama','".$id_brand."','-1','Dibuat secara otomatis oleh sistem. Hapus jika tidak perlu')";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();
                    
                    //Membuat branch pusat
                    $query="INSERT INTO branch (nama,id_brand) VALUES ('Cabang Pusat','".$id_brand."')";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();
                    $id_branch=$stmt->insert_id;
                    
                    //membuat rekening kas
                    $query="INSERT INTO rek_pembayaran (nama,id_brand,id_branch,deskripsi) VALUES ('Kas','".$id_brand."','".$id_branch."','Dibuat secara otomatis oleh sistem. Hapus jika tidak perlu')";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();
                    
                    //membuat website config
                    $query="INSERT INTO webconfig (id_brand,namaweb) VALUES ('".$id_brand."','".strtolower($user)."')";
                    $stmt=$koneksi->prepare($query);
                    $stmt->execute();

                    $to   = 'neworderpaspos@gmail.com';
                    $from = 'noreply@paspos.com';
                    $name = 'Akun Baru Pas POS' ;
                    $subj = 'Pas POS Pendaftaran akun baru';
                    $msg = "Dear ".$to."<br/>Akun baru telah dibuat dengan rincian sebagai berikut : <br/> Nama Brand : ".$nama."<br/>Username : ".$user."<br/>Email : ".$email."<br/>Nomer Telepon : ".$nohp."<br/>Tanggal Pembuatan ".$tanggalbuat."";

                    function smtpmailer($to, $from, $name, $subj, $msg){
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true; 
                    
                        $mail->SMTPSecure = 'ssl'; 
                        $mail->Host = 'mail.paspos.com';
                        $mail->Port = 465;  
                        $mail->Username = 'noreply@paspos.com';
                        $mail->Password = 'uedNxjZTa}4n';
                        $mail->IsHTML(true);
                        $mail->From=$from;
                        $mail->FromName=$name;
                        $mail->Sender=$from;
                        $mail->AddReplyTo($from, $name);
                        $mail->Subject = $subj;
                        $mail->Body = $msg;
                        $mail->AddAddress($to);
                        
                        if(!$mail->Send())
                        {
                            $error ="Akun tidak terkirim ke email official...";
                            echo '<script>alert("'.$error.'")</script>';
                            // echo '  <script>
                            //             Swal.fire(
                            //                 "Ini adalah judulnya",
                            //                 "Ini adalah teksnya",
                            //                 "success"
                            //             )
                            //         </script>';
                        }
                        else 
                        {
                            $error = "Akun berhasil dibuat dan di kirim admin.";  
                            echo '<script>alert("'.$error.'")</script>';
                            // echo '  <script>
                            //             Swal.fire(
                            //                 "Ini adalah judulnya",
                            //                 "Ini adalah teksnya",
                            //                 "success"
                            //             )
                            //         </script>';
                        }
                    }
                    if($ok==1){
                        smtpmailer($to, $from, $name, $subj, $msg);
                    }else{
                        echo '<script>alert("Username tidak ditemukan")</script>';
                        // echo '  <script>
                        //             Swal.fire(
                        //                 "Ini adalah judulnya",
                        //                 "Ini adalah teksnya",
                        //                 "success"
                        //             )
                        //         </script>';
                    }

                    echo '<script>window.location.href="../login.php"</script>';
                
                    session_destroy();
                    echo '  <script>
                            swal({
                                title: "Pembuatan akun sukses",
                                text: "Pembuatan akun sukses, login untuk memulai aplikasi",
                                type: "success",
                                timer: 3000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../login.php";
                            });
                        </script>';
                    
                }else{
                    $_SESSION['su_user']="";
                    echo '  <script>
                                    swal({
                                        title: "Pembuatan akun gagal",
                                        text: "Nama dan Username telah terdaftar, silahkan login atau hubungi admin terkait",
                                        type: "error",
                                        timer: 3000,
                                        showConfirmButton: false
                                    }).then(function(){
                                        window.location.href = "../register.php";
                                    });
                                </script>';
                }
            }else{
                echo '  <script>
                            swal({
                                title: "Pembuatan akun gagal",
                                text: "Password dan ulangi password tidak sama",
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = "../register.php";
                            });
                        </script>';   
            }
        ?>
    </body>
</html>