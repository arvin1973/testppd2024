<div class="container-fluid">
    <div class="row stepper-manajemen-user-tpt" style="margin-left: -40px;">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Manajemen User TPT Daerah <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                </div>
                <div class="page-title-right">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row _list_prov" style="margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive isitable">
                                <table id="listProv" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id </center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Provinsi</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Jumlah TPT</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row _list_user" style="display: none;">

    <div class="col-lg-12" style="margin-top: 90px;">
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1);">
               
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info">List TPT Daerah</h3>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <table style="width:100%;  border: 0px solid black">
                            <tbody>
                                <tr style=" border: 0px solid black">
                                    <td style="width:70px; border: 0px solid black; font-size: 14px;">Provinsi </td>
                                    <!-- <td >:</td> -->
                                    <td style=" border: 0px solid black; font-size: 14px;" name="">:</td>
                                    <td class="nm_prov"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" id="modal_add_show" class="btn btn-info waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;"><i class="fa fa-plus"></i> User Baru</a>
                            <input type="hidden" id="inp_wlyh" />
                            <!-- <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fa fa-refresh"></i> Muat Ulang</a> -->
                            <div class="table-responsive isitable">
                                <table class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;" id="t_bahan">
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id </center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Nama</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Email</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Provinsi</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Group User</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Status</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Last Access</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; min-width: 80px;">
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row _wrapper_info" style="display: none">

        <!-- start page title -->
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px; margin-left: -28px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._list_user" data-hide="._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Manajemen User TPT Daerah <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Daftar wilayah yang dinilai <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._list_user" data-hide="._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser">
                        <p style="padding: 5px; font-size: 0.8rem !important;"><strong><i class="mdi mdi-undo" style="color: #2ad408;"></i> Kembali</strong></p>
                    </a>
                </div>
                <div class="page-title-right">
                    <!-- <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Moltran</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-lg-12" style="margin-top: 90px;">
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1);">
                <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 35px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">

                    <a href="#" class="logo text-center logo-light">
                        <span class="logo" style="line-height: 90px;">
                            <img src="https://peppd.bappenas.go.id/ppd2022/assets/images/ic_logo_ppd.png" alt="" width="50">
                        </span>
                    </a>

                </div>
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info">Profil TPT Daerah</h3>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <table style="width:100%;  border: 0px solid black">
                            <tbody>
                                <tr style=" border: 0px solid black">
                                    <td style="width:70px; border: 0px solid black; font-size: 14px;">Id User </td>
                                    <td style=" border: 0px solid black; font-size: 14px;" name="">:</td>
                                    <td class="lbl_id_user"></td>
                                </tr>
                                <tr style=" border: 0px solid black">
                                    <td style="width:70px; border: 0px solid black; font-size: 14px;">Nama </td>
                                    <td style=" border: 0px solid black; font-size: 14px;" name="">:</td>
                                    <td class="lbl_nm_user"></td>
                                </tr>
                                <tr style=" border: 0px solid black">
                                    <td style="width:70px; border: 0px solid black; font-size: 14px;">Email </td>
                                    <!-- <td >:</td> -->
                                    <td style=" border: 0px solid black; font-size: 14px;" name="">:</td>
                                    <td class="lbl_email_user"></td>
                                </tr>
                                <tr style=" border: 0px solid black">
                                    <td style="width:70px; border: 0px solid black; font-size: 14px;">Provinsi </td>
                                    <!-- <td >:</td> -->
                                    <td style=" border: 0px solid black; font-size: 14px;" name="">:</td>
                                    <td class="lbl_prov_user"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <input type="hidden" id="inp_user" />
                    <ul class="nav nav-tabs nav-tabs-daerah-penilaian" role="tablist" style="border-bottom: 1px solid black;">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                                <span class="d-none d-sm-block">Daftar Kabupaten/Kota Dinilai</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card list_kabkota" style="">
                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 5px;">
                                    <h3 class="card-title">Daftar Kabupaten / Kota Yang Dinilai</h3>
                                    <button data-toggle="modal" data-target="#modal_add_kab" class="btn btn-info waves-effect waves-light tambah_list_daerah_tptd" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;"><i class="fa fa-plus"></i> Tambah Data</button>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-bordered table-striped" id="t_dataKK" style="border: 1px solid black;margin-bottom: 0px;border-collapse: inherit;">
                                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                                        <tr>
                                                            <th style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                                <center>No</center>
                                                            </th>
                                                            <th style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                                <center>Kode </center>
                                                            </th>
                                                            <th style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                                <center>Nama Kabupaten/Kota</center>
                                                            </th>
                                                            <th style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                                <center>Hapus</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table_kabupaten">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <button class="btn btn-warning btnShwHd" data-show="._list_user" data-hide="._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                                                <button type="submit" id="modal_add_kab" class="btn btn-info waves-effect waves-light">Tambah Data</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<!--//popup add user-->
<form id="form_add">
    <div id="modal_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="card-title mt-1 mb-1" style="color: black;">Tambah Data User TPT Daerah</h3>
                    <hr>
                    <input type="hidden" class="form-control" id="prov" name="prov" placeholder="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">User Id</label>
                                <input type="text" class="form-control" id="field-1" name="code" placeholder="User Id" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="field-2" placeholder="Nama" required="" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Email</label>
                                <input type="email" class="form-control" id="field-3" placeholder="Email" required="" name="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<!--//popup edit user-->
<form id="form_edit">
    <div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h3 class="card-title mt-1 mb-1" style="color: black;">Edit Data User TPT Daerah</h3>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">User Id</label>
                                <input type="hidden" class="form-control" id="iduser" name="iduser" placeholder="">
                                <input type="text" class="form-control input-sm" id="userid" name="userid" placeholder="" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Nama</label>
                                <input type="text" class="form-control input-sm" id="nama" name="nama" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Email</label>
                                <input type="text" class="form-control input-sm" id="email" name="email" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Status </label>
                                <select class="form-control" id="stts" name="stts">
                                    <option value=""> - Choose - </option>
                                    <option value="Y"> Active </option>
                                    <option value="N"> Not Active </option>
                                    <option value="D"> Delete </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="form_kab">
    <div id="modal_add_kab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="card-title mt-1 mb-1" style="color: black;">Pilih Kabupaten/Kota Yang Akan Dinilai</h3>
                    <hr>
                    <div class="col-12">
                        <div class="form-group">
                            <select class="form-control selectpicker" id="list_kabkot" data-width="100%" multiple="multiple" name="kk[]" data-actions-box="true" data-live-search="true">

                            </select>
                        </div>
                    </div>

                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                    <button class="btn btn-info waves-effect waves-light pull-left" type="submit">Simpan</button>
                </div> -->
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        // Function to initialize selectpicker when the modal is shown
        $('#modal_add_kab').on('shown.bs.modal', function() {
            $('.selectpicker').selectpicker();
        });

        // Form submission
        $('#form_kab').submit(function(e) {
            e.preventDefault();
            $('.selectpicker').selectpicker('refresh');
        });
    });
</script>