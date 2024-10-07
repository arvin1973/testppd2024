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

    <!-- Plugins css-->
    <link href="<?php echo base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/libs/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />

    <!-- Table datatable css -->
    <link href="<?php echo base_url(); ?>/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/libs/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
    <!--<script src="<?php echo base_url("package/") ?>js/modernizr.min.js"></script>-->


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
                            Copyright 2020 © <b>|Direktorat PEPPD - Kementerian PPN / Bappenas
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


    <!-- Right Sidebar -->
    <!--        <div class="right-bar _rightbar" id="rightbar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-17 m-0 text-white">T</h4>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-4">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, layout, etc.
                    </div>
                   

                    <a href="https://bit.ly/2QMLoUn" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-download mr-1"></i> Download Now</a>
                </div>
            </div>  end slimscroll-menu
        </div>-->
    <!-- /Right-bar -->

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
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12 alert alert-info mb-0 fade show _wrapper_statement" style="">
                                <h5 class="text-info">
                                    <h6>Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka</h6>
                                    <p class=""></p>
                                </h5>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="alo">Password saat ini</label>
                                    <div class="input-group">
                                        <input name="opass" class="form-control saatini" type="password" autocomplete="off" />
                                        <div class="input-group-append">
                                            <button class=" btn-info input-group-text  pIni" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="alo">Password baru</label>
                                    <div class="input-group">
                                        <input name="npass" class="form-control saatbaru" type="password" id="new_password" placeholder="Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka" />
                                        <div class="input-group-append">
                                            <button class=" btn-info input-group-text  pBaru" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="alo">Ulangi Password baru </label>
                                    <div class="input-group">
                                        <input name="cpass" class="form-control saatulang" type="password" placeholder="Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka" />
                                        <div class="input-group-append">
                                            <button class=" btn-info input-group-text  pUlang" type="button"><i class="mdi mdi-eye-minus-outline"></i></button>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Batal</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i>&nbsp;Simpan</button>
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

    <!--Form Wizard-->
    <!--        <script src="<?php echo base_url("assets/") ?>libs/jquery-steps/jquery.steps.min.js"></script>
        <script src="<?php echo base_url("assets/") ?>libs/jquery-validation/jquery.validate.min.js"></script>-->

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

</body>

</html>