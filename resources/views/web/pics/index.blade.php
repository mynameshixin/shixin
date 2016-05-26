<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家图集页'])
<body>
	@include('web.common.banner')
	<div class="container nolog_container"  style="background: #d0d0d0">
		@include('web.common.ologin')
		<div class="w1248 clearfix">
			<div class="nolog_allcat clearfix">
				<div class="nolog_allcateach nolog_allcateach1">
					<ul class="nolog_catul">
						<li><a href="">沙发</a></li>
						<li><a href="">椅子</a></li>
						<li><a href="">书柜</a></li>
						<li><a href="">茶几</a></li>
						<li><a href="">鞋柜</a></li>
						<li><a href="">床品</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach2">
					<ul class="nolog_catul">
						<li><a href="">壁灯</a></li>
						<li><a href="">香薰</a></li>
						<li><a href="">枕头</a></li>
						<li><a href="">地毯</a></li>
						<li><a href="">花瓶</a></li>
						<li><a href="">花盆</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach3">
					<ul class="nolog_catul">
						<li><a href="">现代</a></li>
						<li><a href="">中式</a></li>
						<li><a href="">日式</a></li>
						<li><a href="">美式</a></li>
						<li><a href="">北欧</a></li>
						<li><a href="">田园</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach4">
					<ul class="nolog_catul">
						<li><a href="">客厅</a></li>
						<li><a href="">玄关</a></li>
						<li><a href="">厨房</a></li>
						<li><a href="">卧室</a></li>
						<li><a href="">书房</a></li>
						<li><a href="">阳台</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach5 mrightzero">
					<ul class="nolog_catul">
						<li><a href="">红调</a></li>
						<li><a href="">绿调</a></li>
						<li><a href="">蓝调</a></li>
						<li><a href="">黑色</a></li>
						<li><a href="">白调</a></li>
						<li><a href="">灰调</a></li>
					</ul>
				</div>
			</div>
		<div id="main" role="main" class="w1248 clearfix">
			<div class="index_con" id="tiles">
			<?php foreach ($goods as $key => $v):?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap"></a>
							<img src="{{$v['images'][0]['img_m']}}">
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{$v['description']}}">{{$v['description']}}</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">{{$v['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
									<a href="javascript:;" class="index_item_d">{{$v['boo_count']}}</a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{$v['user']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">{{$v['user']['nick']}}</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart">{{$v['folder_name']}}</p>
								</div>
							</div>
							<?php if(isset($v['comment']) && !empty($v['comment'])): ?>
								<div class="index_item_bottom clearfix comment">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="<?php echo $v['comment']['user']['pic_m']; ?>" alt="">
									</a>
									<div class="index_item_authinfo index_item_authtalk">
										<a href="javascript:;" class="index_item_talkname"><?php echo $v['comment']['user']['username']; ?>：</a>
										<span class="index_item_authto"><?php echo $v['comment']['content']; ?></span>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

			   </div>
			</div>
		</div>
	</div>
	<h1 id='load' style="text-align: center;line-height: 40px; height:40px;color:#999; font-size: 20px; margin-bottom: 30px;display: none">正在加载中。。。</h1>
</body>
<script type="text/javascript">
	postUrl = "{{url('webd/pics/goods')}}"
	postData = {'num':10}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/picpubu.js"></script>
<script type="text/javascript" src="{{asset('web')}}/js/index.js"></script>
</html>