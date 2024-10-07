<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-center text-secondary" style="font-family: inherit">Laporan Penilaian TPI/TPU</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Tahap II</a></li>
                        <li class="breadcrumb-item active">Provinsi</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->

    <!-- start page title -->
    <div class="row stepper-status-penilaian-II-provinsi-tpitpu" style="margin-left: -40px;">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Laporan Penilaian Provinsi TPI/TPU Tahap II <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
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

    <div class="row _wrapper_bahan" style="display: none; margin-top: 90px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="#" id="rekap_resume_by_user" class="btn btn-secondary waves-effect waves-light my-3">Rekap Resume by User</a>
                        <input type="hidden" id="inp_wlyh" />
                        <table id="t_bahan" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                <tr>
                                    <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>No</center>
                                    </th>
                                    <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Nama Provinsi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!--                <div class="card-footer">
                    <button class="btn btn-info" id="btnShwMdlSindiAdd"><i class="fas fa-plus"></i>&nbsp;Data Baru</button>
                    <button class="btn btn-info" id="btnDownAll"><i class=" mdi mdi-zip-disk "></i>&nbsp;Unduh Semua</button>
                </div>-->
            </div>
        </div>
    </div>


    <div class="row stepper-status-penilaian-II-provinsi-tpitpu-penilaian">
        <!-- start page title -->
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px; margin-left: -28px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_bahan,.stepper-status-penilaian-II-provinsi-tpitpu" data-hide="._wrapper_info,._wrapper_penilai" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Laporan Penilaian Provinsi TPI/TPU Tahap II <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Daftar penilai <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._wrapper_bahan,.stepper-status-penilaian-II-provinsi-tpitpu" data-hide="._wrapper_info,._wrapper_penilai" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="">
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
                                <td class="text-uppercase lbl_hdr_katewlyh"></td>
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
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-primary waves-effect waves-light" id="btnDowDoc" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Unduh Semua <i class="fas fa-download" style="padding-left: 5px;"></i></button>
                    <div class="table-responsive">
                        <input type="hidden" id="inp_penilai" />
                        <table class="table table-condensed table-bordered table-striped" id="t_tpitpu" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                <tr>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>NO</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Nama Penilai</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Nama Dokumen</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Unduh Dokumen Penilaian</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Unduh Penilaian</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- <div class="card-footer">
                    <button class="btn btn-warning btnShwHd" data-show="._wrapper_bahan" data-hide="._wrapper_info,._wrapper_penilai" data-hdrhide=".lbl_hdr_nmwlyh" data-reload=""><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                    <button class="btn btn-success" id="btnDowDoc"><i class=" mdi mdi-file-download-outline "></i>&nbsp;Unduh Semua</button>
                </div> -->
            </div>
        </div>
    </div>

</div>