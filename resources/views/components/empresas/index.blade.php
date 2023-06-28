@extends('layouts.main')

@push('body-link')
<script src="{{ asset("js/app.js") }}"></script>
@endpush

@section('title', 'GPS APP | Empresas')

@section('content')

{{-- MODAL WINDOW PARA BORRAR UNA EMPRESA --}}
<div class="modal fade" id="deleteEmpresa" tabindex="-1" aria-labelledby="deleteEmpresa" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Borrar empresa </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="deleteModalContent"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnBorrarEmpresa">Borrar</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

{{-- CARD CON TABLA PARA MOSTRAR LAS EMPRESAS --}}
<div class="card" style="max-width: 1100px;">
  <h2 class="card-header card-title">Lista de Empresas</h2>

  <div class="card-body">
    <div class="table-responsive">
      <div class="row mx-1">
        <div class="col-lg-9 mb-2">
          {{-- BUSQUEDA --}}
          <form id="searchForm" action="#">
            <div class="d-flex">
              <input id="razon_social" class="form-control mr-1" name="razon_social" value="{{ request('razon_social') }}" type="text" placeholder="Buscar por Razon Social" data-toggle="tooltip" data-placement="top" title="Razon social">
              <input id="ruc" class="form-control mr-2" name="ruc" value="{{ request('ruc') }}" type="text" placeholder="Buscar por Ruc" data-toggle="tooltip" data-placement="top" title="Ruc">
              <button type="submit" class="btn btn-primary mr-1">Buscar</button>
              <button type="button" id="btnClearFields" class="btn btn-secondary mr-2">Limpiar</button>
            </div>
          </form>
        </div>

        <div class="col-lg-3">
          <div class="d-flex justify-content-end">
            <a href="{{ route('components.empresas.create') }}" class="btn btn-success mb-2 mr-2"><i class="fa fa-plus-circle"></i> Nueva Empresa</a>
          </div>
        </div>
      </div>

      <div class="row mx-1">
        <div class="col-sm-12">
          <table class="table table-striped table-hover text-center container-lg">
            <thead>
              <tr>
                <th>#</th>
                <th>Razon Social</th>
                <th>Ruc</th>
                <th>Direccion</th>
                <th>Telefono</th>
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

              @if($empresas)
                {{-- {{dd($empresas);}} --}}
                @foreach($empresas as $index => $empresa)
                  <tr>
                    {{-- <td>{{ $index + $empresas->firstItem() }}</td> --}}
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $empresa->razon_social }}</td>
                    <td>{{ $empresa->ruc }}</td>
                    <td>{{ $empresa->direccion }}</td>
                    <td>{{ $empresa->telefono }}</td>
                    <td style="min-width: 100px;">
                      <a href="{{ route("components.empresas.show", $empresa->id) }}" class="view" title="Ver" data-toggle="tooltip"><i class="fa fa-fw fa-eye"></i></a>
                      <a href="{{ route("components.empresas.edit", $empresa->id) }}" class="edit px-2" title="Editar" data-toggle="tooltip"><i class="fa fa-fw fa-edit"></i></a>
                      {{-- Hidden Delete form --}}
                      <form class="deleteForm" style="display: inline;" method="POST" action="{{ route('components.empresas.destroy', $empresa->id) }}">
                        @csrf
                        @method('DELETE')
                        {{-- <button class="btnFormDeleteEmpresa" data-razon-social="{{ $empresa->razon_social }}" style="background: none; border: none; display: inline; padding: 0;" data-toggle="modal" data-target="#deleteEmpresa"><i class="fa fa-fw fa-trash" style="color: red;"></i></b> --}}
                        <button class="btnFormDeleteEmpresa" data-razon-social="{{ $empresa->razon_social }}" style="background: none; border: none; display: inline; padding: 0;"><i class="fa fa-fw fa-trash" style="color: red;"></i></b>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>

      <div class="row mx-1 d-flex justify-content-center">
        {{-- <div class="mt-4">{{ $empresas->appends(request()->only('razon_social','ruc'))->links() }}</div> --}}
      </div>
    </div>
  </div>
</div>
@endsection

{{-- Añadir footer --}}