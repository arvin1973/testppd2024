    var main = function(){
        controller = "index.php/PPD2_unduh_nilai";
        var datatable = function(){
             $(".btnUnduh").click(function(e){
                 e.preventDefault();
                
                var pilih = $('form#form_unduh select[name="pilih"]').val();
                 window.open(base_url+controller+"/Download_nilai?wl="+pilih); 
             });
            
        };
        
    return{
        init:function(){datatable();},
        tble:function(){edittable();},
       // detail:function(){chart();},
    };
    }();