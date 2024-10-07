var main = function(){
    controller = "PPD5_M_Dokumen_Kab";
    var datatable = function(){
        
        function g_analytics(){
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-217181586-1');
        }g_analytics()
          
        
        var table   = $("#dataUser");
        var t_bahan = $("#t_bahan");
        var t_upload = $("#t_bahan");

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
                            // $("._wrapper_wlyh").hide();
                            // $("._wrapper_info").show();
                            // $("._wrapper_bahan").show();
                            // $(".list_kabko").fadeIn();
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
        }g_bahan()
        
        t_upload.on('click','._btnUplDok',function(){
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
            // --end--
       });
       
        var frmDokumenAdd = $("#frmDokumenAdd");

        frmDokumenAdd.validate({
            errorElement: 'span',
            errorClass: 'error',
            rules:{
                id:{required:true},
                nama:{required:true},
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
                                loading.hide();
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
       
         
       t_upload.on("click","._btnEdiDok",function(){
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
            
            //$("#filedok").text(lbfile);
            //$("._wrapper_info").hide();
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
         
        $("#btnShwMdlSindiAdd").click(function(){
            $("#frmDokAdd")[0].reset();
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

        t_upload.on('click','._btnUplInovasiDok',function(){
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

        t_upload.on("click","._btnEdtInovasiDok",function(){
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
        
        $("._wrapper_del").click(function(e){
            e.preventDefault();
            var id = $('form#frmDokEdt input[name="iddok"]').val();
            var title = $('form#frmDokEdt input[name="nama"]').val();
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
        
        t_upload.on('click', '._btnDokDel', function(e){
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