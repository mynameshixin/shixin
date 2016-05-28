<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家用户发布'])
<body>
	@include('web.common.banner')
	<div class="container">
		@include('web.common.user')
		
		<div class="w1248 w1240 clearfix" id="main" role="main">
			<div class="index_con  perhome_wrap" id="tiles">
				<?php foreach ($user_like as $key => $v):?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap"></a>
							<img src="{{$v['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}">
							<?php if(isset($v['price']) && !empty($v['price'])): ?>
								<div class="index_item_price">￥{{$v['price']}}</div>
							<?php endif; ?>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{$v['description'] or $v['title']}}">{{$v['description'] or $v['title']}}</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">{{$v['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
									<a href="" class="index_item_d">{{$v['boo_count']}}</a>
								</div>
							</div>
							<?php foreach ($v['comment'] as $key => $value):?>
							<div class="index_item_bottom clearfix comment">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{$value['user']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo index_item_authtalk">
									<a href="javascript:;" class="index_item_authname">{{$value['user']['nick']}}：</a>
									<span class="index_item_authto">{{$value['content']}}</span>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endforeach;?>
			</div>
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>
<script type="text/javascript">
	postUrl = '{{url("webd/user/goods?oid={$user_id}")}}'
	postData = {'num':10,'kind':2}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/userpubu.js"></script>
</html>