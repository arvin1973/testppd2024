<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Kertas Kerja</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Kertas Kerja</a></li>
                        <li class="breadcrumb-item active">Kota</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row _wrapper_wlyh">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive isitable">
                                  <table id="dataUser" class="table table-small-font table-bordered table-striped" style="width:100%">                          
                                    <thead>
                                        <tr>
                                            <th style="">Id</th>
                                            <th style="">Kota</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                            <div class="panel-footer">
                                </div>
                        </div>
                    </div>
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
    <div class="row _wrapper_bahan" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Kertas Kerja</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-bordered table-hover" id="t_bahan">
                            <thead>
                                <tr>
                                    <th class="" title="No Urut" style="width:5px">NO</th>
                                    <th class="text-uppercase">Nama Penilai</th>
                                    <th class="" style="width:5px">Unduh</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>

