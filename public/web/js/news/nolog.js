/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-05-04 16:40:59
 * @version $Id$
 */
$(function(){
	$('body').append('<a href="javascript:;" class="back_to_top">^</a>');
	$('.back_to_top').click(function(){
		$("html,body").animate({scrollTop: 0},600);
	});
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
				top: 48
			});
		};
	});
	// $('.header_more_a1').click(function(){
 //    $('.pop_goodsupload').hide();
 //    $('.pop_uploadfile').show();
 //    var poptopHei = $('.pop_uploadfile .pop_con').height();
 //    $('.pop_con').css({
 //       'margin-top':-(poptopHei/2)
 //    })
 //  });
 //  $('.pop_uploadfile,.pop_close').click(function(){
 //    $('.pop_uploadfile').hide();
 //  })
 //  $('.pop_uploadfile .pop_con').click(function(){
 //    event.stopPropagation()
 //  })
 //  $('.header_more_a2').click(function(){
 //    $('.pop_goodsupload').hide();
 //    $('.pop_uploadgoods').show();
 //    var popconHei = $('.pop_uploadgoods .pop_con').height();
 //    $('.pop_con').css({
 //       'margin-top':-(popconHei/2)
 //    })
 //  });
 //  $('.detail_pop_goodsget').click(function(){
 //    $('.pop_uploadgoods').hide();
 //    $('.pop_goods_upload').show();
 //    var popconHei = $('.pop_goods_upload .pop_con').height();
 //      if (popconHei > 410) {
 //        $('.pop_goods_upload .pop_conwrap').css({
 //          'max-height':410,
 //          'overflow-y':'scroll'
 //        })
 //      };
 //    var poptopHei = $('.pop_goods_upload .pop_con').height();
 //    $('.pop_goods_upload .pop_con').css({
 //       'margin-top':-(poptopHei/2)
 //    })
 //  })
 //  $('.pop_uploadgoods,.pop_uploadgoods .detail_pop_cancel,.pop_uploadgoods .pop_close').click(function(){
 //    $('.pop_uploadgoods').hide();
 //  })
 //  $('.pop_goods_upload,.pop_goods_upload .detail_pop_cancel,.pop_goods_upload .pop_close').click(function(){
 //    $('.pop_goods_upload').hide();
 //  })
 //  $(".pop_upload_a").on("change","input[type='file']",function(){
 //    var filePath=$(this).val();
 //    if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1 || filePath.indexOf("JPEG")!=-1 || filePath.indexOf("jpeg")!=-1){
 //        var arr=filePath.split('\\');
 //        var fileName=arr[arr.length-1];
 //        $(".pop_upload_a span").html(fileName);
 //        $('.pop_choose_already').show();
 //         var poptopHei = $('.pop_choose_already .pop_con').height();
 //        $('.pop_choose_already .pop_con').css({
 //           'margin-top':-(poptopHei/2)
 //        })
 //        var popH =$('.pop_choose_already').show().find('.pop_con').height();
 //        $('.pop_choose_already').show().find('.pop_col_left').height(popH-40);
 //        $('.point_to_a').click(function(){
 //          $('.pop_col_colum_wrap').animate({
 //            scrollTop: 50},
 //            300);
 //        })
 //        $('.point_to_d').click(function(){
 //          $('.pop_col_colum_wrap').animate({
 //            scrollTop: 100},
 //            300);
 //        })
 //    }else{
 //        $(".pop_upload_a span").html("您上传文件类型有误！");
 //        return false 
 //    }
 //  })
 //  $('.detail_pop_collection').click(function(){
 //    $('.pop_choose_already').show();
 //    var popH =$('.pop_choose_already').show().find('.pop_con').height();
 //    $('.pop_choose_already').show().find('.pop_col_left').height(popH-40);
 //    $('.point_to_a').click(function(){
 //      $('.pop_col_colum_wrap').animate({
 //        scrollTop: 50},
 //        300);
 //    })
 //    $('.point_to_d').click(function(){
 //      $('.pop_col_colum_wrap').animate({
 //        scrollTop: 100},
 //        300);
 //    })
 //  });
 //  $('.pop_choose_already,.pop_close,.detail_pop_cancel').click(function(){
 //    $('.pop_choose_already').hide()
 //  });
 //  $('.pop_con').click(function(){
 //    event.stopPropagation()
 //  })
 //  // 私信弹窗
 //  $('.header_more_2').click(function(){
 //    $('.pop_letter').show()
 //    var poptopHei = $('.pop_letter .pop_con').height();
 //    $('.pop_con').css({
 //       'margin-top':-(poptopHei/2)
 //    })
 //  });
 //  $('.pop_con').click(function(){
 //    event.stopPropagation();
 //  })
 //  $('.pop_letter,.pop_letter .pop_close,.pop_letter .detail_pop_cancel').click(function(){
 //    $('.pop_letter').hide()
 //  })
 //  $('.header_more_a3').click(function(event) {
 //    if ($(this).hasClass('perhome_add_fold')) {
 //      $('.pop_addprivfold').css({
 //        display: 'block'
 //      });
 //      var poptopHei = $('.pop_addprivfold .pop_con').height();
 //      $('.pop_addprivfold .pop_con').css({
 //         'margin-top':-(poptopHei/2)
 //      })
 //      $('.pop_addfold').css({
 //        display: 'none'
 //      });
 //    }else{
 //      $('.pop_addfold').css({
 //        display: 'block'
 //      });
 //      var poptopHei = $('.pop_addfold .pop_con').height();
 //      $('.pop_addfold .pop_con').css({
 //         'margin-top':-(poptopHei/2)
 //      })
 //      $('.pop_addprivfold').css({
 //        display: 'none'
 //      });
 //    };
 //  });
 //  $('.pop_addfold,.pop_addprivfold,.pop_close,.detail_pop_cancel').click(function(){
 //    $('.pop_addfold,.pop_addprivfold').css({
 //      display:'none'
 //    })
 //  })
})













