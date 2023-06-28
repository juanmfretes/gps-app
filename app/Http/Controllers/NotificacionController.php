<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function getAllNotifications(string $vehicleId)
    {
        // Obtener notificaciones a partir del vehicleId (vehiculo_id)
        $id = (int) $vehicleId;
        $allNotifications = Notificacion::with(['vehiculo:id,conductor,marca,modelo'])->select('id', 'lat', 'lng', 'codigo', 'fechaHora', 'vehiculo_id')->where('vehiculo_id', $id)->get()->all();

        $notifications = [];
        foreach ($allNotifications as $notification) {
            $notifications[] = [
                'id' => $notification['id'],
                'lat' => $notification['lat'],
                'lng' => $notification['lng'],
                'codigo' => $notification['codigo'],
                'fechaHora' => $notification['fechaHora'],
                'conductor' => $notification['vehiculo']['conductor'],
                'vehiculo' => "{$notification['vehiculo']['marca']} {$notification['vehiculo']['modelo']}"
            ];
        }

        return response()->json($notifications);
    }

    public function store(Request $request)
    {
        // Request contiene: imei, lat, lng, codigo, fechaHora
        // Tabla DB: lat, lng, codigo, fechaHora, vehiculo_id

        // Validar 'imei' y 'fechaHora' (para no insertar duplicado)
        $vehiculoId = Vehiculo::where('imei', $request['imei'])->first()->id;
        $fechaHora = $request['fechaHora'];
        $codigo = $request['codigo'];

        // PREGUNTAR: SE TIENE EN CUENTA EL CÓDIGO PARA LA VERIFICACIÓN???
        $listaNotificaciones = Notificacion::where('vehiculo_id', $vehiculoId)->where('fechaHora', $fechaHora)->where('codigo', $codigo)->get()->all();

        // Si no es cero => ya existe dicho registro
        if (count($listaNotificaciones) > 0) {
            return;
            // AGREGAR UNA EXCEPTION
        }

        // Crear el nuevo registro para agregar a 'notificaciones'
        $nuevoRegistro = $request->all();

        // Insertar nueva Notificacion en la tabla
        $nuevaNotificacion = new Notificacion();
        $nuevaNotificacion->lat = $request['lat'];
        $nuevaNotificacion->lng = $request['lng'];
        $nuevaNotificacion->codigo = $request['codigo'];
        $nuevaNotificacion->fechaHora = $request['fechaHora'];
        $nuevaNotificacion->vehiculo_id = $vehiculoId;

        $nuevaNotificacion->save();

        // Enviar response
        return response(json_encode(['ok' => 'ok']));
    }
}
