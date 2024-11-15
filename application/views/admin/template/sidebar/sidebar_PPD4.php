            <div class="left-side-menu shadow-lg bg-white rounded" style="box-shadow: 0 0 1rem rgb(0 0 0 / 10%) !important; z-index: 99;">

                <div class="slimscroll-menu">

                    <!--                        - Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="user-box" style="padding-top: 10px; padding-bottom: 0px; min-height: 0px;">
                            <h2 style="font-family: 'Montserrat', sans-serif; text-align: center; font-weight: 800;"><span style="color: #103D5D;">PPD</span><span style="color: #E75E5E;">20</span><span style="color: #FACF61;">24</span></h2>
                            <hr style="margin-top: 0px; margin-bottom: 0px;">
                        </div>

                        <ul class="metismenu" id="side-menu">

                            <li class="active">
                                <a href="" <?php echo site_url("home") ?>" class="waves-effect">
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
                                    <!--                                        <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_users_prov") ?>">User Provinsi</a></li>-->
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_users_kabkota") ?>">User Kab/Kota</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_users_tpt_daerah") ?>">User TPT Daerah</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="ion ion-md-cloud-outline"></i>
                                    <span> Upload Dokumen</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Dokumen_Prov") ?>">Provinsi </a></li>
                                    <!-- <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("Unavailable_page") ?>">Provinsi </a></li> -->
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Dokumen_Kab") ?>">Kabupaten </a></li>
                                    <!-- <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("Unavailable_page") ?>">Kabupaten </a></li> -->
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Dokumen_Kota") ?>">Kota</a></li>
                                    <!-- <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("Unavailable_page") ?>">Kota</a></li> -->
                                    <!--                                        <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Dokumen_Prov_D") ?>">Provinsi</a></li>
                                        <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Dokumen_Prov_Kab") ?>">Kabupaten</a></li>
                                        <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Dokumen_Prov_Kot") ?>">Kota</a></li>-->
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-file-table-box-multiple-outline"></i>
                                    <span>Laporan Penilaian</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_status_penilaian_daerah") ?>">Rekap Penilaian</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_status_penilaian_kab_daerah") ?>">Kabupaten </a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_status_penilaian_kota_daerah") ?>">Kota</a></li>
                                 </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="mdi mdi-newspaper-variant-multiple-outline"></i>
                                    <span>Kertas Kerja</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Kertaskerja_Kab_daerah") ?>">Kabupaten </a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Kertaskerja_Kota_daerah") ?>">Kota</a></li>
                                 </ul>
                            </li>

                            <li>
                                <a href="#" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_M_Penilaian_Prov_Daerah") ?>">
                                    <i class=" mdi  mdi ion ion-ios-log-in "></i>
                                    <span>Upload Hasil Penilaian </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="waves-effect link_target" data-target="<?php echo site_url("PPD4_dokumen") ?>">
                                    <i class="mdi mdi-pencil-box-multiple-outline"></i>
                                    <span>Bahan Dukung </span>
                                </a>
                            </li>

                        </ul>

                    </div>
                    <!--                         End Sidebar -->

                    <div class="clearfix"></div>

                    <div class="help-box" style="color: #98a6ad; border: 1px solid #98a6ad; border-radius: 5px; margin: 25px; padding: 10px;">
                        <h6 class="text-muted m-t-0">Butuh Bantuan ?</h6>
                        <p class="m-b-0" style="margin-bottom: 0.5rem;">
                            <span class="text-custom" style="font-size: 12px;"><b>Email </b>:</span>
                        <p style="font-size: 12px; line-height: 0.5;"><a href="mailto:ppd@bappenas.go.id">ppd@bappenas.go.id</a></p>
                        <p style="font-size: 12px; line-height: 0.5;"><a href="mailto:ppd2024bappenas@gmail.com">ppd2024bappenas@gmail.com</a></p>
                        </p>
                        <p class="m-b-0" style="margin-bottom: 0.5rem;">
                            <span class="text-custom" style="font-size: 12px;"><b>Telp </b>:</span>
                        <p style="font-size: 12px; line-height: 0.5; margin-bottom: 0.5rem;"><i class="fab fa-whatsapp"></i> <a href="https://wa.me/6285640970092?text=Hallo%20helpdesk%20Sistem%20Digital%20Penilaian%20PPD,%20Izin%20bertanya" target="_blank">0856 4097 0092</a> (Laily)</p>
                        <!-- <br> <a href="#" style="font-size: 12px;">0877 3871 8978</a> -->
                        <p style="font-size: 12px; line-height: 0.5; margin-bottom: 0.5rem;"><i class="fab fa-whatsapp"></i> <a href="https://wa.me/6285603050558?text=Hallo%20helpdesk%20Sistem%20Digital%20Penilaian%20PPD,%20Izin%20bertanya" target="_blank">0856 0305 0558</a> (Munawir)</p>
                        <p style="font-size: 12px; line-height: 0.5; margin-bottom: 0.5rem;"><i class="fab fa-whatsapp"></i> <a href="https://wa.me/6281539297878?text=Hallo%20helpdesk%20Sistem%20Digital%20Penilaian%20PPD,%20Izin%20bertanya" target="_blank">0815 3929 7878</a> (Arvin)</p>                                              
			</p>
                    </div>

                </div>
                <!--                     Sidebar -left -->

            </div>