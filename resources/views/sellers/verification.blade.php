@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <div class="panel-control">
            <a href="{{ route('sellers.reject', $seller->id) }}" class="btn btn-default btn-rounded d-innline-block">{{translate('Reject')}}</a></li>
            <a href="{{ route('sellers.approve', $seller->id) }}" class="btn btn-primary btn-rounded d-innline-block">{{translate('Accept')}}</a>
        </div>
        <h3 class="panel-title">{{translate('Seller Verification')}}</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-4">
            <div class="panel-heading">
                <h3 class="text-lg">{{translate('User Info')}}</h3>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Name')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->name }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Email')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->email }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Address')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->address }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Phone')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->phone }}</p>
                </div>
            </div>


            <div class="panel-heading">
                <h3 class="text-lg">{{translate('Shop Info')}}</h3>
            </div>

            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Shop Name')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->shop->name }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Address')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->shop->address }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-heading">
                <h3 class="text-lg">{{translate('Verification Info')}}</h3>
            </div>
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tbody>
                    @foreach (json_decode($seller->verification_info) as $key => $info)
                        <tr>
                            <th>{{ $info->label }}</th>
                            @if ($info->type == 'text' || $info->type == 'select' || $info->type == 'radio')
                                <td>{{ $info->value }}</td>
                            @elseif ($info->type == 'multi_select')
                                <td>
                                    {{ implode(json_decode($info->value), ', ') }}
                                </td>
                            @elseif ($info->type == 'file')
                                <td>
                                    <a href="{{ my_asset($info->value) }}" target="_blank" class="btn-info">{{translate('Click here')}}</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('sellers.reject', $seller->id) }}" class="btn btn-default d-innline-block">{{translate('Reject')}}</a></li>
                <a href="{{ route('sellers.approve', $seller->id) }}" class="btn btn-primary d-innline-block">{{translate('Accept')}}</a>
            </div>
        </div>
    </div>
</div>

@endsection
