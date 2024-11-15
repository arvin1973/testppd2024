            <!-- <div class="left-side-menu"> -->
            <div class="left-side-menu shadow-lg bg-white rounded" style="z-index: 99; box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1rem !important;">

                <div class="slimscroll-menu">

                    <!--                        - Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="user-box" style="padding-top: 10px; padding-bottom: 0px; min-height: 0px;">
                            <h2 style="font-family: 'Montserrat', sans-serif; text-align: center; font-weight: 800;"><span style="color: #103D5D;">PPD</span><span style="color: #E75E5E;">20</span><span style="color: #FACF61;">24</span></h2>
                            <!-- <hr style="margin-top: 0px; margin-bottom: 0px;"> -->
                        </div>

                        <ul class="metismenu" id="side-menu">

                            <li class="">
                                <a href="<?php echo site_url("home") ?>" class="waves-effect">
                                    <i class="mdi mdi-home"></i>
                                    <span> Beranda </span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-account-edit-outline"></i>
                                    <span> Manajemen Pengguna</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_users_ppd") ?>">User Admin</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_users_tpt") ?>">User TPT</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_users_tpt_daerah") ?>">User TPT Daerah</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_users_tpitpu") ?>">User TPI/TPU</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_users_prov") ?>">User Tim Provinsi</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_users_kabkota") ?>">User Tim Kab/Kota</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-palette"></i>
                                    <span> Manajemen Data</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_modul_1") ?>">Modul 1</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_modul_2") ?>">Modul 2</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_modul_3") ?>">Modul 3</a></li>
                                    <!-- <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("Unavailable_page") ?>">Modul 3</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="ion ion-md-cloud-outline"></i>
                                    <span> Upload Dokumen</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_M_Bahan_dukung") ?>">Bahan Dukung dari Pusat</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_M_Bahan_dukung_daerah") ?>">Bahan Dukung dari Provinsi</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_M_Dokumen_Prov") ?>">Provinsi </a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_M_Dokumen_Kab") ?>">Kabupaten</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_M_Dokumen_Kota") ?>">Kota </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-file-table-box-multiple-outline"></i>
                                    <span> Laporan Penilaian </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false"> Penilaian TPT
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_status_penilaian_prov") ?>">Provinsi</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_status_penilaian_kab") ?>">Kabupaten</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_status_penilaian_kota") ?>">Kota</a></li>
                                            <!--                                                <li>
                                                    <a href="javascript: void(0);">Level 2.2</a>
                                                </li>-->
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false">Penilaian TPI/TPU
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li>
                                                <a href="javascript: void(0);" aria-expanded="false">Tahap II
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <ul class="nav-third-level nav" aria-expanded="false">
                                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_t2_penilaian") ?>">Provinsi</a></li>
                                                    <!--                                                        <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("Unavailable_page") ?>">Provinsi</a></li>-->
                                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_t2_penilaian_kab") ?>">Kabupaten</a></li>
                                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_t2_penilaian_kota") ?>">Kota</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);" aria-expanded="false">Tahap III
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <ul class="nav-third-level nav" aria-expanded="false">
                                                    <!--                                                        <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_status_penilaian_prov") ?>">Provinsi</a></li>-->
                                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_t3_penilaian") ?>">Provinsi</a></li>
                                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_t3_penilaian_kab") ?>">Kabupaten</a></li>
                                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_t3_penilaian_kota") ?>">Kota</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false"> Penilaian TPT Daerah
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_status_penilaian_daerah") ?>">Berdasarkan Provinsi</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_status_penilaian_kab_daerah") ?>">Kabupaten</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD1_status_penilaian_kota_daerah") ?>">Kota</a></li>
                                            <!--                                                <li>
                                                    <a href="javascript: void(0);">Level 2.2</a>
                                                </li>-->
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="waves-effect link_target" data-target="<?php echo site_url("Penilaian_Kab") ?>">
                                            <span> Penilaian Daerah </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-newspaper-variant-multiple-outline"></i>
                                    <span>Kertas Kerja</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false"> Kertas Kerja TPT Pusat
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Prov") ?>">Provinsi</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Kab") ?>">Kabupaten</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Kota") ?>">Kota</a></li>
                                            <!--                                                <li>
                                                    <a href="javascript: void(0);">Level 2.2</a>
                                                </li>-->
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false"> Kertas Kerja TPT Daerah
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_daerah") ?>">Berdasarkan Provinsi</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Kab_daerah") ?>">Kabupaten</a></li>
                                            <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Kota_daerah") ?>">Kota</a></li>
                                            <!--                                                <li>
                                                    <a href="javascript: void(0);">Level 2.2</a>
                                                </li>-->
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-newspaper-variant-multiple-outline"></i>
                                    <span> Kertas Kerja</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Prov") ?>">Provinsi</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Kab") ?>">Kabupaten</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("M_Kertaskerja_Kota") ?>">Kota</a></li>
                                </ul>
                            </li> -->

                        </ul>

                    </div>
                    <!--                         End Sidebar -->

                    <div class="clearfix"></div>
                    <div class="help-box" style="color: #98a6ad; border: 1px solid #98a6ad; border-radius: 5px; margin: 25px; padding: 10px;">
                        <h6 class="text-muted m-t-0">Butuh Bantuan ?</h6>
                        <p class="m-b-0" style="margin-bottom: 0.5rem;">
                            <span class="text-custom" style="font-size: 12px;"><b>Email </b>:</span>
                        </p>
                        <p style="font-size: 12px; line-height: 0.5;"><a href="mailto:ppd@bappenas.go.id">ppd@bappenas.go.id</a></p>
                        <p style="font-size: 12px; line-height: 0.5;"><a href="mailto:ppd2024bappenas@gmail.com">ppd2024bappenas@gmail.com</a></p>
                        <p></p>
                        <p class="m-b-0" style="margin-bottom: 0.5rem;">
                            <span class="text-custom" style="font-size: 12px;"><b>Telp </b>:</span>
                        </p>
                        <p style="font-size: 12px; line-height: 0.5; margin-bottom: 0.5rem;"><i class="fab fa-whatsapp"></i> <a href="https://wa.me/6285640970092?text=Hallo%20helpdesk%20Sistem%20Digital%20Penilaian%20PPD,%20Izin%20bertanya" target="_blank">0856 4097 0092</a> (Laily)</p>
                        <!-- <br> <a href="#" style="font-size: 12px;">0877 3871 8978</a> -->
                        <p style="font-size: 12px; line-height: 0.5; margin-bottom: 0.5rem;"><i class="fab fa-whatsapp"></i> <a href="https://wa.me/6285603050558?text=Hallo%20helpdesk%20Sistem%20Digital%20Penilaian%20PPD,%20Izin%20bertanya" target="_blank">0856 0305 0558</a> (Munawir)</p>
			<p style="font-size: 12px; line-height: 0.5; margin-bottom: 0.5rem;"><i class="fab fa-whatsapp"></i> <a href="https://wa.me/6281539297878?text=Hallo%20helpdesk%20Sistem%20Digital%20Penilaian%20PPD,%20Izin%20bertanya" target="_blank">0815 3929 7878</a> (Arvin)</p>                                              
			<p></p>
                    </div>

                </div>
                <!--                     Sidebar -left -->

            </div>