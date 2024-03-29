---
title: php静态方法和非静态方法的使用场景
description: php静态方法和非静态方法的使用场景
keywords: PHP, static
create_time: 2018-01-25
tag: PHP, static
category: 笔记
---

一直弄不清楚, 什么时候应该使用静态方法, 什么时候应该使用非静态方法.
今天就抽时间, 好好的查查资料, 总结一下思路. 方便在以后的代码道路上不犯错误.

## 道友的理解

[大家的见解](http://www.cnblogs.com/subsir/articles/2574761.html)

[segmentfault](https://segmentfault.com/q/1010000003489029)

>如果你的类是需要实例化的，并且你的的方法是实例之间发生作用，那么事实上你“只能”使用非静态方法
 如果你希望暴露一些什么地方都不会改变的，全局可用的方法，那么使用静态方法（场景上会让你感觉像是在调用一个全局可用的函数）

>这里还有个陷阱是静态类和单例的区别，它们可能都是提供一个全局的"唯一"对象，并且暴露一些方法给外部使用
 它们的场景区别是，如果你的这个唯一对象需要维持一定的状态，或者实现某个接口或者继承某个类，或者集成在某个类中，那么使用单例
 如果你的这个对象仅仅就是提供全局访问，不涉及到状态，那么使用静态类静态方法

## 我的理解

> 在一个类中, 我们可以使用一些共有的属性来控制我们的逻辑, 这个时候, 用静态方法就不好处理了.
这个时候用非静态方法是最好的.

> 静态方法适合用于一个单独的, 独立的逻辑. 不会使用和改变到类中的属性.

## todo

以后我有了更深的认识, 会随时更新. 目前从使用的角度来说. 就这些理解.

> create_time: 2018-01-25 23:59:41