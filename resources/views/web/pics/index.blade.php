<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家图集页'])
<body style="background: #d0d0d0">
	@include('web.common.banner')
	<div class="container nolog_container">
		@include('web.common.ologin')
		<div class="w1248 clearfix">
			<div class="nolog_allcat clearfix">
				<div class="nolog_allcateach nolog_allcateach1">
					<ul class="nolog_catul">
						<?php foreach ($cate as $key => $v):?>
							<?php if(in_array($key, [0,1,2,3,4,5])):?>
								<li><a href="">{{$v['name']}}</a></li>
							<?php endif;?>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach2">
					<ul class="nolog_catul">
						<?php foreach ($cate as $key => $v):?>
							<?php if(in_array($key, [6,7,8,9,10,11])):?>
								<li><a href="">{{$v['name']}}</a></li>
							<?php endif;?>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach3">
					<ul class="nolog_catul">
						<?php foreach ($cate as $key => $v):?>
							<?php if(in_array($key, [12,13,14,15,16])):?>
								<li><a href="">{{$v['name']}}</a></li>
							<?php endif;?>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach4">
					<ul class="nolog_catul">
						<?php foreach ($cate as $key => $v):?>
							<?php if(in_array($key, [17,18,19,20,21])):?>
								<li><a href="">{{$v['name']}}</a></li>
							<?php endif;?>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach5 mrightzero">
					<ul class="nolog_catul">
						<?php foreach ($cate as $key => $v):?>
							<?php if(in_array($key, [22,23,24,25,26])):?>
								<li><a href="">{{$v['name']}}</a></li>
							<?php endif;?>
						<?php endforeach; ?>
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