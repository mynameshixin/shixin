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
		  		$('#load').show()
		  	},
		  	'url':postUrl,
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':postData,
		  	'success':function(json){
		  		
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			f = 0
		  			data = json.data.list

		  			$lis = $('.find_fold_li','#ul').slice(0,data.length).clone()

					$.each($lis,function(index,v){

						gpic_1 = data[index].folder_goods[0] != undefined?data[index].folder_goods[0].image_url:defaultPic
						gpic_2 = data[index].folder_goods[1] != undefined?data[index].folder_goods[1].image_url:defaultPic
						gpic_3 = data[index].folder_goods[2] != undefined?data[index].folder_goods[2].image_url:defaultPic
						
						$($lis[index]).attr('folder_id',data[index].folder_id)
						$('.find_fold_name',$lis[index]).html(data[index].name)
						username = data[index].nick==''?data[index].username:data[index].nick
						$('.find_fold_authnme',$lis[index]).html(username)

						$('.find_fold_imgwrap img',$lis[index]).attr('src',data[index].img_url)
						$('.find_fold_catflw',$lis[index]).html(data[index].count+'文件&nbsp;&nbsp;'+data[index].collection_count+'关注')

						$('.find_fold_liwrap',$lis[index]).eq(0).find('img').attr('src',gpic_1)
						$('.find_fold_liwrap',$lis[index]).eq(1).find('img').attr('src',gpic_2)
						$('.find_fold_liwrap',$lis[index]).eq(2).find('img').attr('src',gpic_3)
						if(self_id == user_id){
							$('.find_fold_authflw',$lis[index]).html('已关注')
						}else{
							follow = data[index].is_follow==1?'已关注':'<span>+</span>特别关注'
							$('.find_fold_authflw',$lis[index]).html(follow)
						}
					})
					$('#ul').append($lis)
					$('#load').hide()
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