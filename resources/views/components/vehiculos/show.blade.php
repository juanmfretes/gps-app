@extends('layouts.main')

@push('body-link')
<script src="{{ asset("js/app.js") }}"></script>
@endpush

@section('title', 'GPS App | Ver datos del Vehículo')

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
        <p id="deleteModalContent">¿Está seguro de que desea borrar el vehículo con el Imei {{ $vehiculo->imei }}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnModalBorrarVehiculo">Borrar</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="card" style="max-width: 500px;">
    <div class="card-header card-title">
        <div class="d-flex align-items-center">
            <h2 class="mb-0">Datos del vehiculo</h2>
        </div>
    </div>

    <div class="card-body pl-4">
        <div class="form-group d-flex">
            <label for="imei" class="col-md-3 col-form-label font-weight-bold">Imei</label>
            <div class="col-md-9">
                <p class="form-control-plaintext text-muted">{{ $vehiculo->imei }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="chapa" class="col-md-3 col-form-label font-weight-bold">Chapa</label>
            <div class="col-md-9">
                <p class="form-control-plaintext text-muted">{{ $vehiculo->chapa }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="marca" class="col-md-3 col-form-label font-weight-bold">Marca</label>
            <div class="col-md-9">
                <p class="form-control-plaintext text-muted">{{ $vehiculo->marca }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="modelo" class="col-md-3 col-form-label font-weight-bold">Modelo</label>
            <div class="col-md-9">
                <p class="form-control-plaintext text-muted">{{ $vehiculo->modelo }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="usuario" class="col-md-3 col-form-label font-weight-bold">Usuario</label>
            <div class="col-md-9">
                <p class="form-control-plaintext text-muted">{{ $vehiculo->conductor }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="empresa" class="col-md-3 col-form-label font-weight-bold">Empresa</label>
            <div class="col-md-9">
                <p class="form-control-plaintext text-muted">{{ $vehiculo->empresa->razon_social }}</p>
            </div>
        </div>

        {{-- <button type="submit" class="btn btn-primary">Crear</button> --}}
        <div class="form-group d-flex justify-content-center row mx-1 mb-0">
            <a href="{{ route('components.vehiculos.edit', $vehiculo->id) }}" class="btn btn-outline-primary mr-2">Editar</a>
            @if(auth()->user()->admin)
                <form style="display: inline;" class="deleteForm" method="POST" action="{{ route('components.vehiculos.destroy', $vehiculo->id) }}">
                    @csrf
                    @method('DELETE')
                    
                    <button class="btn btn-outline-danger" id="btnDeleteVehicleShow" data-toggle="modal" data-target="#deleteVehicle">Borrar</button>
                </form>
            @endif
            <a href="{{ route('components.vehiculos.index') }}" class="btn btn-outline-dark ml-2">Cancelar</a>
        </div>
    </div>
</div>

@endsection