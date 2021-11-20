@extends('layouts.blank')

@section('content')
    <div class="cls-content-sm panel">
        <div class="panel-body">
            <h1 class="h3">{{ translate('Reset Password') }}</h1>
            <p class="pad-btm">{{translate('Enter your email address and new password and confirm password.')}} </p>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ translate('Email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ translate('New Password') }}" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ translate('Confirm Password') }}" required>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        {{ translate('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
