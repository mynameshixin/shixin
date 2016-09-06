<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?d395e3863da8722a0eba22f2bc629b6a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<div class="header">
		<div class="headercontainer w1248 clearfix">
			<a href="/" class="header_logo"></a>
			<a href="{{url('webd/home')}}" class="header_item">商品</a>
			<a href="{{url('webd/pics')}}" class="header_item">图集</a>
			<a href="{{url('webd/find')}}" class="header_item">发现</a>
			<a href="{{url('webd/app')}}" class="header_item">APP</a>
			<div href="javascript:;" class="header_add_btn">
				+
				<div class="header_add_item">
					@include('web.common.banner.action')
				</div>
			</div>
			<form action="/webd/search/goods" method="get" name='search'>
				<input type="text" class="header_search" value="{{$keyword or ''}}" name="keyword" placeholder="搜索你喜欢的" <?php if(empty($self_id)){?>style="width: 565px;"<?php } ?>>
			</form>
			<script type="text/javascript">
				$('.header_search').keydown(function(e){
					if(e.keyCode==13){
						$('form[name=search]').submit()
					}
				})
			</script>
			<div href="javascript:;" class="header_mess">
				<!-- <i class="icon-bell-alt"></i> -->
				<div class="header_moremess" >
					<div class="header_add_up"></div>
					<div class="header_add_clickbtn clearfix">
						<a href="javascript:;" class="header_add_clicka header_add_clicka_on" id="notice" style="border-radius: 6px 0px 0px 0px">通知</a>
						<a href="javascript:;" class="header_add_clicka" id="news" style="border: none;border-radius:0px 6px 0px 0px">消息</a>
					</div>
					<div class="header_add_con" style="height: 360px;overflow-y: scroll;" id="n1">
						<ul class="header_add_cul"></ul>
					</div>
					<div class="header_add_con" style="height: 360px;overflow-y: scroll;" id="n2">
						<ul class="header_add_cul"></ul>
					</div>
					<!-- <a href="javascript:;" class="header_add_more">查看更多</a> -->
				</div>
			</div>
			@include('web.common.banner.my')

		</div>
</div>

<script type="text/javascript">
	$.ajax({
		'url':"{{url('webd/notice/check')}}",
		'type':'post',
		'data':{
			'user_id':u_id,
			'num':10
		},
		'dataType':'json',
		'success':function(json){
			if(json.code==1001){
				$('.header_mess').css({'background-position-y':'-1075px'})
				return false			
			}
		},
	})
</script>
<script type="text/javascript">
function sendMess(){
    $('#send_new_message').click(function(){
      var sendtextArea = $('.letter_textarea textarea').val().trim();
      var to_id = $(this).attr('to_id')
      var pic_m = $(this).attr('pic_m')
      if (sendtextArea == "") {
        $('textarea[name=message]').focus()
      }else{
        $.ajax({
          'beforeSend':function(){
            $('#send_new_message').html('发送中')
          },
          'url':"/webd/notice/messages",
          'type':'post',
          'data':{
            'user_id':u_id,
            'content':sendtextArea,
            'to_id':to_id
          },
          'dataType':'json',
          'success':function(json){
            if(json.code==200){
              var messHtml = '<li class="clearfix letter_ulright">\
              <span class="letter_rel">'+sendtextArea+'</span>\
              <div class="letter_avawrap">\
                <img src="'+pic_m+'" alt="">\
              </div>\
            </li>';
             if($('#letter_content .letter_ul').length!=0){
             	$('#letter_content .letter_ul:last').append(messHtml)
             }else{
             	var ul = '<ul class="letter_ul">'+messHtml+'</ul>'
             	$('#letter_content').append(ul)
             }
            
            $('#letter_content').animate({ scrollTop: 10000}, 800);
            $('.letter_textarea textarea').val("")
            }else{
              layer.msg(json.message, {icon: 5});
              return
            }
          },
          'complete':function(){
            $('#send_new_message').html('发送留言')
          }
        })
        
      };
    })
  }
// 私信弹窗
function getMessage(obj){
	$('.pop_letter').show();
	var to_id = $(obj).attr('to_id')
	$.ajax({
		'beforeSend':function(){
			layer.load(0, {shade: 0.5});
		},
		'url':"{{url('webd/notice/msginner')}}",
		'type':'post',
		'data':{
			'user_id':u_id,
			'to_id':to_id,
		},
		'dataType':'json',
		'success':function(json){
			$('#letter_content').html('')
			if(json.code==200 && json.data!=undefined){
				var contents = ''
				$.each(json.data,function(i,v){
					contents += '<div class="letter_time">'+v.min+'</div>\
						<ul class="letter_ul">'
						$.each(v.adata,function(k,val){
							var pic_m = val.user.auth_avatar!=null?val.user.auth_avatar:val.user.pic_m
							var nick = val.user.nick!=''?val.user.nick:val.user.username
							var uid = val.user.id
							var position = val.position
							contents += '<li class="clearfix '+position+'">\
								<div class="letter_avawrap">\
									<a href="/webd/user?oid='+uid+'" target="_blank"><img src="'+pic_m+'" alt=""></a>\
								</div>\
								<span class="letter_rel">\
									'+val.content+'\
								</span>\
							</li>'
						})
						
					contents += '</ul>'
				})
				$('#letter_content').append(contents)
			}
		},
		'complete':function(){
			layer.closeAll('loading');
		}
	})

	$('#letter_content').animate({ scrollTop: 10000}, 800);
	$('#send_new_message').attr('to_id',to_id)
	var poptopHei = $('.pop_letter .pop_con').height();
	$('.pop_con').css({
		'margin-top':-(poptopHei/2)
	})
	sendMess()
} 

function common_notice(){
	$.ajax({
		'beforeSend':function(){
			layer.load(0, {shade: 0.5});
		},
		'url':"{{url('webd/notice/index')}}",
		'type':'post',
		'data':{
			'user_id':u_id,
			'num':50,
			'editstatus':1
		},
		'dataType':'json',
		'success':function(json){
			if(json.code==200){
				var lis = ''
				$.each(json.data.list,function(index,v){
					var pic_m = v.user.auth_avatar!=null?v.user.auth_avatar:v.user.pic_m
					var nick = v.user.nick!=''?v.user.nick:v.user.username
					var uid = v.user.id
					lis += '<li class="clearfix">'
						+'<div class="header_add_mava_wrap">'
							+'<a href="/webd/user?oid='+uid+'" target="_blank"><img src="'+pic_m+'" alt=""></a>'
						+'</div>'
						+'<div class="header_add_font_wrap">'
							+'<p class="header_add_font_a">'+nick+' - <span>'+v.min+'前</span></p>'
							+'<p class="header_add_font_a">'+v.msg_content+'</p>'
						+'</div>'
					+'</li>'
				})
				$('#n2').hide()
				$('#n1').find('ul').html(lis)
				$('#n1').show()
				
			}
		},
		'complete':function(){
			layer.closeAll('loading');
		}
	})
}
function common_message(){
	$.ajax({
		'beforeSend':function(){
			layer.load(0, {shade: 0.5});
		},
		'url':"{{url('webd/notice/msg')}}",
		'type':'post',
		'data':{
			'user_id':u_id,
			'num':50,
		},
		'dataType':'json',
		'success':function(json){
			if(json.code==200 && json.data!=undefined){
				var lis = ''
				$.each(json.data,function(index,v){
					var pic_m = v.user.auth_avatar!=null?v.user.auth_avatar:v.user.pic_m
					var nick = v.user.nick!=''?v.user.nick:v.user.username
					var uid = v.user.id
					lis += '<li class="clearfix" onclick="getMessage(this)" to_id='+uid+'>'
						+'<div class="header_add_mava_wrap">'
							+'<a href="/webd/user?oid='+uid+'" target="_blank"><img src="'+pic_m+'" alt=""></a>'
						+'</div>'
						+'<div class="header_add_font_wrap">'
							+'<p class="header_add_font_a">'+nick+' - <span>'+v.min+'前</span></p>'
							+'<p class="header_add_font_a">'+v.content.substring(0,22)+'</p>'
						+'</div>'
					+'</li>'
				})
				$('#n1').hide()
				$('#n2').find('ul').html(lis)
				$('#n2').show()
				
			}
		},
		'complete':function(){
			layer.closeAll('loading');
		}
	})
}

	// 消息
	$('#news').click(function(){
		$('#n1').hide();
		if($('#n2').find('ul').html()==''){
			common_message()
		}
		$('#n2').show()
	})
	// 通知
	$('.header_mess').click(function(){
		$(this).css({'background-position-y':'-906px'})
		if($('.header_moremess').css('display') == 'block'){
			//$('.header_moremess').find('ul').html('')
			$('.header_moremess').css("display","none")
		}else{
			common_notice()
			$('.header_moremess').css("display","block")
		}
	})
	$('#notice').click(function(){
		$('#n2').hide()
		$('#n1').show()
	})
	$('.header_moremess').click(function(){
		event.stopPropagation();
	})
</script>
@include('web.common.login')
@include('web.common.daction')

<a href="javascript:;" class="back_to_top">^</a>
<script type="text/javascript">
	$(function(){
		$('.back_to_top').click(function(){
			$("html,body").animate({scrollTop: 0},600);
		})
	})
</script>