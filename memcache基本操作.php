<?php

	//1. 实例化memcache类
	$m = new Memcache;//只有安装了memcache扩展才可以使用，否则报错


	//2. 连接到Memcache服务器
	$m->connect('127.0.0.1', 11211);


	// echo MEMCACHE_COMPRESSED;//2
	//将数据存放到memcache中
	// $m->set('lamp27', 'good good study,day day up', MEMCACHE_COMPRESSED, 100);
	

	//从memcache中取出某个键值
	// echo $m->get('lamp27');
	

	//memcache不能存放数组，只不过memcache会自动序列化
	// $m->set('lamp', array(1,3,'a'), 2, 0);
	

	//get()方法会自动反序列化
	$arr  = $m->get('lamp'); 

	print_r($arr);





