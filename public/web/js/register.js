    $(function() {
      //注册
      popFun($('.nolog_login_btn'),$('.pop_login1,.pop_close'),$('.pop_login1'),$('.pop_login1 .pop_con'))
      //popFun($('.nolog_login_btn'),$('.pop_login3,.pop_close,.pop_login_confirm'),$('.pop_login3'),$('.pop_login3 .pop_con'))
      // 登陆
      popFun($('.nolog_land_btn'),$('.pop_login2,.pop_close'),$('.pop_login2'),$('.pop_login2 .pop_con'))
      // popFun($('.nolog_login_btn'),$('.pop_login4,.pop_close,.pop_login_confirm'),$('.pop_login4'),$('.pop_login4 .pop_con'))
      function popFun(popbtn,hidebtn,popcon,stopbtn){
        popbtn.click(function(event) {
          popcon.show();
        });
        hidebtn.click(function(event) {
          popcon.hide();
        });
        stopbtn.click(function(event) {
          event.stopPropagation()
        });
      }
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
        mobile = $('input[name=mobile]').val().trim()
        if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(mobile)){
          layer.msg('手机格式不正确', {icon: 5});
          return 
        }
        $.ajax({
          'dataType':'json',
          'data':{'mobile':mobile,'type':1},
          'type':'post',
          'url':'/api/mobile/captcha',
          'success':function(json){
            if(json.code==200){
              $('.pop_login_pb').find('strong').html(60)
              $('.pop_login_e').attr('disabled','disabled')
              $('.pop_login_pa').show()
              $('.pop_login_pb').show()
              var i = 60
              var t = setInterval(function(){
                n = --i
                if(n == 0){
                  clearInterval(t)
                  $('.pop_login_e').removeAttr('disabled')
                  $('.pop_login_pa').hide()
                  $('.pop_login_pb').hide()
                }
                $('.pop_login_pb').find('strong').html(n)
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
      //登陆确定
      $('#confirm2').click(function(){
        $pa = $('.pop_login2') 
        account = $('input[name=account]',$pa).val().trim()
        password = $('input[name=password]',$pa).val().trim()
        if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(account)){
          layer.msg('不是一个有效的手机号', {icon: 5});
          return 
        }
        $.ajax({
          'beforeSend':function(){
            layer.load(0, {shade: 0.5});
          },
          'dataType':'json',
          'data':{'account':account,'password':password},
          'type':'post',
          'url':'/webd/home/login',
          'success':function(json){
            if(json.code==200){
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