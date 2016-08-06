<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
	<script type="text/javascript">
		var self_id = "{{$self_id}}"
		relationUrl = "{{url('webd/user/relation')}}"
	</script>
	<script type="text/javascript" src="{{asset('web')}}/js/user/relation.js"></script>
	<div class="container"  style="background: #fff">
		<div class="w1248 clearfix" id="main" role="main">
			<div class="index_con" id="tiles">
			<?php if(!empty($user_info)){ ?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_user">
							<div class="index_item_utop clearfix">
								<div class="index_item_uava">
									<a href="{{url('webd/user')}}" target="_blank"><img src="{{!empty($user_info['auth_avatar'])?$user_info['auth_avatar']:$user_info['pic_m']}}" alt=""></a>
								</div>
								<div class="index_item_uname"><a href="javascript:;" target="_blank"><?php echo mb_substr($user_info['nick'], 0,6,'utf-8') ?></a></div>
							</div>
							<div class="index_item_umdl clearfix">
								<div class="index_item_umcon">
									<p class="index_item_umnum"><a href="/webd/user?oid={{$user_info['id']}}" title="采集">{{$user_info['count']['collection_count']}}</a></p>
									<p class="index_item_umitem">采集</p>
								</div>
								<div class="index_item_umcon">
									<p class="index_item_umnum"><a href="/webd/user?oid={{$user_info['id']}}" title="文件夹">{{$user_info['count']['folder_count']}}</a></p>
									<p class="index_item_umitem">文件夹</p>
								</div>
								<div class="index_item_umcon" style="border-right: 0px;">
									<p class="index_item_umnum"><a href="/webd/user/fans?oid={{$user_info['id']}}" title="粉丝">{{$user_info['count']['fans_count']}}</a></p>
									<p class="index_item_umitem">粉丝</p>
								</div>
							</div>
							<div class="index_item_ubtm clearfix">
								<div class="index_item_ubrec">
									推荐文件夹 <a href="{{url('webd/find')}}" target="_blank" class="index_item_ubrecmore">查看更多</a>
								</div>
							<?php foreach ($recommend as $key => $re):?>
								
								<li folder_id="{{$re['id']}}">
								<div class="index_item_ubfold clearfix">
									<div class="index_item_ubfava">
										<a href="{{url('webd/folder')}}?fid={{$re['id']}}" target="_blank"><img src="{{$re['img_url']}}" alt=""></a>
									</div>
									<div class="index_item_ubfinfo">
										<p class="index_item_ubfnme"><a href="{{url('webd/folder')}}?fid={{$re['id']}}" target="_blank"><?php echo mb_substr($re['name'], 0,8,'utf-8') ?></a></p>
										<p class="index_item_ubffow">{{$re['count']}}文件&nbsp;&nbsp;{{$re['collection_count']}}关注</p>
									</div>
									<?php if($re['user_id'] != $self_id): ?>
									<a class="index_item_ubfatten" onclick="relation(this)"><?php echo !empty($re['is_collection'])?'已关注':'<span>+</span>特别关注'; ?></a>
									<?php endif; ?>
								</div>
								</li>
							
							<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php }else{ ?>
					<div class="index_item"></div>
			<?php } ?>
			<?php foreach ($goods as $key => $v):?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap" href="{{url('webd/pic/')}}/{{$v['id']}}" target="_blank"></a>
							<img src="{{$v['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}" style="height: {{$v['images'][0]['rh']}}px" onload="resize_xy(this)">
							<div class="index_item_price"><?php echo strpos($v['detail_url'],'m.fancy.com')?'$':'￥'; ?>{{$v['price']}}</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{$v['description']}}">{{$v['description']}}</div>
								<div class="index_item_rel clearfix" good_id="{{$v['id']}}">
									<a  class="index_item_l" onclick="praise(this,1)">{{$v['praise_count']}}</a>
									<a  class="index_item_c" onclick="collect(this)">{{$v['collection_count']}}</a>
									<a href="{{$v['detail_url']}}" target="_blank" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="{{url('webd/user')}}?oid={{$v['user']['id']}}" class="index_item_authava" target="_blank">
									<img src="{{!empty($v['user']['auth_avatar'])?$v['user']['auth_avatar']:$v['user']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="{{url('webd/user')}}?oid={{$v['user']['id']}}" target="_blank" class="index_item_authname">{{!empty($v['user']['nick'])?$v['user']['nick']:$v['user']['username']}}</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="{{url('webd/folder')}}?fid={{$v['folder_id']}}" target="_blank">{{$v['folder_name']}}</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
<div class="detail_pop_o" style="display: none"></div>
</body>

<script type="text/javascript">
$(function(){
	/*$(document).pjax('a.index_item_blurwrap', '.detail_pop_o', {fragment:'.detail_pop', timeout:5000,cache:false});
	$(document).on('pjax:send', function() {
	    layer.load(0, {shade: 0.5});
	});
	$(document).on('pjax:complete', function() {
	    layer.closeAll('loading');
	    $('body').css({'overflow':'hidden'})
	    $('.detail_pop_o').show()
	});*/
})
</script>

<script type="text/javascript">
	postUrl = "{{url('webd/home/goods')}}"
	postData = {'num':15}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/pubu.js"></script>

</html>