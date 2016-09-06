@include('web.common.vr.head',['k1'=>'梦幻家——VR展示住宅空间','k2'=>'身临其境的看房体验','k3'=>'search-vr'])
	<div class="w1248 w1240">
			<div class="vr_line">
				<div class="vr-left"><span>位置</span></div>
					<div class="vr-right">
						<div id="sjld2" style="width:100%;position:relative;">
							<div class="m_zlxg" id="shenfen2">
								<p title="">选择省份</p>
								<div class="m_zlxg2">
									<ul></ul>
								</div>
							</div>
							<div class="m_zlxg" id="chengshi2">
								<p title="">选择城市</p>
								<div class="m_zlxg2">
									<ul></ul>
								</div>
							</div>
							<div class="m_zlxg" id="quyu2">
								<p title="">选择区域</p>
								<div class="m_zlxg2">
									<ul></ul>
								</div>
							</div>
							<input id="sfdq_num" type="hidden" value="" />
							<input id="csdq_num" type="hidden" value="" />
							<input id="sfdq_tj" type="hidden" value="" />
							<input id="csdq_tj" type="hidden" value="" />
							<input id="qydq_tj" type="hidden" value="" />
						</div>

					<script type="text/javascript">
					$(function(){
					
						$("#sjld2").sjld("#shenfen2","#chengshi2","#quyu2");
						
					});
					</script>
					</div>
			</div>
			<div class="search-option clearfix">
				<span>区&nbsp;&nbsp;&nbsp;&nbsp;域:</span>
				<ul>
					<li>全国</li><li>全上海</li><li class="on">黄浦</li><li>静安</li>
					<li>徐汇</li><li>浦东</li><li>长宁</li><li>虹口</li>
					<li>杨浦</li><li>普陀</li><li>闸北</li><li>闵行</li>
					<li>宝山</li><li>嘉定</li><li>青浦</li><li>奉贤</li>
					<li>南汇</li><li>崇明</li><li>金山</li><li>松江</li>
				</ul>
			</div>
			<div class="search-option clearfix">
				<span>开发商:</span>
				<ul>
					<li>不限</li><li class="on">世茂</li><li>万科</li><li>恒大 </li>
					<li>绿地</li><li>保利</li><li>中国海外发展</li><li>碧桂园</li>
					<li>融创中国</li><li>龙湖</li><li>富力</li><li>华润</li>
					<li>华夏幸福基业</li><li>招商</li><li>金地</li><li>远洋</li>     
					<li>绿城</li><li>荣盛</li><li>北京首都</li><li>复地</li>
					<li>金科</li><li>其他</li>
				</ul>
			</div>
			<div class="search-option clearfix">
				<span>户&nbsp;&nbsp;&nbsp;&nbsp;型:</span>
				<ul>
					<li>1居</li><li>2居</li><li class="on">3居</li><li>4居</li><li>5居</li><li>5居以上</li>
				</ul>
			</div>
	</div>
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
<script type="text/javascript">
	$('.search-option li').click(function(){
			if(!$(this).hasClass('on')){
				$(this).addClass('on').siblings().removeClass('on');
				$(this).siblings('input').val($(this).attr('data-val'));
			}
		})
</script>
<script type="text/javascript" src="{{asset('web/js/vr/index.js')}}"></script>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>