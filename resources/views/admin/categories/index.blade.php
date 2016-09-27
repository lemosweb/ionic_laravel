@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Categorias</h1>

        <div class="container">
            <div class="row">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Cadastrar Categoria</a>
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
            @foreach($categories as $category)

            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><a href="{{route('admin.categories.edit',['id' => $category->id])}}" class="btn btn-default">Editar</a></td>
            </tr>

            @endforeach
            </tbody>
        
        </table>

        {{ $categories->render() }}

    </div>
</div>


@endsection