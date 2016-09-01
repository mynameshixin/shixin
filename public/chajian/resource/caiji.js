$(function() {
			var $container = $('.dtj-waterfull');
			$container.imagesLoaded(function() {
				$container.masonry({
					itemSelector: '.item',
					gutter: 15,
					isAnimated: true,
				});
			});
			
			var select_num=0;
			$('.slect-btn').click(function(){
				var item=$(this).parents('.item');
				var checked=$(item).hasClass('item-selected');
				if(checked){
					$(item).removeClass('item-selected');
					chageStatus()
				}else{
					if(select_num<5){
						$(this).parents('.item').addClass('item-selected');
						select_num=$('.item-selected').length;
						chageStatus();
					}else{
						var _html=$('.dtj-multi-noti').html();
						$('.dtj-multi-noti').html('<p style="color:red">最多只能选择五张图片或者视频</p>');
						setTimeout(function(){
							$('.dtj-multi-noti').html(_html);
						},3000)
					}
				}
				
			})
			$('.dtj-cancel').click(function(){
				$('.item-selected').removeClass('item-selected');
				chageStatus();
			})
			function chageStatus(){
				select_num=$('.item-selected').length;
				if(select_num){
					$('.dtj-multi-noti').css('display','block');
					$('.footer').css('display','block');
					$('.dtj-multi-noti').find('b').text(select_num);
				}else{
					$('.dtj-multi-noti').css('display','none');
					$('.footer').css('display','none');
				}
			}
			
			$('.dtj-confirm').click(function(){
				$('.pop_collect').css('display','block')
			})
			//模拟采集成功效果
			$('.pop_close').click(function(){
				$('.sunccess').show();
			  	$('.sunccess').fadeOut(5000);
			})
			
		});