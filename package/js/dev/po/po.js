var main = function(){
    controller = "index.php/Purchase_order";
    var datatable = function(){
        $('.inp_dp').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });
        var table = $("#data");
        var tbl_detail = $("#tbl_detail_edit");
        var tableSupplier = $("#tblSupplier");
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
                { "targets": 3, "orderable": false },
                { "targets": 3, "class": "text-right"},
                { "width": "50px", "targets":3 }
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
            
       });
        var datatable_detail = tbl_detail.DataTable({
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
       });
        
        var dttblSupplier = tableSupplier.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/supplier_datatable", // json datasource
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
                ponumber:{required:true},
                volume:{required:true,number:true},
                unit:{required:true},
                material:{required:true},
                supplier:{required:true},
                podate:{required:true},
                attch:{extension: "pdf|doc|docx",filesize: 3000000}, //3 mb
            }
            ,
            errorPlacement: function(error, element) {
                if (element.attr("name") === "podate" || element.attr("name") === "material" || element.attr("name") === "supplier" ) {
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
                
                var data1 = new FormData(forml[0]);
                data1.append(csrf_name, $("#csrf").val());
                var data = data1;
                
                loading.show();
                msg_obj.hide();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+url, //Where to make Ajax calls
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
                            loading.hide();$("#csrf").val(obj.csrf_hash);
                            //success msg
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
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'Ukuran berkas maksimal 3 Mb');
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
                            $('form#form_edit input[name="id"]').val(id);
                            $('form#form_edit input[name="ponumber"]').val(obj.data[0].po_no);
                            $('form#form_edit input[name="volume"]').val(obj.data[0].volume);
                            $('form#form_edit input[name="address"]').val(obj.data[0].address);
                            $('form#form_edit input[name="supplier"]').val(obj.data[0].suppliercode+" - "+obj.data[0].suppliername);
                            $('form#form_edit input[name="supplierid"]').val(obj.supplierid);
                            $('form#form_edit input[name="podate"]').val(obj.po_date);
                            $('form#form_edit select[name="unit"]').html(obj.str);
                            
                            datatable_detail.ajax.reload(function(){
                                $('.formadd_wrapper').hide();
                                $('.list_wrapper').hide();
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
        
        tableSupplier.on('click', 'a.btnSelect', function(e){
            e.preventDefault();
            var target      = $("#mdlSupplier .frmTrgt").val();
            var id          = $(this).data("id");
            var code        = $(this).data("code");
            var name        = $(this).data("name");
            var address     = $(this).data("address");
            if(target=='frmAdd'){
                
                $("#form_add #inp_supplier").val(code+" - "+name);
                $("#form_add #inp_address").val(address);
                $("#form_add #inp_supplierid").val(id);
            }
            else{
                $("#form_edit #inp_supplier").val(code+" - "+name);
                $("#form_edit #inp_address").val(address);
                $("#form_edit #inp_supplierid").val(id);
            }
            
            $('#mdlSupplier').modal('hide');

        });
        
        tablematerial.on('click', 'a.btnSelect', function(e){
            e.preventDefault();
            var target      = $("#mdlMaterial .frmTrgt").val();
            var id          = $(this).data("id");
            var code        = $(this).data("code");
            var name        = $(this).data("name");
            if(target=='frmAdd'){
                
                $("#form_add #inp_material").val(code+" - "+name);
                $("#form_add #inp_materialid").val(id);
                $("#form_add #inp_supplierid").val(id);
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
                volume:{required:true,number:true},
                unit:{required:true},
                material:{required:true},
                supplier:{required:true},
                podate:{required:true},
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
        
        var formAddDetail = $("#formAddDetail");
        formAddDetail.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                material:{required:true},
                qty:{required:true,number:true},
                unit:{required:true},
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
                            if(obj.status === 1){
                                datatable_detail.ajax.reload(function(){
                                    loading.hide();
                                    sweetAlert("Success", obj.msg, "success");
                                    formAddDetail[0].reset();
                                    datatable_detail.columns.adjust().draw();
                                });
                            }
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "info");

                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome"; //redirect ke login page
                                }, 2000);
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
        
        tbl_detail.on('click', 'a.hapus', function(e){
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
        tbl_detail.on('click', 'a.edit', function(e){
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
                            $('form#formEditDetail input[name="machine"]').val(obj.data[0].machname);
                            $('form#formEditDetail select[name="unit"]').html(obj.str);
                            $('form#formEditDetail input[name="material"]').val(obj.data[0].matname);
                            $('form#formEditDetail input[name="qty"]').val(obj.data[0].qty);
                            
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
        
        $("#addBtn").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('.formadd_wrapper').show();
            $('.list_wrapper').hide();
        });
        $(".btnShwSupp").click(function(e){
            var targetFrm = $(this).data("trgt");
            e.preventDefault();
            loading.show();
            dttblSupplier.ajax.reload(function(){
                loading.hide();
                $('#mdlSupplier .frmTrgt').val(targetFrm);
                $('#mdlSupplier').modal('show');
            });
        });
        $(".btnBack").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('.formadd_wrapper').hide();
            $('.formedit_wrapper').hide();
            $('.detail_wrapper').hide();
            $('.list_wrapper').show();
        });
        $(".btnRefresh").click(function(e){
            e.preventDefault();
            forml[0].reset();loading.show();
            datatable.ajax.reload(function(){
                loading.hide();
            });
        });
        $("#btn_reload_detail").click(function(e){
            e.preventDefault();
            loading.show();
            datatable_detail.ajax.reload(function(){
                loading.hide();
            });
        });
        $("#btnAddDetail").click(function(e){
            e.preventDefault();
            $("#modalAddDetail").modal("show");
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