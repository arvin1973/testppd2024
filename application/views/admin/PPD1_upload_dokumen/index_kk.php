<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Dokumen Pendukung</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Upload Dokumen</a></li>
                        <li class="breadcrumb-item active">Kabupaten</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->

    <!-- start page title -->
    <div class="row stepper-dokumen-kabupaten-admin" style="margin-left: -40px;">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Kabupaten <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
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

    <div class="row _wrapper_wlyh" style="margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <button id="unduhspesifik" class="btn btn-primary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;" data-toggle="modal" data-target="#modalkab">Unduh Spesifik Dokumen<i class="fas fa-download" style="padding-left: 5px;"></i></button>
                            <button id="unduhinovasi" class="btn btn-primary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Unduh Inovasi</button>
                            <div class="table-responsive isitable">
                                <table id="dataUser" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Kabupaten</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Provinsi</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Status Unggah</center>
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
        <!-- <div class="col-md-12">
            <div class="card card-border">
                <div class="card-header border-primary bg-transparent pb-0">
                    <h3 class="card-title text-primary">Informasi</h3>
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table-description table-modified">

                            <tr style="">
                                <td class="text-uppercase lbl_hdr_katewlyh"></td>
                                <td>:</td>
                                <td class="lbl_hdr_nmwlyh"></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- start page title -->
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px; margin-left: -28px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="kabko">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Kabupaten <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Bahan Dukung <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="kabko">
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
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1); height: 150px;">
                <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 35px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">

                    <a href="#" class="logo text-center logo-light">
                        <span class="logo" style="line-height: 75px;">
                            <img src="https://peppd.bappenas.go.id/ppd2022/assets/images/ic_logo_ppd.png" alt="" width="50">
                        </span>
                    </a>

                </div>
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info">Informasi</h3>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <table style="width:100%; border: 0px solid black">
                            <tbody>
                                <tr style="border: 0px solid black">
                                    <td class="text-uppercase lbl_hdr_katewlyh"></td>
                                    <td>:</td>
                                    <td class="text-uppercase lbl_hdr_nmwlyh"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row _wrapper_bahan" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <a href="#" id="btnShwMdlSindiAdd" class="btn btn-info waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px;"><i class="fa fa-plus"></i> Tambah Dokumen</a>
                    <a href="#" id="btnDowDoc" class="btn btn-primary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Unduh Semua<i class="fas fa-download" style="padding-left: 5px;"></i></a>
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <input type="hidden" id="inp_dok" />
                        <table class="table table-condensed table-bordered table-striped" id="t_bahan" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                <tr>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>No</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Nama Dokumen</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center> Tag di?</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Diupload Oleh</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Aktivitas</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Unduh</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Edit</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Hapus</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- <div class="card-footer">
                    <button class="btn btn-warning btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                    <button class="btn btn-success" id="btnDowDoc"><i class=" mdi mdi-file-download-outline "></i>&nbsp;Unduh Semua</button>
                    <button class="btn btn-info" id="btnShwMdlSindiAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                </div> -->
            </div>
        </div>
    </div>

    <div class="row _wrapper_infoG" style="display: none;">

        <!-- start page title -->
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px; margin-left: -28px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="kabko">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Kabupaten <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_bahan" data-hide="._wrapper_infoG" data-hdrhide="._wrapper_infoG" data-reload="GUser">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Bahan Dukung <i class="mdi mdi-numeric-2-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Group User <i class="mdi mdi-numeric-3-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._wrapper_bahan" data-hide="._wrapper_infoG" data-hdrhide="._wrapper_infoG" data-reload="GUser">
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

        <div class="col-8" style="margin-top: 90px; justify-self: center;">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">

                    <div style="overflow-x: auto;">
                        <input type="hidden" class="" id="iddok" name="iddok" placeholder='id'>
                        <input type="hidden" class="" id="idgro" name="idgro" placeholder='id'>
                        <table class="table-description table-modified">
                            <tr style="">
                                <td class="text">Nama Dokumen</td>
                                <td>:</td>
                                <td class="lbl_id_jdl"></td>
                            </tr>
                            <tr style="">
                                <td class="text">Diupload Oleh</td>
                                <td>:</td>
                                <td class="lbl_nm_upload"></td>
                            </tr>
                            <tr style="">
                                <td class="text">Aktivitas</td>
                                <td>:</td>
                                <td class="lbl_aktiv"></td>
                            </tr>
                            <tr style="">
                                <td class="text">Tag di</td>
                                <td>:</td>
                                <td class="lbl_email_user" style="width:500px">
                                    <table id="t_dataGroup" class="table mb-0">
                                        <tbody class="table_wilayah"> </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr style="">
                                <td class="text"> </td>
                                <td></td>
                                <td class="" style="width:500px" id="t_dataSel">
                                    <div class="form-group">
                                        <select class="form-control" id="select_gr" name="select_gr">
                                            <option value="">- Pilih -</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr class="_wrpTahap" style="display: none;">
                                <td class="text">Tahap?</td>
                                <td>:</td>
                                <td class="" style="width:500px">
                                    <table id="t_dataTahap" class="table mb-0">
                                        <tbody class="table_tahap"> </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr class="_wrpGruTahap" style="display: none;">
                                <td class="text"></td>
                                <td></td>
                                <td class="" style="width:500px" id="t_datatah">
                                    <div class="form-group">
                                        <select class="form-control" id="select_thp" name="select_thp">

                                        </select>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <!-- <div class="card-footer">
                        <button class="btn btn-warning btnShwHd" data-show="._wrapper_bahan" data-hide="._wrapper_infoG" data-hdrhide="._wrapper_infoG" data-reload="GUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                    </div> -->

                </div>
            </div>

        </div>

    </div>

</div>

<form id="frmDokAdd">
    <div id="mdl_dok_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="card-title mt-1 mb-1" style="color: black;">Tambah Dokumen</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <br /><span class="text-info" style='font-size: 10px'>Format: Nama Dokumen (spasi) Tahun (spasi) Daerah. </span>
                                    <br /><span class="text-info" style='font-size: 10px'>Contoh : RKPD 2020 Kota A</span>
                                </label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="" required="">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="field-3" name="attch" placeholder="" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <div id="uploadStatus"></div>


                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </div> -->
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<form id="frmDokEdt">
    <div id="mdl_dok_edt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <br /><span class="text-info" style='font-size: 10px'>Format: Nama Dokumen (spasi) Tahun (spasi) Daerah.</span>
                                    <br /><span class="text-info" style='font-size: 10px'>Contoh : RKPD 2020 Kabupaten A</span>
                                </label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="" required="">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="filedok" name="filedok" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <div id="uploadStatus"></div>


                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </div> -->
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<form id="frmDokInovasiEdt">
    <div id="mdl_dok_inovasi_edt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title mt-0 mb-3" style="color: black;">Edit Dokumen Inovasi</h3>
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <br><span class="text-info" style='font-size: 11px'>Format File: <strong name="frmat" style="color: #33b86c;"></strong> </span>
                                    <span class="text-info" style='font-size: 11px'>Max File 100 MB</span>
                                </label>
                                <input type="text" class="form-control" id="editNama" name="nama" placeholder="" required="" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Judul Inovasi<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editJudul" name="judul" placeholder="" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Deskripsi<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="4" cols="50" placeholder="Contoh: Inovasi pertanian dengan menggunakan AI" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Input<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="editInput" name="input" rows="4" cols="50" placeholder="" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Proses<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="editProses" name="proses" rows="4" cols="50" placeholder="" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Output<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="editOutput" name="output" rows="4" cols="50" placeholder="" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Outcome<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="editOutcome" name="outcome" rows="4" cols="50" placeholder="" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Tag<span class="text-danger">*</span></label>
                                <select class="js-example-basic-multiple" multiple="multiple" id="editTagSelect" name="tagInovasi[]" placeholder="ketik lalu tekan enter" required="">
                                    <!-- Options will be dynamically added here -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="editFiledok" name="filedok" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <div id="uploadStatus"></div>
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

<div class="modal fade" id="modalkab" tabindex="-1" role="dialog" aria-labelledby="modalkabLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalkabLabel">Unduh Spesifik Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Unduh</th>
                        </tr>
                    </thead>
                    <tbody id="isi-tabel-sdokumen">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>