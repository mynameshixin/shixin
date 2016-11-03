<!DOCTYPE html>
<html lang="en" style="background-color: #fff;">
<head>

	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>堆图家</title>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/index.css">
	@include('web.common.head')	
</head>
<!-- htmlv?=20160718 -->
<body ondragstart="return false" class="know-home">
@include('web.common.banner')
<!-- htmlv?=20160718 -->
	<div class="container">
    <div class="w1248 w1240 clearfix">
   		<div> 
    		<p style="font-size: 16px;"><?=$class['a']['name']?>&nbsp;&nbsp;&nbsp;>></p>
    		<hr style="color: #868686;font-size: 12px;"/>
    		<div>
    		<ul style="list-style:none;">
    		@for($i=0;$i < $class['int'] ; $i++)
    		<a href="/Article/search/<?php 	echo $class[$i]['id'] ?>"><li  style="width:50px; float:left;  margin: 10px 70px 10px 0; color:#<?php if($class[$i]['name']==$class['b']['name']){echo'e15335';}else{echo'868686';}?>;">
				<p><?=$class[$i]['name']?></p>
    		</li>
    		</a>
    		@endfor
    		</ul>
    		</div> 	
   		</div>
   		<div style="height:100px;"></div>
	    	
	    	<div class="pic-list-title">
	    		最新图文
	    	</div>
	    	<div class="pic-list clearfix">	
	    		@foreach ($rel as $rel)
	    		<div class="rows">
	    			<img style="height:248px" src="{{$rel['eassat_ximg']}}"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		     	
    			@endforeach
    			 
	    	
	    		<!-- <div class="rows">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows mrightzero">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows mrightzero">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows mrightzero">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div>
	    		<div class="rows mrightzero">
	    			<img src="{{asset('web')}}/images/vr_pic1.png"/>
	    			<p class="row-info">
	    				<span class="title">卧室清理小技巧</span>
	    				<span class="time">2016/8/15</span>
	    			</p>
	    		</div> -->
	    	</div>
    </div>
</div>
	
	

	<!-- htmlv?=20160718 -->
	<div class="pop_changefold">
		<div class="pop_con">
			
			<div class="pop_change_pic clearfix">
				<!-- htmlv?=20160718 -->
				<div class="pop_change_wrap">
					<div class="pop_change_imgwrap">
					</div>
					<div class="pop_change_imgwrap" id="pop_change_fengmian">
						<!-- <img src="{{asset('web')}}/images/temp/2.png" alt=""> -->
					</div>
					<div class="pop_change_imgwrap">
					</div>
				</div>
				<!-- htmlv?=20160718 -->			
			</div>	
		</div>
	</div>
	<!-- htmlv?=20160718 -->
	<!-- 上传VR -->
	<div class="pop_uploadvr">
		<div class="pop_con">
			<p class="pop_tit">
				上传VR
				<span class="pop_close"></span>
			</p>
			<div class="pop_conwrap">
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">标题</span>
					<input class="pop_iptname" placeholder="为这个VR场景添加一个名称和描述">
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">展示图片</span>
					<div class="pop_vrchangewrap">
						<div class="pop_vrimgwrap">
							<img src="{{asset('web')}}/images/temp/1.png">
						</div>
						<div class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright">
							更改封面
						</div>
					</div>
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">地址</span>
					<input class="pop_iptname" placeholder="粘贴这个VR场景的链接地址">
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">文件夹</span>
					<select class="pop_labelselect" style="margin-right: 15px;width:255px;">
						<option value="">椅子</option>
						<option value="">桌子</option>
						<option value="">电视柜</option>
						<option value="">沙发</option>
						<option value="">卧室</option>
						<option value="">卫生间</option>
					</select>
				</div>
			</div>
			
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">上传</a>
			</div>
		</div>
	</div>
	<!-- 编辑VR -->
	<div class="pop_editvr"  style="display:none;">
		<div class="pop_con">
			<p class="pop_tit">
				编辑VR
				<span class="pop_close"></span>
			</p>
			<div class="pop_conwrap">
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">标题</span>
					<input class="pop_iptname" placeholder="为这个VR场景添加一个名称和描述">
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">展示图片</span>
					<div class="pop_vrchangewrap">
						<div class="pop_vrimgwrap">
							<img src="{{asset('web')}}/images/temp/1.png">
						</div>
						<div class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright">
							更改封面
						</div>
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
					<span class="pop_labelname">地址</span>
					<input class="pop_iptname" placeholder="粘贴这个VR场景的链接地址">
				</div>
				<div class="pop_namewrap clearfix">
					<span class="pop_labelname">文件夹</span>
					<select class="pop_labelselect" style="margin-right: 15px;width:255px;">
						<option value="">椅子</option>
						<option value="">桌子</option>
						<option value="">电视柜</option>
						<option value="">沙发</option>
						<option value="">卧室</option>
						<option value="">卫生间</option>
					</select>
				</div>
			</div>
			
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_delete">删除采集</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">保存</a>
			</div>
		</div>
	</div>
	<!-- htmlv=20160710 -->
	<div class="pop_editfold">
		<div class="pop_con">
			<p class="pop_tit">
				编辑文件夹
				<span class="pop_close"></span>
			</p>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">名称</span>
				<input class="pop_iptname" placeholder="取一个好名字，让更多人精准地搜到它">
			</div>
			<div class="pop_deswrap clearfix">
				<span class="pop_labelname">描述</span>
				<textarea class="pop_iptdes" id="about_your_file"  placeholder="关于你的文件夹"></textarea>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">封面</span>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_filechange">更改</a>
			</div>
			<div class="pop_namewrap clearfix">
				<span class="pop_labelname">隐私</span>
				<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr" checked="checked">
				<label for="pop_iptpr"></label>
			</div>
			<div class="pop_btnwrap">
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_delete">删除文件夹</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
				<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding">保存</a>
			</div>
		</div>
	</div>
	<!-- htmlv=20160710 -->
</body>
<script type="text/javascript">
		$(function() {
			// <!-- htmlv=20160710 -->
			$('#edit_fold_btn').click(function(){
				$('.pop_editfold').show()
			  	var poptopHei = $('.pop_editfold .pop_con').height();
					$('.pop_con').css({
					   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_con').click(function(){
				event.stopPropagation();
			})
			$('.pop_editfold,.pop_editfold .pop_close,.pop_editfold .detail_pop_cancel').click(function(){
				$('.pop_editfold').hide()
			})
			$('#about_your_file').change(function(event) {
				var newVal = $(this).val();
				$("#new_fold_descri").html(newVal)
			});
			// <!-- htmlv=20160710 -->
		    var $container = $('.index_con');
		    $container.imagesLoaded(function() {
		        $container.masonry({
	                itemSelector: '.index_item',
	                gutter: 15,
	                isAnimated: true,
	            });
	            // <!-- htmlv=20160710 -->
	            // var text = $('.index_item_intro');
	            //   str = text.html(),
	            //   textLeng = 27;
	            //   if(str.length > textLeng ){
	            //         text.html( str.substring(0,textLeng )+"...");
	            //   }
	            // <!-- htmlv=20160710 -->
		     });
		    
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
		      // <!-- htmlv?=20160718 -->
		     $('.detail_filechange').click(function(){
				$('.pop_editfold').hide()
				$('.pop_changefold').show();
				// <!-- htmlv?=20160718 -->
				// autoScroll()
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
			$("#pop_change_fengmian").append('<img id="dragimg" src="{{asset('web')}}/images/temp/2.png" alt="">')
	        var odiv = document.getElementById("dragimg");
	        var conheight = $('#pop_change_fengmian').height();
	        dragimgFun(odiv)
	        function dragimgFun(odiv){
	        	odiv.onmousedown = function (ev) {
	                    var oEvent = ev || event;
	                    var gapX = oEvent.clientX - odiv.offsetLeft;
	                    var gapY = oEvent.clientY - odiv.offsetTop;
	                    document.onmousemove = function (ev) {
	                        var oEvent = ev || event;
	                        //限制在可视区域内运动
	                        var l = oEvent.clientX - gapX;
	                        var t = oEvent.clientY - gapY;
	                        var r = document.documentElement.clientWidth - odiv.offsetWidth;
	                        var b = document.documentElement.clientHeight - odiv.offsetHeight;
	                        var tb = odiv.height-conheight;
	                        // console.info(-tb)
	                        odiv.style.left = 0 + "px";
	                        if (t <= -tb) {
	                        	odiv.style.top = -tb + "px";
	                        }else if (t > 0) {
	                            odiv.style.top = 0 + "px";
	                        }
	                        else if (t > b) {
	                            odiv.style.top = b + "px";
	                        } else {
	                            odiv.style.top = t + "px";
	                        }
	                    }
	            }
	            odiv.onmouseup = function () {
	                document.onmousemove = null;
	                document.onmouseup = null;
	            }
	        }
	        // <!-- htmlv?=20160718 -->
	        //轮播
       		 $.foucs({ direction: 'right' });

		});
	</script>
</html>
