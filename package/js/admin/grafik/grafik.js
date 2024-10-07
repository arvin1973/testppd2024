var main = function(){
    controller = "index.php/Grafik";
    var datatable = function(){
        var table     = $("#data");
        var table_dt  = $("#data_dt");
        var data = [
    ['id-3700', 0],
    ['id-ac', 1],
    ['id-jt', 2],
    ['id-be', 3],
    ['id-bt', 4],
    ['id-kb', 5],
    ['id-bb', 6],
    ['id-ba', 7],
    ['id-ji', 8],
    ['id-ks', 9],
    ['id-nt', 10],
    ['id-se', 11],
    ['id-kr', 12],
    ['id-ib', 13],
    ['id-su', 14],
    ['id-ri', 15],
    ['id-sw', 16],
    ['id-ku', 17],
    ['id-la', 18],
    ['id-sb', 19],
    ['id-ma', 20],
    ['id-nb', 21],
    ['id-sg', 22],
    ['id-st', 23],
    ['id-pa', 24],
    ['id-jr', 25],
    ['id-ki', 26],
    ['id-1024', 27],
    ['id-jk', 28],
    ['id-go', 29],
    ['id-yo', 30],
    ['id-sl', 31],
    ['id-sr', 32],
    ['id-ja', 33],
    ['id-kt', 34]
];
        
    function peta(){
            url = controller+"/manajemen_kasus";
            var provinsi = $("#inp_pro");
            var kabupaten = $("#inp_kab");
            data = "provinsi="+$("#inp_pro").val()+"&kabupaten="+$("#inp_kab").val();
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:data, //Form variables
                success:function(response){
                    var obj = jQuery.parseJSON(response);
                    var mm = Highcharts.mapChart('gmaps-polygons', {
                            chart: {
                                map: 'countries/id/id-all'
                            },

                            title: {
                                text: ''
                            },

                            subtitle: {
                                text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
                            },
                            legend: {
            enabled: false
        },    
                            mapNavigation: {
                                enabled: true,
                                buttonOptions: {
                                    verticalAlign: 'bottom'
                                }
                            },

                            colorAxis: {
                                min: 0
                            },
series: [{
            name: 'Countries',
            color: '#E0E0E0',
            enableMouseTracking: false
        }, {
            allowPointSelect: true,
            cursor: 'pointer',
            type: 'mapbubble',
            name: 'Population 2010',
            joinBy: ['iso-a2', 'code'],
            data: [{
                    z: 9,
                    name: "id-jr",
                    color: "#00FF00"
                }, {
                    z: 10,
                    name: "Point1",
                    color: "#FF00FF"
                }],
            minSize: 4,
            maxSize: '12%',
            tooltip: {
                pointFormat: '{point.code}: {point.z} thousands'
            }
        }]
//                            series: [{
//                                    ype: 'mappoint',
//        name: 'Cities',
//                                data: [
//   // ['id-3700', 0],
////    ['id-ac', 1],
////    ['id-jt', 2],
////    ['id-be', 3],
////    ['id-bt', 4],
////    ['id-kb', 5],
////    ['id-bb', 6],
////    ['id-ba', 7],
////    ['id-ji', 8],
////    ['id-ks', 9],
////    ['id-nt', 10],
////    ['id-se', 11],
////    ['id-kr', 12],
////    ['id-ib', 13],
////    ['id-su', 14],
////    ['id-ri', 15],
////    ['id-sw', 16],
////    ['id-ku', 17],
////    ['id-la', 18],
////    ['id-sb', 19],
////    ['id-ma', 20],
////    ['id-nb', 21],
////    ['id-sg', 22],
////    ['id-st', 23],
////    ['id-pa', 24],
////    ['id-jr',25],
////   [{
////            name: 'Depok',
////            lat: -6.400462,
////            lon: 106.799599
////        }]
////    ['id-ki', 26],
//  //  ['id-1024', 27],
////    ['id-jk', 28],
////    ['id-go', 29],
////    ['id-yo', 30],
////    ['id-sl', 31],
////    ['id-sr', 32],
////    ['id-ja', 33],
//    //['id-kt', 34]
//],
//                                name: 'Daya Tangkal',
//                                states: {
//                                    hover: {
//                                        color: '#BADA55'
//                                    }
//                                },
////                                dataLabels: {
////                                    enabled: true,
////                                    format: '{point.name}'
////                                }
//                                dataLabels: {
//                align: 'left',
//                x: 5,
//                verticalAlign: 'middle'
//            }
//                            }]
                        });
                },
                error:function (xhr, ajaxOptions, thrownError){
                     loading.hide(); 
                     alert(thrownError);
                 }
            });
        }peta();
        
        function dua(){
            url = controller+"/manajemen_kasus";
            var provinsi = $("#inp_pro");
            var kabupaten = $("#inp_kab");
            data = "provinsi="+$("#inp_pro").val()+"&kabupaten="+$("#inp_kab").val();
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:data, //Form variables
                success:function(response){
                    var obj = jQuery.parseJSON(response);
                    var mm = Highcharts.chart('chart-container-1', {
                        chart: { type: 'column' },
                        title: { "text":obj.text, },
                        subtitle: { "text":obj.sumber, },
                        xAxis: { "categories":obj.categories,
                            crosshair: true
//                            ,
//                            labels: {
//                                format: '{value} km'
//                            }
                           },
                        yAxis: {
                            min: 0,
                            title: {
                                "text":obj.text1,
                            }
                        },
                        tooltip: {
                            headerFormat:'<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                         '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series:  obj.series
                    });
                },
                error:function (xhr, ajaxOptions, thrownError){
                     loading.hide(); 
                     alert(thrownError);
                 }
            });
        }dua();
        
        function pembahasan_kasus(){
            url = controller+"/pembahasan_kasus";
            var provinsi = $("#inp_pro");
            var kabupaten = $("#inp_kab");
            data = "provinsi="+$("#inp_pro").val()+"&kabupaten="+$("#inp_kab").val();
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:data, //Form variables
                success:function(response){
                    var obj = jQuery.parseJSON(response);
                    var mm = Highcharts.chart('chart-container-2', {
                        chart: { type: 'column' },
                        title: { "text":obj.text, },
                        subtitle: { "text":obj.sumber, },
                        xAxis: { "categories":obj.categories,
                            crosshair: true
//                            ,
//                            labels: {
//                                format: '{value} km'
//                            }
                           },
                        yAxis: {
                            min: 0,
                            title: {
                                "text":obj.text1,
                            }
                        },
                        tooltip: {
                            headerFormat:'<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                         '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series:  obj.series
                    });
                },
                error:function (xhr, ajaxOptions, thrownError){
                     loading.hide(); 
                     alert(thrownError);
                 }
            });
        }pembahasan_kasus();
        
        function pembahasan_kasus_ideologi(){
            url = controller+"/pembahasan_kasus_ideologi";
            var provinsi = $("#inp_pro");
            var kabupaten = $("#inp_kab");
            data = "provinsi="+$("#inp_pro").val()+"&kabupaten="+$("#inp_kab").val();
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:data, //Form variables
                success:function(response){
                    var obj = jQuery.parseJSON(response);
                    var mm = Highcharts.chart('chart-container-3', {
                        chart: { type: 'column' },
                        title: { "text":obj.text, },
                        subtitle: { "text":obj.sumber, },
                        xAxis: { "categories":obj.categories,
                            crosshair: true
//                            ,
//                            labels: {
//                                format: '{value} km'
//                            }
                           },
                        yAxis: {
                            min: 0,
                            title: {
                                "text":obj.text1,
                            }
                        },
                        tooltip: {
                            headerFormat:'<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                         '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series:  obj.series
                    });
                },
                error:function (xhr, ajaxOptions, thrownError){
                     loading.hide(); 
                     alert(thrownError);
                 }
            });
        }pembahasan_kasus_ideologi();
        
        function pembahasan_kasus_kriminal(){
            url = controller+"/pembahasan_kasus_kriminal";
            var provinsi = $("#inp_pro");
            var kabupaten = $("#inp_kab");
            data = "provinsi="+$("#inp_pro").val()+"&kabupaten="+$("#inp_kab").val();
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: base_url+url, //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:data, //Form variables
                success:function(response){
                    var obj = jQuery.parseJSON(response);
                    var mm = Highcharts.chart('chart-container-4', {
                        chart: { type: 'column' },
                        title: { "text":obj.text, },
                        subtitle: { "text":obj.sumber, },
                        xAxis: { "categories":obj.categories,
                            crosshair: true
//                            ,
//                            labels: {
//                                format: '{value} km'
//                            }
                           },
                        yAxis: {
                            min: 0,
                            title: {
                                "text":obj.text1,
                            }
                        },
                        tooltip: {
                            headerFormat:'<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                         '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series:  obj.series
                    });
                },
                error:function (xhr, ajaxOptions, thrownError){
                     loading.hide(); 
                     alert(thrownError);
                 }
            });
        }pembahasan_kasus_kriminal();

        
        
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
    };
}();