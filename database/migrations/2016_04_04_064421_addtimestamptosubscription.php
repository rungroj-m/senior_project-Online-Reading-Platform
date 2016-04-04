<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addtimestamptosubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //$table->timestamps();
        Schema::table('subscriptions', function (Blueprint $table) {
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
      Schema::table('subscriptions', function (Blueprint $table) {
          $table->dropColumn(['update_at', 'create_at']);
      });
    }
}
