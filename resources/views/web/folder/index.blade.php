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
	<div class="container">
		@include('web.common.folder')
		<div class="w1248 w1240 clearfix" id="main" role='main'>

			<div class="index_con  perhome_wrap" id='tiles'>
				<?php if($self_id==$user_id){?>
					<div class="index_item" style="box-shadow: none;-webkit-box-shadow: none;">
						<li class="find_fold_li perhome_add_one perhome_add_goods" style="margin-bottom: 0px;">
							<a href="javascript:;" class="perhome_add_btn">+</a>
							<div class="perhome_add_des">添加文件</div>
						</li>
					</div>
				<?php }else{ ?>
					<div class="index_item"></div>
				<?php } ?>
				<?php if(!empty($folder['goods'])): ?>
				<?php foreach ($folder['goods'] as $key => $value) :?>
			    <div class="index_item">
			    	<div class="index_item_wrap">
						<div class="index_item_imgwrap clearfix">
							<a class="index_item_blurwrap" href="{{url('webd/pic/')}}/{{$value['id']}}" target="_blank"></a>
							<img src="{{$value['image_url']}}">
							<?php if(!empty($value['price'])): ?>
								<div class="index_item_price">￥{{$value['price']}}</div>
							<?php endif; ?>
						</div>
						<div class="index_item_info">
							<div class="index_item_top">
								<div class="index_item_intro" title="{{!empty(trim($value['description']))?$value['description']:$value['title']}}">{{!empty(trim($value['description']))?$value['description']:$value['title']}}</div>
								<div class="index_item_rel clearfix">
									<a href="javascript:;" class="index_item_l">{{$value['praise_count']}}</a>
									<a href="javascript:;" class="index_item_c">{{$value['collection_count']}}</a>
									<?php if($value['kind'] == 1): ?>
										<a href="{{$value['detail_url']}}" class="index_item_b" target="_blank"></a>
									<?php elseif($value['kind'] == 2):?>
										<a href="javascript:;" class="index_item_d">{{$value['boo_count']}}</a>
									<?php endif; ?>
								</div>
							</div>
							<?php if(!empty($value['comment'])): ?>
								<?php $comment = $value['comment'][$value['id']]; ?>
								<div class="index_item_bottom clearfix comment">
									<a href="{{url('webd/user')}}?oid={{$comment['user']['id']}}" class="index_item_authava" target="_blank">
										<img src="{{$comment['user']['pic_m']}}" alt="">
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
	<a href="javascript:;" class="back_to_add">+</a>
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
		<form action="" method="post" enctype="multipart/form-data" name='ua'>
		<div class="pop_con">
			<p class="pop_tit">
				上传采集
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
                url:"{{url('webd/folder/uimg')}}", //请求url
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
			<p class="pop_movetp">你确定要删除该采集吗？</p>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">确定</a>
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
			$('.pop_uploadgoods').hide()
		}
	</script>
	<!-- 获取商品网址弹框 -->
	<div class="pop_uploadgoods" style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				上传商品
				<span class="pop_close" onclick="cg()"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<input class="pop_iptgoods" placeholder="粘贴商品网站" type="text" value="">
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" onclick="cg()">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_goodsget">获取</a>
			</div>
		</div>
	</div>

	<!-- 上传图片详细弹框 -->
	<div class="pop_goods_upload" style="display:none;">
		<div class="pop_con clearfix">
			<p class="pop_tit">
				上传图片
				<span class="pop_close"></span>
			</p>
			<div class="pop_conwrap">
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">名称</span>
					<input class="pop_iptname" placeholder="北欧纯木沙发椅">
				</div>
				<!-- <div class="pop_namewrap clearfix">
					<span class="pop_labelname">价格</span>
					<p class="pop_iptprice">￥45</p>
				</div> -->
				<div class="pop_goodsimgwrap clearfix">
					<p class="pop_goodsimgtit">图片</p>
					<div class="pop_goodseachimg">
						<a href="javascript:;" class="pop_gooddelete"></a>
						<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">
						<div class="pop_good_toppne">主图</div>
					</div>
					<div class="pop_goodseachimg">
						<a href="javascript:;" class="pop_gooddelete"></a>
						<img src="public/images/temp/temp (2).png" height="127" width="127" alt="">
					</div>
					<div class="pop_goodseachimg">
						<a href="javascript:;" class="pop_gooddelete"></a>
						<img src="public/images/temp/temp (3).png" height="127" width="127" alt="">
					</div>
					<div class="pop_goodseachimg">
						<a href="javascript:;" class="pop_gooddelete"></a>
						<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">
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
			</div>
			
			<div class="pop_btnwrap pop_goods_share">
				<div class="pop_col_lbtm">
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
				</div>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_goodsave">保存</a>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('.detail_pop_goodsget').click(function(){
				$('.pop_uploadgoods').hide();
				$.ajax({
					'beforeSend':function(){
						layer.load(0, {shade: 0.5});
					},
					'url':"/webd/taobao/detail",
					'type':'get',
					'data':{
						'url':$('.pop_iptgoods').val().trim()
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
							detail_url = $('.pop_iptgoods').val().trim()
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
					<p class="pop_iptprice">￥<input id='pprice' type="text" value="" name='price' style="color:#a1a1a1;border: none"></p>
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
				<div class="pop_col_lbtm">
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
				</div>
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
<script type="text/javascript">
		$(function() {
			$('.perhome_add_goods').click(function(){

				$('.pop_goodsupload').show();
				var popconHei = $('.pop_goodsupload .pop_conwrap').height();
			  	if (popconHei > 410) {
				    $('.pop_goodsupload .pop_conwrap').css({
				      'max-height':410,
				      'overflow-y':'scroll'
				    })
				  };
			  	var poptopHei = $('.pop_goodsupload .pop_con').height();
					$('.pop_con').css({
					   'margin-top':-(poptopHei/2)
				})
			});
			$('.pop_goodsupload,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_goodsupload').hide();
			});
			$('.pop_goodsupload .pop_con').click(function(){
				event.stopPropagation()
			});
			$('.pop_cona').click(function(){
				$('.pop_goodsupload').hide();
				$('.pop_uploadfile').show();
				var popconHei = $('.pop_goods_upload .pop_conwrap').height();
			  	if (popconHei > 410) {
				    $('.pop_goods_upload .pop_conwrap').css({
				      'max-height':410,
				      'overflow-y':'scroll'
				    })
				  };
			  var poptopHei = $('.pop_goods_upload .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			});
			$('.pop_goods_upload,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_goods_upload').hide();
			});
			$('.pop_goods_upload .pop_con').click(function(){
				event.stopPropagation()
			});
			$('.pop_conb').click(function(){
				$('.pop_goodsupload').hide();
				$('.pop_uploadgoods').show();
				var popconHei = $('.pop_pic_upload .pop_conwrap').height();
			  	if (popconHei > 410) {
				    $('.pop_pic_upload .pop_conwrap').css({
				      'max-height':410,
				      'overflow-y':'scroll'
				    })
				  };
			  var poptopHei = $('.pop_pic_upload .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			});
			$('.pop_pic_upload,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_pic_upload').hide();
			});
			$('.pop_pic_upload .pop_con').click(function(){
				event.stopPropagation()
			});
			$('.pop_col_r').click(function(){
				if ($(this).hasClass('pop_col_radio_on')) {
					$(this).removeClass('pop_col_radio_on').addClass('pop_col_radio');
					$(this).parent('.pop_col_bwrap').find('.jiathis_button').removeClass('jiathis_button_on')
				}else{
					$(this).removeClass('pop_col_radio').addClass('pop_col_radio_on');
					$(this).parent('.pop_col_bwrap').find('.jiathis_button').addClass('jiathis_button_on')
				};
			})
			// 触发分享按钮开始
			$('.detail_pop_goodsave').click(function(){
				$('.jiathis_button_on').trigger('click')
			})
			// 触发分享按钮结束

			//点击删除提示效果开始
			$('.detail_select_btndele').click(function(){
				$('.pop_deletetips').show();
				var poptopHei = $('.pop_deletetips .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_deletetips,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_deletetips').hide();
			})
			$('.pop_deletetips .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击复制至提示效果结束

			//点击复制至效果开始
			$('.detail_select_btncopy').click(function(){
				$('.pop_copyfile').show();
				var poptopHei = $('.pop_copyfile .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_copyfile,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_copyfile').hide();
			})
			$('.pop_copyfile .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击复制至效果结束

			//点击复制至提示效果开始
			$('.detail_select_btncopy').click(function(){
				$('.pop_copytips').show();
				var poptopHei = $('.pop_copytips .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_copytips,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_copytips').hide();
			})
			$('.pop_copytips .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击复制至提示效果结束

			// 下拉框效果开始
			$('.pop_fakeselect').click(function(){
				$('.pop_optionwrap').show();
				var poptopHei = $('.pop_optionwrap .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			});
			$('.pop_searul li').click(function(){
				event.stopPropagation()
				var fakeOption = $(this).html();
				$('.pop_fakedefault').html(fakeOption);
				$('.pop_optionwrap').hide();
			})
			// 下拉框效果结束
			

			//文件未找到提示效果开始
			$('.pop_searnew').click(function(){
				$('.pop_findnotips').show();
				var poptopHei = $('.pop_findnotips .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_findnotips,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_findnotips').hide();
			})
			$('.pop_findnotips .pop_con').click(function(){
				event.stopPropagation()
			})
			//文件未找到提示效果结束

			//点击移动至效果开始
			$('.detail_select_btnmove').click(function(){
				$('.pop_movefile').show();
				var poptopHei = $('.pop_movefile .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_movefile,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_movefile').hide();
			})
			$('.pop_movefile .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击移动至效果结束

			//点击移动至提示效果开始
			$('.detail_select_btnmove').click(function(){
				$('.pop_movetips').show();
				var poptopHei = $('.pop_movetips .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_movetips,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_movetips').hide();
			})
			$('.pop_movetips .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击移动至提示效果结束
			$('.back_to_add').click(function(){
				$('.pop_uploadfile').show();
				var poptopHei = $('.pop_uploadfile .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_uploadfile,.pop_close').click(function(){
				$('.pop_uploadfile').hide();
			})
			$('.pop_uploadfile .pop_con').click(function(){
				event.stopPropagation()
			})
			
			$(".pop_upload_a").on("change","input[type='file']",function(){
			    var filePath=$(this).val();
			    if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1){
			        var arr=filePath.split('\\');
			        var fileName=arr[arr.length-1];
			        $(".pop_upload_a span").html(fileName);
			    }else{
			        $(".pop_upload_a span").html("您上传文件类型有误！");
			        return false 
			    }
			})
			$('.detail_fileb_sfld').click(function(){
				$('.pop_editfile').show();
				var poptopHei = $('.pop_editfile .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			});
			$('.pop_editfile,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_editfile').hide();
			})
			// $('.detail_fileb_sfld').click(function(){
			// 	$('.pop_editpic').show();
			// });
			$('.pop_editfile,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_editpic').hide();
			})
			$('.pop_con').click(function(){
				event.stopPropagation()
			})
		    var $container = $('.index_con');
		    $container.imagesLoaded(function() {
		        $container.masonry({
	                itemSelector: '.index_item',
	                gutter: 15,
	                isAnimated: true,
	            });
	            var text = $('.index_item_intro');
	              str = text.html(),
	              textLeng = 29;
	              if(str.length > textLeng ){
	                    text.html( str.substring(0,textLeng )+"...");
	              }
		     });
		    $('.detail_fileb_simg').click(function(){
		    	var detail_selecth = '<div class="detail_raido_wrap"></div>'
		    	$('.index_item_imgwrap ').append(detail_selecth)
		    	$('.detail_raido_wrap').click(function(){
		    		if ($(this).hasClass('detail_raido_wrapred')) {
		    			$(this).removeClass('detail_raido_wrapred').addClass('detail_raido_wrap');
		    		}else{
		    			$(this).removeClass('detail_raido_wrap').addClass('detail_raido_wrapred');
		    		};
		    	});
		    	if (!$('.detail_select_wrap').hasClass('haha')) {
		    		$('.detail_select_wrap').show()
		    		$('.detail_select_wrap').slideUp(400,function(){
		    			$('.detail_select_wrap').addClass('haha')
		    		});
		    		event.stopPropagation();
		    	}else{
		    		$('.detail_select_wrap').slideDown(400, function() {
		    			$('.detail_select_wrap').removeClass('haha')
		    		});
		    	};
		    })
		    $('.detail_filebtn_click').click(function(){
		    	event.stopPropagation();
		    	if ($(this).siblings('.detail_fileb_select').hasClass('slideup')) {
		    		$('.detail_fileb_select').addClass('slideup');
		    		$(this).siblings('.detail_fileb_select').removeClass('slideup').addClass('slidedown');
		    		var isOut = true;
		    	}else{
		    		$('.detail_fileb_select').addClass('slideup');
		    		$(this).siblings('.detail_fileb_select').removeClass('slidedown').addClass('slideup');
		    	};
		    	window.document.onclick = function(){
			    	if(isOut){
			            $('.detail_fileb_select').removeClass('slidedown').addClass('slideup');
			        }else{
			        	$('.detail_fileb_select').removeClass('slideup').addClass('slidedown');
			        }
			    }
		    });
		    $(window).scroll(function(event) {
			var scrollHei = $('body').scrollTop();
			if (scrollHei <= 130) {
				$('.perhome_scroll_info,.perhome_scroll_wrap').css({
					transform:'translate(0px, -50px)',
					transition:'transform 200ms ease'
				});
				$('.perhome_scroll_wrap').removeClass('shadow');
			}else{
				$('.perhome_scroll_wrap').addClass('shadow');
				$('.perhome_scroll_wrap').css({
					display:'block',
					position: 'fixed',
					transform:'translate(0px, -0px)',
					transition:'transform 200ms ease'
				});
				$('.perhome_scroll_info').css({
					transform:'translate(0px, -0px)',
					transition:'transform 200ms ease'
				})
			};
		});
		    
		});
	</script>
<script type="text/javascript">
	postUrl = "{{url('webd/folder/folders')}}?fid={{$folder['id']}}"
	postData = {'num':15}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/folder/pubu.js"></script>
</html>