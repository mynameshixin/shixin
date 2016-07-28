
<?php if(empty($self_id)){?>
<div style="">
<a href="javascript:;" class="nolog_login_btn">注册</a>
<a href="javascript:;" class="nolog_land_btn">登录</a>
</div>
<?php }else{ ?>
<div href="javascript:;" class="header_rel" style="float: right; border-right: none">
				<a href="#"><img src="{{!empty($self_info['auth_avatar'])?$self_info['auth_avatar']:$self_info['pic_m']}}" alt=""></a>
				<var class="header_tril"></var>
				<div class="header_moreinfo">
					<a href="/webd/user?oid={{$self_id}}" target="_blank" class="header_more_item header_more_1">我的堆图家</a>
					<!-- <a href="javascript:;" target="_blank" class="header_more_item header_more_2">私信</a> -->
					<a href="/webd/user/follow?oid={{$self_id}}" target="_blank" class="header_more_item header_more_3">我的关注</a>
					<!-- <a href="javascript:;" target="_blank" class="header_more_item header_more_4">堆图家认证</a> -->
					<a href="{{url('webd/user/setaccount')}}" target="_blank" class="header_more_item header_more_5">账号设置</a>
					<a href="{{url('webd/home/logout')}}" class="header_more_item header_more_6">退出</a>
				</div>
			</div>
<?php } ?>
