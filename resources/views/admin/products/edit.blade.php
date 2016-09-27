@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Editar Categoria {{ $category->name }}</h1>
    </div>

    @include('.errors._check')

    <div class="container">
        {!! Form::model($category, array('route' => ['admin.categories.update', $category->id])) !!}

        @include('admin.categories.form')


        <div class="form-group">
            {!! Form::submit('Alterar Categoria', ['class' => 'btn btn-primary']) !!}
        </div>





        {!! Form::close() !!}
    </div>
</div>


@endsection