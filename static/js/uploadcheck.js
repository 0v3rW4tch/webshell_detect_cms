/**
 * Created by 4me on 2020/3/30.
 */


var csrftoken = $('meta[name=csrf-token]').attr('content');



$(document).ready(function () {
    $("#input_file").fileinput({

                language: 'zh', //设置语言

                uploadUrl:"/cms/upload_check/", //上传的地址

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
                console.log(single_result);
                if(single_result['code'] == 200){
                    $('#upload_result_table').bootstrapTable({
                        striped: true,
                        sidePagination:'client',
                        pageSize: "1",
                        pagination: true, // 是否分页
                        showColumns: false,

                        cache: false,
                        columns : [
                            {field:"filename",title:"文件名",align:"center",valign:"middle"},
                            {field:"property",title:"安全/危险",align:"center",valign:"middle"}
                        ],
                        rowStyle:function(row,index){
                             if(row.property == "危险"){
                                 return {css:{"color":"red"}};
                             }else{
                                 return {css:{"color":"green"}};
                             }
                        },
                        data: single_result['message'],
                    })
                }else{
                    zlalert.alertInfo(single_result['message']);
                }


            }).on('filebatchuploadsuccess', function(event, data, previewId, index){

                    var batch_result = data.response;
                    console.log(batch_result);
                    if(batch_result['code'] == 200){
                    $('#upload_result_table').bootstrapTable({
                        striped: true,
                        sidePagination:'client',
                        showColumns: false,
                        pageSize: "3",
                        pagination: true, // 是否分页
                        cache: false,
                        columns : [
                            {field:"filename",title:"文件名",align:"center",valign:"middle"},
                            {field:"property",title:"安全/危险",align:"center",valign:"middle"}

                        ],
                        rowStyle:function(row,index){
                             if(row.property == "危险"){
                                 return {css:{"color":"red"}};
                             }else{
                                 return {css:{"color":"green"}};
                             }
                        },
                        data: batch_result['message'],
                    })
                }else{
                    zlalert.alertInfo(batch_result['message']);
                }


                });
})








// $(function dianji(){
//     // 'use strict';
//    $("#submit_file").click(function (event) {
//       event.preventDefault();
//         // console.log('start');
//         // $('#input_file').fileupload({
//         //     dataType: 'json',
//         //     done: function (e, data) {
//         //         console.log(data.result);
//         //     }
//         //
//         // });
//         var files = document.getElementById('input_file').files;
//         var csrf_token = $('#csrf_token').val();
//         // console.log(files);
//         var formData = new FormData();
//         formData.append("csrf_token",csrf_token);
//         for (var i = 0; i < files.length; i++) {
// 				 formData.append("input_file", files[i]);
// 			}
//         // console.log(formData);
        //


       // $.ajax({
//             url: '/cms/upload_check/',
//             async: false,
//             type: 'POST',
//             data: formData,
//             cache: false,
//             processData: false,
//             contentType: false,
//            success : function(result) {
//                 zlalert.alertSuccessToast("上传成功！请等待检测结果~");
//                 console.log(result['message']);
//
//
//          },
//          error : function(result) {
//              console.log(result);
//          }
//
//
// });
//
//
//
//
//       });
//
//
//
// });