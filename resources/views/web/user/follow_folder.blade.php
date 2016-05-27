<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家关注的文件夹'])
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
				<ul class="find_fold_list clearfix">
					<?php foreach ($user_follow_folder as $key => $value) :?>
					<li class="find_fold_li <?php echo (($key+1)%5==0)?'mrightzero':''; ?>">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="#" target="_blank"><img src="{{$value['user']['pic_m'] or url('uploads/sundry/blogo.jpg')}}" alt=""></a>
							</div>
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">{{$value['name']}}</a>
								<a href="#" target="_blank" class="find_fold_authnme">{{$value['user']['nick'] or $value['user']['username']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{$value['img_url']}}" alt="">
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{$value['folder_goods'][0]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{$value['folder_goods'][1]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{$value['folder_goods'][2]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw">取消关注</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<h1 id='load' style="text-align: center;line-height: 40px; height:40px;color:#999; font-size: 20px; margin-bottom: 30px;display: none">正在加载中。。。</h1>
</body>
</html>