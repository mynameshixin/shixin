/**
 * 
 * @authors Crystal (1291124482@qq.com)
 * @date    2016-07-16 17:22:15
 * @version $Id$
 */
// 批量上传功能

// 批量上传弹框


  var uploadPophtml = '<div class="pop_addpic_multi">\
  <form name="allimg" action="" method="post" enctype="multipart/form-data">\
    <div class="pop_con">\
      <p class="pop_tit">\
        上传图片\
        <span class="pop_close"></span>\
      </p>\
      <div class="pop_namewrap clearfix" style="padding:0px 0px 0px 30px;">\
        <span class="pop_labelname" style="font-size:14px;line-height:42px;width:100%;">图片展示(最多5张且每张大小不超过8M)</span>\
        <div class="pop_addpic_con clearfix" style="float:left">\
            <div class="pop_addpic_wrap" style="position:relative;float:left;">\
              <img src="/web/images/pop_upload_multi.png" alt="" class="show"/>\
              <input type="file" name="uallimg[]"/>\
            </div>\
            <div class="pop_addpic_wrap" style="position:relative;float:left;">\
              <img src="/web/images/pop_upload_multi.png" alt="" class="show"/>\
              <input type="file" name="uallimg[]"/>\
            </div>\
            <div class="pop_addpic_wrap" style="position:relative;float:left;">\
              <img src="/web/images/pop_upload_multi.png" alt="" class="show"/>\
              <input type="file" name="uallimg[]"/>\
            </div>\
            <div class="pop_addpic_wrap" style="position:relative;float:left;">\
              <img src="/web/images/pop_upload_multi.png" alt="" class="show"/>\
              <input type="file" name="uallimg[]"/>\
            </div>\
            <div class="pop_addpic_wrap" style="position:relative;float:left;">\
              <img src="/web/images/pop_upload_multi.png" alt="" class="show"/>\
              <input type="file" name="uallimg[]"/>\
            </div>\
        </div>\
      </div>\
      <div class="pop_namewrap clearfix" style="padding:8px 0px 8px 30px;">\
        <span class="pop_labelname" style="font-size:12px;line-height:36px;">保存至文件夹</span>\
        <select class="pop_iptselect" name="fid">\
          <option value="">椅子</option>\
        </select>\
      </div>\
      <div class="pop_btnwrap">\
        <input type="hidden" name="user_id" value="'+user_id+'"/>\
        <input type="hidden" name="kind" value="2"/>\
        <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>\
        <a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="allimg">上传</a>\
      </div>\
    </div>\
  </form>\
  </div>';
$('.header_more_a1,.pop_cona').click(function(){
    $('.pop_goodsupload').hide();
    $('body').append(uploadPophtml);
    var poptopHei = $('.pop_addpic_multi .pop_con').height();
    $('.pop_addpic_multi .pop_con').css({
       'margin-top':-(poptopHei/2)
    });
    //获取文件id
    $.ajax({
        'beforeSend':function(){
          layer.load(0, {shade: 0.5});
        },
        'url':'/webd/pics/cgoods',
        'type':'post',
        'data':{'user_id':user_id},
        'dataType':'json',
        'success':function(json){
          if(json.code==200){
            var option = ''
            $.each(json.data.folder,function(index,v){
                option += "<option value="+v.id+">"+v.name+"</option>"
            })
            
            $('form[name=allimg]').find('.pop_iptselect').html(option)
          }else{
              layer.msg(json.message, {icon: 5});
              return
          } 
        },
        'complete':function(){
          layer.closeAll('loading');
        }
    })
    
    $('.pop_addpic_wrap input').change(function(){
        var imgcon = $('.pop_pic_wrap');
        if (this.files && this.files[0]) {
          var filename = this.files[0].name;
          var subfile = filename.split('.');
          var subfilelen = subfile.length;
          var last = subfile[subfilelen-1].toLowerCase();
          var tp ="jpg,gif,bmp,png,jpeg";
          var rs=tp.indexOf(last);
          var obj = $(this)
            if(rs>=0){
              var reader = new FileReader();
              reader.onload = function(evt){
                var addpicLen = $('.pop_pic_wrap .pop_addpic_wrap').length;
                var appendnewNode = '<div class="pop_addpic_wrap2" style="position:absolute;">\
                              <span class="close_img_btn">×</span>\
                              <img src="'+evt.target.result+'" alt="">\
                              <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]">'+subfile[0]+'</textarea>\
                            </div>';
                obj.prev().css('display','none')
                obj.parent('.pop_addpic_wrap').append(appendnewNode)

                $('.close_img_btn').click(function(){
                  $(this).parents('.pop_addpic_wrap2').prev().prev().css('display','block').next().val('')
                  $(this).parents('.pop_addpic_wrap2').remove();

                })
              }
              reader.readAsDataURL(this.files[0]);
          }else{
              alert("您选择的上传文件不是有效的图片文件！请重新选择");
              return false;
          }
        } else{
        };

      });
    $('.pop_addpic_multi,.pop_close,.detail_pop_cancel').click(function(){
        $('.pop_addpic_multi').remove();
      })
      $('.pop_addpic_multi .pop_con').click(function(){
        event.stopPropagation()
      })

  $('form[name=allimg]').submit(function(){
    var form = $('form[name=allimg]')
    $(this).ajaxSubmit({
        type:"post",  //提交方式
        dataType:"json", //数据类型
        url:"/webd/pics/uimg", //请求url
        'fileTypeDesc': "Image Files",
        success:function(json){ //提交成功的回调函数
            if(json.code==200) {
              layer.msg('成功上传',{icon: 6});
              setTimeout(function(){
                location.reload()
              },1000)
            }else{
              layer.msg(json.message, {icon: 5});
              return
            } 
        },
        resetForm:1
    });
    return false
  })
  $('#allimg').click(function(){
    $('form[name=allimg]').submit()
  })



  })
  
