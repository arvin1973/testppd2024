    var main = function(){
        controller = "index.php/Module_1_PPD2";
        var datatable = function(){
            var table = $("#tblPro");
            var datatable_p = table.DataTable({
                   "processing": true,
                   "serverSide": true,
                   "ajax":{
                       url :base_url+controller+"/get_datatable", // json datasource
                       type: "post",  // method  , by default get
                       error: function(){  // error handling
                               $(".employee-grid-error").html("");
                               $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                               $("#employee-grid_processing").css("display","none");
                       },
                       data: function(d){
                       },
                       "dataSrc": function ( json ) {
                           //$("#ttl_qty").val(json.ttl_qty);
                           return json.data;
                       }

                   },
                   "columnDefs": [                  
                        { "width": "2px", "targets": 0},
                        { "targets": 3, "orderable": false },
                        { "width": "390px", "targets": 1},
                       { "width": "140px", "targets": 2}
  //                     { "width": "10px", "targets": 4}
                   ],
                   "lengthMenu": [[5, 20, 25, 50, -1], [5, 20, 25, 50, "All"]],
                   "initComplete": function(settings, json) {
                    //console.log(settings);
                   },
                   paging: true,
                   "language": {
                       "sProcessing":   "Sedang memproses...",
                       "sLengthMenu":   "Tampilkan _MENU_ entri",
                  "sZeroRecords":  "Tidak ada data",
                  "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                  "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
                  "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                  "sInfoPostFix":  "",
                  "sSearch":       "Cari:",
                  "sUrl":          "",
                  "oPaginate": {
                      "sFirst":    "Pertama",
                      "sPrevious": "Sebelumnya",
                      "sNext":     "Selanjutnya",
                      "sLast":     "Terakhir"
                  }
              }
              });
            
            $(".btnProv").click(function(e){
                e.preventDefault();
                $('.list_provinsi').hide();
               $('.list_penilai').hide();
               $('.module_1').hide();
               $('.mdlNilai').hide();
               $('.list_btn').hide();
               $('.list_provinsi').show();
          }); 
            
            var table1 = $("#tblPro");
            table1.on('click', 'a.edit', function(e){
                e.preventDefault();
                    //$("#customborder_collapse5").attr('disabled','disabled');
                var id      = $(this).data("id");
                var msg_obj = $("#msg");
                ajax_url = controller+"/detail_get";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
                $("#iddaerah").val(id);
                $("#idwilayah").val(id);
                $("#provid").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_provinsi').hide();
                                $('.list_penilai').show();
                                $('.module_1').show();
                                $('form#form_pd td[name="inputnp"]').html(obj.profile);
                                $('form#form_pd td[name="inputddn"]').html(obj.data[0].nama_provinsi);

                                $('div#kp input[name="kp_user"]').val(obj.profile);
                                $('div#kp input[name="kp_daerah"]').val(obj.data[0].nama_provinsi);

                                $('.table_pencapaian').html(obj.tbl_pencapaian);
                                $('.table_keterkaitan').html(obj.tbl_keterkaitan);
                                $('.table_konsistensi').html(obj.tbl_konsistensi);
                                $('.table_kk').html(obj.tbl_kk);
                                $('.table_inovasi').html(obj.tbl_inovasi);
                                
                                $('div#nmp li[name="profil"]').html(obj.profile2);
                                $('div#nmp td[name="daerah"]').html(obj.data[0].nama_provinsi);
                                
                                $('div#info_k li[name="profil"]').html(obj.profile2);
                                $('div#info_k td[name="daerah"]').html(obj.data[0].nama_provinsi);
                                $('.pencapaian_ttl_prov').html(obj.pencapaian);
                                $('.keterkaitan_ttl_prov').html(obj.keterkaitan);
                                $('.konsistensi_ttl_prov').html(obj.konsistensi);
                                $('.kelengkapan_ttl_prov').html(obj.kelengkapan);
                                $('.inovasi_ttl_prov').html(obj.inovasi);
                                if(obj.pernyataan=='1' )
                                    $('#pop_berkas_prov').modal('show');
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });        
            });
            
            table1.on('click', 'a.download', function(e){
                e.preventDefault();
                    //$("#customborder_collapse5").attr('disabled','disabled');
                var id      = $(this).data("id");
               // alert(id);
                var msg_obj = $("#msg");
                ajax_url = controller+"/Download_excel";
                window.open(base_url+controller+"/Download_excel?wl="+id+"&in="+$("#inp_in").val());

            });

            table1.on('click', 'a.doku', function(e){
                e.preventDefault();
                    //$("#customborder_collapse5").attr('disabled','disabled');
                var id      = $(this).data("id");
                var msg_obj = $("#msg");
                ajax_url = controller+"/detail_dok";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.tr_dokumen').html(obj.tbl_dok);
                                $('#modal_dok').modal();
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });   


            });      

            $(".btnBack").click(function(e){
                e.preventDefault();
                //form_ch[0].reset();
                $('.list_provinsi').show();
                $('.list_penilai').hide();
                $('.module_1').hide();
                $('.mdlNilai').hide();
                datatable_p.ajax.reload();
            }); 
        
            $(".btnKembali").click(function(e){
                e.preventDefault();
                $('.kp_1').show();
                $('.kp_2').hide();
                $('#mdlNilai').hide();
                $('.list_penilai_dok').show();
            });
            var table2 = $("#tblNilai");
            table2.on('click', 'a.klikskor', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var daerah = $("#idaerah").val();
                var indkno = $(this).data("nomor");
                var nilai = $(this).data("nilai");
                var idin = $(this).data("idin");
               // alert(nilai);
                var msg_obj = $("#msg");
                ajax_url = controller+"/pilih_skor";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#iddaerah").val()+"&indkno="+indkno+"&nilai="+nilai+"&idin="+idin;
                loading.show();
                //$("#idaerah").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.table_ktg_skor').html(obj.table_ktg_skor);
                                $('div#nmp label[name="total"]').html(obj.nilai);
                                //$(".total").val();
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
        
            //kriteria Provinsi
            var tbl_kp = $("#tbl_kp");
            tbl_kp.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idwilayah").val();
                $('div#info_k td[name="ni"]').html(indkno);
                $('div#info_k td[name="bbt"]').html(indkbbt);
                $('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_d";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idwilayah").val();
                //alert(ajax_data);
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_btn').hide();
                                $('.list_penilai_dok').hide();
                                $('.module_1').hide();
                                $('.list_detai_kreteria').show();
                                $('.table_ktg_skor').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_k label[name="total"]').html(obj.total);
                                $('div#info_k td[name="ctt"]').html(obj.desk);
                                $('div#info_k td[name="note"]').html(obj.catatan);

                                $('form#form_resume_prov input[name="provresume"]').val(iddaerah);
                                $('form#form_resume_prov input[name="provindikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_prov textarea[name="provcatatan"]').val(obj.catatan_res);
                                $('form#form_resume_prov textarea[name="provsaran"]').val(obj.masukan_res);
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();}
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });

            var tbl_kk = $("#tbl_kketerkaitan");
            tbl_kk.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idwilayah").val();
                $('div#info_k td[name="ni"]').html(indkno);
                $('div#info_k td[name="bbt"]').html(indkbbt);
                $('div#nmp label[name="noidk"]').html(indkno);
                ajax_url = controller+"/detail_kategori_skor_d";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idwilayah").val();
                //alert(ajax_data);
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_btn').hide();
                                $('.list_penilai_dok').hide();
                                $('.module_1').hide();
                                $('.list_detai_kreteria').show();
                                $('.table_ktg_skor').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_k label[name="total"]').html(obj.total);
                                $('div#info_k td[name="ctt"]').html(obj.desk);
                                $('div#info_k td[name="note"]').html(obj.catatan);
                                $(".catatan").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' )
                                    $(".catatan").show();
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });

            var tbl_kkon = $("#table_kkonsistensi");
            tbl_kkon.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idwilayah").val();
                $('div#info_k td[name="ni"]').html(indkno);
                $('div#info_k td[name="bbt"]').html(indkbbt);
                $('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_d";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idwilayah").val();
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_btn').hide();
                                $('.list_penilai_dok').hide();
                                $('.module_1').hide();
                                $('.list_detai_kreteria').show();
                                $('.table_ktg_skor').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_k label[name="total"]').html(obj.total);
                                $('div#info_k td[name="ctt"]').html(obj.desk);
                                $('div#info_k td[name="note"]').html(obj.catatan);
                                $('form#form_resume_prov input[name="provresume"]').val(iddaerah);
                                $('form#form_resume_prov input[name="provindikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_prov textarea[name="provcatatan"]').val(obj.catatan_res);
                                $('form#form_resume_prov textarea[name="provsaran"]').val(obj.masukan_res);
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();}
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
        
            var tbl_kkk = $("#table_kkk");
            tbl_kkk.on('click', 'a.isinilai2', function(e){
               e.preventDefault();
               var id      = $(this).data("id");
               var indkno = $(this).data("nomor");
               var indkbbt = $(this).data("bobot");
               var iddaerah = $("#idwilayah").val();
               $('div#info_k td[name="ni"]').html(indkno);
               $('div#info_k td[name="bbt"]').html(indkbbt);
               $('div#nmp label[name="noidk"]').html(indkno);
   //            var msg_obj = $("#msg");
               ajax_url = controller+"/detail_kategori_skor_d";
               ajax_data = "id="+id;
               ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idwilayah").val();
               loading.show();
               jQuery.ajax({
                   type: "POST", // HTTP method POST or GET
                   url: base_url+ajax_url, //Where to make Ajax calls
                   dataType:"text", // Data type, HTML, json etc.
                   data:ajax_data, //Form variables
                   success:function(response){
                       var obj = null;
                       try
                       {
                           obj = $.parseJSON(response);  
                       }catch(e)
                       {}
                       if(obj)//if json data
                       {
                           //success msg
                           if(obj.status === 1){
                               loading.hide();
                               $('.list_btn').hide();
                               $('.list_penilai_dok').hide();
                               $('.module_1').hide();
                               $('.list_detai_kreteria').show();
                               $('.table_ktg_skor').html(obj.table_ktg_skor);
                               $('#pop_indikator').modal();
                               $('div#kriteria_info h3[name="info_k"]').html(obj.kriteria);
                               $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                               $('div#info_k label[name="total"]').html(obj.total);
                               $('form#form_resume_prov input[name="provresume"]').val(iddaerah);
                               $('form#form_resume_prov input[name="provindikaresum"]').val(obj.no_indikator);
                               $('form#form_resume_prov textarea[name="provcatatan"]').val(obj.catatan_res);
                               $('form#form_resume_prov textarea[name="provsaran"]').val(obj.masukan_res);
                               $(".catatan").hide();
                               $(".wajibisi").hide();
                               if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                   $(".catatan").show();
                                   $(".wajibisi").show();}
                           }
                           //error msg
                           else if(obj.status === 0){
                               loading.hide();
                               sweetAlert("Error", obj.msg, "error");
                           }
                           //session ended msg
                           else if(obj.status === 2){
                               sweetAlert("Error", obj.msg, "error");
                               window.setTimeout(function(){
                                   window.location.href = base_url+default_controller; //redirect ke login page
                               }, 2000);
                           }
                           $("#csrf").val(obj.csrf_hash);
                       }
                       else
                       {
                           show_alert_ms(msg_obj,99,response);loading.hide();
                           return false;
                       }
                   },
                   error:function (xhr, ajaxOptions, thrownError){
                       loading.hide(); 
                       alert(thrownError);
                       return false;
                   }
               });

           });

        var tbl_kinv = $("#table_Kinovasi");
        tbl_kinv.on('click', 'a.isinilai2', function(e){
           e.preventDefault();
           var id      = $(this).data("id");
           var indkno = $(this).data("nomor");
           var indkbbt = $(this).data("bobot");
           var iddaerah = $("#idwilayah").val();
           $('div#info_k td[name="ni"]').html(indkno);
           $('div#info_k td[name="bbt"]').html(indkbbt);
           $('div#nmp label[name="noidk"]').html(indkno);
//            var msg_obj = $("#msg");
           ajax_url = controller+"/detail_kategori_skor_d";
           ajax_data = "id="+id;
           ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idwilayah").val();
           loading.show();
           jQuery.ajax({
               type: "POST", // HTTP method POST or GET
               url: base_url+ajax_url, //Where to make Ajax calls
               dataType:"text", // Data type, HTML, json etc.
               data:ajax_data, //Form variables
               success:function(response){
                   var obj = null;
                   try
                   {
                       obj = $.parseJSON(response);  
                   }catch(e)
                   {}
                   if(obj)//if json data
                   {
                       //success msg
                       if(obj.status === 1){
                           loading.hide();
                           $('.list_btn').hide();
                           $('.list_penilai_dok').hide();
                           $('.module_1').hide();
                           $('.list_detai_kreteria').show();
                           $('.table_ktg_skor').html(obj.table_ktg_skor);
                           $('#pop_indikator').modal();
                           $('div#kriteria_info h3[name="info_k"]').html(obj.kriteria);
                           $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                           $('div#info_k label[name="total"]').html(obj.total);
                           $('div#info_k td[name="ctt"]').html(obj.desk);
                           $('div#info_k td[name="note"]').html(obj.catatan);
                           $('form#form_resume_prov input[name="provresume"]').val(iddaerah);
                            $('form#form_resume_prov input[name="provindikaresum"]').val(obj.no_indikator);
                            $('form#form_resume_prov textarea[name="provcatatan"]').val(obj.catatan_res);
                            $('form#form_resume_prov textarea[name="provsaran"]').val(obj.masukan_res);
                            $(".catatan").hide();
                            $(".wajibisi").hide();
                            if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                $(".catatan").show();
                                $(".wajibisi").show();}
                       }
                       //error msg
                       else if(obj.status === 0){
                           loading.hide();
                           sweetAlert("Error", obj.msg, "error");
                       }
                       //session ended msg
                       else if(obj.status === 2){
                           sweetAlert("Error", obj.msg, "error");
                           window.setTimeout(function(){
                               window.location.href = base_url+default_controller; //redirect ke login page
                           }, 2000);
                       }
                       $("#csrf").val(obj.csrf_hash);
                   }
                   else
                   {
                       show_alert_ms(msg_obj,99,response);loading.hide();
                       return false;
                   }
               },
               error:function (xhr, ajaxOptions, thrownError){
                   loading.hide(); 
                   alert(thrownError);
                   return false;
               }
           });

       });
        
        var tableH = $("#tblHasilNilai");
        tableH.on('click', 'a.klikskor', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var daerah = $("#idaerah").val();
            var indkno = $(this).data("nomor");
            var nilai = $(this).data("nilai");
            var idin = $(this).data("idin");
           // alert(nilai);
            var msg_obj = $("#msg");
            ajax_url = controller+"/pilih_skor_i";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#iddaerah").val()+"&indkno="+indkno+"&nilai="+nilai+"&idin="+idin;
            loading.show();
            //$("#idaerah").val(id);
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+ajax_url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:ajax_data, //Form variables
                success:function(response){
                    var obj = null;
                    try
                    {
                        obj = $.parseJSON(response);  
                    }catch(e)
                    {}
                    //var obj = jQuery.parseJSON(response);

                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            loading.hide();
                            $('.table_ktg_skor').html(obj.table_ktg_skor);
                            $('div#info_k label[name="total"]').html(obj.nilai);
                            //$(".total").val();
                        }
                        //error msg
                        else if(obj.status === 0){
                            loading.hide();
                            sweetAlert("Error", obj.msg, "error");
                        }
                        //session ended msg
                        else if(obj.status === 2){
                            sweetAlert("Error", obj.msg, "error");
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; //redirect ke login page
                            }, 2000);
                        }
                        $("#csrf").val(obj.csrf_hash);
                    }
                    else
                    {
                        show_alert_ms(msg_obj,99,response);loading.hide();
                        return false;
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    loading.hide(); 
                    alert(thrownError);
                    return false;
                }
            });
            
        });
        
       $(".btnKembaliK").click(function(e){
           e.preventDefault();
                var id = $("#idwilayah").val();
                var msg_obj = $("#msg");
                ajax_url = controller+"/detail_get";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
               $("#provid").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.module_1').show();
                                $('.list_penilai_dok').show();
                                $('.list_detai_kreteria').hide();
                           
                                $('.list_provinsi').hide();
                                $('.list_penilai').show();
                                $('.module_1').show();
                                $('form#form_pd td[name="inputnp"]').html(obj.profile);
                                $('form#form_pd td[name="inputddn"]').html(obj.data[0].nama_provinsi);

                                $('div#kp input[name="kp_user"]').val(obj.profile);
                                $('div#kp input[name="kp_daerah"]').val(obj.data[0].nama_provinsi);

                                $('.table_pencapaian').html(obj.tbl_pencapaian);
                                $('.table_keterkaitan').html(obj.tbl_keterkaitan);
                                $('.table_konsistensi').html(obj.tbl_konsistensi);
                                $('.table_kk').html(obj.tbl_kk);
                                $('.table_inovasi').html(obj.tbl_inovasi);
                                
                                $('div#nmp li[name="profil"]').html(obj.profile2);
                                $('div#nmp td[name="daerah"]').html(obj.data[0].nama_provinsi);
                                
                                $('div#info_k li[name="profil"]').html(obj.profile2);
                                $('div#info_k td[name="daerah"]').html(obj.data[0].nama_provinsi);
                                
                                $('.pencapaian_ttl_prov').html(obj.pencapaian);
                                $('.keterkaitan_ttl_prov').html(obj.keterkaitan);
                                $('.konsistensi_ttl_prov').html(obj.konsistensi);
                                $('.kelengkapan_ttl_prov').html(obj.kelengkapan);
                                $('.inovasi_ttl_prov').html(obj.inovasi);
                                if(obj.pernyataan=='1' )
                                    $('#pop_berkas_prov').modal('show');
                                
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
        });
        //resume save
        $(".btnResumeProv").click(function(e){
            e.preventDefault();
            var msg         =   $("#msg");
            var ktr = $('form#form_resume_prov input[name="provresume"]').val();
            var ind = $('form#form_resume_prov input[name="provindikaresum"]').val();
            var ctt = $('form#form_resume_prov textarea[name="provcatatan"]').val();
            var srn = $('form#form_resume_prov textarea[name="provsaran"]').val();
            if($('form#form_resume_prov textarea[name="provcatatan"]').val() === ''){show_alert_ms(msg,1,"<i>Catatan </i>Harus diisi");return false; }
            if($('form#form_resume_prov textarea[name="provsaran"]').val() === ''){show_alert_ms(msg,1,"<i>Masukan dan saran </i>Harus diisi");return false; }
                $("#msg").hide();
                ajax_url = controller+"/add_catatan_prov";
                ajax_data = "provresume="+ktr;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&provindikaresum="+ind+"&provcatatan="+ctt+"&provsaran="+srn;
                
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
//                                $('.table_skor_kota').html(obj.table_ktg_skor);
//                                $('div#info_kategori_kota label[name="total"]').html(obj.nilai);
                                //$(".total").val();
                                sweetAlert("Success", obj.msg, "success");
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
                
            });
        //lembaran pernyataan Provinsi
        $(".btnSPProv").click(function(e){
                e.preventDefault();
                var ktid = $('form#form_pernyataan_prov input[name="provid"]').val();
                var nmlp = $('form#form_pernyataan_prov input[name="namalengkap"]').val();
               ajax_url = controller+"/add_lembaranpernyataan_prov";
                ajax_data = "prov="+ktid;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&nama="+nmlp;
                 //alert(srn);
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    mimeType: "multipart/form-data",
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                datatable.ajax.reload();
                                $('.list_btn').show();
                                $('.list_provinsi').hide();
                                $('.list_penilai').hide();
                                $('.list_detai_kreteria_kab').hide();
                                $('#pop_berkas_prov').modal('toggle');
                                datatable.ajax.reload();
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
                
            });
        
//            var formK = $("#form_pernyataan_prov");
//        formK.validate({
//                errorElement: 'span', //default input error message container
//                errorClass: 'help-block help-block-error', // default input error message class
//                rules:{
//                    provid:{required:true},
//                    namalengkap:{required:true},
//                    attch:{extension: "pdf|doc|docx",filesize: 30000000}, //3 mb
//                }
//                ,
//                errorPlacement: function(error, element) {
//                    if (element.attr("name") === "podate" || element.attr("name") === "material" || element.attr("name") === "supplier" ) {
//                        error.insertAfter(element.parent());
//                    } else {
//                        error.insertAfter(element);
//                    }
//                },
//                highlight: function (element) { // hightlight error inputs
//                    $(element)
//                    .closest('.form-group').addClass('has-error'); // set error class to the control group
//                },
//                unhighlight: function (element) { // hightlight error inputs
//                    $(element)
//                    .closest('.has-error').removeClass('has-error'); // set error class to the control group
//                },
//                submitHandler: function(form) {
//                    var url = controller+"/add_act";
//
//                    var data1 = new FormData(formK[0]);
//                    data1.append(csrf_name, $("#csrf").val());
//                    var data = data1;
//
//                    loading.show();
//                    msg_obj.hide();
//                    jQuery.ajax({
//                        type: "POST", // HTTP method POST or GET
//                        url: base_url+url, //Where to make Ajax calls
//                        data:data, //Form variables
//                        mimeType: "multipart/form-data",
//                        cache: false,
//                        contentType: false,
//                        processData: false,
//                        success:function(response){
//                            var obj = null;
//                            try{
//                                obj = $.parseJSON(response);  
//                            }catch(e)
//                            {}
//                            //var obj = jQuery.parseJSON(response);
//
//                            if(obj)//if json data
//                            {
//                                loading.hide();$("#csrf").val(obj.csrf_hash);
//                                //success msg
//                                if(obj.status === 1){
//                                    $("#detailid").val(obj.id);
//    //                                datatable_detail.ajax.reload(function(){
//    //                                    
//    //                                });
//                                        $("#form_add :input").prop("disabled", true);
//                                        $(".formadd_wrapper").hide();
//                                        $(".list_wrapper").show();
//                                        sweetAlert("Success", obj.msg, "success");loading.hide();
//                                        $('.list_dok').show();
//                                        $('.input_dok').hide();
//    //                                    window.location.href = base_url+controller; 
//                                }
//
//                                //error msg
//                                else if(obj.status === 0){
//                                    sweetAlert("Error", obj.msg, "error");
//                                }
//                                //datatable.ajax.reload();
//                            }
//                            else
//                            {
//                                sweetAlert("Error", response, "error");
//                                loading.hide();
//                            }
//                        },
//                        error:function (xhr, ajaxOptions, thrownError){
//                            loading.hide(); 
//                            sweetAlert("FATAL ERROR", thrownError, "error");
//                        }
//                    });
//                    return false;
//                }
//            });
//             $.validator.addMethod('filesize', function (value, element, param) {
//                return this.optional(element) || (element.files[0].size <= param);
//            }, 'Ukuran berkas maksimal 3 Mb');
        
//List Kabupaten
            $(".btnKab").click(function(e){
                e.preventDefault();
                $('.list_btn').hide();
                $('.list_kabupaten').show();
            });
            
            var tableK = $("#tblKab");
            var datatable = tableK.DataTable({
                   "processing": true,
                   "serverSide": true,
                   "ajax":{
                       url :base_url+controller+"/get_data_kk", // json datasource
                       type: "post",  // method  , by default get
                       error: function(){  // error handling
                               $(".employee-grid-error").html("");
                               $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                               $("#employee-grid_processing").css("display","none");
                       },
                       data: function(d){
                       },
                       "dataSrc": function ( json ) {
                           //$("#ttl_qty").val(json.ttl_qty);
                           return json.data;
                       }

                   },
                   "columnDefs": [                  
                        { "width": "2px", "targets": 0},
                        { "targets": 3, "orderable": false },
                        { "width": "390px", "targets": 1},
                       { "width": "140px", "targets": 2}
  //                     { "width": "10px", "targets": 4}
                   ],
                   "lengthMenu": [[3, 5, 20, 25, 50, -1], [3, 5, 20, 25, 50, "All"]],
                   "initComplete": function(settings, json) {
                    //console.log(settings);
                   },
                   paging: true,
                   "language": {
                       "sProcessing":   "Sedang memproses...",
                       "sLengthMenu":   "Tampilkan _MENU_ entri",
                  "sZeroRecords":  "Tidak ada data",
                  "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                  "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
                  "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                  "sInfoPostFix":  "",
                  "sSearch":       "Cari:",
                  "sUrl":          "",
                  "oPaginate": {
                      "sFirst":    "Pertama",
                      "sPrevious": "Sebelumnya",
                      "sNext":     "Selanjutnya",
                      "sLast":     "Terakhir"
                  }
              }
              });
            var table2 = $("#tblKab");
            table2.on('click', 'a.edit', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var msg_obj = $("#msg");
                ajax_url = controller+"/detail_get_kab";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
                $("#iddaerahKab").val(id);
                $("#idKabupaten").val(id);
                $("#kabid").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_kabupaten').hide();                                
                                $('.list_penilai_kab').show();
                                $('form#form_pd_kab td[name="inputNKab"]').html(obj.data[0].nama_kabupaten);
                                $('form#form_pd_kab td[name="inputNPro"]').html(obj.profile);
                                $('.module_1_kab').show();
                                $('.table_pencapaian_kab').html(obj.tbl_pencapaian);
                                $('.table_keterkaitan_kab').html(obj.tbl_keterkaitan);
                                $('.table_konsistensi_kab').html(obj.tbl_konsistensi);
                                $('.table_kk_kab').html(obj.tbl_kk);
                                $('.table_inovasi_kab').html(obj.tbl_inovasi);  
                                $('div#info_kategori_kab td[name="daerah"]').html(obj.data[0].nama_kabupaten);
                                $('.pencapaian_ttl_kab').html(obj.pencapaian);
                                $('.keterkaitan_ttl_kab').html(obj.keterkaitan);
                                $('.konsistensi_ttl_kab').html(obj.konsistensi);
                                $('.kelengkapan_ttl_kab').html(obj.kelengkapan);
                                $('.inovasi_ttl_kab').html(obj.inovasi);
                                if(obj.pernyataan=='1' )
                                    $('#pop_berkas_kab').modal('show');
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });        
            });
            
            table2.on('click', 'a.download', function(e){
              e.preventDefault();
                  //$("#customborder_collapse5").attr('disabled','disabled');
              var id      = $(this).data("id");
             // alert(id);
              var msg_obj = $("#msg");
              //ajax_url = controller+"/Download_excel";
              window.open(base_url+controller+"/Download_excel_kab?wl="+id+"&in="+$("#inp_in").val());

          });
            
            //kembali 1
            $(".btnBackKSatu").click(function(e){
                e.preventDefault();
                //form_ch[0].reset();
                $('.list_kabupaten').show();
                $('.list_penilai_kab').hide();
//                $('.module_1').hide();
//                $('.mdlNilai').hide();
                datatable.ajax.reload();
            });
            
            //list kategori item 
            var tbl_KriteriaPencapaianKab = $("#tbl_KriteriaPencapaianKab");
            tbl_KriteriaPencapaianKab.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKabupaten").val();
                $('div#info_kategori_kab td[name="nomorindikator"]').html(indkno);
                $('div#info_kategori_kab td[name="bobotindikator"]').html(indkbbt);
               // $('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_kab";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKabupaten").val();
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kab').hide();
                                $('.list_detai_kreteria_kab').show();
                                //$('.list_btn').hide();
                                $('.module_1_kab').hide();
                                $('.table_ktg_skor_kab').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info_kab h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_kategori_kab label[name="total"]').html(obj.total);
                                $('div#info_kategori_kab td[name="ctt"]').html(obj.desk);
                                $('div#info_kategori_kab td[name="note"]').html(obj.catatan);
                                //
                                $('form#form_resume_kab input[name="kabresume"]').val(iddaerah);
                                $('form#form_resume_kab input[name="kabindikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kab textarea[name="kabcatatan"]').val(obj.catatan_res);
                                $('form#form_resume_kab textarea[name="kabsaran"]').val(obj.masukan_res);
                                
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();}
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var tbl_kketerkaitan_kab = $("#tbl_kketerkaitan_kab");
            tbl_kketerkaitan_kab.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKabupaten").val();
                $('div#info_kategori_kab td[name="nomorindikator"]').html(indkno);
                $('div#info_kategori_kab td[name="bobotindikator"]').html(indkbbt);
               // $('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_kab";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKabupaten").val();
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kab').hide();
                                $('.list_detai_kreteria_kab').show();
                                //$('.list_btn').hide();
                                $('.module_1_kab').hide();
                                $('.table_ktg_skor_kab').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info_kab h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_kategori_kab label[name="total"]').html(obj.total);
                                $('div#info_kategori_kab td[name="ctt"]').html(obj.desk);
                                $('div#info_kategori_kab td[name="note"]').html(obj.catatan);
                                $('form#form_resume_kab input[name="kabresume"]').val(iddaerah);
                                $('form#form_resume_kab input[name="kabindikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kab textarea[name="kabcatatan"]').val(obj.catatan_res);
                                $('form#form_resume_kab textarea[name="kabsaran"]').val(obj.masukan_res);
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();}
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var table_kkonsistensi_kab = $("#table_kkonsistensi_kab");
            table_kkonsistensi_kab.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKabupaten").val();
                $('div#info_kategori_kab td[name="nomorindikator"]').html(indkno);
                $('div#info_kategori_kab td[name="bobotindikator"]').html(indkbbt);
               // $('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_kab";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKabupaten").val();
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kab').hide();
                                $('.list_detai_kreteria_kab').show();
                                //$('.list_btn').hide();
                                $('.module_1_kab').hide();
                                $('.table_ktg_skor_kab').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info_kab h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_kategori_kab label[name="total"]').html(obj.total);
                                $('div#info_kategori_kab td[name="ctt"]').html(obj.desk);
                                $('div#info_kategori_kab td[name="note"]').html(obj.catatan);
                                $('form#form_resume_kab input[name="kabresume"]').val(iddaerah);
                                $('form#form_resume_kab input[name="kabindikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kab textarea[name="kabcatatan"]').val(obj.catatan_res);
                                $('form#form_resume_kab textarea[name="kabsaran"]').val(obj.masukan_res);
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                $(".wajibisi").show();}
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var table_kkk_kab = $("#table_kkk_kab");
            table_kkk_kab.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKabupaten").val();
                $('div#info_kategori_kab td[name="nomorindikator"]').html(indkno);
                $('div#info_kategori_kab td[name="bobotindikator"]').html(indkbbt);
               // $('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_kab";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKabupaten").val();
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kab').hide();
                                $('.list_detai_kreteria_kab').show();
                                //$('.list_btn').hide();
                                $('.module_1_kab').hide();
                                $('.table_ktg_skor_kab').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info_kab h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_kategori_kab label[name="total"]').html(obj.total);
                                $('div#info_kategori_kab td[name="ctt"]').html(obj.desk);
                                $('div#info_kategori_kab td[name="note"]').html(obj.catatan);
                                $('form#form_resume_kab input[name="kabresume"]').val(iddaerah);
                                $('form#form_resume_kab input[name="kabindikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kab textarea[name="kabcatatan"]').val(obj.catatan_res);
                                $('form#form_resume_kab textarea[name="kabsaran"]').val(obj.masukan_res);
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                $(".wajibisi").show();}
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var tbl_kinovasi_kab = $("#tbl_kinovasi_kab");
            tbl_kinovasi_kab.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKabupaten").val();
                $('div#info_kategori_kab td[name="nomorindikator"]').html(indkno);
                $('div#info_kategori_kab td[name="bobotindikator"]').html(indkbbt);
               // $('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_kab";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKabupaten").val();
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kab').hide();
                                $('.list_detai_kreteria_kab').show();
                                //$('.list_btn').hide();
                                $('.module_1_kab').hide();
                                $('.table_ktg_skor_kab').html(obj.table_ktg_skor);
                                $('#pop_indikator').modal();
                                $('div#kriteria_info_kab h3[name="info_k"]').html(obj.kriteria);
                                $('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('div#info_kategori_kab label[name="total"]').html(obj.total);
                                $('div#info_kategori_kab td[name="ctt"]').html(obj.desk);
                                $('div#info_kategori_kab td[name="note"]').html(obj.catatan);
                                $('form#form_resume_kab input[name="kabresume"]').val(iddaerah);
                                $('form#form_resume_kab input[name="kabindikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kab textarea[name="kabcatatan"]').val(obj.catatan_res);
                                $('form#form_resume_kab textarea[name="kabsaran"]').val(obj.masukan_res);
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();}
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var tableHasilKab = $("#tblHasilNilaiKab");
            tableHasilKab.on('click', 'a.klikskor', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var daerah = $("#idaerah").val();
                var indkno = $(this).data("nomor");
                var nilai = $(this).data("nilai");
                var idin = $(this).data("idin");
               // alert(nilai);
                var msg_obj = $("#msg");
                ajax_url = controller+"/pilih_skor_kabupaten";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKabupaten").val()+"&indkno="+indkno+"&nilai="+nilai+"&idin="+idin;
                loading.show();
                //$("#idaerah").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.table_ktg_skor_kab').html(obj.table_ktg_skor);
                                $('div#info_kategori_kab label[name="total"]').html(obj.nilai);
                                //$(".total").val();
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            $(".btnDokumenKota").click(function(e){
                e.preventDefault();
                datatable.ajax.reload();
                $('.list_kota').show();
                $('.list_penilai_kota').hide();
            });
            $(".btnKI").click(function(e){
                e.preventDefault();
                var id = $("#idKabupaten").val();
                var msg_obj = $("#msg");
                ajax_url = controller+"/detail_get_kab";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
               // $("#iddaerahKota").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_kabupaten').hide(); 
                                $('.list_detai_kreteria_kab').hide();
                                $('.list_penilai_kab').show();
                                $('form#form_pd_kab td[name="inputNKab"]').html(obj.data[0].nama_kabupaten);
                                $('form#form_pd_kab td[name="inputNPro"]').html(obj.profile);
                                $('.module_1_kab').show();
                                
                                $('.table_pencapaian_kab').html(obj.tbl_pencapaian);
                                $('.table_keterkaitan_kab').html(obj.tbl_keterkaitan);
                                $('.table_konsistensi_kab').html(obj.tbl_konsistensi);
                                $('.table_kk_kab').html(obj.tbl_kk);
                                $('.table_inovasi_kab').html(obj.tbl_inovasi);  
                                $('div#info_kategori_kab td[name="daerah"]').html(obj.data[0].nama_kabupaten);
                                $('.pencapaian_ttl_kab').html(obj.pencapaian);
                                $('.keterkaitan_ttl_kab').html(obj.keterkaitan);
                                $('.konsistensi_ttl_kab').html(obj.konsistensi);
                                $('.kelengkapan_ttl_kab').html(obj.kelengkapan);
                                $('.inovasi_ttl_kab').html(obj.inovasi);
                                if(obj.pernyataan=='1' )
                                    $('#pop_berkas_kab').modal('show');
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
            });
            
            $(".btnResumeKab").click(function(e){
                e.preventDefault();
                var msg         =   $("#msg");
                var ktr = $('form#form_resume_kab input[name="kabresume"]').val();
                var ind = $('form#form_resume_kab input[name="kabindikaresum"]').val();
                var ctt = $('form#form_resume_kab textarea[name="kabcatatan"]').val();
                var srn = $('form#form_resume_kab textarea[name="kabsaran"]').val();
                if($('form#form_resume_kab textarea[name="kabcatatan"]').val() === ''){show_alert_ms(msg,1,"<i>Catatan </i>Harus diisi");return false; }
                if($('form#form_resume_kab textarea[name="kabsaran"]').val() === ''){show_alert_ms(msg,1,"<i>Masukan dan saran </i>Harus diisi");return false; }
                $("#msg").hide();
                ajax_url = controller+"/add_catatan_kab";
                ajax_data = "Kabresume="+ktr;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&kabindikaresum="+ind+"&kabcatatan="+ctt+"&kabsaran="+srn;
                
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
//                                $('.table_skor_kota').html(obj.table_ktg_skor);
//                                $('div#info_kategori_kota label[name="total"]').html(obj.nilai);
                                //$(".total").val();
                                sweetAlert("Success", obj.msg, "success");
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
                
            });
            
            //form_pernyataan
            $(".btnSPKab").click(function(e){
                e.preventDefault();
                var ktid = $('form#form_pernyataan_kab input[name="kabid"]').val();
                var nmlp = $('form#form_pernyataan_kab input[name="namalengkap"]').val();
               ajax_url = controller+"/add_lembaranpernyataan_kab";
                ajax_data = "kab="+ktid;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&nama="+nmlp;
                 //alert(srn);
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                datatable.ajax.reload();
                                $('.list_btn').show();
                                $('.list_kabupaten').hide();
                                $('.list_penilai_kab').hide();
                                $('.list_detai_kreteria_kab').hide();
                                $('#pop_berkas_kab').modal('toggle');
                                datatable.ajax.reload();
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
                
            });
            

//kota
        $(".btnKot").click(function(e){
             e.preventDefault();
            $('.list_btn').hide();
            $('.list_kota').show();
       });
        var tableKota = $("#tblKot");
        var datatable = tableKota.DataTable({
               "processing": true,
               "serverSide": true,
               "ajax":{
                   url :base_url+controller+"/get_data_kota", // json datasource
                   type: "post",  // method  , by default get
                   error: function(){  // error handling
                           $(".employee-grid-error").html("");
                           $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                           $("#employee-grid_processing").css("display","none");
                   },
                   data: function(d){
                   },
                   "dataSrc": function ( json ) {
                       //$("#ttl_qty").val(json.ttl_qty);
                       return json.data;
                   }

               },
               "columnDefs": [                  
                    { "width": "2px", "targets": 0},
                    { "targets": 3, "orderable": false },
                    { "width": "390px", "targets": 1},
                   { "width": "140px", "targets": 2}
//                     { "width": "10px", "targets": 4}
               ],
               "lengthMenu": [[5, 20, 25, 50, -1], [5, 20, 25, 50, "All"]],
               "initComplete": function(settings, json) {
                //console.log(settings);
               },
               paging: true,
               "language": {
                   "sProcessing":   "Sedang memproses...",
                   "sLengthMenu":   "Tampilkan _MENU_ entri",
              "sZeroRecords":  "Tidak ada data",
              "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
              "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
              "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
              "sInfoPostFix":  "",
              "sSearch":       "Cari:",
              "sUrl":          "",
              "oPaginate": {
                  "sFirst":    "Pertama",
                  "sPrevious": "Sebelumnya",
                  "sNext":     "Selanjutnya",
                  "sLast":     "Terakhir"
              }
          }
          });
        tableKota.on('click', 'a.edit', function(e){
          e.preventDefault();
          var id      = $(this).data("id");
          var msg_obj = $("#msg");
          ajax_url = controller+"/detail_get_kota";
          ajax_data = "id="+id;
          ajax_data+="&"+csrf_name+"="+$("#csrf").val();
          loading.show();
          $("#iddaerahKota").val(id);
          $("#idKota").val(id);
          $("#kotaid").val(id);
          jQuery.ajax({
              type: "POST", // HTTP method POST or GET
              url: base_url+ajax_url, //Where to make Ajax calls
              dataType:"text", // Data type, HTML, json etc.
              data:ajax_data, //Form variables
              success:function(response){
                  var obj = null;
                  try
                  {
                      obj = $.parseJSON(response);  
                  }catch(e)
                  {}
                  //var obj = jQuery.parseJSON(response);

                  if(obj)//if json data
                  {
                      //success msg
                      if(obj.status === 1){
                          loading.hide();
                          $('.list_kota').hide();
                          $('.list_penilai_kota').show();
                          $('.module_1_kota').show();
                          $('form#form_pd_kota td[name="inputnp"]').html(obj.profile);
                          $('form#form_pd_kota td[name="inputddn"]').html(obj.data[0].nama_kabupaten);
                          $('.table_pencapaian_kota').html(obj.tbl_pencapaian);
                          $('.table_keterkaitan_kota').html(obj.tbl_keterkaitan);
                          $('.table_konsistensi_kota').html(obj.tbl_konsistensi);
                          $('.table_kk_kota').html(obj.tbl_kk);
                          $('.table_inovasi_kota').html(obj.tbl_inovasi);
                          $('div#info_kategori_kota td[name="daerah"]').html(obj.data[0].nama_kabupaten);
                          $('.pencapaian_ttl_kota').html(obj.pencapaian);
                          $('.keterkaitan_ttl_kota').html(obj.keterkaitan);
                          $('.konsistensi_ttl_kota').html(obj.konsistensi);
                          $('.kelengkapan_ttl_kota').html(obj.kelengkapan);
                          $('.inovasi_ttl_kota').html(obj.inovasi);
                         
                          if(obj.pernyataan=='1' )
                              $('#pop_berkas').modal('show');
                          
                      }
                      //error msg
                      else if(obj.status === 0){
                          loading.hide();
                          sweetAlert("Error", obj.msg, "error");
                      }
                      //session ended msg
                      else if(obj.status === 2){
                          sweetAlert("Error", obj.msg, "error");
                          window.setTimeout(function(){
                              window.location.href = base_url+default_controller; //redirect ke login page
                          }, 2000);
                      }
                      $("#csrf").val(obj.csrf_hash);
                  }
                  else
                  {
                      show_alert_ms(msg_obj,99,response);loading.hide();
                      return false;
                  }
              },
              error:function (xhr, ajaxOptions, thrownError){
                  loading.hide(); 
                  alert(thrownError);
                  return false;
              }
          });        
      });
          
        tableKota.on('click', 'a.download', function(e){
              e.preventDefault();
                  //$("#customborder_collapse5").attr('disabled','disabled');
              var id      = $(this).data("id");
             // alert(id);
              var msg_obj = $("#msg");
              ajax_url = controller+"/Download_excel";
              window.open(base_url+controller+"/Download_excel_kota?wl="+id+"&in="+$("#inp_in").val());

          });

        var tbl_kp_kota = $("#tbl_kp_kota");
        tbl_kp_kota.on('click', 'a.isinilai2', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var indkno = $(this).data("nomor");
            var indkbbt = $(this).data("bobot");
            var iddaerah = $("#idKota").val();
            ajax_url = controller+"/detail_kategori_skor_kota";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKota").val();
            //alert(ajax_data);
            loading.show();
            //$(".idaerah2").val(id);
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+ajax_url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:ajax_data, //Form variables
                success:function(response){
                    var obj = null;
                    try
                    {
                        obj = $.parseJSON(response);  
                    }catch(e)
                    {}
                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            loading.hide();
                            $('.list_penilai_kota').hide();
                            $('div#info_kategori_kota td[name="nomorindikator"]').html(indkno);
                            $('div#info_kategori_kota td[name="bobotindikator"]').html(indkbbt);
                            $('div#kriteria_info_kota h3[name="info_k"]').html(obj.kriteria);
                            $('div#info_kategori_kota label[name="total"]').html(obj.total);
                            //$('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                            $('.table_skor_kota').html(obj.table_ktg_skor);
                            $('.list_detai_kreteria_kota').show();
                            $("#idKota").focus();
                            $('#pop_indikator').modal();
                            $('form#form_resume_kota input[name="Kotaresume"]').val(iddaerah);
                            $('form#form_resume_kota input[name="indikaresum"]').val(obj.no_indikator);
                            $('form#form_resume_kota textarea[name="catatan"]').val(obj.catatan_res);
                            $('form#form_resume_kota textarea[name="saran"]').val(obj.masukan_res);

                            $(".catatan").hide();
                            $(".wajibisi").hide();
                            if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                $(".catatan").show();
                                $(".wajibisi").show();
                            }
                        }
                        //error msg
                        else if(obj.status === 0){
                            loading.hide();
                            sweetAlert("Error", obj.msg, "error");
                        }
                        //session ended msg
                        else if(obj.status === 2){
                            sweetAlert("Error", obj.msg, "error");
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; //redirect ke login page
                            }, 2000);
                        }
                        $("#csrf").val(obj.csrf_hash);
                    }
                    else
                    {
                        show_alert_ms(msg_obj,99,response);loading.hide();
                        return false;
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    loading.hide(); 
                    alert(thrownError);
                    return false;
                }
            });

        });
            
            var tbl_kk_Kota = $("#tbl_kk_Kota");
            tbl_kk_Kota.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKota").val();
                
                //$('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_kota";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKota").val();
                //alert(ajax_data);
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kota').hide();
                                $('div#info_kategori_kota td[name="nomorindikator"]').html(indkno);
                                $('div#info_kategori_kota td[name="bobotindikator"]').html(indkbbt);
                                $('div#kriteria_info_kota h3[name="info_k"]').html(obj.kriteria);
                                $('div#info_kategori_kota label[name="total"]').html(obj.total);
                                //$('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('.table_skor_kota').html(obj.table_ktg_skor);
                                $('.list_detai_kreteria_kota').show();
                                $("#idKota").focus();
                                $('#pop_indikator').modal();
                                $('form#form_resume_kota input[name="Kotaresume"]').val(iddaerah);
                                $('form#form_resume_kota input[name="indikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kota textarea[name="catatan"]').val(obj.catatan_res);
                                $('form#form_resume_kota textarea[name="saran"]').val(obj.masukan_res);
                                
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();
                                }
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var table_kota_kk = $("#table_kota_kk");
            table_kota_kk.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKota").val();
                
                //$('div#nmp label[name="noidk"]').html(indkno);
    //            var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor_kota";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKota").val();
                //alert(ajax_data);
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kota').hide();
                                $('div#info_kategori_kota td[name="nomorindikator"]').html(indkno);
                                $('div#info_kategori_kota td[name="bobotindikator"]').html(indkbbt);
                                $('div#kriteria_info_kota h3[name="info_k"]').html(obj.kriteria);
                                $('div#info_kategori_kota label[name="total"]').html(obj.total);
                                //$('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('.table_skor_kota').html(obj.table_ktg_skor);
                                $('form#form_resume_kota input[name="Kotaresume"]').val(iddaerah);
                                $('form#form_resume_kota input[name="indikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kota textarea[name="catatan"]').val(obj.catatan_res);
                                $('form#form_resume_kota textarea[name="saran"]').val(obj.masukan_res);
                                $("#idKota").focus();
                                $('.list_detai_kreteria_kota').show();
                                $('#pop_indikator').modal();
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();
                                }
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var table_kkk_kota = $("#table_kkk_kota");
            table_kkk_kota.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKota").val();
                ajax_url = controller+"/detail_kategori_skor_kota";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKota").val();
                //alert(ajax_data);
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kota').hide();
                                $('div#info_kategori_kota td[name="nomorindikator"]').html(indkno);
                                $('div#info_kategori_kota td[name="bobotindikator"]').html(indkbbt);
                                $('div#kriteria_info_kota h3[name="info_k"]').html(obj.kriteria);
                                $('div#info_kategori_kota label[name="total"]').html(obj.total);
                                //$('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('.table_skor_kota').html(obj.table_ktg_skor);
                                $('form#form_resume_kota input[name="Kotaresume"]').val(iddaerah);
                                $('form#form_resume_kota input[name="indikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kota textarea[name="catatan"]').val(obj.catatan_res);
                                $('form#form_resume_kota textarea[name="saran"]').val(obj.masukan_res);
                                $("#idKota").focus();
                                $('.list_detai_kreteria_kota').show();
                                $('#pop_indikator').modal();
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();
                                }
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var table_Ki_kota = $("#table_Ki_kota");
            table_Ki_kota.on('click', 'a.isinilai2', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var indkno = $(this).data("nomor");
                var indkbbt = $(this).data("bobot");
                var iddaerah = $("#idKota").val();
                ajax_url = controller+"/detail_kategori_skor_kota";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKota").val();
                //alert(ajax_data);
                loading.show();
                //$(".idaerah2").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_penilai_kota').hide();
                                $('div#info_kategori_kota td[name="nomorindikator"]').html(indkno);
                                $('div#info_kategori_kota td[name="bobotindikator"]').html(indkbbt);
                                $('div#kriteria_info_kota h3[name="info_k"]').html(obj.kriteria);
                                $('div#info_kategori_kota label[name="total"]').html(obj.total);
                                //$('div#kriteria_info small[name="info_jml"]').html(obj.jml_terjawab);
                                $('.table_skor_kota').html(obj.table_ktg_skor);
                                $('form#form_resume_kota input[name="Kotaresume"]').val(iddaerah);
                                $('form#form_resume_kota input[name="indikaresum"]').val(obj.no_indikator);
                                $('form#form_resume_kota textarea[name="catatan"]').val(obj.catatan_res);
                                $('form#form_resume_kota textarea[name="saran"]').val(obj.masukan_res);
                                $(".daerah").focus();
                                $('.list_detai_kreteria_kota').show();
                                $('#pop_indikator').modal();
                                $(".catatan").hide();
                                $(".wajibisi").hide();
                                if(obj.no_indikator=='7' || obj.no_indikator=='22' || obj.no_indikator=='24' ){
                                    $(".catatan").show();
                                    $(".wajibisi").show();
                                }
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
            var tableHKota = $("#tblHasilNilaiKota");
            tableHKota.on('click', 'a.klikskor', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var daerah = $("#idKota").val();
                var indkno = $(this).data("nomor");
                var nilai = $(this).data("nilai");
                var idin = $(this).data("idin");
               // alert(nilai);
                var msg_obj = $("#msg");
                ajax_url = controller+"/pilih_skor_kota";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&iddaerah="+$("#idKota").val()+"&indkno="+indkno+"&nilai="+nilai+"&idin="+idin;
                loading.show();
                //$("#idaerah").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.table_skor_kota').html(obj.table_ktg_skor);
                                $('div#info_kategori_kota label[name="total"]').html(obj.nilai);
                                if(obj.pernyataan=='1' )
                                      $('#pop_berkas').modal('show');
                                //$(".total").val();
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });

            });
            
      
            
            var formK = $("#form_resume_kota");
            formK.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                rules:{
                    Kotaresume:{required:true},
                    indikaresum:{required:true},
                    catatan:{required:true},
                    saran:{required:true}
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "tgl_isi" || element.attr("name") === "tgl_lahir" ) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element) { // hightlight error inputs
                    $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // hightlight error inputs
                    $(element)
                    .closest('.has-error').removeClass('has-error'); // set error class to the control group
                },
                submitHandler: function(form) {
                    var url = controller+"/add_catatan_kota";
                    var data = formK.serialize();
                    data+="&"+csrf_name+"="+$("#csrf").val();

                    loading.show();
                    msg_obj.hide();
                    jQuery.ajax({
                        type: "POST", // HTTP method POST or GET
                        url: base_url+url, //Where to make Ajax calls
                        dataType:"text", // Data type, HTML, json etc.
                        data:data, //Form variables
                        success:function(response){
                            var obj = null;
                            try{
                                obj = $.parseJSON(response);  
                            }catch(e)
                            {}
                            //var obj = jQuery.parseJSON(response);

                            if(obj)//if json data
                            {
                                loading.hide();$("#csrf").val(obj.csrf_hash);
                                //success msg
                                if(obj.status === 1){
                                    if(obj.pernyataan=== 1 ){
                                      $('#pop_berkas').modal('show');
                                    }else{
                                      sweetAlert("Success", obj.msg, "success");
                                    }
                                    //
                                    
                                }

                                //error msg
                                else if(obj.status === 0){
                                    sweetAlert("Error", obj.msg, "error");
                                }
                                datatable.ajax.reload();
                            }
                            else
                            {
                                sweetAlert("Error", response, "error");
                                loading.hide();
                            }
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            loading.hide(); 
                            sweetAlert("FATAL ERROR", thrownError, "error");
                        }
                    });
                    return false;
                }
            });
        
            $(".btnDokumenKota").click(function(e){
                e.preventDefault();
                datatable.ajax.reload();
                $('.list_kota').show();
                $('.list_penilai_kota').hide();
            });
            $(".btnp").click(function(e){
                e.preventDefault();
                //alert();
                $('#pop_berkas').modal('show');
               // datatable.ajax.reload();
       //         $('.pop_indikator').modal('show');
            });            
            $(".btnSkorKota").click(function(e){
                e.preventDefault();
                var id = $("#idKota").val();
                var msg_obj = $("#msg");
                ajax_url = controller+"/detail_get_kota";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
               $("#kotaid").val(id);
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                $('.list_kota').hide();
                                $('.list_detai_kreteria_kota').hide();
                                $('.list_penilai_kota').show();
                                $('.module_1_kota').show();
                                $('form#form_pd_kota td[name="inputnp"]').html(obj.profile);
                                $('form#form_pd_kota td[name="inputddn"]').html(obj.data[0].nama_kabupaten);
                                $('.table_pencapaian_kota').html(obj.tbl_pencapaian);
                                $('.table_keterkaitan_kota').html(obj.tbl_keterkaitan);
                                $('.table_konsistensi_kota').html(obj.tbl_konsistensi);
                                $('.table_kk_kota').html(obj.tbl_kk);
                                $('.table_inovasi_kota').html(obj.tbl_inovasi);
                                
                                $('div#info_kategori_kota td[name="daerah"]').html(obj.data[0].nama_kabupaten);
                                $('.pencapaian_ttl_kota').html(obj.pencapaian);
                                $('.keterkaitan_ttl_kota').html(obj.keterkaitan);
                                $('.konsistensi_ttl_kota').html(obj.konsistensi);
                                $('.kelengkapan_ttl_kota').html(obj.kelengkapan);
                                $('.inovasi_ttl_kota').html(obj.inovasi);
                                if(obj.pernyataan=='1' )
                                      $('#pop_berkas').modal('show');
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
            });
            
            $(".btnResume").click(function(e){
                e.preventDefault();
                var ktr = $('form#form_resume_kota input[name="Kotaresume"]').val();
                var ind = $('form#form_resume_kota input[name="indikaresum"]').val();
                var ctt = $('form#form_resume_kota textarea[name="catatan"]').val();
                var srn = $('form#form_resume_kota textarea[name="saran"]').val();
               ajax_url = controller+"/add_catatan_kota";
                ajax_data = "Kotaresume="+ktr;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&indikaresum="+ind+"&catatan="+ctt+"&saran="+srn;
                 //alert(srn);
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
//                                $('.table_skor_kota').html(obj.table_ktg_skor);
//                                $('div#info_kategori_kota label[name="total"]').html(obj.nilai);
                                //$(".total").val();
                                sweetAlert("Success", obj.msg, "success");
                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
                
            });
            
            //form_pernyataan
            $(".btnSP").click(function(e){
                e.preventDefault();
                var ktid = $('form#form_pernyataan input[name="kotaid"]').val();
                var nmlp = $('form#form_pernyataan input[name="namalengkap"]').val();
                //alert(nmlp);
               ajax_url = controller+"/add_lembaranpernyataan_kota";
                ajax_data = "kota="+ktid;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&nama="+nmlp;
                 //alert(srn);
                loading.show();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+ajax_url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:ajax_data, //Form variables
                    success:function(response){
                        var obj = null;
                        try
                        {
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                datatable.ajax.reload();
                                $('.list_btn').show();
                                $('.list_kota').hide();
                                $('.list_penilai_kota').hide();
                                $('.list_detai_kreteria_kota').hide();
                                $('#pop_berkas').modal('toggle');
                                datatable.ajax.reload();

                            }
                            //error msg
                            else if(obj.status === 0){
                                loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //session ended msg
                            else if(obj.status === 2){
                                sweetAlert("Error", obj.msg, "error");
                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; //redirect ke login page
                                }, 2000);
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                            return false;
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                        return false;
                    }
                });
                
            });
//            $(".btnBerkas").click(function(e){
//                e.preventDefault();
//                $("#pop_berkas .close").click()
//              //  alert();
//              //  $('#pop_berkas').modal('toggle').hide();
//             //   $('#pop_berkas').modal('toggle');
//               // datatable.ajax.reload();
//       //         $('.pop_indikator').modal('show');
//            });
            
            
        };
        
    return{
        init:function(){datatable();},
        tble:function(){edittable();},
       // detail:function(){chart();},
    };
    }();