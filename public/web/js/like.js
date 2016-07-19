function praise(obj,type){
	var good_id = $(obj).parents('.index_item_rel').attr('good_id')
	if(u_id==''){
		layer.msg('没有登陆',{'icon':5})
		return
	}
	$.ajax({
		'beforeSend':function(){
			layer.load(0, {shade: 0.5});
		},
		'url':"/webd/goodaction/create",
		'type':'post',
		'data':{
			'good_id':good_id,
			'action':type,
			'user_id':u_id
		},
		'dataType':'json',
		'success':function(json){
			if(json.code==200){
				num = $(obj).html()
				$(obj).html(parseInt(num)+1)
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


