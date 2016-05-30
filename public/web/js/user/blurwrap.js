
function blurwrap(obj){

	img_id = $(obj).attr('img_id')
	$('body').addClass('overhidden')
	$.ajax({
		'beforeSend':function(){
	  		layer.load(0, {shade: 0.5});
	  	},
	  	'url':imgUrl,
	  	'type':'POST',
	  	'dataType':'json',
	  	'data':{'img_id':img_id},
	  	'success':function(json){
	  		$parent = $('.detail_pop')
	  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
	  			data = json.data.list
	  			// $('.detail_pop_timgwarp img',$parent).attr('src',defaultPic)
	  			$('.detail_pop_timgwarp img',$parent).attr('src',data.images[0].img_o)
	  			price = data.price
	  			$('.index_item_price').remove()
	  			if(price!=0) $('.detail_pop_timgwarp').append('<div class="index_item_price">￥'+price+'</div>')
	  			$('.detail_pop_des').attr('title',data.description).html(data.description)
	  			detail_url = data.detail_url.substr(0,50)
	  			$('.detail_pop_fromurl').attr('href',detail_url).html(detail_url)
	  			comments = ''
	  			$('li.clearfix').remove()
	  			if(data.comments != 0){
	  				$.each(data.comments,function(index,v){
	  					username = v.user.nick!=''?v.user.nick:v.user.username
	  					if($.inArray(index, [0,1,2])!= -1){
	  						str = '<li class="clearfix">'
								+'<div class="detail_pop_authava">'
									+'<a href="/webd/user/index?oid='+v.user.id.toString()+'" target="_blank"><img src="'+v.user.pic_m+'" alt=""></a>'
								+'</div>'
								+'<div class="detail_pop_cominfo">'
									+'<p class="detail_pop_comname"><a href="/webd/user/index?oid='+v.user.id.toString()+'">'+username+'</a>- 1个月前说'
										+'<span class="detail_pop_comshare" style="display: inline;">'
											+'<a href="javascript:;" class="detail_pop_share1"></a>'
											+'<a href="javascript:;" class="detail_pop_share2"></a>'
											+'<a href="javascript:;" class="detail_pop_share3"></a>'
									+'</span>'
									+'</p>'
									+'<p class="detail_pop_comcon">'+v.content+'</p>'
								+'</div>'
								+'<div class="detail_pop_favor">'+v.praise_count+'</div>'
							+'</li>'
							comments += str
						}
	  				})
				}else{
					comments = '<li style="font-size:18px;text-align:center" class="clearfix">暂无评论</li>'
				}
				$('.detail_pop_tlcomlist').append(comments)

				$('.detail_pop_tlbtmauth .detail_pop_authava').find('img').attr('src',data.user.pic_m)
				$('.detail_pop_trauth .detail_pop_authava').find('img').attr('src',data.user.pic_m)
								fid = data.folder!=undefined?data.folder:0;
				$('.detail_pop_trauth .detail_pop_authava').find('a').attr('href','/webd/folder?fid='+fid+'&oid='+data.user_id)
				$('.detail_pop_authname a').attr('href','/webd/user?oid='+data.user.id).html(data.user.username)
				$('.detail_pop_authcollect a').attr('href','/webd/folder?fid='+fid+'&oid='+data.user_id).html(data.folder.name)
				$('.detail_pop_authcollect span').html(data.folder.name)
				r = data.relation
				switch(r){
					case 1:
						relation = '相互关注'
					break;
					case 2:
						relation = '已关注'
					break;
					default:
						relation = '未关注'
					break;
				}
				$('.detail_pop_trauth .detail_fileball').html(relation)
				// $('.detail_pop_tritem').remove()
				more = ''
				$.each(data.more,function(index,v){
					more += '<div class="detail_pop_tritem">'
								+'<div class="index_item_wrap">'
									+'<div class="index_item_imgwrap clearfix">'
										+'<a class="index_item_blurwrap" href="#"></a>'
										+'<img src="'+v.image_url+'">'
									+'</div>'
								+'</div>'
							+'</div>'
				})
				//$('.detail_pop_trwwrap').append(more)



					/*<li class="find_fold_li mrightzero">
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
*/
				
	  			
	  		}
	  		$parent.show();
	  		
	  	},
	  	'complete':function(){
			layer.closeAll('loading');
		}
	})

}
