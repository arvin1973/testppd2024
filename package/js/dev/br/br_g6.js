var main = function(){
    controller = "index.php/Batch_request";
    var datatable = function(){
        
        var table = $("#data");
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
                { "targets": 6, "orderable": false },
                { "width": "50px", "targets":6 }
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
            "order": [[ 1,0, "desc" ]]
            
       });
        
        table.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            var msg_obj = $("#msg");
            ajax_url = controller+"/detail_get";
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
                    //var obj = jQuery.parseJSON(response);

                    if(obj)//if json data
                    {
                        //success msg
                        if(obj.status === 1){
                            loading.hide();
                            $('form#form_edit input[name="id"]').val(id);
                            $('form#form_edit input[name="dsnumber"]').val(obj.data[0].ds_no);
                            $('form#form_edit input[name="dsdate"]').val(obj.data[0].ds_date);
                            $('form#form_edit input[name="sono"]').val(obj.data[0].so_no);
                            $('form#form_edit input[name="sovolume"]').val(obj.data[0].sovol+" "+obj.data[0].sounit);
                            $('form#form_edit input[name="sodate"]').val(obj.data[0].so_date);
                            $('form#form_edit input[name="cust"]').val(obj.data[0].custcode+" - "+obj.data[0].custname);
                            $('form#form_edit input[name="custaddress"]').val(obj.data[0].custaddress);
                            $('form#form_edit input[name="proj"]').val(obj.data[0].projcode+" - "+obj.data[0].projname);
                            $('form#form_edit input[name="projaddress"]').val(obj.data[0].projaddress);
                            $('form#form_edit input[name="sounit"]').val(obj.data[0].sounit);
                            $('form#form_edit input[name="plant"]').val(obj.data[0].plantcode+" - "+obj.data[0].plantname);
                            $('form#form_edit input[name="qty"]').val(obj.data[0].qty);
                            $('form#form_edit input[name="prodcode"]').val(obj.data[0].prodcode);
                            $('form#form_edit input[name="prodspec"]').val(obj.data[0].prodspec);
                            $('form#form_edit select[name="location"]').html(obj.str_loca);

                            $('.formedit_wrapper').show();
                            $('.formadd_wrapper').hide();
                            $('.list_wrapper').hide();
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
        
        var form_e = $("#form_edit");
        form_e.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            rules:{
                id:{required:true},
                machine:{required:true},
                qtybr:{required:true,number:true},
                location:{required:true},
            }
            ,
            highlight: function (element) { // hightlight error inputs
                $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // hightlight error inputs
                $(element)
                .closest('.has-error').removeClass('has-error'); // set error class to the control group
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "grdate" ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var data1 = new FormData(form_e[0]);
                var url = controller+"/detail_act";
                data1.append(csrf_name, $("#csrf").val());
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
                            if(obj.status === 1){
                                datatable.ajax.reload(function(){
                                    loading.hide();
                                    sweetAlert("Success", obj.msg, "success");
                                });
                            }

                            else if(obj.status === 0){loading.hide();
                                sweetAlert("Error", obj.msg, "error");
                                datatable.ajax.reload();
                            }
                            $("#csrf").val(obj.csrf_hash);
                        }
                        else
                        {
                            sweetAlert("Error", response, "error");loading.hide();
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        sweetAlert("Error", thrownError, "error");loading.hide();
                    }
                });
                return false;
            }
        });
        
        $(".btnBack").click(function(e){
            e.preventDefault();
            $('.formedit_wrapper').hide();
            $('.list_wrapper').show();
        });
        $(".btnRefresh").click(function(e){
            e.preventDefault();
            forml[0].reset();loading.show();
            datatable.ajax.reload(function(){
                loading.hide();
            });
        });
    };
    return{
        init:function(){datatable();},
    };
}();