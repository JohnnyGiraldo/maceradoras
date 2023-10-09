<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TestTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Test:Task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' Verifica las fechas de mantenimiento de las maceradoras y envía notificaciones si es necesario.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $texto = "[" . date("Y-m-d H:i:s") ."] Debes hacerle mantenimiento a la maceradora; ";
        Storage::append('file.txt', $texto);
    }
}
