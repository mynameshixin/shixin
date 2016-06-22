<div class="search_btn_con clearfix">
	<a href="/webd/search?keyword={{$keyword}}&type=2" class="search_btn_lround <?php if($type==2): ?>search_btn_select<?php endif;?>">文件夹</a>
	<a href="/webd/search/goods?keyword={{$keyword}}" class="<?php if($type==1): ?>search_btn_select<?php endif;?>">图片</a>
	<a href="/webd/search/goods?keyword={{$keyword}}&type=3" class="<?php if($type==3): ?>search_btn_select<?php endif;?>">商品</a>
	<a href="/webd/search/user?keyword={{$keyword}}&type=4" class="<?php if($type==4): ?>search_btn_select<?php endif;?>">用户</a>
	<?php if(!empty($self_id)): ?><a href="/webd/search/my?keyword={{$keyword}}&type=5" class="search_btn_rround <?php if($type==5): ?>search_btn_select<?php endif;?>">我的文件</a><?php endif; ?>
</div>