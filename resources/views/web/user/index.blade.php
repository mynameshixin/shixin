<!DOCTYPE html>
<html lang="en">
@include('web.common.head',['title'=>'堆图家用户文件夹'])
<body>
<script type="text/javascript">

function AutoResizeImage(maxWidth, maxHeight, objImg) {
    var img = new Image();
    img.src = objImg.src;
    var hRatio;
    var wRatio;
    var Ratio = 1;
    var w = img.width;
    var h = img.height;
    wRatio = maxWidth / w;
    hRatio = maxHeight / h;
    if (maxWidth == 0 && maxHeight == 0) {
        Ratio = 1;
    } else if (maxWidth == 0) { //
        if (hRatio < 1)
            Ratio = hRatio;
    } else if (maxHeight == 0) {
        if (wRatio < 1)
            Ratio = wRatio;
    } else if (wRatio < 1 || hRatio < 1) {
        Ratio = (wRatio <= hRatio ? wRatio : hRatio);
    }
    if (Ratio < 1) {
        w = w * Ratio;
        h = h * Ratio;
    }
    objImg.height = h;
    objImg.width = w;
}

</script>
	@include('web.common.banner')
	<div class="container">
		@include('web.common.user')
		
		<div class="w1248 w1240 clearfix">
			<div class="find_cater perhome_wrap clearfix">
				<ul class="find_fold_list clearfix">
				<?php foreach ($folders as $key => $value) :?>
					<?php if($value['private'] == 0): ?>
					<li class="find_fold_li <?php echo ($key+1)%5 == 0?'mrightzero':''; ?>">
						<div class="find_fold_info clearfix">
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">{{$value['name']}}</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{$value['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="" onload="AutoResizeImage(223,147,this)">
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{ $value['goods'][0]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{ $value['goods'][1]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="{{ $value['goods'][2]['image_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw"><span>+</span>关注</a>
					</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>
			<p class="perhome_addprivate">创建隐私文件夹，只有你自己可以看得见哦</p>
			<div class="find_cater perhome_wrap clearfix">
				<ul class="find_fold_list clearfix">
					<?php foreach ($folders as $key => $value) :?>
					<?php if($value['private'] == 1): ?>
					<li class="find_fold_li <?php echo $key%5 == 0?'mrightzero':''; ?>">
						<div class="find_fold_info clearfix">
							<div class="find_fold_tname">
								<a href="#" target="_blank" class="find_fold_name">客厅空间</a>
							</div>
						</div>
						<div class="find_fold_imgwrap">
							<div class="find_fold_imgblur"></div>
							<img src="{{$value['img_url'] or url('uploads/sundry/blogo.jpg')}}" alt="">
							<div class="find_fold_catflw">{{$value['count']}}文件&nbsp;&nbsp;{{$value['collection_count']}}关注</div>
						</div>
						<div class="find_fold_limg clearfix">
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($value['goods'][0]['image_url'])?$value['goods'][0]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($value['goods'][1]['image_url'])?$value['goods'][1]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="">
							</div>
							<div class="find_fold_liwrap">
								<div class="find_fold_liblur"></div>
								<img src="<?php  echo isset($value['goods'][2]['image_url'])?$value['goods'][2]['image_url']:url('uploads/sundry/blogo.jpg');?>" alt="">
							</div>
						</div>
						<a href="javascript:;" class="find_fold_authflw"><span>+</span>关注</a>
					</li>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<h1 id='load' style="text-align: center;line-height: 40px; height:40px;color:#999; font-size: 20px; margin-bottom: 30px;display: none">正在加载中。。。</h1>
</body> 

<script type="text/javascript">
	postUrl = '{{url("webd/user/folders?oid={$user_id}")}}'
	postData = {'num':10}
</script>

<script type="text/javascript" src="{{asset('web')}}/js/user/folders.js"></script>
</html>