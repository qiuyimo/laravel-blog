# laravel 记录 sql 日志



文件: `/laravel-project/app/Providers/AppServiceProvider.php`


监听 query, 然后保存的 `sql.log`.

# 一级标题
## 二级标题
### 三级标题
#### 四级标题
##### 五级标题
###### 六级标题

1. test
    * testtest
    * testsetes
2. test
    1. testset
    2. testest
    3. testset
3. testsetste

> 一级引用


>> 二级引用
>> 二级引用


>>> 三级引用
>>> 三级引用
>>> 三级引用

**加粗**

~~删除线~~

*斜体*


- [ ] 不勾选
- [x] 勾选

[链接](http://coding.net)

![Alt text](/path/to/img.jpg)


First Header | Second Header | Third Header
------------ | ------------- | ------------
Content Cell | Content Cell  | Content Cell
Content Cell | Content Cell  | Content Cell


---


First Header | Second Header | Third Header
:----------- | :-----------: | -----------:
Left         | Center        | Right
Left         | Center        | Right


这是分隔线上部分内容

---

这是分隔线上部分内容


```php
public function register()
{
    if ($this->app->environment() !== 'production') {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
    // ...
}
```


sql 日志文件 path: `/laravel-project/storage/logs/sql.log`

```php
<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // 记录 sql 日志.
        DB::listen(function ($query) {
            $tmp = str_replace('?', '"'.'%s'.'"', $query->sql);
            $tmp = vsprintf($tmp, $query->bindings);
            $tmp = '[' . date("Y-m-d H:i:s", time()) . "]\n" . str_replace("\\", "", $tmp) . "\n";
            file_put_contents(storage_path('/logs/sql.log'), $tmp, FILE_APPEND);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

```

