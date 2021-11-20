@extends('layouts.app')

@section('content')

    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Update Pickup Point Information')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('pick_up_points.update',$pickup_point->id) }}" method="POST" enctype="multipart/form-data">
            	<input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{translate('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" value="{{ $pickup_point->name }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="address">{{translate('Location')}}</label>
                        <div class="col-sm-9">
                            <textarea name="address" rows="8" class="form-control" required>{{ $pickup_point->address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="phone">{{translate('Phone')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Phone')}}" id="phone" name="phone" value="{{ $pickup_point->phone }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{translate('Pickup Point Status')}}</label>
                        <div class="col-sm-3">
                            <label class="switch" style="margin-top:5px;">
                            		<input value="1" type="checkbox" name="pick_up_status"@if ($pickup_point->pick_up_status == 1) checked @endif>
                            		<span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{translate('Pick-up Point Manager')}}</label>
                        <div class="col-sm-9">
                            <select name="staff_id" required class="form-control demo-select2-placeholder">
                                @foreach(\App\Staff::all() as $staff)
                                    @if ($staff != null && $staff->user!=null )
                                        <option value="{{$staff->id}}" @if ($pickup_point->staff_id == $staff->id) selected @endif>{{$staff->user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
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
