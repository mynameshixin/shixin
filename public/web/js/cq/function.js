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