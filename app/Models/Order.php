<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'maceradoras'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'customer_name', 'total_amount', 'order_date', // Lista de atributos que se pueden asignar masivamente
    ];

    // Relación con la tabla "clientes"
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación con la tabla "maceradoras"
    public function maceradora()
    {
        return $this->belongsTo(Maceradora::class, 'maceradora_id');
    }

    // Definir relaciones con otros modelos, si las hay
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}




