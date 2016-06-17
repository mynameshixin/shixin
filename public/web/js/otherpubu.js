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

    if (closeToBottom) {
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
		  			var str = ''
		  			var list  = json.data.list
		  			var $items = $('.index_item', $tiles)
		      		
		  			$.each(list,function(index,v){
		  				str += '<div class="index_item">'
				    	+'<div class="index_item_wrap">'
							+'<div class="index_item_imgwrap">'
								+'<a class="index_item_blurwrap"></a>'
								+'<img src="'+list[index].images[0].img_m+'">'
								+'<div class="index_item_price">￥'+list[index].price+'</div>'
							+'</div>'
							+'<div class="index_item_info">'
								+'<div class="index_item_top">'
									+'<div class="index_item_intro" title="'+list[index].description+'">'+list[index].description+'</div>'
									+'<div class="index_item_rel clearfix">'
										+'<a href="javascript:;" class="index_item_l">'+list[index].praise_count+'</a>'
										+'<a href="javascript:;" class="index_item_c">'+list[index].collection_count+'</a>'
										+'<a href="'+list[index].detail_url+'" class="index_item_b"></a>'
									+'</div>'
								+'</div>'
								+'<div class="index_item_bottom clearfix">'
									+'<a href="javascript:;" class="index_item_authava" target="_blank">'
										+'<img src="'+list[index].user.pic_m+'" alt="">'
									+'</a>'
									+'<div class="index_item_authinfo">'
										+'<a href="javascript:;" class="index_item_authname">'+list[index].user.nick+'</a>'
										+'<span class="index_item_authto">采集到</span>'
										+'<p class="index_item_authtopart"><a href="javascript:;" target="_blank">'+list[index].folder_name+'</a></p>'
									+'</div>'
								+'</div>'
							+'</div>'
						+'</div>'
					   +'</div>'

					   
		  			})
		  			$('#load').hide()
		  			
		  			$tiles.append(str)
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