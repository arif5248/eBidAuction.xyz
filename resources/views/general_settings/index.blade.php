@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('General Settings')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('generalsettings.update',$generalsetting->id ) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{translate('Site Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" value="{{ $generalsetting->site_name }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="address">{{translate('Address')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="address" name="address" value="{{ $generalsetting->address }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{translate('Footer Text')}}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="4" name="description" required>{{$generalsetting->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="phone">{{translate('Phone')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="phone" name="phone" value="{{ $generalsetting->phone }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">{{translate('Email')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="email" name="email" value="{{ $generalsetting->email }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="facebook">{{translate('Facebook')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="facebook" name="facebook" value="{{ $generalsetting->facebook }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="instagram">{{translate('Instagram')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="instagram" name="instagram" value="{{ $generalsetting->instagram }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="twitter">{{translate('Twitter')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="twitter" name="twitter" value="{{ $generalsetting->twitter }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="youtube">{{translate('Youtube')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="youtube" name="youtube" value="{{ $generalsetting->youtube }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="google_plus">{{translate('Google Plus')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="google_plus" name="google_plus" value="{{ $generalsetting->google_plus }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{translate('System Timezone')}}</label>
                        <div class="col-sm-9">
                            <select name="timezone" class="form-control demo-select2" data-live-search="true">
                                @foreach (timezones() as $key => $value)
                                    <option value="{{ $value }}" @if (app_timezone() == $value)
                                        selected
                                    @endif>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>

@endsection
