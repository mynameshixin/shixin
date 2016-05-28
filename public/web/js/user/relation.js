function relation(obj){

	thisobj = $(obj)
	content = $(obj).html().trim()
	folder_id = $(obj).parents('li').attr('folder_id')
	user_id = $(obj).parents('li').attr('user_id')
	follow = folder_id!=undefined?'特别关注':'关注'
	$.ajax({
		'beforeSend':function(){
		  	layer.load(0, {shade: 0.5});
		},
	  	'url':relationUrl,
	  	'type':'POST',
	  	'dataType':'json',
	  	'data':{
	  		'folder_id':folder_id,
	  		'user_id':user_id,
	  		'content':content,
	  		'self_id':self_id
	  	},
	  	'success':function(json){

	  		if(json.code == 200){
	  			r = json.data.list.relation
	  			if(r == 2){
	  				thisobj.html('已关注')
	  				return 
	  			}
	  			if(r == 4){
	  				thisobj.html('<span>+</span>'+follow)
	  				return
	  			}
	  		}
	  	},
	  	'complete':function(){
			layer.closeAll('loading');
		}
	})

}