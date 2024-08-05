@extends("layouts.app")
@section("title","Reportes")

@section('content')
<section class="container">
    <a type="button" class="btn btn-success" href="{{route('exportar.prisioneros')}}">Generar lista de prisioneros</a>
    <a type="button" class="btn btn-success" href="{{route('exportar.visitas')}}">Generar lista de Visitas</a>
    <a type="button" class="btn btn-success" href="{{route('exportar.visitantes')}}">Generar lista de
        Visitantes</a>
</section>
@endsection