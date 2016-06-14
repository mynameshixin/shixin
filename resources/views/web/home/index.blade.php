<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家首页'])
<body>
	@include('web.common.banner')
	<div class="container"  style="background: #d0d0d0">
		<div class="w1248 clearfix" id="main" role="main">
			<div class="index_con" id="tiles">
			<?php if(!empty($user_info)){ ?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_user">
							<div class="index_item_utop clearfix">
								<div class="index_item_uava">
									<a href="{{url('webd/user')}}" target="_blank"><img src="{{$user_info['pic_m']}}" alt=""></a>
								</div>
								<div class="index_item_uname"><a href="javascript:;" target="_blank"><?php echo mb_substr($user_info['nick'], 0,6,'utf-8') ?></a></div>
							</div>
							<div class="index_item_umdl clearfix">
								<div class="index_item_umcon">
									<p class="index_item_umnum">{{$user_info['count']['collection_count']}}</p>
									<p class="index_item_umitem">采集</p>
								</div>
								<div class="index_item_umcon">
									<p class="index_item_umnum">{{$user_info['count']['folder_count']}}</p>
									<p class="index_item_umitem">文件夹</p>
								</div>
								<div class="index_item_umcon" style="border-right: 0px;">
									<p class="index_item_umnum">{{$user_info['count']['fans_count']}}</p>
									<p class="index_item_umitem">粉丝</p>
								</div>
							</div>
							<div class="index_item_ubtm clearfix">
								<div class="index_item_ubrec">
									推荐文件夹 <a href="{{url('webd/find')}}" target="_blank" class="index_item_ubrecmore">查看更多</a>
								</div>
							<?php foreach ($recommend as $key => $re):?>
								<div class="index_item_ubfold clearfix">
									<div class="index_item_ubfava">
										<a href="{{url('webd/folder')}}?fid={{$re['id']}}" target="_blank"><img src="{{$re['img_url']}}" alt=""></a>
									</div>
									<div class="index_item_ubfinfo">
										<p class="index_item_ubfnme"><a href="{{url('webd/folder')}}?fid={{$re['id']}}" target="_blank"><?php echo mb_substr($re['name'], 0,8,'utf-8') ?></a></p>
										<p class="index_item_ubffow">{{$re['count']}}文件&nbsp;&nbsp;{{$re['collection_count']}}关注</p>
									</div>
									<a href="javascript:;" class="index_item_ubfatten"><?php echo !empty($re['is_collection'])?'已关注':'关注'; ?></a>
								</div>
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
							<img src="{{$v['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}">
							<div class="index_item_price">￥{{$v['price']}}</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{$v['description']}}">{{$v['description']}}</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">{{$v['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
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

</body>
<script type="text/javascript">
	postUrl = "{{url('webd/home/goods')}}"
	postData = {'num':10}
</script>

<script type="text/javascript" src="{{asset('web')}}/js/pubu.js"></script>
<script type="text/javascript" src="{{asset('web')}}/js/index.js"></script>
</html>