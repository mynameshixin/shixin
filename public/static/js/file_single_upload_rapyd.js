/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var Img_upload = function () {

    var getimage_url = "/image?image_ids=";
    var uploader_swf = "/static/js/uploadify-v2.1.4/uploadify.swf";
    var uploader_cancel_png = "/static/js/uploadify-v2.1.4/cancel.png";
    var uploader_url = "/image";//http://10.21.3.59:8881/admin/store/action/edit?modify=1
    var images = [];

    var getUrlParam = function(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    var init = function(dom_id){
        var url_show = getUrlParam('show');
        if(url_show){//显示
            $('#div_'+dom_id+' .help-block').hide();
            $('#div_'+dom_id).append('<div id="up_'+dom_id+'"></div>');

        }else{//编辑
            $('#'+dom_id).after('<div id="up_'+dom_id+'"><input id="'+dom_id+'_upload" name="'+dom_id+'_upload" type="file"><br></div>');
            load_uploadify(dom_id);


            if($('#'+dom_id).val() == ''){
                $('#'+dom_id).val('');
            }

        }
        $('#up_'+dom_id).append('<ul id="edit_'+dom_id+'" style="list-style: none;margin-left:-50px;"></ul>');

        onload_image(dom_id);
    }
    var load_uploadify = function(dom_id){
        $('#'+dom_id+'_upload').uploadify({
            'uploader'  : uploader_swf,
            'script'    : uploader_url,
            'cancelImg' : uploader_cancel_png,
            'fileDataName':'image',
            'sizeLimit' : 150*1024*1024,//2097152,////2097152,//控制上传文件的大小，单位byte
            'multi'     : false,
            'fileExt'   : '*.jpg;*.gif;*.png;',
            'fileDesc'  : 'Image Files (.JPG, .GIF, .PNG)',
            'simUploadLimit' : 1,
            'auto':true,
            'wmode':'transparent',
            onComplete:function(a, b ,c, d, e){
                var d = eval('(' + d + ')');
                if (d.code == 200) {
                    var old=$('#'+dom_id).val();

                    if(old!="") delPic(old,dom_id);

                    $('#'+dom_id).val(d.data.image_id);
                    var images_1=[];
                    images_1.push(d.data);
                    load_image(dom_id, images_1, 'picUrl');
                }
                return true;
            },onAllComplete: function (event, data){
                return false;
            },onCancel:function(event,queueId,fileObj,data){

            }
        });

    }


    var onload_image = function(dom_id){
        var pics=$('#'+dom_id).val();
        if(!pics){
            pics=$('#div_'+dom_id+' .help-block').html();
        }
        if(pics!=" " && pics!=","){
            $.ajax({
                type: 'get',
                url: getimage_url+pics,
                dataType: 'json',
                async:false,
                success:function(data){
                    if (data.code == 200) {

                        for (var i = 0; i < data.data.length; i++) {
                            if (data.data[i]!=0) {
                                images.push(data.data[i]);
                            }

                        }
                        load_image(dom_id, images, 'picUrl');
                    }
                }
            });
        }
    }



    //加载图片
    var load_image = function(dom_id,imgs,key){
        var url_show = getUrlParam('show');
        for(var i=0;i<imgs.length;i++){
            if(imgs[i][key]=="") continue;
            if(url_show){
                $('#edit_'+dom_id).append('<li style="float:left;margin-left:10px;"><a href="'+imgs[i][key]+'" target="_blank" style="cursor:pointer;"><img src="'+imgs[i][key]+'" width=100 height=100></a><br>'+imgs[i]['name']);
            }else{
                $('#edit_'+dom_id).append('<li style="float:left;margin-left:10px;" id="li_img_'+imgs[i]['image_id']+'" val="'+imgs[i]['image_id']+'"><a href="'+imgs[i][key]+'" target="_blank" style="cursor:pointer;" title="点击打开原图"><img src="'+imgs[i][key]+'" width=100 height=100></a><br/>'+imgs[i]['name']+'<br/><a style="display:block;text-align:center;cursor:pointer;" href="javascript:Img_upload.delPic(\''+imgs[i]['image_id']+'\',\''+dom_id+'\');">删   除</a>');
            }
        }
    }

    var delPic = function(id, dom_id){
        $('#li_img_' + id).fadeOut();
        var pics = $('#'+dom_id).val();
        var pics_arr = pics.split(",");
        var pics_set = [];
        for (var i = 0; i < pics_arr.length; i++) {
            if (pics_arr[i] != id && pics_arr[i]!=' ') {
                pics_set.push(pics_arr[i]);
            }
        }
        $('#'+dom_id).val(pics_set);
    }


    return {
        //main function to initiate template pages
        init: function(dom_id){
            init(dom_id);
        },
        delPic: function(id, dom_id){
            delPic(id, dom_id);
        }
    }

}();