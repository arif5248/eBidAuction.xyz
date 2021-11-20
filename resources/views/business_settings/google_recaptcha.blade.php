@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{translate('Google reCAPTCHA Setting')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('google_recaptcha.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('Google reCAPTCHA')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <label class="switch">
                                    <input value="1" name="google_recaptcha" type="checkbox" @if (\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="CAPTCHA_KEY">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('Site KEY')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="CAPTCHA_KEY" value="{{  env('CAPTCHA_KEY') }}" placeholder="{{ translate('Site KEY') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
