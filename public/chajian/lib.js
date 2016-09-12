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

//弹出新创口
       /** 
      * 以POST表单方式打开新窗口的JQUERY实现 
      @param:url 需要打开的URL 
      @param:args URL的参数，数据类型为object 
      @param:name 打开URL窗口的名字，如果同一按钮需要重复地打开新窗口， 
      而不是在第一次打开的窗口做刷新，此参数应每次不同 
      @param:windowParam 新打开窗口的参数配置 
      * @author: haijiang.mo 
      */ 
      var windowDefaultConfig = new Object; 
      windowDefaultConfig['directories'] = 'no'; 
      windowDefaultConfig['location'] = 'no'; 
      windowDefaultConfig['menubar'] = 'no'; 
      windowDefaultConfig['resizable'] = 'no'; 
      windowDefaultConfig['scrollbars'] = 'no'; 
      windowDefaultConfig['status'] = 'no'; 
      windowDefaultConfig['toolbar'] = 'no'; 
     
      function jQueryOpenPostWindow(url,args,name,windowParam){ 
     
      //创建表单对象 
      var _form = $("<form></form>",{ 
      'id':'tempForm',  
      'method':'post', 
      'action':url, 
      'target':name, 
      'style':'display:none' 
      }).appendTo($("body")); 
       
      //将隐藏域加入表单 
      for(var i in args){ 
      _form.append($("<input>",{'type':'hidden','name':i,'value':args[i]})); 
      } 
       
      //克隆窗口参数对象 
      var windowConfig = windowDefaultConfig; 
       
      //配置窗口 
      for(var i in windowParam){ 
      windowConfig[i] = windowParam[i]; 
      } 
       
      //窗口配置字符串 
      var windowConfigStr = ""; 
       
      for(var i in windowConfig){ 
      windowConfigStr += i+"="+windowConfig[i]+","; 
      } 
       
      //绑定提交触发事件 
      _form.bind('submit',function(){ 
      window.open("about:blank",name,windowConfigStr); 
      }); 
       
      //触发提交事件 
      _form.trigger("submit"); 
      //表单删除 
      _form.remove(); 
      } 







function fun(ele)
{
  var pop= ele.getElementsByTagName("text")[0].innerText;
	if(	ele.getElementsByTagName("text")[0].innerText=="已选择"	 )
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
         var texts='';


     		 numm=$('.item-selected').find("img");
         text=$('.item-selected').find("text");
         //alert(text[1].innerText);
     		 for (var i =  0; i < numm.length ; i++) {
     		 	imgs=numm[i].src+","+imgs;
                alt=numm[i].title+","+alt;
                texts=text[i+1+i].innerText+","+texts;
               
     		 };
          
     		 jQueryOpenPostWindow('http://www.duitujia.com/chajian/deposit.php',{"user_id":user_id,"src":imgs,'alt':alt,'text':texts},'推图家',windowDefaultConfig) 
	   
				 
     	}else{
             user_id=jsonp.data.user_id;
     		 imgs='';
     		  numm=$('.item-selected').find("img");
           text=$('.item-selected').find("text");
             alt='';
             texts=''
     		 for (var i =  0; i < numm.length ; i++) {
     		 	imgs=numm[i].src+","+imgs;
                alt=numm[i].title+","+alt;
                 texts=text[i+1+i].innerText+","+texts;  
     		 };
             console.log('1')
     		 jQueryOpenPostWindow('http://www.duitujia.com/chajian/1.php',{"user_id":user_id,"src":imgs,'alt':alt,'text':texts},'推图家',windowDefaultConfig) 
           // window.open('http://www.duitujia.com/chajian/1.php?user_id='+user_id+"&src="+imgs+'&alt='+alt+'&tex=t'+texts,'推图家',windowDefaultConfig)
            }
      
     },
     
 });
}