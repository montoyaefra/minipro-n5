@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="bg-white d-inline-block p-3 border rounded">
        <h5>Bievenido</h5>
        <p>Seleciona la accion que quieras realizar en las pestañas del menu de las <br> izquierda </p>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
