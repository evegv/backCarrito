<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $table = 'carrito';
    protected $primaryKey = 'idCarrito';
    protected $fillable = ['total'];
    public $timestamps = false;

    public function compraproducto()
    {
        return $this->hasMany(CompraProducto::class, 'idCarrito');
    }
}
