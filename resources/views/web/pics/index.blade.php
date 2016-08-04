<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
	<div class="container nolog_container"  style="background: #fff; padding-top: 15px;">
		<?php if(empty($self_id)): ?>
		<div class="w1248 clearfix">
			<div class="nolog_allcat clearfix">
				<div class="nolog_allcateach nolog_allcateach1">
					<ul class="nolog_catul">
						<li><a href="/webd/search/goods?keyword=现代" target="_blank">现代</a></li>
						<li><a href="/webd/search/goods?keyword=北欧" target="_blank">北欧</a></li>
						<li><a href="/webd/search/goods?keyword=日式" target="_blank">日式</a></li>
						<li><a href="/webd/search/goods?keyword=法式" target="_blank">法式</a></li>
						<li><a href="/webd/search/goods?keyword=简欧" target="_blank">简欧</a></li>
						<li><a href="/webd/search/goods?keyword=古典" target="_blank">古典</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach2">
					<ul class="nolog_catul">
						<li><a href="/webd/search/goods?keyword=新中式" target="_blank">新中式</a></li>
						<li><a href="/webd/search/goods?keyword=新古典" target="_blank">新古典</a></li>
						<li><a href="/webd/search/goods?keyword=东南亚" target="_blank">东南亚</a></li>
						<li><a href="/webd/search/goods?keyword=中式" target="_blank">中式</a></li>
						<li><a href="/webd/search/goods?keyword=LOFT" target="_blank">LOFT</a></li>
						<li><a href="/webd/search/goods?keyword=地中海" target="_blank">地中海</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach3">
					<ul class="nolog_catul">
						
						<li><a href="/webd/search/goods?keyword=工业" target="_blank">工业</a></li>
						<li><a href="/webd/search/goods?keyword=田园" target="_blank">田园</a></li>
						<li style="width: 63px; padding: 0; text-align: right;"><a href="/webd/search/goods?keyword=美式简约" target="_blank">美式简约</a></li>
						<li><a href="/webd/search/goods?keyword=巴洛克" target="_blank">巴洛克</a></li>
						<li><a href="/webd/search/goods?keyword=意大利" target="_blank">意大利</a></li>
						<li style="text-align: right;"><a href="/webd/search/goods?keyword=混搭" target="_blank">混搭</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach4">
					<ul class="nolog_catul">
						<li><a href="/webd/search/goods?keyword=客厅" target="_blank">客厅</a></li>
						<li><a href="/webd/search/goods?keyword=玄关" target="_blank">玄关</a></li>
						<li><a href="/webd/search/goods?keyword=餐厅" target="_blank">餐厅</a></li>
						<li><a href="/webd/search/goods?keyword=卧室" target="_blank">卧室</a></li>
						<li><a href="/webd/search/goods?keyword=阳台" target="_blank">阳台</a></li>
						<li><a href="/webd/search/goods?keyword=厨房" target="_blank">厨房</a></li>
					</ul>
				</div>
				<div class="nolog_allcateach nolog_allcateach5 mrightzero">
					<ul class="nolog_catul">
						<li><a href="/webd/search/goods?keyword=书房" target="_blank">书房</a></li>
						<li><a href="/webd/search/goods?keyword=阳光房" target="_blank">阳光房</a></li>
						<li><a href="/webd/search/goods?keyword=庭院" target="_blank">庭院</a></li>
						<li><a href="/webd/search/goods?keyword=衣帽间" target="_blank">衣帽间</a></li>
						<li><a href="/webd/search/goods?keyword=卫生间" target="_blank">卫生间</a></li>
						<li><a href="/webd/search/goods?keyword=花园" target="_blank">花园</a></li>
					</ul>
				</div>
			</div>
		<?php endif; ?>
		<div id="main" role="main" class="w1248 clearfix">
			<div class="index_con" id="tiles">
			<?php foreach ($goods as $key => $v):?>
				<div class="index_item" img_id="{{$v['id']}}">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap" href="{{url('webd/pic')}}/{{$v['id']}}" target="_blank"></a>
							<img src="{{$v['images'][0]['img_m']}}" style="height: <?php echo $v['images'][0]['rh']."px";?>">
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{!empty(trim($v['description']))?$v['description']:$v['title']}}">{{!empty(trim($v['description']))?$v['description']:$v['title']}}</div>
								<!-- <div class="index_item_rel clearfix" good_id="{{$v['id']}}">
									<a href="javascript:;" class="index_item_l" onclick="praise(this,1)">{{$v['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
									<a href="javascript:;" class="index_item_d" onclick="praise(this,2)">{{$v['boo_count']}}</a>
								</div> -->
							</div>
							<div class="index_item_bottom clearfix">
								<a href="{{url('webd/user')}}?oid={{$v['user']['id']}}" class="index_item_authava authava" target="_blank">
									<img src="{{!empty($v['user']['auth_avatar'])?$v['user']['auth_avatar']:$v['user']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="{{url('webd/user')}}?oid={{$v['user']['id']}}" class="index_item_authname" target="_blank">{{!empty($v['user']['nick'])?$v['user']['nick']:$v['user']['username']}}</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="{{url('webd/folder')}}?fid={{$v['folder_id']}}" target="_blank">{{$v['folder_name']}}</a></p>
								</div>
							</div>
							<?php if(isset($v['comment']) && !empty($v['comment'])): ?>
								<div class="index_item_bottom clearfix comment">
									<a href="{{url('webd/user')}}?oid={{$v['comment']['user']['id']}}" class="index_item_authava" target="_blank">
										<img src="{{!empty($v['comment']['user']['auth_avatar'])?$v['comment']['user']['auth_avatar']:$v['comment']['user']['pic_m']}}" alt="">
									</a>
									<div class="index_item_authinfo index_item_authtalk">
										<a href="{{url('webd/user')}}?oid={{$v['comment']['user']['id']}}" class="index_item_talkname" target="_blank"><?php echo $v['comment']['user']['username']; ?>：</a>
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
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>
<script type="text/javascript">
	postUrl = "{{url('webd/pics/goods')}}"
	postData = {'num':15}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/picpubu.js"></script>
</html>