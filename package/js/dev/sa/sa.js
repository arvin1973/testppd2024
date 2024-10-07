var main = function(){
    controller = "index.php/Stock_adjustment";
    var datatable = function(){
        $('.inp_dp').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });
        jQuery('#timepicker2').timepicker({showMeridian: false});
        var table = $("#data");
        var tablematerial = $("#tblMaterial");
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
        
        var dttblMaterial = tablematerial.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/material_datatable", // json datasource
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
                { "width": "20px", "targets": 3 }
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
                unit:{required:true},
                matno:{required:true},
                qty:{required:true,number:true},
                unload_time:{required:true},
                grdate:{required:true},
            }
            ,
            errorPlacement: function(error, element) {
                if (element.attr("name") === "sadate" || element.attr("name") === "matno" ) {
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
                                        sweetAlert("Error", obj.msg, "error");
                                    }

                                    //session ended msg
                                    else if(obj.status === 2){
                                        sweetAlert("Caution", obj.msg, "error");

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
                            $('form#form_edit input[name="sanumber"]').val(obj.data[0].sa_no);
                            $('form#form_edit input[name="matcode"]').val(obj.data[0].matcode);
                            $('form#form_edit input[name="matname"]').val(obj.data[0].matname);
                            $('form#form_edit input[name="plant"]').val(obj.data[0].plantcode+" - "+obj.data[0].plantname);
                            $('form#form_edit input[name="sadate"]').val(obj.sa_date);
                            $('form#form_edit select[name="unit"]').html(obj.str);
                            $('form#form_edit input[name="qty"]').val(obj.data[0].qty);

                            $("#dp_edit").datepicker({
                                format: 'dd/mm/yyyy',
                                autoclose: true
                            }).datepicker("update", obj.sa_date); 
                            jQuery('#edit_tp').timepicker({showMeridian: false});
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
        
        tablematerial.on('click', 'a.btnSelect', function(e){
            e.preventDefault();
            var target      = $("#mdlMaterial .frmTrgt").val();
            var id          = $(this).data("id");
            var code        = $(this).data("code");
            var name        = $(this).data("name");
            if(target=='frmAdd'){
                
                $("#form_add #inp_material").val(code);
                $("#form_add #inp_matname").val(name);
                $("#form_add #inp_materialid").val(id);
            }
            else{
                $("#form_edit #inp_material").val(code+" - "+name);
                $("#form_edit #inp_materialid").val(id);
                $("#form_edit #inp_supplierid").val(id);
            }
            
            $('#mdlMaterial').modal('hide');
        });
        
        //EDIT DATA
        var form_e = $("#form_edit");
        form_e.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                id:{required:true},
                qty:{required:true,number:true},
                unit:{required:true},
                sadate:{required:true},
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
        $(".btnShwMat").click(function(e){
            var targetFrm = $(this).data("trgt");
            e.preventDefault();
            loading.show();
            dttblMaterial.ajax.reload(function(){
                loading.hide();
                $('#mdlMaterial .frmTrgt').val(targetFrm);
                $('#mdlMaterial').modal('show');
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
    };
    
    return{
        init:function(){datatable();},
    };
}();