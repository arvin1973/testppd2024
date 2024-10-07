<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >MANAJEMEN DATA MODUL 3</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Manajemen Data</a></li>
                        <li class="breadcrumb-item active">Modul 3</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
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
                                <td  class="text-uppercase">Kriteria</td>
                                <td>:</td>
                                <td class="lbl_hdr_krit"></td>
                            </tr>
                            <tr style="">
                                <td  class="text-uppercase">Indikator</td>
                                <td>:</td>
                                <td class="lbl_hdr_indi"></td>
                            </tr>
                            <tr style="display: none">
                                <td  class="text-uppercase">Sub Indikator</td>
                                <td>:</td>
                                <td class="lbl_hdr_sindi"></td>
                            </tr>
                            <tr style="display: none">
                                <td  class="text-uppercase">Item Penilaian</td>
                                <td>:</td>
                                <td class="lbl_hdr_item"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
    <div class="row _wrapper _wrapper_indi">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Indikator</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_indi">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut"style="width:10px">NO</th>
                                    <th class="text-uppercase">NAMA Indikator</th>
                                    <th class="text-uppercase"style="width:10px">Bobot</th>
                                    <th class="" style="width:10px">#AKSI</th>
                                </tr>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
<!--                    <button class="btn btn-info" id="btnShwMdlKriteriaAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru Kriteria</button>-->
                    <button class="btn btn-info" id="btnShwMdlIndiAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru Indikator</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row _wrapper _wrapper_sindi" style="display:none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title pull-left">List Sub Indikator</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" id="inp_indi" value=""/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_sindi">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut">NO</th>
                                    <th class="text-uppercase">NAMA Sub Indikator</th>
                                    <th class="text-uppercase">Tampilkan</th>
                                    <th class="text-uppercase">Tag Provinsi</th>
                                    <th class="">#AKSI</th>
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-info" id="btnShwMdlSindiAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_indi" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row _wrapper _wrapper_item" style="display:none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    
                    <h3 class="card-title pull-left">List Item Penilaian</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" id="inp_sindi" value=""/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_item">
                            <thead>
                                <tr>
                                    <th class="">NO</th>
                                    <th class="text-uppercase">NAMA Item Penilaian</th>
                                    <th class="text-uppercase">Status</th>
                                    <th class="">#AKSI</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-info" id="btnShwMdlItemAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_sindi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_sindi"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row _wrapper _wrapper_indiitem" style="display:none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    
                    <h3 class="card-title pull-left">List Kategori Skor per Item</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" id="inp_item" value=""/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_indiitem">
                            <thead>
                                <tr>
                                    <th class="">NO</th>
                                    <th class="text-uppercase">NAMA Kategori Skor per Item</th>
                                    <th class="text-uppercase">Skor</th>
                                    <th class="text-uppercase">Status</th>
                                    <th class="">#AKSI</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-info" id="btnShwMdlIndiitemAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_item" data-hide="._wrapper" data-hdrhide=".lbl_hdr_item"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="frmKriteriaAdd">
    <div id="mdl_kriteria_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="field-1" class="control-label">Aspek</label>
                                <select class="form-control" id="field-1" name="kriter"  required="">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($list_aspek->result() as $v) {
                                        ?>
                                    <option value="<?php echo $v->id?>"><?php echo $v->nm?></option>
                                            <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Kriteria</label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="Nama Indikator" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-4" class="control-label">bobot</label>
                                <input type="text" class="form-control" id="field-4" placeholder="Bobot" required="" name="bobot">
                            </div>
                        </div>
<!--                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-4" class="control-label">No Urut</label>
                                <input type="text" class="form-control" id="field-4" required="" name="nourut">
                            </div>
                        </div>-->
                    </div>
<!--                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
                            </div>
                        </div>
                    </div>-->
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<form id="frmIndiAdd">
    <div id="mdl_indi_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Indikator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="field-1" class="control-label">Kriteria</label>
                                <select class="form-control" id="field-1" name="kriter"  required="">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($list_kriteria->result() as $v) {
                                        ?>
                                    <option value="<?php echo $v->id?>"><?php echo $v->nm?></option>
                                            <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Indikator</label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="Nama Indikator" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-4" class="control-label">bobot</label>
                                <input type="text" class="form-control" id="field-4" placeholder="Bobot" required="" name="bobot">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-4" class="control-label">No Urut</label>
                                <input type="text" class="form-control" id="field-4" required="" name="nourut">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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

<form id="frmIndiEdit">
    <div id="mdl_indi_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Indikator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="field-1" class="control-label">Kriteria</label>
                                <select class="form-control" id="field-1" name="kriter"  disabled="">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($list_kriteria->result() as $v) {
                                        ?>
                                    <option value="<?php echo $v->id?>"><?php echo $v->nm?></option>
                                            <?php
                                    }
                                    ?>
                                </select>
                                <input type="hidden"name="id"required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Indikator</label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="Nama Indikator" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">bobot</label>
                                <input type="text" class="form-control" id="field-4" placeholder="Bobot" required="" name="bobot">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">No Urut</label>
                                <input type="text" class="form-control" id="field-4" required="" name="nourut">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="field-1" class="control-label">Status</label>
                                <select class="form-control" id="field-1" name="stts">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Y.Aktif</option>
                                    <option value="N">T.Tidak</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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


<form id="frmSindiAdd">
    <div id="mdl_sindi_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Item Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Sub Indikator <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="" required="">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-3" class="control-label">No Urut <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nourut" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">ditampilkan ? <span class="text-danger">*</span></label>
                                <select class="form-control" id="field-4" required="" name="tampil">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Ya</option>
                                    <option value="N">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Tag di Provinsi? <span class="text-danger">*</span></label>
                                <select class="form-control" id="field-4" required="" name="tag_prov">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Ya</option>
                                    <option value="N">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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

<form id="frmSindiEdit">
    <div id="mdl_sindi_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Item Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Indikator</label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="Nama Indikator" required="">
                                <input type="hidden"name="id"required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-4" class="control-label">ditampilkan ? <span class="text-danger">*</span></label>
                                <select class="form-control" id="field-4" required="" name="tampil">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Ya</option>
                                    <option value="N">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Tag di Provinsi? <span class="text-danger">*</span></label>
                                <select class="form-control" id="field-4" required="" name="tag_prov">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Ya</option>
                                    <option value="N">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="field-1" class="control-label">Status</label>
                                <select class="form-control" id="field-1" name="stts">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Y.Aktif</option>
                                    <option value="N">T.Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-3" class="control-label">No Urut <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nourut" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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

<form id="frmItemAdd">
    <div id="mdl_item_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Item Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Item Penilaian<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="field-3" class="control-label">No Urut <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nourut" required="">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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

<form id="frmItemEdit">
    <div id="mdl_item_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Item Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Item Penilaian<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nama" required="">
                                <input type="hidden"name="id"required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="field-1" class="control-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" id="field-1" name="stts">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Y.Aktif</option>
                                    <option value="N">T.Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="field-3" class="control-label">No Urut <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nourut" required="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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

<form id="frmIndiitemAdd">
    <div id="mdl_indiitem_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kategori Skor per Item </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Kategori Skor per Item<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nama" placeholder="" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Skor<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="" name="skor" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="field-3" class="control-label">No Urut <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nourut" required="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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

<form id="frmIndiitemEdit">
    <div id="mdl_indiitem_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Kategori Skor per Item </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nama Kategori Skor per Item <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nama" required="">
                                <input type="hidden"name="id"required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Skor<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="" name="skor" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-3" class="control-label">No Urut <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="field-3" name="nourut" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="field-1" class="control-label">Status</label>
                                <select class="form-control" id="field-1" name="stts">
                                    <option value="">- Pilih -</option>
                                    <option value="Y">Y.Aktif</option>
                                    <option value="N">T.Tidak</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Catatan</label>
                                <textarea class="form-control" id="field-5" name="note"></textarea>
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