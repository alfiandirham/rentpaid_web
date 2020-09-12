<?php

namespace App\Console\Commands;

use App\Http\Controllers\Controller;
use Illuminate\Console\Command;

class StatusTenantBelumDitagihCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:belum-ditagih';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status tenant aktif menjadi belum ditagih';

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
     * @return mixed
     */
    public function handle()
    {
        Controller::updateStatusTenantBelumDitagih();
    }
}
