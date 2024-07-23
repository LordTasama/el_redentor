@extends('layouts.app')

@section('template_title')
    {{ $guardia->name ?? __('Show') . " " . __('Guardia') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Guardia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('guardias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombres:</strong>
                                    {{ $guardia->nombres }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellidos:</strong>
                                    {{ $guardia->apellidos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ultimasesion:</strong>
                                    {{ $guardia->ultimaSesion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rol:</strong>
                                    {{ $guardia->rol }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection