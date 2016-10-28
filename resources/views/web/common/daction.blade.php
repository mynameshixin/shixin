
<script type="text/javascript" src="{{asset('web')}}/js/angular.js"></script>
<script type="text/javascript" src="{{asset('web')}}/js/distpicker.data.js"></script>
<script type="text/javascript" src="{{asset('web')}}/js/distpicker.js"></script>
<script type="text/javascript" src="{{asset('web')}}/js/autocomplete.js"></script>
<script type="text/javascript">
  var upvr = angular.module('upvr', [], function($interpolateProvider) {
   $interpolateProvider.startSymbol('{%');
   $interpolateProvider.endSymbol('%}');
  });

  upvr.controller('dev',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/dev',
		  }).success(function(json, status) {
		  	$scope.dev = json.data.list
		  })
	})

	upvr.controller('huxing',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/huxing',
		  }).success(function(json, status) {
		  	$scope.huxing = json.data.list
		  })
	})

	upvr.controller('type',function($scope,$http){
		$http({
		    method: 'post',
		    url: '/api/vr/type',
		  }).success(function(json, status) {
		  	$scope.type = json.data.list
		  })
	})

	upvr.controller('btype',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/brandtype',
		  }).success(function(json, status) {
		  	$scope.btype = json.data.list
		  })
	})

	upvr.controller('sale',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/sales',
		  }).success(function(json, status) {
		  	$scope.sale = json.data.list
		  })
	})
</script>
<style type="text/css">
	.autocomplete-container {
		position: relative;
		width: 190px;
		height: 32px;
		margin: 0 auto;
		display: inline-block;
	}

	.autocomplete-input {
		width: 218px;
	    height: 36px;
	    background: #f0f0f0;
	    border-radius: 3px;
	    border: none
	}

	.autocomplete-button {
		font-family: inherit;
		border: none;
		background-color: #990101;
		color: white;
		padding: 8px;
		float: left;
		cursor: pointer;
		border-radius: 0px 3px 3px 0px;
		transition: all 0.2s ease-out 0s;
		margin: 0.5px 0px 0px -1px;
	}

	.autocomplete-button:HOVER {
		background-color: #D11E1E;
	}
	#search_form_outer,#search_upload_outer{
		display: inline-block;
		position: absolute;
	    left: 40px;
	    top: 0;
	    z-index: 100
	}
	.proposal-box {
		position: absolute;
		height: auto;
		border-left: 1px solid rgba(0, 0, 0, 0.11);
		border-right: 1px solid rgba(0, 0, 0, 0.11);
		left: 0px;
	}

	.proposal-list {
		list-style: none;
		box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.44);
		-webkit-margin-before: 0em;
		-webkit-margin-after: 0em;
		-webkit-margin-start: 0px;
		-webkit-margin-end: 0px;
		-webkit-padding-start: 0px;
	}

	.proposal-list li {
		text-align: left;
		padding: 5px;
		font-size: 16px;
		border-bottom: 1px solid rgba(0, 0, 0, 0.16);
		height: 25px;
		line-height: 25px;
		background-color: rgba(255, 255, 255, 1);
		cursor: pointer;
	}

	li.proposal.selected {
		background-color: rgba(175, 175, 175, 1);
		color: white;
	}

	#search-box {
		position: relative;
		width: 400px;
		margin: 0 auto;
		display: inline;
	}

	#message {

	}
	</style>
	<!-- 上传图片 -->
	<div class="pop_collect p_collect" style="display: none" img_id="" id="upload_outer">
	<form action="" method="post" enctype="multipart/form-data" name="allimg">
		<div class="pop_con">
			<div class="pop_col_left" style="height: 400px">
				<div class="pop_col_ltop clearfix">
					<div class="pop_namewrap clearfix" style="padding:0px 0px 0px 30px;">
			        <span class="pop_labelname" style="font-size:14px;line-height:42px;width:100%;">图片展示<br>最多5张且每张大小不超过8M</span>
			        <div class="pop_addpic_con clearfix" style="float:left">
			            <div class="pop_addpic_wrap" style="position:relative;float:left;">
			              <img src="/web/images/pop_upload_multi.png" alt="堆图家" class="show" />
			              <input type="file" name="image[]" multiple="true"/>
			            </div>
			        </div>
			      </div>
				</div>
				<input type="hidden" name="user_id" value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id'];?>"/>
				<input type="hidden" name="kind" value="2"/>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close" onclick="$('#upload_outer').hide()"></span>
					 
					<div class="pop_col_sinput_wrap" style="margin-top: 20px">
						<a href="javascript:;" class="pop_col_sinputbtn" title='堆图家搜索'></a>
						<input class="pop_col_sinput" placeholder="搜索">
						<div id="search_upload_outer"></div>
					</div>
					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
						</div>
						<ul class="pop_col_colum" id="search_upload">
							
						</ul>
						<p class="pop_col_new">最新保存到</p>
						<ul class="pop_col_colum pop_col_colum_new">
							
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all">
							
							
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew" id="show_folder_add" title="新建文件夹并上传" >+</a>
					<p class="pop_add_addfont">新建文件夹并上传</p>
				</div>
			</div>
		</div>
	</form>
	</div>

	<!-- 上传图片时新建文件夹 -->
	<div class="pop_collect p_folder" style="display: none" id="pic_folder_outer">
		<div class="pop_con">
			<div class="pop_col_left" style="height: 470px">
				<div class="pop_col_ltop clearfix">
					<!-- <img src="{{url('uploads/sundry/wlogo.jpg')}}"  width="668" alt="堆图家"> -->
				</div>			
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					创建文件夹
					<span class="pop_close" onclick="$('#pic_folder_outer').hide()"></span>
				</div>
				<div class="pop_col_infowrap">
					<div class="pop_col_name">
						<p class="pop_col_nlabel">名称</p>
						<input class="pop_col_ninput" placeholder="例如：欧式低奢亮色系风格" name="fname" value="">
					</div>
					<div class="pop_col_name">
						<p class="pop_col_nlabel">描述</p>
						<textarea class="pop_col_narea" placeholder="例如：欧式低奢亮色系风格"></textarea>
					</div>
					<div class="pop_col_priv">
						<p class="pop_col_nlabel">隐私</p>
						<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr_o" name="private" private="0">
						<label for="pop_iptpr_o"></label>
					</div>
				</div>
				<div class="pop_btnwrap">
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" onclick="$('#pic_folder_outer').hide()" title="堆图家取消">取消</a>
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" style="float:right;" id="pic_cfolder" title="堆图家创建">创建</a>
				</div>
			</div>
		</div>
	</div>

	<!-- 上传商品时新建文件夹 -->
	<div class="pop_collect p_folder" style="display: none" id="good_folder_outer">
		<div class="pop_con" style="width: 500px">
			<div class="pop_col_right" style="width: 400px">
				<div class="pop_col_tit" style="width: 400px">
					创建文件夹
					<span class="pop_close" onclick="$('#good_folder_outer').hide()"></span>
				</div>
				<div class="pop_col_infowrap" style="width: 450px">
					<div class="pop_col_name">
						<p class="pop_col_nlabel">名称</p>
						<input class="pop_col_ninput" placeholder="例如：欧式低奢亮色系风格" name="fname" value="">
					</div>
					<div class="pop_col_name">
						<p class="pop_col_nlabel">描述</p>
						<textarea class="pop_col_narea" placeholder="例如：欧式低奢亮色系风格"></textarea>
					</div>
					<div class="pop_col_priv">
						<p class="pop_col_nlabel">隐私</p>
						<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr_2" name="private" private="0">
						<label for="pop_iptpr_2"></label>
					</div>
				</div>
				<div class="pop_btnwrap" style="width: 450px">
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" onclick="$('#good_folder_outer').hide()" title="堆图家取消">取消</a>
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" style="float:right;" id="pic_cgood" title="堆图家创建">创建</a>
				</div>
			</div>
		</div>
	</div>
	<!-- 上传图片的js -->
	<!-- <script type="text/javascript" src="{{asset('web')}}/js/backupjs.js"></script> -->
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
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="geturl" title="堆图家获取">获取</a>
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
						<a href="javascript:;" class="pop_gooddelete" title="堆图家"></a>
						<img src="public/images/temp/temp (1).png" height="127" width="127" alt="堆图家">
						<!-- <div class="pop_good_toppne">主图</div> -->
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="margin-top: 17px;">上传到文件夹</span>
					<style type="text/css">
					  #search_fgood .autocomplete-container{height: 40px; width: 200px}
					  #search_fgood input{ padding-left: 20px }
					</style>
					<div class="pop_col_sinput_wrap">
						<a href="javascript:;" class="pop_col_sinputbtn" title='堆图家搜索' style="float: left;position: unset; margin-top: 10px"></a>
						<div id="search_fgood" style="padding-left: 10px"></div>
					</div>
					<select class="pop_iptselect" style="margin-top: 17px; margin-left: 140px" name="fid">
						
					</select>
				</div>

				<div class="pop_desimgwrap clearfix">
					<div class="pop_deswrap clearfix">
						<span class="pop_labelname">新建文件夹</span>
						<a href="javascript:;" class="pop_add_addnew" id="show_good_add" title="新建文件夹并上传">+</a>
						<p class="pop_add_addfont">新建文件夹并上传</p>
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
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_goodsave" id="u_b" title="堆图家保存">保存</a>
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
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding folder" title="堆图家创建">创建</a>
			</div>
		</div>
	</div>

<!-- 上传VR -->
<div class="pop_uploadvr" ng-app="upvr">
<form action="" method="post" enctype="multipart/form-data" name="uvr">
	<div class="pop_con" style="width: 550px">
		<p class="pop_tit">
			上传VR
			<span class="pop_close"></span>
		</p>
		<div class="pop_conwrap" style="height: 400px;overflow-y:scroll">
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname" style="width: 80px">标题</span>
				<input class="pop_iptname" placeholder="为这个VR场景添加一个名称和描述" name='title' value="" style="width: 350px">
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname" style="width: 80px">展示图片</span>
				<div class="pop_vrchangewrap">
					<div class="pop_vrimgwrap" style="width: 100px;height: 100px">
						<img src="{{asset('web')}}/images/temp/1.png">
					</div>
					<input type="hidden" name='kind' value="2"></input>
					<input type="hidden" name='user_id' value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"></input>
					<input class="pop_upload" type="file" name='image' id="fvr" style="display:none"></input>
					<label for="fvr" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright" style="color:#969696;float: left; cursor: pointer;">
								上传VR展示图</label>
				</div>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname" style="width: 80px">地址</span>
				<input class="pop_iptname" placeholder="粘贴这个VR场景的链接地址" name='detail_url' value="" style="width: 350px">
			</div>
			
				<div class="vr_line">
					<div class="vr-left"><span>位置</span></div>
					<div class="vr-right">
						<form class="form-inline">
					      <div id="distpicker1">
					        <div class="form-group">
					          <label class="sr-only" for="province5">Province</label>
					          <select class="form-control form-se"  id="province5"></select>
					        </div>
					        <div class="form-group">
					          <label class="sr-only" for="city5">City</label>
					          <select class="form-control form-se"  id="city5"></select>
					        </div>
					        <div class="form-group">
					          <label class="sr-only" for="district5">District</label>
					          <select class="form-control form-se"  id="district5"></select>
					        </div>
					        <input type="hidden" name="cityid" value="0"></input>
					      </div>
			    		</form>
						<script type="text/javascript">
							$("#distpicker1").distpicker({
							  province: "---- 省 ----",
							  city: "---- 市 ----",
							  district: "---- 区县 ----",
							  autoSelect: false
							});

							$('.form-se').change(function(){
								var s1 = $('.form-se').eq(0).find('option:selected').attr('data-code')
								var s2 = $('.form-se').eq(1).find('option:selected').attr('data-code')
								var s3 = $('.form-se').eq(2).find('option:selected').attr('data-code')
								if(s1!='' && s2==''){
									$('input[name=cityid]').val(s1)
								}
								if(s1!='' && s2!='' && s3==''){
									$('input[name=cityid]').val(s2)
								}
								if(s1!='' && s2!='' && s3!=''){
									$('input[name=cityid]').val(s3)
								}
								if(s1=='' && s2=='' && s3==''){
									$('input[name=cityid]').val("0")
								}
							})
						</script>		
					</div>
				</div>

				<div class="vr_line">
					<div class="vr-left"><span>类型</span></div>
					<div class="vr-right">
						<div class="select hourse-type" ng-controller="type">
							<label data-val="{%v.id%}" ng-repeat="v in type" onclick="changeType(this)"><i></i>{%v.name%}</label>
							<input type="hidden" name="typeid" value="0" />
						</div>
					</div>
				</div>
				<div class="vr_line hourse">
					<div class="vr-left"><span>开发商</span></div>
					<div class="vr-right">
						<select class="pop_selects" style="margin-right: 15px;width:255px;" name='devid' ng-controller="dev">
							<option ng-repeat="v in dev" value="{%v.id%}">{%v.name%}</option>
						</select>
					</div>
				</div>
				<div class="vr_line hourse">
					<div class="vr-left"><span>户型</span></div>
					<div class="vr-right">
						<div class="select" ng-controller="huxing">
							<label data-val="{%v.id%}" ng-repeat="v in huxing" onclick="changeid(this)"><i></i>{%v.name%}</label>
							<input type="hidden" name="huid" value="0" />
						</div>
					</div>
				</div>
				
				<div class="vr_line shop">
					<div class="vr-left"><span>所在卖场</span></div>
					<div class="vr-right">
						<select class="pop_selects" style="margin-right: 15px;width:255px;" name='saleid' ng-controller="sale">
							<option ng-repeat="v in sale" value="{%v.id%}">{%v.name%}</option>
						</select>
					</div>
				</div>
				<div class="vr_line shop">
					<div class="vr-left"><span>门店类型</span></div>
					<div class="vr-right">
						<div class="select" ng-controller="btype">
							<label data-val="{%v.id%}" ng-repeat="v in btype" onclick="changeid(this)"><i></i>{%v.name%}</label>
							<input type="hidden" name="btypeid" value="0" />
						</div>
					</div>
				</div>
				<div class="vr_line">
					<div class="vr-left"><span>文件夹</span></div>
					<div class="vr-right" style="height: 90px">
						<div class="pop_namewrap clearfix" style="padding: 0">
							<style type="text/css">
							  #search_fvr .autocomplete-container{height: 40px; width: 200px}
							  #search_fvr input{ padding-left: 20px }
							</style>
							<div class="pop_col_sinput_wrap">
								<a href="javascript:;" class="pop_col_sinputbtn" title='堆图家搜索' style="float: left;position: unset; margin-top: 10px"></a>
								<div id="search_fvr" style="padding-left: 10px"></div>
							</div>
							<select class="pop_labelselect" style="margin-right: 15px;width:200px;" name='fid'>
							</select>
						</div>
					</div>
				</div>
		</div>
		
		<div class="pop_btnwrap">
			<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消">取消</a>
			<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="uvr" title="堆图家上传">上传</a>
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
	$('.hourse',$('.pop_uploadvr')).css('display','none');
	$('.shop',$('.pop_uploadvr')).css('display','none');
	function changeType(obj){
		var _val=$(obj).attr('data-val');
		if(_val=='4'){
			
			$('.hourse',$('.pop_uploadvr')).find('input[type=hidden]').val("0")
			$('.hourse',$('.pop_uploadvr')).find('label').removeClass("on")
			for (var i = 0; i < $('select.pop_selects',$('.pop_uploadvr')).length; i++) {
				$('select.pop_selects',$('.pop_uploadvr')).eq(i).find('option').removeAttr('selected')
			}

			$('.hourse',$('.pop_uploadvr')).css('display','none');
			$('.shop',$('.pop_uploadvr')).css('display','block');
		}else{
			
			$('.shop',$('.pop_uploadvr')).find('input[type=hidden]').val("0")
			$('.shop',$('.pop_uploadvr')).find('label').removeClass("on")
			for (var i = 0; i < $('select.pop_selects',$('.pop_uploadvr')).length; i++) {
				$('select.pop_selects',$('.pop_uploadvr')).eq(i).find('option').removeAttr('selected')
			}
			$('.shop',$('.pop_uploadvr')).css('display','none');
			$('.hourse',$('.pop_uploadvr')).css('display','block');
		}
		
		if(!$(obj).hasClass('on')){
			$(obj).addClass('on').siblings().removeClass('on');
			$(obj).siblings('input').val($(obj).attr('data-val'));
		}
	}
	function changeid(obj){
		
		if(!$(obj).hasClass('on')){
			$(obj).addClass('on').siblings().removeClass('on');
			$(obj).siblings('input').val($(obj).attr('data-val'));
		}
	}
	
</script>



<!-- 上传出清商品 -->
<div class="pop_uploadcg" style="display: none">
<form action="" method="post" enctype="multipart/form-data" name="ucq">
	<div class="pop_con" style="width: 550px">
		<p class="pop_tit">
			上传出清商品
			<span class="pop_close" onclick="$('.pop_uploadcg').hide()"></span>
		</p>
		<div class="pop_conwrap" style="height: 400px;overflow-y:scroll; background: none">
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname" style="width: 80px">标题</span>
				<input class="pop_iptname" placeholder="为这个出清商品添加一个名称" name='title' value="" style="width: 350px">
			</div>

			<div class="pop_namewrap clearfix">
				<span class="pop_labelname" style="width: 80px">描述</span>
				<textarea class="pop_iptdes" placeholder="关于出清商品的描述" style="width: 350px" name="description"></textarea>
			</div>
			<style type="text/css">
				.pop_namewrap .sales_pic_add .pop_addpic_wrap_cq{ margin:0 1px; }
			</style>
			<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">商品图片</span>
					<div class="sales_pic_add clearfix" style="display: inline-block;">
						<div class="pop_addpic_con clearfix" style="float:left">
						    <div class="pop_addpic_wrap_cq" style="float:left;">
				              <img src="{{asset('web')}}/images/pop_upload_multi.png" alt="堆图家" />
				              <input type="file" name="image[]"/>
				            </div>
			            </div>
			            <div class="pop_addpic_con clearfix" style="float:left">
						    <div class="pop_addpic_wrap_cq" style="float:left;">
				              <img src="{{asset('web')}}/images/pop_upload_multi.png" alt="堆图家" />
				              <input type="file" name="image[]"/>
				            </div>
			            </div>
			            <div class="pop_addpic_con clearfix" style="float:left">
						    <div class="pop_addpic_wrap_cq" style="float:left;">
				              <img src="{{asset('web')}}/images/pop_upload_multi.png" alt="堆图家" />
				              <input type="file" name="image[]"/>
				            </div>
			            </div>
			            <div class="pop_addpic_con clearfix" style="float:left">
						    <div class="pop_addpic_wrap_cq" style="float:left;">
				              <img src="{{asset('web')}}/images/pop_upload_multi.png" alt="堆图家" />
				              <input type="file" name="image[]"/>
				            </div>
			            </div>
			            <div class="pop_addpic_con clearfix" style="float:left">
						    <div class="pop_addpic_wrap_cq" style="float:left;">
				              <img src="{{asset('web')}}/images/pop_upload_multi.png" alt="堆图家" />
				              <input type="file" name="image[]"/>
				            </div>
			            </div>
			           
					</div>
				</div>
			
			
			
				<div class="vr_line">
					<div class="vr-left"><span>位置</span></div>
					<div class="vr-right">
						<form class="form-inline">
					      <div id="distpicker_cq">
					        <div class="form-group">
					          <label class="sr-only" for="province_cq">Province</label>
					          <select class="form-control form-se-cq"  id="province_cq"></select>
					        </div>
					        <div class="form-group">
					          <label class="sr-only" for="city_cq">City</label>
					          <select class="form-control form-se-cq"  id="city_cq"></select>
					        </div>
					        <div class="form-group">
					          <label class="sr-only" for="district_cq">District</label>
					          <select class="form-control form-se-cq"  id="district_cq"></select>
					        </div>
					        <input type="hidden" name="cityid" value="0"></input>
					      </div>
			    		</form>
						<script type="text/javascript">
							$("#distpicker_cq").distpicker({
							  province: "---- 省 ----",
							  city: "---- 市 ----",
							  district: "---- 区县 ----",
							  autoSelect: false
							});

							$('.form-se-cq').change(function(){
								var s1 = $('.form-se-cq').eq(0).find('option:selected').attr('data-code')
								var s2 = $('.form-se-cq').eq(1).find('option:selected').attr('data-code')
								var s3 = $('.form-se-cq').eq(2).find('option:selected').attr('data-code')
								if(s1!='' && s2==''){
									$('input[name=cityid]',$('#distpicker_cq')).val(s1)
								}
								if(s1!='' && s2!='' && s3==''){
									$('input[name=cityid]',$('#distpicker_cq')).val(s2)
								}
								if(s1!='' && s2!='' && s3!=''){
									$('input[name=cityid]',$('#distpicker_cq')).val(s3)
								}
								if(s1=='' && s2=='' && s3==''){
									$('input[name=cityid]',$('#distpicker_cq')).val("0")
								}
							})
						</script>		
					</div>
				</div>

				<div class="pop_namewrap clearfix" style="clear: both">
					<span class="pop_labelname" style="width: 80px">来源</span>
	
					<span class="pop_labelname" style="width: 30px;float: none">个人</span>
					<input type="radio" name="source" value="1" checked="checked" />
					
					<span class="pop_labelname" style="width: 30px;float: none">商家</span>
					<input type="radio" name="source" value="2"/>

				</div>

				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">价格</span>
	
					<span class="pop_labelname" style="width: 40px;float: none">出价</span>
					<input type="text" class="pop_iptname"  name="reserve_price" value="" style="width: 50px;float: none" />
						 
					<span class="pop_labelname" style="width: 40px;float: none; margin-left: 10px">原价</span>
					<input type="text" class="pop_iptname" name="price" value="" style="width: 50px;float: none"/>

				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">联系方式</span>
					<input class="pop_iptname" value="" placeholder="电话号/微信号" name="contact" style="width: 350px">
				</div>
				<div class="pop_namewrap fenlei clearfix">
					<span class="pop_labelname" style="width: 80px">分类</span>
					<select name="f_select"  class="pop_iptname" style="width: 170px">
						<option value="1">沙发</option>
						<option value="2">桌</option>
						<option value="3">床</option>
						<option value="4">柜</option>
						<option value="5">架子</option>
						<option value="6">装饰摆设</option>
						<option value="7">灯饰</option>
						<option value="8">家纺家饰</option>
						<option value="9">卫生间</option>
						<option value="10">花艺植物</option>
						<option value="11">厨房用品</option>
						<option value="12">其他</option>
					</select>
					<select name="s_select" class="pop_iptname" style="width: 200px;margin-left: 10px">
						<option value="">三人沙发</option>
						<option value="">双人沙发</option>
						<option value="">单人沙发</option>
						<option value="">沙发床</option>
						<option value="">布艺沙发</option>
						<option value="">皮质沙发</option>
						<option value="">古典沙发</option>
						<option value="">现代沙发</option>
						<option value="">美式沙发</option>
						<option value="">东南亚沙发</option>
						<option value="">简欧沙发</option>
						<option value="">日式沙发</option>
					</select>
					<input type="hidden" name="tags" value="沙发三人沙发"></input>
				</div>
				<input type="hidden" name="user_id" value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id'];?>"/>
				
		</div>
		
		<div class="pop_btnwrap">
			<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消" onclick="$('.pop_uploadcg').hide()">取消</a>
			<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="ucq" title="堆图家上传">上传</a>
		</div>
	</div>
</form>
</div>


<!-- 采集时选择文件夹 -->
	<div class="pop_collect p_collect" style="display: none" img_id="" id="collect_outer">
		<div class="pop_con">
			<div class="pop_col_left" style="height: 400px">
				<div class="pop_col_ltop clearfix">
					<img src=""  width="668" alt="堆图家">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="" style="resize: none; padding: 0"></textarea>
					</div>
					
					<!-- <a href="javascript:;" class="detail_pop_colledit"></a> -->
				</div>
				
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close"></span>
					 <p class="pop_col_tips">
					 该文件已采集到<a href="javascript:;">工业风格</a>文件夹
					 </p>
					<div class="pop_col_sinput_wrap">
						<a href="javascript:;" class="pop_col_sinputbtn" title="堆图家搜索"></a>
						<input class="pop_col_sinput" placeholder="搜索">
						<div id="search_form_outer"></div>
					</div>
					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<!-- <div class="pop_col_alphabet">
							<a href="javascript:;" class="pop_col_alpbtn">A</a><a href="javascript:;" class="pop_col_alpbtn">B</a><a href="javascript:;" class="pop_col_alpbtn">C</a><a href="javascript:;" class="pop_col_alpbtn">D</a><a href="javascript:;" class="pop_col_alpbtn">E</a><a href="javascript:;" class="pop_col_alpbtn">F</a><a href="javascript:;" class="pop_col_alpbtn">G</a><a href="javascript:;" class="pop_col_alpbtn">H</a><a href="javascript:;" class="pop_col_alpbtn">I</a><a href="javascript:;" class="pop_col_alpbtn">J</a><a href="javascript:;" class="pop_col_alpbtn">K</a><a href="javascript:;" class="pop_col_alpbtn">L</a><a href="javascript:;" class="pop_col_alpbtn">M</a><a href="javascript:;" class="pop_col_alpbtn">N</a><a href="javascript:;" class="pop_col_alpbtn">O</a><a href="javascript:;" class="pop_col_alpbtn">P</a><a href="javascript:;" class="pop_col_alpbtn">Q</a><a href="javascript:;" class="pop_col_alpbtn">R</a><a href="javascript:;" class="pop_col_alpbtn">S</a><a href="javascript:;" class="pop_col_alpbtn">T</a><a href="javascript:;" class="pop_col_alpbtn">U</a><a href="javascript:;" class="pop_col_alpbtn">V</a><a href="javascript:;" class="pop_col_alpbtn">W</a><a href="javascript:;" class="pop_col_alpbtn">X</a><a href="javascript:;" class="pop_col_alpbtn">Y</a><a href="javascript:;" class="pop_col_alpbtn">Z</a>
						</div> -->
						<ul class="pop_col_colum" id="search_outer">
							
						</ul>
						<p class="pop_col_new">最新保存到</p>
						<ul class="pop_col_colum pop_col_colum_new">
							
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all">
							
							
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew" id="pop_add_addnew_outer" title="堆图家新建文件夹">+</a>
					<p class="pop_add_addfont">新建文件夹并保存</p>
				</div>
			</div>
		</div>
	</div>
	<!-- 采集时新建文件夹并保存 -->
	<div class="pop_collect p_folder" style="display: none" id="folder_outer">
		<div class="pop_con">
			<div class="pop_col_left" style="height: 400px">
				<div class="pop_col_ltop clearfix">
					<img src="" width="668" alt="堆图家">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="" style="padding: 0"></textarea>
					</div>
					
					<!-- <a href="javascript:;" class="detail_pop_colledit"></a> -->
				</div>
			
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					创建文件夹
					<span class="pop_close"></span>
				</div>
				<div class="pop_col_infowrap">
					<div class="pop_col_name">
						<p class="pop_col_nlabel">名称</p>
						<input class="pop_col_ninput" placeholder="" name="fname" value="">
					</div>
					<div class="pop_col_name">
						<p class="pop_col_nlabel">描述</p>
						<textarea class="pop_col_narea" placeholder=""></textarea>
					</div>
					<div class="pop_col_priv">
						<p class="pop_col_nlabel">隐私</p>
						<input class="pop_iptprivacy" type="checkbox" id="pop_iptprs" name="private" private="0">
						<label for="pop_iptprs"></label>
					</div>
				</div>
				<div class="pop_btnwrap">
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消">取消</a>
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" style="float:right;" id="cfolder_outer" title="堆图家创建">创建</a>
				</div>
			</div>
		</div>
	</div>


<!-- 留言 -->
	<div class="pop_letter" style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				<span class="pop_tit_center">给他留言</span>
				<span class="pop_close" onclick="$('.pop_letter').hide()"></span>
			</p>
			<div class="letter_con">
				
				<div class="letter_content">
					<div style="overflow-y: scroll; height: 260px" id="letter_content">
						
					</div>
					<div class="letter_textarea">
						<textarea name="message"></textarea>
					</div>
				</div>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" id="send_new_message" to_id="<?php if(!empty($user_id)) echo $user_id; ?>" pic_m="
				<?php if(!empty($self_info['pic_m'])) echo $self_info['pic_m']; ?>" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" onclick="sendMess(this)">发送留言</a>
			</div>
		</div>
	</div>