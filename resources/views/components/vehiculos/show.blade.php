@extends('layouts.main')

@section('title', 'GPS App | Ver datos del Vehículo')

@section('content')

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
            <a href="{{ route('components.vehiculos.edit', $vehiculo->id) }}" class="btn btn-outline-primary mr-2">Edit</a>
            @if(auth()->user()->admin)
                <form style="display: inline;" method="POST" action="{{ route('components.vehiculos.destroy', $vehiculo->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger">Delete</button>
                </form>
            @endif
            <a href="{{ route('components.vehiculos.index') }}" class="btn btn-outline-dark ml-2">Cancel</a>
        </div>
    </div>
</div>

@endsection