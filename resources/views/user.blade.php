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
            @php
                $role = $usuario->getRoleNames();
            @endphp
            @if (count($role) != 0)
                {{ $role[0] }}
            @else
                sin asignar rol
            @endif
            </td>
            <td class="px-6 py-4">
                @if ($usuario->estado)
                    <span class="bg-green-400 p-2">activo</span>
                @else
                <span class="bg-red-400 p-2 border rounded">inactivo</span>
                @endif
            </td>
            <td class="px-6 py-4 flex gap-3">
                <button class="font-medium text-blue-600 hover:underline text-lg" data-toggle="modal" data-target="#example{{$usuario->id}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </td>
        </tr>

        <div class="modal fade" id="example{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("user.update", $usuario->id)}}" class="flex flex-col justify-center" method="POST">
                        @csrf
                        @method("put")
                        <h6><b>Email</b></h6>
                        <input type="text" value="{{$usuario->email}}" name="email" required>
                        <h6><b>clase asignada no rol</b></h6>
                        <select name="rol" id="roles">
                            <option value="" disabled selected>sin asignar rol</option>
                            @foreach ($roles as $rol)
                            @if ($usuario->hasRole($rol))
                            <option value="{{ $rol->name}}" selected>{{ $rol->name}}</option>
                            @else
                            <option value="{{ $rol->name}}">{{ $rol->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        <h6><b>Estado</b></h6>
                        <fieldset>
                            <div>
                              <input type="radio" id="contactChoice1" name="estado" value="1" checked/>
                              <label for="contactChoice1">Activo</label>
                        
                              <input type="radio" id="contactChoice2" name="estado" value="0" />
                              <label for="contactChoice2">Desactivo</label>
                        
                          </fieldset>
                          
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
    <script> console.log('Hi!'); </>
@stop
