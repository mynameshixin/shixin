<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
	<script type="text/javascript">
		defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
		self_id = "{{$self_id}}"
		user_id = "<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"
		relationUrl = "{{url('webd/user/relation')}}"
		keyword = "{{$keyword}}"
	</script>
	<script src="{{url('web/js/user/relation.js')}}"></script>
	@include('web.common.banner')
	<div class="container">
		<div class="w1248 clearfix" id="main" role='main'>
			@include('web.common.search.menu')
			<div class="find_cater_container">
				<div class="find_cater clearfix" id='tiles'>
					<ul class="find_fold_list clearfix">
					</ul>
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
			'url':"/webd/search/user",
			'type':'post',
			'data':{
				'keyword':keyword,
				'page':1,
				'user_id':user_id
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200 && json.data.list!=0 && json.data.list!=null){
					data = json.data.list
					var str = ''
					$.each(data,function(index,v){
						gpic_1 = data[index].folders[0].img_url
						gpic_2 = data[index].folders[1].img_url
						gpic_3 = data[index].folders[2].img_url
						gpic_4 = data[index].folders[3].img_url

						glink_1 = data[index].folders[0].id
						glink_2 = data[index].folders[1].id
						glink_3 = data[index].folders[2].id
						glink_4 = data[index].folders[3].id
						gname_1 = data[index].folders[0].name!=undefined?data[index].folders[0].name:'堆图家'
						gname_2 = data[index].folders[1].name!=undefined?data[index].folders[1].name:'堆图家'
						gname_3 = data[index].folders[2].name!=undefined?data[index].folders[2].name:'堆图家'
						gname_4 = data[index].folders[3].name!=undefined?data[index].folders[3].name:'堆图家'
						nick = v.nick!=''?v.nick:v.username
						pic_m = v.auth_avatar!=null?v.auth_avatar:v.pic_m
						mrightzero = (parseInt(index)+1)%5==0?'mrightzero':''
						// follow = ''
						switch(v.relation){
							case 1:
								follow = '相互关注'
								break;
							case 2:
								follow = '已关注'
								break;
							default:
								follow = '<span>+</span>关注'
								break;
						}
						str += '<li class="find_user_li '+mrightzero+'" user_id='+v.id+'>'
									+'<div class="find_user_info">'
										+'<a href="/webd/user?oid='+v.id+'" class="find_user_name" target="_blank" title="'+nick+'">'+nick+'</a>'
										+'<a href="/webd/user?oid='+v.id+'" class="find_user_rela" target="_blank">'+v.count.fans_count+'粉丝 '+v.count.follow_count+'关注</a>'
									+'</div>'
									+'<div class="find_user_con clearfix">'
										+'<div class="find_user_img">'
											+'<div class="find_user_blur"></div>'
											+'<a href="/webd/user?oid='+v.id+'" class="position" target="_blank" title="'+nick+'"><img src="'+pic_m+'" alt="'+nick+'"></a>'
										+'</div>'
										+'<ul class="find_user_limg">'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_1+'" class="position" target="_blank" title="'+gname_1+'"><img src="'+gpic_1+'" alt="'+gname_1+'"></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_2+'" class="position" target="_blank" title="'+gname_2+'"><img src="'+gpic_2+'" alt="'+gname_2+'"></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_3+'" class="position" target="_blank" title="'+gname_3+'"><img src="'+gpic_3+'" alt="'+gname_3+'"></a>'
											+'</li>'
											+'<li>'
												+'<div class="find_user_blur"></div>'
												+'<a href="/webd/folder?fid='+glink_4+'" class="position" target="_blank" title="'+gname_4+'"><img src="'+gpic_4+'" alt="'+gname_4+'"></a>'
											+'</li>'
										+'</ul>'
										if(v.id!=self_id){
											str+='<a onclick="relation(this)" class="find_user_authflw" style="cursor: pointer">'+follow+'</a>'
										}
									str+='</div>'
								+'</li>'

					})
					$('.find_cater').find('.find_fold_list').append(str)
				}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
	    })
	    $('.find_cater').show()
	});
</script>
<script src="{{url('web/js/search/user.js')}}"></script>
</html>