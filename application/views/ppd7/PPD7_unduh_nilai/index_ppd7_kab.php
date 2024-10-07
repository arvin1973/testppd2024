<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" >Unduh Penilaian Dokumen</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Unduh Nilai Kabupaten</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->
    <div class="row stepper-navigation-unduh-nilai-tpt">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Daftar Kabupaten <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
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

    <div class="row _wrapper _wrapper_wlyh" style="margin-top: 90px; display: block;">

    <p class="text-muted font-13 mb-4">Silahkan klik <strong style="color: #317eeb;">unduh nilai</strong> pada <strong>provinsi</strong> yang dipilih.</p>

    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-lg-10" id="t_wlyh">
            <!-- <div class="card" style="border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;">
                <div style="display: flex; align-items: center;">
                    <img src="<?php echo base_url()?>/assets/icons/PNG_Provinsi/1100_Provinsi Aceh.png" alt="Provinsi Aceh" srcset="" width="100" height="100" style="padding: 15px;">
                    <div class="card-body" style="padding-top: 0.8rem; padding-left: 0px;">
                        <div class="content-wilayah" style="display: flex; justify-content: space-between; align-items: center;">
                            <h4>Provinsi Nusa Tenggara Timur</h4>
                            <div class="btn-wilayah" style="float: right;">
                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px;">Unduh Nilai <i class="fas fa-download" style="padding-left: 5px;"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Penilaian Dokumen Kabupaten</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_wlyh">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut"style="width:10px">NO</th>
                                    <th class="text-uppercase">Nama Kabupaten</th>
                                    <th class="text-uppercase">Unduh</th>
                                </tr>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
               <div class="card-footer">
                    <button class="btn btn-info" id="btnShwMdlIndiAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                </div>
            </div>
        </div> -->
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
                                <td></td>
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
                    <h3 class="card-title">Daftar Bahan Dukung</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-bordered table-hover" id="t_bahan">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:10px">NO</th>
                                    <th class="text-uppercase">NAMA Dokumen</th>
                                    <th class=""style="width:10px">Unduh</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="prov"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>
    
<!--    <div class="row _wrapper_info" style="display: none">
        <div class="col-md-12">
            <div class="card card-border">
                <div class="card-header border-primary bg-transparent pb-0">
                    <h3 class="card-title text-primary">Informasi</h3>
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table-description table-modified">
                            
                            <tr style="">
                                <td  class="text-uppercase lbl_hdr_katewlyh">Provinsi</td>
                                <td>:</td>
                                <td class="lbl_hdr_nmwlyh"></td>
                            </tr>
                            <tr style="display: none">
                                <td  class="text-uppercase">Kriteria</td>
                                <td>:</td>
                                <td class="lbl_hdr_krit"></td>
                            </tr>
                            <tr style="display:none">
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
                                <td  class="text-uppercase">Item</td>
                                <td>:</td>
                                <td class="lbl_hdr_item"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>-->
<!--    <div class="row _wrapper _wrapper_prov" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Provinsi</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted font-13 mb-4">Silahkan pilih <code>provinsi</code> yang ingin dilakukan penilaian</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_prov">
                            <thead>
                                <tr>
                                    <th class="" style="width: 10px">NO</th>
                                    <th class="text-uppercase">NAMA Provinsi</th>
                                    <th class="text-uppercase" title="Kelengkapan">Kelengkapan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>-->
<!--    <div class="row _wrapper _wrapper_kab" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Kabupaten</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted font-13 mb-4">Silahkan pilih <code>kabupaten</code> yang ingin dilakukan penilaian</p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_kab">
                            <thead>
                                <tr>
                                    <th class="" style="width: 10px">NO</th>
                                    <th class="text-uppercase">NAMA Kabupaten</th>
                                    <th class="text-uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>-->
<!--    <div class="row _wrapper _wrapper_indi" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Indikator</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-bordered table-hover" id="t_indi">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:10px">NO</th>
                                    <th class="text-uppercase">NAMA Indikator</th>
                                    <th class="text-uppercase"style="width:10px">Bobot</th>
                                    <th class=""style="width:10px">KELENGKAPAN</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_prov"  data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="prov"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>-->
    
<!--    <div class="row _wrapper _wrapper_item" style="display:none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title pull-left">Daftar ITEM PENILAIAN</h3>
                </div>
                <div class="card-body">
                    <div class=" p-4 text-vertical-center text-center" style="float: right;border:3px solid #e8e8e8;box-shadow: 5px 10px #b6b6b6;">
                        <p>Nilai :</p>
                        <b><span class="dropcap text-primary lbl_nilai">7.5</span></b>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <input type="hidden" id="inp_indi" value=""/>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="t_item">
                            <thead>
                                <tr>
                                    <th class=" text-vertical-center" title="No Urut" rowspan="2" style="width: 10px">NO</th>
                                    <th class="text-uppercase text-vertical-center" rowspan="2">NAMA Item</th>
                                    <th class="text-center" colspan="2">INDIKATOR PENILAIAN</th>
                                    <th class="text-center" rowspan="2" style="width:10px">SKOR</th>
                                </tr>
                                <tr>
                                    <td class="text-center table-warning"><b>0</b></td>
                                    <td class="text-center table-primary"><b>1</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-center"><b>TOTAL</b></td>
                                    <td class="text-right"><h4>0</h4></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-warning btnShwHd"  data-show="._wrapper_indi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit" data-reload="indi"><i class="fas fa-arrow-left"></i>&nbsp;Pilih Indikator</button>
                    <button type="button" class="btn btn-warning btnShwHd"  data-show="._wrapper_indi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit" data-reload="indi">&nbsp;Indikator Selanjutnya <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>-->
</div>