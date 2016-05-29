
$(function() {
			$('.index_main').find('.index_item_blurwrap').click(function(){
				$('body').addClass('overhidden')
				$('.detail_pop').css({
					display:'block'
				});
				$('.detail_pop').scroll(function(event) {
					console.info($('.detail_pop').scrollTop());
					var popscrollHei = $('.detail_pop').scrollTop();
					if (popscrollHei > 30) {
						$('.detail_pop_tbtnwarp').css({
			        		'position':'fixed',
			        		top:0,
			        		'z-index':1000,
			        		'padding':15,
			        		'margin-left':-15
			        	})
					}else{
						$('.detail_pop_tbtnwarp').css({
			        		'position':'relative',
			        		top:0,
			        		'z-index':1000,
			        		'padding':0,
			        		'margin-left':0
			        	})
					};
					var showHei = $('.detail_pop_tltop').height()+30;
					if (popscrollHei > showHei) {
						$('.detail_pop_tbtnwarp').css({
			        		'position':'relative',
			        		top:0,
			        		'z-index':1000,
			        		'padding':0,
			        		'margin-left':0
			        	})
					};
				});

			    $('.detail_pop_collection').click(function(){
					$('.pop_collect').show();
					var popH =$('.pop_collect').show().find('.pop_con').height();
					$('.pop_collect').show().find('.pop_col_left').height(popH-40);
				})
				$('.pop_col_r').click(function(){
					if ($(this).hasClass('pop_col_radio_on')) {
						$(this).removeClass('pop_col_radio_on').addClass('pop_col_radio');
						$(this).parent('.pop_col_bwrap').find('.jiathis_button').removeClass('jiathis_button_on')
					}else{
						$(this).removeClass('pop_col_radio').addClass('pop_col_radio_on');
						$(this).parent('.pop_col_bwrap').find('.jiathis_button').addClass('jiathis_button_on')
					};
				})
				$('.pop_collect,.pop_close,.detail_pop_cancel').click(function(){
					$('.pop_collect').hide()
				});
				$('.pop_con').click(function(){
					event.stopPropagation()
				})
				// 触发分享按钮开始
				$('.detail_pop_build').click(function(){
					$('.jiathis_button_on').trigger('click')
				})
				// 触发分享按钮结束

				// 左侧相关信息编辑开始
				var textcon = $('.pop_col_detailtext').text();
				$('.pop_col_detailtext').focusin(function(event) {
					var moreHtml = $('.pop_col_detailtext').attr('title');
					$('.pop_col_detailtext').html(moreHtml);
					$('.pop_col_detailtext').css({
						'overflow-y':'scroll'
					});
					$('.detail_pop_colledit').hide();
				});
				$('.pop_col_detailtext').focusout(function(event) {
					$('.pop_col_detailtext').html(textcon);
					$('.pop_col_detailtext').css({
						'overflow-y':'hidden'
					});
					$('.detail_pop_colledit').show();
				});
				//左侧相关信息编辑结束
				if ($('.pop_col_infowrap').height()>360) {
					$('.pop_col_infowrap').css({
						'overflow-y': 'scroll'
					});
				}else{
					$('.pop_col_infowrap').css({
						'overflow-y': 'hidden'
					});
				};
				$('.detail_pop_loadclose,.detail_pop').click(function(){
					$('body').removeClass('overhidden')
					$('.detail_pop').css({
						display:'none'
					});
				});
				$('.detail_pop_wrap,.detail_pop_loadbtn').click(function(){
					event.stopPropagation()
				})
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
	              textLeng = 29;
	              if(str.length > textLeng ){
	                    text.html( str.substring(0,textLeng )+"...");
	              }
		     });
		   
		    $(window).scroll(function(event) {
				var scrollHei = $('body').scrollTop();
				if (scrollHei <= 68) {
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
			$('.detail_pop_tbtn_click').click(function(){
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
		    $('.detail_pop_desmore').click(function(){
				var moreHtml = $('.detail_pop_des').attr('title');
				$('.detail_pop_des').html(moreHtml)
			})
			$('.detail_pop_tlcomlist li').hover(
				function () {
				    $(this).find('.detail_pop_comshare').show();
			  	},
			    function () {
				    // $('.detail_pop_comshare').hide();
				}
			);
			$('.detail_pop_compub').focus(function(){
				$('.detail_pop_addcom').show()
			});
			$('.detail_pop_compub').change(function(){
				$('.detail_pop_authfollow').css({
					color: '#000',
					background:'#fff'
				});
			})
		});

