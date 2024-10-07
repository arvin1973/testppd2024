var main = function(){
    controller = "index.php/BT_G1";
    var datatable = function(){
        $('.inp_dp').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });
        $('.inp_dp2').datepicker({
            format: 'dd/mm/yyyy',
            autoclose:true,
        });        
        var table = $("#data");
        var table_d = $("#data_material");
        var tableSo = $("#tblSo");
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
                    d.date2     =$("#bacth_date2").val();
                    d.sono      =$("#inp_sono").val();
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
       
        var dttblSo = tableSo.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :base_url+controller+"/so_datatable", // json datasource
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
                { "width": "8px", "targets": 6}
            ],
            "initComplete": function(settings, json) {
            },
            paging: true,
            "order": [[ 0, "desc" ]]
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
        
        $("#mdlSo").on('click', '#save_popup', function(e){
            var   so_list = "";
            console.log(so_list=$('.checkbox:checked').map(function() {
                return this.value;
            }).get().join('|'));
            $("#inp_sono").val(so_list);
        });
    
        
        $(".btnShwSo").click(function(e){
            var targetFrm = $(this).data("trgt");
            e.preventDefault();
            loading.show();
            dttblSo.ajax.reload(function(){
                loading.hide();
                $('#mdlSo .frmTrgt').val(targetFrm);
                $('#mdlSo').modal('show');
            });
        });
       
        $("#btnFilter").click(function(e){
            e.preventDefault();
            loading.show();
            datatable.ajax.reload(function(){
                loading.hide();
            });
        });
        $("#export").click(function(e){
            e.preventDefault();
            e.machine     = $("#machine").val();
            e.date     =$("#bacth_date").val();
            e.date2     =$("#bacth_date2").val();
            e.noso     =$("#inp_sono").val();
            loading.show();
            window.open(base_url+"BT_G1/report_exp?machine="+e.machine+"&date="+e.date+"&date2="+e.date2+"&noso="+e.noso);
            loading.hide();
        });        
    };
   
    return{
        init:function(){datatable();},
    };
}();