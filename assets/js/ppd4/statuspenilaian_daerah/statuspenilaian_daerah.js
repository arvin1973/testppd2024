var main = function(){
    controller = "PPD4_status_penilaian_daerah";
    var datatable = function(){
        $("#rekapall").click(function(e){
            window.open(base_url+controller+"/allrekap"); 
        });;        
    };
    var general = function(){
        
    }  
    return{
        init:function(){datatable();general();},
    };
}();