<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';

    $query_pw = "SELECT sandi FROM sumin WHERE id_brand='1'";
    $pw = $koneksi->prepare($query_pw);
    $pw->execute();
    $pw->bind_result($mrvisca);
    while($pw->fetch()){
    }

    // Kuota Branch
    $query_maxbranch = "SELECT maxbranch FROM brand WHERE id='".$id_brand."'";
    $kuota_maxbranch = $koneksi->prepare($query_maxbranch);
    $kuota_maxbranch->execute();
    $kuota_maxbranch->bind_result($maxbranch);
    while($kuota_maxbranch->fetch()){
    }

    // Cek Row Branch
    $query_branch_row = mysqli_query($koneksi,"SELECT * FROM branch WHERE id_brand='".$id_brand."'");
    $branch_row = mysqli_num_rows($query_branch_row);
?>

<!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Daftar Cabang</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Cabang</a>
                                    </li>
                                    <li class="breadcrumb-item active">Daftar Cabang
                                    </li>
                                    <p id="rahasia" style="display:none;"><?php echo $mrvisca; ?></p>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th>Id</th>
                                            <th>Id brand</th>
                                            <th>Nama</th>
                                            <th>No Wa</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Provinsi</th>
                                            <th>Pembuatan</th>
                                            <th>Masa Aktif</th>
                                            <th>Presenstase Summary (%)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Tambah branch -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form action="proses/proses_tambah_cabang.php" method="post" class="modal-content">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Cabang</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Cabang</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Cabang" aria-label="Nama Cabang" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">No Wa</label>
                                        <input type="number" name="nowa" class="form-control" placeholder="62821xxxxxxxx" aria-label="62821xxxxxxxx" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Alamat</label>
                                        <textarea name="alamat" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Kota</label>
                                        <input type="text" class="form-control" name="kota" placeholder="Kota Cabang" aria-label="Kota Cabang" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Provinsi</label>
                                        <input type="text" name="provinsi" class="form-control" placeholder="Provinsi Cabang" aria-label="Provinsi Cabang" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Presentase</label>
                                        <input type="text" name="presentase" class="form-control" placeholder="Presentase Summary (%)" aria-label="Presentase Summary (%)" />
                                    </div>
                                    <input type="hidden" name="id_brand" value="<?php echo $id_brand; ?>"/>
                                    <button type="submit" class="btn btn-primary me-1">Tambahkan</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Edit Branch -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-edit">
                        <div class="modal-dialog sidebar-sm">
                            <form action="proses/proses_edit_cabang.php" method="post" class="modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Cabang</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Cabang</label>
                                        <input type="text" class="form-control" name="nama" id="upd_nama" placeholder="Nama Cabang" aria-label="Nama Cabang" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">No Wa</label>
                                        <input type="number" nama="nowa" id="upd_nowa" class="form-control" placeholder="62821xxxxxxxx" aria-label="62821xxxxxxxx" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Alamat</label>
                                        <textarea name="alamat" id="upd_alamat" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Kota</label>
                                        <input type="text" class="form-control" name="kota" id="upd_kota" placeholder="Kota Cabang" aria-label="Kota Cabang" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Provinsi</label>
                                        <input type="text" class="form-control" name="provinsi" id="upd_provinsi" placeholder="Provinsi Cabang" aria-label="Kota Cabang" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Presentase</label>
                                        <input type="text" name="presentase" id="upd_presentase" class="form-control" placeholder="Presentase Summary (%)" aria-label="Presentase Summary (%)" />
                                    </div>
                                    <input type="hidden" name="id_brand" id="upd_id_brand"/>
                                    <input type="hidden" name="id_branch" id="upd_id"/>
                                    <button type="submit" class="btn btn-primary me-1">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Update Masa Aktif -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-maktif">
                        <div class="modal-dialog sidebar-sm">
                            <form action="proses/proses_update_maktif.php" method="post" class="modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Masa Aktif Cabang</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Cabang</label>
                                        <input type="text" class="form-control" name="nama" id="upd_nama_maktif" placeholder="Nama Cabang" aria-label="Nama Cabang" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Masa Aktif</label>
                                        <input type="text" class="form-control dt-date" name="aktif_akun" id="upd_aktif_akun_maktif" placeholder="MM/DD/YYYY"/>
                                    </div>
                                    <input type="hidden" name="id_branch" id="upd_id_maktif"/>
                                    <button type="button" data-id="btnlockperpanjang" onclick="perpanjangFunction()" class="btn btn-primary"><i data-feather="lock"></i></button>
                                    <button type="submit" data-id="btnperpanjang" class="btn btn-primary" style="display:none;">Update Masa Aktif</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

<?php
    include 'footer.php';
?>

    <!-- BEGIN: Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../assets/tema/template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/tema/template/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/tema/template/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="../assets/tema/template/app-assets/js/scripts/tables/table-datatables-basic.js"></script> -->
    <script>
        var dt_basic_table = $('.datatables-basic'),
            dt_date_table = $('.dt-date'),
            assetPath = 'jsonfile/';

        // DataTable with buttons
        // --------------------------------------------------------------------

        if (dt_basic_table.length) {
            var dt_basic = dt_basic_table.DataTable({
            ajax: assetPath + 'cabang.json',
            columns: [
                { data: 'responsive_id' },
                { data: 'no' },
                { data: 'id' }, // hide column
                { data: 'id_brand' }, // hide column
                { data: 'nama' },
                { data: 'nowa' },
                { data: 'alamat' },
                { data: 'kota' },
                { data: 'provinsi' }, // hide column
                { data: 'pembuatan' },
                { data: 'aktif_akun' },
                { data: 'presentase' },
                { data: '' }
            ],
            columnDefs: [
                {
                // For Responsive
                className: 'control',
                orderable: false,
                responsivePriority: 2,
                targets: 0
                },
                {
                    targets: 2,
                    visible: false
                },
                {
                    targets: 3,
                    visible: false
                },
                {
                    targets: 8,
                    visible: false
                },
                {
                responsivePriority: 1,
                targets: 4
                },
                {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function (data, type, row) {
                    return (
                    '<div class="d-inline-flex">' +
                    '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                    feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                    '</a>' +
                    '<div class="dropdown-menu dropdown-menu-end">' +
                    '<a href="proses/proses_hapus_cabang.php?id='+ row.id +'" class="dropdown-item">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Hapus Cabang</a>' +
                    '<a data-bs-target="#modals-slide-in-maktif" data-bs-toggle="modal" onclick="maktifdata({id: \''+ row.id +'\', nama: \''+ row.nama +'\', aktif_akun: \''+ row.aktif_akun +'\'});" class="dropdown-item">' +
                    feather.icons['calendar'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Perpanjang Masa Aktif</a>' +
                    '<a href="https://api.whatsapp.com/send?phone=628977853270&text=Hallo%20Mimin%20TS%20Paspos...%0A%0AId%20Cabang%20%3A%20'+ row.id +'%0A%0AMau%20Perpanjang%20Aktivasi%20cabang...mohon%20dibantu%20untuk%20prosedur%20perpanjangannya%20ya%20mimin...%20terimakasih..." class="dropdown-item">' +
                    feather.icons['phone-call'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Mimin IT</a>' +
                    '</div>' +
                    '</div>' +
                    '<a data-bs-target="#modals-slide-in-edit" data-bs-toggle="modal" onclick="editdata({id: \''+ row.id +'\', id_brand: \''+ row.id_brand +'\', nama: \''+ row.nama +'\', nowa: \''+ row.nowa +'\', alamat: \''+ row.alamat +'\', kota: \''+ row.kota +'\', provinsi: \''+ row.provinsi +'\', presentase: \''+ row.presentase +'\'});" class="item-edit">' +
                    feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                    '</a>'
                    );
                }
                }
            ],
            order: [[1, 'asc']],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                {
                extend: 'collection',
                className: 'btn btn-outline-secondary dropdown-toggle me-2',
                text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                buttons: [
                    {
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 6, 7, 8, 9, 10] }
                    }
                ],
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function () {
                    $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                    }, 50);
                }
                },
                {
                text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Tambah Cabang',
                className: 'create-new btn btn-primary',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#modals-slide-in'
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
                }
            ],
            responsive: {
                details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                    var data = row.data();
                    return 'Details of ' + data['full_name'];
                    }
                }),
                type: 'column',
                renderer: function (api, rowIdx, columns) {
                    var data = $.map(columns, function (col, i) {
                    return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                        ? '<tr data-dt-row="' +
                            col.rowIdx +
                            '" data-dt-column="' +
                            col.columnIndex +
                            '">' +
                            '<td>' +
                            col.title +
                            ':' +
                            '</td> ' +
                            '<td>' +
                            col.data +
                            '</td>' +
                            '</tr>'
                        : '';
                    }).join('');

                    return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                }
                }
            },
            language: {
                paginate: {
                // remove previous & next text from pagination
                previous: '&nbsp;',
                next: '&nbsp;'
                }
            }
            });
            var kuota = <?php echo $maxbranch;?>;
            $('div.head-label').html('<h6 class="mb-0">Daftar Cabang (Kuota : '+ kuota +')</h6>');
        }

        // Flat Date picker
        if (dt_date_table.length) {
            dt_date_table.flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'm/d/Y'
            });
        }

        // fungsi data passing modal
        function editdata(arr){
            // console.log(arr);
            $("#upd_id").val(arr.id);
            $("#upd_id_brand").val(arr.id_brand);
            $("#upd_nama").val(arr.nama);
            $("#upd_nowa").val(arr.nowa);
            $("#upd_alamat").val(arr.alamat);
            $("#upd_kota").val(arr.kota);
            $("#upd_provinsi").val(arr.provinsi);
            $("#upd_presentase").val(arr.presentase);
        }

        // fungsi data passing modal
        function maktifdata(arr){
            // console.log(arr);
            $("#upd_id_maktif").val(arr.id);
            $("#upd_nama_maktif").val(arr.nama);
            $("#upd_aktif_akun_maktif").val(arr.aktif_akun);
        }

        var security = $("#rahasia").text();
        function perpanjangFunction() {
            var objek = prompt("Masukan Password", "Tanya Mimin");
            if (objek != security) {
                alert("Password Salah");
                $("[data-id='btnlockperpanjang']").show();
                $("[data-id='btnperpanjang']").hide();
            }else{
                $("[data-id='btnlockperpanjang']").hide();
                $("[data-id='btnperpanjang']").show();
            }
        }
    </script>
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