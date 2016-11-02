<!DOCTYPE html>
<html lang="en">
@include('web.common.cq.head')
<body>
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web')}}/js/cq/function.js"></script>
	<script type="text/javascript">
	var cdata = {'page':1,'num':10}
	var nodata = '<div style="font-size: 18px;margin: 20px 100px;">暂无数据</div>'
	// 公共请求ajax
	function seajax(cdata,v){
		cdata.keyword = v
		$.ajax({
			'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/cq/search",
			'type':'post',
			'data':cdata,
			'dataType':'json',
			'success':function(json){
				if(json.code==200 && json.data!=0 && json.data!=null){
		  			var str = ''
		  			var list  = json.data
		  			$.each(list,function(index,v){
					   str +=  '<div class="index_item" img_id="'+v.id+'">\
							<div class="index_item_wrap">\
								<div class="index_item_imgwrap clearfix">\
									<a class="index_item_blurwrap" href="/webd/cqpic/'+v.id+'" target="_blank" title="'+v.title+'"></a>\
									<img src="'+v.images[0].img_m+'" style="height: '+v.images[0].rh+'px" onload="resize_xy(this)" alt="'+v.title+'">\
									<div class="index_item_price"><strong>'+v.reserve_price+'</strong><b>'+v.price+'</b></div>\
								</div>\
								<div class="index_item_info">\
									<div class="index_item_top">\
										<div class="index_item_intro" title="'+v.title+'">'+v.title+'</div>\
										<div class="vr_title">\
												<span class="vr_home_loc">'+v.cityname+' '+v.countryname+'</span>\
												<span class="vr_home_ll">'+v.views+'浏览</span>\
												<span class="vr_home_fb">'+v.min+'发表</span>\
										</div>\
										<div class="index_item_rel clearfix" good_id="'+v.id+'">\
											<a href="javascript:;" class="index_item_like" onclick="cq_good_col(this)">'+v.praise_count+'</a>\
											<a href="javascript:;" class="index_item_c" onclick="cq_good_like(this)">'+v.collection_count+'</a>\
											<a href="javascript:;" target="_blank" onclick="cq_good_edit(this)" class="index_item_edit"></a>\
										</div>\
									</div>\
								</div>\
							</div>\
						</div>'
		  			})
		  			$('#tiles').html(str)
		  			applyLayout();
		  			$('.w1248 .o2').show();
		  			f = 1
		  		}else{
		  			$('#tiles').html(nodata)
		  			f = 0
		  			$('#load').hide()
		  		}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
		})
	}
	// 提交搜索
	function search_action(obj){
		var v = $(obj).find('input').val()
		seajax(cdata,v)
		$('.w1248 .search-option a').removeClass('red')
		postUrl = '/webd/cq/search'
		postData.user_id = 0
		postData.keyword = v
		$page = 1
		return false
	}
	var tags = [
    {"name":"三人沙发","pid":1},{"name":"双人沙发","pid":1},{"name":"单人沙发","pid":1},{"name":"沙发床","pid":1},{"name":"布艺沙发","pid":1},{"name":"皮质沙发","pid":1},{"name":"古典沙发","pid":1},{"name":"现代沙发","pid":1},{"name":"美式沙发","pid":1},{"name":"东南亚沙发","pid":1},{"name":"简欧沙发","pid":1},{"name":"日式沙发","pid":1},
    {"name":"餐桌","pid":2},{"name":"书桌","pid":2},{"name":"茶几","pid":2},{"name":"办公桌","pid":2},{"name":"梳妆台","pid":2},{"name":"吧台","pid":2},{"name":"会议桌","pid":2},{"name":"沙发桌","pid":2},{"name":"咖啡桌","pid":2},
    {"name":"双人床","pid":3},{"name":"儿童床","pid":3},{"name":"单人床","pid":3},{"name":"实木床","pid":3},{"name":"板式床","pid":3},{"name":"铁艺床","pid":3},{"name":"水床","pid":3},{"name":"吊床","pid":3},{"name":"榻榻米床","pid":3},{"name":"欧式床","pid":3},{"name":"折叠床","pid":3},{"name":"美式床","pid":3},{"name":"地中海床","pid":3},{"name":"高低床","pid":3},
    {"name":"电视柜","pid":4},{"name":"衣柜","pid":4},{"name":"书柜","pid":4},{"name":"床头柜","pid":4},{"name":"浴室柜","pid":4},{"name":"酒柜","pid":4},{"name":"玄关柜","pid":4},{"name":"五斗柜","pid":4},{"name":"厨柜","pid":4},{"name":"餐边柜","pid":4},{"name":"餐具柜","pid":4},{"name":"食品柜","pid":4},{"name":"文件柜","pid":4},{"name":"组合柜","pid":4},{"name":"吧柜","pid":4},
    {"name":"书架","pid":5},{"name":"鞋架","pid":5},{"name":"衣帽架","pid":5},{"name":"花架","pid":5},{"name":"伞架","pid":5},{"name":"博古架","pid":5},{"name":"格架","pid":5},
    {"name":"摆件","pid":6},{"name":"镜子","pid":6},{"name":"钟","pid":6},{"name":"装置画","pid":6},{"name":"香薰","pid":6},{"name":"挂钩","pid":6},{"name":"收纳","pid":6},{"name":"相框","pid":6},
    {"name":"台灯","pid":7},{"name":"吊灯","pid":7},{"name":"壁灯","pid":7},{"name":"户外灯","pid":7},{"name":"镜前灯","pid":7},{"name":"吸顶灯","pid":7},{"name":"创意","pid":7},{"name":"落地灯","pid":7},{"name":"厨卫灯","pid":7},{"name":"水晶灯","pid":7},{"name":"铜灯","pid":7},
    {"name":"阳台灯","pid":7},
    {"name":"床品","pid":8},{"name":"抱枕","pid":8},{"name":"布料","pid":8},{"name":"窗帘","pid":8},{"name":"坐垫","pid":8},{"name":"桌布","pid":8},{"name":"枕头","pid":8},{"name":"桌旗","pid":8},{"name":"靠垫","pid":8},{"name":"地毯","pid":8},
    {"name":"浴帘","pid":9},{"name":"浴巾","pid":9},{"name":"衣架","pid":9},{"name":"洗漱套瓶","pid":9},{"name":"杯子","pid":9},{"name":"马桶垫","pid":9},{"name":"防滑垫","pid":9},{"name":"毛巾架","pid":9},{"name":"毛巾环","pid":9},
    {"name":"多肉植物","pid":10},{"name":"花瓶","pid":10},{"name":"花盆","pid":10},{"name":"仿真花","pid":10},{"name":"鲜花","pid":10},{"name":"干花","pid":10},{"name":"水景","pid":10},{"name":"野兽派","pid":10},{"name":"RoseOnly","pid":10},
    {"name":"餐具","pid":11},{"name":"盘子","pid":11},{"name":"杯子","pid":11},{"name":"勺子","pid":11},{"name":"刀叉","pid":11},{"name":"碟子","pid":11},{"name":"碗架","pid":11},
    {"name":"隔断","pid":12},{"name":"窗帘","pid":12},{"name":"沐浴","pid":12},{"name":"浴缸","pid":12}
    ];
	// 分类搜索
	function search_cate(obj){
		var v = $('#cq_search_word input[name=keyword]').val()
		var value = $(obj).attr('value')
		var html = $(obj).html()
		var si = ''

		if(value!=0){
			$.each(tags,function(i,v){
		        if(v.pid==value){
		          si+= '<li><a href="javascript:;" onclick="search_lcate(this)">'+v.name+'</a></li>'
		        }
		    })
		    $('#lcate').html(si)
		}else{
			 html = ''
			 $('#lcate').html(html)
		}
		cdata.tags = html
		seajax(cdata,v)
		postUrl = '/webd/cq/search'
		postData.user_id = 0
		postData.tags = html
		$page = 1
		return false
	}

	// 小分类搜索
	function search_lcate(obj){
		var v = $('#cq_search_word input[name=keyword]').val()
		$('#lcate a').removeClass('red')
		$(obj).addClass('red')
		var html = $(obj).html()
		cdata.tags = html
		seajax(cdata,v)
		postUrl = '/webd/cq/search'
		postData.user_id = 0
		postData.tags = html
		$page = 1
		return false
	}

	// 价格搜索
	function search_price(obj){
		var v = $('#cq_search_word input[name=keyword]').val()
		var price1 = $(obj).attr('price1')
		var price2 = $(obj).attr('price2')
		cdata.price1 = price1
		cdata.price2 = price2
		seajax(cdata,v)
		postUrl = '/webd/cq/search'
		postData.user_id = 0
		postData.price1 = price1
		postData.price2 = price2
		$page = 1
		return false
	}

	// 来源搜索
	function search_source(obj){
		var v = $('#cq_search_word input[name=keyword]').val()
		var dv = $(obj).attr('data-v')
		cdata.source = dv
		seajax(cdata,v)
		postUrl = '/webd/cq/search'
		postData.user_id = 0
		postData.source = dv
		$page = 1
		return false
	}
	</script>
	<div class="container nolog_container"  style="background: #fff; padding-top: 15px;">
		<div class="nolog_index_banner" style="background: url({{ asset('/static/web/images/vr')}}/cq_banner.png) top center no-repeat">
	      <div class="w1248 clearfix nolog_index_top">
	        <p class="nolog_index_title">出清商品——闲置二手家居展示</p>
	        <div class="header_search_wrap clearfix">
	          <form action="" method="get" onsubmit="return search_action(this)" id="cq_search_word">
	            <input type="text" name="keyword" class="header_search header_search_indexnolog" placeholder="搜索你想看的">
	          </form>
	        </div>
	        <p class="nolog_index_subtit">搜索——闲置家居动起来</p>
	      </div>
	    </div>
	    <style type="text/css">
			.w1248 .search-option a{ font-size: 14px;color: #999;display: inline-block;width: 100px;text-align: center; }
			.w1248 .search-option a.red{color: #f00}
			.w1248 .o2{display: none}
			.w1248 .o2{ line-height: 2em }
			.w1248 .o2 a{ width: auto; }
			#main .index_item_price strong{ color: #f00; font-size: 18px;padding: 10px }
			#main .index_item_price b{ text-decoration: line-through; }
			.index_item_price{ width: 100% }
	    </style>
		<div class="w1248 w1240" style="padding-bottom: 20px">
		    <div class="search-option clearfix">
				<a href="/webd/cq" class="red">最新</a>
				<?php if(!empty($self_id)): ?>
					<a href="javascript:;" id="mypub">我的发布</a>
					<a href="javascript:;" id="mycol">我的收藏</a>
				<?php endif; ?>
				<a href="javascript:;" class="popd">发布</a>
				
			</div>
			<div class="search-option o2 clearfix" style="margin-top: 20px">
				<span>类&nbsp;&nbsp;&nbsp;&nbsp;别:</span>
				<ul id="ocate">
					<li><a href="javascript:;" class="red" onclick="search_cate(this)" value="0">全部</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="1">沙发</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="2">桌</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="3">床</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="4">柜</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="5">架子</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="6">装饰摆设</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="7">灯饰</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="8">家纺家饰</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="9">卫生间</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="10">花艺植物</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="11">厨房用品</a></li>
					<li><a href="javascript:;" onclick="search_cate(this)" value="12">其他</a></li>
				</ul>
			</div>
			<div class="search-option o2 clearfix">
				<span>小&nbsp;&nbsp;&nbsp;&nbsp;类:</span>
				<ul>
					<div id="lcate">
						
					</div>
				</ul>
			</div>
			<div class="search-option o2 clearfix">
				<span>价&nbsp;&nbsp;&nbsp;&nbsp;格:</span>
				<ul>
					<li><a href="javascript:;" class="red" onclick="search_price(this)" price1="0" price2="0">全部</a></li>
					<li><a href="javascript:;" onclick="search_price(this)" price1="50" price2="0">50元以下</a></li>
					<li><a href="javascript:;" onclick="search_price(this)" price1="50" price2="100">50-100元</a></li>
					<li><a href="javascript:;" onclick="search_price(this)" price1="100" price2="200">100-200元</a></li>
					<li><a href="javascript:;" onclick="search_price(this)" price1="200" price2="300">200-300元</a></li>
					<li><a href="javascript:;" onclick="search_price(this)" price1="300" price2="500">300-500元</a></li>
					<li><a href="javascript:;" onclick="search_price(this)" price1="500" price2="1000">500-1000元</a></li>
					<li><a href="javascript:;" onclick="search_price(this)" price1="1000" price2="2000">1000-2000元</a></li>
				</ul>
			</div>
			<div class="search-option o2 clearfix">
				<span>区&nbsp;&nbsp;&nbsp;&nbsp;域:</span>
				<div id="distpicker_search">
			        <div class="form-group">
			          <label class="sr-only" for="province_search">Province</label>
			          <select class="form-control form-se-search"  id="province_search"></select>
			        </div>
			        <div class="form-group">
			          <label class="sr-only" for="city_search">City</label>
			          <select class="form-control form-se-search"  id="city_search"></select>
			        </div>
			        <div class="form-group">
			          <label class="sr-only" for="district_search">District</label>
			          <select class="form-control form-se-search"  id="district_search"></select>
			        </div>
			        <input type="hidden" name="cityid" value="0"></input>
			     </div>
			     <script type="text/javascript">
					$("#distpicker_search").distpicker({
					  province: "---- 省 ----",
					  city: "---- 市 ----",
					  district: "---- 区县 ----",
					  autoSelect: false
					});

					$('.form-se-search').change(function(){
						var s1 = $('.form-se-search').eq(0).find('option:selected').attr('data-code')
						var s2 = $('.form-se-search').eq(1).find('option:selected').attr('data-code')
						var s3 = $('.form-se-search').eq(2).find('option:selected').attr('data-code')
						if(s1!='' && s2==''){
							cdata.cityid = s1
						}
						if(s1!='' && s2!='' && s3==''){
							cdata.cityid = s2
						}
						if(s1!='' && s2!='' && s3!=''){
							cdata.cityid = s3
						}
						if(s1=='' && s2=='' && s3==''){
							cdata.cityid = 0 
						}
						var v = $('#cq_search_word input[name=keyword]').val()
						seajax(cdata,v)
						postUrl = '/webd/cq/search'
						postData.user_id = 0
						$page = 1
						return false

					})
				</script>		
			</div>
			<div class="search-option o2 clearfix" style="margin-bottom: 20px">
				<span>来&nbsp;&nbsp;&nbsp;&nbsp;源:</span>
				<ul>
					<li><a href="javascript:;" class="red" onclick="search_source(this)" data-v="0">不限</a></li>
					<li><a href="javascript:;" onclick="search_source(this)" data-v="1">个人</a></li>
					<li><a href="javascript:;" onclick="search_source(this)" data-v="2">商家</a></li>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			$('.o2 a').click(function(){
				$(this).parents('.o2').find("a").removeClass('red')
				$(this).addClass('red')
			})
		</script>
		<div id="main" role="main" class="w1248 clearfix">
			<div class="index_con" id="tiles">
			<?php foreach ($goods as $key => $v):?>
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
									<a href="javascript:;" class="index_item_like" onclick="cq_good_col(this)">{{$v['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c" onclick="cq_good_like(this)">{{$v['collection_count']}}</a>
									<a href="/webd/pic/{{$v['id']}}" target="_blank" class="index_item_chat"></a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			<?php endforeach; ?>

			   </div>
			</div>
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>
<script type="text/javascript">
  var $tiles = $('#tiles')
  $handler = $('.index_item', $tiles)
  $main = $('#main')
  $window = $(window)
  $document = $(document)
  $page = 1
  var f = 1
  options = {
    autoResize: true, // This will auto-update the layout when the browser window is resized.
    container: $main, // Optional, used for some extra CSS styling
    offset: 15, // Optional, the distance between grid items
    itemWidth:236 // Optional, the width of a grid item
  };
  /**
   * Reinitializes the wookmark handler after all images have loaded
   */
  function applyLayout() {
    //$tiles.imagesLoaded(function() {
      // Destroy the old handler
      if ($handler.wookmarkInstance) {
        $handler.wookmarkInstance.clear();
      }

      // Create a new layout handler.
      $handler = $('.index_item', $tiles);
      $handler.wookmark(options);
      //$handler.find('.index_item_imgwrap img').css('visibility','visible')
    //});
  }
</script>
<script type="text/javascript">
	postUrl = "{{url('webd/cq/goods')}}"
	postData = {'num':10}
</script>

<script type="text/javascript">
	$('#mypub').click(function(){
		$.ajax({
			'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/cq/goods",
			'type':'post',
			'data':{
				'user_id':u_id,
				'page':1,
				'num':10
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200 && json.data!=0 && json.data!=null){
		  			var str = ''
		  			var list  = json.data
		  			$.each(list,function(index,v){
					   str +=  '<div class="index_item" img_id="'+v.id+'">\
							<div class="index_item_wrap">\
								<div class="index_item_imgwrap clearfix">\
									<a class="index_item_blurwrap" href="/webd/cqpic/'+v.id+'" target="_blank" title="'+v.title+'"></a>\
									<img src="'+v.images[0].img_m+'" style="height: '+v.images[0].rh+'px" onload="resize_xy(this)" alt="'+v.title+'">\
									<div class="index_item_price"><strong>'+v.reserve_price+'</strong><b>'+v.price+'</b></div>\
								</div>\
								<div class="index_item_info">\
									<div class="index_item_top">\
										<div class="index_item_intro" title="'+v.title+'">'+v.title+'</div>\
										<div class="vr_title">\
												<span class="vr_home_loc">'+v.cityname+' '+v.countryname+'</span>\
												<span class="vr_home_ll">'+v.views+'浏览</span>\
												<span class="vr_home_fb">'+v.min+'发表</span>\
										</div>\
										<div class="index_item_rel clearfix" good_id="'+v.id+'">\
											<a href="javascript:;" class="index_item_like" onclick="cq_good_col(this)">'+v.praise_count+'</a>\
											<a href="javascript:;" class="index_item_c" onclick="cq_good_like(this)">'+v.collection_count+'</a>\
											<a href="javascript:;" target="_blank" onclick="cq_good_edit(this)" class="index_item_edit"></a>\
										</div>\
									</div>\
								</div>\
							</div>\
						</div>'
		  			})
		  			$('#tiles').html(str)
		  			applyLayout();
		  			f = 1
		  		}else{
		  			$('#tiles').html(nodata)
		  			f = 0
		  			$('#load').hide()
		  		}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
		})
		
		$('.w1248 .search-option a').removeClass('red')
		$('#mypub').addClass('red')
		postUrl = '/webd/cq/goods'
		postData.user_id = u_id
		$page = 1
		cdata = {'page':1,'num':10}
		$('.w1248 .o2').hide();
	})

	$('#mycol').click(function(){

		$.ajax({
			'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/cq/mycol",
			'type':'post',
			'data':{
				'user_id':u_id,
				'page':1,
				'num':10
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200 && json.data!=0 && json.data!=null){
		  			var str = ''
		  			var list  = json.data
		  			$.each(list,function(index,v){
					   str +=  '<div class="index_item" img_id="'+v.id+'">\
							<div class="index_item_wrap">\
								<div class="index_item_imgwrap clearfix">\
									<a class="index_item_blurwrap" href="/webd/cqpic/'+v.id+'" target="_blank" title="'+v.title+'"></a>\
									<img src="'+v.images[0].img_m+'" style="height: '+v.images[0].rh+'px" onload="resize_xy(this)" alt="'+v.title+'">\
									<div class="index_item_price"><strong>'+v.reserve_price+'</strong><b>'+v.price+'</b></div>\
								</div>\
								<div class="index_item_info">\
									<div class="index_item_top">\
										<div class="index_item_intro" title="'+v.title+'">'+v.title+'</div>\
										<div class="vr_title">\
												<span class="vr_home_loc">'+v.cityname+' '+v.countryname+'</span>\
												<span class="vr_home_ll">'+v.views+'浏览</span>\
												<span class="vr_home_fb">'+v.min+'发表</span>\
										</div>\
										<div class="index_item_rel clearfix" good_id="'+v.id+'">\
											<a href="javascript:;" class="index_item_like" onclick="cq_good_col(this)">'+v.praise_count+'</a>\
											<a href="javascript:;" class="index_item_c" onclick="cq_good_like(this)">'+v.collection_count+'</a>\
											<a href="/webd/pic/'+v.id+'" target="_blank" class="index_item_chat"></a>\
										</div>\
									</div>\
								</div>\
							</div>\
						</div>'
					   
		  			})
		  			$('#tiles').html(str)
		  			applyLayout();
		  			f = 1
		  		}else{
		  			$('#tiles').html(nodata)
		  			f = 0
		  			$('#load').hide()
		  		}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
		})
		
		$('.w1248 .search-option a').removeClass('red')
		$('#mycol').addClass('red')
		postUrl = '/webd/cq/mycol'
		postData.user_id = u_id
		$page = 1
		cdata = {'page':1,'num':10}
		$('.w1248 .o2').hide();
	})

</script>
<script type="text/javascript" src="{{asset('web')}}/js/cqpicpubu.js"></script>

</html>