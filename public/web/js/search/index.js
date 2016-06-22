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
		  	'url':"/webd/search/folder",
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':{
				'keyword':keyword,
				'page':++$page
			},
		  	'success':function(json){
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			data = json.data.list
					var str = ''
					$.each(data,function(index,v){
						gpic_1 = data[index].goods[0] != undefined?data[index].goods[0].image_url:defaultPic
						gpic_2 = data[index].goods[1] != undefined?data[index].goods[1].image_url:defaultPic
						gpic_3 = data[index].goods[2] != undefined?data[index].goods[2].image_url:defaultPic
						mrightzero = (parseInt(index)+1)%5==0?'mrightzero':''
						var none = (data[index].user.id==self_id)?'style="display: none"':''
						follow = v.is_follow==1?'已关注':'<span>+</span>关注'
						glink_1 = data[index].goods[0] != undefined?'/webd/pic/'+data[index].goods[0].id:'#'
						glink_2 = data[index].goods[1] != undefined?'/webd/pic/'+data[index].goods[1].id:'#'
						glink_3 = data[index].goods[2] != undefined?'/webd/pic/'+data[index].goods[2].id:'#'
						nick = v.user.nick!=''?v.user.nick:v.user.username
						pic_m = v.user.auth_avatar!=null?v.user.auth_avatar:v.user.pic_m
						str += '<li class="find_fold_li '+mrightzero+'" folder_id='+v.id+'>'
							+'<div class="find_fold_info clearfix">'
								+'<div class="find_fold_authava">'
									+'<a href="/webd/user?oid='+v.user.id+'" target="_blank"><img src="'+pic_m+'" alt=""></a>'
								+'</div>'
								+'<div class="find_fold_tname">'
									+'<a href="#" target="_blank" class="find_fold_name">'+v.name+'</a>'
									+'<a href="/webd/user?oid='+v.user.id+'" target="_blank" class="find_fold_authnme">'+nick+'</a>'
								+'</div>'
							+'</div>'
							+'<div class="find_fold_imgwrap">'
								+'<div class="find_fold_imgblur"></div>'
								+'<a href="/webd/folder?fid='+v.id+'" class="position" target="_blank"><img src="'+v.img_url+'" alt="" onload="rect(this)"></a>'
								+'<div class="find_fold_catflw">'+v.count+'文件&nbsp;&nbsp;'+v.collection_count+'关注</div>'
							+'</div>'
							+'<div class="find_fold_limg clearfix">'
								+'<div class="find_fold_liwrap">'
									+'<div class="find_fold_liblur"></div>'
									+'<a href="'+glink_1+'" target="_blank" class="position"><img src="'+gpic_1+'" alt=""></a>'
								+'</div>'
								+'<div class="find_fold_liwrap">'
									+'<div class="find_fold_liblur"></div>'
									+'<a href="'+glink_2+'" target="_blank" class="position"><img src="'+gpic_2+'" alt=""></a>'
								+'</div>'
								+'<div class="find_fold_liwrap">'
									+'<div class="find_fold_liblur"></div>'
									+'<a href="'+glink_3+'" target="_blank" class="position"><img src="'+gpic_3+'" alt=""></a>'
								+'</div>'
							+'</div>'
							+'<a onclick="relation(this)" class="find_fold_authflw" '+none+'>'+follow+'</a>'
						+'</li>'
					})
					$('.find_cater').eq(0).append(str)
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