<!-- 本地上传采集弹框 -->
	<div class="pop_uploadfile" style="display: none;">
		<form action="" method="post" enctype="multipart/form-data" name='u_a'>
		<div class="pop_con">
			<p class="pop_tit">
				上传图片
				<span class="pop_close"></span>
			</p>
			<div class="pop_upload_wrap">
				<a class="pop_upload_a">
					<input class="pop_upload" type="file" name='image'></input>
					<input type="hidden" name='fid' value=""></input>
					<input type="hidden" name='title' value="来自相册"></input>
					<input type="hidden" name='kind' value="2"></input>
					<input type="hidden" name='user_id' value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"></input>
					<span>请选择文件</span>
				</a>
				<a href="javascript:;" id='u_a' class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">上传</a>
			</div>
		</div>
		</form>
	</div>

	<script type="text/javascript">

		$('form[name=u_a]').submit(function(){
			ua = $('form[name=u_a]').serialize()
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
		$('#u_a').click(function(){
			$('form[name=u_a]').submit()
		})
	</script>
	<!-- 获取商品网址弹框 -->
	<div class="pop_uploadgoods" style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				上传商品
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<input class="pop_iptgoods" placeholder="粘贴商品网站" id="pop_ipt_goods">
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="geturl">获取</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('.pop_uploadgoods .pop_close,.pop_uploadgoods .detail_pop_cancel').click(function(){
			$(this).parents('.pop_uploadgoods').hide()
		})
	</script>
	<!-- 上传商品详细弹框 -->
	<div class="pop_goods_upload" style="display:none;">
	<form action="" method="post" enctype="multipart/form-data" name='u_b'>
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
				</div>
				<div class="pop_goodsimgwrap clearfix">
					<p class="pop_goodsimgtit">商品图片</p>
					<div class="pop_goodseachimg" id='pimg'>
						<a href="javascript:;" class="pop_gooddelete"></a>
						<img src="public/images/temp/temp (1).png" height="127" width="127" alt="">
						<!-- <div class="pop_good_toppne">主图</div> -->
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="margin-top: 17px;">上传到文件夹</span>
					<select class="pop_iptselect" style="margin-top: 17px;" name="fid">
						
					</select>
				</div>
				<div class="pop_desimgwrap clearfix">
					<div class="pop_deswrap clearfix">
						<span class="pop_labelname">评论</span>
						<textarea class="pop_iptdes"  placeholder="说说你对这件商品的看法吧"></textarea>
					</div>
				</div>
				
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
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_goodsave" id="u_b">保存</a>
			</div>
		</div>
	</form>
	</div>

	<!-- 创建文件夹 -->
	<div class="pop_addfold" style="display: none;">
		<div class="pop_con">
			<p class="pop_tit">
				创建文件夹
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">名称</span>
				<input class="pop_iptname" placeholder="取一个好名字，让更多人精准地搜到它" name='fname' value="">
			</div>
			<div class="pop_deswrap clearfix">
				<span class="pop_labelname">描述</span>
				<textarea class="pop_iptdes"  placeholder="关于你的文件夹"></textarea>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">隐私</span>
				<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr_s" name="private" private=0>
				<label for="pop_iptpr_s"></label>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding folder">创建</a>
			</div>
		</div>
	</div>

<!-- 上传VR -->
<div class="pop_uploadvr">
<form action="" method="post" enctype="multipart/form-data" name="uvr">
	<div class="pop_con">
		<p class="pop_tit">
			上传VR
			<span class="pop_close"></span>
		</p>
		<div class="pop_conwrap">
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">标题</span>
				<input class="pop_iptname" placeholder="为这个VR场景添加一个名称和描述" name='title' value="">
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">展示图片</span>
				<div class="pop_vrchangewrap">
					<div class="pop_vrimgwrap">
						<img src="{{asset('web')}}/images/temp/1.png">
					</div>
					<input type="hidden" name='kind' value="2"></input>
					<input type="hidden" name='user_id' value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"></input>
					<input class="pop_upload" type="file" name='image' id="fvr" style="display:none"></input>
					<label for="fvr" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright" style="color:#969696;float: left; cursor: pointer; margin-left: 30px">
								上传VR展示图</label>
				</div>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">地址</span>
				<input class="pop_iptname" placeholder="粘贴这个VR场景的链接地址" name='detail_url' value="">
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">文件夹</span>
				<select class="pop_labelselect" style="margin-right: 15px;width:255px;" name='fid'>
					
				</select>
			</div>
		</div>
		
		<div class="pop_btnwrap">
			<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
			<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="uvr">上传</a>
		</div>
	</div>
</form>
</div>
<script type="text/javascript">
	 $('#pop_iptpr_s').click(function(){
        if($(this).attr('private') == 1){
          $(this).attr('private',0)
        }else{
          $(this).attr('private',1)
        }
  	})
</script>