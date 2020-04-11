@extends('layouts.app')

@section('title', 'Cadastrar Produto')

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
    {!! Form::open(['route' => 'produtos.store', 'method' => 'post', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true]) !!}
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Novo Produto</div>
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-form-label" for="nome">Nome</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                            </div>
                                            {{ Form::text('name', null, ['class' => $errors->has('name') ? 'is-invalid form-control' : ' form-control']) }}
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                                        <label class="col-form-label" for="nome">Valor</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            {{ Form::text('price', null, ['class' => $errors->has('price') ? 'is-invalid form-control' : ' form-control']) }}
                                        </div>
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label class="col-form-label" for="nome">Quantidade</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-plus"></i></span>
                                            </div>
                                            {{ Form::text('amount', null, ['class' => $errors->has('amount') ? 'is-invalid form-control' : ' form-control']) }}
                                        </div>
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label class="col-form-label" for="nome">Descrição</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-text-width"></i></span>
                                            </div>
                                            {{ Form::textarea('description', null, ['rows' => 3, 'class' => $errors->has('description') ? 'is-invalid form-control' : ' form-control']) }}
                                        </div>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                        <label class="col-form-label" for="nome">Imagem</label>
                                        <div class="input-group">
                                            {{ Form::file('image', ['class' => 'filestyle', 'data-buttontext' => 'Selecionar Arquivo', 'data-buttonname' => 'btn-primary']) }}
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="col-form-label">
                                                {{ Form::checkbox('active', 1, false) }}
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                Ativo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    {!! Form::close() !!}
@endsection
