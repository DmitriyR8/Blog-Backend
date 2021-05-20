<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSingleReviewsHardcodeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('single_reviews', function (Blueprint $table) {
            $table->unique('hardcode_id');
            $table->index('hardcode_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('single_reviews', function (Blueprint $table) {
            $table->dropUnique('single_reviews_hardcode_id_unique');
            $table->dropIndex('single_reviews_hardcode_id_index');
            $table->integer('hardcode_id')->change();
        });
    }
}
