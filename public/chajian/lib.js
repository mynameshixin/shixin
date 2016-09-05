var select_num=0;
function chageStatus(){
				select_num=$('.item-selected').length;
				if(select_num){
					$('.dtj-multi-noti').css('display','block');
					$('.footer').css('display','block');
					$('.dtj-multi-noti').find('b').text(select_num);
				}else{
					$('.dtj-multi-noti').css('display','none');
					$('.footer').css('display','none');
				}
			}
function fun(ele)
{

	if(	ele.getElementsByTagName("text")[0].innerText=="已选择" )
	{
		ele.className='HUABAN-cell item-hover';
					
		ele.getElementsByTagName("text")[0].innerText="未选择";
		ele.getElementsByTagName("div")[1].style.backgroundPosition="0 0";
		chageStatus()
	}
	else
	{
		if(select_num<5){
		
						ele.className='item-selected HUABAN-cell item-hover';	
						ele.getElementsByTagName("text")[0].innerText="已选择";					
						ele.getElementsByTagName("div")[1].style.backgroundPosition="0 -40px";
						select_num=$('.item-selected').size();
						chageStatus();
					}else{
					
						var _html=$('.dtj-multi-noti').html();
						$('.dtj-multi-noti').html('<p style="color:red">最多只能选择五张图片或者视频</p>');
						setTimeout(function(){
							$('.dtj-multi-noti').html(_html);
						},1000)

					}
	}

	
}
function funClose()
{
	//alert("您已经按下了关闭按钮");
	var widE = document.getElementById("HUABAN_WIDGETS");
	document.body.removeChild(widE);
	//alert("ok");
}

//抓取用户所选择的图片
function plugin(){         
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
             console.log('1')
     		window.open('http://www.duitujia.com/chajian/1.php?user_id='+user_id+'&src='+imgs+'&alt='+alt,'推图家',"top=0,left=0,width=495,height=544") 

            }
      
     },
     
 });
}