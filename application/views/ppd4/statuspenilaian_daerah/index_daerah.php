<div class="container-fluid">
    <div class="row stepper-navigation-bahan-dukung-kabkota">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Rekap Penilian <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>

                </div>
                <div class="page-title-right">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row _wrapper_bahan" style="margin-top: 90px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-custom">Rekap Penilian Kabupaten/Kota Tahap I</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" /><input type="hidden" id="inp_dok" />
                        <table class="table table-condensed table-bordered table-striped" id="t_bahan" style="border: 1px solid black; margin-bottom: 0px; border-collapse: inherit;">
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                <tr>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="No Urut">
                                        <center><b>No</b></center>
                                    </th>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="Nama Dokumen">
                                        <center><b>Nama Dokumen</b></center>
                                    </th>
                                    <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="Unduh">
                                        <center><b>Unduh</b></center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text" >
                                        <center><b>1</b></center>
                                    </th>
                                    <th class="text" >
                                        <center><b>Rekap Penilaian Tahap I</b></center>
                                    </th>
                                    <th class="text" >
                                        <center><button id="rekapall"><i class='fas fa-download'></i></button></center>
                                    </th>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <!-- <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button> -->
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
                            <h3 class="card-title mt-0 mb-3" style="color: black;">Tambah Dokumen Hasil Penilaian</h3>
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <!-- <span class="text-info" style='font-size: 10px'>Format Nama Dokumen</span></Br> -->
                                    <br><span class="text-info" style='font-size: 11px'>Format Nama Dokumen </span>
                                    <span class="text-info" style='font-size: 11px'> </span>
                                    <br><span class="text-black" style='font-size: 11px'>Contoh : Rekapitulasi Penilaian Kabupaten</span>
                                    <br><span class="text-danger" style='font-size: 11px'>Max : 100 MB</span>
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

<form id="frmDokUp">
    <div id="mdl_dok_up" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <h3 class="card-title mt-0 mb-3" style="color: black;">Tambah Dokumen Hasil Penilaian</h3>
                            <input type="hidden" id="inp_iddok" name="iddok" readonly>
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <!-- <span class="text-info" style='font-size: 10px'>Format Nama Dokumen</span></Br> -->
                                    <br><span class="text-info" style='font-size: 11px'>Format Nama Dokumen </span>
                                    <span class="text-info" style='font-size: 11px'> </span>
                                    <br><span class="text-black" style='font-size: 11px'>Contoh : Rekapitulasi Penilaian Kabupaten</span>
                                    <br><span class="text-danger" style='font-size: 11px'>Max : 100 MB</span>
                                </label>
                                <input type="text" class="form-control" id="namaup" name="nama" placeholder="" required="" readonly>
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
                            <h3 class="card-title mt-0 mb-3" style="color: black;">Edit Dokumen Hasil Penilaian</h3>
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                    <br><span class="text-info" style='font-size: 11px'>Format Nama Dokumen</span>
                                    <span class="text-info" style='font-size: 11px'></span>
                                    <br><span class="text-black" style='font-size: 11px'>Contoh : Rekapitulasi Penilaian Kabupaten</span>
                                    <br><span class="text-danger" style='font-size: 11px'>Max : 100 MB</span>
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
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>