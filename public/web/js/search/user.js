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
		  			f = 0
		  			data = json.data.list
					var str = ''
					$.each(data,function(index,v){
						gpic_1 = data[index].folders[0].img_url
						gpic_2 = data[index].folders[1].img_url
						gpic_3 = data[index].folders[2].img_url
						gpic_4 = data[index].folders[3].img_url

						glink_1 = data[index].folders[0].id
						glink_2 = data[index].folders[1].id
						glink_3 = data[index].folders[2].id
						glink_4 = data[index].folders[3].id

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
										+'<a href="/webd/user?oid='+v.id+'" class="find_user_name" target="_blank">'+nick+'</a>'
										+'<a href="/webd/user?oid='+v.id+'" class="find_user_rela" target="_blank">'+v.count.fans_count+'粉丝 '+v.count.follow_count+'关注</a>'
									+'</div>'
									+'<div class="find_user_con clearfix">'
										+'<div class="find_user_img">'
											+'<div class="find_user_blur"></div>'
											+'<a href="/webd/user?oid='+v.id+'" class="position" target="_blank"><img src="'+pic_m+'" alt=""></a>'
										+'</div>'
										+'<ul class="find_user_limg">'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_1+'" class="position" target="_blank"><img src="'+gpic_1+'" alt=""></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_2+'" class="position" target="_blank"><img src="'+gpic_2+'" alt=""></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_3+'" class="position" target="_blank"><img src="'+gpic_3+'" alt=""></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_4+'" class="position" target="_blank"><img src="'+gpic_4+'" alt=""></a>'
											+'</li>'
										+'</ul>'
										+'<a onclick="relation(this)" class="find_user_authflw" style="cursor: pointer">'+follow+'</a>'
									+'</div>'
								+'</li>'

					})
					$('.find_cater').find('.find_fold_list').append(str)
					f = 1
					
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