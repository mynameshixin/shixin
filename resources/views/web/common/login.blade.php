  <div class="pop_login pop_login1" style="display: none;" login="1">
    <div class="pop_con" style="margin-left: -250px">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="{{asset('/static/web/images/index-img/pop_logo.png')}}" height="87" width="108" alt="">
        <span class="pop_close"></span>
      </p>
      <div class="pop_login_wrap clearfix">
        <div class="pop_login_contit">
          使用手机注册
        </div>
        <div class="pop_login_content clearfix">
          <div class="pop_login_contwrap clearfix">
            <input class="pop_login_a" type="" name="" value="" placeholder="+86">
            <input class="pop_login_b" type="" name="mobile" value="" placeholder="请输入手机号">
          </div>
          <div class="pop_login_contwrap clearfix" style="margin-bottom: 0px;">
            <input class="pop_login_d" type="" name="captcha" value="" placeholder="请输入验证码">
            <input class="pop_login_e" type="button"  name="" value="获取短信验证码" >
          </div>
          <div class="pop_login_contwrap clearfix">
            <p class="pop_login_pa" style="display: none">验证码已发送至您的手机，请注意查收</p>
            <p class="pop_login_pb" style="display: none"><strong>60</strong>s后重新发送</p>
          </div>
          <div class="pop_login_contwrap clearfix" style="margin-bottom: 8px;">
            <input class="pop_login_c" type="password" name="password" value="" placeholder="请设置登录密码">
            <div class="pop_login_safew clearfix">
              <div class="pop_login_safe pop_login_safeh">高</div>
              <div class="pop_login_safe pop_login_safem">中</div>
              <div class="pop_login_safe pop_login_safel">低</div>
            </div>
          </div>
          <a href="javascript:;" class="pop_login_confirm" id="confirm1">确定</a>
          <p class="pop_login_des">
            注册即表示同意<a href="javascript:;">《用户使用条款及服务协议》</a>
          </p>
        </div>
      </div>
      
    </div>
  </div>
  <div class="pop_login pop_login2" style="display:none">
    <div class="pop_con" style="margin-left: -250px">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="{{asset('/static/web/images/index-img/pop_logo.png')}}" height="87" width="108" alt="">
        <span class="pop_close"></span>
      </p>
      <div class="pop_login_wrap clearfix">
        <div class="pop_login_contit">
          使用第三方账号登录
        </div>
        <div class="pop_login_conother">
          <a href="/webd/tlogin/weibo?rurl=<?php echo urlencode($_SERVER['REQUEST_URI']);?>" target="_blank"></a>
          <a href="/webd/tlogin/wechat?rurl=<?php echo urlencode($_SERVER['REQUEST_URI']);?>" target="_blank"></a>
          <a href="/webd/tlogin/qq?rurl=<?php echo urlencode($_SERVER['REQUEST_URI']);?>" target="_blank"></a>
          <a href="javascript:;" onclick="layer_error('该功能仍在建设中')" style="margin-right: 0px;"></a>
        </div>
        <div class="pop_login_contit">
          使用手机号登录
        </div>
        <div class="pop_login_content clearfix">
          <div class="pop_login_contwrap clearfix">
            <input class="pop_login_c" type="" name="account" value="" placeholder="堆图家注册手机号">
          </div>
          <div class="pop_login_contwrap">
            <input class="pop_login_c" type="password" name="password" value="" placeholder="堆图家注册密码">
          </div>
          <a href="javascript:;" class="pop_login_confirm" id="confirm2">确定</a>
          <p class="pop_login_des">
            <a href="javascript:;" id="forgetpwd">忘记密码&nbsp;》</a>
            <span class="pop_login_desw" style="float: right;">
            还没有堆图家账号？<a href="javascript:;" id="register">点击注册&nbsp;》</a>
            </span>
          </p>
        </div>
      </div>
      
    </div>
  </div>
  <div class="pop_login pop_login3" style="display:none" login="2">
    <div class="pop_con" style="margin-left: -250px">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="{{asset('/static/web/images/index-img/pop_logo.png')}}" height="87" width="108" alt="">
        <span class="pop_close"></span>
      </p>
      <div class="pop_login_wrap clearfix">
        <div class="pop_login_contit">
          找回密码
        </div>
        <div class="pop_login_content clearfix">
          <div class="pop_login_contwrap clearfix">
            <input class="pop_login_a" type="" name="" value="" placeholder="+86">
            <input class="pop_login_b" type="" name="mobile" value="" placeholder="请输入手机号">
          </div>
          <div class="pop_login_contwrap clearfix" style="margin-bottom: 0px;">
            <input class="pop_login_d" type="" name="captcha" value="" placeholder="请输入验证码">
            <input class="pop_login_e" type="button"  name="" value="获取短信验证码" >
          </div>
          <div class="pop_login_contwrap clearfix">
            <p class="pop_login_pa" style="display: none">验证码已发送至您的手机，请注意查收</p>
            <p class="pop_login_pb" style="display: none"><strong>60</strong>s后重新发送</p>
          </div>
          <div class="pop_login_contwrap clearfix" style="margin-bottom: 8px;">
            <input class="pop_login_c" type="password" name="password" value="" placeholder="请输入新密码">
            <div class="pop_login_safew clearfix">
              <div class="pop_login_safe pop_login_safeh">高</div>
              <div class="pop_login_safe pop_login_safem">中</div>
              <div class="pop_login_safe pop_login_safel">低</div>
            </div>
          </div>
          <div class="pop_login_contwrap clearfix">
            <input class="pop_login_c" type="password" name="repassword" value="" placeholder="再次输入新密码">
          </div>
          <a href="javascript:;" class="pop_login_confirm" style="margin-bottom: 21px;" id="confirm3">确定</a>
          
        </div>
      </div>
      
    </div>
  </div>

  <!-- 注册和登陆的js -->
<script type="text/javascript">
   <?php if(!empty($index) && $index == 1):?>
      $(window).scroll(function(event) {
        var scrollHei = $('body').scrollTop();
        if (scrollHei <= 272) {
          $('.header').addClass('slideup');
          $('.nolog_header').removeClass('slideup');
        }else{
          $('.nolog_header').addClass('slideup');
          $('.header').removeClass('slideup');
        };
      });
      <?php endif;?>
</script>
<script type="text/javascript" src="{{asset('web/js/register.js')}}"></script>