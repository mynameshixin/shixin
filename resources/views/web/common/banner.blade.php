<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?d395e3863da8722a0eba22f2bc629b6a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<div class="header">
		<div class="headercontainer w1248 clearfix">
			<a href="/" class="header_logo"></a>
			<a href="{{url('webd/home')}}" class="header_item">商品</a>
			<a href="{{url('webd/pics')}}" class="header_item">图集</a>
			<a href="{{url('webd/find')}}" class="header_item">发现</a>
			<a href="{{url('webd/app')}}" class="header_item">APP</a>
			<div href="javascript:;" class="header_add_btn">
				+
				<div class="header_add_item">
					@include('web.common.banner.action')
				</div>
			</div>
			<form action="/webd/search/goods" method="get" name='search'>
				<input type="text" class="header_search" value="{{$keyword or ''}}" name="keyword" placeholder="搜索你喜欢的" <?php if(empty($self_id)){?>style="width: 565px;"<?php } ?>>
			</form>
			<script type="text/javascript">
				$('.header_search').keydown(function(e){
					if(e.keyCode==13){
						$('form[name=search]').submit()
					}
				})
			</script>
			<div href="javascript:;" class="header_mess">
				<!-- <i class="icon-bell-alt"></i> -->
				<div class="header_moremess" >
					<div class="header_add_up"></div>
					<div class="header_add_clickbtn clearfix">
						<a href="javascript:;" class="header_add_clicka header_add_clicka_on" style="border-radius: 6px 0px 0px 0px">通知</a>
						<a href="javascript:;" class="header_add_clicka" style="border: none;border-radius:0px 6px 0px 0px">消息</a>
					</div>
					<div class="header_add_con" style="height: 360px;overflow-y: scroll;">
						<ul class="header_add_cul">
							
						</ul>
					</div>
					<!-- <a href="javascript:;" class="header_add_more">查看更多</a> -->
				</div>
			</div>
			@include('web.common.banner.my')

		</div>
</div>
<script type="text/javascript">
	$('.header_mess').click(function(){
		if($('.header_moremess').css('display') == 'block'){
			$('.header_moremess').find('ul').html('')
			$('.header_moremess').css("display","none")
		}else{
			$.ajax({
				'beforeSend':function(){
					layer.load(0, {shade: 0.5});
				},
				'url':"{{url('webd/notice/index')}}",
				'type':'post',
				'data':{
					'user_id':user_id,
					'num':50
				},
				'dataType':'json',
				'success':function(json){
					if(json.code==200){
						var lis = ''
						$.each(json.data.list,function(index,v){
							var pic_m = v.user.auth_avatar!=null?v.user.auth_avatar:v.user.pic_m
							var nick = v.user.nick!=''?v.user.nick:v.user.username
							var uid = v.user.id
							lis += '<li class="clearfix">'
								+'<div class="header_add_mava_wrap">'
									+'<a href="/webd/user?oid='+uid+'" target="_blank"><img src="'+pic_m+'" alt=""></a>'
								+'</div>'
								+'<div class="header_add_font_wrap">'
									+'<p class="header_add_font_a">'+nick+' - <span>'+v.min+'前</span></p>'
									+'<p class="header_add_font_a">'+v.msg_content+'</p>'
								+'</div>'
							+'</li>'
						})
						$('.header_moremess').find('ul').html(lis)
						
					}
				},
				'complete':function(){
					layer.closeAll('loading');
				}
			})
			$('.header_moremess').css("display","block")
		}
	})
	$('.header_moremess').click(function(){
		event.stopPropagation();
	})
</script>
@include('web.common.login')
@include('web.common.daction')

<a href="javascript:;" class="back_to_top">^</a>
<script type="text/javascript">
	$(function(){
		$('.back_to_top').click(function(){
			$("html,body").animate({scrollTop: 0},600);
		})
	})
</script>