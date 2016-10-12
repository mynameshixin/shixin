
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>插件</title>
		<script type="text/javascript">
		var u_id="<?php echo $_POST['user_id'];?>";
		var user_id=u_id;
		</script>
		<link rel="stylesheet" type="text/css" href="http://www.duitujia.com/web/css/index.css">
		<link rel="stylesheet" type="text/css" href="http://www.duitujia.com/web/css/main.css">
		<script type="text/javascript" src="http://www.duitujia.com/web/js/jquery-1.11.3.min.js"></script>
		
		<script type="text/javascript" src="http://www.duitujia.com/static/layer/layer.js"></script>
		<script type="text/javascript" src="http://www.duitujia.com/web/js/jquery.form.js"></script>
		
	

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
	.sou_suo{	
		width: 200px;
		margin: 0 0 0 50px;
		position: absolute;
		background-color: #fff;
		z-index: 99999;
	}
	</style>
	</head>


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
<!-- 上传图片 -->
	<div class="pop_collect p_collect" style="display: inline" img_id="" id="upload_outer">
	<form action="" method="post" enctype="multipart/form-data" name="allimg">
		<div class="pop_con" style="top:0">
			<div class="pop_col_left" style="height: 400px">
				<div class="pop_col_ltop clearfix">
					<div class="pop_namewrap clearfix" style="padding:0px 0px 0px 30px;">
			        <span class="pop_labelname" style="font-size:14px;line-height:42px;width:100%;">图片展示</span>
			      <!--   <div class="pop_addpic_con clearfix" style="float:left ">	
			            <div class="pop_addpic_wrap" style="position:relative;float:left;">
			              <img src="http://www.duitujia.com/web/images/pop_upload_multi.png" alt="堆图家" class="show" />
			              <input type="file" name="image[]" multiple="true"/>
			            </div>
			        </div> -->
					<?php					
						$src=explode(',',$_POST['src']); 	
						$alt=explode(',',$_POST['alt']); 
						$texts=explode(',',$_POST['text']); 				
						foreach ($src as $k => $v) {
							if(end(array_keys($src))==$k){ 
           					 break;
     						 }
												?>
					<div class="pop_addpic_con clearfix" style="float:left ">	
					<div class="pop_addpic_wrap oppo">	
					 <img src="<?=$v?>" class="imge_eea"  alt="<?=$alt[$k]?>">		
					
					<textarea class="pop_addfont_wrap texts" name="pop_addfont_wrap[]"><?=$texts[$k]?></textarea>
					  </div>
					   </div>
							<?php
							
						}

					?>
					



			      </div>
				</div>
				<input type="hidden" name="user_id" value="95393134da1585163a7ff5abe750b0b3_eyJpdiI6ImRxMU1MVE5MMVN6SW1keGNtOUxic2c9PSIsInZhbHVlIjoiXC80VjU2MVgzT0JkM1d4cXNWSlltcnc9PSIsIm1hYyI6IjlmOGQ3ZDlmYjZhYjkwYjgyYjkwNjkwMzI0MGY4MjMxMDJlZDgwM2IzMmRiYzcwODBkZDU2NjUwM2E5YjRjNjkifQ=="/>
				<input type="hidden" name="kind" value="2"/>
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					选择文件夹
					<span class="pop_close" onclick="$('#upload_outer').hide()"></span>
					 
					<div class="pop_col_sinput_wrap" style="margin-top: 20px">
						<a href="javascript:;" class="pop_col_sinputbtn" title='堆图家搜索'></a>
						<input  class="pop_col_sinput" onfocus="hanshu(this)" onblur="qk(this)" placeholder="搜索">
						<input type="text" style="display:none">
						<div id="search_upload_outer"></div>
						<div class="sou_suo" id="sou_suo">
							<!-- <tr><th>name</th><th>idn</th></tr>  -->
						</div>
						
					</div>



					
				</div>
				<div class="">
					<div class="pop_col_colum_wrap">
						<div class="pop_col_alphabet">
						</div>
						<ul class="pop_col_colum" id="search_upload">
							
						</ul>
						<p class="pop_col_new">最新保存到</p>
						<ul class="pop_col_colum pop_col_colum_new" id="pop_cg">
							
						</ul>
						<p class="pop_col_new">所有文件夹</p>
						<ul class="pop_col_colum pop_col_colum_all" id="pop_coolo">
						
						</ul>
					</div>
					
				</div>
				<div class="pop_add_foldbtn clearfix">
					<a href="javascript:;" class="pop_add_addnew" id="show_folder_add" title="新建文件夹并上传" >+</a>
					<p class="pop_add_addfont">新建文件夹并上传</p>
				</div>
			</div>
		</div>
	</form>
	</div>

	<!-- 上传图片时新建文件夹 -->
	<div class="pop_collect p_folder" style="display:none" id="pic_folder_outer">
		<div class="pop_con" style="top:0">
			<div class="pop_col_left" style="height: 470px">
				<div class="pop_col_ltop clearfix">
					<!-- <img src="http://www.duitujia.com/uploads/sundry/wlogo.jpg"  width="668" alt="堆图家"> -->
				</div>			
			</div>
			<div class="pop_col_right">
				<div class="pop_col_tit">
					创建文件夹
					<span class="pop_close" onclick="$('#pic_folder_outer').hide()"></span>
				</div>
				<div class="pop_col_infowrap">
					<div class="pop_col_name">
						<p class="pop_col_nlabel">名称</p>
						<input class="pop_col_ninput" placeholder="例如：欧式低奢亮色系风格" name="fname" value="">
					</div>
					<div class="pop_col_name">
						<p class="pop_col_nlabel">描述</p>
						<textarea class="pop_col_narea" placeholder="例如：欧式低奢亮色系风格"></textarea>
					</div>
					<div class="pop_col_priv">
						<p class="pop_col_nlabel">隐私</p>
						<input class="pop_iptprivacy" type="checkbox" id="pop_iptpr_o" name="private" private="0">
						<label for="pop_iptpr_o"></label>
					</div>
				</div>
				<div class="pop_btnwrap">
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_fileball detail_pop_cancel" onclick="$('#pic_folder_outer').hide()" title="堆图家取消">取消</a>
					<a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding" style="float:right;" id="pic_cfolder" title="堆图家创建">创建</a>
				</div>
			</div>
		</div>
	</div>

<!-- <script type="text/javascript" src="http://www.duitujia.com/web/js/backupjs.js"></script> -->

	</body>
	<script type="text/javascript" src="http://www.duitujia.com/chajian/upload.js"></script>
	<script type="text/javascript">	 	
			  		$.ajax({
			  			 url: "http://www.duitujia.com/webd/pics/cgoods",
			             dataType: "jsonp",
			             data:{"user_id":user_id},
			             jsonp:'callback', 
			         	 type:'get',
			         	 success: function(jsonp){			        		        
			         	 	// alert(jsonp.folder[0);			         	 
			         	 	for (var i = 0; i < jsonp.folder.length; i++) {								
								document.getElementById('pop_coolo').innerHTML+='<li class="pop_col_colum_on clearfix" folder_id="'+jsonp.folder[i].id+'" style="cursor:pointer; height:30px;" onclick="allimg_upload(this)"><div class="pop_col_colava"><img src="'+jsonp.folder[i].image_url+'" alt=""></div><div class="pop_col_colname">'+jsonp.folder[i].name+'</div><a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn ">上传</a></li>';
			         	 	 };	

			         	 	for (var i = 0; i < jsonp.cg.length; i++) {								
								document.getElementById('pop_cg').innerHTML+='<li class="pop_col_colum_on clearfix" folder_id="'+jsonp.cg[i].id+'" style="cursor:pointer; height:30px;" onclick="allimg_upload(this)"><div class="pop_col_colava"><img src="'+jsonp.cg[i].image_url+'" alt=""></div><div class="pop_col_colname">'+jsonp.cg[i].name+'</div><a href="javascript:;" class="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn ">上传</a></li>';
			         	 	 };			        	         	 	         	   
			         	 }


			  		});
			
			function hanshu(ele){

				//if(ele.keyCode==13){ // enter 键
                 
           	
				var val=ele.value								
				ele.onkeyup=function(){
				var es=$(".pop_col_sinput")[0].value;
				$.ajax({
				 url: "http://www.duitujia.com/webd/pics/cgoods",
					dataType: "jsonp",
					data:{"user_id":user_id},
					jsonp:'callback', 	
					type:'get',
					success: function(jsonp){
					document.getElementById('sou_suo').innerHTML = '';	   
					jQuery(function($){
               	 	var tab = $("#sou_suo");
                	$(jsonp.folder).each(function(i,dom){   
                	var tr = $("<tr>");                             
                   alert(dom.folder);
                         tr.append("<td style='cursor:pointer; height:30px;' class='pop_col_colum_on clearfix' onclick='allimg_upload(this)' folder_id="+dom.id+">"+"<div>" + dom.name +"</div>"+"</td>"); 
                     
                    tab.append(tr);
                });	
            });

					
					var tab = $("#sou_suo");  
					 var me =$(".pop_col_sinput")[0] , v =$(".pop_col_sinput")[0].value.replace(/^\s+|\s+$/g,"");
                  	 var trs = tab.find("tr:gt(0)");

           		     if(v==""){   
						 document.getElementById('sou_suo').innerHTML = '';	 
						
						}else{
							trs.hide().filter(":contains('"+es+"')").show();	
						}
				}
				});
				}
				}	
						
				function qk(ele){
				//document.getElementById('sou_suo').innerHTML = '';	 
				}		
				

				 // jQuery(function($){
     //            var tab = $("#tab"), txt = $("#txt");
     //            $(data.rows).each(function(i,dom){
     //                var tr = $("<tr>");
     //                for(var k in dom){
     //                    tr.append("<td>" + dom[k] + "</td>"); 
     //                }
     //                tab.append(tr);
     //            });
     //            txt.keyup(function(){
     //                var me = $(this), v = me.val().replace(/^\s+|\s+$/g,"");
     //                var trs = tab.find("tr:gt(0)");
     //                if(v==""){
     //                    trs.filter(":hidden").show();
     //                }else{
     //                    trs.hide().filter(":contains('"+me.val()+"')").show();
     //                }
     //            });
     //        });
		</script>

</html>
<!-- <div class="pop_addpic_wrap">  
<span class="close_img_btn">×</span> 
<img src="blob:http://www.duitujia.com/c8f31fc4-86d8-4b83-bb58-a50cc3f7608f" alt="">  
 <textarea class="pop_addfont_wrap" name="pop_addfont_wrap[]">secondarytile</textarea>  
   </div> -->
<!-- 
   <a href="javascript:;" c
   lass="pop_buildbtn detail_filebtn detail_filebtn_cpadding pop_col_cbtn ">上传</a> -->