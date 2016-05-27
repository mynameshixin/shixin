<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家图集页'])
<body>
	<div class="header">
		<div class="headercontainer w1248 w1240 clearfix">
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
									<img src="public/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你</p>
								</div>
								<!-- <div class="header_add_fold_wrap">
									<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div> -->
							</li>
							<li class="clearfix">
								<div class="header_add_mava_wrap">
									<img src="public/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你的文件夹</p>
								</div>
								<div class="header_add_fold_wrap">
									<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div>
							</li>
							<li class="clearfix">
								<div class="header_add_mava_wrap">
									<img src="public/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你的文件夹</p>
								</div>
								<div class="header_add_fold_wrap">
									<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div>
							</li>
							<li class="clearfix">
								<div class="header_add_mava_wrap">
									<img src="public/images/temp_avatar.JPG" alt="">
								</div>
								<div class="header_add_font_wrap">
									<p class="header_add_font_a">小周 - <span>1个月前</span></p>
									<p class="header_add_font_a">关注了你的文件夹</p>
								</div>
								<div class="header_add_fold_wrap">
									<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">	
								</div>
							</li>
						</ul>
					</div>
					<a href="javascript:;" class="header_add_more">查看更多</a>
				</div>
			</div>
			<div href="javascript:;" class="header_rel">
				<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
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
		<div class="detail_pop_wrap detail_goodspop_wrap w990 clearfix">
			<div class="detail_pop_top clearfix">
				<div class="detail_pop_tleft">
					<div class="detail_pop_tltop">
						<div class="detail_pop_tbtnwarp">
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtnbuy detail_pop_tbtn_cpadding">采集</div>
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtnlike detail_pop_tbtn_cpadding">喜欢</div>
							<!-- <div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtn_cpadding">去购买</div> -->
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright">删除</div>
							<div class="detail_pop_tbtn detail_pop_tbtnright">
								<div class="detail_pop_tbtn_click detail_fileb_pr">
									分享
									<var class="detail_pop_tbtntril"></var>
								</div>
								<div class="detail_fileb_select slideup">
									<div class="detail_fileb_selectw">
										<span class="jiathis_style_32x32" id="own_share">
											<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="public/images/qq.png" height="18" width="15" alt="">QQ</a>
											<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="public/images/wechat.png" height="17" width="19" alt="">微信</a>
										</span>
										<var class="detail_fileb_setril"></var>
									</div>
								</div>
							</div>
							<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
							<!-- JiaThis Button END -->
						</div>
						<div class="detail_pop_timgwarp">
							<img src="public/images/temp/pop_img.png" height="830" width="668" alt="">
						</div>
						<p class="detail_pop_des" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅">
							富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅<a href="javascript:;" class="detail_pop_desmore">…</a>
						</p>
						<div class="detail_pop_from">
							来自 <a href="javascript:;" class="detail_pop_fromurl">www.huaban.com</a>
							<a href="javascript:;" class="detail_pop_fromwarn"></a>
							<a href="javascript:;" class="detail_pop_fromedit"></a>
						</div>
					</div>
					<div class="detail_pop_tlbtm">
						<div class="detail_pop_tlbtmauth clearfix">
							<div class="detail_pop_authava">
								<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
							</div>
							<div class="detail_pop_authinfo">
								<p class="detail_pop_authname"><a href="#">小红</a></p>
								<p class="detail_pop_authcollect">采集到<span>客厅</span></p>
							</div>
							<a class="detail_pop_authfollow detail_filebtn detail_fileball">+ 关注</a>
						</div>
						<p class="detail_pop_tlbtmcomment">评论</p>
						<ul class="detail_pop_tlcomlist">
							<li class="clearfix">
								<div class="detail_pop_authava">
									<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="detail_pop_cominfo">
									<p class="detail_pop_comname"><a href="#">小周</a>- 1个月前说：
										<span class="detail_pop_comshare">
											<a href="javascript:;" class="detail_pop_share1"></a>
											<a href="javascript:;" class="detail_pop_share2"></a>
											<a href="javascript:;" class="detail_pop_share3"></a>
									</span>
									</p>
									<p class="detail_pop_comcon">非有设计感非有设计感非有设计感非有设计感非有设计感非有设计感非有设计</p>
								</div>
								<div class="detail_pop_favor">20</div>
							</li>
							<li class="clearfix">
								<div class="detail_pop_authava">
									<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="detail_pop_cominfo">
									<p class="detail_pop_comname"><a href="#">小周</a>- 1个月前说：
										<span class="detail_pop_comshare">
											<a href="javascript:;" class="detail_pop_share1"></a>
											<a href="javascript:;" class="detail_pop_share2"></a>
											<a href="javascript:;" class="detail_pop_share3"></a>
									</span>
									</p>
									<p class="detail_pop_comcon">非有设计感非有设计感非有设计感非有设计感非有设计感非有设计感非有设计</p>
								</div>
								<div class="detail_pop_favor">20</div>
							</li>
							<li class="clearfix">
								<div class="detail_pop_authava">
									<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="detail_pop_cominfo">
									<p class="detail_pop_comname"><a href="#">小周</a>- 1个月前说：
										<span class="detail_pop_comshare">
											<a href="javascript:;" class="detail_pop_share1"></a>
											<a href="javascript:;" class="detail_pop_share2"></a>
											<a href="javascript:;" class="detail_pop_share3"></a>
									</span>
									</p>
									<p class="detail_pop_comcon">非有设计感非有设计感非有设计感非有设计感非有设计感非有设计感非有设计</p>
								</div>
								<div class="detail_pop_favor">20</div>
							</li>
						</ul>
						<a href="javascript:;" class="detail_pop_loadmore">显示更多评论</a>
						<div class="detail_pop_compublish clearfix">
							<div class="detail_pop_authava">
								<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
							</div>
							<textarea name="caption" placeholder="添加评论或把采集@给好友" class="detail_pop_compub" autocomplete="off"></textarea>
						</div>
						<div class="detail_pop_addcom clearfix">
							<a class="detail_pop_authfollow detail_filebtn detail_fileball">添加评论</a>
						</div>
					</div>
				</div>
				<div class="detail_pop_tright">
					<div class="detail_pop_trauth clearfix">
						<div class="detail_pop_authava">
							<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
						</div>
						<div class="detail_pop_authinfo">
							<p class="detail_pop_authname"><a href="#">客厅</a></p>
							<p class="detail_pop_authcollect"><a href="#">小红</a></p>
						</div>
						<a class="detail_pop_authfollow detail_filebtn detail_fileball">已关注</a>
					</div>
					<div class="detail_pop_trworks">
						<div class="detail_pop_trwwrap">
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/2.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/3.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/4.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/5.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/6.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/7.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/8.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/9.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/10.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/6.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/7.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/8.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/9.png">
									</div>
								</div>
							</div>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="#"></a>
										<img src="public/images/temp/10.png">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="detail_pop_bottom">
				<p class="detail_pop_btitle">该采集也在以下文件夹</p>
				<div class="find_cater perhome_follow_wrap clearfix">
					<ul class="find_fold_list clearfix">
						<li class="find_fold_li">
							<div class="find_fold_info clearfix">
								<div class="find_fold_authava">
									<a href="#" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="find_fold_tname">
									<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
									<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
								</div>
							</div>
							<div class="find_fold_imgwrap">
								<div class="find_fold_imgblur"></div>
								<img src="public/images/cat/b.png" alt="">
								<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
							</div>
							<div class="find_fold_limg clearfix">
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
							</div>
							<a href="javascript:;" class="find_fold_authflw">取消关注</a>
						</li>
						<li class="find_fold_li">
							<div class="find_fold_info clearfix">
								<div class="find_fold_authava">
									<a href="#" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="find_fold_tname">
									<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
									<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
								</div>
							</div>
							<div class="find_fold_imgwrap">
								<div class="find_fold_imgblur"></div>
								<img src="public/images/cat/b.png" alt="">
								<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
							</div>
							<div class="find_fold_limg clearfix">
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
							</div>
							<a href="javascript:;" class="find_fold_authflw">取消关注</a>
						</li>
						<li class="find_fold_li">
							<div class="find_fold_info clearfix">
								<div class="find_fold_authava">
									<a href="#" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="find_fold_tname">
									<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
									<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
								</div>
							</div>
							<div class="find_fold_imgwrap">
								<div class="find_fold_imgblur"></div>
								<img src="public/images/cat/b.png" alt="">
								<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
							</div>
							<div class="find_fold_limg clearfix">
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
							</div>
							<a href="javascript:;" class="find_fold_authflw">取消关注</a>
						</li>
						<li class="find_fold_li mrightzero">
							<div class="find_fold_info clearfix">
								<div class="find_fold_authava">
									<a href="#" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="find_fold_tname">
									<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
									<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
								</div>
							</div>
							<div class="find_fold_imgwrap">
								<div class="find_fold_imgblur"></div>
								<img src="public/images/cat/b.png" alt="">
								<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
							</div>
							<div class="find_fold_limg clearfix">
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
								<div class="find_fold_liwrap">
									<div class="find_fold_liblur"></div>
									<img src="public/images/cat/l.png" alt="">
								</div>
							</div>
							<a href="javascript:;" class="find_fold_authflw">取消关注</a>
						</li>
					</ul>
				</div>
				<a href="javascript:;" class="detail_pop_baddmore">加载更多</a>
				<p class="detail_pop_btitle">推荐给你的采集</p>
				<div class="index_con  perhome_wrap">
					<div class="index_item">
						<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/2.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/3.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/4.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/5.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/6.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/7.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/8.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/9.png">
								<div class="index_item_price">￥980</div>
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">82</a>
										<a href="javascript:;" class="index_item_c">90</a>
										<a href="javascript:;" class="index_item_d"></a>
									</div>
								</div>
								<div class="index_item_bottom clearfix">
									<a href="javascript:;" class="index_item_authava" target="_blank">
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap">
								<a class="index_item_blurwrap"></a>
								<img src="public/images/temp/10.png">
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
										<img src="public/images/temp_avatar.JPG" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">叶子</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">搭配</p>
									</div>
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
		   	var $con_pop = $('.detail_pop_trwwrap');
			    $con_pop.imagesLoaded(function() {
			        $con_pop.masonry({
		                itemSelector: '.detail_pop_tritem',
		                gutter: 1,
		                isAnimated: true,
		            });
			     });
		    $(window).scroll(function(event) {
				var scrollHei = $('body').scrollTop();
				if (scrollHei <= 68) {
					$('.perhome_scroll_info,.perhome_scroll_wrap').css({
						transform:'translate(0px, -70px)',
						transition:'transform 200ms ease'
					});
					$('.perhome_scroll_wrap').removeClass('shadow');
				}else{
					$('.perhome_scroll_wrap').addClass('shadow');
					$('.perhome_scroll_wrap').css({
						display:'block',
						position: 'fixed',
						transform:'translate(0px, -0px)',
						transition:'transform 200ms ease'
					});
					$('.perhome_scroll_info').css({
						transform:'translate(0px, -0px)',
						transition:'transform 200ms ease'
					})
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
		    $('.detail_pop_desmore').click(function(){
				var moreHtml = $('.detail_pop_des').attr('title');
				$('.detail_pop_des').html(moreHtml)
			})
			$('.detail_pop_tlcomlist li').hover(
				function () {
				    $(this).find('.detail_pop_comshare').show();
			  	},
			    function () {
				    $('.detail_pop_comshare').hide();
				}
			);
			$('.detail_pop_compub').focus(function(){
				$('.detail_pop_addcom').show()
			});
			$('.detail_pop_compub').change(function(){
				$('.detail_pop_authfollow').css({
					color: '#000',
					background:'#fff'
				});
			})
		});
	</script>
</html>