<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        $empresas = Empresa::orderBy('razon_social', 'ASC');

        // BUSQUEDA DE RAZON SOCIAL ###########################
        if ($razon_social = $request->razon_social)
            $empresas->where('razon_social', 'ilike', "%$razon_social%");

        // BUSQUEDA DE RUC ###########################
        if ($ruc = $request->ruc)
            $empresas->where('ruc', 'ILIKE', "%$ruc%");

        // PAGINACION
        $empresas =  $empresas->paginate(4);
        return view('components.empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('components.empresas.create');
    }

    public function edit($id)
    {
        $empresa = Empresa::find($id);

        return view('components.empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        // Para verificar que siga siendo único y no de errores se usa el método '->ignore()'
        $request->validate([
            'razon_social' => ['required', Rule::unique('empresa', 'razon_social')->ignore($empresa->id)], // unico
            'ruc' => ['required', Rule::unique('empresa', 'ruc')->ignore($empresa->id)], // unico
            'direccion' => 'required|string',
            'telefono' => ['required', Rule::unique('empresa', 'telefono')->ignore($empresa->id)], // unico
        ]);

        info('pasó la validación del update');

        $empresa->update($request->all());

        return redirect()->route('components.empresas.index')->with('message', 'La empresa ha sido modificada exitosamente');
    }

    public function show($id)
    {
        $empresa = Empresa::find($id);

        return view('components.empresas.show', compact('empresa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'razon_social' => 'required|unique:empresa,razon_social', // único
            'ruc' => 'required|unique:empresa,ruc', // único
            'direccion' => 'required|string',
            'telefono' => 'required|unique:empresa,telefono', // único
        ]);

        Empresa::create($request->all());

        return redirect()->route('components.empresas.index')->with('message', 'La empresa ha sido añadida exitosamente.');
    }

    public function destroy($id)
    {
        try {
            $empresa = Empresa::find($id);

            // Verificar que no tenga datos asociados
            $users = $empresa->users->all();
            $vehiculos = $empresa->vehiculos->all();

            if (count($users) !== 0 || count($vehiculos) !== 0) {
                return redirect()->route('components.empresas.index')->with('error', 'No se puede borrar la empresa ya que posee Usuarios y/o Vehiculos. Borrar datos asociados primero.');
            }

            $empresa->delete();

            return redirect()->route('components.empresas.index')->with('message', 'La empresa ha sido eliminada exitosamente.');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
