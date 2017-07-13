<?php

	
	//先查询缓存中有无数据，有则返回给php,没有数据则查询数据库，然后缓存，最后返回给php

	$m = new Memcache;

	$m->addServer('192.168.35.253', 11211);

	$sql = 'select id,gname,descp,price,num,store,pic from shop_goods limit 100';

	$key = md5($sql);

	//这个数据需要从数据库得到，建议在后台做一个缓存模块。这个模块可以管理数据缓存时间
	$expire = 10;

	$goodsData = $m->get($key);

	if (!$goodsData) {

		//查询数据库
				
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

		//缓存数据
		$m->set($key, $goodsData, 2, $expire);//expire有效期

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