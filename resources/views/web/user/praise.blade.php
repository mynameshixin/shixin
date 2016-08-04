<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
<div id="loads" style="z-index: 9999; position: absolute; left: 0; top:0"></div>
	@include('web.common.banner')
	
	<div class="container">
		@include('web.common.user')
		<script type="text/javascript">user_id="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"</script>
		<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
		<div class="w1248 w1240 clearfix" id="main" role="main">
			<div class="index_main index_con  perhome_wrap" id="tiles">
				<?php foreach ($user_like as $key => $v):?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<!-- <a class="index_item_blurwrap" img_id="{{$v['id']}}" onclick="blurwrap(this)"></a> -->
							<a class="index_item_blurwrap" href="{{url('webd/pic')}}/{{$v['id']}}"  target="_blank" img_id="{{$v['id']}}"></a>
							<img src="{{$v['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}">
							<?php if(isset($v['price']) && !empty($v['price'])): ?>
								<div class="index_item_price">￥{{$v['price']}}</div>
							<?php endif; ?>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{!empty($v['description'])?$v['description']:$v['title']}}">{{!empty($v['description'])?$v['description']:$v['title']}}</div>
								<div class="index_item_rel clearfix" good_id="{{$v['id']}}">
									<a class="index_item_l" onclick="praise(this,1)">{{$v['praise_count']}}</a>
									<a class="index_item_c" onclick="collect(this)">{{$v['collection_count']}}</a>
									<?php if($v['kind'] == 1): ?>
										<a href="{{$v['detail_url']}}" class="index_item_b" target="_blank"></a>
									<?php elseif($v['kind'] == 2):?>
										<a class="index_item_d" onclick="praise(this,2)">{{$v['boo_count']}}</a>
									<?php endif; ?>
								</div>
							</div>
							<?php foreach ($v['comment'] as $k => $value):?>
							<div class="index_item_bottom clearfix comment">
								<a href="{{url('webd/user')}}?oid={{$value['user']['id']}}" class="index_item_authava" target="_blank">
									<img src="{{!empty($value['user']['auth_avatar'])?$value['user']['auth_avatar']:$value['user']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo index_item_authtalk">
									<a href="{{url('webd/user')}}?oid={{$value['user']['id']}}" class="index_item_authname">{{$value['user']['nick']}}：</a>
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
	<a href="javascript:;" id='load' class="detail_pop_baddmore" style="display: none;">正在加载中。。。</a>
	


</body>
<script type="text/javascript">
	postUrl = '{{url("webd/user/goods?oid={$user_id}")}}'
	imgUrl = '{{url("webd/pics/img?oid={$user_id}")}}'
	postData = {'num':10}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/userpubu.js"></script>
</html>