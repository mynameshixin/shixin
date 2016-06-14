/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-05-29 19:21:01
 * @version $Id$
 */
 $(function(){
	function autoScroll(){
		var $show = $('.pop_change_wrap'),
			$show_each = $show.find('.pop_change_imgwrap'),
			$show_num = $show_each.length,
			$show_ewth = 200,
			$scrlls = 500,
			$prev = $('.pop_change_imgrigt'),
			$next = $('.pop_change_imgleft');
			$show_width = $show_ewth*$show_num;
			$showl = $show.position().left;
			$page = 1;
			$show.css('width',$show_width);
			console.info()
		$prev.click(function(){
			
			if(!$show.is(':animated')){
				if($page === ($show_num - 1)){
					$show.animate({left:-$show_ewth * ($page-1)},$scrlls);
				}
				else{
					$show.animate({left:'-='+ $show_ewth},$scrlls);
					$page++;
				}
			}
		})
		$next.click(function() {
			if(!$show.is(':animated')){
				if($page === 1){
					$show.animate({left:$show_ewth},$scrlls);
				}
				else{
					$show.animate({left:'+='+ $show_ewth},$scrlls);
					$page--;
				}
			}
		});
	}
	var $index = 0;
    $('.find_cater').eq($index).show()
    $('.perhome_perlike_label').click(function(){
    	$('.perhome_perlike_label').removeClass('perhome_perlike_lon');
    	$(this).addClass('perhome_perlike_lon');
    	var $index = $(this).index();
    	$('.find_cater').hide()
    	$('.find_cater').eq($index).show();
    	
    	var $container = $('.index_con');
	    $container.imagesLoaded(function() {
	        $container.masonry({
	            itemSelector: '.index_item',
	            gutter: 15,
	            isAnimated: true,
	        });
	        var text = $('.index_item_intro');
	      str = text.html(),
	      textLeng = 27;
	      if(str.length > textLeng ){
	            text.html( str.substring(0,textLeng )+"...");
	      }
	     });
	    floatFun()
    })
    var $mindex = 0;
    $('.follow_each').eq($mindex).show()
    $('.search_btn_con a').click(function(){
    	$('.search_btn_con a').removeClass('search_btn_select');
    	$(this).addClass('search_btn_select');
    	var $mindex = $(this).index();
    	$('.follow_each').hide()
    	$('.follow_each').eq($mindex).show();
    })
	autoScroll();
	$('.find_fold_edit').click(function(){
		$('.pop_editfold').show();
		var popconHei = $('.pop_editfold .pop_con').height();
	  	// if (popconHei > 410) {
		  //   $('.pop_editfold .pop_con').css({
		  //     'max-height':410,
		  //     'overflow-y':'scroll'
		  //   })
		  // };
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
	$('.detail_filechange').click(function(){
		$('.pop_editfold').hide();
		$('.pop_changefold').show();
		var popconHei = $('.pop_changefold .pop_con').height();
	  	// if (popconHei > 410) {
		  //   $('.pop_changefold .pop_con').css({
		  //     'max-height':410,
		  //     'overflow-y':'scroll'
		  //   })
		  // };
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
	$('.perhome_add_one').click(function(event) {
		if ($(this).hasClass('perhome_add_fold')) {
			$('.pop_addfold').css({
				display: 'block'
			});
			var popconHei = $('.pop_editfold .pop_con').height();
		  	// if (popconHei > 410) {
			  //   $('.pop_editfold .pop_con').css({
			  //     'max-height':410,
			  //     'overflow-y':'scroll'
			  //   })
			  // };
		  	var poptopHei = $('.pop_editfold .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
			})
		}else{
			$('.pop_addprivfold').css({
				display: 'block'
			});
			var popconHei = $('.pop_addprivfold .pop_con').height();
		  	if (popconHei > 410) {
			    $('.pop_addprivfold .pop_con').css({
			      'max-height':410,
			      'overflow-y':'scroll'
			    })
			  };
		  	var poptopHei = $('.pop_addprivfold .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
			})
		};
	});
	$('.pop_addfold,.pop_addprivfold,.pop_close,.detail_pop_cancel').click(function(){
		$('.pop_addfold,.pop_addprivfold').css({
			display:'none'
		})
	})
	$('.pop_con').click(function(){
		event.stopPropagation();
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
	      textLeng = 27;
	      if(str.length > textLeng ){
	            text.html( str.substring(0,textLeng )+"...");
	      }
	 });
	buildDage()
	privacyDage()
	function buildDage(){
		var oUl= document.getElementById("find_fold_build");
		var aLi = oUl.getElementsByTagName("li");
		var disX = 0;
		var disY = 0;
		var minZindex = 1;
		var aPos =[];
		for(var i=0;i<aLi.length;i++){
			var t = aLi[i].offsetTop;
			var l = aLi[i].offsetLeft;
			aLi[i].style.top = t+"px";
			aLi[i].style.left = l+"px";
			aPos[i] = {left:l,top:t};
			aLi[i].index = i;
		}
		for(var i=0;i<aLi.length;i++){
			aLi[i].style.position = "absolute";
			aLi[i].style.margin = 0;
			setDrag(aLi[i]);
		}
		//拖拽
		function setDrag(obj){
			obj.onmouseover = function(){
				obj.style.cursor = "move";
			}
			obj.onmousedown = function(event){
				var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
				var scrollLeft = document.documentElement.scrollLeft||document.body.scrollLeft;
				obj.style.zIndex = minZindex++;
				//当鼠标按下时计算鼠标与拖拽对象的距离
				disX = event.clientX +scrollLeft-obj.offsetLeft;
				disY = event.clientY +scrollTop-obj.offsetTop;
				document.onmousemove=function(event){
					//当鼠标拖动时计算div的位置
					var l = event.clientX -disX +scrollLeft;
					var t = event.clientY -disY + scrollTop;
					obj.style.left = l + "px";
					obj.style.top = t + "px";
					for(var i=0;i<aLi.length;i++){
						aLi[i].className = "find_fold_li";
					}
					var oNear = findMin(obj);
					if(oNear){
						oNear.className = "find_fold_li active";
					}
				}
				document.onmouseup = function(){
					document.onmousemove = null;//当鼠标弹起时移出移动事件
					document.onmouseup = null;//移出up事件，清空内存
					//检测是否普碰上，在交换位置
					var oNear = findMin(obj);
					if(oNear){
						oNear.className = "find_fold_li";
						oNear.style.zIndex = minZindex++;
						obj.style.zIndex = minZindex++;
						startMove(oNear,aPos[obj.index]);
						startMove(obj,aPos[oNear.index]);
						//交换index
						oNear.index += obj.index;
						obj.index = oNear.index - obj.index;
						oNear.index = oNear.index - obj.index;
					}else{

						startMove(obj,aPos[obj.index]);
					}
				}
				clearInterval(obj.timer);
				return false;//低版本出现禁止符号
			}
		}
		//碰撞检测
		function colTest(obj1,obj2){
			var t1 = obj1.offsetTop;
			var r1 = obj1.offsetWidth+obj1.offsetLeft;
			var b1 = obj1.offsetHeight+obj1.offsetTop;
			var l1 = obj1.offsetLeft;

			var t2 = obj2.offsetTop;
			var r2 = obj2.offsetWidth+obj2.offsetLeft;
			var b2 = obj2.offsetHeight+obj2.offsetTop;
			var l2 = obj2.offsetLeft;

			if(t1>b2||r1<l2||b1<t2||l1>r2){
				return false;
			}else{
				return true;
			}
		}
		//勾股定理求距离
		function getDis(obj1,obj2){
			var a = obj1.offsetLeft-obj2.offsetLeft;
			var b = obj1.offsetTop-obj2.offsetTop;
			return Math.sqrt(Math.pow(a,2)+Math.pow(b,2));
		}
		//找到距离最近的
		function findMin(obj){
			var minDis = 999999999;
			var minIndex = -1;
			for(var i=0;i<aLi.length;i++){
				if(obj==aLi[i])continue;
				if(colTest(obj,aLi[i])){
					var dis = getDis(obj,aLi[i]);
					if(dis<minDis){
						minDis = dis;
						minIndex = i;
					}
				}
			}
			if(minIndex==-1){
				return null;
			}else{
				return aLi[minIndex];
			}
		}	
	}
	function privacyDage(){
		var oUl= document.getElementById("find_fold_buildprivacy");
		var aLi = oUl.getElementsByTagName("li");
		var disX = 0;
		var disY = 0;
		var minZindex = 1;
		var aPos =[];
		for(var i=0;i<aLi.length;i++){
			var t = aLi[i].offsetTop;
			var l = aLi[i].offsetLeft;
			aLi[i].style.top = t+"px";
			aLi[i].style.left = l+"px";
			aPos[i] = {left:l,top:t};
			aLi[i].index = i;
		}
		for(var i=0;i<aLi.length;i++){
			aLi[i].style.position = "absolute";
			aLi[i].style.margin = 0;
			setDrag(aLi[i]);
		}
		//拖拽
		function setDrag(obj){
			obj.onmouseover = function(){
				obj.style.cursor = "move";
			}
			obj.onmousedown = function(event){
				var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
				var scrollLeft = document.documentElement.scrollLeft||document.body.scrollLeft;
				obj.style.zIndex = minZindex++;
				//当鼠标按下时计算鼠标与拖拽对象的距离
				disX = event.clientX +scrollLeft-obj.offsetLeft;
				disY = event.clientY +scrollTop-obj.offsetTop;
				document.onmousemove=function(event){
					//当鼠标拖动时计算div的位置
					var l = event.clientX -disX +scrollLeft;
					var t = event.clientY -disY + scrollTop;
					obj.style.left = l + "px";
					obj.style.top = t + "px";
					for(var i=0;i<aLi.length;i++){
						aLi[i].className = "find_fold_li";
					}
					var oNear = findMin(obj);
					if(oNear){
						oNear.className = "find_fold_li active";
					}
				}
				document.onmouseup = function(){
					document.onmousemove = null;//当鼠标弹起时移出移动事件
					document.onmouseup = null;//移出up事件，清空内存
					//检测是否普碰上，在交换位置
					var oNear = findMin(obj);
					if(oNear){
						oNear.className = "find_fold_li";
						oNear.style.zIndex = minZindex++;
						obj.style.zIndex = minZindex++;
						startMove(oNear,aPos[obj.index]);
						startMove(obj,aPos[oNear.index]);
						//交换index
						oNear.index += obj.index;
						obj.index = oNear.index - obj.index;
						oNear.index = oNear.index - obj.index;
					}else{

						startMove(obj,aPos[obj.index]);
					}
				}
				clearInterval(obj.timer);
				return false;//低版本出现禁止符号
			}
		}
		//碰撞检测
		function colTest(obj1,obj2){
			var t1 = obj1.offsetTop;
			var r1 = obj1.offsetWidth+obj1.offsetLeft;
			var b1 = obj1.offsetHeight+obj1.offsetTop;
			var l1 = obj1.offsetLeft;

			var t2 = obj2.offsetTop;
			var r2 = obj2.offsetWidth+obj2.offsetLeft;
			var b2 = obj2.offsetHeight+obj2.offsetTop;
			var l2 = obj2.offsetLeft;

			if(t1>b2||r1<l2||b1<t2||l1>r2){
				return false;
			}else{
				return true;
			}
		}
		//勾股定理求距离
		function getDis(obj1,obj2){
			var a = obj1.offsetLeft-obj2.offsetLeft;
			var b = obj1.offsetTop-obj2.offsetTop;
			return Math.sqrt(Math.pow(a,2)+Math.pow(b,2));
		}
		//找到距离最近的
		function findMin(obj){
			var minDis = 999999999;
			var minIndex = -1;
			for(var i=0;i<aLi.length;i++){
				if(obj==aLi[i])continue;
				if(colTest(obj,aLi[i])){
					var dis = getDis(obj,aLi[i]);
					if(dis<minDis){
						minDis = dis;
						minIndex = i;
					}
				}
			}
			if(minIndex==-1){
				return null;
			}else{
				return aLi[minIndex];
			}
		}	
	}	
 })