var main = function(){
    controller = "PPD3_modul2";
    var datatable = function(){
        var twlyh = $("#t_wlyh");
        var tindi = $("#t_indi");
        var titem = $("#t_item");
        
        function g_wilayah(){
            var kate = $("#inp_kate_wlyh").val();
            loading.show();
            ajax_url = controller+"/g_wilayah";
            ajax_data="kate="+kate;
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
                            //$("#t_wlyh > tbody").html(obj.str);
                            $("#t_wlyh").html(obj.str);
                            if(kate=="PROV")
                                $(".lbl_katewlyh").html("provinsi");
                            
                            else if(kate=="KAB")
                                $(".lbl_katewlyh").html("kabupaten");
                            else if(kate=="KOTA")
                                $(".lbl_katewlyh").html("kota");
                            
                            $("._wrapper").hide();
                            //$("._wrapper_wlyh").fadeIn();
                            $("._wrapper_wlyh").css("display", "block");
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

        $(".btnProv").click(function(){
            $("#inp_kate_wlyh").val("PROV");
            g_wilayah();
        });
        $(".btnKab").click(function(){
            $("#inp_kate_wlyh").val("KAB");
            g_wilayah();
        });
        $(".btnKota").click(function(){
            $("#inp_kate_wlyh").val("KOTA");
            g_wilayah();
        });
        twlyh.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblwlyh     = _self.data("nmwlyh");
            $("#inp_wlyh").val(id);
            $(".lbl_hdr_nmwlyh").html(lblwlyh).parent("tr").show();
            g_indi();
        });
        twlyh.on("click","a.getDoc",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblwlyh     = _self.data("nmwlyh");
            loading.show();
            ajax_url = controller+"/g_doc";
            ajax_data="id="+id;
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
                            $("#t_doc > tbody").html(obj.str);
                            $("#mdl_doc").modal("show");
                            $("#mdl_doc .lbl_jdl_wlyh").html(lblwlyh);
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
        });
        
        function g_indi(){
            loading.show();
            ajax_url = controller+"/g_indi";
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
                            $("#t_indi > tbody").html(obj.str);
                            $("._wrapper").hide();
                            $("._wrapper_info").show();
                            $("._wrapper_indi").fadeIn();
                            $("._wrapper_statement").hide();
                            if(obj.sttsDispSttment=='Y')
                                $("._wrapper_statement").fadeIn();
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
        
        tindi.on("click","a._mdlRsm",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblkriter   = _self.data("nmkriteria");
            clickable=false;
                loading.show();
                ajax_url = controller+"/g_det_resume";
                ajax_data="id="+id;
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
                                $('form#frm_simpul input[name="id"]').val(id);
                                $('form#frm_simpul textarea[name="simpul"]').val(obj.simpul);
                                $('form#frm_simpul textarea[name="saran"]').val(obj.saran);
                                $('form#frm_simpul #lbl_jdl_aspek').html(obj.nmaspek);

                                $("#mdl_simpul").modal("show");
                                loading.hide();
                                clickable=true;
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
        });
        
        tindi.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblindi     = _self.data("nmindi");
            var lblaspk     = _self.data("nmaspek");
            var lblkriter   = _self.data("nmkriteria");
            $("#inp_indi").val(id);
            $(".lbl_hdr_indi").html(lblindi).parent("tr").show();
            $(".lbl_hdr_aspk").html(lblaspk).parent("tr").show();
            $(".lbl_hdr_krit").html(lblkriter).parent("tr").show();
            g_item();
        });
        
        function g_item(){
            loading.show();
            ajax_url = controller+"/g_item";
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
                            $("#t_item > tbody").html(obj.str);
                            $("#t_item > tfoot").html(obj.str_foot);
                            $(".lbl_nilai").html(obj.nilai);
                            $(".t_ctt").hide();
                            if(obj.ctt_indi!==''){
                                $(".t_ctt .ctt_indi").html(obj.ctt_indi);
                                $(".t_ctt").show();
                            }
                            $("._wrapper").hide();
                            $("._wrapper_info").show();
                            $("._wrapper_item").fadeIn();
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
                
        titem.on('change','._btnIsiIndiItem',function(){
            //if(clickable==true){
            var _self   = $(this);
            var id      = _self.data('id');
            var nomor   = _self.data('nomor');
            var nmitem   = _self.data('nmitem');
            var nilai = $(this).find("input").val();    
            
            if(nilai < 5 || nilai > 10  ){
                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
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
                toastr["error"]("Skor harus lebih besar dari 5 kecil dari 10");
                $(this).find("input").val("");
             return false;   
            }
            loading.show();            
            ajax_url = controller+"/save_score";
            ajax_data="id="+id+"&nilai="+nilai+"&nomor="+nomor+"&nmitem="+nmitem;
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
//                                _parent.children("td").removeClass("table-warning");_self.addClass("table-warning");
//                                _parent.children().children("._colSkor").html(_nilai);
                                $(".ttl_skor").html(obj.ttl_skor);
                                $(".lbl_nilai").html(obj.nilai);
                                
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
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
                                toastr["success"](obj.msg);
                                
//                                if(obj.is_display_simpul=='Y'){
//                                    $('form#frm_simpul input[name="id"]').val(obj.idrsme);
//                                    $('form#frm_simpul textarea[name="simpul"]').val(obj.val_ksmpln);
//                                    $('form#frm_simpul textarea[name="saran"]').val(obj.val_saran);
//                                    $('form#frm_simpul #lbl_jdl_aspek').html(obj.nmaspek);
//                                    
//                                    $("#mdl_simpul").modal("show");
//                                }
                                loading.hide();
                                clickable=true;
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
            
        });
//        titem.on('change','._btnIsiIndiItem',function(){
//            
//            var id      = _self.data('id');
//            //var nilai  = $("#nilai").val();
//            alert(id);
//            
//        });
        titem.on('click','._btnEdit',function(){
            var id          =$("#inp_indi").val();
            $("#idtambah").val(id);
            $("#mdl_tambah").modal("show");
        });
        
        var frm_tambah = $("#frm_tambah"); 
        frm_tambah.validate({
            errorElement: 'label', 
            errorClass: 'error', 
            rules:{
                idtambah:{required:true},
                skor:{number:true,required:true},
                //alo:{number:true,required:true},
                //giat:{required:true},
            },
//            errorPlacement: function(error, element) {
//                if (
//                        element.attr("name") === "lat" ||element.attr("name") === "long" 
//                        || element.attr("name") === "lat_end" ||element.attr("name") === "long_end" 
//                        ) {
//                    error.insertAfter(element.parent());
//                } else {
//                    error.insertAfter(element);
//                }
//            },
//            highlight: function (element) {
//                var name = $(element).attr("name");
//                if(name==="lat"
//                        ){
//                    $(element).parent().parent().addClass('has-error');
//                }
//                else if(
//                        name==="bbn_bansos"
//                        ){
//                    $(element).parent().addClass('has-error');
//                }
//                else
//                    $(element).closest('.form-group').addClass('has-error');
//            },
            unhighlight: function (element) {
                $(element)
                .closest('.has-error').removeClass('has-error');
            },
            submitHandler: function(form) {
                var data1 = new FormData(frm_tambah[0]);
                var url = controller+"/tambah_skore";
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
                                loading.hide();
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
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
                                toastr["success"](obj.msg);
                                $("#mdl_tambah").modal("hide");
                                g_item();
                            }
                            else if(obj.status === 0){loading.hide();
                                
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                            }
                            else if(obj.status === 2){loading.hide();
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                                window.location.href = base_url+default_controller;
                            }
                        }
                        else
                        {
                            Swal.fire({
                                    title: "Error!",
                                    text: "An Error occured",
                                    icon: "warning",
                                    
                                });
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
        
        
        titem.on('click','._btnPilihIndiItem',function(){
            if(clickable==true){
                var _self   = $(this);
                var id      = _self.data('id');
                var _nilai  = _self.data('nilai');
                var _parent = _self.parent();
                clickable=false;
                loading.show();
                ajax_url = controller+"/save_score";
                ajax_data="id="+id;
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
                                _parent.children("td").removeClass("table-warning");_self.addClass("table-warning");
                                
                                _parent.children().children("._colSkor").html(_nilai);
                                $(".ttl_skor").html(obj.ttl_skor);
                                $(".lbl_nilai").html(obj.nilai);
                                
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
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
                                toastr["success"](obj.msg);
                                
                                if(obj.is_display_simpul=='Y'){
                                    $('form#frm_simpul input[name="id"]').val(obj.idrsme);
                                    $('form#frm_simpul textarea[name="simpul"]').val(obj.val_ksmpln);
                                    $('form#frm_simpul textarea[name="saran"]').val(obj.val_saran);
                                    $('form#frm_simpul #lbl_jdl_aspek').html(obj.nmaspek);
                                    
                                    $("#mdl_simpul").modal("show");
                                }
                                loading.hide();
                                clickable=true;
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
            
        });
        
        titem.on('click','._btnDelIndiItem',function(){
             var _self   = $(this);
            var id      = _self.data('id');
            var nomor   = _self.data('nomor');
            var nmitem   = _self.data('nmitem');
            d_item();
        });
        
        function d_item(){
            loading.show();
        }
        
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
            if(_reload=='indi'){
                g_indi();
            }
            else if(_reload=='prov'){
                g_wilayah();
            }
            goToMessage(last_trgt);
        });
        
        
        var frm_simpul = $("#frm_simpul");
        frm_simpul.validate({
            errorElement: 'label', 
            errorClass: 'error', 
            rules:{
                vol:{number:true,required:true},
                alo:{number:true,required:true},
                giat:{required:true},
            },
            errorPlacement: function(error, element) {
                if (
                        element.attr("name") === "lat" ||element.attr("name") === "long" 
                        || element.attr("name") === "lat_end" ||element.attr("name") === "long_end" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                var name = $(element).attr("name");
                if(name==="lat"
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
                var data1 = new FormData(frm_simpul[0]);
                var url = controller+"/resume_save";
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
                                loading.hide();
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
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
                                toastr["success"](obj.msg);
                                $("#mdl_simpul").modal("hide");
                                g_indi();
                            }
                            else if(obj.status === 0){loading.hide();
                                
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                            }
                            else if(obj.status === 2){loading.hide();
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                                window.location.href = base_url+default_controller;
                            }
                        }
                        else
                        {
                            Swal.fire({
                                    title: "Error!",
                                    text: "An Error occured",
                                    icon: "warning",
                                    
                                });
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
        
        
        function g_sttmnt(){
            var id          =$("#inp_wlyh").val();
            clickable=false;
            loading.show();
            ajax_url = controller+"/g_det_sttmnt";
            ajax_data="id="+id;
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
                            $('form#frm_sttmnt input[name="id"]').val(id);
                            $("#btn_sttmntUnduhLink").hide();
                            if(obj.link != null)
                                $("#btn_sttmntUnduhLink").attr("href",obj.link).show();

                            $("#mdl_sttmnt").modal("show");
                            loading.hide();
                            clickable=true;

                        }
                        else if(obj.status === 0){
                            loading.hide();clickable=true;
                            sweetAlert("Error", obj.msg, "error");
                        }
                        else if(obj.status === 2){
                            sweetAlert("Caution", obj.msg, "warning");clickable=true;
                            window.setTimeout(function(){
                                window.location.href = base_url+"welcome";
                            }, 2000);
                        }

                    }
                    else{
                        sweetAlert("Caution", response, "error");
                        loading.hide();
                        window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
        $("#btnShwMdlSttmnt").click(function(){
            g_sttmnt();
        });
        
        twlyh.on("click","a.getSttmnt",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            $("#inp_wlyh").val(id);
            g_sttmnt();
        });
        var frm_sttmnt = $("#frm_sttmnt");
        frm_sttmnt.validate({
            errorElement: 'label', 
            errorClass: 'error', 
            rules:{
                dokumen:{
                    required:true,
                }
            },
            errorPlacement: function(error, element) {
                if (
                        element.attr("name") === "lat" ||element.attr("name") === "long" 
                        || element.attr("name") === "lat_end" ||element.attr("name") === "long_end" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                var name = $(element).attr("name");
                if(name==="lat"
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
                var data1 = new FormData(frm_sttmnt[0]);
                var url = controller+"/sttmnt_save";
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
                                loading.hide();
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
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
                                toastr["success"](obj.msg);
                                $("#mdl_sttmnt").modal("hide");frm_sttmnt[0].reset();
                                g_wilayah();
                            }
                            else if(obj.status === 0){loading.hide();
                                
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                            }
                            else if(obj.status === 2){loading.hide();
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                                window.location.href = base_url+default_controller;
                            }
                        }
                        else
                        {
                            Swal.fire({
                                    title: "Error!",
                                    text: "An Error occured",
                                    icon: "warning",
                                    
                                });
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
        
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();