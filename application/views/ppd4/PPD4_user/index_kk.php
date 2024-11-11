<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Manajemen User Kab/Kota</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                       <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
                        <li class="breadcrumb-item active">Data Modul I</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->

    <div class="row _list_user" style="display: grid;">

        <div class="row stepper-navigation-bahan-dukung-kabkota">
            <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
                <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                    <!-- <h4 class="page-title">Welcome !</h4> -->
                    <div style="display: flex;">
                        <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Manajemen User Kab/Kota <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
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

        <div class="row" style="margin-top: 90px;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                        <h2 class="card-title"></h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-info" id="modal_add_show" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 30px;">Tambah User <i class="fas fa-plus" style="margin-left: 5px;"></i></button>
                                <div class="table-responsive isitable">
                                    <table id="ppd4_dataUser_kabkota" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                                        <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                            <tr>
                                                <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; width: 15%;"><center>Id </center></th>
                                                <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; width: 20%;"><center>Nama</center></th>
                                                <!-- <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; width: 15%;"><center>Email</center></th> -->
                                                <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; width: 20%;"><center>Kabupaten</center></th>
                                                <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; width: 15%;"><center>Status</center></th>
                                                <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; width: 15%;"><center>Aksi</center></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                </div>
                                <div class="panel-footer">
                                    <!-- <a href="#" id="modal_add_show" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> User Baru</a> -->
                                    <!-- <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fa fa-refresh"></i> Muat Ulang</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row _edituser" style="display: none;">

        <div class="row stepper-navigation-bahan-dukung-tpt">
            <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
                <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                    <!-- <h4 class="page-title">Welcome !</h4> -->
                    <div style="display: flex;">
                        <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                            <a href="#" class="btnShwHd" data-show="._list_user" data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser">
                                <div class="card-body" style="padding: 2px 8px;">
                                    <p class="mb-0">Manajemen User Kab/Kota <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                                </div>
                            </a>
                        </div>
                        <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Edit <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
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

        <div class="row" style="margin-top: 90px; display: flex; justify-content: center;">
            <div class="col-8">
                <form id="form_edit">
                    <div class="card">
                        <div class="card-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                            <!-- <h3 class="card-title">Profil</h3> -->
                        </div>
                        <div class="card-body">
                            <h3 class="card-title mt-0 mb-3" style="color: black;">Edit User Kabupaten/ Kota</h3>
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
                            <!-- <div class="row">
                                <div class="col-md-12 col-sm-6 col-xs-12 col-lg-6">    
                                    <div class="form-group">
                                    <label>Status </label>
                                    <select class="form-control" id="stts" name="stts">
                                        <option value=""> - Choose - </option>
                                        <option value="Y"> Active </option>
                                        <option value="N"> Not Active </option>

                                    </select>
                                    </div>
                                </div>

                            </div> -->
                        </div>
                        <!-- card-body -->
                        <!-- <div class="card-footer">
                            <a class="btn btn-warning btnShwHd"  data-show="._list_user"  data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="DUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</a>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
                        </div> -->

                        <div class="card-footer" style="border-top: 1px solid rgb(175, 175, 175);">
                            <a class="btn btn-sm btn-secondary waves-effect btnShwHd" data-show="._list_user" data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; color: white;"><i class="fas fa-times"></i>&nbsp;&nbsp;Kembali</a>
                            <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; float: right;"><i class="fas fa-check"></i>&nbsp;&nbsp;Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="row _wrapper_info" style="display: none">
        <div class="col-md-12">
            <div class="card card-border">
                <div class="card-header border-primary bg-transparent pb-0">
                    <h3 class="card-title text-primary">Profil</h3>
                </div>
                <div class="card-body">

                    <div style="overflow-x: auto;">
                        <input type="hidden" class="" id="iduser" name="iduser" placeholder='id'>
                        <table class="table-description table-modified">

                            <tr style="">
                                <td class="text-uppercase">Id User</td>
                                <td>:</td>
                                <td class="lbl_id_user"></td>
                            </tr>
                            <tr style="">
                                <td class="text-uppercase">Nama</td>
                                <td>:</td>
                                <td class="lbl_nm_user"></td>
                            </tr>
                            <tr style="">
                                <td class="text-uppercase">Email</td>
                                <td>:</td>
                                <td class="lbl_email_user"></td>
                            </tr>
                            <!--                            <tr style="">
                                <td  class="text-uppercase">Status</td>
                                <td>:</td>
                                <td class="lbl_stat_user"></td>
                            </tr>-->
                        </table>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-12">
            <div class="card-box">
                <input type="hidden" id="inp_user" />
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-home-variant-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Daftar Provinsi Dinilai</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Daftar Kabupaten/Kota Dinilai</span>
                        </a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card list_prov" style="">
                            <!--                            <div class="card-header">
                            <h3 class="card-title">Daftar Provinsi Dinilai</h3>
                            </div>-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">

                                            <table id="t_dataProv" class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Provinsi</th>
                                                        <th>Nama Provinsi</th>
                                                        <th>Hapus</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table_wilayah">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-warning btnShwHd" data-show="._list_user" data-hide="._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                                            <button type="submit" id="modal_add_prov" class="btn btn-info waves-effect waves-light">Tambah Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card list_kabkota" style="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0" id="t_dataKK">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode </th>
                                                        <th>Nama Kab/Kota</th>
                                                        <th>Hapus</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table_kabupaten">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-warning btnShwHd" data-show="._list_user" data-hide="._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                                            <button type="submit" id="modal_add_kab" class="btn btn-info waves-effect waves-light">Tambah Data</button>
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
                <div class="modal-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="card-title mt-0 mb-3" style="color: black;">Tambah User Kabupaten/ Kota</h3>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Kabupaten/ Kota</label>
                                <select class="form-control" id="field-4" name="kab">
                                    <option value=""> - Pilih - </option>
                                    <?php
                                    foreach ($list_kab->result() as $v) {
                                    ?>
                                        <option value="<?php echo $v->id; ?>"><?php echo $v->id_kab ?> - <?php echo $v->nama_kabupaten ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<!--//popup pilih Provinsi-->
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

                                <label>Provinsi</label>
                                <select class="form-control" name="prov">
                                    <option value=""> - Pilih - </option>
                                    <?php
                                    foreach ($list_kab->result() as $v) {
                                    ?>
                                        <option value="<?php echo encrypt_text($v->id); ?>"><?php echo $v->id_kode ?> - <?php echo $v->nama_provinsi ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                    <button class="btn btn-info waves-effect waves-light pull-left" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--//popup pilih kabupaten/kota-->
<form id="form_kk">
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title" style="font-size: 12px"></h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive isitableK">
                                                <table id="dataKab" class="table table-small-font table-bordered table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Id </th>
                                                            <th>Kabupaten</th>
                                                            <th>Provinsi</th>
                                                            <th>Pilih</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>

                                            </div>
                                            <!--                            <div class="panel-footer">
                                <a href="#" id="modal_add_show" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> User Baru</a>
                            </div>-->
                                        </div>
                                    </div>
                                </div>
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
</form>