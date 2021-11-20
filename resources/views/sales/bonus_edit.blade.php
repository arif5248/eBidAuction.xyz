@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Edit Bonus')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('refer.bonus.update', $edit_bonus->id) }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{translate('Bonus Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Bonus Name')}}" id="bonus_name" name="bonus_name" class="form-control" value="{{$edit_bonus->bonus_name}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{translate('Amount')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Amount')}}" id="amount" name="amount" class="form-control" value="{{$edit_bonus->amount}}" required>
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
