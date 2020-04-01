/**
 * Created by 4me on 2020/2/14.
 */


$(function(){
   $("#submit").click(function (event) {
      event.preventDefault();

      var dataiE = $("#input_dictionary");
      var resultE = $("#return_result");
      resultE.empty();

      var datai = dataiE.val();
      console.log(datai);
      zlajax.post({
          'url' : '/cms/dictionary_check/',
          'data' : {
              'input_dictionary': datai,
          },
          'success' : function (data) {
              if(data['code'] == 200){
                  zlalert.alertSuccessToast("已输入目录,请等待判断结果！");
                  setTimeout(function () {

                        var tmp = data['message'];
                        for(var p in tmp){
                            if(tmp[p] == 1){
                                var del_name = datai + '\\\\' + p;
                                var text = "<tr style='color: red' id="+p+"><td>"+p+"</td><td>"+"<a href='javascript:void(0);' onclick='del_shell(\""+del_name+"\")' title='删除'><span class='glyphicon glyphicon-remove'></span></a>"+"</td></tr>"
                                resultE.append(text);
                            }else{
                                // var text = "<tr><td>"+p+"</td><td>"+"安全"+"</td><td>"+"/"+"</td></tr>";
                                // resultE.append(text);
                            }
                        }
                      // console.log(data['message']);
                  },1800)
              }else{
                  var message = data['message'];
                   zlalert.alertInfo(message);
              }
          },
          'fail' : function (error) {
                 zlalert.alertErrorToast("网络出现错误！");
           },

      });

   });
});



function del_shell(shell_file_path) {

    shell_file_path = shell_file_path.replace(/\\/g,'/');
    var shell_file_name = shell_file_path.split('/')[shell_file_path.split('/').length -1];
    // var shell_file_name = shell_file_path.split('/')[-1];
    // alert(shell_file_name);
    zlalert.alertConfirm({
        "msg" : "确认是否删除",
        "confirmText" : "确认",
        "cancelText" : "取消",
        "confirmCallback" : function () {
            zlajax.post({
                'url':'/cms/del_shell/',
                 'data':{
                    'shell_file_path' : shell_file_path
                 },
                'success' : function (data) {
                    if(data['code'] == 200){

                        // console.log(data['message']);
                        // $(eval('#'+shell_file_name)).remove();


                        $("#success-tag").toggle('slow');

                        setTimeout(function(){
                        $("#success-tag").toggle('slow');
                    },2500);
                        $("tr[id='"+shell_file_name+"']").remove();

                        // zlalert.alertInfo("成功");
                    }else{
                        // var message = data['message'];

                        $("#warn-tag").toggle('slow');

                        setTimeout(function(){
                        $("#warn-tag").toggle('slow');
                    },1800);
                    }
                },
                'fail' : function (error) {
                     // zlalert.alertErrorToast("网络出现错误！");

                        $("#error-tag").toggle('slow');

                        setTimeout(function(){
                        $("#error-tag").toggle('slow');
                    },1800);
                },
            });
        }
    });


}