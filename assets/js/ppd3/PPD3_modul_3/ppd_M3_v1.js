var main = function(){
    controller = "PPD3_modul3";
    var datatable = function(){
        var twlyh = $("#t_wlyh");
        var tindi = $("#t_indi");
        var titem = $("#t_item");
        
        function g_progres(){
            //var kate = $("#inp_kate_wlyh").val();
            loading.show();
            ajax_url = controller+"/g_progres";
            ajax_data="csrf_name="+$("#csrf").val();
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
                            $("#p_prov").html(obj.strPro);
                            $("#p_kab").html(obj.strKab);
                            $("#p_kot").html(obj.strKot);
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
        //g_progres();

        function g_wilayah(){
            var kate = $("#inp_kate_wlyh").val();
            loading.show();
            ajax_url = controller+"/g_wilayah";
            ajax_data="kate="+kate;
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
                            //$("#t_wlyh > tbody").html(obj.str);
                            $("#t_wlyh").html(obj.str);
                            if(kate=="PROV")
                                $(".lbl_katewlyh").html("provinsi");
                            
                            else if(kate=="KAB")
                                $(".lbl_katewlyh").html("kabupaten");
                            else if(kate=="KOTA")
                                $(".lbl_katewlyh").html("kota");
                            
                            $("._wrapper").hide();
                            //$("._wrapper_wlyh").fadeIn();
                            $("._wrapper_wlyh").css("display", "block");
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

        $(".btnProv").click(function(){
            $("#inp_kate_wlyh").val("PROV");
            g_wilayah();
            g_item_persandingan_per_daerah();
            g_persandingan_aspek_kualitatif();
            g_grafik_aspek();
        });
        $(".btnKab").click(function(){
            $("#inp_kate_wlyh").val("KAB");
            g_wilayah();
            g_item_persandingan_per_daerah();
            g_persandingan_aspek_kualitatif();
            g_grafik_aspek();
        });
        $(".btnKota").click(function(){
            $("#inp_kate_wlyh").val("KOTA");
            g_wilayah();
            g_item_persandingan_per_daerah();
            g_persandingan_aspek_kualitatif();
            g_grafik_aspek();
        });
        twlyh.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblwlyh     = _self.data("nmwlyh");
            $("#inp_wlyh").val(id);
            $(".lbl_hdr_nmwlyh").html(lblwlyh).parent("tr").show();
            g_indi();
        });
        twlyh.on("click","a.getDoc",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblwlyh     = _self.data("nmwlyh");
            loading.show();
            ajax_url = controller+"/g_doc";
            ajax_data="id="+id;
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
                            $("#t_doc > tbody").html(obj.str);
                            $("#mdl_doc").modal("show");
                            $("#mdl_doc .lbl_jdl_wlyh").html(lblwlyh);
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
        });

        function g_indi(){
            loading.show();
            ajax_url = controller+"/g_indi";
            ajax_data="id="+$("#inp_wlyh").val();
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
                            $("#t_indi > tbody").html(obj.str);
                            $("._wrapper").hide();
                            $("._wrapper_info").show();
                            // $("._wrapper_indi").fadeIn();
                            $("._wrapper_indi").css("display", "block");
                            $("._wrapper_statement").hide();
                            if(obj.sttsDispSttment=='Y')
                                $("._wrapper_statement").fadeIn();
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

        function g_item_persandingan_per_daerah(){
            var kate = $("#inp_kate_wlyh").val();
            loading.show();
            ajax_url = controller+"/g_item_persandingan_per_daerah";
            ajax_data="kate="+kate;
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
                            // console.log(obj);
                            $(".tabs-persandingan-penilaian").html(obj.str_aspek);
                            $("#t_persandingan_aspek_kualitatif > tbody").html(obj.str);
                            $("._wrapper").hide();
                            // $("._wrapper_wlyh").fadeIn();
                            $("._wrapper_wlyh").css("display", "block");
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

        function g_grafik_aspek(){
            var kate = $("#inp_kate_wlyh").val();
            loading.show();
            ajax_url = controller+"/g_grafik_aspek";
            ajax_data="kate="+kate;
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
                            console.log(obj.array_data_indikator_by_aspek);
                            $(".tab-list-aspek").html(obj.str);
                            $("._wrapper").hide();
                            // $("._wrapper_wlyh").fadeIn();
                            $("._wrapper_wlyh").css("display", "block");
                            loading.hide();

                            var no_aspek = 1;
                            var noIndikator = 1;
                            $.each( obj.list_data_aspek, function( key, value ) {

                                var nmindikator = [];
                                $.each( obj.list_data_indi_by_aspek, function( key, valueIndi ) {
                                    if (value.nmaspek == valueIndi.ASPEK) {
                                        var aliasindikator = "Indikator "+noIndikator;
                                        nmindikator.push(aliasindikator);
                                        noIndikator += 1;
                                    }
                                })

                                if (nmindikator.length == 2) {
                                    var typeChart = {polar:false, type:'column'};
                                } else {
                                    var typeChart = {polar:true, type:'line'};
                                }

                                var valueindikator = [];
                                $.each( obj.array_data_indikator_by_aspek, function( key, valueNilaiIndi ) {
                                    if (value.nmaspek == valueNilaiIndi.nama_aspek) {
                                        valueindikator.push(valueNilaiIndi.nilai_per_indikator)
                                    }
                                })

                                console.log(nmindikator.length);

                                var text = value.nmaspek;
                                var result_list_data_aspek = text.replace(/ /g, "-");
                                Highcharts.chart('container-'+result_list_data_aspek, {

                                    chart: typeChart,
                            
                                    accessibility: {
                                        description: 'A spiderweb chart compares the allocated budget against actual spending within an organization. The spider chart has six spokes. Each spoke represents one of the 6 departments within the organization: sales, marketing, development, customer support, information technology and administration. The chart is interactive, and each data point is displayed upon hovering. The chart clearly shows that 4 of the 6 departments have overspent their budget with Marketing responsible for the greatest overspend of $20,000. The allocated budget and actual spending data points for each department are as follows: Sales. Budget equals $43,000; spending equals $50,000. Marketing. Budget equals $19,000; spending equals $39,000. Development. Budget equals $60,000; spending equals $42,000. Customer support. Budget equals $35,000; spending equals $31,000. Information technology. Budget equals $17,000; spending equals $26,000. Administration. Budget equals $10,000; spending equals $14,000.'
                                    },
                            
                                    title: {
                                        text: 'Perbandingan '+value.nmaspek,
                                        x: -80
                                    },
                            
                                    pane: {
                                        size: '80%'
                                    },
                            
                                    xAxis: {
                                        categories: nmindikator,
                                        tickmarkPlacement: 'on',
                                        lineWidth: 0
                                    },
                            
                                    yAxis: {
                                        gridLineInterpolation: 'polygon',
                                        lineWidth: 0,
                                        min: 0,
                                        tickInterval: 1
                                    },
                            
                                    tooltip: {
                                        shared: true,
                                        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.1f}</b><br/>'
                                    },
                            
                                    legend: {
                                        title: {
                                            text: 'Legenda<br/><hr/><span style="font-size: 9px; color: #666; font-weight: normal;">(Klik pada nama daerah untuk menampilkan/<br/>menyembunyikan grafik)</span>',
                                        },
                                        backgroundColor: '#FCFFC5',
                                        borderColor: '#C98657',
                                        borderWidth: 1,
                                        align: 'right',
                                        verticalAlign: 'middle',
                                        layout: 'vertical'
                                    },
                            
                                    series: valueindikator[0],
                            
                                    responsive: {
                                        rules: [{
                                            condition: {
                                                maxWidth: 500
                                            },
                                            chartOptions: {
                                                legend: {
                                                    align: 'center',
                                                    verticalAlign: 'bottom',
                                                    layout: 'horizontal'
                                                },
                                                pane: {
                                                    size: '70%'
                                                }
                                            }
                                        }]
                                    }
                            
                                });
                                no_aspek += 1;
                              });
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

        function g_persandingan_aspek_kualitatif(){
            var kate = $("#inp_kate_wlyh").val();
            loading.show();
            ajax_url = controller+"/g_persandingan_aspek_kualitatif";
            ajax_data="kate="+kate;
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
                            console.log(obj);
                            $("#t_persandingan_aspek_kualitatif > thead").html(obj.str_nama_daerah);
                            $("#t_persandingan_aspek_kualitatif > tbody").html(obj.str);
                            $("._wrapper").hide();
                            // $("._wrapper_wlyh").fadeIn();
                            $("._wrapper_wlyh").css("display", "block");
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
        
        tindi.on("click","a._mdlRsm",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblkriter   = _self.data("nmkriteria");
            clickable=false;
                loading.show();
                ajax_url = controller+"/g_det_resume";
                ajax_data="id="+id;
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
                                $('form#frm_simpul input[name="id"]').val(id);
                                $('form#frm_simpul textarea[name="simpul"]').val(obj.simpul);
                                $('form#frm_simpul textarea[name="saran"]').val(obj.saran);
                                $('form#frm_simpul #lbl_jdl_aspek').html(obj.nmaspek);

                                $("#mdl_simpul").modal("show");
                                loading.hide();
                                clickable=true;
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
        });
        
        tindi.on("click","a.getDetail",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblindi     = _self.data("nmindi");
            var lblaspk     = _self.data("nmaspek");
            var lblkriter   = _self.data("nmkriteria");
            $("#inp_indi").val(id);
            $(".lbl_hdr_indi").html(lblindi).parent("tr").show();
            $(".lbl_hdr_aspk").html(lblaspk).parent("tr").show();
            $(".lbl_hdr_krit").html(lblkriter).parent("tr").show();
            g_item();
            g_item_persandingan();
        });
        
        function g_item(){
            loading.show();
            ajax_url = controller+"/g_item";
            ajax_data="id="+$("#inp_indi").val();
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
                            $("#t_item > tbody").html(obj.str);
                            $("#t_item > tfoot").html(obj.str_foot);
                            $(".lbl_nilai").html(obj.nilai);
                            $(".t_ctt").hide();
                            if(obj.ctt_indi!==''){
                                $(".t_ctt .ctt_indi").html(obj.ctt_indi);
                                $(".t_ctt").show();
                            }
                            $("._wrapper").hide();
                            $("._wrapper_info").show();
                            // $("._wrapper_item").fadeIn();
                            $("._wrapper_item").css("display", "block");
                            $("._wrapper_judul").hide();
                            if(obj.datajudul!==''){
                                $(".t_judul").html(obj.datajudul);
                                $("#yangdi").val(obj.judulitem);
                                $("._wrapper_judul").show();
                            }
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

        function g_item_persandingan(){
            loading.show();
            ajax_url = controller+"/g_item_persandingan";
            ajax_data="id="+$("#inp_indi").val();
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
                            console.log(obj);
                            $("#t_nama_item_persandingan").html(obj.str_nama_daerah);
                            $("#t_item_persandingan > tbody").html(obj.str);
                            if(obj.kate_wlyh == 'PROV') {
                                var text = obj.kate_wlyh;
                                var wilayah = text.replace("PROV", "Provinsi");
                            }else if (obj.kate_wlyh == 'KAB') {
                                var text = obj.kate_wlyh;
                                var wilayah = text.replace("KAB", "Kabupaten");
                            }else if (obj.kate_wlyh == 'KOTA') {
                                var text = obj.kate_wlyh;
                                var wilayah = text.replace("KOTA", "Kota");
                            }
                            $(".span-persandingan-penilaian").html("Persandingan Penilaian "+wilayah+" <span class='badge badge-secondary'>New Feature</span>");
                            $(".t_ctt").hide();
                            // if(obj.ctt_indi!==''){
                            //     $(".t_ctt .ctt_indi").html(obj.ctt_indi);
                            //     $(".t_ctt").show();
                            // }
                            // $("._wrapper").hide();
                            // $("._wrapper_info").show();
                            // // $("._wrapper_item").fadeIn();
                            // $("._wrapper_item").css("display", "block");
                            // $("._wrapper_judul").hide();
                            // if(obj.datajudul!==''){
                            //     $(".t_judul").html(obj.datajudul);
                            //     $("#yangdi").val(obj.judulitem);
                            //     $("._wrapper_judul").show();
                            // }
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
        
        $("._btnIsiJudulItem").change(function(){
            var id = $("#inp_indi").val()
            var judul = $("#yangdi").val()
            var wlyh =$("#inp_wlyh").val();
            
            loading.show();
            ajax_url = controller+"/save_jdlnilai";
            ajax_data="id="+id+"&judul="+judul+"&wlyh="+wlyh;
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
                                
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-left",
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
                                toastr["success"](obj.msg);
                                
                                loading.hide();
                                clickable=true;
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
        });
                
        titem.on('change','._btnIsiIndiItem',function(){
            //if(clickable==true){
            var _self   = $(this);
            var id      = _self.data('id');
            var nomor   = _self.data('nomor');
            var nmitem   = _self.data('nmitem');
            var sumber   = _self.data('info');
            var nilai = $(this).find("input").val();    
            
            if(nilai < 5 || nilai > 10  ){
                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-left",
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
                toastr["error"]("Skor harus lebih besar dari 5 kecil dari 10");
                $(this).find("input").val("");
             return false;   
            }
            loading.show();            
            ajax_url = controller+"/save_score";
            ajax_data="id="+id+"&nilai="+nilai+"&nomor="+nomor+"&nmitem="+nmitem+"&sumber="+sumber;
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
//                                _parent.children("td").removeClass("table-warning");_self.addClass("table-warning");
//                                _parent.children().children("._colSkor").html(_nilai);
                                $(".ttl_skor").html(obj.ttl_skor);
                                $(".lbl_nilai").html(obj.nilai);
                                
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-left",
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
                                toastr["success"](obj.msg);
                                
                                if(obj.is_display_simpul=='Y'){
                                    $('form#frm_simpul input[name="id"]').val(obj.idrsme);
                                    $('form#frm_simpul textarea[name="simpul"]').val(obj.val_ksmpln);
                                    $('form#frm_simpul textarea[name="saran"]').val(obj.val_saran);
                                    $('form#frm_simpul #lbl_jdl_aspek').html(obj.nmaspek);
                                    
                                    $("#mdl_simpul").modal("show");
                                }
                                loading.hide();
                                clickable=true;

                                g_item_persandingan();
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
            
        });
        
        titem.on('change','._btnIsiIndiInfo',function(){
           var _self   = $(this);
            var id      = _self.data('id');
            var nomor   = _self.data('nomor');
            var nmitem   = _self.data('nmitem');
            var nilai   = _self.data('nilai');
            var sumber = $(this).find("input").val();
//            if(nilai < 5 || nilai > 10  ){
//                toastr.options = {
//                                  "closeButton": true,
//                                  "debug": false,
//                                  "newestOnTop": false,
//                                  "progressBar": true,
//                                  "positionClass": "toast-bottom-right",
//                                  "preventDuplicates": false,
//                                  "onclick": null,
//                                  "showDuration": "300",
//                                  "hideDuration": "1000",
//                                  "timeOut": "5000",
//                                  "extendedTimeOut": "1000",
//                                  "showEasing": "swing",
//                                  "hideEasing": "linear",
//                                  "showMethod": "fadeIn",
//                                  "hideMethod": "fadeOut"
//                                };
//                toastr["error"]("Skor harus lebih besar dari 5 kecil dari 10");
//                $(this).find("input").val("");
//             return false;   
//            }
            loading.show();            
            ajax_url = controller+"/save_score";
            ajax_data="id="+id+"&nilai="+nilai+"&nomor="+nomor+"&nmitem="+nmitem+"&sumber="+sumber;
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
//                                _parent.children("td").removeClass("table-warning");_self.addClass("table-warning");
//                                _parent.children().children("._colSkor").html(_nilai);
                                $(".ttl_skor").html(obj.ttl_skor);
                                $(".lbl_nilai").html(obj.nilai);
                                
//                                toastr.options = {
//                                  "closeButton": true,
//                                  "debug": false,
//                                  "newestOnTop": false,
//                                  "progressBar": true,
//                                  "positionClass": "toast-bottom-right",
//                                  "preventDuplicates": false,
//                                  "onclick": null,
//                                  "showDuration": "300",
//                                  "hideDuration": "1000",
//                                  "timeOut": "5000",
//                                  "extendedTimeOut": "1000",
//                                  "showEasing": "swing",
//                                  "hideEasing": "linear",
//                                  "showMethod": "fadeIn",
//                                  "hideMethod": "fadeOut"
//                                };
//                                toastr["success"](obj.msg);
                                

                                loading.hide();
                                clickable=true;
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
            
        });
        
        
        
        
        
        
        
        
        titem.on('click','._btnEdit',function(){
            var id          =$("#inp_indi").val();
            $("#idtambah").val(id);
            $("#mdl_tambah").modal("show");
        });
        
        var frm_tambah = $("#frm_tambah"); 
        frm_tambah.validate({
            errorElement: 'label', 
            errorClass: 'error', 
            rules:{
                idtambah:{required:true},
                skor:{number:true,required:true},
                //alo:{number:true,required:true},
                //giat:{required:true},
            },
//            errorPlacement: function(error, element) {
//                if (
//                        element.attr("name") === "lat" ||element.attr("name") === "long" 
//                        || element.attr("name") === "lat_end" ||element.attr("name") === "long_end" 
//                        ) {
//                    error.insertAfter(element.parent());
//                } else {
//                    error.insertAfter(element);
//                }
//            },
//            highlight: function (element) {
//                var name = $(element).attr("name");
//                if(name==="lat"
//                        ){
//                    $(element).parent().parent().addClass('has-error');
//                }
//                else if(
//                        name==="bbn_bansos"
//                        ){
//                    $(element).parent().addClass('has-error');
//                }
//                else
//                    $(element).closest('.form-group').addClass('has-error');
//            },
            unhighlight: function (element) {
                $(element)
                .closest('.has-error').removeClass('has-error');
            },
            submitHandler: function(form) {
                var data1 = new FormData(frm_tambah[0]);
                var url = controller+"/tambah_skore";
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
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                loading.hide();
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-left",
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
                                toastr["success"](obj.msg);
                                $("#mdl_tambah").modal("hide");
                                g_item();
                            }
                            else if(obj.status === 0){loading.hide();
                                
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                            }
                            else if(obj.status === 2){loading.hide();
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                                window.location.href = base_url+default_controller;
                            }
                        }
                        else
                        {
                            Swal.fire({
                                    title: "Error!",
                                    text: "An Error occured",
                                    icon: "warning",
                                    
                                });
                            loading.hide();
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
        
        
        titem.on('click','._btnPilihIndiItem',function(){
            if(clickable==true){
                var _self   = $(this);
                var id      = _self.data('id');
                var _nilai  = _self.data('nilai');
                var _parent = _self.parent();
                clickable=false;
                loading.show();
                ajax_url = controller+"/save_score";
                ajax_data="id="+id;
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
                                _parent.children("td").removeClass("table-warning");_self.addClass("table-warning");
                                
                                _parent.children().children("._colSkor").html(_nilai);
                                $(".ttl_skor").html(obj.ttl_skor);
                                $(".lbl_nilai").html(obj.nilai);
                                
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-left",
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
                                toastr["success"](obj.msg);
                                
                                if(obj.is_display_simpul=='Y'){
                                    $('form#frm_simpul input[name="id"]').val(obj.idrsme);
                                    $('form#frm_simpul textarea[name="simpul"]').val(obj.val_ksmpln);
                                    $('form#frm_simpul textarea[name="saran"]').val(obj.val_saran);
                                    $('form#frm_simpul #lbl_jdl_aspek').html(obj.nmaspek);
                                    
                                    $("#mdl_simpul").modal("show");
                                }
                                loading.hide();
                                clickable=true;
                                
                            }
                            else if(obj.status === 0){
                                loading.hide();clickable=true;
                                sweetAlert("Error", obj.msg, "error");
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution", obj.msg, "warning");clickable=true;
                                window.setTimeout(function(){
                                    window.location.href = base_url+"welcome";
                                }, 2000);
                            }

                        }
                        else{
                            sweetAlert("Caution", response, "error");
                            loading.hide();
                            window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
            
        });
        
        titem.on('click','._btnDelIndiItem',function(){
             var _self   = $(this);
            var id      = _self.data('id');
            var nomor   = _self.data('nomor');
            var nmitem   = _self.data('nmitem');
            d_item();
        });
        
        function d_item(){
            loading.show();
        }
        
        $(".btnShwHd").click(function(){
            var _self = $(this);
            var _show = _self.data("show").split(',');
            var _hide = _self.data("hide").split(',');
            var _hdrhide = _self.data("hdrhide").split(',');
            var _reload = _self.data("reload");
            var last_trgt = "";
            $.each(_hide,function(index,value){
                $(value).hide();
            });
            $.each(_hdrhide,function(index,value){
                $(value).parents("tr").hide();
            });
            $.each(_show,function(index,value){
                $(value).show();
                last_trgt=$(value);
            });
            if(_reload=='indi'){
                g_indi();
            }
            else if(_reload=='prov'){
                g_wilayah();
                g_item_persandingan_per_daerah();
                g_persandingan_aspek_kualitatif();
                g_grafik_aspek();
            }
            goToMessage(last_trgt);
        });
        
        
        var frm_simpul = $("#frm_simpul");
        frm_simpul.validate({
            errorElement: 'label', 
            errorClass: 'error', 
            rules:{
                vol:{number:true,required:true},
                alo:{number:true,required:true},
                giat:{required:true},
            },
            errorPlacement: function(error, element) {
                if (
                        element.attr("name") === "lat" ||element.attr("name") === "long" 
                        || element.attr("name") === "lat_end" ||element.attr("name") === "long_end" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                var name = $(element).attr("name");
                if(name==="lat"
                        ){
                    $(element).parent().parent().addClass('has-error');
                }
                else if(
                        name==="bbn_bansos"
                        ){
                    $(element).parent().addClass('has-error');
                }
                else
                    $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element)
                .closest('.has-error').removeClass('has-error');
            },
            submitHandler: function(form) {
                var data1 = new FormData(frm_simpul[0]);
                var url = controller+"/resume_save";
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
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                loading.hide();
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-left",
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
                                toastr["success"](obj.msg);
                                $("#mdl_simpul").modal("hide");
                                g_indi();
                            }
                            else if(obj.status === 0){loading.hide();
                                
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                            }
                            else if(obj.status === 2){loading.hide();
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                                window.location.href = base_url+default_controller;
                            }
                        }
                        else
                        {
                            Swal.fire({
                                    title: "Error!",
                                    text: "An Error occured",
                                    icon: "warning",
                                    
                                });
                            loading.hide();
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
        
        
        function g_sttmnt(){
            var id          =$("#inp_wlyh").val();
            clickable=false;
            loading.show();
            ajax_url = controller+"/g_det_sttmnt";
            ajax_data="id="+id;
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
                            $('form#frm_sttmnt input[name="id"]').val(id);
                            $("#btn_sttmntUnduhLink").hide();
                            if(obj.link != null)
                                $("#btn_sttmntUnduhLink").attr("href",obj.link).show();

                            $("#mdl_sttmnt").modal("show");
                            loading.hide();
                            clickable=true;

                        }
                        else if(obj.status === 0){
                            loading.hide();clickable=true;
                            sweetAlert("Error", obj.msg, "error");
                        }
                        else if(obj.status === 2){
                            sweetAlert("Caution", obj.msg, "warning");clickable=true;
                            window.setTimeout(function(){
                                window.location.href = base_url+"welcome";
                            }, 2000);
                        }

                    }
                    else{
                        sweetAlert("Caution", response, "error");
                        loading.hide();
                        window.setTimeout(function(){
//                                window.location.href = base_url+"welcome";
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
        $("#btnShwMdlSttmnt").click(function(){
            g_sttmnt();
        });
        
        twlyh.on("click","a.getSttmnt",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            $("#inp_wlyh").val(id);
            g_sttmnt();
        });
        var frm_sttmnt = $("#frm_sttmnt");
        frm_sttmnt.validate({
            errorElement: 'label', 
            errorClass: 'error', 
            rules:{
                dokumen:{
                    required:true,
                }
            },
            errorPlacement: function(error, element) {
                if (
                        element.attr("name") === "lat" ||element.attr("name") === "long" 
                        || element.attr("name") === "lat_end" ||element.attr("name") === "long_end" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                var name = $(element).attr("name");
                if(name==="lat"
                        ){
                    $(element).parent().parent().addClass('has-error');
                }
                else if(
                        name==="bbn_bansos"
                        ){
                    $(element).parent().addClass('has-error');
                }
                else
                    $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element)
                .closest('.has-error').removeClass('has-error');
            },
            submitHandler: function(form) {
                var data1 = new FormData(frm_sttmnt[0]);
                var url = controller+"/sttmnt_save";
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
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                loading.hide();
                                toastr.options = {
                                  "closeButton": true,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": true,
                                  "positionClass": "toast-bottom-left",
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
                                toastr["success"](obj.msg);
                                $("#mdl_sttmnt").modal("hide");frm_sttmnt[0].reset();
                                g_wilayah();
                                g_item_persandingan_per_daerah();
                                g_persandingan_aspek_kualitatif();
                                g_grafik_aspek();
                            }
                            else if(obj.status === 0){loading.hide();
                                
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                            }
                            else if(obj.status === 2){loading.hide();
                                swal({
                                    title: "Error!",
                                    text: obj.msg,
                                    type: "error"
                                });
                                window.location.href = base_url+default_controller;
                            }
                        }
                        else
                        {
                            Swal.fire({
                                    title: "Error!",
                                    text: "An Error occured",
                                    icon: "warning",
                                    
                                });
                            loading.hide();
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
        
        twlyh.on("click","a.getNilai",function(e){
            var _self       = $(this);
            var id          = _self.data("id");
            var lblwlyh     = _self.data("nmwlyh");
            loading.show();
            ajax_url = controller+"/g_nilai_upload";
            ajax_data="id="+id;
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
                            if(obj.str_nilai=="Y")
                                $("._wrapper_nilai").show();
                            else
                                $("._wrapper_nilai").hide();
//                            $("#t_doc > tbody").html(obj.str);
//                            $("#mdl_doc").modal("show");
                                $("#mdl_upload_nilai ._btn_unggah").html(obj.str);
                                $('form#frmNilaiAdd input[name="id"]').val(id);
                                $('form#frmNilaiAdd input[name="nama"]').val("Penilaian Tahap 3 "+lblwlyh);
                                $("#mdl_upload_nilai").modal("show");
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
        });
        
        var frmNilaiAdd = $("#frmNilaiAdd");
        frmNilaiAdd.validate({
            errorElement: 'span',
            errorClass: 'error', 
            rules:{
                id:{required:true},
                nama:{required:true},
                attch:{extension: "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|",filesize: 300000000}, //300 mb
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "pagu_bansos" 
                        || element.attr("name") === "pagu_bm" 
                        || element.attr("name") === "pagu_bb" 
                        || element.attr("name") === "pagu_bp" 
                        ) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('error'); 
            },
            unhighlight: function (element) { 
                $(element)
                .closest('.has-error').removeClass('has-error'); 
            },
            submitHandler: function(form) {
                var url = controller+"/save_dok_nilai";
                var data1 = new FormData(frmNilaiAdd[0]);
                
                data1.append(csrf_name, $("#csrf").val());
                //data1.append("id", $("#inp_wlyh").val());
                var data = data1;

                loading.show();
                jQuery.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(percentComplete + '%');
                                $(".progress-bar").html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    type: "POST",
                    url: base_url+url, 
                    data:data, 
                    mimeType: "multipart/form-data",
                    cache: false,
                    contentType: false,
                    processData: false,
                     beforeSend: function(){
                        $(".progress-bar").width('0%');
                      //  $('#uploadStatus').html('<img src="loading.gif"/>');
                    },
                    success:function(response){
                        var obj = null;
                        try{
                            obj = $.parseJSON(response);  
                        }catch(e)
                        {}

                        if(obj)
                        {
                            $("#csrf").val(obj.csrf_hash);
                            if(obj.status === 1){
                                toastr["success"](obj.msg);
                                toastr.options = {
                                  "closeButton": false,
                                  "debug": false,
                                  "newestOnTop": false,
                                  "progressBar": false,
                                  "positionClass": "toast-bottom-left",
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
                                frmNilaiAdd[0].reset();
                                $('#mdl_upload_nilai').modal('toggle');
                                loading.hide();
                            }
                            else if(obj.status === 0){
                                sweetAlert("Perhatian!", obj.msg, "error");
                                loading.hide();
                            }
                            else if(obj.status === 2){
                                sweetAlert("Caution!", obj.msg, "warning");

                                window.setTimeout(function(){
                                    window.location.href = base_url+default_controller; 
                                }, 2000);
                            }
                        }
                        else
                        {
                            sweetAlert("Caution!", "An Error Occured", "warning");
                            loading.hide();
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
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'Ukuran berkas maksimal 300 Mb');
        
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();