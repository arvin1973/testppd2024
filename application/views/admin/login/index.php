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
    <!-- <style type="text/css">
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
    </style> -->
    <style type = "text/css">
        /* Google Font Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins" , sans-serif;
        }
        body{
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url("<?php echo base_url("assets/images/background_biasa_01.png") ?>") no-repeat center center fixed;
        background-size: cover;
        }
        .container{
        position: relative;
        max-width: 950px;
        width: 100%;
        background: #fff;
        padding: 40px 30px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        perspective: 2700px;
        }
        .container .cover{
        position: absolute;
        top: 0;
        left: 40%;
        height: 100%;
        width: 60%;
        z-index: 98;
        transition: all 1s ease;
        transform-origin: left;
        transform-style: preserve-3d;
        }
        .container #flip:checked ~ .cover{
        transform: rotateY(-180deg);
        }
        .container .cover .front{
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        }
        .cover .back{
        transform: rotateY(180deg);
        backface-visibility: hidden;
        }
        .container .cover::before,
        .container .cover::after{
        content: '';
        position: absolute;
        height: 100%;
        width: 10%;
        opacity: 0.5;
        z-index: 12;
        }
        .container .cover::after{
        opacity: 0.3;
        transform: rotateY(180deg);
        backface-visibility: hidden;
        }
        .container .cover img{
        position: absolute;
        height: 100%;
        width: 100%;
        object-fit: cover;
        z-index: 10;
        }
        .container .cover .text{
        position: absolute;
        z-index: 130;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        }
        .cover .text .text-1,
        .cover .text .text-2{
        font-size: 26px;
        font-weight: 600;
        color: #fff;
        text-align: center;
        }
        .cover .text .text-2{
        font-size: 15px;
        font-weight: 500;
        }
        .container .forms{
        height: 100%;
        width: 80%;
        background: #fff;
        }
        .container .form-content{
        display: flex;
        align-items: center;
        justify-content: space-between;
        }
        .form-content .login-form{
        width: calc(100% / 2 - 25px);
        }
        .forms .form-content .title{
        position: relative;
        font-size: 24px;
        font-weight: 500;
        color: #333;
        }
        .forms .form-content .title:before{
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 25px;
        background: #1acef2;
        }
        .forms .signup-form  .title:before{
        width: 20px;
        }
        .forms .form-content .input-boxes{
        margin-top: 30px;
        }
        .forms .form-content .input-box{
        display: flex;
        align-items: center;
        height: 50px;
        width: 100%;
        margin: 10px 0;
        position: relative;
        }
        .form-content .input-box input{
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        padding: 0 30px;
        font-size: 16px;
        font-weight: 500;
        border-bottom: 2px solid rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        }
        .form-content .input-box input:focus,
        .form-content .input-box input:valid{
          border-color: #1acef2;
        }
        input:invalid + span {
            color: red;
        }
        .form-content .input-box i{
        position: absolute;
        color: #1acef2;
        font-size: 17px;
        }
        .forms .form-content .text{
        font-size: 14px;
        font-weight: 500;
        color: #333;
        }
        .forms .form-content .text a{
        text-decoration: none;
        }
        .forms .form-content .text a:hover{
        text-decoration: underline;
        }
        .forms .form-content .button{
        color: #fff;
        margin-top: 40px;
        }
        .forms .form-content .button input{
        color: #fff;
        background: #1acef2;
        border-radius: 6px;
        padding: 0;
        cursor: pointer;
        transition: all 0.4s ease;
        }
        .forms .form-content .button input:hover{
        background: #1acef2;
        }
        .forms .form-content label{
        color: #1acef2;
        cursor: pointer;
        }
        .forms .form-content label:hover{
        text-decoration: underline;
        }
        .forms .form-content .login-text{
        text-align: center;
        margin-top: 25px;
        }
        .container #flip{
        display: none;
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
    <div class="cover">
      <div class="front">
        <img src="<?php echo base_url("assets/images/background_page-2024.png") ?>" alt="">
        <div class="text">
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div style="display: flex; align-items: center;">
                <img src="<?php echo base_url("assets/images/New-Logo-Kementerian-PPN-Bappenas-Horizontal.png") ?>" alt="Logo" class="" style="width:50%" />
                <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                <h3 style="font-family: 'Montserrat', sans-serif; font-weight: 800;"><span style="color: #103D5D;">PPD</span><span style="color: #E75E5E;">20</span><span style="color: #FACF61;">24</span></h3>
            </div>
          <form id="frm_login">
            <div class="input-boxes">
              <div class="input-box">
                <input type="text" name="userid" placeholder="ID Login" required>
              </div>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="input-box">
                <input type="password" name="pass" placeholder="Password" required>
              </div>
              <div id="captcha_wrapper" style="padding: 5px;border:1px solid #eee;text-align: center" title="Klik untuk refresh captcha">
                <?php echo $captcha_img; ?>
            </div>
            <div class="input-box">
              <input id="captcha" data-caption="Captcha" type="text" autocomplete="off" placeholder="Security Code" name="captcha" required />
            </div>
              <div class="button input-box">
                <input type="submit" value="Masuk">
              </div>
        </form>
        <div class="text-center">
            Copyright &copy;2020-2024
        </div>
      </div>
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