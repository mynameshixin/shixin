function cq_good_col(obj){
	var img_id = $(obj).parents('.index_item').attr('img_id')
	var count = $(obj).html()
	if(u_id==''){
		layer.msg('没有登陆',{'icon':5})
		return
	}
	$.ajax({
		'beforeSend':function(){
			layer.load(0, {shade: 0.5});
		},
		'url':"/webd/cq/col",
		'type':'post',
		'data':{
			'good_id':img_id,
			'user_id':u_id
		},
		'dataType':'json',
		'success':function(json){
			if(json.code==200){
				$(obj).html(parseInt(count)+1)
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
}

function cq_good_like(obj){
	var img_id = $(obj).parents('.index_item').attr('img_id')
	var count = $(obj).html()
	if(u_id==''){
		layer.msg('没有登陆',{'icon':5})
		return
	}
	$.ajax({
		'beforeSend':function(){
			layer.load(0, {shade: 0.5});
		},
		'url':"/webd/cq/glike",
		'type':'post',
		'data':{
			'good_id':img_id,
			'user_id':u_id
		},
		'dataType':'json',
		'success':function(json){
			if(json.code==200){
				$(obj).html(parseInt(count)+1)
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
}

// 编辑出清商品
function edit_cq_good(objs){
    var obj = $('.pop_editcq');
    if(u_id==''){
      layer.msg('需要登录',{'icon':5})
      return
    };
    var good_id = $(objs).attr('good_id');
    $.ajax({
      'url':"/webd/cq/editgoodinfo",
      'type':'post',
      'data':{'good_id':good_id},
      'dataType':'json',
      'success':function(json){
          $('input[name=title]',obj).val(json.data.title)
          $('textarea[name=description]',obj).html(json.data.description).val(json.data.description)
          if(json.data.source==1){
            $('input[name=source][value=1]',obj).attr('checked',1)
          }
          if(json.data.source==2){
            $('input[name=source][value=2]',obj).attr('checked',1)
          }
          $('#cqposition').html(json.data.cityname+' '+json.data.countryname)
          $('input[name=cityid]',obj).val(json.data.cityid)
          $('input[name=reserve_price]',obj).val(json.data.reserve_price)
          $('input[name=price]',obj).val(json.data.price)
          $('input[name=contact]',obj).val(json.data.contact)
          $('input[name=good_id]',obj).val(json.data.id)
          $('#ccate').html(json.data.tags)
          return
      }
    });
    $('.pop_editcq').show();
    var poptopHei = $('.pop_editcq .pop_con').height();
    $('.pop_editcq .pop_con').css({
       'margin-top':-(poptopHei/2)
    });
    var tags = [{"name":"三人沙发","pid":1},{"name":"双人沙发","pid":1},{"name":"单人沙发","pid":1},{"name":"沙发床","pid":1},{"name":"布艺沙发","pid":1},{"name":"皮质沙发","pid":1},{"name":"古典沙发","pid":1},{"name":"现代沙发","pid":1},{"name":"美式沙发","pid":1},{"name":"东南亚沙发","pid":1},{"name":"简欧沙发","pid":1},{"name":"日式沙发","pid":1},
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
    {"name":"隔断","pid":12},{"name":"窗帘","pid":12},{"name":"沐浴","pid":12},{"name":"浴缸","pid":12}];
    $('select[name=f_select]').change(function(){
      var value  = $(this).val()
      var str = $(this).find('option:selected').html()
      var s = ''
      $.each(tags,function(i,v){
        if(v.pid==value){
          s+= '<option>'+v.name+'</option>'
        }
      })
      $('select[name=s_select]').html(s)
      var f = $('select[name=s_select]').find('option:selected').html()
      $('input[name=tags]').val(str+f)
      
    });

    $('select[name=s_select]').change(function(){
      var str = $('select[name=f_select]').find('option:selected').html()
      var f = $(this).find('option:selected').html()
      $('input[name=tags]').val(str+f)
      
    });
  } 