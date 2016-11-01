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
function rebind(obj,size){
    if($(obj).width()>size) $(obj).css('width',size+'px')
}
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

    function increaseView(obj,gid,url){
      $.getJSON('/api/vr/viewincrease',{'gid':gid},function(json){
        if(json.data.status==1){
          location.href = url
        }
      })
    }

    function like_count(obj,good_id){
      var obj = $(obj)
      var num = obj.html()
      $.ajax({
        'url':"/webd/goodaction/create",
        'type':'post',
        'data':{
          'good_id':good_id,
          'action':1,
          'user_id':u_id
        },
        'dataType':'json',
        'success':function(json){
          if(json.code==200){
            obj.html(++num)
          }else{
            layer.msg(json.message, {icon: 5});
            return
          }
        }
      })
    }
  </script>
</head>

<body class="nolog_body" ng-app="myApp">

  <div class="header slideup" style=" display: block;">
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
      <form action="/vr/4/" method="get">
        <input type="hidden" value="{{$alias or '1'}}" name="alias"></input>
        <input type="text" class="header_search header_search_s" style="width: 645px;" placeholder="搜索你想看的" name="keyword">
      </form>
 @include('web.common.banner.my')
    </div>
  </div>
 @include('web.common.daction')
<script type="text/javascript">
  var myApp = angular.module('myApp', [], function($interpolateProvider) {
   $interpolateProvider.startSymbol('{%');
   $interpolateProvider.endSymbol('%}');
  });
  myApp.controller('dev',function($scope,$http){
    $http({
        method: 'get',
        url: '/api/vr/dev',
      }).success(function(json, status) {
        $scope.dev = json.data.list
      })
  })

  myApp.controller('huxing',function($scope,$http){
    $http({
        method: 'get',
        url: '/api/vr/huxing',
      }).success(function(json, status) {
        $scope.huxing = json.data.list
      })
  })

  myApp.controller('type',function($scope,$http){
    $http({
        method: 'post',
        url: '/api/vr/type',
      }).success(function(json, status) {
        $scope.type = json.data.list
      })
  })

  myApp.controller('btype',function($scope,$http){
    $http({
        method: 'get',
        url: '/api/vr/brandtype',
      }).success(function(json, status) {
        $scope.btype = json.data.list
      })
  })

  myApp.controller('sale',function($scope,$http){
    $http({
        method: 'get',
        url: '/api/vr/sales',
      }).success(function(json, status) {
        $scope.sale = json.data.list
      })
  })

</script>
 <div class="container nolog_index_container clearfix {{$k3}}" >
    <div class="nolog_index_banner" style="background: url({{ asset('/static/web/images/vr')}}/{{$pic}}.png) top center no-repeat">
      <div class="w1248 clearfix nolog_index_top">
        <p class="nolog_index_title">{{$k1}}</p>
        <div class="header_search_wrap clearfix">
          <form action="/vr/4/" method="get">
            <input type="hidden" value="{{$alias or '1'}}" name="alias"></input>
            <input type="text" name="keyword" class="header_search header_search_indexnolog" placeholder="搜索你想看的" value="{{$keyword or ''}}">
          </form>
        </div>
        <p class="nolog_index_subtit">搜索——<a href="javascript:;">{{$k2}}</a></p>
      </div>
    </div>