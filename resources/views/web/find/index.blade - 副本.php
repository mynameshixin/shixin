<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家--发现'])
<body>
	@include('web.common.banner')
	<div class="container">
		<div class="w1248 clearfix">
			<p class="find_title">分类</p>
			<div class="find_cater_wrap">
				<div class="find_cater clearfix">
					<ul class="find_cat_list">
						<?php foreach ($cate as $key => $v) :?>
							<li class="find_cat_listli <?php echo $key==5?'mrightzero':''; ?>">
								<img src="{{$v['img']}}" alt="">
								<a href="javascript:;" target="_blank">{{$v['name']}}</a>
							</li>
						<?php endforeach; ?>
						<li class="find_cat_listli mrightzero">
							<img src="{{url()}}/uploads/sundry/12.png" alt="">
							<a href="javascript:;" target="_blank" class="find_cat_more">查看全部</a>
						</li>
					</ul>
				</div>
				<div class="find_cater_all slideup clearfix">
					<div class="find_cater_tril"></div>
					<div class="find_cater_aeach_wrap clearfix">
					<?php foreach ($cate_all as $key => $value) :?>
						<?php if(in_array($key,[0,1,2])): ?>
						<ul class="find_cater_aeach <?php echo $key==2?'mrightzero':''; ?>" >
							<p class="find_cater_label">{{$value['name']}}</p>
							<?php foreach ($value['children'] as $k => $v): ?>
								<li><a href="javascript:;">{{$v['name']}}</a></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					<?php endforeach; ?>
					</div>
					<div class="find_cater_aeach_wrap clearfix">
						<?php foreach ($cate_all as $key => $value) :?>
						<?php if(in_array($key,[3,4,5])): ?>
						<ul class="find_cater_aeach <?php echo $key==5?'mrightzero':''; ?>">
							<p class="find_cater_label">{{$value['name']}}</p>
							<?php foreach ($value['children'] as $k => $v): ?>
								<li><a href="javascript:;">{{$v['name']}}</a></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					<?php endforeach; ?>
					</div>
				</div>
			</div>

			
			<p class="find_title">文件夹推荐</p>
			<div class="find_cater clearfix">
				<ul class="find_fold_list clearfix">
				<?php foreach ($recommend as $key => $v):?>
					<li class="find_fold_li <?php echo $key==4?'mrightzero':'';?>">
						<div class="find_fold_info clearfix">
							<div class="find_fold_authava">
								<a href="#" target="_blank"><img src="{{$v['user']['pic_m']}}" alt=""></a>
							</div>
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">{{$v['name']}}</a>
								<a href="#" target="_blank" class="find_fold_authnme">{{$v['user']['nick']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{$v['img_url']}}" alt="">
							<div class="find_fold_catflw">{{$v['count']}}文件&nbsp;&nbsp;{{$v['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($v['goods'][0]['image_url'])?$v['goods'][0]['image_url']:url().'/uploads/sundry/blogo.jpg';?>" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($v['goods'][1]['image_url'])?$v['goods'][1]['image_url']:url().'/uploads/sundry/blogo.jpg';?>" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($v['goods'][2]['image_url'])?$v['goods'][2]['image_url']:url().'/uploads/sundry/blogo.jpg';?>" alt="">
							</div>
							
						</div>
						<a href="javascript:;" class="find_fold_authflw"><?php echo !empty($v['is_collection'])?'已关注':"<span>+</span>关注"; ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<p class="find_title">商品推荐</p>
			<div class="w1248 clearfix" id="main" role="main">
				<div class="index_con" id="tiles">
					
				</div>
			</div>
			<a href="javascript:;" id='load' class="detail_pop_baddmore">正在加载中。。。</a>
		</div>
	</div>
	
</body>
<script type="text/javascript">
	postUrl = "{{url('webd/home/goods')}}"
	postData = {'num':10}
</script>
<script type="text/javascript" src="{{asset('web')}}/js/otherpubu.js"></script>
<script type="text/javascript">
		$(function() {

		   
		    // .find_cater_wrap
		    $('.find_cat_more').click(function(){
		    	if ($(this).parents('.find_cater_wrap').find('.find_cater_all').hasClass('slideup')) {
		    		$(this).parents('.find_cater_wrap').find('.find_cater_all').removeClass('slideup').addClass('slidedown');
		    	}else{
		    		$(this).parents('.find_cater_wrap').find('.find_cater_all').removeClass('slidedown').addClass('slideup');
		    	};
		    })
		});
	</script>
</html>