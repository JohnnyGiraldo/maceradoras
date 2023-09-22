<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['pais', 'ciudad','institucion', 'email','telefono','direccion','id'];
  
}
