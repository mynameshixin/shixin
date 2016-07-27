/**
 * 
 * @authors Crystal (1291124482@qq.com)
 * @date    2016-04-16 15:55:29
 * @version $Id$
 */

function c_function(obj){
    //采集动作
    // folder_id = $(obj).parent('li').attr('folder_id')
    var folder_id = $(obj).attr('folder_id')
    var good_id = $(obj).parents('.p_collect').attr('img_id')
    var action = 1
    $.ajax({
      'beforeSend':function(){
        layer.load(0, {shade: 0.5});
      },
      'url':"/webd/pics/cpic",
      'type':'post',
      'data':{
        'folder_id':folder_id,
        'good_id':good_id,
        'action':action,
        'user_id':u_id
      },
      'dataType':'json',
      'success':function(json){
        if(json.code==200){
          layer.msg('采集成功', {icon: 6});
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

  }
var cout = 0;
function collect(obj){
  var o = $(obj)
  var imgsrc = o.parents('.index_item_wrap').find('.index_item_imgwrap').find('img').attr('src')
  var description = o.parents('.index_item_wrap').find('.index_item_intro').html()
  var good_id = o.parents('.index_item_wrap').find('.index_item_rel').attr('good_id')
  if(u_id==''){
      layer.msg('请登录', {icon: 5});
      $('.pop_login2').show()
      h = $('.pop_login2').find('.pop_con').height()
        $('.pop_login2').find('.pop_con').css({
           'margin-top':-(h/2)
        })
      return 
  }
  var proposals = []
  $('#collect_outer').find('.pop_col_ltop').find('img').attr('src',imgsrc)
  $('#collect_outer').find('.pop_col_detailtext').val(description)
  $('#collect_outer').attr('img_id',good_id)
  $('#folder_outer').find('.pop_col_ltop').find('img').attr('src',imgsrc)
  $('#folder_outer').find('.pop_col_detailtext').val(description)

  $('#collect_outer').show();
  var popH =$('#collect_outer').show().find('.pop_con').height();
  $('#collect_outer').show().find('.pop_col_left').height(popH);
  var collect_outer = $('#collect_outer')
  $.ajax({
      'beforeSend':function(){
        layer.load(0, {shade: 0.5});
      },
      'url':'/webd/pics/cgoods',
      'data':{'user_id':u_id},
      'type':'post',
      'dataType':'json',
      'success':function(json){
        if(json.code==200){
          cgcontent = afolder = ''
          $.each(json.data.cg,function(index,v){
            cgcontent += '<li class="pop_col_colum_on clearfix" folder_id='+v.id+' style="cursor:pointer" onclick="c_function(this)">'
              +'<div class="pop_col_colava">'
                +'<img src="'+v.image_url+'" alt="">'
              +'</div>'
              +'<div class="pop_col_colname">'+v.name.substr(0,8)+'</div>'

            if(v.private==1) cgcontent+='<a class="pop_col_foldlock"></a>'
              cgcontent+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn" >采集</a>'
            +'</li>'
          })
          $('.pop_col_colum_new',collect_outer).html(cgcontent)
          $.each(json.data.folder,function(index,v){
            afolder += '<li class="pop_col_colum_on clearfix" folder_id='+v.id+' style="cursor:pointer" onclick="c_function(this)">'
              +'<div class="pop_col_colava">'
                +'<img src="'+v.image_url+'" alt="">'
              +'</div>'
              +'<div class="pop_col_colname">'+v.name.substr(0,8)+'</div>'
              if(v.private==1) afolder+='<a class="pop_col_foldlock"></a>'
              afolder+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn" >采集</a>'
            +'</li>'
            proposals[index] = v.name
          })
          $('.pop_col_colum_all',collect_outer).html(afolder)
        }else{
          layer.msg(json.message, {icon: 5});
          return
        }
      },
      'complete':function(){
        layer.closeAll('loading');
      }
    })
  //自动补全
  if(cout == 0){
    $('#search_form_outer').autocomplete({
        hints: proposals,
        width: 218,
        height: 36,
        onSubmit: function(text){
          var pop_col_colum_all_li =  $('.pop_col_colum_all li',collect_outer)
          $.each(pop_col_colum_all_li,function(index,v){
            if(pop_col_colum_all_li.eq(index).find('.pop_col_colname').html()==text){
              $('#search_outer').html(pop_col_colum_all_li.eq(index).clone())
              return
            }
          })  
        }
      });
    cout = 1;
  }
}

//上传图片最后步骤
function allimg_upload(obj){
  var folder_id = $(obj).attr('folder_id')
  $('form[name=allimg]').ajaxSubmit({
          type:"post",  //提交方式
          dataType:"json", //数据类型
          url:"/webd/pics/uimg", //请求url
          'fileTypeDesc': "Image Files",
          'data':{'fid':folder_id},
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
}

$(function(){
  //采集创建新文件
  $('#pop_add_addnew_outer').click(function(){
    $('#collect_outer').hide();
    $('#folder_outer').show()
    var popH =$('#folder_outer').show().find('.pop_con').height();
    $('#folder_outer').show().find('.pop_col_left').height(popH);
  })
  //隐私文件夹设置
  $('#folder_outer .pop_iptprivacy').click(function(){
    if($(this).attr('checked') == 'checkbox') return
    if($(this).attr('private') == 1){
      $(this).attr('private',0)
    }else{
      $(this).attr('private',1)
    }
  })
  $('#collect_outer .pop_collect,#collect_outer .pop_close,#collect_outer .detail_pop_cancel').click(function(){
      $('#collect_outer').hide()
  });
  $('#folder_outer .pop_collect,#folder_outer .pop_close,#folder_outer .detail_pop_cancel').click(function(){
      $('#folder_outer').hide()
  });
  //采集创建文件夹点击按钮
  $('#cfolder_outer').click(function(){
    var pop_con = $(this).parents('.pop_con')
    var name = $('input[name=fname]',pop_con).val().trim()
    var description = $('textarea',pop_con).val().trim()
    var private = $('input[name=private]',pop_con).attr('private')
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
        'fid':10,'user_id':u_id
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

  $(".pop_upload_a").on("change","input[type='file']",function(){
          var filePath=$(this).val();
          if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1){
              var arr=filePath.split('\\');
              var fileName=arr[arr.length-1];
              var file = fileName.substring(0,fileName.lastIndexOf('.'))
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



var cx = 0
// 上传图片js
$('.header_more_a1,.pop_cona').click(function(){
    if(u_id==''){
      layer.msg('需要登录',{'icon':5})
      return
    }
    
    $(this).parents('.pop_goodsupload').hide()
    $('#upload_outer').show();
    var popH =$('#upload_outer').show().find('.pop_con').height();
    $('#upload_outer').show().find('.pop_col_left').height(popH);
    var upload_outer = $('#upload_outer')
    var proposals = []
    $.ajax({
            'beforeSend':function(){
              layer.load(0, {shade: 0.5});
            },
            'url':'/webd/pics/cgoods',
            'data':{'user_id':u_id},
            'type':'post',
            'dataType':'json',
            'success':function(json){
              if(json.code==200){
                cgcontent = afolder = ''
                $.each(json.data.cg,function(index,v){
                  cgcontent += '<li class="pop_col_colum_on clearfix" folder_id='+v.id+' style="cursor:pointer" onclick="allimg_upload(this)">'
                    +'<div class="pop_col_colava">'
                      +'<img src="'+v.image_url+'" alt="">'
                    +'</div>'
                    +'<div class="pop_col_colname">'+v.name.substr(0,8)+'</div>'

                  if(v.private==1) cgcontent+='<a class="pop_col_foldlock"></a>'
                    cgcontent+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn " >上传</a>'
                  +'</li>'
                })
                $('.pop_col_colum_new',upload_outer).html(cgcontent)
                $.each(json.data.folder,function(index,v){
                  afolder += '<li class="pop_col_colum_on clearfix" folder_id='+v.id+' style="cursor:pointer" onclick="allimg_upload(this)">'
                    +'<div class="pop_col_colava">'
                      +'<img src="'+v.image_url+'" alt="">'
                    +'</div>'
                    +'<div class="pop_col_colname">'+v.name.substr(0,8)+'</div>'
                    if(v.private==1) afolder+='<a class="pop_col_foldlock"></a>'
                    afolder+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn " >上传</a>'
                  +'</li>'
                  proposals[index] = v.name
                })
                $('.pop_col_colum_all',upload_outer).html(afolder)
              }else{
                layer.msg(json.message, {icon: 5});
                return
              }
            },
            'complete':function(){
              layer.closeAll('loading');
            }
          })
    if(cx == 0){
      //自动补全
        $('#search_upload_outer').autocomplete({
            hints: proposals,
            width: 218,
            height: 36,
            onSubmit: function(text){
              var pop_col_colum_all_li =  $('.pop_col_colum_all li',upload_outer)
              $.each(pop_col_colum_all_li,function(index,v){
                if(pop_col_colum_all_li.eq(index).find('.pop_col_colname').html()==text){
                  $('#search_upload').html(pop_col_colum_all_li.eq(index).clone())
                  return
                }
              })  
            }
          });
        cx = 1;
    }
    $('.pop_addpic_wrap input').change(function(){
        var imgcon = $('.pop_pic_wrap');
        var obj = $(this)
        if(this.files.length > 5){
          layer.msg('上传图片个数不能超过5个',{'icon':5})
          obj.val('')
          obj.parents('.pop_addpic_con').find('.pop_addpic_wrap:gt(0)').remove()
          return
        }

        
        obj.parents('.pop_addpic_con').find('.pop_addpic_wrap:gt(0)').remove()
        for (var i = 0; i < this.files.length; i++) {
          if (this.files[i]) {
            var filename = this.files[i].name;
            var subfile = filename.split('.');
            var subfilelen = subfile.length;
            var last = subfile[subfilelen-1].toLowerCase();
            var tp ="jpg,gif,bmp,png,jpeg";
            var rs=tp.indexOf(last);
              if(rs>=0){
                  var file_url = getObjectURL(this.files[i]);
                  var appendnewNode = '<div class="pop_addpic_wrap">\
                                <span class="close_img_btn">×</span>\
                                <img src="'+file_url+'" alt="">\
                                <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]" >'+subfile[0]+'</textarea>\
                              </div>';
                  obj.parents('.pop_addpic_con').append(appendnewNode)

                  $('.close_img_btn').click(function(){
                    $(this).parents('.pop_addpic_wrap').remove()
                  })

                  $('.pop_addpic_wrap .pop_addfont_wrap').click(function(){
                      $(this).animate({height:"40px"})
                  }).blur(function(){
                      $(this).animate({height:"20px"})
                  })

              }else{
                  layer.msg('您选择的上传文件不是有效的图片文件！请重新选择',{'icon':5})
                  obj.val('')
                  obj.parents('.pop_addpic_con').find('.pop_addpic_wrap:gt(0)').remove()
                  return false;
              }
            }
        }
      });
    $('.pop_addpic_multi,.pop_close,.detail_pop_cancel').click(function(){
        $('.pop_addpic_multi').remove();
      })
    $('.pop_addpic_multi .pop_con').click(function(){
      event.stopPropagation()
    })


})

  //添加文件夹
  $('.popc,#show_folder_add').click(function(){
    if(u_id==''){
      layer.msg('需要登录',{'icon':5})
      return
    }
    $('.pop_addfold').show()
    $('#upload_outer').hide()
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
        'fid':10000,'user_id':u_id
      },
      'dataType':'json',
      'success':function(json){
        if(json.code==200){
          layer.msg('创建成功', {icon: 6});
          setTimeout(function(){
            location.reload()
          },1000)
          
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
    if(u_id==''){
      layer.msg('需要登录',{'icon':5})
      return
    }
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
  // 上传商品点击
  $('#geturl').click(function(){
        if($('#pop_ipt_goods').val().trim()==''){
          layer.msg('地址不能为空',{'icon':5})
          return 
        }
        $('.pop_uploadgoods').hide();
        $.ajax({
          'beforeSend':function(){
            layer.load(0, {shade: 0.5});
          },
          'url':"/webd/taobao/detail",
          'type':'get',
          'data':{
            'url':$('#pop_ipt_goods').val().trim()
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
              detail_url = $('#pop_ipt_goods').val().trim()
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

              $.post('/webd/pics/cgoods',{'user_id':u_id},function(json){
                  if(json.code==200){
                    var option = ''
                    /*$.each(json.data.cg,function(i,v){
                        option += '<option value="'+v.id+'">'+v.name+'</option>'
                    })*/
                    $.each(json.data.folder,function(i,v){
                        option += '<option value="'+v.id+'">'+v.name+'</option>'
                    })
                    if(json.folder==0) option = '<option>没有文件</option>'
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

// 上传vr
 $('.header_more_a5').click(function(){
    if(u_id==''){
      layer.msg('需要登录',{'icon':5})
      return
    }
    $.ajax({
          'beforeSend':function(){
            layer.load(0, {shade: 0.5});
          },
          'url':"/webd/pics/cgoods",
          'type':'post',
          'data':{
            'user_id':u_id
          },
          'dataType':'json',
          'success':function(json){
            if(json.code==200){
              $('.pop_uploadvr .pop_labelselect').html('')
              strs = ''
              $.each(json.data.folder,function(index,v){
                strs += '<option value="'+v.id+'">'+v.name+'</option>';
              })
              $('.pop_uploadvr .pop_labelselect').append(strs)
            }else{
              layer.msg(json.message, {icon: 5});
              return
            }
          },
          'complete':function(){
            layer.closeAll('loading');
          }
    })
    $('.pop_uploadvr').show();
    var poptopHei = $('.pop_uploadvr .pop_con').height();
    $('.pop_uploadvr .pop_con').css({
       'margin-top':-(poptopHei/2)
    })
    //vr change
    $("#fvr").on("change",function(){
        var filePath=$('#fvr').val();
        if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1){
            var arr=filePath.split('\\');
            var fileName=arr[arr.length-1];
            var file = fileName.substring(0,fileName.lastIndexOf('.'))
            files = getObjectURL(this.files[0]);
            $('.pop_vrimgwrap img').attr('src',files)

        }else{
            layer.msg('文件类型不正确', {icon: 5});
            return false 
        }
    })
    
    // 保存上传
    $('form[name=uvr]').submit(function(){
        uvr = $('form[name=uvr]').serialize()
        $(this).ajaxSubmit({
          type:"post",  //提交方式
          dataType:"json", //数据类型
          url:"/webd/folder/uvr", //请求url
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
    $('#uvr').click(function(){
      if($('#fvr').val()==''){
            layer.msg('没有选择图片', {icon: 5});
            return
      }
      $('form[name=uvr]').submit()
    })
      
  });
  $('.pop_uploadvr,.pop_close,.pop_uploadvr .detail_pop_cancel').click(function(){
    $('.pop_uploadvr').hide();
  })
  $('.pop_uploadvr .pop_con').click(function(){
    event.stopPropagation()
  })



})
