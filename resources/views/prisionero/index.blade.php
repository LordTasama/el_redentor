@extends('layouts.app')
@section("title","Prisioneros")
@section('template_title')
Prisioneros
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Prisioneros') }}
                        </span>

                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Nacimiento</th>
                                    <th>Ingreso</th>
                                    <th>Delito</th>
                                    <th>Celda</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prisioneros as $prisionero)
                                <tr>
                                    <td>{{ $prisionero->id }}</td>

                                    <td>{{ $prisionero->nombres }}</td>
                                    <td>{{ $prisionero->apellidos }}</td>
                                    <td>{{ $prisionero->nacimiento }}</td>
                                    <td>{{ $prisionero->ingreso }}</td>
                                    <td>{{ $prisionero->delito }}</td>
                                    <td>{{ $prisionero->celda }}</td>

                                    <td>
                                        <form action="{{ route('prisioneros.destroy', $prisionero->id) }}"
                                            method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('prisioneros.show', $prisionero->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('prisioneros.edit', $prisionero->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); confirm('¿Está seguro que lo desea eliminar?') ? this.closest('form').submit() : false;"><i
                                                    class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $prisioneros->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection