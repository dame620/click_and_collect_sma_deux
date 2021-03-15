<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabelandtrackingToPackageorenvelopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packageorenvelops', function (Blueprint $table) {
            $table->longText('labelbase64')->nullable();
            $table->string('trackingnumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packageorenvelops', function (Blueprint $table) {
            $table->dropColumn('labelbase64');
            $table->dropColumn('trackingnumber');
        });
    }
}
