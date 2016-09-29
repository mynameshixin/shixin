@include('web.common.vr.head',['k1'=>'VR门店——品牌门店VR全景展示','k2'=>'身临其店轻松购物','k3'=>''])

 
		<div class="vr_home home_design">
			<div class="w1248">
				<!--品牌家居店-->
				<div class="w990 clearfix">
					<div class="home_title">
						<h3><span>——</span>品牌家居店<span>——</span></h3>
					</div>
					<ul class="clearfix" id="ul1">
						<?php foreach ($needData as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,{{$v['id']}},'{{$v['detail_url']}}')"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rect(this)"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">{{$v['cityname'] or '未知地区'}} {{$v['countryname'] or ''}}</span>
								<span class="vr_like" style="cursor: pointer;" onclick="like_count(this,{{$v['id']}})">{{$v['praise_count']}}</span>
								<span class="vr_view">{{$v['viewcount'] or '0'}}</span>
							</div>
						</li>
						<?php } ?>
						
					</ul>
					<div class="des_more"><a href="javascript:;" class="nolog_index_conmore1" type="1" id="des_more1">查看更多。。。</a></div>
				</div>
				<!--品牌饰品店-->
				<div class="w990 clearfix">
					<div class="home_title">
						<h3><span>——</span>品牌饰品店<span>——</span></h3>
					</div>
					<ul class="clearfix" id="ul2">
						<?php foreach ($needData2 as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,{{$v['id']}},'{{$v['detail_url']}}')"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rect(this)"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">{{$v['cityname'] or '未知地区'}} {{$v['countryname'] or ''}}</span>
								<span class="vr_like" style="cursor: pointer;" onclick="like_count(this,{{$v['id']}})">{{$v['praise_count']}}</span>
								<span class="vr_view">{{$v['viewcount'] or '0'}}</span>
							</div>
						</li>
						<?php } ?>
						
					</ul>
					<div class="des_more"><a href="javascript:;" class="nolog_index_conmore1" type="2" id="des_more2">查看更多。。。</a></div>
				</div>
				<!--品牌卫浴店-->
				<div class="w990 clearfix">
					<div class="home_title">
						<h3><span>——</span>品牌卫浴店<span>——</span></h3>
					</div>
					<ul class="clearfix" id="ul3">
						<?php foreach ($needData3 as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,{{$v['id']}},'{{$v['detail_url']}}')"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rect(this)" onclick="location.href='/webd/pic/{{$v['id']}}'" style="cursor: pointer;"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">{{$v['cityname'] or '未知地区'}} {{$v['countryname'] or ''}}</span>
								<span class="vr_like" style="cursor: pointer;" onclick="like_count(this,{{$v['id']}})">{{$v['praise_count']}}</span>
								<span class="vr_view">{{$v['viewcount'] or '0'}}</span>
							</div>
						</li>
						<?php } ?>
						
					</ul>
					<div class="des_more"><a href="javascript:;" class="nolog_index_conmore1" type="3" id="des_more3">查看更多。。。</a></div>
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
	var postUrl = '/vrp/vrindex'
	var postData = {}
</script>
<script type="text/javascript" src="{{asset('web/js/vr/vrindex.js')}}"></script>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>