<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>堆图家</title>
  <script type="text/javascript">
    user_id = "<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"
  </script>
  <link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/font-awesome.min.css">
  <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="{{asset('public/web')}}/css/font-awesome-ie7.min.css">
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/main.css">
  <link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/index.css">
  <script type="text/javascript" src="{{asset('web')}}/js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="{{asset('web')}}/js/jquery.lazyload.js"></script>
  <script type="text/javascript" src="{{asset('web')}}/js/jquery.form.js"></script>
  <script type="text/javascript" src="{{asset('web')}}/plugins/Masonry/masonry-docs.min.js"></script>
  <script type="text/javascript" src="{{asset('web')}}/js/nolog.js"></script>
  <script type="text/javascript" src="{{asset('web')}}/js/index.js"></script>
</head>
<body class="nolog_body">
@include('web.common.daction')
  <div class="nolog_header">
    <div class="headercontainer w1248 clearfix">
      <a href="/" class="header_logo"></a>
      <a href="{{url('webd/home')}}" class="header_item">商品</a>
      <a href="{{url('webd/pics')}}" class="header_item">图集</a>
      <a href="{{url('webd/find')}}" class="header_item">发现</a>
      <a href="{{url('webd/app')}}" class="header_item">APP</a>
      <div href="javascript:;" class="header_add_btn">
        <div class="header_add_item">
          @include('web.common.banner.action')
        </div>
      </div>
      @include('web.common.banner.my')
    </div>
  </div>
  <div class="header slideup">
    <div class="headercontainer w1248 clearfix">
      <a href="/" class="header_logo"></a>
      <a href="{{url('webd/home')}}" class="header_item">商品</a>
      <a href="{{url('webd/pics')}}" class="header_item">图集</a>
      <a href="{{url('webd/find')}}" class="header_item">发现</a>
      <a href="{{url('webd/app')}}" class="header_item">APP</a>
      <div href="javascript:;" class="header_add_btn">
        <div class="header_add_item">
          @include('web.common.banner.action')
        </div>
      </div>
      <form action="/webd/search" method="get" name='search_s'>
        <input type="text" class="header_search header_search_s" style="width: 645px;" placeholder="搜索你喜欢的" name="keyword">
      </form>
      <script type="text/javascript">
            $('.header_search_s').keydown(function(e){
              if(e.keyCode==13){
                $('form[name=search_s]').submit()
              }
            })
      </script>
      @include('web.common.banner.my')
    </div>
  </div>
  <div class="container nolog_index_container clearfix">
    <div class="nolog_index_banner" style="background: url({{ asset('/static/web/images/index-img/index-banner.jpg')}}) top center no-repeat">
      <div class="w1248 clearfix nolog_index_top">
        <p class="nolog_index_title">发现、采集、分享你喜欢的家居  </p>
        <div class="header_search_wrap clearfix">
          <form action="/webd/search" method="get" name='search'>
            <input type="text" class="header_search header_search_indexnolog" name="keyword" placeholder="搜索你喜欢的">
          </form>
          <script type="text/javascript">
            $('.header_search_indexnolog').keydown(function(e){
              if(e.keyCode==13){
                $('form[name=search]').submit()
              }
            })
          </script>
        </div>
        <p class="nolog_index_subtit">热门搜索：<a href="/webd/search?keyword=沙发" target="_blank">沙发</a>、<a href="/webd/search?keyword=吊灯" target="_blank">吊灯</a>、<a href="/webd/search?keyword=窗帘" target="_blank">窗帘</a>、<a href="/webd/search?keyword=中式" target="_blank">中式</a>、<a href="/webd/search?keyword=法式" target="_blank">法式</a>、<a href="/webd/search?keyword=饰品" target="_blank">饰品</a></p>
      </div>
    </div>
    <div class="nolog_index_container">
      <div class="w1248 clearfix">
        <div class="nolog_index_contit">
          行家推荐
        </div>
        <div class="nolog_index_conexpert clearfix">
         <?php foreach ($user as $key => $value):?>
          <div class="nolog_index_conexinfo <?php if($key==4): ?>mrightzero <?php endif; ?>">
            <div class="nolog_index_conexava">
              <a href="/webd/user?oid={{$value['id']}}" target="_blank"><img src="{{!empty($value['auth_avatar'])?$value['auth_avatar']:$value['pic_m']}}" height="135" width="135" alt=""></a>
            </div>
            <div class="nolog_index_conrel">
              <p class="nolog_index_conexname">{{!empty(trim($value['nick']))?$value['nick']:$value['username']}}</p>
              <p class="nolog_index_conexfans">{{$value['fans_count']}}粉丝</p>
               <!--  <p class="nolog_index_conexwork"><商家></p> -->
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="nolog_index_contit">
          为您推荐
        </div>
        <div class="nolog_index_conreco clearfix">
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[0]['id']}}" target="_blank"><img src="{{$recommend[0]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[0]['id']}}" target="_blank">{{$recommend[0]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[0]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[0]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[0]['user']['id']}}" target="_blank">{{!empty(trim($recommend[0]['user']['nick']))?$recommend[0]['user']['nick']:$recommend[0]['user']['username']}}</a>
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[1]['id']}}" target="_blank">{{$recommend[1]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[1]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[1]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[1]['user']['id']}}" target="_blank">{{!empty(trim($recommend[1]['user']['nick']))?$recommend[1]['user']['nick']:$recommend[1]['user']['username']}}
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[1]['id']}}" target="_blank"><img src="{{$recommend[1]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[2]['id']}}" target="_blank"><img src="{{$recommend[2]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox nolog_index_conrecone mrightzero">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[2]['id']}}" target="_blank">{{$recommend[2]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[2]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[2]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[2]['user']['id']}}" target="_blank">{{!empty(trim($recommend[2]['user']['nick']))?$recommend[2]['user']['nick']:$recommend[2]['user']['username']}}
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
                <a href="/webd/folder?fid={{$recommend[3]['id']}}" target="_blank">{{$recommend[3]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[3]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[3]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[3]['user']['id']}}" target="_blank">{{!empty(trim($recommend[3]['user']['nick']))?$recommend[3]['user']['nick']:$recommend[3]['user']['username']}}
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[3]['id']}}" target="_blank"><img src="{{$recommend[3]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[4]['id']}}" target="_blank"><img src="{{$recommend[4]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[4]['id']}}" target="_blank">{{$recommend[4]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[4]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[4]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[4]['user']['id']}}" target="_blank">{{!empty(trim($recommend[4]['user']['nick']))?$recommend[4]['user']['nick']:$recommend[4]['user']['username']}}
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                文件夹
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[5]['id']}}" target="_blank">{{$recommend[5]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[5]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[5]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[5]['user']['id']}}" target="_blank">{{!empty(trim($recommend[5]['user']['nick']))?$recommend[5]['user']['nick']:$recommend[5]['user']['username']}}
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox mrightzero">
            <a href="/webd/folder?fid={{$recommend[5]['id']}}" target="_blank"><img src="{{$recommend[5]['img_url']}}" alt=""></a>
          </div>
        </div>
       <!--  <a href="#" class="nolog_index_conmore">加载更多</a> -->
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
@include('web.common.login',['index'=>1])
</body>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/register.js')}}"></script>
</html>