<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h2 class="page-title" style="font-size: 12px">Dokumen Pendukung</h2>
            <!--                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Moltran</a></li>
                                            <li class="breadcrumb-item"><a href="#">Forms</a></li>
                                            <li class="breadcrumb-item active">Form Wizard</li>
                                        </ol>
                                    </div>-->
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-lg-12 list_dok">
        <div class="card">
            <div class="card-header ">
                <p class="card-title" style="font-size: 12px"></p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive isitable">
                            <!--                                                    <p class="text-right"><small><mark><i>* Klik status penilaian untuk pengisian</i></mark></small></p>-->
                            <table id="tblPro" class="table table-small-font table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr style="background-color:#043c8f">
                                        <th style="font-size: 14px; color:#fafbfc">No</th>
                                        <th style="font-size: 14px; color:#fafbfc">Provinsi</th>
                                        <th style="font-size: 14px; color:#fafbfc">Dokumen </th>
                                        <th style="font-size: 14px; color:#fafbfc">Edit </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo $content_t;
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="panel-footer">
                            <a href="#" id="modal_add_show" class="btn btn-xs btn-primary waves-effect waves-light"><i class="fa fa-plus"></i> Upload Data</a>
                            <!--                            <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fa fa-refresh"></i> Muat Ulang</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 input_dok" style="display: none">
        <div class="card">
            <div class="card-header">
                <div class="card-body">
                    <div class="form">
                        <form role="form" id="form_add">
                            <div class="form-group row">
                                <label for="cname" class="col-form-label col-lg-2">Provinsi </label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="select_prov" id="select_prov">
                                        <option value=""> - Pilih - </option>
                                        <?php
                                        foreach ($list_prov->result() as $p) {
                                        ?>
                                            <option value="<?php echo $p->id; ?>"><?php echo $p->nama_provinsi ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cname" class="col-form-label col-lg-2">Dokumen </label>
                                <div class="col-lg-4">
                                    <input type="file" name="attch" height="48" />
                                </div>
                            </div>




                            <div class="form-group row mb-0">
                                <div class="offset-lg-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Uoload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- .form -->
                </div>
                <!-- card-body -->




            </div>
            <!-- card -->
        </div>
        <!-- col -->

    </div>
</div>
<!--                        
 <div class="container">-->
<!--  <iframe class="responsive-iframe" src="http://localhost/ppdbappenas/attachments/"></iframe>-->