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
                            <h2 class="content-header-title float-start mb-0">Daftar Pembelian</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Stock</a>
                                    </li>
                                    <li class="breadcrumb-item active">Daftar Pembelian Stock
                                    </li>
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
                                            <th>No Faktur</th>
                                            <th>Tanggal</th>
                                            <th>Id Brand</th>
                                            <th>Id Branch</th>
                                            <th>Nama Branch</th>
                                            <th>Id Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>Id Supplier</th>
                                            <th>Nama Supplier</th>
                                            <th>Total</th>
                                            <th>Pembayaran</th>
                                            <th>Belum terlunasi</th>
                                            <th>Id Rekening</th>
                                            <th>Tipe Pembayaran</th>
                                            <th>Jenis Pembayaran</th>
                                            <th>Jenis bayar</th>
                                            <th>Tanggal Dari</th>
                                            <th>Tanggal Sampai</th>
                                            <th>Catatan</th>
                                            <th>Status Pembayaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form action="proses/proses_update_bayar_transaksi.php" method="POST">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Pelunasan Transaksi</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">No. Faktur</label>
                                        <input type="text" name="nofak" class="form-control upd_nofak" placeholder="No Faktur" aria-label="No Faktur" readonly/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Sisa Pembayaran</label>
                                        <input type="text" name="sisa_pembayaran" class="form-control upd_sisa_pembayaran" placeholder="Sisa Pembayaran" aria-label="Sisa Pembayaran" readonly/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Jumlah Pembayaran</label>
                                        <input type="text" name="pembayaran" class="form-control dt-email" placeholder="Jumlah Pelunasan" aria-label="Jumlah Pelunasan" />
                                    </div>
                                    <input type="hidden" name="id_faktur" class="form-control upd_id" value=""/>
                                    <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
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
    <script>
        var dt_basic_table = $('.datatables-basic'),
            dt_date_table = $('.dt-date'),
            assetPath = 'jsonfile/';

        // DataTable with buttons
        // --------------------------------------------------------------------

        if (dt_basic_table.length) {
            var dt_basic = dt_basic_table.DataTable({
            ajax: assetPath + 'faktur.json',
            columns: [
                { data: 'responsive_id' },
                { data: 'no' }, // hide column 1
                { data: 'id' }, // hide column 2
                { data: 'nofak' },
                { data: 'tglfak' },
                { data: 'id_brand'}, // Hide Column 5
                { data: 'id_branch' }, // Hide Column 6
                { data: 'nama_branch' },
                { data: 'id_employee' }, // Hide Column 8
                { data: 'nama_pegawai' },
                { data: 'id_supplier' }, // Hide Column 10
                { data: 'nama_supplier' },
                { data: 'total' },
                { data: 'pembayaran' },// Hide Column 13
                { data: 'sisa_pembayaran' }, // Hide Column 14
                { data: 'id_rekening' }, // Hide Column 15
                { data: 'nama_rekening' }, // Hide Column 16
                { data: 'jenis_pembayaran' }, // Hide Column 17
                { data: 'jenis_bayar' }, // Hide Column18
                { data: 'tanggal_dari' }, // Hide Column 19
                { data: 'tanggal_sampai' }, // Hide Column 20
                { data: 'catatan' }, // Hide Column 21
                { data: 'status_transaksi' },
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
                    targets: 1,
                    visible: false
                },
                {
                    targets: 2,
                    visible: false
                },
                {
                    targets: 5,
                    visible: false
                },
                {
                    targets: 6,
                    visible: false
                },
                {
                    targets: 8,
                    visible: false
                },
                {
                    targets: 10,
                    visible: false
                },
                {
                    targets: 13,
                    visible: false
                },
                {
                    targets: 15,
                    visible: false
                },
                {
                    targets: 16,
                    visible: false
                },
                {
                    targets: 17,
                    visible: false
                },
                {
                    targets: 18,
                    visible: false
                },
                {
                    targets: 19,
                    visible: false
                },
                {
                    targets: 20,
                    visible: false
                },
                {
                    targets: 21,
                    visible: false
                },
                {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function (data, type, row, meta) {
                    return (
                    '<div class="d-inline-flex">' +
                    '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                    feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                    '</a>' +
                    '<div class="dropdown-menu dropdown-menu-end">' +
                    '<a href="preview_faktur.php?id='+ row.id +'" class="dropdown-item">' +
                    feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Preview Faktur</a>' +
                    '<a href="proses/hapus_faktur.php?id'+ row.nofak +'" class="dropdown-item">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Hapus Faktur</a>' +
                    '</div>' +
                    '</div>' +
                    '<a data-bs-target="#modals-slide-in" data-bs-toggle="modal" onclick="bayartrans({id: \''+ row.id +'\', nofak: \''+ row.nofak +'\', sisa_pembayaran: \''+ row.sisa_pembayaran +'\'});" class="item-edit bayar_trans" title="lunasi transaksi">' +
                    feather.icons['dollar-sign'].toSvg({ class: 'font-small-4' }) +
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
                    exportOptions: { columns: [1, 2, 3, 6, 8, 10, 11, 12, 13, 15, 17, 18, 19, 20] }
                    },
                    {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 2, 3, 6, 8, 10, 11, 12, 13, 15, 17, 18, 19, 20] }
                    },
                    {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 2, 3, 6, 8, 10, 11, 12, 13, 15, 17, 18, 19, 20] }
                    },
                    {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 2, 3, 6, 8, 10, 11, 12, 13, 15, 17, 18, 19, 20] }
                    },
                    {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 2, 3, 6, 8, 10, 11, 12, 13, 15, 17, 18, 19, 20] }
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
                    text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Beli Stock',
                    className: 'create-new btn btn-primary',
                    action: function (e, dt, node, config)
                    {
                        //This will send the page to the location specified
                        window.location.href = 'faktur.php';
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
                    return 'Detail Faktur : ' + data['nofak'];
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
            $('div.head-label').html('<h6 class="mb-0">Daftar Faktur</h6>');
        }

        function bayartrans(arr){
            // console.log(arr);
            $(".upd_id").val(arr.id);
            $(".upd_nofak").val(arr.nofak);
            $(".upd_sisa_pembayaran").val(arr.sisa_pembayaran);
        }

        // Flat Date picker
        if (dt_date_table.length) {
            dt_date_table.flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'm/d/Y'
            });
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