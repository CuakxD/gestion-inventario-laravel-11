@extends('dashboard')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Artículo</h1>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Cantidad:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}"
                    required>
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                    value="{{ old('price') }}" required>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name="user_id" value="{{ auth()->id() }}"> {{-- Campo oculto para el user_id --}}

            <button type="submit" class="btn btn-primary">Crear Artículo</button>
        </form>
    </div>
@endsection
