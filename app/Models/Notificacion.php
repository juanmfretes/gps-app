<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';
    protected $fillable = ['imei', 'lat', 'lng', 'codigo', 'fechaHora'];

    public function vehiculo() {
        return $this->belongsTo(Vehiculo::class);
    }

    
}
