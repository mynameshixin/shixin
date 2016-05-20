/**
 * 
 * @authors Crystal (1291124482@qq.com)
 * @date    2016-04-16 15:55:29
 * @version $Id$
 */

$(function(){
	var mleft = $('.container').css('marginLeft')
        $('.headercontainer').css({
          'left':mleft
        });
        $(window).resize(function(){
          var mleft = $('.container').css('marginLeft')
          $('.headercontainer').css({
            'left':mleft
          })
        })
          
	$(window).scroll(function(event) {
		var x = document.body.scrollLeft; 
          if (x>0) {
              $('.headercontainer').css({
                'left':-x
              })
            }else{
              var mleft = $('.container').css('marginLeft')
              $('.headercontainer').css({
                'left':mleft
              });
      	};
	});
  $('.header_add_clicka').click(function(){
    $('.header_add_clicka').removeClass('header_add_clicka_on');
    $(this).addClass('header_add_clicka_on')
  })
})
