var main = function(){
    controller = "PPD4_M_Dokumen_Kota";
    var datatable = function(){
        
        var table   = $("#dataUser_kota");
        var t_bahan = $("#t_bahan_kota");
        
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
                     { "targets": 1, "orderable": false },
                     { "width": "2px", "targets": 0},
//                     { "width": "150px", "targets": 1},
//                     { "width": "80px", "targets": 2}                     
                 ],
                 "lengthMenu": [[ 20, 25, 50, 100], [ 20, 25, 50, "All"]],
                 "initComplete": function(settings, json) {
                     //console.log(settings);
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
        
        table.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id        = _self.data("id");
            var lblkk     = _self.data("nmkk");
            $("#inp_wlyh").val(id);
            $(".lbl_hdr_katewlyh").html("Kota").parent("tr").show();
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
                            console.log(obj.group);
                             $("#t_bahan_kota > tbody").html(obj.str);
                             $("._wrapper_wlyh").hide();
                             $("._wrapper_info").css("display", "block");
                             $("._wrapper_bahan").show();
                            //  $(".list_kabko").fadeIn();
                             $(".list_kabko").css("display", "block");
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

        t_bahan.on('click','._btnUplDok',function(){
            var _self   = $(this);
            var id      = _self.data('id');
            var nmdok   = _self.data('nmdok');
            var frmdata   = _self.data('frmat');
            var nilai   = $(this).find("input").val();  
            $('form#frmDokumenAdd input[name="iddok"]').val(id);
            $('form#frmDokumenAdd input[name="datafrm"]').val(frmdata);
            $('form#frmDokumenAdd input[name="nama"]').val(nmdok);
            $('form#frmDokumenAdd strong[name="frmat"]').html(frmdata);
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            $('#mdl_dokomen_add').modal('show');

            //mendefinisikan format extension dengan format extension yang ada di var frmdata
            // --start--
            $( 'form#frmDokumenAdd input[name="attch"]' ).rules( "add", {
                extension: frmdata
            });
             //--end--
           
       });
       var frmDokumenAdd = $("#frmDokumenAdd");
       frmDokumenAdd.validate({
           errorElement: 'span',
           errorClass: 'error',
           rules:{
                id:{required:true},
                nama:{required:true},
                datafrm:{required:true},
                attch:{filesize: 300000000}, //300 mb
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var url = controller+"/save_dokumen_kab";
                var data1 = new FormData(frmDokumenAdd[0]);
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
                                g_bahan();
                                frmDokumenAdd[0].reset();
                                $('#mdl_dokomen_add').modal('toggle');
                                
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
                            // loading.hide();
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
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

        $("#btnShwMdlSindiAdd").click(function(){
            $("#frmDokAdd")[0].reset();
            var idkab = $("#inp_wlyh").val();
            $('form#frmDokAdd input[name="idkabU"]').val(idkab);
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            $('#mdl_dok_add').modal('show');
            
        });

        $(document).ready(function(){
            // Initialize Select2 on the select element
            $('#tagSelect').select2({
                placeholder: "Ketik lalu tekan tombol enter",
                tags: true,
                tokenSeparators: [',', ' '], // Define separators for tagging
            });

            // Sample data for pre-existing options
            var existingTags = [
                'Dokumen Inovasi',
            ];

            // Dynamically populate existing options
            $.each(existingTags, function(index, tag) {
                var option = new Option(tag, tag, false, false);
                $('#tagSelect').append(option);
            });

            // Trigger an event to update Select2 after dynamically adding options
            $('#tagSelect').trigger('change');
        });

        t_bahan.on('click','._btnUplInovasiDok',function(){
            var _self   = $(this);
            var id      = _self.data('id');
            var nmdok   = _self.data('nmdok');
            var frmdata   = _self.data('frmat');
            var nilai   = $(this).find("input").val();   
            $('form#frmDokumenInovasiAdd input[name="iddok"]').val(id);
            $('form#frmDokumenInovasiAdd input[name="datafrm"]').val(frmdata);
            $('form#frmDokumenInovasiAdd input[name="nama"]').val(nmdok);
            $('form#frmDokumenInovasiAdd strong[name="frmat"]').html(frmdata);
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            $('#mdl_dokomen_inovasi_add').modal('show');

            //mendefinisikan format extension dengan format extension yang ada di var frmdata
            // --start--
            $( 'form#frmDokumenInovasiAdd input[name="attch"]' ).rules( "add", {
                extension: frmdata
            });
            // --end--
        
        });

        var frmDokumenInovasiAdd = $("#frmDokumenInovasiAdd");
        frmDokumenInovasiAdd.validate({
           errorElement: 'span',
           errorClass: 'error',
           rules:{
                nama:{required:true},
                judul:{required:true},
                deskripsi:{required:true},
                input:{required:true},
                proses:{required:true},
                output:{required:true},
                outcome:{required:true},
                tagInovasi:{required:true},
                datafrm:{required:true},
                // attch:{extension: "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi|",filesize: 300000000}, //300 mb
                attch:{filesize: 300000000}, //300 mb
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var url = controller+"/save_dokumen_kab_inovasi";
                var data1 = new FormData(frmDokumenInovasiAdd[0]);
                
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
                        // $('#uploadStatus').html('<img src="loading.gif"/>');
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
                                g_bahan();
                                frmDokumenInovasiAdd[0].reset();
                                $('#mdl_dokomen_inovasi_add').modal('toggle');
                                
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
                            // loading.hide();
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
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

        var frmDokAdd = $("#frmDokAdd");
        frmDokAdd.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
                attch:{extension: "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi|",filesize: 300000000}, //300 mb
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
                var url = controller+"/save_dok";
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
                                g_bahan();
                                frmDokAdd[0].reset();
                                $('#mdl_dok_add').modal('toggle');
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
                            // loading.hide();
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
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
        }, 'Ukuran berkas maksimal 100 Mb');
        
        t_bahan.on("click","._btnEdtDok",function(){
            var _self       = $(this);
            var id      = _self.data('id');
            var nmdok   = _self.data('nmdok');
            var frmdata   = _self.data('frmat');
            var iddok   = _self.data("idmap");
            var kate   = _self.data("kate");
            var jdl   = _self.data("jdl");
            if(kate=='1'){
                $("#nama").prop("readonly",true);
                $("#nama").val(nmdok);
                 $("._wrapper_del").hide();
            }else{
                $("#nama").prop("readonly",false);
                $("#nama").val(jdl);
                $("._wrapper_del").show();
            }
            $('form#frmDokEdt strong[name="frmat"]').html(frmdata);
            $('form#frmDokEdt input[name="datafrm"]').val(frmdata);
            $('form#frmDokEdt input[name="dokdata"]').val(id);
            $("#iddok").val(iddok);
            
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            $('#mdl_dok_edt').modal('show');

            //mendefinisikan format extension dengan format extension yang ada di var frmdata
            // --start--
            $( 'form#frmDokEdt input[name="filedok"]' ).rules( "add", {
                extension: frmdata
            });
            // --end--

        });
        var frmDokEdt = $("#frmDokEdt");
        frmDokEdt.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                nama:{required:true},
                iddok:{required:true},
                // filedok:{extension: "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi|",filesize: 300000000}, //300 mb
                filedok:{filesize: 300000000}, //300 mb
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
                data1.append("id", $("#inp_dok").val());
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
                                g_bahan();
                                frmDokEdt[0].reset();
                                $('#mdl_dok_edt').modal('toggle');
                                
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
                            // loading.hide();
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
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

        t_bahan.on("click","._btnEdtInovasiDok",function(){
            var _self       = $(this);
            var id      = _self.data('id');
            var nmdok   = _self.data('nmdok');
            var frmdata   = _self.data('frmat');
            var iddok   = _self.data("idmap");
            var kate   = _self.data("kate");
            var jdl   = _self.data("jdl");
            
            var idinov   = _self.data("idinov");
            var nminov   = _self.data("nminov");
            var descinov   = _self.data("descinov");
            var inpinov   = _self.data("inpinov");
            var proinov   = _self.data("proinov");
            var outinov   = _self.data("outinov");
            var cominov   = _self.data("cominov");
            var tag   = _self.data("tag");


            // Split the string into an array of Tags
            var arrayTags = tag.split(',');
            // Build a JSON Tags
            var jsonTags = [];
            $.each(arrayTags, function(index, value) {
                jsonTags.push(value);
            });

            // Initialize Select2 on the select element
            $('#editTagSelect').select2({
                placeholder: "Ketik lalu tekan tombol enter",
                tags: true,
                tokenSeparators: [',', ' '], // Define separators for tagging
            });

            $('#editTagSelect').empty();
            // Dynamically populate existing options
            $.each(jsonTags, function(index, tag) {
                var option = new Option(tag, tag, false, false);
                $('#editTagSelect').append(option);
            });

            // Trigger an event to update Select2 after dynamically adding options
            $('#editTagSelect').trigger('change');

            if(kate=='1'){
                $("#editNama").prop("readonly",true);
                $("#editNama").val(nmdok);
                    //$("._wrapper_del").hide();
            }else{
                $("#editNama").prop("readonly",false);
                $("#editNama").val(jdl);
                //$("._wrapper_del").show();
            }
            $('form#frmDokInovasiEdt strong[name="frmat"]').html(frmdata);
            $('form#frmDokInovasiEdt input[name="datafrm"]').val(frmdata);
            $('form#frmDokInovasiEdt input[name="dokdata"]').val(id);

            $('form#frmDokInovasiEdt input[id="editJudul"]').val(nminov);
            $('form#frmDokInovasiEdt textarea[id="editDeskripsi"]').val(descinov);
            $('form#frmDokInovasiEdt textarea[id="editInput"]').val(inpinov);
            $('form#frmDokInovasiEdt textarea[id="editProses"]').val(proinov);
            $('form#frmDokInovasiEdt textarea[id="editOutput"]').val(outinov);
            $('form#frmDokInovasiEdt textarea[id="editOutcome"]').val(cominov);
            $('form#frmDokInovasiEdt select[id="editTagSelect"]').val(jsonTags).trigger('change');
            $("#editIddok").val(iddok);
            
            //$("#filedok").text(lbfile);
            //$("._wrapper_info").hide();
            $(".progress-bar").width('0%');
            $(".progress-bar").html('0%');
            $('#mdl_dok_inovasi_edt').modal('show');

            //mendefinisikan format extension dengan format extension yang ada di var frmdata
            // --start--
            $( 'form#frmDokInovasiEdt input[name="editFiledok"]' ).rules( "add", {
                extension: frmdata
            });
            // --end--
        }); 
       
        var frmDokInovasiEdt = $("#frmDokInovasiEdt");
        frmDokInovasiEdt.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                iddok:{required:true},
                nama:{required:true},
                judul:{required:true},
                deskripsi:{required:true},
                input:{required:true},
                proses:{required:true},
                output:{required:true},
                outcome:{required:true},
                tagInovasi:{required:true},
                // filedok:{extension: "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi|",filesize: 300000000}, //300 mb
                filedok:{filesize: 300000000}, //300 mb
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
                var url = controller+"/update_inovasi_dok";
                var data1 = new FormData(frmDokInovasiEdt[0]);
                
                data1.append(csrf_name, $("#csrf").val());
                data1.append("id", $("#inp_dok").val());
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
                                g_bahan();
                                frmDokInovasiEdt[0].reset();
                                $('#mdl_dok_inovasi_edt').modal('toggle');
                                
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
                            // loading.hide();
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; 
                            }, 2000);
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

        t_bahan.on('click', '._btnDokDel', function(e){
            e.preventDefault();
            var _self   = $(this);
            var id      = _self.data('idmap');
            var title   = $(this).data("jdl");
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
                                    // loading.hide();
                                    window.setTimeout(function(){
                                        window.location.href = base_url+default_controller; 
                                    }, 2000);
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
        
        $("#btnDowDoc").click(function(){
            var id          = $("#inp_wlyh").val();
            window.open(base_url+controller+"/d_bahan?wl="+id); 
        });
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();