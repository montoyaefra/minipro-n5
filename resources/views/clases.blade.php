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
<div class="flex flex-row justify-between">
    <h1>Clases</h1>
    <a href="{{route("clase.create")}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Clase </a>
</div>
@stop

@section('content')

<div class="mx-4 flex flex-col">
    <table class=" text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="pl-4 py-3">
                    Maestro
                </th>
                <th scope="col" class="pr-1 py-3">
                    Alumnos Inscritos
                </th>
                <th scope="col" class="pl-5 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
           <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            
  @foreach ($users as $user)
  @foreach ($user->cursos as $curso)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td class="px-6 py-4">
            {{$count++}}
        </td>
        <td class="px-6 py-4">
            {{$curso->nombre}}
        </td>
        <td class="px-6 py-4">
            {{$user->name}}
        </td>
        <td class="px-6 py-4">
            @php
            $randomNumber = rand(1, 7); 
			 echo $randomNumber;
            @endphp
        </td>
        <td class="px-6 py-3">
            <div class="flex flex-row justify-center items-center gap-2 ">
                <button class="font-medium text-blue-600 hover:underline text-lg" data-toggle="modal" data-target="#example{{$curso->id}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <form class="pt-3" action="{{ route('clase.destroy', $curso->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline text-lg">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>

    <div class="modal fade" id="example{{$curso->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Editar Permisos</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("clase.update", $curso->id)}}" class="" method="POST">
                        @csrf
                        @method("put")
                        <h6><b>Nombre del Curso</b></h6>
                        <input type="text" class="form-control" value="{{$curso->nombre}}"  name="curso" placeholder="Agrega Curso" required>
                        <br>
                        <button type="submit" class="btn btn-primary mt-3">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        
        
     @endforeach
 @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Curso</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="flex flex-col gap-1" method="POST" action="{{ route("clase.store")}}">
            @csrf
            <h6><b>Curso</b></h6>
            <input type="text" name="curso" id="curso" placeholder="ingresa Curso" required>
            <br>
            <select name="maestro_id" id="roles">
                <option value="null" disabled selected>Escoge una clase:</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                @endforeach
            </select>
            <br>
            <button type="submit" class="btn btn-primary mt-3 w-25">Save changes</button>
          </form>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


 
  
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </>
@stop
