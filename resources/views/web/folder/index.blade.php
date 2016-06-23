<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家文件夹'])
<script type="text/javascript">
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	user_id = "{{$user_id}}"
	self_id = "{{$self_id}}"
</script>
<body>
	@include('web.common.banner')

	<div class="container" private="{{$folder['private']}}">
		@include('web.common.folder')
		<script type="text/javascript">user_id="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"</script>
		<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
		<div class="w1248 w1240 clearfix" id="main" role='main'>

			<div class="index_con  perhome_wrap" id='tiles'>
				<?php if($self_id==$user_id){?>
					<div class="index_item" style="box-shadow: none;-webkit-box-shadow: none;">
						<li class="find_fold_li perhome_add_one perhome_add_goods" style="margin-bottom: 0px;">
							<a href="javascript:;" class="perhome_add_btn">+</a>
							<div class="perhome_add_des">添加<?php if($folder['private']==1) echo '隐私';?>文件</div>
						</li>
					</div>
				<?php }else{ ?>
					<div class="index_item"></div>
				<?php } ?>
				<?php if(!empty($folder['goods'])): ?>
				<?php foreach ($folder['goods'] as $key => $value) :?>
			    <div class="index_item">
			    	<div class="index_item_wrap" good_id="{{$value['id']}}">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap" href="{{url('webd/pic')}}/{{$value['id']}}" target="_blank"></a>
							<img src="{{$value['images'][0]['img_m'] or url('uploads/sundry/blogo.jpg')}}">
							<?php if(!empty($value['price'])): ?>
								<div class="index_item_price">￥{{$value['price']}}</div>
							<?php endif; ?>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
							<div class="index_item_intro" title="<?php  echo !empty(trim($value['description']))?$value['description']:$value['title']?>"><?php  echo !empty(trim($value['description']))?$value['description']:$value['title']?></div>
								<div class="index_item_rel clearfix" good_id="{{$value['id']}}">
									<a href="javascript:;" class="index_item_l" onclick="praise(this,1)">{{$value['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$value['collection_count']}}</a>
									<?php if($value['kind'] == 1): ?>
										<a href="{{$value['detail_url']}}" class="index_item_b" target="_blank"></a>
									<?php elseif($value['kind'] == 2):?>
										<a href="javascript:;" class="index_item_d" onclick="praise(this,2)">{{$value['boo_count']}}</a>
									<?php endif; ?>
								</div>
							</div>
							<?php if(!empty($value['comment'])): ?>
								<?php $comment = $value['comment'][$value['id']]; ?>
								<div class="index_item_bottom clearfix comment">
									<a href="{{url('webd/user')}}?oid={{$comment['user']['id']}}" class="index_item_authava" target="_blank">
										<img src="{{!empty($comment['user']['auth_avatar'])?$comment['user']['auth_avatar']:$comment['user']['pic_m']}}" alt="">
									</a>
									<div class="index_item_authinfo index_item_authtalk">
										<a href="{{url('webd/user')}}?oid={{$comment['user']['id']}}" target="_blank" class="index_item_talkname">{{$comment['user']['nick'] or $comment['user']['username']}}：</a>
										<span class="index_item_authto">{{$comment['content']}}</span>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
			    </div>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if($self_id==$user_id){?>
		<!-- <a href="javascript:;" class="back_to_add">+</a> -->
	<?php } ?>
	<!-- 编辑文件夹弹框 -->
	<div class="pop_editfile" style="display: none;">
		<div class="pop_con">
			<p class="pop_tit">
				编辑文件
				<span class="pop_close"></span>
			</p>
			<div class="pop_conwrap clearfix">
				<div class="pop_desimgwrap">
					<div class="pop_imgwrap">
						<img src="public/images/temp/1.png" alt="">
					</div>
				</div>
				
				<div class="pop_namewrap clearfix">
					<div class="pop_labelwrap">
						<span class="pop_labelname">名称</span>
						<textarea class="pop_iptdes"  placeholder="这是一把欧洲进口的沙发椅，来自品牌"></textarea>
					</div>
					<div class="pop_foldwrap clearfix">
						<span class="pop_labelname" style="margin-top: 17px;">文件夹</span>
						<select class="pop_iptselect" style="margin-top: 17px;">
							<option value="">椅子</option>
							<option value="">桌子</option>
							<option value="">电视柜</option>
							<option value="">沙发</option>
							<option value="">卧室</option>
							<option value="">卫生间</option>
						</select>
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="margin-top: 17px;">文件夹</span>
					<select class="pop_iptselect" style="margin-top: 17px;">
						<option value="">椅子</option>
						<option value="">桌子</option>
						<option value="">电视柜</option>
						<option value="">沙发</option>
						<option value="">卧室</option>
						<option value="">卫生间</option>
					</select>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">标签</span>
					<select class="pop_labelselect" style="margin-right: 15px;">
						<option value="">该采集的风格是...</option>
						<option value="">现代</option>
						<option value="">中式</option>
						<option value="">日式</option>
						<option value="">新古典</option>
						<option value="">美式</option>
						<option value="">现代</option>
						<option value="">中式</option>
						<option value="">日式</option>
						<option value="">新古典</option>
						<option value="">美式</option>
					</select>
					<select class="pop_labelselect">
						<option value="">该采集的颜色是...</option>
						<option value="">红</option>
						<option value="">橙</option>
						<option value="">黄</option>
						<option value="">绿</option>
						<option value="">青</option>
						<option value="">蓝</option>
						<option value="">紫</option>
						<option value="">黑</option>
						<option value="">白</option>
						<option value="">灰</option>
					</select>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">来自</span>
					<input class="pop_iptname" placeholder="www.thden.com">
				</div>
			</div>
			
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_delete">删除采集</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">保存</a>
			</div>
		</div>
	</div>
	<!-- 编辑图片弹框 -->
	<div class="pop_editpic" style="display: none;">
		<div class="pop_con">
			<p class="pop_tit">
				编辑图片
				<span class="pop_close"></span>
			</p>
			<div class="pop_conwrap">
				<div class="pop_desimgwrap">
					<div class="pop_imgwrap">
						<img src="public/images/temp/1.png" alt="">
					</div>
				</div>
				
				<div class="pop_namewrap clearfix">
					<div class="pop_labelwrap">
						<span class="pop_labelname">名称</span>
						<textarea class="pop_iptdes"  placeholder="这是一把欧洲进口的沙发椅，来自品牌"></textarea>
					</div>
					<div class="pop_foldwrap clearfix">
						<span class="pop_labelname" style="margin-top: 17px;">移动到</span>
						<select class="pop_iptselect" style="margin-top: 17px;">
							<option value="">椅子</option>
							<option value="">桌子</option>
							<option value="">电视柜</option>
							<option value="">沙发</option>
							<option value="">卧室</option>
							<option value="">卫生间</option>
						</select>
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">标签</span>
					<select class="pop_labelselect" style="margin-right: 15px;">
						<option value="">该采集的风格是...</option>
						<option value="">现代</option>
						<option value="">中式</option>
						<option value="">日式</option>
						<option value="">新古典</option>
						<option value="">美式</option>
						<option value="">现代</option>
						<option value="">中式</option>
						<option value="">日式</option>
						<option value="">新古典</option>
						<option value="">美式</option>
					</select>
					<select class="pop_labelselect">
						<option value="">该采集的颜色是...</option>
						<option value="">红</option>
						<option value="">橙</option>
						<option value="">黄</option>
						<option value="">绿</option>
						<option value="">青</option>
						<option value="">蓝</option>
						<option value="">紫</option>
						<option value="">黑</option>
						<option value="">白</option>
						<option value="">灰</option>
					</select>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">来自</span>
					<input class="pop_iptname" placeholder="www.thden.com">
				</div>
			</div>
			
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_delete">删除采集</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">保存</a>
			</div>
		</div>
	</div>
	<!-- 本地上传采集弹框 -->
	<div class="pop_uploadfile" style="display: none;">
		<form action="/webd/folder/uimg" method="post" enctype="multipart/form-data" name='ua'>
		<div class="pop_con">
			<p class="pop_tit">
				上传图片
				<span class="pop_close"></span>
			</p>
			<div class="pop_upload_wrap">
				<a class="pop_upload_a">
					<input class="pop_upload" type="file" name='image'></input>
					<input type="hidden" name='fid' value="{{$folder['id']}}"></input>
					<input type="hidden" name='title' value="来自相册"></input>
					<input type="hidden" name='kind' value="2"></input>
					<input type="hidden" name='user_id' value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"></input>
					<span>请选择文件</span>
				</a>
				<a href="javascript:;" id='ua' class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">上传</a>
			</div>
		</div>
		</form>
	</div>

	<script type="text/javascript">
		$('form[name=ua]').submit(function(){
			ua = $('form[name=ua]').serialize()
			$(this).ajaxSubmit({
				type:"post",  //提交方式
                dataType:"json", //数据类型
                'fileTypeDesc': "Image Files",
                url:"/webd/folder/uimg", //请求url
                success:function(json){ //提交成功的回调函数
                    if(json.code==200) {
                    	layer.msg('成功上传',{icon: 6});
                    	setTimeout(function(){
                    		location.reload()
                    	},2000)
                    	
                    }else{
                    	layer.msg(json.message, {icon: 5});
						return
                    } 
                },
                resetForm:1
	        });
	        return false
		})
		$('#ua').click(function(){
			$('form[name=ua]').submit()
			return
		})
	</script>
	<!-- 移动至弹框 -->
	<div class="pop_movefile" style="display: none;">
		<div class="pop_con">
			<p class="pop_tit">
				移动至...
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">文件夹</span>
				<div class="pop_fakeselect">
					<span class="pop_fakedefault">请选择一个文件夹</span>
					<div class="pop_fakeicon"></div>
					<div class="pop_optionwrap">
						<div class="pop_searwrap clearfix">
							<a href="javascript:;" class="pop_searnewbtn"></a>
							<input type="text" class="pop_sear" placeholder="Search">
							<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball pop_searnew">新建</a>
						</div>
						<ul class="pop_searul">
							<li>椅子</li>
							<li>桌子</li>
							<li>电视</li>
							<li>沙发</li>
							<li>卧室</li>
							<li>椅子</li>
							<li>桌子</li>
							<li>电视</li>
							<li>沙发</li>
							<li>卧室</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">移动</a>
			</div>
		</div>
	</div>
	<!-- 移动提示弹框 -->
	<div class="pop_movetips" style="display: none;">
		<div class="pop_con">
			<p class="pop_tit">
				提示
				<span class="pop_close"></span>
			</p>
			<p class="pop_movetp"> 你还没有选择需要移动的文件  </p>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">确定</a>
			</div>
		</div>
	</div>
	<!-- 复制至弹框 -->
	<div class="pop_copyfile" style="display: none;">
		<div class="pop_con">
			<p class="pop_tit">
				复制至...
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">文件夹</span>
				<div class="pop_fakeselect">
					<span class="pop_fakedefault">请选择一个文件夹</span>
					<div class="pop_fakeicon"></div>
					<div class="pop_optionwrap">
						<div class="pop_searwrap clearfix">
							<a href="javascript:;" class="pop_searnewbtn"></a>
							<input type="text" class="pop_sear" placeholder="Search">
							<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball pop_searnew">新建</a>
						</div>
						<ul class="pop_searul">
							<li>椅子</li>
							<li>桌子</li>
							<li>电视</li>
							<li>沙发</li>
							<li>卧室</li>
							<li>椅子</li>
							<li>桌子</li>
							<li>电视</li>
							<li>沙发</li>
							<li>卧室</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">移动</a>
			</div>
		</div>
	</div>
	<!-- 复制提示弹框 -->
	<div class="pop_copytips" style="display: none;">
		<div class="pop_con">
			<p class="pop_tit">
				提示
				<span class="pop_close"></span>
			</p>
			<p class="pop_movetp"> 你还没有选择需要复制的文件  </p>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">确定</a>
			</div>
		</div>
	</div>
	<!-- 普通文件夹变隐私提示弹框 -->
	<div class="pop_privtips" style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				提示
				<span class="pop_close"></span>
			</p>
			<p class="pop_movetp"> 该文件夹已变为隐私文件夹，只有你自己可见。    </p>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">确定</a>
			</div>
		</div>
	</div>
	<!-- 文件夹没找到提示弹框 -->
	<div class="pop_findnotips" style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				提示
				<span class="pop_close"></span>
			</p>
			<p class="pop_movetp">未找到该文件夹</p>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">确定</a>
			</div>
		</div>
	</div>
	<!-- 文件删除提示弹框 -->
	<div class="pop_deletetips" style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				提示
				<span class="pop_close"></span>
			</p>
			<p class="pop_movetp">你确定要删除这些文件吗？</p>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="delpfolder">确定</a>
			</div>
		</div>
	</div>
	<!-- 采集创建成功提示弹框 -->
	<div class="pop_successtips"  style="display:none;">
		<div class="pop_con">
			<div class="pop_newcollect">
				<img src="public/images/temp_avatar.JPG" alt="">
			</div>
			<div class="pop_newcoltip">
				<p class="pop_colspcol">成功采集到</p>
				<p class="pop_colspwjj"><span>椅子</span>文件夹</p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function cg(){
			$('#pop_file').hide()
		}
	</script>
	<!-- 获取商品网址弹框 -->
	<div class="pop_uploadgoods" style="display:none;" id="pop_file">
		<div class="pop_con">
			<p class="pop_tit">
				上传商品
				<span class="pop_close" onclick="cg()"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<input class="pop_iptgoods" placeholder="粘贴商品网站" type="text" value="" id="pop_goods">
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" onclick="cg()">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_goodsget">获取</a>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('#delpfolder').click(function(){
			var garr = '';
			var delfs = $('div[class=detail_raido_wrapred]')
			$.each(delfs,function(i,v){
				gid = delfs.eq(i).parents('.index_item_wrap').attr('good_id')
				garr+= gid+'|'
			})
			if(garr==''){
				layer.msg('没有选择文件', {icon: 5});
				return 
			}
			$.ajax({
				'beforeSend':function(){
					layer.load(0, {shade: 0.5});
				},
				'url':"/webd/folder/delpfolder",
				'type':'post',
				'data':{
					'user_id':"<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>",
					'garr':garr,
					'fid':"{{$folder['id']}}"
				},
				'dataType':'json',
				'success':function(json){
					if(json.code==200){
						layer.msg('删除成功', {icon: 6});
						setTimeout(function(){
							location.reload()
						},1000)
					}else{
						layer.msg(json.message, {icon: 5});
						return
					}
				},
				'complete':function(){
					layer.closeAll('loading');
				}
			})
			return
		})
		// 上传商品点击
		$('.detail_pop_goodsget').click(function(){
				if($('#pop_goods').val().trim()==''){
		          layer.msg('地址不能为空',{'icon':5})
		          return 
		        }
				$('.pop_uploadgoods').hide();
				$.ajax({
					'beforeSend':function(){
						layer.load(0, {shade: 0.5});
					},
					'url':"/webd/taobao/detail",
					'type':'get',
					'data':{
						'url':$('#pop_goods').val().trim()
					},
					'dataType':'json',
					'success':function(json){
						if(json.code==200){
							ub = $('form[name=ub]')
							description = title = json.data.x_item[0].title
							price = json.data.x_item[0].price
							pic_url = json.data.x_item[0].pic_url
							reserve_price = json.data.x_item[0].reserve_price
							image_ids = json.data.x_item[0].image_ids
							detail_url = $('#pop_goods').val().trim()
							$('input[name=title]',ub).val(title)
							$('input[name=price]',ub).val(price)
							$('#pimg img',ub).attr('src',pic_url)
							$('input[name=image]',ub).attr('value',pic_url)
							$('input[name=detail_url]',ub).val(detail_url)
							$('input[name=image_ids]',ub).val(image_ids)
							$('input[name=reserve_price]',ub).val(reserve_price)
							$('input[name=description]',ub).val(description)
							$('.pop_pic_upload').show();
							var popconHei = $('.pop_pic_upload .pop_con').height();
						  	if (popconHei > 410) {
							    $('.pop_pic_upload .pop_conwrap').css({
							      'max-height':410,
							      'overflow-y':'scroll'
							    })
							  };
						  	var poptopHei = $('.pop_pic_upload .pop_con').height();
							$('.pop_pic_upload .pop_con').css({
							   'margin-top':-(poptopHei/2)
							})
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
	</script>
	<!-- 上传商品详细弹框 -->
	<div class="pop_pic_upload" style="display:none;">
	<form action="" method="post" enctype="multipart/form-data" name='ub'>
		<div class="pop_con clearfix">
			<p class="pop_tit">
				上传商品
				<span class="pop_close"></span>
			</p>
			<div class="pop_conwrap">
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">名称</span>
					<input class="pop_iptname" placeholder="名称"  name='title' value="来自商品">
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">价格</span>
					<p class="pop_iptprice"><input id='pprice' type="text" value="" name='price' style="color:#a1a1a1;border: none; font-size: 16px"></p>
					<input type="hidden" value="" name='reserve_price' id='reserve_price'></input>
					<input type="hidden" value="1" name='kind'></input>
					<input type="hidden" value="" name='description' id='description'></input>
					<input type="hidden" value="" name='detail_url' id='detail_url'></input>
					<input type="hidden" value="" name='image_ids' id='image_ids'></input>
					<input type="hidden" value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>" name='user_id'></input>
					<input type="hidden" value="{{$folder['id']}}" name='fid'></input>
				</div>
				<div class="pop_goodsimgwrap clearfix">
					<p class="pop_goodsimgtit">商品图片</p>
					<div class="pop_goodseachimg" id='pimg'>
						<a href="javascript:;" class="pop_gooddelete"></a>
						<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">
						<!-- <div class="pop_good_toppne">主图</div> -->
					</div>
					<div class="pop_goodseachimg pop_goodseachadd"></div>
					<div class="pop_goodseachimg pop_goodseachadd"></div>
					<div class="pop_goodseachimg pop_goodseachadd"></div>
					<div class="pop_goodseachimg pop_goodseachadd"></div>
				</div>
				<div class="pop_desimgwrap clearfix">
					<div class="pop_deswrap clearfix">
						<span class="pop_labelname">评论</span>
						<textarea class="pop_iptdes"  placeholder="说说你对这件商品的看法吧"></textarea>
					</div>
				</div>
				<!-- <div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="margin-top: 17px;">文件夹</span>
					<select class="pop_iptselect" style="margin-top: 17px;">
						<option value="">椅子</option>
						<option value="">桌子</option>
						<option value="">电视柜</option>
						<option value="">沙发</option>
						<option value="">卧室</option>
						<option value="">卫生间</option>
					</select>
				</div> -->
			</div>
			<div class="pop_btnwrap pop_goods_share">
				<!-- <div class="pop_col_lbtm">
					<span class="pop_col_lbshare">
						分享到 :
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>
						<a class="pop_col_lbswc"></a>
						<a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>
					</span>
					
					<span class="pop_col_lbshare">
						微信朋友圈
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio"></a>
						<a class="pop_col_lbsqq"></a>
						<a class="jiathis_button_qzone jiathis_button"></a>
					</span>
					<span class="pop_col_lbshare">
						QQ空间
					</span>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				</div> -->
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="ub">保存</a>
			</div>
		</div>
	</form>
	</div>

	<script type="text/javascript">
		$('form[name=ub]').submit(function(){
			$(this).ajaxSubmit({
				type:"post",  //提交方式
                dataType:"json", //数据类型
                url:"{{url('webd/folder/ugoods')}}", //请求url
                success:function(json){ //提交成功的回调函数
                    if(json.code==200) {
                    	layer.msg('成功上传',{icon: 6});
                    	setTimeout(function(){
                    		location.reload()
                    	},1000)
                    }else{
                    	layer.msg(json.message, {icon: 5});
						return
                    } 
                },
                resetForm:1
	        });
	        return false
		})
		$('#ub').click(function(){
			$('form[name=ub]').submit()
		})
	</script>
	<!-- 上传商品弹框 -->
	<div class="pop_goodsupload" style="display:none;">
		<div class="pop_con">
			<div class="pop_conabwrap">
				<div class="pop_cona"></div>
				<div class="pop_conb"></div>
			</div>
		</div>
		
		
	</div>
	<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
</body>
<script type="text/javascript" src="{{asset('web')}}/js/folder/filelist.js"></script>

<script type="text/javascript">
	postUrl = "{{url('webd/folder/folders')}}?fid={{$folder['id']}}"
	postData = {'num':15}
	<?php if(isset($_GET['o']) && $_GET['o'] == 1): ?>
	postData.o = 1
	<?php endif; ?>
</script>
<script type="text/javascript" src="{{asset('web')}}/js/folder/pubu.js"></script>
</html>