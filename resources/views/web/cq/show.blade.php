<!DOCTYPE html>
<html lang="en" style="background: rgba(229,229,229,.95)">
<head>
	@include('web.common.cq.head')
</head>

<body>
	@include('web.common.banner')

	<div class="container nolog_container">
		<a href="javascript:;" class="detail_pop_loadbtn detail_pop_loadleft"></a>
		<a href="javascript:;" class="detail_pop_loadbtn detail_pop_loadright"></a>
		<div class="detail_pop_wrap w990 clearfix">
			<div class="detail_pop_top clearfix">
				<div class="detail_pop_tleft detail_sales">
					<div class="detail_pop_tltop">
						<div class="detail_pop_tbtnwarp">
							<!-- htmlv?=20160718 -->
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtnbuy detail_pop_tbtn_cpadding detail_pop_collection">采集</div>
							<!-- htmlv?=20160718 -->
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtnlike detail_pop_tbtn_cpadding">赞</div>
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
							<div class="pop_img_bigwrap clearfix">
								<?php foreach($good['images'] as $k=>$v){?>
								<div class="pop_img_eachwrap">
									<img src="{{$v['img_o']}}" height="" width="668" alt="">
								</div>
								<?php }?>
							</div>
							<div class="pop_img_bigpointerwrap"></div>
							<div class="pop_img_bigleft"></div>
							<div class="pop_img_bigright"></div>
							
							<div class="index_item_price"><b>600</b><del>980</del></div>
						</div>
						<p class="detail_pop_des" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅">
							富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅<a href="javascript:;" class="detail_pop_desmore">…</a>
						</p>
						<div class="detail_pop_from">
							来自 <a href="javascript:;" class="detail_pop_fromurl">上海  普陀区</a>
							<a href="javascript:;" class="detail_pop_fromwarn"></a>
							<a href="javascript:;" class="detail_pop_fromwarn detail_pop_looked">2 浏览</a>
							
							<a href="javascript:;" class="detail_pop_fromwarn detail_pop_time">四小时前 发布</a>

							<!-- <a href="javascript:;" class="detail_pop_fromedit"></a> -->
						</div>
					</div>
					<div class="detail_pop_tlbtm">
						<div class="detail_pop_tlbtmauth clearfix">
							<div class="detail_pop_authava">
								<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
							</div>
							<div class="detail_pop_authinfo">
								<p class="detail_pop_authname"><a href="#">小红</a><small>(个人)</small></p>
								<p class="detail_pop_authcollect">123153423644</p>
							</div>
						</div>
						<div class="detail_pop_tlbtmauth clearfix">
							<div class="detail_pop_authinfo authinfo_detail">
								<p class="detail_pop_authname"><small>详细信息</small></p>
								<p class="detail_pop_authcollect">这里是富有什么味道的客厅，这里是富有什么味道的客厅，这里是富有什么味道的客厅，这里是富有什么味道的客厅，这里是富有什么味道的客厅，这里是富有什么味道的客厅</p>
							</div>
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
						</ul>
						<a href="javascript:;" class="detail_pop_loadmore">显示更多评论</a>
						<div class="detail_pop_compublish clearfix">
							<div class="detail_pop_authava">
								<a href="#"><img src="public/images/temp_avatar.JPG" alt=""></a>
							</div>
							<textarea name="caption" placeholder="添加评论或把采集@给好友" class="detail_pop_compub" autocomplete="off"></textarea>
						</div>
						<div class="detail_pop_addcom clearfix">
							<a class="detail_pop_authfollow detail_filebtn detail_fileball" id="add_commit_btn">添加评论</a>
						</div>
					</div>
				</div>
			</div>
			<div class="detail_pop_bottom">
				<p class="detail_pop_btitle">该采集也在以下文件夹</p>
	
				<div class="w1248 w1242 clearfix">
			<div class="index_con clearfix">
				<div class="rows">
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
										<a href="javascript:;" class="index_item_b"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
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
										<a href="javascript:;" class="index_item_b"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
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
										<a href="javascript:;" class="index_item_b"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
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
										<a href="javascript:;" class="index_item_b"></a>
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

</body>
</html>