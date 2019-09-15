@extends('layouts.app')

@section('scripts')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Login Now</h2>
                <form method="POST" action="{{ route('login') }}">
                            @csrf
              <div class="form-group">
                <label for="username" class="text-uppercase">{{ __('Username') }}</label>
                <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group">
                <label for="password" class="text-uppercase">Password</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-login">Submit</button>
                @if (Route::has('password.request'))
                    <label class="form-check-label">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </label>
                @endif
            </div>
      
            </form>
    <div class="copy-text">Copyright © 2019 DHVSU Faculty Evaluation</div>
        </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block img-fluid" src="{{ asset('dist/img/dhvsu-1861.jpg') }}" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                        <h2>DHVSU 1861</h2>
                    </div>  
              </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block img-fluid" src="{{ asset('dist/img/dhvsu-2019.jpg') }}" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                        <h2>DHVSU 2019</h2>
                    </div>  
                </div>
                </div>
            </div>     
                
            </div>
        </div>
    </div>
</section>
@endsection
