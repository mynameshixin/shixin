@include('web.common.vr.head',['k1'=>'梦幻家——VR展示住宅空间','k2'=>'身临其境的看房体验','k3'=>''])
<style type="text/css">
	.form-inline .form-group {display: inline-block;margin-bottom: 0;}
	.sr-only{position: absolute;width: 1px;height: 1px;padding: 0;margin: -1px;overflow: hidden;clip: rect(0,0,0,0);border: 0;}
	.form-inline .form-control{    display: inline-block;width: auto;vertical-align: middle;}
	.form-control{height: 34px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;}
    option {
    font-weight: normal;
    display: block;
    white-space: pre;
    min-height: 1.2em;
    padding: 0px 2px 1px;
}
</style>
	<div class="w1248 w1240">
			
			<div class="vr_line">
				<div class="vr-left"><span>位&nbsp;&nbsp;&nbsp;&nbsp;置</span></div>

				<form class="form-inline">
			      <div id="distpicker2">
			        <div class="form-group">
			          <label class="sr-only" for="province5">Province</label>
			          <select class="form-control" id="province5"></select>
			        </div>
			        <div class="form-group">
			          <label class="sr-only" for="city5">City</label>
			          <select class="form-control" id="city5"></select>
			        </div>
			        <div class="form-group">
			          <label class="sr-only" for="district5">District</label>
			          <select class="form-control" id="district5"></select>
			        </div>
			         <!-- <input type="hidden" name="alias" value="{{$alias}}"></input>
			         <input type="hidden" name="keyword" value="{{$keyword}}"></input>
			         <input type="submit" value="筛选" class="btn"> -->
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
				<div class="w990 clearfix" ng-controller="myCtrl">
					<ul class="clearfix" id="ul" >

						<li class="vr_home_list" ng-repeat="v in sites">
							<div class="vr_content">
								<a class="index_item_vrlogo" href="{%v.detail_url%}" target="_blank"></a>
								<span>{%v.title%}</span>
								<img src="{%v.images[0].img_m%}" onload="rect(this)"/>
							</div>
							<div class="vr_title">
								<span class="vr_home_loc">{%v.cityname%} {%v.countryname%}</span>
								<span class="vr_like">{%v.praise_count%}</span>
								<span class="vr_view">{%v.viewcount%}</span>
							</div>
						</li>

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
									<a class="index_item_vrlogo" href="'+v.detail_url+'" target="_blank"></a>\
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
									<a class="index_item_vrlogo" href="'+v.detail_url+'" target="_blank"></a>\
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

	$('.form-control').change(function(){
		cdata.page = 1
		var s1 = $('.form-control').eq(0).find('option:selected').attr('data-code')
		var s2 = $('.form-control').eq(1).find('option:selected').attr('data-code')
		var s3 = $('.form-control').eq(2).find('option:selected').attr('data-code')
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
									<a class="index_item_vrlogo" href="'+v.detail_url+'" target="_blank"></a>\
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
<script type="text/javascript">
	

	myApp.controller('dev',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/dev',
		  }).success(function(json, status) {
		  	$scope.dev = json.data.list
		  })
	})

	myApp.controller('huxing',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/huxing',
		  }).success(function(json, status) {
		  	$scope.huxing = json.data.list
		  })
	})

	myApp.controller('type',function($scope,$http){
		$http({
		    method: 'post',
		    url: '/api/vr/type',
		  }).success(function(json, status) {
		  	$scope.type = json.data.list
		  })
	})

	myApp.controller('btype',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/brandtype',
		  }).success(function(json, status) {
		  	$scope.btype = json.data.list
		  })
	})

	myApp.controller('sale',function($scope,$http){
		$http({
		    method: 'get',
		    url: '/api/vr/sales',
		  }).success(function(json, status) {
		  	$scope.sale = json.data.list
		  })
	})

 	myApp.controller('myCtrl', function($scope,$http) {
	  	$scope.sites = <?php echo json_encode($needData); ?>
	});


</script>
<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
</html>