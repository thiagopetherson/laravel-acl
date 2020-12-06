@extends('auth.templates.template')

@section('content-form')

    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>  
        @endif
    </div>

        <form class="login form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group row">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror             
            </div>

            <div class="form-group row mb-0">             
                <button type="submit" class="btn btn-login">
                    {{ __('Enviar Link de Recuperação de Senha') }}
                </button>               
            </div>
        </form>
@endsection
