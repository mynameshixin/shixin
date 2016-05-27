$(function (){
  /**
   * When scrolled all the way to the bottom, add more tiles
   */
  $window = $(window)
  $document = $(document)
  $page0 = 1
  $page1 = 1
  
  function onMore() {
  		private = $(this).attr('private')
  		if(private == 1){
  			postData.page = ++$page1
  		}else{
  			postData.page = ++$page0
  		}
    	postData.private = private
    	obj = $(this)
    	$.ajax({
		  	'beforeSend':function(){
		  		obj.html('请等待。。。')
		  	},
		  	'url':postUrl,
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':postData,
		  	'success':function(json){
		  		ul = '#ul'+private
		  		if(json.code==200 && json.data.list!=0){
		  			f = 0
		  			data = json.data.list

		  			$lis = $('.find_fold_li',ul).slice(0,data.length).clone()

					$.each($lis,function(index,v){

						gpic_1 = data[index].goods[0] != undefined?data[index].goods[0].image_url:defaultPic
						gpic_2 = data[index].goods[1] != undefined?data[index].goods[1].image_url:defaultPic
						gpic_3 = data[index].goods[2] != undefined?data[index].goods[2].image_url:defaultPic

						$('.find_fold_name',$lis[index]).html(data[index].name)
						$('.find_fold_imgwrap img',$lis[index]).attr('src',data[index].img_url)
						$('.find_fold_catflw',$lis[index]).html(data[index].count+'文件&nbsp;&nbsp;'+data[index].collection_count+'关注')

						$('.find_fold_liwrap img',$lis[index]).eq(0).attr('src',gpic_1)
						$('.find_fold_liwrap img',$lis[index]).eq(1).attr('src',gpic_2)
						$('.find_fold_liwrap img',$lis[index]).eq(2).attr('src',gpic_3)

					})
					
					$(ul).append($lis)
					obj.html('查看更多。。。')
					
		  		}else{
		  			obj.html('没有更多。。。')
		  		}

		  	}
		  })      
    }


  // Capture scroll event.
  $('#more').bind('click', onMore);
  $('#more1').bind('click', onMore);
});