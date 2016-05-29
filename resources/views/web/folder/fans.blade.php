<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家文件夹'])
<body>
	@include('web.common.banner')
	<div class="container">
		@include('web.common.folder')
		<div class="w1248 w1240 clearfix">
			<div class="find_cater detail_cater clearfix">
				<ul class="find_fold_list clearfix" id="ul">
					<?php foreach ($user_fans as $key => $value) :?>
					<li class="find_user_li <?php echo (($key+1)%5==0)?'mrightzero':''; ?>" user_id="{{$value['user']['id']}}">
						<div class="find_user_info">
							<a href="javascript:;" class="find_user_name">{{empty($value['user']['nick'])?$value['user']['username']:$value['user']['nick']}}</a>
							<a href="javascript:;" class="find_user_rela">{{$value['count']['fans_count']}}粉丝 {{$value['count']['follow_count']}}关注</a>
						</div>
						<div class="find_user_con clearfix">
							<div class="find_user_img">
								<div class="find_user_blur"></div>
								<img src="{{$value['user']['pic_m'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
							<ul class="find_user_limg">
								<li>
									<div class="find_user_blur"></div>
									<img src="{{$value['folders'][0]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
								</li>
								<li>
									<div class="find_user_blur"></div>
									<img src="{{$value['folders'][1]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
								</li>
								<li>
									<div class="find_user_blur"></div>
									<img src="{{$value['folders'][2]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
								</li>
								<li>
									<div class="find_user_blur"></div>
									<img src="{{$value['folders'][3]['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
								</li>
							</ul>
							<a onclick="relation(this)" class="find_user_authflw">
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
	postUrl = '{{url("webd/folder/folders")}}?oid={{$user_id}}&fid={{$self_id}}'
	postData = {'num':15,'kind':2}
</script>

<script type="text/javascript" src="{{asset('web')}}/js/folder/fansfollow.js"></script>

<script type="text/javascript">
		$(function() {
		    
		    $('.detail_filebtn_click').click(function(){
		    	event.stopPropagation();
		    	if ($(this).siblings('.detail_fileb_select').hasClass('slideup')) {
		    		$('.detail_fileb_select').addClass('slideup');
		    		$(this).siblings('.detail_fileb_select').removeClass('slideup').addClass('slidedown');
		    		var isOut = true;
		    	}else{
		    		$('.detail_fileb_select').addClass('slideup');
		    		$(this).siblings('.detail_fileb_select').removeClass('slidedown').addClass('slideup');
		    	};
		    	window.document.onclick = function(){
			    	if(isOut){
			            $('.detail_fileb_select').removeClass('slidedown').addClass('slideup');
			        }else{
			        	$('.detail_fileb_select').removeClass('slideup').addClass('slidedown');
			        }
			    }
		    });
		});
	</script>
</html>






