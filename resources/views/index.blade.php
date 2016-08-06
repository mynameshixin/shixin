<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta property="wb:webmaster" content="9e2bfff93f801b23" />
  <meta property="qc:admins" content="24531766656451452116375" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="baidu-site-verification" content="Sl3bRnTO0A" />
  <title>堆图家，链接全球家居资源(家居、室内设计、商品、美图、VR)</title>
  <meta name="keywords" content="堆图家,家居,室内设计,商品,美图,软装,建筑,装修,VR,设计,人物,数据"/> 
  <meta name="description" content="堆图家,带你搜集你喜欢的家居,你可以用它搜集灵感图片,发布VR,保存素材,晒晒喜欢的家居"/> 
  <link rel="shortcut icon" href="/logo.ico">
  <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?d395e3863da8722a0eba22f2bc629b6a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
  <script type="text/javascript">
    user_id = "<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"
    u_id = "<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"
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

  <div class="nolog_header">
    <div class="headercontainer w1248 clearfix">
      <a href="/" class="header_logo"></a>
      <a href="{{url('webd/home')}}" class="header_item" title="商品">商品</a>
      <a href="{{url('webd/pics')}}" class="header_item" title="图集">图集</a>
      <a href="{{url('webd/find')}}" class="header_item" title="发现">发现</a>
      <a href="{{url('webd/app')}}" class="header_item" title="APP">APP</a>
      <div href="javascript:;" class="header_add_btn">
       
        +
        
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
      <a href="{{url('webd/home')}}" class="header_item" title="商品">商品</a>
      <a href="{{url('webd/pics')}}" class="header_item" title="图集">图集</a>
      <a href="{{url('webd/find')}}" class="header_item" title="发现">发现</a>
      <a href="{{url('webd/app')}}" class="header_item" title="APP">APP</a>
      <div href="javascript:;" class="header_add_btn">
        
        +
        
        <div class="header_add_item">
          @include('web.common.banner.action')
        </div>
      </div>
      <form action="/webd/search/goods" method="get" name='search_s'>
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
  @include('web.common.daction')
  <div class="container nolog_index_container clearfix">
    <div class="nolog_index_banner" style="background: url({{ asset('/static/web/images/index-img/index-banner.jpg')}}) top center no-repeat">
      <div class="w1248 clearfix nolog_index_top">
        <p class="nolog_index_title">发现、采集、分享你喜欢的家居  </p>
        <div class="header_search_wrap clearfix">
          <form action="/webd/search/goods" method="get" name='search'>
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
        <p class="nolog_index_subtit">热门搜索：<a href="/webd/search/goods?keyword=沙发" target="_blank">沙发</a>、<a href="/webd/search/goods?keyword=吊灯" target="_blank">吊灯</a>、<a href="/webd/search/goods?keyword=窗帘" target="_blank">窗帘</a>、<a href="/webd/search/goods?keyword=中式" target="_blank">中式</a>、<a href="/webd/search/goods?keyword=法式" target="_blank">法式</a>、<a href="/webd/search/goods?keyword=饰品" target="_blank">饰品</a></p>
      </div>
    </div>
    <div class="nolog_index_container">
      <div class="w1248 clearfix">
        <div class="nolog_index_contit">
          用户推荐
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
              <p class="nolog_index_conexwork"><<?php  if($value['role']==1){
                echo '设计师';
                }elseif($value['role']==2){
                  echo '家居迷';
                  }elseif($value['role']==3){echo '商家';}?>></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="nolog_index_contit">
          文件夹推荐
        </div>
        <!-- 1 -->
        <div class="nolog_index_conreco clearfix">
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[0]['id']}}" target="_blank"><img src="{{$recommend[0]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                
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
        <!-- 2 -->
          <div class="nolog_index_conrecbox nolog_index_conrecone">
            <div class="nolog_index_conrecinfobox textleft marbtm">
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                
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

          <!-- 3 -->
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[6]['id']}}" target="_blank"><img src="{{$recommend[6]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[6]['id']}}" target="_blank">{{$recommend[6]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[6]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[6]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[6]['user']['id']}}" target="_blank">{{!empty(trim($recommend[6]['user']['nick']))?$recommend[6]['user']['nick']:$recommend[6]['user']['username']}}</a>
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[7]['id']}}" target="_blank">{{$recommend[7]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[7]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[7]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[7]['user']['id']}}" target="_blank">{{!empty(trim($recommend[7]['user']['nick']))?$recommend[7]['user']['nick']:$recommend[7]['user']['username']}}
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[7]['id']}}" target="_blank"><img src="{{$recommend[7]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[8]['id']}}" target="_blank"><img src="{{$recommend[8]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox nolog_index_conrecone mrightzero">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[8]['id']}}" target="_blank">{{$recommend[8]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[8]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[8]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[8]['user']['id']}}" target="_blank">{{!empty(trim($recommend[8]['user']['nick']))?$recommend[8]['user']['nick']:$recommend[8]['user']['username']}}
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              
            </div>
          </div>

        <!-- 4 -->
         <div class="nolog_index_conrecbox nolog_index_conrecone">
            <div class="nolog_index_conrecinfobox textleft marbtm">
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[9]['id']}}" target="_blank">{{$recommend[9]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[9]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[9]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[9]['user']['id']}}" target="_blank">{{!empty(trim($recommend[9]['user']['nick']))?$recommend[9]['user']['nick']:$recommend[9]['user']['username']}}
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[9]['id']}}" target="_blank"><img src="{{$recommend[9]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[10]['id']}}" target="_blank"><img src="{{$recommend[10]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[10]['id']}}" target="_blank">{{$recommend[10]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[10]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[10]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[10]['user']['id']}}" target="_blank">{{!empty(trim($recommend[10]['user']['nick']))?$recommend[10]['user']['nick']:$recommend[10]['user']['username']}}
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[11]['id']}}" target="_blank">{{$recommend[11]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[11]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[11]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[11]['user']['id']}}" target="_blank">{{!empty(trim($recommend[11]['user']['nick']))?$recommend[11]['user']['nick']:$recommend[11]['user']['username']}}
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox mrightzero">
            <a href="/webd/folder?fid={{$recommend[11]['id']}}" target="_blank"><img src="{{$recommend[11]['img_url']}}" alt=""></a>
          </div>

        <!-- 5 -->
         <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[12]['id']}}" target="_blank"><img src="{{$recommend[12]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[12]['id']}}" target="_blank">{{$recommend[12]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[12]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[12]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[12]['user']['id']}}" target="_blank">{{!empty(trim($recommend[12]['user']['nick']))?$recommend[12]['user']['nick']:$recommend[12]['user']['username']}}</a>
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              <div class="nolog_index_conrecivonright"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[13]['id']}}" target="_blank">{{$recommend[13]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[13]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[13]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[13]['user']['id']}}" target="_blank">{{!empty(trim($recommend[13]['user']['nick']))?$recommend[13]['user']['nick']:$recommend[13]['user']['username']}}
              </p>
            </div>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[13]['id']}}" target="_blank"><img src="{{$recommend[13]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox">
            <a href="/webd/folder?fid={{$recommend[14]['id']}}" target="_blank"><img src="{{$recommend[14]['img_url']}}" alt=""></a>
          </div>
          <div class="nolog_index_conrecbox nolog_index_conrecone mrightzero">
            <div class="nolog_index_conrecinfobox textleft marbtm">
              <div class="nolog_index_conrecivonleft"></div>
              <a class="nolog_index_conrecfold">
                
              </a>
              <p class="nolog_index_conrecauto">
                <a href="/webd/folder?fid={{$recommend[14]['id']}}" target="_blank">{{$recommend[14]['name']}}</a>
              </p>
              <p class="nolog_index_conrecfans">
                {{$recommend[14]['count']['folder_count']}}文件&nbsp;&nbsp;{{$recommend[14]['count']['fans_count']}}粉丝
              </p>
              <p class="nolog_index_conrecfrom">
                来自<a href="/webd/user?oid={{$recommend[14]['user']['id']}}" target="_blank">{{!empty(trim($recommend[14]['user']['nick']))?$recommend[14]['user']['nick']:$recommend[14]['user']['username']}}</a>
              </p>
            </div>
            <div class="nolog_index_conrecinfobox textright">
              
            </div>
          </div>
        </div>
       <!--  <a href="#" class="nolog_index_conmore">加载更多</a> -->
        <div class="nolog_index_cattitle" style="padding: 0; margin-top: 30px">
          以分类浏览堆图家
        </div>
        <div class="nolog_index_catcon clearfix">
          <div class="find_cater_aeach_wrap clearfix" style="margin-bottom: 40px;">
            <ul class="find_cater_aeach">
              <p class="find_cater_label">设计风格</p>
              <li><a href="/webd/search/goods?keyword=现代" target="_blank">现代</a></li>
              <li><a href="/webd/search/goods?keyword=北欧" target="_blank">北欧</a></li>
              <li><a href="/webd/search/goods?keyword=日式" target="_blank">日式</a></li>
              <li><a href="/webd/search/goods?keyword=法式" target="_blank">法式</a></li>
              <li><a href="/webd/search/goods?keyword=新中式" target="_blank">新中式</a></li>
              <li><a href="/webd/search/goods?keyword=地中海" target="_blank">地中海</a></li>

            </ul>
            <ul class="find_cater_aeach">
              <p class="find_cater_label">居家空间</p>
              <li><a href="/webd/search/goods?keyword=客厅" target="_blank">客厅</a></li>
              <li><a href="/webd/search/goods?keyword=餐厅" target="_blank">餐厅</a></li>
              <li><a href="/webd/search/goods?keyword=卧室" target="_blank">卧室</a></li>
              <li><a href="/webd/search/goods?keyword=阳台" target="_blank">阳台</a></li>
              <li><a href="/webd/search/goods?keyword=厨房" target="_blank">厨房</a></li>
              <li><a href="/webd/search/goods?keyword=书房" target="_blank">书房</a></li>

            </ul>
            <ul class="find_cater_aeach">
              <p class="find_cater_label">商业空间</p>
              <li><a href="/webd/search/goods?keyword=餐饮店" target="_blank">餐饮店</a></li>
              <li><a href="/webd/search/goods?keyword=酒店" target="_blank">酒店</a></li>
              <li><a href="/webd/search/goods?keyword=民宿" target="_blank">民宿</a></li>
              <li><a href="/webd/search/goods?keyword=售楼处" target="_blank">售楼处</a></li>
              <li><a href="/webd/search/goods?keyword=样板房" target="_blank">样板房</a></li>
              <li><a href="/webd/search/goods?keyword=办公室" target="_blank">办公室</a></li>

            </ul>
            <ul class="find_cater_aeach">
              <p class="find_cater_label">红星美凯龙</p>
              <li><a href="/webd/search/goods?keyword=左右" target="_blank">左右</a></li>
              <li><a href="/webd/search/goods?keyword=奥卓" target="_blank">奥卓</a></li>
              <li><a href="/webd/search/goods?keyword=双叶" target="_blank">双叶</a></li>
              <li><a href="/webd/search/goods?keyword=多喜爱" target="_blank">多喜爱</a></li>
              <li><a href="/webd/search/goods?keyword=法郎仕" target="_blank">法郎仕</a></li>
              <li><a href="/webd/search/goods?keyword=柏逸轩" target="_blank">柏逸轩</a></li>

            </ul>
            <ul class="find_cater_aeach">
              <p class="find_cater_label">单品</p>
              <li><a href="/webd/search/goods?keyword=沙发" target="_blank">沙发</a></li>
              <li><a href="/webd/search/goods?keyword=餐桌" target="_blank">餐桌</a></li>
              <li><a href="/webd/search/goods?keyword=书桌" target="_blank">书桌</a></li>
              <li><a href="/webd/search/goods?keyword=衣柜" target="_blank">衣柜</a></li>
              <li><a href="/webd/search/goods?keyword=床头柜" target="_blank">床头柜</a></li>
              <li><a href="/webd/search/goods?keyword=五斗柜" target="_blank">五斗柜</a></li>

            </ul>
          <style type="text/css">
                .color li{}
          </style>
            <ul class="find_cater_aeach nolog_index_cateachcolor">
              <p class="find_cater_label">色系</p>
                <li><a href="/webd/search/goods?keyword=红色" target="_blank" class="nolog_index_cr"></a></li>
                <li><a href="/webd/search/goods?keyword=橙色" target="_blank" class="nolog_index_co"></a></li>
                <li><a href="/webd/search/goods?keyword=黄色" target="_blank" class="nolog_index_cy"></a></li>
                <li><a href="/webd/search/goods?keyword=绿色" target="_blank" class="nolog_index_cg"></a></li>
                <li><a href="/webd/search/goods?keyword=青色" target="_blank" class="nolog_index_cq"></a></li>
                <li><a href="/webd/search/goods?keyword=蓝色" target="_blank" class="nolog_index_cl"></a></li>
                <li><a href="/webd/search/goods?keyword=紫色" target="_blank" class="nolog_index_cp"></a></li>
                <li><a href="/webd/search/goods?keyword=黑色" target="_blank" class="nolog_index_cb"></a></li>
                <li><a href="/webd/search/goods?keyword=白色" target="_blank" class="nolog_index_cw"></a></li>
                <li><a href="/webd/search/goods?keyword=灰色" target="_blank" class="nolog_index_cc"></a></li>
            </ul>

            <ul class="find_cater_aeach">
              <p class="find_cater_label">装饰摆设</p>
              <li><a href="/webd/search/goods?keyword=摆件" target="_blank">摆件</a></li>
              <li><a href="/webd/search/goods?keyword=装饰画" target="_blank">装饰画</a></li>
              <li><a href="/webd/search/goods?keyword=香薰" target="_blank">香薰</a></li>
              <li><a href="/webd/search/goods?keyword=挂钩" target="_blank">挂钩</a></li>
              <li><a href="/webd/search/goods?keyword=收纳" target="_blank">收纳</a></li>
              <li><a href="/webd/search/goods?keyword=相框" target="_blank">相框</a></li>
            </ul>

            <ul class="find_cater_aeach">
              <p class="find_cater_label">灯饰</p>
              <li><a href="/webd/search/goods?keyword=台灯" target="_blank">台灯</a></li>
              <li><a href="/webd/search/goods?keyword=吊灯" target="_blank">吊灯</a></li>
              <li><a href="/webd/search/goods?keyword=户外灯" target="_blank">户外灯</a></li>
              <li><a href="/webd/search/goods?keyword=镜前灯" target="_blank">镜前灯</a></li>
              <li><a href="/webd/search/goods?keyword=落地灯" target="_blank">落地灯</a></li>
              <li><a href="/webd/search/goods?keyword=水晶灯" target="_blank">水晶灯</a></li>
            </ul>
           
           <ul class="find_cater_aeach">
              <p class="find_cater_label">家纺家饰</p>
              <li><a href="/webd/search/goods?keyword=床品" target="_blank">床品</a></li>
              <li><a href="/webd/search/goods?keyword=抱枕" target="_blank">抱枕</a></li>
              <li><a href="/webd/search/goods?keyword=窗帘" target="_blank">窗帘</a></li>
              <li><a href="/webd/search/goods?keyword=坐垫" target="_blank">坐垫</a></li>
              <li><a href="/webd/search/goods?keyword=桌布" target="_blank">桌布</a></li>
              <li><a href="/webd/search/goods?keyword=地毯" target="_blank">地毯</a></li>
            </ul>

          <ul class="find_cater_aeach">
              <p class="find_cater_label">卫生间</p>
              <li><a href="/webd/search/goods?keyword=浴帘" target="_blank">浴帘</a></li>
              <li><a href="/webd/search/goods?keyword=衣架" target="_blank">衣架</a></li>
              <li><a href="/webd/search/goods?keyword=洗漱套瓶" target="_blank">洗漱套瓶</a></li>
              <li><a href="/webd/search/goods?keyword=防滑垫" target="_blank">防滑垫</a></li>
              <li><a href="/webd/search/goods?keyword=毛巾架" target="_blank">毛巾架</a></li>
              <li><a href="/webd/search/goods?keyword=毛巾环" target="_blank">毛巾环</a></li>
            </ul>

            <ul class="find_cater_aeach">
              <p class="find_cater_label">花艺植物</p>
              <li><a href="/webd/search/goods?keyword=多肉植物" target="_blank">多肉植物</a></li>
              <li><a href="/webd/search/goods?keyword=花瓶" target="_blank">花瓶</a></li>
              <li><a href="/webd/search/goods?keyword=鲜花" target="_blank">鲜花</a></li>
              <li><a href="/webd/search/goods?keyword=千花" target="_blank">千花</a></li>
              <li><a href="/webd/search/goods?keyword=仿真花" target="_blank">仿真花</a></li>
              <li><a href="/webd/search/goods?keyword=野兽派" target="_blank">野兽派</a></li>
            </ul>
            
            <ul class="find_cater_aeach">
              <p class="find_cater_label">厨房用品</p>
              <li><a href="/webd/search/goods?keyword=盘子" target="_blank">盘子</a></li>
              <li><a href="/webd/search/goods?keyword=杯子" target="_blank">杯子</a></li>
              <li><a href="/webd/search/goods?keyword=勺子" target="_blank">勺子</a></li>
              <li><a href="/webd/search/goods?keyword=刀叉" target="_blank">刀叉</a></li>
              <li><a href="/webd/search/goods?keyword=碟" target="_blank">碟</a></li>
              <li><a href="/webd/search/goods?keyword=碗架" target="_blank">碗架</a></li>
            </ul>
            
          </div>
        
        </div>
      </div>
    </div>
    
  </div>
@include('web.common.foot')
@include('web.common.login',['index'=>1])
</body>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>