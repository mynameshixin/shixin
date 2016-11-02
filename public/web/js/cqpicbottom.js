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
		  	'type':'get',
		  	'dataType':'json',
		  	'data':postData_show,
		  	'success':function(json){
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			pic_f = 0
		  			var str = ""
		  			var list  = json.data.list
		  			$.each(list,function(index,v){
			  			str +=  '<div class="index_item" img_id="'+v.id+'">\
								<div class="index_item_wrap">\
									<div class="index_item_imgwrap clearfix">\
										<a class="index_item_blurwrap" href="/webd/cqpic/'+v.id+'" target="_blank" title="'+v.title+'"></a>\
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
												<a href="javascript:;" class="index_item_like" onclick="cq_good_like(this)">'+v.praise_count+'</a>\
												<a href="javascript:;" class="index_item_c" onclick="cq_good_col(this)">'+v.collection_count+'</a>\
												<a href="/webd/cqpic/'+v.id+'" target="_blank" class="index_item_chat"></a>\
											</div>\
										</div>\
									</div>\
								</div>\
							</div>'
					})  
		  			$tiles_show.append(str)
		  			$('#load_show').hide()
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