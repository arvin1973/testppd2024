<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">


        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <div style="display: inline-flex;">
                    <p style="margin-right: 5px; color: white;"><?php echo $this->session->userdata(SESSION_LOGIN)->name; ?></p>
                    <img src="<?php echo base_url("assets") ?>/images/users/images1.png" alt="user-image" class="rounded-circle">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0"></h6>
                </div>

                <a href="javascript:void(0)" class="dropdown-item notify-item btn_change_password"><i class="fa fa-lock"></i> Change Password</a>
                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="<?php echo site_url("Welcome/logout") ?>" class="dropdown-item notify-item btn_logout"><i class="md md-settings-power"></i> Logout</a>
            </div>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">


        <a href="" class="logo text-center logo-light">
            <span class="logo-lg">
                <!-- <img src="<?php echo base_url("assets") ?>/images/Logo_Bappenas_White-03.png" alt="" height="50"> -->
                <img src="<?php echo base_url("assets") ?>/images/New-Logo-Kementerian-PPN-Bappenas-Horizontal-Hitam-Putih.png" alt="" height="50">
                <!-- <img src="<?php echo base_url("assets") ?>/images/ppd_2021_03.png" alt="" height="50">
                                <span class="logo-lg-text-dark">hhhhhh</span> -->
            </span>
        </a>
    </div>

    <!-- LOGO -->


    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

        <li class="d-none d-sm-block">
        </li>
    </ul>
</div>