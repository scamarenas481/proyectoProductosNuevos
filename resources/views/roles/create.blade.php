@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Agregar Rol</h2>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
@endsection
