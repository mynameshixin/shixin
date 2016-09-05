
$(function() {
      //读取COOKIE
      function getCookie(name)
        {
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg)){
        	 return unescape(arr[2]);
        }else{return null;}
        
        }
	//模拟采集成功效果
	$('.pop_close').click(function(){
		$('.sunccess').show();
	  	$('.sunccess').fadeOut(5000);
	})
			
});


