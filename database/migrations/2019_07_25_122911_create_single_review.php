<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSingleReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('h1_title')->index();
            $table->string('title')->index();
            $table->longText('description');
            $table->float('overall_rating');
            $table->integer('quality')->nullable();
            $table->integer('price')->nullable();
            $table->integer('customer_support')->nullable();
            $table->string('author')->index();
            $table->string('back_img')->nullable();
            $table->string('back_alt_img')->nullable();
            $table->text('short_desc');
            $table->longText('text');
            $table->integer('hardcode_id');
            $table->string('link');
            $table->longText('main_quote');
            $table->string('img_main_quote')->nullable();
            $table->string('alt_main_quote_img')->nullable();
            $table->string('url');
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('single_reviews');
    }
}
