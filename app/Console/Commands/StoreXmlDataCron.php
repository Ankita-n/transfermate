<?php

namespace App\Console\Commands;

use App\Repositories\SaveDataInterface;
use Illuminate\Console\Command;

class StoreXmlDataCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storeData:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch the data from xml and store in db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $saveData;
    public function __construct(SaveDataInterface $saveData)
    {
        parent::__construct();
        $this->saveData = $saveData;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->saveData->featchAndStoreData();
        \Log::info("xml data store successfully");
    }
}
