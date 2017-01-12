<script type="text/javascript">
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	user_id = "{{$user_id}}"
	self_id = "{{$self_id}}"
	relationUrl = "{{url('webd/user/relation')}}"
</script>
<script src="{{url('web/js/user/relation.js')}}"></script>
<script src="{{url('web/js/user/blurwrap.js')}}"></script>
<style>
	.fl {
    float: left;
}
.yuan{
	 border-radius:50%; overflow:hidden;
	 width: 100px;

}
.fr {
    float: right;
}
.clearfix:after {content:""; display:block; height:0; visibility:hidden; clear:both; }
.clearfix { *zoom:1; }
.top{
	width: 1250px;
	margin: 0 auto;

}
.top_menu{
		box-shadow: 2px 0px 5px #c5c5c5;
}
.logo{
	width: 85px;
	height: 68px;
}
.nav li{
	height: 68px;
	line-height: 68px;
	margin-left:29px;
	float: left;
}
.nav li a{
	color: #000;
}
.scb input{
	width: 688px;
	height: 40px;
	border: 1px solid #c5c5c5;
	margin-top: 15px;
	border-radius: 6px;
	font-size: 15px;
	padding-left: 5px;
}
.top_mn {
	margin-left: 10px;
}
.top_mn div{
	height: 68px;
	width: 70px;
	border-left: 1px solid #ebebeb;
}
.main{
	width: 1250px;
	margin:0 auto;
}
.main_info_top{
	width: 1197px;
	padding: 15px 35px 25px 18px;
}
.main_info_top_user{
	padding-left: 15px;
}
.main_info_top_btn a{
	background: #e15335;
	display: inline-block;
	color: #fff;
	padding: 8px 10px;
	text-align: center;
	border-radius: 5px;
	margin-top: 12px;
}
.main_info_middle{
	padding: 0 0 20px 30px;
}
.main_info_middle_info{
	width: 512px;
}
.main_info_middle_info p{
	color: #aba8a8;
}
.main_info_bottom{
	padding: 18px 35px 12px 30px;
	border-top: 1px solid #767676;
}
.main_info_bottom_menu{
	margin-left: 284px;
}
.main_info_bottom_menu li{
	text-align: center;
	float: left;
	margin-right: 105px;
}
.main_info_bottom_menu li a {
	color: #ababab;
}
.main_info_bottom_menu li a:hover {
	color: #e15335;
}
.main_info_bottom_menu li a strong{
	display: block;
}
.main_info_bottom_menu li a span{
	display: block;
}
.main_info_bottom_btn a{
	color: #fff;
	background:url(../images/sj.png) 55px center no-repeat #e15335;
	display: block;
	width: 75px;
	height: 35px;
	border-radius: 5px;
	line-height: 35px;
	text-indent:20px; 

}

.main_info{
background: url(/web/images/btm.png) left center no-repeat;background-position:0px ;
}
.user_bg{
	background: url(/web/images/usbg.png) right center no-repeat;
}
#div2{
	position: relative;
  
  top: -60px;
}
</style>

<div id="div1"  >

<div class="perhome_per_wrap">
			<div class="w1248 w1240 clearfix">
				<div class="perhome_perinfo_wrap clearfix">
					<div class="perhome_perinfo">
						<div class="perhome_perava">
							<img src="{{!empty($user_info['auth_avatar'])?$user_info['auth_avatar']:$user_info['pic_m']}}" alt="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}">
						</div>
						<div class="perhome_perline">
							<?php if($user_id!=$self_id){ ?>
							<a href="javascript:;" class="otherhome_follow otherhome_sendmess" onclick="getMessage(this)" to_id="{{$user_id}}">留言</a>
							<?php } ?>
							<?php if($user_id!=$self_id){ ?>
							<a href="javascript:;" onclick="relation(this)" class="otherhome_follow otherhome_alfollow" user_id="{{$user_id}}" title="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}">

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
							<a href="/webd/user?oid={{$user_info['id']}}" target="_blank" title="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}"><img src="{{!empty($user_info['auth_avatar'])?$user_info['auth_avatar']:$user_info['pic_m']}}" alt="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}"></a>
						</div>
						<div class="perhome_scroll_name">{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}</div>
					</div>
								<?php if($user_info['role']==3) {?>
								<img src="{{url("web/images/std.png")}}" alt="隐藏" class="mingpian" onclick="mdis(this)" style="float:left;margin-top:9px;">
								<?php }else{ ?>
								<img src="{{url("web/images/mp.png")}}" alt="隐藏" class="mingpian" onclick="mdis(this)" style="float:left;margin-top:9px;">
								<?php } ?>
					<div class="perhome_cater_wrap clearfix" style="width: 690px;margin: auto;padding: 6px 0px;">
					
						<a href='{{url("webd/user/index?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==1?'perhome_perlike_lon':''; ?>" title="文件夹">
						<p class="perhome_perlike_num">{{$user_info['count']['folder_count']}}</p>
						<p class="perhome_perlike_la">文件夹</p>
						</a>
						<a href='{{url("webd/user/praise?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==2?'perhome_perlike_lon':''; ?>" title="喜欢">
							<p class="perhome_perlike_num">{{$user_info['count']['praise_count']}}</p>
							<p class="perhome_perlike_la">喜欢</p>
						</a>
						<a href='{{url("webd/user/pub?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==3?'perhome_perlike_lon':''; ?>" title="发布">
							<p class="perhome_perlike_num">{{$user_info['count']['pub_count']}}</p>
							<p class="perhome_perlike_la">发布</p>
						</a>
						<a href='{{url("webd/user/fans?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==4?'perhome_perlike_lon':''; ?>" title="粉丝">
							<p class="perhome_perlike_num">{{$user_info['count']['fans_count']}}</p>
							<p class="perhome_perlike_la">粉丝</p>
						</a>
						<a href='{{url("webd/user/follow?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==5?'perhome_perlike_lon':''; ?>" title="关注">
							<p class="perhome_perlike_num">{{$user_info['count']['follow_count']}}</p>
							<p class="perhome_perlike_la">关注</p>
						</a>

						<div class="detail_pop_tbtn detail_pop_tbtnright" style="float: none;position: absolute;right: 0">
							<div class="detail_pop_tbtn_click detail_fileb_pr">
								分享
								<var class="detail_pop_tbtntril"></var>
							</div>
							<div class="detail_fileb_select slideup">
								<div class="detail_fileb_selectw">
									<span class="jiathis_style_32x32" id="own_share">
										<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
										<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
										<a class="jiathis_button_tsina detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/weibo.png" height="19" width="19" alt="">微博</a>
										<a class="jiathis_button_douban detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/douban.png" height="19" width="19" alt="">豆瓣</a>
									</span>
									<var class="detail_fileb_setril"></var>
								</div>
							</div>
						</div>
						<!-- JiaThis Button BEGIN -->
						<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
						<!-- JiaThis Button END -->
					</div>

					

				</div>

				

			</div>
</div>
</div>
</div>

<div id="div2" style="margin-top:-60px;display:none;">
		<div class="">
					<div class="w1248 w1240 clearfix">
						<div class=" clearfix">
							<div class="">
									<div class="main">
								    <div class="user_bg">
									<div class="main_info clearfix">
										<div class="main_info_top clearfix">
											<img src="{{!empty($user_info['auth_avatar'])?$user_info['auth_avatar']:$user_info['pic_m']}}" alt="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}" class="fl yuan" />
											<div class="main_info_top_user fl">
												<a href="###"><p style=" color:#000;padding-bottom: 15px;font-size: 17px;">{{$user_info['username']}}</p></a>
												<a href="###"><p style="color: #aba8a8;">联系方式：{{!empty($user_info['wechat'])?$user_info['wechat']:$user_info['mobile']}}</p></a>
											</div>
											<div class="main_info_top_btn fr">
									
									<?php if($user_id!=$self_id){ ?>
									<a href="javascript:;" class="otherhome_follow otherhome_sendmess" onclick="getMessage(this)" to_id="{{$user_id}}">留言</a>
									<?php } ?>
									<?php if($user_id!=$self_id){ ?>
									<a href="javascript:;" onclick="relation(this)" class="otherhome_follow otherhome_alfollow" user_id="{{$user_id}}" title="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}">

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
										</div>
										<div class="main_info_middle" style="position: relative;">
										<div  class="main_info_middle_info" >
											<p>{{$user_info['rolename']}}</p>
											<p>{{$user_info['signature']}}  </p>
								<p style="padding-left: 40px;background: url(images/dw.png) left center no-repeat; line-height: 35px;margin-top: 18px;">{{$user_info['location']}}</p>
										</div>

										<?php if($user_info['vr']['detail_url']){ ?>
											<a href="{{$user_info['vr']['detail_url']}}"><img src="/web/images/vr_t.png" style="position: absolute;top: 0px;left: 884px;"></a>			
										<?php }; ?>
										</div>
										<div class="perhome_perlike_wrap clearfix" style="width: 100%;">
						<div class="w1248 w1240 clearfix">
							<div class="perhome_cater_info" style="display:none">
								<div class="perhome_scroll_ava">
									<a href="/webd/user?oid={{$user_info['id']}}" target="_blank" title="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}"><img src="{{!empty($user_info['auth_avatar'])?$user_info['auth_avatar']:$user_info['pic_m']}}" alt="{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}"></a>
								</div>
								<div class="perhome_scroll_name">{{empty($user_info['nick'])?$user_info['username']:$user_info['nick']}}</div>
							</div>
							<!-- 第二页 -->
								<?php if($user_info['role']==3) {?>
								<img src="{{url("web/images/std.png")}}" alt="隐藏" class="mingpian" onclick="mdis(this)" style="float:left;margin-top:9px;">
								<?php }else{ ?>
								<img src="{{url("web/images/mp.png")}}" alt="隐藏" class="mingpian" onclick="mdis(this)" style="float:left;margin-top:9px;">
								<?php } ?>
							<div class="perhome_cater_wrap clearfix" style="width: 690px;margin: auto;padding: 6px 0px;">
								
								<a href='{{url("webd/user/index?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==1?'perhome_perlike_lon':''; ?>" title="文件夹">
								<p class="perhome_perlike_num">{{$user_info['count']['folder_count']}}</p>
								<p class="perhome_perlike_la">文件夹</p>
								</a>
								<a href='{{url("webd/user/praise?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==2?'perhome_perlike_lon':''; ?>" title="喜欢">
									<p class="perhome_perlike_num">{{$user_info['count']['praise_count']}}</p>
									<p class="perhome_perlike_la">喜欢</p>
								</a>
								<a href='{{url("webd/user/pub?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==3?'perhome_perlike_lon':''; ?>" title="发布">
									<p class="perhome_perlike_num">{{$user_info['count']['pub_count']}}</p>
									<p class="perhome_perlike_la">发布</p>
								</a>
								<a href='{{url("webd/user/fans?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==4?'perhome_perlike_lon':''; ?>" title="粉丝">
									<p class="perhome_perlike_num">{{$user_info['count']['fans_count']}}</p>
									<p class="perhome_perlike_la">粉丝</p>
								</a>
								<a href='{{url("webd/user/follow?oid={$user_id}")}}' class="perhome_perlike_label <?php echo $type==5?'perhome_perlike_lon':''; ?>" title="关注">
									<p class="perhome_perlike_num">{{$user_info['count']['follow_count']}}</p>
									<p class="perhome_perlike_la">关注</p>
								</a>

								<div class="detail_pop_tbtn detail_pop_tbtnright" style="float: none;position: absolute;right: 0">
									<div class="detail_pop_tbtn_click detail_fileb_pr">
										分享
										<var class="detail_pop_tbtntril"></var>
									</div>
									<div class="detail_fileb_select slideup">
										<div class="detail_fileb_selectw">
											<span class="jiathis_style_32x32" id="own_share">
												<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
												<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
												<a class="jiathis_button_tsina detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/weibo.png" height="19" width="19" alt="">微博</a>
												<a class="jiathis_button_douban detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/douban.png" height="19" width="19" alt="">豆瓣</a>
											</span>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div>
								<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
								<!-- JiaThis Button END -->
							</div>

							

						</div>

						

					</div>
		</div>
									</div>
									</div>
								    </div>

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
				'border-top':'0px solid #eaeaea',
				'background':''
			});
			$('.perhome_cater_info').hide();
			$('.mingpian').css({
				'display':'inline'
			});
		}else{
			$('.perhome_perlike_wrap').css({
				'position':'fixed',
				'top':40,
				'z-index':3,
				'border-top':'1px solid #eaeaea',
				'background':'#fff',
				'width':'100%'

			});
			$('.perhome_cater_info').show();
			$('.mingpian').css({
				'display':'none'
			});
		};
		
	});

	$('.detail_pop_tbtn_click').click(function(){
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
	//  $('.mingpian').click(function(){
	//  	var dis= $('.mingpian').alt.value;
	//  	alert(dis);
	//  	// if(txt==='显示'){
 //   //  	div.style.display = 'block';
 //   //  	this.value = '隐藏';
 //   //  	}else{
 //   //  	div.style.display = 'none';
 //   //  	this.value = '显示';
	//  	// }
	// }
	var diss=1;
	function mdis(iso){
		var dis=iso.alt;
		if(diss==1){
			
			$('#div1').css({
				'margin-top':'-60px',
				'display':'none'
			});
			$('#div2').css({			
				'display':'inline'
			});
			diss=2;

		}else{
			
			$('#div2').css({			
				'margin-top':'-60px',
				'display':'none'
			});
			$('#div1').css({			
				'display':'inline'
			});
			diss=1;
			

		}
	}

</script>