<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentRatings', function (Blueprint $table) {
            $table->renameColumn('commentRatingKey', 'id');
            $table->renameColumn('commentKey', 'comment_id');
            $table->renameColumn('userKey', 'user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commentRatings', function (Blueprint $table) {
            //
        });
    }
}
