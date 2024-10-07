<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $tag_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url("assets") ?>/images/favicon_bappenas_2023.ico">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&family=Lato:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Plugins css-->
    <link href="<?php echo base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />

    <!-- Table datatable css -->
    <link href="<?php echo base_url(); ?>/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo base_url(); ?>/assets/libs/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo base_url(); ?>/assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/libs/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!--USERDEFINED-->
    <!--            <link href="<?php echo base_url(); ?>/package/css/userdefined.css" rel="stylesheet" />-->
    <!-- App css -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?php echo base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/css/app.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <!-- Notification css (Toastr) -->
    <link href="<?php echo base_url(); ?>/assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/css/userdefined.css?v=<?php echo now("Asia/Jakarta") ?>" rel="stylesheet" type="text/css" />
    <!-- <script src="<?php echo base_url("package/") ?>js/modernizr.min.js"></script> -->

    <!-- App css -->
    <!-- <link href="<?php echo base_url(); ?>/assets_zircos/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/assets_zircos/assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/assets_zircos/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/assets_zircos/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/assets_zircos/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/assets_zircos/assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/assets_zircos/assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets_zircos/plugins/switchery/switchery.min.css">

        <link href="<?php echo base_url(); ?>/assets_zircos/stylecustom.css" rel="stylesheet" type="text/css" /> -->

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Lato', sans-serif;
            /* font-family: 'Open Sans', sans-serif; */
            /* font-family: 'Poppins', sans-serif; */
            /* font-family: 'Roboto', sans-serif; */
        }

        /* #sidebar-menu > ul > li > a.active {
                color: white;
                background: #317eeb;
            } */

        a.active {
            color: black !important;
            background-color: white !important;
        }

        .mm-active>a.active {
            color: white !important;
            background: #317eeb !important;
        }

        .bold {
            color: white !important;
            background: #317eeb;
        }

        .mm-active .bold {
            color: white !important;
            background: #317eeb;
        }

        /* .enlarged #sidebar-menu > ul > li > a.active:hover {
                color: white;
                background: #317eeb;
            } */

        .enlarged .left-side-menu .help-box {
            display: none;
        }

        /* .row {
                display: grid;
            } */

        ._wrapper_item {
            display: block;
        }
    </style>

    <style>
        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: rgba(255, 99, 71, 0.3);
            color: white;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 4px;
        }

        #myBtn:hover {
            background-color: rgba(255, 99, 71, 1);
        }
    </style>

    <script class="js_path" src="<?php echo $js_path ?>"></script>
</head>

<body data-layout="horizontal">
    <div class="se-pre-con"></div>
    <div class="spinner">

        <div class="rect1"></div>

        <div class="rect2"></div>

        <div class="rect3"></div>

        <div class="rect4"></div>

        <div class="rect5"></div>

    </div>
    <input type="hidden" id="csrf" value="<?php echo $csrf["hash"] ?>" />
    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <?php $this->load->view("admin/template/header"); ?>
        <!-- end Topbar -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row" style="justify-content: center;">
                        <div class="col-12 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Ubah Password</h5>
                                </div>
                                <div class="col-md-12 alert alert-info mb-0 fade show" style="border-radius: 0px;">
                                    <h6 class="text-muted" style="text-align: center;">Password harus lebih dari <b style="color: #8d8d8d;">6 karakter</b>, mengandung huruf <b style="color: #8d8d8d;">BESAR</b>, huruf <b style="color: #8d8d8d;">kecil</b> dan <b style="color: #8d8d8d;">angka</b></h6>
                                </div>
                                <form class="form-horizontal" id="frmChaPass">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="example-text-input">User Id</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" value="<?php echo $this->session->userdata(SESSION_LOGIN)->userid; ?>" id="" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="example-text-input">Nama</label>
                                            <div class="col-9 input-group">
                                                <input type="text" class="form-control" value="<?php echo $this->session->userdata(SESSION_LOGIN)->name; ?>" id="" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="example-email">Email</label>
                                            <div class="col-9">
                                                <div class="col-12 input-group px-0">
                                                    <input type="email" id="example-email" name="nemail" class="form-control" placeholder="*email yang terdaftar harus aktif">
                                                    <!-- <p class="">*email yang terdaftar harus aktif<p class=""></p></p> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="example-password-input">Password saat ini</label>
                                            <div class="col-9">
                                                <div class="col-12 input-group px-0">
                                                    <input name="opass" class="form-control saatini" type="password" autocomplete="off" />
                                                    <button class=" btn-info input-group-text  pIni" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="example-password-input">Password baru </label>
                                            <div class="col-9">
                                                <div class="col-12 input-group px-0">
                                                    <input name="npass" class="form-control saatbaru" type="password" id="new_password" placeholder="Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil, dan angka" />
                                                    <button class=" btn-info input-group-text  pBaru" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label" for="example-password-input">Ulangi Password baru </label>
                                            <div class="col-9">
                                                <div class="col-12 input-group px-0">
                                                    <input name="cpass" class="form-control saatulang" type="password" placeholder="Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil, dan angka" />
                                                    <button class=" btn-info input-group-text  pUlang" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card-body -->
                                    <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175);">
                                        <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px; float: right;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
                                    </div>
                                </form>
                            </div>
                            <!-- card -->
                        </div>
                        <!-- col -->
                    </div>


                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!--        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Choose Demos
        </a>-->

    <!--CHANGE PASSWORD MODAL s-->
    <form>
        <div id="modal_change_password" class="modal ">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card-header bg-light" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 px-4 pb-3">
                                <h3 class="card-title mt-1 mb-3" style="color: black;">Selamat datang diaplikasi Penilaian PPD 2024, silakan aktifkan akun anda</h3>
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
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); justify-content: left;">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->
    </form>
    <!--CHANGE PASSWORD MODAL e-->



    <script>
        var resizefunc = [];
    </script>
    <!-- Vendor js -->
    <script src="<?php echo base_url("assets") ?>/js/vendor.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/moment/moment.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/jquery-scrollto/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/jquery-validation/jquery.validate.min.js"></script>
    <!-- third party js -->
    <script src="<?php echo base_url("assets") ?>/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/responsive.bootstrap4.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/buttons.bootstrap4.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/pdfmake/vfs_fonts.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/buttons.html5.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/buttons.print.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.fixedheader.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.scroller.min.js"></script>

    <script src="<?php echo base_url(); ?>/package/plugins/jquery-validation-1.15.0/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>/package/plugins/jquery-validation-1.15.0/dist/additional-methods.min.js"></script>
    <script src="<?php echo base_url(); ?>/package/plugins/jquery-validation-1.15.0/dist/localization/messages_id.min.js"></script>
    <!-- Datatables init -->
    <script src="<?php echo base_url("assets") ?>/js/pages/datatables.init.js"></script>
    <!-- Responsive Table js -->
    <script src="<?php echo base_url("assets") ?>/libs/rwd-table/rwd-table.min.js"></script>


    <!-- Init js-->

    <script src="<?php echo base_url("assets/") ?>libs/dropzone/dropzone.min.js"></script>
    <!-- App js -->
    <script src="<?php echo base_url("assets/") ?>js/app.min.js"></script>

    <!-- Responsive Table js -->
    <!--        <script src="<?php echo base_url("assets/") ?>libs/rwd-table/rwd-table.js"></script>-->

    <!-- Toastr js -->
    <script src="<?php echo base_url("assets/") ?>libs/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url("assets/") ?>libs/bootbox/bootbox.all.min.js"></script>

    <script src="<?php echo base_url("assets/") ?>js/universal_active.js?v=<?php echo now("Asia/Jakarta") ?>"></script>
    <script class="js_path" src="<?php echo $js_path ?>"></script>
    <script type="text/javascript" class="js_initial">
        <?php
        if (isset($js_init))
            echo $js_init;
        ?>
    </script>
    <script type="text/javascript">
        $(window).on('load', function() {
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>

    <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

</body>

</html>