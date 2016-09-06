
$(function() {
      //读取COOKIE
      function getCookie(name)
        {
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg)){
        	 return unescape(arr[2]);
        }
       
        else{return null;}
        
        }


			//抓取用户所选择的图片
		$('.dtj-confirm').click(function(){         
			$.ajax({         
             url: "http://www.duitujia.com/webd/plugin",
             dataType: "jsonp",
             data:{},
             jsonp:'callback', 
         	 type:'get',
             success: function(jsonp){
             	//判断登录状态
             	if(jsonp.data.user_id){
             		 var user_id=jsonp.data.user_id;
             		 var imgs='';
                      var alt='';

             		 numm=$('.item-selected').find("img");
             		 for (var i =  0; i < numm.length ; i++) {
             		 	imgs=numm[i].src+","+imgs;
                        alt=numm[i].title+","+alt;
             		 };
             		 window.open('http://www.duitujia.com/chajian/deposit.php?user_id='+user_id+'&src='+imgs+'&alt='+alt,'推图家',"top=0,left=0,width=655,height=475") 
			   
        				 
             	}else{
                     user_id=jsonp.data.user_id;
             		 imgs='';
             		  numm=$('.item-selected').find("img");
                     alt='';
             		 for (var i =  0; i < numm.length ; i++) {
             		 	imgs=numm[i].src+","+imgs;
                        alt=numm[i].title+","+alt;
             		 };

             		window.open('http://www.duitujia.com/chajian/1.php?user_id='+user_id+'&src='+imgs+'&alt='+alt,'推图家',"top=0,left=0,width=495,height=544") 
       
                    }

      		
              
             },
             
         });

				
				
	})
			//模拟采集成功效果
			$('.pop_close').click(function(){
				$('.sunccess').show();
			  	$('.sunccess').fadeOut(5000);
			})
			
		});


