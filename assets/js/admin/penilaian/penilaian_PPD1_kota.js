    var main = function(){
        controller = "index.php/Penilaian_PPD1_kota";
        var datatable = function(){
            $("#select_penilai").change(function(e){
                e.preventDefault();
                var _self = $(this);
                var id          = _self.val();
                $("#inp_tim").val(id);
                s_daerah();
            });
            function s_daerah(){
                loading.show();
                ajax_url = controller+"/s_daerah";
                ajax_data="id="+$("#inp_tim").val();
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
                                $('form#commentForm select[name="select_tpt"]').html(obj.str);
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
            }
        
        };
        $(".btnDown").click(function(e){
       e.preventDefault();
                //$("#customborder_collapse5").attr('disabled','disabled');
            var id      = $('form#commentForm select[name="select_penilai"]').val();//$(".inp_tim");
            var prov      = $('form#commentForm select[name="select_tpt"]').val();//$(".inp_tim");
            if(prov == '' || id == ''){
                toastr["warning"]('Silakan di pilih Tim penilai dan Daerah yang di nilai ');
                toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-bottom-right",
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
            }else{
            ajax_url = controller+"/penilaian_excel";
            window.open(base_url+controller+"/Download_nilai?timid="+id+"&provid="+prov);
        }
            
        });
    return{
        init:function(){datatable();},
        tble:function(){edittable();},
       // detail:function(){chart();},
    };
    }();