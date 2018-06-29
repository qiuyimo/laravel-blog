<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvalidMarkdownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invalid_markdown', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name', 255)->comment('markdown 的文件名称');
            $table->string('log', 255)->comment('失效原因');
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
        Schema::dropIfExists('invalid_markdown');
    }
}
