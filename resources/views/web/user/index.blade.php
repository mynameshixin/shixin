<!DOCTYPE html>
<html lang="en">
@include('web.common.head')
<body>
	@include('web.common.banner')
	<script type="text/javascript" src="{{asset('web/js/folder/popjs.js')}}"></script>
	<div class="container">
		@include('web.common.user')
		
		<div class="w1248 w1240 clearfix">
			<div class="find_cater perhome_wrap clearfix">
			
				<ul class="find_fold_list clearfix" id="ul0">
				<?php if($user_id==$self_id){ ?>
					<div class="find_fold_li find_fold_fund perhome_add_one">
						<a href="javascript:;" class="perhome_add_btn">+</a>
						<div class="perhome_add_des">创建文件夹</div>
					</div>
				<?php }else{ ?>
						<li class="find_fold_li" style="display: none"></li>
				<?php } ?>
				<?php foreach ($folders as $key => $value) :?>
					<?php if($value['private'] == 0): ?>
					<li class="find_fold_li" folder_id="{{$value['id']}}">
						<div class="find_fold_info clearfix">
							<div class="find_fold_tname">
								<a href="{{url('webd/folder')}}?fid={{$value['id']}}" target="_blank" class="find_fold_name" title="{{$value['name']}}">{{$value['name']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<a href="{{url('webd/folder')}}?fid={{$value['id']}}" target="_blank" class="position" title="{{$value['name']}}"><img src="{{$value['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['name']}}" onload="rect(this)"></a>
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['goods'][0]['id'] or '#'}}" class="position" target="_blank" title="{{$value['goods'][0]['title'] or '堆图家'}}"><img src="{{ $value['goods'][0]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['goods'][0]['title'] or '堆图家'}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['goods'][1]['id'] or '#'}}" class="position" target="_blank" title="{{$value['goods'][1]['title'] or '堆图家'}}"><img src="{{ $value['goods'][1]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['goods'][1]['title'] or '堆图家'}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['goods'][2]['id'] or '#'}}" class="position" target="_blank" title="{{$value['goods'][2]['title'] or '堆图家'}}"><img src="{{ $value['goods'][2]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['goods'][2]['title'] or '堆图家'}}"></a>
							</div>
						</div>
						<a  <?php if($user_id != $self_id){ ?>onclick="relation(this)"<?php }else{ ?>onclick="folderEdit(this)" <?php } ?> class="find_fold_authflw " style="cursor: pointer;">
						<?php 
						if($user_id == $self_id){
							echo "编辑";
						}else{
							echo $value['is_follow']?"已关注":"<span>+</span>特别关注";
						}
						?></a>
					</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>
			<a href="javascript:;" id='more' class="detail_pop_baddmore" private="0">查看更多。。。</a>
			<?php if($user_id == $self_id):?>
			<p class="perhome_addprivate">创建隐私文件夹，只有你自己可以看得见哦</p>
			<div class="find_cater perhome_wrap clearfix">
				<ul class="find_fold_list clearfix" id="ul1" >
					<?php if($user_id==$self_id){ ?>
						<div class="find_fold_li find_fold_fund perhome_add_one perhome_add_fold">
							<a href="javascript:;" class="perhome_add_btn">+</a>
							<div class="perhome_add_des">创建隐私文件夹</div>
						</div>
					<?php }else{ ?>
						<li class="find_fold_li" style="display: none"></li>
					<?php } ?>
					<?php foreach ($folders_private as $key => $value) :?>
					<?php if($value['private'] == 1): ?>
					<li class="find_fold_li" folder_id="{{$value['id']}}" >
						<div class="find_fold_info clearfix">
							<div class="find_fold_tname">
								<a href="{{url('webd/folder')}}?fid={{$value['id']}}" target="_blank" class="find_fold_name" title="{{$value['name']}}">{{$value['name']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<!-- <div class="find_fold_lock"></div> -->
							<div class="find_fold_imgblur"></div>
							<a href="{{url('webd/folder')}}?fid={{$value['id']}}" target="_blank" class="position" title="{{$value['name']}}"><img src="{{$value['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$value['name']}}" onload="rect(this)"></a>
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['goods'][0]['id'] or '#'}}" class="position" target="_blank" title="{{$value['goods'][0]['title'] or '堆图家'}}"><img src="<?php  echo isset($value['goods'][0]['image_url'])?$value['goods'][0]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="{{$value['goods'][0]['title'] or '堆图家'}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['goods'][1]['id'] or '#'}}" class="position" target="_blank" title="{{$value['goods'][1]['title'] or '堆图家'}}"><img src="<?php  echo isset($value['goods'][1]['image_url'])?$value['goods'][1]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="{{$value['goods'][1]['title'] or '堆图家'}}"></a>
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<a href="{{url('webd/pic')}}/{{$value['goods'][2]['id'] or '#'}}" class="position" target="_blank" title="{{$value['goods'][2]['title'] or '堆图家'}}"><img src="<?php  echo isset($value['goods'][2]['image_url'])?$value['goods'][2]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="{{$value['goods'][2]['title'] or '堆图家'}}"></a>
							</div>
						</div>
						<a onclick="folderEdit(this)" class="find_fold_authflw">编辑</a>
					</li>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<a href="javascript:;" id='more1' class="detail_pop_baddmore" private="1">查看更多。。。</a>
		<?php endif; ?>
		</div>
	</div>
		<div class="pop_addfold">
		<div class="pop_con">
			<p class="pop_tit">
				创建文件夹
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">名称</span>
				<input class="pop_iptname" name='fname' value="" placeholder="取一个好名字，让更多人精准地搜到它">
			</div>
			<div class="pop_deswrap clearfix">
				<span class="pop_labelname">描述</span>
				<textarea class="pop_iptdes"  placeholder="关于你的文件夹" ></textarea>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">隐私</span>
				<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr" name="private" private=0>
				<label for="pop_iptpr"></label>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding folder">创建</a>
			</div>
		</div>
	</div>
	<div class="pop_addprivfold">
		<div class="pop_con">
			<p class="pop_tit">
				创建隐私文件夹
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">名称</span>
				<input class="pop_iptname" value="" name='fname' placeholder="取一个好名字，让更多人精准地搜到它">
			</div>
			<div class="pop_deswrap clearfix">
				<span class="pop_labelname">描述</span>
				<textarea class="pop_iptdes"  placeholder="关于你的文件夹"></textarea>
				<!-- <input class="pop_iptname" placeholder="取一个好名字，让更多人精准地搜到它"> -->
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">隐私</span>
				<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr" checked="checkbox" name="private" private=1>
				<label for="pop_iptpr"></label>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding folder">创建</a>
			</div>
		</div>
	</div>
	<div class="pop_editfold">
		<div class="pop_con">
			<p class="pop_tit">
				编辑文件夹
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">名称</span>
				<input class="pop_iptname" placeholder="取一个好名字，让更多人精准地搜到它" value="" name='fname'>
			</div>
			<div class="pop_deswrap clearfix">
				<span class="pop_labelname">描述</span>
				<textarea class="pop_iptdes"  placeholder="关于你的文件夹"></textarea>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">封面</span>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_filechange">更改</a>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">隐私</span>
				<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr3" name="private" private=0>
				<label for="pop_iptpr3"></label>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_delete">删除文件夹</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding folderedit">编辑</a>
			</div>
		</div>
	</div>
	<div class="pop_changefold">
		<div class="pop_con">
			<p class="pop_tit">
				更改文件夹封面
			</p>
			<div class="pop_change_pic clearfix">
			<div class="pop_change_wrap">
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
				<div class="pop_change_imgwrap" style="display: none"><img src="" alt="" class="imgwrap"></div>
			</div>
				<div class="pop_change_imgblur pop_change_imgbleft"></div>
				<div class="pop_change_imgblur pop_change_imgbright"></div>
				<div class="pop_change_imgblurtb pop_change_imgblurt"></div>
				<div class="pop_change_imgblurtb pop_change_imgblurb"></div>
				<a href="javascript:;" class="pop_change_imgbtn pop_change_imgleft"></a>
				<a href="javascript:;" class="pop_change_imgbtn pop_change_imgrigt"></a>
			</div>
			<div class="pop_btnwrap" style="border-top: 1px solid #f1f1f1;">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="avatarsave">保存</a>
			</div>
		</div>
	</div>
</body> 
<script type="text/javascript">
		$(function() {
			/*$(window).scroll(function(event) {
				var scrollHei = $('body').scrollTop();
				if (scrollHei <= 260) {
					$('.perhome_perlike_wrap').css({
						'position':'relative',
						'top':0,
						'border-top':'0px solid #eaeaea'
					});
					$('.perhome_cater_info').hide();
				}else{
					$('.perhome_perlike_wrap').css({
						'position':'fixed',
						'top':48,
						'z-index':10001,
						'border-top':'1px solid #eaeaea'
					});
					$('.perhome_cater_info').show();
				};
			});*/			
			$('.pop_con').click(function(){
				event.stopPropagation();
			})
			$('.pop_editfold,.pop_editfold .pop_close,.pop_editfold .detail_pop_cancel').click(function(){
				$('.pop_editfold').hide()
			})
			//更改封面
			$('.detail_filechange').click(function(){
				foderid = $(this).parents('.pop_con').attr('fid')
				$('.pop_editfold').hide()
				$('.pop_changefold').attr('fid',foderid)
				$.ajax({
					'url':"{{url('api/goods')}}",
					'type':'get',
					'data':{
						'folder_id':foderid,'num':10,'page':1
					},
					'dataType':'json',
					'success':function(json){
						// console.log(json)
						if(json.code==200){
							list = json.data.list
							$f = $('.pop_changefold .pop_change_imgwrap').slice(0,list.length)
							$('.pop_change_imgwrap').css({'display':'none'})
							$('.pop_change_imgwrap img').attr('src','')
							$.each($f,function(index,v){
								$($f[index]).css({'display':'block'})
								if(list[index].images[0]!=undefined) {
									$('.imgwrap',$f[index]).attr('src',list[index].images[0].img_m)
									$('.imgwrap',$f[index]).attr('id',list[index].images[0].image_id)
								}
							})
							$('.pop_changefold').show();
						}
					}
				})
				
			  	var poptopHei = $('.pop_changefold .pop_con').height();
					$('.pop_con').css({
					   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_changefold,.pop_changefold .detail_pop_cancel').click(function(){
				$('.pop_changefold').hide();
			});
			$('.pop_changefold .pop_con').click(function(){
				event.stopPropagation()
			})
			$('.find_fold_fund').click(function(event) {
				if ($(this).hasClass('perhome_add_fold')) {
					$('.pop_addprivfold').css({
						display: 'block'
					});
					var poptopHei = $('.pop_addprivfold .pop_con').height();
					$('.pop_addprivfold .pop_con').css({
					   'margin-top':-(poptopHei/2)
					})
					$('.pop_addfold').css({
						display: 'none'
					});
				}else{
					$('.pop_addfold').css({
						display: 'block'
					});
					var poptopHei = $('.pop_addfold .pop_con').height();
					$('.pop_addfold .pop_con').css({
					   'margin-top':-(poptopHei/2)
					})
					$('.pop_addprivfold').css({
						display: 'none'
					});
				};
			});
			$('.pop_addfold,.pop_addprivfold,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_addfold,.pop_addprivfold').css({
					display:'none'
				})
			})
			$('.pop_iptprivacy').click(function(){
				if($(this).attr('checked') == 'checkbox') return
				if($(this).attr('private') == 1){
					$(this).attr('private',0)
				}else{
					$(this).attr('private',1)
				}
			})
			// 修改文件夹
			$('.folderedit').click(function(){
				pop_con = $(this).parents('.pop_con')
				name = $('input[name=fname]',pop_con).val().trim()
				description = $('textarea',pop_con).val().trim()
				private = $('input[name=private]',pop_con).attr('private')
				if(name=='') {
					layer.msg('信息没有填写完全', {icon: 5});
					return 
				}
				$.ajax({
					'beforeSend':function(){
						layer.load(0, {shade: 0.5});
					},
					'url':"{{url('webd/folder/efolder')}}",
					'type':'post',
					'data':{
						'name':name,
						'description':description,'private':private,
						'fid':pop_con.attr('fid'),'user_id':'<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id'];?>'
					},
					'dataType':'json',
					'success':function(json){
						if(json.code==200){
							layer.msg('修改成功', {icon: 6});
							setTimeout(function(){
								location.reload()
							},2000)
						}else{
							layer.msg(json.message, {icon: 5});
							return
						}
					},
					'complete':function(){
						layer.closeAll('loading');
					}
				})
			})
			//保存封面
			$('#avatarsave').click(function(){
				fid = $(this).parents('.pop_changefold').attr('fid')
				var i;
				left = $('.pop_change_wrap').css('left')
				if(left == 0){
					i = 1;
				}else if(left == '200px'){
					i = 0;
				}else{
					i = Math.abs(parseInt(left))/200+1
				}
				img_id = $('.pop_change_wrap img').eq(i).attr('id')
				$.ajax({
					'beforeSend':function(){
						layer.load(0, {shade: 0.5});
					},
					'url':"{{url('webd/folder/avatar')}}",
					'type':'post',
					'data':{
						'image_id':img_id,
						'fid':fid,
						'user_id':'<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id'];?>'
					},
					'dataType':'json',
					'success':function(json){
						if(json.code==200){
							location.reload()
						}else{
							layer.msg(json.message, {icon: 5});
							return
						}
					},
					'complete':function(){
						layer.closeAll('loading');
					}
				})
				console.log(i)
			})

			//删除文件夹
			$('.detail_pop_delete').click(function(){
				fid = $(this).parents('.pop_con').attr('fid')
				layer.confirm('确定删除该文件夹？', {
				  btn: ['取消','确定'] //按钮
				}, function(index){
					layer.close(index)
				}, function(){
				  $.ajax({
						'beforeSend':function(){
							layer.load(0, {shade: 0.5});
						},
						'url':"{{url('webd/folder/dfolder')}}",
						'type':'post',
						'data':{
							'fid':fid,'user_id':'<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id'];?>'
						},
						'dataType':'json',
						'success':function(json){
							if(json.code==200){
								layer.msg('成功删除',{icon: 6});
								location.reload()
							}else{
								layer.msg(json.message, {icon: 5});
								return
							}
						},
						'complete':function(){
							layer.closeAll('loading');
						}
					})
				});
				
			})
		});
	</script>
<script type="text/javascript">
	postUrl = '{{url("webd/user/folders?oid={$user_id}")}}'
	postData = {'num':10}
</script>

<script type="text/javascript" src="{{asset('web')}}/js/user/folders.js"></script>
</html>