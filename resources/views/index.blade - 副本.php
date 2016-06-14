<!doctype html>
<html lang="zh">
<head>
<meta charset="utf-8">
<script type="text/javascript" src="{{ asset('/static/web/common/js/jianrongIE8.js')}}"> </script><!---解决IE兼容问题------>
<title>堆图家</title>
<link href="{{ asset('/static/web/common/css/index.css')}}" type="text/css" rel="stylesheet"/>
<link href="{{ asset('/static/web/common/css/font-awesome-4.4.0/css/font-awesome.min.css')}}"  type="text/css" rel="stylesheet"/>
</head>
<body>
<header id="header">
     <nav class="top_nav">
         <h1 class="logo"><img src="{{ asset('/static/web/images/index-img/logo.png')}}"></h1>
         <ul class="nav">
            <li class="active"><a href="">首页</a></li>
            <li><a href="">图集</a></li>
            <li style="font-size:35px;"><a href="">···</a></li>
         </ul>

         <div class="login">
             <?php
              $user = \Auth::user();
             ?>
             @if($user)
                 <form action="{{url('auth/logout')}}">
                     @if ($user->hasRole(['administrator','super_administrator']) )
                         <a href="{{url('admin')}}">管理后台</a>
                     @endif
                     <button>登出</button>
                 </form>

             @else
                 <form action="{{url('auth/login')}}">
                     <button>注册</button>
                     <button>登录</button>
                 </form>
             @endif
         </div>     
     </nav>
     <h1 class="big-title">发现、采集、分享你喜欢的家居</h1>
     <form class="search_box">
        <input class="search" type="text" placeholder="搜索你喜欢的">
        <div class="search-btn"><img src="{{ asset('/static/web/images/index-img/search.png')}}"></div>
     </form>
     <div class="search-title">
        <span style="font-size:16px; color:#c9c9c9">热门搜索：</span>
        <a href="">沙发</a>
        <a href="">吊灯</a>
        <a href="">窗帘</a>
        <a href="">中式</a>
        <a href="">法式</a>
        <a href="">饰品</a>
     </div>     
</header>
<!--头部结束-->
<div class="main-title">
    <h1 class="titile-tuijian">达人推荐</h1>
</div>
<div id="person">
    <ul>
        <li>
           <div class="photo"><a href=""><img src="{{ asset('/static/web/images/index-img/p1.jpeg')}}"></a></div>
           <h2 class="usename">下雨天</h2>
           <p><span><i class="fa fa-star-o"></i></span><span>91924</span></p>
           <p><span>擅长领域：</span><span>家居</span></p>
        </li>
        <li>
           <div class="photo"><a href=""><img src="{{ asset('/static/web/images/index-img/p2.jpeg')}}"></a></div>
           <h2 class="usename">下雨天</h2>
           <p><span><i class="fa fa-star-o"></i></span><span>91924</span></p>
           <p><span>擅长领域：</span><span>家居</span></p>
        </li>
        <li>
           <div class="photo"><a href=""><img src="{{ asset('/static/web/images/index-img/p3.jpeg')}}"></a></div>
           <h2 class="usename">下雨天</h2>
           <p><span><i class="fa fa-star-o"></i></span><span>91924</span></p>
           <p><span>擅长领域：</span><span>家居</span></p>
        </li>
        <li>
           <div class="photo"><a href=""><img src="{{ asset('/static/web/images/index-img/p4.png')}}"></a></div>
           <h2 class="usename">下雨天</h2>
           <p><span><i class="fa fa-star-o"></i></span><span>91924</span></p>
           <p><span>擅长领域：</span><span>家居</span></p>
        </li>
        <li>
           <div class="photo"><a href=""><img src="{{ asset('/static/web/images/index-img/p5.jpeg')}}"></a></div>
           <h2 class="usename">下雨天</h2>
           <p><span><i class="fa fa-star-o"></i></span><span>91924</span></p>
           <p><span>擅长领域：</span><span>家居</span></p>
        </li>
    </ul>
</div>
<div class="main-title">
    <h1 class="titile-tuijian">为你推荐</h1>
</div>
<section class="main-list">
   <ul class="aul">
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-1.jpg')}}"></a></li>
      <li>
         <div class="li-top">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa"><i class="fa fa-caret-left"></i></div>
         </div>
         <div class="li-top li-top-right" style="margin-top:4px;">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-right"><i class="fa fa-caret-right"></i></div> 
         </div>       
      </li>      
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-2.jpg')}}"></a></li>
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-3.jpg')}}"></a></li>
      <li>
         <div class="li-top li-main">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-main"><i class="fa fa-caret-left"></i></div>
         </div>      
      </li>
   </ul>
   <!-------------------第二排--------------------->
   <ul class="aul">     
      <li>
         <div class="baohan">
             <div class="li-top">            
             </div>
             <div class="li-top li-top-right" style="margin-top:4px;">
                <h1>文件夹</h1>
                <h2><a href="">王先生</a></h2>
                <p><span>212采集</span> <span>912粉丝</span></p>
                <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
                <div class="fa-right"><i class="fa fa-caret-right"></i></div> 
             </div>
         </div>       
      </li>      
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-4.jpg')}}"></a></li>
      <li class="lisr-bg2 hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-6.jpg')}}"></a></li>
      <li>
         <div class="li-top">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa"><i class="fa fa-caret-left"></i></div>
         </div>
         <div class="li-top li-top-right" style="margin-top:4px;">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-right"><i class="fa fa-caret-right"></i></div> 
         </div>       
      </li>
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-7.jpg')}}"></a></li>
   </ul>
   <!-------------------第三排--------------------->
   <ul class="aul">
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-8.jpg')}}"></a></li>
      <li>
         <div class="li-top">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa"><i class="fa fa-caret-left"></i></div>
         </div>
         <div class="li-top li-top-right" style="margin-top:4px;">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-right"><i class="fa fa-caret-right"></i></div> 
         </div>       
      </li>      
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-9.jpg')}}"></a></li>
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-10.jpg')}}"></a></li>
      <li>
         <div class="li-top li-main">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-main"><i class="fa fa-caret-left"></i></div>
         </div>      
      </li>
   </ul>
    <!-------------------第四排--------------------->
   <ul class="aul">     
      <li>
         <div class="baohan">
             <div class="li-top">            
             </div>
             <div class="li-top li-top-right" style="margin-top:4px;">
                <h1>文件夹</h1>
                <h2><a href="">王先生</a></h2>
                <p><span>212采集</span> <span>912粉丝</span></p>
                <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
                <div class="fa-right"><i class="fa fa-caret-right"></i></div> 
             </div>
         </div>       
      </li>      
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-10.jpg')}}"></a></li>
      <li class="lisr-bg2 lisr-bg3 hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-10.jpg')}}"></a></li>
      <li>
         <div class="li-top">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa"><i class="fa fa-caret-left"></i></div>
         </div>
         <div class="li-top li-top-right" style="margin-top:4px;">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-right"><i class="fa fa-caret-right"></i></div> 
         </div>       
      </li>
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-12.jpg')}}"></a></li>
   </ul>  
     <!-------------------第五排--------------------->
    <ul class="aul">
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-13.jpg')}}"></a></li>
      <li>
         <div class="li-top">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa"><i class="fa fa-caret-left"></i></div>
         </div>
         <div class="li-top li-top-right" style="margin-top:4px;">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-right"><i class="fa fa-caret-right"></i></div> 
         </div>       
      </li>      
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-14.jpg')}}"></a></li>
      <li class="hover-bg"><a href=""><img src="{{ asset('/static/web/images/index-img/list-15.jpg')}}"></a></li>
      <li>
         <div class="li-top li-main">
            <h1>文件夹</h1>
            <h2><a href="">王先生</a></h2>
            <p><span>212采集</span> <span>912粉丝</span></p>
            <p><span>来自</span> <span class="color-hong"><a href="">贵妃娘娘</a></span></p>
            <div class="fa-main"><i class="fa fa-caret-left"></i></div>
         </div>      
      </li>
   </ul>
</section>
<div class="jiazai">
   <a href="###">加载更多</a>
</div>













<footer id="footer">
    <header class="footer-top">
       <span>以分类浏览堆土家</span>
       <span><a href="">更多 <i class="fa fa-angle-double-right"></i></a></span>
    </header>
    <header class="footer-main">    
        <article class="main-left">
            <h1>商品分类</h1>
            <div class="center-nav">
                <section class="content-nav">
                    <h2>家居</h2>
                    <div class="subnav">    
                        <a href="">沙发</a>
                        <a href="">椅子</a>
                        <a href="">书柜</a>
                        <a href="">茶几</a>
                        <a href="">床</a>
                        <a href="">书桌</a>
                        <a href="">衣柜</a>
                        <a href="">电视柜</a>
                        <a href="">鞋柜</a>
                        <a href="">户外家具</a>
                        <a href="">儿童家具</a>
                    </div>
                    <h2>装饰摆设</h2>
                    <div class="subnav">     
                        <a href="">摆件</a>
                        <a href="">镜子</a>
                        <a href="">钟</a>
                        <a href="">装置画</a>
                        <a href="">香薰</a>
                        <a href="">挂钩</a>
                        <a href="">收纳</a>
                        <a href="">餐具</a>
                        <a href="">厨房用品</a>                       
                    </div>                                    
                    <h2>灯饰</h2>
                    <div class="subnav">     
                        <a href="">台灯</a>
                        <a href="">吊灯</a>
                        <a href="">壁灯</a>
                        <a href="">户外灯</a>
                        <a href="">镜前灯</a>                                             
                    </div> 
                </section>
                <section class="content-nav">
                    <h2>家纺家饰</h2>
                    <div class="subnav">                
                        <a href="">床品</a>
                        <a href="">抱枕</a>
                        <a href="">布料</a>
                        <a href="">坐垫</a>
                        <a href="">桌布</a>
                        <a href="">枕头</a>
                        
                    </div>
                    <h2>卫生间</h2>
                    <div class="subnav">               
                        <a href="">浴帘</a>
                        <a href="">衣架</a>
                        <a href="">洗漱套瓶</a>
                        <a href="">杯子</a>
                        <a href="">马桶垫</a>
                        <a href="">防滑垫</a>                   
                    </div>                                    
                    <h2>地毯</h2>
                    <div class="subnav">     
                        <a href="">现代</a>
                        <a href="">古典</a>
                        <a href="">手工</a>
                        <a href="">动物</a>                                             
                    </div>
                </section>
                <section class="content-nav">
                    <h2>花艺植物</h2>        
                    <div class="subnav">                
                        <a href="">多肉植物</a>
                        <a href="">花瓶</a>
                        <a href="">仿真花</a>
                        <a href="">鲜花</a>
                        <a href="">花盆</a>                       
                    </div>
                    <h2>品牌</h2>
                    <div class="subnav">               
                        <a href="">MUJI</a>      
                        <a href="">宜家</a>
                        <a href="">zakka</a>
                        <a href="">baker</a>                                                 
                    </div>                                    
                    <h2>家用小家电</h2>
                    <div class="subnav">     
                        <a href="">微波炉</a>
                        <a href="">烤箱</a>
                        <a href="">面包机</a>
                        <a href="">咖啡机</a> 
                        <a href="">搅拌机</a> 
                        <a href="">其他</a>                                             
                    </div>
                </section>
            </div>              
        </article>
        <article class="main-right">
            <h1>图集分类</h1>
            <section class="content-nav">
                    <h2>设计风格</h2>        
                    <div class="subnav">                
                        <a href="">现代</a>      
                        <a href="">中式</a>
                        <a href="">日式</a>
                        <a href="">新古典</a>
                        <a href="">美式</a> 
                        <a href="">法式</a> 
                        <a href="">田园</a> 
                        <a href="">地中海</a> 
                        <a href="">LOFT</a> 
                        <a href="">北欧</a> 
                        <a href="">混搭</a>                       
                    </div>
                    <h2>空间</h2>
                    <div class="subnav">          
                        <a href="">客厅</a>      
                        <a href="">玄关</a>
                        <a href="">厨房/餐厅</a>
                        <a href="">衣帽间</a> 
                        <a href="">书房</a> 
                        <a href="">卧室</a> 
                        <a href="">儿童房</a> 
                        <a href="">阳台</a> 
                        <a href="">卫生间</a> 
                        <a href="">阁楼</a> 
                        <a href="">庭院</a>                                                 
                    </div>                                    
                    <h2>颜色</h2>
                    <div class="subnav">     
                        <a class="color color1" href=""></a>
                        <a class="color color2" href=""></a>
                        <a class="color color3" href=""></a>
                        <a class="color color4" href=""></a> 
                        <a class="color color5" href=""></a> 
                        <a class="color color6" href=""></a>
                        <a class="color color7" href=""></a> 
                        <a class="color color8" href=""></a>                                              
                    </div>
                </section>
        </article>    
    </header>
    <header class="footer-bottom">
        <ul>
           <li>
              <p><a href="">堆图家首页</a></p>
              <p><a href="">堆图家采集工具</a></p>
              <p><a href="">堆图家官方博客</a></p>              
           </li>
           <li>
              <p><a href="">联系我们</a></p>
              <p><a href="">用户反馈</a></p>
              <p><a href="">堆图家 LOGO 标准文档</a></p>              
           </li>
           <li>
              <p><a href="">堆图家 iphone 端</a></p>
              <p><a href="">堆图家 Android 版</a></p>
              <p><a href="">堆图家 HD</a></p>              
           </li>
           <li>
              <p><a href="">新浪微博：@堆图家网</a></p>
              <p><a href="">官方QQ：1030984323</a></p>
              <p><a href="">官方微信：<i class="fa fa-weixin" ></i></a></p>
              <p><img src="{{ asset('/static/web/images/index-img/footer-bg.jpg')}}"></p>
           </li>
        </ul>
    </header>
</footer>
</body>
</html>
