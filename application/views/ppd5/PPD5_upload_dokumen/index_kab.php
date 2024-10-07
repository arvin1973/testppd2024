<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >DAFTAR DOKUMEN PENDUKUNG KAB/KOTA</h4>

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
                            <p class="mb-0">Dokumen Pendukung <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <!-- <a href="#"><p style="padding: 5px; font-size: 0.8rem !important;"><strong><i class="mdi mdi-undo" style="color: #2ad408;"></i> Kembali</strong></p></a> -->
                </div>
                <div class="page-title-right"> </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row _wrapper_bahan" style="margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;""> </div>
                <!-- <div class=" card-header border-info bg-transparent pb-0"> -->
                    <!-- <h3 class="card-title text-custom">List Dokumen Tahap 1</h3> -->
                    <!-- <h3 class="card-title text-custom">List Dokumen Pendukung</h3> -->
                    <!-- <button class="btn btn-success" id="btnDowDoc" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 1px; margin-bottom: 10px; float: right;"><i class="mdi mdi-file-download-outline"></i>&nbsp;Unduh Semua</button> -->
                    <!-- </div> -->
                    <div class="card-body">
                        <h3 class="card-title text-custom">Daftar Dokumen Pendukung</h3>
                        <button class="btn btn-sm btn-primary waves-effect waves-light" id="btnDowDoc" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Unduh Semua <i class="fas fa-download" style="padding-left: 5px;"></i></button>
                        <div class="table-responsive">
                            <input type="hidden" id="inp_wlyh" value="<?php echo $satker; ?>" />
                            <input type="hidden" id="inp_dok" />
                            <!-- <table class="table table-bordered table-hover" id="t_bahan" >
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;"> -->
                            <table class="table table-condensed table-bordered table-striped " id="t_bahan" style="border: 1px solid black; margin-bottom: 0px; border-collapse: inherit;">
                                <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                    <!-- <tr>
                                    <th class="" title="No" style="width:5px; font-size: 12px">NO</th>
                                    <th class="" title="Nama Dokumen" style=" font-size: 12px" >Jenis Dokumen</th>
                                    <th class="" title="Diupload Oleh" style="width:5px; font-size: 12px">Status</th>
                                    <th class="" title="Aktivitas" style="width:5px; font-size: 12px">Unggah</th>
                                    <th class="" title="Aktivitas" style="width:5px; font-size: 12px">Hapus</th>
                                </tr> -->
                                    <tr>
                                        <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="No" width="5%">
                                            <center><b>No</b></center>
                                        </th>
                                        <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="Nama Dokumen" width="45%">
                                            <center><b>Nama Dokumen</b></center>
                                        </th>
                                        <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="Status" width="17%">
                                            <center><b>Status</b></center>
                                        </th>
                                        <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="Aksi" width="33%">
                                            <center><b>Aksi</b></center>
                                        </th>
                                        <!-- <th class="text" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="Hapus"><center><b>Hapus</b></center></th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer" style="padding-top: 0px;">
                        <button class="btn btn-info" id="btnShwMdlSindiAdd" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px;">Tambah Dokumen <i class="fas fa-plus" style="margin-left: 5px;"></i></button>
                        <!-- <button class="btn btn-sm btn-primary waves-effect waves-light" id="btnDowDoc" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Unduh Semua Bahan Dukung <i class="fas fa-download" style="padding-left: 5px;"></i></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="frmDokumenAdd">
        <div id="mdl_dokomen_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="iddok" />
                        <input type="hidden" name="datafrm" />
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-0 mb-3" style="color: black;">Tambah Dokumen</h3>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                        <br><span class="text-info" style="font-size: 11px;">Format File: <strong name="frmat" style="color: #33b86c;"></strong></span>
                                        <span class="text-info" style="font-size: 11px;">Max File 100 MB</span>
                                    </label>
                                    <input type="text" class="form-control" id="field-3" name="nama" placeholder="" required="" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="field-4" name="attch" placeholder="" required="">
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

    <form id="frmDokumenInovasiAdd">
        <div id="mdl_dokomen_inovasi_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="iddok" />
                        <input type="hidden" name="datafrm" />
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-0 mb-3" style="color: black;">Tambah Dokumen Inovasi</h3>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="field-3" name="nama" placeholder="" required="" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Judul Inovasi<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="field-4" name="judul" placeholder="Contoh: Artificial Agriculture" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Deskripsi<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="field-5" name="deskripsi" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan singkat terkait inovasi" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Input<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="field-6" name="input" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan upaya yang dilakukan agar inovasi menjawab permasalahan dan mencapai tujuan" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Proses<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="field-12" name="proses" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan rangkaian kegiatan dan aksi yang dirancang dan dilaksanakan" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Output<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="field-7" name="output" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan hasil atau keluaran langsung yang dapat dirasakan dari inovasi" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Outcome<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="field-8" name="outcome" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan potensi capaian jangka panjang inovasi meliputi dampak, manfaat, dan perubahan" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Tag<span class="text-danger">* (ketik lalu tekan enter/space) (Contoh: Pertanian)</span></label>
                                    <select class="js-example-basic-multiple" multiple="multiple" id="tagSelect" name="tagInovasi[]" placeholder="ketik lalu tekan enter/space" required="">
                                        <!-- Options will be dynamically added here -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span>
                                        <br><span class="text-info" style='font-size: 11px'>Format File: <strong name="frmat" style="color: #33b86c;"></strong> </span>
                                        <span class="text-info" style='font-size: 11px'>Max File 100 MB</span>
                                    </label>
                                    <input type="file" class="form-control" id="field-10" name="attch" placeholder="" required="">
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
                        <input type="hidden" name="datafrm" />
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-0 mb-3" style="color: black;">Tambah Dokumen</h3>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span>
                                        <br><span class="text-info" style='font-size: 11px'>Format File: <strong style="color: #33b86c;"> pdf|docx|xls|xlxs|JPEG|PNG|zip</strong> </span>
                                        <span class="text-info" style='font-size: 11px'>Max File 100 MB</span>
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
                                        <span class="text-info" style='font-size: 11px'>Max File 100 MB</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="">
                                    <input type="hidden" id="iddok" name="iddok" />
                                    <input type="hidden" name="datafrm" />
                                    <input type="hidden" name="dokdata" />
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
                    <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="button" class="btn btn-outline-warning waves-effect _wrapper_del" data-dismiss="modal"><i class="fas fa-minus"></i>&nbsp;Hapus</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </div> -->
                    <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Batal</button>
                        <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
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
                        <input type="hidden" id="editIddok" name="iddok" />
                        <input type="hidden" name="datafrm" />
                        <input type="hidden" name="dokdata" />

                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-0 mb-3" style="color: black;">Edit Dokumen Inovasi</h3>
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="editNama" name="nama" placeholder="" required="" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Judul Inovasi<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="editJudul" name="judul" placeholder="Contoh: Artificial Agriculture" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Deskripsi<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan singkat terkait inovasi" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Input<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="editInput" name="input" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan upaya yang dilakukan agar inovasi menjawab permasalahan dan mencapai tujuan" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Proses<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="editProses" name="proses" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan rangkaian kegiatan dan aksi yang dirancang dan dilaksanakan" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Output<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="editOutput" name="output" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan hasil atau keluaran langsung yang dapat dirasakan dari inovasi" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Outcome<span class="text-danger">* (Maksimum Kata: 2000)</span></label>
                                    <textarea class="form-control" id="editOutcome" name="outcome" rows="4" cols="50" maxlength="3000" placeholder="Penjelasan potensi capaian jangka panjang inovasi meliputi dampak, manfaat, dan perubahan" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Tag<span class="text-danger">* (ketik lalu tekan enter/space) (Contoh: Pertanian)</span></label>
                                    <select class="js-example-basic-multiple" multiple="multiple" id="editTagSelect" name="tagInovasi[]" placeholder="ketik lalu tekan enter/space" required="">
                                        <!-- Options will be dynamically added here -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span>
                                        <br><span class="text-info" style='font-size: 11px'>Format File: <strong name="frmat" style="color: #33b86c;"></strong> </span>
                                        <span class="text-info" style='font-size: 11px'>Max File 100 MB</span>
                                    </label>
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