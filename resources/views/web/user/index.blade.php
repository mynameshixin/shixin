<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家用户文件夹'])
<body>
	@include('web.common.banner')
	<div class="container">
		@include('web.common.user')
		
		<div class="w1248 w1240 clearfix">
			<div class="find_cater perhome_wrap clearfix">
			
				<ul class="find_fold_list clearfix" id="ul0">

				<?php foreach ($folders as $key => $value) :?>
					<?php if($value['private'] == 0): ?>
					<li class="find_fold_li <?php echo ($key+1)%5 == 0?'mrightzero':''; ?>" folder_id="{{$value['id']}}">
						<div class="find_fold_info clearfix">
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">{{$value['name']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{$value['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="" onload="rect(this)">
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{ $value['goods'][0]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{ $value['goods'][1]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{ $value['goods'][2]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
						</div>
						<a  onclick="relation(this)" class="find_fold_authflw">
						<?php 
						if($user_id == $self_id){
							echo "编辑";
						}else{
							echo $value['is_follow']?"已关注":"<span>+</span>特别关注";
						}
						?></a>
					</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>
			<a href="javascript:;" id='more' class="detail_pop_baddmore" private="0">查看更多。。。</a>
			<?php if($user_id == $self_id):?>
			<p class="perhome_addprivate">创建隐私文件夹，只有你自己可以看得见哦</p>
			<div class="find_cater perhome_wrap clearfix">
				<ul class="find_fold_list clearfix" id="ul1">
					<?php foreach ($folders_private as $key => $value) :?>
					<?php if($value['private'] == 1): ?>
					<li class="find_fold_li <?php echo ($key+1)%5 == 0?'mrightzero':''; ?>">
						<div class="find_fold_info clearfix">
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{$value['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="" onload="rect(this)">
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($value['goods'][0]['image_url'])?$value['goods'][0]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($value['goods'][1]['image_url'])?$value['goods'][1]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($value['goods'][2]['image_url'])?$value['goods'][2]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw">编辑</a>
					</li>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<a href="javascript:;" id='more1' class="detail_pop_baddmore" private="1">查看更多。。。</a>
		<?php endif; ?>
		</div>
	</div>
	
</body> 

<script type="text/javascript">
	postUrl = '{{url("webd/user/folders?oid={$user_id}")}}'
	postData = {'num':10}
</script>

<script type="text/javascript" src="{{asset('web')}}/js/user/folders.js"></script>
</html>