 <table border="1" style="border-collapse:collapse;">
 	<tr height="30">
 		<td>空间类型</td>
 		<td>空间数</td>
 		<td>空间面积</td>
 		<td>联系人</td>
 		<td>联系方式</td>
 		<td>其他补充</td>
 		<td>预约时间</td>
 	</tr>
 	<?php foreach ($all as $key => $value) {?>
 	<tr height="30">
 		<td><?php if($value['type']==1) echo '实体门店';if($value['type']==2) echo '住宅空间';?></td>
 		<td>{{$value['num']}}</td>
 		<td>{{$value['area']}}</td>
 		<td>{{$value['name']}}</td>
 		<td>{{$value['mobile']}}</td>
 		<td>{{$value['other']}}</td>
 		<td>{{$value['create_at']}}</td>
 	</tr>
 	<?php } ?>
 </table>