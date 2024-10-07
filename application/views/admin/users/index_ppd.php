<div class="container-fluid">
    <!-- start page title -->
    <div class="row" style="margin-left: -40px;">
        <div class="col-12" style="background-color: #f1f1f1; position: fixed; z-index: 98; border-bottom: 1px solid rgba(49, 126, 235, 0.3); margin-top: 5px;">
            <div class="page-title-box" style="padding: 10px 0px 0px 20px; margin: 0px;">
                <!-- <h4 class="page-title">Welcome !</h4> -->
                <div style="display: flex;">
                    <div class="card" style="color: white; border: 2px solid white; border-style: dashed; background-color: rgba(49, 126, 235, 1); margin-bottom: 15px; margin-right: 1%;">
                        <div class="card-body" style="padding: 2px 8px;">
                            <p class="mb-0">Manajemen User Sekretariat <i class="mdi mdi-numeric-1-box-outline" style="color: white;"></i></p>
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

    <div class="row _list_user" style="display: flex; margin-top: 90px;">

        <div class="col-lg-12">
            <div class="card">
                <!-- <div class="card-header"> -->
                <div class="card-header bg-success" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
                    <h2 class="card-title" style="font-size: 12px"></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" id="modal_add_show" class="btn btn-info waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;"><i class="fa fa-plus"></i> User Baru</a>
                            <div class="table-responsive isitable">
                                <!-- <table id="dataUser" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: inherit; width: 100%;">
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <td style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id</center>
                                            </td>
                                            <td style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Nama</center>
                                            </td>
                                            <td style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Email</center>
                                            </td>
                                            <td style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Group User</center>
                                            </td>
                                            <td style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Status</center>
                                            </td>
                                            <td style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Last Access</center>
                                            </td>
                                            <td style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Aksi</center>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Id</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Nama</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Email</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Group User</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Status</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Last Access</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table> -->
                                <table id="dataUser" class="table table-condensed table-bordered table-striped" style="border: 1px solid black; border-collapse: separate !important; border-spacing: 1.5px; width: 100%;">
                                    <thead style="background-color: rgb(31, 56, 100) !important; color: white;">
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Id</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Nama</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Email</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Group User</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Status</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">
                                                <center>Last Access</center>
                                            </th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black; min-width: 100px;">
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <!-- <tfoot>
                                        <tr>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Id</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Nama</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Email</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Group User</th>
                                            <th style="padding-left: 10px; padding-right: 10px; border: 1px solid black;">Status</th>
                                        </tr>
                                    </tfoot> -->
                                </table>
                            </div>
                            <div class="panel-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <div class="row _edituser" style="display: none;">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profil</h3>
                </div>
                <div class="card-body">
                    <form id="form_edit">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12 col-lg-6">
                                <div class="form-group">
                                    <label>Id User</label>
                                    <input type="hidden" class="form-control" id="iduser" name="iduser" placeholder="">
                                    <input type="text" class="form-control input-sm" id="userid" name="userid" placeholder="" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12 col-lg-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control input-sm" id="nama" name="nama" placeholder="">
                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control input-sm" id="email" name="email" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12 col-lg-6">
                                <div class="form-group">
                                    <label>Status </label>
                                    <select class="form-control" id="stts" name="stts">
                                        <option value=""> - Choose - </option>
                                        <option value="Y"> Active </option>
                                        <option value="N"> Not Active </option>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-warning btnShwHd" data-show="._list_user" data-hide="._edituser" data-hdrhide=".lbl_hdr_nmwlyh" data-reload="DUser"><i class="fas fa-arrow-left"></i>&nbsp;Kembali</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> -->


</div>

<form id="form_edit">
    <div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="card-title mt-1 mb-1" style="color: black;">Edit Data User Admin</h3>
                    <hr>
                    <!-- <p class="text-muted font-13 mb-4">Menambah data user admin sistem digital PPD</p> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">User Id</label>
                                <input type="hidden" class="form-control" id="iduser" name="iduser">
                                <input type="text" class="form-control" id="userid" name="userid" placeholder="ID User" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Status </label>
                                <select class="form-control" id="stts" name="stts">
                                    <option value=""> - Choose - </option>
                                    <option value="Y"> Active </option>
                                    <option value="N"> Not Active </option>

                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<form id="form_add">
    <div id="modal_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light" style="background: url(<?= base_url(); ?>/assets/icons/bg_modal_5.jpg) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" "="">
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: blue;">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="card-title mt-1 mb-1" style="color: black;">Tambah Data User Admin</h3>
                    <hr>
                    <!-- <p class="text-muted font-13 mb-4">Menambah data user admin sistem digital PPD</p> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">User Id</label>
                                <input type="text" class="form-control" name="code" placeholder="User Id" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama" required="" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="field-4" class="control-label">Email</label>
                                <input type="email" class="form-control" placeholder="Email" required="" name="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgb(175, 175, 175); display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-dismiss="modal" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-sm btn-success waves-effect waves-light" style="border-radius: 0px; padding-left: 10px; padding-right: 10px;"><i class="fas fa-check"></i>&nbsp;Simpan</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</form>

<form id="form_wil">
    <div id="modal_wil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Provinsi yang Akan Dinilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <div class="form-group">
                                <input type="" class="form-control" name="iduserr" placeholder=''>
                                <label>Provinsi</label>
                                <select class="form-control" name="prov">
                                    <option value=""> - Pilih - </option>
                                    <?php
                                    foreach ($list_prov->result() as $v) {
                                    ?>
                                        <option value="<?php echo encrypt_text($v->id); ?>"><?php echo $v->id_kode ?>-<?php echo $v->nama_provinsi ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button class="btn btn-info waves-effect waves-light pull-left" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>








<!--//list kabupaten-->
<div id="list_kab" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive isitable">
                            <table id="dataKab" class="table table-small-font table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="font-size: 13px">No </th>
                                        <th style="font-size: 13px">Kabupaten</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info waves-effect waves-light" id="save_popup">Simpan</button>
            </div>
        </div>
    </div>
</div>


<!--<div class="modal fade" id="modal_add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">New Data</h4>
            </div>
            <form role="form" id="form_add">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>User Id</label>
                            <input type="text" class="form-control" name="code" placeholder="">
                        </div>
                    </div>                        
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control email" name="mail" placeholder="">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="">
                        </div>
                    </div>                        
                    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                        <div class="form-group">
                            <label>Posisi </label>
                            <select class="form-control" name="group" id="select_plantadd">
                                <option value=""> - Choose - </option>
                                <?php
                                //      foreach ($list_group->result() as $v) {
                                ?>
                                <option value="<? php // echo $v->id;
                                                ?>"><?php //echo $v->name
                                                    ?></option>
                                        <?php
                                        //}
                                        ?>
                            </select>
                        </div>
                    </div>     
                </div>
                <div class="row plant_wrapper" style="display: none">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <div class="form-group">
                                <label>Mitra Kerja</label>
                                <input type="text" class="form-control" name="mitra" placeholder="" >
                            </div>
                        </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <div class="form-group">
                            <label>Petugas Di</label>
                            <select class="form-control" name="plant">
                                <option value=""> - Choose - </option>
                                <?php
                                //foreach ($list_kk->result() as $v) {
                                ?>
                                <option value="<?php //echo encrypt_text($v->id);
                                                ?>"><?php //echo $v->nama_pro
                                                    ?>-<?php //echo $v->nm_kabko
                                                        ?></option>
                                        <?php
                                        //  }
                                        ?>
                            </select>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Close</button>
              <button class="btn btn-primary pull-left" type="submit">Save changes</button>
            </div>
                </form>
        </div>  
    </div>  
</div>-->
<!--<div class="container">
    
    <div class="row list_program_wrapper">
        <div class="col-md-12">
            <div class="panel panel-border panel-primary">
                <div class="panel-heading"> 
                    <h3 class="panel-title">Daftar Petugas/ Aktivis Desa/ Kelurahan</h3> 
                </div> 
                <div class="panel-body table-rep-plugin table-responsive">
                    <table id="data" class="table table-striped table-responsive table-bordered table-hover" style="width:100%">
                        <thead>
                        <th class="text-uppercase" title="ID">Id</th>
                            <th class="text-uppercase">Nama</th>
                            <th class="text-uppercase">Posisi</th>
                            <th class="text-uppercase">Mitra Kerja</th>
                            <th class="text-uppercase">Lokasi Dampingan</th>
                            <th></th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    <p class="text-right"><small><i>* Klik untuk lihat detail</i></small></p>
                </div>
                <div class="panel-footer">
                    <a href="#" id="modal_add_show" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> New Data</a>
                    <a href="#" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Muat Ulang</a>
                </div>
            </div>
        </div>
    </div>
    
     end row 
</div>  container 

<div class="modal fade" id="modal_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit User Data</h4>
            </div>
            <form role="form" id="form_edit">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>User ID</label>
                                <input type="text" class="form-control" name="code" placeholder="" readonly="">
                                <input type="hidden" class="form-control" id="id" name="id" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
                            <div class="form-group">
                                <label>Status Active</label>
                                <select class="form-control" name="stts">
                                    <option value=""> - Choose - </option>
                                    <option value="Y"> Active </option>
                                    <option value="N"> Not Active </option>

                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="name" placeholder="">
                            </div>
                        </div>                        
                        <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
                            <div class="form-group">
                                <label>Posisi </label>
                                <select class="form-control" name="group" id="select_plantedit">
                                    <option value=""> - Choose - </option>
                                    <?php
                                    //    foreach ($list_group->result() as $v) {
                                    ?>
                                    <option value="<?php //echo $v->id;
                                                    ?>"><?php //echo $v->name
                                                        ?></option>
                                            <?php
                                            //}
                                            ?>
                                </select>
                            </div>
                        </div>       
                    </div>
                <div class="row plant_wrapper_edit" style="display: none">
                    
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <div class="form-group">
                                <label>Mitra Kerja</label>
                                <input type="text" class="form-control" name="mitra" placeholder="" >
                            </div>
                        </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <div class="form-group">
                            <label>Petugas Di</label>
                            <select class="form-control" name="plant">
                                <option value=""> - Choose - </option>
                                <?php
                                //foreach ($list_kk->result() as $v) {
                                ?>
                                <option value="<?php //echo encrypt_text($v->id);
                                                ?>"><?php //echo $v->nama_pro
                                                    ?></option>
                                        <?php
                                        //}
                                        ?>
                            </select>
                        </div>
                    </div>    
                      
                </div>
                
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Close</button>
              <button class="btn btn-primary pull-left" type="submit">Save changes</button>
            </div>
                </form>
        </div> /.modal-content 
    </div> /.modal-dialog 
</div>-->