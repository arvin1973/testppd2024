var main = function(){
    controller = "index.php/Product_G6";
    var datatable = function(){
        var table = $("#data");
        var tbl_ing_edit = $("#tbl_detail_edit");
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
                { "width": "10px", "targets": 4 }
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
       });
        
        var datatable_detail = tbl_ing_edit.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/get_datatable_detail", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                },
                data: function(d){
                    d.id     =$("#detailid").val();
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
       });
        
        
        table.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_get";
            ajax_data = "id="+id;
            ajax_data+="&"+csrf_name+"="+$("#csrf").val();
            loading.show();
            $("#detailid").val(id);
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
                    //var obj = jQuery.parseJSON(response);

                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            $('form#form_edit input[name="id"]').val(obj.id);
                            $('form#form_edit input[name="code"]').val(obj.data[0].product_code);
                            $('form#form_edit select[name="strength"]').html(obj.str);
                            $('form#form_edit input[name="slumps"]').val(obj.data[0].slump);
                            $('form#form_edit input[name="spec"]').val(obj.data[0].specification);
                            
                            datatable_detail.ajax.reload(function(){
                                $('.formadd_wrapper').hide();
                                $('.list_datatable').hide();
                                $('.formedit_wrapper').show();
                                $('.detail_wrapper').show();
                                datatable_detail.columns.adjust().draw();
                                loading.hide();
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
        
        tbl_ing_edit.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_material_get";
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
                    //var obj = jQuery.parseJSON(response);

                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            $('form#formEditDetail input[name="id"]').val(obj.id);
                            $('form#formEditDetail input[name="machine"]').val(obj.data[0].machname);
                            $('form#formEditDetail select[name="unit"]').html(obj.str);
                            $('form#formEditDetail input[name="material"]').val(obj.data[0].matname);
                            $('form#formEditDetail input[name="qty"]').val(obj.data[0].qty);
                            
                            datatable_detail.ajax.reload(function(){
                                $('#modalEditDetail').modal("show");
                                loading.hide();
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
        
        
        
        $(".btnBack").click(function(e){
            e.preventDefault();
            datatable.ajax.reload(function(){
                $(".formadd_wrapper").hide();
                $(".formedit_wrapper").hide();
                $(".detail_wrapper").hide();
                $(".list_datatable").show();

                $("#form_add :input").removeAttr("disabled");
            });
            
        });
        $(".btn_reload").click(function(e){
            e.preventDefault();
            datatable.ajax.reload();
        });
        $("#btn_reload_detail").click(function(e){
            e.preventDefault();
            datatable_detail.ajax.reload();
        });
    };
    
    return{
        init:function(){datatable();},
    };
}();