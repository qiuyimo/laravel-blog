---
title: screen的使用方法和应用场景
category: 笔记
description: screen的使用方法和应用场景
keywords: Linux, screen
create_time: 2018-06-23 00:30:28
tag: Linux, screen
---

远程连接服务器后, 有的时候需要在后台运行一个服务, 有的时候服务器设置了自动断开, 怎么保证运行的命令不断开? 可以使用`screen`命令来实现. 

screen的使用方法和应用场景

使用`screen`命令来创建一个新的会话. `exit`退出. 
再次想要进入, 执行`screen -ls`, 会显示后台运行的列表.
再执行`screen -r 进程号`就进入了. 


## 常用快捷键的意义

绑定键 | 意义
------| -------------
C-a ? | 	显示所有键绑定信息
C-a w	 | 显示所有窗口列表
C-a C-a	 | 切换到之前显示的窗口
C-a c	 | 创建一个新的运行shell的窗口并切换到该窗口
C-a n	 | 切换到下一个窗口
C-a p	 | 切换到前一个窗口(与C-a n相对)
C-a 0..9	 | 切换到窗口0..9
C-a a	 | 发送 C-a到当前窗口
C-a d | 	暂时断开screen会话
C-a k | 	杀掉当前窗口
C-a [ | 	进入拷贝/回滚模式

参数 | 意义
------| -------------
-c file | 	使用配置文件file，而不使用默认的$HOME/.screenrc
-d|-D [pid.tty.host] | 不开启新的screen会话，而是断开其他正在运行的screen会话
-h num	 | 指定历史回滚缓冲区大小为num行
-list|-ls	 | 列出现有screen会话，格式为pid.tty.host
-d -m | 	启动一个开始就处于断开模式的会话
-r sessionowner/ [pid.tty.host] | 	重新连接一个断开的会话。多用户模式下连接到其他用户screen会话需要指定sessionowner，需要setuid-root权限
-S sessionname	 | 创建screen会话时为会话指定一个名字
-v	 | 显示screen版本信息
-wipe [match]	 | 同-list，但删掉那些无法连接的会话



Linux下经常使用putty或者secureCRT等通过ssh远程登录服务器，但如果在执行程序的过程中关闭远程终端窗口，则原先运行的程序会被立即杀死。这对于一些花费时间较长的程序非常不利，本文将介绍如何使用screen命令解决这个问题，以及screen提供的其他功能。


screen简介
使用ssh远程登录服务器时，如果在运行程序的过程中不小心关闭了远程终端窗口，或者出现网络断开或者电脑死机的情况，主机与服务器的连接会话立即丢失，刚刚运行的程序或进行的工作也同时丢失，这不得不说是一件非常令人沮丧的事情。使用screen可以很好地解决这个问题。

screen是一款由GNU计划开发的用于命令行终端切换的自由软件，实现全屏窗口管理的功能，能够混合多个工作到一个终端上。
一般linux系统中自带有screen命令，如果没有，ubuntu类系统可以方便地通过以下命令进行安装：

sudo apt-get install screen
在Red Hat类系统中可以使用以下命令：

yum install screen
下面简单介绍screen的几个常用功能。

多会话
通过putty等远程服务器后，直接在命令行下运行以下命令新建一个screen会话：

screen
也可以指定会话的名称，以下即创建以noalgo为名称的会话：

screen -S noalgo
也可以在新建会话时指定要运行的程序，以下运行了vi编辑器，注意此时退出vi编辑器即表示退出了screen会话。

screen -S noalgo vi helloworld.c
新建会话后即进入了screen的世界，在这里做的事情和在普通的shell中的事情没有什么区别，只是此时的会话是可以进行恢复的，即使发生网络中断，也可以通过再次运行screen命令回到刚才的会话中，而且，再次回来时屏幕上显示的是刚才的画面，而如果程序动态运行时，此时显示最新的结果。
如果有事需要离开，而服务器上的程序需要同时在运行，此时可以通过命令d分离会话。在screen会话中进行的操作都是以ctrl+a开始，所以分离时需要先按下ctrl+a，然后再按d，这里表示为：

C-a, d
此时会回到原先的putty窗口，就可以随意关掉putty去干其他事情了。
当要回去的时候可以先通过putty进行登录，然后运行以下命令查看系统中已有的screen会话：

screen -ls
或

screen -list
得到的结果类似为：

noalgo@AdMin:~$ screen -ls
There is a screen on:
        15057.noalgo    (01/30/2015 06:16:45 AM)        (Detached)
1 Socket in /var/run/screen/S-noalgo.
然后可以通过以下命令回到screen会话中：

screen -r 15075
或者直接通过会话名称回去：

screen -r noalgo
此时即可继续刚刚离开之前所做的事情了。
另外，通过以下命令可以实现会话共享，此时多个用户登录到同一个会话中，如果他们同时处于同一个窗口下时，彼此的操作会同步给每一个用户，即达到共享桌面的效果。

screen -X
多窗口
在普通的shell环境中，如果要同时执行多个程序，可以通过ctrl+z，以及fg和bg等命令交替执行，但screen提供了多窗口的功能同样可以达到这个目的。
通过screen命令新建一个会话：

screen -S noalgo
此时进入了screen会话默认的一个窗口，通过以下命令可以新建一个窗口并进入新的窗口：

C-a, c
在不同的窗口间切换可以通过下面两个命令进行，分别是进入下一个和前一个窗口：

C-a, n
C-a, p
使用以下命令可以查看当前共有几个窗口，标注*号的为当前所在的窗口：

C-a, w
使用以下命令强行关闭一个窗口，如果当前只剩下最后一个窗口，则终止当前的会话：

C-a, k
以下命令也可以达到同样的效果：

exit
当使用多个窗口时，可以通过将屏幕分割成几个区域来提高效率。使用以下命令进行分屏，分别是水平分割和垂直分割：

C-a, S
C-a, |
拥有多个屏幕时，使用以下命令进行切换：

C-a, Tab
使用以下命令关闭某个分屏，

C-a, X
或者关闭处当前区域的所有其他区域：

C-a, Q
Screen详细参数
以上是通过简单的例子介绍screen的常见用法，下面对其参数进行详细介绍。screen的命令语法为：

screen [-AmRvx -ls -wipe][-d <name>][-h <line>][-r <name][-s ][-S <name>]

其中的参数意义如下：

-A：将所有的视窗都调整为目前终端机的大小。
-d：分离指定的screen会话。
-h：指定视窗的缓冲区行数。
-m：即使目前已在会话中的screen会话，仍强制建立新的screen会话。
-r：恢复分离的screen会话。
-R：先试图恢复离线的会话。若找不到离线的会话，即建立新的screen会话。
-s：指定建立新视窗时，所要执行的shell。
-S：指定screen会话的名称。
-v：显示版本信息。
-x：恢复之前离线的screen会话。
-ls：显示目前所有的screen会话。
-list：显示目前所有的screen会话。
-wipe：检查目前所有的screen会话，并删除已经无法使用的screen会话。
在每个screen会话中，可以使用的命令如下。注意，screen的命令都是以ctrl+a(C-a)开始的，以下省略C-a而直接以后面的按键替代：

?：Help，显示按键绑定情况。
c：Create，创建新的窗口。
n：Next，切换到下个窗口。
p：Previous，切换到前一个窗口。
M：查看活动状态。
x：锁住当前的窗口，需用用户密码解锁。
d：Detach，暂时离开当前会话，此后可以恢复。
z：把当前会话放到后台执行，可以使用shell的fg命令回去。
w：Windows，列出已创建的窗口。
t：Time，显示当前时间。
K：Kill，强行关闭当前的窗口。
[0..9]：切换到第 0..9个窗口。
[Space]：由窗口0顺序切换到窗口9。
C-a：在两个最近使用的窗口间切换。
S：水平分屏。
|：垂直分屏。
X：关闭当前分屏。
Q：关闭除当前分屏的所有分屏。
[Tab]：在分屏中切换。
[：Copy,进入拷贝模式，此时可以回滚、搜索、复制，就像用使用vi一样。
]：Paste，粘贴刚刚在拷贝模式选定的内容。
其中在拷贝模式下可以使用的命令包括

C-b：Backward，PageUp。
C-f：Forward，PageDown。
H：High，将光标移至左上角。
L：Low，将光标移至左下角。
0：移到行首。
$：移到行末。
w：forward one word，前移一个字。
b：backward one word，后移一个字。
Space：第一次按标记起点，第二次按标记终点。
Esc：结束copy mode。
这里列的也不是全部的参数，需要更详细的内容，可以直接通过以下命令进行获取：

man screen
下面是C-a, ?显示的内容，可以提示每个按键绑定的功能，也非常方便。

                                 Screen key bindings, page 1 of 1.

                                 Command key:  ^A   Literal ^A:  a

 break       ^B b        history     { }         other       ^A          split       S         
 clear       C           info        i           pow_break   B           suspend     ^Z z      
 colon       :           kill        K k         pow_detach  D           time        ^T t      
 copy        ^[ [        lastmsg     ^M m        prev        ^H ^P p ^?  title       A         
 detach      ^D d        license     ,           quit        \           vbell       ^G        
 digraph     ^V          lockscreen  ^X x        readbuf     <           version     v         
 displays    *           log         H           redisplay   ^L l        width       W         
 dumptermcap .           login       L           remove      X           windows     ^W w      
 fit         F           meta        a           removebuf   =           wrap        ^R r      
 flow        ^F f        monitor     M           reset       Z           writebuf    >         
 focus       ^I          next        ^@ ^N sp n  screen      ^C c        xoff        ^S s      
 hardcopy    h           number      N           select      '           xon         ^Q q      
 help        ?           only        Q           silence     _         

^]   paste .
"    windowlist -b
-    select -
0    select 0
1    select 1
2    select 2
3    select 3
4    select 4
5    select 5
6    select 6
7    select 7
8    select 8
9    select 9
I    login on
O    login off
]    paste .
|    split -v
:kB: focus prev

