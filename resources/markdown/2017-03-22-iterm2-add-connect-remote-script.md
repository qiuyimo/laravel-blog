---
title: iterm2添加连接远程服务器的脚本. 方便以后连接服务器
description: iterm2添加连接远程服务器的脚本. 方便以后连接服务器.
keywords: iterm2, iterm
create_time: 2017-03-22
tag: iterm2, iterm
category: 笔记
---

iterm2添加连接远程服务器的脚本. 方便以后连接服务器, 使用起来太方便了.


方法, 如图:

![](/images/14901486312469.jpg)


重点是箭头指向的地方:

填入的格式:
`expect /Users/qiuyu/iterm_login_shell/192.168.10.2`

其中
`/Users/qiuyu/iterm_login_shell/192.168.10.2`是我的文件路径. 如图:

![](/images/14901484425066.jpg)

内容如下:

```shell
#!/usr/bin/expect -f
set user root
set host 192.168.10.2
set password 111111
set timeout -1

spawn ssh $user@$host
expect "*assword:*"
send "$password\r"
interact
expect eof
```

这样, 以后按`command+o`, 就可以呼出选项了. 

![](/images/14901490028120.jpg)




