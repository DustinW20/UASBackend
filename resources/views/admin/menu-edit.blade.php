@extends('layouts.admin')

@section('title')
    Buat Menu
@endsection


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card px-2 py-2">
        <form action="{{ route('menu.update', ['id' => $menu->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label class="form-label" for="name">Name</label>
            <div class="input-group input-group-outline mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required
                    value="{{ old('name', $menu->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label class="form-label" for="status">Description</label>

            <div class="input-group input-group-outline mb-3 mb-3">
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required>{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <label class="form-label" for="status">Price</label>

            <div class="input-group input-group-outline mb-3 mb-3">
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" required
                    value="{{ old('price', $menu->price) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <label class="form-label" for="status">Status</label>

            <div class="input-group input-group-outline mb-3 mb-3">
                <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                    <option value="masih" {{ old('status', $menu->status) == 'masih' ? 'selected' : '' }}>Masih</option>
                    <option value="habis" {{ old('status', $menu->status) == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group input-group-outline mb-3 mb-3">
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($menu->image)
                    <img src="{{ asset('img/' . $menu->image) }}" alt="{{ $menu->name }}" height="100px"
                        class="mt-2 rounded">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Menu</button>
        </form>
    </div>
@endsection
