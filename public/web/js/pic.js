$(function(){
				$('.detail_pop').scroll(function(event) {
					// console.info($('.detail_pop').scrollTop());
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
				var $con_pop = $('.detail_pop_trwwrap');
			    $con_pop.imagesLoaded(function() {
			        $con_pop.masonry({
		                itemSelector: '.detail_pop_tritem',
		                gutter: 1,
		                isAnimated: true,
		            });
		            
			     });
			   /* var $container = $('.index_con');
			    $container.imagesLoaded(function() {
			        $container.masonry({
		                itemSelector: '.index_item',
		                gutter: 15,
		                isAnimated: true,
		            });
		            
			     });*/

			    $('.detail_pop_loadmore').click(function(){
			    	$('.detail_pop_tlcomlist li').show()
			    	$(this).hide()
			    })
			   
			    //采集ajax 
			    $('.detail_pop_collection').click(function(){
			    	if(user_id==''){
			    		layer.msg('请登录', {icon: 5});
			    		$('.pop_login2').show()
			    		h = $('.pop_login2').find('.pop_con').height()
				        $('.pop_login2').find('.pop_con').css({
				           'margin-top':-(h/2)
				        })
			    		return 
			    	}
					$('#collect_inner').show();
					var popH =$('#collect_inner').show().find('.pop_con').height();
					$('#collect_inner').show().find('.pop_col_left').height(popH);
					var collect_inner = $('#collect_inner')
					var proposals = []
					$.ajax({
						'beforeSend':function(){
							layer.load(0, {shade: 0.5});
						},
						'url':'/webd/pics/cgoods',
						'data':{'user_id':user_id},
						'type':'post',
						'dataType':'json',
						'success':function(json){
							if(json.code==200){
								cgcontent = afolder = ''
								$.each(json.data.cg,function(index,v){
									cgcontent += '<li class="pop_col_colum_on clearfix" folder_id='+v.id+' style="cursor:pointer" onclick="c_function(this)">'
										+'<div class="pop_col_colava">'
											+'<img src="'+v.image_url+'" alt="">'
										+'</div>'
										+'<div class="pop_col_colname">'+v.name.substr(0,8)+'</div>'

									if(v.private==1) cgcontent+='<a class="pop_col_foldlock"></a>'
										cgcontent+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn" >采集</a>'
									+'</li>'
								})
								$('.pop_col_colum_new',collect_inner).html(cgcontent)
								$.each(json.data.folder,function(index,v){
									afolder += '<li class="pop_col_colum_on clearfix" folder_id='+v.id+' style="cursor:pointer" onclick="c_function(this)">'
										+'<div class="pop_col_colava">'
											+'<img src="'+v.image_url+'" alt="">'
										+'</div>'
										+'<div class="pop_col_colname">'+v.name.substr(0,8)+'</div>'
										if(v.private==1) afolder+='<a class="pop_col_foldlock"></a>'
										afolder+='<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn" >采集</a>'
									+'</li>'
									proposals[index] = v.name
								})
								$('.pop_col_colum_all',collect_inner).html(afolder)
							}else{
								layer.msg(json.message, {icon: 5});
								return
							}
						},
						'complete':function(){
							layer.closeAll('loading');
						}
					})
					//自动补全
					$('#search_form_inner').autocomplete({
							hints: proposals,
							width: 218,
							height: 36,
							onSubmit: function(text){
								var pop_col_colum_all_li =  $('.pop_col_colum_all li',collect_inner)
								$.each(pop_col_colum_all_li,function(index,v){
									if(pop_col_colum_all_li.eq(index).find('.pop_col_colname').html()==text){
										$('#search_inner').html(pop_col_colum_all_li.eq(index).clone())
										return
									}
								})	
							}
						});
				})
				
				

			    //创建新文件
				$('#pop_add_addnew').click(function(){
					$('#collect_inner').hide();
					$('#folder_inner').show()
					var popH =$('#folder_inner').show().find('.pop_con').height();
					$('#folder_inner').show().find('.pop_col_left').height(popH);					
				})
				$('#folder_inner .pop_iptprivacy').click(function(){
					if($(this).attr('checked') == 'checkbox') return
					if($(this).attr('private') == 1){
						$(this).attr('private',0)
					}else{
						$(this).attr('private',1)
					}
				})
				//创建点击按钮
				$('#cfolder').click(function(){
					var pop_con = $(this).parents('.pop_con')
					var name = $('input[name=fname]',pop_con).val().trim()
					var description = $('textarea',pop_con).val().trim()
					var private = $('input[name=private]',pop_con).attr('private')
					if(name=='') {
						layer.msg('信息没有填写完全', {icon: 5});
						return 
					}
					$.ajax({
						'beforeSend':function(){
							layer.load(0, {shade: 0.5});
						},
						'url':"/webd/folder/cfolder",
						'type':'post',
						'data':{
							'name':name,
							'description':description,'private':private,
							'fid':10,'user_id':user_id
						},
						'dataType':'json',
						'success':function(json){
							if(json.code==200){
								layer.msg('创建成功', {icon: 6});
								setTimeout(function(){
									location.reload()
								},2000)
							}else{
								layer.msg(json.message, {icon: 5});
								return
							}
						},
						'complete':function(){
							layer.closeAll('loading');
						}
					})
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
				/*var textcon = $('.pop_col_detailtext').text();
				$('.pop_col_detailtext').focusin(function(event) {
					var moreHtml = $('.pop_col_detailtext').attr('title');
					var littleHtml = $('.pop_col_detailtext').html();
					$('.pop_col_detailtext').html(moreHtml);
					$('.pop_col_detailtext').css({
						'overflow-y':'scroll'
					});
					$('.detail_pop_colledit').hide();
				});
				$('.pop_col_detailtext').focusout(function(event) {
					$('.pop_col_detailtext').html(textcon);
					
					$('.detail_pop_colledit').show();
				});
				$('.detail_pop_colledit').click(function(){
					var moreHtml = $('.pop_col_detailtext').attr('title');
					$('.pop_col_detailtext').html(moreHtml);
					$('.pop_col_detailtext').css({
						'overflow-y':'scroll'
					});
					
				})*/
				//左侧相关信息编辑结束
				if ($('.pop_col_infowrap').height()>360) {
					$('.pop_col_infowrap').css({
						'overflow-y': 'scroll'
					});
				}
				/*$('.detail_pop_loadclose,.detail_pop').click(function(){
					$('body').removeClass('overhidden')
					$('.detail_pop').css({
						display:'none'
					});
					$('.pop_img_bigpointerwrap').html("");
					$('.pop_img_bigwrap').css({'left':0});
					var state = {
						title:'',
						url:'http://www.baidu.com'
					};
					window.history.pushState(state,document.title,state.url);
				});*/
				
				/*$('.detail_pop_loadclose,.detail_pop').click(function(){
					$('body').removeClass('overhidden')
					$('.detail_pop').css({
						display:'none'
					});
				});*/
				$('.detail_pop_wrap,.detail_pop_loadbtn').click(function(){
					event.stopPropagation()
				})
				
		   
		    $(window).scroll(function(event) {
				var scrollHei = $('body').scrollTop();
				if (scrollHei <= 260) {
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
				    $('.detail_pop_comshare').hide();
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
	page = 1
	function onMore() {

    	obj = $(this)
    	moreData.page = ++page
    	ul = $('#ul')
    	$.ajax({
		  	'beforeSend':function(){
		  		obj.html('请等待。。。')
		  	},
		  	'url':folderUrl,
		  	'type':'POST',
		  	'dataType':'json',
		  	'data':moreData,
		  	'success':function(json){
		  		if(json.code==200 && json.data.list!=0 && json.data.list!=null){
		  			data = json.data.list

		  			$lis = $('.find_fold_li',ul).slice(0,data.length).clone()

					$.each($lis,function(index,v){
						if(data[index]==null) {
							/*$($lis[index]).eq(index).remove()
							return;*/
						}
						gpic_1 = data[index].goods[0] != undefined?data[index].goods[0].image_url:defaultPic
						gpic_2 = data[index].goods[1] != undefined?data[index].goods[1].image_url:defaultPic
						gpic_3 = data[index].goods[2] != undefined?data[index].goods[2].image_url:defaultPic

						glink_1 = data[index].goods[0] != undefined?'/webd/pic/'+data[index].goods[0].id:''
						glink_2 = data[index].goods[1] != undefined?'/webd/pic/'+data[index].goods[1].id:''
						glink_3 = data[index].goods[2] != undefined?'/webd/pic/'+data[index].goods[2].id:''

						$($lis[index]).attr('folder_id',data[index].id)
						$('.find_fold_name',$lis[index]).html(data[index].name).attr('href','/webd/folder?fid='+data[index].id)
						nick = data[index].user.nick!=''?data[index].user.nick:data[index].user.username
						$('.find_fold_authnme',$lis[index]).html(nick).attr('href','/webd/user/index?oid='+data[index].user.id)

						$('.find_fold_imgwrap img',$lis[index]).attr('src',data[index].img_url)
						$('.find_fold_imgwrap a',$lis[index]).attr('href','/webd/folder?fid='+data[index].id)

						$('.find_fold_catflw',$lis[index]).html(data[index].count+'文件&nbsp;&nbsp;'+data[index].collection_count+'关注')

						$('.find_fold_liwrap a',$lis[index]).eq(0).attr('href',glink_1)
						$('.find_fold_liwrap a',$lis[index]).eq(1).attr('href',glink_2)
						$('.find_fold_liwrap a',$lis[index]).eq(2).attr('href',glink_3)

						$('.find_fold_liwrap img',$lis[index]).eq(0).attr('src',gpic_1)
						$('.find_fold_liwrap img',$lis[index]).eq(1).attr('src',gpic_2)
						$('.find_fold_liwrap img',$lis[index]).eq(2).attr('src',gpic_3)

						$('.find_fold_authflw',$lis[index]).css('display','block')
						if(self_id==data[index].user.id){
							$('.find_fold_authflw',$lis[index]).css('display','none')
						}
						follow = data[index].is_follow==1?'已关注':'<span>+</span>特别关注'
						$('.find_fold_authflw',$lis[index]).html(follow)

						pic_m = data[index].user.auth_avatar!=null?data[index].user.auth_avatar:data[index].user.pic_m
						$('.find_fold_authava img',$lis[index]).attr('src',pic_m)
						$('.find_fold_authava a',$lis[index]).attr('href','/webd/user/index?oid='+data[index].user.id)


					})
					
					$(ul).append($lis)
					obj.html('查看更多。。。')
					
		  		}else{
		  			obj.html('没有更多。。。')
		  		}

		  	}
		  })      
    }
    $('#more').bind('click', onMore);
})