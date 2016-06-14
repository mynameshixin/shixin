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
		  		obj.css({'display':'block'})
		  	},
		  	'url':postUrl,
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':postData,
		  	'success':function(json){
		  		ul = '#ul'+private
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			f = 0
		  			data = json.data.list

		  			$lis = $('.find_fold_li',ul).slice(1,data.length+1).clone()

					$.each($lis,function(index,v){

						gpic_1 = data[index].goods[0] != undefined?data[index].goods[0].image_url:defaultPic
						gpic_2 = data[index].goods[1] != undefined?data[index].goods[1].image_url:defaultPic
						gpic_3 = data[index].goods[2] != undefined?data[index].goods[2].image_url:defaultPic

						glink_1 = data[index].goods[0] != undefined?'/webd/pic/'+data[index].goods[0].id:'#'
						glink_2 = data[index].goods[1] != undefined?'/webd/pic/'+data[index].goods[1].id:'#'
						glink_3 = data[index].goods[2] != undefined?'/webd/pic/'+data[index].goods[2].id:'#'
						$($lis[index]).attr('folder_id',data[index].id)
						$('.find_fold_name',$lis[index]).html(data[index].name).attr('href','/webd/folder?fid='+data[index].id)
						$('.find_fold_imgwrap a',$lis[index]).attr('href','/webd/folder?fid='+data[index].id)
						$('.find_fold_imgwrap img',$lis[index]).attr('src',data[index].img_url)
						$('.find_fold_catflw',$lis[index]).html(data[index].count+'文件&nbsp;&nbsp;'+data[index].collection_count+'关注')

						$('.find_fold_liwrap img',$lis[index]).eq(0).attr('src',gpic_1)
						$('.find_fold_liwrap img',$lis[index]).eq(1).attr('src',gpic_2)
						$('.find_fold_liwrap img',$lis[index]).eq(2).attr('src',gpic_3)

						$('.find_fold_liwrap a',$lis[index]).eq(0).attr('href',glink_1)
						$('.find_fold_liwrap a',$lis[index]).eq(1).attr('href',glink_2)
						$('.find_fold_liwrap a',$lis[index]).eq(2).attr('href',glink_3)
						if(self_id == user_id){
							$('.find_fold_authflw',$lis[index]).html('编辑')
						}else{
							follow = data[index].is_follow==1?'已关注':'<span>+</span>特别关注'
							$('.find_fold_authflw',$lis[index]).html(follow)
						}

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