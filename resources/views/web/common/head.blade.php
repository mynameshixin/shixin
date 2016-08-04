<head>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{$title or '堆图家，链接全球家居资源(家居、室内设计、商品、美图、VR)'}}</title>
	<meta name="keywords" content="堆图家,家居,室内设计,商品,美图,软装,建筑,装修,VR,设计,人物,数据{{$keywords or ''}}"/> 
	<meta name="description" content="堆图家,带你搜集你喜欢的家居,你可以用它搜集灵感图片,发布VR,保存素材,晒晒喜欢的家居"/>
	<link rel="shortcut icon" href="/logo.ico"> 
	<script type="text/javascript">
		(function(){
		    var bp = document.createElement('script');
		    var curProtocol = window.location.protocol.split(':')[0];
		    if (curProtocol === 'https') {
		        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
		    }
		    else {
		        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
		    }
		    var s = document.getElementsByTagName("script")[0];
		    s.parentNode.insertBefore(bp, s);
		})();
	</script>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/font-awesome.min.css">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="{{asset('public/web')}}/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
		user_id = "<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"
		u_id = "<?php if(!empty($_COOKIE['user_id'])) echo $_COOKIE['user_id']; ?>"
	</script>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/main.css">
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/index.css">
	<script type="text/javascript" src="{{asset('web')}}/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/jquery.lazyload.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/jquery.form.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/plugins/Masonry/masonry-docs.min.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/jquery.imagesloaded.js"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/jquery.wookmark.js"></script>
	<script type="text/javascript" src="{{asset('static/layer/layer.js')}}"></script>
	<script type="text/javascript" src="{{asset('web')}}/js/index.js"></script>
	
	<script type="text/javascript">
		function rect(obj){
			marginLeft = ($(obj).parent().width()-$(obj).width())/2
			marginTop = ($(obj).parent().height()-$(obj).height())/2
			$(obj).css({
				'margin-left':marginLeft,
				'margin-top':marginTop
			})
		}
		function layer_error(str){
			str = str!=''?str:'该功能仍在建设中'
			layer.msg(str, {icon: 5});
			return false;
		}
		
		function getObjectURL(file) {
			var url = null ; 
			if (window.createObjectURL!=undefined) { // basic
				url = window.createObjectURL(file) ;
			} else if (window.URL!=undefined) { // mozilla(firefox)
				url = window.URL.createObjectURL(file) ;
			} else if (window.webkitURL!=undefined) { // webkit or chrome
				url = window.webkitURL.createObjectURL(file) ;
			}
			return url ;
		}

	</script>
</head>