@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Google Login Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Client ID')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="GOOGLE_CLIENT_ID" value="{{  env('GOOGLE_CLIENT_ID') }}" placeholder="{{ translate('Google Client ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Client Secret')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" value="{{  env('GOOGLE_CLIENT_SECRET') }}" placeholder="{{ translate('Google Client Secret') }}" required>
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
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Facebook Login Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('App ID')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="FACEBOOK_CLIENT_ID" value="{{ env('FACEBOOK_CLIENT_ID') }}" placeholder="{{ translate('Facebook Client ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('App Secret')}}</label>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <input type="text" class="form-control" name="FACEBOOK_CLIENT_SECRET" value="{{ env('FACEBOOK_CLIENT_SECRET') }}" placeholder="{{ translate('Facebook Client Secret') }}" required>
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

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Twitter Login Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="TWITTER_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Client ID')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="TWITTER_CLIENT_ID" value="{{ env('TWITTER_CLIENT_ID') }}" placeholder="{{ translate('Twitter Client ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="TWITTER_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Client Secret')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="TWITTER_CLIENT_SECRET" value="{{ env('TWITTER_CLIENT_SECRET') }}" placeholder="{{ translate('Twitter Client Secret') }}" required>
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
