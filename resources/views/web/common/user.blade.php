<script type="text/javascript">
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	user_id = "{{$user_id}}"
	self_id = "{{$self_id}}"
	relationUrl = "{{url('webd/user/relation')}}"
</script>
<script src="{{url('web/js/user/relation.js')}}"></script>
<script src="{{url('web/js/user/blurwrap.js')}}"></script>

<div class="perhome_per_wrap">
			<div class="w1248 w1240 clearfix">
				<div class="perhome_perinfo_wrap clearfix">
					<div class="perhome_perinfo">
						<div class="perhome_perava">
							<img src="{{!empty($user_info['auth_avatar'])?$user_info['auth_avatar']:$user_info['pic_m']}}" alt="">
						</div>
						<div class="perhome_perline">
							<a href="javascript:;" class="otherhome_follow">留言</a>
							<?php if($user_id!=$self_id){ ?>
							<a href="javascript:;" onclick="relation(this)" class="otherhome_follow otherhome_alfollow" user_id="{{$user_id}}">
							<?php 
								switch ($user_info['t_relation']) {
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
								}
							?>
							</a>
							<?php } ?>
						</div>
						<div class="perhome_perdes">
							<div class="perhome_pername">
								{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}
							</div>
							<div class="perhome_perwechat">
								微信号：{{empty(trim($user_info['wechat']))?'木有填写':$user_info['wechat']}}
							</div>
							<div class="perhome_persketch">
								签名：{{empty($user_info['signature'])?'用户太懒什么也没有留下':$user_info['signature']}}
		                    </div>
						</div>
								
							</div>
						</div>
			</div>
			<div class="perhome_perlike_wrap clearfix" style="width: 100%;background:#fff;">
				<div class="w1248 w1240 clearfix">
					<div class="perhome_cater_info" style="display:none">
						<div class="perhome_scroll_ava">
							<img src="{{!empty($user_info['auth_avatar'])?$user_info['auth_avatar']:$user_info['pic_m']}}" alt="">
						</div>
						<div class="perhome_scroll_name">{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}</div>
					</div>
					
					<div class="perhome_cater_wrap clearfix" style="width: 690px;margin: auto;padding: 6px 0px;">
						<a href='{{url("webd/user/index?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==1?'perhome_perlike_lon':''; ?>">
						<p class="perhome_perlike_num">{{$user_info['count']['folder_count']}}</p>
						<p class="perhome_perlike_la">文件夹</p>
						</a>
						<a href='{{url("webd/user/praise?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==2?'perhome_perlike_lon':''; ?>">
							<p class="perhome_perlike_num">{{$user_info['count']['praise_count']}}</p>
							<p class="perhome_perlike_la">喜欢</p>
						</a>
						<a href='{{url("webd/user/pub?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==3?'perhome_perlike_lon':''; ?>">
							<p class="perhome_perlike_num">{{$user_info['count']['pub_count']}}</p>
							<p class="perhome_perlike_la">发布</p>
						</a>
						<a href='{{url("webd/user/fans?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==4?'perhome_perlike_lon':''; ?>">
							<p class="perhome_perlike_num">{{$user_info['count']['fans_count']}}</p>
							<p class="perhome_perlike_la">粉丝</p>
						</a>
						<a href='{{url("webd/user/follow?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==5?'perhome_perlike_lon':''; ?>">
							<p class="perhome_perlike_num">{{$user_info['count']['follow_count']}}</p>
							<p class="perhome_perlike_la">关注</p>
						</a>
					</div>
				</div>
			</div>
</div>

<script type="text/javascript">
	$(window).scroll(function(event) {
		var scrollHei = $('body').scrollTop();
		if (scrollHei <= 260) {
			$('.perhome_perlike_wrap').css({
				'position':'relative',
				'top':0,
				'border-top':'0px solid #eaeaea'
			});
			$('.perhome_cater_info').hide();
		}else{
			$('.perhome_perlike_wrap').css({
				'position':'fixed',
				'top':40,
				'z-index':3,
				'border-top':'1px solid #eaeaea'
			});
			$('.perhome_cater_info').show();
		};
	});
</script>