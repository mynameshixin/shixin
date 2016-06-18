<script type="text/javascript">
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	user_id = "{{$user_id}}"
	self_id = "{{$self_id}}"
	relationUrl = "{{url('webd/user/relation')}}"
</script>
<script src="{{url('web/js/user/relation.js')}}"></script>
<div class="perhome_per_wrap">
			<div class="w1248 w1240 clearfix">
				<div class="detail_perinfo_wrap clearfix">
					<div class="perhome_perinfo clearfix">
						<div class="detail_filetit_wrap">
							<div class="detail_filetit">
								{{$folder['name']}}
							</div>
							<p class="detail_filedes">{{!empty($folder['user_info']['nick'])?$folder['user_info']['nick']:$folder['user_info']['username']}}</p>
						</div>
						<div class="detail_fileinfo">
							<div class="detail_fileuser">
								<div class="detail_fuava">
									<img src="{{!empty($folder['user_info']['auth_avatar'])?$folder['user_info']['auth_avatar']:$folder['user_info']['pic_m']}}" alt="">
								</div>
								<p class="detail_funame">{{!empty($folder['user_info']['nick'])?$folder['user_info']['nick']:$folder['user_info']['username']}}</p>
							</div>
							<div class="perhome_perlike_wrap clearfix">
								<a href="{{url('webd/folder')}}?fid={{$folder['id']}}" class="perhome_perlike_label <?php echo $type==1?'perhome_perlike_lon':''; ?>">
									<p class="perhome_perlike_num">{{$folder['count']}}</p>
									<p class="perhome_perlike_la">文件</p>
								</a>
								<a href="{{url('webd/folder/fans')}}?fid={{$folder['id']}}" class="perhome_perlike_label <?php echo $type==2?'perhome_perlike_lon':''; ?>">
									<p class="perhome_perlike_num">{{$folder['fans_count']}}</p>
									<p class="perhome_perlike_la">关注</p>
								</a>
							</div>
							<div class="detail_filebtn_wrap clearfix">
								<!-- <div class="detail_filebtn detail_fileball">查看全部</div>
								<div class="detail_filebtn detail_filebtn_cpadding">只看商品</div> -->
								<div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										分享
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select slideup">
										<div class="detail_fileb_selectw">
											<span class="jiathis_style_32x32" id="own_share">
												<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
												<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
											</span>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div>
								<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
								<!-- JiaThis Button END -->
								<!-- <div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										编辑
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select detail_fileb_selectt slideup">
										<div class="detail_fileb_selectw">
											<a href="javascript:;" class="detail_fileb_seleta detail_fileb_seletah detail_fileb_simg">批量管理文件</a>
											<a href="javascript:;" class="detail_fileb_seleta detail_fileb_sfld">编辑文件夹</a>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="perhome_scroll_wrap">
			<div class="w1248 w1240 clearfix">
				<div class="perhome_scroll_info">
					<div class="detail_fileuser">
						<div class="detail_fuava">
							<img src="{{!empty($folder['user_info']['auth_avatar'])?$folder['user_info']['auth_avatar']:$folder['user_info']['pic_m']}}" alt="">
						</div>
						<p class="detail_funame">{{!empty($folder['user_info']['nick'])?$folder['user_info']['nick']:$folder['user_info']['username']}}</p>
					</div>
					<div class="perhome_perlike_wrap clearfix">
						<a href="{{url('webd/folder')}}?fid={{$folder['id']}}" class="perhome_perlike_label perhome_perlike_lon">
							<p class="perhome_perlike_num">{{$folder['count']}}</p>
							<p class="perhome_perlike_la">文件</p>
						</a>
						<a href="{{url('webd/folder/fans')}}?fid={{$folder['id']}}" class="perhome_perlike_label">
							<p class="perhome_perlike_num">{{$folder['fans_count']}}</p>
							<p class="perhome_perlike_la">关注</p>
						</a>
					</div>
					<div class="detail_filebtn_wrap clearfix">
								<!-- <div class="detail_filebtn detail_fileball">查看全部</div>
								<div class="detail_filebtn detail_filebtn_cpadding">只看商品</div> -->
								<div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										分享
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select slideup">
										<div class="detail_fileb_selectw">
											<span class="jiathis_style_32x32" id="own_share">
												<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="{{asset('web')}}/images/qq.png" height="18" width="15" alt="">QQ</a>
												<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="{{asset('web')}}/images/wechat.png" height="17" width="19" alt="">微信</a>
											</span>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div>
								<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
								<!-- JiaThis Button END -->
								<!-- <div class="detail_filebtn">
									<div class="detail_filebtn_click detail_fileb_pr">
										编辑
										<var class="detail_filebtril"></var>
									</div>
									<div class="detail_fileb_select detail_fileb_selectt slideup">
										<div class="detail_fileb_selectw">
											<a href="javascript:;" class="detail_fileb_seleta detail_fileb_seletah detail_fileb_simg">批量管理文件</a>
											<a href="javascript:;" class="detail_fileb_seleta detail_fileb_sfld">编辑文件</a>
											<var class="detail_fileb_setril"></var>
										</div>
									</div>
								</div> -->
							</div>
				</div>
			</div>
		</div>

		<div class="detail_select_wrap haha">
			<div class="detail_select_bg"></div>
			<div class="w1248 w1240 clearfix">
				<div class="detail_select_con">
					<a href="javascript:;" class="detail_select_cbtn detail_select_cball">全选</a>
					<a href="javascript:;" class="detail_select_cbtn detail_select_cbgrey">完成</a>
					<a href="javascript:;" class="detail_select_cbtn detail_select_btndele">删除</a>
					<a href="javascript:;" class="detail_select_cbtn detail_select_btncopy">复制至...</a>
					<a href="javascript:;" class="detail_select_cbtn detail_select_btnmove">移动至...</a>
				</div>
			</div>
		</div>