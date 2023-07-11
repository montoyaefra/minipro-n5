

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

@section('title', 'Maestro')


@section('content_header')
    <h1>Maestros</h1>
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
                    DNI
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-2 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                   Direccion 
                </th>
                <th scope="col" class="px-6 py-3">
                   Cumpleaños 
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
                {{$usuario->dni}}
            </td>
            <td class="px-6 py-4">
                {{$usuario->name}}
            </td>
            <td class="px-6 py-4">
               {{$usuario->email}}
            </td>
            <td class="px-6 py-4">
                {{$usuario->direction}}
            </td>
            <td>
                {{$usuario->birthday}}
            </td>
            <td class="px-6 py-4 flex gap-3">
                <button class="font-medium text-blue-600 hover:underline text-lg" data-toggle="modal" data-target="#example{{$usuario->id}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <form action="{{ route('alumno.destroy', $usuario->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=" text-red-500 hover:underline text-lg"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>

        <div class="modal fade" id="example{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Editar Alumnos</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("alumno.update", $usuario->id)}}" class="flex flex-col justify-center" method="POST">
                        @csrf
                        @method("put")
                        <h6><b>DNI</b></h6>
                        <input type="text" value="{{$usuario->dni}}" name="dni">
                        <h6><b>Nombre</b></h6>
                        <input type="text" value="{{$usuario->name}}" name="nombre" required>
                        <h6><b>Email</b></h6>
                        <input type="text" value="{{$usuario->email}}" name="email" required>
                        <h6><b>Direccion</b></h6>
                        <input type="text" value="{{$usuario->direction}}" name="direccion">
                        <h6><b>Cumpleaños</b></h6>
                        <input type="date" value="{{$usuario->birthday}}" name="nacimiento">
                        <br>
                        <button type="submit" class="btn btn-primary mt-5">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
                </div>
              </div>
            </div>
          </div>
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
