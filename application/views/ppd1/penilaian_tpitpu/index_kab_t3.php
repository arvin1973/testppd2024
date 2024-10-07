<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Laporan Penilaian TPI/TPU</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Tahap III</a></li>
                        <li class="breadcrumb-item active">Kabupaten</li>
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
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-bordered table-hover" id="t_bahan">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:5px">No</th>
                                    <th class="text">Nama Kabupaten</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

<!--    -->
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
                                <td class="lbl_hdr_nmwlyh"></td>
                                <td  class="text-uppercase lbl_hdr_katewlyh"></td>
                                <td></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row _wrapper_penilai" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List penilaian</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_penilai" />
                        <table class="table table-bordered table-hover" id="t_tpitpu">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:5px">NO</th>
                                    <th class="text-secondary">Nama Penilai</th>
                                    <th class="text-secondary">Nama Dokumen</th>
                                    <th class="text-center">Unduh<br> Dokumen Penilaian</th>
                                    <th class="" style="width:5px">Unduh Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_bahan"  data-hide="._wrapper_info,._wrapper_penilai" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload=""><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                    <button class="btn btn-success" id="btnDowDoc"><i class=" mdi mdi-file-download-outline "></i>&nbsp;Unduh Semua</button>
                </div>
            </div>
        </div>
    </div>
    
</div>
