<div class="container-fluid">

    <!-- start page title -->
    <div class="row" style="margin-left: -40px;">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Manajemen User Tim Kabupaten Dan Kota <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
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
    </div>
    <!-- end page title -->

    <div class="row _list_user" style="display: flex; margin-top: 90px;">

        <div class="col-12">
            <div class="card-box" style="background-color: white; border: 1px solid rgba(49, 126, 235, 1); border-radius: 0.2rem;">
                <div class="row">
                    <div class="col-2" style="text-align: -webkit-center;">
                        <div class="avatar-md bg-info rounded-circle mr-2" style="height: 7rem; width: 7rem;">
                            <i class="ion-md-contacts avatar-title font-56 text-white" style="font-size: 56px;"></i>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <div class="text-right">
                                    <h4 class="my-0 font-weight-bold"><span data-plugin="counterup" id="active_user">15852</span>/<span data-plugin="counterup" id="total_user">15852</span></h4>
                                    <p class="mb-0 mt-1 text-truncate">Pengguna Aktif</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 class="text-uppercase">Percentage Active User <span class="float-right" id="progress-active-user">60%</span></h6>
                            <div class="progress progress-sm m-0">
                                <div class="progress-bar bg-info" role="progressbar" id="progress-bar-active-user" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                    <span class="sr-only" id="span-progress-bar-active-user">60% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card-box-->
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" id="rekap_active_user" class="btn btn-secondary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Rekap Active User</a>
                            <a href="#" id="rekap_user" class="btn btn-secondary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Rekap User</a>
                            <a href="#" id="modal_add_show" class="btn btn-info waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;"><i class="fa fa-plus"></i> User Baru</a>
                            <div class="table-responsive isitable">
                                <table id="dataUser" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
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
                                                <center>Kab/Kota</center>
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
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 11px"></tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="_edituser" style="display: none;">

        <!-- start page title -->
        <div class="row" style="margin-left: -40px;">
            <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
                <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                    <!-- <h4 class="page-title">Welcome !</h4> -->
                    <div style="display: flex;">
                        <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                            <a href="#" class="btnShwHd" data-show="._list_user" data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser">
                                <div class="card-body" style="padding: 2px 8px;">
                                    <p class="mb-0">Manajemen User Tim Kabupaten Dan Kota <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                                </div>
                            </a>
                        </div>
                        <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Profil User <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                            </div>
                        </div>
                        <a href="#" class="btnShwHd" data-show="._list_user" data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser">
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
        </div>
        <!-- end page title -->

        <div class="row" style="margin-top: 90px; justify-content: center;">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                        <h2 class="card-title" style="font-size: 12px"></h2>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title mt-1 mb-1" style="color: black;">Profil</h3>
                        <hr>
                        <form id="form_edit">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Id User</label>
                                        <input type="hidden" class="form-control" id="iduser" name="iduser" placeholder="">
                                        <input type="text" class="form-control input-sm" id="userid" name="userid" placeholder="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control input-sm" id="nama" name="nama" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email</label>
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

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="modal-footer">
                            <a class="btn btn-warning btnShwHd" data-show="._list_user" data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</a>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
                        </div> -->
                            <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: right;">
                                <!-- <button type="button" class="btn btn-sm btn-secondary waves-effect btnShwHd" data-show="._list_user" data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button> -->
                                <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- card-body -->
                </div>
            </div>
        </div>

    </div>

</div>

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
                    <h3 class="card-title mt-1 mb-1" style="color: black;">Tambah Data User Tim Kabupaten/Kota</h3>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">User Id</label>
                                <input type="text" class="form-control" id="field-1" name="code" placeholder="User Id" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="field-2" placeholder="Nama" required="" name="name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Email</label>
                                <input type="email" class="form-control" id="field-3" placeholder="Email" required="" name="email">
                            </div>
                        </div>

                    </div>
                    <!--                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label>p</label>
                                <select class="form-control" id="select2" name="prodid">

                                </select>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" id="lprov" name="lprov">
                                    <option value=""> - Pilih - </option>
                                    <?php
                                    foreach ($list_prov->result() as $v) {
                                        $encrypted_id = base64_encode(openssl_encrypt($v->id_kode, "AES-128-ECB", ENCRYPT_PASS));
                                    ?>
                                        <option value="<?php echo $encrypted_id; ?>"><?php echo $v->nama_provinsi ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" id="t_dataKab">
                                <label>Kab/Kota</label>
                                <select class="form-control" id="lkab" name="lkab">
                                    <option value=""> - Silakan pilih provinsi - </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Kab/Kota</label>
                                                <select class="form-control" name="prov">
                                                    <option value=""> - Pilih - </option>
                                                    <?php
                                                    foreach ($list_kab->result() as $v) {
                                                    ?>
                                                    <option value="<?php echo $v->id; ?>"><?php echo $v->id_kab ?>-<?php echo $v->nama_kabupaten ?></option>
                                                            <?php
                                                        }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>   
                    </div>-->

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Tags 2</label>
                                <select id="tagSelect" class="js-example-basic-multiple" multiple="multiple" style="width: 200px;">
                                    <!-- Options will be dynamically added here -->
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
    </div><!-- /.modal -->
</form>

<form id="form_wil">
    <div id="modal_wil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Provinsi yang Akan Dinilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <div class="form-group">
                                <input type="" class="form-control" name="iduserr" placeholder=''>
                                <label>Kab/Kota</label>
                                <select class="form-control" name="prov">
                                    <option value=""> - Pilih - </option>
                                    <?php
                                    foreach ($list_kab->result() as $v) {
                                    ?>
                                        <option value="<?php echo encrypt_text($v->id); ?>"><?php echo $v->id_kab ?>-<?php echo $v->nama_kabupaten ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button class="btn btn-info waves-effect waves-light pull-left" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>








<!--//list kabupaten-->
<div id="list_kab" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive isitable">
                            <table id="dataKab" class="table table-small-font table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="font-size: 13px">No </th>
                                        <th style="font-size: 13px">Kabupaten</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info waves-effect waves-light" id="save_popup">Simpan</button>
            </div>
        </div>
    </div>
</div>