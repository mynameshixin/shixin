<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>堆图家</title>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/font-awesome.min.css">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="public/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/main.css">
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/index.css">
	<script type="text/javascript" src="{{asset('web')}}/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/news/Masonry/masonry-docs.min.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/news/index.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/news/nolog.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/news/scroll.js"></script>
	
	<!-- htmlv=20160710 -->
	<script type="text/javascript" src="{{asset('web')}}/js/news/detail_find.js"></script>
	<!-- htmlv=20160710 -->
	@include('web.common.head')	
</head>
<body>
@include('web.common.banner')
	
	<div class="container nolog_container">
		<div class="detail_pop_wrap w942 clearfix">
			<div class="art_title">
				<a href="/Article/aqqid/<?php echo $ok['eassat_id']?>" class="pre"><b><</b>上一个</a>
				<h2>
				<?php
			echo $ok['eassat_title'];

			?></h2>
				<h4><?php
			echo $ok['eassat_describe'];
			?></h4>
				<a href="/Article/addid/<?php echo $ok['eassat_id']?>" class="nex"><b><</b>下一个</a>
			</div>
			<div class="art_content">
			<?php
			echo $ok['eassat_cont'];
			?>
			@if($ok['eassat_guide_user'])
			<div class="share">
				<p style="color:#9d9d9d">本期专业内容指导来自 <a style="color:#E15335" href="/webd/user?oid=<?php echo $ok['eassat_guide_id']?>"><?php echo $ok['eassat_guide_user'];?></a></p>
				<div class="head-img">
					<img src="
					<?php
					echo $ok['eassat_guide_src'];
					?>
					"/>
				</div>
			</div>
			@endif	
	
		</div>

		</div>

		<div class="detail_pop_wrap w944 clearfix">
			<p>文章评论</p>
		</div>
		<div class="detail_pop_wrap w942 artical mtop15 clearfix">
			<div class="detail_pop_tlbtm">
				<ul class="detail_pop_tlcomlist">
			
					@for ($i = 0; $i < $new['int']; $i++)
					<li class="clearfix">
						<div class="detail_pop_authava">
							<a href="/webd/user?oid=<?php echo $new[$i]['comment_user_id']?>"><img src="<?php echo $new[$i]['comment_user_src']?>" alt=""></a>
						</div>

						<div class="detail_pop_cominfo">
							<p class="detail_pop_comname"><a href="/webd/user?oid=<?php echo $new[$i]['comment_user_id']?>"><?php echo $new[$i]['comment_user_name']?></a>- <?php echo $new[$i]['comment_date']?>说：
								<span class="detail_pop_comshare">
									<a href="javascript:;" class="detail_pop_share1"></a>
									<a href="javascript:;" name="<?php echo $new[$i]['comment_user_id']?>" class="detail_pop_share2" onclick="comment_delete(this)" neme="<?php echo $new[$i]['comment_id']?>"></a>
									<a href="javascript:;" class="detail_pop_share3"></a>
							</span>
							</p>
							<p class="detail_pop_comcon"><?php echo $new[$i]['comment_cont']?></p>
						</div>
						<div class="detail_pop_favor"  name="<?php echo $new[$i]['comment_id']?>" onclick="add_int(this)"><?php echo $new[$i]['comment_int']?></div>
					</li>
					@endfor
					<li class="add_pingx"><hr width="100%" style="border:none;border-top:1px solid #DADADA;"/></li>
					@for ($i = 0; $i < $comment['int']; $i++)
					<li class="clearfix">
						<div class="detail_pop_authava">
							<a href="/webd/user?oid=<?php echo $comment[$i]['comment_user_id']?>"><img src="<?php echo $comment[$i]['comment_user_src']?>" alt=""></a>
						</div>
						<div class="detail_pop_cominfo">
							<p class="detail_pop_comname"><a href="/webd/user?oid=<?php echo $comment[$i]['comment_user_id']?>"><?php echo $comment[$i]['comment_user_name']?></a>- <?php echo $comment[$i]['comment_date']?>说：
								<span class="detail_pop_comshare">
									<a href="javascript:;" class="detail_pop_share1"></a>
									<a href="javascript:;" class="detail_pop_share2" onclick="comment_delete(this)" neme="<?php echo $comment[$i]['comment_id']?>" name="<?php echo $comment[$i]['comment_user_id']?>"></a>
									<a href="javascript:;" class="detail_pop_share3"></a>
							</span>
							</p>
							<p class="detail_pop_comcon"><?php echo $comment[$i]['comment_cont']?></p>
						</div>
						<div class="detail_pop_favor"  name="<?php echo $comment[$i]['comment_id']?>" onclick="add_int(this)"><?php echo $comment[$i]['comment_int']?></div>
					</li>
					@endfor					
				</ul>
				@if($comment['int'] >= 10)
				<a href="javascript:;" class="detail_pop_loadmore" name="10" onclick="add_pingx(this)">显示更多评论</a>
				@endif
				@if($us)
				<div class="detail_pop_compublish clearfix">
					<div class="detail_pop_authava">
						<a href="#"><img src="<?php echo $us['src']?>" alt=""></a>
					</div>
					<textarea name="caption" id="<?php echo $us['id']?>" placeholder="添加评论或把采集@给好友" class="detail_pop_compub" autocomplete="off"></textarea>
				</div>
				@else
				<div class="detail_pop_compublish clearfix">
					<div class="detail_pop_authava">
						<a href="#"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
					</div>
					<textarea name="caption" placeholder="添加评论或把采集@给好友" class="detail_pop_compub" autocomplete="off"></textarea>
				</div>
				@endif
				<div class="detail_pop_addcom clearfix" >
					<a class="detail_pop_authfollow detail_filebtn detail_fileball" >添加评论</a>
				</div>
			</div>
		</div>
		<div class="detail_pop_wrap w944 clearfix">
			<p>相关推荐</p>
		</div>
		<div class="detail_pop_wrap w944 clearfix">
			<div class="art-com">
				<div class="pop_img_bigleft"></div>
				<div class="pop_img_bigright"></div>
				
				<div class="detail_pop_timgwarp">
					<div class="pop_img_bigwrap clearfix">
						<div class="pop_img_eachwrap">
						@for ($i=0;$i<$where['int'];$i++)
							<div class="art-list">
								<a href="/Article/article/<?php echo $where[$i]['eassat_id']?>"></a>
								<img src="<?php echo $where[$i]['eassat_ximg']?>"  alt="">
								<p><?php echo $where[$i]['eassat_title']?></p>			
							</div>
						@endfor
						</div>
						<div class="pop_img_eachwrap">
						@if($where['int']>3)
						@for ($i=3;$i<$where['int'];$i++)
							<div class="art-list">
								<a href="/Article/article/<?php echo $where[$i]['eassat_id']?>"></a>
								<img src="<?php echo $where[$i]['eassat_ximg']?>"  alt="">
								<p><?php echo $where[$i]['eassat_title']?></p>			
							</div>
						@endfor	
						@endif						
						</div>
						<div class="pop_img_eachwrap">
							<div class="art-list">
								<img src="public/images/temp/pop_img.png"  alt="">
							</div>
							<div class="art-list">
								<img src="public/images/temp/pop_img.png"  alt="">
							</div>
							<div class="art-list">
								<img src="public/images/temp/pop_img.png"  alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	<div class="pop_editpic" style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				编辑图片
				<span class="pop_close"></span>
			</p>
			<div class="pop_conwrap">
				<div class="pop_desimgwrap">
					<div class="pop_imgwrap">
						<img src="public/images/temp/1.png" alt="">
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<div class="pop_labelwrap">
						<span class="pop_labelname">名称</span>
						<textarea class="pop_iptdes"  placeholder="这是一把欧洲进口的沙发椅，来自品牌"></textarea>
					</div>
					<div class="pop_foldwrap clearfix">
						<span class="pop_labelname" style="margin-top: 17px;">移动到</span>
						<select class="pop_iptselect" style="margin-top: 17px;">
							<option value="">椅子</option>
							<option value="">桌子</option>
							<option value="">电视柜</option>
							<option value="">沙发</option>
							<option value="">卧室</option>
							<option value="">卫生间</option>
						</select>
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">标签</span>
					<select class="pop_labelselect" style="margin-right: 15px;">
						<option value="">该采集的风格是...</option>
						<option value="">现代</option>
						<option value="">中式</option>
						<option value="">日式</option>
						<option value="">新古典</option>
						<option value="">美式</option>
						<option value="">现代</option>
						<option value="">中式</option>
						<option value="">日式</option>
						<option value="">新古典</option>
						<option value="">美式</option>
					</select>
					<select class="pop_labelselect">
						<option value="">该采集的颜色是...</option>
						<option value="">红</option>
						<option value="">橙</option>
						<option value="">黄</option>
						<option value="">绿</option>
						<option value="">青</option>
						<option value="">蓝</option>
						<option value="">紫</option>
						<option value="">黑</option>
						<option value="">白</option>
						<option value="">灰</option>
					</select>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">来自</span>
					<input class="pop_iptname" placeholder="www.thden.com">
				</div>
			</div>
			
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_delete">删除采集</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">保存</a>
			</div>
		</div>
	</div>
	
	
	
</body>
<script type="text/javascript">
		$(function() {
			$('.detail_pop_fromwarn').click(function(){
				$('body').removeClass('overhidden')
				$('.detail_pop').css({
					display:'none'
				});
				$('.pop_report').show();
				var poptopHei = $('.pop_report .pop_con').height();
				$('.pop_report .pop_con').css({
				   'margin-top':-(poptopHei/2)
				});
			})
			
			$('.pop_report,.pop_report .pop_close,.pop_report .detail_pop_cancel').click(function(){
				$('.pop_report').hide();
			});
			$('.pop_con').click(function(){
				event.stopPropagation();
			});
			// htmlv?=20160707
			$('.report_submit').click(function(event) {
				$('.pop_report_end').show();
				$('.pop_report').hide();
				setTimeout("$('.pop_report_end').fadeOut(5000)");
			});
			// htmlv?=20160707
			$('.detail_pop_desmore').click(function(){
				var moreHtml = $('.detail_pop_des').attr('title');
				$('.detail_pop_des').html(moreHtml)
			});
			autoScroll();
		    var $container = $('.index_con');
		    $container.imagesLoaded(function() {
		        $container.masonry({
	                itemSelector: '.index_item',
	                gutter: 15,
	                isAnimated: true,
	            });
	            var text = $('.index_item_intro');
	              str = text.html(),
	              textLeng = 27;
	              if(str.length > textLeng ){
	                    text.html( str.substring(0,textLeng )+"...");
	              }
		     });
		    var $con_pop = $('.detail_pop_trwwrap');
		    $con_pop.imagesLoaded(function() {
		        $con_pop.masonry({
	                itemSelector: '.detail_pop_tritem',
	                gutter: 1,
	                isAnimated: true,
	            });
		     });
		    popEdit()
		    function popEdit(){
				$('.detail_pop_myedit').click(function(){
					$('.pop_editpic').show();
					var poptopHei = $('.pop_editpic .pop_con').height();
						$('.pop_editpic .pop_con').css({
						   'margin-top':-(poptopHei/2)
					});
					$('.pop_editpic,.pop_editpic').click(function(){
						$('.pop_editpic').hide();
					})
				})
			}
			$('.pop_editpic,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_editpic').hide()
			})
			$(window).scroll(function(event) {
				var popscrollHei = $(window).scrollTop();
				if (popscrollHei > 30) {
					$('.detail_pop_tbtnwarp').css({
		        		'position':'fixed',
		        		top:48,
		        		'z-index':1000,
		        		'padding':15,
		        		'margin-left':-15
		        	})
				}else{
					$('.detail_pop_tbtnwarp').css({
		        		'position':'relative',
		        		top:0,
		        		'z-index':1000,
		        		'padding':0,
		        		'margin-left':0
		        	})
				};
				var showHei = $('.detail_pop_tltop').height()+30;
				if (popscrollHei > showHei) {
					$('.detail_pop_tbtnwarp').css({
		        		'position':'relative',
		        		top:0,
		        		'z-index':1000,
		        		'padding':0,
		        		'margin-left':0
		        	})
				};
			});
			$('.detail_pop_compub').focus(function(){
				$('.detail_pop_addcom').show()
			});
			$('.detail_pop_compub').change(function(){
				$('.detail_pop_authfollow').css({
					color: '#000',
					background:'#fff'
				});
			})
			//提交留言JS
			$(".detail_fileball").click(function(){
				var mes=$(this).parent().siblings().find('textarea').val();
				if(mes==''){
					alert("提交内容不能为空")
				}else{
					pingx(mes);
				}
			})
			
		});
		var eassat_id=<?php echo $ok['eassat_id']?>
	</script>
	<script type="text/javascript" src="{{asset('web')}}/js/news/comment.js"></script>
</html>