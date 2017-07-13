<?php

	//搭建一个memcache分布式缓存系统
	

	/*
	  分布式缓存系统好处：

	  	1. 避免单点故障
	  	2. 可以使用内存变大
	  	3. 降低事故几率


	 */

	// 192.168.35.121
	// 192.168.35.213
	// 192.168.35.179
	// 192.168.35.253
	
	$memcache  = new  Memcache;
	$memcache->addServer ( '192.168.35.121' ,  11211 );
	$memcache->addServer ( '192.168.35.213' ,  11211 );
	$memcache->addServer ( '192.168.35.179' ,  11211 );
	$memcache->addServer ( '192.168.35.253' ,  11211 );


/*	for ($i=0; $i<10; $i++) {

		$memcache->set('key'.$i, 'val'.$i, 2, 0);
	}*/


	for ($i=0; $i<10; $i++) {

		$list[] = $memcache->get('key'.$i);
	}

	echo '<pre>';

	print_r($list);


