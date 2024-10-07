var main = function(){
    controller = "index.php/Good_received";
    var datatable = function(){
        $('.inp_dp').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });
        jQuery('#timepicker2').timepicker({showMeridian: false});
        jQuery('#timepicker3').timepicker({showMeridian: false});
        var table = $("#data");
        var tablePo = $("#tblPo");
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
                { "targets": 6, "orderable": false },
                { "width": "50px", "targets":6 }
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
            
       });
        
        var dttblPo = tablePo.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/po_datatable", // json datasource
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
                { "targets": 3, "orderable": false },
                { "width": "20px", "targets": 3}
            ],
            "initComplete": function(settings, json) {
            },
            paging: true,
            
       });
        
        
        
        var forml = $("#form_add");
        var msg_obj=$("#msg_add");
        msg_obj.hide();
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                grnumber:{required:true},
                dn:{required:true},
                podetid:{required:true},
                truckid:{required:true},
                qty:{required:true,number:true},
                unload_time:{required:true},
                grdate:{required:true},
                regdate:{required:true},
                undate:{required:true},
            }
            ,
            errorPlacement: function(error, element) {
                if (element.attr("name") === "grdate" || element.attr("name") === "pono" ) {
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
                                $('form#form_add input[name="grnumber"]').val(obj.trans_no);
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
                                        
                                        datatable.ajax.reload(function(){
                                            loading.hide();
                                            sweetAlert("Success", obj.msg, "success");
                                        });
                                        
                                    }
                                    //error msg
                                    else if(obj.status === 0){
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
                            $('form#form_edit input[name="id"]').val(id);
                            $('form#form_edit input[name="grnumber"]').val(obj.data[0].gr_no);
                            $('form#form_edit input[name="dn"]').val(obj.data[0].dn_no);
                            $('form#form_edit input[name="pono"]').val(obj.data[0].po_no);
                            $('form#form_edit input[name="address"]').val(obj.data[0].address);
                            $('form#form_edit input[name="mat"]').val(obj.data[0].matname);
                            $('form#form_edit input[name="supname"]').val(obj.data[0].supname);
                            $('form#form_edit input[name="supaddress"]').val(obj.data[0].supaddress);
                            $('form#form_edit input[name="plant"]').val(obj.data[0].plantcode+" - "+obj.data[0].plantname);
                            $('form#form_edit input[name="grdate"]').val(obj.gr_date);
                            $('form#form_edit input[name="reg_time"]').val(obj.data[0].reg_time);
                            $('form#form_edit input[name="unload_time"]').val(obj.data[0].unload_time);
                            $('form#form_edit input[name="qty"]').val(obj.data[0].qty);
                            $('form#form_edit input[name="truckid"]').val(obj.data[0].policeno);

                            $("#undate_edit").datepicker({
                                format: 'dd/mm/yyyy',
                                autoclose: true
                            }).datepicker("update", obj.unloaddt); 
                            $("#regdate_edit").datepicker({
                                format: 'dd/mm/yyyy',
                                autoclose: true
                            }).datepicker("update", obj.regdt); 
                            jQuery('#unloadtime_edit').timepicker({showMeridian: false});
                            jQuery('#vrt_edit').timepicker({showMeridian: false});
                            $('.formedit_wrapper').show();
                            $('.formadd_wrapper').hide();
                            $('.list_wrapper').hide();
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
        
        tablePo.on('click', 'a.btnSelect', function(e){
            e.preventDefault();
            var target      = $("#mdlPo .frmTrgt").val();
            var id          = $(this).data("id");
            var pono        = $(this).data("pono");
            var podate        = $(this).data("podate");
            var vol        = $(this).data("vol");
            var supplier        = $(this).data("supplier");
            var supaddress        = $(this).data("supaddress");
            var materialcode     = $(this).data("materialcode");
            var materialname     = $(this).data("materialname");
            var unit     = $(this).data("unit");
            if(target=='frmAdd'){
                
                $("#form_add #inp_pono").val(pono);
                $("#form_add #inp_poid").val(id);
                $("#form_add #inp_podate").val(podate);
                $("#form_add #inp_povolume").val(vol);
                $("#form_add #inp_supplier").val(supplier);
                $("#form_add #inp_address").val(supaddress);
            }
            else{
                $("#form_edit #inp_pono").val(pono);
                $("#form_edit #inp_poid").val(id);
                $("#form_edit #inp_podate").val(podate);
                $("#form_edit #inp_povolume").val(vol);
                $("#form_edit #inp_pounit").val(unit);
                $("#form_edit #inp_matcode").val(materialcode);
                $("#form_edit #inp_matname").val(materialname);
                $("#form_edit #inp_supplier").val(supplier);
                $("#form_edit #inp_address").val(supaddress);
            }
            
            ajax_url = controller+"/get_material_po";
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
                            $(".select_mat").html(obj.str);
                            $('#mdlPo').modal('hide');
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
                qty:{required:true,number:true},
                truckid:{required:true},
                dn:{required:true},
                unit:{required:true},
                unload_time:{required:true},
                grdate:{required:true},
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
            errorPlacement: function(error, element) {
                if (element.attr("name") === "grdate" ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                // some other code
                // maybe disabling submit button
                // then:
                var data1 = new FormData(form_e[0]);
                var url = controller+"/detail_act";
//                var data = form_e.serialize();
                data1.append(csrf_name, $("#csrf").val());
                var data = data1;
                
                loading.show();
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
                                datatable.ajax.reload(function(){
                                    loading.hide();
                                    sweetAlert("Success", obj.msg, "success");
                                });
                            }

                            //error msg
                            else if(obj.status === 0){loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                                datatable.ajax.reload();
                            }
                            $("#csrf").val(obj.csrf_hash);
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
        
        $("#addBtn").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('.formadd_wrapper').show();
            $('.list_wrapper').hide();
        });
        $(".btnShwPo").click(function(e){
            var targetFrm = $(this).data("trgt");
            e.preventDefault();
            loading.show();
            dttblPo.ajax.reload(function(){
                loading.hide();
                $('#mdlPo .frmTrgt').val(targetFrm);
                $('#mdlPo').modal('show');
            });
        });
        $(".btnBack").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('.formadd_wrapper').hide();
            $('.formedit_wrapper').hide();
            $('.list_wrapper').show();
        });
        $(".btnRefresh").click(function(e){
            e.preventDefault();
            forml[0].reset();loading.show();
            datatable.ajax.reload(function(){
                loading.hide();
            });
        });
        
        $(".select_mat").change(function(){
            var _self = $(this);
            var qty          = _self.find(':selected').data('qty');
            var unit          = _self.find(':selected').data("unit");
            $("#inp_povolume").val(qty);
            $("#inp_pounit").val(unit);console.log(unit)
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