var main = function(){
    controller = "index.php/Manajemen_kasus_G1";
    var datatable = function(){
//        $('.inp_wp').datepicker({
//            format: 'dd/mm/yyyy',
//            autoclose:true,
//        });
        var table = $("#data");
        //var table_p = $("#pertanyaan"); 
        var data_soal = $("#data_soal");
        
        var datatable = table.DataTable({
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
                    //Make your callback here.
    //                    $("#csrf").val(json.csrf_hash);
                    return json.data;
                }                
            },
            "columnDefs": [ 
                { "targets": 4, "orderable": false },
                { "width": "50px", "targets": 4 }
            ],
            "initComplete": function(settings, json) {
    //                console.log(settings);
            },
            paging: true,
            dom: 'lfrtip',
            buttons: [
                {
                    text: 'New',
                    className: 'btn btn-default btn-sm waves-effect waves-light',
                    action: function ( e, dt, node, config ) {
                        $('#modal_add').modal('show') 
                    }
                }
            ],
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
       

       
       
        var forml = $("#form_add");
        var msg_obj=$("#msg_add");
       $("#modal_add_show").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('#modal_add').modal('show');
        });
       msg_obj.hide();
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
               nama:{required:true},
                jenis:{required:true},
                pendidikan:{required:true},
                status:{required:true},
                inp_wp:{required:true},
            }
            ,
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
                var url = controller+"/add_act";
                var data = forml.serialize();
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
                                sweetAlert("Success", obj.msg, "success");
                                forml[0].reset();
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
        
        table.on('click', 'a.edit', function(e){
            
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/ques_datatable";
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
                    if(obj){
                        if(obj.status === 1){
              //              $("#pertanyaan").html(obj.content);
                            //$('form#form_ch input[name="nama"]').val(obj.data[0].nama);
                            $('form#form_ch p[name="nik"]').html(obj.data[0].nik);
                            $('form#form_ch p[name="nama_t"]').html(obj.data[0].nama);
                            $('form#form_ch p[name="jk"]').html(obj.data[0].jk);
                            $('form#form_ch p[name="status"]').html(obj.stat);
                            $('form#form_ch p[name="pendidikan"]').html(obj.pendidikan);
                            $('form#form_ch p[name="usia"]').html(obj.data[0].usia);
                            $('form#form_ch p[name="jmlanak"]').html(obj.data[0].ja);
                            $('form#form_ch p[name="jlaki"]').html(obj.data[0].ja_l);
                            $('form#form_ch p[name="jperempuan"]').html(obj.data[0].ja_p);
                            $('form#form_ch p[name="tempat"]').html(obj.data[0].tempat);
                            $('form#form_ch p[name="ekon"]').html(obj.ekon);
                            $('form#form_ch p[name="tgl"]').html(obj.data[0].tgl);
                            $('form#form_ch p[name="waktu"]').html(obj.data[0].waktu);
                            $('form#form_ch p[name="nm_pen"]').html(obj.data[0].nm_pecatat);
                            $('form#form_ch p[name="nm_pel"]').html(obj.data[0].nm_pelapor);
                            $('form#form_ch p[name="jk_p"]').html(obj.data[0].jk_p);
                            $('form#form_ch p[name="usia_p"]').html(obj.data[0].usia_p);
                            $('form#form_ch p[name="penjelasan"]').html(obj.data[0].ket);
                            $('form#form_ch input[name="id"]').val(obj.id);
                            //Verifikasi
//                            $("#ver").html(obj.content_ver);
                            $("#table_v").html(obj.table_ver);
                            //Hasil Verifikasi
                            $('form#hasilver div[name="sk"]').html(obj.status_kasus);
                            $('form#hasilver p[name="alter"]').html(obj.alasan);
                            //$('form#hasilver textarea[name="alter"]').val(obj.alasan);
                            //Dokumen Pembahasan Kasus
                            $('form#form_dpk input[name="inp_wp"]').val(obj.tgl_dpk);
                            $('form#form_dpk input[name="inp_jm"]').val(obj.waktu);
                            $('form#form_dpk input[name="peserta"]').val(obj.peserta);
                            $('form#form_dpk p[name="penjelasan"]').html(obj.penjelasan);
                            $('form#form_dpk div[name="sosial"]').html(obj.sosial);
                            $('form#form_dpk div[name="ideologi"]').html(obj.ideologi);
                            $('form#form_dpk div[name="kriminal"]').html(obj.kriminal);
                            //keputusan Pembahasan kasus
                            $('form#form_kpk div[name="rm"]').html(obj.remedial);
                            $('form#form_kpk input[name="remedial_l"]').val(obj.remedial_l);
                            $('form#form_kpk div[name="rk"]').html(obj.rujukan);
                            $('form#form_kpk input[name="rujukan_l"]').val(obj.rujukan_l);
                            $('form#form_kpk input[name="termin"]').val(obj.termin);
                            //Dokumentasi Penanganan Kasus Remedial
                            $('form#form_dpkr div[name="kr"]').html(obj.penanganan);
                            $('form#form_dpkr input[name="pkrl"]').val(obj.pk_l);
                            $('form#form_dpkr div[name="pr"]').html(obj.pelaksana);
                            $('form#form_dpkr input[name="prl"]').val(obj.pl_l);
                            $('form#form_dpkr input[name="tmpt"]').val(obj.tempat);
                            $('form#form_dpkr input[name="inp_wp"]').val(obj.tanggal);
                            $('form#form_dpkr input[name="inp_to"]').val(obj.to_tgl);
                            $('form#form_dpkr div[name="juml"]').html(obj.jumlah);
                            $('form#form_dpkr input[name="jkr_l"]').val(obj.jk_l);
                            $("#form_dpkr :input").prop("disabled", true);
                            //Keputusan Penangan Kasus Remedial
                            $('form#form_kpkr input[name="termin"]').val(obj.termin2);
                            $('form#form_kpkr div[name="rk"]').html(obj.rujukan2);
                            $('form#form_kpkr input[name="alru"]').val(obj.alasan2);
                            $('form#form_kpkr input[name="rekom"]').val(obj.rekom);
                            $('form#form_kpkr input[name="rujukan_l"]').val(obj.rujukan_l);
                            //Dokumen kasus Rujukan ke polsek
                            $('form#form_dpk input[name="inp_wp"]').val(obj.tgl_kasus_krpk);
                            $('form#form_dpk input[name="tempat"]').val(obj.tempat_krpk);
                            $('form#form_dpk div[name="pbkasus"]').html(obj.pengajuan);
                            $('form#form_dpk input[name="nm_pengaju"]').val(obj.nm_pengajuan);
                            $('form#form_dpk input[name="nm_penerima"]').val(obj.nm_penerima);
                            $('form#form_dpk div[name="sprujukan"]').html(obj.status_proses);  
                            $('form#form_dpk input[name="vonis"]').val(obj.vonis);
                            $('form#form_dpk div[name="sakrujukan"]').html(obj.status_akhir);
                            //Dokumen Pembahasan puskesmas
                            $('form#form_dpkp input[name="inp_wp"]').val(obj.tgl_dpk);
                            $('form#form_dpkp input[name="tmpt"]').val(obj.tempat_dpk);
                            $('form#form_dpkp div[name="pbkasus"]').html(obj.kasus_dpk);
                            $('form#form_dpkp input[name="nm_pengaju"]').val(obj.nama_pengaju_dpk);
                            $('form#form_dpkp input[name="nm_penerima"]').val(obj.nama_penerima_dpk);
                            $('form#form_dpkp div[name="jlp_diberikan"]').html(obj.jenis_layanan_dpk);
                            $('form#form_dpkp input[name="puskesmas_lain"]').val(obj.jenis_lain_dpk);
                            $('form#form_dpkp div[name="stsakhir"]').html(obj.status_akhir_dpk);
                            
                            $('.list_program_wrapper').hide();
                            $('.List_pp').show();
                            $('.List_hasil').show();
                            $('.List_detail').show();
                            loading.hide();
                        }
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
                    else{
                        show_alert_ms(msg_obj,99,response);
                        loading.hide();
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
        
        $(".kembali").click(function(e){
            e.preventDefault();
            //form_ch[0].reset();
//            $('.List_detail').hide('');
//            $('.fade').hide('');
//            $('.list_program_wrapper').show();
//            $('.list_program_wrapper').focus();
$('.list_program_wrapper').show();
$('.list_program_wrapper').focus();
                            $('.List_pp').hide();
                            $('.List_hasil').hide();
                            $('.List_detail').hide();
        }); 
        //
        //download
        //
        table.on('click', 'a.download', function(e){
            e.preventDefault();
            e.kasus     = $(this).data("id");
            window.open(base_url+controller+"/Download_excel?id="+e.kasus);
                       // ajax_url = controller+"/Download_excel";
        });
        
        function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
        
       var form_ch = $("#form_ch"); 
       form_ch.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
               
            }
            ,
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
                var url = controller+"/add_ver";
                var data = form_ch.serialize();
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
                                oading.hide();
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
       $("form#form_ch").change(function(e){
          // form_ch();
           form_ch[0].call();
//            loading.show();
//            var id      = $("#id");
//            
//            var url = controller+"/add_ver";
//                var data = form_ch.serialize();
//                
//                data+="&"+csrf_name+"="+$("#csrf").val();                
//                loading.show();
//                msg_obj.hide();
//                jQuery.ajax({
//                    type: "POST", // HTTP method POST or GET
//                    url: base_url+url, //Where to make Ajax calls
//                    dataType:"text", // Data type, HTML, json etc.
//                    data:data, //Form variables
//                    success:function(response){
//                        var obj = null;
//                        try{
//                            obj = $.parseJSON(response);  
//                        }catch(e)
//                        {}
//                        //var obj = jQuery.parseJSON(response);
//
//                        if(obj)//if json data
//                        {
//                            loading.hide();$("#csrf").val(obj.csrf_hash);
//                            //success msg
//                            if(obj.status === 1){
//                                loading.hide();
//                            }
//
//                            //error msg
//                            else if(obj.status === 0){
//                                sweetAlert("Error", obj.msg, "error");
//                            }
//                            //datatable.ajax.reload();
//                        }
//                        else
//                        {
//                            sweetAlert("Error", response, "error");
//                            loading.hide();
//                        }
//                    },
//                    error:function (xhr, ajaxOptions, thrownError){
//                        loading.hide(); 
//                        sweetAlert("FATAL ERROR", thrownError, "error");
//                    }
//                });
//                return false;
            
       });

    };
   
    return{
        init:function(){datatable();}
//        detail:function(){detail();}
    };
}();