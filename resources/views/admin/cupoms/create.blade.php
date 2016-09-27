@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Cadastrar Categoria</h1>
    </div>

    @include('.errors._check')


    <div class="container">
        {!! Form::open(array('route' => 'admin.cupoms.store')) !!}

       @include('admin.cupoms.form')


        <div class="form-group">
            {!! Form::submit('Criar Categoria', ['class' => 'btn btn-primary']) !!}
        </div>





        {!! Form::close() !!}
    </div>
</div>


@endsection