    $(function() {



      //弹出新创口
       /** 
      * 以POST表单方式打开新窗口的JQUERY实现 
      @param:url 需要打开的URL 
      @param:args URL的参数，数据类型为object 
      @param:name 打开URL窗口的名字，如果同一按钮需要重复地打开新窗口， 
      而不是在第一次打开的窗口做刷新，此参数应每次不同 
      @param:windowParam 新打开窗口的参数配置 
      * @author: haijiang.mo 
      */ 
      function jQueryOpenPostWindow(url,args,name,windowParam){ 
      var windowDefaultConfig = new Object; 
      windowDefaultConfig['directories'] = 'no'; 
      windowDefaultConfig['location'] = 'no'; 
      windowDefaultConfig['menubar'] = 'no'; 
      windowDefaultConfig['resizable'] = 'no'; 
      windowDefaultConfig['scrollbars'] = 'no'; 
      windowDefaultConfig['status'] = 'no'; 
      windowDefaultConfig['toolbar'] = 'no'; 
     
      //创建表单对象 
      var _form = $("<form></form>",{ 
      'id':'tempForm',  
      'method':'post', 
      'action':url, 
      'target':name, 
      'style':'display:none' 
      }).appendTo($("body")); 
       
      //将隐藏域加入表单 
      for(var i in args){ 
      _form.append($("<input>",{'type':'hidden','name':i,'value':args[i]})); 
      } 
       
      //克隆窗口参数对象 
      var windowConfig = windowDefaultConfig; 
       
      //配置窗口 
      for(var i in windowParam){ 
      windowConfig[i] = windowParam[i]; 
      } 
       
      //窗口配置字符串 
      var windowConfigStr = ""; 
       
      for(var i in windowConfig){ 
      windowConfigStr += i+"="+windowConfig[i]+","; 
      } 
       
      //绑定提交触发事件 
      _form.bind('submit',function(){ 
      window.open("about:blank",name,windowConfigStr); 
      }); 
       
      //触发提交事件 
      _form.trigger("submit"); 
      //表单删除 
      _form.remove(); 
      } 



      //注册
      popFun($('.nolog_login_btn'),$('.pop_login1,.pop_close'),$('.pop_login1'),$('.pop_login1 .pop_con'))
      // popFun($('.nolog_login_btn'),$('.pop_login3,.pop_close,.pop_login_confirm'),$('.pop_login3'),$('.pop_login3 .pop_con'))
      // 登陆
      popFun($('.nolog_land_btn'),$('.pop_login2,.pop_close'),$('.pop_login2'),$('.pop_login2 .pop_con'))
      // popFun($('#register'),$('.pop_login4,.pop_close,.pop_login_confirm'),$('.pop_login4'),$('.pop_login4 .pop_con'))
      function popFun(popbtn,hidebtn,popcon,stopbtn){
        popbtn.click(function(event) {
          popcon.show();
          h = popcon.find('.pop_con').height()
          popcon.find('.pop_con').css({
           'margin-top':-(h/2)
          })

        });
        popbtn.click()
        hidebtn.click(function(event) {
          popcon.hide();
        });
        stopbtn.click(function(event) {
          event.stopPropagation()
        });
      }

      $('#register').click(function(){
        $('.pop_login2').hide();
        popcon = $('.pop_login1')
        popcon.show();
        h = popcon.find('.pop_con').height()
        popcon.find('.pop_con').css({
         'margin-top':-(h/2)
        })
      })
      $('#forgetpwd').click(function(){
        $('.pop_login2').hide();
        popcon = $('.pop_login3')
        popcon.show();
        h = popcon.find('.pop_con').height()
        popcon.find('.pop_con').css({
         'margin-top':-(h/2)
        })
      })
      $('.pop_close').click(function(){
        $('.pop_login3').hide()
      })
      $('.pop_login_c').keydown(function(event) {
        var inLen = $(this).val();
        if (inLen.length < 5) {
          $('.pop_login_safew').addClass('pop_login_safewlow');
        }else if(inLen.length < 10){
          $('.pop_login_safew').addClass('pop_login_safewmiddle');
        }else{
          $('.pop_login_safew').addClass('pop_login_safewhigh');
        };
      })
     
      //验证码
      $('.pop_login_e').click(function(){
        p = $(this).parents('.pop_login')
        var type = p.attr('login')
        mobile = $('input[name=mobile]',p).val().trim()
        if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(mobile)){
          layer.msg('手机格式不正确', {icon: 5});
          return 
        }
        $.ajax({
          'dataType':'json',
          'data':{'mobile':mobile,'type':type},
          'type':'post',
          'url':'/api/mobile/captcha',
          'success':function(json){
            if(json.code==200){
              $('.pop_login_pb',p).find('strong').html(60)
              $('.pop_login_e',p).attr('disabled','disabled')
              $('.pop_login_pa',p).show()
              $('.pop_login_pb',p).show()
              var i = 60
              var t = setInterval(function(){
                n = --i
                if(n == 0){
                  clearInterval(t)
                  $('.pop_login_e',p).removeAttr('disabled')
                  $('.pop_login_pa',p).hide()
                  $('.pop_login_pb',p).hide()
                }
                $('.pop_login_pb',p).find('strong').html(n)
              },1000)
            }else{
              message = json.message[1]!=undefined?json.message:json.message[0]
              layer.msg(message, {icon: 5});
            }
          }
        })
      })
      //注册确定
      $('#confirm1').click(function(){
        $pa = $('.pop_login1') 
        mobile = $('input[name=mobile]',$pa).val().trim()
        captcha = $('input[name=captcha]',$pa).val().trim()
        password = $('input[name=password]',$pa).val().trim()
        $.ajax({
          'beforeSend':function(){
            layer.load(0, {shade: 0.5});
          },
          'dataType':'json',
          'data':{'mobile':mobile,'captcha':captcha,'password':password},
          'type':'post',
          'url':'/api/register',
          'success':function(json){
            if(json.code==200){
              $.post('/webd/home/set',{'u':json.data.u},function(data){
                if(data.status==1) location.reload()
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

      //找回密码确定
      $('#confirm3').click(function(){
        $pa = $('.pop_login3') 
        mobile = $('input[name=mobile]',$pa).val().trim()
        captcha = $('input[name=captcha]',$pa).val().trim()
        password = $('input[name=password]',$pa).val().trim()
        repassword = $('input[name=repassword]',$pa).val().trim()
        if(password!=repassword){
          layer.msg('两次密码不一致', {icon: 5});
          return
        }
        $.ajax({
          'beforeSend':function(){
            layer.load(0, {shade: 0.5});
          },
          'dataType':'json',
          'data':{'mobile':mobile,'captcha':captcha,'password':password,'repassword':repassword},
          'type':'post',
          'url':'/webd/home/efpwd',
          'success':function(json){
            if(json.code==200){
              layer.msg('重置密码成功', {icon: 6});
              location.reload()
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
     


    });

