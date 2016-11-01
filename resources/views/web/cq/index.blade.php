<!DOCTYPE html>
<html lang="en">
@include('web.common.cq.head')
<body>
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
	<div class="container nolog_container"  style="background: #fff; padding-top: 15px;">
		<div class="nolog_index_banner" style="background: url({{ asset('/static/web/images/vr')}}/cq_banner.png) top center no-repeat">
	      <div class="w1248 clearfix nolog_index_top">
	        <p class="nolog_index_title">出清商品——闲置二手家居展示</p>
	        <div class="header_search_wrap clearfix">
	          <form action="" method="get">
	            <input type="hidden" value="" name="alias"></input>
	            <input type="text" name="keyword" class="header_search header_search_indexnolog" placeholder="搜索你想看的" value="{{$keyword or ''}}">
	          </form>
	        </div>
	        <p class="nolog_index_subtit">搜索——闲置家居动起来</p>
	      </div>
	    </div>
	    <style type="text/css">
			.w1248 .search-option a{ font-size: 14px;color: #999;display: inline-block;width: 100px;text-align: center; }
			.w1248 .search-option a.red{color: #f00}
			#main .index_item_price strong{ color: #f00; font-size: 18px;padding: 10px }
			#main .index_item_price b{ text-decoration: line-through; }
	    </style>
		<div class="w1248 w1240" style="padding-bottom: 20px">
		    <div class="search-option clearfix">
				<a href="" class="red">最新</a>
				<a href="">我的发布</a>
				<a href="">我的收藏</a>
				<a href="javascript:;" class="popd">发布</a>
				
			</div>
		</div>

		<div id="main" role="main" class="w1248 clearfix">
			<div class="index_con" id="tiles">
			<?php foreach ($goods as $key => $v):?>
				<div class="index_item" img_id="{{$v['id']}}">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap" href="{{url('webd/pic')}}/{{$v['id']}}" target="_blank" title="{{$v['title']}}"></a>
							<img src="{{$v['images'][0]['img_m']}}" style="height: <?php echo $v['images'][0]['rh']."px";?>" onload="resize_xy(this)" alt="{{$v['title']}}">
							<div class="index_item_price"><strong>{{$v['reserve_price']}}</strong><b>{{$v['price']}}</b></div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{$v['title']}}">{{$v['title']}}</div>
								<div class="vr_title">
										<span class="vr_home_loc">{{$v['cityname']}} {{$v['countryname']}}</span>
										<span class="vr_home_ll">{{$v['views']}}浏览</span>
										<span class="vr_home_fb">{{$v['min']}}发表</span>
								</div>
								<div class="index_item_rel clearfix" good_id="{{$v['id']}}">
									<a href="javascript:;" class="index_item_like" onclick="">{{$v['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
									<a href="javascript:;" class="index_item_chat"></a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			<?php endforeach; ?>

			   </div>
			</div>
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>
<script type="text/javascript">
	postUrl = "{{url('webd/cq/goods')}}"
	postData = {'num':10}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/cqpicpubu.js"></script>
</html>