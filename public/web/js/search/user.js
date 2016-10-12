$(function (){
  /**
   * When scrolled all the way to the bottom, add more tiles
   */
  $window = $(window)
  $document = $(document)
  $page = 1
  var f=1
  function onScroll() {
  	
    var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
        closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 1);

    if (closeToBottom && f==1) {
    	$.ajax({
		  	'beforeSend':function(){
		  		f = 0
		  		$('#load').show()
		  		$('#load').css({'display':'block'})
		  	},
		  	'url':"/webd/search/user",
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':{
				'keyword':keyword,
				'page':++$page,
				'user_id':user_id
			},
		  	'success':function(json){
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			data = json.data.list
					var str = ''
					$.each(data,function(index,v){
						gpic_1 = data[index].folders[0].img_url
						gpic_2 = data[index].folders[1].img_url
						gpic_3 = data[index].folders[2].img_url
						gpic_4 = data[index].folders[3].img_url

						glink_1 = data[index].folders[0].id!=undefined?'href="/webd/folder?fid='+data[index].folders[0].id+'"':''
						glink_2 = data[index].folders[1].id!=undefined?'href="/webd/folder?fid='+data[index].folders[1].id+'"':''
						glink_3 = data[index].folders[2].id!=undefined?'href="/webd/folder?fid='+data[index].folders[2].id+'"':''
						glink_4 = data[index].folders[3].id!=undefined?'href="/webd/folder?fid='+data[index].folders[3].id+'"':''

						gname_1 = data[index].folders[0].name!=undefined?data[index].folders[0].name:'堆图家'
						gname_2 = data[index].folders[1].name!=undefined?data[index].folders[1].name:'堆图家'
						gname_3 = data[index].folders[2].name!=undefined?data[index].folders[2].name:'堆图家'
						gname_4 = data[index].folders[3].name!=undefined?data[index].folders[3].name:'堆图家'
						nick = v.nick!=''?v.nick:v.username
						pic_m = v.auth_avatar!=null?v.auth_avatar:v.pic_m
						mrightzero = (parseInt(index)+1)%5==0?'mrightzero':''
						switch(v.relation){
							case 1:
								follow = '相互关注'
								break;
							case 2:
								follow = '已关注'
								break;
							case 5:
								follow = '我的文件'
								break;
							default:
								follow = '<span>+</span>关注'
								break;
						}
						str += '<li class="find_user_li '+mrightzero+'" user_id='+v.id+'>'
									+'<div class="find_user_info">'
										+'<a href="/webd/user?oid='+v.id+'" class="find_user_name" target="_blank" title="'+nick+'">'+nick+'</a>'
										+'<a href="/webd/user?oid='+v.id+'" class="find_user_rela" target="_blank">'+v.count.fans_count+'粉丝 '+v.count.follow_count+'关注</a>'
									+'</div>'
									+'<div class="find_user_con clearfix">'
										+'<div class="find_user_img">'
											+'<div class="find_user_blur"></div>'
											+'<a href="/webd/user?oid='+v.id+'" class="position" target="_blank" title="'+nick+'"><img src="'+pic_m+'" alt="'+nick+'"></a>'
										+'</div>'
										+'<ul class="find_user_limg">'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a '+glink_1+' class="position" target="_blank" title="'+gname_1+'"><img src="'+gpic_1+'" alt="'+gname_1+'"></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a '+glink_2+' class="position" target="_blank" title="'+gname_2+'"><img src="'+gpic_2+'" alt="'+gname_2+'"></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a '+glink_3+' class="position" target="_blank" title="'+gname_3+'"><img src="'+gpic_3+'" alt="'+gname_3+'"></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a '+glink_4+' class="position" target="_blank" title="'+gname_4+'"><img src="'+gpic_4+'" alt="'+gname_4+'"></a>'
											+'</li>'
										+'</ul>'
										
										if(v.id!=self_id){
											str+= '<a onclick="relation(this)" class="find_user_authflw" style="cursor: pointer">'+follow+'</a>'
										}
								str+='</div>'
								+'</li>'

					})
					$('.find_cater').find('.find_fold_list').append(str)
					setTimeout(function(){
		  				f = 1
		  			},500)
					
		  		}else{
		  			f = 0
		  			$('#load').html('全部加载完成。。。')
		  		}

		  	}
		  })      
    }
  };


  // Capture scroll event.
  $window.bind('scroll', onScroll);
});