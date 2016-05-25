<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家图集页'])
<body>
	@include('web.common.banner')
	<div class="container nolog_container">
		<div class="nolog_adv_wrap" style="background: url({{asset('web')}}/images/nolog_bg.jpg)">
			<div class="w1248 clearfix">
				<div class="nolog_title">
					<p class="nolog_headline">链接全球家居商品，家居图片</p>
					<p class="nolog_subhead">集分享，交友为一体的家居互联网交流分享平台</p>
				</div>
				<div class="nolog_loginway">
					<div class="nolog_waywrap">
						<div class="nolog_waya nolog_wwchat"></div>
						<div class="nolog_waya nolog_wqq"></div>
					</div>
					<p class="nolog_waytips">——  用以上社交账号直接登录  ——</p>
				</div>
			</div>
		</div>
		<div class="nolog_adv_wrapscroll">
			<div class="nolog_adv_scroll"></div>
			<div class="w1248 clearfix">
				<div class="nolog_title">
					<p class="nolog_headline">链接全球家居商品，家居图片</p>
					<p class="nolog_subhead">集分享，交友为一体的家居互联网交流分享平台</p>
				</div>
				<div class="nolog_loginway">
					<span class="nolog_waytips">用社交账号直接登录：</span>
					<div class="nolog_waywrap">
						<div class="nolog_waya nolog_wwchat"></div>
						<div class="nolog_waya nolog_wqq"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="w1248 clearfix">
			<div class="nolog_allcat clearfix">
				<div class="nolog_allcateach nolog_allcateach1">
					<ul class="nolog_catul">
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach2">
					<ul class="nolog_catul">
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach3">
					<ul class="nolog_catul">
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach4">
					<ul class="nolog_catul">
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach5 mrightzero">
					<ul class="nolog_catul">
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
						<li><a href="javascript:;">沙发</a></li>
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
							<div class="index_item_price">￥{{$v['price']}}</div>
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
								<div class="index_item_bottom clearfix">
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
	postData = {'num':9}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/picpubu.js"></script>
<script type="text/javascript" src="{{asset('web')}}/js/index.js"></script>
</html>