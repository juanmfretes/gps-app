@extends('layouts.main')

@section('title', 'GPS APP | Agregar Empresa')

@section('content')

<div class="card" style="max-width: 650px;">
  <h2 class="card-header card-title mb-0">Agregar Empresa</h2>

  <div class="card-body">
      <form action="{{ route('components.empresas.store') }}" method="POST" class="mx-auto" style="max-width: 400px;">
          @csrf
          @include('components.empresas._form')
      </form>
  </div>
</div>

@endsection