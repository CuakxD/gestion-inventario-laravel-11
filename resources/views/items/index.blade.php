@extends('dashboard')
@section('content')
    <div class="container text-center">

        <h1 style="font-size: 25px">Gestion de inventario</h1>
        <p>Articulos agregador por mi</p>
        <div class="row">
            <div class="col-md-12">
                <div class="text-right">
                    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Crear Nuevo Artículo</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Creador</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($itemsArray as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['price'] }}</td>
                                <td>{{ $item['user_name'] }}</td>
                                <td>
                                    <a href="{{ route('items.show', $item['id']) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('items.edit', $item['id']) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('items.destroy', $item['id']) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger   
 btn-sm"
                                            onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay registros disponibles</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
