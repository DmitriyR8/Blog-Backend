<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticle extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('h1_title')->index();
            $table->string('title')->index();
            $table->longText('description');
            $table->string('url');
            $table->integer('views')->nullable();
            $table->text('short_desc');
            $table->string('author')->index();
            $table->time('read_time')->nullable();
            $table->string('back_img')->nullable();
            $table->string('back_alt_img')->nullable();
            $table->longText('main_quote');
            $table->string('img_main_quote')->nullable();
            $table->string('alt_main_quote_img')->nullable();
            $table->text('related_articles');
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
        Schema::dropIfExists('blog_articles');
    }
}