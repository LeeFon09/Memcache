## memcache扩展安装

* 安装libevent

		tar -zxvf libevent-2.1.8-stable.tar.gz 

		cd /lamp/libevent-2.1.8-stable

		./configure  --prefix=/usr/local/libevent

		make

		make install
	

* 安装memcache扩展（https://github.com/websupport-sk/pecl-memcache）

		cd /lamp/pecl-memcache-NON_BLOCKING_IO_php7/

		//生成configure文件
		/usr/local/php/bin/phpize

		//以后安装php的扩展，都是一下这条命令来检查环境的
		./configure --with-php-config=/usr/local/php/bin/php-config

		make
		
		make install

		vim /usr/local/php/etc/php.ini 
		
			//在php.ini加入
			extension="memcache.so";
			
		/usr/local/apache2/bin/apachectl restart


		//检查一下memcache扩展是否开启
		# php -m  

		