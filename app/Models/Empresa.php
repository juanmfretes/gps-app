<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa';

    protected $fillable = ['razon_social', 'ruc', 'direccion', 'telefono'];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
