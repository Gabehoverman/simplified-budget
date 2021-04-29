@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-xl-5 my-5 card" style="padding: 25px;">

            <h2 class="text-center mb-3">
                Sign Up
            </h2>

            <div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label">{{ __('First Name') }}</label>

                        <div class="col-md-12">
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label">{{ __('Last Name') }}</label>

                        <div class="col-md-12">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-3 mt-5">
                        {{ __('Register') }}
                    </button>

                    <div class="col-md-10 offset-md-1">
                        <p class="small text-muted text-center">By signing up, you agree to our <a target="_blank" href="{{ route('web.terms') }}">Terms of Service</a>, <a target="_blank" href="{{ route('web.privacy') }}">Privacy Policy</a>, and <a target="_blank" href="{{ route('web.disclosures') }}">Disclosures</a>.</p>
                    </div>
                    <br>
                    <!-- Link -->
                    <div class="text-center">
                        <small class="text-muted text-center">
                        Already have an account? <a href="{{ route('login') }}">Log in</a>.
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
