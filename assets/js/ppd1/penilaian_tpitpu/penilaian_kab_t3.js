var main = function(){
    controller = "PPD1_t3_penilaian_kab";
    var datatable = function(){
        
        var table   = $("#dataUser");
        var t_bahan = $("#t_bahan");
        var t_group = $("#t_dataGroup");
        var t_tahap = $("#t_dataTahap");
        var twlyh = $("#t_tpitpu");
        
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
      
        
        t_bahan.on("click","a.getDetail",function(e){
            var _self    = $(this);
            var id       = _self.data("id");
            var lblP     = _self.data("title");
            $("#inp_penilai").val(id);
            $(".lbl_hdr_katewlyh").html(lblP).parent("tr").show();

            d_view();
        });
        
        function d_view(){
             loading.show();
             ajax_url = controller+"/detail_view";
             ajax_data="id="+$("#inp_penilai").val();
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
                             $("#t_tpitpu > tbody").html(obj.str);
                             $("._wrapper_bahan").hide();
                             $("._wrapper_info").show();
                             $("._wrapper_penilai").show();
//                             
//                             $('#t_dataSel select[name="select_gr"]').html(obj.str);
//                             $("#t_dataTahap > tbody").html(obj.tbl_tahap);
//                             $('#t_datatah select[name="select_thp"]').html(obj.str_t);
//                             if(obj.tahap==='3'){
//                                $("._wrpTahap").show();
//                                $("._wrpGruTahap").show();
//                            }else{
//                                $("._wrpTahap").hide();
//                                $("._wrpGruTahap").hide();    
//                                        }
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
            var id          = $("#inp_penilai").val();
            window.open(base_url+controller+"/d_bahan?wl="+id); 
        });
        twlyh.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            window.open(base_url+controller+"/Download_nilai?token="+id); 
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
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();