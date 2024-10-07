<!-- start page title -->
<!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Penghargaan Pembangunan Daerah 2022 </h4>
                <div class="page-title-right"> </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->
<div class="row" style="margin-left: -25px;">
    <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
        <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
            <!-- <h4 class="page-title">Welcome !</h4> -->
            <div style="display: flex;">
                <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                    <div class="card-body" style="padding: 2px 8px;">
                        <p class="mb-0">Beranda <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
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
<!-- end page title -->

<div class="row" style="margin-top: 90px;">
    <div class="col-12">
        <!-- <div class="card-box widget-box-two widget-two-info" style="background-color: white;">
            <i class="mdi mdi-account-convert widget-two-icon" style="top: 10px; height: 75px; width: 75px; line-height: 75px;"></i>
            <div class="wigdet-two-content">
                <p style="line-height: 1.5rem;"><b>Id User</b> &nbsp;: <?php echo $this->session->userdata(SESSION_LOGIN)->userid; ?></p>
                <p style="line-height: 1.5rem;"><b>Nama</b> &nbsp;&nbsp;&nbsp;: <?php echo $this->session->userdata(SESSION_LOGIN)->name; ?></p>
            </div>
        </div> -->
        <div class="card" style="border: 1px solid rgba(49, 126, 235, 1);">
            <div class="avatar-lg bg-info rounded-circle mr-2" style="position: absolute; height: 5.5rem; width: 5.5rem; top: 15px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)">
                <!-- <i class="ion-md-information avatar-title font-26 text-white" style="font-size: 72px !important;"></i> -->
                <a href="#" class="logo text-center logo-light">
                    <span class="logo" style="line-height: 75px;">
                        <img src="<?php echo base_url("assets") ?>/images/ic_logo_ppd.png" alt="" width="50">
                    </span>
                    <!-- <span class="logo-sm">
                        <img src="<?php echo base_url("assets") ?>/images/ic_logo_ppd.png" alt="" height="50">
                    </span> -->
                </a>
            </div>
            <div class="card-header border-info bg-transparent pb-0">
                <h3 class="card-title text-info">Informasi</h3>
            </div>
            <div class="card-body">
                <div class="text-left">
                    <!-- <p class="mb-0"><b>Id User</b> &nbsp;: <?php echo $this->session->userdata(SESSION_LOGIN)->userid; ?></p> -->
                    <!-- <p class="mb-0"><b>Nama</b> &nbsp;&nbsp;&nbsp;: <?php echo $this->session->userdata(SESSION_LOGIN)->name; ?></p> -->
                    <table style="width:100%; border: 0px solid black;">
                        <tr style="border: 0px solid black;">
                            <td style="width:60px; border: 0px solid black; font-size: 14px; font-weight: bold;">Id User </td>
                            <!-- <td >:</td> -->
                            <td style=" border: 0px solid black; font-size: 14px;" name="">: &nbsp; <?php echo $this->session->userdata(SESSION_LOGIN)->userid; ?></td>
                        </tr>
                        <tr style=" border: 0px solid black">
                            <td style="width:60px; border: 0px solid black; font-size: 14px; font-weight: bold;">Nama</td>
                            <!-- <td >:</td> -->
                            <td style=" border: 0px solid black; font-size: 14px;" name="">: &nbsp; <?php echo $this->session->userdata(SESSION_LOGIN)->name; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="panel-footer"> </div>
        <!--        <div class="card-box">
            <div class="list_penilai_dok">
            
                    <table style="width:100%;">
                        <tr style="">
                          <td style="width:70px; border: 0px solid black; font-size: 14px;">Id User </td>
                          <td style="width:10px; ">:</td>
                          <td style="width:800px;"></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td style="width:70px; border: 0px solid black; font-size: 14px;">Nama</td>
                          <td>:</td>
                          <td></td>
                          <td></td>
                        </tr>
                    </table>
            </div>
        
        </div>-->
        <div class="row">
            <!-- <div class="col-12">
                <div class="card card-border">
                    <div class="card-header border-info bg-transparent pb-0">
                    </div>
                    <div class="card-body">
                        <p style='text-align: justify'>Penghargaan Pembangunan Daerah (PPD) adalah penghargaan yang diberikan oleh pemerintah pusat, dalam hal ini Kementerian Perencanaan Pembangunan Nasional/ Badan Perencanaan Pembangunan Nasional, kepada pemerintah daerah yang menunjukkan prestasi dalam perencanaan, pencapaian dan inovasi pembangunan daerah terbaik. Penghargaan ini diberikan kepada provinsi, kabupaten, dan kota.</p>
                        <span>Tujuan pelaksanaan PPD yaitu:</span>
                        <ul class="mb-0">
                                <li>Mendorong pemerintah daerah untuk menyusun dokumen perencanaan yang konsisten, komprehensif, terukur, dan dapat dilaksanakan.</li>
                                <li>Mendorong integrasi, sinkronisasi, dan sinergi antara perencanaan pusat dan daerah.</li>
                                <li>Mendorong pemerintah daerah untuk melaksanakan kegiatan secara efektif dan efisien dalam rangka pencapaian sasaran pembangunan.</li>
                                <li>Mendorong pemerintah daerah untuk berinovasi dalam perencanaan dan pelaksanaan pembangunan.</li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-md-12"> -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary py-3 text-white">
                        <div class="card-widgets">
                            <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                        </div>
                        <h5 class="card-title mb-0 text-white">Penghargaan Pembangunan Daerah</h5>
                    </div>
                    <div id="cardCollpase1" class="collapse show">
                        <div class="card-body" style='text-align: justify'>
                            <p><b>Penghargaan Pembangunan Daerah (PPD)</b> adalah penghargaan yang diberikan oleh pemerintah pusat, dalam hal ini Kementerian Perencanaan Pembangunan Nasional/ Badan Perencanaan Pembangunan Nasional, kepada pemerintah daerah yang menunjukkan prestasi dalam perencanaan, pencapaian dan inovasi pembangunan daerah terbaik. Penghargaan ini diberikan kepada provinsi, kabupaten, dan kota.</p>
                            <span>Tujuan pelaksanaan PPD yaitu:</span>
                            <ul class="mb-0">
                                <li>Mendorong pemerintah daerah untuk menyusun dokumen perencanaan yang konsisten, komprehensif, terukur, dan dapat dilaksanakan.</li>
                                <li>Mendorong integrasi, sinkronisasi, dan sinergi antara perencanaan pusat dan daerah.</li>
                                <li>Mendorong pemerintah daerah untuk melaksanakan kegiatan secara efektif dan efisien dalam rangka pencapaian sasaran pembangunan.</li>
                                <li>Mendorong pemerintah daerah untuk berinovasi dalam perencanaan dan pelaksanaan pembangunan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-purple py-3 text-white">
                        <div class="card-widgets">
                            <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                        </div>
                        <h5 class="card-title mb-0 text-white">Tutorial Penggunaan Sistem Digital PPD</h5>
                    </div>
                    <div id="cardCollpase2" class="collapse show">
                        <div class="card-body" style='text-align: justify'>
                            <div class="custom-accordion" id="accordionborder">
                                <div class="card mb-1 shadow-none border">
                                    <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapsefour" aria-expanded="true" aria-controls="customborder_collapsefour">
                                        <div class="card-header" id="customborder_headingfour">
                                            <h5 class="card-title m-0">
                                                Modul 1
                                                <i class="mdi mdi-minus-circle-outline float-right accor-minus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>

                                    <div id="customborder_collapsefour" class="collapse show" aria-labelledby="customborder_headingfour" data-parent="#accordionborder" style="">
                                        <div class="card-body">
                                            <video width="390" height="240" style="width: 100%; height: 100%;" controls>
                                                <source src="<?= base_url() ?>assets/video_tutorial_3/tpt/modul_1_tpt.mp4" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-1 shadow-none border">
                                    <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapsefive" aria-expanded="false" aria-controls="customborder_collapsefive">
                                        <div class="card-header" id="customborder_headingfive">
                                            <h5 class="card-title m-0">
                                                Bahan Dukung
                                                <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>

                                    <div id="customborder_collapsefive" class="collapse" aria-labelledby="customborder_headingfive" data-parent="#accordionborder">
                                        <div class="card-body">
                                            <video width="390" height="240" style="width: 100%; height: 100%;" controls>
                                                <source src="<?= base_url() ?>assets/video_tutorial_3/tpt/bahan_dukung_tpt.mp4" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-0 shadow-none border">
                                    <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapsesix" aria-expanded="false" aria-controls="customborder_collapsesix">
                                        <div class="card-header" id="customborder_headingsix">
                                            <h5 class="card-title m-0">
                                                Dokumen Daerah
                                                <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>

                                    <div id="customborder_collapsesix" class="collapse" aria-labelledby="customborder_headingsix" data-parent="#accordionborder" style="">
                                        <div class="card-body">
                                            <video width="390" height="240" style="width: 100%; height: 100%;" controls>
                                                <source src="<?= base_url() ?>assets/video_tutorial_3/tpt/dokumen_daerah_tpt.mp4" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-0 shadow-none border">
                                    <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapseseven" aria-expanded="false" aria-controls="customborder_collapseseven">
                                        <div class="card-header" id="customborder_headingseven">
                                            <h5 class="card-title m-0">
                                                Unduh Nilai
                                                <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>

                                    <div id="customborder_collapseseven" class="collapse" aria-labelledby="customborder_headingseven" data-parent="#accordionborder" style="">
                                        <div class="card-body">
                                            <video width="390" height="240" style="width: 100%; height: 100%;" controls>
                                                <source src="<?= base_url() ?>assets/video_tutorial_3/tpt/unduh_nilai_tpt.mp4" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-0 shadow-none border">
                                    <a href="" class="text-dark collapsed" data-toggle="collapse" data-target="#customborder_collapsetwelve" aria-expanded="false" aria-controls="customborder_collapsetwelve">
                                        <div class="card-header" id="customborder_headingtwelve">
                                            <h5 class="card-title m-0">
                                                Ubah Password
                                                <i class="mdi mdi-minus-circle-outline float-right accor-plus-icon"></i>
                                            </h5>
                                        </div>
                                    </a>

                                    <div id="customborder_collapsetwelve" class="collapse" aria-labelledby="customborder_headingtwelve" data-parent="#accordionborder" style="">
                                        <div class="card-body">
                                            <video width="390" height="240" style="width: 100%; height: 100%;" controls>
                                                <source src="<?= base_url() ?>assets/video_tutorial_3/ubah_password.mp4" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>