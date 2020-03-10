<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoIpCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_ip_country', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('start_ip_octet');
            $table->ipAddress('end_ip_octet');
            $table->unsignedInteger('start_ip_integer');
            $table->unsignedInteger('end_ip_integer');
            $table->string('country_code', 2);
            $table->string('country_name', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_ip_country');
    }
}
