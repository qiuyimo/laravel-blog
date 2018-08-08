<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToInvalidMarkdownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invalid_markdown', function (Blueprint $table) {
            $table->tinyInteger('type')->default(1)->comment('类型, 1: markdown 无效, 2: markdown 已经不存在');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invalid_markdown', function (Blueprint $table) {
            //
        });
    }
}
