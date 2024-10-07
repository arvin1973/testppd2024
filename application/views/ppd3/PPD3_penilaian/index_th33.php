<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" >Tahap 3 - Dokumen Daerah</h4>
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
                                <i class="fa fa-info-circle "></i> Sebelum melakukan penilaian, silahkan mengunduh Dokumen Daerah.
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
<!--                                    <th class="text-uppercase" title="Bahan Dukung" style="width: 10px">Bahan<br/>Dukung</th>-->
<!--                                    <th class="text-uppercase" title="Kelengkapan" style="width: 10px">Kelengkapan</th>
                                    <th class="text-uppercase" title="Status" style="width: 10px">Status</th>-->
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <br/>
<!--                    <p>Keterangan</p>
                    <ul class="" style="list-style: none;padding-left: 10px">
                        <li><i class="fas fa-battery-half text-warning"></i>&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkapi data penilaian</em></li>
                        <li><i class="fas fa-exclamation-circle text-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkapi Resume Aspek</em></li>
                        <li><i class="fas fa-exclamation-circle text-pink"></i>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkapi Lembar pernyataan</em></li>
                        <li><i class="fas fa-check-circle text-success"></i>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkap</em></li>
                    </ul>-->
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_katewlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div id="mdl_doc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="card card-color mb-0">
                <div class="card-header bg-light">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="card-title mt-1 mb-0">Dokumen Daerah - Tahap 3 - <span class="lbl_jdl_wlyh"></span></h3>
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