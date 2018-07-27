@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    {{ Form::open(['route' => 'import', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                    {{ csrf_field() }}
                    <input type="file" id="csv" name="csv" accept="text/csv" class="pull-left">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-upload"></i> Importar CSV</button>
                    {{ Form::close() }}
                </div>

                <div class="box-body">
                    <table class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>CPF</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Data de Nascimento</th>
                                <th>CEP</th>
                                <th>Logradouro</th>
                                <th>Número</th>
                                <th>Complemento</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="container-fluid">

                        </div>
                    </div>

                    <div class="row">
                        <div class="container-fluid">
                            <a href="#" class="btn btn-success pull-left"><i class="fa fa-download"></i> Exportar para CSV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop