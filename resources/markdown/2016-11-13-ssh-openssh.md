---
title: SSH 和 OpenSSH说明
description: SSH 和 OpenSSH说明
keywords: Linux, 计算机原理
create_time: 2016-11-13
tag: Linux, 计算机原理
category: 笔记
---

ssh 的简介.

## SSH是什么?
**ssh**: 英文全称是 *Secure Shell Protocol* , 即*安全外壳协议* . 

通过使用SSH，你可以把所有传输的数据进行加密，这样“中间人”这种攻击方式就不可能实现了， 而且也能够防止DNS和IP欺骗。还有一个 额外的好处就是传输的数据是经过压缩的，所以可以加快传输的速度。 SSH有很多功能，它既可以代替telnet，又可以为ftp、pop、甚至ppp提 供一个安全的“通道”。 

最初SSH是由芬兰的一家公司开发的。但是因为受版权和加密算法的限制，现在很多人都转而使用OpenSSH。 

OpenSSH是SSH的替代软件，而且是免费的，可以预计将来会有越 来越多的人使用它而不是SSH。 

SSH是由客户端和服务端的软件组成的，有两个不兼容的版本分别是：1.x和2.x。 用SSH 2.x的客户程序是不能连接到SSH 1.x的服务程序上去的。OpenSSH 2.x同时支持SSH 1.x和2.x。 

## 为什么要用SSH
传统的网络服务程序，如：ftp、pop和telnet在本质上都是不安全的，因为它们在网络上用明文传送口令和数据， 别有用心的人非常容易就可以截 获这些口令和数据。

而且，这些服务程序的安全验证方式也是有其弱点的， 就是很容易受到“中间人”（man-in-the-middle）这种方式的攻击。

所谓“中间人”的攻击方式， 就是“中间人”冒充真正的服务器接收你的传给服务器的数据，然后再冒充你把数据传给真正的服务器。 

服务器和你之间的数 据传送被“中间人”一转手做了手脚之后，就会出现很严重的问题。

## 怎么用SSH
从客户端来看，SSH提供两种级别的安全验证。 

* 第一种级别（基于口令的安全验证）

只要你知道自己帐号和口令，就可以登录到远程主机。所有传输的数据都会被加密， 但是不能保证你正在连接的服务器就是你想连接的服务器。可能会有别的服务器在冒充真正的服务器， 也就是受到“中间人”这种方式的攻击。

例如: `ssh root@192.168.0.222`
这是我平时在shell中连接我的虚拟机的命令. 就是使用的这种方式. 

 
* 第二种级别（基于密匙的安全验证）

需要依靠密匙，也就是你必须为自己创建一对密匙，并把公用密匙放在需要访问的服务器上。 如果你要连接到SSH服务器 上，客户端软件就会向服务器发出请求，请求用你的密匙进行安全验证。服务器收到请求之后， 先在你在该服务器的家目录下寻找你的公用密匙，然后把它和你发 送过来的公用密匙进行比较。如果两个密匙一致， 服务器就用公用密匙加密“质询”（challenge）并把它发送给客户端软件。 客户端软件收到“质 询”之后就可以用你的私人密匙解密再把它发送给服务器。 

用这种方式，你必须知道自己密匙的口令。但是，与第一种级别相比，第二种级别不需要在网络上传送口令。

例如: 用git推送到github, 一般都是使用第二种方式. 






