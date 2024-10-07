<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Dokumen Pendukung</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Upload Dokumen</a></li>
                        <li class="breadcrumb-item active">Kab/Kota</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="row _wrapper_bahan" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Bahan Dukung</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-bordered table-hover" id="t_bahan">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:5px">NO</th>
                                    <th class="text">Nama Dokumen</th>
                                    <th class="" style="width:8px"> Tag di group</th>
                                    <th class="" title="Diupload Oleh" style="width:15px">Diupload Oleh</th>
                                    <th class="" title="Aktivitas" style="width:15px">Aktivitas</th>
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
                    <button class="btn btn-info" id="btnShwMdlSindiAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                    <button class="btn btn-info" id="btnDownAll"><i class=" mdi mdi-zip-disk "></i>&nbsp;Unduh Semua</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row _wrapper_info" style="display: none;">
        <div class="col-md-12">
            <div class="card card-border">
                <div class="card-header border-primary bg-transparent pb-0">
                    <h3 class="card-title text-primary">Dokumen</h3>
                </div>
                <div class="card-body">
                    
                    <div style="overflow-x: auto;">
                        <input type="hidden" class="" id="iddok" name="iddok" placeholder='id'>
                        <input type="hidden" class="" id="idgro" name="idgro" placeholder='id'>
                        <table class="table-description table-modified">
                            <tr style="">
                                <td  class="text">Nama Dokumen</td>
                                <td>:</td>
                                <td class="lbl_id_jdl"></td>
                            </tr>
                            <tr style="">
                                <td  class="text">Diupload Oleh</td>
                                <td>:</td>
                                <td class="lbl_nm_upload"></td>
                            </tr>
                            <tr style="">
                                <td  class="text">Aktivitas</td>
                                <td>:</td>
                                <td class="lbl_aktiv"></td>
                            </tr>
                            <tr style="">
                                <td  class="text">Tag di?</td>
                                <td>:</td>
                                <td class="lbl_email_user" style="width:500px">
                                    <table id="t_dataGroup" class="table mb-0">
                                                
                                                <tbody class="table_wilayah">
                                                </tbody>
                                            </table>
                                </td>
                                
                            </tr>
                            
                            <tr style="">
                                <td  class="text"> </td>
                                <td>:</td>
                                <td class="" style="width:500px" id="t_dataSel">                            
                                    <div class="form-group" >
                                        <select class="form-control" id="select_gr" name="select_gr">
                                        <option value="">- Pilih -</option>
                                        <option value="Y">TPT</option>
                                        <option value="N">TPU/TPI</option>
                                        <option value="N">Daerah</option>
                                        <option value="N">Semua</option>
                                    </select>
                                    </div>
                                </td>
                            </tr>
                            
                            
                            <tr class="_wrpTahap" style="display: none;">
                                    <td  class="text">Tahap?</td>
                                    <td>:</td>
                                    <td class="" style="width:500px">
                                        <table id="t_dataTahap" class="table mb-0">
                                            <tbody class="table_tahap"> </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="_wrpGruTahap" style="display: none;">
                                <td  class="text"></td>
                                <td></td>
                                <td class="" style="width:500px" id="t_datatah">
                                    <div class="form-group" >
                                        <select class="form-control" id="select_thp" name="select_thp">
                                        <option value="">- Pilih -</option>
                                        <option value="1">Tahap Umum</option>
                                        <option value="2">Tahap 2</option>
                                        <option value="3">Tahap 3</option>
                                    </select>
                                    </div>
                                </td>
                            </tr>
                            
                        </table>
                    </div>
                    <div class="card-footer">
                                            <button class="btn btn-warning btnShwHd"  data-show="._wrapper_bahan"  data-hide="._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="GUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                                        </div>
                    <div style="overflow-x: auto;">
                        
                    </div>
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
                    <h5 class="modal-title">Tambah Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Dokumen<span class="text-danger">*</span></label>
                                <span class="text-info" style='font-size: 10px'>Format: Nama Dokumen (spasi) Tahun (spasi) Daerah, </span>
                                    <span class="text-info" style='font-size: 10px'>Contoh : RKPD 2020 Provinsi A</span>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <div id="uploadStatus"></div>


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