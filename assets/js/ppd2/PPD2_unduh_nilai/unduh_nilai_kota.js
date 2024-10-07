var main = function(){
    controller = "PPD2_unduh_nilai_kota";
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
            window.open(base_url+controller+"/Download_nilai?token="+id); 
        });
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();