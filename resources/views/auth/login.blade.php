@extends('layouts.extra-pages')

@section('title', 'Login')

@section('container')

    <div class="login-content">
        <div class="login-logo">
            <a href="index.html">
                <img class="align-content" src="/images/logo-appmax.png" alt="">
            </a>
        </div>
        <div class="login-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('Email') ? ' is-invalid' : '' }}" name="Email" value="{{ old('Email') }}" required autofocus>
                    @if ($errors->has('Email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Senha') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="checkbox">
                    <label class="col-form-label">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        {{ __('Lembrar') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <div class="register-link m-t-15 text-center">
                    <p>Não tem uma conta? <a href="#"> Registrar-se</a></p>
                </div>
            </form>
        </div>
    </div>
@stop
