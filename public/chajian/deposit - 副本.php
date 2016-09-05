
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>插件</title>
		<link rel="stylesheet" type="text/css" href="http://www.duitujia.com/web/css/index.css">
		<style type="text/css">
			
	.autocomplete-container {
		position: relative;
		width: 190px;
		height: 32px;
		margin: 0 auto;
		display: inline-block;
	}

	.autocomplete-input {
		width: 218px;
	    height: 36px;
	    background: #f0f0f0;
	    border-radius: 3px;
	    border: none
	}

	.autocomplete-button {
		font-family: inherit;
		border: none;
		background-color: #990101;
		color: white;
		padding: 8px;
		float: left;
		cursor: pointer;
		border-radius: 0px 3px 3px 0px;
		transition: all 0.2s ease-out 0s;
		margin: 0.5px 0px 0px -1px;
	}

	.autocomplete-button:HOVER {
		background-color: #D11E1E;
	}
	#search_form_outer,#search_upload_outer{
		display: inline-block;
		position: absolute;
	    left: 40px;
	    top: 0;
	    z-index: 100
	}
	.proposal-box {
		position: absolute;
		height: auto;
		border-left: 1px solid rgba(0, 0, 0, 0.11);
		border-right: 1px solid rgba(0, 0, 0, 0.11);
		left: 0px;
	}

	.proposal-list {
		list-style: none;
		box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.44);
		-webkit-margin-before: 0em;
		-webkit-margin-after: 0em;
		-webkit-margin-start: 0px;
		-webkit-margin-end: 0px;
		-webkit-padding-start: 0px;
	}

	.proposal-list li {
		text-align: left;
		padding: 5px;
		font-size: 16px;
		border-bottom: 1px solid rgba(0, 0, 0, 0.16);
		height: 25px;
		line-height: 25px;
		background-color: rgba(255, 255, 255, 1);
		cursor: pointer;
	}

	li.proposal.selected {
		background-color: rgba(175, 175, 175, 1);
		color: white;
	}

	#search-box {
		position: relative;
		width: 400px;
		margin: 0 auto;
		display: inline;
	}

	#message {

	}
	</style>
	</head>
	<script>
	$(function() {
	$.ajax({         
             url: "http://la.com/webd/pics/cgoods",
             dataType: "jsonp",
             data:"user_id:"+GetQueryString("user_id"),
             jsonp:'callback', 
         	 type:'post',
             success: function(jsonp){
             	alert(1);
             }
         });
}
	</script>

	<body>
		<!--header内容-->
		<!--<div class="pop">
			<div class="img_upload">
				<div class="pic_show">
					<h1>图片展示</h1>
					<p>最多5张且每张大小不超过8M</p>
					<div class="pic_selected">
						<div class="items">
							<span class="hor"></span>
							<span class="ver"></span>
						</div>
						<div class="items">
							<img src= "8.png"/>
							<span class="delete">x</span>
							<span class="title">#简约#</span>
						</div>
						<div class="items">
							<img src= "8.png"/>
							<span class="delete">x</span>
							<span class="title">#简约#</span>
						</div>
						<div class="items">
							<img src= "8.png"/>
							<span class="delete">x</span>
							<span class="title">#简约#</span>
						</div>
						<div class="items">
							<img src= "8.png"/>
							<span class="delete">x</span>
							<span class="title">#简约#</span>
						</div>
						
					</div>
					
				</div>
				<div class="choose_file">
					
				</div>
			</div>
		</div>-->
		
		
		<!--这部分请使用官网的上传图片模块进行替换-->
		<div class="pop_collect p_collect" style="display: inline" img_id="" id="upload_outer">
	<form action="" method="post" enctype="multipart/form-data" name="allimg">
		<div class="pop_con" style="top:0">
			<div class="pop_col_left" style="height: 460px">
				<div class="pop_col_ltop clearfix">
					<div class="pop_namewrap clearfix" style="padding:0px 0px 0px 30px;">
			        <span class="pop_labelname" style="font-size:14px;line-height:42px;width:100%;">图片展示<br>最多5张且每张大小不超过8M</span>
			        <div class="pop_addpic_con clearfix" style="float:left">
			            <div class="pop_addpic_wrap" style="position:relative;float:left;">
			              <img src="pop_upload_multi.png" alt="堆图家" class="show">
			              <input type="file" name="image[]" multiple="true">
			            </div>
			           <div class="pop_addpic_wrap"> <span class="close_img_btn">×</span> <img src="blob:http://www.duitujia.com/6232269f-140e-48ca-a72a-2ca90faf713d" alt=""> <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]">3</textarea> </div>
<div class="pop_addpic_wrap"> <span class="close_img_btn">×</span> <img src="blob:http://www.duitujia.com/6232269f-140e-48ca-a72a-2ca90faf713d" alt=""> <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]">3</textarea> </div>
<div class="pop_addpic_wrap"> <span class="close_img_btn">×</span> <img src="blob:http://www.duitujia.com/6232269f-140e-48ca-a72a-2ca90faf713d" alt=""> <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]">3</textarea> </div>
<div class="pop_addpic_wrap"> <span class="close_img_btn">×</span> <img src="blob:http://www.duitujia.com/6232269f-140e-48ca-a72a-2ca90faf713d" alt=""> <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]">3</textarea> </div>
<div class="pop_addpic_wrap"> <span class="close_img_btn">×</span> <img src="blob:http://www.duitujia.com/6232269f-140e-48ca-a72a-2ca90faf713d" alt=""> <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]">3</textarea>                              </div>
			        </div>
			      </div>
				</div>
				<input type="hidden" name="user_id" value="515563c604f3a66837b9f700b55f6668_eyJpdiI6ImxZaFpzRlwvWkVvRnBKQzNwV1cxY1lRPT0iLCJ2YWx1ZSI6Im1ualE3aGZKK014WlVPQlZZMDdKc1E9PSIsIm1hYyI6IjU2MDA0NDM0MWJmYzZhYzY4MTcxNTcwNWEzNmNkYTQ1NjIxYWJlNDEzMTA4YWFlZWRjMTExNTk0ODcwOGQzZjEifQ==">
				<input type="hidden" name="kind" value="2">
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close" onclick="$('#upload_outer').hide()"></span>
					 
					<div class="pop_col_sinput_wrap" style="margin-top: 20px">
						<a href="javascript:;" class="pop_col_sinputbtn" title="堆图家搜索"></a>
						<input class="pop_col_sinput" placeholder="搜索">
						<div id="search_upload_outer"></div>
					</div>
					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
						</div>
						<ul class="pop_col_colum" id="search_upload">
							
						</ul>
						<p class="pop_col_new">最新保存到</p>
						<ul class="pop_col_colum pop_col_colum_new">
							
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all">
							
							
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew" id="show_folder_add" title="新建文件夹并上传">+</a>
					<p class="pop_add_addfont">新建文件夹并上传</p>
				</div>
			</div>
		</div>
	</form>
	</div>
	<div class="sunccess" style="display: none">
		<div class="smile"><img src="sucess.png"/></div>
		<div class="sunccess_txt">
			成功采集到！<br /><span><b>椅子</b>文件夹</span>
		</div>
	</div>

	<script type="text/javascript">
	
			
			// //模拟采集成功效果
			// $('.pop_close').click(function(){
			// 	$('.sunccess').show();
			//   	$('.sunccess').fadeOut(5000);
			// })
			
	
	</script>
	</body>

</html>