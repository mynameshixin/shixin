@include('web.common.vr.head',['k1'=>'梦幻家——VR展示住宅空间','k2'=>'身临其境的看房体验','k3'=>''])

	<div class="w1248 w1240">
			
			<div class="vr_line">
				<div class="vr-left"><span>位&nbsp;&nbsp;&nbsp;&nbsp;置</span></div>

				<form class="form-inline">
			      <div id="distpicker2">
			        <div class="form-group">
			          <label class="sr-only" for="province5">Province</label>
			          <select class="form-control form-select" id="province5"></select>
			        </div>
			        <div class="form-group">
			          <label class="sr-only" for="city5">City</label>
			          <select class="form-control form-select" id="city5"></select>
			        </div>
			        <div class="form-group">
			          <label class="sr-only" for="district5">District</label>
			          <select class="form-control form-select" id="district5"></select>
			        </div>
			      </div>
	    		</form>
			<script type="text/javascript">
				$("#distpicker2").distpicker({
				  province: "---- 不限省 ----",
				  city: "---- 不限市 ----",
				  district: "---- 不限区县 ----",
				  autoSelect: false
				});
			</script>		
			</div>
			<?php if($alias== 2){ ?>
				<div class="search-option clearfix">
					<span>类&nbsp;&nbsp;&nbsp;型</span>
					<ul ng-controller="type">
						<li ng-repeat="v in type" onclick="addClassOntype(this)" typeid="{%v.id%}">{%v.name%}</li>
					</ul>
				</div>
			<?php } ?>
			<?php if($alias== 3){ ?>
				<div class="search-option clearfix">
					<span>门店类型</span>
					<ul ng-controller="btype">
						<li ng-repeat="v in btype" onclick="addClassOnbtype(this)" btypeid="{%v.id%}">{%v.name%}</li>
					</ul>
				</div>
			<?php } ?>
			<?php if($alias== 3){ ?>
				<div class="search-option clearfix">
					<span>所在卖场</span>
					<ul ng-controller="sale">
						<li ng-repeat="v in sale" onclick="addClassOnsale(this)" saleid="{%v.id%}">{%v.name%}</li>
					</ul>
				</div>
			<?php } ?>
			<?php if($alias==1 || $alias == 2){ ?>
				<div class="search-option clearfix">
					<span>开发商</span>
					<ul ng-controller="dev">
						<li ng-repeat="v in dev" onclick="addClassOndev(this)" devid="{%v.id%}">{%v.name%}</li>
					</ul>
				</div>
				<div class="search-option clearfix">
					<span>户&nbsp;&nbsp;&nbsp;型</span>
					<ul ng-controller="huxing">
						<li ng-repeat="v in huxing" onclick="addClassOnhu(this)" huid="{%v.id%}">{%v.name%}</li>
					</ul>
				</div>
			<?php } ?>
	</div>
	<div class="vr_home">
			<div class="w1248">
				<div class="w990 clearfix">
					<ul class="clearfix" id="ul" >
					<?php foreach ($needData as $key => $v) { ?>
						<li class="vr_home_list">
							<div class="vr_content">
								<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,{{$v['id']}},'{{$v['detail_url']}}')"></a>
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
					<div class="des_more" ><a href="javascript:;" id="des_more" onclick="addnew()">查看更多。。。</a></div>
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
	// 公共的数据
	var cdata = {'alias':{{$alias}},'keyword':"{{$keyword}}",'devid':0,'huid':0,'cityid':0,'page':1,'typeid':0,'btypeid':0,'saleid':0}

	// 公共请求ajax
	function reajax(cdata){
		$.ajax({
	      	'url':'/vrp/search',
	      	'type':'post',
	      	'dataType':'json',
	      	'data':cdata,
	      	'success':function(json){
	      		var li = ''
	      		$.each(json,function(i,v){
	      			li += '<li class="vr_home_list">\
								<div class="vr_content">\
									<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,'+v.id+','+v.detail_url+')"></a>\
									<span>'+v.title+'</span>\
									<img src="'+v.images[0].img_m+'" onload="rect(this)"/>\
								</div>\
								<div class="vr_title">\
									<span class="vr_home_loc">'+v.cityname+' '+v.countryname+'</span>\
									<span class="vr_like">'+v.praise_count+'</span>\
									<span class="vr_view">'+v.viewcount+'</span>\
								</div>\
							</li>'
				})
				$('#ul').html(li)
	      	}
	      })
	}
	// 开发商
	function addClassOndev(obj){
	  cdata.page = 1
      $(obj).parent('ul').find('li').removeClass('on')
      $(obj).addClass('on')
      devid = $(obj).attr('devid')
      cdata.devid = devid
      reajax(cdata)
    }
    // 户型
    function addClassOnhu(obj){
      cdata.page = 1
      $(obj).parent('ul').find('li').removeClass('on')
      $(obj).addClass('on')
      huid = $(obj).attr('huid')
      cdata.huid = huid
      reajax(cdata)
    }
    // 类型
    function addClassOntype(obj){
      cdata.page = 1
      $(obj).parent('ul').find('li').removeClass('on')
      $(obj).addClass('on')
      typeid = $(obj).attr('typeid')
      cdata.typeid = typeid
      reajax(cdata)
    }
    // 门店类型
    function addClassOnbtype(obj){
      cdata.page = 1
      $(obj).parent('ul').find('li').removeClass('on')
      $(obj).addClass('on')
      btypeid = $(obj).attr('btypeid')
      cdata.btypeid = btypeid
      reajax(cdata)
    }
    // 卖场类型
    function addClassOnsale(obj){
      cdata.page = 1
      $(obj).parent('ul').find('li').removeClass('on')
      $(obj).addClass('on')
      saleid = $(obj).attr('saleid')
      cdata.saleid = saleid
      reajax(cdata)
    }
    // 加载更多
    function addnew(){
    	cdata.page++
		$.ajax({
	      	'url':'/vrp/search',
	      	'type':'post',
	      	'dataType':'json',
	      	'data':cdata,
	      	'success':function(json){
	      		if(json==''){
			  	  $('#des_more').html('没有更多。。。')
				  return 	
			  	}
			  	
			  	var li = ''
	      		$.each(json,function(i,v){
	      			li += '<li class="vr_home_list">\
								<div class="vr_content">\
									<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,'+v.id+','+v.detail_url+')"></a>\
									<span>'+v.title+'</span>\
									<img src="'+v.images[0].img_m+'" onload="rect(this)"/>\
								</div>\
								<div class="vr_title">\
									<span class="vr_home_loc">'+v.cityname+' '+v.countryname+'</span>\
									<span class="vr_like">'+v.praise_count+'</span>\
									<span class="vr_view">'+v.viewcount+'</span>\
								</div>\
							</li>'
				})
				$('#ul').append(li)
	      	}
	      })
    }

	$('.form-select').change(function(){
		cdata.page = 1
		var s1 = $('.form-select').eq(0).find('option:selected').attr('data-code')
		var s2 = $('.form-select').eq(1).find('option:selected').attr('data-code')
		var s3 = $('.form-select').eq(2).find('option:selected').attr('data-code')
		if(s1!='' && s2==''){
			cdata.cityid = s1
		}
		if(s1!='' && s2!='' && s3==''){
			cdata.cityid = s2
		}
		if(s1!='' && s2!='' && s3!=''){
			cdata.cityid = s3
		}
		if(s1=='' && s2=='' && s3==''){
			cdata.cityid = 0 
		}

		$.ajax({
	      	'url':'/vrp/search',
	      	'type':'post',
	      	'dataType':'json',
	      	'data':cdata,
	      	'success':function(json){
	      		var li = ''
	      		$.each(json,function(i,v){
	      			li += '<li class="vr_home_list">\
								<div class="vr_content">\
									<a class="index_item_vrlogo" style="cursor: pointer;" target="_blank" onclick="increaseView(this,'+v.id+','+v.detail_url+')></a>\
									<span>'+v.title+'</span>\
									<img src="'+v.images[0].img_m+'" onload="rect(this)"/>\
								</div>\
								<div class="vr_title">\
									<span class="vr_home_loc">'+v.cityname+' '+v.countryname+'</span>\
									<span class="vr_like">'+v.praise_count+'</span>\
									<span class="vr_view">'+v.viewcount+'</span>\
								</div>\
							</li>'
				})
				$('#ul').html(li)
	      	}
	      })

	})
</script>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>