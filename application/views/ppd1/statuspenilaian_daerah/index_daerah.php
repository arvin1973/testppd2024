<div class="container-fluid">
    <!-- start page title -->
    
    <!-- end page title -->

    <div class="row _list_prov" style="margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive isitable">
                                <table id="listProv" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id </center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Provinsi</center>
                                            </th>
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

    <div class="row _wrapper_wlyh" style="margin-top: 90px;display:none;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <a href="#" id="rekap_penilaian_daerah" class="btn btn-secondary waves-effect waves-light">Rekap Penilaian Daerah</a>
                    <a href="#" id="rekap_resume_by_user" class="btn btn-secondary waves-effect waves-light my-3">Rekap Resume by User</a>
                    <a href='#' data-pr='' id='rekapall' class='btn btn-primary waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;'>Rekap Penilaian<i class='fas fa-download' style='padding-left: 5px;'></i></a>
                    <div class="row">
                        <button type="button" class="btn btn-info waves-effect waves-light my-3 mx-3" id="export_penilaian"  data-toggle="modal" data-target=".bs-example-modal-lg">Laporan Berdasarkan Penilai</button>
                        <div class="col-12">
                            <div class="table-responsive isitable">
                                <table id="t_bahan" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Kabupaten/Kota</center>
                                            </th>
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
        <!-- <div class="col-md-12">
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
        </div> -->
        <div class="col-md-12" style="margin-top: 90px;">
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
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div id="btnDownAll"></div>
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-condensed table-bordered table-striped" id="t_bahan" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                            <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                <tr>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>No</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Nama Penilai</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Kelengkapan</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Status</center>
                                    </th>
                                    <th class="" style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                        <center>Unduh Hasil Penilaian</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- <div class="card-footer">
                    <button class="btn btn-warning btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper_bahan,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="kabko"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>

                </div> -->
            </div>
        </div>
    </div>

</div><!-- modal laporan berdasarkan penilaian -->
<!--                                     -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: blue;">×</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="#" id="rekap_penilaian_by_user" class="btn btn-secondary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;">Rekap Penilaian by User</a>
                <h3 class="card-title mt-1 mb-1" style="color: black;">List Progress Penilaian</h3>
                <br />
                <table id="tabel_progres_penilai" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                        <tr>
                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                <center>No</center>
                            </th>
                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                <center>Userid</center>
                            </th>
                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                <center>Nama</center>
                            </th>
                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                <center>Provinsi</center>
                            </th>
                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                <center>Kabupaten</center>
                            </th>
                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                <center>Persentase Penilaian</center>
                            </th>
                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                <center>Lembar Pernyataan</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>