<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $tag_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Penilaian PPD 2022" name="description" />
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


    <!-- tag -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-217181586-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-217181586-1');
    </script>

    <style>
        html {
            /* scroll-behavior: smooth; */
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

    <style>
        .change-table-background-color {
            background-color: #E9E9E9 !important;
        }
    </style>

    <style>
        @media only screen and (max-width: 711px) {
            .stepper-navigation-modul1-tpt {
                margin-left: -10px;
            }

            .stepper-navigation-bahan-dukung-tpt {
                margin-left: -85px;
            }

            .stepper-navigation-bahan-dukung-tpt {
                margin-left: -25px;
            }

            .stepper-navigation-unduh-nilai-tpt {
                margin-left: -40px;
            }

            .stepper-navigation-unduh-nilai-tpt {
                margin-left: -40px;
            }

            .stepper-navigation-bahan-dukung-kabkota {
                margin-left: -40px;
            }
        }

        @media only screen and (min-width: 712px) {
            .stepper-navigation-modul1-tpt {
                margin-left: -10px;
            }

            .stepper-navigation-bahan-dukung-tpt {
                margin-left: -25px;
            }

            .stepper-navigation-unduh-nilai-tpt {
                margin-left: -40px;
            }

            .stepper-navigation-bahan-dukung-kabkota {
                margin-left: -40px;
            }

            .title-regional-name {
                font-size: 1rem;
            }

            .btn-unduh-bahan-dukung {
                font-size: 0.7rem;
            }

            .btn-mulai-penilaian {
                font-size: 0.7rem;
            }

            .btn-status {
                font-size: 0.7rem;
            }
        }

        @media only screen and (min-width: 1024px) {
            .title-regional-name {
                font-size: 1.25rem;
            }

            .btn-unduh-bahan-dukung {
                font-size: 0.8rem;
            }

            .btn-mulai-penilaian {
                font-size: 0.8rem;
            }

            .btn-status {
                font-size: 0.8rem;
            }
        }
    </style>

    <style>
        .highcharts-credits {
            display: none;
        }

        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }

        #dataUser_wrapper>.row {
            display: flex;
        }

        #dataUser>tbody>tr>td {
            padding-left: 10px;
            padding-right: 10px;
            border: 1px solid black;
            text-align: center;
            white-space: normal;
        }

        .nav-tabs-daerah-penilaian>.nav-item>.nav-link.active {
            border-color: black black white black !important;
        }
    </style>

    <style>
        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            border-color: black black #f5f5f5 black !important;
            background-color: transparent !important;
        }

        .tabs-grafik .nav-link.active,
        .tabs-grafik .nav-item.show .nav-link {
            border-color: black black #317eeb black !important;
            background-color: transparent !important;
        }

        .tabs-persandingan-penilaian .nav-link.active,
        .tabs-persandingan-penilaian .nav-item.show .nav-link {
            border-color: black black #317eeb black !important;
            background-color: transparent !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: white !important;
            background-color: #317eeb !important;
        }
    </style>

    <script class="js_path" src="<?php echo $js_path ?>"></script>
</head>

<body>
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

        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view($sidebar); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!--Widget-4 -->
                    <div id="content_wrapper">

                        <!-- end row -->
                        <?php
                        $this->load->view($main_content);
                        ?>
                        <!-- end row -->
                    </div>

                </div>
                <!-- end container-fluid -->

            </div>
            <!-- end content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            Copyright 2024 © <b>|Direktorat PEPPD - Kementerian PPN / Bappenas
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

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
    <form id="frmChaPass">
        <div id="modal_change_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success" style="background: url(<?php echo base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: blue;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="card-title mt-1 mb-1" style="color: black;">Ubah Password</h3>
                        <hr style="margin-bottom: 0px;" />
                        <div class="row">

                            <div class="col-12 mb-3 alert alert-info mb-0 fade show _wrapper_statement" style="border-radius: 0px;">
                                <h6 class="text-muted" style="text-align: center;">Password harus lebih dari <b style="color: #8d8d8d;">6 karakter</b>, mengandung huruf <b style="color: #8d8d8d;">BESAR</b>, huruf <b style="color: #8d8d8d;">kecil</b> dan <b style="color: #8d8d8d;">angka</b></h6>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alo">Password saat ini</label>
                                    <div class="input-group">
                                        <input name="opass" class="form-control saatini" type="password" autocomplete="off" />
                                        <button class=" btn-info input-group-text  pIni" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alo">Password baru</label>
                                    <div class="input-group">
                                        <input name="npass" class="form-control saatbaru" type="password" id="new_password" placeholder="Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka" />
                                        <button class=" btn-info input-group-text  pBaru" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alo">Ulangi Password baru </label>
                                    <div class="input-group">
                                        <input name="cpass" class="form-control saatulang" type="password" placeholder="Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka" />
                                        <button class=" btn-info input-group-text  pUlang" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;&nbsp;Simpan</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->
    </form>
    <!--CHANGE PASSWORD MODAL e-->



    <script>
        var resizefunc = [];
    </script>


    <!-- Highchart js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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



    <!--Form Wizard-->
    <!-- <script src="<?php echo base_url("assets/") ?>libs/jquery-steps/jquery.steps.min.js"></script>
        <script src="<?php echo base_url("assets/") ?>libs/jquery-validation/jquery.validate.min.js"></script> -->

    <!-- Init js-->
    <!--<script src="<?php echo base_url("assets/") ?>js/pages/form-wizard.init.js"></script>-->
    <script src="<?php echo base_url("assets/") ?>libs/dropzone/dropzone.min.js"></script>
    <!-- App js -->
    <script src="<?php echo base_url("assets/") ?>js/app.min.js"></script>

    <!-- Responsive Table js -->
    <!--        <script src="<?php echo base_url("assets/") ?>libs/rwd-table/rwd-table.js"></script>-->

    <!-- Toastr js -->
    <script src="<?php echo base_url("assets/") ?>libs/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url("assets/") ?>libs/bootbox/bootbox.all.min.js"></script>

    <script src="<?php echo base_url("assets/") ?>js/universal.js?v=<?php echo now("Asia/Jakarta") ?>"></script>
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
                // console.log(document.documentElement.scrollTop);
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

    <script>
        // $(window).scroll(function() {
        //     // console.log($(this).scrollTop());
        //     if ($(this).scrollTop() > 400) { //use `this`, not `document`
        //         $('#box-nilai-absolute').css({'display': 'none'});
        //         $('#box-nilai-fixed').css({'display': 'block'});
        //     }else if ($(this).scrollTop() == 0) {
        //         $('#box-nilai-absolute').css({'display': 'block'});
        //         $('#box-nilai-fixed').css({'display': 'none'});
        //     }else{
        //         $('#box-nilai-absolute').css({'display': 'block'});
        //         $('#box-nilai-fixed').css({'display': 'none'});
        //     }
        // });
    </script>

    <script>
        $(window).scroll(function() {
            // console.log($(this).scrollTop());
            if ($(this).scrollTop() > 300) { //use `this`, not `document`
                $('#box-nilai-absolute').css({
                    'display': 'none'
                });
                $('#box-nilai-fixed').css({
                    'display': 'block'
                });
            } else if ($(this).scrollTop() == 0) {
                $('#box-nilai-absolute').css({
                    'display': 'block'
                });
                $('#box-nilai-fixed').css({
                    'display': 'none'
                });
            } else {
                $('#box-nilai-absolute').css({
                    'display': 'block'
                });
                $('#box-nilai-fixed').css({
                    'display': 'none'
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</body>

</html>