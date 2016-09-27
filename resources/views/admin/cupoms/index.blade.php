@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Cupons</h1>

        <div class="container">
            <div class="row">
                <a href="{{ route('admin.cupoms.create') }}" class="btn btn-primary">Cadastrar Novo Cupom</a>
            </div>
        </div>

        <br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Código</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cupoms as $cupom)

            <tr>
                <td>{{ $cupom->code }}</td>
                <td>{{ $cupom->value }}</td>
                <td><a href="{{route('admin.cupoms.edit',['id' => $cupom->id])}}" class="btn btn-default">Editar</a></td>
            </tr>

            @endforeach
            </tbody>
        
        </table>

        {{ $cupoms->render() }}

    </div>
</div>


@endsection