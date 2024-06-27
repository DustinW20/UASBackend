@extends('layouts.admin')
@section('title')
    Buat Menu
@endsection

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
    @if ($errors->any())
        <span
            class="alert alert-primary alert-dismissible text-white">{{ implode('', $errors->all('<div>:message</div>')) }}</span>
    @endif
    <div class="card px-2 py-2">
        <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group input-group-outline my-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="input-group input-group-outline my-3">
                <textarea class="form-control" name="description" rows="3" required></textarea>
            </div>
            <div class="input-group input-group-outline my-3">
                <label class="form-label" for="price">Price</label>
                <input type="number" class="form-control" name="price" required>
            </div>
            <div class="input-group input-group-outline my-3">
                <select class="form-control" name="status" required>
                    <option value="masih">Masih</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
            <div class="input-group input-group-outline my-3">
                <input type="file" class="form-control-file" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
