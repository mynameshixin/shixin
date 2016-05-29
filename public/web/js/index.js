/**
 * 
 * @authors Crystal (1291124482@qq.com)
 * @date    2016-04-16 15:55:29
 * @version $Id$
 */

$(function(){
  
  $('.header_add_clicka').click(function(){
    $('.header_add_clicka').removeClass('header_add_clicka_on');
    $(this).addClass('header_add_clicka_on')
  });
  // $('.index_item_intro').addClass()
  function addPoint(){
    $(".index_item_intro").each(function(i) {
        var vh = 44;
        var $vp = $(".word", $(this));
        while ($vp.outerHeight() > vh){
            $vp.text($vp.text().replace(/(\s)*([a-zA-Z0-9]+|\W)(\.\.\.)?$/, "..."));
        };
    });
  }
    
})
