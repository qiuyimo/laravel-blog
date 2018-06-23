## 常见问题

### migrate 报错: 1231 Variable 'sql_mode' can't be set to the value of 'NO_AUTO_CREATE_USER'

第一次运行 `php artisan migrage`, 报错, 如下: 

```shell
➜  laravel-blog git:(master) ✗ php artisan migrate

In Connection.php line 664:

  SQLSTATE[42000]: Syntax error or access violation: 1231 Variable 'sql_mode' can't be set to the value of 'NO_AUTO_CREATE_USER' (SQL: select * from information_schema.tables where table_schema = laravel-blog and table_name = migrations)


In MySqlConnector.php line 150:

  SQLSTATE[42000]: Syntax error or access violation: 1231 Variable 'sql_mode' can't be set to the value of 'NO_AUTO_CREATE_USER'


➜  laravel-blog git:(master) ✗
```

**在 `5.7.*` 的日志中提到已废除该模式，在 `8.0.11` 中删除了，迁移时会抛出如下异常**

> Illuminate\Database\QueryException : SQLSTATE[42000]: Syntax error or access violation: 1231 Variable 'sql_mode' can't be set to the value of 'NO_AUTO_CREATE_USER'

解决方案：将 `config/database.php` 配置文件中 `mysql` 的 `strict` 的值改为 `false` 即可！



### Mac 升级后 git 不可用

给 Mac 升级了, 之后使用 `git`, 提示:

```shell
xcrun: error: invalid active developer path (/Library/Developer/CommandLineTools), missing xcrun at: /Library/Developer/CommandLineTools/usr/bin/xcrun
```

解决方法，重装xcode command line：

```shell
$ xcode-select --install
```

或者

```shell
$ sudo xcode-select -switch /
```

