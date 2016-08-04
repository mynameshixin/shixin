<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body class="nolog_body">
	<div class="header">
		<div class="headercontainer w992 clearfix contact_header">
			<a href="/" class="header_logo">堆图家</a>
			<p><a class="contact_header_a contact_header_aon" href="/webd/contact">联系我们</a></p>
			<p><a class="contact_header_a" href="javascript:;">关于堆图家</a></p>
		</div>
	</div>
	<div class="container nolog_index_container clearfix">
		<div class="nolog_index_contactbg">
			<img src="{{asset('/web/images/contact_bg.jpg')}}" height="126" width="100%" alt="">
		</div>
		<div class="nolog_index_contactcon">
			<div class="w992 clearfix">
				<p class="nolog_index_contact_a">堆图家是宜然网络科技（上海）有限公司旗下网站，任何关于堆图家的意见与建议，以及相关合作事宜，请通过以下方式与我们联系：</p>
				<p class="nolog_index_contact_b">商务及流量合作、品牌广告投放：</p>
				<p class="nolog_index_contact_c">请发送邮件至duitujia@126.com</p>
				<p class="nolog_index_contact_b">其他网内一般事务：</p>
				<p class="nolog_index_contact_c">请私信@堆图家</p>
				<p class="nolog_index_contact_c">或发送邮件至duitujia@126.com</p>
				<p class="nolog_index_contact_b">联系电话：</p>
				<p class="nolog_index_contact_c">021-62308521</p>
				<p class="nolog_index_contact_b">公司地址：</p>
				<p class="nolog_index_contact_c">上海市普陀区怒江北路598号红星世贸大厦B座1207室</p>
			</div>
		</div>
		
	</div>
	@include('web.common.foot')
</body>
<script type="text/javascript">
		$(function() {
		    var $container = $('.index_con');
		    $container.imagesLoaded(function() {
		        $container.masonry({
	                itemSelector: '.index_item',
	                gutter: 15,
	                isAnimated: true,
	            });
		     });
		    var scrHei = $(window).height();
		    var minHei = scrHei - 420;
		    $('.nolog_index_contactcon').css({
		    	'min-height':minHei
		    })
		   
		});
	</script>
</html>