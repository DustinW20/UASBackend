@extends('layouts.user')

@section('content')

    <section class="py-5">
        @if ($errors->any())
            <div class="alert alert-primary alert-dismissible text-white mx-5" style="background-color: red; color: white;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($menus as $item)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                {{ $item->status }}</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('img') . '/' . $item->image }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $item->name }}</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through"></span>
                                    {{ number_format($item->price) }} Rp
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                <form action="{{ route('addToCart') }}" class="d-inline" method="post">
                                    @csrf
                                    <input type="text" name="menu_id" value="{{ $item->id }}" hidden>
                                    <button class="btn btn-outline-success" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
