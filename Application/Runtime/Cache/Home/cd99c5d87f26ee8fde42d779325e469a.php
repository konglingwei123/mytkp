<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
	<head>
		<title>reg模板</title>
		<meta charset="utf-8">
	</head>
	<body>
		reg模板成功访问<br/>
		<?php echo ($tttt); ?><br/>
		<?php echo ($arr["0"]); ?>---<?php echo ($arr[1]); ?><br/>
		<?php echo ($arr1["11"]); ?>---<?php echo ($arr1[22]); ?><br/><br/><br/>
		<table border="1" bordercolor="blue" width="100%" cellspacing="0">
			<tr style="background-color:pink;">
				<td>编号</td>
				<td>姓名</td>
				<td>班级类型</td>
				<td>状态</td>
				<td>创建时间</td>
				<td>开始时间</td>
				<td>结束时间</td>
				<td>班主任</td>
				<td>项目经理</td>
				<td>人数</td>
				<td>备注</td>
			</tr>
			<!--<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "$msg" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?>//volist循环
				第<?php echo ($i); ?>次循环--索引为<?php echo ($key); ?>
				<?php if(($mod) == "0"): ?><tr style="background-color:green;">
						<td><?php echo ($class["cid"]); ?></td>
						<td><?php echo ($class["name"]); ?></td>
						<td><?php echo ($class["classtype"]); ?></td>
						<td><?php echo ($class["status"]); ?></td>
						<td><?php echo ($class["createtime"]); ?></td>
						<td><?php echo ($class["begintime"]); ?></td>
						<td><?php echo ($class["endtime"]); ?></td>
						<td><?php echo ($class["headerid"]); ?></td>
						<td><?php echo ($class["managerid"]); ?></td>
						<td><?php echo ($class["stucount"]); ?></td>
						<td><?php echo ($class["remark"]); ?></td>
					</tr><?php endif; endforeach; endif; else: echo "$msg" ;endif; ?>-->
			<!--  //foreach循环 -->
			<?php if(is_array($data)): foreach($data as $i=>$class): ?>第<?php echo ($i); ?>次循环--索引为<?php echo ($key); ?>
				<?php if(($i%2) == "0"): ?><tr style="background-color:orange;">
						<td><?php echo ($class["cid"]); ?></td>
						<td><?php echo ($class["name"]); ?></td>
						<td>
							<?php if($class["classtype"] == 1): ?>常规班
							<?php elseif($class["classtype"] == 2): ?>快速班
							<?php elseif($class["classtype"] == 3): ?>flash班
							<?php else: ?>PHP班<?php endif; ?>
						</td>
						<td><?php echo ($class["status"]); ?></td>
						<td><?php echo ($class["createtime"]); ?></td>
						<td><?php echo ($class["begintime"]); ?></td>
						<td><?php echo ($class["endtime"]); ?></td>
						<td><?php echo ($class["headerid"]); ?></td>
						<td><?php echo ($class["managerid"]); ?></td>
						<td><?php echo ($class["stucount"]); ?></td>
						<td><?php echo ($class["remark"]); ?></td>
					</tr><?php endif; endforeach; endif; ?> 
			<!-- 
			<?php $__FOR_START_22105__=0;$__FOR_END_22105__=$arrayLength;for($i=$__FOR_START_22105__;$i < $__FOR_END_22105__;$i+=1){ if(($i%2) == "0"): ?><tr style="background-color:violet;">
						<td><?php echo ($data["$i"]["cid"]); ?></td>
						<td><?php echo ($data["$i"]["name"]); ?></td>
						<td><?php echo ($data["$i"]["classtype"]); ?></td>
						<td><?php echo ($data["$i"]["status"]); ?></td>
						<td><?php echo ($data["$i"]["createtime"]); ?></td>
						<td><?php echo ($data["$i"]["begintime"]); ?></td>
						<td><?php echo ($data["$i"]["endtime"]); ?></td>
						<td><?php echo ($data["$i"]["headerid"]); ?></td>
						<td><?php echo ($data["$i"]["managerid"]); ?></td>
						<td><?php echo ($data["$i"]["stucount"]); ?></td>
						<td><?php echo ($data["$i"]["remark"]); ?></td>
					</tr><?php endif; } ?> -->
			
		</table>
		
		<!--  <?php switch($i): case "1": ?>你<?php break;?>
			<?php case "1": ?>我<?php break;?>
			<?php case "1": ?>他<?php break; endswitch;?> -->
		
		<!-- if else语句  <?php if($j < 4): ?>内容1 
        <?php else: ?>
              	来来来来<?php endif; ?> -->
        
        
        
	</body>
</html>