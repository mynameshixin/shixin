<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家首页'])
<body>
	<div class="header">
		<div class="headercontainer w1248 clearfix">
			<a href="javascript:;" class="header_logo">堆图家</a>
			<a href="javascript:;" class="header_item">首页</a>
			<a href="javascript:;" class="header_item">图集</a>
			<a href="javascript:;" class="header_item">发现</a>
			<a href="javascript:;" class="header_item">APP</a>
			<div href="javascript:;" class="header_add_btn">
				+
				<div class="header_add_item">
					<div class="header_add_iwrap">
						<div class="header_add_up"></div>
						<div class="header_add_item_awrap">
							<a href="javascript:;" target="_blank" class="header_add_item_a header_more_a1">上传图片</a>
							<a href="javascript:;" target="_blank" class="header_add_item_a header_more_a2">上传商品</a>
							<a href="javascript:;" target="_blank" class="header_add_item_a header_more_a3">添加文件夹</a>
							<a href="javascript:;" target="_blank" class="header_add_item_a header_more_a4">安装堆工具</a>
						</div>
						
					</div>
				</div>
			</div>
			<input type="text" class="header_search" placeholder="搜索你喜欢的">
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
			<div href="javascript:;" class="header_rel">
				<a href="#"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
				<var class="header_tril"></var>
				<div class="header_moreinfo">
					<a href="javascript:;" target="_blank" class="header_more_item header_more_1">我的花瓣</a>
					<a href="javascript:;" target="_blank" class="header_more_item header_more_2">私信</a>
					<a href="javascript:;" target="_blank" class="header_more_item header_more_3">我的关注</a>
					<a href="javascript:;" target="_blank" class="header_more_item header_more_4">堆图家认证</a>
					<a href="javascript:;" target="_blank" class="header_more_item header_more_5">账号设置</a>
					<a href="javascript:;" class="header_more_item header_more_6">退出</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="w1248 clearfix">
			<div class="index_con">
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_user">
							<div class="index_item_utop clearfix">
								<div class="index_item_uava">
									<a href="javascript:;" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="index_item_uname"><a href="javascript:;" target="_blank">世界有你</a></div>
							</div>
							<div class="index_item_umdl clearfix">
								<div class="index_item_umcon">
									<p class="index_item_umnum">1288</p>
									<p class="index_item_umitem">采集</p>
								</div>
								<div class="index_item_umcon">
									<p class="index_item_umnum">99</p>
									<p class="index_item_umitem">文件夹</p>
								</div>
								<div class="index_item_umcon" style="border-right: 0px;">
									<p class="index_item_umnum">288</p>
									<p class="index_item_umitem">粉丝</p>
								</div>
							</div>
							<div class="index_item_ubtm clearfix">
								<div class="index_item_ubrec">
									推荐文件夹 <a href="javascript:;" class="index_item_ubrecmore">查看更多</a>
								</div>
								<div class="index_item_ubfold clearfix">
									<div class="index_item_ubfava">
										<a href="javascript:;" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
									</div>
									<div class="index_item_ubfinfo">
										<p class="index_item_ubfnme"><a href="javascript:;" target="_blank">花瓣</a></p>
										<p class="index_item_ubffow">99文件&nbsp;&nbsp;20关注</p>
									</div>
									<a href="javascript:;" class="index_item_ubfatten">关注</a>
								</div>
								<div class="index_item_ubfold clearfix">
									<div class="index_item_ubfava">
										<a href="javascript:;" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
									</div>
									<div class="index_item_ubfinfo">
										<p class="index_item_ubfnme"><a href="javascript:;" target="_blank">艺匠</a></p>
										<p class="index_item_ubffow">99文件&nbsp;&nbsp;20关注</p>
									</div>
									<a href="javascript:;" class="index_item_ubfatten">关注</a>
								</div>
								<div class="index_item_ubfold clearfix">
									<div class="index_item_ubfava">
										<a href="javascript:;" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
									</div>
									<div class="index_item_ubfinfo">
										<p class="index_item_ubfnme"><a href="javascript:;" target="_blank">极客公园</a></p>
										<p class="index_item_ubffow">99文件&nbsp;&nbsp;20关注</p>
									</div>
									<a href="javascript:;" class="index_item_ubfatten">关注</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/2.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/3.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/4.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/5.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/6.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/7.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/8.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/9.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap">
							<a class="index_item_blurwrap"></a>
							<img src="{{asset('web')}}/images/temp/10.png">
							<div class="index_item_price">￥980</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">82</a>
									<a href="javascript:;" class="index_item_c">90</a>
									<a href="javascript:;" class="index_item_b"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="javascript:;" class="index_item_authname">叶子</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>
								</div>
							</div>
						</div>
					</div>
			    </div>
			</div>
		</div>
	</div>
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
		});
	</script>
</html>