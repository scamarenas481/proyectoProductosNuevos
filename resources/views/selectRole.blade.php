@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Seleccionar Rol</h2>

        <form action="{{ route('set.active.role') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="role_id" class="form-label">Seleccione su Rol</label>
                <select class="form-select" id="role_id" name="role_id" required> <!-- Cambio aquí -->
                    @foreach ($userRoles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="selectedRole" class="form-label">Rol Seleccionado</label>
                <input type="text" class="form-control" value="{{ $selectedRole->name }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
    </div>
@endsection
