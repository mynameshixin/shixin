<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家搜索'])
<body>
	<script type="text/javascript">
		defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
		self_id = "{{$self_id}}"
		relationUrl = "{{url('webd/user/relation')}}"
		keyword = "{{$keyword}}"
		kinds = "<?php 
				if($type==1){
					echo 2;
				}elseif($type==3){
					echo 1;
				}?>"
	</script>
	<script src="{{url('web/js/user/relation.js')}}"></script>
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/waterfall/handlebars.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/waterfall/jquery.easing.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/waterfall/waterfall.min.js"></script>
	<div class="container">
		<div class="w1248 clearfix">
			@include('web.common.search.menu')
			<div class="find_cater_container" >
				<div class="find_cater clearfix">
					<div class="index_con" id="index_con">
						
					</div>
				</div>

			</div>
			
			
		</div>
	</div>
	<!-- <a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a> -->
</body>
<script type="text/x-handlebars-template" id="waterfall-tpl">
{{#data.list}}
    <div class="index_item">
		<div class="index_item_wrap">
			<div class="index_item_imgwrap clearfix">
				<a class="index_item_blurwrap" href="/webd/pic/'+v.id+'" target="_blank"></a>
				<img src="'+v.image_url+'">
				<div class="index_item_price">v.price</div>
			</div>
			<div class="index_item_info">
				<div class="index_item_top">
					<div class="index_item_intro" title="'+des+'">des</div>
					<div class="index_item_rel clearfix" good_id="'+v.id+'">
						<a  class="index_item_l" onclick="praise(this,1)">v.praise_count</a>
						<a  class="index_item_c" onclick="collect(this)">v.collection_count</a>
						<a href="v.detail_url" class="index_item_b" target="_blank"></a>
						<a href="javascript:;" class="index_item_d" onclick="praise(this,2)">v.boo_count</a>	
					</div>
				</div>
				<div class="index_item_bottom clearfix">
						<a href="/webd/user?oid='+v.cuser.id+'" class="index_item_authava" target="_blank">
							<img src="'+userpic+'" alt="">
						</a>
						<div class="index_item_authinfo">
							<a href="/webd/user?oid='+v.cuser.id+'" target="_blank" class="index_item_authname">nick</a>
							<span class="index_item_authto">采集到</span>
							<p class="index_item_authtopart"><a href="/webd/folder?fid='+v.cfolder.id+'" target="_blank">v.cfolder.name</a></p>
						</div>
				</div>
				<div class="index_item_bottom clearfix">'
						<a href="/webd/user?oid='+v.comment[$id].user.id+'" class="index_item_authava" target="_blank">
							<img src="'+userpic+'" alt="">
						</a>
						<div class="index_item_authinfo index_item_authtalk">
							<a href="/webd/user?oid='+v.comment[$id].user.id+'" class="index_item_talkname" target="_blank">'+nick+'：</a>
							<span class="index_item_authto">'+v.comment[$id].content+'</span>
						</div>
				</div>
			</div>
		</div>
	</div>
{{/data.list}}
</script>
<script>
$('#index_con').waterfall({
    itemCls: 'index_item',
    colWidth: 222,
    gutterWidth: 15,
    gutterHeight: 15,
    checkImagesLoaded: false,
    isAnimated: true,
    animationOptions: {
    },
    path: function(page) {
        return '/webd/search/goods?page=' + page+'&keyword='+keyword+'&kind='+kinds;
    }
});
</script>
<script type="text/javascript">
		/*function floatFun(){
			var $container = $('.index_con');
		    $container.imagesLoaded(function() {
		        $container.masonry({
	                itemSelector: '.index_item',
	                gutter: 15,
	                isAnimated: true,
	            });
	            
		     });
		}


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
				'kind':kinds
			},
			'dataType':'json',
			'success':function(json){

				if(json.code==200 && json.data.list!=0 && json.data.list!=null){
					data = json.data.list
					var str = ''
					$.each(data,function(index,v){
						des = v.description.trim() != ''?v.description:v.title
						kind = v.kind
						str += '<div class="index_item">'
							+'<div class="index_item_wrap">'
								+'<div class="index_item_imgwrap clearfix">'
									+'<a class="index_item_blurwrap" href="/webd/pic/'+v.id+'" target="_blank"></a>'
									+'<img src="'+v.image_url+'">'
									if(kind==1){
										str += '<div class="index_item_price">'+v.price+'</div>'
									}
								str +='</div>'
								+'<div class="index_item_info">'
									+'<div class="index_item_top">'
										+'<div class="index_item_intro" title="'+des+'">'+des+'</div>'
										+'<div class="index_item_rel clearfix" good_id="'+v.id+'">'
											+'<a  class="index_item_l" onclick="praise(this,1)">'+v.praise_count+'</a>'
											+'<a  class="index_item_c" onclick="collect(this)">'+v.collection_count+'</a>'
										if(kind==1){
											str +='<a href="'+v.detail_url+'" class="index_item_b" target="_blank"></a>'
										}else if(kind==2){
											str +='<a href="javascript:;" class="index_item_d" onclick="praise(this,2)">'+v.boo_count+'</a>'
										}		
									str +='</div>'
									+'</div>'

									if(v.cfolder!=0 && v.cuser!=0){
										userpic = v.cuser.auth_avatar!=null?v.cuser.auth_avatar:v.cuser.pic_m
										nick = v.cuser.nick!=''?v.cuser.nick:v.cuser.username
										str+='<div class="index_item_bottom clearfix">'
											+'<a href="/webd/user?oid='+v.cuser.id+'" class="index_item_authava" target="_blank">'
												+'<img src="'+userpic+'" alt="">'
											+'</a>'
											+'<div class="index_item_authinfo">'
												+'<a href="/webd/user?oid='+v.cuser.id+'" target="_blank" class="index_item_authname">'+nick+'</a>'
												+'<span class="index_item_authto">采集到</span>'
												+'<p class="index_item_authtopart"><a href="/webd/folder?fid='+v.cfolder.id+'" target="_blank">'+v.cfolder.name+'</a></p>'
											+'</div>'
										+'</div>'
									}

									if(v.comment!=0 && v.comment!=null){
										$id = v.id
										userpic = v.comment[$id].user.auth_avatar!=null?v.comment[$id].user.auth_avatar:v.comment[$id].user.pic_m
										nick = v.comment[$id].user.nick!=''?v.comment[$id].user.nick:v.comment[$id].user.username
										str+='<div class="index_item_bottom clearfix">'
											+'<a href="/webd/user?oid='+v.comment[$id].user.id+'" class="index_item_authava" target="_blank">'
												+'<img src="'+userpic+'" alt="">'
											+'</a>'
											+'<div class="index_item_authinfo index_item_authtalk">'
												+'<a href="/webd/user?oid='+v.comment[$id].user.id+'" class="index_item_talkname" target="_blank">'+nick+'：</a>'
												+'<span class="index_item_authto">'+v.comment[$id].content+'</span>'
											+'</div>'
										+'</div>'
									}
								str+='</div>'
							+'</div>'
						+'</div>'
						 
					})
					$('.find_cater').find('.index_con').append(str)
					floatFun()
				}
			},
			'complete':function(){
				layer.closeAll('loading');
			}
	    })
	    $('.find_cater').show()*/
</script>
</html>