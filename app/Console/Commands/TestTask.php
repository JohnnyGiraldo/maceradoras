<?php

namespace App\Console\Commands;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Maceradora;
use ArrayObject;


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
    public static function handle()
    {
        $limiteMantenimiento = Carbon::now()->subMonths(6)->subDays(6);

        // Consulta las maceradoras que necesitan mantenimiento
        $maceradoras = Maceradora::where('fechaInstalacion', '<=', $limiteMantenimiento)->get();

        // Genera notificaciones para cada maceradora
        $maceradoras = DB::table('maceradoras')
        ->join('clientes', 'maceradoras.cliente_id', '=', 'clientes.id')
        ->select('maceradoras.serial', 'maceradoras.modelo', 'maceradoras.fechaInstalacion','maceradoras.fechaMantenimiento', 'clientes.institucion')
        ->where('maceradoras.fechaInstalacion', '<=', $limiteMantenimiento)
        ->get();

        
        $lista =  new ArrayObject();

        foreach ($maceradoras as $maceradora) {
            // Aquí puedes generar y registrar las notificaciones
            // Por ejemplo, puedes guardar los detalles en un archivo de texto
            $fechaActual = new DateTime ("".date("Y-m-d"));
            $fechaMantenimiento =  new DateTime($maceradora->fechaMantenimiento);
            $intervalo =$fechaActual->diff($fechaMantenimiento);
            $numMeses = ($intervalo->y*12)+$intervalo->m;

            if($numMeses>=6){

                $notificacion = [
                    'serial' => $maceradora->serial,
                    'mesesSinMantenimiento' => $numMeses,
                    'modelo' => $maceradora->modelo,
                    'fechaInstalacion' => $maceradora->fechaInstalacion,
                    'institucion' => $maceradora->institucion,
                ];

                $lista->append($notificacion);

                //$texto = "Serial: {$maceradora->serial},Meses sin mantenimiento:{$numMeses}, Modelo: {$maceradora->modelo}, Fecha de Instalación: {$maceradora->fechaInstalacion},  Institución: {$maceradora->institucion}, ";
                
                //Storage::append('file.txt', $texto );

            }

           // Storage::append('file.txt', count($lista));
        }
        // Puedes agregar código adicional para enviar notificaciones por correo electrónico, almacenar en la base de datos, etc.

        //$this->info('Notificaciones de mantenimiento generadas con éxito.');
        
        return $lista;
    }
}