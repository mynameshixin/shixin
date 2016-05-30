<!DOCTYPE html>
<html lang="en">
<head>
	@include('web.common.head',['title'=>'堆图家用户图集'])
</head>
<body>
	@include('web.common.banner')
	<div class="detail_pop">
		<a href="javascript:;" class="detail_pop_loadclose"></a>
		<a href="javascript:;" class="detail_pop_loadbtn detail_pop_loadleft"></a>
		<a href="javascript:;" class="detail_pop_loadbtn detail_pop_loadright"></a>
		<div class="detail_pop_wrap w990 clearfix">
			<div class="detail_pop_top clearfix">
				<div class="detail_pop_tleft">
					<div class="detail_pop_tltop">
						<div class="detail_pop_tbtnwarp">
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtnbuy detail_pop_tbtn_cpadding detail_pop_collection">采集</div>
							<div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtnlike detail_pop_tbtn_cpadding">喜欢</div>
							<!-- <div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtntobuy detail_pop_tbtn_cpadding">去购买</div> -->
							<!-- <div href="javascript:;" class="detail_pop_tbtn detail_pop_tbtngrey detail_pop_tbtn_cpadding detail_pop_tbtnright">删除</div> -->
							<div class="detail_pop_tbtn detail_pop_tbtnright">
								<div class="detail_pop_tbtn_click detail_fileb_pr">
									分享
									<var class="detail_pop_tbtntril"></var>
								</div>
								<div class="detail_fileb_select slideup">
									<div class="detail_fileb_selectw">
										<span class="jiathis_style_32x32" id="own_share">
											<a class="jiathis_button_qzone detail_fileb_selecta detail_fileb_selectah"><img class="detail_fileb_sqq" src="public/images/qq.png" height="18" width="15" alt="">QQ</a>
											<a class="jiathis_button_weixin detail_fileb_selecta"><img class="detail_fileb_swx" src="public/images/wechat.png" height="17" width="19" alt="">微信</a>
										</span>
										<var class="detail_fileb_setril"></var>
									</div>
								</div>
							</div>
							<!-- JiaThis Button BEGIN -->
								<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
							<!-- JiaThis Button END -->
						</div>
						<div class="detail_pop_timgwarp" style="overflow: hidden">
							<img src="{{$goods['images'][0]['img_o']}}" alt="" onload="rect(this)">
							<?php if(!empty($goods['price'])): ?><div class="index_item_price">￥<?php echo $goods['price'];?></div><?php endif; ?>
						</div>
						<p class="detail_pop_des" title="{{$goods['description']}}">
							{{$goods['description']}}<a href="javascript:;" class="detail_pop_desmore"></a>
						</p>
						<div class="detail_pop_from">
							来自 <a href="{{$goods['detail_url']}}" class="detail_pop_fromurl" target="_blank"><?php echo mb_substr($goods['detail_url'], 0,50,'utf-8'); ?></a>
							<a href="javascript:;" class="detail_pop_fromwarn"></a>
							<!-- <a href="javascript:;" class="detail_pop_fromedit"></a> -->
						</div>
					</div>
					<div class="detail_pop_tlbtm">
						<div class="detail_pop_tlbtmauth clearfix">
							<div class="detail_pop_authava">
								<a href="{{url('webd/user/index')}}?oid={{$goods['user_id']}}"><img src="{{$goods['user']['pic_m']}}" alt=""></a>
							</div>
							<div class="detail_pop_authinfo">
								<p class="detail_pop_authname"><a href="{{url('webd/user/index')}}?oid={{$goods['user_id']}}">{{$goods['user']['nick'] or $goods['user']['username']}}</a></p>
								<p class="detail_pop_authcollect">采集到<span>{{$goods['folder']['name']}}</span></p>
							</div>
							<a class="detail_pop_authfollow detail_filebtn detail_fileball">
							<?php 
							switch ($goods['relation']) {
								case 1:
									echo '相互关注';
								break;
								case 2:
									echo '已关注';
								break;
								default:
									echo '未关注';
								break;
							}
							?>
							 </a>
						</div>
						<p class="detail_pop_tlbtmcomment">评论</p>
						<ul class="detail_pop_tlcomlist">
							<?php foreach ($goods['comments'] as $key => $v):?>
							<?php if(in_array($key, [0,1,2])): ?>
							<li class="clearfix">
								<div class="detail_pop_authava">
									<a href="{{url('webd/user/index')}}?oid={{$v['user']['id']}}"><img src="{{$v['user']['pic_m']}}" alt=""></a>
								</div>
								<div class="detail_pop_cominfo">
									<p class="detail_pop_comname"><a href="{{url('webd/user/index')}}?oid={{$v['user']['id']}}">{{$v['user']['nick'] or $v['user']['username']}}</a>- 1个月前说：
										<span class="detail_pop_comshare">
											<a href="javascript:;" class="detail_pop_share1"></a>
											<a href="javascript:;" class="detail_pop_share2"></a>
											<a href="javascript:;" class="detail_pop_share3"></a>
									</span>
									</p>
									<p class="detail_pop_comcon">{{$v['content']}}</p>
								</div>
								<div class="detail_pop_favor">{{$v['praise_count']}}</div>
							</li>
							<?php endif; ?>
							<?php endforeach; ?>
						</ul>
						<?php if(!empty($goods['comments'])): ?><a href="javascript:;" class="detail_pop_loadmore">显示更多评论</a><?php endif; ?>
						<div class="detail_pop_compublish clearfix">
							<div class="detail_pop_authava">
								<a href="{{url('webd/user/index')}}?oid={{$self_info['id']}}"><img src="{{$self_info['pic_m']}}" alt=""></a>
							</div>
							<textarea name="caption" placeholder="添加评论或把采集@给好友" class="detail_pop_compub" autocomplete="off"></textarea>
						</div>
						<div class="detail_pop_addcom clearfix">
							<a class="detail_pop_authfollow detail_filebtn detail_fileball">添加评论</a>
						</div>
					</div>
				</div>
				<div class="detail_pop_tright">
					<div class="detail_pop_trauth clearfix">
						<div class="detail_pop_authava">
							<a href="{{url('webd/user/index')}}?oid={{$goods['user_id']}}"><img src="{{$goods['user']['pic_m']}}" alt=""></a>
						</div>
						<div class="detail_pop_authinfo">
							<p class="detail_pop_authname"><a href="{{url('webd/folder/index')}}?oid={{$goods['user_id']}}&fid={{$goods['folder']['id']}}">{{$goods['folder']['name']}}</a></p>
							<p class="detail_pop_authcollect"><a href="{{url('webd/user/index')}}?oid={{$goods['user_id']}}">{{$goods['user']['nick'] or $goods['user']['username']}}</a></p>
						</div>
						<a class="detail_pop_authfollow detail_filebtn detail_fileball"><?php 
							switch ($goods['relation']) {
								case 1:
									echo '相互关注';
								break;
								case 2:
									echo '已关注';
								break;
								default:
									echo '未关注';
								break;
							}
							?></a>
					</div>
					<div class="detail_pop_trworks">
						<div class="detail_pop_trwwrap">
							<?php foreach ($goods['more'] as $key => $v):?>
							<div class="detail_pop_tritem">
								<div class="index_item_wrap">
									<div class="index_item_imgwrap clearfix">
										<a class="index_item_blurwrap" href="{{url('webd/pic/')}}/{{$v['id']}}"></a>
										<img src="{{$v['image_url']}}">
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="detail_pop_bottom">
				<p class="detail_pop_btitle">该采集也在以下文件夹</p>
				<div class="perhome_follow_wrap clearfix">
					<ul class="find_fold_list clearfix" id="ul">
						<?php if(empty($goods['collection_folders'])): ?><p class="nodata">暂无数据</p><?php endif; ?>
						<?php foreach($goods['collection_folders'] as $k=>$v): ?>
							<?php if(in_array($k, [0,1,2,3])): ?>
							<li class="find_fold_li <?php if(($k+1)%4==0) echo 'mrightzero'; ?>">
								<div class="find_fold_info clearfix">
									<div class="find_fold_authava">
										<a href="{{url('webd/user/index')}}?oid={{$v['user']['id']}}" target="_blank"><img src="{{!empty($v['user']['auth_avatar'])?$v['user']['auth_avatar']:$v['user']['pic_m']}}" alt=""></a>
									</div>
									<div class="find_fold_tname">
										<a href="#" target="_blank" class="find_fold_name">{{$v['name']}}</a>
										<a href="#" target="_blank" class="find_fold_authnme">{{$v['user']['nick'] or $v['user']['username']}}</a>
									</div>
								</div>
								<div class="find_fold_imgwrap">
									<div class="find_fold_imgblur"></div>
									<img src="{{$v['img_url']}}" alt="" onload="rect(this)">
									<div class="find_fold_catflw">{{$v['count']}}文件&nbsp;&nbsp;{{$v['collection_count']}}关注</div>
								</div>
								<div class="find_fold_limg clearfix">
									<div class="find_fold_liwrap">
										<div class="find_fold_liblur"></div>
										<img src="{{$v['goods'][0]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
									</div>
									<div class="find_fold_liwrap">
										<div class="find_fold_liblur"></div>
										<img src="{{$v['goods'][1]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
									</div>
									<div class="find_fold_liwrap">
										<div class="find_fold_liblur"></div>
										<img src="{{$v['goods'][2]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
									</div>
								</div>
								<a href="javascript:;" class="find_fold_authflw">
								<?php 
									echo $v['is_follow']==1?'已关注':'<span>+</span>特别关注';
								?>
								</a>
							</li>
						<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php if(!empty($goods['collection_folders'])): ?><a href="javascript:;" class="detail_pop_baddmore" id="more">加载更多</a><?php endif; ?>
				<p class="detail_pop_btitle">推荐给你的采集</p>
				<div class="index_con  perhome_wrap">
					<?php if(empty($goods['collection_folders'])): ?><p class="nodata">暂无数据</p><?php endif; ?>
					<?php foreach($goods['folders_one'] as $k=>$v): ?>
					<div class="index_item">
						<div class="index_item_wrap">
							<div class="index_item_imgwrap clearfix">
								<a class="index_item_blurwrap"></a>
								<?php if(!empty($v['price'])): ?><div class="index_item_price">￥{{$v['price']}}</div><?php endif; ?>
								<img src="{{$v['image_url']}}">
							</div>
							<div class="index_item_info">
								<div class="index_item_top">
									<div class="index_item_intro" title="{{!empty($v['description'])?$v['description']:$v['title']}}">{{!empty($v['description'])?$v['description']:$v['title']}}</div>
									<div class="index_item_rel clearfix">
										<a href="javascript:;" class="index_item_l">{{$v['praise_count']}}</a>
										<a href="javascript:;" class="index_item_c">{{$v['collection_count']}}</a>
										<a href="{{$v['detail_url']}}" target="_blank" class="index_item_b"></a>
									</div>
								</div>
								<?php foreach ($v['collection_good'] as $key => $value):?>
								<div class="index_item_bottom clearfix">
									<a href="{{url('webd/user/index')}}?oid={{$value['user_id']}}" class="index_item_authava" target="_blank">
										<img src="{{$value['pic_m']}}" alt="">
									</a>
									<div class="index_item_authinfo">
										<a href="javascript:;" class="index_item_authname">{{!empty($value['nick'])?$value['nick']:$value['username']}}</a>
										<span class="index_item_authto">采集到</span>
										<p class="index_item_authtopart">{{$value['name']}}</p>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- 采集时新建文件夹 -->
	<div class="pop_collect" style="display:none;">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="public/images/temp/pop_img.png" height="830" width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅">富有海的味道的客厅#室内设计#让新房的...</textarea>
					</div>
					
					<a href="javascript:;" class="detail_pop_colledit"></a>
				</div>
				<div class="pop_col_lbtm">
					<span class="pop_col_lbshare">
						分享到 :
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>
						<a class="pop_col_lbswc"></a>
						<a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>
					</span>
					
					<span class="pop_col_lbshare">
						微信朋友圈
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio"></a>
						<a class="pop_col_lbsqq"></a>
						<a class="jiathis_button_qzone jiathis_button"></a>
					</span>
					<span class="pop_col_lbshare">
						QQ空间
					</span>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				</div>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					创建文件夹
					<span class="pop_close"></span>
				</div>
				<div class="pop_col_infowrap">
					<div class="pop_col_name">
						<p class="pop_col_nlabel">名称</p>
						<input class="pop_col_ninput" placeholder="例如：欧式低奢亮色系风格">
					</div>
					<div class="pop_col_name">
						<p class="pop_col_nlabel">描述</p>
						<textarea class="pop_col_narea" placeholder="例如：欧式低奢亮色系风格"></textarea>
					</div>
					<div class="pop_col_priv">
						<p class="pop_col_nlabel">隐私</p>
						<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr">
						<label for="pop_iptpr"></label>
					</div>
				</div>
				<div class="pop_btnwrap">
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel">取消</a>
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding detail_pop_build">创建</a>
				</div>
			</div>
		</div>
	</div>
	<!-- 采集时选择文件夹 -->
	<div class="pop_collect pop_choose" style="display:none;">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="public/images/temp/pop_img.png" height="830" width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅" style="resize: none;">富有海的味道的客厅#室内设计#让新房的...</textarea>
					</div>
					
					<a href="javascript:;" class="detail_pop_colledit"></a>
				</div>
				<div class="pop_col_lbtm">
					<span class="pop_col_lbshare">
						分享到 :
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>
						<a class="pop_col_lbswc"></a>
						<a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>
					</span>
					
					<span class="pop_col_lbshare">
						微信朋友圈
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio"></a>
						<a class="pop_col_lbsqq"></a>
						<a class="jiathis_button_qzone jiathis_button"></a>
					</span>
					<span class="pop_col_lbshare">
						QQ空间
					</span>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				</div>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close"></span>
					<p class="pop_col_tips">
						该文件已采集到<a href="javascript:;">工业风格</a>文件夹
					</p>
					<div class="pop_col_sinput_wrap">
						<a href="javascript:;" class="pop_col_sinputbtn"></a>
						<input class="pop_col_sinput" placeholder="搜索">
					</div>
					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
							<a href="javascript:;" class="pop_col_alpbtn">A</a><a href="javascript:;" class="pop_col_alpbtn">B</a><a href="javascript:;" class="pop_col_alpbtn">C</a><a href="javascript:;" class="pop_col_alpbtn">D</a><a href="javascript:;" class="pop_col_alpbtn">E</a><a href="javascript:;" class="pop_col_alpbtn">F</a><a href="javascript:;" class="pop_col_alpbtn">G</a><a href="javascript:;" class="pop_col_alpbtn">H</a><a href="javascript:;" class="pop_col_alpbtn">I</a><a href="javascript:;" class="pop_col_alpbtn">J</a><a href="javascript:;" class="pop_col_alpbtn">K</a><a href="javascript:;" class="pop_col_alpbtn">L</a><a href="javascript:;" class="pop_col_alpbtn">M</a><a href="javascript:;" class="pop_col_alpbtn">N</a><a href="javascript:;" class="pop_col_alpbtn">O</a><a href="javascript:;" class="pop_col_alpbtn">P</a><a href="javascript:;" class="pop_col_alpbtn">Q</a><a href="javascript:;" class="pop_col_alpbtn">R</a><a href="javascript:;" class="pop_col_alpbtn">S</a><a href="javascript:;" class="pop_col_alpbtn">T</a><a href="javascript:;" class="pop_col_alpbtn">U</a><a href="javascript:;" class="pop_col_alpbtn">V</a><a href="javascript:;" class="pop_col_alpbtn">W</a><a href="javascript:;" class="pop_col_alpbtn">X</a><a href="javascript:;" class="pop_col_alpbtn">Y</a><a href="javascript:;" class="pop_col_alpbtn">Z</a>
						</div>
						<p class="pop_col_new">最新采集到</p>
						<ul class="pop_col_colum pop_col_colum_new">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew">+</a>
					<p class="pop_add_addfont">新建文件夹</p>
				</div>
			</div>
		</div>
	</div>
	<!-- 采集时提示已经采集过了 -->
	<div class="pop_collect pop_choose pop_choose_already" style="display:none;">
		<div class="pop_con">
			<div class="pop_col_left">
				<div class="pop_col_ltop clearfix">
					<img src="public/images/temp/pop_img.png" height="830" width="668" alt="">
					<div class="pop_col_dwrap clearfix">
						<textarea class="pop_col_detailtext" title="富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅富有海的味道的客厅#室内设计#让新房的客厅与大自然合二为一了哦，享受美好的自然气息，富有海的味道富有味道的客厅" style="resize: none;">富有海的味道的客厅#室内设计#让新房的...</textarea>
					</div>
					
					<a href="javascript:;" class="detail_pop_colledit"></a>
				</div>
				<div class="pop_col_lbtm">
					<span class="pop_col_lbshare">
						分享到 :
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio_on"></a>
						<a class="pop_col_lbswc"></a>
						<a class="jiathis_button_weixin jiathis_button jiathis_button_on"></a>
					</span>
					
					<span class="pop_col_lbshare">
						微信朋友圈
					</span>
					&nbsp;
					<span class="pop_col_bwrap">
						<a href="javascript:;" class="pop_col_r pop_col_radio"></a>
						<a class="pop_col_lbsqq"></a>
						<a class="jiathis_button_qzone jiathis_button"></a>
					</span>
					<span class="pop_col_lbshare">
						QQ空间
					</span>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
				</div>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close"></span>
					<p class="pop_col_tips">
						该文件已采集到<a href="javascript:;">工业风格</a>文件夹
					</p>
					<div class="pop_col_sinput_wrap">
						<a href="javascript:;" class="pop_col_sinputbtn"></a>
						<input class="pop_col_sinput" placeholder="搜索">
					</div>
					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
							<a href="javascript:;" class="pop_col_alpbtn">A</a><a href="javascript:;" class="pop_col_alpbtn">B</a><a href="javascript:;" class="pop_col_alpbtn">C</a><a href="javascript:;" class="pop_col_alpbtn">D</a><a href="javascript:;" class="pop_col_alpbtn">E</a><a href="javascript:;" class="pop_col_alpbtn">F</a><a href="javascript:;" class="pop_col_alpbtn">G</a><a href="javascript:;" class="pop_col_alpbtn">H</a><a href="javascript:;" class="pop_col_alpbtn">I</a><a href="javascript:;" class="pop_col_alpbtn">J</a><a href="javascript:;" class="pop_col_alpbtn">K</a><a href="javascript:;" class="pop_col_alpbtn">L</a><a href="javascript:;" class="pop_col_alpbtn">M</a><a href="javascript:;" class="pop_col_alpbtn">N</a><a href="javascript:;" class="pop_col_alpbtn">O</a><a href="javascript:;" class="pop_col_alpbtn">P</a><a href="javascript:;" class="pop_col_alpbtn">Q</a><a href="javascript:;" class="pop_col_alpbtn">R</a><a href="javascript:;" class="pop_col_alpbtn">S</a><a href="javascript:;" class="pop_col_alpbtn">T</a><a href="javascript:;" class="pop_col_alpbtn">U</a><a href="javascript:;" class="pop_col_alpbtn">V</a><a href="javascript:;" class="pop_col_alpbtn">W</a><a href="javascript:;" class="pop_col_alpbtn">X</a><a href="javascript:;" class="pop_col_alpbtn">Y</a><a href="javascript:;" class="pop_col_alpbtn">Z</a>
						</div>
						<p class="pop_col_new">最新采集到</p>
						<ul class="pop_col_colum pop_col_colum_new">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all">
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a class="pop_col_foldlock"></a>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
							<li class="pop_col_colum_on clearfix">
								<div class="pop_col_colava">
									<a href="javascript:;" target="_blank"><img src="public/images/temp_avatar.JPG" alt=""></a>
								</div>
								<div class="pop_col_colname"><a href="javascript:;" target="_blank">禅意装饰画</a></div>
								<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn">采集</a>
							</li>
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew">+</a>
					<p class="pop_add_addfont">新建文件夹</p>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	defaultPic = "{{url('uploads/sundry/blogo.jpg')}}"
	folderUrl = '{{url("webd/pics/folder?oid={$user_id}")}}'
	imgUrl = '{{url("webd/pics/img?oid={$user_id}")}}'
	postData = {'num':8,'img_id':{{$goods['id']}}}
</script>
 <script type="text/javascript" src="{{asset('web')}}/js/pic.js"></script>
</html>