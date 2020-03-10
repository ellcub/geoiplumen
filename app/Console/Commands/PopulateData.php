<?php


namespace App\Console\Commands;

use App\Services\DataPopulation;
use Exception;
use Illuminate\Console\Command;

class PopulateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the Geo IP Country Whois data table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  DataPopulation  $dp
     */
    public function handle(DataPopulation $dp): void
    {
        try {
            $dp->execute();
        } catch (Exception $e) {
            $this->error("An error occurred:");
            $this->info($e->getMessage());
        }
    }
}
