@include('web.common.vr.head',['k1'=>'设计家——二手房与家居改造','k2'=>'优秀作品实景展示','k3'=>''])


		<div class="vr_home home_design">
			<div class="w1248">
				<div class="w1248 clearfix">
					<div class="home_title">
						<h3><span>——</span>优秀设计师作品<span>——</span></h3>
					</div>
					<ul class="clearfix" id="ul2">
					<?php foreach ($needData as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,{{$v['id']}},'{{$v['detail_url']}}')"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rebind(this,394)" onclick="location.href='/webd/pic/{{$v['id']}}'" style="cursor: pointer;"/>
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
				<!--二手房改造精选-->
				<div class="w1248 clearfix">
					<div class="home_title">
						<h3><span>——</span>二手房改造精选<span>——</span></h3>
					</div>
					<ul class="clearfix" id="ul3">
						<?php foreach ($needData2 as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,{{$v['id']}},'{{$v['detail_url']}}')"></a>
								<span>{{$v['title']}}</span>
								<img src="{{$v['images'][0]['img_m']}}" onload="rebind(this,394)" onclick="location.href='/webd/pic/{{$v['id']}}'" style="cursor: pointer;"/>
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
			</div>
		</div>
		
	</div>
@include('web.common.foot')
@include('web.common.login',['index'=>1])
</body>
<script type="text/javascript">
	var postUrl = '/vrp/design'
	var postData = {}
</script>
<script type="text/javascript" src="{{asset('web/js/vr/design.js')}}"></script>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>