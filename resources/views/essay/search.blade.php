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
	    	<br>
	    	<div class="pic-list clearfix">	
	    		@foreach ($rel as $rel)
	    		<div class="rows">
	    			<img style="height:248px" src="{{$rel['eassat_ximg']}}"/>
	    			<p class="row-info">
	    				<span class="time">{{$rel['eassat_title']}}</span>
	    				<span class="time">{{$rel['eassat_date']}}</span>
	    			</p>
	    		</div>
    			@endforeach   			    		
	    	</div>
	    	<script type="text/javascript" src="{{asset('web')}}/js/news/scarch.js"></script>

	    	
    </div>
</div>
	
	

<div>
    <img style="margin-left: 650px;" src="{{asset('web/images/查看更多2.png')}}" name="6" nema="<?=$class['b']['name']?>" onclick="readd(this)" alt="查看更多">
</div> 
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
