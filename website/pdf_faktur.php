<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Pas POS - Faktur PDF</title>
    <link rel="icon" href="../assets/img/logo.svg" type="image/gif" sizes="16x16" />
    <link rel="shortcut icon" href="../assets/img/logo.svg" type="image/gif" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/app-assets/css/pages/app-invoice-print.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/tema/template/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<?php
    include '../settings/database.php';
    require_once 'vendor/autoload.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $id = $_GET['id'];

    function rupiah($angka){
	    $hasil_rupiah = "" . number_format($angka,0,',','.');
	    return $hasil_rupiah;
    }

    // Get data faktur
    $query_faktur = "SELECT id,nofak,tglfak,id_brand,id_branch,id_employee,id_supplier,total,pembayaran,sisa_pembayaran,id_rekening,jenis_pembayaran,tanggal_dari,tanggal_sampai,catatan FROM faktur WHERE id='".$id."'";
    $faktur_data = $koneksi->prepare($query_faktur);
    $faktur_data->execute();
    $faktur_data->bind_result($idfak,$nofak,$tglfak,$id_brand,$id_branch,$id_employee,$id_supplier,$total,$pembayaran,$sisa_pembayaran,$id_rekening,$jenis_pembayaran,$tanggal_dari,$tanggal_sampai,$catatan);
    while($faktur_data->fetch()){
        $start_date = date('d-m-Y',strtotime($tanggal_dari));
        $end_date = date('d-m-Y',strtotime($tanggal_sampai));

        // Get gambar brand
        $query_brand = "SELECT foto FROM brand WHERE id='".$id_brand."'";
        $brand_data = $koneksi2->prepare($query_brand);
        $brand_data->execute();
        $brand_data->bind_result($foto_brand);
        while($brand_data->fetch()){
        }

        // Get data branch
        $query_branch = "SELECT nama,nowa,alamat,kota,provinsi FROM branch WHERE id='".$id_branch."'";
        $data_branch = $koneksi2->prepare($query_branch);
        $data_branch->execute();
        $data_branch->bind_result($nama_branch,$nowa_branch,$alamat_branch,$kota_branch,$provinsi_branch);
        while($data_branch->fetch()){
        }

        // Get data supplier
        $query_supplier = "SELECT institusi,nama,alamat,notlp,email FROM supplier WHERE id='".$id_supplier."'";
        $supplier_data = $koneksi2->prepare($query_supplier);
        $supplier_data->execute();
        $supplier_data->bind_result($institusi,$nama_supplier,$alamat_supplier,$notlp,$email);
        while($supplier_data->fetch()){
        }

        // Get data rekening
        $query_rek_pembayaran = "SELECT nama FROM rek_pembayaran WHERE id='".$id_rekening."'";
        $data_rek_pembayaran = $koneksi2->prepare($query_rek_pembayaran);
        $data_rek_pembayaran->execute();
        $data_rek_pembayaran->bind_result($nama_rekening);
        while($data_rek_pembayaran->fetch()){
        }

        // Jenis Pembayaran
        if($jenis_pembayaran=="0"){
            $jenis_bayar = "Tunai";
        }elseif($jenis_pembayaran=="1"){
            $jenis_bayar = "Kredit";
        }elseif($jenis_pembayaran=="2"){
            $jenis_bayar = "Down Payment (DP)";
        }else{
            $jenis_bayar = "Cash On Delivery (COD)";
        }

        // Get nama pegawai
        $query_nama_pegawai = "SELECT nama FROM employee WHERE id='".$id_employee."'";
        $data_nama_pegawai = $koneksi2->prepare($query_nama_pegawai);
        $data_nama_pegawai->execute();
        $data_nama_pegawai->bind_result($nama_pegawai);
        while($data_nama_pegawai->fetch()){
        }

        // Get jumlah total item
        $query_total_item = "SELECT sum(harga_item_total) FROM faktur_item WHERE id_faktur='".$nofak."'";
        $data_total_item = $koneksi2->prepare($query_total_item);
        $data_total_item->execute();
        $data_total_item->bind_result($jum_titem);
        while($data_total_item->fetch()){
            $ongkir = $total-$jum_titem;
        }
    }

    $html = file_get_contents("pdf_faktur.php");
    $dompdf->loadHtml($html);
    // (Opsional) Mengatur ukuran kertas dan orientasi kertas
    $dompdf->setPaper('A4', 'landscape');
    // Menjadikan HTML sebagai PDF
    $dompdf->render();
    // Output akan menghasilkan PDF (1 = download dan 0 = preview)
    $dompdf->stream("codexworld",array("Attachment"=>1));
?>

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="invoice-print p-3">
                    <div class="d-flex justify-content-between flex-md-row flex-column pb-2">
                        <div>
                            <div class="d-flex mb-1">
                                <img src="<?php echo $foto_brand;?>" style="width:27px;height:24px;">
                                <h3 class="text-danger fw-bold ms-1"><?php echo $nama_branch; ?></h3>
                            </div>
                            <p class="mb-25"><?php echo $alamat_branch; ?></p>
                            <p class="mb-25"><?php echo $kota_branch; ?>, <?php echo $provinsi_branch; ?></p>
                            <p class="mb-0">+<?php echo $nowa_branch; ?></p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="fw-bold text-end mb-1">Faktur : #<?php echo $nofak; ?></h4>
                            <div class="invoice-date-wrapper mb-50">
                                <span class="invoice-date-title">Tgl faktur:</span>
                                <span class="fw-bold"> <?php echo $start_date; ?></span>
                            </div>
                            <div class="invoice-date-wrapper">
                                <span class="invoice-date-title">Tgl Batas:</span>
                                <span class="fw-bold"><?php echo $end_date; ?></span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row pb-2">
                        <div class="col-sm-6">
                            <h6 class="mb-1">Faktur Pembelian Ke:</h6>
                            <p class="mb-25"><?php echo $nama_supplier; ?></p>
                            <p class="mb-25"><?php echo $institusi; ?></p>
                            <p class="mb-25"><?php echo $institusi; ?></p>
                            <p class="mb-25">+<?php echo $notlp; ?></p>
                            <p class="mb-0"><?php echo $email; ?></p>
                        </div>
                        <div class="col-sm-6 mt-sm-0 mt-2">
                            <h6 class="mb-1">Detail Pembayaran:</h6>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pe-1">Dibayarkan:</td>
                                        <td><strong>Rp.<?php echo rupiah($pembayaran); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="pe-1">Nama Bank:</td>
                                        <td><?php echo $nama_rekening; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pe-1">Tipe Transaksi:</td>
                                        <td><?php echo $jenis_bayar; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pe-1">Tipe Transaksi:</td>
                                        <td>Rp.<?php echo rupiah($sisa_pembayaran); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pe-1">SWIFT code:</td>
                                        <td><?php echo $start_date; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th class="py-1">No</th>
                                    <th class="py-1">Nama Item</th>
                                    <th class="py-1">Jumlah</th>
                                    <th class="py-1">Harga Satuan</th>
                                    <th class="py-1">Total Item</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;

                                    // Get item faktur
                                    $query_faktur_item = "SELECT id_daftar_stock,nama,jumlah_stock,harga_item,harga_item_total FROM faktur_item WHERE id_faktur='".$nofak."'";
                                    $data_faktur_item = $koneksi->prepare($query_faktur_item);
                                    $data_faktur_item->execute();
                                    $data_faktur_item->bind_result($id_daftar_stock,$nama_item_faktur,$jumlah_stock_faktur,$harga_item,$harga_item_total);
                                    while($data_faktur_item->fetch()){
                                        $no++;
                                ?>
                                <tr>
                                    <td class="py-1">
                                        <p class="fw-semibold mb-25"><?php echo $no++; ?></p>
                                    </td>
                                    <td class="py-1">
                                        <strong><?php echo $nama_item_faktur; ?></strong>
                                    </td>
                                    <td class="py-1">
                                        <strong><?php echo $jumlah_stock_faktur; ?></strong>
                                    </td>
                                    <td class="py-1">
                                        <strong>Rp.<?php echo rupiah($harga_item); ?></strong>
                                    </td>
                                    <td class="py-1">
                                        <strong>Rp.<?php echo rupiah($harga_item_total); ?></strong>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row invoice-sales-total-wrapper mt-3">
                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                            <p class="card-text mb-0"><span class="fw-bold">Pegawai Pengajuan:</span> <span class="ms-75"><?php echo $nama_pegawai; ?></span></p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Subtotal:</p>
                                    <p class="invoice-total-amount">Rp.<?php echo rupiah($jum_titem); ?></p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Ongkir:</p>
                                    <p class="invoice-total-amount">Rp.<?php echo rupiah($ongkir); ?></p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total:</p>
                                    <p class="invoice-total-amount">Rp.<?php echo rupiah($total); ?></p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Kekurangan:</p>
                                    <p class="invoice-total-amount">Rp.<?php echo rupiah($sisa_pembayaran); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row">
                        <div class="col-12">
                            <span class="fw-bold">Catatan:</span>
                            <span><?php echo $catatan; ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../assets/tema/template/app-assets/js/scripts/pages/app-invoice-print.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>