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
                            <h2 class="content-header-title float-start mb-0">Daftar Pegawai</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pegawai</a>
                                    </li>
                                    <li class="breadcrumb-item active">Daftar Pegawai
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
                                            <th>Id Brand</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Id Branch</th>
                                            <th>Nama Cabang</th>
                                            <th>Nama Pegawai</th>
                                            <th>Email</th>
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
                            <form action="proses/proses_tambah_pegawai.php" method="POST" class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Username</label>
                                        <input type="text" name="user" class="form-control" placeholder="Username" aria-label="Username" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Password</label>
                                        <input type="text" name="pass" class="form-control" placeholder="Password" aria-label="Password" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nama Cabang</label>
                                        <select name="id_branch" class="form-select">
                                            <option value="" selected disabled> --- Pilih Nama Cabang --- </option>
                                            <?php
                                                // Get Data Cabang
                                                $query_cabang = "SELECT id,nama FROM branch WHERE id_brand='".$id_brand."'";
                                                $cabang_data = $koneksi->prepare($query_cabang);
                                                $cabang_data->execute();
                                                $cabang_data->bind_result($id_branch,$nama_cabang);
                                                while($cabang_data->fetch()){
                                            ?>
                                            <option value="<?php echo $id_branch; ?>"><?php echo $nama_cabang; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <!-- <small class="form-text"> You can use letters, numbers & periods </small> -->
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Nama Pegawai</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Pegawai" aria-label="Nama Pegawai" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Alamat Email" aria-label="Alamat Email" />
                                    </div>
                                    <input type="hidden" name="id_brand" value="<?php echo $id_brand; ?>" />
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-edit">
                        <div class="modal-dialog sidebar-sm">
                            <form action="proses/proses_update_pegawai.php" method="POST" class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Username</label>
                                        <input type="text" name="user" class="form-control user" placeholder="Username" aria-label="Username" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Password</label>
                                        <input type="text" name="pass" class="form-control pass" placeholder="Password" aria-label="Password" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nama Cabang</label>
                                        <select name="id_branch" class="form-select id_branch">
                                            <option value="" selected disabled> --- Pilih Nama Cabang --- </option>
                                            <?php
                                                // Get Data Cabang
                                                $query_cabang = "SELECT id,nama FROM branch WHERE id_brand='".$id_brand."'";
                                                $cabang_data = $koneksi->prepare($query_cabang);
                                                $cabang_data->execute();
                                                $cabang_data->bind_result($id_branch,$nama_cabang);
                                                while($cabang_data->fetch()){
                                            ?>
                                            <option value="<?php echo $id_branch; ?>"><?php echo $nama_cabang; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <!-- <small class="form-text"> You can use letters, numbers & periods </small> -->
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Nama Pegawai</label>
                                        <input type="text" name="nama" class="form-control nama" placeholder="Nama Pegawai" aria-label="Nama Pegawai" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Email</label>
                                        <input type="email" name="email" class="form-control email" placeholder="Alamat Email" aria-label="Alamat Email" />
                                    </div>
                                    <input type="hidden" name="id_brand" value="<?php echo $id_brand; ?>" />
                                    <input type="hidden" name="id_pegawai" class="form-control id_pegawai" />
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
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
            ajax: assetPath + 'pegawai.json',
            columns: [
                { data: 'responsive_id' },
                { data: 'no' },
                { data: 'id' }, // hide column 2
                { data: 'id_brand' }, // hide column 3
                { data: 'user' },
                { data: 'pass' },
                { data: 'id_branch' }, // hide column 6
                { data: 'nama_branch' },
                { data: 'nama' },
                { data: 'email' },
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
                    targets: 6,
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
                    '<a href="javascript:;" class="dropdown-item">' +
                    feather.icons['user-check'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Rubah Akses</a>' +
                    '<a href="proses/proses_hapus_pegawai.php?id='+ row.id +'" class="dropdown-item">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Hapus Pegawai</a>' +
                    '</div>' +
                    '</div>' +
                    '<a data-bs-target="#modals-slide-in-edit" data-bs-toggle="modal" onclick="getdata({id: \''+ row.id +'\', user: \''+ row.user +'\', pass: \''+ row.pass +'\', id_branch: \''+ row.id_branch +'\', nama: \''+ row.nama +'\', email: \''+ row.email +'\'})" class="item-edit">' +
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
                    exportOptions: { columns: [1, 4, 5, 7, 8, 9] }
                    },
                    {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 7, 8, 9] }
                    },
                    {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 7, 8, 9] }
                    },
                    {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 7, 8, 9] }
                    },
                    {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 4, 5, 7, 8, 9] }
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
                text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Tambah Pegawai',
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
            $('div.head-label').html('<h6 class="mb-0">Daftar Pegawai</h6>');
        }


        // fungsi data passing modal
        function getdata(arr){
            // console.log(arr);
            $(".id_pegawai").val(arr.id);
            $(".user").val(arr.user);
            $(".pass").val(arr.pass);
            $(".pass").val(arr.pass);
            $(".id_branch").val(arr.id_branch);
            $(".nama").val(arr.nama);
            $(".email").val(arr.email);
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