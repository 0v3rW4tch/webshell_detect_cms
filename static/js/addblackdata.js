/**
 * Created by 4me on 2020/4/1.
 */

var csrftoken = $('meta[name=csrf-token]').attr('content');

$(function () {
    $("#myModal").on('show.bs.modal', function () {

    $("#input_black_data").fileinput({

                language: 'zh', //设置语言

                uploadUrl:"/cms/upload_data_set/", //上传的地址

                allowedFileExtensions: ['php','phtml','php3','php4','php5'],//接收的文件后缀

                uploadExtraData:{"csrf_token": csrftoken},
                dropZoneTitle: '可以将文件拖放到这里 支持多文件上传',

                uploadAsync: false, //默认异步上传

                showUpload:true, //是否显示上传按钮

                showRemove : true, //显示移除按钮

                showPreview :true, //是否显示预览

                showCaption:true,//是否显示标题

                browseClass:"btn btn-primary", //按钮样式

                dropZoneEnabled: true,//是否显示拖拽区域



               //minImageWidth: 50, //图片的最小宽度

               //minImageHeight: 50,//图片的最小高度

               //maxImageWidth: 1000,//图片的最大宽度

               //maxImageHeight: 1000,//图片的最大高度

                //maxFileSize:0,//单位为kb，如果为0表示不限制文件大小

               //minFileCount: 0,

                maxFileCount:8, //表示允许同时上传的最大文件个数

                enctype:'multipart/form-data',

               validateInitialCount:true,

                previewFileIcon: "<iclass='glyphicon glyphicon-king'></i>",

               msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",

           }).on("fileuploaded", function (event, data, previewId, index){
                var single_result = data.response;
                if(single_result['code'] == 200){


                    zlalert.alertSuccessToast("已成功上传黑样本，学习需要时间请过段时间再来看结果！");



                     $("#myModal").modal('hide');


                }else{


                        zlalert.alertInfo(single_result['message']);

                    $("#myModal").modal('hide');
                }
                }).on('filebatchuploadsuccess', function(event, data, previewId, index){

                    var batch_result = data.response;

                    if(batch_result['code'] == 200){

                        zlalert.alertSuccessToast("已成功上传黑样本，学习需要时间,请过段时间再来看结果！");


                        $("#myModal").modal('hide');


                }else{
                    zlalert.alertInfo(single_result['message']);

                    $("#myModal").modal('hide');
                }

            });

}).on("hidden.bs.modal", function() {
    // $(this).removeData("bs.modal");
    /*modal页面加载$()错误,由于移除缓存时加载到<div class="modal-content"></div>未移除的数据，手动移除加载的内容*/
    // $(this).find(".modal-content").children().remove();
        setTimeout(function () {
            window.location.reload();
        },3200);


});
})


