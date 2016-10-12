$(function (){
  var $tiles_show = $('#tiles_show')
  var $handler_show = $('.index_item', $tiles_show)
  $main_show = $('#main_show')
  $window_show = $(window)
  $document_show = $(document)
  $page_show = 1
  var pic_f = 1
  var options_show = {
    autoResize: true, // This will auto-update the layout when the browser window is resized.
    container: $main_show, // Optional, used for some extra CSS styling
    offset: 15, // Optional, the distance between grid items
    itemWidth:236 // Optional, the width of a grid item
  };
  /**
   * Reinitializes the wookmark handler after all images have loaded
   */
  function applyLayout_show() {
   	//$tiles.imagesLoaded(function() {
      // Destroy the old handler
      if ($handler_show.wookmarkInstance) {
        $handler_show.wookmarkInstance.clear();
      }

      // Create a new layout handler.
      $handler_show = $('.index_item', $tiles_show);
      $handler_show.wookmark(options_show);
  	//});
  }
  /**
   * When scrolled all the way to the bottom, add more tiles
   */
  function onScroll_show() {
  	
    var winHeight = window.innerHeight ? window.innerHeight : $window_show.height(), // iphone fix
    closeToBottom = ($window_show.scrollTop() + winHeight > $document_show.height() - 1);
    if (closeToBottom && pic_f==1) {
    	postData_show.page = ++$page_show
    	$.ajax({
		  	'beforeSend':function(){
		  		pic_f = 0
		  		$('#load_show').show()
		  		$('#load_show').css({'display':'block'})
		  	},
		  	'url':postUrl_show,
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':postData_show,
		  	'success':function(json){

		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			pic_f = 0
		  			
		  			var list  = json.data.list
		  			var $items = $('.index_item', $tiles_show)
		      		$firstTen = $items.slice(0, list.length).clone();
		  			$.each($firstTen,function(index,v){
		  				$value = $firstTen[index]
		  				$('.index_item_price',$value).remove()
		  				
		  				if(list[index].price!=0){
		  					$('.index_item_imgwrap',$value).append('<div class="index_item_price">'+list[index].price+'</div>')
		  				}

					    description = list[index].description!=''?list[index].description:list[index].title
					    $('.index_item_blurwrap',$value).attr('img_id',list[index].id).attr('href','/webd/pic/'+list[index].id).attr('title',description)
					    $(".index_item_intro",$value).html(description);
					    $(".index_item_intro",$value).attr('title',description)

					    $(".index_item_rel a",$value).eq(0).html(list[index].praise_count)
					    $(".index_item_rel a",$value).eq(1).html(list[index].collection_count)
					    $(".index_item_rel",$value).attr('good_id',list[index].id)

					    $(".index_item_d",$value).html(list[index].boo_count)
					    $(".index_item_b",$value).attr('href',list[index].detail_url)
					    $('.index_item_bottom',$value).remove()

					    if(list[index].collection_good != 0){
					    	cg = list[index].collection_good
					    	var ap = ''
					    	$.each(cg,function(k,value){
					    		var str = ''
					    		var pic_m = value.user.auth_avatar!=null?value.user.auth_avatar:value.user.pic_m
					    		nick = value.nick!=''?value.nick:value.username
					    		str = '<div class="index_item_bottom clearfix">'
									+'<a href="/webd/user/index?oid='+value.user_id+'" class="index_item_authava" target="_blank" title="'+nick+'">'
										+'<img src="'+pic_m+'" alt="'+nick+'">'
									+'</a>'
									+'<div class="index_item_authinfo">'
										+'<a href="/webd/user/index?oid='+value.user_id+'" target="_blank" class="index_item_authname" title="'+nick+'">'+nick+'</a>'
										+'<span class="index_item_authto">采集到</span>'
										+'<p class="index_item_authtopart"><a href="/webd/folder?fid='+value.folder_id+'" target="_blank" title="'+value.name+'">'+value.name+'</a></p>'
									+'</div>'
								+'</div>'
								ap+=str
					    	})
							$($value).append(ap)
					    }
					    var rh = parseInt(list[index].rh)>800?800:list[index].rh
					    $(".index_item_imgwrap img",$value).css({'height':rh+'px'}).removeAttr('src').attr('src',list[index].image_url).attr('alt',description)
					   
		  			})
		  			$('#load_show').hide()
		  			
		  			$tiles_show.append($firstTen)
		  			applyLayout_show();
		  			setTimeout(function(){
		  				pic_f = 1
		  			},500)
		  		}else{
		  			pic_f = 0
		  			$('#load_show').html('全部加载完成。。。')
		  		}
		  	}
		  })      
    }
  };

  // Call the layout function for the first time
  applyLayout_show();

  // Capture scroll event.
  $window_show.bind('scroll.wookmark', onScroll_show);
});