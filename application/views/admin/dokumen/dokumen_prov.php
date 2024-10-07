<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $page_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Penilaian PPD 2023" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url("assets") ?>/images/logo_bappenas.png">

    <!-- Google Font -->
    <!--        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&family=Lato:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        -->
    <!-- Table datatable css -->
    <link href="<?php echo base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/libs/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/libs/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />


    <!-- App css -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?php echo base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/css/app.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <!-- Notification css (Toastr) -->
    <link href="<?php echo base_url(); ?>/assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/css/userdefined.css?v=<?php echo now("Asia/Jakarta") ?>" rel="stylesheet" type="text/css" />
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



    <script class="js_path" src=""></script>
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
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Penghargaan Pembangunan Daerah 2024 </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                            </ol>
                        </div>
                        <div class="clearfix">

                        </div>
                    </div>

                </div>
            </div>
        </header>


        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page" id="app">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!--Widget-4 -->
                    <div id="content_wrapper">
                        <div class="embed-responsive embed-responsive-1by1">
                            <iframe class="embed-responsive-item" src="<?php echo $msg; ?>"></iframe>
                        </div>
                        <!-- end row -->

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
                            Copyright 2023 © <b>|Direktorat PEPPD - Kementerian PPN / Bappenas
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
    <!--        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.learningaboutelectronics.com/Articles/NP-modernization-act-new-york-state.doc' width='80%' height='565px' frameborder='0'> 
        </iframe>-->
    <!--                <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=https://fransalamonda.com/peppd/doc/data.xls&embedded=true'  frameborder='0'> 
        </iframe>-->

    <!-- END wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- Vendor js -->
    <script src="<?php echo base_url("assets") ?>/js/vendor.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/responsive.bootstrap4.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/buttons.bootstrap4.min.js"></script>

    <!--        <script src="<?php echo base_url("assets") ?>/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url("assets") ?>/libs/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo base_url("assets") ?>/libs/pdfmake/vfs_fonts.js"></script>-->

    <script src="<?php echo base_url("assets") ?>/libs/datatables/buttons.html5.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/buttons.print.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/libs/datatables/dataTables.scroller.min.js"></script>




    <script type="text/javascript">
        $(window).on('load', function() {
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>



</body>

</html>