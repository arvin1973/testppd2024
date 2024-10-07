var main = function(){
    controller = "PPD1_status_penilaian_kab";
    var datatable = function(){
        var table   = $("#dataUser");
        var t_bahan = $("#t_bahan");
        
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
                         return json.data;
                     }

                 },
                 "columnDefs": [                  
//                     { "targets": 0, "orderable": false },
                     { "width": "2px", "targets": 0},
                 ],
                 "lengthMenu": [[10, 20, 25, 50], [10, 20, 25, 50]],
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

        $("#export_penilaian").on("click", function(e){

            loading.show();
            ajax_url = controller+"/g_nilai_berdasarkan_penilai";
            jQuery.ajax({
                type: "GET",
                url: base_url+ajax_url,
                dataType:"text",
                success:function(response){
                    var obj = null;
                    try
                    {
                        obj = $.parseJSON(response);  
                    }catch(e)
                    {}

                    if(obj){
                        $("#csrf").val(obj.csrf_hash);
                        if(obj.status === 1){
                            $("#tabel_progres_penilai > tbody").html(obj.str);
                            $('#tabel_progres_penilai').DataTable();
                            loading.hide();
                        }else if(obj.status === 0){
                            console.log(obj);
                            loading.hide();
                            sweetAlert("Error", obj.msg, "error");
                        }else if(obj.status === 2){
                            console.log(obj);
                            sweetAlert("Caution", obj.msg, "warning");
                            window.setTimeout(function(){
                                window.location.href = base_url+"welcome";
                            }, 2000);
                        }
                    }else{
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

        $("#rekap_penilaian_by_user").click(function(e){
            window.open(base_url+controller+"/rekap_penilaian_tpt_by_user"); 
        });

        $("#rekap_penilaian_daerah").click(function(e){
            window.open(base_url+controller+"/rekap_penilaian_daerah_by_tpt"); 
        });

        $("#rekap_resume_by_user").click(function(e){
            window.open(base_url+controller+"/rekap_resume_tpt_by_user"); 
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
                            $("#btnDownAll").empty();
                            $("#t_bahan > tbody").html(obj.str);
                            $("#btnDownAll").append(obj.btn);
 //                            $("._wrapper_wlyh").hide();
 //                            $("._wrapper_bahan").show();
 //                            $("._wrapper_info").show();
                             $(".stepper-status-penilaian-kabupaten-tpt").hide();
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
         }
         
        t_bahan.on('click', 'a.btnDown', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            //var prov   = $(this).data("pr");
            var prov   = $("#inp_wlyh").val();
            ajax_url = controller+"/penilaian_excel";
            window.open(base_url+controller+"/Download_nilai?timid="+id+"&provid="+prov);
        });
        
        $(document).on('click', '#downAll', function(e) {
            e.preventDefault();
            var kab = $(this).data('pr');
            window.open(base_url + controller + "/downloadAllNilai?kabid=" + kab); 
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
            goToMessage(last_trgt);
        });
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();