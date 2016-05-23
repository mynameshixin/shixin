$(function (){
  var $tiles = $('#tiles')
  $handler = $('.index_item', $tiles)
  $main = $('#main')
  $window = $(window)
  $document = $(document)
  $page = 0
  options = {
    autoResize: true, // This will auto-update the layout when the browser window is resized.
    container: $main, // Optional, used for some extra CSS styling
    offset: 5, // Optional, the distance between grid items
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

    if (closeToBottom) {
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
		  		if(json.code==200 && json.data.list!=0){
		  			var str = ''
		  			var list  = json.data.list
		  			var $items = $('.index_item', $tiles)
		      		$firstTen = $items.slice(1, 10).clone();
		      		/*'<div class="index_item">'
			    	+'<div class="index_item_wrap">'
						+'<div class="index_item_imgwrap">'
							+'<a class="index_item_blurwrap"></a>'
							+'<img src="http://www.duitujia.com/web/images/temp/10.png">'
							+'<div class="index_item_price">￥980</div>'
						+'</div>'
						+'<div class="index_item_info">'
							+'<div class="index_item_top">'
								+'<div class="index_item_intro" title="简洁实用的衣柜">简洁实用</div>'
								+'<div class="index_item_rel clearfix">'
									+'<a href="javascript:;" class="index_item_l">82</a>'
									+'<a href="javascript:;" class="index_item_c">90</a>'
									+'<a href="javascript:;" class="index_item_b"></a>'
								+'</div>'
							+'</div>'
							+'<div class="index_item_bottom clearfix">'
								+'<a href="javascript:;" class="index_item_authava" target="_blank">'
									+'<img src="http://www.duitujia.com/web/images/temp_avatar.JPG" alt="">'
								+'</a>'
								+'<div class="index_item_authinfo">'
									+'<a href="javascript:;" class="index_item_authname">叶子</a>'
									+'<span class="index_item_authto">采集到</span>'
									+'<p class="index_item_authtopart"><a href="javascript:;" target="_blank">搭配</a></p>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
				   +'</div>'*/
		  			$.each($firstTen,function(index,v){
		  				$value = $firstTen[index]
					    $(".index_item_price",$value).html('￥'+list[index].price)
					    $(".index_item_intro",$value).html(list[index].description);
					    $(".index_item_intro",$value).attr('title',list[index].folder_name)

					    $(".index_item_rel a",$value).eq(0).html(list[index].price)
					    $(".index_item_rel a",$value).eq(1).html(list[index].praise_count)
					    $(".index_item_rel a",$value).eq(2).attr('href',list[index].detail_url)

					    $(".index_item_bottom img",$value).attr('src',list[index].user.pic_m)
					    $(".index_item_authname",$value).html(list[index].user.nick)
					    $(".index_item_authtopart a",$value).html(list[index].folder_name)

					   $(".index_item_imgwrap img",$value).attr('src',list[index].images.img_m)
					   
		  			})
		  			$('#load').hide()
		  			$tiles.append($firstTen)
		  			applyLayout();
		  		}
		  	}
		  })


     /* var $items = $('.index_item', $tiles),
      $firstTen = $items.slice(0, 10);
      console.log($firstTen.length)      
      $tiles.append($firstTen.clone());*/

      
    }
  };

  // Call the layout function for the first time
  applyLayout();

  // Capture scroll event.
  $window.bind('scroll.wookmark', onScroll);
});