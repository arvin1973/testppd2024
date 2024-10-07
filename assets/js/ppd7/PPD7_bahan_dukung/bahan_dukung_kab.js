var main = function(){
    controller = "PPD7_bahan_dukung_kab";
    var datatable = function(){
        
        var twlyh = $("#t_wlyh");
        
        
        
        function g_wilayah(){
            loading.show();
            ajax_url = controller+"/g_wilayah";
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
                            $("#t_wlyh").html(obj.str);
                            //$("._wrapper").hide();
                           // $("._wrapper_prov").fadeIn();
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
        g_wilayah(); 
        twlyh.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblpkk     = _self.data("nmpkk");
            $("#inp_wlyh").val(id);
            $("._wrapper_bahan").show();
            $("._wrapper_wlyh").hide();
            $(".lbl_hdr_katewlyh").html("Kabupaten").parent("tr").show();
            $(".lbl_hdr_nmwlyh").html(lblpkk).parent("tr").show();
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
                            $("._wrapper_bahan").show();
                            // $("._wrapper_info").show();
                            $("._wrapper_info").css("display", "block");
                            $("._wrapper_bahan").fadeIn();
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
        
        $("#btnDowDoc").click(function(){
            var id = $("#inp_wlyh").val();
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
            if(_reload=='prov'){
                g_wilayah();
            }
            else if(_reload=='indi'){
                g_prov();
            }
            goToMessage(last_trgt);
        });
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();