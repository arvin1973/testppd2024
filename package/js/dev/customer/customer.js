var main = function(){
    controller = "index.php/Customer";
    var datatable = function(){
        var table = $("#data");
        var tbl_ing_edit = $("#tbl_detail_edit");
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
                { "targets": 3, "orderable": false },
                { "width": "50px", "targets": 3 }
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
       });
        
        var datatable_detail = tbl_ing_edit.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/get_datatable_detail", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                },
                data: function(d){
                    d.id     =$("#detailid").val();
                },
                "dataSrc": function ( json ) {
                    //Make your callback here.
//                    $("#csrf").val(json.csrf_hash);
                    return json.data;
                }
                
            },
            "columnDefs": [ 
                { "targets": 3, "orderable": false },
                { "width": "50px", "targets": 3 }
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
       });
        
        
        var forml = $("#form_add");
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                code:{required:true},
                name:{required:true},
                address:{required:true},
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
                jQuery.ajax({
                    type: "POST",
                    url: base_url+url,
                    dataType:"text",
                    data:data,
                    success:function(response){
                        var obj = null;
                        try{
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                
                                $("#detailid").val(obj.id);
                                datatable_detail.ajax.reload(function(){
                                    $("#form_add :input").prop("disabled", true);
                                    $(".formedit_wrapper").hide();
                                    $(".detail_wrapper").show();
                                    sweetAlert("Success", obj.msg, "success");loading.hide();
                                });
                            }

                            //error msg
                            else if(obj.status === 0){
                                
                                datatable.ajax.reload(function(){
                                    sweetAlert("Error", obj.msg, "error");loading.hide();
                                });
                            }
                            
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
        
        var formAddDetail = $("#formAddDetail");
        formAddDetail.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                code:{required:true},
                name:{required:true},
                address:{required:true},
            }
            ,
            errorPlacement: function(error, element) {
                if (element.attr("name") === "tgl_isi" || element.attr("name") === "tgl_lahir" ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) { 
                $(element)
                .closest('.form-group').addClass('has-error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var url = controller+"/addDetail_act";
                var data = formAddDetail.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val();
                data+="&id="+$("#detailid").val();
                
                loading.show();
                jQuery.ajax({
                    type: "POST", 
                    url: base_url+url,
                    dataType:"text",
                    data:data,
                    success:function(response){
                        var obj = null;
                        try{
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            $("#csrf").val(obj.csrf_hash);
                            //success msg
                            if(obj.status === 1){
                                datatable_detail.ajax.reload(function(){
                                    loading.hide();
                                    sweetAlert("Success", obj.msg, "success");
                                    formAddDetail[0].reset();
                                    datatable_detail.columns.adjust().draw();
                                });
                                
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");loading.hide();
                            }
                            
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

                                if(obj)
                                {
                                    if(obj.status === 1){
                                        loading.hide();
                                        sweetAlert("Success", obj.msg, "success");
                                    }
                                    else if(obj.status === 0){
                                        loading.hide();
                                        sweetAlert("Error", obj.msg, "error");
                                    }

                                    else if(obj.status === 2){
                                        sweetAlert("Caution", obj.msg, "info");

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
        
        tbl_ing_edit.on('click', 'a.hapus', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            var msg_obj = $("#msg");
            bootbox.confirm("Anda Yakin Hapus data : <i>"+title+"</i>?", function(result) {
                   if(result) {
                        ajax_url = controller+"/delete_detail";
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

                                if(obj)
                                {
                                    if(obj.status === 1){
                                        datatable_detail.ajax.reload(function(){
                                            loading.hide();
                                            sweetAlert("Success", obj.msg, "success");
                                        });
                                    }
                                    else if(obj.status === 0){
                                        datatable_detail.ajax.reload(function(){
                                            loading.hide();
                                            sweetAlert("Error", obj.msg, "error");
                                        });
                                    }
                                    else if(obj.status === 2){
                                        sweetAlert("Caution", obj.msg, "info");

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
            $("#detailid").val(id);
            jQuery.ajax({
                type: "POST", 
                url: base_url+ajax_url, 
                dataType:"text", 
                data:ajax_data,
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
                            $('form#form_edit input[name="id"]').val(obj.id);
                            $('form#form_edit input[name="code"]').val(obj.data[0].code);
                            $('form#form_edit input[name="name"]').val(obj.data[0].name);
                            $('form#form_edit input[name="address"]').val(obj.data[0].address);
                            
                            datatable_detail.ajax.reload(function(){
                                $('.formadd_wrapper').hide();
                                $('.list_datatable').hide();
                                $('.formedit_wrapper').show();
                                $('.detail_wrapper').show();
                                datatable_detail.columns.adjust().draw();
                                loading.hide();
                            });
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
        
        tbl_ing_edit.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_material_get";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            jQuery.ajax({
                type: "POST", 
                url: base_url+ajax_url, 
                dataType:"text", 
                data:ajax_data,
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
                            $('form#formEditDetail input[name="id"]').val(obj.id);
                            $('form#formEditDetail input[name="code"]').val(obj.data[0].code);
                            $('form#formEditDetail input[name="name"]').val(obj.data[0].name);
                            $('form#formEditDetail input[name="address"]').val(obj.data[0].address);
                            
                            datatable_detail.ajax.reload(function(){
                                $('#modalEditDetail').modal("show");
                                loading.hide();
                            });
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
                strength:{required:true},
                slumps:{required:true},
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
                if (element.attr("name") === "tgl_lahir" ) {
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
                jQuery.ajax({
                    type: "POST", 
                    url: base_url+url, 
                    data:data,
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
                                datatable.ajax.reload(function(){
                                    form_e[0].reset();
                                    $("#csrf").val(obj.csrf_hash);
                                    $('.formadd_wrapper').hide();
                                    $('.list_datatable').show();
                                    $('.formedit_wrapper').hide();
                                });
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                                datatable.ajax.reload();
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
        
        var form_e_detail = $("#formEditDetail");
        form_e_detail.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                id:{required:true},
                qty:{required:true},
                unit:{required:true},
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
                if (element.attr("name") === "tgl_lahir" ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var data1 = new FormData(form_e_detail[0]);
                var url = controller+"/detail_edit_act";
//                var data = form_e.serialize();
                data1.append(csrf_name, $("#csrf").val());
                var data = data1;
                
                loading.show();
                jQuery.ajax({
                    type: "POST", 
                    url: base_url+url, 
                    data:data,
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
                                datatable_detail.ajax.reload(function(){
                                    form_e_detail[0].reset();
                                    $("#csrf").val(obj.csrf_hash);
                                    $('#modalEditDetail').modal("hide");
                                });
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                                datatable.ajax.reload();
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
        
        
        $("#modal_add_show").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $(".formadd_wrapper").show();
            $(".list_datatable").hide();
        });
        $(".btnBack").click(function(e){
            e.preventDefault();
            datatable.ajax.reload(function(){
                forml[0].reset();
                $(".formadd_wrapper").hide();
                $(".formedit_wrapper").hide();
                $(".detail_wrapper").hide();
                $(".list_datatable").show();

                $("#form_add :input").removeAttr("disabled");
            });
            
        });
        $(".btn_reload").click(function(e){
            e.preventDefault();
            datatable.ajax.reload();
        });
        $("#btn_reload_detail").click(function(e){
            e.preventDefault();
            datatable_detail.ajax.reload();
        });
        $("#btnAddDetail").click(function(e){
            e.preventDefault();
            $("#modalAddDetail").modal("show");
        });
    };
    
    return{
        init:function(){datatable();},
    };
}();