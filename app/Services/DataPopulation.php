<?php


namespace App\Services;


use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DataPopulation
{

    /**
     * Location to download data from
     * @var string
     */
    protected $zipUrl = 'https://php-dev-task.s3-eu-west-1.amazonaws.com/GeoIPCountryCSV.zip';

    /**
     * Location to store zip file
     * @var string
     */
    protected $storeZipFile = 'geoipcountrycsv.zip';

    /**
     * @var string
     */
    protected $storeCsv;

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

    /**
     * Download data and store zip file
     * Assume we want to download a fresh copy
     */
    public function downloadFile(): void
    {
        $client = new Client();
        $response = $client->get($this->zipUrl);
        Storage::put($this->storeZipFile, $response->getBody());
    }

    /**
     * Extract csv file from the zip archive
     * @throws Exception
     */
    public function extractCSV()
    {
        $zipFile = storage_path('app/'.$this->storeZipFile);

        $zip = new ZipArchive();
        if ($zip->open($zipFile) === true) {
            $zip->extractTo(storage_path('app/'));

            // Get the filename of the csv, assuming one file is in the zip (index of 0)
            $this->storeCsv = $zip->statIndex(0)['name'];

            $zip->close();
        } else {
            throw new Exception('Failed to extract CSV');
        }
    }

    public function populateData()
    {
        $file = storage_path('app/').$this->storeCsv;
        $query = "LOAD DATA LOCAL INFILE '".$file."'
            INTO TABLE geo_ip_country
            FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
            LINES TERMINATED BY '\n'
            (start_ip_octet,
            end_ip_octet,
            start_ip_integer,
            end_ip_integer,
            country_code,
            country_name
            )";
        DB::connection()->getpdo()->exec($query);

        echo DB::table('geo_ip_country')->count();
    }
}
