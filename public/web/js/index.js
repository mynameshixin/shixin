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
          $(obj).parents('.p_collect').hide()
          layer.msg('保存成功', {icon: 6});
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
              +'<div class="pop_col_colname">'+v.name.substr(0,6)+'</div>'

            if(v.private==1) cgcontent+='<a class="pop_col_foldlock"></a>'
              cgcontent+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn" >保存</a>'
            +'</li>'
          })
          $('.pop_col_colum_new',collect_outer).html(cgcontent)
          $.each(json.data.folder,function(index,v){
            afolder += '<li class="pop_col_colum_on clearfix" folder_id='+v.id+' style="cursor:pointer" onclick="c_function(this)">'
              +'<div class="pop_col_colava">'
                +'<img src="'+v.image_url+'" alt="">'
              +'</div>'
              +'<div class="pop_col_colname">'+v.name.substr(0,6)+'</div>'
              if(v.private==1) afolder+='<a class="pop_col_foldlock"></a>'
              afolder+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn" >保存</a>'
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
  //采集创建文件夹并保存点击按钮
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

        var folder_id = json.data.folder_id
        var good_id = $('#collect_outer').attr('img_id')
        // 采集
        $.ajax({
          'url':"/webd/pics/cpic",
          'type':'post',
          'data':{
            'folder_id':folder_id,
            'good_id':good_id,
            'action':1,
            'user_id':u_id
          },
          'dataType':'json',
          'success':function(json){
            if(json.code==200){
              layer.msg('保存成功', {icon: 6});
              $('#folder_outer').hide()
            }else{
              layer.msg(json.message, {icon: 5});
              return
            }
          }
        })
        
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
                    +'<div class="pop_col_colname">'+v.name.substr(0,6)+'</div>'

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
                    +'<div class="pop_col_colname">'+v.name.substr(0,6)+'</div>'
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

// 上传图片添加文件夹
$('#show_folder_add').click(function(){
    $('#pic_folder_outer').show()
    $('#upload_outer').hide()
})

// 上传商品添加文件夹
$('#show_good_add').click(function(){
    $('#good_folder_outer').show()
    $('.pop_goods_upload').hide()
})

$('#pic_folder_outer .pop_iptprivacy').click(function(){
      if($(this).attr('checked') == 'checkbox') return
      if($(this).attr('private') == 1){
        $(this).attr('private',0)
      }else{
        $(this).attr('private',1)
      }
 })
$('#good_folder_outer .pop_iptprivacy').click(function(){
      if($(this).attr('checked') == 'checkbox') return
      if($(this).attr('private') == 1){
        $(this).attr('private',0)
      }else{
        $(this).attr('private',1)
      }
 })
//创建点击按钮
$('#pic_cfolder').click(function(){
  var pop_con = $(this).parents('.pop_con')
  var name = $('input[name=fname]',pop_con).val().trim()
  var description = $('textarea',pop_con).val().trim()
  var private = $('input[name=private]',pop_con).attr('private')
  if(name=='') {
    layer.msg('信息没有填写完全', {icon: 5});
    return 
  }
  var folder_id = ''
  //创建
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
      // if(json.code==200){
        // 文件夹不存在
        folder_id = json.data.folder_id
        // 上传图片
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
                      layer.msg('文件夹创建成功', {icon: 6});
                      setTimeout(function(){
                        location.reload()
                      },1000)
                      return
                    } 
                },
                resetForm:1
          });
      // }
    },
    'complete':function(){
      layer.closeAll('loading');
    }
  })
  
})

//上传并创建文件夹点击按钮
$('#pic_cgood').click(function(){
  var pop_con = $(this).parents('.pop_con')
  var name = $('input[name=fname]',pop_con).val().trim()
  var description = $('textarea',pop_con).val().trim()
  var private = $('input[name=private]',pop_con).attr('private')
  if(name=='') {
    layer.msg('信息没有填写完全', {icon: 5});
    return 
  }
  var folder_id = ''
  //创建
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

        folder_id = json.data.folder_id
        // 上传商品
        var u_b = $('form[name=u_b]')
        var title = $('input[name=title]',u_b).val().trim()
        var reserve_price = $('input[name=reserve_price]',u_b).val().trim()
        var description = $('input[name=description]',u_b).val().trim()
        var detail_url = $('input[name=detail_url]',u_b).val().trim()
        var image_ids = $('input[name=image_ids]',u_b).val().trim()
        $.ajax({
          data:{'fid':folder_id,'user_id':u_id,'kind':1,'title':title,'reserve_price':reserve_price,'description':description,'detail_url':detail_url,'image_ids':image_ids},
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
        });
        return false
    },
    'complete':function(){
      layer.closeAll('loading');
    }
  })
  
})

  //添加文件夹
  $('.popc').click(function(){
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
    $('.pop_goodsupload').hide()
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
  var cgeturl = 0
  $('#geturl').click(function(){

        if($('#pop_ipt_goods').val().trim()==''){
          layer.msg('地址不能为空',{'icon':5})
          return 
        }
        $('#search_fgood input').val('')
        var sfoldername = []
        //$('.pop_goods_upload').show();
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
                    $.each(json.data.folder,function(i,v){
                        option += '<option value="'+v.id+'" name="'+v.name+'">'+v.name+'</option>'
                        sfoldername[i] = v.name
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
        //自动补全
      if(cgeturl == 0){
            $('#search_fgood').autocomplete({
                hints: sfoldername,
                width: 188,
                height: 30,
                onSubmit: function(text){
                  if($.inArray(text,sfoldername)!=-1){
                    $('.pop_goods_upload .pop_iptselect').find('option[name='+text+']').attr('selected',1)
                  }
                }
            });
            cgeturl = 1
        }
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
var cfvr_new = 0
 $('.header_more_a5').click(function(){
    if(u_id==''){
      layer.msg('需要登录',{'icon':5})
      return
    }
    $('#search_fvr input').val('')
    var sfoldername = []
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
                strs += '<option value="'+v.id+'" name="'+v.name+'">'+v.name+'</option>';
                sfoldername[index] = v.name
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
    //自动补全
    if(cfvr_new == 0){
          $('#search_fvr').autocomplete({
              hints: sfoldername,
              width: 188,
              height: 30,
              onSubmit: function(text){
                if($.inArray(text,sfoldername)!=-1){
                  $('.pop_uploadvr .pop_labelselect').find('option[name='+text+']').attr('selected',1)
                }
              }
          });
          cfvr_new = 1
      }
    $('.pop_uploadvr').show();
    var poptopHei = $('.pop_uploadvr .pop_con').height();
    $('.pop_uploadvr .pop_con').css({
       'margin-top':-(poptopHei/2)
    })
    //vr change
    $("#fvr").on("change",function(){
        var filePath=$(this).val();
        if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1){
            var arr=filePath.split('\\');
            var fileName=arr[arr.length-1];
            var file = fileName.substring(0,fileName.lastIndexOf('.'))
            files = getObjectURL(this.files[0]);
            $(this).parents('.pop_vrchangewrap').find('.pop_vrimgwrap img').attr('src',files)

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
          //resetForm:1
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
  
// 上传出清商品
 $('.popd').click(function(){
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
              $('.pop_uploadcg .pop_labelselect').html('')
              strs = ''
              $.each(json.data.folder,function(index,v){
                strs += '<option value="'+v.id+'" name="'+v.name+'">'+v.name+'</option>';
              })
              $('.pop_uploadcg .pop_labelselect').append(strs)
            }else{
              layer.msg(json.message, {icon: 5});
              return
            }
          },
          'complete':function(){
            layer.closeAll('loading');
          }
    })

    $('.pop_uploadcg').show();
    var poptopHei = $('.pop_uploadcg .pop_con').height();
    $('.pop_uploadcg .pop_con').css({
       'margin-top':-(poptopHei/2)
    })
    var tags = [
    {"name":"三人沙发","pid":1},{"name":"双人沙发","pid":1},{"name":"单人沙发","pid":1},{"name":"沙发床","pid":1},{"name":"布艺沙发","pid":1},{"name":"皮质沙发","pid":1},{"name":"古典沙发","pid":1},{"name":"现代沙发","pid":1},{"name":"美式沙发","pid":1},{"name":"东南亚沙发","pid":1},{"name":"简欧沙发","pid":1},{"name":"日式沙发","pid":1},
    {"name":"餐桌","pid":2},{"name":"书桌","pid":2},{"name":"茶几","pid":2},{"name":"办公桌","pid":2},{"name":"梳妆台","pid":2},{"name":"吧台","pid":2},{"name":"会议桌","pid":2},{"name":"沙发桌","pid":2},{"name":"咖啡桌","pid":2},
    {"name":"双人床","pid":3},{"name":"儿童床","pid":3},{"name":"单人床","pid":3},{"name":"实木床","pid":3},{"name":"板式床","pid":3},{"name":"铁艺床","pid":3},{"name":"水床","pid":3},{"name":"吊床","pid":3},{"name":"榻榻米床","pid":3},{"name":"欧式床","pid":3},{"name":"折叠床","pid":3},{"name":"美式床","pid":3},{"name":"地中海床","pid":3},{"name":"高低床","pid":3},
    {"name":"电视柜","pid":4},{"name":"衣柜","pid":4},{"name":"书柜","pid":4},{"name":"床头柜","pid":4},{"name":"浴室柜","pid":4},{"name":"酒柜","pid":4},{"name":"玄关柜","pid":4},{"name":"五斗柜","pid":4},{"name":"厨柜","pid":4},{"name":"餐边柜","pid":4},{"name":"餐具柜","pid":4},{"name":"食品柜","pid":4},{"name":"文件柜","pid":4},{"name":"组合柜","pid":4},{"name":"吧柜","pid":4},
    {"name":"书架","pid":5},{"name":"鞋架","pid":5},{"name":"衣帽架","pid":5},{"name":"花架","pid":5},{"name":"伞架","pid":5},{"name":"博古架","pid":5},{"name":"格架","pid":5},
    {"name":"摆件","pid":6},{"name":"镜子","pid":6},{"name":"钟","pid":6},{"name":"装置画","pid":6},{"name":"香薰","pid":6},{"name":"挂钩","pid":6},{"name":"收纳","pid":6},{"name":"相框","pid":6},
    {"name":"台灯","pid":7},{"name":"吊灯","pid":7},{"name":"壁灯","pid":7},{"name":"户外灯","pid":7},{"name":"镜前灯","pid":7},{"name":"吸顶灯","pid":7},{"name":"创意","pid":7},{"name":"落地灯","pid":7},{"name":"厨卫灯","pid":7},{"name":"水晶灯","pid":7},{"name":"铜灯","pid":7},
    {"name":"阳台灯","pid":7},
    {"name":"床品","pid":8},{"name":"抱枕","pid":8},{"name":"布料","pid":8},{"name":"窗帘","pid":8},{"name":"坐垫","pid":8},{"name":"桌布","pid":8},{"name":"枕头","pid":8},{"name":"桌旗","pid":8},{"name":"靠垫","pid":8},{"name":"地毯","pid":8},
    {"name":"浴帘","pid":9},{"name":"浴巾","pid":9},{"name":"衣架","pid":9},{"name":"洗漱套瓶","pid":9},{"name":"杯子","pid":9},{"name":"马桶垫","pid":9},{"name":"防滑垫","pid":9},{"name":"毛巾架","pid":9},{"name":"毛巾环","pid":9},
    {"name":"多肉植物","pid":10},{"name":"花瓶","pid":10},{"name":"花盆","pid":10},{"name":"仿真花","pid":10},{"name":"鲜花","pid":10},{"name":"干花","pid":10},{"name":"水景","pid":10},{"name":"野兽派","pid":10},{"name":"RoseOnly","pid":10},
    {"name":"餐具","pid":11},{"name":"盘子","pid":11},{"name":"杯子","pid":11},{"name":"勺子","pid":11},{"name":"刀叉","pid":11},{"name":"碟子","pid":11},{"name":"碗架","pid":11},
    {"name":"隔断","pid":12},{"name":"窗帘","pid":12},{"name":"沐浴","pid":12},{"name":"浴缸","pid":12}
    ];
    $('select[name=f_select]').change(function(){
      var value  = $(this).val()
      var str = $(this).find('option:selected').html()
      var s = ''
      $.each(tags,function(i,v){
        if(v.pid==value){
          s+= '<option>'+v.name+'</option>'
        }
      })
      $('select[name=s_select]').html(s)
      var f = $('select[name=s_select]').find('option:selected').html()
      $('input[name=tags]').val(str+f)
      
    })

    $('select[name=s_select]').change(function(){
      var str = $('select[name=f_select]').find('option:selected').html()
      var f = $(this).find('option:selected').html()
      $('input[name=tags]').val(str+f)
      
    })


    
    
    // 保存上传
    $('form[name=ucq]').submit(function(){
        $(this).ajaxSubmit({
          type:"post",  //提交方式
          dataType:"json", //数据类型
          url:"/webd/cq/ucq", //请求url
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
          //resetForm:1
        });
        return false
    })
    $('#ucq').click(function(){
      $('form[name=ucq]').submit()
    })
      
  });
  

  
})
