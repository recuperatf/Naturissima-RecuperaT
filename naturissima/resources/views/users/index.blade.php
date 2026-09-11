@extends('layouts.basic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Crear usuario</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1>Users</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}">Editar</a>
                                <a href="{{ route('users.destroy', $user->id) }}">Borrar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
