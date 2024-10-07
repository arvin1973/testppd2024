var main = function(){
    controller = "PPD1_M_Bahan_dukung";
    var datatable = function(){
        
        var table   = $("#dataUser");
        var t_bahan = $("#t_bahan");
        var t_group = $("#t_dataGroup");
        var t_tahap = $("#t_dataTahap");
        
        function g_bahan(){
             loading.show();
             ajax_url = controller+"/g_bahan";
             ajax_data="id="+$("#inp_wlyh").val();
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
                             $("#t_bahan > tbody").html(obj.str);
                             $("._wrapper_bahan").show();
                             $(".list_kabko").fadeIn();
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
         g_bahan();
        
        table.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            var lblkk     = _self.data("nmkk");
            $("#inp_wlyh").val(id);
            $(".lbl_hdr_katewlyh").html("").parent("tr").show();
            $(".lbl_hdr_nmwlyh").html(lblkk).parent("tr").show();
            g_bahan();
        });
        
        t_bahan.on("click","a.btnJml",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            var lblJdl     = _self.data("judul");
            var lblCr     = _self.data("cr");
            var lblDt     = _self.data("dt");
            $("#iddok").val(id);
            $(".lbl_id_jdl").html(lblJdl).parent("tr").show();
            $(".lbl_nm_upload").html(lblCr).parent("tr").show();
            $(".lbl_aktiv").html(lblDt).parent("tr").show();
            d_view();
             $("._wrapper_bahan").hide();
             $("._wrapper_info").show();
        });
        
        t_group.on("click","a.btnCl",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            $("#idgro").val(id);
            i_view();
        });
        
        $("#select_gr").change(function(e){
            e.preventDefault();
            var _self = $(this);
            var idgroup = _self.val();
            ajax_url = controller+"/detail_update";
            ajax_data="id="+$("#iddok").val()+"&group="+idgroup;
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
                            $("#t_dataGroup > tbody").html(obj.tbl_group);
                            $('#t_dataSel select[name="select_gr"]').html(obj.str);
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
                            if(obj.tahap==='3'){
                                $("._wrpTahap").show();
                                $("._wrpGruTahap").show();
                            }

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
            });
            
        t_tahap.on("click","a.btnCl",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            $("#idgro").val(id);
            i_view_t();
        });    
            
        $("#select_thp").change(function(e){
                e.preventDefault();
                var _self = $(this);
                var idtahap = _self.val();
                ajax_url = controller+"/detail_update_t";
                        ajax_data="id="+$("#iddok").val()+"&group="+idtahap;
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
                                        $("#t_dataTahap > tbody").html(obj.tbl_group_t);
                                        $('#t_datatah select[name="select_thp"]').html(obj.str_t);
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
            });    
        
        function d_view(){
             loading.show();
             ajax_url = controller+"/detail_view";
             ajax_data="id="+$("#iddok").val();
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
                             $("#t_dataGroup > tbody").html(obj.tbl_group);
                             $('#t_dataSel select[name="select_gr"]').html(obj.str);
                             $("#t_dataTahap > tbody").html(obj.tbl_tahap);
                             $('#t_datatah select[name="select_thp"]').html(obj.str_t);
                             if(obj.tahap==='3'){
                                $("._wrpTahap").show();
                                $("._wrpGruTahap").show();
                            }else{
                                $("._wrpTahap").hide();
                                $("._wrpGruTahap").hide();    
                                        }
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
         
        function i_view(){
            ajax_url = controller+"/detail_update";
            ajax_data="id="+$("#iddok").val()+"&group="+$("#idgro").val();
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
                            $("#t_dataGroup > tbody").html(obj.tbl_group);
                            $('#t_dataSel select[name="select_gr"]').html(obj.str);
                            if(obj.tahap==='3'){
                                $("._wrpTahap").show();
                                $("._wrpGruTahap").show();
                            }else{
                                $("._wrpTahap").hide();
                                $("._wrpGruTahap").hide();
                            }
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
         
        function i_view_t(){
            ajax_url = controller+"/detail_update_t";
            ajax_data="id="+$("#iddok").val()+"&group="+$("#idgro").val();
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
                            $("#t_dataTahap > tbody").html(obj.tbl_group_t);
                            $('#t_datatah select[name="select_thp"]').html(obj.str_t);
                            if(obj.tahap==='3'){
                                $("._wrpTahap").show();
                                $("._wrpGruTahap").show();
                            }
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
        
        t_bahan.on('click', 'a.btnDel', function(e){
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
                        ajax_url = controller+"/delete_dok";
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
                                        g_bahan();
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
        
        $("#btnShwMdlSindiAdd").click(function(){
            $("#frmDokAdd")[0].reset();
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            $('#mdl_dok_add').modal('show');
        });
        
        
        function g_downlad_all(){
             loading.show();
             ajax_url = controller+"/download_all";
             ajax_data="id="+$("#inp_wlyh").val();
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
                            
                             loading.hide();
                         }
                         else if(obj.status === 0){
                             loading.hide();
                             sweetAlert("Error", obj.msg, "error");
                         }
                         else if(obj.status === 2){
                             sweetAlert("Caution", obj.msg, "warning");
//                             window.setTimeout(function(){
//                                 window.location.href = base_url+"welcome";
//                             }, 2000);
                         }

                     }
                     else{
                         sweetAlert("Caution", response, "error");
//                         loading.hide();
//                         window.setTimeout(function(){
//                             window.location.href = base_url+"welcome";
//                         }, 2000);
//                         return false;
                     }
                 },
                 error:function (xhr, ajaxOptions, thrownError){
                     loading.hide(); 
                     alert(thrownError);
                     return false;
                 }
             });
         }
        
        $("#btnDownAll").click(function(){
            g_downlad_all();
        });
        
        var frmDokAdd = $("#frmDokAdd");
        frmDokAdd.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
                attch:{extension: "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|",filesize: 300000000}, //300 mb
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
                var url = controller+"/save_dokkk";
                var data1 = new FormData(frmDokAdd[0]);
                
                data1.append(csrf_name, $("#csrf").val());
                data1.append("id", $("#inp_wlyh").val());
                var data = data1;

                loading.show();
                jQuery.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(percentComplete + '%');
                                $(".progress-bar").html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    type: "POST",
                    url: base_url+url, 
                    data:data, 
                    mimeType: "multipart/form-data",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $(".progress-bar").width('0%');
                      //  $('#uploadStatus').html('<img src="loading.gif"/>');
                    },
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
                                g_bahan();
                                frmDokAdd[0].reset();
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
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'Ukuran berkas maksimal 300 Mb');
     
     
     
        t_bahan.on("click","a.btnEdi",function(e){
            var _self    = $(this);
            var id       = _self.data("id");
            var lbnm     = _self.data("nama");
            var lbfile   = _self.data("file");
            $("#inp_wlyh").val(id);
            $("#nama").val(lbnm);
            $("#filedok").text(lbfile);
            $("._wrapper_info").hide();
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            $('#mdl_dok_edt').modal('show');
        });   
        
        var frmDokEdt = $("#frmDokEdt");
        frmDokEdt.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
                filedok:{extension: "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|",filesize: 300000000}, //300 mb
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
                var url = controller+"/update_dok";
                var data1 = new FormData(frmDokEdt[0]);
                
                data1.append(csrf_name, $("#csrf").val());
                data1.append("id", $("#inp_wlyh").val());
                var data = data1;

                loading.show();
                jQuery.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(percentComplete + '%');
                                $(".progress-bar").html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    type: "POST",
                    url: base_url+url, 
                    data:data, 
                    mimeType: "multipart/form-data",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $(".progress-bar").width('0%');
                      //  $('#uploadStatus').html('<img src="loading.gif"/>');
                    },
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
                                g_bahan();
                                frmDokAdd[0].reset();
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
        
        $(".btnShwHd").click(function(){
            var _self = $(this);
            var _show = _self.data("show").split(',');
            var _hide = _self.data("hide").split(',');
            var _hdrhide = _self.data("hdrhide").split(',');
            var _reload = _self.data("reload");
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
            if(_reload=='kabko'){
               datatable.ajax.reload();
            }
            else if(_reload=='indi'){
                g_prov();
            }
            else if(_reload=='GUser'){
                g_bahan();
            }
            goToMessage(last_trgt);
        });
//    t_group.on("click","input.checkbox",function(e){
//            var _self       = $(this);
//            var iddata = _self.data("id");
//            var   idgroup = "";
//                console.log(idgroup=$('.checkbox:checked').map(function() {
//                    return this.value;
//                }).get());
//                //alert(iddata);   
//                ajax_url = controller+"/detail_update";
//                ajax_data="id="+$("#iddok").val()+"&group="+idgroup;
//                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
//                loading.show();
//                jQuery.ajax({
//                            type: "POST",
//                            url: base_url+ajax_url,
//                            dataType:"text", 
//                            data:ajax_data, 
//                            success:function(response){
//                                var obj = null;
//                                try
//                                {
//                                    obj = $.parseJSON(response);  
//                                }catch(e)
//                                {}
//                                if(obj)
//                                {
//                                    $("#csrf").val(obj.csrf_hash);
//                                    if(obj.status === 1){
//                                        //g_bahan();
//                                        toastr["success"](obj.msg);
//
//                                        toastr.options = {
//                                          "closeButton": false,
//                                          "debug": false,
//                                          "newestOnTop": false,
//                                          "progressBar": false,
//                                          "positionClass": "toast-bottom-right",
//                                          "preventDuplicates": false,
//                                          "onclick": null,
//                                          "showDuration": "300",
//                                          "hideDuration": "1000",
//                                          "timeOut": "5000",
//                                          "extendedTimeOut": "1000",
//                                          "showEasing": "swing",
//                                          "hideEasing": "linear",
//                                          "showMethod": "fadeIn",
//                                          "hideMethod": "fadeOut"
//                                        };
//                                        
//                                    }
//                                    else if(obj.status === 0){
//                                        loading.hide();
//                                        Swal.fire(
//                                            'Error!',
//                                            obj.msg,
//                                            'error'
//                                          );
//                                    }
//                                    else if(obj.status === 2){
//                                        Swal.fire(
//                                            'Error!',
//                                            obj.msg,
//                                            'error'
//                                          );
//
//                                        window.setTimeout(function(){
//                                            window.location.href =base_url+default_controller;
//                                        }, 2000);
//                                    }
//                                    else{
//                                        loading.hide();
//                                        Swal.fire(
//                                            'Error!',
//                                            obj.msg,
//                                            'error'
//                                          );
//                                    }
//                                }
//                                else
//                                {
//                                    sweetAlert("Error", "An Error Occured", "error");
//                                    loading.hide();
//                                    return false;
//                                }
//                            },
//                            error:function (x, status, error){
//                                loading.hide(); 
//                                if (x.status == 403) {
//                                    sweetAlert("Error", "Sorry, your session has expired. Please login again to continue", "warning");
//                                    window.location.href =base_url+default_controller;
//                                }
//                                else {
//                                    alert("An error occurred: " + status + "nError: " + error);
//                                    window.location.href =base_url+default_controller;
//                                }
//                            }
//                        });
//        });
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();