<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Penilaian PPD 2023">
    <meta name="author" content="">

    <link rel="shortcut icon" href="<?php echo base_url("assets") ?>/images/favicon_bappenas_2023.ico">

    <title><?php echo $page_title ?></title>

    <!-- Base Css Files -->
    <link href="<?php echo base_url("package") ?>/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="<?php echo base_url("package") ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("package") ?>/plugins/ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("package") ?>/css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="<?php echo base_url("package") ?>/css/animate.css" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="<?php echo base_url("package") ?>/css/waves-effect.css" rel="stylesheet">

    <link href="<?php echo base_url("package") ?>/plugins/sweetalert/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom Files -->
    <link href="<?php echo base_url("package") ?>/css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("package") ?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/package/css/userdefined.css" rel="stylesheet" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-217181586-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-217181586-1');
    </script>

    <script src="<?php echo base_url("package") ?>/js/modernizr.min.js"></script>
    <style type="text/css">
        body {
            background: url("<?php echo base_url("assets/images/background_biasa_01.png") ?>") no-repeat center center fixed;
            background-size: cover;
            /*                  Full height 
  height: 100%;*/
            /*            background-repeat: no-repeat;*/
            /*            background-position: center;*/
            background-repeat: no-repeat;
            background-size: cover;
            /*            background-size: 800px 500px;*/
            /*            background-position: center;*/

        }
    </style>
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
    <br />
    <br />
    <br />
    <br />

    <div class="container">
        <div class="row">


            <div class="col-lg-4 col-md-offset-2" style="padding-right: 0px;">
                <div class="wrapper-page" style="margin-top: 0px; margin-right: 0px;">

                    <div class="panel panel-color panel-primary " style="box-shadow: 2px 5px 8px #888888;">
                        <!-- <div class="panel-heading">
                            </div> -->
                        <div class="panel-body">
                            <div style="display: flex; align-items: center;">
                                <img src="<?php echo base_url("assets/images/New-Logo-Kementerian-PPN-Bappenas-Horizontal.png") ?>" alt="Logo" class="" style="width:50%" />
                                <h3 style="font-family: 'Montserrat', sans-serif; font-weight: 800;"><span style="color: #103D5D;">PPD</span><span style="color: #E75E5E;">20</span><span style="color: #FACF61;">24</span></h3>
                            </div>
                            <div class="row loginbox" style="width: 85%;margin: 10px auto;  ">
                                <form class="form-horizontal m-t-20" id="frm_login">
                                    <div class="form-group input_wrapper">
                                        <input class="form-control " autocomplete="off" type="text" name="userid" placeholder="ID Login">
                                    </div>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                    <div class="form-group input_wrapper">
                                        <input class="form-control " type="password" name="pass" placeholder="Password">
                                    </div>
                                    <div class="form-group input_wrapper " style="margin-top: 5px">
                                        <div id="captcha_wrapper" style="padding: 5px;border:1px solid #eee;text-align: center" title="Klik untuk refresh captcha">
                                            <?php echo $captcha_img; ?>
                                        </div>
                                        <input id="captcha" data-caption="Captcha" n class="form-control input-xs" type="text" autocomplete="off" placeholder="Security Code" name="captcha" />
                                    </div>
                                    <div class="form-group text-center m-t-40">
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary btn-lg btn-block waves-effect waves-light" type="submit"><i class="fa fa-sign-in"></i> Masuk</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            Copyright &copy;2020-2024
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4" style="padding-left: 0px;">
                <img src="<?php echo base_url("assets/images/background_page-2024.png") ?>" alt="Logo" class="" style="margin: 0px ; width:100%" />
            </div>

        </div>
    </div>



    <script>
        var resizefunc = [];
    </script>
    <script src="<?php echo base_url("package") ?>/js/jquery.min.js"></script>
    <script src="<?php echo base_url("package") ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("package") ?>/js/waves.js"></script>
    <script src="<?php echo base_url("package") ?>/js/wow.min.js"></script>
    <script src="<?php echo base_url("package") ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url("package") ?>/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url("package") ?>/plugins/jquery-detectmobile/detect.js"></script>
    <script src="<?php echo base_url("package") ?>/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url("package") ?>/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url("package") ?>/plugins/jquery-blockui/jquery.blockUI.js"></script>
    <script src="<?php echo base_url("package") ?>/plugins/jquery-validation-1.15.0/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url("package") ?>/plugins/sweetalert/dist/sweetalert2.all.min.js"></script>


    <!-- CUSTOM JS -->
    <script src="<?php echo base_url("assets") ?>/js/universal.js?v=" <?php now("Asia/Jakarta") ?>></script>
    <script src="<?php echo base_url("assets") ?>/js/admin/login/login.js"></script>
    <script type="text/javascript">
        <?php
        if (isset($js_initial))
            echo $js_initial;
        ?>
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
</body>

</html>