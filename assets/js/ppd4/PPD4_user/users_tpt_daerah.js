var main = function(){
    controller = "index.php/PPD4_M_users_tpt_daerah";
    var datatable = function(){
        var table = $("#dataUser");
        var table_p = $("#t_dataProv");
        var table_kk = $("#t_dataKK");
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
                         //$("#ttl_qty").val(json.ttl_qty);
                         return json.data;
                     }

                 },
                 "columnDefs": [                  
                     { "targets": 2, "orderable": false },
                     { "width": "2px", "targets": 0},
                     { "width": "150px", "targets": 1},
//                     { "width": "80px", "targets": 2}                     
                 ],
                 "lengthMenu": [[5, 20, 25, 50, -1], [5, 20, 25, 50, "All"]],
                 "initComplete": function(settings, json) {
     //                console.log(settings);
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
        var forml = $("#form_add");
        var msg_obj=$("#msg_add");
        
        $("#modal_add_show").click(function(e){
                e.preventDefault();
                forml[0].reset();
            $('#modal_add').modal('show');
        });
        
        $("#select_groupadd").change(function(e){
            e.preventDefault();
            var _self = $(this);
            $(".group_wrapper").hide();
            if(_self.val()=='4'){
                $(".group_wrapper").show();
            }
        });
        msg_obj.hide();
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                code:{required:true},
                name:{required:true},
                email:{required:true}
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
                                $('#modal_add').modal('hide');
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

        table.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            var lblus       = _self.data("ustpt");
            var lblnm     = _self.data("nmtpt");
            var lblem     = _self.data("emtpt");
            $("#inp_user").val(id);
           $(".lbl_id_user").html(lblus).parent("tr").show();
            $(".lbl_nm_user").html(lblnm).parent("tr").show();
            $(".lbl_email_user").html(lblem).parent("tr").show();
            d_view();
        });  
        
        table.on('click', 'a.getEdit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_view";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            //$("#iduser").val(id);
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
                            $("#iduser").val(id);
                            $("#userid").val(obj.data[0].userid);
                            $("#nama").val(obj.data[0].name);
                            $("#email").val(obj.data[0].email);
                            $("#stts").html(obj.str_stts);
                            
                            $("._list_user").hide();
                            $("._edituser").css("display", "block");
                            
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
        
        function d_view(){
             loading.show();
             ajax_url = controller+"/detail_view";
             ajax_data="id="+$("#inp_user").val();
             ajax_data+="&"+csrf_name+"="+$("#csrf").val();
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

                     if(obj)
                     {
                         $("#csrf").val(obj.csrf_hash);
                         if(obj.status === 1){
                             $("#t_dataProv > tbody").html(obj.tbl_wilayah);
                             $("#t_dataKK > tbody").html(obj.tbl_kabupaten);
                             $("._list_user").hide();
                             $("._wrapper_info").show();
//                             $("._wrapper_wlyh").hide();
//                             $("._wrapper_info").show();
//                             $("._wrapper_bahan").show();
                             $("._wrapper_info").fadeIn();
                             loading.hide();
                         }
                         else if(obj.status === 0){
                             loading.hide();
                             sweetAlert("Error", obj.msg, "error");
                         }
                         else if(obj.status === 2){
                             sweetAlert("Caution", obj.msg, "warning");
                             window.setTimeout(function(){
                                 window.location.href = base_url+"welcome";
                             }, 2000);
                         }

                     }
                     else{
                         sweetAlert("Caution", response, "error");
                         loading.hide();
                         window.setTimeout(function(){
                             window.location.href = base_url+"welcome";
                         }, 2000);
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
         
        var formE = $("#form_edit");
        formE.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                iduser:{required:true},
                userid:{required:true},
                nama:{required:true},
                email:{required:true},
                stts:{required:true},
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
                var url = controller+"/detail_act";
                var data = formE.serialize();
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
                             toastr["success"](obj.msg);
                             datatable.ajax.reload();
                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-left",
                                  "preventDuplicates": false,
                                  "onclick": null,
                                  "showDuration": "300",
                                  "hideDuration": "1000",
                                  "timeOut": "5000",
                                  "extendedTimeOut": "1000",
                                  "showEasing": "swing",
                                  "hideEasing": "linear",
                                  "showMethod": "fadeIn",
                                  "hideMethod": "fadeOut"
                                };
                                
                                $("._list_user").show();
                                $("._edituser").hide();
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //datatable.ajax.reload();
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
        
        
       
        
//    add_provinsi dinilai tpt
        $("#modal_add_prov").click(function(e){
            e.preventDefault();
            var iduser = $("#iduser").val();
            $("#iduserp").val(iduser);
//            alert(iduser);
            $('#modal_wil').modal('show');
        });
        
//        add kabupaten dinilai tpt
        var table_k = $("#dataKab");
        var datatable_kab = table_k.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: base_url + controller + "/kab_datatable", // URL for the JSON datasource
                type: "post", // HTTP method to be used
                data: function(d) {
                    // Append dataID to the request payload
                    d.dataID = $("#inp_user").val();
                    
                    // Log dataID to the console to verify its value
                    console.log("dataID:", d.dataID);
                },
                error: function() { // Error handling
                    $(".employee-grid-error").html("");
                    $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#employee-grid_processing").css("display", "none");
                },
                "dataSrc": function(json) {
                    // Process JSON data returned from the server
                    return json.data;
                }
            },
            "columnDefs": [
                { "targets": 2, "orderable": false },
                { "width": "2px", "targets": 0 },
                { "width": "150px", "targets": 1 },
                // { "width": "80px", "targets": 2 }
            ],
            "lengthMenu": [[5, 20, 25, 50, -1], [5, 20, 25, 50, "All"]],
            "initComplete": function(settings, json) {
                // Optionally, you can do something when the initialization is complete
                // console.log(settings);
            },
            paging: true,
            "language": {
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ada data",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });
        
        
        $("#modal_add_kab").click(function(e){
            $('#list_kab').modal('show');
            $('#list_kab').on('shown.bs.modal', function() {

                ajax_data="id="+$("#inp_user").val();
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                $.ajax({
                    
                    url: controller+'/get_kabkot', // Update this URL to your actual controller method
                    type: 'POST',
                    dataType: 'json',
                    data: ajax_data,
                    success: function(data) {
                        // Clear existing options
                        $('#kabkot_select').empty();

                        // Populate options
                        $.each(data, function(index, item) {
                            $('#kabkot_select').append(
                                $('<option>', {
                                    value: item.id,
                                    text: item.nama_kabupaten
                                })
                            );
                        });

                        // Refresh the select picker
                        $('#kabkot_select').selectpicker('refresh');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            });
        });

        var form3 = $("#form_kab");
        form3.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
               // iduserp:{required:true},
                kk:{required:true},
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
                var url = controller+"/add_kk";
                var data = form3.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val()+"&id="+$("#inp_user").val();
                
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
                                d_view();
                             $('#list_kab').modal('toggle');
                             loading.hide();
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //datatable.ajax.reload();
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
                
        var form2 = $("#form_wil");
        form2.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
               // iduserp:{required:true},
                prov:{required:true},
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
                var url = controller+"/add_wil";
                var data = form2.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val()+"&id="+$("#inp_user").val();
                
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
                                d_view();
                             $('#modal_wil').modal('toggle');
                             loading.hide();
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                            }
                            //datatable.ajax.reload();
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
        
        table.on('click', 'a.btnRes', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda yakin password diatur ulang?", 
                text: "Atur ulang "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, reset!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/reset_password";
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
                                if(obj)
                                {
                                    $("#csrf").val(obj.csrf_hash);
                                    if(obj.status === 1){
                                        loading.hide();
                                      datatable.ajax.reload();
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-left",
                                          "preventDuplicates": false,
                                          "onclick": null,
                                          "showDuration": "300",
                                          "hideDuration": "1000",
                                          "timeOut": "5000",
                                          "extendedTimeOut": "1000",
                                          "showEasing": "swing",
                                          "hideEasing": "linear",
                                          "showMethod": "fadeIn",
                                          "hideMethod": "fadeOut"
                                        };
                                        
                                    }
                                    else if(obj.status === 0){
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                    else if(obj.status === 2){
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );

                                        window.setTimeout(function(){
                                            window.location.href =base_url+default_controller;
                                        }, 2000);
                                    }
                                    else{
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                }
                                else
                                {
                                    sweetAlert("Error", "An Error Occured", "error");
                                    loading.hide();
                                    return false;
                                }
                            },
                            error:function (x, status, error){
                                loading.hide(); 
                                if (x.status == 403) {
                                    sweetAlert("Error", "Sorry, your session has expired. Please login again to continue", "warning");
                                    window.location.href =base_url+default_controller;
                                }
                                else {
                                    alert("An error occurred: " + status + "nError: " + error);
                                    window.location.href =base_url+default_controller;
                                }
                            }
                        });
                    }
                });
        });
        
        table.on('click', 'a.btnDel', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda yakin data dihapussssss?", 
                text: "Hapus data "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, reset!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/delete";
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
                                if(obj)
                                {
                                    $("#csrf").val(obj.csrf_hash);
                                    if(obj.status === 1){
                                        loading.hide();
                                      datatable.ajax.reload();
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-left",
                                          "preventDuplicates": false,
                                          "onclick": null,
                                          "showDuration": "300",
                                          "hideDuration": "1000",
                                          "timeOut": "5000",
                                          "extendedTimeOut": "1000",
                                          "showEasing": "swing",
                                          "hideEasing": "linear",
                                          "showMethod": "fadeIn",
                                          "hideMethod": "fadeOut"
                                        };
                                        
                                    }
                                    else if(obj.status === 0){
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                    else if(obj.status === 2){
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );

                                        window.setTimeout(function(){
                                            window.location.href =base_url+default_controller;
                                        }, 2000);
                                    }
                                    else{
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                }
                                else
                                {
                                    sweetAlert("Error", "An Error Occured", "error");
                                    loading.hide();
                                    return false;
                                }
                            },
                            error:function (x, status, error){
                                loading.hide(); 
                                if (x.status == 403) {
                                    sweetAlert("Error", "Sorry, your session has expired. Please login again to continue", "warning");
                                    window.location.href =base_url+default_controller;
                                }
                                else {
                                    alert("An error occurred: " + status + "nError: " + error);
                                    window.location.href =base_url+default_controller;
                                }
                            }
                        });
                    }
                });
        });
        
        //delete list Prov
        table_p.on('click', 'a.btnDel', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda yakin data dihapus?", 
                text: "Hapus data "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, reset!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/delete_prov";
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
                                if(obj)
                                {
                                    $("#csrf").val(obj.csrf_hash);
                                    if(obj.status === 1){
                                        loading.hide();
                                        d_view();
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-left",
                                          "preventDuplicates": false,
                                          "onclick": null,
                                          "showDuration": "300",
                                          "hideDuration": "1000",
                                          "timeOut": "5000",
                                          "extendedTimeOut": "1000",
                                          "showEasing": "swing",
                                          "hideEasing": "linear",
                                          "showMethod": "fadeIn",
                                          "hideMethod": "fadeOut"
                                        };
                                        
                                    }
                                    else if(obj.status === 0){
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                    else if(obj.status === 2){
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );

                                        window.setTimeout(function(){
                                            window.location.href =base_url+default_controller;
                                        }, 2000);
                                    }
                                    else{
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                }
                                else
                                {
                                    sweetAlert("Error", "An Error Occured", "error");
                                    loading.hide();
                                    return false;
                                }
                            },
                            error:function (x, status, error){
                                loading.hide(); 
                                if (x.status == 403) {
                                    sweetAlert("Error", "Sorry, your session has expired. Please login again to continue", "warning");
                                    window.location.href =base_url+default_controller;
                                }
                                else {
                                    alert("An error occurred: " + status + "nError: " + error);
                                    window.location.href =base_url+default_controller;
                                }
                            }
                        });
                    }
                });
        });
        //delete list kabupaten/kota
        table_kk.on('click', 'a.btnDel', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda yakin data dihapus?", 
                text: "Hapus data "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, reset!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/delete_kabko";
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
                                if(obj)
                                {
                                    $("#csrf").val(obj.csrf_hash);
                                    if(obj.status === 1){
                                        loading.hide();
                                        d_view();
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-left",
                                          "preventDuplicates": false,
                                          "onclick": null,
                                          "showDuration": "300",
                                          "hideDuration": "1000",
                                          "timeOut": "5000",
                                          "extendedTimeOut": "1000",
                                          "showEasing": "swing",
                                          "hideEasing": "linear",
                                          "showMethod": "fadeIn",
                                          "hideMethod": "fadeOut"
                                        };
                                        
                                    }
                                    else if(obj.status === 0){
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                    else if(obj.status === 2){
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );

                                        window.setTimeout(function(){
                                            window.location.href =base_url+default_controller;
                                        }, 2000);
                                    }
                                    else{
                                        loading.hide();
                                        Swal.fire(
                                            'Error!',
                                            obj.msg,
                                            'error'
                                          );
                                    }
                                }
                                else
                                {
                                    sweetAlert("Error", "An Error Occured", "error");
                                    loading.hide();
                                    return false;
                                }
                            },
                            error:function (x, status, error){
                                loading.hide(); 
                                if (x.status == 403) {
                                    sweetAlert("Error", "Sorry, your session has expired. Please login again to continue", "warning");
                                    window.location.href =base_url+default_controller;
                                }
                                else {
                                    alert("An error occurred: " + status + "nError: " + error);
                                    window.location.href =base_url+default_controller;
                                }
                            }
                        });
                    }
                });
        });
        $(".btnShwHd").click(function(){
            var _self = $(this);
            var _show = _self.data("show").split(',');
            var _hide = _self.data("hide").split(',');
            var _reload = _self.data("reload");
            var last_trgt = "";
            $.each(_hide,function(index,value){
                $(value).hide();
            });
            $.each(_show,function(index,value){
                $(value).show();
            });
            if(_reload=='DUser'){
               datatable.ajax.reload();
            }
//            else if(_reload=='indi'){
//                g_prov();
//            }
           // goToMessage(last_trgt);
        });
   };
    
    return{
        init:function(){datatable();},
    };
}();