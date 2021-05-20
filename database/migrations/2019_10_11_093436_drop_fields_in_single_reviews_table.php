<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFieldsInSingleReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('single_reviews', function (Blueprint $table) {
            $table->string('slug')->after('id')->index();
            $table->unique('slug');
            $table->renameColumn('text','main_text');
            $table->dropColumn('main_quote');
            $table->dropColumn('img_main_quote');
            $table->dropColumn('alt_main_quote_img');
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
            $table->dropUnique('single_reviews_slug_unique');
            $table->dropIndex('single_reviews_slug_index');
            $table->dropColumn('slug');
            $table->renameColumn('main_text', 'text');
            $table->longText('main_quote')->after('back_alt_img');
            $table->string('img_main_quote')->after('main_quote')->nullable();
            $table->string('alt_main_quote_img')->after('img_main_quote')->nullable();
        });
    }
}
