@extends('layouts.main')

@push('body-link')
<script src="{{ asset("js/app.js") }}"></script>
@endpush

@section('title', 'GPS APP | Vehiculos')

@section('content')

{{-- MODAL WINDOW PARA BORRAR UN VEHICULO --}}
<div class="modal fade" id="deleteVehicle" tabindex="-1" aria-labelledby="deleteVehicle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Borrar vehiculo </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="deleteModalContent"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnBorrarVehiculo">Borrar</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

{{-- CARD CON TABLA PARA MOSTRAR LOS VEHICULOS --}}
<div class="card" style="max-width: 1100px;">
  <h2 class="card-header card-title">Lista de Vehiculos</h2>

  <div class="card-body">
    <div class="table-responsive">
      <div class="row mx-1">
        <div class="col-lg-9 mb-2">
          {{-- BUSQUEDA --}}
          <form id="searchForm" action="#">
            <div class="d-flex">
              <input id="chapa" class="form-control mr-1" name="chapa" value="{{ request('chapa') }}" type="text" placeholder="Buscar por chapa" data-toggle="tooltip" data-placement="top" title="Chapa (AAA 000)">
              <input id="conductor" class="form-control mr-2" name="conductor" value="{{ request('conductor') }}" type="text" placeholder="Buscar conductor" data-toggle="tooltip" data-placement="top" title="Conductor">
              <button type="submit" class="btn btn-primary mr-1">Buscar</button>
              <button type="button" id="btnClearFields" class="btn btn-secondary mr-2">Limpiar</button>
            </div>
          </form>
        </div>

        <div class="col-lg-3">
          @if(auth()->user()->admin)
            <div class="d-flex justify-content-end">
              <a href="{{ route('components.vehiculos.create') }}" class="btn btn-success mb-2 mr-2"><i class="fa fa-plus-circle"></i> Nuevo Vehiculo</a>
            </div>
          @endif
        </div>
      </div>

      <div class="row mx-1">
        <div class="col-sm-12">
          <table class="table table-striped table-hover text-center container-lg">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Imei</th>
                      <th>Chapa</th>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Conductor</th>
                      <th>Empresa</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                {{-- ZONA PARA MOSTRAR MENSAJES ################ --}}
                @if($message = session('message'))
                  <div class="alert alert-success alert-dismissible fade show">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @elseif($message = session('error'))
                  <div class="alert alert-warning alert-dismissible fade show">
                    <h4 class="alert-heading">Atención!</h4>
                    <hr>
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                  @if($vehiculos)
                      {{-- {{dd($vehiculos);}} --}}
                      @foreach($vehiculos as $index => $vehiculo)
                        <tr>
                            <td>{{ $index + $vehiculos->firstItem() }}</td>
                            <td>{{ $vehiculo->imei }}</td>
                            <td>{{ $vehiculo->chapa }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->conductor }}</td>
                            <td>{{ $vehiculo->empresa->razon_social }}</td>
                            <td style="min-width: 100px;">
                                <a href="{{ route("components.vehiculos.show", $vehiculo->id) }}" class="view" title="Ver" data-toggle="tooltip"><i class="fa fa-fw fa-eye"></i></a>
                                <a href="{{ route("components.vehiculos.edit", $vehiculo->id) }}" class="edit px-2" title="Editar" data-toggle="tooltip"><i class="fa fa-fw fa-edit"></i></a>
                                @if(auth()->user()->admin)
                                  {{-- Hidden Delete form --}}
                                  <form class="deleteForm" style="display: inline;" method="POST" action="{{ route('components.vehiculos.destroy', $vehiculo->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btnFormDeleteVehicle" data-vehiculo-imei="{{ $vehiculo->imei }}" style="background: none; border: none; display: inline; padding: 0;" data-toggle="modal" data-target="#deleteVehicle"><i class="fa fa-fw fa-trash" style="color: red;"></i></b>
                                  </form>
                                @endif
                            </td>
                        </tr>
                      @endforeach
                  @endif
              </tbody>
          </table>
        </div>
      </div>

      <div class="row mx-1 d-flex justify-content-center">
        <div class="mt-4">{{ $vehiculos->appends(request()->only('chapa','conductor'))->links() }}</div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- Añadir footer --}}