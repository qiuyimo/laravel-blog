---
title: PHP根据时间戳, 获取月的第一天和最后一天, 周的第一天和最后一天
description: 根据时间戳, 获取月的第一天和最后一天, 周的第一天和最后一天
keywords: PHP, 周的第一天, 周的最后一天
create_time: 2016-11-25
tag: PHP
category: PHP
---

# 根据时间戳, 获取月的第一天和最后一天, 周的第一天和最后一天

```php
if ($time_type == 1) {
	$begin_time = strtotime(date("Y", $time).'-'.date("m", $time).'-1');
	$end_time = strtotime(date('Y-m', strtotime('next month')).'-1');
} elseif($time_type == 2) {
	$begin_time = $time - 86400 * date('w', $time) + (date('w', $time) > 0 ? 86400 : -518400);
	$end_time = $begin_time + 518400;
}

```







