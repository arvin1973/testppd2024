    var main = function(){
        controller = "index.php/kertas_kerja_PPD2";
        var datatable = function(){
            var forml = $("#form_add");
            var msg_obj=$("#msg_add");
            msg_obj.hide();
            forml.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                rules:{
                    select_prov:{required:true},
                    attch:{extension: "pdf|doc|docx",filesize: 30000000}, //3 mb
                }
                ,
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "podate" || element.attr("name") === "material" || element.attr("name") === "supplier" ) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element) { // hightlight error inputs
                    $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // hightlight error inputs
                    $(element)
                    .closest('.has-error').removeClass('has-error'); // set error class to the control group
                },
                submitHandler: function(form) {
                    var url = controller+"/add_act";

                    var data1 = new FormData(forml[0]);
                    data1.append(csrf_name, $("#csrf").val());
                    var data = data1;

                    loading.show();
                    msg_obj.hide();
                    jQuery.ajax({
                        type: "POST", // HTTP method POST or GET
                        url: base_url+url, //Where to make Ajax calls
                        data:data, //Form variables
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
                            //var obj = jQuery.parseJSON(response);

                            if(obj)//if json data
                            {
                                loading.hide();$("#csrf").val(obj.csrf_hash);
                                //success msg
                                if(obj.status === 1){
                                    $("#detailid").val(obj.id);
    //                                datatable_detail.ajax.reload(function(){
    //                                    
    //                                });
                                        $("#form_add :input").prop("disabled", true);
                                        $(".formadd_wrapper").hide();
                                        $(".list_wrapper").show();
                                        sweetAlert("Success", obj.msg, "success");loading.hide();
                                        $('.list_dok').show();
                                        $('.input_dok').hide();
    //                                    window.location.href = base_url+controller; 
                                }

                                //error msg
                                else if(obj.status === 0){
                                    sweetAlert("Error", obj.msg, "error");
                                }
                                //datatable.ajax.reload();
                            }
                            else
                            {
                                sweetAlert("Error", response, "error");
                                loading.hide();
                            }
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            loading.hide(); 
                            sweetAlert("FATAL ERROR", thrownError, "error");
                        }
                    });
                    return false;
                }
            });
             $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, 'Ukuran berkas maksimal 3 Mb');

            
            var table1 = $("#tblPro");
            table1.on('click', 'a.uploadK', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var kode      = $(this).data("kode");
                var nama      = $(this).data("nama");
                var berkas      = $(this).data("berkas");
                //alert(id);
                $('.list_provinsi').hide();
                $('form#form_add input[name="select_prov"]').val(kode);
                $('form#form_add input[name="cname"]').val(nama);
                $('form#form_add input[name="attch"]').val(berkas);
                //$('.dokumen_kertas').show();    
                $('.dokumen_kertas').show();
            });
//            var form2 = $("#form_kertas");
//            form2.validate({
//            errorElement: 'span', //default input error message container
//            errorClass: 'help-block help-block-error', // default input error message class
//            rules:{
//                idkertas:{required:true},
//                cname:{required:true},
//                attch:{extension: "pdf|doc|docx",filesize: 30000000}, //3 mb
//            }
//            ,
//            errorPlacement: function(error, element) {
//                if (element.attr("name") === "podate" || element.attr("name") === "material" || element.attr("name") === "supplier" ) {
//                    error.insertAfter(element.parent());
//                } else {
//                    error.insertAfter(element);
//                }
//            },
//            highlight: function (element) { // hightlight error inputs
//                $(element)
//                .closest('.form-group').addClass('has-error'); // set error class to the control group
//            },
//            unhighlight: function (element) { // hightlight error inputs
//                $(element)
//                .closest('.has-error').removeClass('has-error'); // set error class to the control group
//            },
//            submitHandler: function(form) {
//                var url = controller+"/add_act";
//                var data1 = new FormData(form2[0]);
//                data1.append(csrf_name, $("#csrf").val());
//                var data = data1;
//                
//                loading.show();
//                msg_obj.hide();
//                jQuery.ajax({
//                    type: "POST", // HTTP method POST or GET
//                    url: base_url+url, //Where to make Ajax calls
//                    data:data, //Form variables
//                    mimeType: "multipart/form-data",
//                    cache: false,
//                    contentType: false,
//                    processData: false,
//                    success:function(response){
//                        var obj = null;
//                        try{
//                            obj = $.parseJSON(response);  
//                        }catch(e)
//                        {}
//                        //var obj = jQuery.parseJSON(response);
//
//                        if(obj)//if json data
//                        {
//                            loading.hide();$("#csrf").val(obj.csrf_hash);
//                            //success msg
//                            if(obj.status === 1){
//                                $("#detailid").val(obj.id);
////                                datatable_detail.ajax.reload(function(){
////                                    
////                                });
//                                    $("#form_add :input").prop("disabled", true);
//                                    $(".formadd_wrapper").hide();
//                                    $(".list_wrapper").show();
//                                    sweetAlert("Success", obj.msg, "success");loading.hide();
//                                    $('.list_dok').show();
//                                    $('.input_dok').hide();
////                                    window.location.href = base_url+controller; 
//                            }
//
//                            //error msg
//                            else if(obj.status === 0){
//                                sweetAlert("Error", obj.msg, "error");
//                            }
//                            //datatable.ajax.reload();
//                        }
//                        else
//                        {
//                            sweetAlert("Error", response, "error");
//                            loading.hide();
//                        }
//                    },
//                    error:function (xhr, ajaxOptions, thrownError){
//                        loading.hide(); 
//                        sweetAlert("FATAL ERROR", thrownError, "error");
//                    }
//                });
//                return false;
//            }
//        });
       
        

        };
        
    return{
        init:function(){datatable();},
        tble:function(){edittable();},
       // detail:function(){chart();},
    };
    }();