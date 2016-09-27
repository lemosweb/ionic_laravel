@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Pedido #{{ $order->id }} - R$ {{ $order->total }}</h3>
            <h3>Cliente: {{ $order->client->user->name }}</h3>
            <h4>Data: {{ $order->created_at }}</h4>

            <p>
                <b>Entregar em:</b>
                {{ $order->client->address }} - {{ $order->client->city }} - {{ $order->client->state }}
            </p>
        </div>

        @include('.errors._check')

        <div class="container">
            {!! Form::model($order, array('route' => ['admin.orders.update', $order->id])) !!}

                {!! Form::label('Status', 'status:') !!}
                {!! Form::select('status', $list_status, null, ['class' => 'form-control']) !!}

                {!! Form::label('entregador', 'entregador:') !!}
                {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class' => 'form-control']) !!}

                <div class="form-group">
                    {!! Form::submit('Criar Categoria', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>


@endsection