/**
 * Created by 10000716 on 2015/9/6.
 */

//加载所需JS和CSS文件
loadJsOrCss("/static/js/uploadify-v2.1.4/swfobject.js","js");
loadJsOrCss("/static/js/uploadify-v2.1.4/jquery.uploadify.v2.1.4.min.js","js");
loadJsOrCss("/static/js/uploadify-v2.1.4/uploadify.css","css");


$(function(){
    url_show=getUrlParam('show');
    console.log(url_show);
    var upload = new uploadify();
    upload.init(url_show);
});


function uploadify(){
    var getimage_url=  getRootPath()+'/admin/store/action/picurl?image_ids=';
    var uploader_swf=  getRootPath()+'/static/js/uploadify-v2.1.4/uploadify.swf';
    var uploader_cancel_png= getRootPath()+'/static/js/uploadify-v2.1.4/cancel.png';
    var uploader_url= getRootPath()+'/admin/store/action/uploadimage';
    var images=[];
    this.init = function(url_show){
        if(url_show){//显示
            $('#div_pics .help-block').hide();
            $('#div_pics').append('<div id="upPics"></div>');

        }else{//编辑
            $('#pics').after('<div id="upPics"><input id="uploadPics" name="uploadPics" type="file" multiple="true"><br></div>');
            load_uploadify();
        }

        $('#upPics').append('<ul id="edit_pics" style="list-style: none;margin-left:-50px;"></ul>');
        onload_image();
    };
    var load_uploadify = function(){
        $('#uploadPics').uploadify({
            'uploader'  : uploader_swf,
            'script'    : uploader_url,
            'cancelImg' : uploader_cancel_png,
            'fileDataName':'image[]',
            'sizeLimit' : 5*1024*1024,//2097152,////2097152,//控制上传文件的大小，单位byte
            'multi'     : true,
            'fileExt'   : '*.jpg;*.gif;*.png;',
            'fileDesc'  : 'Image Files (.JPG, .GIF, .PNG)',
            'simUploadLimit' : 5,
            'auto':true,
            'wmode':'transparent',
            onComplete:function(a, b ,c, d, e){
                var d = eval('(' + d + ')');
                if(d.response==100){
                    var data= d.data;
                    var image_ids=[];var nowImages=[];
                    for (var i=0;i<data.length;i++){
                        image_ids.push(data[i]['image_id']);
                        images.push(data[i]);
                        nowImages.push(data[i]);
                    }
                    var pics=$('#pics').val();
                    if(pics.length>0) pics+=',';
                    $('#pics').val(pics+image_ids);
                    load_image(nowImages,'pic_m');
                }
                return true;
            },onAllComplete: function (event, data){
                return false;
            },onCancel:function(event,queueId,fileObj,data){

            }
        });
    };
    var load_uploadify = function(){
        $('#uploadPics').uploadify({
            'uploader'  : uploader_swf,
            'script'    : uploader_url,
            'cancelImg' : uploader_cancel_png,
            'fileDataName':'image[]',
            'sizeLimit' : 5*1024*1024,//2097152,////2097152,//控制上传文件的大小，单位byte
            'multi'     : true,
            'fileExt'   : '*.jpg;*.gif;*.png;',
            'fileDesc'  : 'Image Files (.JPG, .GIF, .PNG)',
            'simUploadLimit' : 5,
            'auto':true,
            'wmode':'transparent',
            onComplete:function(a, b ,c, d, e){
                var d = eval('(' + d + ')');
                if(d.response==100){
                    var data= d.data;
                    var image_ids=[];var nowImages=[];
                    for (var i=0;i<data.length;i++){
                        image_ids.push(data[i]['image_id']);
                        images.push(data[i]);
                        nowImages.push(data[i]);
                    }
                    var pics=$('#pics').val();
                    if(pics.length>0) pics+=',';
                    $('#pics').val(pics+image_ids);
                    load_image(nowImages,'pic_m');
                }
                return true;
            },onAllComplete: function (event, data){
                return false;
            },onCancel:function(event,queueId,fileObj,data){

            }
        });
    };

//获得图片
    var onload_image = function(){
        var pics=$('#pics').val();
        if(!pics){
            pics=$('#div_pics .help-block').html();
            pics=pics?pics.replace(/&nbsp;/, ""):pics;
        }
        if(pics){
            $.ajax({
                type: 'get',
                url: getimage_url+pics ,
                dataType: 'json',
                async:false,
                success:function(data){
                    if(data.response){
                        for(var i=0;i<data.data.length;i++){
                            //alert(data.data[i]);
                            images.push(data.data[i]);
                        }
                        load_image(images,'pic_m');
                    }
                }
            });

        }

    };
    //加载图片
    var load_image = function(imgs,key){
        for(var i=0;i<imgs.length;i++){
            if(url_show){
                $('#edit_pics').append('<li style="float:left;margin-left:10px;"><a href="'+imgs[i][key]+'" target="_blank" style="cursor:pointer;"><img src="'+imgs[i][key]+'" width=100 height=100></a>');
            }else{
                $('#edit_pics').append('<li style="float:left;margin-left:10px;" id="li_img_'+imgs[i]['image_id']+'" val="'+imgs[i]['image_id']+'"><a href="'+imgs[i][key]+'" target="_blank" style="cursor:pointer;" title="点击打开原图"><img src="'+imgs[i][key]+'" width=100 height=100></a><br/><a style="display:block;text-align:center;cursor:pointer;" href="javascript:delPic('+imgs[i]['image_id']+');">删   除</a>');
            }
        }
    }


}

function delPic(id){
    $('#li_img_'+id).fadeOut();
    var pics=$('#pics').val();
    var pics_arr=pics.split(",");
    var pics_set=[];
    for(var i=0;i<pics_arr.length;i++){
        if(pics_arr[i]!=id){
            pics_set.push(pics_arr[i]);
        }
    }
    $('#pics').val(pics_set);
};
function loadJsOrCss(filename, filetype){
    var filename = getRootPath() + filename;
    if (filetype=="js"){ //判定文件类型
        var fileref=document.createElement('script')//创建标签
        fileref.setAttribute("type","text/javascript")//定义属性type的值为text/javascript
        fileref.setAttribute("src", filename)//文件的地址
    }
    else if (filetype=="css"){ //判定文件类型
        var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
    }
    if (typeof fileref!="undefined")
        document.getElementsByTagName("head")[0].appendChild(fileref)
}
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
};
function getRootPath(){
    //获取当前网址，如： http://localhost:8083/uimcardprj/share/meun.jsp
    var curWwwPath=window.document.location.href;
    //获取主机地址之后的目录，如： uimcardprj/share/meun.jsp
    var pathName=window.document.location.pathname;
    var pos=curWwwPath.indexOf(pathName);
    //获取主机地址，如： http://localhost:8083
    var localhostPaht=curWwwPath.substring(0,pos);
    return localhostPaht;
};
