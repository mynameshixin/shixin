<head>
	<meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{$title}}</title>
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/font-awesome.min.css">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="{{asset('public/web')}}/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/main.css">
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/index.css">
	<script type="text/javascript" src="{{asset('web')}}/js/jquery-1.11.3.min.js"></script>
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

		function current_show(obj){
			$('body').addClass('overhidden')
			/*var state = {
				title:'',
				url:'http://la.com/webd/pic/'+$(obj).attr('img_id')
			};*/
			var state = {
				title:'',
				url:'1.html'
			};
			console.log(state)
			window.history.pushState(state,document.title,state.url);
		}


	</script>
</head>