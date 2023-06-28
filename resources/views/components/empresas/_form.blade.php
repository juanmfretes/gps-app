<div class="form-group">
    <label for="razon_social" class="col-form-label">Razon Social</label>
    <input id="razon_social" type="text" name="razon_social" value="{{ isset($empresa) ? $empresa->razon_social : '' }}" pattern="[ 0-9A-Z.]+" id="razon_social" title="Introduzca Razon Social en MAYUSCULAS" class="form-control @error('razon_social') is-invalid @enderror">
    @error('razon_social')
    <div class="invalid-feedback">
        La empresa ya existe. Favor modifique el nombre.
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="ruc" class="col-form-label">Ruc</label>
    <input id="ruc" type="text" name="ruc" value="{{ isset($empresa) ? $empresa->ruc : '' }}" pattern="[0-9]{5,}-[0-9]{1}" title="Introduzca Ruc" class="form-control @error('ruc') is-invalid @enderror" required>
    @error('ruc')
    <div class="invalid-feedback">
        El ruc ya existe. Favor verifique que sea el correcto.
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="direccion" class="col-form-label">Direccion</label>
    <input id="direccion" type="text" name="direccion" value="{{ isset($empresa) ? $empresa->direccion : '' }}" title="Introduzca Direccion" class="form-control" required>
</div>

<div class="form-group">
    <label for="telefono" class="col-form-label">Telefono</label>
    <input id="telefono" type="text" name="telefono" value="{{ isset($empresa) ? $empresa->telefono : '' }}" pattern="[0-9]{6,}" title="Introduzca Telefono (sin espacios ni separadores)" class="form-control @error('telefono') is-invalid @enderror" required>
    @error('telefono')
    <div class="invalid-feedback">
        El telefono ya existe. Favor verifique que sea el correcto.
    </div>
    @enderror
</div>

<div class="form-group d-flex justify-content-center mt-5">
    <button type="submit" class="btn btn-primary mr-2">{{ isset($empresa) ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('components.empresas.index') }}" class="btn btn-secondary">Cancelar</a>
</div>