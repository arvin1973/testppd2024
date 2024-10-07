var main = function(){
    controller = "PPD1_status_penilaian_prov";
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
                 "lengthMenu": [[5, 20, 25, 50], [5, 20, 25, 50]],
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

        $("#rekap_resume_by_user").click(function(e){
            window.open(base_url+controller+"/rekap_resume_tpt_by_user"); 
        });
        
        $(document).ready(function(){

            loading.show();
            ajax_url = controller+"/g_rekap_penilaian_tim";
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
                            console.log(obj);
                            $("#rekap_sudah_melakukan_penilaian").html(obj.str);
                            $("#rekap_all_penilai").html(obj.str_all_penilai);
                            var persentage_penilai = (parseFloat(obj.str) / parseFloat(obj.str_all_penilai) * 100).toFixed(2);
                            var prosesBar = $('#progress-bar-penilaian');
                            $("#progress-penilaian").html(persentage_penilai +'%');
                            $("#span-progress-bar-penilaian").html(persentage_penilai+'% Complete');

                            setInterval(function(){
                                prosesBar.css('width', persentage_penilai + '%');
                                prosesBar.attr('aria-valuenow', persentage_penilai);
                            }, 100);
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
                             $(".stepper-status-penilaian-provinsi-tpt").hide();
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
            var prov   = $(this).data("pr");
            //alert(prov);
            ajax_url = controller+"/penilaian_excel";
            window.open(base_url+controller+"/Download_nilai?timid="+id+"&provid="+prov);
        });
        
        // Use event delegation
        $(document).on('click', '#downAllProv', function(e) {
            e.preventDefault();
            var prov = $(this).data('pr');
            window.open(base_url + controller + "/downloadAllNilai?provid=" + prov); 
        });

        
        
        $("#btnShwMdlSindiAdd").click(function(){
            $("#frmDokAdd")[0].reset();
            $('#mdl_dok_add').modal('show');
        });
        
        var frmDokAdd = $("#frmDokAdd");
        frmDokAdd.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
                attch:{extension: "pdf|doc|docx|xlsx|xls|csv|",filesize: 300000000}, //3 mb
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
        }, 'Ukuran berkas maksimal 3 Mb');
     
     
     
        t_bahan.on("click","a.btnEdi",function(e){
            var _self    = $(this);
            var id       = _self.data("id");
            var lbnm     = _self.data("nama");
            var lbfile   = _self.data("file");
            $("#inp_wlyh").val(id);
            $("#nama").val(lbnm);
            $("#filedok").text(lbfile);
            $("._wrapper_info").hide();
            $('#mdl_dok_edt').modal('show');
        });   
        
        var frmDokEdt = $("#frmDokEdt");
        frmDokEdt.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
                filedok:{extension: "pdf|doc|docx|xlsx|xls|csv|",filesize: 300000000}, //3 mb
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
            goToMessage(last_trgt);
        });
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();