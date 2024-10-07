var main = function(){
    controller = "index.php/Data_demografi_G1";
    var datatable = function(){
        var table = $("#data");
        var tbl_ing_edit = $("#tbl_detail_edit");
        var tbl_detail_kec = $("#tbl_detail_kec");
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
                { "targets": 2, "orderable": false },
                { "width": "50px", "targets": 2 }
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
//            dom: 'lfrtip',
//            buttons: [
//                {
//                    text: 'New',
//                    className: 'btn btn-default btn-sm waves-effect waves-light',
//                    action: function ( e, dt, node, config ) {
//                        $('#modal_add').modal('show') 
//                    }
//                }
//            ],
            "language": {
                "sProcessing":   "Sedang memproses...",
                "sLengthMenu":   "Tampilkan _MENU_ entri",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
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
        msg_obj.hide();
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                code:{required:true},
                name:{required:true},
                kabko:{required:true},
                kecam:{required:true},
                keldes:{required:true},
                mitra:{required:true},
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
//        var datatable_detail = tbl_ing_edit.DataTable({
//             "processing": true,
//             "serverSide": true,
//             "ajax":{
//                 url :base_url+controller+"/get_datatable_detail", // json datasource
//                 type: "post",  // method  , by default get
//                 error: function(){  // error handling
//                         $(".employee-grid-error").html("");
//                         $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
//                         $("#employee-grid_processing").css("display","none");
//
//                 },
//                 data: function(d){
//                     d.id     =$("#detailid").val();
//                 },
//                 "dataSrc": function ( json ) {
//                     //Make your callback here.
// //                    $("#csrf").val(json.csrf_hash);
//                     return json.data;
//                 }
//
//             },
//             "columnDefs": [ 
//                 { "targets": 3, "orderable": false },
//                 { "width": "50px", "targets": 3 }
//             ],
//             "initComplete": function(settings, json) {
// //                console.log(settings);
//             },
//             paging: true,
//        });
//        
//        var datatable_detail_kec = tbl_detail_kec.DataTable({
//             "processing": true,
//             "serverSide": true,
//             "ajax":{
//                 url :base_url+controller+"/get_datatable_kec", // json datasource
//                 type: "post",  // method  , by default get
//                 error: function(){  // error handling
//                         $(".employee-grid-error").html("");
//                         $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
//                         $("#employee-grid_processing").css("display","none");
//
//                 },
//                 data: function(d){
//                     d.id     =$("#detailidkec").val();
//                 },
//                 "dataSrc": function ( json ) {
//                     //Make your callback here.
// //                    $("#csrf").val(json.csrf_hash);
//                     return json.data;
//                 }
//
//             },
//             "columnDefs": [ 
//                 { "targets": 3, "orderable": false },
//                 { "width": "50px", "targets": 3 }
//             ],
//             "initComplete": function(settings, json) {
// //                console.log(settings);
//             },
//             paging: true,
//        });
       
       
       
       
        
        var forml_kk = $("#form_add_kk");
        
        forml_kk.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                id:{required:true},
                code_kk:{required:true},
                name_kk:{required:true},
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
                var url = controller+"/add_act_kk";
                var data = forml_kk.serialize();
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
                                forml_kk[0].reset();
                            }
                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //datatable_detail.ajax.reload();
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
        
        table.on('click', 'a.hapus', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            var msg_obj = $("#msg");
            bootbox.confirm("Anda Yakin Hapus data : <i>"+title+"</i>?", function(result) {
                   if(result) {
                        ajax_url = controller+"/delete";
                        ajax_data = "id="+id;
                        ajax_data+="&"+csrf_name+"="+$("#csrf").val();
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
                                        sweetAlert("Success", obj.msg, "success");
                                    }
                                    //error msg
                                    else if(obj.status === 0){
//                                        show_alert_ms(msg_obj,0,obj.msg);
//                                        goToMessage(msg_obj);
                                        loading.hide();
                                        bootbox.alert({
                                            message: obj.msg,
                                            title: "Alert!",
                                        });
                                    }

                                    //session ended msg
                                    else if(obj.status === 2){
                                        show_alert_ms(msg_obj,0,obj.msg);

                                        window.setTimeout(function(){
                                            window.location.href = base_url+"welcome"; //redirect ke login page
                                        }, 2000);
                                    }
                                    $("#csrf").val(obj.csrf_hash);
                                    datatable.ajax.reload();
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
                    }
                    else{return;}
                }); 
        });
        
        table.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_get";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            $("#detailid").val(id);
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
                            $('form#form_edit input[name="id"]').val(obj.id);
                            $('form#form_edit input[name="code"]').val(obj.data[0].kode);
                            $('form#form_edit input[name="name"]').val(obj.data[0].nama_pro);
                            $('form#form_edit input[name="name_kab"]').val(obj.data[0].nm_kabko);
                            $('form#form_edit input[name="name_kec"]').val(obj.data[0].nm_kec);
                            $('form#form_edit input[name="name_kel"]').val(obj.data[0].keldes);
                            $('form#form_edit input[name="mitra"]').val(obj.data[0].mitra);
                            $('form#form_edit input[name="rt"]').val(obj.data[0].rt);
                            $('form#form_edit input[name="rw"]').val(obj.data[0].rw);
//                            $('form#form_edit input[name="laki"]').val(obj.data[0].jml_lk);
//                            $('form#form_edit input[name="wanita"]').val(obj.data[0].jml_per);
                            $('form#form_edit input[name="manula_lk"]').val(obj.data[0].manula_lk);
                            $('form#form_edit input[name="manula_pr"]').val(obj.data[0].manula_pr);
                            $('form#form_edit input[name="dewasa_lk"]').val(obj.data[0].dws_lk);
                            $('form#form_edit input[name="dewasa_pr"]').val(obj.data[0].dws_pr);
                            $('form#form_edit input[name="anak_lk"]').val(obj.data[0].anak_lk);
                            $('form#form_edit input[name="anak_pr"]').val(obj.data[0].anak_pr);
                            $('form#form_edit input[name="pns"]').val(obj.data[0].pns);
                            $('form#form_edit input[name="petani"]').val(obj.data[0].petani);
                            $('form#form_edit input[name="nelayan"]').val(obj.data[0].nelayan);
                            $('form#form_edit input[name="wiraswasta"]').val(obj.data[0].wiraswasta);
                                                        $('form#form_edit input[name="peternakan"]').val(obj.data[0].peternakan);
                            $('form#form_edit input[name="pedagang"]').val(obj.data[0].pedagang);
                            $('form#form_edit input[name="informal"]').val(obj.data[0].p_informal);
                            
                            $('form#form_edit input[name="lain"]').val(obj.data[0].lain);
                                                        $('form#form_edit input[name="klinik"]').val(obj.data[0].puske);
                            $('form#form_edit input[name="paud"]').val(obj.data[0].paud);
                            $('form#form_edit input[name="tk"]').val(obj.data[0].tk);
                            $('form#form_edit input[name="sdmi"]').val(obj.data[0].sdmi);
                            $('form#form_edit input[name="smpmts"]').val(obj.data[0].smpmts);
                            $('form#form_edit input[name="smama"]').val(obj.data[0].smama);
                            $('form#form_edit input[name="smk"]').val(obj.data[0].smk);
                            $('form#form_edit input[name="ponpes"]').val(obj.data[0].ponpes);
                            $('form#form_edit input[name="akademi"]').val(obj.data[0].akademi);
                            
                            $('form#form_edit input[name="masjid"]').val(obj.data[0].masjid);
                            $('form#form_edit input[name="gereja"]').val(obj.data[0].gereja);
                            $('form#form_edit input[name="pura"]').val(obj.data[0].pura);
                            $('form#form_edit input[name="ibadahlain"]').val(obj.data[0].lainya);
                            
                            $('form#form_edit label[name="cpolsek"]').html(obj.str_pol);
                            $('form#form_edit label[name="cdk"]').html(obj.str_dk);
                            $('form#form_edit label[name="cksp"]').html(obj.str_ksp);
                            $('form#form_edit label[name="cp2t"]').html(obj.str_p2t);
                            $('form#form_edit label[name="cpd"]').html(obj.str_pd);
                            
                            $('form#form_edit label[name="cpkk"]').html(obj.str_pkk);
                            $('form#form_edit label[name="mtlkk"]').html(obj.str_mtlkk);
                            $('form#form_edit label[name="cmtp"]').html(obj.str_mtp);
                            $('form#form_edit label[name="ckarang"]').html(obj.str_karang);
                            $('form#form_edit label[name="ctpa"]').html(obj.str_tpa);
                            $('form#form_edit label[name="crm"]').html(obj.str_rm);
                            $('form#form_edit label[name="ckp"]').html(obj.str_kp);
                            
                            $('form#form_edit input[name="ormas"]').val(obj.data[0].ormas);
                            $('form#form_edit input[name="klainnya"]').val(obj.data[0].k_lain);
                           // $('form#form_edit input[name="mitra"]').val(obj.data[0].mitra);
                            //$('#modal_edit').modal('show');
                            $('.list_program_wrapper').hide();
                            $('.formedit_wrapper').show();

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
            $('.list_program_wrapper').show();
                            $('.formedit_wrapper').hide();

        }); 
        
        tbl_ing_edit.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            //alert($(this).data("id"));
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_kabko";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            $("#detailid").val(id);
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+ajax_url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:ajax_data, //Form variables
                success:function(response){
                    var obj = null;
                    try
                    { obj = $.parseJSON(response);  }
                    catch(e) {}
                    //var obj = jQuery.parseJSON(response);
                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            loading.hide();
                            $('form#form_edit_kabko input[name="id"]').val(obj.id);
                            $('form#form_edit_kabko input[name="code"]').val(obj.data[0].code);
                            $('form#form_edit_kabko input[name="name"]').val(obj.data[0].name);
//                            //$('form#form_add_kk input[name="id_code_kk"]').val(obj.id);
//                            //$('#modal_edit').modal('show');
                            datatable_detail_kec.ajax.reload(function(){
                                $('.list_program_wrapper').hide();
                                $('.formedit_wrapper').hide();
                                $('.detail_wrapper').hide();
                                $('.formedit_kabko').show();
                                $('.detail_wrapper_kec').show();
                                datatable_detail_kec.columns.adjust().draw();
//                                loading.hide();
                            });
                            $('.formedit_kabko').show();
                            
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
        //EDIT DATA
        var form_e = $("#form_edit");
        form_e.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                id:{required:true},
                code:{required:true},
                name:{required:true},
                name_kab:{required:true},
                name_kec:{required:true},
                name_kel:{required:true},
                
            }
            ,
            highlight: function (element) { // hightlight error inputs
                $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // hightlight error inputs
                $(element)
                .closest('.has-error').removeClass('has-error'); // set error class to the control group
            },
//            errorPlacement: function(error, element) {
//                if (element.attr("name") === "tgl_lahir" ) {
//                    error.insertAfter(element.parent());
//                } else {
//                    error.insertAfter(element);
//                }
//            },
            submitHandler: function(form) {
                // some other code
                // maybe disabling submit button
                // then:
                var data1 = new FormData(form_e[0]);
                var url = controller+"/detail_act";
//                var data = form_e.serialize();
                data1.append(csrf_name, $("#csrf").val());
                var data = data1;
                
                loading.fadeIn();
                msg_obj = $("#msg_edit");
                msg_obj.hide();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+url, //Where to make Ajax calls
//                    dataType:"text", // Data type, HTML, json etc.
                    data:data, //Form variables
                    mimeType: "multipart/form-data",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        var obj = null;
                        try{
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                sweetAlert("Success", obj.msg, "success");
                                
                                form_e[0].reset();
                                $('.list_program_wrapper').show();
                            $('.formedit_wrapper').hide();
                                window.setTimeout(function(){
                                    msg_obj.fadeOut();
                                    $('#modal_edit').modal('hide');
                                }, 2000);
                                $("#csrf").val(obj.csrf_hash);
                                datatable.ajax.reload();
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                                datatable.ajax.reload();
                            }
                            loading.hide();
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                    }
                });
                return false;
            }
        });
        
        $("#modal_add_show").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('#modal_add').modal('show');
        });
        $("#btnAddDetail").click(function(e){
            e.preventDefault();
            forml_kk[0].reset();
            $('#modal_add_kk').modal('show');
        });
        
        $("#select_tahun").change(function(e){
            e.preventDefault();
            datatable.ajax.reload();
        });
        
        table.on('click', 'a.download', function(e){
            e.preventDefault();
            e.iddaerah     = $(this).data("id");
//            var id      = $(this).data("id");
//            var title   = $(this).data("title");
//            var msg_obj = $("#msg");

                       window.open(base_url+controller+"/Download_excel?id="+e.iddaerah);
                       // ajax_url = controller+"/Download_excel";

                    
        });
        
    };
    var detail = function(){
        controller = "index.php/r_department";
        var form_edit = $("#form");
        form_edit.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                thn:{required:true},
                code:{required:true},
                name:{required:true},
            }
            ,
            errorPlacement: function(error, element) {
                if (element.attr("name") === "tgl_isi" || element.attr("name") === "tgl_lahir" ) {
                    error.insertAfter(element.parent());
                } 
                else if (element.attr("name") === "st_hamil" || element.attr("name") === "st_cerai" ) {
                    error.insertAfter(element.parent().children("br.error_sini"));
                } 
                else {
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
                var data = form_edit.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val();
                var url = controller+"/detail_act";
                loading = $(".spinner");
                loading.fadeIn();
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
                            var msg_obj=$("#msg_box_edit");
                            //success msg
                            if(obj.status === 1){
                                sweetAlert("Success", obj.msg, "success");
                                window.setTimeout(function(){
                                    msg_obj.fadeOut();
                                }, 2000);
                                $('#modal_edit').modal('hide');
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Oops...", obj.msg, "error");
                            }
                            $("#csrf").val(obj.csrf_hash);
                            loading.hide();
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        loading.hide(); 
                        alert(thrownError);
                    }
                });
                return false;
            }
        });

    };
    return{
        init:function(){datatable();},
        detail:function(){detail();}
    };
}();