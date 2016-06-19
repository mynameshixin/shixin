<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家用户设置'])
<body>
	@include('web.common.banner')
	<div class="container">
		<div class="w1248 clearfix">
			<div class="setting_con clearfix">
				<div class="setting_contit">
					账号设置
				</div>
				<div class="setting_coneach">
				<form action="" method="post" name="account">
					<div class="setting_coneachtit clearfix">
						<span>个人资料</span>
						<div class="setting_coneach_little slideup">
							{{$self_info['username']}}
						</div>
						<a href="javascript:;">收起&nbsp;<img src="{{asset('web')}}/images/setting_btn.png" height="10" width="11" alt=""></a>
					</div>
					<div class="setting_coneach_content">
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">登录名：</div>
							<div class="setting_coneach_conright">
								{{$self_info['username']}}
								<a href="#phone" class="ephone">修改手机号&nbsp;》</a>
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">昵称：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="昵称" value="{{$self_info['nick']}}" name="nick">
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">我是：</div>
							<div class="setting_coneach_conright setting_coneach_cone">
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="role" value="1" <?php if($self_info['role'] == 1): ?>checked<?php endif; ?>>&nbsp;设计师</label>
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="role" value="2" <?php if($self_info['role'] == 2): ?>checked<?php endif; ?>>&nbsp;家居迷</label>
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="role" value="3" <?php if($self_info['role'] == 3): ?>checked<?php endif; ?>>&nbsp;商家</label>
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">所在位置：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="所在位置" value="{{$self_info['location']}}" name="location">
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">性别：</div>
							<div class="setting_coneach_conright setting_coneach_cone">
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="gender" value="1" <?php if($self_info['gender'] == 1): ?>checked<?php endif; ?>>&nbsp;男</label>
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="gender" value="0" <?php if($self_info['gender'] == 0): ?>checked<?php endif; ?>>&nbsp;女</label>
								
							</div>
						</div>
						<!-- <div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">职业：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="室内设计师">
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">年龄：</div>
							<div class="setting_coneach_conright setting_coneach_ctwo">
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="label_one" value="">&nbsp;60后</label>
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="label_one" value="">&nbsp;70后</label>
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="label_one" value="">&nbsp;80后</label>
								<label class="setting_coneach_conrlabel" for="label_one"><input type="radio" name="label_one" value="">&nbsp;90后</label>
							</div>
						</div> -->
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">微信号：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="微信号" value="{{$self_info['wechat']}}" name="wechat">
							</div>
						</div>
						<!-- <div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">个人主页：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="http/:dfgfdgfefwemflwfsdfsaddml…">
							</div>
						</div> -->
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">关于自己：</div>
							<div class="setting_coneach_conright" style="height:74px;">
								<textarea name="signature" placeholder="关于自己">{{$self_info['signature']}}</textarea>
							</div>
						</div>
						<input type="hidden" name='user_id' value="<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"></input>
						<a href="javascript:;" class="setting_org_btn"  id="account">保存</a>
					</div>
				</form>
				</div>
				<div class="setting_coneach">
					<div class="setting_coneachtit clearfix">
						<span>头像</span>
						<div class="setting_coneach_little">
							<div class="setting_coneach_conrava">
								<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
							</div>
						</div>
						<a href="javascript:;">收起&nbsp;<img src="{{asset('web')}}/images/setting_btn.png" height="10" width="11" alt=""></a>
					</div>
					<div class="setting_coneach_content slideup">
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">&nbsp;</div>
							<div class="setting_coneach_conright">
								<div class="setting_coneach_conrava">
									<img src="{{asset('web')}}/images/temp_avatar.JPG" alt="">
								</div>
								<a href="javascript:;" class="setting_coneach_conload" style="color:#969696;float: left;">上传头像</a>
							</div>
						</div>
					</div>
				</div>
				<div class="setting_coneach">
					<div class="setting_coneachtit clearfix" id="phone">
						<span>登录手机号</span>
						<div class="setting_coneach_little">
							13818236788
						</div>
						<a href="javascript:;">收起&nbsp;<img src="{{asset('web')}}/images/setting_btn.png" height="10" width="11" alt=""></a>
					</div>
					<form action="" method="post" name='ephone'>
					<div class="setting_coneach_content slideup">
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">当前手机号：</div>
							<div class="setting_coneach_conright">
								{{$self_info['mobile']}}
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">新手机号：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="新手机号" name='mobile'>
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">验证码：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="验证码" name='captcha' style=" width: 142px;float: left">
								<input class="pop_login_h" type="button" name="" value="获取短信验证码" style=" margin-left: 10px">
							</div>
						</div>
						<div class="pop_login_contwrap clearfix">
							
							<div class="setting_coneach_conright" style="margin-left: 150px">
					            <p class="pop_login_pc" style="width: auto;display: none" >已发送至您的手机，<strong>60</strong>s后重新发送</p>
				            </div>
				        </div>
						<!-- <div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">登录密码：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="* * * * * *" type="password">
							</div>
						</div> -->
						<a href="javascript:;" class="setting_org_btn" id="ephone">保存</a>
					</div>
					</form>
				</div>
				<div class="setting_coneach">
					<form action="" method="post" name='epwd'>
					<div class="setting_coneachtit clearfix">
						<span>重置密码</span>
						<div class="setting_coneach_little">
							******
						</div>
						<a href="javascript:;">收起&nbsp;<img src="{{asset('web')}}/images/setting_btn.png" height="10" width="11" alt=""></a>
					</div>
					<div class="setting_coneach_content slideup">
						<!-- <div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">当前密码：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="13888888888">
							</div>
						</div> -->
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">新密码：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="新密码" type="password" name="password">
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">确认密码：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="确认密码" type="password" name="repassword">
							</div>
						</div>
						<a href="javascript:;" class="setting_org_btn" id="epwd">保存</a>
					</div>
					</form>
				</div>
				<!-- <div class="setting_coneach">
					<div class="setting_coneachtit clearfix">
						<span>个性网址</span>
						<div class="setting_coneach_little">
							http/:dfgfdgfefwemflwfsdfsaddml…
						</div>
						<a href="javascript:;">收起&nbsp;<img src="{{asset('web')}}/images/setting_btn.png" height="10" width="11" alt=""></a>
					</div>
					<div class="setting_coneach_content slideup">
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft">个人主页：</div>
							<div class="setting_coneach_conright">
								<input class="setting_coneach_conrinput" placeholder="http/:dfgfdgfefwemflwfsdfsaddml…">
							</div>
						</div>
						<a href="javascript:;" class="setting_org_btn">保存</a>
					</div>
				</div> -->
				<div class="setting_coneach">
					<div class="setting_coneachtit clearfix">
						<span>第三方账号登录</span>
						<div class="setting_coneach_little">
							<img src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="" style="margin-right: 20px;">
							<img src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">
						</div>
						<a href="javascript:;">收起&nbsp;<img src="{{asset('web')}}/images/setting_btn.png" height="10" width="11" alt=""></a>
					</div>
					<div class="setting_coneach_content slideup">
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft"><img src="{{asset('web')}}/images/qq.png" height="18" width="15" alt=""></div>
							<div class="setting_coneach_conright">
								<a href="javascript:;" class="setting_coneach_conload" style="color:#969696;float: left;margin:0px">重新绑定微信</a>
							</div>
						</div>
						<div class="setting_coneach_conwrap clearfix">
							<div class="setting_coneach_conleft"><img src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt=""></div>
							<div class="setting_coneach_conright">
								<a href="javascript:;" class="setting_coneach_conload" style="color:#969696;float: left;margin:0px"> 绑定QQ</a>
							</div>
						</div>
						<a href="javascript:;" class="setting_org_btn">保存</a>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>
<script type="text/javascript">
		$(function() {
		    $('.setting_coneachtit a').click(function() {
		    	var goalCon = $(this).parents('.setting_coneach').find('.setting_coneach_content');
		    	var littleCon = $(this).parents('.setting_coneach').find('.setting_coneach_little');
		    	if (goalCon.hasClass('slideup')) {
             		goalCon.removeClass('slideup').addClass('slidedown');
             		littleCon.addClass('slideup').removeClass('slidedown');
		    	}else{
		    		goalCon.addClass('slideup');
		    		littleCon.removeClass('slideup')
		    	};
		    });

		    $('.ephone').click(function(){
		    	$('.setting_coneachtit').eq(2).find('a').click()
		    })

		    //个人资料
		    $('#account').click(function(){
		    	accountc = $('form[name=account]');
		    	var pdata = {
		    		'nick':$('input[name=nick]',accountc).val().trim(),
		    		'role':$('input[name=role]',accountc).val().trim(),
		    		'location':$('input[name=location]',accountc).val().trim(),
		    		'gender':$('input[name=gender]',accountc).val().trim(),
		    		'wechat':$('input[name=wechat]',accountc).val().trim(),
		    		'signature':$('input[name=signature]',accountc).val(),
		    		'user_id':$('input[name=user_id]',accountc).val()
		    	}
		    	$.ajax({
		    		'beforeSend':function(){
		  				layer.load(0, {shade: 0.5});
		  			},
		    		'type':'post',
		    		'data':pdata,
		    		'dataType':'json',
		    		'url':'/webd/user/einfo',
		    		'success':function(json){
		    			if(json.code==200){
		    				layer.msg('保存成功',{icon:6})
		    				setTimeout(function(){
		    					location.reload()
		    				},1000)
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

		    $('#epwd').click(function(){
		    	epwd = $('form[name=epwd]')
		    	password = $('input[name=password]',epwd).val().trim()
		    	repassword = $('input[name=repassword]',epwd).val().trim()
		    	if(repassword =='' || password == ''){
		    		layer.msg('密码信息未填全', {icon: 5});
		    		return
		    	}
		    	if(repassword != password){
		    		layer.msg('两次密码信息不一致', {icon: 5});
		    		return
		    	}
		    	$.ajax({
		    		'beforeSend':function(){
		  				layer.load(0, {shade: 0.5});
		  			},
		  			'url':'/webd/user/epwd',
		    		'type':'post',
		    		'data':{'password':password,"repassword":repassword,'user_id':user_id},
		    		'dataType':'json',
		    		'success':function(json){
		    			if(json.code==200){
		    				layer.msg('密码修改成功请重新登陆',{icon:6})
		    				setTimeout(function(){
		    					location.href = '/webd/home/logout'
		    				},1000)
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
		   // 点击验证码
		   $('.pop_login_h').click(function(){
	        	ephone = $('form[name=ephone]')
	        	mobile = $('input[name=mobile]',ephone).val().trim()
		        if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(mobile)){
		          layer.msg('手机格式不正确', {icon: 5});
		          return 
		        }
			     $.ajax({
		          'dataType':'json',
		          'data':{'mobile':mobile,'type':1},
		          'type':'post',
		          'url':'/api/mobile/captcha',
		          'success':function(json){
		            if(json.code==200){
		              $('.pop_login_pc').find('strong').html(60)
		              $('.pop_login_h').attr('disabled','disabled')
		              $('.pop_login_pc').show()
		              var i = 60
		              var t = setInterval(function(){
		                n = --i
		                if(n == 0){
		                  clearInterval(t)
		                  $('.pop_login_h').removeAttr('disabled')
		                  $('.pop_login_pc').hide()
		                }
		                $('.pop_login_pc').find('strong').html(n)
		              },1000)
		            }else{
		              message = json.message[1]!=undefined?json.message:json.message[0]
		              layer.msg(message, {icon: 5});
		            }
		          }
		        })
     	 })
		  //修改手机号确定
	      $('#ephone').click(function(){
	        ephone = $('form[name=ephone]') 
	        mobile = $('input[name=mobile]',ephone).val().trim()
	        captcha = $('input[name=captcha]',ephone).val().trim()
	        $.ajax({
	          'beforeSend':function(){
	            layer.load(0, {shade: 0.5});
	          },
	          'dataType':'json',
	          'data':{'mobile':mobile,'captcha':captcha,'user_id':user_id},
	          'type':'post',
	          'url':'/webd/user/ephone',
	          'success':function(json){
	            if(json.code==200){
	              layer.msg('修改成功',{icon:6})
				  setTimeout(function(){
					location.reload()
				  },1000)
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
	});
	</script>
</html>