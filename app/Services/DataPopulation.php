<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class DataPopulation
{
    /**
     * Check whether a table has any records
     *
     * @param  string  $table
     * @return bool
     */
    public function checkDataIsPopulated($table = 'geo_ip_country'): bool
    {
        return (bool)DB::table($table)->count();
    }
}
