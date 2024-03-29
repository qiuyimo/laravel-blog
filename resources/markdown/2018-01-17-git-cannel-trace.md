---
title: 已经提交到远程仓库的文件, 取消git的版本控制
description: 已经提交到远程仓库的文件, 取消git的版本控制
keywords: Git, Linux
create_time: 2018-01-17
tag: Git, Linux
category: 笔记
---

git的命令太常用了. 但是, 有一些命令用的很少, 用到的时候手忙脚乱的. 特此记录. 方便以后查阅.

### 命令解释
```bash
-n --dry-run 
Don’t actually remove any file(s). Instead, just show if they exist in the index and would otherwise be removed by the command.
-r 
Allow recursive removal when a leading directory name is given. 
--cached 
Use this option to unstage and remove paths only from the index. Working tree files, whether modified or not, will be left alone.
```

### 命令
```bash
git rm -r -n --cached "bin/" //-n：加上这个参数，执行命令时，是不会删除任何文件，而是展示此命令要删除的文件列表预览。
git rm -r --cached  "bin/"      //最终执行命令. 
git commit -m" remove bin folder all file out of control"    //提交
git push origin master   //提交到远程服务器
```



### 实际操作
##### 只是展示文件列表. 
```bash
➜  coupons_deals git:(master) ✗
➜  coupons_deals git:(master) ✗ git rm -r -n --cached "vendor/"
rm 'vendor/.DS_Store'
rm 'vendor/.idea/modules.xml'
rm 'vendor/.idea/vendor.iml'
rm 'vendor/.idea/workspace.xml'
rm 'vendor/autoload.php'
rm 'vendor/composer/ClassLoader.php'
rm 'vendor/composer/LICENSE'
rm 'vendor/composer/autoload_classmap.php'
rm 'vendor/composer/autoload_namespaces.php'
rm 'vendor/composer/autoload_psr4.php'
rm 'vendor/composer/autoload_real.php'
rm 'vendor/composer/autoload_static.php'
rm 'vendor/composer/installed.json'
rm 'vendor/facebook/.DS_Store'
rm 'vendor/facebook/webdriver/.DS_Store'
rm 'vendor/facebook/webdriver/.coveralls.yml'
....
➜  coupons_deals git:(master) ✗
```

##### 清除git的版本控制. 且列出列表.
```bash
➜  coupons_deals git:(master) ✗ git rm -r --cached "vendor/"
rm 'vendor/.DS_Store'
rm 'vendor/.idea/modules.xml'
rm 'vendor/.idea/vendor.iml'
rm 'vendor/.idea/workspace.xml'
rm 'vendor/autoload.php'
rm 'vendor/composer/ClassLoader.php'
rm 'vendor/composer/LICENSE'
rm 'vendor/composer/autoload_classmap.php'
rm 'vendor/composer/autoload_namespaces.php'
rm 'vendor/composer/autoload_psr4.php'
rm 'vendor/composer/autoload_real.php'
rm 'vendor/composer/autoload_static.php'
rm 'vendor/composer/installed.json'
rm 'vendor/facebook/.DS_Store'
rm 'vendor/facebook/webdriver/.DS_Store'
rm 'vendor/facebook/webdriver/.coveralls.yml'
...
```

##### 提交

```bash
➜  coupons_deals git:(master) ✗ git commit -m 'remove vendor folder all file out of git control'
[master 9975fd2] remove vendor folder all file out of git control
 188 files changed, 39 insertions(+), 17071 deletions(-)
 create mode 100644 .idea/deployment.xml
 create mode 100644 .idea/webServers.xml
 create mode 100644 log/slickdeals_item.html
 delete mode 100755 vendor/.DS_Store
 delete mode 100755 vendor/.idea/modules.xml
 delete mode 100755 vendor/.idea/vendor.iml
 delete mode 100755 vendor/.idea/workspace.xml
 delete mode 100755 vendor/autoload.php
 delete mode 100755 vendor/composer/ClassLoader.php
 delete mode 100755 vendor/composer/LICENSE
 delete mode 100755 vendor/composer/autoload_classmap.php
 delete mode 100755 vendor/composer/autoload_namespaces.php
 delete mode 100755 vendor/composer/autoload_psr4.php
 delete mode 100755 vendor/composer/autoload_real.php
 delete mode 100755 vendor/composer/autoload_static.php
 delete mode 100755 vendor/composer/installed.json
 delete mode 100755 vendor/facebook/.DS_Store
 delete mode 100755 vendor/facebook/webdriver/.DS_Store
 delete mode 100755 vendor/facebook/webdriver/.coveralls.yml
 ....
```
 
##### 提交到远程
```bash
 ➜  coupons_deals git:(master) ✗ git push origin master
Counting objects: 7, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (7/7), done.
Writing objects: 100% (7/7), 1.09 KiB | 0 bytes/s, done.
Total 7 (delta 2), reused 0 (delta 0)
To ssh://promo.302e.com:5022/qiuyu/coupons_deals.git
   f0a8e4f..9975fd2  master -> master
➜  coupons_deals git:(master) ✗
```
 
 
##### 查看
```bash
➜  coupons_deals git:(master) ✗ git status
On branch master
Your branch is up-to-date with 'origin/master'.
Changes not staged for commit:
  (use "git add/rm <file>..." to update what will be committed)
  (use "git checkout -- <file>..." to discard changes in working directory)

	modified:   .idea/deployment.xml
	modified:   core/.DS_Store
	deleted:    core/driver/.DS_Store
	modified:   coupons_deals.class.php
	modified:   log/slickdeals_item.html

Untracked files:
  (use "git add <file>..." to include in what will be committed)

	.idea/coupons_deals.iml
	.idea/modules.xml
	.idea/vcs.xml
	.idea/workspace.xml
	log/anycodes.log
	log/anycodes_max_id.log
	log/coupons.html
	log/slickdeals.html
	log/slickdeals.log
	log/slickdeals_max_id.log
	log/slickdeals_url_list.log
	vendor/

no changes added to commit (use "git add" and/or "git commit -a")
➜  coupons_deals git:(master) ✗
```

可以看到. `vendor`文件夹已经不在git的控制之中了.


# add后, 没有commit, 取消版本控制.

如果想取消使用git add命令添加的文件的话，需要下面的命令：

```bash
git rm –cached
```

`git rm` 命令是把建立的版本库索引（index）和那个文件一起删除了。

加上`cached`之后，就只删除索引，不删除文件本身。

与`git add`相应的取消操作并不是`git rm`，而是`git rm –cached`。
这是需要非常注意的地方。
