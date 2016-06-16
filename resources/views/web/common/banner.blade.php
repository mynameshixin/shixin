<div class="header">
		<div class="headercontainer w1248 clearfix">
			<a href="/" class="header_logo">堆图家</a>
			<a href="{{url('webd/home')}}" class="header_item">首页</a>
			<a href="{{url('webd/pics')}}" class="header_item">图集</a>
			<a href="{{url('webd/find')}}" class="header_item">发现</a>
			<a href="{{url('webd/app')}}" class="header_item">APP</a>
			<div href="javascript:;" class="header_add_btn">
				+
				<div class="header_add_item">
					@include('web.common.banner.action')
				</div>
			</div>
			<form action="/webd/search" method="post" name='search'>
				<input type="text" class="header_search" name="keyword" placeholder="搜索你喜欢的" <?php if(empty($self_id)){?>style="width: 565px;"<?php } ?>>
			</form>
			<script type="text/javascript">
				$('.header_search').keydown(function(e){
					if(e.keyCode==13){
						$('form[name=search]').submit()
					}
				})
			</script>
			<div href="javascript:;" class="header_mess">
				<i class="icon-bell-alt"></i>
				<div class="header_moremess">
					<div class="header_add_up"></div>
					<div class="header_add_clickbtn clearfix">
						<a href="javascript:;" class="header_add_clicka header_add_clicka_on" style="border-radius: 6px 0px 0px 0px">通知</a>
						<a href="javascript:;" class="header_add_clicka" style="border: none;border-radius:0px 6px 0px 0px">消息</a>
					</div>
					<div class="header_add_con">
						<ul class="header_add_cul">
							<li class="clearfix">
								<div class="header_add_mava_wrap">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你</p>
								</div>
								<!-- <div class="header_add_fold_wrap">
									<img src="{{asset('web')}}/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div> -->
							</li>
							<li class="clearfix">
								<div class="header_add_mava_wrap">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你的文件夹</p>
								</div>
								<div class="header_add_fold_wrap">
									<img src="{{asset('web')}}/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div>
							</li>
							<li class="clearfix">
								<div class="header_add_mava_wrap">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你的文件夹</p>
								</div>
								<div class="header_add_fold_wrap">
									<img src="{{asset('web')}}/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div>
							</li>
							<li class="clearfix">
								<div class="header_add_mava_wrap">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你的文件夹</p>
								</div>
								<div class="header_add_fold_wrap">
									<img src="{{asset('web')}}/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div>
							</li>
						</ul>
					</div>
					<a href="javascript:;" class="header_add_more">查看更多</a>
				</div>
			</div>
			@include('web.common.banner.my')

		</div>
</div>

@include('web.common.login')