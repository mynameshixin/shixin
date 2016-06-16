<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家搜索'])
<body>
	<script type="text/javascript">
		defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
		self_id = "{{$self_id}}"
		relationUrl = "{{url('webd/user/relation')}}"
		keyword = "{{$keyword}}"
	</script>
	<script src="{{url('web/js/user/relation.js')}}"></script>
	@include('web.common.banner')
	<div class="container">
		<div class="w1248 clearfix" id="main" role='main'>
			@include('web.common.search.menu')
			<div class="find_cater_container">
				<div class="find_cater clearfix">
					<div class="index_con" id='tiles'>
						
					</div>
				</div>

			</div>
			
			
		</div>
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>
<script type="text/javascript">
	$(function() { 
	    $('.find_cater').hide()
	    $.ajax({
	    	'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/search/goods",
			'type':'post',
			'data':{
				'keyword':keyword,
				'page':1,
				'kind':"<?php 
				if($type==2){
					echo 2;
				}elseif($type==3){
					echo 1;
				}?>"
			},
			'dataType':'json',
			'success':function(json){
				console.log(json)
				return
				if(json.code==200 && json.data.list!=0 && json.data.list!=null){
					data = json.data.list
					var str = ''
					$.each(data,function(index,v){
						gpic_1 = data[index].goods[0] != undefined?data[index].goods[0].image_url:defaultPic
						gpic_2 = data[index].goods[1] != undefined?data[index].goods[1].image_url:defaultPic
						gpic_3 = data[index].goods[2] != undefined?data[index].goods[2].image_url:defaultPic
						mrightzero = (parseInt(index)+1)%5==0?'mrightzero':''
						follow = v.is_follow==1?'已关注':'<span>+</span>关注'
						glink_1 = data[index].goods[0] != undefined?'/webd/pic/'+data[index].goods[0].id:'#'
						glink_2 = data[index].goods[1] != undefined?'/webd/pic/'+data[index].goods[1].id:'#'
						glink_3 = data[index].goods[2] != undefined?'/webd/pic/'+data[index].goods[2].id:'#'
						nick = v.user.nick!=''?v.user.nick:v.user.username
						pic_m = v.user.auth_avatar!=null?v.user.auth_avatar:v.user.pic_m


						str += '<div class="index_item">'
							+'<div class="index_item_wrap">'
								+'<div class="index_item_imgwrap clearfix">'
									+'<a class="index_item_blurwrap"></a>'
									+'<img src="public/images/temp/2.png">'
								+'</div>'
								+'<div class="index_item_info">'
									+'<div class="index_item_top">'
										+'<div class="index_item_intro" title="简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新">简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新简洁实用的衣柜，方便区分，不用每天掏柜子了，打开小小清新</div>'
										+'<div class="index_item_rel clearfix">'
											+'<a href="javascript:;" class="index_item_l">82</a>'
											+'<a href="javascript:;" class="index_item_c">90</a>'
											+'<a href="javascript:;" class="index_item_d"></a>'
										+'</div>'
									+'</div>'
									+'<div class="index_item_bottom clearfix">'
										+'<a href="javascript:;" class="index_item_authava" target="_blank">'
											+'<img src="public/images/temp_avatar.JPG" alt="">'
										+'</a>'
										+'<div class="index_item_authinfo">'
											+'<a href="javascript:;" class="index_item_authname">叶子</a>'
											+'<span class="index_item_authto">采集到</span>'
											+'<p class="index_item_authtopart">搭配</p>'
										+'</div>'
									+'</div>'
								+'</div>'
							+'</div>'
						+'</div>'
						 
					})
					$('.find_cater').eq(0).append(str)
				}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
	    })
	    //$('.find_cater').eq(0).show()
	});
</script>
<script src="{{url('web/js/search/index.js')}}"></script>
</html>