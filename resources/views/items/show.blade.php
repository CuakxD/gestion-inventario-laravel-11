@extends('dashboard')

@section('content')
    <div class="container">
        <h1>Detalles del Artículo</h1>

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item['name'] }}" readonly>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" readonly>{{ $item['description'] }}</textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Cantidad:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $item['quantity'] }}"
                readonly>
        </div>

        <div class="form-group">
            <label for="price">Precio:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01"
                value="{{ $item['price'] }}" readonly>
        </div>

        <a href="{{ route('items.index') }}" class="btn btn-secondary">Volver a la lista</a>
    </div>
@endsection
