
	function readd(ele){   
   
	   $.ajax({
      type:"post",  //提交方式
      dataType:"json", //数据类型
      url:"/Article/se/add", //请求url
        'data':{
          'classfy':$(ele).attr('nema'),
          'c':$(ele).attr('name')
        },
        success:function(json){ //提交成功的回调函数
          var ht='';  
          for(var i=0; i<json.int;i++){
            ht=ht+'<div class="rows"><img style="height:248px" src="'+json[i].eassat_ximg+'"/> <p class="row-info"><span class="time">'+json[i].eassat_title+'</span><span class="time">'+json[i].eassat_date+'</span></p></div>'; 
           
          }

          var _html='<div class="pic-list clearfix">'+ht+'</div>';

           $('.pic-list').append(_html);   
           ele.name=Number(json.c)+10;     
                  
           
        
        },
        });
	}
