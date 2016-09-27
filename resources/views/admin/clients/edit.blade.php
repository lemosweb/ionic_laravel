@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Editar Categoria {{ $client->user->name }}</h1>
    </div>

    @include('.errors._check')

    <div class="container">
        {!! Form::model($client, array('route' => ['admin.clients.update', $client->id])) !!}

        @include('admin.clients.form')


        <div class="form-group">
            {!! Form::submit('Atualizar Cliente', ['class' => 'btn btn-primary']) !!}
        </div>





        {!! Form::close() !!}
    </div>
</div>


@endsection