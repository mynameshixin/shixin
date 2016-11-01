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
		  		
		  		if(json.code==200 && json.data!=0 && json.data!=null){
		  			
		  			var str = ''
		  			var list  = json.data
		  			$.each(list,function(index,v){
		
					   str +=  '<div class="index_item" img_id="'+v.id+'">\
							<div class="index_item_wrap">\
								<div class="index_item_imgwrap clearfix">\
									<a class="index_item_blurwrap" href="" target="_blank" title="'+v.title+'"></a>\
									<img src="'+v.images[0].img_m+'" style="height: '+v.images[0].rh+'px" onload="resize_xy(this)" alt="'+v.title+'">\
									<div class="index_item_price"><strong>'+v.reserve_price+'</strong><b>'+v.price+'</b></div>\
								</div>\
								<div class="index_item_info">\
									<div class="index_item_top">\
										<div class="index_item_intro" title="'+v.title+'">'+v.title+'</div>\
										<div class="vr_title">\
												<span class="vr_home_loc">'+v.cityname+' '+v.countryname+'</span>\
												<span class="vr_home_ll">'+v.views+'浏览</span>\
												<span class="vr_home_fb">'+v.min+'发表</span>\
										</div>\
										<div class="index_item_rel clearfix" good_id="'+v.id+'">\
											<a href="javascript:;" class="index_item_like" onclick="">'+v.praise_count+'</a>\
											<a href="javascript:;" class="index_item_c">'+v.collection_count+'</a>\
											<a href="javascript:;" class="index_item_chat"></a>\
										</div>\
									</div>\
								</div>\
							</div>\
						</div>'
					   
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