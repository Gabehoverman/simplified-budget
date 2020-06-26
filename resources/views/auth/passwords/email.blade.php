@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-xl-5 my-5 card" style="padding: 25px;">
            <h2 class="text-center mb-5">
                {{ __('Reset Password') }}
            </h2>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-3 mt-5">
                        {{ __('Send Password Reset Link') }}
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
