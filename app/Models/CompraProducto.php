<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProducto extends Model
{
    use HasFactory;
    protected $table = 'compra_producto';
    protected $primaryKey = 'idCompraProducto';
    protected $fillable = [
        'idCarrito', 'idProducto',
        'cantidad', 'precio'
    ];
    public $timestamps = false;

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'idCarrito');
    }
}
