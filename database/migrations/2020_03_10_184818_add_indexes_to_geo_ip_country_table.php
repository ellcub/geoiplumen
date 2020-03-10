<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToGeoIpCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'geo_ip_country',
            function (Blueprint $table) {
                $table->index('start_ip_integer');
                $table->index('end_ip_integer');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'geo_ip_country',
            function (Blueprint $table) {
                $table->dropIndex('geo_ip_country_start_ip_integer_index');
                $table->dropIndex('geo_ip_country_end_ip_integer_index');
            }
        );
    }
}
