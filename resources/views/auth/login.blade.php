@extends('frontend.layouts.app_plain')
@section('extra_css')
    <style>
        main {
            min-height: 100vh;
            padding: 25px;

            background-image: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.25),
                rgba(0, 0, 0, 0.75)
            );
        }
    </style>
@endsection
@section('content')
<div class="container login">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-md-6">
            <div class="text-center mb-3">
                <a href="{{route('admin.login')}}">
                    <img src="{{asset('image/football.png')}}" style="width:60px" alt="">
                </a>
            </div>
            <div class="card user-login-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                           <div class="d-flex align-items-center" >
                            <i class="fas fa-user" style="font-size : 20px ; padding-right: 10px !important;"></i><input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" required placeholder="username" autocomplete="current-username">
                           </div>
                            @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="d-flex align-items-center" >
                                <i class="fas fa-lock" style="font-size : 20px ; padding-right: 10px !important;"></i><input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="password" autocomplete="current-password">
                            </div>
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                            <div class="d-flex align-items-center">
                                <div class="check" style="font-size : 20px ; padding-right: 8px !important;">
                                    <input class="my-check-box"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="">
                                </div>
                                    <button class="btn btn-theme btn-block">Login</button>
                            </div>
                        
                            {{-- <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('username') }}</label>

                            <div class="col-md-6">
                                
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="current-username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
