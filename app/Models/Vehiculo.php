<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = ['imei', 'chapa', 'marca', 'modelo', 'conductor', 'empresa_id'];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function notificaciones() {
        return $this->hasMany(Notificacion::class);
    }
    
    public function localizaciones() {
        return $this->hasMany(localizacion::class);
    }

    
}
