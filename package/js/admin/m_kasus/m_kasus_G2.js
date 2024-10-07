var main = function(){
    controller = "index.php/Manajemen_kasus_G2";
    var datatable = function(){
        $('.inp_wp').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });
        $('.inp_tm').timepicker({
            showMeridian: false
        });
        
        var table = $("#data");
        //var table_p = $("#pertanyaan"); 
        var data_soal = $("#data_soal");
        
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
                    //Make your callback here.
    //                    $("#csrf").val(json.csrf_hash);
                    return json.data;
                }                
            },
            "columnDefs": [ 
                { "targets": 4, "orderable": false },
                { "width": "50px", "targets": 4 }
            ],
            "initComplete": function(settings, json) {
    //                console.log(settings);
            },
            paging: true,
            dom: 'lfrtip',
            buttons: [
                {
                    text: 'New',
                    className: 'btn btn-default btn-sm waves-effect waves-light',
                    action: function ( e, dt, node, config ) {
                        $('#modal_add').modal('show') 
                    }
                }
            ],
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
       

       
       
        var forml = $("#form_add");
        
        var msg_obj=$("#msg_add");
        
       $("#modal_add_show").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('#modal_add').modal('show');
        });
        
        msg_obj.hide();
        
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
               nama:{required:true},
                jenis:{required:true},
                pendidikan:{required:true},
                status:{required:true},
                inp_wp:{required:true},
            }
            ,
            errorPlacement: function(error, element) {
                if (element.attr("name") === "tgl_isi" || element.attr("name") === "tgl_lahir" ) {
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
                var data = forml.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val();
                
                loading.show();
                msg_obj.hide();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:data, //Form variables
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
                                sweetAlert("Success", obj.msg, "success");
                                forml[0].reset();
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                            }
                            datatable.ajax.reload();
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
        
        table.on('click', 'a.edit', function(e){
            
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/ques_datatable";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+ajax_url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:ajax_data, //Form variables
                success:function(response){
                    var obj = null;
                    try
                    {
                         obj = $.parseJSON(response);     
                    }catch(e)
                    {}
                    if(obj){
                        if(obj.status === 1){
              //              $("#pertanyaan").html(obj.content);
                            //$('form#form_ch input[name="nama"]').val(obj.data[0].nama);
                            $('form#form_ch input[name="nama"]').val(obj.data[0].nama);
                            $('form#form_ch input[name="nik"]').val(obj.data[0].nik);
                            $('form#form_ch select[name="usia"]').val(obj.data[0].usia);
                            $('form#form_ch select[name="jenis"]').val(obj.data[0].jk);
                            $('form#form_ch select[name="pendidikan"]').val(obj.data[0].pendidikan);
                            $('form#form_ch select[name="status"]').val(obj.data[0].status);
                            $('form#form_ch input[name="janakE"]').val(obj.data[0].ja);
                            $('form#form_ch input[name="jlakiE"]').val(obj.data[0].ja_l);
                            $('form#form_ch input[name="jperempuanE"]').val(obj.data[0].ja_p);
                            $('form#form_ch select[name="status_eko"]').val(obj.data[0].ekonomi);
                            $('form#form_ch input[name="inp_wp"]').val(obj.tgl);
                            $('form#form_ch input[name="inp_tm"]').val(obj.data[0].waktu);
                            $('form#form_ch input[name="tempat"]').val(obj.data[0].tempat);
                            $('form#form_ch input[name="nmpen"]').val(obj.data[0].nm_pecatat);
                            $('form#form_ch input[name="nmpel"]').val(obj.data[0].nm_pelapor);
                            $('form#form_ch select[name="jk_pencatat"]').val(obj.data[0].jk_p);
                            $('form#form_ch select[name="usia_pencatat"]').val(obj.data[0].usia_p);
                            $('form#form_ch textarea[name="penjelasan"]').val(obj.data[0].ket);
                            $('form#form_ch input[name="id"]').val(obj.id);
                            //$("#ver").html(obj.content_ver);
                            $('.list_program_wrapper').hide();
                            $('.List_detail').show();
                            loading.hide();
                        }
                        else if(obj.status === 0){
                            loading.hide();
                            sweetAlert("Error", obj.msg, "error");
                        }
                        //session ended msg
                        else if(obj.status === 2){
                            sweetAlert("Error", obj.msg, "error");
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; //redirect ke login page
                            }, 2000);
                        }
                        $("#csrf").val(obj.csrf_hash);
                    }
                    else{
                        show_alert_ms(msg_obj,99,response);
                        loading.hide();
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
        
        
        
        $(".laki").change(function () {
            
//        var l = $("#jlaki").val();
//        var p = $("#jperempuan").val();
        var l = document.getElementById('jlaki').value;
        var p = document.getElementById('jperempuan').value;
        $("#janak").val('');
        var hsl = parseInt(l) + parseInt(p) ; 
        //alert(hsl);
        $("#janak").val(hsl);
    });
        $(".perem").change(function () {
        //var l = $("#jlaki").val();
        //var p = $("#jperempuan").val();
        var l = document.getElementById('jlaki').value;
        var p = document.getElementById('jperempuan').value;
        $("#janak").val('');
        var hsl = parseInt(l) + parseInt(p) ; 
          //  alert(hsl);
        $("#janak").val(hsl);
        
    });
    
    $(".lakiE").change(function () {
        var l = document.getElementById('jlakiE').value;
        //alert(l);
        var p = document.getElementById('jperempuanE').value;
        $("#janak").val('');
        var hsl = parseInt(l) + Number(p) ; 
        $("#janakE").val(hsl);
    });
    $(".peremE").change(function () {
        var l = document.getElementById('jlakiE').value;
        var p = document.getElementById('jperempuanE').value;
        $("#janak").val('');
        var hsl = parseInt(l) + parseInt(p) ;
        $("#janakE").val(hsl);
    });        
        
    $(".btnBack").click(function(e){
            e.preventDefault();
            //form_ch[0].reset();
            $('.List_detail').hide('');
            $('.fade').hide('');
            $('.list_program_wrapper').show();
            $('.list_program_wrapper').focus();
        });    
        
        
        
        
        $("#modal_add_v").click(function(e){
            e.preventDefault();
            forml[0].reset();
            $('#modal_add').modal('show');
        });
        $("#modal_add_hv").click(function(e){
            e.preventDefault();
            var id = $('.radio:checked').data("id");
            alert(id);
            //var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/ques_datatable";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+ajax_url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:ajax_data, //Form variables
                success:function(response){
                    var obj = null;
                    try
                    {
                         obj = $.parseJSON(response);     
                    }catch(e)
                    {}
                    if(obj){
                        if(obj.status === 1){
              //              $("#pertanyaan").html(obj.content);
                            //$('form#form_ch input[name="nama"]').val(obj.data[0].nama);
                            $('form#form_ch p[name="nama"]').html(obj.data[0].nama);
                            $('form#form_ch p[name="nik"]').html(obj.data[0].nik);
                            $('form#form_ch p[name="jk"]').html(obj.data[0].jk);
                            $('form#form_ch p[name="tgl"]').html(obj.data[0].tgl);
                            $('form#form_ch p[name="ket"]').html(obj.data[0].ket);
                            $('form#form_ch input[name="id"]').val(obj.id);
                            $('.List_detail').show();
                            $("#ver").html(obj.content_ver);
                            $('.list_program_wrapper').hide();
                            $('.List_pp').show();
                            $('.List_detail').show();
                            loading.hide();
                        }
                        else if(obj.status === 0){
                            loading.hide();
                            sweetAlert("Error", obj.msg, "error");
                        }
                        //session ended msg
                        else if(obj.status === 2){
                            sweetAlert("Error", obj.msg, "error");
                            window.setTimeout(function(){
                                window.location.href = base_url+default_controller; //redirect ke login page
                            }, 2000);
                        }
                        $("#csrf").val(obj.csrf_hash);
                    }
                    else{
                        show_alert_ms(msg_obj,99,response);
                        loading.hide();
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
        
        
        
        
       var form_ch = $("#form_ch"); 
       form_ch.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
               nama:{required:true},
                jenis:{required:true},
                pendidikan:{required:true},
                status:{required:true},
                inp_wp:{required:true},
            }
            ,
            errorPlacement: function(error, element) {
                if (element.attr("name") === "tgl_isi" || element.attr("name") === "tgl_lahir" ) {
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
                var url = controller+"/add_ver";
                var data = form_ch.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val();
                
                loading.show();
                msg_obj.hide();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+url, //Where to make Ajax calls
                    dataType:"text", // Data type, HTML, json etc.
                    data:data, //Form variables
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
                                loading.hide();
                                sweetAlert("Success", obj.msg, "success");
                                //form_ch[0].reset();
                                datatable.ajax.reload(function(){
                                    loading.hide();
                                    $('.list_program_wrapper').show();
                                    $('.List_detail').hide();
                                });
           
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                            }
                            datatable.ajax.reload();
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
        
        $("#segar").click(function(e){
            e.preventDefault();
            loading.show();
            datatable.ajax.reload(function(){
                loading.hide();
            });
        });

    };
   
    return{
        init:function(){datatable();}
//        detail:function(){detail();}
    };
}();