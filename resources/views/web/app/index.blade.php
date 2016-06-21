<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家--app'])
<script type="text/javascript" src="{{asset('web')}}/js/nolog.js"></script>
<body class="nolog_body">
	@include('web.common.banner')


		<div class="nolog_index_container">
		<div class="nolog_index_conapp clearfix" style="background:none">
			<div class="w1248 clearfix" style="padding-top: 1px;">
				<div class="nolog_index_conapp_phone">
					<img src="{{asset('web')}}/images/cat/10.png" alt="">
				</div>
				<div class="nolog_index_conapp_right">
					<img src="{{asset('web')}}/images/app_logo.png" height="146" width="146" class="nolog_app_log"></img>
					<p class="nolog_app_font">用社交的方式链接全球家居资源</p>
					<div class="nolog_app_code clearfix">
						<div class="nolog_app_wrap">
							<img src="{{asset('web')}}/images/code_an.png" height="128" width="128" alt="">
							<p style="color:#828282">Android 下载</p>
						</div>
						<div class="nolog_app_wrap">
							<img src="{{asset('web')}}/images/code_ip.png" height="128" width="128" alt="">
							<p style="color:#828282">iPhone/iPad 下载</p>
						</div>
						<!-- htmlv?=20160707 -->
						<div class="nolog_app_wrap">
							<img src="{{asset('web')}}/images/code_ip.png" height="128" width="128" alt="">
							<p style="color:#828282">微信订阅号</p>
						</div>
						<!-- htmlv?=20160707 -->
					</div>
					<div class="nolog_app_qqwc">
						<a href="#" style="margin-right: 21px;"><img src="{{asset('web')}}/images/app_wc.png" height="61" width="61" alt=""></a>
						<a href="#"><img src="{{asset('web')}}/images/app_qq.png" height="61" width="61" alt=""></a>
					</div>
				</div>
			</div>
		</div>
	</div>
		@include('web.common.foot')
		
	</div>
</body>
<script type="text/javascript">
		$(function() {;
		    var scrHei = $(window).height();
		    var minHei = scrHei - 220;
		    if (minHei>730) {
		    	$('.nolog_index_conapp').css({
			    	'min-height':minHei
			    })
		    }else{
		    	$('.nolog_index_conapp').css({
			    	'min-height':730
			    })
		    };
		    
		   $(window).resize(function(){
		   		var scrHei = $(window).height();
			    var minHei = scrHei - 220;
			    if (minHei>730) {
			    	$('.nolog_index_conapp').css({
				    	'min-height':minHei
				    })
			    }else{
			    	$('.nolog_index_conapp').css({
				    	'min-height':730
				    })
			    };
		   })
		});
	</script>
</html>