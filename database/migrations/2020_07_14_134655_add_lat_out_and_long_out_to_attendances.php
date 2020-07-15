<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatOutAndLongOutToAttendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            //New two columns
            $table->double('lat_out')->after('lng');
            $table->double('long_out')->after('lat_out');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            //Drop columns if exists
            $table->dropColumn('lat_out');
            $table->dropColumn('long_out');
        });
    }
}
