@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Profile')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{translate('Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="{{translate('Name')}}" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{translate('Email')}}</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" placeholder="{{translate('Email')}}" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="new_password">{{translate('New Password')}}</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="{{translate('New Password')}}" name="new_password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="confirm_password">{{translate('Confirm Password')}}</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="{{translate('Confirm Password')}}" name="confirm_password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="avatar">{{translate('Avatar')}} <small>(120x80)</small></label>
                        <div class="col-sm-10">
                            <input type="file" id="avatar" name="avatar" class="form-control">
                        </div>
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
