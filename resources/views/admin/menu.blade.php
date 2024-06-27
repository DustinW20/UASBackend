@extends('layouts.admin')

@section('title')
    Menu
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
        </div>
        <div class="section-body">
            <a href="{{ route('menu.create') }}" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addModal">Tambah
                Menu</a>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->description }}</td>
                                <td>{{ $menu->price }}</td>
                                <td>{{ $menu->status }}</td>
                                <td>
                                    <img src="{{ asset('img/' . $menu->image) }}" alt="" height="100px"
                                        class="rounded">
                                </td>
                                <td>{{ $menu->created_at }}</td>
                                <td>
                                    <a href="{{ route('menu.edit', ['id' => $menu->id]) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('menu.destroy', ['id' => $menu->id]) }}" class="d-inline"
                                        method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteModal{{ $menu->id }}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <!-- Edit Modal -->

    <!-- Delete Modal -->
    <!-- Bootstrap core JS -->
@endsection
