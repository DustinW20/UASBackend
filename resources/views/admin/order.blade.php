@extends('layouts.admin')

@section('title')
    Pesanan
@endsection

@section('content')
    <section class="section">
        <div class="section-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Menu Item</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->details->first()->menu->name }}</td>
                            <td>{{ $order->details->first()->quantity }}</td>
                            <td>{{ $order->details->first()->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.order.update', ['cartItem' => $order->id]) }}" class="d-inline"
                                    method="post">
                                    @method('put')
                                    @csrf
                                    <input type="text" name="status" value="done" hidden>
                                    <button type="submit" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $order->id }}">Setujui Dan Antar</button>
                                </form>
                                <form action="{{ route('admin.order.update', ['cartItem' => $order->id]) }}"
                                    class="d-inline" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="text" name="status" value="cancel" hidden>
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $order->id }}">Tolak Dan Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal untuk Edit -->
    @foreach ($orders as $order)
        <div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="editModal{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $order->id }}">Edit Order</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk edit order -->
                        <form method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Isi form edit order di sini -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
