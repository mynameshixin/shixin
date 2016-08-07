<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
	@include('web.common.banner')
	<div class="container">
		@include('web.common.user')
		
		<div class="w1248 w1240 clearfix">
			<div class="index_con  perhome_wrap">
				<ul class="find_fold_list clearfix" id="ul">
					<?php foreach ($user_fans as $key => $value) :?>
					<li class="find_user_li <?php echo (($key+1)%5==0)?'mrightzero':''; ?>" user_id="{{$value['id']}}">
						<div class="find_user_info">
							<a href="{{url('webd/user')}}?oid={{$value['id']}}" class="find_user_name" target="_blank" title="{{empty($value['nick'])?$value['username']:$value['nick']}}">{{empty($value['nick'])?$value['username']:$value['nick']}}</a>
							<a href="javascript:;" class="find_user_rela">{{$value['count']['fans_count']}}粉丝 {{$value['count']['follow_count']}}关注</a>
						</div>
						<div class="find_user_con clearfix">
							<div class="find_user_img">
								<div class="find_user_blur"></div>
								<a href="{{url('webd/user')}}?oid={{$value['id']}}" class="position" target="_blank" title="{{empty($value['nick'])?$value['username']:$value['nick']}}"><img src="{{!empty($value['auth_avatar'])?$value['auth_avatar']:$value['pic_m']}}" alt="{{empty($value['nick'])?$value['username']:$value['nick']}}"></a>
							</div>
							<ul class="find_user_limg">
								<li>
									<div class="find_user_blur"></div>
									<a href="{{url('webd/folder')}}?fid={{$value['folders'][0]['id'] or '#'}}" class="position" target="_blank" title="{{$value['folders'][0]['name'] or '堆图家'}}"><img src="{{$value['folders'][0]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['folders'][0]['name'] or '堆图家'}}"></a>
								</li>
								<li>
									<div class="find_user_blur"></div>
									<a href="{{url('webd/folder')}}?fid={{$value['folders'][1]['id'] or '#'}}" class="position" target="_blank" title="{{$value['folders'][1]['name'] or '堆图家'}}"><img src="{{$value['folders'][1]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['folders'][1]['name'] or '堆图家'}}"></a>
								</li>
								<li>
									<div class="find_user_blur"></div>
									<a href="{{url('webd/folder')}}?fid={{$value['folders'][2]['id'] or '#'}}" class="position" target="_blank" title="{{$value['folders'][2]['name'] or '堆图家'}}"><img src="{{$value['folders'][2]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['folders'][2]['name'] or '堆图家'}}"></a>
								</li>
								<li>
									<div class="find_user_blur"></div>
									<a href="{{url('webd/folder')}}?fid={{$value['folders'][3]['id'] or '#'}}" class="position" target="_blank" title="{{$value['folders'][3]['name'] or '堆图家'}}"><img src="{{$value['folders'][3]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['folders'][3]['name'] or '堆图家'}}"></a>
								</li>
							</ul>
							
							<a onclick="relation(this)" class="find_user_authflw" <?php if($self_id==$value['id']): ?>style="display: none"<?php endif; ?>>
								<?php 
								switch ($value['relation']) {
									case '1':
										echo '相互关注';
										break;
									case '2':
										echo '已关注';
										break;
									case '4':
										echo '<span>+</span>关注';
										break;
									default:
										echo '<span>+</span>关注';
										break;
								} ?>
							</a>
							
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>

<script type="text/javascript">
	postUrl = '{{url("webd/user/fanfollow?oid={$user_id}")}}'
	postData = {'num':15}
</script>

<script type="text/javascript" src="{{asset('web')}}/js/user/fansfollow.js"></script>
</html>