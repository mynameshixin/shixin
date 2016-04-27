@extends('admin.right')

@section('htmlheader_title')

@endsection

@section('content')
    {!! $edit !!}
@endsection

@section('otherheader')
<script type="text/javascript" src="{{asset('/static/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/static/js/uploadify-v2.1.4/swfobject.js')}}"></script>
<script type="text/javascript" src="{{asset('/static/js/uploadify-v2.1.4/jquery.uploadify.v2.1.4.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/static/js/uploadify-v2.1.4/uploadify.css')}}">
@endsection

@section('otherfooter')

<script>
    (function ($) {
        $.getUrlParam = function (name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        }
    })(jQuery);

    var getimage_url="{{asset('/admin/store/action/picurl?image_ids=')}}";
    var uploader_swf="{{asset('/static/js/uploadify-v2.1.4/uploadify.swf')}}";
    var uploader_cancel_png="{{asset('/static/js/uploadify-v2.1.4/cancel.png')}}";
    var uploader_url="{{asset('/admin/store/action/uploadimage')}}";//http://10.21.3.59:8881/admin/store/action/edit?modify=1

    var images=[];
    var url_show="";
    //var uploader_button_png="{{asset('/static/js/uploadify-v2.1.4/upload_btn.png')}}";
    $(function(){
        url_show=$.getUrlParam('show');
        if(url_show){//显示
            $('#div_pics .help-block').hide();
            $('#div_pics').append('<div id="upPics"></div>');

        }else{//编辑
            $('#pics').after('<div id="upPics"><input id="uploadPics" name="uploadPics" type="file" multiple="true"><br></div>');
            load_uploadify();
        }

        $('#upPics').append('<ul id="edit_pics" style="list-style: none;margin-left:-50px;"></ul>');
        onload_image();
    });
    function load_uploadify(){
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
    }

    //获得图片
    function onload_image(){
        var pics=$('#pics').val();
        if(!pics){
           pics=$('#div_pics .help-block').html();
           pics=pics.replace(/&nbsp;/, "");
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

    }
    //加载图片
    function load_image(imgs,key){
        for(var i=0;i<imgs.length;i++){
             if(url_show){
                $('#edit_pics').append('<li style="float:left;margin-left:10px;"><a href="'+imgs[i][key]+'" target="_blank" style="cursor:pointer;"><img src="'+imgs[i][key]+'" width=100 height=100></a>');
             }else{
                $('#edit_pics').append('<li style="float:left;margin-left:10px;" id="li_img_'+imgs[i]['image_id']+'" val="'+imgs[i]['image_id']+'"><a href="'+imgs[i][key]+'" target="_blank" style="cursor:pointer;" title="点击打开原图"><img src="'+imgs[i][key]+'" width=100 height=100></a><br/><a style="display:block;text-align:center;cursor:pointer;" href="javascript:delPic('+imgs[i]['image_id']+');">删   除</a>');
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
    }


</script>
@endsection
