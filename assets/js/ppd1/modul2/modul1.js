
var main = function(){
    var datatable = function(){
        controller = "M_modul_1";
        
        var t_indi  = $("#t_indi");
        var t_sindi = $("#t_sindi");
        var t_item  = $("#t_item");
        var t_indiitem  = $("#t_indiitem");
        
        function g_indi(){
            loading.show();
            ajax_url = controller+"/g_indi";
            ajax_data=csrf_name+"="+$("#csrf").val();
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
                            $("#t_indi > tbody").html(obj.str);loading.hide();
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
        g_indi();
        $("#btnShwMdlIndiAdd").click(function(){
            $("#frmIndiAdd")[0].reset();
            $('#mdl_indi_add').modal('show');
        });
        
        t_indi.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblkrit     = _self.data("nmkriteria");
            var lblindi      = _self.data("nmindi");
            $("#inp_indi").val(id);
            $(".lbl_hdr_krit").html(lblkrit).parent("tr").show();
            $(".lbl_hdr_indi").html(lblindi).parent("tr").show();
            g_sindi();
        });
        
        
        t_indi.on('click', 'a.btnDel', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda Yakin?", 
                text: "Hapus data "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, hapus!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/delete_indi";
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
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-right",
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
                                        g_indi();
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
        t_indi.on("click","a.btnEdit",function(e){
            var _self = $(this);
            var id = _self.data("id");
            $('.has-error').removeClass('has-error');
            loading.show();
            ajax_url = controller+"/get_detail_indi";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            jQuery.ajax({
                type: "POST",
                url: base_url+ajax_url,
                dataType:"text",
                data:ajax_data,
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
                            
                            $("#frmIndiEdit")[0].reset();
                            
                            $('form#frmIndiEdit input[name="id"]').val(id);
                            $('form#frmIndiEdit input[name="nama"]').val(obj.data[0].nm);
                            $('form#frmIndiEdit input[name="bobot"]').val(obj.data[0].bobot);
                            $('form#frmIndiEdit input[name="nourut"]').val(obj.data[0].nourut);
                            $('form#frmIndiEdit textarea[name="note"]').val(obj.data[0].note);
                            $('form#frmIndiEdit select[name="kriter"]').val(obj.data[0].krtriaid);
                            $('form#frmIndiEdit select[name="stts"]').val(obj.data[0].isactive);
                            $('#mdl_indi_edit').modal('show');
                            loading.hide();
                        }
                        else if(obj.status === 0){
                            loading.hide();
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "error",
                                    
                                });
                        }
                        else if(obj.status === 2){
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "warning",
                                    
                                });
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
                        }
                    }
                    else{
                        sweetAlert("Caution", response, "error");
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
        });
        
        var frmAddIndi = $("#frmIndiAdd");
        frmAddIndi.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                kode:{required:true},
                
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "pagu_bansos" 
                        || element.attr("name") === "pagu_bm" 
                        || element.attr("name") === "pagu_bb" 
                        || element.attr("name") === "pagu_bp" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmAddIndi[0]);
                var url = controller+"/save_indi";
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_indi();
                                frmAddIndi[0].reset();
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        var frmEditIndi = $("#frmIndiEdit");
        frmEditIndi.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                id:{required:true},
                
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmEditIndi[0]);
                var url = controller+"/update_indi";
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_indi();
                                frmEditIndi[0].reset();
                                $('#mdl_indi_edit').modal('hide');
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        
        function g_sindi(){
            loading.show();
            ajax_url = controller+"/g_sindi";
            ajax_data="id="+$("#inp_indi").val();
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
                            $("#t_sindi > tbody").html(obj.str);
                            $("._wrapper").hide();
                            $("._wrapper_info").show();
                            $("._wrapper_sindi").show();
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
        $("#btnShwMdlSindiAdd").click(function(){
            $("#frmSindiAdd")[0].reset();
            $('#mdl_sindi_add').modal('show');
        });
        
        var frmAddSindi = $("#frmSindiAdd");
        frmAddSindi.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "pagu_bansos" 
                        || element.attr("name") === "pagu_bm" 
                        || element.attr("name") === "pagu_bb" 
                        || element.attr("name") === "pagu_bp" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmAddSindi[0]);
                var url = controller+"/save_sindi";
                data1.append(csrf_name, $("#csrf").val());
                data1.append("id", $("#inp_indi").val());
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_sindi();
                                frmAddSindi[0].reset();
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        var frmEditSindi = $("#frmSindiEdit");
        frmEditSindi.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                id:{required:true},
                
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmEditSindi[0]);
                var url = controller+"/update_sindi";
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_sindi();
                                frmEditSindi[0].reset();
                                $('#mdl_sindi_edit').modal('hide');
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        t_sindi.on('click', 'a.btnDel', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda Yakin?", 
                text: "Hapus data "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, hapus!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/delete_sindi";
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
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-right",
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
                                        g_sindi();
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
        t_sindi.on("click","a.btnEdit",function(e){
            var _self = $(this);
            var id = _self.data("id");
            $('.has-error').removeClass('has-error');
            loading.show();
            ajax_url = controller+"/get_detail_sindi";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            jQuery.ajax({
                type: "POST",
                url: base_url+ajax_url,
                dataType:"text",
                data:ajax_data,
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
                            
                            $("#frmSindiEdit")[0].reset();
                            
                            $('form#frmSindiEdit input[name="id"]').val(id);
                            $('form#frmSindiEdit input[name="nama"]').val(obj.data[0].nm);
                            $('form#frmSindiEdit input[name="nourut"]').val(obj.data[0].nourut);
                            $('form#frmSindiEdit select[name="tampil"]').val(obj.data[0].istampil);
                            $('form#frmSindiEdit select[name="tag_prov"]').val(obj.data[0].isprov);
                            $('form#frmSindiEdit select[name="stts"]').val(obj.data[0].isactive);
                            $('form#frmSindiEdit textarea[name="note"]').val(obj.data[0].note);
                            $('#mdl_sindi_edit').modal('show');
                            loading.hide();
                        }
                        else if(obj.status === 0){
                            loading.hide();
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "error",
                                    
                                });
                        }
                        else if(obj.status === 2){
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "warning",
                                    
                                });
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
                        }
                    }
                    else{
                        sweetAlert("Caution", response, "error");
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
        });
        t_sindi.on("click","a.getDetail",function(e){
            var _self   = $(this);
            var id      = _self.data("id");
            var lblnm   = _self.data("nm");
            $("#inp_sindi").val(id);
            $(".lbl_hdr_sindi").html(lblnm).parent("tr").show();
            g_item();
        });
        
        function g_item(){
            loading.show();
            ajax_url = controller+"/g_item";
            ajax_data="id="+$("#inp_sindi").val();
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
                            $("#t_item > tbody").html(obj.str);
                            $("._wrapper").hide();
                            $("._wrapper_info").show();
                            $("._wrapper_item").show();
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
        $("#btnShwMdlItemAdd").click(function(){
            $("#frmItemAdd")[0].reset();
            $('#mdl_item_add').modal('show');
        });
        
        var frmAddItem = $("#frmItemAdd");
        frmAddItem.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "pagu_bansos" 
                        || element.attr("name") === "pagu_bm" 
                        || element.attr("name") === "pagu_bb" 
                        || element.attr("name") === "pagu_bp" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmAddItem[0]);
                var url = controller+"/save_item";
                data1.append(csrf_name, $("#csrf").val());
                data1.append("id", $("#inp_sindi").val());
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_item();
                                frmAddItem[0].reset();
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        var frmEditItem = $("#frmItemEdit");
        frmEditItem.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                id:{required:true},
                
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmEditItem[0]);
                var url = controller+"/update_item";
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_item();
                                frmEditItem[0].reset();
                                $('#mdl_item_edit').modal('hide');
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        
        t_item.on('click', 'a.btnDel', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda Yakin?", 
                text: "Hapus data "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, hapus!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/delete_item";
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
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-right",
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
                                        g_item();
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
        t_item.on("click","a.btnEdit",function(e){
            var _self = $(this);
            var id = _self.data("id");
            $('.has-error').removeClass('has-error');
            loading.show();
            ajax_url = controller+"/get_detail_item";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            jQuery.ajax({
                type: "POST",
                url: base_url+ajax_url,
                dataType:"text",
                data:ajax_data,
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
                            
                            $("#frmItemEdit")[0].reset();
                            
                            $('form#frmItemEdit input[name="id"]').val(id);
                            $('form#frmItemEdit input[name="nama"]').val(obj.data[0].nm);
                            $('form#frmItemEdit input[name="nourut"]').val(obj.data[0].nourut);
                            $('form#frmItemEdit select[name="stts"]').val(obj.data[0].isactive);
                            $('form#frmItemEdit textarea[name="note"]').val(obj.data[0].note);
                            $('#mdl_item_edit').modal('show');
                            loading.hide();
                        }
                        else if(obj.status === 0){
                            loading.hide();
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "error",
                                    
                                });
                        }
                        else if(obj.status === 2){
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "warning",
                                    
                                });
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
                        }
                    }
                    else{
                        sweetAlert("Caution", response, "error");
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
        });
        t_item.on("click","a.getDetail",function(e){
            var _self   = $(this);
            var id      = _self.data("id");
            var lblnm   = _self.data("nm");
            $("#inp_item").val(id);
            $(".lbl_hdr_item").html(lblnm).parent("tr").show();
            g_indiitem();
        });
        
        function g_indiitem(){
            loading.show();
            ajax_url = controller+"/g_indiitem";
            ajax_data="id="+$("#inp_item").val();
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
                            $("#t_indiitem > tbody").html(obj.str);
                            $("._wrapper").hide();
                            $("._wrapper_info").show();
                            $("._wrapper_indiitem").show();
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
        $("#btnShwMdlIndiitemAdd").click(function(){
            $("#frmIndiitemAdd")[0].reset();
            $('#mdl_indiitem_add').modal('show');
        });
        
        var frmAddIndiitem = $("#frmIndiitemAdd");
        frmAddIndiitem.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmAddIndiitem[0]);
                var url = controller+"/save_indiitem";
                data1.append(csrf_name, $("#csrf").val());
                data1.append("id", $("#inp_item").val());
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_indiitem();
                                frmAddIndiitem[0].reset();
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        var frmEditIndiitem = $("#frmIndiitemEdit");
        frmEditIndiitem.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                id:{required:true},
                
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var data1 = new FormData(frmEditIndiitem[0]);
                var url = controller+"/update_indiitem";
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);

                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-right",
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
                                g_indiitem();
                                frmEditIndiitem[0].reset();
                                $('#mdl_indiitem_edit').modal('hide');
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        
        t_indiitem.on('click', 'a.btnDel', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var title   = $(this).data("title");
            Swal.fire({ 
                title: "Anda Yakin?", 
                text: "Hapus data "+title+" ?", 
                type: "warning", 
                showCancelButton: !0
                , confirmButtonColor: "#348cd4", 
                cancelButtonColor: "#6c757d", 
                confirmButtonText: "Yes, hapus!" }).then((result) => {
                    if (result.value) {
                        ajax_url = controller+"/delete_indiitem";
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
                                        toastr["success"](obj.msg);

                                        toastr.options = {
                                          "closeButton": false,
                                          "debug": false,
                                          "newestOnTop": false,
                                          "progressBar": false,
                                          "positionClass": "toast-bottom-right",
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
                                        g_indiitem();
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
        t_indiitem.on("click","a.btnEdit",function(e){
            var _self = $(this);
            var id = _self.data("id");
            $('.has-error').removeClass('has-error');
            loading.show();
            ajax_url = controller+"/get_detail_indiitem";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            jQuery.ajax({
                type: "POST",
                url: base_url+ajax_url,
                dataType:"text",
                data:ajax_data,
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
                            
                            $("#frmIndiitemEdit")[0].reset();
                            
                            $('form#frmIndiitemEdit input[name="id"]').val(id);
                            $('form#frmIndiitemEdit input[name="nama"]').val(obj.data[0].nm);
                            $('form#frmIndiitemEdit input[name="skor"]').val(obj.data[0].skor);
                            $('form#frmIndiitemEdit input[name="nourut"]').val(obj.data[0].nourut);
                            $('form#frmIndiitemEdit select[name="stts"]').val(obj.data[0].isactive);
                            $('form#frmIndiitemEdit textarea[name="note"]').val(obj.data[0].note);
                            $('#mdl_indiitem_edit').modal('show');
                            loading.hide();
                        }
                        else if(obj.status === 0){
                            loading.hide();
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "error",
                                    
                                });
                        }
                        else if(obj.status === 2){
                            Swal.fire({
                                    title: "Error!",
                                    text: obj.msg,
                                    icon: "warning",
                                    
                                });
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
                        }
                    }
                    else{
                        sweetAlert("Caution", response, "error");
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
        });
        
        
        $(".btnShwHd").click(function(){
            var _self = $(this);
            var _show = _self.data("show").split(',');
            var _hide = _self.data("hide").split(',');
            var _hdrhide = _self.data("hdrhide").split(',');
            var last_trgt = "";
            $.each(_hide,function(index,value){
                $(value).hide();
            });
            $.each(_hdrhide,function(index,value){
                $(value).parents("tr").hide();
            });
            $.each(_show,function(index,value){
                $(value).show();
                last_trgt=$(value);
            });
            
            goToMessage(last_trgt);
        });
        
        
        
       
        
        $(".inp_nominal").keyup(function(){
            var inp=$(this);
            if(Number(inp.val().replace(/,/g,""))>0)
                inp.val(Number(inp.val().replace(/,/g,"")).toLocaleString("en"));
            
            var sum = 0;
            $(".inp_nominal").each(function() {
                var _self = $(this);
                sum+=Number(_self.val().replace(/,/g,""));
            });
            $(".form_wrapper #pagu_total").val(Number(sum).toLocaleString("en"));

        });
       
        var form_real = $("#form_realisasi_detail");
        form_real.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error error-modified', // default input error message class
            rules:{
                kode:{required:true},
                bulan:{required:true},
                fisik_detail:{required:true,min: 0},
                bm_detail:{required:true,pstv_numb: true},
                bp_detail:{required:true,pstv_numb: true},
                bb_detail:{required:true,pstv_numb: true},
                bansos_detail:{required:true,pstv_numb: true},
                "masalah_detail[]":{required:true},
                remarks:{
                    required: function (element) {
                        if(!$("#inp_chck_klm_msl").is(':checked')){
                            var e = $("#inp_rl_msl_dsc");
                            return e.val()=="" ;                            
                        }
                        else
                        {
                            return false;
                        }  
                    }  
                },
                ket:{required:true,minlength: 20},
                notif_detail:{required:true},
                stts_prcntg:{required:true,prcnt_stts:true},
                dokumen:{extension: "pdf|doc|docx",filesize: 3000000}, //3 mb
                video:{url: true},
                gambar:{url: true},
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "pagu_bansos" 
                        ) {
                    error.insertAfter(element.parent().parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                var name = $(element).attr("name");
                if(name==="pagu_bansos"
                        ){
                    $(element).parent().parent().addClass('has-error');
                }
                else if(
                        name==="bbn_bansos"
                        ){
                    $(element).parent().addClass('has-error');
                }
                else
                    $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element)
                .closest('.has-error').removeClass('has-error');
            },
            submitHandler: function(form) {
                var data1 = new FormData(form_real[0]);
                var url = controller+"/save_realisasi";
                data1.append(csrf_name, $("#csrf").val());
                data1.append("tipe", "add");
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

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                $.Notification.autoHideNotify('success','bottom right', 'Berhasil!', 'Data capaian realisasi disimpan.');
                                $(".realisasi_bulanan_wrapper").hide();
                                get_month_list();
                                
                            }
                            else if(obj.status === 0){
                                sweetAlert("Caution!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller;
                                }, 2000);
                            }
                        }
                        else
                        {
//                            show_alert_ms(msg_obj,99,response);
                            loading.hide();
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
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'Ukuran berkas maksimal 3 Mb');
        
        $.validator.addMethod('pstv_numb', function (value, element, param) {
            var tmp = parseInt(Number(value.replace(/,/g,"")));
            if(tmp >= 0)
                return true;
            else
                return false;
        }, 'Nominal harus bernilai positif');
        $.validator.addMethod('prcnt_stts', function (value, element, param) {
            var inp_stts_plksn = $("#inp_stts_plksn").val();
            var tmp = parseInt(Number(value.replace(/,/g,"")));
            if(inp_stts_plksn == 1 && tmp == 0)
                return true;
            else if(inp_stts_plksn == 2 && (tmp >= 1 && tmp <= 10))
                return true;
            else if(inp_stts_plksn == 3 && (tmp >= 11 && tmp <= 25))
                return true;
            else if(inp_stts_plksn == 4 && (tmp >= 26 && tmp <= 99))
                return true;
            else if(inp_stts_plksn == 5 && (tmp == 100))
                return true;
            else if(inp_stts_plksn == 6 && (tmp == 100))
                return true;
            else
                return false;
        }, 'masukkan nilai yang valid');
        
        
        $("#inp_chck_kum").click(function(){
            $(".wrapper_blnj_kum").hide();
            $(".inp_blnj_pars").removeAttr("readonly");
            if($(this). is(":checked")){
                $(".wrapper_blnj_kum").slideDown();
                $(".inp_blnj_pars").attr("readonly","readonly");
            }
        });
        
        $("#inp_chck_klm_msl").click(function(){
            $(".wrapper_ktgr_msl").show();
            $(".wrapper_lbl_warn_msl").hide();
            $("#inp_rl_msl_dsc").removeAttr('disabled');
            if($(this). is(":checked")){
                $(".wrapper_ktgr_msl").hide();
                $(".wrapper_lbl_warn_msl").show();
                $("#inp_rl_msl_dsc").attr('disabled','');
            }
        });
        
        $(".inp_rl_kum").keyup(function(){
            var _this = $(this);
            var val = _this.val();
            var trgt = _this.data("target");
            var trgt_bfr = _this.data("bfr");
            var rl_bfr = $(trgt_bfr).val();
            var prsial = parseInt(Number(val.replace(/,/g,"")) - parseInt(rl_bfr));
            $(trgt).val(prsial);
            
            $(trgt).val(Number($(trgt).val().replace(/,/g,"")).toLocaleString("en"));
        });
        
        $("#inp_msl_rl").change(function(){
            var _self = $(this);
            if(_self.val() !== null){
                if(_self.val().length > 0){
                    $.each(_self.val(), function( index, value ) {
                        if(value==12){
                            _self.val(12);
                        }
                        else{
                            
                        }
                    });
                }
            }
        });
        
        $('#inp_stts_plksn').change(function(){
            var _self = $(this);
            $('form#form_realisasi_detail input[name="stts_prcntg"]').removeAttr("readonly");
            if(_self.val() === '1'){
                $('form#form_realisasi_detail input[name="stts_prcntg"]').val(Number(0));
                $('form#form_realisasi_detail input[name="stts_prcntg"]').attr("readonly","");
            }
        });
    };
    
    var general = function(){
        

        $('form').submit(function(){
          var radioValue = $("input[name='options']:checked").val();
          if(radioValue){
             alert("You selected - " + radioValue);
           };
            return false;
        });
    };
    
    return{
        init:function(){datatable();general()},
    };
}();
