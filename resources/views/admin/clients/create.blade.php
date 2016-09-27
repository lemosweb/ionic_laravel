@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>Cadastrar Cliente</h1>
    </div>

    @include('.errors._check')


    <div class="container">
        {!! Form::open(array('route' => 'admin.clients.store')) !!}

       @include('admin.clients.form')


        <div class="form-group">
            {!! Form::submit('Cadastrar Cliente', ['class' => 'btn btn-primary']) !!}
        </div>





        {!! Form::close() !!}
    </div>
</div>


@endsection