<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" >Upload Penilaian - Tahap 3</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
<!--                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Bahan Dukung - Tahap 2</li>-->
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row _wrapper _wrapper_katewlyh">
        <div class="col-lg-12">
            <div class="card card-border">
                <div class="card-header border-primary bg-transparent pb-0">
                    <h3 class="card-title text-primary">WILAYAH PENILAIAN</h3>
                </div>
                <div class="card-body">
                    <br/>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-box bg-danger _cardboxcustom btnProv" title="Klik untuk lihat detail">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <div class="display-3 text-center">
                                                    <i class="fas fa-hotel text-white"></i>
                                                    <br/>
                                                    <h6 class="text-white">PROVINSI</h6>
                                                </div>
                                            </div>

                                        </div><!-- End row -->
                                    </div>
                                </div><!-- end row -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-box bg-warning _cardboxcustom btnKab" title="Klik untuk lihat detail">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <div class="display-3 text-center">
                                                    <i class="fas fa-building  text-white"></i>
                                                    <br/>
                                                    <h6 class="text-white">KABUPATEN</h6>
                                                </div>
                                            </div>

                                        </div><!-- End row -->
                                    </div>
                                </div><!-- end row -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-box bg-success _cardboxcustom btnKota" title="Klik untuk lihat detail">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <div class="display-3 text-center">
                                                    <i class="fas fa-building text-white"></i>
                                                    <br/>
                                                    <h6 class="text-white">KOTA</h6>
                                                </div>
                                            </div>

                                        </div><!-- End row -->
                                    </div>
                                </div><!-- end row -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"><p class="text-left"><small><i>*Silakan klik ikon </i></small></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row _wrapper _wrapper_wlyh" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List <span class="lbl_katewlyh">Provinsi</span></h3>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-info-circle "></i> Silakan mengunggah hasil penilaian yang telah dilakukan.
                            </div>
                        </div>
                    </div>
<!--                    <p class="text-muted font-13 mb-4">Silahkan pilih <span class="text-primary lbl_katewlyh">provinsi</span> yang ingin dilakukan penilaian</p>-->
                    <input type="hidden" id="inp_kate_wlyh" value=""/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_wlyh">
                            <thead>
                                <tr>
                                    <th class="" style="width: 10px">NO</th>
                                    <th class="text-uppercase">NAMA <span class="lbl_katewlyh">Provinsi</span></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <br/>
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_katewlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row _wrapper_info" style="display: none">
        <div class="col-md-12">
            <div class="card card-border">
                <div class="card-header border-primary bg-transparent pb-0">
                    <h3 class="card-title text-primary">Informasi</h3>
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table-description table-modified">
                            
                            <tr style="">
                                <td  class="text-uppercase lbl_hdr_katewlyh"></td>
                                <td>:</td>
                                <td class="lbl_hdr_nmwlyh"></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row _wrapper_bahan" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Penilaian</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <input type="hidden" id="inp_dok" />
                        <table class="table table-bordered table-hover" id="t_doc_p">
                            <thead>
                                <tr>
                                    <th class="" title="No" style="width:5px">NO</th>
                                    <th class="" style="width:5px">Nama Dokumen</th>
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
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
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
                    <h5 class="modal-title">Upload Dokumen Penilaian - Tahap 3</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span></label>
                                <span class="text-info" style='font-size: 10px'>Format: Nama Dokumen (spasi) Daerah. </span>
                                <span class="text-info" style='font-size: 10px'>Contoh : Tahap 3 Provinsi A</span>
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
                    <h5 class="modal-title">Edit Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span></label>
                                <span class="text-info" style='font-size: 10px'>Format: Nama Dokumen (spasi) Tahun (spasi) Daerah.</span>
                                    <span class="text-info" style='font-size: 10px'>Contoh : Tahap 3 Provinsi A</span>
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

<!-- Modal -->
<div id="mdl_doc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="card card-color mb-0">
                <div class="card-header bg-light">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="card-title mt-1 mb-0">Dokumen Daerah - Tahap 2 - <span class="lbl_jdl_wlyh"></span></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-muted font-13 mb-4">Silahkan unduh dokumen-dokumen dibawah sebelum melakukan penilaian</p>
                            <table class="table table-condensed table-bordered table-striped " id="t_doc">
                                <thead>
                                    <tr>
                                        <td class="text-uppercase" style="width: 10px">No</td>
                                        <td class="text-uppercase">Judul</td>
                                        <td class="text-uppercase" style="width: 10px">Tautan</td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Tutup</button>
                    
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->