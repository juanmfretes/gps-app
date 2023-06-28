<?php

namespace App\Http\Controllers;

use App\Models\localizacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalizacionController extends Controller
{
    public function getLastLocation()
    {
        // Obtener la última localización que se guardó en la DB para cada IMEI

        $imeiList = localizacion::distinct('vehiculo_id')->select('vehiculo_id')->orderBy('vehiculo_id')->get()->all();

        // Condición para usuarios NORMALES (Sólo pueden ver los vehículos de su empresa)

        $lastLocations = [];

        foreach ($imeiList as $index => $value) {
            $currentVehiculoId = $value['vehiculo_id'];
            // Obtener las última localización de un vehículo específico
            $lastLocation = localizacion::with(['vehiculo:id,imei,conductor,marca,modelo,chapa,empresa_id'])->where('vehiculo_id', $currentVehiculoId)->orderBy('fechaHora', 'DESC')->first();

            $lastLocations[] = [
                'imei' => $lastLocation['vehiculo']['imei'],
                'lat' => $lastLocation['lat'],
                'lng' => $lastLocation['lng'],
                'conductor' => $lastLocation['vehiculo']['conductor'],
                'vehiculo' => "{$lastLocation['vehiculo']['marca']} {$lastLocation['vehiculo']['modelo']}",
                'chapa' => $lastLocation['vehiculo']['chapa'],
                'empresa_id' => $lastLocation['vehiculo']['empresa_id'],
                'speed' => $lastLocation['speed'],
                'fechaHora' => $lastLocation['fechaHora']
            ];
        }

        return response()->json($lastLocations);
    }

    public function store(Request $request)
    {
        // Request contiene: imei, lat, lng, speed, fechaHora
        // Tabla DB: lat, lng, speed, fechaHora, vehiculo_id

        // validacion de 'vehiculo_id' (imei) y 'fechaHora' (para no insertar un duplicado)
        $vehiculoId = Vehiculo::where('imei', $request['imei'])->first()->id;
        $fechaHora = $request['fechaHora'];

        $listaLocalizaciones = localizacion::where('vehiculo_id', $vehiculoId)->where('fechaHora', $fechaHora)->get()->all();
        // Si no es cero => ya existe dicho registro
        if (count($listaLocalizaciones) > 0) {
            return;
            // AGREGAR UNA EXCEPTION
        }

        // Crear el nuevo registro para agregar a 'localizaciones'
        $nuevaLocalizacion = new Localizacion();
        $nuevaLocalizacion->lat = $request['lat'];
        $nuevaLocalizacion->lng = $request['lng'];
        $nuevaLocalizacion->speed = $request['speed'];
        $nuevaLocalizacion->fechaHora = $request['fechaHora'];
        $nuevaLocalizacion->vehiculo_id = $vehiculoId;

        // Guardar $nuevoRegistro en la tabla 'localizaciones'
        $nuevaLocalizacion->save();

        // $response = ['ok' => 'ok'];
        return response(json_encode(['ok' => 'ok']));
    }
}
