var main = function(){
    controller = "PPD3_t3_dokumen_daerah";
    var datatable = function(){
        
        var table   = $("#dataUser");
        var t_bahan = $("#t_bahan");
        var twlyh = $("#t_wlyh");
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
                            // $("#t_wlyh > tbody").html(obj.str);
                            $("#t_wlyh").html(obj.str);
                            if(kate=="PROV")
                                $(".lbl_katewlyh").html("provinsi");
                            
                            else if(kate=="KAB")
                                $(".lbl_katewlyh").html("kabupaten");
                            else if(kate=="KOTA")
                                $(".lbl_katewlyh").html("kota");
                            
                            $("._wrapper").hide();
                            // $("._wrapper_wlyh").fadeIn();
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
       
       table.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            var lblkk     = _self.data("nmkk");
            $("#inp_wlyh").val(id);
//            $("._wrapper_bahan").show();
            $(".lbl_hdr_katewlyh").html("").parent("tr").show();
            $(".lbl_hdr_nmwlyh").html(lblkk).parent("tr").show();
            g_bahan();
        });  
       
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
                             $("._wrapper_wlyh").hide();
                             $("._wrapper_info").show();
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
         }g_bahan();
        
        twlyh.on("click","a.getDoc",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblwlyh     = _self.data("nmwlyh");
            $("#inp_kode_wlyh").val(id);
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
         
         
         
         t_bahan.on("click","a.btnVie",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            $("#mdl_dok_add").modal("show");
        //    document.getElementById("rightbar").style.right = "0px";
        
        });

         $("#btnShwMdlSindiAdd").click(function(){
             var id          = $("#inp_kode_wlyh").val();
                          window.open(base_url+controller+"/d_bahan?wl="+id); 
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
//            if(_reload=='indi'){
//                g_indi();
//            }
//            else if(_reload=='prov'){
//                g_wilayah();
//            }
            goToMessage(last_trgt);
        });
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();