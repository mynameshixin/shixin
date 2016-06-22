<script type="text/javascript">
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	user_id = "{{$user_id}}"
	self_id = "{{$self_id}}"
	relationUrl = "{{url('webd/user/relation')}}"
	fid = "{{$folder['id']}}"
	function addSe(obj){
		if ($(obj).hasClass('detail_raido_wrapred')) {
			$(obj).removeClass('detail_raido_wrapred').addClass('detail_raido_wrap');
		}else{
			$(obj).removeClass('detail_raido_wrap').addClass('detail_raido_wrapred');
		};
	}
</script>
<script src="{{url('web/js/user/relation.js')}}"></script>
<div class="perhome_per_wrap">
			<div class="w1248 w1240 clearfix">
				<div class="detail_perinfo_wrap clearfix">
					<div class="perhome_perinfo clearfix">
						<div class="detail_filetit_wrap">
							<div class="detail_filetit">
								{{$folder['name']}}
							</div>
							<!-- <p class="detail_filedes">{{!empty($folder['user_info']['nick'])?$folder['user_info']['nick']:$folder['user_info']['username']}}</p> -->
							<p class="detail_filedes">{{$folder['description']}}</p>
						</div>
						<div class="detail_fileinfo">
							<div class="detail_fileuser">
								<div class="detail_fuava">
									<a href="/webd/user?oid={{$folder['user_id']}}" target="_blank"><img src="{{!empty($folder['user_info']['auth_avatar'])?$folder['user_info']['auth_avatar']:$folder['user_info']['pic_m']}}" alt=""></a>
								</div>
								<p class="detail_funame">{{!empty($folder['user_info']['nick'])?$folder['user_info']['nick']:$folder['user_info']['username']}}</p>
							</div>
							<div class="perhome_perlike_wrap clearfix">
								<a href="{{url('webd/folder')}}?fid={{$folder['id']}}" class="perhome_perlike_label <?php echo $type==1?'perhome_perlike_lon':''; ?>">
									<p class="perhome_perlike_num">{{$folder['file_count'] or  $folder['count']}}</p>
									<p class="perhome_perlike_la">文件</p>
								</a>
								<a href="{{url('webd/folder/fans')}}?fid={{$folder['id']}}" class="perhome_perlike_label <?php echo $type==2?'perhome_perlike_lon':''; ?>">
									<p class="perhome_perlike_num">{{$folder['fans_count']}}</p>
									<p class="perhome_perlike_la">关注</p>
								</a>
							</div>
							<div class="detail_filebtn_wrap clearfix">
								<?php if(isset($_GET['o']) && $_GET['o']==1): ?><a class="detail_filebtn detail_fileball" style="color: #969696" href="/webd/folder?fid={{$folder['id']}}">查看全部</a><?php endif; ?>
								<?php if($type==1 && !isset($_GET['o'])): ?><a class="detail_filebtn detail_filebtn_cpadding" style="color: #fff" href="/webd/folder?fid={{$folder['id']}}&o=1">只看商品</a><?php endif; ?>
								<div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										分享
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select slideup">
										<div class="detail_fileb_selectw">
											<span class="jiathis_style_32x32" id="own_share">
												<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
												<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
											</span>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div>
								<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
								<!-- JiaThis Button END -->
								<?php if($folder['user_id']!=$self_id){ ?>
								<li style="display: inline-block;" folder_id="{{$folder['id']}}"><a href="javascript:;" style="color:#fff" class="detail_filebtn detail_filebtn_cpadding" onclick="relation(this)" >
								<?php echo $folder['is_follow']?"已关注":"<span>+</span>特别关注";?></a></li>
								<?php } ?>
								<?php if($folder['user_id']==$self_id){ ?>
								 <div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										编辑
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select detail_fileb_selectt slideup">
										<div class="detail_fileb_selectw">
											<a class="detail_fileb_seleta detail_fileb_seletah detail_fileb_simg">批量管理文件</a>
											<a class="detail_fileb_seleta detail_fileb_sfld" onclick="folderEditInner(this)">编辑文件夹</a>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div> 
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="perhome_scroll_wrap">
			<div class="w1248 w1240 clearfix">
				<div class="perhome_scroll_info">
					<div class="detail_fileuser">
						<div class="detail_fuava">
							<a href="/webd/user?oid={{$folder['user_id']}}" target="_blank"><img src="{{!empty($folder['user_info']['auth_avatar'])?$folder['user_info']['auth_avatar']:$folder['user_info']['pic_m']}}" alt=""></a>
						</div>
						<p class="detail_funame">{{!empty($folder['user_info']['nick'])?$folder['user_info']['nick']:$folder['user_info']['username']}}</p>
					</div>
					<div class="perhome_perlike_wrap clearfix">
						<a href="{{url('webd/folder')}}?fid={{$folder['id']}}" class="perhome_perlike_label perhome_perlike_lon">
							<p class="perhome_perlike_num">{{$folder['count']}}</p>
							<p class="perhome_perlike_la">文件</p>
						</a>
						<a href="{{url('webd/folder/fans')}}?fid={{$folder['id']}}" class="perhome_perlike_label">
							<p class="perhome_perlike_num">{{$folder['fans_count']}}</p>
							<p class="perhome_perlike_la">关注</p>
						</a>
					</div>
					<div class="detail_filebtn_wrap clearfix">
								<?php if(isset($_GET['o']) && $_GET['o']==1): ?><a class="detail_filebtn detail_fileball" style="color: #969696" href="/webd/folder?fid={{$folder['id']}}">查看全部</a><?php endif; ?>
								<?php if($type==1 && !isset($_GET['o'])): ?><a class="detail_filebtn detail_filebtn_cpadding" style="color: #fff" href="/webd/folder?fid={{$folder['id']}}&o=1">只看商品</a><?php endif; ?>
								<div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										分享
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select slideup">
										<div class="detail_fileb_selectw">
											<span class="jiathis_style_32x32" id="own_share">
												<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
												<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
											</span>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div>
								<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
								<!-- JiaThis Button END -->
								<?php if($folder['user_id']!=$self_id){ ?>
								<li style="display: inline-block;" folder_id="{{$folder['id']}}"><a href="javascript:;" style="color:#fff" class="detail_filebtn detail_filebtn_cpadding" onclick="relation(this)" >
								<?php echo $folder['is_follow']?"已关注":"<span>+</span>特别关注";?></a></li>
								<?php } ?>
								<?php if($folder['user_id']==$self_id){ ?>
								 <div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										编辑
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select detail_fileb_selectt slideup">
										<div class="detail_fileb_selectw">
											<a class="detail_fileb_seleta detail_fileb_seletah detail_fileb_simg">批量管理文件</a>
											<a class="detail_fileb_seleta detail_fileb_sfld" onclick="folderEditInner(this)">编辑文件夹</a>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
				</div>
			</div>
		</div>

		<div class="detail_select_wrap haha">
			<div class="detail_select_bg"></div>
			<div class="w1248 w1240 clearfix">
				<div class="detail_select_con">
					<a href="javascript:;" id="detail_all_select" class="detail_select_cball">全选</a>
					<a href="javascript:;" class="detail_select_cbtn detail_select_cbgrey">完成</a>
					<a href="javascript:;" class="detail_select_cbtn detail_select_btndele">删除</a>
					<a href="javascript:;" onclick="layer_error('该功能仍在建设中')" class="detail_select_cbtn ">复制至...</a>
					<a href="javascript:;" onclick="layer_error('该功能仍在建设中')" class="detail_select_cbtn ">移动至...</a>
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
<script type="text/javascript">
	$('.pop_con').click(function(){
				event.stopPropagation();
			})
			$('.pop_editfold,.pop_editfold .pop_close,.pop_editfold .detail_pop_cancel').click(function(){
				$('.pop_editfold').hide()
			})
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
</script>