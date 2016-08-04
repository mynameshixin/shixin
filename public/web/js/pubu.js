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
     // $handler.find('.index_item_imgwrap img').css('visibility','visible')
// });
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
		      		$firstTen = $items.slice(1, list.length+1).clone();

		  			$.each($firstTen,function(index,v){
		  				$value = $firstTen[index]
		  				$(".index_item_blurwrap",$value).attr('href','/webd/pic/'+list[index].id)


		  				fuhao = list[index].detail_url.indexOf('m.fancy.com')>0?'$':'￥'
					    $(".index_item_price",$value).html(fuhao+list[index].price)
					    $(".index_item_intro",$value).html(list[index].description);
					    $(".index_item_intro",$value).attr('title',list[index].description)

					    $(".index_item_rel",$value).attr('good_id',list[index].id)
					    $(".index_item_rel a",$value).eq(0).html(list[index].praise_count)
					    $(".index_item_rel a",$value).eq(1).html(list[index].collection_count)
					    $(".index_item_rel a",$value).eq(2).attr('href',list[index].detail_url)
					    pic_m = list[index].user.auth_avatar!=null?list[index].user.auth_avatar:list[index].user.pic_m
					    $(".index_item_bottom img",$value).attr('src',pic_m)
					    user_nick = (list[index].user.nick!=0)?list[index].user.nick:list[index].user.username
					    $(".index_item_authname",$value).html(user_nick).attr('href','/webd/user?oid='+list[index].user.id)

					    $(".index_item_authava",$value).attr('href','/webd/user?oid='+list[index].user.id)
					    $(".index_item_authtopart a",$value).html(list[index].folder_name).attr('href','/webd/folder?fid='+list[index].folder_id)
					    var rh = parseInt(list[index].images[0].rh)
					    $(".index_item_imgwrap img",$value).attr('src',list[index].images[0].img_m).css({'height':rh+'px'})
					   
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