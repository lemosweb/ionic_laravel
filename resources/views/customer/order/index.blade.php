@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>Meus Pedidos</h1>

            <div class="container">
                <div class="row">
                    <a href="{{ route('order.create') }}" class="btn btn-primary">Cadastrar Novo Pedido</a>
                </div>
            </div>

            <br>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)

                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->status }}</td>

                    </tr>

                @endforeach
                </tbody>

            </table>

            {{ $orders->render() }}

        </div>
    </div>


@endsection