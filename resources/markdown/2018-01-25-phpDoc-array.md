---
title: phpDoc描述数组
description: phpDoc描述数组
keywords: PHP, phpDoc, Array
create_time: 2018-01-25
tag: PHP, phpDoc, Array
category: 笔记
---

psr的规范中找不到数组应该如何的注释. 只能查一些第三方的资料. 来看看别人是如何注释数组的. 特此记录.

## 参考

[psr-5 github](https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md)

[查看 wiki](https://zh.wikipedia.org/wiki/PHPDoc)

```php
/**
 * Initializes this class with the given options.
 *
 * @param array $options {
 *     A description of this array.
 *
 *     @type boolean $required Whether this element is required
 *     @type string  $label    The display name for this element
 * }
 */
public function __construct(array $options = array())
{
    <...>
}
```

```php
/**
 * 批量获取用户基本信息
 * @desc 用于获取多个用户基本信息
 * @return int    code 操作码，0表示成功
 * @return array  list 用户列表
 * @return int    list[].id 用户ID
 * @return string list[].name 用户名字
 * @return string list[].note 用户来源
 * @return string msg 提示信息
 */
public function getMultiBaseInfo()
{
    return [];
}
```


