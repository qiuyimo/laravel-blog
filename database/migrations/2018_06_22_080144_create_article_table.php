<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id')->comment('主键 id');
            $table->string('title', 255)->unique()->comment('标题');
            $table->string('url', 255)->unique()->comment('相对 url');
            $table->string('description', 255)->comment('meta 的描述信息');
            $table->string('keywords', 255)->comment('mata 的关键字');
            $table->integer('category_id')->comment('分类的 id');

            $table->integer('weight')->default(0)->comment('排序权重, 越大越优先显示');

            $table->integer('like')->unsigned()->default(0)->comment('点赞数量');

            $table->text('markdown')->comment('markdown 正文');
            $table->text('html')->comment('根据 markdown 转换后的 html');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
