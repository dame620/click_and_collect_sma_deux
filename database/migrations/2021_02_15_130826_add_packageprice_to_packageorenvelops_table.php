<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackagepriceToPackageorenvelopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packageorenvelops', function (Blueprint $table) {
            
            $table->integer('packageprice')->nullable();

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
            $table->dropColumn('packageprice');

        });
    }
}
