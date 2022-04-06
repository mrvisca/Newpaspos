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
            require "PHPMailer/PHPMailerAutoload.php";

            date_default_timezone_set("Asia/Jakarta");

            $kode = uniqid(true);
            $pass = password_hash(md5($kode),PASSWORD_DEFAULT);    

            $user=$_POST['user'];$ok=0;
            $query="SELECT nama,email FROM brand WHERE user='".$user."'";
            $stmt=$koneksi->prepare($query);
            $stmt->execute();
            $stmt->bind_result($nama,$email);
            while($stmt->fetch()){
                $ok=1;
            }

            $stmt=$koneksi->prepare("UPDATE brand SET pass='$pass' WHERE user = '$user'");
            $stmt->execute();

            if($ok==0){
                $query="SELECT nama,email FROM employee WHERE user='".$user."'";
                $stmt=$koneksi->prepare($query);
                $stmt->execute();
                $stmt->bind_result($nama,$email);
                while($stmt->fetch()){
                    $ok=1;
                }

                $stmt=$koneksi->prepare("UPDATE employee SET pass='$kode' WHERE user = '$user'");
                $stmt->execute();
            }

            $to   = $email;
            $from = 'info@paspos.com';
            $name = 'Pas POS' ;
            $subj = 'Pas POS Forgot Password';
            $msg = "Dear ".$nama.", dengan username ".$user.", Seseorang mencoba masuk ke akun anda. Harap diingat dan ganti password anda dengan rutin. Password anda adalah: ".$kode;

            function smtpmailer($to, $from, $name, $subj, $msg){
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true; 
            
                $mail->SMTPSecure = 'none'; 
                $mail->Host = 'postal.paspos.com';
                $mail->Port = 25;  
                $mail->Username = 'ppsmtp';
                $mail->Password = 'XjvxO6dBWM4yqHLIgzFmDtac';
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
                    $error ="Request reset password gagal, terjadi kesalahan saat proses reset...";
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
                    $error = "Password Sudah dikirim via email, Jangan Lupa di cek ya.";  
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
            }
            
            echo '<script>window.location.href="../login.php"</script>';
        ?>
    </body>
</html>