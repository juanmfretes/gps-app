@extends('layouts.main')

@push('body-link')
<script src="{{ asset("js/app.js") }}"></script>
@endpush

@section('title', 'GPS App | Ver datos de la Empresa')

@section('content')

{{-- MODAL WINDOW PARA BORRAR UN VEHICULO --}}
<div class="modal fade" id="deleteEmpresa" tabindex="-1" aria-labelledby="deleteEmpresa" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Borrar Emprsa </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="deleteModalContent">¿Está seguro de que desea borrar la empresa {{ $empresa->razon_social }}?</p>
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
            <h2 class="mb-0">Datos de la empresa</h2>
        </div>
    </div>

    <div class="card-body pl-4">
        <div class="form-group d-flex">
            <label for="razon_social" class="col-md-4 col-form-label font-weight-bold">Razon Social</label>
            <div class="col-md-8">
                <p class="form-control-plaintext text-muted">{{ $empresa->razon_social }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="chapa" class="col-md-4 col-form-label font-weight-bold">Ruc</label>
            <div class="col-md-8">
                <p class="form-control-plaintext text-muted">{{ $empresa->ruc }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="marca" class="col-md-4 col-form-label font-weight-bold">Direccion</label>
            <div class="col-md-8">
                <p class="form-control-plaintext text-muted">{{ $empresa->direccion }}</p>
            </div>
        </div>

        <div class="form-group d-flex">
            <label for="modelo" class="col-md-4 col-form-label font-weight-bold">Telefono</label>
            <div class="col-md-8">
                <p class="form-control-plaintext text-muted">{{ $empresa->telefono }}</p>
            </div>
        </div>

        <div class="form-group d-flex justify-content-center row mx-1 mb-0">
            <a href="{{ route('components.empresas.edit', $empresa->id) }}" class="btn btn-outline-primary mr-2">Editar</a>
                <form style="display: inline;" class="deleteForm" method="POST" action="{{ route('components.empresas.destroy', $empresa->id) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger" id="btnDeleteEmpresaShow" data-toggle="modal" data-target="#deleteEmpresa">Borrar</button>
                </form>
            <a href="{{ route('components.empresas.index') }}" class="btn btn-outline-dark ml-2">Cancelar</a>
        </div>
    </div>
</div>

@endsection