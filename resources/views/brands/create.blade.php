@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Brand Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{translate('Logo')}} <small>({{ translate('120x80') }})</small></label>
                    <div class="col-sm-10">
                        <input type="file" id="logo" name="logo" class="form-control">
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
