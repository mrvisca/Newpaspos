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
                                <h2 class="content-header-title float-start mb-0">Daftar Stock Log</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Stock</a>
                                        </li>
                                        <li class="breadcrumb-item active">Daftar Stock Log
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
                                                <th>Tanggal</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                                <th>Id Stock</th>
                                                <th>Nama Stock</th>
                                                <th>Id Branch</th>
                                                <th>Cabang</th>
                                                <th>Id Pegawai</th>
                                                <th>Pegawai</th>
                                                <th>Id Item</th>
                                                <th>Nama Item</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal to add new record -->
                        <div class="modal modal-slide-in fade" id="modals-slide-in">
                            <div class="modal-dialog sidebar-sm">
                                <form class="add-new-record modal-content pt-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                    <div class="modal-header mb-1">
                                        <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                    </div>
                                    <div class="modal-body flex-grow-1">
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                            <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-post">Post</label>
                                            <input type="text" id="basic-icon-default-post" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" />
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Email</label>
                                            <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                            <small class="form-text"> You can use letters, numbers & periods </small>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                            <input type="text" class="form-control dt-date" id="basic-icon-default-date" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                            <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
                                        </div>
                                        <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
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
        <footer class="footer footer-static footer-light">
            <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
        </footer>
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
                ajax: assetPath + 'stocklog.json',
                columns: [
                    { data: 'responsive_id' },
                    { data: 'no' },
                    { data: 'id' }, // hide column
                    { data: 'tanggal' },
                    { data: 'jumlah' },
                    { data: 'ket' },
                    { data: 'id_daftar_stock' }, // hide column
                    { data: 'nama_barang' },
                    { data: 'id_branch' }, // hide column
                    { data: 'nama_cabang' },
                    { data: 'id_employee' }, // hide column
                    { data: 'nama_pegawai' },
                    { data: 'id_item' }, // hide column
                    { data: 'nama_item' },
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
                        targets: 12,
                        visible: false
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
                        exportOptions: { columns: [1, 3, 4, 5, 7, 9, 11, 13] }
                        },
                        {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                        className: 'dropdown-item',
                        exportOptions: { columns: [1, 3, 4, 5, 7, 9, 11, 13] }
                        },
                        {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                        className: 'dropdown-item',
                        exportOptions: { columns: [1, 3, 4, 5, 7, 9, 11, 13] }
                        },
                        {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                        className: 'dropdown-item',
                        exportOptions: { columns: [1, 3, 4, 5, 7, 9, 11, 13] }
                        },
                        {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                        className: 'dropdown-item',
                        exportOptions: { columns: [1, 3, 4, 5, 7, 9, 11, 13] }
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
                $('div.head-label').html('<h6 class="mb-0">DataTable with Buttons</h6>');
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