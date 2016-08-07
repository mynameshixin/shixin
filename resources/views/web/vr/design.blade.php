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
				<p class="nolog_index_title">设计家-二手房与家居改</p>
				<div class="header_search_wrap clearfix">
					<input type="text" class="header_search header_search_indexnolog" placeholder="搜索你想看的">
				</div>
				<p class="nolog_index_subtit">搜索——<a href="javascript:;">优秀作品实景展示</a></p>
			</div>
		</div>
		<div class="vr_home home_design">
			<div class="w1248">
				<div class="w990 clearfix">
					<div class="home_title">
						<h3><span>——</span>优秀设计师作品<span>——</span></h3>
					</div>
					<ul class="clearfix" id="ul2">
					<?php foreach ($needData as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" href="{{$v['detail_url']}}" target="_blank"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rect(this)"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">{{$v['cityname'] or '未知地区'}} {{$v['countryname'] or ''}}</span>
								<span class="vr_like">{{$v['praise_count']}}</span>
								<span class="vr_view">{{$v['viewcount'] or '0'}}</span>
							</div>
						</li>
					<?php } ?>
					</ul>
					<div class="des_more"><a href="javascript:;" class="nolog_index_conmore1" type="2" id="des_more2">查看更多。。。</a></div>
				</div>
				<!--二手房改造精选-->
				<div class="w990 clearfix">
					<div class="home_title">
						<h3><span>——</span>二手房改造精选<span>——</span></h3>
					</div>
					<ul class="clearfix" id="ul3">
						<?php foreach ($needData2 as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" href="{{$v['detail_url']}}" target="_blank"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rect(this)"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">{{$v['cityname'] or '未知地区'}} {{$v['countryname'] or ''}}</span>
								<span class="vr_like">{{$v['praise_count']}}</span>
								<span class="vr_view">{{$v['viewcount'] or '0'}}</span>
							</div>
						</li>
						<?php } ?>
						
					</ul>
					<div class="des_more"><a href="javascript:;" class="nolog_index_conmore1" type="3" id="des_more3">查看更多。。。</a></div>
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
<script type="text/javascript">
	var postUrl = '/vrp/design'
	var postData = {}
</script>
<script type="text/javascript" src="{{asset('web/js/vr/design.js')}}"></script>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>