<!DOCTYPE html>
<html lang="en">
<head>
	@include('web.common.cq.head')
</head>

<body style="background: #ddd">
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web')}}/js/scroll.js"></script>
	<script type="text/javascript">
		function re668(obj){
			if($(obj).width()>668) $(obj).css('width','668px')
		}
		$(function(){
			var detail_pop_timgwarp_cq_img = $('.detail_pop_timgwarp_cq img').eq(0).height()
			$('.detail_pop_timgwarp_cq').css({'height':detail_pop_timgwarp_cq_img+'px'})
			autoScroll()
		})
	</script>
	<div class="container nolog_container">
		<a href="/webd/cqpic/{{$good['pre']}}" class="detail_pop_loadbtn detail_pop_loadleft" title="上一个"></a>
		<a href="/webd/cqpic/{{$good['next']}}" class="detail_pop_loadbtn detail_pop_loadright" title="下一个"></a>
		<div class="detail_pop_wrap w990 clearfix">
			<div class="detail_pop_top clearfix">
				<div class="detail_pop_tleft detail_sales">
					<div class="detail_pop_tltop">
						<div class="detail_pop_tbtnwarp">
							<!-- htmlv?=20160718 -->
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtnbuy detail_pop_tbtn_cpadding detail_pop_collection cq_collect">采集</div>
							<!-- htmlv?=20160718 -->
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtnlike detail_pop_tbtn_cpadding cq_like">赞</div>
							<!-- <div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtn_cpadding">去购买</div> -->
							<!-- <div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright">删除</div> -->
							<div class="detail_pop_tbtn detail_pop_tbtnright">
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
						<div class="detail_pop_timgwarp_cq">
							<div class="pop_img_bigwrap clearfix">
								<?php foreach($good['images'] as $k=>$v){?>
								<div class="pop_img_eachwrap">
									<img src="{{$v['img_o']}}" alt="" onload="re668(this)">
								</div>
								<?php }?>
							</div>
							<div class="pop_img_bigpointerwrap"></div>
							<div class="pop_img_bigleft"></div>
							<div class="pop_img_bigright"></div>
							
							<div class="index_item_price"><b style="padding:0 10px">600</b><del>980</del></div>
						</div>
						<p class="detail_pop_des" title="{{$good['title']}}">
							{{$good['title']}}
						</p>
						<div class="detail_pop_from">
							来自 <a href="javascript:;" class="detail_pop_fromurl">{{$good['countryname']}}  {{$good['cityname']}}</a>
							<a href="javascript:;" class="detail_pop_fromwarn"></a>
							<a href="javascript:;" class="detail_pop_fromwarn detail_pop_looked">{{$good['views']}} 浏览</a>
							
							<a href="javascript:;" class="detail_pop_fromwarn detail_pop_time">{{$good['min']}} 发布</a>
						</div>
					</div>
					<div class="detail_pop_tlbtm">
						<div class="detail_pop_tlbtmauth clearfix">
							<div class="detail_pop_authava">
								<a href="/webd/user?oid={{$good['user']['id']}}" target="_blank"><img src="<?php echo $good['user']['auth_avatar']!=null?$good['user']['auth_avatar']:$good['user']['pic_m']; ?>" alt=""></a>
							</div>
							<div class="detail_pop_authinfo">
								<p class="detail_pop_authname"><a href="/webd/user?oid={{$good['user']['id']}}" target="_blank"><?php echo $good['user']['nick']!=''?$good['user']['nick']:$good['user']['username']; ?></a><small>(<?php echo $good['source']==1?'个人':'商家'?>)</small></p>
								<p class="detail_pop_authcollect">{{$good['contact']}}</p>
							</div>
						</div>
						<div class="detail_pop_tlbtmauth clearfix">
							<div class="detail_pop_authinfo authinfo_detail">
								<p class="detail_pop_authname"><small>详细信息</small></p>
								<p class="detail_pop_authcollect">{{$good['description']}}</p>
							</div>
						</div>
						<p class="detail_pop_tlbtmcomment">评论</p>
						<ul class="detail_pop_tlcomlist">
							<?php foreach($good['comments'] as $k=>$v){?>
							<li class="clearfix" <?php if(!in_array($k, [0,1,2])): ?>style="display: none"<?php endif; ?>>
								<div class="detail_pop_authava">
									<a href="/webd/user?oid={{$v['user']['id']}}" target="_blank"><img src="<?php echo $v['user']['auth_avatar']!=null?$v['user']['auth_avatar']:$v['user']['pic_m']; ?>" alt=""></a>
								</div>
								<div class="detail_pop_cominfo">
									<p class="detail_pop_comname"><a href="/webd/user?oid={{$v['user']['id']}}" target="_blank"><?php echo $v['user']['nick']!=''?$v['user']['nick']:$v['user']['username']; ?></a>- {{$v['min']}}说：
										<span class="detail_pop_comshare">
											<a href="javascript:;" class="detail_pop_share1"></a>
											<a href="javascript:;" class="detail_pop_share2"></a>
											<a href="javascript:;" class="detail_pop_share3"></a>
									</span>
									</p>
									<p class="detail_pop_comcon">{{$v['content']}}</p>
								</div>
								<div class="detail_pop_favor" style="cursor:pointer" onclick="comment_parise(this)" user_id="{{$self_info['id']}}" comment_id="{{$v['id']}}">{{$v['praise_count']}}</div>
							</li>
							<?php }?>
						</ul>
						<a href="javascript:;" class="detail_pop_loadmore">显示更多评论</a>
						<div class="detail_pop_compublish clearfix">
							<div class="detail_pop_authava">
								<a href="/webd/user?oid={{$self_info['id']}}" target="_blank"><img src="<?php echo $self_info['auth_avatar']!=null?$self_info['auth_avatar']:$self_info['pic_m']; ?>" alt=""></a>
							</div>
							<textarea name="caption" placeholder="添加评论" class="detail_pop_compub" autocomplete="off"></textarea>
						</div>
						<div class="detail_pop_addcom clearfix">
							<a class="detail_pop_authfollow detail_filebtn detail_fileball" id="add_commit_btn" style="color: #000">添加评论</a>
						</div>
					</div>
				</div>
			</div>
			<style type="text/css">
			#main_show .index_item_price strong{ color: #f00; font-size: 18px;padding: 10px }
			#main_show .index_item_price b{ text-decoration: line-through; }
			</style>
			<?php if(!empty($ogood)): ?>
			<div class="detail_pop_bottom">
				<p class="detail_pop_btitle">发布该商品的人也发布了</p>
				<div class="w1248 w1242 clearfix" id="main_show" role="main" style="width: 1000px">
					<div class="index_con clearfix" id="tiles_show">
						<?php foreach($ogood as $k=>$v){?>
							<div class="index_item" img_id="{{$v['id']}}">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="/webd/cqpic/{{$v['id']}}" target="_blank" title="{{$v['title']}}"></a>
										<img src="{{$v['images'][0]['img_m']}}" style="height: <?php echo $v['images'][0]['rh']."px";?>" onload="resize_xy(this)" alt="{{$v['title']}}">
										<div class="index_item_price"><strong>{{$v['reserve_price']}}</strong><b>{{$v['price']}}</b></div>
									</div>
									<div class="index_item_info">
										<div class="index_item_top">
											<div class="index_item_intro" title="{{$v['title']}}">{{$v['title']}}</div>
											<div class="vr_title">
													<span class="vr_home_loc">{{$v['cityname']}} {{$v['countryname']}}</span>
													<span class="vr_home_ll">{{$v['views']}}浏览</span>
													<span class="vr_home_fb">{{$v['min']}}发表</span>
											</div>
											<div class="index_item_rel clearfix" good_id="{{$v['id']}}">
												<a href="javascript:;" class="index_item_like" onclick="">{{$v['praise_count']}}</a>
												<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
												<a href="/webd/cqpic/{{$v['id']}}" target="_blank" class="index_item_chat"></a>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							<?php }?>
					</div>
				</div>				
			</div>
			<?php endif; ?>

	<?php if(!empty($ogood)): ?>
	<a href="javascript:;" id='load_show' class="detail_pop_baddmore" style="display: none;">正在加载中。。。</a>
	<?php endif; ?>
<script type="text/javascript">
	postUrl_show = "/webd/cq/ogoods"
	postData_show = {'num':10,'good_id':{{$good['id']}}}
</script>
<script type="text/javascript">
	//评论赞添加
	function comment_parise(obj){
		if(u_id==''){
			layer.msg('没有登陆',{'icon':5})
			return
		}
		var count = $(obj).html()
		var user_id = $(obj).attr('user_id')
		var comment_id = $(obj).attr('comment_id')
		$.ajax({
			'url':"/webd/cq/clike",
			'type':'post',
			'data':{
				'comment_id':comment_id,
				'user_id':user_id,
				'u_id':u_id
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200){
					$(obj).html(parseInt(count)+1)
				}else{
					layer.msg(json.message, {icon: 5});
					return
				}
				
			},
			
		})
	}

	// 采集出清商品
	$('.cq_collect').click(function(){
		$.ajax({
			'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/cq/col",
			'type':'post',
			'data':{
				'good_id':"{{$good['id']}}",
				'user_id':u_id
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200){
					layer.msg('采集成功', {icon: 6});
					return
				}else{
					layer.msg(json.message, {icon: 5});
					return
				}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
		})
	})

	// 商品点赞
	$('.cq_like').click(function(){
		$.ajax({
			'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/cq/glike",
			'type':'post',
			'data':{
				'good_id':"{{$good['id']}}",
				'user_id':u_id
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200){
					layer.msg('点赞成功', {icon: 6});
					return
				}else{
					layer.msg(json.message, {icon: 5});
					return
				}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
		})
	})

	$('.detail_pop_compub').focus(function(){
		$('.detail_pop_addcom').show()
	});
	$('.detail_pop_compub').change(function(){
		$('.detail_pop_authfollow').css({
			color: '#000',
			background:'#fff'
		});
	})

	$('.detail_pop_loadmore').click(function(){
	    	$('.detail_pop_tlcomlist li').show()
	    	$(this).hide()
	})
	// 添加评论
	$("#add_commit_btn").click(function(){
		if(u_id==''){
			layer.msg('没有登陆',{'icon':5})
			return
		}
		if($('textarea[name=caption]').val().trim()==''){
			layer.msg('没有填写评论',{'icon':5})
			return
		}
		$.ajax({
			'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/cq/comment",
			'type':'post',
			'data':{
				'to_good_id':"{{$good['id']}}",
				'content':$('textarea[name=caption]').val().trim(),
				'user_id':u_id
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200){
					var commitHtml = '<li class="clearfix">\
									<div class="detail_pop_authava">\
										<a href="/webd/user/index?oid={{$self_info['id']}}"><img src="{{!empty($self_info['auth_avatar'])?$self_info['auth_avatar']:$self_info['pic_m']}}" alt=""></a>\
									</div>\
									<div class="detail_pop_cominfo">\
										<p class="detail_pop_comname"><a href="/webd/user/index?oid={{$self_info['id']}}">{{!empty($self_info['nick'])?$self_info['nick']:$self_info['username']}}</a>- 刚刚说：\
										</p>\
										<p class="detail_pop_comcon">'+$('textarea[name=caption]').val().trim()+'</p>\
									</div>\
									<div class="detail_pop_favor" style="cursor:pointer" onclick="comment_parise(this)" user_id="{{$self_info['id']}}" comment_id="'+json.data.id+'">0</div>\
								</li>'
					$(".detail_pop_tlcomlist").prepend(commitHtml);
					$(".detail_pop_compub").val("")
				}else{
					layer.msg(json.message, {icon: 5});
					return
				}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
		})
		
	})
</script>
<script type="text/javascript" src="{{asset('web')}}/js/cqpicbottom.js"></script>
</body>
</html>