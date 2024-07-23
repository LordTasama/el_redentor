<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="visitante_id" class="form-label">{{ __('Visitante Id') }}</label>
            <input type="text" name="visitante_id" class="form-control @error('visitante_id') is-invalid @enderror" value="{{ old('visitante_id', $visita?->visitante_id) }}" id="visitante_id" placeholder="Visitante Id">
            {!! $errors->first('visitante_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="prisionero_id" class="form-label">{{ __('Prisionero Id') }}</label>
            <input type="text" name="prisionero_id" class="form-control @error('prisionero_id') is-invalid @enderror" value="{{ old('prisionero_id', $visita?->prisionero_id) }}" id="prisionero_id" placeholder="Prisionero Id">
            {!! $errors->first('prisionero_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="inicio_visita" class="form-label">{{ __('Iniciovisita') }}</label>
            <input type="text" name="inicioVisita" class="form-control @error('inicioVisita') is-invalid @enderror" value="{{ old('inicioVisita', $visita?->inicioVisita) }}" id="inicio_visita" placeholder="Iniciovisita">
            {!! $errors->first('inicioVisita', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fin_visita" class="form-label">{{ __('Finvisita') }}</label>
            <input type="text" name="finVisita" class="form-control @error('finVisita') is-invalid @enderror" value="{{ old('finVisita', $visita?->finVisita) }}" id="fin_visita" placeholder="Finvisita">
            {!! $errors->first('finVisita', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>