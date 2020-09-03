<?php

namespace App\Console\Commands;

use App\Http\Controllers\Controller;
use Illuminate\Console\Command;

class CekTunggakanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tunggakan:cek';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek Jika ada yang belum ditagih auto menunggak';

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
        Controller::cekTunggakan();
    }
}
