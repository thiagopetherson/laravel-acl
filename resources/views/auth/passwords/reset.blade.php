@extends('auth.templates.template')

@section('content-form')

        <form class="login form" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">               
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror         
            </div>

            <div class="form-group">               
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror          
            </div>

            <div class="form-group"> 
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">   
            </div>

            <div class="form-group mb-0">               
                    <button type="submit" class="btn btn-login">
                        {{ __('Resetar Senha') }}
                    </button>              
            </div>
        </form>

@endsection
