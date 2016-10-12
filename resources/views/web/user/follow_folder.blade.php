<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
	@include('web.common.banner')
	<div class="container">
		@include('web.common.user')	
		<div class="w1248 w1240 clearfix">
			<div class="search_btn_con perhome_follow_wrap clearfix">
				<a href='{{url("webd/user/follow?oid={$user_id}")}}' class="search_btn_lround">关注者</a>
				<a href='{{url("webd/user/followfolder?oid={$user_id}")}}' class="search_btn_rround search_btn_select">文件夹</a>
			</div>
			<div class="find_cater perhome_follow_wrap clearfix">
				<ul class="find_fold_list clearfix" id="ul">
					<?php foreach ($user_follow_folder as $key => $value) :?>
					<li class="find_fold_li <?php echo (($key+1)%5==0)?'mrightzero':''; ?>" folder_id="{{$value['folder_id']}}">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="{{url('webd/user')}}?oid={{$value['user']['id']}}" target="_blank" title="{{!empty($value['user']['nick'])?$value['user']['nick']:$value['user']['username']}}"><img src="{{!empty($value['user']['auth_avatar'])?$value['user']['auth_avatar']:$value['user']['pic_m']}}" alt="{{!empty($value['user']['nick'])?$value['user']['nick']:$value['user']['username']}}"></a>
							</div>
							<div class="find_fold_tname">
								<a href="{{url('webd/folder')}}?fid={{$value['folder_id']}}" target="_blank" class="find_fold_name" title="{{$value['name']}}">{{$value['name']}}</a>
								<a href="{{url('webd/user')}}?oid={{$value['user']['id']}}" target="_blank" class="find_fold_authnme" title="{{!empty($value['user']['nick'])?$value['user']['nick']:$value['user']['username']}}">{{!empty($value['user']['nick'])?$value['user']['nick']:$value['user']['username']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<a href="{{url('webd/folder')}}?fid={{$value['folder_id']}}" target="_blank" class="position" title="{{$value['name']}}"><img src="{{$value['img_url']}}" alt="{{$value['name']}}" onload="rect(this)"></a>
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['folder_goods'][0]['id'] or 'javascript:;'}}" target="_blank" class="position" title="{{!empty(trim($value['folder_goods'][0]['description']))?$value['folder_goods'][0]['description']:$value['folder_goods'][0]['title']}}"><img src="{{$value['folder_goods'][0]['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}" alt="{{!empty(trim($value['folder_goods'][0]['description']))?$value['folder_goods'][0]['description']:$value['folder_goods'][0]['title']}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['folder_goods'][1]['id'] or 'javascript:;'}}" target="_blank" class="position" title="{{!empty(trim($value['folder_goods'][1]['description']))?$value['folder_goods'][1]['description']:$value['folder_goods'][1]['title']}}"><img src="{{$value['folder_goods'][1]['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}" alt="{{!empty(trim($value['folder_goods'][1]['description']))?$value['folder_goods'][1]['description']:$value['folder_goods'][1]['title']}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['folder_goods'][2]['id'] or 'javascript:;'}}" target="_blank" class="position" title="{{!empty(trim($value['folder_goods'][2]['description']))?$value['folder_goods'][2]['description']:$value['folder_goods'][2]['title']}}"><img src="{{$value['folder_goods'][2]['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}" alt="{{!empty(trim($value['folder_goods'][2]['description']))?$value['folder_goods'][2]['description']:$value['folder_goods'][2]['title']}}"></a>
							</div>
						</div>
						<a onclick="relation(this)" class="find_fold_authflw" <?php  if($value['user']['id']==$self_id):?>style="display: none"<?php endif; ?>>
							<?php 
								echo $value['is_follow']?"已关注":"<span>+</span>特别关注";
							?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>
<script type="text/javascript">
	postUrl = '{{url("webd/user/followfolder?oid={$user_id}")}}'
	postData = {'num':15}

</script>
<script type="text/javascript" src="{{asset('web')}}/js/user/followfolder.js"></script>
</html>