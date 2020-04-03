/**
 * Created by 4me on 2020/2/13.
 */


$(function (){
   $("#submit").click(function (event) {
      event.preventDefault();

      var dataiE = $("#input_data");

      var datai = dataiE.val();
      // console.log(data);
      zlajax.post({
          'url' : '/cms/input_check/',
          'data' : {
              'input_data': datai,
          },

          'success' : function (data) {
              // var store_data = eval('(' + data + ')');
              console.log(data['code']);
              if(data['code'] == 200){
                  dataiE.val("");
                  zlalert.alertSuccessToast("已输入,请等待判断结果！");

                  setTimeout(function(){
                    $("#safe_info_alert").toggle(3000);
                     },2000);

                  setTimeout(function(){
                        $("#safe_info_alert").toggle('slow');
                    },5500);


              }else if(data['code'] == 201){
                  dataiE.val("");
                  zlalert.alertSuccessToast("已输入,请等待判断结果！")

                  setTimeout(function(){
                  $("#danger_info_alert").toggle(3000);},2000);

                  setTimeout(function(){
                        $("#danger_info_alert").toggle('slow');
                    },5500);
              }
              else{
                  dataiE.val("");
                  var message = data['message'];
                   zlalert.alertInfo(message);
              }


          },
          'fail' : function (error) {
                 dataiE.val("");
                 zlalert.alertErrorToast("网络出现错误！");
           },

      });

   });
});


// setInterval(get_info,3000);   // 3秒