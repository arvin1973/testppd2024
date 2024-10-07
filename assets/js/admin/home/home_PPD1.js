var main = function(){
    controller = "Home";
    var init = function(){

        $(document).ready(function(){

            // dashboard sum user
            var sum_of_tpt_user;
            $.ajax({
                type: "GET",
                url: controller+"/all_tpt_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_tpt_user = obj.data;
                    $(".sum_of_tpt_user").html(sum_of_tpt_user);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_of_active_tpt_user;
            $.ajax({
                type: "GET",
                url: controller+"/active_tpt_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_active_tpt_user = obj.data;
                    $(".sum_of_active_tpt_user").html(sum_of_active_tpt_user);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_of_tpitpu_user;
            $.ajax({
                type: "GET",
                url: controller+"/all_tpitpu_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_tpitpu_user = obj.data;
                    $(".sum_of_tpitpu_user").html(sum_of_tpitpu_user);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_of_active_tpitpu_user;
            $.ajax({
                type: "GET",
                url: controller+"/active_tpitpu_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_active_tpitpu_user = obj.data;
                    $(".sum_of_active_tpitpu_user").html(sum_of_active_tpitpu_user);
                }, 
                async: false // <- this turns it into synchronous
            })

            var width_progress_tpt = (( sum_of_active_tpt_user / sum_of_tpt_user ) * 100 ).toFixed(2);
            var progress_color_tpt = (width_progress_tpt == 100 ? 'bg-primary' : 'bg-warning');
            $('.progress-bar-sum-user-tpt').attr('aria-valuenow', sum_of_active_tpt_user).css('width', width_progress_tpt+'%');
            $('.progress-bar-sum-user-tpt').attr('aria-valuemax', sum_of_tpt_user);
            $('.progress-bar-sum-user-tpt').removeClass('[class^=bg-]');
            $('.progress-bar-sum-user-tpt').addClass(progress_color_tpt);


            var width_progress_tpitpu = (( sum_of_active_tpitpu_user / sum_of_tpitpu_user ) * 100 ).toFixed(2);
            var progress_color_tpitpu = (width_progress_tpitpu == 100 ? 'bg-primary' : 'bg-warning');
            $('.progress-bar-sum-user-tpitpu').attr('aria-valuenow', sum_of_active_tpitpu_user).css('width', width_progress_tpitpu+'%');
            $('.progress-bar-sum-user-tpitpu').attr('aria-valuemax', sum_of_tpitpu_user);
            $('.progress-bar-sum-user-tpitpu').removeClass('[class^=bg-]');
            $('.progress-bar-sum-user-tpitpu').addClass(progress_color_tpitpu);
            // end dashboard sum user


            // dashboard sum regional user
            var sum_of_province_user;
            $.ajax({
                type: "GET",
                url: controller+"/all_province_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_province_user = obj.data;
                    $(".sum_of_province_user").html(sum_of_province_user);
                }, 
                async: false // <- this turns it into synchronous
            })
              
            var sum_of_active_province_user;
            $.ajax({
                type: "GET",
                url: controller+"/active_province_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_active_province_user = obj.data;
                    $(".sum_of_active_province_user").html(sum_of_active_province_user);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_of_citydistrict_user;
            $.ajax({
                type: "GET",
                url: controller+"/all_citydistrict_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_citydistrict_user = obj.data;
                    $(".sum_of_citydistrict_user").html(sum_of_citydistrict_user);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_of_active_citydistrict_user;
            $.ajax({
                type: "GET",
                url: controller+"/active_citydistrict_user_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_active_citydistrict_user = obj.data;
                    $(".sum_of_active_citydistrict_user").html(sum_of_active_citydistrict_user);
                }, 
                async: false // <- this turns it into synchronous
            })

            var width_progress_province = (( sum_of_active_province_user / sum_of_province_user ) * 100 ).toFixed(2);
            var progress_color_province = (width_progress_province == 100 ? 'bg-primary' : 'bg-warning');
            $('.progress-bar-sum-user-province').attr('aria-valuenow', sum_of_active_province_user).css('width', width_progress_province+'%');
            $('.progress-bar-sum-user-province').attr('aria-valuemax', sum_of_province_user);
            $('.progress-bar-sum-user-province').removeClass('[class^=bg-]');
            $('.progress-bar-sum-user-province').addClass(progress_color_province);

            var width_progress_citydistrict = (( sum_of_active_citydistrict_user / sum_of_citydistrict_user ) * 100 ).toFixed(2);
            var progress_color_citydistrict = (width_progress_citydistrict == 100 ? 'bg-primary' : 'bg-warning');
            $('.progress-bar-sum-user-citydistrict').attr('aria-valuenow', sum_of_active_citydistrict_user).css('width', width_progress_citydistrict+'%');
            $('.progress-bar-sum-user-citydistrict').attr('aria-valuemax', sum_of_citydistrict_user);
            $('.progress-bar-sum-user-citydistrict').removeClass('[class^=bg-]');
            $('.progress-bar-sum-user-citydistrict').addClass(progress_color_citydistrict);
            // end dashboard regional user

            var sum_active_user = parseInt(sum_of_active_tpt_user) + parseInt(sum_of_active_tpitpu_user) + parseInt(sum_of_active_province_user) + parseInt(sum_of_active_citydistrict_user);
            //   console.log(sum_active_tpttpitpu_user);
            $('.count-all-user').html(sum_active_user);
            
            console.log(sum_active_user);

            // dashboard sum modul
            var sum_modul_1 = 0;
            $.ajax({
                type: "GET",
                url: controller+"/sum_modul_1_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data.length);
                    for (let index = 0; index < obj.data.length; index++) {
                        sum_modul_1 += parseInt(obj.data[index].sum_assessed_area);
                    }
                    // console.log(sum_modul_1);

                    $(".sum_modul_1").html(sum_modul_1);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_finish_modul_1 = 0;
            $.ajax({
                type: "GET",
                url: controller+"/sum_finish_modul_1_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data.length);
                    for (let index = 0; index < obj.data.length; index++) {
                        sum_finish_modul_1 += parseInt(obj.data[index].sum_finish_assessed);
                    }
                    // console.log(sum_modul_1);

                    $(".sum_finish_modul_1").html(sum_finish_modul_1);
                }, 
                async: false // <- this turns it into synchronous
            })
              
            // var sum_of_active_province_user;
            // $.ajax({
            //     type: "GET",
            //     url: controller+"/active_province_user_get",
            //     success: function (data) {
            //         var obj = null;
            //         obj = $.parseJSON(data);
            //         // console.log(obj.data);
            //         sum_of_active_province_user = obj.data;
            //         $(".sum_of_active_province_user").html(sum_of_active_province_user);
            //     }, 
            //     async: false // <- this turns it into synchronous
            // })

            // var sum_active_regional_user = parseInt(sum_of_active_province_user) + parseInt(sum_of_active_citydistrict_user);
            // //   console.log(sum_active_regional_user);
            // $('.count-all-provincecitydistrict-user').html(sum_active_regional_user);

            var width_progress_modul_1 = (( sum_finish_modul_1 / sum_modul_1 ) * 100 ).toFixed(2);
            $('.progress-bar-sum-modul-1').attr('aria-valuenow', sum_finish_modul_1).css('width', width_progress_modul_1+'%');
            $('.progress-bar-sum-modul-1').attr('aria-valuemax', sum_modul_1);

            // var width_progress_citydistrict = (( sum_of_active_citydistrict_user / sum_of_citydistrict_user ) * 100 ).toFixed(2);
            // $('.progress-bar-sum-user-citydistrict').attr('aria-valuenow', sum_of_active_citydistrict_user).css('width', width_progress_citydistrict+'%');
            // $('.progress-bar-sum-user-citydistrict').attr('aria-valuemax', sum_of_citydistrict_user);

            // end dashboard sum modul

            // dashboard sum document regional user
            var sum_of_province_document;
            $.ajax({
                type: "GET",
                url: controller+"/all_province_document_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_province_document = obj.data;
                    // $(".sum_of_province_document").html(sum_of_province_document);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_of_citydistrict_document;
            $.ajax({
                type: "GET",
                url: controller+"/all_citydistrict_document_get",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    sum_of_citydistrict_document = obj.data;
                    // $(".sum_of_citydistrict_document").html(sum_of_citydistrict_document);
                }, 
                async: false // <- this turns it into synchronous
            })

            var sum_of_regional_document = parseInt(sum_of_province_document) + parseInt(sum_of_citydistrict_document);
            //   console.log(sum_of_regional_document);
            $('.count-all-regional-document').html(sum_of_regional_document);

            // var width_progress_province = (( sum_of_active_province_user / sum_of_province_user ) * 100 ).toFixed(2);
            // $('.progress-bar-sum-user-province').attr('aria-valuenow', sum_of_active_province_user).css('width', width_progress_province+'%');
            // $('.progress-bar-sum-user-province').attr('aria-valuemax', sum_of_province_user);

            // var width_progress_citydistrict = (( sum_of_active_citydistrict_user / sum_of_citydistrict_user ) * 100 ).toFixed(2);
            // $('.progress-bar-sum-user-citydistrict').attr('aria-valuenow', sum_of_active_citydistrict_user).css('width', width_progress_citydistrict+'%');
            // $('.progress-bar-sum-user-citydistrict').attr('aria-valuemax', sum_of_citydistrict_user);

            // end dashboard document user

            //progress tpt
            $.ajax({
                type: "GET",
                url: controller+"/progress_tpt",
                success: function (data) {
                    var obj = null;
                    obj = $.parseJSON(data);
                    // console.log(obj.data);
                    $('.list-progress-tpt').append(obj.data);
                }, 
                // async: false // <- this turns it into synchronous
            })

        });

    };
    
    return{
        init:function(){init();},
    };
}();