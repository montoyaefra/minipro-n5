@vite(['resources/css/app.css', 'resources/js/app.js'])
<head>
    <script src="https://kit.fontawesome.com/38c6ae743a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
@php
    $count=1;
@endphp
@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
    <h1>Permisos</h1>
@stop

@section('content')

<div class="container flex flex-col">
    <table class=" text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Permiso
                </th>
                <th scope="col" class="px-6 py-3">
                    Estado
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
           @foreach ($usuarios as $usuario)
           <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    
            <td class="px-6 py-4">
                {{$count++}}
            </td>
            <td class="px-6 py-4">
                {{$usuario->name}}
            </td>
            <td class="px-6 py-4">
                admin, maestro
            </td>
            <td class="px-6 py-4">
                @if ($usuario->estado)
                    <span class="bg-green-400 p-2">activo</span>
                @else
                <span class="bg-red-400 p-2 border rounded">inactivo</span>
                @endif
            </td>
            <td class="px-6 py-4 flex gap-3">
                <a href="#" class="font-medium text-blue-600 hover:underline text-lg"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
