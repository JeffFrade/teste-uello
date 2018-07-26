@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number">93,139</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-address-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Endereços</span>
                    <span class="info-box-number">93,139</span>
                </div>
            </div>
        </div>
    </div>
@stop