$(function (){
  var $tiles = $('#tiles')
  $handler = $('.index_item', $tiles)
  $main = $('#main')
  $window = $(window)
  $document = $(document)
  $page = 1
  var f = 1
  options = {
    autoResize: true, // This will auto-update the layout when the browser window is resized.
    container: $main, // Optional, used for some extra CSS styling
    offset: 15, // Optional, the distance between grid items
    itemWidth:236 // Optional, the width of a grid item
  };
  /**
   * Reinitializes the wookmark handler after all images have loaded
   */
  function applyLayout() {
    //$tiles.imagesLoaded(function() {
      // Destroy the old handler
      if ($handler.wookmarkInstance) {
        $handler.wookmarkInstance.clear();
      }

      // Create a new layout handler.
      $handler = $('.index_item', $tiles);
      $handler.wookmark(options);
      //$handler.find('.index_item_imgwrap img').css('visibility','visible')
    //});
  }
  /**
   * When scrolled all the way to the bottom, add more tiles
   */
  function onScroll() {
  	
    var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
        closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

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
		  			
		  			var str = ''
		  			var list  = json.data.list
		  			var $items = $('.index_item', $tiles)
		      		$firstTen = $items.slice(0, list.length).clone();
		  			$.each($firstTen,function(index,v){
		  				$value = $firstTen[index]
		  				description = list[index].description.trim()!=''?list[index].description.trim():list[index].title
		  				$(".index_item_blurwrap",$value).attr('href','/webd/pic/'+list[index].id).attr('title',description)
					    $(".index_item_price",$value).html('￥'+list[index].price)
					    $(".index_item_intro",$value).html(description);
					    $(".index_item_intro",$value).attr('title',description)

					    $(".index_item_rel",$value).attr('good_id',list[index].id)
					    $(".index_item_rel a",$value).eq(0).html(list[index].praise_count)
					    $(".index_item_rel a",$value).eq(1).html(list[index].collection_count)
					    $(".index_item_rel a",$value).eq(2).html(list[index].boo_count)
					    pic_m = list[index].user.auth_avatar!=null?list[index].user.auth_avatar:list[index].user.pic_m
					    
					    user_nick = (list[index].user.nick!=0)?list[index].user.nick:list[index].user.username
					    $(".index_item_bottom img",$value).attr('src',pic_m).attr('title',user_nick)
					    $(".index_item_authname",$value).html(user_nick).attr('href','/webd/user?oid='+list[index].user.id).attr('title',user_nick)

						$(".authava",$value).attr('href','/webd/user?oid='+list[index].user.id).attr('title',user_nick)
						$(".authava img",$value).attr('alt',user_nick)
					    $(".index_item_authtopart a",$value).html(list[index].folder_name).attr('href','/webd/folder?fid='+list[index].folder_id).attr('title',list[index].folder_name)

					    $('.comment',$value).remove()

					    if(list[index].comment != undefined){
					    	user_nick = (list[index].comment.user.nick!=0)?list[index].comment.user.nick:list[index].comment.user.username
					    	pics = list[index].comment.user.auth_avatar!=null?list[index].comment.user.auth_avatar:list[index].comment.user.pic_m
				    		$str = '<div class="index_item_bottom clearfix comment">'
								+'<a href="/webd/user?oid='+list[index].comment.user.id+'" class="index_item_authava" target="_blank" title="'+user_nick+'">'
									+'<img src="'+pics+'" alt="'+user_nick+'">'
								+'</a>'
								+'<div class="index_item_authinfo index_item_authtalk">'
									+'<a href="/webd/user?oid='+list[index].comment.user.id+'" class="index_item_talkname" target="_blank" title="'+user_nick+'">'+user_nick+'：</a>'
									+'<span class="index_item_authto">'+list[index].comment.content+'</span>'
								+'</div>'
							+'</div>'
							$($value).append($str)
					    	
					    }
					    var rh = parseInt(list[index].images[0].rh)>800?800:list[index].images[0].rh
					    $(".index_item_imgwrap img",$value).css({'height':rh+'px'}).removeAttr('src').attr('src',list[index].images[0].img_m).attr('alt',description)
					   
		  			})
		  			$('#load').hide()
		  			$tiles.append($firstTen)
		  			applyLayout();
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

  // Call the layout function for the first time
  applyLayout();

  // Capture scroll event.
  $window.bind('scroll.wookmark', onScroll);
});