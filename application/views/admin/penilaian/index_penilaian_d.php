<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Hasil Penilaian</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Upload Hasil Penilaian</a></li>
                        <li class="breadcrumb-item active">Kab/Kota</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row _wrapper_bahan" style="">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Hasil Penilaian Kab/Kota</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" /><input type="hidden" id="inp_dok" />
                        <table class="table table-bordered table-hover" id="t_bahan">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:5px">No</th>
                                    <th class="">Nama Dokumen</th>
                                    <th class="" style="width:5px">Unduh</th>
                                    <th class="" style="width:5px">Edit</th>
                                    <th class="" style="width:5px">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
<!--                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>-->
                    <button class="btn btn-info" id="btnShwMdlSindiAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="frmDokAdd">
    <div id="mdl_dok_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumen Hasil Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span></Br>
                                    <span class="text-info" style='font-size: 10px'>Format: Nama Dokumen (spasi) Tahun (spasi) Daerah</span></Br>
                                    <span class="text-info" style='font-size: 10px'>Contoh : Penilaian 2020 Kabupaten A</span>
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
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<form id="frmDokEdt">
    <div id="mdl_dok_edt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Dokumen Hasil Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span></label></Br>
                                <span class="text-info" style='font-size: 10px'>Format: Nama Dokumen (spasi) Tahun (spasi) Daerah.</span>
                                    <span class="text-info" style='font-size: 10px'>Contoh : RKPD 2020 Provinsi A</span>
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
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>