var main = function(){
    controller = "index.php/Verivikasi_G2";
    var datatable = function(){
        $('.inp_wp').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });
        $('.timepicker2').timepicker({
            Format: "HH:mm:ss",
            autoclose:true,
        });
        var table = $("#data");
        var table_v = $("#data_ver"); 
        //var data_soal = $("#data_soal");
        
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
       
        var datatable_v = table_v.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/verifikasi_datatable", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                },
                data: function(d){
                        d.id     =$('.Kdtddtm').val();
                },
                "dataSrc": function ( json ) {
                    //Make your callback here.
//                    $("#csrf").val(json.csrf_hash);
                    return json.data;
                }                
            },
            "columnDefs": [ 
                { "targets": 2, "orderable": false },
                { "width": "5px", "targets": 2 },
                {"text-center":"<td>" }
            ],
            "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
//            dom: 'lfrtip',
//            buttons: [
//                {
//                    text: 'New',
//                    className: 'btn btn-default btn-sm waves-effect waves-light',
//                    action: function ( e, dt, node, config ) {
//                        $('#modal_add').modal('show') 
//                    }
//                }
//            ],
            "language": {
                "sProcessing":   "Sedang memproses...",
                "sLengthMenu":   "Tampilkan _MENU_ entri",
                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
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
       
       table.on('click', 'a.detail', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            $('.Kdtddtm').val(id);
            var msg_obj = $("#msg");
   
            ajax_url = controller+"/detail_get";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            $("#detailid").val(id);
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
                    //var obj = jQuery.parseJSON(response);

                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            loading.hide();
                            $('form#form_ch input[name="id"]').val(obj.id);
                            $('form#form_ch p[name="nik"]').html(obj.data[0].nik);
                            $('form#form_ch p[name="nama_t"]').html(obj.data[0].nama);
                            $('form#form_ch p[name="jk"]').html(obj.data[0].jk);
                            $('form#form_ch p[name="status"]').html(obj.stat);
                            $('form#form_ch p[name="pendidikan"]').html(obj.pendidikan);
                            $('form#form_ch p[name="usia"]').html(obj.data[0].usia);
                            $('form#form_ch p[name="jmlanak"]').html(obj.data[0].ja);
                            $('form#form_ch p[name="jlaki"]').html(obj.data[0].ja_l);
                            $('form#form_ch p[name="jperempuan"]').html(obj.data[0].ja_p);
                            $('form#form_ch p[name="tempat"]').html(obj.data[0].tempat);
                            $('form#form_ch p[name="ekon"]').html(obj.ekon);
                            $('form#form_ch p[name="tgl"]').html(obj.data[0].tgl);
                            $('form#form_ch p[name="waktu"]').html(obj.data[0].waktu);
                            $('form#form_ch p[name="nm_pen"]').html(obj.data[0].nm_pecatat);
                            $('form#form_ch p[name="nm_pel"]').html(obj.data[0].nm_pelapor);
                            $('form#form_ch p[name="jk_p"]').html(obj.data[0].jk_p);
                            $('form#form_ch p[name="usia_p"]').html(obj.data[0].usia_p);
                            $('form#form_ch p[name="penjelasan"]').html(obj.data[0].ket);
                            //Dokumen Pembahasan Kasus
                            $('form#form_dpk input[name="id"]').val(obj.id);
                            $('form#form_dpk input[name="inp_wp"]').val(obj.tgl_dpk);
                            $('form#form_dpk input[name="timepicker2"]').val(obj.waktu);
                            $('form#form_dpk input[name="peserta"]').val(obj.peserta);
                            $('form#form_dpk textarea[name="penjelasan"]').val(obj.penjelasan);
                            datatable_v.ajax.reload(function(){
                               $('.List_detail').show('');
                                                       $('.list_menu').show('');
                                                       $('.list_program_wrapper').hide(); 
                           });
                            
                        }
                        //error msg
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
                    else
                    {
                        show_alert_ms(msg_obj,99,response);loading.hide();
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

        table_v.on('click', 'a.edit', function(e){
            e.preventDefault();
            //
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_soal";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            $("#detailid").val(id);
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
                    //var obj = jQuery.parseJSON(response);

                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            loading.hide();
                            $('form#form_add_dtm input[name="id"]').val(obj.id);
                            $('form#form_add_dtm input[name="idkt"]').val($('.Kdtddtm').val());
                            $('form#form_add_dtm input[name="nosoal"]').val(obj.data[0].code);
//                            $('form#form_edit input[name="code"]').val(obj.data[0].code+", "+obj.data[0].soal);
                            $('form#form_add_dtm label[name="soal"]').html(obj.data[0].code+". "+obj.data[0].soal);
                            $('form#form_add_dtm div[name="jwb"]').html(obj.jawaban);
                            $('#modal_add').modal('show');
                        }
                        //error msg
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
                    else
                    {
                        show_alert_ms(msg_obj,99,response);loading.hide();
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

        var forml = $("#form_add_dtm");
        var msg_obj=$("#msg_add");
        forml.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
               id:{required:true},
                idkt:{required:true},
                nosoal:{required:true}
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
//                                sweetAlert("Success", obj.msg, "success");
//                                forml[0].reset();
                                datatable_v.ajax.reload(function(){
                                    $('#modal_add').modal('toggle');
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
       
       
        $("#segarkan").click(function(e){
            e.preventDefault();
            loading.show();
            datatable_v.ajax.reload(function(){
                loading.hide();
            });
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