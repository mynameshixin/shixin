<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家用户喜欢'])
<body>
	@include('web.common.banner')
	<div class="container">
		@include('web.common.user')
		
		<div class="w1248 w1240 clearfix" id="main" role="main">
			<div class="index_main index_con  perhome_wrap" id="tiles">
				<?php foreach ($user_like as $key => $v):?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap"></a>
							<img src="{{$v['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}">
							<?php if(isset($v['price']) && !empty($v['price'])): ?>
								<div class="index_item_price">￥{{$v['price']}}</div>
							<?php endif; ?>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{$v['description'] or $v['title']}}">{{$v['description'] or $v['title']}}</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">{{$v['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
									<a href="" class="index_item_d">{{$v['boo_count']}}</a>
								</div>
							</div>
							<?php foreach ($v['comment'] as $k => $value):?>
							<div class="index_item_bottom clearfix comment">
								<a href="javascript:;" class="index_item_authava" target="_blank">
									<img src="{{$value['user']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo index_item_authtalk">
									<a href="javascript:;" class="index_item_authname">{{$value['user']['nick']}}：</a>
									<span class="index_item_authto">{{$value['content']}}</span>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endforeach;?>
			</div>
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>

	
	<div class="detail_pop" style="display:none;">
		<a href="javascript:;" class="detail_pop_loadclose"></a>
		<a href="javascript:;" class="detail_pop_loadbtn detail_pop_loadleft"></a>
		<a href="javascript:;" class="detail_pop_loadbtn detail_pop_loadright"></a>
		<div class="detail_pop_wrap w990 clearfix">
			<div class="detail_pop_top clearfix">
				<div class="detail_pop_tleft">
					<div class="detail_pop_tltop">
						<div class="detail_pop_tbtnwarp">
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtnbuy detail_pop_tbtn_cpadding detail_pop_collection">采集</div>
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtnlike detail_pop_tbtn_cpadding">喜欢</div>
							<!-- <div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtntobuy detail_pop_tbtn_cpadding">去购买</div> -->
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
							<div class="index_item_price">￥980</div>
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
							<!-- <a class="detail_pop_authfollow detail_filebtn detail_fileball">+ 关注</a> -->
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
				<div class="perhome_follow_wrap clearfix">
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
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/2.png">
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
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/3.png">
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
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/4.png">
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
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/5.png">
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
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/6.png">
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
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/7.png">
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
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/8.png">
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
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/9.png">
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
				    <div class="index_item">
				    	<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<div class="index_item_price">￥980</div>
								<img src="public/images/temp/10.png">
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
	<!-- 采集时新建文件夹 -->
	<!-- <div class="pop_collect" style="display:none;">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="public/images/temp/pop_img.png" height="830" width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅">富有海的味道的客厅#室内设计#让新房的...</textarea>
					</div>
					
					<a href="javascript:;" class="detail_pop_colledit"></a>
				</div>
				<div class="pop_col_lbtm">
					<span class="pop_col_lbshare">
						分享到 :
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>
						<a class="pop_col_lbswc"></a>
						<a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>
					</span>
					
					<span class="pop_col_lbshare">
						微信朋友圈
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio"></a>
						<a class="pop_col_lbsqq"></a>
						<a class="jiathis_button_qzone jiathis_button"></a>
					</span>
					<span class="pop_col_lbshare">
						QQ空间
					</span>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				</div>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					创建文件夹
					<span class="pop_close"></span>
				</div>
				<div class="pop_col_infowrap">
					<div class="pop_col_name">
						<p class="pop_col_nlabel">名称</p>
						<input class="pop_col_ninput" placeholder="例如：欧式低奢亮色系风格">
					</div>
					<div class="pop_col_name">
						<p class="pop_col_nlabel">描述</p>
						<textarea class="pop_col_narea" placeholder="例如：欧式低奢亮色系风格"></textarea>
					</div>
					<div class="pop_col_priv">
						<p class="pop_col_nlabel">隐私</p>
						<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr">
						<label for="pop_iptpr"></label>
					</div>
				</div>
				<div class="pop_btnwrap">
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_build">创建</a>
				</div>
			</div>
		</div>
	</div> -->
	<!-- 采集时选择文件夹 -->
	<!-- <div class="pop_collect pop_choose" style="display:none;">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="public/images/temp/pop_img.png" height="830" width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅" style="resize: none;">富有海的味道的客厅#室内设计#让新房的...</textarea>
					</div>
					
					<a href="javascript:;" class="detail_pop_colledit"></a>
				</div>
				<div class="pop_col_lbtm">
					<span class="pop_col_lbshare">
						分享到 :
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>
						<a class="pop_col_lbswc"></a>
						<a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>
					</span>
					
					<span class="pop_col_lbshare">
						微信朋友圈
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio"></a>
						<a class="pop_col_lbsqq"></a>
						<a class="jiathis_button_qzone jiathis_button"></a>
					</span>
					<span class="pop_col_lbshare">
						QQ空间
					</span>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				</div>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close"></span>
					<p class="pop_col_tips">
						该文件已采集到<a href="javascript:;">工业风格</a>文件夹
					</p>
					<div class="pop_col_sinput_wrap">
						<a href="javascript:;" class="pop_col_sinputbtn"></a>
						<input class="pop_col_sinput" placeholder="搜索">
					</div>
					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
							<a href="javascript:;" class="pop_col_alpbtn">A</a><a href="javascript:;" class="pop_col_alpbtn">B</a><a href="javascript:;" class="pop_col_alpbtn">C</a><a href="javascript:;" class="pop_col_alpbtn">D</a><a href="javascript:;" class="pop_col_alpbtn">E</a><a href="javascript:;" class="pop_col_alpbtn">F</a><a href="javascript:;" class="pop_col_alpbtn">G</a><a href="javascript:;" class="pop_col_alpbtn">H</a><a href="javascript:;" class="pop_col_alpbtn">I</a><a href="javascript:;" class="pop_col_alpbtn">J</a><a href="javascript:;" class="pop_col_alpbtn">K</a><a href="javascript:;" class="pop_col_alpbtn">L</a><a href="javascript:;" class="pop_col_alpbtn">M</a><a href="javascript:;" class="pop_col_alpbtn">N</a><a href="javascript:;" class="pop_col_alpbtn">O</a><a href="javascript:;" class="pop_col_alpbtn">P</a><a href="javascript:;" class="pop_col_alpbtn">Q</a><a href="javascript:;" class="pop_col_alpbtn">R</a><a href="javascript:;" class="pop_col_alpbtn">S</a><a href="javascript:;" class="pop_col_alpbtn">T</a><a href="javascript:;" class="pop_col_alpbtn">U</a><a href="javascript:;" class="pop_col_alpbtn">V</a><a href="javascript:;" class="pop_col_alpbtn">W</a><a href="javascript:;" class="pop_col_alpbtn">X</a><a href="javascript:;" class="pop_col_alpbtn">Y</a><a href="javascript:;" class="pop_col_alpbtn">Z</a>
						</div>
						<p class="pop_col_new">最新采集到</p>
						<ul class="pop_col_colum pop_col_colum_new">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew">+</a>
					<p class="pop_add_addfont">新建文件夹</p>
				</div>
			</div>
		</div>
	</div> -->
	<!-- 采集时提示已经采集过了 -->
	<div class="pop_collect pop_choose pop_choose_already" style="display:none;">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="public/images/temp/pop_img.png" height="830" width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅" style="resize: none;">富有海的味道的客厅#室内设计#让新房的...</textarea>
					</div>
					
					<a href="javascript:;" class="detail_pop_colledit"></a>
				</div>
				<div class="pop_col_lbtm">
					<span class="pop_col_lbshare">
						分享到 :
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>
						<a class="pop_col_lbswc"></a>
						<a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>
					</span>
					
					<span class="pop_col_lbshare">
						微信朋友圈
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio"></a>
						<a class="pop_col_lbsqq"></a>
						<a class="jiathis_button_qzone jiathis_button"></a>
					</span>
					<span class="pop_col_lbshare">
						QQ空间
					</span>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				</div>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close"></span>
					<p class="pop_col_tips">
						该文件已采集到<a href="javascript:;">工业风格</a>文件夹
					</p>
					<div class="pop_col_sinput_wrap">
						<a href="javascript:;" class="pop_col_sinputbtn"></a>
						<input class="pop_col_sinput" placeholder="搜索">
					</div>
					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
							<a href="javascript:;" class="pop_col_alpbtn">A</a><a href="javascript:;" class="pop_col_alpbtn">B</a><a href="javascript:;" class="pop_col_alpbtn">C</a><a href="javascript:;" class="pop_col_alpbtn">D</a><a href="javascript:;" class="pop_col_alpbtn">E</a><a href="javascript:;" class="pop_col_alpbtn">F</a><a href="javascript:;" class="pop_col_alpbtn">G</a><a href="javascript:;" class="pop_col_alpbtn">H</a><a href="javascript:;" class="pop_col_alpbtn">I</a><a href="javascript:;" class="pop_col_alpbtn">J</a><a href="javascript:;" class="pop_col_alpbtn">K</a><a href="javascript:;" class="pop_col_alpbtn">L</a><a href="javascript:;" class="pop_col_alpbtn">M</a><a href="javascript:;" class="pop_col_alpbtn">N</a><a href="javascript:;" class="pop_col_alpbtn">O</a><a href="javascript:;" class="pop_col_alpbtn">P</a><a href="javascript:;" class="pop_col_alpbtn">Q</a><a href="javascript:;" class="pop_col_alpbtn">R</a><a href="javascript:;" class="pop_col_alpbtn">S</a><a href="javascript:;" class="pop_col_alpbtn">T</a><a href="javascript:;" class="pop_col_alpbtn">U</a><a href="javascript:;" class="pop_col_alpbtn">V</a><a href="javascript:;" class="pop_col_alpbtn">W</a><a href="javascript:;" class="pop_col_alpbtn">X</a><a href="javascript:;" class="pop_col_alpbtn">Y</a><a href="javascript:;" class="pop_col_alpbtn">Z</a>
						</div>
						<p class="pop_col_new">最新采集到</p>
						<ul class="pop_col_colum pop_col_colum_new">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew">+</a>
					<p class="pop_add_addfont">新建文件夹</p>
				</div>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript">
	postUrl = '{{url("webd/user/goods?oid={$user_id}")}}'
	postData = {'num':10}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/userpubu.js"></script>
<script type="text/javascript" src="{{asset('web')}}/js/pic.js"></script>
</html>