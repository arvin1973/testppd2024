var main = function(){
    controller = "index.php/Project_location";
    var datatable = function(){
        var t_cust = $("#t_cust");
        var t_proj = $("#t_project");
        var t_loca = $("#t_location");
        var DT_cust = t_cust.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/DT_customer", // json datasource
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
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
       });
        
        var DT_proj = t_proj.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/DT_project", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                },
                data: function(d){
                    d.id     =$("#custid").val();
                },
                "dataSrc": function ( json ) {
                    //Make your callback here.
//                    $("#csrf").val(json.csrf_hash);
                    return json.data;
                }
                
            },
            "columnDefs": [ 
                
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
       });
        
        var DT_loca = t_loca.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/DT_location", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                },
                data: function(d){
                    d.id     =$("#projid").val();
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
       });
        
        
        var forml = $("#formAdd");
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                code:{required:true},
                desc:{required:true},
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
                data+="&id="+$("#projid").val();
                
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
                                DT_loca.ajax.reload(function(){
                                    sweetAlert("Success", obj.msg, "success");forml[0].reset();
                                    DT_loca.columns.adjust().draw();
                                    loading.hide();
                                });
                            }

                            //error msg
                            else if(obj.status === 0){
                                
                                DT_loca.ajax.reload(function(){
                                    sweetAlert("Error", obj.msg, "error");loading.hide();DT_loca.columns.adjust().draw();
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
        
        t_cust.on('click', 'a.detail', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var label      = $(this).data("label");
            $("#custid").val(id);
            $("#lbl_cust").html(label);
            $("#lbl_cust").parent().parent().show();
            loading.show();
            DT_proj.ajax.reload(function(){
                $(".wrapper_customer").hide();
                $(".wrapper_project").show();
                $(".wrapper_info").show();
                loading.hide();
            });
        });
        t_proj.on('click', 'a.detail', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var label      = $(this).data("label");
            $("#projid").val(id);
            $("#lbl_proj").html(label);
            $("#lbl_proj").parent().parent().show();
            loading.show();
            DT_loca.ajax.reload(function(){
                $(".wrapper_customer").hide();
                $(".wrapper_project").hide();
                $(".wrapper_location").show();
                $(".wrapper_info").show();
                DT_loca.columns.adjust().draw();
                loading.hide();
            });
        });
        
        t_loca.on('click', 'a.hapus', function(e){
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
                                        DT_loca.ajax.reload(function(){
                                            loading.hide();
                                            sweetAlert("Success", obj.msg, "success");
                                        });
                                    }
                                    else if(obj.status === 0){
                                        DT_loca.ajax.reload(function(){
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
        
        t_loca.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_get";
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
                            $('form#form_edit input[name="id"]').val(obj.id);
                            $('form#form_edit input[name="code"]').val(obj.data[0].code);
                            $('form#form_edit input[name="desc"]').val(obj.data[0].desc);
                            
                            loading.hide();
                            $("#modal_edit").modal("show");
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
                desc:{required:true},
                
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
                                DT_loca.ajax.reload(function(){
                                    form_e[0].reset();
                                    $("#csrf").val(obj.csrf_hash);
                                    $("#modal_edit").modal("hide");
                                });
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                                DT_loca.ajax.reload();
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
            $('#modal_add').modal('show');
        });
        $(".btn_back").click(function(e){
            e.preventDefault();
            var _self = $(this);
            var _target = $(_self.data("target"));
            var _tohide = _self.data("tohide").split(',');
            var _no = _self.data("no");
            
            $.each(_tohide,function(index,value){
                $(value).parents(".form-group").hide();
            });
            
            _self.parents(".row").hide();
            _target.show();
            if(_no =='1')
                $(".wrapper_info").hide();
            
        });
        $(".btn_reload").click(function(e){
            e.preventDefault();
            var _self = $(this);
            var _set = _self.data("set");
            if(_set=="DT_cust"){
                DT_cust.ajax.reload();
            }
            else if(_set=="DT_proj"){
                DT_proj.ajax.reload();
            }
            else{
                DT_loca.ajax.reload();
            }
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