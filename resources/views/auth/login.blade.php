@extends('layouts.app')

@section('content')

<div class="main-container container-fluid d-none d-md-block">
    <div class="row">
        <div class="col-md-2">
            <div class="one-layer">
                <div class="layer-one flex-column justify-content-center align-content-center">
                    <div class="form-group-layer">
                        <h2 class="layer-title text-center">Masuk Akun</h2>
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                            <label class="layer-label" for="username">Email</label>
                            <input type="email" placeholder="Masukan Email" class="form-control layer-form{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <label for="password" class="layer-label mt-4">Password</label>
                            <input type="password" placeholder="Masukan password" class="layer-form form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <a href="#" class="btn mt-3 float-right forget-pass">Lupa Password ?</a>
                            <br>
                            <input type="submit" class="btn mt-3 btn-rentpaid" value="Masuk Akun">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="layer-two d-none d-lg-block"></div>
        <div class="container col-md-8 offset-2">
            <div class="main-logo">
                <img src="{{asset('img/logo 2.png')}}" class="img-fluid" alt="">
                <img class="img-fluid pt-5" src="{{asset('img/payment_illustration.png')}}" alt="">
            </div>
        </div>
    </div>
</div>

<div class="d-block main-container-sm d-sm-none">
    <div class="container row-sm">
        <div class="logo-sm">
            <img src="{{asset('img/logo 2.png')}}" class="img-fluid" alt="">
        </div>
    </div>
    <div class="layer-two-sm"></div>
    <div class="bg-rentpaid">
        <div class="container row-sm layer-sm-one">
            <div class="form-group">
                <h2 class="layer-title text-center">Masuk Akun</h2>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                    <label class="layer-label" for="username">Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <label for="password" class="layer-label mt-4">Password</label>
                    <input id="password" type="password" placeholder="Masukan password" class="layer-form form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <a href="#" class="btn mt-3 float-right forget-pass">Lupa Password ?</a>
                    <br>
                    <input type="submit" class="btn mt-3 btn-rentpaid" value="Masuk Akun">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
