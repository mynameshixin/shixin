<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家--发现'])
<body>
	@include('web.common.banner')
	<div class="container">
		<div class="w1248 clearfix">
			<p class="find_title">分类</p>
			<div class="find_cater_wrap">
				<div class="find_cater clearfix">
					<ul class="find_cat_list">
						<?php foreach ($cate as $key => $v) :?>
							<li class="find_cat_listli">
								<img src="{{$v['imageurl']}}" alt="">
								<a href="javascript:;" target="_blank">{{$v['name']}}</a>
							</li>
						<?php endforeach; ?>
						<li class="find_cat_listli mrightzero">
							<img src="{{url('web')}}/public/images/cat/12.png" alt="">
							<a href="javascript:;" target="_blank" class="find_cat_more">查看全部</a>
						</li>
					</ul>
				</div>
				<div class="find_cater_all slideup clearfix">
					<div class="find_cater_tril"></div>
					<div class="find_cater_aeach_wrap clearfix">
						<ul class="find_cater_aeach">
							<p class="find_cater_label">家具</p>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">家具</p>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero">
							<p class="find_cater_label">家具</p>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
						</ul>
					</div>
					<div class="find_cater_aeach_wrap clearfix">
						<ul class="find_cater_aeach">
							<p class="find_cater_label">家具</p>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">家具</p>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero">
							<p class="find_cater_label">家具</p>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
							<li><a href="javascript:;">沙发</a></li>
						</ul>
					</div>
				</div>
			</div>

			
			<p class="find_title">文件夹推荐</p>
			<div class="find_cater clearfix">
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
						<a href="javascript:;" class="find_fold_authflw"><span>+</span>关注</a>
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
						<a href="javascript:;" class="find_fold_authflw"><span>+</span>关注</a>
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
						<a href="javascript:;" class="find_fold_authflw"><span>+</span>关注</a>
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
						<a href="javascript:;" class="find_fold_authflw"><span>+</span>关注</a>
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
						<a href="javascript:;" class="find_fold_authflw"><span>+</span>关注</a>
					</li>
				</ul>
			</div>
			<p class="find_title">商品推荐</p>
			<div class="index_con">
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
	<a href="javascript:;" class="back_to_top">^</a>
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
		    $('.back_to_top').click(function(){
		    	$("html,body").animate({scrollTop: 0},600);
		    })
		    // .find_cater_wrap
		    $('.find_cat_more').click(function(){
		    	if ($(this).parents('.find_cater_wrap').find('.find_cater_all').hasClass('slideup')) {
		    		$(this).parents('.find_cater_wrap').find('.find_cater_all').removeClass('slideup').addClass('slidedown');
		    	}else{
		    		$(this).parents('.find_cater_wrap').find('.find_cater_all').removeClass('slidedown').addClass('slideup');
		    	};
		    })
		});
	</script>
</html>