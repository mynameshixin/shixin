<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
	<script type="text/javascript">
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	self_id = "{{$self_id}}"
	relationUrl = "{{url('webd/user/relation')}}"
	</script>
	<script src="{{url('web/js/user/relation.js')}}"></script>
	<div class="container">
		<div class="w1248 clearfix">
			<p class="find_title">特别推荐</p>
			<div class="find_cater_wrap">
				<div class="clearfix">
					<ul class="find_cat_list">
						<li class="find_rec_special" onclick="location.href='/vr/1'" style="cursor: pointer;">
							<img src="{{asset('web')}}/images/cat/four_rec/01.jpg" alt="梦幻家">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">梦幻家</p>
								<p class="find_rec_wrapdes">“用VR展示住宅空间”</p>
							</div>
						</li>
						<li class="find_rec_special" onclick="location.href='/vr/2'" style="cursor: pointer;">
							<img src="{{asset('web')}}/images/cat/four_rec/02.jpg" alt="改造家">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">设计家</p>
								<p class="find_rec_wrapdes">“二手房与家居改造”</p>
							</div>
						</li>
						<li class="find_rec_special" onclick="location.href='/vr/3'" style="cursor: pointer;">
							<img src="{{asset('web')}}/images/cat/four_rec/03.jpg" alt="家居前线">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">VR门店</p>
								<p class="find_rec_wrapdes">“品牌门店VR全景展示”</p>
							</div>
						</li>
						<li class="find_rec_special mrightzero" onclick="layer_error('正在建设中')" style="cursor: pointer;">
							<img src="{{asset('web')}}/images/cat/four_rec/04.jpg" alt="二手商品">
							<div class="find_rec_wrap">
								<p class="find_rec_wraptit">出清商品</p>
								<p class="find_rec_wrapdes">“尾货与二手家居展示”</p>
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
							<a href="/webd/search/goods?keyword=餐具" target="_blank"><img src="{{asset('web')}}/images/cat/1.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=餐具" target="_blank">餐具</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=新古典" target="_blank"><img src="{{asset('web')}}/images/cat/2.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=新古典" target="_blank">新古典</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=钟" target="_blank"><img src="{{asset('web')}}/images/cat/3.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=钟" target="_blank">钟</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=床品" target="_blank"><img src="{{asset('web')}}/images/cat/4.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=床品" target="_blank">床品</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=摆件" target="_blank"><img src="{{asset('web')}}/images/cat/5.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=摆件" target="_blank">摆件</a>
						</li>
						<li class="find_cat_listli" style="margin-right: 14px;">
							<a href="/webd/search/goods?keyword=厨房" target="_blank"><img src="{{asset('web')}}/images/cat/6.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=厨房" target="_blank">厨房</a>
						</li>
						<li class="find_cat_listli mrightzero">
							<a href="/webd/search/goods?keyword=多肉" target="_blank"><img src="{{asset('web')}}/images/cat/7.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=多肉" target="_blank">多肉</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=儿童房" target="_blank"><img src="{{asset('web')}}/images/cat/8.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=儿童房" target="_blank">儿童房</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=抱枕" target="_blank"><img src="{{asset('web')}}/images/cat/9.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=抱枕" target="_blank">抱枕</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=书房" target="_blank"><img src="{{asset('web')}}/images/cat/10.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=书房" target="_blank">书房</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=客厅" target="_blank"><img src="{{asset('web')}}/images/cat/11.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=客厅" target="_blank">客厅</a>
						</li>
						<li class="find_cat_listli">
							<a href="/webd/search/goods?keyword=挂件" target="_blank"><img src="{{asset('web')}}/images/cat/12.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=挂件" target="_blank">挂件</a>
						</li>
						<li class="find_cat_listli" style="margin-right: 14px;">
							<a href="/webd/search/goods?keyword=宜家" target="_blank"><img src="{{asset('web')}}/images/cat/13.jpg" alt=""></a>
							<a href="/webd/search/goods?keyword=宜家" target="_blank">宜家</a>
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
							<p class="find_cater_label">设计风格</p>
							<li><a href="/webd/search/goods?keyword=现代" target="_blank">现代</a></li>
							<li><a href="/webd/search/goods?keyword=北欧" target="_blank">北欧</a></li>
							<li><a href="/webd/search/goods?keyword=日式" target="_blank">日式</a></li>
							<li><a href="/webd/search/goods?keyword=法式" target="_blank">法式</a></li>
							<li><a href="/webd/search/goods?keyword=新中式" target="_blank">新中式</a></li>
							<li><a href="/webd/search/goods?keyword=新古典" target="_blank">新古典</a></li>
							<li><a href="/webd/search/goods?keyword=简欧" target="_blank">简欧</a></li>
							<li><a href="/webd/search/goods?keyword=古典中式" target="_blank">古典中式</a></li>
							<li><a href="/webd/search/goods?keyword=古典" target="_blank">古典</a></li>
							<li><a href="/webd/search/goods?keyword=地中海" target="_blank">地中海</a></li>
							<li><a href="/webd/search/goods?keyword=LOFT" target="_blank">LOFT</a></li>
							<li><a href="/webd/search/goods?keyword=东南亚" target="_blank">东南亚</a></li>
							<li><a href="/webd/search/goods?keyword=美式工业" target="_blank">美式工业</a></li>
							<li><a href="/webd/search/goods?keyword=美式田园" target="_blank">美式田园</a></li>
							<li><a href="/webd/search/goods?keyword=美式简约" target="_blank">美式简约</a></li>
							<li><a href="/webd/search/goods?keyword=巴洛克" target="_blank">巴洛克</a></li>
							<li><a href="/webd/search/goods?keyword=意大利" target="_blank">意大利</a></li>
							<li><a href="/webd/search/goods?keyword=混搭" target="_blank">混搭</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">居家空间</p>
							<li><a href="/webd/search/goods?keyword=客厅" target="_blank">客厅</a></li>
							<li><a href="/webd/search/goods?keyword=玄关" target="_blank">玄关</a></li>
							<li><a href="/webd/search/goods?keyword=餐厅" target="_blank">餐厅</a></li>
							<li><a href="/webd/search/goods?keyword=卧室" target="_blank">卧室</a></li>
							<li><a href="/webd/search/goods?keyword=阳台" target="_blank">阳台</a></li>
							<li><a href="/webd/search/goods?keyword=厨房" target="_blank">厨房</a></li>
							<li><a href="/webd/search/goods?keyword=书房" target="_blank">书房</a></li>
							<li><a href="/webd/search/goods?keyword=阳光房" target="_blank">阳光房</a></li>
							<li><a href="/webd/search/goods?keyword=庭院" target="_blank">庭院</a></li>
							<li><a href="/webd/search/goods?keyword=花园" target="_blank">花园</a></li>
							<li><a href="/webd/search/goods?keyword=衣帽间" target="_blank">衣帽间</a></li>
							<li><a href="/webd/search/goods?keyword=卫生间" target="_blank">卫生间</a></li>
							<li><a href="/webd/search/goods?keyword=酒窖" target="_blank">酒窖</a></li>
							<li><a href="/webd/search/goods?keyword=阁楼" target="_blank">阁楼</a></li>
							<li><a href="/webd/search/goods?keyword=走道" target="_blank">走道</a></li>
							<li><a href="/webd/search/goods?keyword=楼梯过厅" target="_blank">楼梯过厅</a></li>
							<li><a href="/webd/search/goods?keyword=儿童房" target="_blank">儿童房</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">商业广场</p>
							<li><a href="/webd/search/goods?keyword=餐饮店" target="_blank">餐饮店</a></li>
							<li><a href="/webd/search/goods?keyword=酒店" target="_blank">酒店</a></li>
							<li><a href="/webd/search/goods?keyword=民宿" target="_blank">民宿</a></li>
							<li><a href="/webd/search/goods?keyword=售楼处" target="_blank">售楼处</a></li>
							<li><a href="/webd/search/goods?keyword=会所" target="_blank">会所</a></li>
							<li><a href="/webd/search/goods?keyword=茶室" target="_blank">茶室</a></li>
							<li><a href="/webd/search/goods?keyword=样板房" target="_blank">样板房</a></li>
							<li><a href="/webd/search/goods?keyword=办公室" target="_blank">办公室</a></li>
							<li><a href="/webd/search/goods?keyword=商业广场" target="_blank">商业广场</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero pos_relative">
							<p class="find_cater_label">红星美凯龙<span class="h-more" style="font-size: 13px; margin-left: 10px;cursor: pointer;"><<(更多)</span></p>
							<li><a href="/webd/search/goods?keyword=左右" target="_blank">左右</a></li>
							<li><a href="/webd/search/goods?keyword=奥卓" target="_blank">奥卓</a></li>
							<li><a href="/webd/search/goods?keyword=双叶" target="_blank">双叶</a></li>
							<li><a href="/webd/search/goods?keyword=多喜爱" target="_blank">多喜爱</a></li>
							<li><a href="/webd/search/goods?keyword=法染仕" target="_blank">法染仕</a></li>
							<li><a href="/webd/search/goods?keyword=柏逸轩" target="_blank">柏逸轩</a></li>
							<li><a href="/webd/search/goods?keyword=大公馆" target="_blank">大公馆</a></li>
							<li><a href="/webd/search/goods?keyword=欧意诺" target="_blank">欧意诺</a></li>
							<li><a href="/webd/search/goods?keyword=欧亚森" target="_blank">欧亚森</a></li>
							<li><a href="/webd/search/goods?keyword=艺尊轩" target="_blank">艺尊轩</a></li>
							<li><a href="/webd/search/goods?keyword=印卓艺" target="_blank">印卓艺</a></li>
							<li><a href="/webd/search/goods?keyword=御景源" target="_blank">御景源</a></li>
							<li><a href="/webd/search/goods?keyword=罗曼迪卡" target="_blank">罗曼迪卡</a></li>
							<li><a href="/webd/search/goods?keyword=奥克维尔" target="_blank">奥克维尔</a></li>
							<li><a href="/webd/search/goods?keyword=优胜美地" target="_blank">优胜美地</a></li>
							<li><a href="/webd/search/goods?keyword=laz boy" target="_blank">laz boy</a></li>
							<li><a href="/webd/search/goods?keyword=fc" target="_blank">fc</a></li>
							<li><a href="/webd/search/goods?keyword=m&d" target="_blank">m&d</a></li>
							<div class="find_cater_aeach_wrap h-div clearfix" style="margin-bottom: 40px; display: none;">
								<ul class="find_cater_aeach">
									<p class="find_cater_label">吉盛伟邦</p>
									<li><a href="/webd/search/goods?keyword=高点">高点</a></li>
									<li><a href="/webd/search/goods?keyword=奢世">奢世</a></li>
									<li><a href="/webd/search/goods?keyword=迪信">迪信</a></li>
									<li><a href="/webd/search/goods?keyword=康宝">康宝</a></li>
									<li><a href="/webd/search/goods?keyword=澳瑞">澳瑞</a></li>
									<li><a href="/webd/search/goods?keyword=百强">百强</a></li>
									<li><a href="/webd/search/goods?keyword=瑞加设计">瑞加设计</a></li>
									<li><a href="/webd/search/goods?keyword=百合臻品">百合臻品</a></li>
									<li><a href="/webd/search/goods?keyword=天元尚品">天元尚品</a></li>
									<li><a href="/webd/search/goods?keyword=皇家爱菲">皇家爱菲</a></li>
									<li><a href="/webd/search/goods?keyword=法米商居">法米商居</a></li>
									<li><a href="/webd/search/goods?keyword=富兰帝斯">富兰帝斯</a></li>
									<li><a href="/webd/search/goods?keyword=Bedont">Bedont</a></li>
									<li><a href="/webd/search/goods?keyword=Reflex">Reflex</a></li>
									<li><a href="/webd/search/goods?keyword=Sedital">Sedital</a></li>
									<li><a href="/webd/search/goods?keyword=Bertolini">Bertolini</a></li>
									<li><a href="/webd/search/goods?keyword=Mastella">Mastella</a></li>
									<li><a href="/webd/search/goods?keyword=Zanaboni">Zanaboni</a></li>
								</ul>
								<ul class="find_cater_aeach">
									<p class="find_cater_label">艺展空间</p>
									<li><a href="/webd/search/goods?keyword=邸色">邸色</a></li>
									<li><a href="/webd/search/goods?keyword=简末">简末</a></li>
									<li><a href="/webd/search/goods?keyword=米兰诺">米兰诺</a></li>
									<li><a href="/webd/search/goods?keyword=物本造">物本造</a></li>
									<li><a href="/webd/search/goods?keyword=一念间">一念间</a></li>
									<li><a href="/webd/search/goods?keyword=明艺韵">明艺韵</a></li>
									<li><a href="/webd/search/goods?keyword=醒艺廊">醒艺廊</a></li>
									<li><a href="/webd/search/goods?keyword=上坐">上坐</a></li>
									<li><a href="/webd/search/goods?keyword=法诺">法诺</a></li>
									<li><a href="/webd/search/goods?keyword=哒哒饰">哒哒饰</a></li>
									<li><a href="/webd/search/goods?keyword=U+家具">U+家具</a></li>
									<li><a href="/webd/search/goods?keyword=罗瓦莎">罗瓦莎</a></li>
									<li><a href="/webd/search/goods?keyword=米立方">米立方</a></li>
									<li><a href="/webd/search/goods?keyword=泠空间">泠空间</a></li>
									<li><a href="/webd/search/goods?keyword=可立特">可立特</a></li>
									<li><a href="/webd/search/goods?keyword=DOMO">DOMO</a></li>
									<li><a href="/webd/search/goods?keyword=HOME+">HOME+</a></li>
									<li><a href="/webd/search/goods?keyword=HAUS658">HAUS658</a></li>
								</ul>
								<ul class="find_cater_aeach">
									<p class="find_cater_label">广州国际家具博览会</p>
									<li><a href="/webd/search/goods?keyword=杨狮">杨狮</a></li>
									<li><a href="/webd/search/goods?keyword=御品">御品</a></li>
									<li><a href="/webd/search/goods?keyword=摩卡">摩卡</a></li>
									<li><a href="/webd/search/goods?keyword=非凡">非凡</a></li>
									<li><a href="/webd/search/goods?keyword=非同">非同</a></li>
									<li><a href="/webd/search/goods?keyword=纳希">纳希</a></li>
									<li><a href="/webd/search/goods?keyword=雅时">雅时</a></li>
									<li><a href="/webd/search/goods?keyword=舒派">舒派</a></li>
									<li><a href="/webd/search/goods?keyword=逸居">逸居</a></li>
									<li><a href="/webd/search/goods?keyword=欧蒂诺">欧蒂诺</a></li>
									<li><a href="/webd/search/goods?keyword=克里斯">克里斯</a></li>
									<li><a href="/webd/search/goods?keyword=卡迪娅">卡迪娅</a></li>
									<li><a href="/webd/search/goods?keyword=卡尼亚">卡尼亚</a></li>
									<li><a href="/webd/search/goods?keyword=康耐登">康耐登</a></li>
									<li><a href="/webd/search/goods?keyword=梦露斯">梦露斯</a></li>
									<li><a href="/webd/search/goods?keyword=area">area</a></li>
									<li><a href="/webd/search/goods?keyword=armoni">armoni</a></li>
									<li><a href="/webd/search/goods?keyword=leta">leta</a></li>
								</ul>
								<ul class="find_cater_aeach mrightzero">
									<p class="find_cater_label">红星美凯龙<span class="h-less">  >>(收起)</span></p>
									<li><a href="/webd/search/goods?keyword=左右" target="_blank">左右</a></li>
									<li><a href="/webd/search/goods?keyword=奥卓" target="_blank">奥卓</a></li>
									<li><a href="/webd/search/goods?keyword=双叶" target="_blank">双叶</a></li>
									<li><a href="/webd/search/goods?keyword=多喜爱" target="_blank">多喜爱</a></li>
									<li><a href="/webd/search/goods?keyword=法染仕" target="_blank">法染仕</a></li>
									<li><a href="/webd/search/goods?keyword=柏逸轩" target="_blank">柏逸轩</a></li>
									<li><a href="/webd/search/goods?keyword=大公馆" target="_blank">大公馆</a></li>
									<li><a href="/webd/search/goods?keyword=欧意诺" target="_blank">欧意诺</a></li>
									<li><a href="/webd/search/goods?keyword=欧亚森" target="_blank">欧亚森</a></li>
									<li><a href="/webd/search/goods?keyword=艺尊轩" target="_blank">艺尊轩</a></li>
									<li><a href="/webd/search/goods?keyword=印卓艺" target="_blank">印卓艺</a></li>
									<li><a href="/webd/search/goods?keyword=御景源" target="_blank">御景源</a></li>
									<li><a href="/webd/search/goods?keyword=罗曼迪卡" target="_blank">罗曼迪卡</a></li>
									<li><a href="/webd/search/goods?keyword=奥克维尔" target="_blank">奥克维尔</a></li>
									<li><a href="/webd/search/goods?keyword=优胜美地" target="_blank">优胜美地</a></li>
									<li><a href="/webd/search/goods?keyword=laz boy" target="_blank">laz boy</a></li>
									<li><a href="/webd/search/goods?keyword=fc" target="_blank">fc</a></li>
									<li><a href="/webd/search/goods?keyword=m&d" target="_blank">m&d</a></li>
									
								</ul>
								
							</div>
						</ul>
					</div>
					<div class="find_cater_aeach_wrap clearfix" style="margin-bottom: 40px;">
						<ul class="find_cater_aeach pos_relative">
							<p class="find_cater_label">单品<span class="h-more" style="font-size: 13px; margin-left: 10px;cursor: pointer;">(更多)>></span></p>
							<li><a href="/webd/search/goods?keyword=沙发" target="_blank">沙发</a></li>
							<li><a href="/webd/search/goods?keyword=桌" target="_blank">桌</a></li>
							<li><a href="/webd/search/goods?keyword=床" target="_blank">床</a></li>
							<li><a href="/webd/search/goods?keyword=柜" target="_blank">柜</a></li>
							<li><a href="/webd/search/goods?keyword=架" target="_blank">架</a></li>
							<li><a href="/webd/search/goods?keyword=其他" target="_blank">其他</a></li>
							<div class="find_cater_aeach_wrap h-div  d-item clearfix" style="margin-bottom: 40px; display: none;">
								<ul class="find_cater_aeach">
									<p class="find_cater_label">沙发<span class="h-less">(合上)>></span></p>
									<li><a href="/webd/search/goods?keyword=三人沙发">三人沙发</a></li>
									<li><a href="/webd/search/goods?keyword=双人沙发">双人沙发</a></li>
									<li><a href="/webd/search/goods?keyword=单人沙发">单人沙发</a></li>
									<li><a href="/webd/search/goods?keyword=沙发床">沙发床</a></li>
									<li><a href="/webd/search/goods?keyword=布艺沙发">布艺沙发</a></li>
									<li><a href="/webd/search/goods?keyword=皮质沙发">皮质沙发</a></li>
									<li><a href="/webd/search/goods?keyword=古典沙发">古典沙发</a></li>
									<li><a href="/webd/search/goods?keyword=现代沙发">现代沙发</a></li>
									<li><a href="/webd/search/goods?keyword=美式沙发">美式沙发</a></li>
									<li><a href="/webd/search/goods?keyword=东南亚沙发">东南亚沙发</a></li>
									<li><a href="/webd/search/goods?keyword=简欧沙发">简欧沙发</a></li>
									<li><a href="/webd/search/goods?keyword=日式沙发">日式沙发</a></li>
									
								</ul>
								<ul class="find_cater_aeach">
									<p class="find_cater_label">桌</p>
									<li><a href="/webd/search/goods?keyword=餐桌">餐桌</a></li>
									<li><a href="/webd/search/goods?keyword=书桌">书桌</a></li>
									<li><a href="/webd/search/goods?keyword=茶几">茶几</a></li>
									<li><a href="/webd/search/goods?keyword=办公桌">办公桌</a></li>
									<li><a href="/webd/search/goods?keyword=梳妆台">梳妆台</a></li>
									<li><a href="/webd/search/goods?keyword=吧台">吧台</a></li>
									<li><a href="/webd/search/goods?keyword=会议桌">会议桌</a></li>
									<li><a href="/webd/search/goods?keyword=沙发桌">沙发桌</a></li>
									<li><a href="/webd/search/goods?keyword=咖啡桌">咖啡桌</a></li>
								</ul>
								<ul class="find_cater_aeach mrightzero">
									<p class="find_cater_label">床</p>
									<li><a href="/webd/search/goods?keyword=双人床">双人床</a></li>
									<li><a href="/webd/search/goods?keyword=儿童床">儿童床</a></li>
									<li><a href="/webd/search/goods?keyword=单人床">单人床</a></li>
									<li><a href="/webd/search/goods?keyword=实木床">实木床</a></li>
									<li><a href="/webd/search/goods?keyword=板式床">板式床</a></li>
									<li><a href="/webd/search/goods?keyword=铁艺床">铁艺床</a></li>
									<li><a href="/webd/search/goods?keyword=水床">水床</a></li>
									<li><a href="/webd/search/goods?keyword=吊床">吊床</a></li>
									<li><a href="/webd/search/goods?keyword=榻榻米床">榻榻米床</a></li>
									<li><a href="/webd/search/goods?keyword=欧式床">欧式床</a></li>
									<li><a href="/webd/search/goods?keyword=折叠床">折叠床</a></li>
									<li><a href="/webd/search/goods?keyword=美式床">美式床</a></li>
									<li><a href="/webd/search/goods?keyword=地中海床">地中海床</a></li>
									<li><a href="/webd/search/goods?keyword=高低床">高低床</a></li>
								</ul>
								<ul class="find_cater_aeach">
									<p class="find_cater_label">柜</p>
									<li><a href="/webd/search/goods?keyword=电视柜">电视柜</a></li>
									<li><a href="/webd/search/goods?keyword=衣柜">衣柜</a></li>
									<li><a href="/webd/search/goods?keyword=书柜">书柜</a></li>
									<li><a href="/webd/search/goods?keyword=床头柜">床头柜</a></li>
									<li><a href="/webd/search/goods?keyword=浴室柜">浴室柜</a></li>
									<li><a href="/webd/search/goods?keyword=酒柜">酒柜</a></li>
									<li><a href="/webd/search/goods?keyword=玄关柜">玄关柜</a></li>
									<li><a href="/webd/search/goods?keyword=五斗柜">五斗柜</a></li>
									<li><a href="/webd/search/goods?keyword=橱柜">橱柜</a></li>
									<li><a href="/webd/search/goods?keyword=餐边柜">餐边柜</a></li>
									<li><a href="/webd/search/goods?keyword=餐具柜">餐具柜</a></li>
									<li><a href="/webd/search/goods?keyword=食品柜">食品柜</a></li>
									<li><a href="/webd/search/goods?keyword=文件柜">文件柜</a></li>
									<li><a href="/webd/search/goods?keyword=组合柜">组合柜</a></li>
									<li><a href="/webd/search/goods?keyword=吧柜">吧柜</a></li>

									
								</ul>
								<ul class="find_cater_aeach">
									<p class="find_cater_label">架子</p>
									<li><a href="/webd/search/goods?keyword=书架">书架</a></li>
									<li><a href="/webd/search/goods?keyword=鞋架">鞋架</a></li>
									<li><a href="/webd/search/goods?keyword=衣帽架">衣帽架</a></li>
									<li><a href="/webd/search/goods?keyword=花架">花架</a></li>
									<li><a href="/webd/search/goods?keyword=伞架">伞架</a></li>
									<li><a href="/webd/search/goods?keyword=博古架">博古架</a></li>
									<li><a href="/webd/search/goods?keyword=格架">格架</a></li>
									
								</ul>
								<ul class="find_cater_aeach mrightzero">
									<p class="find_cater_label">其他</p>
									<li><a href="/webd/search/goods?keyword=隔断">隔断</a></li>
									<li><a href="/webd/search/goods?keyword=窗帘">窗帘</a></li>
									<li><a href="/webd/search/goods?keyword=淋浴">淋浴</a></li>
									<li><a href="/webd/search/goods?keyword=浴缸">浴缸</a></li>
									
								</ul>
						
							</div>
						</ul>
						
						<ul class="find_cater_aeach nolog_index_cateachcolor">
			              <p class="find_cater_label">色系</p>
			                <li><a href="/webd/search/goods?keyword=红色" target="_blank" class="nolog_index_cr" title="红色"></a></li>
			                <li><a href="/webd/search/goods?keyword=橙色" target="_blank" class="nolog_index_co" title="橙色"></a></li>
			                <li><a href="/webd/search/goods?keyword=黄色" target="_blank" class="nolog_index_cy" title="黄色"></a></li>
			                <li><a href="/webd/search/goods?keyword=绿色" target="_blank" class="nolog_index_cg" title="绿色"></a></li>
			                <li><a href="/webd/search/goods?keyword=青色" target="_blank" class="nolog_index_cq" title="青色"></a></li>
			                <li><a href="/webd/search/goods?keyword=蓝色" target="_blank" class="nolog_index_cl" title="蓝色"></a></li>
			                <li><a href="/webd/search/goods?keyword=紫色" target="_blank" class="nolog_index_cp" title="紫色"></a></li>
			                <li><a href="/webd/search/goods?keyword=黑色" target="_blank" class="nolog_index_cb" title="黑色"></a></li>
			                <li><a href="/webd/search/goods?keyword=白色" target="_blank" class="nolog_index_cw" title="白色"></a></li>
			                <li><a href="/webd/search/goods?keyword=灰色" target="_blank" class="nolog_index_cc" title="灰色"></a></li>
			            </ul>
						
						<ul class="find_cater_aeach">
							<p class="find_cater_label">装饰摆设</p>
							<li><a href="/webd/search/goods?keyword=摆件" target="_blank">摆件</a></li>
							<li><a href="/webd/search/goods?keyword=镜子" target="_blank">镜子</a></li>
							<li><a href="/webd/search/goods?keyword=钟" target="_blank">钟</a></li>
							<li><a href="/webd/search/goods?keyword=装置画" target="_blank">装置画</a></li>
							<li><a href="/webd/search/goods?keyword=香薰" target="_blank">香薰</a></li>
							<li><a href="/webd/search/goods?keyword=挂钩" target="_blank">挂钩</a></li>
							<li><a href="/webd/search/goods?keyword=收纳" target="_blank">收纳</a></li>
							<li><a href="/webd/search/goods?keyword=相框" target="_blank">相框</a></li>
							<li><a href="/webd/search/goods?keyword=其他" target="_blank">其他</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero">
							<p class="find_cater_label">灯饰</p>
							<li><a href="/webd/search/goods?keyword=台灯" target="_blank">台灯</a></li>
							<li><a href="/webd/search/goods?keyword=吊灯" target="_blank">吊灯</a></li>
							<li><a href="/webd/search/goods?keyword=壁灯" target="_blank">壁灯</a></li>
							<li><a href="/webd/search/goods?keyword=户外灯" target="_blank">户外灯</a></li>
							<li><a href="/webd/search/goods?keyword=镜前灯" target="_blank">镜前灯</a></li>
							<li><a href="/webd/search/goods?keyword=吸顶灯" target="_blank">吸顶灯</a></li>
							<li><a href="/webd/search/goods?keyword=创意灯" target="_blank">创意灯</a></li>
							<li><a href="/webd/search/goods?keyword=落地灯" target="_blank">落地灯</a></li>
							<li><a href="/webd/search/goods?keyword=厨卫灯" target="_blank">厨卫灯</a></li>
							<li><a href="/webd/search/goods?keyword=水晶灯" target="_blank">水晶灯</a></li>
							<li><a href="/webd/search/goods?keyword=铜灯" target="_blank">铜灯</a></li>
							<li><a href="/webd/search/goods?keyword=阳台灯" target="_blank">阳台灯</a></li>
						</ul>
						
					</div>
					<div class="find_cater_aeach_wrap">
						<ul class="find_cater_aeach ">
							<p class="find_cater_label">家纺家饰</p>
							<li><a href="/webd/search/goods?keyword=床品" target="_blank">床品</a></li>
							<li><a href="/webd/search/goods?keyword=抱枕" target="_blank">抱枕</a></li>
							<li><a href="/webd/search/goods?keyword=布料" target="_blank">布料</a></li>
							<li><a href="/webd/search/goods?keyword=窗帘" target="_blank">窗帘</a></li>
							<li><a href="/webd/search/goods?keyword=坐垫" target="_blank">坐垫</a></li>
							<li><a href="/webd/search/goods?keyword=桌布" target="_blank">桌布</a></li>
							<li><a href="/webd/search/goods?keyword=枕头" target="_blank">枕头</a></li>
							<li><a href="/webd/search/goods?keyword=桌旗" target="_blank">桌旗</a></li>
							<li><a href="/webd/search/goods?keyword=靠垫" target="_blank">靠垫</a></li>
							<li><a href="/webd/search/goods?keyword=地毯" target="_blank">地毯</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">卫生间</p>
							<li><a href="/webd/search/goods?keyword=浴帘" target="_blank">浴帘</a></li>
							<li><a href="/webd/search/goods?keyword=浴巾" target="_blank">浴巾</a></li>
							<li><a href="/webd/search/goods?keyword=衣架" target="_blank">衣架</a></li>
							<li><a href="/webd/search/goods?keyword=洗漱套瓶" target="_blank">传世</a></li>
							<li><a href="/webd/search/goods?keyword=杯子" target="_blank">美克美家</a></li>
							<li><a href="/webd/search/goods?keyword=马桶垫" target="_blank">第展</a></li>
							<li><a href="/webd/search/goods?keyword=防滑垫" target="_blank">希尔巴赫</a></li>
							<li><a href="/webd/search/goods?keyword=毛巾架" target="_blank">梁志天</a></li>
							<li><a href="/webd/search/goods?keyword=毛巾环" target="_blank">毛巾环</a></li>
						</ul>
						<ul class="find_cater_aeach">
							<p class="find_cater_label">花艺植物</p>
							<li><a href="/webd/search/goods?keyword=多肉植物" target="_blank">多肉植物</a></li>
							<li><a href="/webd/search/goods?keyword=花瓶" target="_blank">花瓶</a></li>
							<li><a href="/webd/search/goods?keyword=花盆" target="_blank">花盆</a></li>
							<li><a href="/webd/search/goods?keyword=仿真花" target="_blank">仿真花</a></li>
							<li><a href="/webd/search/goods?keyword=鲜花" target="_blank">鲜花</a></li>
							<li><a href="/webd/search/goods?keyword=干花" target="_blank">干花</a></li>
							<li><a href="/webd/search/goods?keyword=水景" target="_blank">水景</a></li>
							<li><a href="/webd/search/goods?keyword=野兽派" target="_blank">野兽派</a></li>
							<li><a href="/webd/search/goods?keyword=RoseOnly" target="_blank">RoseOnly</a></li>
						</ul>
						<ul class="find_cater_aeach mrightzero">
							<p class="find_cater_label">厨房用品</p>
							<li><a href="/webd/search/goods?keyword=餐具" target="_blank">餐具</a></li>
							<li><a href="/webd/search/goods?keyword=盘子" target="_blank">盘子</a></li>
							<li><a href="/webd/search/goods?keyword=杯子" target="_blank">杯子</a></li>
							<li><a href="/webd/search/goods?keyword=勺子" target="_blank">勺子</a></li>
							<li><a href="/webd/search/goods?keyword=刀叉" target="_blank">刀叉</a></li>
							<li><a href="/webd/search/goods?keyword=碟子" target="_blank">碟子</a></li>
							<li><a href="/webd/search/goods?keyword=碗架" target="_blank">碗架</a></li>
							
						</ul>
						
					</div>
				</div>
			</div>
			<p class="find_title">堆图达人</p>
			<div class="clearfix">
				<ul class="find_fold_list clearfix">
				<?php foreach($user as $k=>$v): ?>
					<li class="find_user_li <?php if($k==4) echo 'mrightzero'?>" user_id="{{$v['id']}}">
						<div class="find_user_info">
							<a href="/webd/user?oid={{$v['id']}}" target="_blank" class="find_user_name" title="{{!empty($v['nick'])?$v['nick']:$v['username']}}">{{!empty($v['nick'])?$v['nick']:$v['username']}}</a>
							<a  class="find_user_rela">{{$v['fans_count']}}粉丝 {{$v['follow_count']}}关注</a>
						</div>
						<div class="find_user_con clearfix">
							<div class="find_user_img">
								<div class="find_user_blur"></div>
								<a href="/webd/user?oid={{$v['id']}}" class="position" target="_blank" title="{{!empty($v['nick'])?$v['nick']:$v['username']}}"><img src="{{!empty($v['auth_avatar'])?$v['auth_avatar']:$v['pic_m']}}" alt="{{!empty($v['nick'])?$v['nick']:$v['username']}}"></a>
							</div>
							<ul class="find_user_limg">
								<li>
									<div class="find_user_blur"></div>
									<a href="/webd/folder?fid={{$v['folders'][0]['id']}}" title="{{$v['folders'][0]['name']}}" class="position" target="_blank"><img src="{{$v['folders'][0]['img_url']}}" alt="{{$v['folders'][0]['name']}}"></a>
								</li>
								<li>
									<div class="find_user_blur"></div>
									<a href="/webd/folder?fid={{$v['folders'][1]['id']}}" title="{{$v['folders'][1]['name']}}" class="position" target="_blank"><img src="{{$v['folders'][1]['img_url']}}" alt="{{$v['folders'][1]['name']}}"></a>
								</li>
								<li>
									<div class="find_user_blur"></div>
									<a href="/webd/folder?fid={{$v['folders'][2]['id']}}" title="{{$v['folders'][2]['name']}}" class="position" target="_blank"><img src="{{$v['folders'][2]['img_url']}}" alt="{{$v['folders'][2]['name']}}"></a>
								</li>
								<li>
									<div class="find_user_blur"></div>
									<a href="/webd/folder?fid={{$v['folders'][3]['id']}}" title="{{$v['folders'][3]['name']}}" class="position" target="_blank"><img src="{{$v['folders'][3]['img_url']}}" alt="{{$v['folders'][3]['name']}}"></a>
								</li>
							</ul>
							<a href="javascript:;" class="find_user_authflw" onclick="relation(this)" <?php if($self_id==$v['id']): ?>style="display: none"<?php endif; ?>>
								<?php 
								switch ($v['relation']) {
									case '1':
										echo '相互关注';
										break;
									case '2':
										echo '已关注';
										break;
									case '4':
										echo '<span>+</span>关注';
										break;
									default:
										echo '<span>+</span>关注';
										break;
								} ?>
							</a>
						</div>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<p class="find_title">精品文件夹</p>
			<div class="clearfix">
				<ul class="find_fold_list clearfix">
				<?php foreach ($recommend as $k => $v){ ?>
					<li class="find_fold_li <?php if($k==4) echo 'mrightzero'; ?>" folder_id="{{$v['id']}}">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="/webd/user?oid={{$v['user']['id']}}" target="_blank" title="{{!empty(trim($v['user']['nick']))?$v['user']['nick']:$v['user']['username']}}"><img src="{{$v['user']['image']}}" alt="{{!empty(trim($v['user']['nick']))?$v['user']['nick']:$v['user']['username']}}"></a>
							</div>
							<div class="find_fold_tname">
								<a href="/webd/folder?fid={{$v['id']}}" target="_blank" class="find_fold_name" title="{{$v['name']}}">{{$v['name']}}</a>
								<a href="/webd/user?oid={{$v['user']['id']}}" target="_blank" class="find_fold_authnme" title="{{!empty(trim($v['user']['nick']))?$v['user']['nick']:$v['user']['username']}}">{{!empty(trim($v['user']['nick']))?$v['user']['nick']:$v['user']['username']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<a href="/webd/folder?fid={{$v['id']}}" target="_blank" class="position" title="{{$v['name']}}"><img src="{{$v['img_url']}}" alt="{{$v['name']}}" onload="rect(this)"></a>
							<div class="find_fold_catflw">{{$v['count']['folder_count']}}文件&nbsp;&nbsp;{{$v['count']['fans_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="/webd/pic/{{$v['goods'][0]['id']}}" target="_blank" class="position" title="{{!empty(trim($v['goods'][0]['title']))?$v['goods'][0]['title']:$v['goods'][0]['description']}}"><img src="{{$v['goods'][0]['images'][0]['img_m']}}" alt="{{!empty(trim($v['goods'][0]['title']))?$v['goods'][0]['title']:$v['goods'][0]['description']}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="/webd/pic/{{$v['goods'][1]['id']}}" target="_blank" class="position" title="{{!empty(trim($v['goods'][1]['title']))?$v['goods'][1]['title']:$v['goods'][1]['description']}}"><img src="{{$v['goods'][1]['images'][0]['img_m']}}" alt="{{!empty(trim($v['goods'][1]['title']))?$v['goods'][1]['title']:$v['goods'][1]['description']}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="/webd/pic/{{$v['goods'][2]['id']}}" target="_blank" class="position" title="{{!empty(trim($v['goods'][2]['title']))?$v['goods'][2]['title']:$v['goods'][2]['description']}}"><img src="{{$v['goods'][2]['images'][0]['img_m']}}" alt="{{!empty(trim($v['goods'][2]['title']))?$v['goods'][2]['title']:$v['goods'][2]['description']}}"></a>
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw" onclick="relation(this)" <?php if($v['user_id'] == $self_id) echo "style='display:none'" ?>>
						<?php 
						if($v['user_id'] != $self_id){
							echo $v['is_collection']?"已关注":"<span>+</span>特别关注";
						}
						?>
						</a>
					</li>
				<?php } ?>
				</ul>
			</div>
			<!-- <p class="find_title">人气商品</p> -->
		<!-- <div  id="main" role='main' style="position: relative;">
			<div class="index_con" id='tiles'>
			<?php foreach ($goods as $k => $v): ?>
				<div class="index_item">
					<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap" href="{{url('webd/pic/')}}/{{$v['id']}}" target="_blank"></a>
							<img src="{{$v['image_url'] or url('uploads/sundry/blogo.jpg')}}">
							<div class="index_item_price">{{$v['price']}}</div>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{$v['description']}}">{{$v['description']}}</div>
								<div class="index_item_rel clearfix" good_id="{{$v['id']}}">
									<a class="index_item_l" onclick="praise(this,1)">{{$v['praise_count']}}</a>
									<a class="index_item_c" onclick="collect(this)">{{$v['collection_count']}}</a>
									<a href="{{$v['detail_url']}}" class="index_item_b" target="_blank"></a>
								</div>
							</div>
							<div class="index_item_bottom clearfix">
								<a href="/webd/user?oid={{$v['cuser']['id']}}" class="index_item_authava" target="_blank">
									<img src="{{!empty($v['cuser']['auth_avatar'])?$v['cuser']['auth_avatar']:$v['cuser']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo">
									<a href="/webd/user?oid={{$v['cuser']['id']}}" target="_blank" class="index_item_authname">{{!empty($v['cuser']['nick'])?$v['cuser']['nick']:$v['cuser']['username']}}</a>
									<span class="index_item_authto">采集到</span>
									<p class="index_item_authtopart"><a href="/webd/folder?fid={{$v['cfolder']['id']}}" target="_blank">{{$v['cfolder']['name']}}</a></p>
								</div>
							</div>
							<?php if(!empty($v['comment'])){ ?>
							<div class="index_item_bottom clearfix">
								<a href="/webd/user?oid={{$v['comment'][$v['id']]['user']['id']}}" class="index_item_authava" target="_blank">
									<img src="{{!empty($v['comment'][$v['id']]['user']['auth_avatar'])?$v['comment'][$v['id']]['user']['auth_avatar']:$v['comment'][$v['id']]['user']['pic_m']}}" alt="">
								</a>
								<div class="index_item_authinfo index_item_authtalk">
									<a href="" class="index_item_talkname" target="_blank">{{!empty($v['comment'][$v['id']]['user']['nick'])?$v['comment'][$v['id']]['user']['nick']:$v['comment'][$v['id']]['user']['username']}}：</a>
									<span class="index_item_authto">{{$v['comment'][$v['id']]['content']}}</span>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div> -->
	</div>
	</div>
	<!-- <a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a> -->
</body>
<script type="text/javascript">
	postUrl = "{{url('webd/find/goods')}}"
	postData = {'num':15}
</script>
<!-- <script src="{{url('web/js/find.js')}}"></script> -->
<script type="text/javascript">
		$(function() {
		    
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

		    //展开分类
		    $('.h-more').click(function(){
		    		$(this).parent().siblings('.find_cater_aeach_wrap').show('1');
		    })
		     $('.h-less').click(function(){
		    	$(this).parent().parent().parent('.find_cater_aeach_wrap').hide();
		    })
		});
	</script>
</html>