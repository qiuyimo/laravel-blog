---
title: redis 报错
description: redis 报错
keywords: redis 报错
create_time: 2017-04-08
tag: redis
category: 笔记
---

```bash
(error) MISCONF Redis is configured to save RDB snapshots, but is currently not able to persist on disk. Commands that may modify the data set are disabled. Please check Redis logs for details about the error.
```

```bash
127.0.0.1:6379> lpop detailUrl
(error) MISCONF Redis is configured to save RDB snapshots, but is currently not able to persist on disk. Commands that may modify the data set are disabled. Please check Redis logs for details about the error.
```

```bash
127.0.0.1:6379> config set stop-writes-on-bgsave-error no
OK
127.0.0.1:6379>
```


参考: 
http://www.jianshu.com/p/3aaf21dd34d6
http://blog.kankanan.com/posts/2012/12/16_89e351b34fdd5b585feb716759318d25540eredis65e06cd551995165768495ee9898.html


```bash
PHP Fatal error:  Uncaught exception 'RedisException' with message 'Connection lost' in /root/spider/redis.class.php:279
Stack trace:
#0 /root/spider/redis.class.php(279): Redis->lSize('detailUrl')
#1 /root/spider/spider.class.php(1202): RedisCluster->lSize('detailUrl')
#2 /root/spider/spider.class.php(1064): Facebook\WebDriver\spider->debug('\xE8\xBF\x9B\xE5\x85\xA5\xE8\xAF\xA6\xE7\xBB\x86\xE9\xA1\xB5...')
#3 /root/spider/spider.class.php(1044): Facebook\WebDriver\spider->detailPageAction()
#4 /root/spider/spider.class.php(287): Facebook\WebDriver\spider->pop()
#5 /root/spider/run.php(59): Facebook\WebDriver\spider->begin(Array, 'detail', '4444', false, '8082', false)
#6 {main}
  thrown in /root/spider/redis.class.php on line 279

```





