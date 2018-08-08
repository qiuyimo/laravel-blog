---
title: 浏览器实时输出
category: PHP
tag: PHP
create_time: 12:31 PM
keywords: PHP
is_show: 1
curl: 
---

```php
<?php

//实时输出内容
ob_end_clean();
ob_implicit_flush();

// Nginx需要加上下面这一行.
header('X-Accel-Buffering: no');

for ($i = 0; $i < 10; $i++) {
    echo $i . "<br/>";
    sleep(1);
}

echo "complete";

```

