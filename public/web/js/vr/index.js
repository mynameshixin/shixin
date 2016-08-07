$(function (){
  /**
   * When scrolled all the way to the bottom, add more tiles
   */
  $window = $(window)
  $document = $(document)
  $page = 1
  
  function onMore() {
  		postData.page = ++$page
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
		  		ul = '#ul'
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			data = json.data.list
		  			var lis = ''
					$.each(data,function(index,v){
						var cityname = data[index].cityname!=undefined?data[index].cityname:'未知地区'
						var countryname = data[index].countryname!=undefined?data[index].countryname:''
						var viewcount = data[index].viewcount!=undefined?data[index].viewcount:0
						lis += '<li class="vr_home_list">'
							+'<div class="vr_content">'
								+'<a class="index_item_vrlogo" href="'+data[index].detail_url+'" target="_blank"></a>'
								+'<span>'+data[index].title+'</span>'
								+'<img src="'+data[index].images[0].img_m+'" onload="rect(this)"/>'
							+'</div>'
							+'<div class="vr_title">'
								+'<span class="vr_home_loc">'+cityname+' '+countryname+'</span>'
								+'<span class="vr_like">'+data[index].praise_count+'</span>'
								+'<span class="vr_view">'+viewcount+'</span>'
							+'</div>'
						+'</li>'
					})
					
					$(ul).append(lis)
					obj.html('查看更多。。。')
					
		  		}else{
		  			obj.html('没有更多。。。')
		  		}

		  	}
		  })      
    }


  // Capture scroll event.
  $('#des_more').bind('click', onMore);
});