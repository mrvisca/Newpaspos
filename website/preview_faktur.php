<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';

    $id = $_GET['id'];

    function rupiah($angka){
	    $hasil_rupiah = "" . number_format($angka,0,',','.');
	    return $hasil_rupiah;
    }

    // Get gambar brand
    $query_brand = "SELECT foto FROM brand WHERE id='".$id_brand."'";
    $brand_data = $koneksi->prepare($query_brand);
    $brand_data->execute();
    $brand_data->bind_result($foto_brand);
    while($brand_data->fetch()){
    }

    // Get data faktur
    $query_faktur = "SELECT id,nofak,tglfak,id_branch,id_employee,id_supplier,total,pembayaran,sisa_pembayaran,id_rekening,jenis_pembayaran,tanggal_dari,tanggal_sampai,catatan FROM faktur WHERE id='".$id."'";
    $faktur_data = $koneksi->prepare($query_faktur);
    $faktur_data->execute();
    $faktur_data->bind_result($idfak,$nofak,$tglfak,$id_branch,$id_employee,$id_supplier,$total,$pembayaran,$sisa_pembayaran,$id_rekening,$jenis_pembayaran,$tanggal_dari,$tanggal_sampai,$catatan);
    while($faktur_data->fetch()){
        $start_date = date('d-m-Y',strtotime($tanggal_dari));
        $end_date = date('d-m-Y',strtotime($tanggal_sampai));

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
?>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-preview-wrapper">
                    <div class="row invoice-preview">
                        <!-- Invoice -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-preview-card">
                                <div class="card-body invoice-padding pb-0">
                                    <!-- Header starts -->
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                                <img src="<?php echo $foto_brand;?>" style="width:27px;height:24px;">
                                                <h3 class="text-danger invoice-logo"><?php echo $nama_branch; ?></h3>
                                            </div>
                                            <p class="card-text mb-25"><?php echo $alamat_branch; ?></p>
                                            <p class="card-text mb-25"><?php echo $kota_branch; ?>, <?php echo $provinsi_branch; ?></p>
                                            <p class="card-text mb-0">+<?php echo $nowa_branch; ?></p>
                                        </div>
                                        <div class="mt-md-0 mt-2">
                                            <h4 class="invoice-title">
                                                Faktur :
                                                <span class="invoice-number">#<?php echo $nofak; ?></span>
                                            </h4>
                                            <div class="invoice-date-wrapper">
                                                <p class="invoice-date-title">Tgl faktur:</p>
                                                <p class="invoice-date"><?php echo $start_date; ?></p>
                                            </div>
                                            <div class="invoice-date-wrapper">
                                                <p class="invoice-date-title">Tgl Batas:</p>
                                                <p class="invoice-date"><?php echo $end_date; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                <hr class="invoice-spacing" />

                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">
                                        <div class="col-xl-8 p-0">
                                            <h6 class="mb-2">Faktur Pembelian Ke:</h6>
                                            <h6 class="mb-25"><?php echo $nama_supplier; ?></h6>
                                            <p class="card-text mb-25"><?php echo $institusi; ?></p>
                                            <p class="card-text mb-25"><?php echo $alamat_supplier; ?></p>
                                            <p class="card-text mb-25">+<?php echo $notlp; ?></p>
                                            <p class="card-text mb-0"><?php echo $email; ?></p>
                                        </div>
                                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h6 class="mb-2">Detail Pembayaran:</h6>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="pe-1">Dibayarkan:</td>
                                                        <td><span class="fw-bold">Rp.<?php echo rupiah($pembayaran); ?></span></td>
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
                                                        <td class="pe-1">Kekurangan:</td>
                                                        <td>Rp.<?php echo rupiah($sisa_pembayaran); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pe-1">Tgl Transaksi:</td>
                                                        <td><?php echo $start_date; ?> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->

                                <!-- Invoice Description starts -->
                                <div class="table-responsive">
                                    <table class="table">
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
                                                    <span class="fw-bold"><?php echo $no++; ?></span>
                                                </td>
                                                <td class="py-1">
                                                    <p class="card-text fw-bold mb-25"><?php echo $nama_item_faktur; ?></p>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $jumlah_stock_faktur; ?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold">Rp.<?php echo rupiah($harga_item); ?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold">Rp.<?php echo rupiah($harga_item_total); ?></span>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                            <p class="card-text mb-0">
                                                <span class="fw-bold">Pegawai Pengajuan:</span> <span class="ms-75"><?php echo $nama_pegawai; ?></span>
                                            </p>
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
                                </div>
                                <!-- Invoice Description ends -->

                                <hr class="invoice-spacing" />

                                <!-- Invoice Note starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="fw-bold">Catatan:</span>
                                            <span><?php echo $catatan; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>
                        </div>
                        <!-- /Invoice -->

                        <!-- Invoice Actions -->
                        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
                                        Send Invoice
                                    </button> -->
                                    <!-- <a class="btn btn-primary w-100 w-100 mb-75" href="pdf_faktur.php?id=<?php //echo $idfak; ?>" >Download PDF</a> -->
                                    <a class="btn btn-info w-100 mb-75" href="pdf_faktur.php?id=<?php echo $idfak; ?>" target="_blank"> Print </a>
                                    <!-- <a class="btn btn-outline-secondary w-100 mb-75" href="./app-invoice-edit.html"> Edit </a> -->
                                    <!-- <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#add-payment-sidebar">
                                        Add Payment
                                    </button> -->
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice Actions -->
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php
        include 'footer.php';
    ?>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../assets/tema/template/app-assets/js/scripts/pages/app-invoice.js"></script>
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