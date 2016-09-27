@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Produtos</h1>

        <div class="container">
            <div class="row">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Cadastrar Produto</a>
            </div>
        </div>

        <br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)

            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->category->name }}</td>

                <td><a href="{{route('admin.products.edit',['id' => $product->id])}}" class="btn btn-default">Editar</a></td>
            </tr>

            @endforeach
            </tbody>
        
        </table>

        {{ $products->render() }}

    </div>
</div>


@endsection