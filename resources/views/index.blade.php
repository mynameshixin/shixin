<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>堆图家</title>
  <link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/font-awesome.min.css">
  <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="{{asset('public/web')}}/css/font-awesome-ie7.min.css">
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/main.css">
  <link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/index.css">
  <script type="text/javascript" src="{{asset('web')}}/js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="{{asset('web')}}/plugins/Masonry/masonry-docs.min.js"></script>
  <script type="text/javascript" src="{{asset('web')}}/js/nolog.js"></script>
</head>
<body class="nolog_body">
  <div class="nolog_header">
    <div class="headercontainer w1248 clearfix">
      <a href="nolog_index.html" class="header_logo"></a>
      <a href="nolog_index.html" class="header_item header_item_on">首页</a>
      <a href="nolog_allfile.html" class="header_item">图集</a>
      <a href="javascript:;" class="header_item">发现</a>
      <a href="App.html" class="header_item">APP</a>
      <div href="javascript:;" class="header_add_btn">
        <div class="header_add_item">
          <div class="header_add_iwrap">
            <div class="header_add_up"></div>
            <div class="header_add_item_awrap">
              <a href="javascript:;" target="_blank" class="header_add_item_a header_more_a1">上传图片</a>
              <a href="javascript:;" target="_blank" class="header_add_item_a header_more_a2">上传商品</a>
              <a href="javascript:;" target="_blank" class="header_add_item_a header_more_a3">添加文件夹</a>
              <a href="tools.html" target="_blank" class="header_add_item_a header_more_a4">安装堆工具</a>
            </div>
            
          </div>
        </div>
      </div>
      <a href="javascript:;" class="nolog_land_btn">登录</a>
      <a href="javascript:;" class="nolog_login_btn">注册</a>
    </div>
  </div>
  <div class="header slideup">
    <div class="headercontainer w1248 clearfix">
      <a href="nolog_index.html" class="header_logo"></a>
      <a href="nolog_index.html" class="header_item">首页</a>
      <a href="nolog_allfile.html" class="header_item">图集</a>
      <a href="javascript:;" class="header_item">发现</a>
      <a href="App.html" class="header_item">APP</a>
      <div href="javascript:;" class="header_add_btn">
        <div class="header_add_item">
          <div class="header_add_iwrap">
            <div class="header_add_up"></div>
            <div class="header_add_item_awrap">
              <a href="javascript:;" target="_blank" class="header_add_item_a header_more_a1">上传图片</a>
              <a href="javascript:;" target="_blank" class="header_add_item_a header_more_a2">上传商品</a>
              <a href="javascript:;" target="_blank" class="header_add_item_a header_more_a3">添加文件夹</a>
              <a href="tools.html" target="_blank" class="header_add_item_a header_more_a4">安装堆工具</a>
            </div>
            
          </div>
        </div>
      </div>
      <input type="text" class="header_search" style="width: 645px;" placeholder="搜索你喜欢的">
      <a href="javascript:;" class="nolog_login_btn">注册</a>
      <a href="javascript:;" class="nolog_land_btn">登录</a>
    </div>
  </div>
  <div class="container nolog_index_container clearfix">
    <div class="nolog_index_banner" style="background: url({{ asset('/static/web/images/index-img/index-banner.jpg')}}) top center no-repeat">
      <div class="w1248 clearfix nolog_index_top">
        <p class="nolog_index_title">发现、采集、分享你喜欢的家居  </p>
        <div class="header_search_wrap clearfix">
          <input type="text" class="header_search header_search_indexnolog" placeholder="搜索你喜欢的">
        </div>
        <p class="nolog_index_subtit">热门搜索：<a href="javascript:;">沙发</a>、<a href="javascript:;">吊灯</a>、<a href="javascript:;">窗帘</a>、<a href="javascript:;">中式</a>、<a href="javascript:;">法式</a>、<a href="javascript:;">饰品</a></p>
      </div>
    </div>
    <div class="nolog_index_container">
      <div class="w1248 clearfix">
        <div class="nolog_index_contit">
          行家推荐
        </div>
        <div class="nolog_index_conexpert clearfix">
          <div class="nolog_index_conexinfo">
            <div class="nolog_index_conexava">
              <img src="{{ asset('/static/web/images/index-img/p1.jpeg')}}" height="135" width="135" alt="">
            </div>
            <div class="nolog_index_conrel">
              <p class="nolog_index_conexname">喵星人</p>
              <p class="nolog_index_conexfans">58粉丝</p>
              <p class="nolog_index_conexwork"><商家></p>
            </div>
          </div>
          <div class="nolog_index_conexinfo">
            <div class="nolog_index_conexava">
              <img src="{{ asset('/static/web/images/index-img/p2.jpeg')}}" height="135" width="135" alt="">
            </div>
            <div class="nolog_index_conrel">
              <p class="nolog_index_conexname">喵星人</p>
              <p class="nolog_index_conexfans">58粉丝</p>
              <p class="nolog_index_conexwork"><商家></p>
            </div>
          </div>
          <div class="nolog_index_conexinfo">
            <div class="nolog_index_conexava">
              <img src="{{ asset('/static/web/images/index-img/p3.jpeg')}}" height="135" width="135" alt="">
            </div>
            <div class="nolog_index_conrel">
              <p class="nolog_index_conexname">喵星人</p>
              <p class="nolog_index_conexfans">58粉丝</p>
              <p class="nolog_index_conexwork"><商家></p>
            </div>
          </div>
          <div class="nolog_index_conexinfo">
            <div class="nolog_index_conexava">
              <img src="{{ asset('/static/web/images/index-img/p4.png')}}" height="135" width="135" alt="">
            </div>
            <div class="nolog_index_conrel">
              <p class="nolog_index_conexname">喵星人</p>
              <p class="nolog_index_conexfans">58粉丝</p>
              <p class="nolog_index_conexwork"><商家></p>
            </div>
          </div>
          <div class="nolog_index_conexinfo mrightzero">
            <div class="nolog_index_conexava">
              <img src="{{ asset('/static/web/images/index-img/p5.jpeg')}}" height="135" width="135" alt="">
            </div>
            <div class="nolog_index_conrel">
              <p class="nolog_index_conexname">喵星人</p>
              <p class="nolog_index_conexfans">58粉丝</p>
              <p class="nolog_index_conexwork"><商家></p>
            </div>
          </div>
        </div>
        <div class="nolog_index_contit">
          为您推荐
        </div>
        <div class="nolog_index_conreco clearfix">
          <div class="nolog_index_conrecbox">
            <img src="{{ asset('/static/web/images/index-img/list-1.jpg')}}" alt="">
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="javascript:;">王先生王先生王先生</a>
              </p>
              <p class="nolog_index_conrecfans">
                212文件&nbsp;&nbsp;912粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="javascript:;">恩娘娘</a>
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="javascript:;">王先生王先生王先生</a>
              </p>
              <p class="nolog_index_conrecfans">
                212文件&nbsp;&nbsp;912粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="javascript:;">恩娘娘</a>
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox">
            <img src="{{ asset('/static/web/images/index-img/list-2.jpg')}}" alt="">
          </div>
          <div class="nolog_index_conrecbox">
            <img src="{{ asset('/static/web/images/index-img/list-3.jpg')}}" alt="">
          </div>
          <div class="nolog_index_conrecbox nolog_index_conrecone mrightzero">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="javascript:;">王先生王先生王先生</a>
              </p>
              <p class="nolog_index_conrecfans">
                212文件&nbsp;&nbsp;912粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="javascript:;">恩娘娘</a>
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              
            </div>
          </div>
          <div class="nolog_index_conrecbox nolog_index_conrecone">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="javascript:;">王先生王先生王先生</a>
              </p>
              <p class="nolog_index_conrecfans">
                212文件&nbsp;&nbsp;912粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="javascript:;">恩娘娘</a>
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox">
            <img src="{{ asset('/static/web/images/index-img/list-3.jpg')}}" alt="">
          </div>
          <div class="nolog_index_conrecbox">
            <img src="{{ asset('/static/web/images/index-img/list-2.jpg')}}" alt="">
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="javascript:;">王先生王先生王先生</a>
              </p>
              <p class="nolog_index_conrecfans">
                212文件&nbsp;&nbsp;912粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="javascript:;">恩娘娘</a>
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="javascript:;">王先生王先生王先生</a>
              </p>
              <p class="nolog_index_conrecfans">
                212文件&nbsp;&nbsp;912粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="javascript:;">恩娘娘</a>
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox mrightzero">
            <img src="{{ asset('/static/web/images/index-img/list-3.jpg')}}" alt="">
          </div>
        </div>
        <a href="#" class="nolog_index_conmore">加载更多</a>
        <div class="nolog_index_cattitle">
          以分类浏览堆图家
          <a href="#">所有分类》</a>
        </div>
        <div class="nolog_index_catcon clearfix">
          <div class="nolog_index_catcon_left clearfix">
            <div class="nolog_index_catcon_ltit">商品分类</div>
            <div class="nolog_index_cateach">
              <div class="nolog_index_cateachtit">家具</div>
              <ul>
                <li><a href="javascript:;">沙发</a></li>
                <li><a href="javascript:;">椅子</a></li>
                <li><a href="javascript:;">书柜</a></li>
                <li><a href="javascript:;">茶几</a></li>
                <li><a href="javascript:;">床</a></li>
                <li><a href="javascript:;">餐桌</a></li>
                <li><a href="javascript:;">书桌</a></li>
                <li><a href="javascript:;">衣柜</a></li>
                <li><a href="javascript:;">电视柜</a></li>
                <li><a href="javascript:;">鞋柜</a></li>
                <li><a href="javascript:;">户外家具</a></li>
                <li><a href="javascript:;">儿童家具</a></li>
              </ul>
            </div>
            <div class="nolog_index_cateach">
              <div class="nolog_index_cateachtit">家具</div>
              <ul>
                <li><a href="javascript:;">沙发</a></li>
                <li><a href="javascript:;">椅子</a></li>
                <li><a href="javascript:;">书柜</a></li>
                <li><a href="javascript:;">茶几</a></li>
                <li><a href="javascript:;">床</a></li>
                <li><a href="javascript:;">餐桌</a></li>
                <li><a href="javascript:;">书桌</a></li>
                <li><a href="javascript:;">衣柜</a></li>
                <li><a href="javascript:;">电视柜</a></li>
                <li><a href="javascript:;">鞋柜</a></li>
                <li><a href="javascript:;">户外家具</a></li>
                <li><a href="javascript:;">儿童家具</a></li>
              </ul>
            </div>
            <div class="nolog_index_cateach">
              <div class="nolog_index_cateachtit">家具</div>
              <ul>
                <li><a href="javascript:;">沙发</a></li>
                <li><a href="javascript:;">椅子</a></li>
                <li><a href="javascript:;">书柜</a></li>
                <li><a href="javascript:;">茶几</a></li>
                <li><a href="javascript:;">床</a></li>
                <li><a href="javascript:;">餐桌</a></li>
                <li><a href="javascript:;">书桌</a></li>
                <li><a href="javascript:;">衣柜</a></li>
                <li><a href="javascript:;">电视柜</a></li>
                <li><a href="javascript:;">鞋柜</a></li>
                <li><a href="javascript:;">户外家具</a></li>
                <li><a href="javascript:;">儿童家具</a></li>
              </ul>
            </div>
            <div class="nolog_index_cateach">
              <div class="nolog_index_cateachtit">家具</div>
              <ul>
                <li><a href="javascript:;">沙发</a></li>
                <li><a href="javascript:;">椅子</a></li>
                <li><a href="javascript:;">书柜</a></li>
                <li><a href="javascript:;">茶几</a></li>
                <li><a href="javascript:;">床</a></li>
                <li><a href="javascript:;">餐桌</a></li>
                <li><a href="javascript:;">书桌</a></li>
                <li><a href="javascript:;">衣柜</a></li>
                <li><a href="javascript:;">电视柜</a></li>
                <li><a href="javascript:;">鞋柜</a></li>
                <li><a href="javascript:;">户外家具</a></li>
                <li><a href="javascript:;">儿童家具</a></li>
              </ul>
            </div>
            <div class="nolog_index_cateach">
              <div class="nolog_index_cateachtit">家具</div>
              <ul>
                <li><a href="javascript:;">沙发</a></li>
                <li><a href="javascript:;">椅子</a></li>
                <li><a href="javascript:;">书柜</a></li>
                <li><a href="javascript:;">茶几</a></li>
                <li><a href="javascript:;">床</a></li>
                <li><a href="javascript:;">餐桌</a></li>
                <li><a href="javascript:;">书桌</a></li>
                <li><a href="javascript:;">衣柜</a></li>
                <li><a href="javascript:;">电视柜</a></li>
                <li><a href="javascript:;">鞋柜</a></li>
                <li><a href="javascript:;">户外家具</a></li>
                <li><a href="javascript:;">儿童家具</a></li>
              </ul>
            </div>
          </div>
          <div class="nolog_index_catcon_right">
            <div class="nolog_index_catcon_ltit">图集分类</div>
            <div class="nolog_index_cateach">
              <div class="nolog_index_cateachtit">家具</div>
              <ul>
                <li><a href="javascript:;">沙发</a></li>
                <li><a href="javascript:;">椅子</a></li>
                <li><a href="javascript:;">书柜</a></li>
                <li><a href="javascript:;">茶几</a></li>
                <li><a href="javascript:;">床</a></li>
                <li><a href="javascript:;">餐桌</a></li>
                <li><a href="javascript:;">书桌</a></li>
                <li><a href="javascript:;">衣柜</a></li>
                <li><a href="javascript:;">电视柜</a></li>
                <li><a href="javascript:;">鞋柜</a></li>
                <li><a href="javascript:;">户外家具</a></li>
                <li><a href="javascript:;">儿童家具</a></li>
              </ul>
            </div>
            <div class="nolog_index_cateach">
              <div class="nolog_index_cateachtit">家具</div>
              <ul>
                <li><a href="javascript:;">沙发</a></li>
                <li><a href="javascript:;">椅子</a></li>
                <li><a href="javascript:;">书柜</a></li>
                <li><a href="javascript:;">茶几</a></li>
                <li><a href="javascript:;">床</a></li>
                <li><a href="javascript:;">餐桌</a></li>
                <li><a href="javascript:;">书桌</a></li>
                <li><a href="javascript:;">衣柜</a></li>
                <li><a href="javascript:;">电视柜</a></li>
                <li><a href="javascript:;">鞋柜</a></li>
                <li><a href="javascript:;">户外家具</a></li>
                <li><a href="javascript:;">儿童家具</a></li>
              </ul>
            </div>
            <div class="nolog_index_cateach nolog_index_cateachcolor">
              <div class="nolog_index_cateachtit">颜色</div>
              <ul>
                <li><a href="javascript:;" class="nolog_index_cr"></a></li>
                <li><a href="javascript:;" class="nolog_index_co"></a></li>
                <li><a href="javascript:;" class="nolog_index_cy"></a></li>
                <li><a href="javascript:;" class="nolog_index_cg"></a></li>
                <li><a href="javascript:;" class="nolog_index_cq"></a></li>
                <li><a href="javascript:;" class="nolog_index_cl"></a></li>
                <li><a href="javascript:;" class="nolog_index_cp"></a></li>
                <li><a href="javascript:;" class="nolog_index_cb"></a></li>
                <li><a href="javascript:;" class="nolog_index_cw"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="nolog_index_confooter">
      <div class="w1248 clearfix">
        <div class="nolog_index_confooter_for">
          <div class="nolog_index_confooter_tit">堆图家首页</div>
          <p><a href="#">堆图家采集工具</a></p>
          <p><a href="#">堆图家论坛</a></p>
        </div>
        <div class="nolog_index_confooter_for">
          <div class="nolog_index_confooter_tit">联系与合作</div>
          <p><a href="#">联系我们</a></p>
          <p><a href="#">用户反馈</a></p>
        </div>
        <div class="nolog_index_confooter_for">
          <div class="nolog_index_confooter_tit">移动客户端</div>
          <p><a href="#">堆图家iPone版</a></p>
          <p><a href="#">堆图家Android版</a></p>
        </div>
        <div class="nolog_index_confooter_for">
          <div class="nolog_index_confooter_tit">关注我们</div>
          <p><a href="#">新浪微博：@堆图家</a></p>
          <div class="code_a">
            <p><a href="#">官方微信：<img src="{{asset('/static/web/images/index-img/code.jpg')}}" height="16" width="16" alt=""></a></p>
            <div class="code_hover"><img src="{{asset('/static/web/images/index-img/code_ip.png')}}" height="108" width="108" alt=""></div>
          </div>
        </div>
      </div>
    </div>
    <div class="nolog_index_copyright">
      <div class="w1248 clearfix">
        ©2015堆图家 宜然网络科技（上海）有限公司       沪ICP备15052918号-1
      </div>
    </div>
  <div class="pop_login pop_login1" style="display: none;">
    <div class="pop_con">
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
    <div class="pop_con">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="{{asset('/static/web/images/index-img/pop_logo.png')}}" height="87" width="108" alt="">
        <span class="pop_close"></span>
      </p>
      <div class="pop_login_wrap clearfix">
        <div class="pop_login_contit">
          使用第三方账号登录
        </div>
        <div class="pop_login_conother">
          <a href="javascript:;"></a>
          <a href="javascript:;"></a>
          <a href="javascript:;"></a>
          <a href="javascript:;" style="margin-right: 0px;"></a>
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
            <a href="javascript:;">忘记密码&nbsp;》</a>
            <span class="pop_login_desw" style="float: right;">
            还没有堆图家账号？<a href="javascript:;">点击注册&nbsp;》</a>
            </span>
          </p>
        </div>
      </div>
      
    </div>
  </div>
  <div class="pop_login pop_login3" style="display:none">
    <div class="pop_con">
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
            <input class="pop_login_c" type="" name="" value="" placeholder="请输入手机号">
          </div>
          <div class="pop_login_contwrap clearfix" style="margin-bottom: 0px;">
            <input class="pop_login_d" type="" name="" value="" placeholder="请输入验证码">
            <input class="pop_login_e" type="" name="" value="" placeholder="获取短信验证码">
          </div>
          <div class="pop_login_contwrap clearfix">
            <p class="pop_login_pa">验证码已发送至您的手机，请注意查收</p>
            <p class="pop_login_pb">58s后重新发送</p>
          </div>
          <a href="javascript:;" class="pop_login_confirm" style="margin-bottom: 21px;">下一步</a>
          
        </div>
      </div>
      
    </div>
  </div>
  <div class="pop_login pop_login4" style="display:none">
    <div class="pop_con">
      <p class="pop_tit" style="text-align:center;border:none;">
        <img src="{{asset('/static/web/images/index-img/pop_logo.png')}}" height="87" width="108" alt="">
        <span class="pop_close"></span>
      </p>
      <div class="pop_login_wrap clearfix">
        <div class="pop_login_contit">
          重置密码
        </div>
        <div class="pop_login_content clearfix">
          <div class="pop_login_contwrap clearfix" style="margin-bottom: 8px;">
            <input class="pop_login_c" type="" name="" value="" placeholder="请输入新密码">
            <div class="pop_login_safew clearfix">
              <div class="pop_login_safe pop_login_safeh">高</div>
              <div class="pop_login_safe pop_login_safem">中</div>
              <div class="pop_login_safe pop_login_safel">低</div>
            </div>
          </div>
          <div class="pop_login_contwrap clearfix">
            <input class="pop_login_c" type="" name="" value="" placeholder="再次输入新密码">
          </div>
          <a href="javascript:;" class="pop_login_confirm" style="margin-bottom: 21px;">确定</a>
          
        </div>
      </div>
      
    </div>
  </div>
</body>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/register.js')}}"></script>
</html>