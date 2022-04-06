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
                            <h2 class="content-header-title float-start mb-0">Daftar Stock</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Stock</a>
                                    </li>
                                    <li class="breadcrumb-item active">Daftar Stock
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
                                            <th>Id Brand</th>
                                            <th>Nama</th>
                                            <th>Unit</th>
                                            <th>Harga Bahan (Rp)</th>
                                            <th>Harga Unit (Rp)</th>
                                            <th>Supplier</th>
                                            <th>Keterangan</th>
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
                            <form action="proses/proses_simpan_dstock.php" method="post" class="modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Stock</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Stock</label>
                                        <input type="text" class="form-control" name="nama" id="basic-icon-default-fullname" placeholder="Nama Stock" aria-label="Nama Stock" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Unit</label>
                                        <select name="unit" class="form-control">
                                            <option value="" select disabled> --- Pilih satuan unit --- </option>
                                            <option value="PCS">PCS</option>
                                            <option value="LUSIN">LUSIN</option>
                                            <option value="TON">TON</option>
                                            <option value="KUINTAL">Kuintal</option>
                                            <option value="KG">KG</option>
                                            <option value="ONS">ONS</option>
                                            <option value="BUAH">BUAH</option>
                                            <option value="EKOR"></option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Harga Bahan</label>
                                        <input type="text" class="form-control" name="harga_ingredient" id="harga_bahan" placeholder="Harga Bahan" aria-label="Harga Bahan" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Harga Unit</label>
                                        <input type="text" class="form-control" name="harga_unit" id="harga_unit" placeholder="Harga Unit" aria-label="Harga Unit" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-salary">Supplier</label>
                                        <select name="supplier" class="form-control">
                                            <option value="" selected disabled> --- Pilih Supplier --- </option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Keterangan</label>
                                        <textarea name="ket" class="form-control"></textarea>
                                    </div>
                                    <input type="hidden" name="id_brand" value="<?php echo $id_brand; ?>"/>
                                    <button type="button" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal edit daftar stock -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-edit">
                        <div class="modal-dialog sidebar-sm">
                            <form action="proses/proses_edit_dstock.php" method="post" class="modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Stock</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Stock</label>
                                        <input type="text" class="form-control" name="nama" id="upd_nama" placeholder="Nama Stock" aria-label="Nama Stock" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Unit</label>
                                        <select name="unit" class="form-control" id="upd_unit">
                                            <option value="" select disabled> --- Pilih satuan unit --- </option>
                                            <option value="PCS">PCS</option>
                                            <option value="LUSIN">LUSIN</option>
                                            <option value="TON">TON</option>
                                            <option value="KUINTAL">Kuintal</option>
                                            <option value="KG">KG</option>
                                            <option value="ONS">ONS</option>
                                            <option value="BUAH">BUAH</option>
                                            <option value="EKOR"></option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Harga Bahan</label>
                                        <input type="text" class="form-control" name="harga_ingredient" id="upd_harga_bahan" placeholder="Harga Bahan" aria-label="Harga Bahan" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Harga Unit</label>
                                        <input type="text" class="form-control" name="harga_unit" id="upd_harga_unit" placeholder="Harga Unit" aria-label="Harga Unit" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-salary">Supplier</label>
                                        <select name="supplier" class="form-control" id="upd_id_supplier">
                                            <option value="" selected disabled> --- Pilih Supplier --- </option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Keterangan</label>
                                        <textarea name="ket" class="form-control" id="upd_ket"></textarea>
                                    </div>
                                    <input type="hidden" name="id" id="upd_id"/>
                                    <input type="hidden" name="id_brand" id="upd_id_brand"/>
                                    <button type="button" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
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
            ajax: assetPath + 'stock.json',
            columns: [
                { data: 'responsive_id' },
                { data: 'no' },
                { data: 'id' }, // hide column
                { data: 'id_brand' }, // hide column
                { data: 'nama' },
                { data: 'unit' },
                { data: 'harga_ingredient' },
                { data: 'harga_unit' },
                { data: 'id_supplier' },
                { data: 'ket' },
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
                    '<a href="proses/proses_hapus_dstock.php?id='+ row.id +'" class="dropdown-item">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Hapus Daftar Stock</a>' +
                    '<a href="javascript:;" class="dropdown-item">' +
                    feather.icons['search'].toSvg({ class: 'font-small-4 me-50' }) +
                    'Cek Harga</a>' +
                    '</div>' +
                    '</div>' +
                    '<a data-bs-target="#modals-slide-in-edit" data-bs-toggle="modal" onclick="editdata({id: \''+ row.id +'\', id_brand: \''+ row.id_brand +'\', nama: \''+ row.nama +'\', unit: \''+ row.unit +'\', harga_ingredient: \''+ row.harga_ingredient +'\', harga_unit: \''+ row.harga_unit +'\', id_supplier: \''+ row.id_supplier +'\', ket: \''+ row.ket +'\'});" class="item-edit">' +
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
                    exportOptions: { columns: [3, 4, 5, 6, 7] }
                    },
                    {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [3, 4, 5, 6, 7] }
                    },
                    {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [3, 4, 5, 6, 7] }
                    },
                    {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [3, 4, 5, 6, 7] }
                    },
                    {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: [3, 4, 5, 6, 7] }
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
                text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Tambah Stock',
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
            $('div.head-label').html('<h6 class="mb-0">Daftar Stock</h6>');
        }

        // fungsi data passing modal
        function editdata(arr){
            // console.log(arr);
            $("#upd_id").val(arr.id);
            $("#upd_id_brand").val(arr.id_brand);
            $("#upd_nama").val(arr.nama);
            $("#upd_unit").val(arr.unit);
            $("#upd_harga_bahan").val(arr.harga_ingredient);
            $("#upd_harga_unit").val(arr.harga_unit);
            $("#upd_id_supplier").val(arr.id_supplier);
            $("#upd_ket").val(arr.ket);
        }

        var harga_bahan = document.getElementById("harga_bahan");
        harga_bahan.addEventListener("keyup", function(e) {
            harga_bahan.value = convertRupiah(this.value);
        });
        harga_bahan.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });
        
        var harga_unit = document.getElementById("harga_unit");
        harga_unit.addEventListener("keyup", function(e) {
            harga_unit.value = convertRupiah(this.value);
        });
        harga_unit.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });

        var upd_harga_bahan = document.getElementById("upd_harga_bahan");
        upd_harga_bahan.addEventListener("keyup", function(e) {
            upd_harga_bahan.value = convertRupiah(this.value);
        });
        upd_harga_bahan.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });
        
        var upd_harga_unit = document.getElementById("upd_harga_unit");
        upd_harga_unit.addEventListener("keyup", function(e) {
            upd_harga_unit.value = convertRupiah(this.value);
        });
        upd_harga_unit.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });
        
        function convertRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split  = number_string.split(","),
            sisa   = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
            if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
            }
        
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
        }
        
        function isNumberKey(evt) {
            key = evt.which || evt.keyCode;
            if ( 	key != 188 // Comma
            && key != 8 // Backspace
            && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            && (key < 48 || key > 57) // Non digit
            ) 
            {
            evt.preventDefault();
            return;
            }
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