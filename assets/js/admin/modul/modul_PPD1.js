    var main = function(){
        controller = "index.php/Modul";
        var datatable = function(){
            var table = $("#tblPro");
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
                         //$("#ttl_qty").val(json.ttl_qty);
                         return json.data;
                     }

                 },
                 "columnDefs": [                  
                     { "targets": 2, "orderable": false },
                     { "width": "2px", "targets": 0},
                     { "width": "500px", "targets": 1},
//                     { "width": "80px", "targets": 2}                     
                 ],
                 "lengthMenu": [[5, 20, 25, 50, -1], [5, 20, 25, 50, "All"]],
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
            var table1 = $("#tblPro");
            table1.on('click', 'a.edit', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                //var msg_obj = $("#msg");
                ajax_url = controller+"/detail_get";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
                $("#iddaerah").val(id);
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
                                $('.list_modul').hide();
                                $('.list_kriteria').show();
                                $('.list_indikator').hide();
                                $('.list_penilai').hide();
                                $('.table_pencapaian').html(obj.tbl_kriteria);
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
                            sweetAlert("Error", obj.msg, "error");loading.hide();
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
            var tbl_kp = $("#tbl_kp");
            tbl_kp.on('click', 'a.isinilai', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                //var msg_obj = $("#msg");
                ajax_url = controller+"/detail_kategori_skor";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
                $("#kriteria_add").val(id);
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
                                $('.list_modul').hide();
                                $('.list_kriteria').hide();
                                $('.list_indikator').show();
                                $('.list_penilai').hide();
                                $('.table_indikator').html(obj.table_indikator);
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
                            sweetAlert("Error", obj.msg, "error");
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
            
            var tbl_ind = $("#tbl_ind");
            tbl_ind.on('click', 'a.isinilai', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                //var msg_obj = $("#msg");
                ajax_url = controller+"/detail_skor";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
                $("#indk_id").val(id);
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
                                $('.list_modul').hide();
                                $('.list_kriteria').hide();
                                $('.list_indikator').hide();
                                $('.list_penilai').show();
                                $('.table_item').html(obj.table_item);
                                $('form#form_indikator_add input[name="nomoradd"]').val(obj.max_s);
                                //$('#nomoradd').val(obj.max_s);
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
                            sweetAlert("Error", obj.msg, "error");loading.hide();
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
            tbl_ind.on('click', 'a.editNI', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                var kriteria  = $(this).data("kriteria");
                var indkno = $(this).data("nomor");
                 var nama = $(this).data("nama");
                 var bobot = $(this).data("bobot");
                 var note  = $(this).data("note");
//                var msg_obj = $("#msg");
                $("#idindk").val(id);
                $("#kriteria").val(kriteria);
                $("#nomor").val(indkno);
                $("#nama_indk").val(nama);
                $("#bobot").val(bobot);
                $("#ctt").val(note);
                $('#modal_indikator').modal('show');

            });
            
           
            
//            $(".btnSaveInd").click(function(e){
//                e.preventDefault();
//                var msg  =   $("#msg");
//                var krit = $('form#form_indikator_e input[name="kriteria"]').val();
//                var indi = $('form#form_indikator_e input[name="idindk"]').val();
//                var nomo = $('form#form_indikator_e input[name="nomor"]').val();
//                var nmin = $('form#form_indikator_e textarea[name="nama_indk"]').val();
//                var bobo = $('form#form_indikator_e input[name="bobot"]').val();
//                var cata = $('form#form_indikator_e textarea[name="ctt"]').val();
//                if($('form#form_indikator_e input[name="nomor"]').val() === ''){show_alert_ms(msg,1,"<i>Catatan </i>Harus diisi");return false; }
//                if($('form#form_indikator_e input[name="nama_indk"]').val() === '' === ''){show_alert_ms(msg,1,"<i>Nama Indikator </i>Harus diisi");return false; }
//                $("#msg").hide();
//                ajax_url = controller+"/edit_indikator";
//                ajax_data = "kriteria="+krit;
//                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&idindk="+indi+"&nomor="+nomo+"&nama_indk="+nmin+"&bobot="+bobo+"&catatan="+cata;                
//                loading.show();
//                jQuery.ajax({
//                    type: "POST", // HTTP method POST or GET
//                    url: base_url+ajax_url, //Where to make Ajax calls
//                    dataType:"text", // Data type, HTML, json etc.
//                    data:ajax_data, //Form variables
//                    success:function(response){
//                        var obj = null;
//                        try
//                        {
//                            obj = $.parseJSON(response);  
//                        }catch(e)
//                        {}
//                        //var obj = jQuery.parseJSON(response);
//
//                        if(obj)//if json data
//                        {
//                            
//                            loading.hide();$("#csrf").val(obj.csrf_hash);
//                            //success msg
//                            if(obj.status === 1){
//                                loading.hide();
//                                sweetAlert("Success", obj.msg, "success");
//                                $('.table_indikator').html(obj.table_kat);
//                                $('#modal_indikator').modal('toggle');
//                            }
//
//                            //error msg
//                            else if(obj.status === 0){
//                                sweetAlert("Error", obj.msg, "error");
//                            }
//                        }
//                        else
//                        {
//                            sweetAlert("Error", obj.msg, "error");loading.hide();
//                            return false;
//                        }
//                    },
//                    error:function (xhr, ajaxOptions, thrownError){
//                        loading.hide(); 
//                        alert(thrownError);
//                        return false;
//                    }
//                });
//                
//            });
            var formIE = $("#form_indikator_e");
            formIE.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                kriteria:{required:true},
                idindk:{required:true},
                nomor:{required:true},
                nama_indk:{required:true},
                bobot:{required:true},
                ctt:{required:false}
            },
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
                var url = controller+"/edit_indikator";
                var data = formIE.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val();
                
                loading.show();
               // msg_obj.hide();
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
                                $('.table_indikator').html(obj.table_item);
                                $('#modal_indikator').modal('toggle');
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
            
            
            
            //edit kategori skor per item
            var tbl_kspi = $("#tblSkor");
            tbl_kspi.on('click', 'a.editks', function(e){
                e.preventDefault();
                var id      = $(this).data("id");
                ajax_url = controller+"/edit_kategori_skor";
                ajax_data = "id="+id;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val();
                loading.show();
                //$("#indk_id").val(id);
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
                                $('form#form_indikator_edit input[name="ip_id"]').val(id);
                                $('form#form_indikator_edit input[name="ind_id"]').val(obj.data[0].indikatorid);
                                $('form#form_indikator_edit input[name="nomorip"]').val(obj.data[0].noskor);
                                $('form#form_indikator_edit textarea[name="nama_ip"]').val(obj.data[0].item_penilaian);
                                $('form#form_indikator_edit textarea[name="ks_nol"]').val(obj.data[0].kspi_nol);
                                $('form#form_indikator_edit textarea[name="ks_satu"]').val(obj.data[0].kspi_satu);
                                $('form#form_indikator_edit select[name="stts"]').html(obj.str_stts);
                               $('#modal_edit_kat_skor_item').modal('show');
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
            
            var formFE = $("#form_indikator_edit");
            formFE.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                ip_id:{required:true},
                ind_id:{required:true},
                nomorip:{required:true},
                nama_ip:{required:true},
                ks_nol:{required:true},
                ks_satu:{required:false},
                stts:{required:false}
            },
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
                var url = controller+"/sv_edit_kategori_skor";
                var data = formFE.serialize();
                data+="&"+csrf_name+"="+$("#csrf").val();
                
                loading.show();
               // msg_obj.hide();
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
                                $('.table_item').html(obj.table_item);
                                $('#modal_edit_kat_skor_item').modal('toggle');
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
            
            $(".btnSaveIndAdd").click(function(e){
                e.preventDefault();
                var msg  =   $("#msg");
                var krit = $('form#form_indikator_add input[name="kriteria_add"]').val();
                var nmin = $('form#form_indikator_add textarea[name="nama_indkadd"]').val();
                var bobo = $('form#form_indikator_add input[name="bobot"]').val();
                var cata = $('form#form_indikator_add textarea[name="ctt"]').val();
                if($('form#form_indikator_e input[name="nomor"]').val() === ''){show_alert_ms(msg,1,"<i>Catatan </i>Harus diisi");return false; }
                if($('form#form_indikator_e input[name="nama_indk"]').val() === '' === ''){show_alert_ms(msg,1,"<i>Nama Indikator </i>Harus diisi");return false; }
                $("#msg").hide();
                ajax_url = controller+"/edit_indikator";
                ajax_data = "kriteria="+krit;
                ajax_data+="&"+csrf_name+"="+$("#csrf").val()+"&idindk="+indi+"&nomor="+nomo+"&nama_indk="+nmin+"&bobot="+bobo+"&catatan="+cata;                
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
                        //var obj = jQuery.parseJSON(response);

                        if(obj)//if json data
                        {
                            //success msg
                            if(obj.status === 1){
                                loading.hide();
                                sweetAlert("Success", obj.msg, "success");
                                $('.table_indikator').html(obj.table_indikator);
                                $('#modal_indikator').modal('toggle');
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
                            show_alert_ms(obj.msg,99,response);loading.hide();
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
            
            
        };
        
        $(".btnBackM").click(function(e){
                e.preventDefault();
                $('.list_kriteria').hide();
                $('.list_modul').show();
            });
        $(".btnKembali2").click(function(e){
                e.preventDefault();
                $('.list_kriteria').show();
                $('.list_modul').hide();
                $('.list_indikator').hide();
            });    
        $(".btnTInd").click(function(e){
            $('#modal_add_indikator').modal('show');
        });
        var edittable = function(){
            alert("");
        };

        $(".btnBack").click(function(e){
            e.preventDefault();
            //form_ch[0].reset();
            $('.list_provinsi').show();
            $('.list_penilai').hide();
            $('.module_1').hide();
        }); 
        

        $(".btnKembali").click(function(e){
            e.preventDefault();
            $('.kp_1').show();
            $('.kp_2').hide();
        });
        var table2 = $("#tbl_skor");
        table2.on('click', 'a.isiskor', function(e){
            
            $('#mdlKri').modal('show');
        });
        
        //kembali kategori skor per item
        $(".btnKSkor").click(function(e){
            e.preventDefault();
            $('.list_penilai').hide();
            $('.list_indikator').show();
        });
        
        $(".btnTKaSkor").click(function(e){
            e.preventDefault();
            
            $('#modal_kat_skor_item').modal('show');
        });
        
    return{
        init:function(){datatable();},
        tble:function(){edittable();},
       // detail:function(){chart();},
    };
    }();