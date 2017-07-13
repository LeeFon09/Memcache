<?php

	$arr = [1,2,3, 'a'=>'123'];

	//将数组变成字符串
	
	//serialize()序列化（串行化）
	$s_str = serialize($arr);

	echo $s_str,'<br/>';


	//反序列化
	$newArr = unserialize($s_str);

	var_dump($newArr);


	//不能直接将数组写到文件中，不能直接将数组写到数据库
	// file_put_contents('./Cache/1.txt', $arr);