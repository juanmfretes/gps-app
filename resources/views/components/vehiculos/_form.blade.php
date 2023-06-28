<div class="form-group">
    <label for="imei" class="col-form-label">Imei</label>
    <input id="imei" maxlength="10" type="text" name="imei" value="{{ isset($vehiculo) ? $vehiculo->imei : '' }}" id="imei" pattern="[0-9]{10}" title="Introduzca Imei (10 dígitos)" class="form-control @error('imei') is-invalid @enderror">
    @error('imei')
    <div class="invalid-feedback">
        Imei ya existente.
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="chapa" class="col-form-label">Chapa</label>
    <input id="chapa" type="text" name="chapa" value="{{ isset($vehiculo) ? $vehiculo->chapa : '' }}" pattern="[A-Z]{3,4} [0-9]{3}" title="Introduzca Chapa (Formato AAA 111)" class="form-control @error('chapa') is-invalid @enderror" required>
    @error('chapa')
    <div class="invalid-feedback">
        Chapa ya existente.
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="marca" class="col-form-label">Marca</label>
    <input id="marca" type="text" name="marca" value="{{ isset($vehiculo) ? $vehiculo->marca : '' }}" title="Introduzca Marca del Vehiculo" class="form-control" required>
</div>

<div class="form-group">
    <label for="modelo" class="col-form-label">Modelo</label>
    <input id="modelo" type="text" name="modelo" value="{{ isset($vehiculo) ? $vehiculo->modelo : '' }}" title="Introduzca Modelo del Vehiculo" class="form-control" required>
</div>

<div class="form-group">
    <label for="conductor" class="col-form-label">Conductor</label>
    <input id="conductor" type="text" name="conductor" value="{{ isset($vehiculo) ? $vehiculo->conductor : '' }}" title="Introduzca Nombre y Apellido del Conductor" class="form-control @error('conductor') is-invalid @enderror" required>
    @error('conductor')
    <div class="invalid-feedback">
        Un conductor no puede conducir más de 1 vehículo.
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="input-select-empresa">Empresa</label>
    <select class="form-control" id="input-select-empresa" name="empresa_id" required>
        @foreach ($empresas as $id => $empresa)
            @if(isset($vehiculo))
                <option {{ $id === $vehiculo->empresa_id ? 'selected' : '' }} value="{{ $id }}">{{ $empresa }}</option>                
            @else
                <option value="{{ $id }}">{{ $empresa }}</option>                
            @endif
        @endforeach
    </select>
</div>

<div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary mr-2">{{ isset($vehiculo) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('components.vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
</div>