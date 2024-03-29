---
title: Redis的高级实用特性——发布及订阅消息
description: Redis的高级实用特性——发布及订阅消息
keywords: Redis
create_time: 2017-08-05
tag: Redis
category: 笔记
---

**发布订阅(pub/sub)**是一种消息通信模式，主要的目的是解耦消息发布者和消息订阅者之间的耦合，这点和设计模式中的观察者模式比较相似。

pub/sub不仅仅解决发布者和订阅者直接代码级别耦合也解决两者在物理部署上的耦合。

Redis作为一个pub/sub的server，在订阅者和发布者之间起到了消息路由的功能。

订阅者可以通过subscribe和psubscribe命令向redis server订阅自己感兴趣的消息类型，redis将消息类型称为通道(channel)。

当发布者通过publish命令向redis server发送特定类型的消息时。

订阅该消息类型的全部client都会收到此消息。这里消息的传递是多对多的。

一个client可以订阅多个channel,也可以向多个channel发送消息。

文章来源: http://blog.csdn.net/jiao_fuyou/article/details/17260743

下面做个实验。这里使用3不同的client, client1用于订阅tv1这个channel的消息，client2用于订阅tv1和tv2这2个chanel的消息，client3用于发布tv1和tv2的消息。


![](/images/15019161162397.jpg)


**下面将详细的解释一下上面的例子**

　　1. client1订阅了tv1这个channel这个频道的消息，client2订阅了tv1和tv2这2个频道的消息
　　2. client3 是用于发布tv1和tv2这2个频道的消息发布者
　　3. 接下来我们在client3发布了一条消息”publish tv1 program1”，大家可以看到这条消息是发往tv1这个频道的
　　4. 理所当然的client1和client2都接收到了这个频道的消息
　　5. 然后client3又发布了一条消息”publish tv2 program2”，这条消息是发往tv2的，由于client1并没有订阅tv1，所以client1的结果中并没有显示出任何结果,但client2订阅了这个频道，所以client2是会有返回结果的。
我们也可以用psubscribe tv*的方式批量订阅以tv开头的频道的内容。
　　
看完这个小例子后应该对pub/sub功能有了一个感性的认识。需要注意的是当一个连接通过subscribe或者psubscribe订阅通道后就进入订阅模式。在这种模式除了再订阅额外的通道或者用unsubscribe或者punsubscribe命令退出订阅模式，就不能再发送其他命令。另外使用 psubscribe命令订阅多个通配符通道，如果一个消息匹配上了多个通道模式的话，会多次收到同一个消息。
下面给出PHP的实现代码：


```php
<?php  
  
$redis = new Redis();  
$redis->connect('127.0.0.1',6379);  
  
$channel = $argv[1]; // channel  
$msg = $argv[2]; // msg  
  
$redis->publish('channel'.$channel, $msg);  
  
?>  
```

```php
<?php  
  
$redis = new Redis();  
$redis->connect('127.0.0.1',6379);  
$channel = $argv[1]; // channel  
$redis->subscribe(array('channel'.$channel), 'callback');  
  
function callback($instance, $channelName, $message) {  
 echo $channelName, "==>", $message,PHP_EOL;  
}  
  
?>  
```


