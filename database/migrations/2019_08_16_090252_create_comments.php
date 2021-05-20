<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('rating');
            $table->longText('comment_body');
            $table->boolean('approve')->nullable()->index();
            $table->unsignedBigInteger('commentable_id')->index();
            $table->string('commentable_type');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('comment_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('comments')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });

            Schema::dropIfExists('comments');
        }
    }
}
