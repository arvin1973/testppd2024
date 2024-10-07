var main = function(){
    controller = "index.php/hasil_verifikasi_G2";
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
       
       table.on('click', 'a.detail', function(e){
            e.preventDefault();
            //
            var id      = $(this).data("id");
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
                            $('form#form_ch p[name="status"]').html(obj.status_p);
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
                            $('form#form_dpk div[name="sk"]').html(obj.status_kasus);
                            $('form#form_dpk textarea[name="alter"]').val(obj.alasan);
                           
                            $('.List_detail').show('');
                            $('.list_menu').show('');
                            $('.list_program_wrapper').hide();
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
        $(".wrapper_status").on('click', '.inp_r_status', function(e){
            //alert();
            $(".hidden_terminasi").hide();
            if (this.value == '2') {
                    $(".hidden_terminasi").show();
            }
        });
//       $('input[type=radio][name=sk]').change(function(e) {           
//            e.preventDefault();
//            $(".rujukan_div").hide();
//            if (this.value == '4') {
//                    $(".rujukan_div").show();
//            }
//
//        });
       
       var form_dpk = $("#form_dpk");
       
       form_dpk.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                id:{required:true}, 
//                sk:{required:true}, 
//                alter:{required:true},                
            },
            
            highlight: function (element) { // hightlight error inputs
                $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // hightlight error inputs
                $(element)
                .closest('.has-error').removeClass('has-error'); // set error class to the control group
            },
//            errorPlacement: function(error, element) {
//                if (element.attr("name") === "tgl_lahir" ) {
//                    error.insertAfter(element.parent());
//                } else {
//                    error.insertAfter(element);
//                }
//            },
            submitHandler: function(form) {
                // some other code
                // maybe disabling submit button
                // then:
                var data1 = new FormData(form_dpk[0]);
                var url = controller+"/detail_act";
//                var data = form_e.serialize();
                data1.append(csrf_name, $("#csrf").val());
                var data = data1;
                
                loading.fadeIn();
                msg_obj = $("#msg_edit");
                msg_obj.hide();
                jQuery.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: base_url+url, //Where to make Ajax calls
//                    dataType:"text", // Data type, HTML, json etc.
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
                            //success msg
                            if(obj.status === 1){
                                sweetAlert("Success", obj.msg, "success");
                                
                                //form_e[0].reset();
                                window.setTimeout(function(){
                                    msg_obj.fadeOut();
                                    $('.List_detail').hide('');
                                    $('.list_menu').hide('');
                                    $('.list_program_wrapper').show();
                                }, 2000);
                                $("#csrf").val(obj.csrf_hash);
                                $('.List_detail').hide('');
                                $('.list_menu').hide('');
                                $('.list_program_wrapper').show();
                                $('.list_program_wrapper').focus();
                                datatable.ajax.reload();
                            }

                            //error msg
                            else if(obj.status === 0){
                                sweetAlert("Error", obj.msg, "error");
                                datatable.ajax.reload();
                            }
                            loading.hide();
                        }
                        else
                        {
                            show_alert_ms(msg_obj,99,response);loading.hide();
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
       
       $(".btnBack").click(function(e){
            e.preventDefault();
            form_dpk[0].reset();
            $('.List_detail').hide('');
            $('.list_menu').hide('');
            $('.list_program_wrapper').show();
        });
       
       
       
      

    };
   
    return{
        init:function(){datatable();}
//        detail:function(){detail();}
    };
}();