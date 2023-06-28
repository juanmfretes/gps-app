<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function localizaciones()
    {
        return view('components.mapas.localizaciones');
    }

    public function notificaciones()
    {
        $allVehicles = Vehiculo::with(['empresa:id,razon_social'])->select('id', 'imei', 'chapa', 'empresa_id')->orderBy('empresa_id',  'DESC');
        // Condición para usuarios NORMALES (Sólo pueden ver vehículos de su empresa)
        if (!auth()->user()->admin) $allVehicles->where('empresa_id', auth()->user()->empresa_id);

        $allVehicles = $allVehicles->orderBy('chapa',  'ASC')->get()->all();
        $filterOptions = [];
        $filterOptions[""] = auth()->user()->admin ? "Empresa - Chapa - Imei" : "Chapa - Imei";
        foreach ($allVehicles as $index => $vehicle) {
            $filterOptions[$vehicle['id']] = "{$vehicle->empresa->razon_social} - {$vehicle->chapa} - {$vehicle->imei}";
        }
        // array_unshift($filterOptions, "" => "Empresa - Chapa - Imei");

        return view('components.mapas.notificaciones', compact('filterOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
