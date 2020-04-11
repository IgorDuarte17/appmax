@extends('layouts.app')

@section('title', 'Produtos')

@section('infos')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Produtos</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Admin</a></li>
                                <li><a href="#">Produtos</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <a href="{{ route('produtos.create') }}" class="btn btn-primary">Novo</a>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Cadastrado Via</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            @if($product->image)
                                            <a data-toggle="tooltip" data-toggle="tooltip" data-html="true" title="<img src='{{ route('image',['link'=>$product->image->link]) }}' width='150' height='150' />">
                                                <i class="fa fa-camera"></i>
                                            </a>
                                            @else
                                            <a data-toggle="tooltip" data-toggle="tooltip" data-html="true" title="<strong>Sem Foto</strong>">
                                                <i class="fa fa-camera"></i>
                                            </a>
                                            @endif
                                        </td>
                                        <th scope="row">
                                            {{ $product->sku }}
                                        </th>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>
                                            {!! Str::limit($product->description, 20, ' (...)') !!}
                                        </td>
                                        <td>
                                            R$ {{ $product->price }}
                                        </td>
                                        <td>
                                            {{ $product->amount }}
                                        </td>
                                        <td>
                                            @if($product->active)
                                                <span class="badge badge-success">Ativo</span>
                                            @else
                                                <span class="badge badge-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $product->Insert_in = 1 ? 'Sistema' : 'API' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('produtos.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm btnRemoveItem" data-route="{{ route('produtos.destroy', $product->id) }}">
                                                <i class="fa fa-trash-o white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
