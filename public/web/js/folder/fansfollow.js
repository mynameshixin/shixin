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

    	postData.page = ++$page
    	$.ajax({
		  	'beforeSend':function(){
		  		f = 0
		  		$('#load').show()
		  		$('#load').css({'display':'block'})
		  	},
		  	'url':postUrl,
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':postData,
		  	'success':function(json){
		  		
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			data = json.data.list
		  			$lis = $('.find_user_li','#ul').slice(0,data.length).clone()

					$.each($lis,function(index,v){
						pic = data[index].user.pic_m==0?defaultpic:data[index].user.pic_m
						gpic_1 = data[index].folders[0].img_url
						gpic_2 = data[index].folders[1].img_url
						gpic_3 = data[index].folders[2].img_url
						gpic_4 = data[index].folders[3].img_url
						var name_1 = data[index].folders[0].name!=undefined?data[index].folders[0].name:'堆图家'
						var name_2 = data[index].folders[1].name!=undefined?data[index].folders[1].name:'堆图家'
						var name_3 = data[index].folders[2].name!=undefined?data[index].folders[2].name:'堆图家'
						var name_4 = data[index].folders[3].name!=undefined?data[index].folders[3].name:'堆图家'
						var h_1 = data[index].folders[0].id!=undefined?'/webd/folder?fid='+data[index].folders[0].id:'/webd/folder?fid=0'
						var h_2 = data[index].folders[1].id!=undefined?'/webd/folder?fid='+data[index].folders[1].id:'/webd/folder?fid=0'
						var h_3 = data[index].folders[2].id!=undefined?'/webd/folder?fid='+data[index].folders[2].id:'/webd/folder?fid=0'
						var h_4 = data[index].folders[3].id!=undefined?'/webd/folder?fid='+data[index].folders[3].id:'/webd/folder?fid=0'
						$($lis[index]).attr('user_id',data[index].user.id)
						username = data[index].user.nick==''?data[index].user.username:data[index].user.nick
						$('.find_user_name',$lis[index]).html(username).attr('title',username).attr('href','/webd/user?oid='+data[index].user.id)
						$('.find_user_rela',$lis[index]).html(data[index].count.fans_count+'粉丝 '+data[index].count.follow_count+'关注')
						$('.find_user_img img',$lis[index]).attr('src',pic).attr('alt',username)
						$('.find_user_img a',$lis[index]).attr('href','/webd/user?oid='+data[index].user.id).attr('title',username)

						$('.find_user_limg li',$lis[index]).eq(0).find('img').attr('src',gpic_1).attr('alt',name_1)
						$('.find_user_limg li',$lis[index]).eq(1).find('img').attr('src',gpic_2).attr('alt',name_2)
						$('.find_user_limg li',$lis[index]).eq(2).find('img').attr('src',gpic_3).attr('alt',name_3)
						$('.find_user_limg li',$lis[index]).eq(3).find('img').attr('src',gpic_4).attr('alt',name_4)

						$('.find_user_limg li',$lis[index]).eq(0).find('a').attr('href',h_1).attr('title',name_1)
						$('.find_user_limg li',$lis[index]).eq(1).find('a').attr('href',h_2).attr('title',name_2)
						$('.find_user_limg li',$lis[index]).eq(2).find('a').attr('href',h_3).attr('title',name_3)
						$('.find_user_limg li',$lis[index]).eq(3).find('a').attr('href',h_4).attr('title',name_4)
						r = data[index].relation
						switch(r){
							case 1:
								reat='相互关注';
							break;
							case 2:
								reat='已关注';
							break;
							case 4:
								reat='<span>+</span>关注';
							break;
							default:
								reat='<span>+</span>关注';
							break;
						}

						$('.find_user_authflw',$lis[index]).html(reat);
					})
					$('#ul').append($lis)
					$('#load').hide()
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