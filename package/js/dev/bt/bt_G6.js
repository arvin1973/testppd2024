var main = function(){
    controller = "index.php/BT_G6";
    var datatable = function(){
        $('.inp_dp').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });
        var table = $("#data");
        var table_d = $("#data_material");
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
                    d.machine  =$("#machine").val();
                    d.date     =$("#bacth_date").val();
                },
                "dataSrc": function ( json ) {
                    $("#ttl_qty").val(json.ttl_qty);
                    return json.data;
                }
                
            },
            "columnDefs": [ 
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
            
       });
        
        var datatable_detail = table_d.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/material_datatable", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                        $(".employee-grid-error").html("");
                        $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#employee-grid_processing").css("display","none");

                },
                data: function(d){
                    d.id  =$("#idmodal").val();
                },
                "dataSrc": function ( json ) {
                    //Make your callback here.
//                    $("#csrf").val(json.csrf_hash);
                    return json.data;
                }
                
            },
            "columnDefs": [ 
            ],
            "initComplete": function(settings, json) {
//                console.log(settings);
            },
            paging: true,
            
       });
        
        table.on('click', 'a.edit', function(e){
            e.preventDefault();
            var id      = $(this).data("id");
            $("#idmodal").val(id);
            loading.show();
            datatable_detail.ajax.reload(function(){
                loading.hide();
                $('#modal_edit').modal('show');
            });
        });
       
        $("#btnFilter").click(function(e){
            e.preventDefault();
            loading.show();
            datatable.ajax.reload(function(){
                loading.hide();
            });
        });
    };
   
    return{
        init:function(){datatable();},
    };
}();