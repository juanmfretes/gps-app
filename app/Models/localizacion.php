<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class localizacion extends Model
{
    use HasFactory;

    protected $table = 'localizaciones';
    protected $fillable = ['lat', 'lng', 'speed', 'fechaHora', 'imei'];

    public function vehiculo() {
        return $this->belongsTo(Vehiculo::class);
    }
}
