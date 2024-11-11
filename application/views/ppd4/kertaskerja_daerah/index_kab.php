<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit" >Kertas Kerja TPT Daerah</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Kertas Kerja</a></li>
                        <li class="breadcrumb-item active">Kabupaten</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->

    <!-- start page title -->
    <div class="row stepper-kertas-kerta-tpt-daerah" style="margin-left: -40px;">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Kertas Kerja Kabupaten TPT Daerah <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                </div>
                <div class="page-title-right">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- <div class="row _wrapper_wlyh"> -->
    <div class="row _wrapper_wlyh" style="margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive isitable">
                                  <table id="dataUser" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">                          
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;"><center>Id</center></th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;"><center>Kabupaten</center></th>
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


    <div class="row stepper-kertas-kerja-tpt-daerah-list-penilai" style="display: none;">
        <!-- start page title -->
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px; margin-left: -28px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_wlyh,.stepper-status-penilaian-provinsi-tpt" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="kabko">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Kertas Kerja Kabupaten TPT Daerah <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Daftar penilai <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._wrapper_wlyh"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="kabko">
                        <p style="padding: 5px; font-size: 0.8rem !important;"><strong><i class="mdi mdi-undo" style="color: #2ad408;"></i> Kembali</strong></p>
                    </a>
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
        <!-- end page title -->
    </div>
    
    <div class="row _wrapper_info" style="display: none; margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1); height: 150px;">
                <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 35px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">

                    <a href="#" class="logo text-center logo-light">
                        <span class="logo" style="line-height: 75px;">
                            <img src="https://peppd.bappenas.go.id/ppd2022/assets/images/ic_logo_ppd.png" alt="" width="50">
                        </span>
                    </a>

                </div>
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info">Informasi</h3>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <table style="width:100%; border: 0px solid black">
                            <tbody>
                                <tr style="border: 0px solid black">
                                    <td class="text-uppercase lbl_hdr_nmwlyh"></td>
                                    <td>:</td>
                                    <td class="text-uppercase lbl_hdr_katewlyh"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row _wrapper_bahan" style="display: none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                </div>
                <h2 class="card-title ml-4 mt-3">List Kertas Kerja Penilai</h2>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-condensed table-bordered table-striped" id="t_bahan" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                <tr>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;" title="No Urut">NO</th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Nama Penilai</th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Unduh</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <!-- <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh"  data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button> -->
                    
                </div>
            </div>
        </div>
    </div>
</div>

