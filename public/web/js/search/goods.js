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
   // $tiles.imagesLoaded(function() {
      // Destroy the old handler
      if ($handler.wookmarkInstance) {
        $handler.wookmarkInstance.clear();
      }

      // Create a new layout handler.
      $handler = $('.index_item', $tiles);
      $handler.wookmark(options);
   // });
  }
  /**
   * When scrolled all the way to the bottom, add more tiles
   */
  function onScroll() {
  	
    var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
        closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 1);

    if (closeToBottom && f==1) {
    	$.ajax({
		  	'beforeSend':function(){
		  		$('#load').show()
		  		$('#load').css({'display':'block'})
		  	},
		  	'url':'/webd/search/goods',
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':{
		  		'keyword':keyword,
				'page':++$page,
				'kind':kinds
		  	},
		  	'success':function(json){

		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			f = 0
		  			data = json.data.list
					var str = ''
					$.each(data,function(index,v){
						des = v.description != ''?v.description:v.title
						kind = v.kind
						str += '<div class="index_item">'
							+'<div class="index_item_wrap">'
								+'<div class="index_item_imgwrap clearfix">'
									+'<a class="index_item_blurwrap" href="/webd/pic/'+v.id+'" target="_blank"></a>'
									+'<img src="'+v.image_url+'">'
									if(kind==1){
										str += '<div class="index_item_price">'+v.price+'</div>'
									}
								str +='</div>'
								+'<div class="index_item_info">'
									+'<div class="index_item_top">'
										+'<div class="index_item_intro" title="'+des+'">'+des+'</div>'
										+'<div class="index_item_rel clearfix">'
											+'<a href="javascript:;" class="index_item_l">'+v.praise_count+'</a>'
											+'<a href="javascript:;" class="index_item_c">'+v.collection_count+'</a>'
										if(kind==1){
											str +='<a href="'+v.detail_url+'" class="index_item_b" target="_blank"></a>'
										}else if(kind==2){
											str +='<a href="javascript:;" class="index_item_d">'+v.boo_count+'</a>'
										}		
									str +='</div>'
									+'</div>'

									if(v.cfolder!=0 && v.cuser!=0){
										userpic = v.cuser.auth_avatar!=null?v.cuser.auth_avatar:v.cuser.pic_m
										nick = v.cuser.nick!=''?v.cuser.nick:v.cuser.username
										str+='<div class="index_item_bottom clearfix">'
											+'<a href="/webd/user?oid='+v.cuser.id+'" class="index_item_authava" target="_blank">'
												+'<img src="'+userpic+'" alt="">'
											+'</a>'
											+'<div class="index_item_authinfo">'
												+'<a href="/webd/user?oid='+v.cuser.id+'" target="_blank" class="index_item_authname">'+nick+'</a>'
												+'<span class="index_item_authto">采集到</span>'
												+'<p class="index_item_authtopart"><a href="/webd/folder?fid='+v.cfolder.id+'" target="_blank">'+v.cfolder.name+'</a></p>'
											+'</div>'
										+'</div>'
									}
								str+='</div>'
							+'</div>'
						+'</div>'
						 
					})
					$('.find_cater').find('.index_con').append(str)

		  			$('#load').hide()
		  			applyLayout();
		  			f = 1
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