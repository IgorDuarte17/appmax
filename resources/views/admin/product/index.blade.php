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
                                    <th scope="col" style="width:130px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="text-center">
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
                                        <td class="text-center">
                                            {{ $product->insert_in === 1 ? 'Sistema' : 'API' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm btnDecrementItem" data-route="{{ route('product_decrement', $product->id) }}">
                                                <i class="fa fa-arrow-down white"></i>
                                            </a>
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

@section('scripts')
    <script>
        jQuery("body").on('click', '.btnDecrementItem', function(e) {
            var self = jQuery(this);
            var element = self.data('target-element');

            swal({
                title: 'Baixar este item?',
                text: "Você está baixando sua quantidade em estoque!",
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off',
                    id: 'amount'
                },
                inputPlaceholder: "Informe a quantidade",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                inputValidator: (value) => {
                    if (!value) {
                    return 'Informe a quantidade!'
                    }
                }
            }).then((result) => {
                if (result.value) {

                    e.preventDefault();

                    jQuery.ajax({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: 'PUT',
                            amount: result.value
                        },
                        url: self.data('route'),
                        type: 'POST',
                        dataType: 'json',

                    }).done(function(data) {

                        const toast = swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        toast({
                            type: data.type,
                            title: data.message
                        });

                        if(data.code == 200) {
                            if(jQuery(element).length){
                                location.reload(true);
                            } else {
                                location.reload(true);
                            }
                        }
                    });
                }
            });

        });
    </script>
@endsection
