<?php


	/*
	缓存步骤：

	php先查询缓存中有无数据，如无则查数据库，查完放缓存，后给php。

	缓存如有，则直接返回给php

	 */
	

	$sql = 'select id,gname,descp,price,num,store,pic from shop_goods limit 100';

	//只要SQL语句一样，md5生成的文件名是一样
	$fileName = md5($sql);

	// //读取文件中是否有数据
	$contents = @file_get_contents('./Cache/'.$fileName);

	$goodsData = json_decode( $contents, true);

	if (!$contents) {

		//能够进来的，说明是缓存中没有数据，没有数据则查询数据库
		
		$dsn = 'mysql:host=127.0.0.1;dbname=lamp27;charset=utf8';

		$pdo = new PDO($dsn, 'root', '123456');

		echo '又来查询数据库。不好哦<br/>';
		sleep(2);

		//发送SQL模板给数据库
		$stmtObj = $pdo->prepare($sql);


		//执行SQL语句
		$stmtObj->execute();


		//拿到商品数据
		$goodsData = $stmtObj->fetchAll(2);


		//先把数组变成字符串
		$tmp = json_encode($goodsData);

		//将从数据库得到数据放到缓存中
		file_put_contents('./Cache/'.$fileName, $tmp);

		// echo '<pre>';

		// print_r($goodsData);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>列表</title>
</head>
<body>
	
	<table>
		<!-- id,gname,descp,price,num,store,pic -->
		<tr>
			<th>序号</th>
			<th>商品名</th>
			<th>描述</th>
			<th>价格</th>
			<th>数量</th>
			<th>库存</th>
			<th>图片</th>
		</tr>

		<?php foreach($goodsData as $v):?>
			<tr>
				
				<td><?php echo $v['id']?></td>
				<td><?php echo $v['gname']?></td>
				<td><?php echo $v['descp']?></td>
				<td><?php echo $v['price']?></td>
				<td><?php echo $v['num']?></td>
				<td><?php echo $v['store']?></td>
				<td><?php echo $v['pic']?></td>
			</tr>

		<?php endforeach;?>
	</table>
	
</body>
</html>
