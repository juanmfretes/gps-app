@extends('layouts.main')

@section('title', 'GPS APP | Agregar Vehiculo')

@section('content')

<div class="card" style="max-width: 650px;">
  <h2 class="card-header card-title mb-0">Agregar Vehiculo</h2>

  <div class="card-body">
      <form action="{{ route('components.vehiculos.store') }}" method="POST" class="mx-auto" style="max-width: 400px;">
          @csrf
          @include('components.vehiculos._form')
      </form>
  </div>
</div>

@endsection