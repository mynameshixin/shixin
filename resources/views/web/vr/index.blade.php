@include('web.common.vr.head')

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
 @include('web.common.banner.my')
    </div>
  </div>
 @include('web.common.daction')

 <div class="container nolog_index_container clearfix">
		<div class="nolog_index_banner" style="background: url({{ asset('/static/web/images/index-img/index-banner.jpg')}}) top center no-repeat">
			<div class="w1248 clearfix nolog_index_top">
				<p class="nolog_index_title">梦幻家——VR展示住宅空间</p>
				<div class="header_search_wrap clearfix">
					<input type="text" class="header_search header_search_indexnolog" placeholder="搜索你想看的">
				</div>
				<p class="nolog_index_subtit">搜索——<a href="javascript:;">身临其境的看房体验</a></p>
			</div>
		</div>
		<div class="vr_home">
			<div class="w1248">
				<div class="w990 clearfix">
					<ul class="clearfix">
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}//images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list mrightzero">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list mrightzero">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
						<li class="vr_home_list mrightzero">
							<div class="vr_content">
								<a class="index_item_vrlogo"></a>
								<span>绿洲中环三居室样板房</span>
								<img src="{{asset('web')}}/images/vr_pic1.png"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">上海 普陀区</span>
								<span class="vr_like">68</span>
								<span class="vr_view">253</span>
							</div>
						</li>
					</ul>
					<div class="des_more"><a href="#">看看其它</a></div>
				</div>
			</div>
			<div class="cooperate">
				<img src="{{asset('web')}}/images/app_logo.png"/>
				<h2>成为堆图家合作开发商，获得更多样板房展示机会</h2>
				<a href="">了解更多</a>
			</div>
		</div>
		
	</div>
@include('web.common.foot')
@include('web.common.login',['index'=>1])
</body>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>