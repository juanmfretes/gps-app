<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
    public function index(Request $request)
    {
        $vehiculos = Vehiculo::with(['empresa:id,razon_social']);
        // dd($request->conductor);

        // SI NO ES ADMIN => SOLO VE SU EMPRESA
        if (!auth()->user()->admin)
            $vehiculos->where('empresa_id', auth()->user()->empresa_id);

        // BUSQUEDA DE CHAPA ###########################
        if ($chapa = $request->chapa)
            $vehiculos->where('chapa', 'ilike', "%$chapa%");

        // BUSQUEDA DE CONDUCTOR ###########################
        if ($conductor = $request->conductor)
            $vehiculos->where('conductor', 'ILIKE', "%$conductor%");

        $vehiculos->select('id', 'imei', 'chapa', 'marca', 'modelo', 'conductor', 'empresa_id',)->orderBy('imei', 'ASC');
        $vehiculos =  $vehiculos->paginate(2);
        // dd($vehiculos);
        return view('components.vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $empresas = Empresa::orderBy('razon_social', 'ASC')->pluck('razon_social', 'id')->all();
        $empresas = array('' => 'Seleccione una empresa') + $empresas;

        return view('components.vehiculos.create', compact('empresas'));
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::find($id);

        $empresas = Empresa::orderBy('razon_social', 'ASC')->pluck('razon_social', 'id')->all();
        $empresas = array('' => 'Seleccione una empresa') + $empresas;

        return view('components.vehiculos.edit', compact('vehiculo', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);

        $request->validate([
            'imei' => ['required', Rule::unique('vehiculos', 'imei')->ignore($vehiculo->id)], // unique --- su longitud ya se verifica en el <form>
            'chapa' => ['required', Rule::unique('vehiculos', 'chapa')->ignore($vehiculo->id)], //unique
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'conductor' => ['required', Rule::unique('vehiculos', 'conductor')->ignore($vehiculo->id)], // unique
            'empresa_id' => 'required|exists:empresa,id'
        ]);

        // $vehiculo->update($request->validated()); // trae solo los campos validados
        $vehiculo->update($request->all());

        return redirect()->route('components.vehiculos.index')->with('message', 'El vehiculo ha sido modificado exitosamente');
    }

    public function show($id)
    {
        $vehiculo = Vehiculo::with('empresa:id,razon_social');
        $vehiculo->select('id', 'imei', 'chapa', 'marca', 'modelo', 'conductor', 'empresa_id');
        $vehiculo = $vehiculo->find($id);
        // dd($vehiculo);

        return view('components.vehiculos.show', compact('vehiculo'));
    }

    public function store(Request $request)
    {
        info($request);
        // dd($request);

        $request->validate([
            'imei' => 'required|unique:vehiculos,imei', // su longitud ya se verifica en el <form>
            'chapa' => 'required|string|unique:vehiculos,chapa',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'conductor' => 'required|string|unique:vehiculos,conductor',
            'empresa_id' => 'required|exists:empresa,id'
        ]);

        info('pasó la validación del vehículo');
        // $newVehicle = new Vehiculo();
        // $newVehicle->fill($request->all());
        // $newVehicle->save();
        Vehiculo::create($request->all());

        return redirect()->route('components.vehiculos.index')->with('message', 'El vehiculo ha sido añadido exitosamente.');
    }

    public function destroy($id)
    {
        try {
            $vehiculo = Vehiculo::find($id);
            $notificaciones = $vehiculo->notificaciones->all();
            $localizaciones = $vehiculo->localizaciones->all();

            // Verificar que no tenga datos asociados
            if (count($notificaciones) !== 0 || count($localizaciones) !== 0) {
                return redirect()->route('components.vehiculos.index')->with('error', 'No se puede borrar el vehículo ya que posee Localizaciones y/o Notificaciones. Borrar datos asociados primero.');
            }

            $vehiculo->delete();

            return redirect()->route('components.vehiculos.index')->with('message', 'El vehículo ha sido eliminado exitosamente.');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
