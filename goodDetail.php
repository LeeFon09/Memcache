<?php

	//接收到用户通过GET方式传递过来的商品ID
	
	$gid = @intval($_GET['gid']);


	if ( $gid <=0 ) {

		echo '去到首页';
		exit;
	}



	$sql = "select id,gname,price,store,pic from shop_goods where id = $gid limit 1";

	$key = md5($sql);

	$m = new Memcache;
	$m->addServer('192.168.35.253', 11211);

	$goodsData = $m->get($key);

	if (!$goodsData) {

		echo '查询数据库了','<br/>';
		//查询数据库
		$dsn = 'mysql:host=127.0.0.1;dbname=lamp27;charset=utf8';

		$pdo = new PDO($dsn, 'root', '123456');

		$sql = "select clicknum,num,id,gname,price,store,pic from shop_goods where id = ? limit 1";

		//发送SQL模板给数据库
		$stmtObj = $pdo->prepare($sql);

		//执行SQL语句
		$stmtObj->execute( array($gid) );

		//拿到商品数据
		$goodsData = $stmtObj->fetch(2);


		// echo '<pre>';

		// print_r($goodsData);exit;

		//只能将热销商品、首页商品放到缓存中

		if ( $goodsData['clicknum'] > 200 || $goodsData['num'] > 200 ) {

			$m->set($key, $goodsData, 2, 10);
		}


	}

	

	// var_dump($goodsData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo  $goodsData['gname']?></title>
</head>
<body>
	
	<div>
		<img width="500" src="./upload/<?php echo $goodsData['pic']?>" alt="">
		<br>

		商品名：<span><?php echo  $goodsData['gname']?></span><br/>
		价格：<span><?php echo  $goodsData['price']?></span><br/>
		库存：<span><?php echo  $goodsData['store']?></span>
		<br>
		<a href="" style="display: inline-block;width: 100px;height: 100px;border-radius: 10px;background: red;line-height: 100px;text-align:center">购买</a>
	</div>
</body>
</html>
