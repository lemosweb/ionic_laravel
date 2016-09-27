@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Clientes</h1>

        <div class="container">
            <div class="row">
                <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Cadastrar novo Cliente</a>
            </div>
        </div>

        <br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)

            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->user->name }}</td>
                <td><a href="{{route('admin.clients.edit',['id' => $client->id])}}" class="btn btn-default">Editar</a></td>
            </tr>

            @endforeach
            </tbody>
        
        </table>

        {{ $clients->render() }}

    </div>
</div>


@endsection