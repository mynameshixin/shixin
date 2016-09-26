<!DOCTYPE html>
<html lang="en">
<head>
	@include('web.common.head')
</head>
<body id="ashow">

	<script type="text/javascript">
		defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
		user_id = "{{$user_id}}"
		self_id = "{{$self_id}}"
		relationUrl = "{{url('webd/user/relation')}}"
	</script>
	<script type="text/javascript" src="{{asset('web')}}/js/user/relation.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/like.js"></script>
	@include('web.common.banner')
	
	<!-- 编辑VR -->
	<div class="pop_editvr"  style="display:none;" >
	<form action="" method="post" enctype="multipart/form-data" name="evr">
		<div class="pop_con" style="width: 550px">
			<p class="pop_tit">
				编辑VR
				<span class="pop_close" onclick="$('.pop_editvr').hide()"></span>
			</p>
			<div class="pop_conwrap" >
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">标题</span>
					<input class="pop_iptname" placeholder="为这个VR场景添加一个名称和描述" name='title' value="{{$goods['title']}}" style="width: 350px">
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">展示图片</span>
					<div class="pop_vrchangewrap">
						<div class="pop_vrimgwrap" style="width: 100px;height: 100px">
							<img src="{{$goods['images'][0]['img_m']}}">
						</div>
						<input type="hidden" name='kind' value="2"></input>
						<input type="hidden" name='user_id' value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"></input>
						<input class="pop_upload" type="file" name='image' id="evr" style="display:none"></input>
						<label for="evr" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright" style="color:#969696;float: left; cursor: pointer;">
									上传VR展示图</label>
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">地址</span>
					<input class="pop_iptname" placeholder="粘贴这个VR场景的链接地址" name='detail_url' value="{{$goods['detail_url']}}" style="width: 350px">
				</div>

					<div class="vr_line">
						<div class="vr-left"><span>位置</span></div>
						<div class="vr-right r1">
							<span style="font-size: 14px;color:#a1a1a1; cursor: pointer;">{{$goods['cityname']}}</span>
							<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" style="margin: 0 0 0 10px" title="设置位置" onclick="$('.r2').show();$('.r1').hide()">设置位置</a>
						</div>
						<div class="vr-right r2" style="display: none">
							
							<form class="form-inline" >
						      <div id="distpicker3">
						        <div class="form-group">
						          <label class="sr-only" for="province5">Province</label>
						          <select class="form-control form-see"  id="province5"></select>
						        </div>
						        <div class="form-group">
						          <label class="sr-only" for="city5">City</label>
						          <select class="form-control form-see"  id="city5"></select>
						        </div>
						        <div class="form-group">
						          <label class="sr-only" for="district5">District</label>
						          <select class="form-control form-see"  id="district5"></select>
						        </div>
						        <input type="hidden" name="cityid" value="{{$goods['cityid']}}" id="cityid"></input>
						      </div>
				    		</form>
							<script type="text/javascript">
								$("#distpicker3").distpicker({
								  province: "---- 省 ----",
								  city: "---- 市 ----",
								  district: "---- 区县 ----",
								  autoSelect: false
								});

								$('.form-see').change(function(){
									var s1 = $('.form-see').eq(0).find('option:selected').attr('data-code')
									var s2 = $('.form-see').eq(1).find('option:selected').attr('data-code')
									var s3 = $('.form-see').eq(2).find('option:selected').attr('data-code')
									if(s1!='' && s2==''){
										$('#cityid').val(s1)
									}
									if(s1!='' && s2!='' && s3==''){
										$('#cityid').val(s2)
									}
									if(s1!='' && s2!='' && s3!=''){
										$('#cityid').val(s3)
									}
									if(s1=='' && s2=='' && s3==''){
										$('#cityid').val("0")
									}
								})
							</script>		
						</div>
					</div>

					<div class="vr_line">
						<div class="vr-left"><span>类型</span></div>
						<div class="vr-right">
							<div class="select hourse-type" ng-controller="type">
								<?php foreach ($goods['type'] as $key => $v) {?>
									<label data-val="{{$v['id']}}" <?php if($goods['typeid'] == $v['id']) echo "class='on'"; ?> onclick="changeeType(this)"><i></i>{{$v['name']}}</label>
								<?php } ?>
								
								<input type="hidden" name="typeid" value="{{$goods['typeid']}}" />
							</div>
						</div>
					</div>
					<div class="vr_line hourse" <?php if($goods['typeid']==4) echo 'style=display:none' ?>>
						<div class="vr-left"><span>开发商</span></div>
						<div class="vr-right">
							<select class="pop_selects" style="margin-right: 15px;width:255px;" name='devid'>
								<?php foreach ($goods['dev'] as $key => $v) {?>
									<option value="{{$v['id']}}" <?php if($v['id']==$goods['devid']) echo 'selected'; ?>>{{$v['name']}}</option>
								<?php } ?>
								
							</select>
						</div>
					</div>
					<div class="vr_line hourse" <?php if($goods['typeid']==4) echo 'style=display:none' ?>> 
						<div class="vr-left"><span>户型</span></div>
						<div class="vr-right">
							<div class="select">
								<?php foreach ($goods['huxing'] as $key => $v) {?>
									<label data-val="{{$v['id']}}" <?php if($goods['huid'] == $v['id']) echo "class='on'"; ?> onclick="changeid(this)"><i></i>{{$v['name']}}</label>
								<?php } ?>
								
								<input type="hidden" name="huid" value="{{$goods['huid']}}" />
							</div>
						</div>
					</div>
					
					<div class="vr_line shop" <?php if($goods['typeid']!=4) echo 'style=display:none' ?>>
						<div class="vr-left"><span>所在卖场</span></div>
						<div class="vr-right">
							<select class="pop_selects" style="margin-right: 15px;width:255px;" name='saleid'>
								<?php foreach ($goods['sales'] as $key => $v) {?>
									<option value="{{$v['id']}}" <?php if($v['id']==$goods['saleid']) echo 'selected'; ?>>{{$v['name']}}</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="vr_line shop" <?php if($goods['typeid']!=4) echo 'style=display:none' ?>>
						<div class="vr-left"><span>门店类型</span></div>
						<div class="vr-right">
							<div class="select">
								<?php foreach ($goods['btype'] as $key => $v) {?>
									<label data-val="{{$v['id']}}" <?php if($goods['btypeid'] == $v['id']) echo "class='on'"; ?> onclick="changeid(this)"><i></i>{{$v['name']}}</label>
								<?php } ?>
								<input type="hidden" name="btypeid" value="{{$goods['btypeid']}}" />
							</div>
						</div>
					</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">文件夹</span>
					<select class="pop_labelselect" style="margin-right: 15px;width:200px;" name='fid'>
						
					</select>
				</div>
				<input type="hidden" name="good_id" value="{{$goods['id']}}" />
			</div>
		
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding dgood" style="float: left" title="堆图家删除">删除</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消" onclick="$('.pop_editvr').hide()">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="efvr"  title="堆图家编辑VR">编辑</a>
			</div>
		</div>
	</form>
	</div>
	
	<!-- 编辑商品 -->
	<div class="pop_editgood"  style="display:none;" >
	<form action="" method="post" enctype="multipart/form-data" name="egood">
		<div class="pop_con" style="width: 550px">
			<p class="pop_tit">
				编辑商品
				<span class="pop_close" onclick="$('.pop_editgood').hide()"></span>
			</p>
			<div class="pop_conwrap" >
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">标题</span>
					<input class="pop_iptname" placeholder="添加一个名称和描述" name='title' value="{{$goods['title']}}" style="width: 350px">
				</div>
				
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">来自</span>
					<input class="pop_iptname" placeholder="图片来源地址" name='detail_url' value="{{$goods['source_url']}}" style="width: 350px">
				</div>
				
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">品类</span>
					<select class="pop_selects" style="margin-right: 15px;width:200px;" name='pinlei'>
						<option>沙发</option>
						<option>桌</option>
						<option>床</option>
						<option>柜</option>
						<option>架子</option>
						<option>装饰摆设</option>
						<option>灯饰</option>
						<option>家纺家饰</option>
						<option>卫生用品</option>
						<option>花艺植物</option>
						<option>厨房用品</option>
					</select>
				</div>

				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">空间</span>
					<select class="pop_selects" style="margin-right: 15px;width:200px;" name='kongjian'>
						<option>客厅</option>
						<option>玄关</option>
						<option>餐厅</option>
						<option>卧室</option>
						<option>阳台</option>
						<option>厨房</option>
						<option>书房</option>
						<option>阳光房</option>
						<option>庭院</option>
						<option>花园</option>
						<option>衣帽间</option>
						<option>卫生间</option>
						<option>酒窖</option>
						<option>阁楼</option>
						<option>走道</option>
						<option>楼梯过厅</option>
						<option>儿童房</option>
						<option>餐厅店</option>
						<option>酒店</option>
						<option>民宿</option>
						<option>售楼处</option>
						<option>样板房</option>
						<option>办公室</option>
						<option>商业广场</option>
					</select>
				</div>

				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">风格</span>
					<select class="pop_selects" style="margin-right: 15px;width:200px;" name='fengge'>
						<option>现代</option>
						<option>北欧</option>
						<option>日式</option>
						<option>法式</option>
						<option>新中式</option>
						<option>新古典</option>
						<option>简欧</option>
						<option>古典中式</option>
						<option>古典</option>
						<option>地中海</option>
						<option>LOFT</option>
						<option>东南亚</option>
						<option>工业</option>
						<option>田园</option>
						<option>美式简约</option>
						<option>巴洛克</option>
						<option>意大利</option>
						<option>混搭</option>
					</select>
				</div>

				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">主题色</span>
					<select class="pop_selects" style="margin-right: 15px;width:200px;" name='zhutise'>
						<option>红</option>
						<option>橙</option>
						<option>黄</option>
						<option>绿</option>
						<option>青</option>
						<option>蓝</option>
						<option>紫</option>
						<option>黑</option>
						<option>白</option>
						<option>灰</option>
					</select>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname" style="width: 80px">文件夹</span>
					<select class="pop_labelselect" style="margin-right: 15px;width:200px;" name='fid'>
						
					</select>
				</div>
				<input type="hidden" name="good_id" value="{{$goods['id']}}" />
				<input type="hidden" name="kind" value="2" />
			</div>
		
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding dgood" style="float: left" title="堆图家删除">删除</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" title="堆图家取消" onclick="$('.pop_editgood').hide()">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" id="egood"  title="堆图家编辑">编辑</a>
			</div>
		</div>
	</form>
	</div>

	<script type="text/javascript">
		/*$('.hourse',$('.pop_editvr')).css('display','none');
		$('.shop',$('.pop_editvr')).css('display','none');*/
		function changeeType(obj){
			var _val=$(obj).attr('data-val');
			if(_val=='4'){
				
				$('.hourse',$('.pop_editvr')).find('input[type=hidden]').val("0")
				$('.hourse',$('.pop_editvr')).find('label').removeClass("on")
				for (var i = 0; i < $('select.pop_selects',$('.hourse',$('.pop_editvr'))).length; i++) {
					$('select.pop_selects',$('.hourse',$('.pop_editvr'))).eq(i).find('option').removeAttr('selected')
				}

				$('.hourse',$('.pop_editvr')).css('display','none');
				$('.shop',$('.pop_editvr')).css('display','block');
			}else{
				
				$('.shop',$('.pop_editvr')).find('input[type=hidden]').val("0")
				$('.shop',$('.pop_editvr')).find('label').removeClass("on")
				for (var i = 0; i < $('select.pop_selects',$('.shop',$('.pop_editvr'))).length; i++) {
					$('select.pop_selects',$('.shop',$('.pop_editvr'))).eq(i).find('option').removeAttr('selected')
				}
				$('.shop',$('.pop_editvr')).css('display','none');
				$('.hourse',$('.pop_editvr')).css('display','block');
			}
			
			if(!$(obj).hasClass('on')){
				$(obj).addClass('on').siblings().removeClass('on');
				$(obj).siblings('input').val($(obj).attr('data-val'));
			}
		}
		$(function(){
			// 点击弹出编辑VR
			$('.edit_vr').click(function(){
				if(u_id==''){
			      layer.msg('需要登录',{'icon':5})
			      return
				}
			    $.ajax({
			          'beforeSend':function(){
			            layer.load(0, {shade: 0.5});
			          },
			          'url':"/webd/pics/cgoods",
			          'type':'post',
			          'data':{
			            'user_id':u_id
			          },
			          'dataType':'json',
			          'success':function(json){
			            if(json.code==200){
			              $('.pop_editvr .pop_labelselect').html('')
			              strs = ''
			              $.each(json.data.folder,function(index,v){
			                strs += '<option value="'+v.id+'">'+v.name+'</option>';
			              })
			              $('.pop_editvr .pop_labelselect').html(strs)
			            }else{
			              layer.msg(json.message, {icon: 5});
			              return
			            }
			          },
			          'complete':function(){
			            layer.closeAll('loading');
			          }
			        })
					$('.pop_editvr').show();
					var poptopHei = $('.pop_editvr .pop_con').height();
				    $('.pop_editvr .pop_con').css({
				       'margin-top':-(poptopHei/2)
				    })
				})

			// 点击弹出编辑图片
			$('.edit_good').click(function(){
				if(u_id==''){
			      layer.msg('需要登录',{'icon':5})
			      return
				}
			    $.ajax({
			          'beforeSend':function(){
			            layer.load(0, {shade: 0.5});
			          },
			          'url':"/webd/pics/cgoods",
			          'type':'post',
			          'data':{
			            'user_id':u_id
			          },
			          'dataType':'json',
			          'success':function(json){
			            if(json.code==200){
			              $('.pop_editgood .pop_labelselect').html('')
			              strs = ''
			              $.each(json.data.folder,function(index,v){
			                strs += '<option value="'+v.id+'">'+v.name+'</option>';
			              })
			              $('.pop_editgood .pop_labelselect').html(strs)
			            }else{
			              layer.msg(json.message, {icon: 5});
			              return
			            }
			          },
			          'complete':function(){
			            layer.closeAll('loading');
			          }
			        })
					$('.pop_editgood').show();
					var poptopHei = $('.pop_editgood .pop_con').height();
				    $('.pop_editgood .pop_con').css({
				       'margin-top':-(poptopHei/2)
				    })
				})
			})
		// vr编辑保存上传
	    $('form[name=evr]').submit(function(){
	        uvr = $('form[name=evr]').serialize()
	        $(this).ajaxSubmit({
	          type:"post",  //提交方式
	          dataType:"json", //数据类型
	          url:"/webd/folder/uvr", //请求url
	          success:function(json){ //提交成功的回调函数
	              if(json.code==200) {
	                layer.msg('成功编辑',{icon: 6});
	                setTimeout(function(){
	                  location.reload()
	                },1000)
	              }else{
	                layer.msg(json.message, {icon: 5});
	                return
	              } 
	          },
	          //resetForm:1
	        });
	        return false
	    })
	    $('#efvr').click(function(){
	      /*if($('#evr').val()==''){
	            layer.msg('没有选择图片', {icon: 5});
	            return
	      }*/
	      $('form[name=evr]').submit()
	    })

	    // 图片编辑保存上传
	    $('form[name=egood]').submit(function(){
	    	var egood = $('form[name=egood]')
	    	var title = $('input[name=title]',egood).val()
	    	var detail_url = $('input[name=detail_url]',egood).val()
	    	var fid = $('select[name=fid]',egood).val()
	    	var good_id = $('input[name=good_id]',egood).val()
	    	var ptags = $('select[name=pinlei]',egood).val()+';'+$('select[name=kongjian]',egood).val()+';'+$('select[name=fengge]',egood).val()+';'+$('select[name=zhutise]',egood).val()
	        $.ajax({
	          type:"post",  //提交方式
	          dataType:"json", //数据类型
	          url:"/webd/folder/egood", //请求url
	          data:{
	          	'kind':2,
	          	'title':title,
	          	'source_url':detail_url,
	          	'fid':fid,
	          	'tags':ptags,
	          	'user_id':u_id,
	          	'good_id':good_id
	          },
	          success:function(json){ //提交成功的回调函数
	              if(json.code==200) {
	                layer.msg('成功编辑',{icon: 6});
	                setTimeout(function(){
	                  location.reload()
	                },1000)
	              }else{
	                layer.msg(json.message, {icon: 5});
	                return
	              } 
	          },
	        });
	        return false
	    })
	    $('#egood').click(function(){
	      $('form[name=egood]').submit()
	    })

	    //vr change
	    $("#evr").on("change",function(){
	        var filePath=$(this).val();
	        if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1){
	            var arr=filePath.split('\\');
	            var fileName=arr[arr.length-1];
	            var file = fileName.substring(0,fileName.lastIndexOf('.'))
	            files = getObjectURL(this.files[0]);
	            $(this).parents('.pop_vrchangewrap').find('.pop_vrimgwrap img').attr('src',files)

	        }else{
	            layer.msg('文件类型不正确', {icon: 5});
	            return false 
	        }
	    })
	    // 删除商品或者vr
	    $('.dgood').click(function(){
	    	layer.msg('确定删除该文件？', {
	    		  time:0,
				  btn: ['确定','取消'],
				  yes:function(index){
				  	layer.close(index)
				  	$.ajax({
						'beforeSend':function(){
							layer.load(0, {shade: 0.5});
						},
						'url':"/webd/pics/del",
						'type':'post',
						'data':{
							'folder_id':"{{$goods['folder_id']}}",'user_id':'<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id'];?>',
							'good_id':"{{$goods['id']}}"
						},
						'dataType':'json',
						'success':function(json){
							if(json.code==200){
								layer.msg('成功删除',{icon: 6});
								location.href = "/webd/folder?fid={{$goods['folder_id']}}"
							}else{
								layer.msg(json.message, {icon: 5});
								return
							}
						},
						'complete':function(){
							layer.closeAll('loading');
						}
					})
				  }
				})
	    })
	</script>
	<div class="detail_pop">
		
		<a href="javascript:;" class="detail_pop_loadclose" style="display: block; top:0;right: 30px" onclick="$('.detail_pop_o').hide();$('body').attr('style','')"></a>
		<a href="{{url('webd/pic/')}}/{{$goods['more']['pre'] or '#'}}" class="detail_pop_loadbtn detail_pop_loadleft" title="上一个"></a>
		<a href="{{url('webd/pic/')}}/{{$goods['more']['next'] or '#'}}" class="detail_pop_loadbtn detail_pop_loadright" title="下一个"></a>

		<div class="perhome_scroll_wrap shadow" style="transform: translate(0px, 0px); transition: transform 200ms ease; display: none; position: fixed;">
			<div class="w1248 w1240 clearfix" style="width: 990px">
				<div class="perhome_scroll_info" style="transform: translate(0px, 0px); transition: transform 200ms ease;">
					<div class="detail_filebtn_wrap clearfix" style="float: left; padding-top: 8px">
						<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtnbuy detail_pop_tbtn_cpadding detail_pop_collection">保存</div>
						<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtnlike detail_pop_tbtn_cpadding <?php if($goods['action']) echo 'detail_pop_tbtnlikeon' ?>">喜欢</div>
						<?php if(!empty($goods['detail_url']) && $goods['kind']==2 && $self_id==$goods['user_id']): ?>
						<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright edit_vr">编辑VR</div>
						<?php endif; ?>
						<?php if(empty($goods['detail_url']) && $goods['kind']==2 && $self_id==$goods['user_id']): ?>
						<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright edit_good">编辑</div>
						<?php endif; ?>
						<div class="detail_pop_tbtn detail_pop_tbtnright">
								<div class="detail_pop_tbtn_click detail_fileb_pr">
									分享
									<var class="detail_pop_tbtntril"></var>
								</div>
								<div class="detail_fileb_select slideup">
									<div class="detail_fileb_selectw">
										<span class="jiathis_style_32x32" id="own_share">
											<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
											<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
											<a class="jiathis_button_tsina detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/weibo.png" height="19" width="19" alt="">微博</a>
											<a class="jiathis_button_douban detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/douban.png" height="19" width="19" alt="">豆瓣</a>
										</span>
										<var class="detail_fileb_setril"></var>
									</div>
								</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="detail_pop_wrap w990 clearfix">
			<div class="detail_pop_top clearfix">
				<div class="detail_pop_tleft">
					<div class="detail_pop_tltop">
						<div class="detail_pop_tbtnwarp">
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtnbuy detail_pop_tbtn_cpadding detail_pop_collection">保存</div>
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtnlike detail_pop_tbtn_cpadding <?php if($goods['action']) echo 'detail_pop_tbtnlikeon' ?>">喜欢</div>
							<?php if(!empty($goods['detail_url']) && $goods['kind']==2 && $self_id==$goods['user_id']): ?>
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright edit_vr">编辑VR</div>
							<?php endif; ?>
							<?php if(empty($goods['detail_url']) && $goods['kind']==2 && $self_id==$goods['user_id']): ?>
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright edit_good">编辑</div>
							<?php endif; ?>
							<div class="detail_pop_tbtn detail_pop_tbtnright">
								<div class="detail_pop_tbtn_click detail_fileb_pr">
									分享
									<var class="detail_pop_tbtntril"></var>
								</div>
								<div class="detail_fileb_select slideup">
									<div class="detail_fileb_selectw">
										<span class="jiathis_style_32x32" id="own_share">
											<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
											<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
											<a class="jiathis_button_tsina detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/weibo.png" height="19" width="19" alt="">微博</a>
											<a class="jiathis_button_douban detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/douban.png" height="19" width="19" alt="">豆瓣</a>
										</span>
										<var class="detail_fileb_setril"></var>
									</div>
								</div>
							</div>
							<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
							<!-- JiaThis Button END -->
						</div>

						<script type="text/javascript">
							function re668(obj){
								if($(obj).width()>668) $(obj).css('width','668px')
							}
						</script>
		
						<div class="detail_pop_timgwarp" style="overflow: hidden; text-align: center;">
						<?php if(!empty($goods['detail_url'])){ ?>
							<a href="{{$goods['detail_url']}}" target="_blank" title="{{!empty(trim($goods['description']))?$goods['description']:$goods['title']}}"><img src="{{$goods['images'][0]['img_o'] or url('uploads/sundry/blogo.jpg')}}"  onload="re668(this)" class="bigimg" alt="{{!empty(trim($goods['description']))?$goods['description']:$goods['title']}}"></a>
						<?php  }else{?>
							<?php if(!empty($goods['source_url'])){ ?>
							<a href="{{$goods['source_url']}}" target="_blank" title="{{!empty(trim($goods['description']))?$goods['description']:$goods['title']}}">
							<?php } ?>
							<img src="{{$goods['images'][0]['img_o'] or url('uploads/sundry/blogo.jpg')}}" alt="{{!empty(trim($goods['description']))?$goods['description']:$goods['title']}}" onload="re668(this)" class="bigimg">
							<?php if(!empty($goods['source_url'])){ ?> </a><?php } ?>
						<?php } ?>
							<?php if(!empty($goods['price'])): ?><div class="index_item_price"><?php  echo strpos($goods['detail_url'],'m.fancy.com')?'$':'￥'?><?php echo $goods['price'];?></div><?php endif; ?>

						<?php if(!empty($goods['detail_url']) && $goods['kind']==2){?><a href="{{$goods['detail_url']}}" target="_blank" title="vr"><img src="{{asset('web')}}/images/vrlogo.png" alt="vr" style="position: absolute; display: none; left:278.5px;top:50px; z-index: 2" id="vlogo"></a> <?php } ?>
						</div>
						<p class="detail_pop_des" title="{{!empty(trim($goods['description']))?$goods['description']:$goods['title']}}">
							{{!empty(trim($goods['description']))?$goods['description']:$goods['title']}}<a href="javascript:;" class="detail_pop_desmore" title="{{!empty(trim($goods['description']))?$goods['description']:$goods['title']}}"></a>
						</p>
						<?php if(!empty($goods['detail_url'])): ?>
							<div class="detail_pop_from">
								来自 <a href="{{$goods['detail_url']}}" class="detail_pop_fromurl" target="_blank"><?php echo mb_substr($goods['detail_url'], 0,50,'utf-8'); ?></a>
								<?php if($goods['kind']==1){ ?>
									<a href="{{$goods['detail_url']}}" target="_blank" style="float: right;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtntobuy detail_pop_tbtn_cpadding">去购买</a>
								<?php }elseif($goods['kind']==2){ ?>
									<a href="{{$goods['detail_url']}}" target="_blank" style="float: right;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding">查看VR</a>
								<?php } ?>
								<!-- <a href="javascript:;" class="detail_pop_fromwarn"></a> -->
								<!-- <a href="javascript:;" class="detail_pop_fromedit"></a> -->
							</div>
						<?php endif; ?>

						<?php if(empty($goods['detail_url']) && !empty($goods['source_url'])): ?>
							<div class="detail_pop_from">
								来自 <a href="{{$goods['source_url']}}" class="detail_pop_fromurl" target="_blank"><?php echo mb_substr($goods['source_url'], 0,50,'utf-8'); ?></a>
							</div>
						<?php endif; ?>
					</div>
					<script type="text/javascript">
						$(function(){
							var bheight = $('.bigimg').height()/2-55.5
							$('#vlogo').css({'top':bheight}).show()
						})
					</script>
					<div class="detail_pop_tlbtm">
						<div class="detail_pop_tlbtmauth clearfix">
							<div class="detail_pop_authava">
								<a href="{{url('webd/user/index')}}?oid={{$goods['user_id']}}" target="_blank" title="{{$goods['user']['nick'] or $goods['user']['username']}}"><img src="{{!empty($goods['user']['auth_avatar'])?$goods['user']['auth_avatar']:$goods['user']['pic_m']}}" alt="{{$goods['user']['nick'] or $goods['user']['username']}}"></a>
							</div>
							<div class="detail_pop_authinfo">
								<p class="detail_pop_authname"><a href="{{url('webd/user/index')}}?oid={{$goods['user_id']}}" target="_blank" title="{{$goods['user']['nick'] or $goods['user']['username']}}">{{$goods['user']['nick'] or $goods['user']['username']}}</a></p>
								<p class="detail_pop_authcollect">采集到<span>{{$goods['folder']['name']}}</span></p>
							</div>
							<a class="detail_pop_authfollow detail_filebtn detail_fileball" onclick="relation(this)" user_id="{{$goods['user_id']}}" <?php if($goods['user_id'] == $self_id): ?>style="display: none"<?php endif; ?>>
							<?php 
							switch ($goods['relation']) {
								case 1:
									echo '相互关注';
								break;
								case 2:
									echo '已关注';
								break;
								default:
									echo '<span>+</span>关注';
								break;
							}
							?>
							 </a>
						</div>
						<p class="detail_pop_tlbtmcomment">评论</p>
						<ul class="detail_pop_tlcomlist">
							<?php foreach ($goods['comments'] as $key => $v):?>

							<li class="clearfix" <?php if(!in_array($key, [0,1,2])): ?>style="display: none"<?php endif; ?>>
								<div class="detail_pop_authava">
									<a href="{{url('webd/user/index')}}?oid={{$v['user']['id']}}" title="{{$v['user']['nick'] or $v['user']['username']}}"><img src="{{!empty($v['user']['auth_avatar'])?$v['user']['auth_avatar']:$v['user']['pic_m']}}" alt="{{$v['user']['nick'] or $v['user']['username']}}"></a>
								</div>
								<div class="detail_pop_cominfo">
									<p class="detail_pop_comname"><a href="{{url('webd/user/index')}}?oid={{$v['user']['id']}}" title="{{$v['user']['nick'] or $v['user']['username']}}">{{$v['user']['nick'] or $v['user']['username']}}</a>- {{$v['min']}}前说：
									<!-- <span class="detail_pop_comshare">
										<a href="javascript:;" class="detail_pop_share1"></a>
										<a href="javascript:;" class="detail_pop_share2"></a>
										<a href="javascript:;" class="detail_pop_share3"></a>
									</span> -->
									</p>
									<p class="detail_pop_comcon">{{$v['content']}}</p>
								</div>
								<div class="detail_pop_favor" style="cursor: pointer;" onclick="comment_parise(this)" user_id="{{$self_info['id']}}" comment_id="{{$v['id']}}">{{$v['praise_count']}}</div>
							</li>

							<?php endforeach; ?>
						</ul>
						<?php if(!empty($goods['comments'])): ?><a href="javascript:;" class="detail_pop_loadmore">显示全部评论</a><?php endif; ?>
						<div class="detail_pop_compublish clearfix">
							<div class="detail_pop_authava">
								<a href="{{url('webd/user/index')}}?oid={{$self_info['id']}}" title="{{$self_info['nick'] or $self_info['username']}}"><img src="{{!empty($self_info['auth_avatar'])?$self_info['auth_avatar']:$self_info['pic_m']}}" alt="{{$self_info['nick'] or $self_info['username']}}"></a>
							</div>
							<textarea name="caption" placeholder="添加评论" class="detail_pop_compub" autocomplete="off"></textarea>
						</div>
						<div class="detail_pop_addcom clearfix">
							<a class="detail_pop_authfollow detail_filebtn detail_fileball" style="color:#000" id="add_commit_btn">添加评论</a>
						</div>
					</div>
				</div>
				<div class="detail_pop_tright">
					<div class="detail_pop_trauth clearfix">
						<div class="detail_pop_authava">
							<?php if($goods['folder']['id'] == 0){ ?>
								<img src="{{$goods['folder']['img_url']}}" alt="堆图家">
							<?php }else{ ?>
								<a href="{{url('webd/folder')}}?fid={{$goods['folder']['id']}}" target="_blank" title="{{$goods['folder']['name']}}"><img src="{{$goods['folder']['img_url']}}" alt="{{$goods['folder']['name']}}"></a>
							<?php } ?>
						</div>
						<div class="detail_pop_authinfo">
							<p class="detail_pop_authname"><a <?php if($goods['folder']['id'] != 0): ?>href="{{url('webd/folder/index')}}?fid={{$goods['folder']['id']}}"<?php endif; ?> target="_blank">{{$goods['folder']['name']}}</a></p>
							<p class="detail_pop_authcollect"><a href="{{url('webd/user/index')}}?oid={{$goods['user_id']}}" target="_blank" title="{{$goods['user']['nick'] or $goods['user']['username']}}">{{$goods['user']['nick'] or $goods['user']['username']}}</a></p>
						</div>
						<li folder_id = "{{$goods['folder']['id']}}">
							<a href="javascript:;" class="detail_pop_authfollow detail_filebtn detail_fileball" onclick="relation(this)" <?php  if($goods['user']['id']==$self_id):?>style="display: none"<?php endif; ?>>
								<?php 
									echo $goods['folder']['is_follow']==1?'已关注':'<span>+</span>特别关注';
								?>
							</a>
						</li>
						
					</div>
					<div class="detail_pop_trworks">
						<div class="detail_pop_trwwrap">
							<?php foreach ($goods['more'] as $key => $v):?>
							<?php if(!in_array((string)$key,['next','pre'])){ ?>
								<div class="detail_pop_tritem">
									<div class="index_item_wrap">
										<div class="index_item_imgwrap clearfix">
											<a title="{{!empty(trim($v['description']))?$v['description']:$v['title']}}" class="index_item_blurwrap" href="{{url('webd/pic')}}/{{$v['id']}}" <?php if($v['id']==$goods['id']) echo 'style="opacity: 0"'; ?>></a>
											<img src="{{$v['image_url']}}" alt="{{!empty(trim($v['description']))?$v['description']:$v['title']}}">
										</div>
									</div>
								</div>
							<?php } ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<?php if(!empty($goods['collection_folders'])): ?>
			<div class="detail_pop_bottom">
				<p class="detail_pop_btitle">该采集也在以下文件夹</p>
				<div class="perhome_follow_wrap clearfix">
					<ul class="find_fold_list clearfix" id="ul">
						<?php if(empty($goods['collection_folders'])): ?><p class="nodata">暂无数据</p><?php endif; ?>
						<?php foreach($goods['collection_folders'] as $k=>$v): ?>
							
							<li class="find_fold_li <?php if(($k+1)%4==0) echo 'mrightzero'; ?>" folder_id="{{$v['id']}}">
								<div class="find_fold_info clearfix">
									<div class="find_fold_authava">
										<a href="{{url('webd/user/index')}}?oid={{$v['user']['id']}}" target="_blank" title="{{$v['user']['nick'] or $v['user']['username']}}"><img src="{{!empty($v['user']['auth_avatar'])?$v['user']['auth_avatar']:$v['user']['pic_m']}}" alt="{{$v['user']['nick'] or $v['user']['username']}}"></a>
									</div>
									<div class="find_fold_tname">
										<a href="{{url('webd/folder')}}?fid={{$v['id']}}" target="_blank" class="find_fold_name" title="{{$v['name']}}">{{$v['name']}}</a>
										<a href="{{url('webd/user/index')}}?oid={{$v['user']['id']}}" target="_blank" class="find_fold_authnme" title="{{$v['user']['nick'] or $v['user']['username']}}">{{$v['user']['nick'] or $v['user']['username']}}</a>
									</div>
								</div>
								<div class="find_fold_imgwrap">
									<div class="find_fold_imgblur"></div>
									<a href="{{url('webd/folder')}}?fid={{$v['id']}}" target="_blank" class="position" title="{{$v['name']}}"><img src="{{$v['img_url']}}" alt="{{$v['name']}}" onload="rect(this)"></a>
									<div class="find_fold_catflw">{{$v['count']}}文件&nbsp;&nbsp;{{$v['collection_count']}}关注</div>
								</div>
								<div class="find_fold_limg clearfix">
									<div class="find_fold_liwrap">
										<div class="find_fold_liblur"></div>
										<a href="{{url('webd/pic')}}/{{$v['goods'][0]['id'] or '#'}}" class="position" target="_blank" title="{{$v['goods'][0]['title'] or '堆图家'}}"><img src="{{$v['goods'][0]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$v['goods'][0]['title'] or '堆图家'}}"></a>
									</div>
									<div class="find_fold_liwrap">
										<div class="find_fold_liblur"></div>
										<a href="{{url('webd/pic')}}/{{$v['goods'][1]['id'] or '#'}}" class="position" target="_blank" title="{{$v['goods'][1]['title'] or '堆图家'}}"><img src="{{$v['goods'][1]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$v['goods'][1]['title'] or '堆图家'}}"></a>
									</div>
									<div class="find_fold_liwrap">
										<div class="find_fold_liblur"></div>
										<a href="{{url('webd/pic')}}/{{$v['goods'][2]['id'] or '#'}}" class="position" target="_blank" title="{{$v['goods'][2]['title'] or '堆图家'}}"><img src="{{$v['goods'][2]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="{{$v['goods'][2]['title'] or '堆图家'}}"></a>
									</div>
								</div>
								<a href="javascript:;" class="find_fold_authflw" onclick="relation(this)" <?php  if($v['user_id']==$self_id):?>style="display: none"<?php endif; ?>>
								<?php 
									echo $v['is_follow']==1?'已关注':'<span>+</span>特别关注';
								?>
								</a>
							</li>

						<?php endforeach; ?>
					</ul>
				</div>
			<?php if(!empty($goods['collection_folders'])): ?><a href="javascript:;" class="detail_pop_baddmore" id="more">加载更多</a><?php endif; ?>
			<?php endif; ?>
			<?php if(!empty($goods['folders_one'])): ?>
			<p class="detail_pop_btitle">推荐给你的采集</p>
			<div id="main_show" role="main" class="w1248 w1240 clearfix" style="width: 1000px">
				<div class="index_con  perhome_wrap" id="tiles_show">
					<?php if(empty($goods['folders_one'])): ?><p class="nodata">暂无数据</p><?php endif; ?>
					<?php foreach($goods['folders_one'] as $k=>$v): ?>
					<div class="index_item">
						<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap" target="_blank" href="{{url('webd/pic')}}/{{$v['id']}}" title="{{!empty(trim($v['description']))?$v['description']:$v['title']}}"></a>
								<?php if(!empty($v['price'])): ?><div class="index_item_price">￥{{$v['price']}}</div><?php endif; ?>
								<img src="{{$v['image_url']}}" style="height: {{$v['rh']}}px" onload="resize_xy(this)" alt="{{!empty(trim($v['description']))?$v['description']:$v['title']}}">
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="{{!empty(trim($v['description']))?$v['description']:$v['title']}}">{{!empty(trim($v['description']))?$v['description']:$v['title']}}</div>
									<div class="index_item_rel clearfix" good_id="{{$v['id']}}">
										<a  class="index_item_l" onclick="praise(this,1)">{{$v['praise_count']}}</a>
										<a  class="index_item_c" onclick="collect(this)">{{$v['collection_count']}}</a>
										<?php if($v['kind']==1){ ?>
											<a href="{{$v['detail_url']}}" target="_blank" class="index_item_b"></a>
										<?php } ?>
										<?php if($v['kind']==2){ ?>
											<a onclick="praise(this,2)" class="index_item_d">{{$v['boo_count']}}</a>
										<?php } ?>
									</div>
								</div>
								<?php foreach ($v['collection_good'] as $key => $value):?>
								<div class="index_item_bottom clearfix">
									<a href="{{url('webd/user/index')}}?oid={{$value['user_id']}}" class="index_item_authava" target="_blank" title="{{$value['user']['nick'] or $value['user']['username']}}">
										<img src="{{!empty($value['user']['auth_avatar'])?$value['user']['auth_avatar']:$value['user']['pic_m']}}" alt="{{$value['user']['nick'] or $value['user']['username']}}">
									</a>
									<div class="index_item_authinfo">
										<a href="{{url('webd/user/index')}}?oid={{$value['user_id']}}" target="_blank" class="index_item_authname" title="{{!empty($value['nick'])?$value['nick']:$value['username']}}">{{!empty($value['nick'])?$value['nick']:$value['username']}}</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart"><a href="{{url('webd/folder')}}?fid={{$value['folder_id']}}" target="_blank">{{$value['name']}}</a></p>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>


	<?php if(!empty($goods['folders_one'])): ?>
	<a href="javascript:;" id='load_show' class="detail_pop_baddmore" style="display: none;">正在加载中。。。</a>
	<?php endif; ?>

	<script type="text/javascript">
		$('.detail_pop_tbtnlike').click(function(){
			if(u_id==''){
				layer.msg('没有登陆',{'icon':5})
				return
			}
			good_id = $('#collect_inner').attr('img_id')
			if(!$(this).hasClass('detail_pop_tbtnlikeon')){
				$.ajax({
					'beforeSend':function(){
						layer.load(0, {shade: 0.5});
					},
					'url':"/webd/goodaction/create",
					'type':'post',
					'data':{
						'good_id':good_id,
						'action':1,
						'user_id':user_id
					},
					'dataType':'json',
					'success':function(json){
						if(json.code==200){
							$('.detail_pop_tbtnlike').addClass('detail_pop_tbtnlikeon')
						}else{
							layer.msg(json.message, {icon: 5});
							return
						}
					},
					'complete':function(){
						layer.closeAll('loading');
					}
				})
			}else{
				$.ajax({
					'beforeSend':function(){
						layer.load(0, {shade: 0.5});
					},
					'url':"/webd/goodaction/del",
					'type':'post',
					'data':{
						'good_id':good_id,
						'action':1,
						'user_id':user_id
					},
					'dataType':'json',
					'success':function(json){
						if(json.code==200){
							$('.detail_pop_tbtnlike').removeClass('detail_pop_tbtnlikeon')
						}else{
							layer.msg(json.message, {icon: 5});
							return
						}
					},
					'complete':function(){
						layer.closeAll('loading');
					}
				})
			}
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
	#search_form_inner{
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
		/* margin-top: 40px;
		margin-bottom: 50px;
		font-size: 20px;
		text-align: center; */
	}
	</style>
	<!-- 采集时选择文件夹 -->
	<div class="pop_collect p_collect" style="display: none" img_id="{{$goods['id']}}" id="collect_inner">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="{{$goods['images'][0]['img_o'] or url('uploads/sundry/blogo.jpg')}}" width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="{{$goods['description']}}" style="resize: none; padding: 0">{{!empty(trim($goods['description']))?trim($goods['description']):trim($goods['title'])}}</textarea>
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
						<a href="javascript:;" class="pop_col_sinputbtn"></a>
						<input class="pop_col_sinput" placeholder="搜索">
						<div id="search_form_inner"></div>
					</div>

				</div>

				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
							<a href="javascript:;" class="pop_col_alpbtn">A</a><a href="javascript:;" class="pop_col_alpbtn">B</a><a href="javascript:;" class="pop_col_alpbtn">C</a><a href="javascript:;" class="pop_col_alpbtn">D</a><a href="javascript:;" class="pop_col_alpbtn">E</a><a href="javascript:;" class="pop_col_alpbtn">F</a><a href="javascript:;" class="pop_col_alpbtn">G</a><a href="javascript:;" class="pop_col_alpbtn">H</a><a href="javascript:;" class="pop_col_alpbtn">I</a><a href="javascript:;" class="pop_col_alpbtn">J</a><a href="javascript:;" class="pop_col_alpbtn">K</a><a href="javascript:;" class="pop_col_alpbtn">L</a><a href="javascript:;" class="pop_col_alpbtn">M</a><a href="javascript:;" class="pop_col_alpbtn">N</a><a href="javascript:;" class="pop_col_alpbtn">O</a><a href="javascript:;" class="pop_col_alpbtn">P</a><a href="javascript:;" class="pop_col_alpbtn">Q</a><a href="javascript:;" class="pop_col_alpbtn">R</a><a href="javascript:;" class="pop_col_alpbtn">S</a><a href="javascript:;" class="pop_col_alpbtn">T</a><a href="javascript:;" class="pop_col_alpbtn">U</a><a href="javascript:;" class="pop_col_alpbtn">V</a><a href="javascript:;" class="pop_col_alpbtn">W</a><a href="javascript:;" class="pop_col_alpbtn">X</a><a href="javascript:;" class="pop_col_alpbtn">Y</a><a href="javascript:;" class="pop_col_alpbtn">Z</a>
						</div>
						<ul class="pop_col_colum" id="search_inner">
							
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
					<a href="javascript:;" class="pop_add_addnew" id="pop_add_addnew">+</a>
					<p class="pop_add_addfont">新建文件夹</p>
				</div>
			</div>
		</div>
	</div>
	<!-- 采集时新建文件夹 -->
	<div class="pop_collect p_folder" style="display: none" id="folder_inner">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="{{$goods['images'][0]['img_o'] or url('uploads/sundry/blogo.jpg')}}"  width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="{{$goods['description']}}" style="padding: 0">{{$goods['description']}}</textarea>
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
						<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr" name="private" private="0">
						<label for="pop_iptpr"></label>
					</div>
				</div>
				<div class="pop_btnwrap">
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" style="float:right;" id="cfolder">创建</a>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	fid = "<?php echo isset($goods['collection_folders'][0]['id'])?$goods['collection_folders'][0]['id']:0; ?>"
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	folderUrl = '{{url("webd/pics/folder?oid={$user_id}")}}'
	postUrl_show = "{{url('webd/pics/img')}}?oid={{$user_id}}&fid="+fid
	moreData = {'num':4,'img_id':{{$goods['id']}}}
	postData_show = {'num':15,'img_id':{{$goods['id']}}}
	user_id = "<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id'];  ?>"
</script>
<script type="text/javascript">

	// 添加评论
	$("#add_commit_btn").click(function(){
		if(u_id==''){
			layer.msg('没有登陆',{'icon':5})
			return
		}
		if($('textarea[name=caption]').val().trim()==''){
			layer.msg('没有填写评论',{'icon':5})
			return
		}
		$.ajax({
			'beforeSend':function(){
				layer.load(0, {shade: 0.5});
			},
			'url':"/webd/pics/addcomment",
			'type':'post',
			'data':{
				'good_id':"{{$goods['id']}}",
				'content':$('textarea[name=caption]').val().trim(),
				'user_id':u_id
			},
			'dataType':'json',
			'success':function(json){
				if(json.code==200){
					var commitHtml = '<li class="clearfix">\
									<div class="detail_pop_authava">\
										<a href="/webd/user/index?oid={{$self_info['id']}}"><img src="{{!empty($self_info['auth_avatar'])?$self_info['auth_avatar']:$self_info['pic_m']}}" alt=""></a>\
									</div>\
									<div class="detail_pop_cominfo">\
										<p class="detail_pop_comname"><a href="/webd/user/index?oid={{$self_info['id']}}">{{!empty($self_info['nick'])?$self_info['nick']:$self_info['username']}}</a>- 刚刚说：\
										</p>\
										<p class="detail_pop_comcon">'+$('textarea[name=caption]').val().trim()+'</p>\
									</div>\
									<div class="detail_pop_favor" style="cursor:pointer" onclick="comment_parise(this)" user_id="{{$self_info['id']}}" comment_id="'+json.data.id+'">0</div>\
								</li>'
					$(".detail_pop_tlcomlist").prepend(commitHtml);
					$(".detail_pop_compub").val("")
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
 <script type="text/javascript" src="{{asset('web')}}/js/pic.js"></script>
 <script type="text/javascript" src="{{asset('web')}}/js/picbottom.js"></script>
<script type="text/javascript">
    $(window).scroll(function(event) {
		var scrollHei = $('body').scrollTop();
		if (scrollHei <= 260) {
			$('.perhome_scroll_info,.perhome_scroll_wrap').css({
				transform:'translate(0px, -70px)',
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
</script>
</div>

</body>

</html>
