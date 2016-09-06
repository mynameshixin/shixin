@include('web.common.vr.head',['k1'=>'梦幻家——VR展示住宅空间','k2'=>'身临其境的看房体验'])

		<div class="vr_home">
			<div class="w1248">
				<div class="w990 clearfix">
					<ul class="clearfix" id="ul">
					<?php foreach ($needData as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" href="{{$v['detail_url']}}" target="_blank"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rect(this)"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">{{$v['cityname'] or '未知地区'}} {{$v['countryname'] or ''}}</span>
								<span class="vr_like">{{$v['praise_count']}}</span>
								<span class="vr_view">{{$v['viewcount'] or '0'}}</span>
							</div>
						</li>
					<?php } ?>
					</ul>
					<div class="des_more" ><a href="javascript:;" id="des_more">查看更多。。。</a></div>
				</div>
			</div>
			<div class="cooperate">
				<img src="{{asset('web')}}/images/app_logo.png"/>
				<h2>成为堆图家合作开发商，获得更多样板房展示机会</h2>
				<a href="">了解更多</a>
			</div>
		</div>
		
	</div>
@include('web.common.foot')
@include('web.common.login',['index'=>1])
</body>
<script type="text/javascript">
	var postUrl = '/vrp/dream'
	var postData = {}
</script>
<script type="text/javascript" src="{{asset('web/js/vr/index.js')}}"></script>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>