@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Category Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('Type')}}</label>
                    <div class="col-sm-10">
                        <select name="digital" required class="form-control demo-select2-placeholder">
                            <option value="0">{{translate('Physical')}}</option>
                            <option value="1">{{translate('Digital')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner">{{translate('Banner')}} <small>({{ translate('200x300') }})</small></label>
                    <div class="col-sm-10">
                        <input type="file" id="banner" name="banner" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="icon">{{translate('Icon')}} <small>({{ translate('32x32') }})</small></label>
                    <div class="col-sm-10">
                        <input type="file" id="icon" name="icon" class="form-control">
                    </div>
                </div>  
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{translate('Meta Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{translate('Description')}}</label>
                    <div class="col-sm-10">
                        <textarea name="meta_description" rows="8" class="form-control"></textarea>
                    </div>
                </div>
                @if (\App\BusinessSetting::where('type', 'category_wise_commission')->first()->value == 1)
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{translate('Commission Rate')}}</label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" placeholder="{{translate('Commission Rate')}}" id="commision_rate" name="commision_rate" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <option class="form-control">%</option>
                        </div>
                @endif
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
