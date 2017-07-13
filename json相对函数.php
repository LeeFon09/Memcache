<?php


	$arr = [1,2,3, 'a'=>'123'];

/*	//将数组变成字符串
	
	//serialize()序列化（串行化）
	$s_str = serialize($arr);

	echo $s_str,'<br/>',strlen($s_str);*/

	$json_str = json_encode($arr);

	// echo $json_str,strlen($json_str);
	
	//将json_encode()后结果变回去
	$res = json_decode($json_str, true);//当给json_decode()传递第二个参数，则返回数组，不给就是对象

	var_dump($res);
