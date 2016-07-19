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
   	$tiles.imagesLoaded(function() {
      // Destroy the old handler
      if ($handler.wookmarkInstance) {
        $handler.wookmarkInstance.clear();
      }

      // Create a new layout handler.
      $handler = $('.index_item', $tiles);
      $handler.wookmark(options);
  	});
  }
  /**
   * When scrolled all the way to the bottom, add more tiles
   */
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
		  			f = 0
		  			
		  			var list  = json.data.list
		  			var $items = $('.index_item', $tiles)
		      		$firstTen = $items.slice(0, list.length).clone();
		  			$.each($firstTen,function(index,v){
		  				$value = $firstTen[index]
		  				$('.index_item_price',$value).remove()
		  				$('.index_item_blurwrap',$value).attr('img_id',list[index].id).attr('href','/webd/pic/'+list[index].id)
		  				if(list[index].price!=0){
		  					$('.index_item_imgwrap',$value).append('<div class="index_item_price">￥'+list[index].price+'</div>')
		  				}

					    description = list[index].description!=''?list[index].description:list[index].title
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
					    		nick = value.nick!=''?value.nick:value.username
					    		str = '<div class="index_item_bottom clearfix">'
									+'<a href="/webd/user/index?oid='+value.user_id+'" class="index_item_authava" target="_blank">'
										+'<img src="'+value.user.pic_m+'" alt="">'
									+'</a>'
									+'<div class="index_item_authinfo">'
										+'<a href="/webd/user/index?oid='+value.user_id+'" target="_blank" class="index_item_authname">'+nick+'</a>'
										+'<span class="index_item_authto">采集到</span>'
										+'<p class="index_item_authtopart"><a href="/webd/folder?fid='+value.folder_id+'" target="_blank">'+value.name+'</a></p>'
									+'</div>'
								+'</div>'
								ap+=str
					    	})
							$($value).append(ap)
					    }
					    
					    $(".index_item_imgwrap img",$value).attr('src',list[index].image_url)
					   
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