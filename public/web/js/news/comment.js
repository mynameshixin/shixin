   //获取用户信息
    function getCookie(name){
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg))
        return unescape(arr[2]);
        else
        return null;
    }
    //添加评论
    function pingx(ele){
    var user_id=getCookie('user_id');

    //json传递数据    
        $.ajax({
        type:"post",  //提交方式
        dataType:"json", //数据类型
        url:"/Article/pingx", //请求url
        'data':{
            'user_id':user_id,
            'cont':ele,
            'eassat_id':eassat_id
        },
          success:function(json){ //提交成功的回调函数         
           if(json===2){
             alert('请登录后再评论！');
           }
            location.reload();        
          },
        });

    }
    function add_pingx(ele){  //更多评论显示
        //json传递数据    
        $.ajax({
        type:"post",  //提交方式
        dataType:"json", //数据类型
        url:"/Article/selectpingx", //请求url
        'data':{
           'c':ele.name,
           'eassat_id':eassat_id
        },
          success:function(json){ //提交成功的回调函数               
            for (var i = 0; i < json.int; i++) {
               var _html='<li class="clearfix"><div class="detail_pop_authava"><a href="/webd/user?oid='+json[i].comment_user_id+'"><img src="'+json[i].comment_user_src+'" alt=""/></a></div><div class="detail_pop_cominfo"><p class="detail_pop_comname"><a href="/webd/user?oid='+json[i].comment_user_id+'">'+json[i].comment_user_name+'</a>- '+json[i].comment_date+'说：<span class="detail_pop_comshare"><a href="javascript:;" class="detail_pop_share1"></a><a href="javascript:;" class="detail_pop_share2"  neme="'+json[i].comment_id+'" name="'+json[i].comment_user_id+'" onclick="comment_delete(this)"></a><a href="javascript:;" class="detail_pop_share3"></a></span></p><p class="detail_pop_comcon">'+json[i].comment_cont+'</p></div><div class="detail_pop_favor" name="'+json[i].comment_id+'" onclick="add_int(this)">'+json[i].comment_int+'</div></li>';
               $('.detail_pop_tlcomlist').append(_html);     
            };         
            ele.name=Number(json.c)+10;        
                 //$('.add_pingx').append(_html);    
          },
        });
    }
    function add_int(ele){ //点赞
        var user_id=getCookie('user_id');
        var a=$(ele).attr('name');   
        if(user_id){
             $.ajax({
            type:"post",  //提交方式
            dataType:"json", //数据类型
            url:"/Article/comment/action", //请求url
            'data':{
               'eassat_comment_id':a,
               'user_id':user_id
            },
              success:function(json){ //提交成功的回调函数
                switch (json)
                {
                case 1:
                  $(ele).attr('class', 'detail_pop_favorr'); 
                  break;  
                case 2:
                  alert('您已顶过') ;
                  $(ele).attr('class', 'detail_pop_favorr');
                  break;
                default:
                  alert('服务器繁忙');
                }  
              },
            });
        }else{
            alert('请先登录！');
        }
    }
    function comment_delete(ele){
          $.ajax({
            type:"get",  //提交方式
            dataType:"json", //数据类型
            url:"/Article/comment/de", //请求url
            'data':{
                 'user':$(ele).attr('name'),
                 'comment_id':$(ele).attr('neme')        
            },
              success:function(json){ //提交成功的回调函数
                switch (json)
                {
                case 1:
                  alert('删除成功，感谢您的关注');  
                   location.reload(); 
                  break;  
                case 2:
                  alert('只能删除本人的评论！亲') ;
                  break;
                case 3:
                  alert('请先登录！亲') ;   
                  break;
                default:
                  alert('服务器繁忙');
                }  
              },
            });
    }
