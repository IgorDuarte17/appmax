@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="fa fa-tags"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $gettAllWithActive->count() }}</span></div>
                                    <div class="stat-heading">Quantidade de Produtos Ativos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $getAllWithLowStock->count() }}</span></div>
                                    <div class="stat-heading">Quantidade de Produtos com Estoque abaixo de 100</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">últimos 5 produtos cadastrados</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col" class="text-center">Quantidade</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getLastFiveProducts as $product)
                                        <th scope="row">
                                            {{ $product->sku }}
                                        </th>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td class="text-center">
                                            <span class=" {{ ($product->amount < 100) ? 'badge badge-danger' : 'badge badge-success' }} "> {{ $product->amount }} </span>
                                        </td>
                                        <td class="text-center">
                                            @if($product->active)
                                                <span class="badge badge-success">Ativo</span>
                                            @else
                                                <span class="badge badge-danger">Inativo</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
