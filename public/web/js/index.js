/**
 * 
 * @authors Crystal (1291124482@qq.com)
 * @date    2016-04-16 15:55:29
 * @version $Id$
 */

$(function(){
  
  $('.header_add_clicka').click(function(){
    $('.header_add_clicka').removeClass('header_add_clicka_on');
    $(this).addClass('header_add_clicka_on')
  });
  // $('.index_item_intro').addClass()
  function addPoint(){
    $(".index_item_intro").each(function(i) {
        var vh = 44;
        var $vp = $(".word", $(this));
        while ($vp.outerHeight() > vh){
            $vp.text($vp.text().replace(/(\s)*([a-zA-Z0-9]+|\W)(\.\.\.)?$/, "..."));
        };
    });
  }
  //上传图片点击按钮 
  $('.popa').click(function(){
      $('.pop_uploadfile').show();
      var popconHei = $('.pop_uploadfile .pop_conwrap').height();
      if (popconHei > 410) {
        $('.pop_uploadfile .pop_conwrap').css({
          'max-height':410,
          'overflow-y':'scroll'
        })
      };
      var poptopHei = $('.pop_uploadfile .pop_con').height();
      $('.pop_uploadfile .pop_con').css({
         'margin-top':-(poptopHei/2)
      })
  });

  $(".pop_upload_a").on("change","input[type='file']",function(){
          var filePath=$(this).val();
          if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1){
              var arr=filePath.split('\\');
              var fileName=arr[arr.length-1];
              $(".pop_upload_a span").html(fileName);
          }else{
              $(".pop_upload_a span").html("您上传文件类型有误！");
              return false 
          }
      })

  $('.pop_goods_upload,.pop_close,.detail_pop_cancel').click(function(){
    $('.pop_uploadfile').hide();
    $('.pop_upload_goods').hide()
    $('.pop_goods_upload').hide()
    $('.pop_addfold').hide()
    $('.header_add_item_awrap').show();
  })

  

  //添加文件夹
  $('.popc').click(function(){
    $('.pop_addfold').show()
    var popconHei = $('.pop_addfold .pop_conwrap').height();
      if (popconHei > 410) {
        $('.pop_addfold .pop_conwrap').css({
          'max-height':410,
          'overflow-y':'scroll'
        })
      };
      var poptopHei = $('.pop_addfold .pop_con').height();
      $('.pop_addfold .pop_con').css({
         'margin-top':-(poptopHei/2)
      })

  })

 
  //创建文件夹
  $('.folder').click(function(){
    pop_con = $(this).parents('.pop_con')
    name = $('input[name=fname]',pop_con).val().trim()
    description = $('textarea',pop_con).val().trim()
    private = $('input[name=private]',pop_con).attr('private')
    if(name=='') {
      layer.msg('信息没有填写完全', {icon: 5});
      return 
    }
    $.ajax({
      'beforeSend':function(){
        layer.load(0, {shade: 0.5});
      },
      'url':"/webd/folder/cfolder",
      'type':'post',
      'data':{
        'name':name,
        'description':description,'private':private,
        'fid':10000,'user_id':user_id
      },
      'dataType':'json',
      'success':function(json){
        if(json.code==200){
          layer.msg('创建成功', {icon: 6});
          setTimeout(function(){
            location.reload()
          },2000)
          
        }else{
          layer.msg(json.message, {icon: 5});
          return
        }
      },
      'complete':function(){
        layer.closeAll('loading');
      }
    })
  })

  //上传商品点击按钮 
  $('.popb').click(function(){
      $('.pop_uploadgoods').show();
      var popconHei = $('.pop_uploadgoods .pop_conwrap').height();
      if (popconHei > 410) {
        $('.pop_upload_goods .pop_conwrap').css({
          'max-height':410,
          'overflow-y':'scroll'
        })
      };
      var poptopHei = $('.pop_uploadgoods .pop_con').height();
      $('.pop_uploadgoods .pop_con').css({
         'margin-top':-(poptopHei/2)
      })
  });
  $('.pop_goods_upload .pop_con').click(function(){
        event.stopPropagation()
  });
  // 上传点击
  $('#geturl').click(function(){
        $('.pop_uploadgoods').hide();

        /*$('.pop_goods_upload').show();
        
        var popconHei = $('.pop_goods_upload .pop_conwrap').height();
        if (popconHei > 410) {
          $('.pop_goods_upload .pop_conwrap').css({
            'max-height':410,
            'overflow-y':'scroll'
          })
        };
        var poptopHei = $('.pop_goods_upload .pop_con').height();
        $('.pop_goods_upload .pop_con').css({
           'margin-top':-(poptopHei/2)
        })
        return */
        $.ajax({
          'beforeSend':function(){
            layer.load(0, {shade: 0.5});
          },
          'url':"/webd/taobao/detail",
          'type':'get',
          'data':{
            'url':$('.pop_ipt_goods').val().trim()
          },
          'dataType':'json',
          'success':function(json){
            if(json.code==200){
              ub = $('form[name=u_b]')
              description = title = json.data.x_item[0].title
              price = json.data.x_item[0].price
              pic_url = json.data.x_item[0].pic_url
              reserve_price = json.data.x_item[0].reserve_price
              image_ids = json.data.x_item[0].image_ids
              detail_url = $('.pop_ipt_goods').val().trim()
              $('input[name=title]',ub).val(title)
              $('input[name=price]',ub).val(price)
              $('#pimg img',ub).attr('src',pic_url)
              $('input[name=image]',ub).attr('value',pic_url)
              $('input[name=detail_url]',ub).val(detail_url)
              $('input[name=image_ids]',ub).val(image_ids)
              $('input[name=reserve_price]',ub).val(reserve_price)
              $('input[name=description]',ub).val(description)
              $('.pop_goods_upload').find('.pop_con').css('margin-top','-350px')
              $('.pop_goods_upload').show();
              var popconHei = $('.pop_goods_upload .pop_con').height();
                if (popconHei > 410) {
                  $('.pop_goods_upload .pop_conwrap').css({
                    'max-height':410,
                    'overflow-y':'scroll'
                  })
                };
                var poptopHei = $('.pop_goods_upload .pop_con').height();
              $('.pop_goods_upload .pop_con').css({
                 'margin-top':-(poptopHei/2)
              })

              $.post('/webd/pics/cgoods',{'user_id':user_id},function(json){
                  if(json.code==200){
                    var option = ''
                    $.each(json.data.cg,function(i,v){
                        option += '<option value="'+v.id+'">'+v.name+'</option>'
                    })
                    $.each(json.data.folder,function(i,v){
                        option += '<option value="'+v.id+'">'+v.name+'</option>'
                    })
                    if(json.cg==0 && json.folder==0) option = '<option>没有文件</option>'
                        $('.pop_iptselect').html(option)
                    }
              },'json')  
            }else{
              layer.msg(json.message, {icon: 5});
              return
            }
          },
          'complete':function(){
            layer.closeAll('loading');
          }
        })
        /*$.post('/webd/pics/cgoods',{'user_id':user_id},function(json){
          if(json.code==200){
            var option = ''
            $.each(json.cg,function(i,v){
                option += '<option value="'+v.id+'">'+v.name+'</option>'
            })
            $.each(json.folder,function(i,v){
                option += '<option value="'+v.id+'">'+v.name+'</option>'
            })
            if(json.cg==0 && json.folder==0) option = '<option>没有文件</option>'
            $('.pop_iptselect').html(option)
          }
        },'json')*/      
  })

  //保存上传
  $('form[name=u_b]').submit(function(){
      $(this).ajaxSubmit({
        type:"post",  //提交方式
        dataType:"json", //数据类型
        url:"/webd/folder/ugoods", //请求url
        success:function(json){ //提交成功的回调函数
            if(json.code==200) {
              layer.msg('成功上传',{icon: 6});
              setTimeout(function(){
                location.reload()
              },2000)
            }else{
              layer.msg(json.message, {icon: 5});
              return
            } 
        },
        resetForm:1
      });
      return false
    })
    $('#u_b').click(function(){
      $('form[name=u_b]').submit()
    })




})
