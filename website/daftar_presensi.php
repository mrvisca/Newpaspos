<?php
    ob_start();
    include 'header.php';
    include 'sidebar.php';
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
                            <h2 class="content-header-title float-start mb-0">Daftar Presensi Pegawai</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pegawai</a>
                                    </li>
                                    <li class="breadcrumb-item active">Daftar Presensi
                                    </li>
                                </ol>
                            </div>
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
                                            <th>Id Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>Id Shift</th>
                                            <th>Nama Shift</th>
                                            <th>Tanggal</th>
                                            <th>Jam Presensi</th>
                                            <th>Batas Presensi</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Toleransi</th>
                                            <th>Verifikasi</th>
                                            <th>Id brand</th>
                                            <th>Id Branch</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form action="proses/proses_update_presensi.php" method="POST" class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Presensi</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Pegawai</label>
                                        <select name="id_pegawai" class="form-select id_pegawai">
                                            <option value="" selected disabled> --- Pilih Nama Pegawai --- </option>
                                            <?php
                                                // Get data pegawai
                                                $query_employee = "SELECT id,nama FROM employee WHERE id_brand='".$id_brand."'";
                                                $employee_data = $koneksi->prepare($query_employee);
                                                $employee_data->execute();
                                                $employee_data->bind_result($pegawai_id,$pegawai_nama);
                                                while($employee_data->fetch()){
                                            ?>
                                            <option value="<?php echo $pegawai_id; ?>"><?php echo $pegawai_nama; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Shift Pegawai</label>
                                        <select name="id_shift" class="form-select id_shift">
                                            <option value="" selected disabled> --- Pilih Shift --- </option>
                                            <?php
                                                // Get data shift
                                                $query_shift = "SELECT id,shift,id_branch FROM shift_pegawai WHERE id_brand='".$id_brand."'";
                                                $data_shift = $koneksi->prepare($query_shift);
                                                $data_shift->execute();
                                                $data_shift->bind_result($id_shift,$nama_shift,$id_branch);
                                                while($data_shift->fetch()){
                                                    // Get data branch
                                                    $query_branch = "SELECT nama FROM branch WHERE id='".$id_branch."'";
                                                    $data_branch = $koneksi2->prepare($query_branch);
                                                    $data_branch->execute();
                                                    $data_branch->bind_result($nama_branch);
                                                    while($data_branch->fetch()){
                                            ?>
                                            <option value="<?php echo $id_shift; ?>"><?php echo $nama_shift; ?> (<?php echo $nama_branch; ?>)</option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Jam Presensi</label>
                                        <input type="text" name="jam_presensi" class="form-control jam_presensi" placeholder="Jam Presensi" aria-label="Jam Presensi" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Status Kehadiran</label>
                                        <select name="status_kehadiran" class="form-select status_kehadiran">
                                            <option value="" selected disabled> --- Pilih Status Kehadiran --- </option>
                                            <option value="Hadir">Hadir</option>
                                            <option value="Alpha">Alpha</option>
                                            <option value="Izin">Izin</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Verifikasi</label>
                                        <select name="toleransi" class="form-select toleransi">
                                            <option value="" selected disabled> --- Pilih Status Verifikasi --- </option>
                                            <option value="0">Belum Disetujui</option>
                                            <option value="1">Disetujui</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="id_presensi" class="form-control id_presensi" value=""/>
                                    <button type="submit" class="btn btn-primary me-1">Update Presensi</button>
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
    <script>
        var dt_basic_table = $('.datatables-basic'),
            dt_date_table = $('.dt-date'),
            assetPath = 'jsonfile/';

        // DataTable with buttons
        // --------------------------------------------------------------------

        if (dt_basic_table.length) {
            var dt_basic = dt_basic_table.DataTable({
            ajax: assetPath + 'presensi.json',
            columns: [
                { data: 'responsive_id' },
                { data: 'no' },
                { data: 'id' }, // hide column 2
                { data: 'id_pegawai' }, // hide column 3
                { data: 'nama_pegawai' },
                { data: 'id_shift' }, // hide column 5
                { data: 'nama_shift' },
                { data: 'tanggal' },
                { data: 'jam_presensi' },
                { data: 'batas_presensi' }, // hide column 9
                { data: 'status_kehadiran' },
                { data: 'status' },
                { data: 'toleransi' }, // hide column 12
                { data: 'verifikasi' }, 
                { data: 'id_brand' }, // hide column 14
                { data: 'id_branch' }, // hide column 15
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
                // Hide Column
                {
                    targets: 2,
                    visible: false
                },
                // Hide Column
                {
                    targets: 3,
                    visible: false
                },
                // Hide Column
                {
                    targets: 5,
                    visible: false
                },
                // Hide Column
                {
                    targets: 9,
                    visible: false
                },
                // Hide Column
                {
                    targets: 12,
                    visible: false
                },
                // Hide Column
                {
                    targets: 14,
                    visible: false
                },
                // Hide Column
                {
                    targets: 15,
                    visible: false
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
                    '<a href="proses/proses_hapus_presensi.php?id='+ row.id +'" class="dropdown-item">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Hapus Presensi</a>' +
                    '</div>' +
                    '</div>' +
                    '<a data-bs-target="#modals-slide-in" data-bs-toggle="modal" onclick="getdata({id: \''+ row.id +'\', id_pegawai: \''+ row.id_pegawai +'\', id_shift: \''+ row.id_shift +'\', jam_presensi: \''+ row.jam_presensi +'\', status_kehadiran: \''+ row.status_kehadiran +'\', toleransi: \''+ row.toleransi +'\'})" class="item-edit">' +
                    feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                    '</a>'
                    );
                }
                }
            ],
            order: [[2, 'asc']],
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
                    exportOptions: { columns: [1, 4, 6, 7, 8, 10, 11, 13] }
                    },
                    {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 6, 7, 8, 10, 11, 13] }
                    },
                    {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 6, 7, 8, 10, 11, 13] }
                    },
                    {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 6, 7, 8, 10, 11, 13] }
                    },
                    {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 6, 7, 8, 10, 11, 13] }
                    }
                ],
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function () {
                    $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                    }, 50);
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
            $('div.head-label').html('<h6 class="mb-0">Daftar Presensi Pegawai</h6>');
        }

        // fungsi data passing modal
        function getdata(arr){
            // console.log(arr);
            $(".id_presensi").val(arr.id);
            $(".id_pegawai").val(arr.id_pegawai);
            $(".id_shift").val(arr.id_shift);
            $(".jam_presensi").val(arr.jam_presensi);
            $(".status_kehadiran").val(arr.status_kehadiran);
            $(".toleransi").val(arr.toleransi);
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