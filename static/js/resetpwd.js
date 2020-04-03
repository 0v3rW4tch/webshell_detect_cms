/**
 * Created by 4me on 2020/2/10.
 */


$(function () {
   $("#submit").click(function (event) {
       event.preventDefault();
       //阻止默认提交表单的事件
       var oldpwdE = $("input[name=oldpwd]");
       var newpwdE = $("input[name=newpwd]");
       var newpwd2E = $("input[name=newpwd2]");


       var oldpwd = oldpwdE.val();
       var newpwd = newpwdE.val();
       var newpwd2 = newpwd2E.val();

       zlajax.post({
            'url' : '/cms/resetpwd/',
            'data' : {
                'oldpwd' : oldpwd,
                'newpwd' : newpwd,
                'newpwd2' : newpwd2,
            },
           'success' : function(data){
                // console.log(data['code']);
               if(data['code'] == 200){
                   zlalert.alertSuccessToast("修改密码成功！");
                   oldpwdE.val("");
                   newpwdE.val("");
                   newpwd2E.val("");
                   setTimeout(function () {
                       $(window).attr('location','/cms/logout');
                   },2100);

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