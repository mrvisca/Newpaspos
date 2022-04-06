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
                            <h2 class="content-header-title float-start mb-0">Daftar Pengguna</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                                    <li class="breadcrumb-item active">Daftar Pengguna</li>
                                    <p id="rahasia" style="display:none;"><?php echo $mrvisca; ?></p>
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
                                            <th>id</th> <!-- hide column -->
                                            <th>Nama</th>
                                            <th>Jumlah Cabang</th>
                                            <th>User</th> <!-- hide column -->
                                            <th>No Hp</th> <!-- hide column -->
                                            <th>Masa Aktif</th>
                                            <th>Pembuatan</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal update masa aktif -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="modal-content pt-0" action="proses/proses_maktif.php">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Masa Aktif</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="nama" id="upd_nama" placeholder="Nama Brand" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Masa Aktif</label>
                                        <input type="text" class="form-control dt-date" name="masa_aktif" id="upd_masaaktif" placeholder="MM/DD/YYYY"/>
                                    </div>
                                    <input type="hidden" name="id_brand" id="upd_id">
                                    <button type="button" data-id="btnlockperpanjang" onclick="perpanjangFunction()" class="btn btn-primary"><i data-feather="lock"></i></button>
                                    <button type="submit" data-id="btnperpanjang" class="btn btn-primary" style="display:none;">Update Masa Aktif</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal modal tambah kuota branch -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-kuota">
                        <div class="modal-dialog sidebar-sm">
                            <form class="modal-content pt-0" action="proses/proses_kuota.php">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kuota Branch</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="nama" id="upd_nama_kuota" placeholder="Nama Brand" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Kuota Branch</label>
                                        <input type="text" class="form-control" name="maxbranch" id="upd_maxbranch_kuota" placeholder="Jumlah Branch" disabled/>
                                    </div>
                                    <input type="hidden" name="id_brand" id="upd_id_kuota">
                                    <button type="button" data-id="btnlockmaxbranch" onclick="maxbranchFunction()" class="btn btn-primary"><i data-feather="lock"></i></button>
                                    <button type="submit" data-id="btnmaxbranch" class="btn btn-primary" style="display:none;">Tambah</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Akses Brand -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-akses">
                        <div class="modal-dialog sidebar-sm">
                            <form class="modal-content pt-0" action="proses/proses_akses.php">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Rubah Akses Pengguna</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="nama" id="upd_nama_akses" placeholder="Nama Brand" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Akses Pengguna</label>
                                        <!-- <input type="text" class="form-control" name="trial" id="upd_trial_akses" placeholder="Akses Pengguna" /> -->
                                        <select name="trial" class="form-control" id="upd_trial_akses">
                                            <option value="1">Member Paspos</option>
                                            <option value="2">Karyawan</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="id_brand" id="upd_id_akses">
                                    <button type="button" data-id="btnlockakses" onclick="aksesFunction()" class="btn btn-primary"><i data-feather="lock"></i></button>
                                    <button type="submit" data-id="btnakses" class="btn btn-primary" style="display:none;">Rubah</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Hapus Akun -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-hapus">
                        <div class="modal-dialog sidebar-sm">
                            <form class="modal-content pt-0" action="proses/proses_hapus_akun.php">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Akun Pengguna</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <label> Yakin akan menghapus Akun pengguna tersebut..?</label>
                                    <div class="mb-1">
                                        <br/>
                                        <label class="form-label" for="basic-icon-default-fullname">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="nama" id="upd_nama_hapus" placeholder="Nama Brand" />
                                    </div>
                                    <input type="hidden" name="id_brand" id="upd_id_hapus">
                                    <button type="button" data-id="btnlockhapus" onclick="hapusFunction()" class="btn btn-primary"><i data-feather="lock"></i></button>
                                    <button type="submit" data-id="btnhapus" class="btn btn-danger" style="display:none;">Hapus</button>
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
            ajax: assetPath + 'pengguna.json',
            columns: [
                { data: 'responsive_id' },
                { data: 'no' },
                { data: 'id' }, // hide column
                { data: 'nama' },
                { data: 'maxbranch' }, // used for sorting so will hide this column
                { data: 'user' }, // hide column
                { data: 'nohp' }, //hide column
                { data: 'masa_aktif' },
                { data: 'created_at' },
                { data: 'email' },
                { data: 'trial' },
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
                    targets: 5,
                    visible: false
                },
                // Hide Column
                {
                    targets: 6,
                    visible: false
                },
                {
                    targets: 10,
                    render: function (data, type, full, meta){
                        var $status_number = full['trial'];
                        var $status = {
                            0: { title: 'Super Admin', class: 'badge-light-primary' },
                            1: { title: 'Member', class: 'badge-light-success' },
                            2: { title: 'Karyawan', class: 'badge-light-info' }
                        };
                        return (
                            '<span class="badge rounded-pill ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                        );
                    }
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
                        '<a data-bs-target="#modals-slide-in-kuota" data-bs-toggle="modal" onclick="kuotadata({id: \''+ row.id +'\', nama: \''+ row.nama +'\', maxbranch: \''+ row.maxbranch +'\'});" class="dropdown-item">' +
                        feather.icons['plus-circle'].toSvg({ class: 'font-small-4 me-50' }) +
                        'Kuota Branch</a>' +
                        '<a data-bs-target="#modals-slide-in-akses" data-bs-toggle="modal" onclick="aksesdata({id: \''+ row.id +'\', nama: \''+ row.nama +'\', trial: \''+ row.trial +'\'});" class="dropdown-item">' +
                        feather.icons['user-check'].toSvg({ class: 'font-small-4 me-50' }) +
                        'Akses Akun</a>' +
                        '<a data-bs-target="#modals-slide-in-hapus" data-bs-toggle="modal" onclick="hapusdata({id: \''+ row.id +'\', nama: \''+ row.nama +'\'});" class="dropdown-item">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                        'Hapus Akun</a>' +
                        '<a href="https://api.whatsapp.com/send?phone=6285842110357&text=Hallo%20mimin%20Pas%20POS...%0A%0AAkun%20%3A%20'+ row.nama +'%0AId%20Akun%20%3A%20'+ row.id +'%0A%0ADi%20bantu%20Hapus%20Akun%20%2F%20Perpanjang%20Masa%20Aktif%20Akun.%0ATerimakasih%20Mimin%20Pas%20POS..." class="dropdown-item">' +
                        feather.icons['phone-call'].toSvg({ class: 'font-small-4 me-50' }) +
                        'Admin IT</a>' +
                        '</div>' +
                        '</div>' +
                        '<a data-bs-target="#modals-slide-in" data-bs-toggle="modal" onclick="getdata({id: \''+ row.id +'\', nama: \''+ row.nama +'\', masa_aktif: \''+ row.masa_aktif +'\'});" class="item-edit">' +
                        feather.icons['calendar'].toSvg({ class: 'font-small-4' }) +
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
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7, 8, 9, 10] }
                    },
                    {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7, 8, 9, 10] }
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
            $('div.head-label').html('<h6 class="mb-0">Daftar Pengguna</h6>');
        }

        // fungsi data passing modal
        function getdata(arr){
            // console.log(arr);
            $("#upd_id").val(arr.id);
            $("#upd_nama").val(arr.nama);
            $("#upd_masaaktif").val(arr.masa_aktif);
        }

        function kuotadata(arr){
            // console.log(arr);
            $("#upd_id_kuota").val(arr.id);
            $("#upd_nama_kuota").val(arr.nama);
            $("#upd_maxbranch_kuota").val(arr.maxbranch);
        }

        function aksesdata(arr){
            // console.log(arr);
            $("#upd_id_akses").val(arr.id);
            $("#upd_nama_akses").val(arr.nama);
            $("#upd_trial_akses").val(arr.trial);
        }

        function hapusdata(arr){
            // console.log(arr);
            $("#upd_id_hapus").val(arr.id);
            $("#upd_nama_hapus").val(arr.nama);
        }
        // end function get data passing modal

        // Flat Date picker
        if (dt_date_table.length) {
            dt_date_table.flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'm/d/Y'
            });
        }

        // Delete Record
        $('.datatables-basic tbody').on('click', '.delete-record', function () {
            dt_basic.row($(this).parents('tr')).remove().draw();
        });

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

        function maxbranchFunction() {
            var objek = prompt("Masukan Password", "Tanya Mimin");
            if (objek != security) {
                alert("Password Salah");
                $("[data-id='btnlockmaxbranch']").show();
                $("[data-id='btnmaxbranch']").hide();
            }else{
                $("[data-id='btnlockmaxbranch']").hide();
                $("[data-id='btnmaxbranch']").show();
            }
        }

        function aksesFunction() {
            var objek = prompt("Masukan Password", "Tanya Mimin");
            if (objek != security) {
                alert("Password Salah");
                $("[data-id='btnlockakses']").show();
                $("[data-id='btnakses']").hide();
            }else{
                $("[data-id='btnlockakses']").hide();
                $("[data-id='btnakses']").show();
            }
        }

        function hapusFunction() {
            var objek = prompt("Masukan Password", "Tanya Mimin");
            if (objek != security) {
                alert("Password Salah");
                $("[data-id='btnlockhapus']").show();
                $("[data-id='btnhapus']").hide();
            }else{
                $("[data-id='btnlockhapus']").hide();
                $("[data-id='btnhapus']").show();
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