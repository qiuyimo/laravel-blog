---
title: phpstorm for Mac 修改注释的风格
description: phpstorm for Mac 修改注释的风格
keywords: phpstorm, Mac, tools
create_time: 2017-03-23
tag: phpstorm, Mac, tools
category: 笔记
---

phpstorm默认的注释, 会在行首加上注释符. 非常的不习惯. 我习惯是在代码前面加上`//`再加一个空格. 修改如下达到效果.

![](/images/14902336357005.jpg)



效果如下:

```php
$elements = $driver->findElements(WebDriverBy::cssSelector("#resultsCol h2"));

foreach ($elements as $v) {
   // echo $v->getText()."\n";

}
```




