@extends('dashboard')

@section('content')
    <div class="container">
        <h1>Editar Artículo</h1>

        @if ($item->user_id == auth()->id())
            <form action="{{ route('items.update', $item['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $item['name']) }}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $item['description']) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">Cantidad:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        value="{{ old('quantity', $item['quantity']) }}" required>
                    @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Precio:</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01"
                        value="{{ old('price', $item['price']) }}" required>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Artículo</button>
            </form>
        @else
            <div class="alert alert-danger">No tienes permiso para editar este artículo.</div>
        @endif
    </div>
@endsection
