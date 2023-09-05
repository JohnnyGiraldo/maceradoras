<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'maceradoras'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'customer_name', 'total_amount', 'order_date', // Lista de atributos que se pueden asignar masivamente
    ];

    // Definir relaciones con otros modelos, si las hay
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}



