<form action="/api/cq/pub" method="post" enctype="multipart/form-data">
	
	token:<input type="text" name="access_token" value="2c153eccf0d73b1a1be54283c8a30b3b"></input><br>
	名称:<input type="text" name="title" value="名称"></input><br>
	描述:<input type="text" name="description" value="描述"></input><br>
	cityid:<input type="text" name="cityid" value="0"></input><br>
	原价:<input type="text" name="price" value="300"></input><br>
	现价:<input type="text" name="reserve_price" value="100"></input><br>
	来源:<input type="text" name="source" value="1"></input><br>
	联系方式:<input type="text" name="contact" value="1355698895"></input><br>
	分类:<input type="text" name="tags" value="分类1；分类2"></input><br>
	图片1:<input type="file" name="image[]"></input><br>
	图片2:<input type="file" name="image[]"></input><br>
	<input type="submit" value="上传"></input><br>
</form>
<p>发布</p>


<form action="/api/cq/edit" method="post" enctype="multipart/form-data">
	
	token:<input type="text" name="access_token" value="2c153eccf0d73b1a1be54283c8a30b3b"></input><br>
	名称:<input type="text" name="title" value="名称"></input><br>
	描述:<input type="text" name="description" value="描述"></input><br>
	cityid:<input type="text" name="cityid" value="0"></input><br>
	原价:<input type="text" name="price" value="300"></input><br>
	现价:<input type="text" name="reserve_price" value="100"></input><br>
	来源:<input type="text" name="source" value="1"></input><br>
	联系方式:<input type="text" name="contact" value="1355698895"></input><br>
	分类:<input type="text" name="tags" value="分类1；分类2"></input><br>
	商品id:<input type="text" name="good_id" value="1"></input><br>
	图片1:<input type="file" name="image[]"></input><br>
	图片2:<input type="file" name="image[]"></input><br>
	<input type="submit" value="上传"></input><br>
</form>

<p>修改</p>