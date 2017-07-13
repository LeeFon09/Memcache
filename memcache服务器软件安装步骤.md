## memcache服务器软件安装

> 前提是安装好libevent


	tar -zxvf memcached-1.4.17.tar.gz 
	
	cd /lamp/memcached-1.4.17

	./configure --prefix=/usr/local/memcache --with-libevent=/usr/local/libevent/


	make && make install

	useradd memcache

	/usr/local/memcache/bin/memcached -umemcache & 

	vi /etc/rc.d/rc.local

		//加入自启动
		/usr/local/memcache/bin/memcached -umemcache & 