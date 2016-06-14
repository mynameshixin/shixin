/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-08 15:04:46
 * @version $Id$
 */

function autoScroll(){
	var $show = $('.pop_img_bigwrap'),
		$show_each = $show.find('.pop_img_eachwrap'),
		$show_num = $show_each.length,
		$show_ewth = $('.pop_img_eachwrap').width(),
		$scrlls = 500,
		$prev = $('.pop_img_bigright'),
		$next = $('.pop_img_bigleft');
		$show_width = $show_ewth*$show_num;
		$showl = $show.position().left;
		$page = 1;
		$show.css('width',$show_width);
		$pointer = $('.pop_img_bigpointerwrap');
		$eachpoin = '<a>●</a>';
		$html = "";
	creatNode()
	$prev.click(function(){
		if(!$show.is(':animated')){
			if($page === ($show_num)){
				$show.animate({left:-$show_ewth * ($page-1)},$scrlls);
			}
			else{
				$show.animate({left:'-='+ $show_ewth},$scrlls);
				$page++;
			}
			$('.pop_img_bigpointerwrap a').css({
				opacity: 0.5
			});
			$('.pop_img_bigpointerwrap a').eq($page-1).css({opacity:1});
		}
	})
	$next.click(function() {
		if(!$show.is(':animated')){
			if($page === 1){
				$show.animate({left:0},$scrlls);
			}
			else{
				$show.animate({left:'+='+ $show_ewth},$scrlls);
				$page--;
			}
			$('.pop_img_bigpointerwrap a').css({
				opacity: 0.5
			});
			$('.pop_img_bigpointerwrap a').eq($page-1).css({opacity:1});
		}
	});
	function creatNode(){
		for (var i=0;i<$show_num;i++) {
			$html += $eachpoin;
		};
		$($pointer).append($html);
		var $pointw = $('.pop_img_bigpointerwrap').width();
		$('.pop_img_bigpointerwrap').css({"margin-left":-$pointw/2});
		$('.pop_img_bigpointerwrap a').eq(0).css({opacity:1});
		$('.pop_img_bigpointerwrap a').click(function(){
			var $index = $(this).index();
			$('.pop_img_bigpointerwrap a').css({
				opacity: 0.5
			});
			$(this).css({opacity:1})
			$page = $index + 1;
			$show.animate({left:-$show_ewth * ($page-1)},$scrlls);
		})
	}
}