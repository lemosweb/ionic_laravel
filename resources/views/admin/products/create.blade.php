@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Cadastrar Produto</h1>
    </div>

    @include('.errors._check')


    <div class="container">
        {!! Form::open(array('route' => 'admin.products.store')) !!}

       @include('admin.products.form')


        <div class="form-group">
            {!! Form::submit('Criar Produto', ['class' => 'btn btn-primary']) !!}
        </div>





        {!! Form::close() !!}
    </div>
</div>


@endsection