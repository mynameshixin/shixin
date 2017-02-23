<!DOCTYPE html>
<html lang="en" style="background-color: #fff;">
<head>
@include('web.common.head')

	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>堆图家</title>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/font-awesome.min.css">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/font-awesome-ie7.min.css">
	<![endif]-->
	
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/index.css">
	<!-- <link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/main.css"> -->
	<script type="text/javascript" src="{{asset('web')}}/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/news/Masonry/masonry-docs.min.js"></script>
	 <script type="text/javascript" src="{{asset('web')}}/js/news/index.js"></script>
	 <script type="text/javascript" src="{{asset('web')}}/js/news/jquery-lazyload-js.js"></script>

	 
	 <script src="{{asset('web')}}/js/news/foucs.js" type="text/javascript"></script>
</head>
<!-- htmlv?=20160718 -->
<body ondragstart="return false" class="know-home">
@include('web.common.banner')
	<div class="container">
		 <div id="main">

	        <div id="index_b_hero">

	            <div class="hero-wrap">

	                <ul class="heros clearfix">


	                @for($i=0;$i < $where['int'];$i++)
	                    <li class="hero" >

	                        <a href="/Article/article/<?php echo $where[$i]['eassat_id']?>" >
	                            <img src="<?php echo $where[$i]['eassat_timg']?>" class="thumb" />
	                        </a>
	                    </li>
	                @endfor
	                </ul>
	            </div>
	            <div class="helper">
	                <a class="prev icon-arrow-a-left"></a>
	                <a class="next icon-arrow-a-right"></a>
	            </div>

	        </div>

    	</div>

    <div class="w1248 w1240 clearfix">
	    	<div class="modules clearfix">
	    		<div class="rows">
	    			<a href="/Article/search/1"></a>
	    			<img src="/web/images/家具知识.png"/>
	    		
	    		</div>
	    		<div class="rows">
	    			<a href="/Article/search/32"></a>
	    			<img src="/web/images/品牌故事.png"/>
	    		
	    		</div>
	    		<div class="rows">
	    			<a href="/Article/search/15"></a>
	    			<img src="/web/images/设计师.png"/>
	    		
	    		</div>
	    		<a href="/Article/search/42">
	    		<div class="rows">
	    			<a href="/Article/search/42"></a>
	    			<img  src="/web/images/问答社区.png"/>
	    		
	    		</div>
	    		</a>
	    	</div>
	    	
	    <div class="item clearfix">
	    		<div class="rows">
	    		<a href="/Article/search/56">
	    			<img src="/web/images/fg.png"/>
	    			<p>风格</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/75">
	    			<img src="/web/images/kj.png"/>
	    			<p>空间</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/85">
	    			<img src="/web/images/jb.png"/>
	    			<p>局部</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/93">
	    			<img src="/web/images/yz.png"/>
	    			<p>硬装</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/98">
	    			<img src="/web/images/rz.png"/>
	    			<p>软装</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/107">
	    			<img src="/web/images/ds.png"/>
	    			<p>灯饰</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/113">
	    			<img src="/web/images/bj.png"/>
	    			<p>摆件</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/122">
	    			<img src="/web/images/ps.png"/>
	    			<p>色系</p>
	    		</a>
	    		</div>
	    </div>
	    	<div class="pic-list-title">
	    		最新图文
	    	</div>
	    	<div id="theme">
	    	<div class="pic-list clearfix">
	    	@foreach ($posts as $post)
	    		<div class="rows" style="margin-top:50px;height:330px">
	    		<a href="/Article/article/<?php echo $post['eassat_id']?>">
	    			<img style="width:390px;height:247px;" src="http://www.duitujia.com<?php echo $post['eassat_ximg']?>"/>
	    			<p class="row-info">
	    				<span class="title"><?php echo $post['eassat_title']?></span>
	    				<span class="time"><?php echo $post['eassat_date']?></span>
	    			</p>
	    		</a>
	    		</div>
	    	@endforeach
	    	</div>
	    	<style>
			#render ul li{
				list-style: none;
				float: left;
				width: 30px;
				height: 30px;
				line-height:30px;
				font-size: 18px;
				text-align:center;
			}
			#render ul li a{
				
				color: blue;
				
			}

			
	    	</style>
	    	<div id="render" style="margin:0 auto; width:400px; height:100px;">
	    	<div>{!! $posts->render() !!}</div>
	    	
	    	</div>

	    	</div>

    </div>
</div>
	

	
	<!-- 上传商品详细弹框 -->
	
	<!-- htmlv?=20160718 -->
	<!-- htmlv?=20160718 -->
	<!-- 创建文件夹 -->
	
	
	<!-- htmlv?=20160718 -->
	<div class="pop_changefold">
		<div class="pop_con">
		
			<div class="pop_change_pic clearfix">
				<!-- htmlv?=20160718 -->
				<div class="pop_change_wrap">
					<div class="pop_change_imgwrap">
					</div>
					<div class="pop_change_imgwrap" id="pop_change_fengmian">
						<!-- <img src="/web/images/temp/2.png" alt=""> -->
					</div>
					<div class="pop_change_imgwrap">
					</div>
				</div>
				<!-- htmlv?=20160718 -->
			
			</div>
			
		</div>
	</div>
	@if ($self_id==5||$self_id==6)
	<a href="/Article/article/create"><div style="position:fixed;left:0px;top:90%;background:#E15335;"><img src="{{asset('web')}}/images/添加文章.png" alt=""></div></a>
	@endif	
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
			$("#pop_change_fengmian").append('<img id="dragimg" src="/web/images/temp/2.png" alt="">')
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
		
		// var wh=$(window).height();
		// var indexa=true;
		// $(window).scroll(function(){
		// var s=wh-$(window).scrollTop();
		// if(s>1){

		// 	 //document.getElementById("theme").innerHTML+="<p>1</p>";;
		// 	index_add(131);
		// }
		// });
		
	//function index_add(ele){   	
		//var flag = false;  
	    // $.ajax({  
	    //     type: "POST",  
	    //     url: "/Article/indexadd", //orderModifyStatus  
	    //     data: {
	    //     	'eassat_id':ele
	    //     },  
	    //     dataType:"json",  
	    //     async:false,  
	    //     cache:false,  
	    //     success: function(data){  

	        	//alert(1);
	            // var member = eval("("+data+")"); //包数据解析为json 格式                                                            
	            // if(member.success=="true"){  
	            //     flag = true;  
	            // }else if(member.success=="false") {  
	            //     alert(member.info);  
	            // }  
	       // },  
	        //error: function(json){  
	           // layer.alert("服务器错误！请稍候刷新网页");
	        //}  
	   // }); 		    
     // 	var a=document.getElementById("theme").innerHTML;
	    // $.ajax({
	    //  type:"post",  //提交方式
	    //  dataType:"jsonp", //数据类型
	    //  url:"/Article/indexadd", //请求url
	    //  'data':{
	    //      'eassat_id':ele          
	    //  },
	    //    success:function(json){ //提交成功的回调函数 
	      
	    //  	alert(1);
	    //     document.getElementById("theme").innerHTML+="<p>新来的(innerHTML)</p>";
	    //    },
	    //  });

    }
	</script>
</html>

