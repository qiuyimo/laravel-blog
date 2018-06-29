---
title: 同时推送代码到 GitHub Coding
category: 笔记
tag: Git
create_time: 2018-06-27 23:18:01
keywords: Git, GitHub, Coding
is_show: 1
curl: 
---



最近在使用 aliyun 上搞博客项目, 拉取 github 上的代码非常的慢. 慢的我无法忍受, 那么有没有什么办法能够快点呢? 没找到合适的方法, 就换一个思路, 把代码同时推送到国内的仓库中, 这样在 aliyun 上应该就不会慢了吧. 



## aliyun 上使用 github 的龟速

看这个速度, 龟速啊. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z code]# git clone git@github.com:qiuyuhome/laravel-blog.git
正克隆到 'laravel-blog'...
remote: Counting objects: 1233, done.
remote: Compressing objects: 100% (838/838), done.
^CKilled by signal 2./1233), 5.69 MiB | 8.00 KiB/s

[root@iZm5eat7o13nmw3p7hg674Z code]#
```

只有可怜的 `8.00 KiB/s`. `!感谢` 中国的伟大长城防火墙. 

## 解决方案

本地推动代码时, 同时推送到 github 和国内的 coding 上, 在 aliyun 上拉取国内的 coding, 速度应该就不会慢了吧. 

### coding

就是一个中国版的 github, 熟悉 github了, 这个更不在话下了, 官方就是中文的. 

1. 建立仓库.
2. 加入公钥.

### 添加本地仓库的远程地址

命令: `git remote set-url --add origin <url2>`

```shell
➜  laravel-blog git:(master) ✗ git remote set-url --add origin git@git.coding.net:qiuyuhome/laravel-blog.git
➜  laravel-blog git:(master) ✗ git remote -v
origin	git@github.com:qiuyuhome/laravel-blog.git (fetch)
origin	git@github.com:qiuyuhome/laravel-blog.git (push)
origin	git@git.coding.net:qiuyuhome/laravel-blog.git (push)
➜  laravel-blog git:(master) ✗
```

### 推送

现在就可以 push 代码了, 会同时推送到指定的 2 个仓库中. 

```git
➜  laravel-blog git:(master) ✗ git add .
➜  laravel-blog git:(master) ✗ git commit -m 'base'
[master e8b7404] base
 1 file changed, 5 insertions(+), 5 deletions(-)
➜  laravel-blog git:(master) git push origin master
Counting objects: 3, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (3/3), done.
Writing objects: 100% (3/3), 391 bytes | 391.00 KiB/s, done.
Total 3 (delta 2), reused 0 (delta 0)
remote: Resolving deltas: 100% (2/2), completed with 2 local objects.
To github.com:qiuyuhome/laravel-blog.git
   537193e..e8b7404  master -> master
The authenticity of host 'git.coding.net (123.59.86.5)' can't be established.
RSA key fingerprint is SHA256:jok3FH7q5LJ6qvE7iPNehBgXRw51ErE77S0Dn+Vg/Ik.
Are you sure you want to continue connecting (yes/no)? yes
Warning: Permanently added 'git.coding.net,123.59.86.5' (RSA) to the list of known hosts.
Counting objects: 1236, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (939/939), done.
Writing objects: 100% (1236/1236), 48.48 MiB | 568.00 KiB/s, done.
Total 1236 (delta 412), reused 660 (delta 239)
remote: Resolving deltas: 100% (412/412), done.
To git.coding.net:qiuyuhome/laravel-blog.git
 * [new branch]      master -> master
➜  laravel-blog git:(master)
```



### 阿里云拉取代码

再看看这回是速度

```shell
[root@iZm5eat7o13nmw3p7hg674Z code]# git clone git@git.coding.net:qiuyuhome/laravel-blog.git
正克隆到 'laravel-blog'...
Warning: Permanently added the RSA host key for IP address '123.59.85.117' to the list of known hosts.
remote: Counting objects: 1241, done.
remote: Compressing objects: 100% (771/771), done.
remote: Total 1241 (delta 414), reused 1235 (delta 412)
接收对象中: 100% (1241/1241), 48.48 MiB | 15.52 MiB/s, done.
处理 delta 中: 100% (414/414), done.
[root@iZm5eat7o13nmw3p7hg674Z code]#
```

15.52 MiB/s, 速度嗷嗷地. 