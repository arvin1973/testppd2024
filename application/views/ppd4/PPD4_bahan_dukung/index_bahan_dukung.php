<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Daftar Bahan Dukung penilaian</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Bahan Dukung</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->
    <div class="row stepper-navigation-bahan-dukung-kabkota">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Bahan Dukung <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
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

    <div class="row _wrapper_bahan" style="margin-top: 90px;">
        <div class="col-lg-12">
            <div class="card card-color mb-0">
                <div class="card-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <!-- <h3 class=" card-title">daftar bahan pendukung penilaian</h3> -->
                    <!-- <h3 class="card-title mt-1 mb-0" style="color: black;">Dokumen Pendukung - <span class="lbl_jdl_wlyh"></span></h3> -->
                </div>
                <div class="card-header border-info bg-transparent pb-0 mb-0">
                    <!-- <button class="btn btn-success" id="btnDowDoc" style="float: right;"><i class="mdi mdi-file-download-outline"></i>&nbsp;Unduh Semua</button>                     -->
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-info" id="btnShwMdlSindiAdd" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px;">Tambah Data <i class="fas fa-plus" style="margin-left: 5px;"></i></button>
                            <button class="btn btn-sm btn-primary waves-effect waves-light" id="btnDowDoc" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Unduh Semua <i class="fas fa-download" style="padding-left: 5px;"></i></button>
                            <input type="hidden" id="inp_wlyh" />
                            <!-- <h3 class="card-title mt-1 mb-1" style="color: black;">Daftar bahan pendukung penilaian<span class="lbl_jdl_wlyh"></span></h3> -->
                            <!-- <p class="text-muted font-13 mb-4">Silahkan unduh dokumen-dokumen dibawah sebelum melakukan penilaian</p> -->
                            <table class="table table-condensed table-bordered table-striped" id="t_bahan_dukung" style="border: 1px solid black; margin-bottom: 0px; border-collapse: inherit;">
                                <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                    <tr>
                                        <td class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>No</b></center>
                                        </td>
                                        <td class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Nama Dokumen</b></center>
                                        </td>
                                        <td class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Diupload Oleh</b></center>
                                        </td>
                                        <td class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Aktivitas</b></center>
                                        </td>
                                        <td class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Unduh</b></center>
                                        </td>
                                        <td class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Edit</b></center>
                                        </td>
                                        <td class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Hapus</b></center>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- <button class="btn btn-info" id="btnShwMdlSindiAdd" style="float: right;"><i class="fas fa-plus"></i>&nbsp;Data Baru</button> -->
                </div>
            </div>
        </div>
    </div>

</div>

<form id="frmDokAdd">
    <div id="mdl_dok_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <h3 class="card-title mt-0 mb-3" style="color: black;">Tambah Dokumen</h3>
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <br><span class="text-info" style='font-size: 11px'>Format File: <strong name="" style="color: #33b86c;">pdf|xls|xlsx|zip</strong></span>
                                    <br><span class="text-info" style='font-size: 11px'>Max File 100 MB</span>
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
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<form id="frmDokEdt">
    <div id="mdl_dok_edt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <h3 class="card-title mt-0 mb-3" style="color: black;">Edit Dokumen</h3>
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <br><span class="text-info" style='font-size: 11px'>Format File: <strong name="frmat" style="color: #33b86c;"></strong> </span>
                                    <br><span class="text-info" style='font-size: 11px'>Max File 100 MB</span>
                                </label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="">
                                <input type="hidden" id="iddok" name="iddok" />
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="field-4" name="filedok" placeholder="">
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