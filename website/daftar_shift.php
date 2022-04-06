<?php
ob_start();
include 'header.php';
include 'sidebar.php'; 
$queryBranch = mysqli_query($koneksi, "SELECT * FROM branch");
$queryBranchEdit = mysqli_query($koneksi, "SELECT * FROM branch");
$queryBrand = mysqli_query($koneksi, "SELECT * FROM brand");
$queryBrandEdit = mysqli_query($koneksi, "SELECT * FROM brand");
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
                            <h2 class="content-header-title float-start mb-0">Daftar Shift</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pengaturan</a>
                                    </li>
                                    <li class="breadcrumb-item active">Daftar Shift
                                    </li>
                                    <p id="rahasia" style="display:none;"><?php echo $mrvisca; ?></p>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <button class="btn-icon btn btn-primary btn-round btn-sm" type="button" onclick="$('#modal_add_shift').modal('show')">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table" id="table_shift">
                                    <thead>
                                        <tr>
                                            <th>Shift</th>
                                            <th>Start Shift</th>
                                            <th>End Shift</th>
                                            <th>Awal Presensi</th>
                                            <th>Akhir Presensi</th>
                                            <th>Cabang</th>
                                            <th>Brand</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Tambah Shift -->
                    <div class="modal modal-slide-in fade" id="modal_add_shift">
                        <div class="modal-dialog sidebar-sm">
                            <form class="modal-content pt-0" id="form-add">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Shift</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label>Nama Shift <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_shift" id="nama_shift" class="form-control mt-1" placeholder="Nama Shift" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-6">
                                            <label>Start Shift <span class="text-danger">*</span></label>
                                            <input type="text" name="start_shift" id="start_shift" class="form-control mt-1" placeholder="Start Shift" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>End Shift <span class="text-danger">*</span></label>
                                            <input type="text" name="end_shift" id="end_shift" class="form-control mt-1" placeholder="End Shift" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-6">
                                            <label>Awal Presensi <span class="text-danger">*</span></label>
                                            <input type="text" name="start_presensi" id="start_presensi" class="form-control mt-1" placeholder="Awal Presensi" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label>Akhir Presensi <span class="text-danger">*</span></label>
                                            <input type="text" name="end_presensi" id="end_presensi" class="form-control mt-1" placeholder="Akhir Presensi" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-12">
                                            <label>Brand <span class="text-danger">*</span></label>
                                            <select name="brand" class="form-control mt-1" id="brand" required>
                                                <option value="">-- Pilih Brand --</option>
                                                <?php 
                                                while($row = mysqli_fetch_assoc($queryBrand)) {
                                                    echo"<option value='".$row['id']."'>".$row['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-12">
                                            <label>Cabang <span class="text-danger">*</span></label>
                                            <select name="branch" class="form-control mt-1" id="branch" required>
                                                <option value="">-- Pilih Cabang --</option>
                                                <?php 
                                                while($row = mysqli_fetch_assoc($queryBranch)) {
                                                    echo"<option value='".$row['id']."'>".$row['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Edit Shift -->
                    <div class="modal modal-slide-in fade" id="modal_update_shift">
                        <div class="modal-dialog sidebar-sm">
                            <form class="modal-content pt-0" id="form-edit">
                                <input type="hidden" name="id_parameter" id="id_parameter">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Shift</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label>Nama Shift <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_shift" id="nama_shift_edit" class="form-control mt-1" placeholder="Nama Shift" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-6">
                                            <label>Start Shift <span class="text-danger">*</span></label>
                                            <input type="text" name="start_shift" id="start_shift_edit" class="form-control mt-1" placeholder="Start Shift" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>End Shift <span class="text-danger">*</span></label>
                                            <input type="text" name="end_shift" id="end_shift_edit" class="form-control mt-1" placeholder="End Shift" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-6">
                                            <label>Awal Presensi <span class="text-danger">*</span></label>
                                            <input type="text" name="start_presensi" id="start_presensi_edit" class="form-control mt-1" placeholder="Awal Presensi" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label>Akhir Presensi <span class="text-danger">*</span></label>
                                            <input type="text" name="end_presensi" id="end_presensi_edit" class="form-control mt-1" placeholder="Akhir Presensi" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-12">
                                            <label>Brand <span class="text-danger">*</span></label>
                                            <select name="brand" class="form-control mt-1" id="brand_edit" required>
                                                <option value="">-- Pilih Brand --</option>
                                                <?php 
                                                while($row = mysqli_fetch_assoc($queryBrandEdit)) {
                                                    echo"<option value='".$row['id']."'>".$row['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-12">
                                            <label>Cabang <span class="text-danger">*</span></label>
                                            <select name="branch" class="form-control mt-1" id="branch_edit" required>
                                                <option value="">-- Pilih Cabang --</option>
                                                <?php 
                                                while($row = mysqli_fetch_assoc($queryBranchEdit)) {
                                                    echo"<option value='".$row['id']."'>".$row['nama']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
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

    <script>
    	$("#table_shift").DataTable({
            ajax: {
                url: 'proses/proses_get_list_shift.php',
                type: 'get',
                dataType: 'json'
            },
            columns: [
                {data: "shift"},
                {data: "start_shift"},
                {data: "end_shift"},
                {data: "awal_presensi"},
                {data: "akhir_presensi"},
                {data: "user"},
                {data: "cabang"},
                {render: function(data, type, row) {
                    return `
                        <button type='button' class='btn btn-warning btn-sm' onclick="get_data('${row.id}')">Edit</button> 
                        <button type='button' class='btn btn-danger btn-sm' onclick="hapus_data('${row.id}')">Hapus</button>
                    `
                }}
            ]
        });
        function get_data(id) {
            $("#modal_update_shift").modal('show')
            $.ajax({
                url: 'proses/proses_get_edit_shift.php',
                dataType: 'json',
                type: 'get',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log("DT", data.shift)
                    $("#id_parameter").val(data.id);
                    $("#nama_shift_edit").val(data.shift);
                    $("#start_shift_edit").val(data.start_shift);
                    $("#end_shift_edit").val(data.end_shift);
                    $("#start_presensi_edit").val(data.awal_presensi);
                    $("#end_presensi_edit").val(data.akhir_presensi);
                    $("#brand_edit").val(data.id_brand).trigger('select');
                    $("#branch_edit").val(data.id_branch).trigger('select');
                }
            })
        }
        function hapus_data(id) {
            let confirmation = confirm("Hapus Data ?")
            if(confirmation) {
                $.ajax({
                  url : 'proses/proses_delete_shift.php',
                  type : "get",
                  data : { id: id },
                  success : function(data) {
                     if(data == "OK") {
                        Swal.fire("Success", "Data Berhasil Dihapus", "success");
                        $("#table_shift").DataTable().ajax.reload();
                     }
                  }
                });
            }
        }

        $("#form-add").on('submit', function(e) {
            e.preventDefault();
            let confirmation = confirm("Tambah Data ?")
            if(confirmation) {
                $.ajax({
                  url : 'proses/proses_add_shift.php',
                  type : "post",
                  data : new FormData($("#form-add")[0]),
                  contentType : false,
                  processData : false,
                  success : function(data) {
                     if(data == "OK") {
                        Swal.fire("Success", "Data Berhasil Disimpan", "success");
                        $("#table_shift").DataTable().ajax.reload();
                        $("#form-add").trigger('reset');
                     }
                  }
                });
            }
        });

        $("#form-edit").on('submit', function(e) {
            e.preventDefault();
            let confirmation = confirm("Edit Data ?")
            if(confirmation) {
                $.ajax({
                  url : 'proses/proses_update_shift.php',
                  type : "post",
                  data : new FormData($("#form-edit")[0]),
                  contentType : false,
                  processData : false,
                  success : function(data) {
                     if(data == "OK") {
                        Swal.fire("Success", "Data Berhasil Diedit", "success");
                        $("#table_shift").DataTable().ajax.reload();
                        $("#form-edit").trigger('reset');
                     }
                  }
                });
            }
        });

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
