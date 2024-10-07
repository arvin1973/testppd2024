//var main = function(){
    controller = "index.php/Chart";
     var revenueChart = new FusionCharts({
         "type": "column3d",
         "renderAt": "chartContainer",
         "width": "1000",
         "height": "500",
         "chart": {
                 "caption": "Today Batch Report",
                 "subCaption": "",
                 "xAxisName": "Plant",
                 "yAxisName": "M3",
                 "captionFontSize": "12",
                 "paletteColors": "#0075c2",
                 "baseFont": "Helvetica Neue,Arial",
                 "showShadow": "0",
                 "divlineColor": "#999999",               
                 "divLineIsDashed": "1",
                 "divlineThickness": "1",
                 "divLineDashLen": "1",
                 "divLineGapLen": "1",
                 "canvasBgColor": "#ffffff"
             },         
    });
    revenueChart.render();
    
    FusionCharts.ready(function(){
     setInterval(function(){
         ajax_url = "Chart/auto_chart";
         jQuery.ajax({
           type: "POST", // HTTP method POST or GET
           url: base_url+ajax_url, //Where to make Ajax calls
           dataType:"text", // Data type, HTML, json etc.
           data:ajax_data, //Form variables
           success:function(response){
               var obj = jQuery.parseJSON(response);
                FusionCharts.ready(function(){
                    var revenueChart = new FusionCharts({
                        "type": "column3d",
                        "renderAt": "chartContainer",
                        "width": "900",
                        "height": "500",
                        "dataFormat": "json",
                        "dataSource":  {
                            "chart": {
                                "caption": "Today Batch Report",
                                "subCaption": "",
                                     "xAxisName":       "Plant",
                                     "yAxisName":       "M3",
                                     "captionFontSize": "34",
                                     "paletteColors":   "#0075c2",
                                     "baseFont":        "Helvetica Neue,Arial",
                                     "showShadow":      "0",
                                     "divlineColor":    "#999999",               
                                     "divLineIsDashed": "1",
                                     "divlineThickness": "1",
                                     "divLineDashLen":   "1",
                                     "divLineGapLen":    "1",
                                     "canvasBgColor":    "#ffffff"
                            },
                            "data": [
//                                     {
//                                         "label": "BANDARA AHMAD YANI",
//                                         "labelFontSize": "12",
//                                         "value": obj.BAY
//                                     },
//                                     {
//                                         "label": "GRAND SUNGKONO LAGOON 1",
//                                         "labelFontSize": "12",
//                                         "value": obj.GSL
//                                     },
//                                     {
//                                         "label": "TOWER CASPIAN",
//                                         "labelFontSize": "12",
//                                         "value": obj.CAS
//                                     },
                                     {
                                         "label": "SOETTA A",
                                         "labelFontSize": "12",
                                         "value": obj.soetaa
                                     },
                                        {
                                         "label": "SOETTA B",
                                         "labelFontSize": "12",
                                         "value": obj.soetab
                                     },
                                     {
                                         "label": "KULON PROGO A",
                                         "labelFontSize": "12",
                                         "value": obj.kulon_progo_a
                                     },
                                     {
                                         "label": "KULON PROGO B",
                                         "labelFontSize": "12",
                                         "value": obj.kulon_progo_b
                                     },
                                     {
                                         "label": "KULON PROGO C",
                                         "labelFontSize": "12",
                                         "value": obj.kulon_progo_c
                                     }
                                     ,
                                     {
                                         "label": "NIPA STORAGE TANK TERMINAL",
                                         "labelFontSize": "12",
                                         "value": obj.nipa
                                     },
                                     {
                                         "label": "PLTA TAKENGON",
                                         "labelFontSize": "12",
                                         "value": obj.takengon
                                     }
                                 ]
                             }
                         });
                         revenueChart.render();
                     })
            },
            error:function (xhr, ajaxOptions, thrownError){
                loading.hide(); 
                alert(thrownError);
            }
        });
     },99000);
    }); 
   