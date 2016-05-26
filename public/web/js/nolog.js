/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-05-04 16:40:59
 * @version $Id$
 */
$(function(){
	$(window).scroll(function(event) {
		var scrollHei = $('body').scrollTop();
		if (scrollHei <= 126) {
			$('.nolog_adv_wrapscroll').css({
				display:'none'
			});
		}else{
			$('.nolog_adv_wrapscroll').css({
				display:'block',
				position: 'fixed',
				top: 74
			});
		};
	});
})













