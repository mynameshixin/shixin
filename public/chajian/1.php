 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>堆图家，链接全球家居资源(家居、室内设计、商品、美图、VR)</title>
  <meta name="keywords" content="堆图家,家居,室内设计,商品,美图,软装,建筑,装修,VR,设计,人物,数据"/> 
  <meta name="description" content="堆图家,带你搜集你喜欢的家居,你可以用它搜集灵感图片,发布VR,保存素材,晒晒喜欢的家居"/> 
  <link rel="shortcut icon" href="/logo.ico">
  <link rel="stylesheet" type="text/css" href="http://www.duitujia.com/web/css/font-awesome.min.css">
  <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="http://www.duitujia.com/public/web/css/font-awesome-ie7.min.css">
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="http://www.duitujia.com/web/css/main.css">
  <link rel="stylesheet" type="text/css" href="http://www.duitujia.com/web/css/index.css">
  <script type="text/javascript" src="http://www.duitujia.com/web/js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="http://www.duitujia.com/web/js/jquery.lazyload.js"></script>
  <script type="text/javascript" src="http://www.duitujia.com/web/js/jquery.form.js"></script>
  <script type="text/javascript" src="http://www.duitujia.com/web/plugins/Masonry/masonry-docs.min.js"></script>
  <script type="text/javascript" src="http://www.duitujia.com/web/js/nolog.js"></script>
  <script type="text/javascript" src="http://www.duitujia.com/web/js/index.js"></script>
  <script type="text/javascript">
    function rect(obj){
      marginLeft = ($(obj).parent().width()-$(obj).width())/2
      marginTop = ($(obj).parent().height()-$(obj).height())/2

      $(obj).css({
        'margin-left':marginLeft,
        'margin-top':marginTop
      })
    }
    function layer_error(str){
      str = str!=''?str:'该功能仍在建设中'
      layer.msg(str, {icon: 5});
      return false;
    }
    function getObjectURL(file) {
      var url = null ; 
      if (window.createObjectURL!=undefined) { // basic
        url = window.createObjectURL(file) ;
      } else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
      } else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
      }
      return url ;
    }
  </script>
</head>
<body class="nolog_body">

 
  <script type="text/javascript" src="http://www.duitujia.com/web/js/autocomplete.js"></script>
<style type="text/css">
  .autocomplete-container {
    position: relative;
    width: 190px;
    height: 32px;
    margin: 0 auto;
    display: inline-block;
  }

  .autocomplete-input {
    width: 218px;
      height: 36px;
      background: #f0f0f0;
      border-radius: 3px;
      border: none
  }

  .autocomplete-button {
    font-family: inherit;
    border: none;
    background-color: #990101;
    color: white;
    padding: 8px;
    float: left;
    cursor: pointer;
    border-radius: 0px 3px 3px 0px;
    transition: all 0.2s ease-out 0s;
    margin: 0.5px 0px 0px -1px;
  }

  .autocomplete-button:HOVER {
    background-color: #D11E1E;
  }
  #search_form_outer,#search_upload_outer{
    display: inline-block;
    position: absolute;
      left: 40px;
      top: 0;
      z-index: 100
  }
  .proposal-box {
    position: absolute;
    height: auto;
    border-left: 1px solid rgba(0, 0, 0, 0.11);
    border-right: 1px solid rgba(0, 0, 0, 0.11);
    left: 0px;
  }

  .proposal-list {
    list-style: none;
    box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.44);
    -webkit-margin-before: 0em;
    -webkit-margin-after: 0em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    -webkit-padding-start: 0px;
  }

  .proposal-list li {
    text-align: left;
    padding: 5px;
    font-size: 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.16);
    height: 25px;
    line-height: 25px;
    background-color: rgba(255, 255, 255, 1);
    cursor: pointer;
  }

  li.proposal.selected {
    background-color: rgba(175, 175, 175, 1);
    color: white;
  }

  #search-box {
    position: relative;
    width: 400px;
    margin: 0 auto;
    display: inline;
  }

  #message {

  }
  </style>
  <!-- 上传图片 -->

    
      <div style="">
<a href="javascript:;" class="nolog_land_btn" style="position:fixed;top:300px;left:300px;width:100px;">请先登录</a>
</div>
 
 
    

 <div class="pop_login pop_login1" style="display:none;" login="1">
    <div class="pop_con" style="margin-left: -250px">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="http://www.duitujia.com/static/web/images/index-img/pop_logo.png" height="87" width="108" alt="堆图家">
        <!-- <span class="pop_close"></span> -->
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
          <a href="javascript:;" class="pop_login_confirm" id="confirm1" title="堆图家确定">确定</a>
          <p class="pop_login_des">
            注册即表示同意<a href="/webd/contact/protocol" target="_blank">《用户使用条款及服务协议》</a>
          </p>
        </div>
      </div>
      
    </div>
  </div>
  <div class="pop_login pop_login2" style="display:none">
    <div class="pop_con" style="margin-left: -250px">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="http://www.duitujia.com/static/web/images/index-img/pop_logo.png" height="87" width="108" alt="堆图家">
        <span class="pop_close"></span>
      </p>
      <div class="pop_login_wrap clearfix">
        <div class="pop_login_contit">
          使用第三方账号登录
        </div>
        <div class="pop_login_conother">
          <a href="/webd/tlogin/weibo?rurl=%2F" target="_blank" title="微博"></a>
          <a href="/webd/tlogin/wechat?rurl=%2F" target="_blank" title="微信"></a>
          <a href="/webd/tlogin/qq?rurl=%2F" target="_blank" title="qq"></a>
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
          <a href="javascript:;" class="pop_login_confirm" id="confirm2" title="堆图家确定">确定</a>
          <p class="pop_login_des">
            <a href="javascript:;" id="forgetpwd" title="堆图家忘记密码">忘记密码&nbsp;》</a>
            <span class="pop_login_desw" style="float: right;">
            还没有堆图家账号？<a href="javascript:;" id="register" title="堆图家点击注册">点击注册&nbsp;》</a>
            </span>
          </p>
        </div>
      </div>
      
    </div>
  </div>
  <div class="pop_login pop_login3" style="display:none" login="2">
    <div class="pop_con" style="margin-left: -250px">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="http://www.duitujia.com/static/web/images/index-img/pop_logo.png" height="87" width="108" alt="堆图家">
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
          <a href="javascript:;" class="pop_login_confirm" style="margin-bottom: 21px;" id="confirm3" title="堆图家确定">确定</a>
          
        </div>
      </div>
      
    </div>
  </div>

  <
  <!-- 注册和登陆的js -->
<script type="text/javascript">
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
      </script>
<script type="text/javascript" src="http://www.duitujia.com/chajian/caijidenglu.js"></script></body>
<script type="text/javascript" src="http://www.duitujia.com/static/layer/layer.js"></script>
</html>