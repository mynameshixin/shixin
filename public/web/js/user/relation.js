//关注与被关注
function relation(obj){
	thisobj = $(obj)
	content = $(obj).html().trim()
	folder_id = $(obj).parents('li').attr('folder_id')
	var user_id = $(obj).parents('li').attr('user_id')
	if(user_id == undefined) user_id = $(obj).attr('user_id')
	follow = folder_id!=undefined?'特别关注':'关注'
	if(self_id==0){
		layer.msg('没有登陆', {icon:5});
		return 
	}
	if(self_id == user_id){
		layer.msg('无法关注自己', {icon:5});
		return 
	}
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

//文件夹编辑
function folderEdit(obj){
	edit = $(obj)
	p = $(obj).parents('.find_fold_li')
	v = $('.pop_editfold')

	$('.pop_con',v).attr('fid',edit.parents('.find_fold_li').attr('folder_id'))

	if($('#pop_iptpr3',v).attr('private') == 1 && $(obj).parents('.find_fold_list').attr('id') == 'ul0'){
		$('#pop_iptpr3',v).click()
	}

	if($('#pop_iptpr3',v).attr('private') == 0 && $(obj).parents('.find_fold_list').attr('id') == 'ul1'){
		$('#pop_iptpr3',v).click()
	}

	foldername = $('.find_fold_tname a',p).html()
	$('input[name=fname]',v).val(foldername)
	//$('.pop_iptdes',v).val()

	$('.pop_editfold').show()
  	var poptopHei = $('.pop_editfold .pop_con').height();
		$('.pop_con').css({
		   'margin-top':-(poptopHei/2)
	})
}

//文件夹页面编辑
function folderEditInner(obj){
	edit = $(obj)
	v = $('.pop_editfold')

	$('.pop_con',v).attr('fid',fid)

	if($('#pop_iptpr3',v).attr('private') == 1 && $('.container').attr('private') == 0){
		$('#pop_iptpr3',v).click()
	}

	if($('#pop_iptpr3',v).attr('private') == 0 && $('.container').attr('private') == 1){
		$('#pop_iptpr3',v).click()
	}

	foldername = $('.detail_filetit').html().trim()
	$('input[name=fname]',v).val(foldername)

	$('.pop_editfold').show()
  	var poptopHei = $('.pop_editfold .pop_con').height();
		$('.pop_con').css({
		   'margin-top':-(poptopHei/2)
	})
}

//评论赞添加
function comment_parise(obj){
	if(u_id==''){
		layer.msg('没有登陆',{'icon':5})
		return
	}
	var count = $(obj).html()
	var user_id = $(obj).attr('user_id')
	var comment_id = $(obj).attr('comment_id')
	$.ajax({
		
		'url':"/webd/pics/commentcount",
		'type':'post',
		'data':{
			'comment_id':comment_id,
			'user_id':user_id,
			'u_id':u_id
		},
		'dataType':'json',
		'success':function(json){
			if(json.code==200){
				$(obj).html(parseInt(count)+1)
			}else{
				layer.msg(json.message, {icon: 5});
				return
			}
			
		},
		
	})
}