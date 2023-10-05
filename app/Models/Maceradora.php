<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maceradora extends Model
{
    use HasFactory;
    
    // Indicar que la columna 'serial' es la clave primaria
    protected $primaryKey = 'serial';
    
    // Deshabilitar incremento automático de ID
    public $incrementing = false;

    protected $fillable = [
        'serial','modelo','estado','fechaFabricacion','tipoAsistencia',
        'fechaInstalacion','tipoMantenimiento','fechaMantenimiento',
        'tipoPieza','fechaCambioPieza','numeroCiclos','fechaIncidente',
        'observaciones','cliente_id'
    ];
}

