<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
		@include('web.common.head')	
		
	<link rel="stylesheet" type="text/css" href="{{asset('web')}}/css/news/index.css">
</head>
<body>
@include('web.common.banner')
<div class="container">
		 <div id="main">

	        <div id="index_b_hero">

	            <div class="hero-wrap">

	                <ul class="heros clearfix">


	                @for($i=0;$i < $where['int'];$i++)
	                    <li class="hero" >

	                        <a href="/Article/article/<?php echo $where[$i]['eassat_id']?>" >
	                            <img src="<?php echo $where[$i]['eassat_timg']?>" class="thumb" />
	                        </a>
	                    </li>
	                @endfor
	                </ul>
	            </div>
	            <div class="helper">
	                <a class="prev icon-arrow-a-left"></a>
	                <a class="next icon-arrow-a-right"></a>
	            </div>

	        </div>

    	</div>

    <div class="w1248 w1240 clearfix">
	    	<div class="modules clearfix">
	    		<div class="rows">
	    			<a href="/Article/search/1"></a>
	    			<img src="/web/images/家具知识.png"/>
	    		
	    		</div>
	    		<div class="rows">
	    			<a href="/Article/search/32"></a>
	    			<img src="/web/images/品牌故事.png"/>
	    		
	    		</div>
	    		<div class="rows">
	    			<a href="/Article/search/15"></a>
	    			<img src="/web/images/设计师.png"/>
	    		
	    		</div>
	    		<a href="/Article/search/42">
	    		<div class="rows">
	    			<a href="/Article/search/42"></a>
	    			<img  src="/web/images/问答社区.png"/>
	    		
	    		</div>
	    		</a>
	    	</div>
	    	
	    <div class="item clearfix">
	    		<div class="rows">
	    		<a href="/Article/search/56">
	    			<img src="/web/images/fg.png"/>
	    			<p>风格</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/75">
	    			<img src="/web/images/kj.png"/>
	    			<p>空间</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/85">
	    			<img src="/web/images/jb.png"/>
	    			<p>局部</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/93">
	    			<img src="/web/images/yz.png"/>
	    			<p>硬装</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/98">
	    			<img src="/web/images/rz.png"/>
	    			<p>软装</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/107">
	    			<img src="/web/images/ds.png"/>
	    			<p>灯饰</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/113">
	    			<img src="/web/images/bj.png"/>
	    			<p>摆件</p>
	    		</a>
	    		</div>
	    		<div class="rows">
	    		<a href="/Article/search/122">
	    			<img src="/web/images/ps.png"/>
	    			<p>色系</p>
	    		</a>
	    		</div>
	    </div>
	    	<div class="pic-list-title">
	    		最新图文
	    	</div>
	    	<div class="pic-list clearfix">

	    	@for($i=0;$i<$index['int'];$i++)
	    		<div class="rows">
	    		<a href="/Article/article/<?php echo $index[$i]['eassat_id']?>">
	    			<img style="width:390px;height:247px;" src="<?php echo $index[$i]['eassat_ximg']?>"/>
	    			<p class="row-info">
	    				<span class="title"><?php echo $index[$i]['eassat_title']?></span>
	    				<span class="time"><?php echo $index[$i]['eassat_date']?></span>
	    			</p>
	    		</a>
	    		</div>
	    	@endfor
	    	</div>
    </div>
</div>
</body>
</html>
