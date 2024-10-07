<!-- <div class="container-fluid"> -->
<div class="row _wrapper _wrapper_katewlyh" style="display: block;">

    <div class="row stepper-navigation-modul1-tpt">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Wilayah Penilaian <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">Daftar Daerah <i class="mdi mdi-numeric-2-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">Daftar Indikator <i class="mdi mdi-numeric-3-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">Daftar Item <i class="mdi mdi-numeric-4-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <!-- <a href="#"><p style="padding: 5px; font-size: 0.8rem !important;"><strong><i class="mdi mdi-undo" style="color: #2ad408;"></i> Kembali</strong></p></a> -->
                </div>
                <div class="page-title-right"> </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 90px;">
        <div class="col-12">
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1); min-height: 125px;">
                <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 20px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">
                    <i class="ion-md-information avatar-title font-26 text-white" style="font-size: 72px !important;"></i>
                </div>
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info">Informasi</h3>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <p class="mb-0"><b>Penilaian</b> &nbsp;: Modul 1</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: flex;">
        <div class="col-lg-4">
            <div class="card-box" style="background-color: #fef5ec; border: 2px solid rgba(255, 152, 0, 0.5); border-radius: 5px; padding: 10px 20px 10px 20px;">
                <div class="media">
                    <div class="media-body align-self-center">
                        <div class="text-left">
                            <h2 class="mt-0 mb-2" style="font-family: 'Hind Madurai', sans-serif !important; color: #505458;"><strong>Provinsi</strong></h2>
                            <!-- <p class="mb-0 mt-1 text-truncate">Total Sales</p> -->
                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light mb-0 btnProv" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;">Detail <i class="fa fa-caret-right" style="padding-left: 5px;"></i></button>
                        </div>
                    </div>
                    <img src="<?php echo base_url(); ?>/assets/icons/provinsi.svg" alt="Provinsi" width="100" height="100">
                </div>
                <div class="mt-0" id="p_prov">
                    <p style="margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;"><b>Progress</b> : 0/0 Selesai</p>
                    <div class="progress progress-sm" style="margin-bottom: 0px;">
                        <div class="progress-bar bg-pink progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="66.6" aria-valuemin="0" aria-valuemax="100" style="width: 0.00%; background-color: #ef5350!important;">
                            <span class="sr-only">0.0% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-box" style="background-color: #fef5ec; border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 5px; padding: 10px 20px 10px 20px;">
                <div class="media">
                    <div class="media-body align-self-center">
                        <div class="text-left">
                            <h2 class="mt-0 mb-2" style="font-family: 'Hind Madurai', sans-serif !important; color: #505458;"><strong>Kabupaten</strong></h2>
                            <!-- <p class="mb-0 mt-1 text-truncate">Total Sales</p> -->
                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light mb-0 btnKab" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;">Detail <i class="fa fa-caret-right" style="padding-left: 5px;"></i></button>
                        </div>
                    </div>
                    <img src="<?php echo base_url(); ?>/assets/icons/kabupaten.svg" alt="Kabupaten" width="100" height="100">
                </div>
                <div class="mt-0" id="p_kab">
                    <p style="margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;"><b>Progress</b> : 0/0 Selesai</p>
                    <div class="progress progress-sm" style="margin-bottom: 0px;">
                        <div class="progress-bar bg-pink progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 1%; background-color: #ffd740!important;">
                            <span class="sr-only">0% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-box" style="background-color: #fef5ec; border: 2px solid rgba(141, 110, 99, 0.5); border-radius: 5px; padding: 10px 20px 10px 20px;">
                <div class="media">
                    <div class="media-body align-self-center">
                        <div class="text-left">
                            <h2 class="mt-0 mb-2" style="font-family: 'Hind Madurai', sans-serif !important; color: #505458;"><strong>Kota</strong></h2>
                            <!-- <p class="mb-0 mt-1 text-truncate">Total Sales</p> -->
                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light mb-0 btnKota" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;">Detail <i class="fa fa-caret-right" style="padding-left: 5px;"></i></button>
                        </div>
                    </div>
                    <img src="<?php echo base_url(); ?>/assets/icons/kota.svg" alt="Kota" width="100" height="100">
                </div>
                <div class="mt-0" id="p_kot">
                    <p style="margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;"><b>Progress</b> : 0/0 Selesai</p>
                    <div class="progress progress-sm" style="margin-bottom: 0px;">
                        <div class="progress-bar bg-pink progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 1%; background-color: #ffd740!important;">
                            <span class="sr-only">100% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row _wrapper _wrapper_wlyh" style="display: none">
    <div class="row stepper-navigation-modul1-tpt">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_katewlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="wilapen">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Wilayah Penilaian <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Daftar Daerah <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">Daftar Indikator <i class="mdi mdi-numeric-3-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">Daftar Item <i class="mdi mdi-numeric-4-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._wrapper_katewlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh">
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
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div style="position: fixed; background-color: #f5f5f5; z-index: 98; margin-top: 65px; padding-top: 10px; width: 100%;">
                <ul class="nav nav-tabs" role="tablist" style="border-bottom: 1px solid black !important;">
                    <li class="nav-item">
                        <a class="nav-link active" id="wilayah-penilaian-b1-tab" data-toggle="tab" href="#wilayah-penilaian-b1" role="tab" aria-controls="wilayah-penilaian-b1" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Penilaian</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wilayah-persandingan-penilaian-b1-tab" data-toggle="tab" href="#wilayah-persandingan-penilaian-b1" role="tab" aria-controls="wilayah-persandingan-penilaian-b1" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Persandingan Penilaian <span class="badge badge-secondary">New Feature</span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wilayah-kualitatif-b1-tab" data-toggle="tab" href="#wilayah-kualitatif-b1" role="tab" aria-controls="wilayah-kualitatif-b1" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Penilaian Kualitatif <span class="badge badge-secondary">New Feature</span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wilayah-grafik-b1-tab" data-toggle="tab" href="#wilayah-grafik-b1" role="tab" aria-controls="wilayah-grafik-b1" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Grafik Penilaian <span class="badge badge-secondary">New Feature</span></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" style="margin-top: 110px;">
                <div class="tab-pane show active" id="wilayah-penilaian-b1" role="tabpanel" aria-labelledby="wilayah-penilaian-b1-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-info-circle "></i> Sebelum melakukan <strong style="color: #33b86c;">penilaian</strong>, silahkan mengunduh <strong style="color: #317eeb;">bahan dukung</strong>.
                            </div>
                        </div>
                    </div>

                    <p class="text-muted font-13 mb-4">Silahkan pilih <strong><span class="lbl_katewlyh">provinsi</span></strong> yang ingin dilakukan <strong style="color: #33b86c;">penilaian</strong></p>

                    <div class="row" style="display: flex; justify-content: center;">
                        <input type="hidden" id="inp_kate_wlyh" value="" />
                        <div class="col-lg-10" id="t_wlyh">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <p>Keterangan : </p>
                        <ul class="" style="Daftar-style: none;padding-left: 10px">
                            <li><button type="button" class="btn btn-sm btn-primary waves-effect waves-light" disabled style="cursor: default; border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px;">Unduh Bahan Dukung <i class="fas fa-download" style="padding-left: 5px;"></i></button>&nbsp;&nbsp;&nbsp;-&nbsp;<em>Unduh bahan dukung</em></li>
                            <li><button type="button" class="btn btn-sm btn-success waves-effect waves-light" disabled style="cursor: default; border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px;">Mulai Penilaian <i class="fa fa-caret-right" style="padding-left: 5px;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Mulai Penilaian</em></li>
                            <li><button type="button" class="btn btn-sm btn-warning waves-effect waves-light" disabled style="cursor: default; border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px; color: white;"><i class="fas fa-exclamation"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkapi Resume Aspek</em></li>
                            <li><button type="button" class="btn btn-sm btn-warning waves-effect waves-light" disabled style="cursor: default; border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #33b86c; color: white;"><i class="fas fa-check-circle"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkapi Lembar pernyataan</em></li>
                            <li><button type="button" class="btn btn-sm btn-warning waves-effect waves-light" disabled style="cursor: default; border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6; color: white;"><i class="fas fa-check-circle"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkap</em></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane" id="wilayah-persandingan-penilaian-b1" role="tabpanel" aria-labelledby="wilayah-persandingan-penilaian-b1-tab">
                    <div class="card-box tabs-persandingan-penilaian" style="border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;">

                        <ul class="nav nav-tabs tabs-bordered nav-justified" role="tablist">
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="profile-b1" role="tabpanel" aria-labelledby="profile-b1-tab">
                                <div class="card" style="border: 1px solid rgba(49, 126, 235, 1);">
                                    <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 20px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">
                                        <i class="ion-md-information avatar-title font-26 text-white" style="font-size: 72px !important;"></i>
                                    </div>
                                    <div class="card-header border-info bg-transparent pb-0">
                                        <h3 class="card-title text-info">Informasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-left">
                                            <p class="mb-0"><b>Kriteria</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="lbl_hdr_krit">Pencapaian</span></p>
                                            <p class="mb-0"><b>Indikator 1</b> &nbsp;: <span class="lbl_hdr_indi">Pertumbuhan Ekonomi dan Pertumbuhan PDRB per Kapita</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active mb-2" id="v-pills-indikator-1-tab" data-toggle="pill" href="#v-pills-indikator-1" role="tab" aria-controls="v-pills-indikator-1" aria-selected="true">Indikator 1</a>
                                            <a class="nav-link mb-2" id="v-pills-indikator-2-tab" data-toggle="pill" href="#v-pills-indikator-2" role="tab" aria-controls="v-pills-indikator-2" aria-selected="true">Indikator 2</a>
                                            <a class="nav-link mb-2" id="v-pills-indikator-3-tab" data-toggle="pill" href="#v-pills-indikator-3" role="tab" aria-controls="v-pills-indikator-3" aria-selected="true">Indikator 3</a>
                                            <a class="nav-link mb-2" id="v-pills-indikator-4-tab" data-toggle="pill" href="#v-pills-indikator-4" role="tab" aria-controls="v-pills-indikator-4" aria-selected="true">Indikator 4</a>
                                            <a class="nav-link mb-2" id="v-pills-indikator-5-tab" data-toggle="pill" href="#v-pills-indikator-5" role="tab" aria-controls="v-pills-indikator-5" aria-selected="true">Indikator 5</a>
                                            <a class="nav-link mb-2" id="v-pills-indikator-6-tab" data-toggle="pill" href="#v-pills-indikator-6" role="tab" aria-controls="v-pills-indikator-6" aria-selected="true">Indikator 6</a>
                                            <a class="nav-link mb-2" id="v-pills-indikator-7-tab" data-toggle="pill" href="#v-pills-indikator-7" role="tab" aria-controls="v-pills-indikator-7" aria-selected="true">Indikator 7</a>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="tab-content pt-md-0">
                                            <div class="tab-pane fade show active" id="v-pills-indikator-1" role="tabpanel" aria-labelledby="v-pills-indikator-1-tab">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="bg-primary text-white">
                                                            <td rowspan="2">
                                                                <center>No</center>
                                                            </td>
                                                            <td rowspan="2">
                                                                <center>Nama Item</center>
                                                            </td>
                                                            <td colspan="2">
                                                                <center>Kategori Skor Per Item</center>
                                                            </td>
                                                            <td rowspan="2">
                                                                <center>Prov 1</center>
                                                            </td>
                                                            <td rowspan="2">
                                                                <center>Prov 2</center>
                                                            </td>
                                                            <td rowspan="2">
                                                                <center>Prov 3</center>
                                                            </td>
                                                        </tr>
                                                        <tr class="bg-primary text-white">
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="v-pills-indikator-2" role="tabpanel" aria-labelledby="v-pills-indikator-2-tab">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="bg-primary text-white">
                                                            <th rowspan='2' class='text-uppercase text-vertical-center' title='No Urut' width='5%' style='white-space: normal;'>
                                                                <center>No</center>
                                                            </th>
                                                            <th rowspan='2' class='text-uppercase text-vertical-center' width='42.5%' style='white-space: normal;'>
                                                                <center>Nama Item</center>
                                                            </th>
                                                            <th colspan='2' class='text-uppercase text-vertical-center' width='42.5%' style='white-space: normal;'>
                                                                <center>Kategori Skor Per Item</center>
                                                            </th>
                                                            <th rowspan='2' class='text-uppercase text-vertical-center' width='10%' style='white-space: normal;'>
                                                                <center>Prov 1</center>
                                                            </th>
                                                            <th rowspan='2' class='text-uppercase text-vertical-center' width='10%' style='white-space: normal;'>
                                                                <center>Prov 2</center>
                                                            </th>
                                                            <th rowspan='2' class='text-uppercase text-vertical-center' width='10%' style='white-space: normal;'>
                                                                <center>Prov 3</center>
                                                            </th>
                                                        </tr>
                                                        <tr class='bg-primary text-white'>
                                                            <th class='text-center'>
                                                                <center>0</center>
                                                            </th>
                                                            <th class='text-center'>
                                                                <center>1</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>Nama Item 1</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 0</center>
                                                            </td>
                                                            <td>
                                                                <center>Skor 1</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                            <td>
                                                                <center>0</center>
                                                            </td>
                                                            <td>
                                                                <center>1</center>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="message-b1" role="tabpanel" aria-labelledby="message-b1-tab">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                                <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                            </div>
                            <div class="tab-pane" id="setting-b1" role="tabpanel" aria-labelledby="setting-b1-tab">
                                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="wilayah-kualitatif-b1" role="tabpanel" aria-labelledby="wilayah-kualitatif-b1-tab">
                    <div class="card-box" style="border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="t_persandingan_aspek_kualitatif">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="wilayah-grafik-b1" role="tabpanel" aria-labelledby="wilayah-grafik-b1-tab">
                    <div class="card-box tab-list-aspek" style="border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<div class="row _wrapper _wrapper_kab" style="display: none">
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
</div>
<div class="row _wrapper _wrapper_indi" style="display: none">
    <div class="row stepper-navigation-modul1-tpt">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_katewlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="wilapen">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Wilayah Penilaian <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="prov">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Daftar Daerah <i class="mdi mdi-numeric-2-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Daftar Indikator <i class="mdi mdi-numeric-3-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">Daftar Item <i class="mdi mdi-numeric-4-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="prov">
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
    </div>


    <div class="row" style="margin-top: 90px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Indikator</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-0 fade show _wrapper_statement" style="display: none">
                        <h5 class="text-info"><i class="fas fa-info-circle fa-2x"></i></h5>
                        <p class="">Penilaian Indikator dan Pencatatan kesimpulan saran telah selesai.</p>
                        <div>
                            <button type="button" class="btn btn-info waves-effect waves-light mr-1" id="btnShwMdlSttmnt"><i class="fas fa-arrow-circle-right"></i>&nbsp;Isi Lembar Pernyataan </button>
                        </div>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <input type="hidden" id="inp_wlyh" />
                        <table class="table table-bordered table-hover" id="t_indi">
                            <thead>
                                <tr>
                                    <th class="text-uppercase" title="No Urut">NO</th>
                                    <th class="text-uppercase">NAMA Indikator</th>
                                    <th class="text-uppercase">Bobot</th>
                                    <th class="text-uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <!-- <button class="btn btn-warning btnShwHd"  data-show="._wrapper_wlyh"  data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh"  data-reload="prov"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row _wrapper _wrapper_item" style="display:none">
    <div class="row stepper-navigation-modul1-tpt">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_katewlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="wilapen">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Wilayah Penilaian <i class="mdi mdi-numeric-1-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_wlyh" data-hide="._wrapper,._wrapper_info" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="prov">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Daftar Daerah <i class="mdi mdi-numeric-2-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_indi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit,.lbl_hdr_aspk" data-reload="indi">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">Daftar Indikator <i class="mdi mdi-numeric-3-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Daftar Item <i class="mdi mdi-numeric-4-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <a href="#" class="btnShwHd" data-show="._wrapper_indi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit,.lbl_hdr_aspk" data-reload="indi">
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
    </div>
    <div class="row" style="margin-top: 90px; display: block;">
        <div class="col-12">
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1);">
                <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 40px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">
                    <i class="ion-md-information avatar-title font-26 text-white" style="font-size: 72px !important;"></i>
                </div>
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info">Informasi</h3>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <p class="mb-0"><b>Provinsi</b> &nbsp;&nbsp;&nbsp;: <span class="lbl_hdr_nmwlyh"></span></p>
                        <p class="mb-0"><b>Aspek</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="lbl_hdr_aspk"></span></p>
                        <p class="mb-0"><b>Kriteria</b> &nbsp;&nbsp;&nbsp;&nbsp;: <span class="lbl_hdr_krit"></span></p>
                        <p class="mb-0"><b>Indikator</b> &nbsp;: <span class="lbl_hdr_indi"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: block;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title pull-left">Daftar ITEM PENILAIAN</h3>
                </div>
                <div class="card-body">
                    <div class="row" style="display: flex; justify-content: end;">
                        <div class="col-md-10">
                            <div class="alert pb-3 pt-5 fade show t_ctt">
                                <h5 class="text-info">Catatan!</h5>
                                <p class="ctt_indi blockquote-footer"><i>- Kosong -</i></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- <div class=" p-1 text-vertical-center text-center" id="box-nilai-fixed" style="float: right; border:3px solid #e8e8e8; box-shadow: 3px 5px #b6b6b6; background-color: rgba(255, 255, 255, 0.8); position: fixed; top: 150px; right: 35px; z-index: 99; display: none;">
                                    <p style="margin-bottom: 0.1rem">Nilai :</p>
                                    <b><span class="dropcap text-primary lbl_nilai" style="font-size: 2.5rem;">7.5</span></b>
                                </div> -->
                            <!-- <div class=" p-4 text-vertical-center text-center" id="box-nilai-absolute" style="float: right;border:3px solid #e8e8e8;box-shadow: 5px 10px #b6b6b6;">
                                <p>Nilai :</p>
                                <b><span class="dropcap text-primary lbl_nilai">7.5</span></b>
                            </div> -->
                            <div class=" p-4 text-vertical-center text-center" id="box-nilai" style="float: right;border:3px solid #e8e8e8;box-shadow: 5px 10px #b6b6b6;">
                                <p>Nilai :</p>
                                <b><span class="dropcap text-primary lbl_nilai">7.5</span></b>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <br />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-info-circle "></i> - Untuk memberikan skor, silahkan Klik Indikator Penilaian pada masing-masing Item
                            </div>
                        </div>
                    </div>


                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                                <span class="d-none d-sm-block">Penilaian</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="message-tab" data-toggle="tab" href="#message" role="tab" aria-controls="message" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="mdi mdi-email-outline font-18"></i></span>
                                <span class="d-none d-sm-block span-persandingan-penilaian">Persandingan Penilaian <span class="badge badge-secondary">New Feature</span></span>
                            </a>
                        </li> -->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <input type="hidden" id="inp_indi" value="" />
                            <div class="table-responsive">
                                <table class="table table-bordered " id="t_item">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th class="text-uppercase text-vertical-center" title="No Urut" rowspan="2">
                                                <center>NO</center>
                                            </th>
                                            <th class="text-uppercase text-vertical-center" rowspan="2">
                                                <center>NAMA ITEM</center>
                                            </th>
                                            <th class="text-uppercase text-vertical-center" colspan="2">
                                                <center>KATEGORI SKOR PER ITEM</center>
                                            </th>
                                            <th class="text-uppercase text-vertical-center" rowspan="2">
                                                <center>SKOR</center>
                                            </th>
                                        </tr>
                                        <tr class="bg-primary text-white">
                                            <td class="text-center"><b>0</b></td>
                                            <td class="text-center"><b>1</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>TOTAL</b></td>
                                            <td class="text-right">
                                                <h4>0</h4>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="message" role="tabpanel" aria-labelledby="message-tab">
                            <table class="table table-bordered " id="t_item_persandingan">
                                <thead id="t_nama_item_persandingan">
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <center>1</center>
                                        </td>
                                        <td>Nama Item</td>
                                        <td>
                                            <center>1</center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
                <div class="card-footer">
                    <!-- <button type="button" class="btn btn-warning btnShwHd"  data-show="._wrapper_indi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit,.lbl_hdr_aspk" data-reload="indi"><i class="fas fa-arrow-left"></i>&nbsp;Kembali ke Daftar Indikator</button> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->


<!-- Modal -->
<form id="frm_simpul">
    <div id="mdl_simpul" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-color mb-0">
                    <div class="card-header bg-success" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <!-- <img src=" <?php echo base_url(); ?>/assets/icons/bg_modal.jpg" alt=""> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                        <!-- <h3 class="card-title mt-1 mb-0" style="color: black;">Dokumen Pendukung - <span class="lbl_jdl_wlyh"></span></h3> -->
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-1 mb-4" style="color: black;">Penilaian Kualitatif <span class="lbl_jdl_aspek">Pencapaian</span></h3>
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Keunggulan Daerah pada <span class="lbl_jdl_aspek">Pencapaian</span></label>
                                    <textarea class="form-control" name="simpul" rows="3" required="" minlength="10"></textarea>
                                    <input type="hidden" name="id" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Rekomendasi terhadap <span class="lbl_jdl_aspek">Pencapaian</span></label>
                                    <textarea class="form-control" name="saran" rows="3" required="" minlength="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="border-top: 1px solid rgb(175, 175, 175);">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; float: right;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>

<!-- Modal -->
<form id="frm_sttmnt">
    <div id="mdl_sttmnt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-color mb-0">
                    <div class="card-header bg-success" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <!-- <img src=" <?php echo base_url(); ?>/assets/icons/bg_modal.jpg" alt=""> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                        <!-- <h3 class="card-title mt-1 mb-0" style="color: black;">Dokumen Pendukung - <span class="lbl_jdl_wlyh"></span></h3> -->
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" />
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-1 mb-4" style="color: black;">Lembar Pernyataan <span id="lbl_jdl_wlyh"></span></h3>
                                <hr />
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <label for="field-1" class="control-label">Dokumen Lembar Kerja <span class="text-danger" style="font-size: 12px"> (pdf|xls|xlsx) * wajib diisi</span></label>
                                    <div class="row">
                                        <div class="d-flex">
                                            <!-- <a href="" id="btn_sttmntUnduhLink" target="_blank" title="Klik untuk unduh data" class="btn btn-xs btn-link">Unduh Dokumen Lembar Kerja <i class='fas fa-download' style='padding-left: 5px;'></i></a> -->
                                            <a href="" id="btn_sttmntUnduhLink" target="_blank" title="Klik untuk unduh data" class="btn btn-xs btn-primary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-left: 13px;">Unduh Lembar Kerja <i class='fas fa-download' style='padding-left: 5px;'></i></a>
                                            <!-- <a href="" class="btn btn-xs btn-primary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px; background-color: #EFEFEF !important; color: black; border-color: black;">Upload Ulang <i class='fas fa-sync-alt' style='padding-left: 5px;'></i></a> -->

                                            <input type="file" name="dokumen" style="margin-left: 13px;" required="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,application/pdf">
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <!-- <pre> -->
                        <div class="row">
                            <div class="col-md-12">
                                <p>Dengan ini saya menyatakan bahwa penilaian ini dilakukan secara profesional, jujur, bertanggung-jawab, dan tidak atas dasar tekanan dari pihak manapun.</p><br>
                                <p>Demikian pernyataan ini.</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-md-2 col-sm-4 offset-md-10 offset-sm-8 text-center"> -->
                            <div class="col-md-4 col-sm-6 offset-md-8 offset-sm-6 text-center">
                                <p class=""><i>Saya yang menyatakan:</i></p>
                                <br />
                                <p class="text-uppercase"><b><?php echo $username ?>.</b></p>
                            </div>
                        </div>
                        <!-- </pre> -->
                    </div>
                    <div class="card-footer" style="border-top: 1px solid rgb(175, 175, 175);">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; float: right;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>

<!-- Modal -->
<div id="mdl_doc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-color mb-0">
                <div class="card-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <!-- <img src=" <?php echo base_url(); ?>/assets/icons/bg_modal.jpg" alt=""> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: blue;">&times;</span>
                    </button>
                    <!-- <h3 class="card-title mt-1 mb-0" style="color: black;">Dokumen Pendukung - <span class="lbl_jdl_wlyh"></span></h3> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title mt-1 mb-1" style="color: black;">Bahan Dukung - <span class="lbl_jdl_wlyh"></span></h3>
                            <p class="text-muted font-13 mb-4">Silahkan unduh dokumen-dokumen dibawah sebelum melakukan penilaian</p>
                            <button class='btn btn-sm btn-primary waves-effect waves-light' id='btnDowDoc' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;'>Unduh Semua <i class='fas fa-download' style='padding-left: 5px;'></i></button>
                            <input type="hidden" id="d_wlyh" />
                            <table class="table table-condensed table-bordered table-striped " id="t_doc" style="border: 1px solid black; margin-bottom: 0px; border-collapse: inherit;">
                                <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                    <tr>
                                        <td class="text-uppercase" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>No</b></center>
                                        </td>
                                        <td class="text-uppercase" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Nama Dokumen</b></center>
                                        </td>
                                        <td class="text-uppercase" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Unduh</b></center>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="border-top: 1px solid rgb(175, 175, 175);">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->