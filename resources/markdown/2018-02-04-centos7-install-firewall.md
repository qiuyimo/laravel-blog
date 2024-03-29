---
title: centos7中配置防火墙
description: centos7中配置防火墙
keywords: Linux, firewall, firewalld, 防火墙
create_time: 2018-02-04
tag: Linux, firewall, firewalld, 防火墙
category: 笔记
---

## 参考

[linux防火墙iptables的原理及配置详解](http://www.178linux.com/85281)

[iptables详解](http://www.zsythink.net/archives/1199)

[firewalld](http://www.firewalld.org/documentation/)

[FirewallD](https://linux.cn/article-8098-1.html) **强烈推荐**

[使用 firewalld 构建 Linux 动态防火墙](https://www.ibm.com/developerworks/cn/linux/1507_caojh/index.html)

## 常用命令

| 命令                                                        | 解释                                         |
|:-----------------------------------------------------------|:--------------------------------------------|
| firewall-cmd --zone=custom --add-port=9090/tcp             | 开启9090端口, 当前有效                         |
| firewall-cmd --zone=custom --add-port=9090/tcp --permanent | 开启9090端口, 加入 `custom`配置文件. 重启后也生效 |



## 使用

### 启动服务，并在系统引导时启动该服务：

```bash
systemctl start firewalld
systemctl enable firewalld
```

要停止并禁用：

```bash
systemctl stop firewalld
systemctl disable firewalld
```

### 重新加载 FirewallD 配置：

```bash
firewall-cmd --reload
```

    FirewallD 使用 XML 进行配置。除非是非常特殊的配置，你不必处理它们，而应该使用 firewall-cmd。
    
    配置文件位于两个目录中：
    
    /usr/lib/FirewallD 下保存默认配置，如默认区域和公用服务。 
    避免修改它们，因为每次 firewall 软件包更新时都会覆盖这些文件。
    /etc/firewalld 下保存系统配置文件。 这些文件将覆盖默认配置。


### 配置集

    FirewallD 使用两个配置集：“运行时”和“持久”。 在系统重新启动或重新启动 FirewallD 时，不会保留运行时的配置更改，而对持久配置集的更改不会应用于正在运行的系统。
    
    默认情况下，firewall-cmd 命令适用于运行时配置，但使用 --permanent 标志将保存到持久配置中。要添加和激活持久性规则，你可以使用两种方法之一。
    
    1、 将规则同时添加到持久规则集和运行时规则集中。 
    
    sudo firewall-cmd --zone=public --add-service=http --permanent
    sudo firewall-cmd --zone=public --add-service=http
    2、 将规则添加到持久规则集中并重新加载 FirewallD。 
    
    sudo firewall-cmd --zone=public --add-service=http --permanent
    sudo firewall-cmd --reload


> reload 命令会删除所有运行时配置并应用永久配置。因为 firewalld 动态管理规则集，所以它不会破坏现有的连接和会话。

