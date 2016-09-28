/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-07-05 20:33:10
 * @version $Id$
 */
$(function() {
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
			$('.detail_fileb_sfld').click(function(){
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
			$('.detail_filechange').click(function(){
				$('.pop_editfold').hide()
				$('.pop_changefold').show();
				autoScroll()
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
			$('.perhome_add_goods').click(function(){
				$('.pop_goodsupload').show();
				var popconHei = $('.pop_goodsupload .pop_conwrap').height();
			  	if (popconHei > 410) {
				    $('.pop_goodsupload .pop_conwrap').css({
				      'max-height':410,
				      'overflow-y':'scroll'
				    })
				  };
			  	var poptopHei = $('.pop_goodsupload .pop_con').height();
					$('.pop_con').css({
					   'margin-top':-(poptopHei/2)
				})
			});
			$('.pop_goodsupload,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_goodsupload').hide();
			});
			$('.pop_goodsupload .pop_con').click(function(){
				event.stopPropagation()
			});
			/*$('.pop_cona').click(function(){
				$('.pop_goodsupload').hide();
				$('.pop_uploadfile').show();
				var poptopHei = $('.pop_uploadfile .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			});*/
			$('.pop_uploadfile,.pop_close').click(function(){
				$('.pop_uploadfile').hide();
			})
			$('.pop_uploadfile .pop_con').click(function(){
				event.stopPropagation()
			})
			$('.pop_conb').click(function(){
				$('.pop_goodsupload').hide();
				$('#pop_file').show();
				var popconHei = $('#pop_file .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(popconHei/2)
				})
			});
			$('.pop_pic_upload,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_pic_upload').hide();
			});
			$('.pop_pic_upload .pop_con').click(function(){
				event.stopPropagation()
			});

			$('.pop_uploadgoods,.pop_uploadgoods .detail_pop_cancel,.pop_uploadgoods .pop_close').click(function(){
				$('.pop_uploadgoods').hide();
			})
			$('.pop_goods_upload,.pop_goods_upload .detail_pop_cancel,.pop_goods_upload .pop_close').click(function(){
				$('.pop_goods_upload').hide();
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
			// 触发分享按钮开始
			$('.detail_pop_goodsave').click(function(){
				$('.jiathis_button_on').trigger('click')
			})
			// 触发分享按钮结束

			//点击删除提示效果开始
			$('.detail_select_btndele').click(function(){
				$('.pop_deletetips').show();
				var poptopHei = $('.pop_deletetips .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})

			$('.pop_deletetips,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_deletetips').hide();
			})
			$('.pop_deletetips .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击复制至提示效果结束

			//点击复制至效果开始
			$('.detail_select_btncopy').click(function(){
				$('.pop_copyfile').show();
				// htmlv=20160705
				popFilelistMove()
				// htmlv=20160705
				var poptopHei = $('.pop_copyfile .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_copyfile,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_copyfile').hide();
			})
			$('.pop_copyfile .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击复制至效果结束

			// 下拉框效果开始
			$('.pop_fakeselect').click(function(){
				$('.pop_optionwrap').show();
			});
			$('.pop_searul li').click(function(){
				event.stopPropagation()
				var fakeOption = $(this).html();
				$('.pop_fakedefault').html(fakeOption);
				$('.pop_optionwrap').hide();
				// htmlv=20160705
				popFilelistMove()
				// htmlv=20160705
			})
			// 下拉框效果结束
			// htmlv=20160705
			function popFilelistMove(){
				
				$('#pop_filelist_move').click(function(){
					var getOption = $('.pop_fakedefault').html();
					if (getOption == "请选择一个文件夹") {
						$('.pop_movefile').hide();
						$('.pop_movetips').show();
						var poptopHei = $('.pop_movetips .pop_con').height();
						$('.pop_con').css({
						   'margin-top':-(poptopHei/2)
						});
						$('.pop_movetips,.pop_close,.detail_pop_cancel').click(function(){
							$('.pop_movetips').hide();
						})
						$('.pop_movetips .pop_con').click(function(){
							event.stopPropagation()
						})
					}else{
						$('.pop_movefile').hide();
					};
				})
				$('#pop_filelist_copy').click(function(){
					var getOption = $('.pop_fakedefault').html();
					if (getOption == "请选择一个文件夹") {
						// alert(1)
						$('.pop_copyfile').hide();
						$('.pop_copytips').show();
						var poptopHei = $('.pop_copytips .pop_con').height();
						$('.pop_con').css({
						   'margin-top':-(poptopHei/2)
						});
						$('.pop_copytips,.pop_close,.detail_pop_cancel').click(function(){
							$('.pop_copytips').hide();
						})
						$('.pop_copytips .pop_con').click(function(){
							event.stopPropagation()
						})
					}else{
						$('.pop_copyfile').hide();
					};
				})
			}
			// htmlv=20160705
			//文件未找到提示效果开始
			$('.pop_searnew').click(function(){
				$('.pop_findnotips').show();
				var poptopHei = $('.pop_findnotips .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_findnotips,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_findnotips').hide();
			})
			$('.pop_findnotips .pop_con').click(function(){
				event.stopPropagation()
			})
			//文件未找到提示效果结束

			
			$('.pop_movefile,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_movefile').hide();
			})
			$('.pop_movefile .pop_con').click(function(){
				event.stopPropagation()
			})
			//点击移动至效果结束
			$('.back_to_add').click(function(){
				$('.pop_uploadfile').show();
				var poptopHei = $('.pop_uploadfile .pop_con').height();
				$('.pop_con').css({
				   'margin-top':-(poptopHei/2)
				})
			})
			$('.pop_uploadfile,.pop_close').click(function(){
				$('.pop_uploadfile').hide();
			})
			$('.pop_uploadfile .pop_con').click(function(){
				event.stopPropagation()
			})
			$(".pop_upload_a").on("change","input[type='file']",function(){
			    var filePath=$(this).val();
			    if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 ||filePath.indexOf("JPG")!=-1 || filePath.indexOf("gif")!=-1){
			        var arr=filePath.split('\\');
			        var fileName=arr[arr.length-1];
			        $(".pop_upload_a span").html(fileName);
			    }else{
			        $(".pop_upload_a span").html("您上传文件类型有误！");
			        return false 
			    }
			})
			$('.pop_editfile,.pop_close,.detail_pop_cancel').click(function(){
				$('.pop_editpic').hide();
			})
			$('.pop_con').click(function(){
				event.stopPropagation()
			})
		    /*var $container = $('.index_con');
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
		     });*/
		    // 点击完成
			$('.detail_select_cbgrey').click(function(){
				$('.detail_select_wrap').slideUp(400,function(){}).addClass('haha')
				$('.detail_raido_wrap',$('.index_item_imgwrap')).remove();
				$('.detail_raido_wrapred',$('.index_item_imgwrap')).remove();
			})
		    // <!-- htmlv=20160705 -->
		    $('.detail_fileb_simg').click(function(){
		    	var detail_selecth = '<div class="detail_raido_wrap" onclick="addSe(this)"></div>'
		    	$('.index_item_imgwrap ').append(detail_selecth)
		    	
		    	if (!$('.detail_select_wrap').hasClass('haha')) {
		    		$('.detail_select_wrap').show()
		    		$('.detail_select_wrap').slideUp(400,function(){
		    			$('.detail_select_wrap').addClass('haha');
		    			$('.index_item_imgwrap .detail_raido_wrap,.index_item_imgwrap .detail_raido_wrapred').remove();
		    			$('.detail_raido_wrapred').removeClass('detail_raido_wrapred').addClass('detail_raido_wrap');
	    				$("#detail_all_select").removeClass('detail_select_notball').addClass('detail_select_cball');
	    				$("#detail_all_select").html("全选");
	    				$("#detail_all_select").on('click',function(){
		    				if ($(this).hasClass('detail_select_cball')) {
		    					$('.detail_raido_wrap').removeClass('detail_raido_wrap').addClass('detail_raido_wrapred');
			    				$(this).removeClass('detail_select_cball').addClass('detail_select_notball');
			    				$(this).html("取消全选");
		    				}else{
		    					$('.detail_raido_wrapred').removeClass('detail_raido_wrapred').addClass('detail_raido_wrap');
			    				$(this).removeClass('detail_select_notball').addClass('detail_select_cball');
			    				$(this).html("全选");
		    				};
		    			})
		    		});
		    		event.stopPropagation();
		    	}else{
		    		$('.detail_select_wrap').slideDown(400, function() {
		    			$('.detail_select_wrap').removeClass('haha');
		    			$("#detail_all_select").on('click',function(){
		    				if ($(this).hasClass('detail_select_cball')) {
		    					$('.detail_raido_wrap').removeClass('detail_raido_wrap').addClass('detail_raido_wrapred');
			    				$(this).removeClass('detail_select_cball').addClass('detail_select_notball');
			    				$(this).html("取消全选");
		    				}else{
		    					$('.detail_raido_wrapred').removeClass('detail_raido_wrapred').addClass('detail_raido_wrap');
			    				$(this).removeClass('detail_select_notball').addClass('detail_select_cball');
			    				$(this).html("全选");
		    				};
		    			})
		    		});
		    	};
		    })

			// <!-- htmlv=20160705 -->
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
		    
		});
