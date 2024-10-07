<!--<div class="container-fluid">-->

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
                            <p class="mb-0" style="color: #d1d1d1;">List Daerah <i class="mdi mdi-numeric-2-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">List Indikator <i class="mdi mdi-numeric-3-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">List Item <i class="mdi mdi-numeric-4-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <!-- <a href="#"><p style="padding: 5px; font-size: 0.8rem !important;"><strong><i class="mdi mdi-undo" style="color: #2ad408;"></i> Kembali</strong></p></a> -->
                </div>
                <div class="page-title-right">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 90px;">
        <div class="col-12">
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1); min-height: 125px;">
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info">Informasi</h3>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <p class="mb-0"><b>Penilaian</b> &nbsp;: Modul 2 Wawancara dan Verifikasi</p>
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
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-box" style="background-color: #fef5ec; border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 5px; padding: 10px 20px 10px 20px;">
                <div class="media">
                    <div class="media-body align-self-center">
                        <div class="text-left">
                            <h2 class="mt-0 mb-2" style="font-family: 'Hind Madurai', sans-serif !important; color: #505458;"><strong>Kabupaten</strong></h2>
                            <button type="button" class="btn btn-sm btn-success waves-effect waves-light mb-0 btnKab" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;">Detail <i class="fa fa-caret-right" style="padding-left: 5px;"></i></button>
                        </div>
                    </div>
                    <img src="<?php echo base_url(); ?>/assets/icons/kabupaten.svg" alt="Kabupaten" width="100" height="100">
                </div>
                <div class="mt-0" id="p_kab">
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
                            <p class="mb-0">List Daerah <i class="mdi mdi-numeric-2-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">List Indikator <i class="mdi mdi-numeric-3-box" style="color: #d1d1d1;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">List Item <i class="mdi mdi-numeric-4-box" style="color: #d1d1d1;"></i></p>
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
                        <a class="nav-link active" id="penilaian-tab" data-toggle="tab" href="#penilaian" role="tab" aria-controls="penilaian" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Penilaian</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="wilayah-persandingan-penilaian-tab" data-toggle="tab" href="#wilayah-persandingan-penilaian" role="tab" aria-controls="wilayah-persandingan-penilaian" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Persandingan Penilaian <span class="badge badge-secondary">New Feature</span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="aspek-kualitatif-tab" data-toggle="tab" href="#aspek-kualitatif" role="tab" aria-controls="aspek-kualitatif" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Penilaian Kualitatif <span class="badge badge-secondary">New Feature</span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="grafik-tab" data-toggle="tab" href="#grafik" role="tab" aria-controls="grafik" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="mdi mdi-settings-outline font-18"></i></span>
                            <span class="d-none d-sm-block">Grafik Penilaian <span class="badge badge-secondary">New Feature</span></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" style="margin-top: 120px;">
                <div class="tab-pane show active" id="penilaian" role="tabpanel" aria-labelledby="penilaian-tab">
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

                    <p class="text-muted font-13 mb-4">Silahkan pilih <strong><span class="lbl_katewlyh">provinsi</span></strong> yang ingin dilakukan <strong style="color: #33b86c;">penilaian</strong>
                        di sistem atau mengunggah hasil penilaian.
                    </p>

                    <div class="row" style="display: flex; justify-content: center;">
                        <input type="hidden" id="inp_kate_wlyh" value="" />
                        <div class="col-lg-10" id="t_wlyh">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <p>Keterangan : </p>
                        <ul class="" style="list-style: none;padding-left: 10px">
                            <li><button type="button" disabled class="btn btn-sm btn-warning waves-effect waves-light" style="border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px; color: white;">Unggah Penilaian <i class="fas fa-upload" style="padding-left: 5px;"></i></button>&nbsp;&nbsp;&nbsp;-&nbsp;<em>Unggah Penilaian</em></li>
                            <!--                        <li><button type="button" class="btn btn-sm btn-primary waves-effect waves-light" style="border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px;">Unduh Bahan Dukung <i class="fas fa-download" style="padding-left: 5px;"></i></button>&nbsp;&nbsp;&nbsp;-&nbsp;<em>Unduh bahan dukung</em></li>-->
                            <li><button type="button" disabled class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px;">Mulai Penilaian <i class="fa fa-caret-right" style="padding-left: 5px;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Mulai Penilaian</em></li>
                            <li><button type="button" disabled class="btn btn-sm btn-warning waves-effect waves-light" style="border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px; color: white;"><i class="fas fa-exclamation"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkapi Resume Aspek</em></li>
                            <li><button type="button" disabled class="btn btn-sm btn-warning waves-effect waves-light" style="border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #33b86c; color: white;"><i class="fas fa-check-circle"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkapi Lembar pernyataan</em></li>
                            <li><button type="button" disabled class="btn btn-sm btn-warning waves-effect waves-light" style="border-radius: 0px; margin-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6; color: white;"><i class="fas fa-check-circle"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<em>Lengkap</em></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane" id="wilayah-persandingan-penilaian" role="tabpanel" aria-labelledby="wilayah-persandingan-penilaian-tab">
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
                <div class="tab-pane" id="aspek-kualitatif" role="tabpanel" aria-labelledby="aspek-kualitatif-tab">
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
                <div class="tab-pane" id="grafik" role="tabpanel" aria-labelledby="grafik-tab">
                    <div class="card-box tab-list-aspek" style="border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;">
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
                <h3 class="card-title">List Kabupaten</h3>
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
                                <p class="mb-0">List Daerah <i class="mdi mdi-numeric-2-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">List Indikator <i class="mdi mdi-numeric-3-box-outline" style="color: white;"></i></p>
                        </div>
                    </div>
                    <div class="card" style="color: black; border: 2px solid #d1d1d1; border-style: dashed; background-color: #f1f1f1; margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0" style="color: #d1d1d1;">List Item <i class="mdi mdi-numeric-4-box" style="color: #d1d1d1;"></i></p>
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
                    <h3 class="card-title">List Indikator</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-0 fade show _wrapper_statement" style="display: none">
                        <h5 class="text-info"><i class="fas fa-info-circle fa-2x"></i></h5>
                        <p class="">Penilaian Indikator, Pengisian Keunggulan dan Rekomendasi telah selesai.</p>
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
                                    <th class="text-uppercase">Nama Indikator</th>
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
                                <p class="mb-0">List Daerah <i class="mdi mdi-numeric-2-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: black; border: 2px solid rgba(49, 126, 235, 1); border-style: dashed; background-color: white; margin-bottom: 15px; margin-right: 1%;">
                        <a href="#" class="btnShwHd" data-show="._wrapper_indi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit,.lbl_hdr_aspk" data-reload="indi">
                            <div class="card-body" style="padding: 2px 8px;">
                                <p class="mb-0">List Indikator <i class="mdi mdi-numeric-3-box" style="color: #d1d1d1;"></i></p>
                            </div>
                        </a>
                    </div>
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">List Item <i class="mdi mdi-numeric-4-box-outline" style="color: white;"></i></p>
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
    <!-- <div class="row" style="margin-top: 90px; display: block;">
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
    </div> -->
    <div class="row" style="margin-top: 90px; display: block;">
        <div class="col-12">
            <div class="card" style="border: 1px solid rgba(49, 126, 235, 1);">
                <!-- <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 40px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">
                    <i class="ion-md-information avatar-title font-26 text-white" style="font-size: 72px !important;"></i>
                </div> -->
                <div class="card-header border-info bg-transparent pb-0">
                    <h3 class="card-title text-info"><span class="lbl_hdr_nmwlyh"></span></h3>
                </div>
                <div class="card-body" style="padding-top: 10px;">
                    <div class="row">
                        <div class="col-10">
                            <div class="text-left">
                                <h6 class="mb-0"><i class="fa fa-asterisk" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<span class="lbl_hdr_aspk"></span>&nbsp;(<span class="lbl_hdr_bobot"></span>%)</h6>
                                <p class="mb-0 mt-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="lbl_hdr_nourut"></span>.&nbsp;&nbsp;&nbsp;&nbsp;<span class="lbl_hdr_indi"></span></p>
                                <h6 class="mb-0 mt-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Bobot</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="lbl_hdr_bobotindi"></span>%</h6>
                                <!-- <div class="alert fade show t_ctt" style="padding-top: 10px; padding-bottom: 10px;">
                                    <p class="mb-0 mt-1"><span class="text-info">Catatan :</span>&nbsp;<span class="ctt_indi blockquote-footer"><i>- Kosong -</i></span></p>
                                </div> -->
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <div class="custom-accordion" id="accordionborder">
                                        <div class="card mb-1 mt-3 shadow-none border" style="background-color: #d4f0fd;">
                                            <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapsefour" aria-expanded="true" aria-controls="customborder_collapsefour">
                                                <div class="card-header" id="customborder_headingfour" style="background-color: #d4f0fd; ">
                                                    <h5 class="card-title m-0 text-info">
                                                        <i class="fa fa-info-circle "></i>
                                                        &nbsp;&nbsp;Interval nilai 0-10
                                                        <i class="mdi mdi-minus-circle-outline float-right accor-minus-icon"></i>
                                                    </h5>
                                                </div>
                                            </a>

                                            <div id="customborder_collapsefour" class="collapse show" aria-labelledby="customborder_headingfour" data-parent="#accordionborder" style="">
                                                <div class="card-body" style="padding-top: 0px;">
                                                    <p style="line-height: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>0 - 2</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Sangat Kurang</sub></p>
                                                    <p style="line-height: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>2,1 - 4</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Kurang</sub></p>
                                                    <p style="line-height: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>4,1 - 6</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Cukup</sub></p>
                                                    <p style="line-height: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>6,1 - 8</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Baik</sub></p>
                                                    <p style="line-height: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>8,1 - 10</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Sangat Baik</sub></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 t_ctt">
                                    <div class="custom-accordion" id="accordionborder">
                                        <div class="card mb-1 mt-3 shadow-none border" style="background-color: #d4f0fd;">
                                            <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapsefour" aria-expanded="true" aria-controls="customborder_collapsefour">
                                                <div class="card-header" id="customborder_headingfour" style="background-color: #d4f0fd; ">
                                                    <h5 class="card-title m-0 text-info">
                                                        Catatan :
                                                        <i class="mdi mdi-minus-circle-outline float-right accor-minus-icon"></i>
                                                    </h5>
                                                </div>
                                            </a>

                                            <div id="customborder_collapsefour" class="collapse show" aria-labelledby="customborder_headingfour" data-parent="#accordionborder" style="">
                                                <div class="card-body" style="padding-top: 0px;">
                                                    <p class="mb-0 mt-1"><span class="ctt_indi blockquote-footer"><i>- Kosong -</i></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="custom-accordion" id="accordionborder2">
                                        <div class="card mb-1 mt-3 shadow-none border" style="background-color: #d4f0fd;">
                                            <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapsefive" aria-expanded="true" aria-controls="customborder_collapsefive">
                                                <div class="card-header" id="customborder_headingfive" style="background-color: #d4f0fd; ">
                                                    <h5 class="card-title m-0 text-info">
                                                        Keterangan :
                                                        <i class="mdi mdi-minus-circle-outline float-right accor-minus-icon"></i>
                                                    </h5>
                                                </div>
                                            </a>

                                            <div id="customborder_collapsefive" class="collapse show" aria-labelledby="customborder_headingfive" data-parent="#accordionborder2" style="">
                                                <div class="card-body" style="padding-top: 0px;">
                                                    <li>
                                                        <img src="<?php echo base_url(); ?>/assets/images/kolom-angka.png" alt="Kolom Angka" width="50" height="50">
                                                        &nbsp;&nbsp;&nbsp;-&nbsp;<em>Isi/ubah angka penilaian dengan mengklik pada kolom dan tekan enter</em>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-6">
                                        <div class="alert alert-info alert-dismissible fade show mt-3">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-info-circle "></i>
                                            &nbsp;&nbsp;Interval nilai 0-10
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>0 - 2</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Sangat Kurang</sub>
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>2,1 - 4</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Kurang</sub>
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>4,1 - 6</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Cukup</sub>
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>6,1 - 8</sub>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>Baik</sub>
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sub>8,1 - 10</sub>&nbsp;&nbsp;&nbsp;&nbsp;<sub>Sangat Baik</sub>
                                        </div>
                                    </div> -->
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="text-vertical-center text-center box-nilai-indi" id="box-nilai-fixed" style="height: 125px; width: 130px; padding-left:10px; padding-bottom: 5px; float: right; border:3px solid #e8e8e8; box-shadow: 3px 5px #b6b6b6; background-color: white; position: fixed; top: 150px; right: 35px; z-index: 99; display: none;">
                                <p style="padding-right: 15px;">Nilai :</p>
                                <!-- <b><span class="dropcap text-primary lbl_nilai">7.5</span></b> -->
                                <input type="hidden" id="idindi_2" name="idindi" value="" />
                                <input type="hidden" id="nomorindi_2" name="nomorindi" value="" />
                                <input type="hidden" id="namaindi_2" name="namaindi" value="" />
                                <input type="number" class="_btnIsiIndi2" id="nilaiindi_2" name="nilaiindi" value="" placeholder="NaN" min='0' max='10' step='0.1' style="height: 55px; width: 100px; font-size: 40px; font-weight: bold; color: blue; border: transparent; text-align: center;">
                            </div>
                            <div class="text-vertical-center text-center box-nilai-indi" id="box-nilai-absolute" style="height: 125px; width: 130px; padding-left:10px; padding-bottom: 5px; float: right;border:3px solid #e8e8e8;box-shadow: 5px 10px #b6b6b6;">
                                <p style="padding-right: 15px;">Nilai :</p>
                                <!-- <b><span class="dropcap text-primary lbl_nilai">7.5</span></b> -->
                                <input type="hidden" id="idindi_1" name="idindi" value="" />
                                <input type="hidden" id="nomorindi_1" name="nomorindi" value="" />
                                <input type="hidden" id="namaindi_1" name="namaindi" value="" />
                                <input type="number" class="_btnIsiIndi" id="nilaiindi_1" name="nilaiindi" value="" placeholder="NaN" min='0' max='10' step='0.1' autofucus style="height: 55px; width: 100px; font-size: 40px; font-weight: bold; color: blue; border: transparent; text-align: center;">
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: block;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title pull-left">List ITEM PENILAIAN</h3>
                </div>
                <div class="card-body">
                    <div class="row" style="display: flex; justify-content: end;">
                        <div class="col-md-10">
                            <!-- <div class="text-left">
                                <h6 class="mb-0"><i class="fa fa-asterisk" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<span class="lbl_hdr_aspk"></span></h6>
                                <p class="mb-0 mt-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>1.</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="lbl_hdr_indi"></span></p>
                                <h6 class="mb-0 mt-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Bobot</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>3,00%</span></h6>
                            </div> -->
                            <!-- <div class="alert pb-3 pt-5 fade show t_ctt"> -->
                            <!-- <div class="alert pb-3 pt-5 fade show t_ctt">
                                <h5 class="text-info">Catatan!</h5>
                                <p class="ctt_indi blockquote-footer"><i>- Kosong -</i></p>
                            </div> -->
                        </div>
                        <!-- <button onclick="topFunction()" id="myBtn" title="Go to top" style="display: block;"><i class="fas fa-arrow-up"></i></button> -->
                        <!-- <div class="col-md-2">

                            <div class=" p-1 text-vertical-center text-center" id="box-nilai-fixed" style="float: right; border:3px solid #e8e8e8; box-shadow: 3px 5px #b6b6b6; background-color: white; position: fixed; top: 150px; right: 35px; z-index: 99; display: none;">
                                <p>Nilai :</p>
                                <b><span class="dropcap text-primary lbl_nilai">7.5</span></b>
                            </div>
                            <div class=" p-4 text-vertical-center text-center" id="box-nilai-absolute" style="float: right;border:3px solid #e8e8e8;box-shadow: 5px 10px #b6b6b6;">
                                <p>Nilai :</p>
                                <b><span class="dropcap text-primary lbl_nilai">7.5</span></b>
                            </div>

                            <div class="clearfix"></div>
                        </div> -->
                    </div>

                    <br />
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fa fa-info-circle "></i>
                                - Untuk memberikan skor, silahkan isi Indikator Penilaian pada masing-masing Item <br>
                                - Interval nilai 5.00-10.00
                                &nbsp;&nbsp;Interval nilai 0-10
                            </div> -->
                        </div>
                    </div>
                    <div class="row _wrapper_judul" style="display:none">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label t_judul" for="example-text-input">Text</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control _btnIsiJudulItem" id="yangdi" value="">
                                            <div class="alert alert-warning _wrapper_infojudul" style="display:none"><i class="fa fa-info-circle "></i> - Untuk memberikan skor, silahkan isi </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <!-- <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                                    <span class="d-none d-sm-block">Penilaian</span>
                                </a> -->
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="message-tab" data-toggle="tab" href="#message" role="tab" aria-controls="message" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-email-outline font-18"></i></span>
                                    <span class="d-none d-sm-block span-persandingan-penilaian">Persandingan penilaian Skor Item Tahap II per Daerah yang Dinilai <span class="badge badge-secondary">New Feature</span></span>
                                </a>
                            </li> -->
                        </ul>
                        <div class="tab-content pt-0">
                            <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input type="hidden" id="inp_indi" value="" />
                                <div class="table-responsive">
                                    <table class="table table-bordered " id="t_item">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <!-- <th class=" text-vertical-center" title="No Urut" rowspan="2" style="width: 10px">No</th>
                                    <th class="text-uppercase text-vertical-center" rowspan="2">Nama Item</th>
                                        <th class="text-center"  style="width:10px" colspan="2">Skor</th> -->
                                                <th class="text-uppercase text-vertical-center" title="No Urut" rowspan="2">
                                                    <center>NO</center>
                                                </th>
                                                <th class="text-uppercase text-vertical-center" title="Nama Item" rowspan="2">
                                                    <center>Poin Pendalaman</center>
                                                </th>
                                                <!-- <th class="text-uppercase text-vertical-center" title="Skor" rowspan="1">
                                                    <center>Skor</center>
                                                </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-center"><b>TOTAL</b></td>
                                                <td class="text-right">
                                                    <h4>0</h4>
                                                </td>
                                            </tr>
                                        </tfoot> -->
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
                                            <td>Poin Pedalaman</td>
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
                <div class="card-footer">
                    <!-- <button type="button" class="btn btn-warning btnShwHd"  data-show="._wrapper_indi" data-hide="._wrapper" data-hdrhide=".lbl_hdr_indi,.lbl_hdr_krit,.lbl_hdr_aspk" data-reload="indi"><i class="fas fa-arrow-left"></i>&nbsp;Kembali ke Daftar Indikator</button> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->

<!-- Modal -->
<form id="frm_tambah">
    <div id="mdl_tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="card card-color mb-0">
                    <div class="card-header bg-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="card-title text-white mt-1 mb-0">Tambah <span id="lbl_jdl_aspek">Item</span></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Nama Item <span class="text-danger"></span></label>
                                    <input class="form-control" name="itmnama" required=""></input>
                                    <input type="hidden" id="idtambah" name="idtambah" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Skor <span class="text-danger"></span></label>
                                    <input type="number" class="form-control" name="skor" required=""></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Tutup</button>

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>

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
                        <h3 class="card-title mt-1 mb-4">Penilaian Kualitatif <span id="lbl_jdl_aspek">Pencapaian</span></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Keunggulan Daerah Pada <span class="text" id="lbl_jdl_aspek"></span></label>
                                    <textarea class="form-control" name="simpul" required=""></textarea>
                                    <input type="hidden" name="id" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Rekomendasi Terhadap <span class="text" id="lbl_jdl_aspek"></span></label>
                                    <textarea class="form-control" name="saran" required=""></textarea>
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
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                    </div>

                    <div class="card-body">
                        <input type="hidden" name="id" />
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title mt-1 mb-4" style="color: black;">Lembar Pernyataan <span id="lbl_jdl_wlyh"></span></h3>
                                <hr />
                                <!--                            <div class="form-group" style="margin-bottom: 0px;">

                                <label for="field-1" class="control-label">Dokumen Lembar Kerja <span class="text-danger" style="font-size: 12px"> (pdf|xls|xlsx) * wajib diisi</span></label>
                                <div class="row">
                                    <div class="d-flex">
                                        <a href="" id="btn_sttmntUnduhLink" target="_blank" title="Klik untuk unduh data" class="btn btn-xs btn-primary waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-left: 13px;">Unduh Lembar Kerja <i class='fas fa-download' style='padding-left: 5px;'></i></a>
                                        <input type="file" name="dokumen" style="margin-left: 13px;" required="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,application/pdf">
                                    </div>
                                </div>
                            </div>-->
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
                            <h3 class="card-title mt-1 mb-1" style="color: black;">Dokumen Pendukung - <span class="lbl_jdl_wlyh"></span></h3>
                            <p class="text-muted font-13 mb-4">Silahkan unduh dokumen-dokumen dibawah sebelum melakukan penilaian</p>
                            <table class="table table-condensed table-bordered table-striped " id="t_doc" style="border: 1px solid black; margin-bottom: 0px; border-collapse: inherit;">
                                <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                    <tr>
                                        <td class="text-uppercase" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>No</b></center>
                                        </td>
                                        <td class="text-uppercase" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Judul</b></center>
                                        </td>
                                        <td class="text-uppercase" style="padding: 3px; padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                            <center><b>Tautan</b></center>
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

<!-- Modal -->
<form id="frmNilaiAdd">
    <div id="mdl_upload_nilai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-color mb-0">
                    <div class="card-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info mb-3 fade show _wrapper_nilai" style="display: none">
                            <p style="margin-bottom: 0.3rem;">Penilaian telah diunggah.</p>
                            <div class="_btn_unggah"> </div>
                            <p class="text-wrapper" style="margin-bottom: 0;">*Untuk merubah penilaian, silakan unggah kembali.</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Wilayah Penilaian<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="field-3" name="nama" placeholder="" required="" readonly="">
                                    <input type="hidden" class="form-control" id="field-3" name="id" placeholder="" required="" readonly="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">File Dokumen<span class="text-danger">*</span></label>
                                    <span class="text-info" style='font-size: 10px'>Max : 100MB</span>
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
                    <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</form><!-- /.modal -->