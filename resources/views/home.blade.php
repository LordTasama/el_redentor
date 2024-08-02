@extends('layouts.app')
@section('content')

@error('error')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@endsection