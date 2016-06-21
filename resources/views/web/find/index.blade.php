<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家--发现'])
<body>
	@include('web.common.banner')
	<div class="container">
		<div class="w1248 clearfix">
			<p class="find_title">特别推荐</p>
			<div class="find_cater_wrap">
				<div class="clearfix">
					<ul class="find_cat_list">
						<li class="find_rec_special" onclick="layer_error('正在建设中')">
							<img src="{{asset('web')}}/images/cat/four_rec/01.jpg" alt="">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">梦幻家</p>
								<p class="find_rec_wrapdes">“用VR展示住宅空间”</p>
							</div>
						</li>
						<li class="find_rec_special" onclick="layer_error('正在建设中')">
							<img src="{{asset('web')}}/images/cat/four_rec/02.jpg" alt="">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">改造家</p>
								<p class="find_rec_wrapdes">“二手房与家居改造”</p>
							</div>
						</li>
						<li class="find_rec_special" onclick="layer_error('正在建设中')">
							<img src="{{asset('web')}}/images/cat/four_rec/03.jpg" alt="">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">家居前线</p>
								<p class="find_rec_wrapdes">“会展信息与公众微信推荐”</p>
							</div>
						</li>
						<li class="find_rec_special mrightzero" onclick="layer_error('正在建设中')">
							<img src="{{asset('web')}}/images/cat/four_rec/04.jpg" alt="">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">二手商品</p>
								<p class="find_rec_wrapdes">“二手家居商品展示平台”</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			
			<p class="find_title">热门分类</p>
			<div class="find_cater_wrap">
				<div class="clearfix">
					<ul class="find_cat_list">
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/1.jpg" alt="">
							<a href="/webd/search?keyword=餐具" target="_blank">餐具</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/2.jpg" alt="">
							<a href="/webd/search?keyword=新古典" target="_blank">新古典</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/3.jpg" alt="">
							<a href="/webd/search?keyword=钟" target="_blank">钟</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/4.jpg" alt="">
							<a href="/webd/search?keyword=床品" target="_blank">床品</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/5.jpg" alt="">
							<a href="/webd/search?keyword=摆件" target="_blank">摆件</a>
						</li>
						<li class="find_cat_listli" style="margin-right: 14px;">
							<img src="{{asset('web')}}/images/cat/6.jpg" alt="">
							<a href="/webd/search?keyword=厨房" target="_blank">厨房</a>
						</li>
						<li class="find_cat_listli mrightzero">
							<img src="{{asset('web')}}/images/cat/7.jpg" alt="">
							<a href="/webd/search?keyword=多肉" target="_blank">多肉</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/8.jpg" alt="">
							<a href="/webd/search?keyword=儿童房" target="_blank">儿童房</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/9.jpg" alt="">
							<a href="/webd/search?keyword=抱枕" target="_blank">抱枕</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/10.jpg" alt="">
							<a href="/webd/search?keyword=书房" target="_blank">书房</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/11.jpg" alt="">
							<a href="/webd/search?keyword=客厅" target="_blank">客厅</a>
						</li>
						<li class="find_cat_listli">
							<img src="{{asset('web')}}/images/cat/12.jpg" alt="">
							<a href="/webd/search?keyword=挂件" target="_blank">挂件</a>
						</li>
						<li class="find_cat_listli" style="margin-right: 14px;">
							<img src="{{asset('web')}}/images/cat/13.jpg" alt="">
							<a href="/webd/search?keyword=宜家" target="_blank">宜家</a>
						</li>
						<li class="find_cat_listli clickcon mrightzero">
							<div class="clickconimg"></div>
							<a href="javascript:;" target="_blank">查看全部</a>
						</li>
					</ul>
				</div>
				<div class="find_cater_all slideup clearfix" style="margin-top: 10px;">
				<!-- <div class="find_cater_all clearfix" style="margin-top: 10px;"> -->
					<div class="find_cater_tril"></div>
					<div class="find_cater_aeach_wrap clearfix" style="margin-bottom: 40px;">
						<ul class="find_cater_aeach">
							<p class="find_cater_label">家具</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">沙发</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">椅子</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">书柜</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">茶几</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">床</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">餐桌</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">衣柜</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">电视柜</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">鞋柜</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">户外家具</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">儿童家具</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">收纳箱</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">灯饰</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">台灯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">吊灯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">壁灯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">户外灯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">镜前灯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">吸顶灯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">创意灯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">落地灯</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">装饰摆设</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">摆件</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">镜子</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">钟</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">装置画</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">香薰</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">挂钩</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">收纳</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">相框</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero">
							<p class="find_cater_label">家纺家饰</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">床品</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">抱枕</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">布料</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">窗帘</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">坐垫</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">桌布</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">枕头</a></li>
						</ul>
					</div>
					<div class="find_cater_aeach_wrap clearfix" style="margin-bottom: 40px;">
						<ul class="find_cater_aeach">
							<p class="find_cater_label">地毯</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">现代</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">古典</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">手工</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">儿童</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">花艺植物</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">多肉植物</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">花瓶</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">花盆</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">仿真花</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">鲜花</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">家用小电器</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">微波炉</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">烤箱</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">面包机</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">咖啡机</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">搅拌机</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">豆浆机</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">加湿器</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">饮水机</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">电风扇</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">吸尘器</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">其他</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero">
							<p class="find_cater_label">文具</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">彩铅&nbsp;钢笔</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">笔盒&nbsp;笔袋</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">本子</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">书立</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">工具类</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">文房四宝</a></li>
						</ul>
					</div>
					<div class="find_cater_aeach_wrap clearfix">
						<ul class="find_cater_aeach">
							<p class="find_cater_label">品牌</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">MINOTTI</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">B&B</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">Miniforms</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">包豪斯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">传世</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">美克美家</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">第展</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">希尔巴赫</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">梁志天</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">风格</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">现代</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">中式</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">日式</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">新古典</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">美式</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">法式</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">田园</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">地中海</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">LOFT</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">北欧</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">混搭</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">空间</p>
							<li><a href="/webd/search?keyword=宜家" target="_blank">客厅</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">玄关</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">厨房</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">餐厅</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">卧室</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">衣帽间</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">书房</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">儿童房</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">阳台</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">卫生间</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">阁楼</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">庭院</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">酒店</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">楼梯</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">办公室</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">阳光房</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">商业广场</a></li>
							<li><a href="/webd/search?keyword=宜家" target="_blank">售楼处</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero">
							<p class="find_cater_label">按颜色</p>
							<div class="find_cater_aeachcolor clearfix">
								<li><a class="find_cater_lcolor find_cater_lc1" href="/webd/search?keyword=宜家" target="_blank"></a></li>
								<li><a class="find_cater_lcolor find_cater_lc2" href="/webd/search?keyword=宜家" target="_blank"></a></li>
								<li><a class="find_cater_lcolor find_cater_lc3" href="/webd/search?keyword=宜家" target="_blank"></a></li>
							</div>
							<div class="find_cater_aeachcolor clearfix">
								<li><a class="find_cater_lcolor find_cater_lc4" href="/webd/search?keyword=宜家"></a></li>
								<li><a class="find_cater_lcolor find_cater_lc5" href="/webd/search?keyword=宜家"></a></li>
								<li><a class="find_cater_lcolor find_cater_lc6" href="/webd/search?keyword=宜家"></a></li>
							</div>
							<div class="find_cater_aeachcolor clearfix">
								<li><a class="find_cater_lcolor find_cater_lc7" href="/webd/search?keyword=宜家"></a></li>
								<li><a class="find_cater_lcolor find_cater_lc8" href="/webd/search?keyword=宜家"></a></li>
								<li><a class="find_cater_lcolor find_cater_lc9" href="/webd/search?keyword=宜家"></a></li>
							</div>
						</ul>
					</div>
				</div>
			</div>
			<p class="find_title">堆图达人</p>
			<div class="clearfix">
				<ul class="find_fold_list clearfix">
						<li class="find_user_li">
							<div class="find_user_info">
								<a href="javascript:;" class="find_user_name">小明</a>
								<a href="javascript:;" class="find_user_rela">12粉丝 10关注</a>
							</div>
							<div class="find_user_con clearfix">
								<div class="find_user_img">
									<div class="find_user_blur"></div>
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<ul class="find_user_limg">
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
								</ul>
								<a href="javascript:;" class="find_user_authflw"><span>+</span>关注</a>
							</div>
						</li>
						<li class="find_user_li">
							<div class="find_user_info">
								<a href="javascript:;" class="find_user_name">小明</a>
								<a href="javascript:;" class="find_user_rela">12粉丝 10关注</a>
							</div>
							<div class="find_user_con clearfix">
								<div class="find_user_img">
									<div class="find_user_blur"></div>
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<ul class="find_user_limg">
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
								</ul>
								<a href="javascript:;" class="find_user_authflw"><span>+</span>关注</a>
							</div>
						</li>
						<li class="find_user_li">
							<div class="find_user_info">
								<a href="javascript:;" class="find_user_name">小明</a>
								<a href="javascript:;" class="find_user_rela">12粉丝 10关注</a>
							</div>
							<div class="find_user_con clearfix">
								<div class="find_user_img">
									<div class="find_user_blur"></div>
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<ul class="find_user_limg">
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
								</ul>
								<a href="javascript:;" class="find_user_authflw"><span>+</span>关注</a>
							</div>
						</li>
						<li class="find_user_li">
							<div class="find_user_info">
								<a href="javascript:;" class="find_user_name">小明</a>
								<a href="javascript:;" class="find_user_rela">12粉丝 10关注</a>
							</div>
							<div class="find_user_con clearfix">
								<div class="find_user_img">
									<div class="find_user_blur"></div>
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<ul class="find_user_limg">
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
								</ul>
								<a href="javascript:;" class="find_user_authflw">已关注</a>
							</div>
						</li>
						<li class="find_user_li mrightzero">
							<div class="find_user_info">
								<a href="javascript:;" class="find_user_name">小明</a>
								<a href="javascript:;" class="find_user_rela">12粉丝 10关注</a>
							</div>
							<div class="find_user_con clearfix">
								<div class="find_user_img">
									<div class="find_user_blur"></div>
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<ul class="find_user_limg">
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
									<li>
										<div class="find_user_blur"></div>
										<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
									</li>
								</ul>
								<a href="javascript:;" class="find_user_authflw">已关注</a>
							</div>
						</li>
					</ul>
			</div>
			<p class="find_title">精品文件夹</p>
			<div class="clearfix">
				<ul class="find_fold_list clearfix">
					<li class="find_fold_li">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="#" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
							</div>
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
								<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{asset('web')}}/images/cat/b.png" alt="">
							<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw"><span>+&nbsp;</span>关注</a>
					</li>
					<li class="find_fold_li">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="#" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
							</div>
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
								<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{asset('web')}}/images/cat/b.png" alt="">
							<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw"><span>+&nbsp;</span>关注</a>
					</li>
					<li class="find_fold_li">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="#" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
							</div>
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
								<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{asset('web')}}/images/cat/b.png" alt="">
							<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw"><span>+&nbsp;</span>关注</a>
					</li>
					<li class="find_fold_li">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="#" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
							</div>
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
								<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{asset('web')}}/images/cat/b.png" alt="">
							<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw"><span>+&nbsp;</span>关注</a>
					</li>
					<li class="find_fold_li mrightzero">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="#" target="_blank"><img src="{{asset('web')}}/images/temp_avatar.JPG" alt=""></a>
							</div>
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
								<a href="#" target="_blank" class="find_fold_authnme">ewqhrwiuerhiwuer</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{asset('web')}}/images/cat/b.png" alt="">
							<div class="find_fold_catflw">10文件&nbsp;&nbsp;10关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{asset('web')}}/images/cat/l.png" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw"><span>+&nbsp;</span>关注</a>
					</li>
				</ul>
			</div>
			<p class="find_title">人气商品</p>
			<div class="index_con">
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
									<p class="index_item_authtopart">搭配</p>
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
	postUrl = "{{url('webd/home/goods')}}"
	postData = {'num':10}
</script>

<script type="text/javascript">
		$(function() {
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
		    
		    // .find_cater_wrap
		    $('.clickcon').click(function(){
		    	var aimCon = $(this).parents('.find_cater_wrap').find('.find_cater_all');
		    	if (aimCon.hasClass('slideup')) {
		    		aimCon.removeClass('slideup').addClass('slidedown');
		    		$(this).find('.clickconimg').addClass('clickconimgdown');
		    	}else{
		    		aimCon.removeClass('slidedown').addClass('slideup');
		    		$(this).find('.clickconimg').removeClass('clickconimgdown');
		    	};
		    })
		});
	</script>
</html>