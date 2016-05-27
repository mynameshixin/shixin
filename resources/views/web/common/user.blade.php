<div class="perhome_per_wrap">
			<div class="w1248 w1240 clearfix">
				<div class="perhome_perinfo_wrap clearfix">
					<div class="perhome_perinfo">
						<div class="perhome_perava">
							<img src="{{$user_info['pic_m']}}" alt="">
						</div>
						<div class="perhome_perline">
							<a href="javascript:;" class="otherhome_follow">留言</a>
							<a href="javascript:;" class="otherhome_follow">+关注</a>
							<a href="javascript:;" class="otherhome_follow otherhome_alfollow">已关注</a>
							<a href="javascript:;" class="otherhome_follow otherhome_alfollow">相互关注</a>
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
						<div class="perhome_perlike_wrap clearfix">
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
		</div>