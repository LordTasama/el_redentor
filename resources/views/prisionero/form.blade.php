<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombres" class="form-label">{{ __('Nombres') }}</label>
            <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres', $prisionero?->nombres) }}" id="nombres" placeholder="Nombres">
            {!! $errors->first('nombres', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="apellidos" class="form-label">{{ __('Apellidos') }}</label>
            <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos', $prisionero?->apellidos) }}" id="apellidos" placeholder="Apellidos">
            {!! $errors->first('apellidos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nacimiento" class="form-label">{{ __('Nacimiento') }}</label>
            <input type="datetime-local" name="nacimiento" class="form-control @error('nacimiento') is-invalid @enderror" value="{{ old('nacimiento', $prisionero?->nacimiento) }}" id="nacimiento" placeholder="Nacimiento">
            {!! $errors->first('nacimiento', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ingreso" class="form-label">{{ __('Ingreso') }}</label>
            <input type="datetime-local" name="ingreso" class="form-control @error('ingreso') is-invalid @enderror" value="{{ old('ingreso', $prisionero?->ingreso) }}" id="ingreso" placeholder="Ingreso">
            {!! $errors->first('ingreso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="delito" class="form-label">{{ __('Delito') }}</label>
            <input type="text" name="delito" class="form-control @error('delito') is-invalid @enderror" value="{{ old('delito', $prisionero?->delito) }}" id="delito" placeholder="Delito">
            {!! $errors->first('delito', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="celda" class="form-label">{{ __('Celda') }}</label>
            <input type="text" name="celda" class="form-control @error('celda') is-invalid @enderror" value="{{ old('celda', $prisionero?->celda) }}" id="celda" placeholder="Celda">
            {!! $errors->first('celda', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>